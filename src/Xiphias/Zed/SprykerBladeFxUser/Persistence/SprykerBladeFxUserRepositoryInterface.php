<?php


namespace Xiphias\Zed\SprykerBladeFxUser\Persistence;

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
}
