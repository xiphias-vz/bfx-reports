<?php

declare(strict_types=1);

namespace Xiphias\Zed\SprykerBladeFxUser\Communication\Plugin\User;

use Generated\Shared\Transfer\UserTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\UserExtension\Dependency\Plugin\UserPostSavePluginInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @method \Xiphias\Zed\SprykerBladeFxUser\Business\SprykerBladeFxUserFacadeInterface getFacade();
 */
class UserPostSaveLicenseIssueEventListener extends AbstractPlugin implements EventHandlerInterface
{
    /**
     * @param TransferInterface $transfer
     * @param $eventName
     *
     * @return void
     */
    public function handle(TransferInterface $transfer, $eventName): void
    {
        /** @var UserTransfer $userTransfer */
        $userTransfer = $transfer;
        $this->getFacade()->removeBladeFxGroupFromUser($userTransfer);
    }
}
