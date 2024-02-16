<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace BladeFx\Client\ReportsApi\Request;

use BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface;
use Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetCategoriesListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParameterListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer;
use Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer;
use Psr\Http\Message\RequestInterface;

interface RequestManagerInterface
{
    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getAuthenticateUserRequest(string $resource, BladeFxAuthenticationRequestTransfer $requestTransfer): RequestInterface;

    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxGetCategoriesListRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getCategoriesListRequest(string $resource, BladeFxGetCategoriesListRequestTransfer $requestTransfer): RequestInterface;

    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getSetFavoriteReportRequest(string $resource, BladeFxSetFavoriteReportRequestTransfer $requestTransfer): RequestInterface;

    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getReportsListRequest(string $resource, BladeFxGetReportsListRequestTransfer $requestTransfer): RequestInterface;

    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxGetReportParameterListRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getReportParametersRequest(
        string $resource,
        BladeFxGetReportParameterListRequestTransfer $requestTransfer,
    ): RequestInterface;

    /**
     * @param \BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface $requestBuilder
     *
     * @return void
     */
    public function setRequestBuilder(RequestBuilderInterface $requestBuilder): void;

    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getReportByFormatRequest(
        string $resource,
        BladeFxGetReportByFormatRequestTransfer $requestTransfer,
    ): RequestInterface;
}
