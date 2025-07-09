<?php


namespace Xiphias\Zed\SprykerBladeFxUser\Business\Handler;

use Exception;
use Generated\Shared\Transfer\BladeFxCreateOrUpdateUserCustomFieldsTransfer;
use Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestTransfer;
use Generated\Shared\Transfer\BladeFxCreateOrUpdateUserResponseTransfer;
use Generated\Shared\Transfer\BladeFxTokenTransfer;
use Generated\Shared\Transfer\BladeFxUpdatePasswordRequestTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\UserTransfer;
use Spryker\Client\Session\SessionClientInterface;
use Spryker\Zed\Event\Business\EventFacadeInterface;
use Spryker\Zed\Messenger\Business\MessengerFacadeInterface;
use Xiphias\Client\ReportsApi\ReportsApiClientInterface;
use Xiphias\Shared\Reports\ReportsConstants;
use Xiphias\Zed\SprykerBladeFxUser\Business\Checker\BladeFXUserCheckerInterface;
use Xiphias\Zed\SprykerBladeFxUser\Persistence\SprykerBladeFxUserEntityManagerInterface;
use Xiphias\Zed\SprykerBladeFxUser\SprykerBladeFxUserConfig;

class BladeFxUserHandler implements BladeFxUserHandlerInterface
{
    /**
     * @param \Xiphias\Zed\SprykerBladeFxUser\Business\Checker\BladeFXUserCheckerInterface $bladeFXUserChecker
     * @param \Spryker\Client\Session\SessionClientInterface $sessionClient
     * @param \Xiphias\Client\ReportsApi\ReportsApiClientInterface $reportsApiClient
     * @param array $bfxUserHandlerPlugins
     * @param \Xiphias\Zed\SprykerBladeFxUser\SprykerBladeFxUserConfig $config
     * @param \Xiphias\Zed\SprykerBladeFxUser\Persistence\SprykerBladeFxUserEntityManagerInterface $entityManager
     * @param \Spryker\Zed\Messenger\Business\MessengerFacadeInterface $messengerFacade
     * @param \Spryker\Zed\Event\Business\EventFacadeInterface $eventFacade
     */
    public function __construct(
        protected BladeFXUserCheckerInterface $bladeFXUserChecker,
        protected SessionClientInterface $sessionClient,
        protected ReportsApiClientInterface $reportsApiClient,
        protected array $bfxUserHandlerPlugins,
        protected SprykerBladeFxUserConfig $config,
        protected SprykerBladeFxUserEntityManagerInterface $entityManager,
        protected MessengerFacadeInterface $messengerFacade,
        protected EventFacadeInterface $eventFacade
    ) {
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function executeCreateOrUpdateUserOnBladeFx(UserTransfer $userTransfer): void
    {
        $this->executeBfxUserHandlerPlugins($userTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    protected function executeBfxUserHandlerPlugins(UserTransfer $userTransfer): void
    {
        foreach ($this->bfxUserHandlerPlugins as $bfxUserHandlerPlugin) {
            if ($bfxUserHandlerPlugin->isApplicable($userTransfer)) {
                $bfxUserHandlerPlugin->execute($userTransfer);

                break;
            }
        }
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     * @param bool $isActive
     *
     * @return void
     */
    public function createOrUpdateUserOnBladeFx(UserTransfer $userTransfer, bool $isActive = true): void
    {
        $requestTransfer = $this->generateAuthenticatedCreateOrUpdateUserOnBladeFxRequestTransfer($userTransfer, $isActive);

        try {
            $responseTransfer = $this->reportsApiClient->sendCreateOrUpdateUserOnBfxRequest($requestTransfer);

            if ($isActive) {
                if ($responseTransfer->getSuccess()) {
                    $passwordUpdateRequestTransfer = $this->generateAuthenticatedUpdatePasswordOnBladeFxRequest($userTransfer, $responseTransfer);
                    $this->reportsApiClient->sendUpdatePasswordOnBladeFxRequest($passwordUpdateRequestTransfer);

                    return;
                }

                if ($responseTransfer->getLicenceIssue()) {
                    $this->addErrorMessage(ReportsConstants::USER_CREATE_FAILED_USER_CAP_ERROR);
                    $this->eventFacade->trigger(ReportsConstants::EVENT_USER_POST_SAVE_LICENSE_ISSUE, $userTransfer);
                }
            }

            if ($responseTransfer->getErrorMessage()) {
                $this->addErrorMessage($responseTransfer->getErrorMessage());
            }
        } catch (Exception $exception) {
            return;
        }
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     * @param \Generated\Shared\Transfer\BladeFxCreateOrUpdateUserResponseTransfer $responseTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxUpdatePasswordRequestTransfer
     */
    public function generateAuthenticatedUpdatePasswordOnBladeFxRequest(
        UserTransfer $userTransfer,
        BladeFxCreateOrUpdateUserResponseTransfer $responseTransfer
    ): BladeFxUpdatePasswordRequestTransfer {
        return (new BladeFxUpdatePasswordRequestTransfer())
            ->setToken((new BladeFxTokenTransfer())->setToken($this->getToken()))
            ->setBladeFxUserId($responseTransfer->getId())
            ->setPassword($userTransfer->getPassword());
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function deleteUserOnBladeFx(UserTransfer $userTransfer): void
    {
        $this->createOrUpdateUserOnBladeFx($userTransfer, false);
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     * @param bool $isActive
     *
     * @return \Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestTransfer
     */
    public function generateAuthenticatedCreateOrUpdateUserOnBladeFxRequestTransfer(
        UserTransfer $userTransfer,
        bool $isActive = true
    ): BladeFxCreateOrUpdateUserRequestTransfer {
        return (new BladeFxCreateOrUpdateUserRequestTransfer())
            ->setToken((new BladeFxTokenTransfer())->setToken($this->getToken()))
            ->setEmail($userTransfer->getUsername())
            ->setFirstName($userTransfer->getFirstName())
            ->setLastName($userTransfer->getLastName())
            ->setPassword($userTransfer->getPassword())
            ->setRoleName(ReportsConstants::SRYKER_BO_ROLE)
            ->setCompanyId($this->getUserIdCompany())
            ->setLanguageId($this->getUserIdLanguage())
            ->setIsActive($isActive)
            ->addCustomFields((new BladeFxCreateOrUpdateUserCustomFieldsTransfer())
                ->setFieldName($this->config->getSprykerUserIdKey())
                ->setFieldValue((string)($userTransfer->getIdUser())));
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function removeBladeFxGroupFromUser(UserTransfer $userTransfer): void
    {
        $this->entityManager->deleteUserHasGroupsByUserIdAndGroupId(
            $userTransfer->getIdUser(),
            $this->bladeFXUserChecker->getBladeFxGroupId(),
        );
    }

    /**
     * @param string $message
     *
     * @return void
     */
    public function addErrorMessage(string $message): void
    {
        $this->messengerFacade->addErrorMessage((new MessageTransfer())->setValue($message));
    }

    /**
     * @return string|null
     */
    protected function getToken(): string|null
    {
        return $this->sessionClient->has($this->config->getBfxTokenSessionKey()) ? $this->sessionClient->get($this->config->getBfxTokenSessionKey()) : null;
    }

    /**
     * @return int|null
     */
    protected function getUserIdCompany(): int|null
    {
        return $this->sessionClient->has($this->config->getBfxUserCompanyIdSessionKey()) ? $this->sessionClient->get($this->config->getBfxUserCompanyIdSessionKey()) : null;
    }

    /**
     * @return int|null
     */
    protected function getUserIdLanguage(): int|null
    {
        return $this->sessionClient->has($this->config->getBfxUserLanguageIdSessionKey()) ? $this->sessionClient->get($this->config->getBfxUserLanguageIdSessionKey()) : null;
    }
}
