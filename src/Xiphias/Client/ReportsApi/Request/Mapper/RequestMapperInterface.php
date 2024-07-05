<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request\Mapper;

use Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestTransfer;
use Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestWithoutTokenTransfer;

interface RequestMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestWithoutTokenTransfer
     */
    public function mapCreateOrUpdateUserRequestTransferWithoutToken(
        BladeFxCreateOrUpdateUserRequestTransfer $requestTransfer,
    ): BladeFxCreateOrUpdateUserRequestWithoutTokenTransfer;
}
