<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace BladeFx\Client\ReportsApi\Request\Validator;

use Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class ReportPreviewRequestValidator extends AbstractRequestValidator implements RequestValidatorInterface
{
    /**
     * @return string
     */
    public function getRequestTransferClass(): string
    {
        return BladeFxGetReportPreviewRequestTransfer::class;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return bool
     */
    public function validateRequest(AbstractTransfer $requestTransfer): bool
    {
        try {
            /**@var \Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer $requestTransfer */
            $requestTransferCasted = $requestTransfer;
            $requestTransferCasted
                ->requireToken()
                ->requireRepId()
                ->requireParams()
                ->requireReturnType();
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
