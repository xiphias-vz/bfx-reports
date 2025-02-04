<?php

namespace Xiphias\Zed\Reports\Communication\TabCreator;

use Generated\Shared\Transfer\TabsViewTransfer;

interface TabCreatorInterface
{
    public function createReportListTabForOrderOverview(TabsViewTransfer $tabsViewTransfer);
}
