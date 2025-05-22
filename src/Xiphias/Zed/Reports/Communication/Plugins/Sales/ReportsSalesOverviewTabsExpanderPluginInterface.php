<?php

namespace Xiphias\Zed\Reports\Communication\Plugins\Sales;

use Generated\Shared\Transfer\TabsViewTransfer;

interface ReportsSalesOverviewTabsExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\TabsViewTransfer $tabsViewTransfer
     *
     * @return \Generated\Shared\Transfer\TabsViewTransfer
     */
    public function expand(TabsViewTransfer $tabsViewTransfer): TabsViewTransfer;
}
