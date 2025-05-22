<?php

namespace Xiphias\Zed\Reports\Communication\TabCreator;

use Generated\Shared\Transfer\TabItemTransfer;
use Generated\Shared\Transfer\TabsViewTransfer;

class TabCreator implements TabCreatorInterface
{
    /**
     * @var string
     */
    public const REPORT_NAME = 'report';

    /**
     * @var string
     */
    public const REPORT_TITLE = 'Reports';

    /**
     * @param \Generated\Shared\Transfer\TabsViewTransfer $tabsViewTransfer
     *
     * @return \Generated\Shared\Transfer\TabsViewTransfer
     */
    public function createReportListTabForOrderOverview(TabsViewTransfer $tabsViewTransfer): TabsViewTransfer
    {
        $tabItemTransfer = new TabItemTransfer();
        $tabItemTransfer
            ->setName(static::REPORT_NAME)
            ->setTitle(static::REPORT_TITLE)
            ->setTemplate($this->getReportsTemplate());

        $tabsViewTransfer->addTab($tabItemTransfer);

        return $tabsViewTransfer;
    }

    /**
     * @return string
     */
    protected function getReportsTemplate(): string
    {
        return '@Reports/Sales/report-list.twig';
    }
}
