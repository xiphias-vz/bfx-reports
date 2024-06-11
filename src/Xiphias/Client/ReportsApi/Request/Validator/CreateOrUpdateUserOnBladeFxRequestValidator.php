<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request\Validator;

use Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class CreateOrUpdateUserOnBladeFxRequestValidator extends AbstractRequestValidator implements RequestValidatorInterface
{
    /**
     * @return string
     */
    protected function getRequestTransferClass(): string
    {
        return BladeFxCreateOrUpdateUserRequestTransfer::class;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return bool
     */
    protected function validateRequest(AbstractTransfer $requestTransfer): bool
    {
        /** @var \Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestTransfer $requestTransferCasted */
        $requestTransferCasted = $requestTransfer;

        try {
            $requestTransferCasted
                ->requireToken();
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
