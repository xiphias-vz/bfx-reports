<?php

declare(strict_types=1);

namespace Xiphias\Zed\SprykerBladeFxUser\Communication\Plugin\User;

use Generated\Shared\Transfer\UserTransfer;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\UserExtension\Dependency\Plugin\UserPostSavePluginInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Xiphias\Shared\Reports\ReportsConstants;

class UserPostSaveEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    public function getSubscribedEvents(EventCollectionInterface $eventCollection): EventCollectionInterface
    {
        return $eventCollection->addListener(
            ReportsConstants::EVENT_USER_POST_SAVE_LICENSE_ISSUE,
            new UserPostSaveLicenseIssueEventListener()
        );
    }
}
