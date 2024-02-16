<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace BladeFx\Client\ReportsApi;

use Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer;
use Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer;
use Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetCategoriesListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer;
use Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer;

interface ReportsApiClientInterface
{
    /**
     * Specification:
     * - Used for authenticating users in bfx service
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer
     */
    public function sendAuthenticateUserRequest(BladeFxAuthenticationRequestTransfer $requestTransfer): BladeFxAuthenticationResponseTransfer;

    /**
     * Specification:
     * - Used for retrieving category list from bfx service
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BladeFxGetCategoriesListRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer
     */
    public function sendGetCategoriesListRequest(BladeFxGetCategoriesListRequestTransfer $requestTransfer): BladeFxCategoriesListResponseTransfer;

    /**
     * Specification:
     * - Used for retrieving report list from bfx service
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer
     */
    public function sendGetReportsListRequest(BladeFxGetReportsListRequestTransfer $requestTransfer): BladeFxGetReportsListResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer $requestTransfer
     *
     * @return void
     */
    public function sendSetFavoriteReportRequest(BladeFxSetFavoriteReportRequestTransfer $requestTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer
     */
    public function sendGetReportByFormatRequest(
        BladeFxGetReportByFormatRequestTransfer $requestTransfer,
    ): BladeFxGetReportByFormatResponseTransfer;
}