<?php

declare(strict_types=1);

namespace Xiphias\Zed\SprykerBladeFxUser\Communication\Plugin\User;

use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Xiphias\Shared\Reports\ReportsConstants;

class UserPostSaveEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection): EventCollectionInterface
    {
        return $eventCollection->addListenerQueued(
            ReportsConstants::EVENT_USER_POST_SAVE_LICENSE_ISSUE,
            new UserPostSaveLicenseIssueEventListener(),
            0,
            null,
            ReportsConstants::EVENT_QUEUE_NAME,
        );
    }
}
