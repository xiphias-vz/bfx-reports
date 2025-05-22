<?php


namespace Xiphias\Client\ReportsApi\Response\Validator;

use Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class ReportParamFormResponseValidator extends AbstractResponseValidator
{
    /**
     * @return string
     */
    public function getResponseTransferClass(): string
    {
        return BladeFxGetReportParamFormResponseTransfer::class;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $responseTransfer
     *
     * @return bool
     */
    public function validateResponse(AbstractTransfer $responseTransfer): bool
    {
        /** @var \Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer $reportParamFormResponseTransfer */
        $reportParamFormResponseTransfer = $responseTransfer;

        try {
            $reportParamFormResponseTransfer->requireIframeUrl();
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
