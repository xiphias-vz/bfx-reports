<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\SprykerBladeFxUser\Business;

use Generated\Shared\Transfer\UserTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Xiphias\Zed\SprykerBladeFxUser\Business\SprykerBladeFxUserBusinessFactory getFactory()
 */
class SprykerBladeFxUserFacade extends AbstractFacade implements SprykerBladeFxUserFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     * @param bool $isActive
     * @param bool $isItFromBO
     *
     * @return void
     */
    public function createOrUpdateUserOnBfx(UserTransfer $userTransfer, bool $isActive = true, bool $isItFromBO = true): void
    {
        $this->getFactory()->createBladeFxUserHandler()->createOrUpdateUserOnBfx($userTransfer, $isActive, $isItFromBO);
    }

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForCreationOnBfx(array $groupRoles, int $userId): bool
    {
        return $this->getFactory()->createBladeFXUserChecker()->checkIfB2CBackofficeUserApplicableForCreationOnBfx($groupRoles, $userId);
    }

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForUpdateOnBfx(array $groupRoles, int $userId): bool
    {
        return $this->getFactory()->createBladeFXUserChecker()->checkIfB2CBackofficeUserApplicableForUpdateOnBfx($groupRoles, $userId);
    }

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForDeleteOnBfx(array $groupRoles, int $userId): bool
    {
        return $this->getFactory()->createBladeFXUserChecker()->checkIfB2CBackofficeUserApplicableForDeleteOnBfx($groupRoles, $userId);
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function deleteUserOnBladeFx(UserTransfer $userTransfer): void
    {
        $this->getFactory()->createBladeFxUserHandler()->deleteUserOnBladeFx($userTransfer);
    }

    /**
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfUserHasBfxBOGroup(int $userId): bool
    {
        return $this->getFactory()->createBladeFXUserChecker()->checkIfUserHasBfxBOGroup($userId);
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer|null $userTransfer
     *
     * @return bool
     */
    public function checkIfUserIsAdmin(?UserTransfer $userTransfer = null): bool
    {
        return $this->getFactory()->createBladeFXUserChecker()->checkIfUserIsAdmin($userTransfer);
    }

    /**
     * @param $userInt
     *
     * @return bool
     */
    public function checkIfUserHasBfxMPGroup($userInt): bool
    {
        return $this->getFactory()->createBladeFXUserChecker()->checkIfUserHasBfxMPGroup($userInt);
    }

    /**
     * @param array $groupRoles
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function executeCreateOrUpdateUserOnBladeFx(array $groupRoles, UserTransfer $userTransfer): void
    {
        $this->getFactory()->createBladeFxUserHandler()->executeCreateOrUpdateUserOnBladeFx($groupRoles, $userTransfer);
    }
}
