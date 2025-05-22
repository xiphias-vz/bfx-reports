<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\ReportsUpdater;

use Generated\Shared\Transfer\ReportsUpdaterRequestTransfer;

interface ReportsUpdaterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ReportsUpdaterRequestTransfer $updaterRequestTransfer
     *
     * @return void
     */
    public function updateFavorite(ReportsUpdaterRequestTransfer $updaterRequestTransfer): void;
}
