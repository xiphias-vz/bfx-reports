<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Reports\Business\BladeFx\UserHandler;

use Generated\Shared\Transfer\UserTransfer;

interface UserHandlerInterface
{
    /**
     * @param array $userForm
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function createOrUpdateUserOnBladeFx(array $userForm, UserTransfer $userTransfer): void;
}
