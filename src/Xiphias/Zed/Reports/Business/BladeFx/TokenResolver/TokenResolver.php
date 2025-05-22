<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\TokenResolver;

use Spryker\Client\Session\SessionClientInterface;
use Xiphias\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class TokenResolver implements TokenResolverInterface
{
 /**
  * @var \Xiphias\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface
  */
    protected BladeFxAuthenticatorInterface $authenticator;

    /**
     * @var \Spryker\Client\Session\SessionClientInterface
     */
    protected SessionClientInterface $sessionClient;

    /**
     * @var \Xiphias\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $config;

    /**
     * @param \Xiphias\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface $authenticator
     * @param \Spryker\Client\Session\SessionClientInterface $sessionClient
     * @param \Xiphias\Zed\Reports\ReportsConfig $config
     */
    public function __construct(BladeFxAuthenticatorInterface $authenticator, SessionClientInterface $sessionClient, ReportsConfig $config)
    {
        $this->authenticator = $authenticator;
        $this->sessionClient = $sessionClient;
        $this->config = $config;
    }

    /**
     * @return string|null
     */
    public function resolveToken(): string|null
    {
        $bfxTokenSessionKey = $this->config->getBfxTokenSessionKey();

        return $this->sessionClient->has($bfxTokenSessionKey) ? $this->sessionClient->get($bfxTokenSessionKey) : null;
    }
}
