<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Reports\Business\BladeFx\Checker;

use Generated\Shared\Transfer\UserTransfer;
use Xiphias\Zed\Reports\Persistence\ReportsRepositoryInterface;

class BladeFxChecker implements BladeFxCheckerInterface
{
    /**
     * @var \Xiphias\Zed\Reports\Persistence\ReportsRepositoryInterface
     */
    protected ReportsRepositoryInterface $reportsRepository;

    /**
     * @param \Xiphias\Zed\Reports\Persistence\ReportsRepositoryInterface $reportsRepository
     */
    public function __construct(
        ReportsRepositoryInterface $reportsRepository,
    ) {
        $this->reportsRepository = $reportsRepository;
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
    public function checkIfBackofficeUserApplicableForCreationOnBfx(array $groupRoles, int $userId): bool
    {
        return !$this->checkIfUserHasMerchant($userId) && $this->findBladeFxBOGroupById($groupRoles) && !$this->checkIfUserHasBfxBOGroup($userId);
    }

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfBackofficeUserApplicableForUpdateOnBfx(array $groupRoles, int $userId): bool
    {
        return !$this->checkIfUserHasMerchant($userId) && $this->findBladeFxBOGroupById($groupRoles) && $this->checkIfUserHasBfxBOGroup($userId);
    }

    /**
     * @param array $groupRoles
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfBackofficeUserApplicableForDeleteOnBfx(array $groupRoles, int $userId): bool
    {
        return !$this->checkIfUserHasMerchant($userId) && !$this->findBladeFxBOGroupById($groupRoles) && $this->checkIfUserHasBfxBOGroup($userId);
    }

    /**
     * @param array $groupRoles
     *
     * @return bool
     */
    public function findBladeFxGroupById(array $groupRoles): bool
    {
        return $this->reportsRepository->findBladeFxGroupById($groupRoles);
    }

    /**
     * @param array $groupRoles
     *
     * @return bool
     */
    public function findBladeFxBOGroupById(array $groupRoles): bool
    {
        return $this->reportsRepository->findBladeFxBOGroupById($groupRoles);
    }

    /**
     * @param int $userId
     *
     * @return bool
     */
    public function checkIfUserHasMerchant(int $userId): bool
    {
        return $this->reportsRepository->checkIfUserHasMerchant($userId);
    }

    /**
     * @param $userInt
     *
     * @return bool
     */
    public function checkIfUserHasBfxMPGroup($userInt): bool
    {
        return $this->reportsRepository->checkIfUserHasBfxMPGroup($userInt);
    }

    /**
     * @param $userInt
     *
     * @return bool
     */
    public function checkIfUserHasBfxBOGroup($userInt): bool
    {
        return $this->reportsRepository->checkIfUserHasBfxBOGroup($userInt);
    }

    /**
     * @param int $userId
     *
     * @return string
     */
    public function getUserMerchantId(int $userId): string
    {
        return $this->reportsRepository->getUserMerchantId($userId);
    }

    /**
     * @param \Generated\Shared\Transfer\UserTransfer|null $userTransfer
     *
     * @return bool
     */
    public function checkIfAdmin(?UserTransfer $userTransfer = null): bool
    {
        if (!$userTransfer) {
            return false;
        }

        return $this->reportsRepository->checkIfUserHasAdminGroup($userTransfer);
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
}
