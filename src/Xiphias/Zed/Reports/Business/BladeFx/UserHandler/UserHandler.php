<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\UserHandler;

use Generated\Shared\Transfer\UserTransfer;
use Spryker\Client\Session\SessionClientInterface;
use Xiphias\Client\ReportsApi\ReportsApiClientInterface;
use Xiphias\Zed\Reports\Business\BladeFx\Checker\BladeFxCheckerInterface;
use Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class UserHandler implements UserHandlerInterface
{
    /**
     * @var string
     */
    protected const ID_USER = 'id_user';

    /**
     * @var string
     */
    protected const USERNAME = 'username';

    /**
     * @var string
     */
    protected const FIRST_NAME = 'first_name';

    /**
     * @var string
     */
    protected const LAST_NAME = 'last_name';

    /**
     * @var string
     */
    protected const PASSWORD = 'password';

    /**
     * @var string
     */
    protected const SRYKER_BO_ROLE = 'SprykerBORole';

    /**
     * @var string
     */
    protected const SPRYKER_MP_ROLE = 'SprykerMPRole';

    /**
     * @var string
     */
    protected const GROUP = 'group';

    /**
     * @var \Xiphias\Client\ReportsApi\ReportsApiClientInterface
     */
    protected ReportsApiClientInterface $apiClient;

    /**
     * @var \Spryker\Client\Session\SessionClientInterface
     */
    protected SessionClientInterface $sessionClient;

    /**
     * @var \Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface
     */
    protected TokenResolverInterface $tokenResolver;

    /**
     * @var \Xiphias\Zed\Reports\Business\BladeFx\Checker\BladeFxCheckerInterface
     */
    protected BladeFxCheckerInterface $bladeFxChecker;

    /**
     * @var \Xiphias\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $config;

    /**
     * @param \Xiphias\Client\ReportsApi\ReportsApiClientInterface $apiClient
     * @param \Spryker\Client\Session\SessionClientInterface $sessionClient
     * @param \Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface $tokenResolver
     * @param \Xiphias\Zed\Reports\Business\BladeFx\Checker\BladeFxCheckerInterface $bladeFxChecker
     * @param \Xiphias\Zed\Reports\ReportsConfig $config
     */
    public function __construct(
        ReportsApiClientInterface $apiClient,
        SessionClientInterface $sessionClient,
        TokenResolverInterface $tokenResolver,
        BladeFxCheckerInterface $bladeFxChecker,
        ReportsConfig $config,
    ) {
        $this->apiClient = $apiClient;
        $this->sessionClient = $sessionClient;
        $this->tokenResolver = $tokenResolver;
        $this->bladeFxChecker = $bladeFxChecker;
        $this->config = $config;
    }

    /**
     * @param array $groupRoles
     * @param \Generated\Shared\Transfer\UserTransfer $userTransfer
     *
     * @return void
     */
    public function createOrUpdateUserOnBladeFx(array $groupRoles, UserTransfer $userTransfer): void
    {
        $userId = $userTransfer->getIdUser();

        if (!$this->bladeFxChecker->checkIfPasswordExists($userTransfer->getPassword())) {
            return;
        }

        //TODO: Implement plugin logic here!!!!!!!!

//        //Changes for market place and merchant portal
//        if ($this->bladeFxChecker->checkIfMerchantPortalUserApplicableForCreationOnBfx($groupRoles, $userId)) {
//            $this->createUserOrUpdateOnBfx($userTransfer, true, false);
//        } elseif ($this->bladeFxChecker->checkIfMerchantPortalUserApplicableForUpdateOnBfx($groupRoles, $userId)) {
//            $this->createUserOrUpdateOnBfx($userTransfer, true, false);
//        } elseif ($this->bladeFxChecker->checkIfMerchantPortalUserApplicableForDeleteOnBfx($groupRoles, $userId)) {
//            $this->createUserOrUpdateOnBfx($userTransfer, false, false);
//        } elseif ($this->bladeFxChecker->checkIfBackofficeUserApplicableForCreationOnBfx($groupRoles, $userId)) {
//            $this->createUserOrUpdateOnBfx($userTransfer);
//        } elseif ($this->bladeFxChecker->checkIfBackofficeUserApplicableForUpdateOnBfx($groupRoles, $userId)) {
//            $this->createUserOrUpdateOnBfx($userTransfer);
//        } elseif ($this->bladeFxChecker->checkIfBackofficeUserApplicableForDeleteOnBfx($groupRoles, $userId)) {
//            $this->createUserOrUpdateOnBfx($userTransfer, false);
//        }
    }
}
