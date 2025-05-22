<?php

namespace Xiphias\Zed\SprykerBladeFxUser\Business\Checker;

use Generated\Shared\Transfer\UserTransfer;
use Xiphias\Zed\SprykerBladeFxUser\Persistence\SprykerBladeFxUserRepositoryInterface;

class BladeFXUserChecker implements BladeFXUserCheckerInterface
{
    /**
     * @param \Xiphias\Zed\SprykerBladeFxUser\Persistence\SprykerBladeFxUserRepositoryInterface $sprykerBladeFxUserRepository
     */
    public function __construct(
        protected SprykerBladeFxUserRepositoryInterface $sprykerBladeFxUserRepository
    ) {
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForCreationOnBfx(UserTransfer $userTransfer): bool
    {
        return $this->findBladeFxBOGroupById($userTransfer->getGroup()) && !$this->checkIfUserHasBfxBOGroup($userTransfer->getIdUser());
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForUpdateOnBfx(UserTransfer $userTransfer): bool
    {
        return $this->findBladeFxBOGroupById($userTransfer->getGroup()) && $this->checkIfUserHasBfxBOGroup($userTransfer->getIdUser());
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForDeleteOnBfx(UserTransfer $userTransfer): bool
    {
        return !$this->findBladeFxBOGroupById($userTransfer->getGroup()) && $this->checkIfUserHasBfxBOGroup($userTransfer->getIdUser());
    }

    /**
     * @param array $groupRoles
     *
     * @return bool
     */
    public function findBladeFxBOGroupById(array $groupRoles): bool
    {
        return $this->sprykerBladeFxUserRepository->findBladeFxBOGroupById($groupRoles);
    }

    /**
     * @param array $groupRoles
     *
     * @return bool
     */
    public function findBladeFxGroupById(array $groupRoles): bool
    {
        return $this->sprykerBladeFxUserRepository->findBladeFxMPGroupById($groupRoles);
    }

    /**
     * @param $userInt
     *
     * @return bool
     */
    public function checkIfUserHasBfxBOGroup($userInt): bool
    {
        return $this->sprykerBladeFxUserRepository->checkIfUserHasBfxBOGroup($userInt);
    }

    /**
     * @param $userInt
     *
     * @return bool
     */
    public function checkIfUserHasBfxMPGroup($userInt): bool
    {
        return $this->sprykerBladeFxUserRepository->checkIfUserHasBfxMPGroup($userInt);
    }

    /**
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfUserHasMerchant(int $userId): bool
    {
        return $this->sprykerBladeFxUserRepository->checkIfUserHasMerchant($userId);
    }

    /**
     * @param string|null $password
     *
     * @return bool
     */
    public function checkIfPasswordExists(?string $password): bool
    {
        return (bool)$password;
    }

    /**
     * @param int $userId
     *
     * @return string
     */
    public function getUserMerchantId(int $userId): string
    {
        return $this->sprykerBladeFxUserRepository->getUserMerchantId($userId);
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer|null $userTransfer
     *
     * @return bool
     */
    public function checkIfUserIsAdmin(?UserTransfer $userTransfer = null): bool
    {
        if (!$userTransfer) {
            return false;
        }

        return $this->sprykerBladeFxUserRepository->checkIfUserHasAdminGroup($userTransfer);
    }
}
