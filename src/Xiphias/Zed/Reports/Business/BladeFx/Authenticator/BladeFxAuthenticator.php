<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\Authenticator;

use Exception;
use Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer;
use Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer;
use Generated\Shared\Transfer\MerchantUserTransfer;
use Generated\Shared\Transfer\UserTransfer;
use Spryker\Client\Session\SessionClientInterface;
use Symfony\Component\HttpFoundation\Request;
use Xiphias\Client\ReportsApi\ReportsApiClientInterface;
use Xiphias\Zed\Reports\Business\BladeFx\Checker\BladeFxCheckerInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class BladeFxAuthenticator implements BladeFxAuthenticatorInterface
{
    /**
     * @var \Xiphias\Client\ReportsApi\ReportsApiClientInterface
     */
    protected ReportsApiClientInterface $apiClient;

    /**
     * @var \Xiphias\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $config;

    /**
     * @var \Spryker\Client\Session\SessionClientInterface
     */
    protected SessionClientInterface $sessionClient;

    /**
     * @var array<\Xiphias\Zed\Reports\Communication\Plugins\Authentication\BladeFxPostAuthenticationPluginInterface>
     */
    protected array $bladeFxPostAuthenticationPlugins;

    /**
     * @var \Xiphias\Zed\Reports\Business\BladeFx\Checker\BladeFxCheckerInterface
     */
    protected BladeFxCheckerInterface $bladeFxChecker;

    /**
     * @param \Xiphias\Client\ReportsApi\ReportsApiClientInterface $apiClient
     * @param \Xiphias\Zed\Reports\ReportsConfig $config
     * @param \Spryker\Client\Session\SessionClientInterface $sessionClient
     * @param array $bladeFxPostAuthenticationPlugins
     * @param \Xiphias\Zed\Reports\Business\BladeFx\Checker\BladeFxCheckerInterface $bladeFxChecker
     */
    public function __construct(
        ReportsApiClientInterface $apiClient,
        ReportsConfig $config,
        SessionClientInterface $sessionClient,
        array $bladeFxPostAuthenticationPlugins,
        BladeFxCheckerInterface $bladeFxChecker,
    ) {
        $this->apiClient = $apiClient;
        $this->config = $config;
        $this->sessionClient = $sessionClient;
        $this->bladeFxPostAuthenticationPlugins = $bladeFxPostAuthenticationPlugins;
        $this->bladeFxChecker = $bladeFxChecker;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request|null $request
     * @param \Generated\Shared\Transfer\UserTransfer|null $userTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer|bool
     */
    public function authenticate(?Request $request = null, ?UserTransfer $userTransfer = null): BladeFxAuthenticationResponseTransfer|bool
    {
        $validatedAuthenticationRequestTransfer = $this->bladeFxChecker->checkIfAdmin($userTransfer) ? $this->getRootUserAuthenticationRequestTransfer() : $this->getAuthenticationRequestTransfer($request->request->getIterator()->current());

        try {
            $authenticationResponseTransfer = $this->apiClient->sendAuthenticateUserRequest(
                $validatedAuthenticationRequestTransfer,
            );

            $this->executePostAuthenticationPlugins($authenticationResponseTransfer);
        } catch (Exception $exception) {
            return false;
        }

        return $authenticationResponseTransfer;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Generated\Shared\Transfer\MerchantUserTransfer $merchantUserTransfer
     *
     * @return void
     */
    public function authenticateUserOnMerchantPortal(Request $request, MerchantUserTransfer $merchantUserTransfer): void
    {
        if ($this->bladeFxChecker->checkIfUserHasBfxMPGroup($merchantUserTransfer->getIdUser())) {
            $userInfo = $request->request->getIterator()->current();

            $authenticationResponseTransfer = $this->apiClient->sendAuthenticateUserRequest(
                $this->getAuthenticationRequestTransfer($userInfo),
            );

            $this->setUserAuthTokenToSession($authenticationResponseTransfer->getToken());
        }
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer $authenticationResponseTransfer
     *
     * @return void
     */
    protected function executePostAuthenticationPlugins(BladeFxAuthenticationResponseTransfer $authenticationResponseTransfer): void
    {
        foreach ($this->bladeFxPostAuthenticationPlugins as $bladeFxPostAuthenticationPlugin) {
            $bladeFxPostAuthenticationPlugin->execute($authenticationResponseTransfer);
        }
    }

    /**
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer
     */
    protected function getRootUserAuthenticationRequestTransfer(): BladeFxAuthenticationRequestTransfer
    {
        return (new BladeFxAuthenticationRequestTransfer())
            ->setUsername($this->config->getDefaultUsername())
            ->setPassword($this->config->getDefaultPassword())
            ->setLicenceExp($this->config->getDefaultLicenceExp());
    }

    /**
     * @param array $userInfo
     *
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer
     */
    protected function getAuthenticationRequestTransfer(array $userInfo): BladeFxAuthenticationRequestTransfer
    {
        return (new BladeFxAuthenticationRequestTransfer())
            ->setUsername($userInfo['username'])
            ->setPassword($userInfo['password'])
            ->setLicenceExp($this->config->getDefaultLicenceExp());
    }

    /**
     * @param string $authToken
     *
     * @return void
     */
    protected function setUserAuthTokenToSession(string $authToken): void
    {
        $bfxTokenSessionKey = $this->config->getBfxTokenSessionKey();

        if (!$this->sessionClient->has($bfxTokenSessionKey)) {
            $this->sessionClient->set($bfxTokenSessionKey, $authToken);
        }
    }
}
