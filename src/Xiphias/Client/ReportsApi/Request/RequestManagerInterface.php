<?php


namespace Xiphias\Client\ReportsApi\Request;

use Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer;
use Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetCategoriesListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParameterListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParamFormRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer;
use Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer;
use Generated\Shared\Transfer\BladeFxUpdatePasswordRequestTransfer;
use Psr\Http\Message\RequestInterface;
use Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface;

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
        BladeFxGetReportParameterListRequestTransfer $requestTransfer
    ): RequestInterface;

    /**
     * @param \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface $requestBuilder
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
        BladeFxGetReportByFormatRequestTransfer $requestTransfer
    ): RequestInterface;

    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxGetReportParamFormRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getReportParamFormRequest(
        string $resource,
        BladeFxGetReportParamFormRequestTransfer $requestTransfer
    ): RequestInterface;

    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getReportPreview(
        string $resource,
        BladeFxGetReportPreviewRequestTransfer $requestTransfer
    ): RequestInterface;

    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getCreateOrUpdateUserOnBladeFxRequest(
        string $resource,
        BladeFxCreateOrUpdateUserRequestTransfer $requestTransfer
    ): RequestInterface;

    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxUpdatePasswordRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getUpdatePasswordOnBladeFxRequest(
        string $resource,
        BladeFxUpdatePasswordRequestTransfer $requestTransfer
    ): RequestInterface;
}
