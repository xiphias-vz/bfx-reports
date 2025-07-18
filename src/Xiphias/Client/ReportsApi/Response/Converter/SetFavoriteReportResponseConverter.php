<?php


namespace Xiphias\Client\ReportsApi\Response\Converter;

use Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer;
use Generated\Shared\Transfer\BladeFxSetFavoriteReportResponseTransfer;

class SetFavoriteReportResponseConverter extends AbstractResponseConverter
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
        $bladeFxSetFavoriteReport = new BladeFxSetFavoriteReportResponseTransfer();

        $bladeFxSetFavoriteReport->fromArray($responseData);

        return $apiResponseConversionResultTransfer->setBladeFxSetFavoriteReportResponse($bladeFxSetFavoriteReport);
    }
}
