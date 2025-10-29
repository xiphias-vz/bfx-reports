<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business;

use Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxGetReportParamFormResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxGetReportsListResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxParameterTransfer;
use Generated\Shared\Transfer\UserTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Xiphias\Zed\Reports\Business\ReportsBusinessFactory getFactory()
 */
class ReportsFacade extends AbstractFacade implements ReportsFacadeInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request|null $request
     * @param \Generated\Shared\Transfer\UserTransfer|null $userTransfer
     *
     * @return void
     */
    public function authenticateBladeFxUser(?Request $request = null, ?UserTransfer $userTransfer = null): void
    {
        $this->getFactory()
            ->createBladeFxAuthenticator()
            ->authenticate($request, $userTransfer);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function authenticateBladeFxUserOnMerchantPortal(Request $request, UserTransfer $userTransfer): void
    {
        $this->getFactory()->createBladeFxAuthenticator()->authenticateUserOnMerchantPortal($request, $userTransfer);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function buildCategoryTree(Request $request): array
    {
        return $this->getFactory()->createCategoryTreeBuilder()->buildCategoryTree($request);
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
     * @param array<int, mixed> $categories
     *
     * @return array<int, mixed>
     */
    public function assembleCategoryTree(array $categories): array
    {
        return $this->getFactory()->createCategoryTreeBuilder()->assembleCategoryTree($categories);
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
     * @param int $reportId
     * @param string $format
     * @param \Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer|null $paramListTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer
     */
    public function getReportByIdInWantedFormat(
        int $reportId,
        string $format,
        ?BladeFxParameterListTransfer $paramListTransfer = null
    ): BladeFxGetReportByFormatResponseTransfer {
        return $this->getFactory()
            ->createBladeFxReportByFormatReader()
            ->getReportByFormat($reportId, $format, $paramListTransfer);
    }

    /**
     * @param \Xiphias\BladeFxApi\DTO\BladeFxParameterTransfer $parameterTransfer
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewResponseTransfer
     */
    public function getReportPreviewURL(
        BladeFxParameterTransfer $parameterTransfer
    ): BladeFxGetReportPreviewResponseTransfer {
        return $this->getFactory()->createBladeFxPreviewReader()->getReportsPreview($parameterTransfer);
    }

    /**
     * @param string|null $attribute
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportsListResponseTransfer
     */
    public function getAllReports(?string $attribute = ''): BladeFxGetReportsListResponseTransfer
    {
        return $this->getFactory()->createBladeFxReportListReader()->getReportList($attribute);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string|null $attribute
     *
     * @return array
     */
    public function processGetReportsRequest(Request $request, ?string $attribute = ''): array
    {
        return $this->getFactory()
            ->createRequestProcessor()
            ->processGetReportsRequest($request, $attribute);
    }

    /**
     * @param int $reportId
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportParamFormResponseTransfer
     */
    public function getReportParamForm(int $reportId): BladeFxGetReportParamFormResponseTransfer
    {
        return $this->getFactory()->createBladeFxReportsReader()->getReportParamForm($reportId);
    }

    /**
     * @param string $fileFormat
     * @param int $reportId
     * @param string $reportName
     *
     * @return array
     */
    public function buildDownloadHeaders(string $fileFormat, int $reportId, string $reportName): array
    {
        return $this->getFactory()->createDownloadHeadersBuilder()->buildDownloadHeaders($fileFormat, $reportId, $reportName);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxParameterTransfer
     */
    public function mapPreviewParametersToNewParameterTransfer(Request $request): BladeFxParameterTransfer
    {
        return $this->getFactory()->createReportsMapper()->mapPreviewParametersToNewParameterTransfer($request);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer
     */
    public function mapDownloadParametersToNewParameterListTransfer(Request $request): BladeFxParameterListTransfer
    {
        return $this->getFactory()->createReportsMapper()->mapDownloadParametersToNewParameterListTransfer($request);
    }

    /**
     * @param \Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewResponseTransfer $responseTransfer
     *
     * @return string
     */
    public function assemblePreviewUrl(BladeFxGetReportPreviewResponseTransfer $responseTransfer): string
    {
        return $this->getFactory()->createReportsMapper()->assemblePreviewUrl($responseTransfer);
    }
}
