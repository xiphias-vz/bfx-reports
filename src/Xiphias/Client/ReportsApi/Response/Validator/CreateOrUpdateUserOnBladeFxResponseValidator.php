<?php


namespace Xiphias\Client\ReportsApi\Response\Validator;

use Generated\Shared\Transfer\BladeFxCreateOrUpdateUserResponseTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class CreateOrUpdateUserOnBladeFxResponseValidator extends AbstractResponseValidator
{
    /**
     * @return string
     */
    protected function getResponseTransferClass(): string
    {
        return BladeFxCreateOrUpdateUserResponseTransfer::class;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Generated\Shared\Transfer\BladeFxCreateOrUpdateUserResponseTransfer $responseTransfer
     *
     * @return bool
     */
    protected function validateResponse(AbstractTransfer|BladeFxCreateOrUpdateUserResponseTransfer $responseTransfer): bool
    {
        try {
            /**
             * @var \Generated\Shared\Transfer\BladeFxCreateOrUpdateUserResponseTransfer $responseTransferCasted
             */
            $responseTransferCasted = $responseTransfer;

            $responseTransferCasted->requireSuccess();
            $responseTransferCasted->requireId();
            $responseTransferCasted->requireLicenceIssue();
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
