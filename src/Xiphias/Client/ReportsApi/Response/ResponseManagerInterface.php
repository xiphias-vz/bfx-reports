<?php


namespace Xiphias\Client\ReportsApi\Response;

use Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer;
use Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer;
use Generated\Shared\Transfer\BladeFxCreateOrUpdateUserResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParameterListResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer;
use Generated\Shared\Transfer\BladeFxSetFavoriteReportResponseTransfer;
use Generated\Shared\Transfer\BladeFxUpdatePasswordResponseTransfer;
use Psr\Http\Message\ResponseInterface;

interface ResponseManagerInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer
     */
    public function getAuthenticationUserResponseTransfer(?ResponseInterface $response): BladeFxAuthenticationResponseTransfer;

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return \Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer
     */
    public function getCategoriesListResponseTransfer(?ResponseInterface $response): BladeFxCategoriesListResponseTransfer;

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer
     */
    public function getReportsListResponseTransfer(?ResponseInterface $response): BladeFxGetReportsListResponseTransfer;

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return \Generated\Shared\Transfer\BladeFxSetFavoriteReportResponseTransfer
     */
    public function getSetFavoriteReportResponseTransfer(?ResponseInterface $response): BladeFxSetFavoriteReportResponseTransfer;

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportParameterListResponseTransfer
     */
    public function getReportParameterListResponseTransfer(?ResponseInterface $response): BladeFxGetReportParameterListResponseTransfer;

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     * @param string $format
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer
     */
    public function getReportByFormatResponseTransfer(
        ?ResponseInterface $response,
        string $format
    ): BladeFxGetReportByFormatResponseTransfer;

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer
     */
    public function getReportParamFormResponseTransfer(?ResponseInterface $response): BladeFxGetReportParamFormResponseTransfer;

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer
     */
    public function getReportPreviewResponseTransfer(?ResponseInterface $response): BladeFxGetReportPreviewResponseTransfer;

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return \Generated\Shared\Transfer\BladeFxCreateOrUpdateUserResponseTransfer
     */
    public function getCreateOrUpdateUserOnBladeFxResponseTransfer(?ResponseInterface $response): BladeFxCreateOrUpdateUserResponseTransfer;

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return \Generated\Shared\Transfer\BladeFxUpdatePasswordResponseTransfer
     */
    public function getUpdatePasswordOnBladeFxRequest(?ResponseInterface $response): BladeFxUpdatePasswordResponseTransfer;
}
