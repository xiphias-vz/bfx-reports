<?php


namespace Xiphias\Zed\Reports\Business\BladeFx\Checker;

use Generated\Shared\Transfer\UserTransfer;

interface BladeFxCheckerInterface
{
    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfBackofficeUserApplicableForCreationOnBfx(array $groupRoles, int $userId): bool;

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfBackofficeUserApplicableForUpdateOnBfx(array $groupRoles, int $userId): bool;

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfBackofficeUserApplicableForDeleteOnBfx(array $groupRoles, int $userId): bool;

    /**
     * @param $userInt
     *
     * @return bool
     */
    public function checkIfUserHasBfxMPGroup($userInt): bool;

    /**
     * @param $userInt
     *
     * @return bool
     */
    public function checkIfUserHasBfxBOGroup($userInt): bool;

    /**
     * @param array $groupRoles
     *
     * @return bool
     */
    public function findBladeFxGroupById(array $groupRoles): bool;

    /**
     * @param array $groupRoles
     *
     * @return bool
     */
    public function findBladeFxBOGroupById(array $groupRoles): bool;

    /**
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfUserHasMerchant(int $userId): bool;

    /**
     * @param int $userId
     *
     * @return string
     */
    public function getUserMerchantId(int $userId): string;

    /**
     * @param \Generated\Shared\Transfer\UserTransfer|null $userTransfer
     *
     * @return bool
     */
    public function checkIfAdmin(?UserTransfer $userTransfer = null): bool;

    /**
     * @param string|null $password
     *
     * @return bool
     */
    public function checkIfPasswordExists(?string $password): bool;
}
