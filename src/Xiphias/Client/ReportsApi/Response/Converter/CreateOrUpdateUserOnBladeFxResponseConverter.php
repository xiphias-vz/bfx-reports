<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Response\Converter;

use Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer;
use Generated\Shared\Transfer\BladeFxCreateOrUpdateUserResponseTransfer;

class CreateOrUpdateUserOnBladeFxResponseConverter extends AbstractResponseConverter
{
    /**
     * @param \Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer $apiResponseConversionResultTransfer
     * @param array $responseData
     *
     * @return \Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer
     */
    protected function expandConversionResponseTransfer(
        BladeFxApiResponseConversionResultTransfer $apiResponseConversionResultTransfer,
        array $responseData,
    ): BladeFxApiResponseConversionResultTransfer {
        $bladeFxCreateOrUpdateUserOnBfx = new BladeFxCreateOrUpdateUserResponseTransfer();

        $bladeFxCreateOrUpdateUserOnBfx->fromArray($responseData);

        return $apiResponseConversionResultTransfer->setBladeFxCreateOrUpdateUserResponse($bladeFxCreateOrUpdateUserOnBfx);
    }
}
