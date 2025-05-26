<?php


namespace Xiphias\Zed\SprykerBladeFxUser\Persistence;

use Generated\Shared\Transfer\UserTransfer;

interface SprykerBladeFxUserRepositoryInterface
{
 /**
  * @return int
  */
    public function getBladeFxBOGroupId(): int;

    /**
     * @param string $groupName
     *
     * @return int
     */
    public function findWantedGroupId(string $groupName): int;

    /**
     * @param array $groupRoles
     *
     * @return bool
     */
    public function findBladeFxBOGroupById(array $groupRoles): bool;

    /**
     * @param int $userId
     * @param int $groupId
     *
     * @return bool
     */
    public function checkIfUserHasWantedGroup(int $userId, int $groupId): bool;

    /**
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfUserHasBfxBOGroup(int $userId): bool;

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return bool
     */
    public function checkIfUserHasAdminGroup(UserTransfer $userTransfer): bool;
}
