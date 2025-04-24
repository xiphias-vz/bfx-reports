<?php

namespace Xiphias\Zed\SprykerBladeFxUser\Business\Checker;

use Generated\Shared\Transfer\UserTransfer;


interface BladeFXUserCheckerInterface
{
    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfMerchantPortalUserApplicableForCreationOnBfx(array $groupRoles, int $userId): bool;

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfMerchantPortalUserApplicableForUpdateOnBfx(array $groupRoles, int $userId): bool;

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfMerchantPortalUserApplicableForDeleteOnBfx(array $groupRoles, int $userId): bool;

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfMarketplaceBackofficeUserApplicableForCreationOnBfx(array $groupRoles, int $userId): bool;

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfMarketplaceBackofficeUserApplicableForUpdateOnBfx(array $groupRoles, int $userId): bool;

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfMarketplaceBackofficeUserApplicableForDeleteOnBfx(array $groupRoles, int $userId): bool;

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForCreationOnBfx(array $groupRoles, int $userId): bool;

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForUpdateOnBfx(array $groupRoles, int $userId): bool;

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForDeleteOnBfx(array $groupRoles, int $userId): bool;

    /**
     * @param array $groupRoles
     *
     * @return bool
     */
    public function findBladeFxBOGroupById(array $groupRoles): bool;

    /**
     * @param array $groupRoles
     *
     * @return bool
     */
    public function findBladeFxGroupById(array $groupRoles): bool;

    /**
     * @param $userInt
     *
     * @return bool
     */
    public function checkIfUserHasBfxBOGroup($userInt): bool;

    /**
     * @param $userInt
     *
     * @return bool
     */
    public function checkIfUserHasBfxMPGroup($userInt): bool;

    /**
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfUserHasMerchant(int $userId): bool;

    /**
     * @param string|null $password
     *
     * @return bool
     */
    public function checkIfPasswordExists(?string $password): bool;

    /**
     * @param \Generated\Shared\Transfer\UserTransfer|null $userTransfer
     *
     * @return bool
     */
    public function checkIfUserIsAdmin(?UserTransfer $userTransfer = null): bool;

    /**
     * @param int $userId
     *
     * @return string
     */
    public function getUserMerchantId(int $userId): string;
}
