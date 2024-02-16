<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BladeFx\Zed\Reports\Communication\Plugins\Provider;

use BladeFx\Zed\Reports\Business\ReportsFacade;
use BladeFx\Zed\Reports\Business\ReportsFacadeInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class BladeFxFacadeProviderPlugin extends AbstractPlugin
{
    /**
     * @return \BladeFx\Zed\Reports\Business\ReportsFacadeInterface
     */
    public function getReportsFacade(): ReportsFacadeInterface
    {
        return new ReportsFacade();
    }
}
