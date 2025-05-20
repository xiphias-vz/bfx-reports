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
    public function createOrUpdateUserOnBfx(UserTransfer $userTransfer, bool $isActive = true, bool $isMerchantUser = false): void
    {
        $this->getFactory()->createBladeFxUserHandler()->createOrUpdateUserOnBladeFx($userTransfer, $isActive, $isMerchantUser);
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return bool
     */
    public function isUserApplicableForCreateOnBfx(UserTransfer $userTransfer): bool
    {
        return $this->getFactory()->createBladeFXUserChecker()->checkIfB2CBackofficeUserApplicableForCreationOnBfx($userTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return bool
     */
    public function isUserApplicableForUpdateOnBfx(UserTransfer $userTransfer): bool
    {
        return $this->getFactory()->createBladeFXUserChecker()->checkIfB2CBackofficeUserApplicableForUpdateOnBfx($userTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return bool
     */
    public function isUserApplicableForDeleteOnBfx(UserTransfer $userTransfer): bool
    {
        return $this->getFactory()->createBladeFXUserChecker()->checkIfB2CBackofficeUserApplicableForDeleteOnBfx($userTransfer);
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
    public function hasUserBfxGroup(int $userId): bool
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
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function executeCreateOrUpdateUserOnBladeFx(UserTransfer $userTransfer): void
    {
        $this->getFactory()->createBladeFxUserHandler()->executeCreateOrUpdateUserOnBladeFx($userTransfer);
    }
}
