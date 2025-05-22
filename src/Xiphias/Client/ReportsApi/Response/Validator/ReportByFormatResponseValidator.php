<?php


declare(strict_types=1);

namespace Xiphias\Client\ReportsApi\Response\Validator;

use Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class ReportByFormatResponseValidator extends AbstractResponseValidator
{
    /**
     * @return string
     */
    protected function getResponseTransferClass(): string
    {
        return BladeFxGetReportByFormatResponseTransfer::class;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $responseTransfer
     *
     * @return bool
     */
    protected function validateResponse(AbstractTransfer $responseTransfer): bool
    {
        /** @var \Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer $responseTransferCasted */
        $responseTransferCasted = $responseTransfer;
        try {
            $responseTransferCasted->requireReport();
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
