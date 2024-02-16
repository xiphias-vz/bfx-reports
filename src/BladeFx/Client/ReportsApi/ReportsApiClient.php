<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BladeFx\Client\ReportsApi;

use Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer;
use Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer;
use Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetCategoriesListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParameterListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParameterListResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer;
use Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \BladeFx\Client\ReportsApi\ReportsApiFactory getFactory()
 */
class ReportsApiClient extends AbstractClient implements ReportsApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer
     */
    public function sendAuthenticateUserRequest(BladeFxAuthenticationRequestTransfer $requestTransfer): BladeFxAuthenticationResponseTransfer
    {
        return $this->getFactory()->createApiHandler()->authenticateUser($requestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetCategoriesListRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer
     */
    public function sendGetCategoriesListRequest(BladeFxGetCategoriesListRequestTransfer $requestTransfer): BladeFxCategoriesListResponseTransfer
    {
        return $this->getFactory()->createApiHandler()->getCategoriesList($requestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer
     */
    public function sendGetReportsListRequest(
        BladeFxGetReportsListRequestTransfer $requestTransfer,
    ): BladeFxGetReportsListResponseTransfer {
        return $this->getFactory()->createApiHandler()->getReportsList($requestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer $requestTransfer
     *
     * @return void
     */
    public function sendSetFavoriteReportRequest(BladeFxSetFavoriteReportRequestTransfer $requestTransfer): void
    {
        $this->getFactory()->createApiHandler()->setFavoriteReport($requestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportParameterListRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportParameterListResponseTransfer
     */
    public function sendGetReportParameterListRequest(
        BladeFxGetReportParameterListRequestTransfer $requestTransfer,
    ): BladeFxGetReportParameterListResponseTransfer {
        return $this->getFactory()->createApiHandler()->getParameterList($requestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer
     */
    public function sendGetReportByFormatRequest(
        BladeFxGetReportByFormatRequestTransfer $requestTransfer,
    ): BladeFxGetReportByFormatResponseTransfer {
        return $this->getFactory()->createApiHandler()->getReportByFormat($requestTransfer);
    }
}
