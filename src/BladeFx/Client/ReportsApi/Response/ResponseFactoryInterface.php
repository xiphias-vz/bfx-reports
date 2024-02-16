<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace BladeFx\Client\ReportsApi\Response;

use BladeFx\Client\ReportsApi\Response\Converter\ReportByFormatResponseConverter;
use BladeFx\Client\ReportsApi\Response\Converter\ResponseConverterInterface;
use BladeFx\Client\ReportsApi\Response\Validator\ReportByFormatResponseValidator;
use BladeFx\Client\ReportsApi\Response\Validator\ResponseValidatorInterface;

interface ResponseFactoryInterface
{
    /**
     * @return \BladeFx\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createAuthenticationResponseConverter(): ResponseConverterInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createAuthenticationResponseValidator(): ResponseValidatorInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createCategoriesListResponseConverter(): ResponseConverterInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createCategoriesListResponseValidator(): ResponseValidatorInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createReportsListResponseValidator(): ResponseValidatorInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createReportsListResponseConverter(): ResponseConverterInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createSetFavoriteReportResponseConverter(): ResponseConverterInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createSetFavoriteReportResponseValidator(): ResponseValidatorInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createReportParameterListResponseConverter(): ResponseConverterInterface;

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Converter\ReportByFormatResponseConverter
     */
    public function createReportByFormatResponseConverter(): ReportByFormatResponseConverter;

    /**
     * @return \BladeFx\Client\ReportsApi\Response\Validator\ReportByFormatResponseValidator
     */
    public function createReportByFormatResponseValidator(): ReportByFormatResponseValidator;
}
