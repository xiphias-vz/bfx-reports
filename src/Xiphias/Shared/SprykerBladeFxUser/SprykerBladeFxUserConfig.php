<?php


namespace Xiphias\Shared\SprykerBladeFxUser;

use Spryker\Shared\Kernel\AbstractSharedConfig;

class SprykerBladeFxUserConfig extends AbstractSharedConfig
{
    /**
     * @return string
     */
    public function getMarketplaceInstallation(): string
    {
        return SprykerBladeFxUserConstants::MARKETPLACE_INSTALLATION;
    }
}
