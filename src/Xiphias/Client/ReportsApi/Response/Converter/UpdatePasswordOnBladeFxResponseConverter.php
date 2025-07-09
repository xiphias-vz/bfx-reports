<?php


namespace Xiphias\Client\ReportsApi\Response\Converter;

use Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer;
use Generated\Shared\Transfer\BladeFxUpdatePasswordResponseTransfer;

class UpdatePasswordOnBladeFxResponseConverter extends AbstractResponseConverter
{
    /**
     * @param \Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer $apiResponseConversionResultTransfer
     * @param array $responseData
     *
     * @return \Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer
     */
    protected function expandConversionResponseTransfer(
        BladeFxApiResponseConversionResultTransfer $apiResponseConversionResultTransfer,
        array $responseData
    ): BladeFxApiResponseConversionResultTransfer {
        $bladeFxUpdatePassword = new BladeFxUpdatePasswordResponseTransfer();
        $bladeFxUpdatePassword->fromArray($responseData);

        return $apiResponseConversionResultTransfer->setBladeFxUpdatePasswordResponse($bladeFxUpdatePassword);
    }
}
