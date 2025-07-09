<?php


namespace Xiphias\Zed\SprykerBladeFxUser\Persistence;

use Generated\Shared\Transfer\UserTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Xiphias\Zed\SprykerBladeFxUser\Persistence\SprykerBladeFxUserPersistenceFactory getFactory();
 */
class SprykerBladeFxUserRepository extends AbstractRepository implements SprykerBladeFxUserRepositoryInterface
{
    /**
     * @return int
     */
    public function getBladeFxBOGroupId(): int
    {
        return $this->findWantedGroupId($this->getFactory()->getReportsSharedConfig()->getBladeFxBOGroupName());
    }

    /**
     * @param string $groupName
     *
     * @return int
     */
    public function findWantedGroupId(string $groupName): int
    {
        $aclGroupQuery = $this->getFactory()->createAclGroupQuery();
        $reportsEntityId = $aclGroupQuery->findByName($groupName)->getIterator()->current() ?? false;

        if ($reportsEntityId) {
            return $reportsEntityId->getIdAclGroup();
        }

        return $reportsEntityId;
    }

    /**
     * @param array $groupRoles
     *
     * @return bool
     */
    public function findBladeFxBOGroupById(array $groupRoles): bool
    {
        $bfxGroupBOId = $this->getBladeFxBOGroupId();

        if (in_array($bfxGroupBOId, $groupRoles)) {
            return true;
        }

        return false;
    }

    /**
     * @param int $userId
     * @param int $groupId
     *
     * @return bool
     */
    public function checkIfUserHasWantedGroup(int $userId, int $groupId): bool
    {
        $aclUserHasGroups = $this->getFactory()->createAclUserHasGroups();

        $UserGroupCollection = $aclUserHasGroups->findByFkUser($userId)->getIterator()->getCollection()->getData();

        foreach ($UserGroupCollection as $userGroupId) {
            if ($userGroupId->getFkAclGroup() == $groupId) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfUserHasBfxBOGroup(int $userId): bool
    {
        $bfxGroupBOId = $this->getBladeFxBOGroupId();

        return $this->checkIfUserHasWantedGroup($userId, $bfxGroupBOId);
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return bool
     */
    public function checkIfUserHasAdminGroup(UserTransfer $userTransfer): bool
    {
        $adminGroupId = $this->getRootGroupId();
        $userId = $userTransfer->getIdUser();

        if ($userId !== $this->getFactory()->getConfig()->getRootAdminId()) {
            return false;
        }

        return $this->checkIfUserHasWantedGroup($userId, $adminGroupId);
    }

    /**
     * @return int
     */
    protected function getRootGroupId(): int
    {
        return $this->findWantedGroupId($this->getFactory()->getConfig()->getRootGroupName());
    }
}
