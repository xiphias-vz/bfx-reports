<?php

namespace Xiphias\Zed\Reports\Communication\TabCreator;

use Generated\Shared\Transfer\TabsViewTransfer;

interface TabCreatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\TabsViewTransfer $tabsViewTransfer
     *
     * @return mixed
     */
    public function createReportListTabForOrderOverview(TabsViewTransfer $tabsViewTransfer);
}
