<?php


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
        BladeFxCreateOrUpdateUserRequestTransfer $requestTransfer
    ): BladeFxCreateOrUpdateUserRequestWithoutTokenTransfer;
}
