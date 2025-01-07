<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

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
