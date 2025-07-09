<?php


namespace Xiphias\Zed\SprykerBladeFxUser\Business\Handler;

use Generated\Shared\Transfer\UserTransfer;

interface BladeFxUserHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     * @param bool $isActive
     *
     * @return void
     */
    public function createOrUpdateUserOnBladeFx(UserTransfer $userTransfer, bool $isActive = true): void;

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function deleteUserOnBladeFx(UserTransfer $userTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function executeCreateOrUpdateUserOnBladeFx(UserTransfer $userTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function removeBladeFxGroupFromUser(UserTransfer $userTransfer): void;
}
