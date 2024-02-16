<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BladeFx\Zed\Reports\Communication\Plugins\Provider;

use BladeFx\Zed\Reports\ReportsConfig;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class ReportsConfigProviderPlugin extends AbstractPlugin
{
    /**
     * @return \BladeFx\Zed\Reports\ReportsConfig
     */
    public function getReportsConfig(): ReportsConfig
    {
        return new ReportsConfig();
    }
}
