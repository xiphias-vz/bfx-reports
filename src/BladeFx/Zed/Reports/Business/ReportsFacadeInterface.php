<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BladeFx\Zed\Reports\Business;

use Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer;
use Generated\Shared\Transfer\BladeFxParameterTransfer;
use Symfony\Component\HttpFoundation\Request;

interface ReportsFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer
     */
    public function authenticateBladeFxUser(): BladeFxAuthenticationResponseTransfer;

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
     *
     * @return array
     * @return \Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer
     */
    public function processGetReportsRequest(Request $request): array;

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
        ?BladeFxParameterTransfer $parameterTransfer,
    ): BladeFxGetReportByFormatResponseTransfer;

    /**
     * @param string|null $attribute
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer
     */
    public function getAllReports(?string $attribute): BladeFxGetReportsListResponseTransfer;
}
