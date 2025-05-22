<?php


namespace Xiphias\Client\ReportsApi\Request\Builder;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class ReportParameterListRequestBuilder extends AbstractRequestBuilder
{
    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return parent::METHOD_GET;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return array
     */
    public function getAdditionalHeaders(AbstractTransfer $requestTransfer): array
    {
        /** @var \Generated\Shared\Transfer\BladeFxGetReportParameterListRequestTransfer $reportParameterListRequestTransfer */
        $reportParameterListRequestTransfer = $requestTransfer;

        return $this->addAuthHeader($reportParameterListRequestTransfer->getToken());
    }
}
