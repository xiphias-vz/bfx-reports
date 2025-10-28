<?php


namespace Xiphias\Client\ReportsApi\Request\Validator;

use Xiphias\BladeFxApi\DTO\BladeFxUpdatePasswordRequestTransfer;
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
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Xiphias\BladeFxApi\DTO\BladeFxUpdatePasswordRequestTransfer $requestTransfer
     *
     * @return bool
     */
    protected function validateRequest(AbstractTransfer|BladeFxUpdatePasswordRequestTransfer $requestTransfer): bool
    {
        try {
            /**
             * @var \Xiphias\BladeFxApi\DTO\BladeFxUpdatePasswordRequestTransfer $requestTransferCasted
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
