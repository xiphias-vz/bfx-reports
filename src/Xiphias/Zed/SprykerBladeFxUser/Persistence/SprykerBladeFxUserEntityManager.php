<?php

declare(strict_types=1);

namespace Xiphias\Zed\SprykerBladeFxUser\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Xiphias\Zed\SprykerBladeFxUser\Persistence\SprykerBladeFxUserPersistenceFactory getFactory();
 * @method \Xiphias\Zed\SprykerBladeFxUser\SprykerBladeFxUserConfig getConfig();
 */
class SprykerBladeFxUserEntityManager extends AbstractEntityManager implements SprykerBladeFxUserEntityManagerInterface
{
    /**
     * @param int $userId
     * @param int $groupId
     *
     * @return void
     */
    public function deleteUserHasGroupsByUserIdAndGroupId(int $userId, int $groupId): void
    {
        if ($userId && $groupId) {
            $this->getFactory()
                ->createAclUserHasGroups()
                ->filterByFkUser($userId)
                ->filterByFkAclGroup($groupId)
                ->delete();
        }
    }
}
