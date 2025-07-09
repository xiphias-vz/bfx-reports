<?php

declare(strict_types=1);

namespace Xiphias\Zed\SprykerBladeFxUser\Communication\Plugin\User;

use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Xiphias\Zed\SprykerBladeFxUser\Business\SprykerBladeFxUserFacadeInterface getFacade();
 */
class UserPostSaveLicenseIssueEventListener extends AbstractPlugin implements EventHandlerInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $transfer
     * @param $eventName
     *
     * @return void
     */
    public function handle(TransferInterface $transfer, $eventName): void
    {
        /** @var \Generated\Shared\Transfer\UserTransfer $userTransfer */
        $userTransfer = $transfer;
        $this->getFacade()->removeBladeFxGroupFromUser($userTransfer);
    }
}
