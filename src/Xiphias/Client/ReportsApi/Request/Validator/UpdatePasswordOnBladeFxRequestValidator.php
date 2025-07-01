<?php


namespace Xiphias\Client\ReportsApi\Request\Validator;

use Generated\Shared\Transfer\BladeFxUpdatePasswordRequestTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class UpdatePasswordOnBladeFxRequestValidator extends AbstractRequestValidator
{
    /**
     * @return string
     */
    protected function getRequestTransferClass(): string
    {
        return BladeFxUpdatePasswordRequestTransfer::class;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Generated\Shared\Transfer\BladeFxUpdatePasswordRequestTransfer $requestTransfer
     *
     * @return bool
     */
    protected function validateRequest(AbstractTransfer|BladeFxUpdatePasswordRequestTransfer $requestTransfer): bool
    {
        try {
            /**
             * @var \Generated\Shared\Transfer\BladeFxUpdatePasswordRequestTransfer $requestTransferCasted
             */
            $requestTransferCasted = $requestTransfer;

            $requestTransferCasted
                ->requireToken()
                ->requirePassword()
                ->requireBladeFxUserId();
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
