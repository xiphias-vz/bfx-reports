<?php


namespace Xiphias\Client\ReportsApi\Response\Validator;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

interface ResponseValidatorInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $responseTransfer
     *
     * @return bool
     */
    public function isResponseValid(AbstractTransfer $responseTransfer): bool;
}
