<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace BladeFx\Client\ReportsApi\Request;

use BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface;
use BladeFx\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface;
use BladeFx\Client\ReportsApi\Request\Validator\RequestValidatorInterface;

interface RequestFactoryInterface
{
    /**
     * @return \BladeFx\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createAuthenticationRequestValidator(): RequestValidatorInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createCategoriesListRequestValidator(): RequestValidatorInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createSetFavoriteReportRequestValidator(): RequestValidatorInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportsListRequestValidator(): RequestValidatorInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createAuthenticationRequestBuilder(): RequestBuilderInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createCategoriesListRequestBuilder(): RequestBuilderInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportsListRequestBuilder(): RequestBuilderInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createSetFavoriteReportRequestBuilder(): RequestBuilderInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportParameterListRequestBuilder(): RequestBuilderInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportParameterListRequestValidator(): RequestValidatorInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportByFormatRequestBuilder(): RequestBuilderInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportPreviewRequestBuilder(): RequestBuilderInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportByFormatRequestValidator(): RequestValidatorInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface
     */
    public function createRequestBodyFormatter(): RequestBodyFormatterInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportParamFormRequestBuilder(): RequestBuilderInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportParamFormRequestValidator(): RequestValidatorInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportPreviewRequestValidator(): RequestValidatorInterface;
}
