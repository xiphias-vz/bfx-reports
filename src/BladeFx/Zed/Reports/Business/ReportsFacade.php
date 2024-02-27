<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BladeFx\Zed\Reports\Business;

use BladeFx\Zed\Reports\Communication\Table\SalesReportsTable;
use Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer;
use Generated\Shared\Transfer\BladeFxParameterTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \BladeFx\Zed\Reports\Business\ReportsBusinessFactory getFactory()
 */
class ReportsFacade extends AbstractFacade implements ReportsFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer
     */
    public function authenticateBladeFxUser(): BladeFxAuthenticationResponseTransfer
    {
        return $this->getFactory()
            ->createBladeFxAuthenticator()
            ->authenticate();
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function processCategoryTreeListRequest(Request $request): array
    {
        return $this->getFactory()
            ->createRequestProcessor()
            ->processCategoryTreeListRequest($request);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return void
     */
    public function processSetFavoriteReportRequest(Request $request): void
    {
        $this->getFactory()
            ->createRequestProcessor()
            ->processSetFavoriteReportRequest($request);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function processGetReportsRequest(Request $request): array
    {
        return $this->getFactory()
            ->createRequestProcessor()
            ->processGetReportsRequest($request);
    }

    /**
     * @param int $reportId
     * @param string $format
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer
     */
    public function getReportByIdInWantedFormat(
        int $reportId,
        string $format,
        ?BladeFxParameterTransfer $parameterTransfer = null,
    ): BladeFxGetReportByFormatResponseTransfer {
        return $this->getFactory()
            ->createBladeFxReportByFormatReader()
            ->getReportByFormat($reportId, $format, $parameterTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer $parameterTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer
     */
    public function getReportPreviewURL(
        BladeFxParameterTransfer $parameterTransfer,
    ): BladeFxGetReportPreviewResponseTransfer {
        return $this->getFactory()->createBladeFxPreviewReader()->getReportsPreview($parameterTransfer);
    }

    /**
     * @param string|null $attribute
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer
     */
    public function getAllReports(?string $attribute = ''): BladeFxGetReportsListResponseTransfer
    {
        return $this->getFactory()->createBladeFxReportListReader()->getReportList($attribute);
    }

    /**
     * @param int $reportId
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer
     */
    public function getReportParamForm(int $reportId): BladeFxGetReportParamFormResponseTransfer
    {
        return $this->getFactory()->createBladeFxReportsReader()->getReportParamForm($reportId);
    }

    /**
     * @param array|null $params
     *
     * @return \BladeFx\Zed\Reports\Communication\Table\SalesReportsTable
     */
    public function getSalesReportsTable(?array $params): SalesReportsTable
    {
        return $this->getFactory()->createSalesReportsTable($this, $params);
    }
}
