<?php


namespace Xiphias\Client\ReportsApi\Response\Validator;

use Generated\Shared\Transfer\BladeFxGetReportParameterListResponseTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class ReportParameterListResponseValidator extends AbstractResponseValidator
{
    /**
     * @return string
     */
    protected function getResponseTransferClass(): string
    {
        return BladeFxGetReportParameterListResponseTransfer::class;
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer $responseTransfer
     *
     * @return bool
     */
    protected function validateResponse(AbstractTransfer $responseTransfer): bool
    {
        try {
            /** @var \Generated\Shared\Transfer\BladeFxGetReportParameterListResponseTransfer $responseTransferCasted */
            $responseTransferCasted = $responseTransfer;

            /** @var \Generated\Shared\Transfer\BladeFxParameterTransfer $report */
            foreach ($responseTransferCasted->getParameterList() as $report) {
                $report
                    ->requireReportId()
                    ->requireParamName()
                    ->requireParamValue();
            }
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
