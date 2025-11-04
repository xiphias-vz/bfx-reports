<?php


namespace Xiphias\Zed\Reports\Communication\Formatter;

use Spryker\Shared\Customer\CustomerConstants;
use Spryker\Zed\Sales\SalesConfig;
use Symfony\Component\HttpFoundation\Request;
use Xiphias\Shared\Reports\ReportsConstants;

class ParameterFormatter implements ParameterFormatterInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function formatRequestParameters(Request $request): array
    {
        return [
            ReportsConstants::ATTRIBUTE => $this->getAttributeValue($request),
            ReportsConstants::PARAMETER_NAME => $this->getParamName($request),
            ReportsConstants::PARAMETER_VALUE => $this->getParamValue($request),
        ];
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return string
     */
    protected function getAttributeValue(Request $request): string
    {
        if ($request->query->has(SalesConfig::PARAM_ID_SALES_ORDER)) {
            return ReportsConstants::BLADE_FX_ORDER_ATTRIBUTE;
        }
        if ($request->query->has(CustomerConstants::PARAM_ID_CUSTOMER)) {
            return ReportsConstants::BLADE_FX_CUSTOMER_ATTRIBUTE;
        }
        if ($request->query->has(ReportsConstants::SPRKYER_PARAM_ID_PRODUCT_ABSTRACT)) {
            return ReportsConstants::BLADE_FX_PRODUCT_ATTRIBUTE;
        }

        if ($request->query->has(ReportsConstants::SPRKYER_PARAM_ID_MERCHANT)) {
            return ReportsConstants::BLADE_FX_MERCHANT_ATTRIBUTE;
        }

        return '';
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return string
     */
    protected function getParamName(Request $request): string
    {
        if ($request->query->has(SalesConfig::PARAM_ID_SALES_ORDER)) {
            return ReportsConstants::BLADE_FX_ORDER_PARAM_NAME;
        }

        if ($request->query->has(CustomerConstants::PARAM_ID_CUSTOMER)) {
            return ReportsConstants::BLADE_FX_CUSTOMER_PARAM_NAME;
        }
        if ($request->query->has(ReportsConstants::SPRKYER_PARAM_ID_PRODUCT_ABSTRACT)) {
            return ReportsConstants::BLADE_FX_CUSTOMER_PARAM_NAME;
        }

        if ($request->query->has(ReportsConstants::SPRKYER_PARAM_ID_MERCHANT)) {
            return ReportsConstants::BLADE_FX_MERCHANT_PARAM_NAME;
        }

        return '';
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return int
     */
    protected function getParamValue(Request $request): int
    {
        if ($request->query->has(SalesConfig::PARAM_ID_SALES_ORDER)) {
            return (int)$request->query->getInt(SalesConfig::PARAM_ID_SALES_ORDER);
        }
        if ($request->query->has(CustomerConstants::PARAM_ID_CUSTOMER)) {
            return (int)$request->query->getInt(CustomerConstants::PARAM_ID_CUSTOMER);
        }
        if ($request->query->has(ReportsConstants::SPRKYER_PARAM_ID_PRODUCT_ABSTRACT)) {
            (int)$request->query->getInt(ReportsConstants::SPRKYER_PARAM_ID_PRODUCT_ABSTRACT);
        }
        if ($request->query->has(ReportsConstants::SPRKYER_PARAM_ID_MERCHANT)) {
            (int)$request->query->getInt(ReportsConstants::SPRKYER_PARAM_ID_MERCHANT);
        }

        return 1;
    }
}
