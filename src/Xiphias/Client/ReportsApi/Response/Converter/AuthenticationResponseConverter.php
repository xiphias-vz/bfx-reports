<?php


namespace Xiphias\Client\ReportsApi\Response\Converter;

use Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer;
use Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer;

class AuthenticationResponseConverter extends AbstractResponseConverter
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
        $bladeFxAuthenticationResponseTransfer = new BladeFxAuthenticationResponseTransfer();
        $bladeFxAuthenticationResponseTransfer->fromArray($responseData, true);

        return $apiResponseConversionResultTransfer->setBladeFxAuthenticationResponse($bladeFxAuthenticationResponseTransfer);
    }
}
