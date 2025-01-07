<?php

namespace Xiphias\Zed\SprykerBladeFxUser\Business\Checker;

use Xiphias\Zed\SprykerBladeFxUser\Persistence\SprykerBladeFxUserRepositoryInterface;

class BladeFXUserChecker implements BladeFXUserCheckerInterface
{
    /**
     * @param SprykerBladeFxUserRepositoryInterface $sprykerBladeFxUserRepository
     */
    public function __construct(
        protected SprykerBladeFxUserRepositoryInterface $sprykerBladeFxUserRepository
    )
    {
    }

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfMerchantPortalUserApplicableForCreationOnBfx(array $groupRoles, int $userId): bool
    {
        return $this->checkIfUserHasMerchant($userId) && $this->findBladeFxGroupById($groupRoles) && !$this->checkIfUserHasBfxMPGroup($userId);
    }

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfMerchantPortalUserApplicableForUpdateOnBfx(array $groupRoles, int $userId): bool
    {
        return $this->checkIfUserHasMerchant($userId) && $this->findBladeFxGroupById($groupRoles) && $this->checkIfUserHasBfxMPGroup($userId);
    }

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfMerchantPortalUserApplicableForDeleteOnBfx(array $groupRoles, int $userId): bool
    {
        return $this->checkIfUserHasMerchant($userId) && !$this->findBladeFxGroupById($groupRoles) && $this->checkIfUserHasBfxMPGroup($userId);
    }

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfMarketplaceBackofficeUserApplicableForCreationOnBfx(array $groupRoles, int $userId): bool
    {
        return !$this->checkIfUserHasMerchant($userId) && $this->findBladeFxBOGroupById($groupRoles) && !$this->checkIfUserHasBfxBOGroup($userId);
    }

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfMarketplaceBackofficeUserApplicableForUpdateOnBfx(array $groupRoles, int $userId): bool
    {
        return !$this->checkIfUserHasMerchant($userId) && $this->findBladeFxBOGroupById($groupRoles) && $this->checkIfUserHasBfxBOGroup($userId);
    }

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfMarketplaceBackofficeUserApplicableForDeleteOnBfx(array $groupRoles, int $userId): bool
    {
        return !$this->checkIfUserHasMerchant($userId) && !$this->findBladeFxBOGroupById($groupRoles) && $this->checkIfUserHasBfxBOGroup($userId);
    }

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForCreationOnBfx(array $groupRoles, int $userId): bool
    {
        return $this->findBladeFxBOGroupById($groupRoles) && !$this->checkIfUserHasBfxBOGroup($userId);
    }

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForUpdateOnBfx(array $groupRoles, int $userId): bool
    {
        return $this->findBladeFxBOGroupById($groupRoles) && $this->checkIfUserHasBfxBOGroup($userId);
    }

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfB2CBackofficeUserApplicableForDeleteOnBfx(array $groupRoles, int $userId): bool
    {
        return !$this->findBladeFxBOGroupById($groupRoles) && $this->checkIfUserHasBfxBOGroup($userId);
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
}
