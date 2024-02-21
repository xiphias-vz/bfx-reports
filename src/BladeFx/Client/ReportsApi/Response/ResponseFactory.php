<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace BladeFx\Client\ReportsApi\Response;

use BladeFx\Client\ReportsApi\Response\Converter\AuthenticationResponseConverter;
use BladeFx\Client\ReportsApi\Response\Converter\CategoriesListResponseConverter;
use BladeFx\Client\ReportsApi\Response\Converter\ReportByFormatResponseConverter;
use BladeFx\Client\ReportsApi\Response\Converter\ReportParameterListResponseConverter;
use BladeFx\Client\ReportsApi\Response\Converter\ReportParamFormResponseConverter;
use BladeFx\Client\ReportsApi\Response\Converter\ReportPreviewResponseConverter;
use BladeFx\Client\ReportsApi\Response\Converter\ReportsListResponseConverter;
use BladeFx\Client\ReportsApi\Response\Converter\ResponseConverterInterface;
use BladeFx\Client\ReportsApi\Response\Converter\SetFavoriteReportResponseConverter;
use BladeFx\Client\ReportsApi\Response\Validator\AuthenticationResponseValidator;
use BladeFx\Client\ReportsApi\Response\Validator\CategoriesListResponseValidator;
use BladeFx\Client\ReportsApi\Response\Validator\ReportByFormatResponseValidator;
use BladeFx\Client\ReportsApi\Response\Validator\ReportParameterListResponseValidator;
use BladeFx\Client\ReportsApi\Response\Validator\ReportParamFormResponseValidator;
use BladeFx\Client\ReportsApi\Response\Validator\ReportPreviewResponseValidator;
use BladeFx\Client\ReportsApi\Response\Validator\ReportsListResponseValidator;
use BladeFx\Client\ReportsApi\Response\Validator\ResponseValidatorInterface;
use BladeFx\Client\ReportsApi\Response\Validator\SetFavoriteReportResponseValidator;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class ResponseFactory implements ResponseFactoryInterface
{
    private UtilEncodingServiceInterface $utilEncodingService;

    /**
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     */
    public function __construct(UtilEncodingServiceInterface $utilEncodingService)
    {
        $this->utilEncodingService = $utilEncodingService;
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createAuthenticationResponseConverter(): ResponseConverterInterface
    {
        return new AuthenticationResponseConverter($this->utilEncodingService);
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createCategoriesListResponseConverter(): ResponseConverterInterface
    {
        return new CategoriesListResponseConverter($this->utilEncodingService);
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createReportsListResponseConverter(): ResponseConverterInterface
    {
        return new ReportsListResponseConverter($this->utilEncodingService);
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createSetFavoriteReportResponseConverter(): ResponseConverterInterface
    {
        return new SetFavoriteReportResponseConverter($this->utilEncodingService);
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createReportParameterListResponseConverter(): ResponseConverterInterface
    {
        return new ReportParameterListResponseConverter($this->utilEncodingService);
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Converter\ReportByFormatResponseConverter
     */
    public function createReportByFormatResponseConverter(): ResponseConverterInterface
    {
        return new ReportByFormatResponseConverter($this->utilEncodingService);
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createReportPreviewResponseConverter(): ResponseConverterInterface
    {
        return new ReportPreviewResponseConverter($this->utilEncodingService);
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createAuthenticationResponseValidator(): ResponseValidatorInterface
    {
        return new AuthenticationResponseValidator();
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createCategoriesListResponseValidator(): ResponseValidatorInterface
    {
        return new CategoriesListResponseValidator();
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createReportsListResponseValidator(): ResponseValidatorInterface
    {
        return new ReportsListResponseValidator();
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createSetFavoriteReportResponseValidator(): ResponseValidatorInterface
    {
        return new SetFavoriteReportResponseValidator();
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createReportParameterListResponseValidator(): ResponseValidatorInterface
    {
        return new ReportParameterListResponseValidator();
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createReportByFormatResponseValidator(): ResponseValidatorInterface
    {
        return new ReportByFormatResponseValidator();
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Converter\ReportParamFormResponseConverter
     */
    public function createReportParamFormRequestConverter(): ResponseConverterInterface
    {
        return new ReportParamFormResponseConverter($this->utilEncodingService);
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createReportParamFormResponseValidator(): ResponseValidatorInterface
    {
        return new ReportParamFormResponseValidator();
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createResponsePreviewValidator(): ResponseValidatorInterface
    {
        return new ReportPreviewResponseValidator();
    }
}
