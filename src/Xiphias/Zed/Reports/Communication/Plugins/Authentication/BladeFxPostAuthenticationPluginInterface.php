<?php


namespace Xiphias\Zed\Reports\Communication\Plugins\Authentication;

use Xiphias\BladeFxApi\DTO\BladeFxAuthenticationResponseTransfer;

interface BladeFxPostAuthenticationPluginInterface
{
    /**
     * @param \Xiphias\BladeFxApi\DTO\BladeFxAuthenticationResponseTransfer $authenticationResponseTransfer
     *
     * @return void
     */
    public function execute(BladeFxAuthenticationResponseTransfer $authenticationResponseTransfer): void;
}
