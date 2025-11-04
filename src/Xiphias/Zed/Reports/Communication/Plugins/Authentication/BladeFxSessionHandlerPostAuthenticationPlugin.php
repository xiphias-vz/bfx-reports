<?php


namespace Xiphias\Zed\Reports\Communication\Plugins\Authentication;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Xiphias\BladeFxApi\DTO\BladeFxAuthenticationResponseTransfer;

/**
 * @method \Xiphias\Zed\Reports\Communication\ReportsCommunicationFactory getFactory()
 */
class BladeFxSessionHandlerPostAuthenticationPlugin extends AbstractPlugin implements BladeFxPostAuthenticationPluginInterface
{
    /**
     * @param \Xiphias\BladeFxApi\DTO\BladeFxAuthenticationResponseTransfer $authenticationResponseTransfer
     *
     * @return void
     */
    public function execute(BladeFxAuthenticationResponseTransfer $authenticationResponseTransfer): void
    {
        $sessionClient = $this->getFactory()->getSessionClient();

        $sessionClient->set(
            $this->getFactory()->getConfig()->getBfxTokenSessionKey(),
            $authenticationResponseTransfer->getAccessToken(),
        );

        $sessionClient->set(
            $this->getFactory()->getConfig()->getBfxUserIdSessionKey(),
            $authenticationResponseTransfer->getIdUser(),
        );

        $sessionClient->set(
            $this->getFactory()->getConfig()->getBfxUserCompanyIdSessionKey(),
            $authenticationResponseTransfer->getIdCompany(),
        );

        $sessionClient->set(
            $this->getFactory()->getConfig()->getBfxUserLanguageIdSessionKey(),
            $authenticationResponseTransfer->getIdLanguage(),
        );
    }
}
