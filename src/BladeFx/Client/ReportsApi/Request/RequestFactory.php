<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BladeFx\Client\ReportsApi\Request;

use BladeFx\Client\ReportsApi\ReportsApiDependencyProvider;
use BladeFx\Client\ReportsApi\ReportsApiFactory;
use BladeFx\Client\ReportsApi\Request\Builder\AuthenticationRequestBuilder;
use BladeFx\Client\ReportsApi\Request\Builder\CategoriesListRequestBuilder;
use BladeFx\Client\ReportsApi\Request\Builder\ReportByFormatRequestBuilder;
use BladeFx\Client\ReportsApi\Request\Builder\ReportParameterListRequestBuilder;
use BladeFx\Client\ReportsApi\Request\Builder\ReportsListRequestBuilder;
use BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface;
use BladeFx\Client\ReportsApi\Request\Builder\SetFavoriteReportRequestBuilder;
use BladeFx\Client\ReportsApi\Request\Formatter\RequestBodyFormatter;
use BladeFx\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface;
use BladeFx\Client\ReportsApi\Request\Validator\AuthenticationRequestValidator;
use BladeFx\Client\ReportsApi\Request\Validator\CategoriesListRequestValidator;
use BladeFx\Client\ReportsApi\Request\Validator\ReportByFormatRequestValidator;
use BladeFx\Client\ReportsApi\Request\Validator\ReportParameterListRequestValidator;
use BladeFx\Client\ReportsApi\Request\Validator\ReportsListRequestValidator;
use BladeFx\Client\ReportsApi\Request\Validator\RequestValidatorInterface;
use BladeFx\Client\ReportsApi\Request\Validator\SetFavoriteReportRequestValidator;

class RequestFactory extends ReportsApiFactory implements RequestFactoryInterface
{
    /**
     * @return \BladeFx\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createAuthenticationRequestValidator(): RequestValidatorInterface
    {
        return new AuthenticationRequestValidator();
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createCategoriesListRequestValidator(): RequestValidatorInterface
    {
        return new CategoriesListRequestValidator();
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createSetFavoriteReportRequestValidator(): RequestValidatorInterface
    {
        return new SetFavoriteReportRequestValidator();
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportsListRequestValidator(): RequestValidatorInterface
    {
        return new ReportsListRequestValidator();
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportParameterListRequestValidator(): RequestValidatorInterface
    {
        return new ReportParameterListRequestValidator();
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportByFormatRequestValidator(): RequestValidatorInterface
    {
        return new ReportByFormatRequestValidator();
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createAuthenticationRequestBuilder(): RequestBuilderInterface
    {
        return new AuthenticationRequestBuilder(
            $this->getConfig(),
            $this->getUtilEncodingService(),
            $this->createRequestBodyFormatter(),
            $this->getAuthenticationRequestFormatterPlugins(),
        );
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createCategoriesListRequestBuilder(): RequestBuilderInterface
    {
        return new CategoriesListRequestBuilder(
            $this->getConfig(),
            $this->getUtilEncodingService(),
            $this->createRequestBodyFormatter(),
        );
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportsListRequestBuilder(): RequestBuilderInterface
    {
        return new ReportsListRequestBuilder(
            $this->getConfig(),
            $this->getUtilEncodingService(),
            $this->createRequestBodyFormatter(),
        );
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportParameterListRequestBuilder(): RequestBuilderInterface
    {
        return new ReportParameterListRequestBuilder(
            $this->getConfig(),
            $this->getUtilEncodingService(),
            $this->createRequestBodyFormatter(),
        );
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportByFormatRequestBuilder(): RequestBuilderInterface
    {
        return new ReportByFormatRequestBuilder(
            $this->createRequestBodyFormatter(),
            $this->getUtilEncodingService(),
            $this->getConfig(),
        );
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createSetFavoriteReportRequestBuilder(): RequestBuilderInterface
    {
        return new SetFavoriteReportRequestBuilder(
            $this->getConfig(),
            $this->getUtilEncodingService(),
            $this->createRequestBodyFormatter(),
        );
    }

    /**
     * @return array<\BladeFx\Client\ReportsApi\Plugins\Formatter\AuthenticationRequestFormatterPluginInterface>
     */
    protected function getAuthenticationRequestFormatterPlugins(): array
    {
        return $this->getProvidedDependency(ReportsApiDependencyProvider::AUTHENTICATION_REQUEST_FORMATTER_PLUGINS);
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface
     */
    public function createRequestBodyFormatter(): RequestBodyFormatterInterface
    {
        return new RequestBodyFormatter();
    }
}
