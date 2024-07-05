<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

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
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
