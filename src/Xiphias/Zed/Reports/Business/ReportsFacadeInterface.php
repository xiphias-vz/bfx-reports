<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business;

use Xiphias\BladeFxApi\DTO\BladeFxGetReportByFormatResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxGetReportParamFormResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxGetReportsListResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxParameterTransfer;
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
     * @param \Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer|null $paramListTransfer
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportByFormatResponseTransfer
     */
    public function getReportByIdInWantedFormat(
        int $reportId,
        string $format,
        ?BladeFxParameterListTransfer $paramListTransfer
    ): BladeFxGetReportByFormatResponseTransfer;

    /**
     * @param string|null $attribute
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportsListResponseTransfer
     */
    public function getAllReports(?string $attribute): BladeFxGetReportsListResponseTransfer;

    /**
     * @param int $reportId
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportParamFormResponseTransfer
     */
    public function getReportParamForm(int $reportId): BladeFxGetReportParamFormResponseTransfer;

    /**
     * @param \Xiphias\BladeFxApi\DTO\BladeFxParameterTransfer $parameterTransfer
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewResponseTransfer
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
     * @return \Xiphias\BladeFxApi\DTO\BladeFxParameterTransfer
     */
    public function mapPreviewParametersToNewParameterTransfer(Request $request): BladeFxParameterTransfer;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer
     */
    public function mapDownloadParametersToNewParameterListTransfer(Request $request): BladeFxParameterListTransfer;

    /**
     * @param \Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewResponseTransfer $responseTransfer
     *
     * @return string
     */
    public function assemblePreviewUrl(BladeFxGetReportPreviewResponseTransfer $responseTransfer): string;
}
