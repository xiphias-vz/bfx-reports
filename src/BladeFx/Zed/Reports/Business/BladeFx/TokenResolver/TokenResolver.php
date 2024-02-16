<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BladeFx\Zed\Reports\Business\BladeFx\TokenResolver;

use BladeFx\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface;
use BladeFx\Zed\Reports\ReportsConfig;
use Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer;
use Spryker\Client\Session\SessionClientInterface;

class TokenResolver implements TokenResolverInterface
{
 /**
  * @var \BladeFx\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface
  */
    protected BladeFxAuthenticatorInterface $authenticator;

    /**
     * @var \Spryker\Client\Session\SessionClientInterface
     */
    protected SessionClientInterface $sessionClient;

    /**
     * @var \BladeFx\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $config;

    /**
     * @param \BladeFx\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface $authenticator
     * @param \Spryker\Client\Session\SessionClientInterface $sessionClient
     * @param \BladeFx\Zed\Reports\ReportsConfig $config
     */
    public function __construct(BladeFxAuthenticatorInterface $authenticator, SessionClientInterface $sessionClient, ReportsConfig $config)
    {
        $this->authenticator = $authenticator;
        $this->sessionClient = $sessionClient;
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function resolveToken(): string
    {
        $bfxTokenSessionKey = $this->config->getBfxTokenSessionKey();

        if ($this->sessionClient->has($bfxTokenSessionKey)) {
            return $this->sessionClient->get($bfxTokenSessionKey);
        }

        return $this->getAuthenticationResponseTransfer()->getToken();
    }

    /**
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer
     */
    protected function getAuthenticationResponseTransfer(): BladeFxAuthenticationResponseTransfer
    {
        return $this->authenticator->authenticate();
    }
}
