<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Reports\Persistence;

use Generated\Shared\Transfer\UserTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Xiphias\Zed\Reports\Persistence\ReportsPersistenceFactory getFactory()
 */
class ReportsRepository extends AbstractRepository implements ReportsRepositoryInterface
{
    /**
     * @param array $groupRoles
     *
     * @return bool
     */
    public function findBladeFxGroupById(array $groupRoles): bool
    {
        $bfxGroupId = $this->getBladeFxMPGroupId();

        if (in_array($bfxGroupId, $groupRoles)) {
            return true;
        }

        return false;
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
     *
     * @return bool
     */
    public function checkIfUserHasMerchant(int $userId): bool
    {
        $merchantUserQuery = $this->getFactory()->createMerchantUserQuery();
        $ifUserHasMerchant = $merchantUserQuery->findByFkUser($userId)->getIterator()->current() ?? false;

        if ($ifUserHasMerchant) {
            return true;
        }

        return false;
    }

    /**
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfUserHasBfxMPGroup(int $userId): bool
    {
        $bfxGroupId = $this->getBladeFxMPGroupId();

        return $this->checkIfUserHasWantedGroup($userId, $bfxGroupId);
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
     * @param int $userId
     *
     * @return string
     */
    public function getUserMerchantId(int $userId): string
    {
        $merchantUserQuery = $this->getFactory()->createMerchantUserQuery();
        $userMerchantId = $merchantUserQuery->findByFkUser($userId)->getIterator()->current();

        return $userMerchantId->getFkMerchant();
    }

    /**
     * @return int
     */
    protected function getBladeFxMPGroupId(): int
    {
        return $this->findWantedGroupId($this->getFactory()->getConfig()->getBladeFxMerchantPortalGroupName());
    }

    /**
     * @return int
     */
    protected function getBladeFxBOGroupId(): int
    {
        return $this->findWantedGroupId($this->getFactory()->getConfig()->getBladeFxBOGroupName());
    }

    /**
     * @return int
     */
    protected function getRootGroupId(): int
    {
        return $this->findWantedGroupId($this->getFactory()->getConfig()->getRootGroupName());
    }

    /**
     * @param string $groupName
     *
     * @return int
     */
    protected function findWantedGroupId(string $groupName): int
    {
        $aclGroupQuery = $this->getFactory()->createAclGroupQuery();
        $reportsEntityId = $aclGroupQuery->findByName($groupName)->getIterator()->current() ?? false;

        if ($reportsEntityId) {
            return $reportsEntityId->getIdAclGroup();
        }

        return $reportsEntityId;
    }

    /**
     * @param int $userId
     * @param int $groupId
     *
     * @return bool
     */
    protected function checkIfUserHasWantedGroup(int $userId, int $groupId): bool
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
}
