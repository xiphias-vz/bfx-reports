<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BladeFx\Zed\Reports\Business\BladeFx\RequestProcessor;

use BladeFx\Zed\Reports\Business\BladeFx\CategoryReader\BladeFxCategoryReaderInterface;
use BladeFx\Zed\Reports\Business\BladeFx\ReportsReader\ReportsReaderInterface;
use BladeFx\Zed\Reports\Business\BladeFx\ReportsUpdater\ReportsUpdaterInterface;
use BladeFx\Zed\Reports\ReportsConfig;
use Generated\Shared\Transfer\CategoryReaderRequestTransfer;
use Generated\Shared\Transfer\ReportsReaderRequestTransfer;
use Generated\Shared\Transfer\ReportsUpdaterRequestTransfer;
use Symfony\Component\HttpFoundation\Request;

class RequestProcessor implements RequestProcessorInterface
{
    /**
     * @var \BladeFx\Zed\Reports\Business\BladeFx\CategoryReader\BladeFxCategoryReaderInterface
     */
    protected BladeFxCategoryReaderInterface $categoryReader;

    /**
     * @var \BladeFx\Zed\Reports\Business\BladeFx\ReportsReader\ReportsReaderInterface
     */
    protected ReportsReaderInterface $reportsReader;

    /**
     * @var \BladeFx\Zed\Reports\Business\BladeFx\ReportsUpdater\ReportsUpdaterInterface
     */
    protected ReportsUpdaterInterface $reportsUpdater;

    /**
     * @var \BladeFx\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $config;

    /**
     * @param \BladeFx\Zed\Reports\Business\BladeFx\CategoryReader\BladeFxCategoryReaderInterface $categoryReader
     * @param \BladeFx\Zed\Reports\Business\BladeFx\ReportsReader\ReportsReaderInterface $reportsReader
     * @param \BladeFx\Zed\Reports\Business\BladeFx\ReportsUpdater\ReportsUpdaterInterface $reportsUpdater
     * @param \BladeFx\Zed\Reports\ReportsConfig $config
     */
    public function __construct(
        BladeFxCategoryReaderInterface $categoryReader,
        ReportsReaderInterface $reportsReader,
        ReportsUpdaterInterface $reportsUpdater,
        ReportsConfig $config,
    ) {
        $this->categoryReader = $categoryReader;
        $this->reportsReader = $reportsReader;
        $this->reportsUpdater = $reportsUpdater;
        $this->config = $config;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function processCategoryTreeListRequest(Request $request): array
    {
        $activeCategory = $request->query->getInt(
            $this->config->getCategoryQueryKey(),
            $this->config->getDefaultCategoryIndex(),
        );

        $categoryReaderRequestTransfer = (new CategoryReaderRequestTransfer())
            ->setActiveCategory($activeCategory);

        return $this->categoryReader
            ->getAllCategories($categoryReaderRequestTransfer)
            ->getCategoriesList()
            ->getArrayCopy();
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return void
     */
    public function processSetFavoriteReportRequest(Request $request): void
    {
        $repId = $request->query->getInt('rep_id');
        $isFavorite = $request->query->getBoolean('is_favorite');

        $updaterRequestTransfer = (new ReportsUpdaterRequestTransfer())
            ->setRepId($repId)
            ->setIsFavorite($isFavorite);

        $this->reportsUpdater->updateFavorite($updaterRequestTransfer);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function processGetReportsRequest(Request $request): array
    {
        $categoryId = $request->query->getInt(
            $this->config->getCategoryQueryKey(),
            $this->config->getDefaultCategoryIndex(),
        );

        $reportsReaderRequestTransfer = (new ReportsReaderRequestTransfer())->setActiveCategory($categoryId);

        return $this->reportsReader
            ->getReportsList($reportsReaderRequestTransfer)
            ->getReportsList()
            ->getArrayCopy();
    }
}
