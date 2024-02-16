<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace BladeFx\Client\ReportsApi\Request\Builder;

use Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer;
use Psr\Http\Message\RequestInterface;

interface RequestBuilderInterface
{
    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function buildRequest(
        string $resource,
        BladeFxGetReportsListRequestTransfer $requestTransfer,
    ): RequestInterface;
}
