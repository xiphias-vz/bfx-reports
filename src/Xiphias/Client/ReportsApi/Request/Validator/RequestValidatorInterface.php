<?php


namespace Xiphias\Client\ReportsApi\Request\Validator;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

interface RequestValidatorInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return bool
     */
    public function isRequestValid(AbstractTransfer $requestTransfer): bool;
}
