<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business;

use Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer;
use Generated\Shared\Transfer\BladeFxParameterListTransfer;
use Generated\Shared\Transfer\BladeFxParameterTransfer;
use Generated\Shared\Transfer\UserTransfer;
use Symfony\Component\HttpFoundation\Request;

interface ReportsFacadeInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request|null $request
     * @param \Generated\Shared\Transfer\UserTransfer|null $userTransfer
     *
     * @return void
     */
    public function authenticateBladeFxUser(?Request $request = null, ?UserTransfer $userTransfer = null): void;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function authenticateBladeFxUserOnMerchantPortal(Request $request, UserTransfer $userTransfer): void;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function processCategoryTreeListRequest(Request $request): array;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return void
     */
    public function processSetFavoriteReportRequest(Request $request): void;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string|null $attribute
     *
     * @return array
     */
    public function processGetReportsRequest(Request $request, ?string $attribute = ''): array;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array<int, mixed>
     */
    public function buildCategoryTree(Request $request): array;

    /**
     * @param array<int, mixed> $categories
     *
     * @return array<int, mixed>
     */
    public function assembleCategoryTree(array $categories): array;

    /**
     * @param int $reportId
     * @param string $format
     * @param \Generated\Shared\Transfer\BladeFxParameterListTransfer|null $paramListTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer
     */
    public function getReportByIdInWantedFormat(
        int $reportId,
        string $format,
        ?BladeFxParameterListTransfer $paramListTransfer
    ): BladeFxGetReportByFormatResponseTransfer;

    /**
     * @param string|null $attribute
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer
     */
    public function getAllReports(?string $attribute): BladeFxGetReportsListResponseTransfer;

    /**
     * @param int $reportId
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer
     */
    public function getReportParamForm(int $reportId): BladeFxGetReportParamFormResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer $parameterTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer
     */
    public function getReportPreviewURL(
        BladeFxParameterTransfer $parameterTransfer
    ): BladeFxGetReportPreviewResponseTransfer;

    /**
     * @param string $fileFormat
     * @param int $reportId
     * @param string $reportName
     *
     * @return array
     */
    public function buildDownloadHeaders(string $fileFormat, int $reportId, string $reportName): array;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\BladeFxParameterTransfer
     */
    public function mapPreviewParametersToNewParameterTransfer(Request $request): BladeFxParameterTransfer;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\BladeFxParameterListTransfer
     */
    public function mapDownloadParametersToNewParameterListTransfer(Request $request): BladeFxParameterListTransfer;

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer $responseTransfer
     *
     * @return string
     */
    public function assemblePreviewUrl(BladeFxGetReportPreviewResponseTransfer $responseTransfer): string;
}
