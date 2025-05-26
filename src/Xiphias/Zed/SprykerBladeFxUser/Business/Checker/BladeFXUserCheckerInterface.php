<?php

namespace Xiphias\Zed\SprykerBladeFxUser\Business\Checker;

use Generated\Shared\Transfer\UserTransfer;

interface BladeFXUserCheckerInterface
{
    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForCreationOnBfx(UserTransfer $userTransfer): bool;

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForUpdateOnBfx(UserTransfer $userTransfer): bool;

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForDeleteOnBfx(UserTransfer $userTransfer): bool;

    /**
     * @param array $groupRoles
     *
     * @return bool
     */
    public function findBladeFxBOGroupById(array $groupRoles): bool;

    /**
     * @param $userInt
     *
     * @return bool
     */
    public function checkIfUserHasBfxBOGroup($userInt): bool;

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
}
