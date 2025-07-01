<?php


namespace Xiphias\Client\ReportsApi\Response\Validator;

use Generated\Shared\Transfer\BladeFxUpdatePasswordResponseTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class UpdatePasswordOnBladeFxResponseValidator extends AbstractResponseValidator
{
    /**
     * @return string
     */
    protected function getResponseTransferClass(): string
    {
        return BladeFxUpdatePasswordResponseTransfer::class;
    }


    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Generated\Shared\Transfer\BladeFxCreateOrUpdateUserResponseTransfer $responseTransfer
     *
     * @return bool
     */
    protected function validateResponse(AbstractTransfer|BladeFxUpdatePasswordResponseTransfer $responseTransfer): bool
    {
        try {
            /**
             * @var \Generated\Shared\Transfer\BladeFxUpdatePasswordResponseTransfer $responseTransferCasted
             */
            $responseTransferCasted = $responseTransfer;

            $responseTransferCasted->requireSuccess();
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
