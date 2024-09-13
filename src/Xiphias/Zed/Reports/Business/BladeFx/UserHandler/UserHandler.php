<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\UserHandler;

use Exception;
use Generated\Shared\Transfer\BladeFxCreateOrUpdateUserCustomFieldsTransfer;
use Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestTransfer;
use Generated\Shared\Transfer\BladeFxTokenTransfer;
use Generated\Shared\Transfer\UserTransfer;
use Spryker\Client\Session\SessionClientInterface;
use Xiphias\Client\ReportsApi\ReportsApiClientInterface;
use Xiphias\Zed\Reports\Business\BladeFx\Checker\BladeFxCheckerInterface;
use Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class UserHandler implements UserHandlerInterface
{
    /**
     * @var string
     */
    protected const ID_USER = 'id_user';

    /**
     * @var string
     */
    protected const USERNAME = 'username';

    /**
     * @var string
     */
    protected const FIRST_NAME = 'first_name';

    /**
     * @var string
     */
    protected const LAST_NAME = 'last_name';

    /**
     * @var string
     */
    protected const PASSWORD = 'password';

    /**
     * @var string
     */
    protected const SRYKER_BO_ROLE = 'SprykerBORole';

    /**
     * @var string
     */
    protected const SPRYKER_MP_ROLE = 'SprykerMPRole';

    /**
     * @var string
     */
    protected const GROUP = 'group';

    /**
     * @var \Xiphias\Client\ReportsApi\ReportsApiClientInterface
     */
    protected ReportsApiClientInterface $apiClient;

    /**
     * @var \Spryker\Client\Session\SessionClientInterface
     */
    protected SessionClientInterface $sessionClient;

    /**
     * @var \Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface
     */
    protected TokenResolverInterface $tokenResolver;

    /**
     * @var \Xiphias\Zed\Reports\Business\BladeFx\Checker\BladeFxCheckerInterface
     */
    protected BladeFxCheckerInterface $bladeFxChecker;

    /**
     * @var \Xiphias\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $config;

    /**
     * @param \Xiphias\Client\ReportsApi\ReportsApiClientInterface $apiClient
     * @param \Spryker\Client\Session\SessionClientInterface $sessionClient
     * @param \Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface $tokenResolver
     * @param \Xiphias\Zed\Reports\Business\BladeFx\Checker\BladeFxCheckerInterface $bladeFxChecker
     * @param \Xiphias\Zed\Reports\ReportsConfig $config
     */
    public function __construct(
        ReportsApiClientInterface $apiClient,
        SessionClientInterface $sessionClient,
        TokenResolverInterface $tokenResolver,
        BladeFxCheckerInterface $bladeFxChecker,
        ReportsConfig $config,
    ) {
        $this->apiClient = $apiClient;
        $this->sessionClient = $sessionClient;
        $this->tokenResolver = $tokenResolver;
        $this->bladeFxChecker = $bladeFxChecker;
        $this->config = $config;
    }

    /**
     * @param array $groupRoles
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function createOrUpdateUserOnBladeFx(array $groupRoles, UserTransfer $userTransfer): void
    {
        $userId = $userTransfer->getIdUser();

        if (!$this->bladeFxChecker->checkIfPasswordExists($userTransfer->getPassword())) {
            return;
        }

//        //Changes for market place and merchant portal
//        if ($this->bladeFxChecker->checkIfMerchantPortalUserApplicableForCreationOnBfx($groupRoles, $userId)) {
//            $this->createUserOrUpdateOnBfx($userTransfer, true, false);
//        } elseif ($this->bladeFxChecker->checkIfMerchantPortalUserApplicableForUpdateOnBfx($groupRoles, $userId)) {
//            $this->createUserOrUpdateOnBfx($userTransfer, true, false);
//        } elseif ($this->bladeFxChecker->checkIfMerchantPortalUserApplicableForDeleteOnBfx($groupRoles, $userId)) {
//            $this->createUserOrUpdateOnBfx($userTransfer, false, false);
//        } elseif ($this->bladeFxChecker->checkIfBackofficeUserApplicableForCreationOnBfx($groupRoles, $userId)) {
//            $this->createUserOrUpdateOnBfx($userTransfer);
//        } elseif ($this->bladeFxChecker->checkIfBackofficeUserApplicableForUpdateOnBfx($groupRoles, $userId)) {
//            $this->createUserOrUpdateOnBfx($userTransfer);
//        } elseif ($this->bladeFxChecker->checkIfBackofficeUserApplicableForDeleteOnBfx($groupRoles, $userId)) {
//            $this->createUserOrUpdateOnBfx($userTransfer, false);
//        }

        //Changes for b2c
        if ($this->bladeFxChecker->checkIfBackofficeUserApplicableForCreationOnBfx($groupRoles, $userId)) {
            $this->createUserOrUpdateOnBfx($userTransfer);
        } elseif ($this->bladeFxChecker->checkIfBackofficeUserApplicableForUpdateOnBfx($groupRoles, $userId)) {
            $this->createUserOrUpdateOnBfx($userTransfer);
        } elseif ($this->bladeFxChecker->checkIfBackofficeUserApplicableForDeleteOnBfx($groupRoles, $userId)) {
            $this->deleteUserOnBladeFx($userTransfer);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function deleteUserOnBladeFx(UserTransfer $userTransfer): void
    {
        $this->createUserOrUpdateOnBfx($userTransfer, false);
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     * @param bool $isActive
     * @param bool $isItFromBO
     *
     * @return void
     */
    public function createUserOrUpdateOnBfx(UserTransfer $userTransfer, bool $isActive = true, bool $isItFromBO = true): void
    {
        $requestTransfer = $this->generateAuthenticatedCreateOrUpdateUserOnBladeFxRequestTransfer($userTransfer, $isActive, $isItFromBO);

        try {
            $this->apiClient->sendCreateOrUpdateUserOnBfxRequest($requestTransfer);
        } catch (Exception $exception) {
            return;
        }
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     * @param bool $isActive
     * @param bool $isItFromBO
     *
     * @return \Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestTransfer
     */
    public function generateAuthenticatedCreateOrUpdateUserOnBladeFxRequestTransfer(
        UserTransfer $userTransfer,
        bool $isActive = true,
        bool $isItFromBO = true,
    ): BladeFxCreateOrUpdateUserRequestTransfer {
        $bladeFxCreateOrUpdateUserRequestTransfer = (new BladeFxCreateOrUpdateUserRequestTransfer())
            ->setToken((new BladeFxTokenTransfer())->setToken($this->getToken()))
            ->setEmail($userTransfer->getUsername())
            ->setFirstName($userTransfer->getFirstName())
            ->setLastName($userTransfer->getLastName())
            ->setPassword($userTransfer->getPassword())
            ->setRoleName($isItFromBO ? static::SRYKER_BO_ROLE : static::SPRYKER_MP_ROLE)
            ->setCompanyId($this->getUserIdCompany())
            ->setLanguageId($this->getUserIdLanguage())
            ->setIsActive($isActive)
            ->addCustomFields((new BladeFxCreateOrUpdateUserCustomFieldsTransfer())
                ->setFieldName($this->config->getSprykerUserIdKey())
                ->setFieldValue((string)($userTransfer->getIdUser())));

        return $this->appendMerchantIdToRequest($bladeFxCreateOrUpdateUserRequestTransfer, $userTransfer->getIdUser(), $isItFromBO);
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestTransfer $bladeFxCreateOrUpdateUserRequestTransfer
     * @param int $userId
     * @param bool $isItFromBO
     *
     * @return \Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestTransfer
     */
    protected function appendMerchantIdToRequest(
        BladeFxCreateOrUpdateUserRequestTransfer $bladeFxCreateOrUpdateUserRequestTransfer,
        int $userId,
        bool $isItFromBO,
    ): BladeFxCreateOrUpdateUserRequestTransfer {
        if (!$isItFromBO) {
            return $bladeFxCreateOrUpdateUserRequestTransfer
                ->addCustomFields((new BladeFxCreateOrUpdateUserCustomFieldsTransfer())
                    ->setFieldName($this->config->getMerchantIdKey())
                    ->setFieldValue($this->bladeFxChecker->getUserMerchantId($userId)));
        }

        return $bladeFxCreateOrUpdateUserRequestTransfer;
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
