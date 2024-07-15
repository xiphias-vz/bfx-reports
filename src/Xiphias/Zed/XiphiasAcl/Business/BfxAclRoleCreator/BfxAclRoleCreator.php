<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\XiphiasAcl\Business\BfxAclRoleCreator;

use ArrayObject;
use Generated\Shared\Transfer\BfxAclRoleTransfer;
use Generated\Shared\Transfer\GroupTransfer;
use Generated\Shared\Transfer\RoleTransfer;
use Generated\Shared\Transfer\RuleTransfer;
use Xiphias\Zed\XiphiasAcl\XiphiasAclConfig;
use Spryker\Shared\Acl\AclConstants as SprykerAclConstants;
use Xiphias\Shared\Acl\AclConstants;

class BfxAclRoleCreator implements BfxAclRoleCreatorInterface
{
    /**
     * @var \Xiphias\Zed\XiphiasAcl\XiphiasAclConfig $config
     */
    protected XiphiasAclConfig $config;

    /**
     * @param \Xiphias\Zed\XiphiasAcl\XiphiasAclConfig $config
     */
    public function __construct(XiphiasAclConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @return \Generated\Shared\Transfer\BfxAclRoleTransfer
     */
    public function createBfxAclRoleAndGroup(): BfxAclRoleTransfer
    {
        $bfxAclRoleTransfer = new BfxAclRoleTransfer();

        $bfxAclRoleTransfer
            ->setRole($this->createRole())
            ->setGroup($this->createGroup());

        return $bfxAclRoleTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\RoleTransfer
     */
    protected function createRole(): RoleTransfer
    {
        $groupTransfer = (new GroupTransfer())
            ->setName($this->config->getBfxGroupName())
            ->setReference($this->config->getBfxGroupReference());

        return (new RoleTransfer())
            ->setName($this->config->getBfxGroupName())
            //->setReference($this->config->getBfxGroupReference())
            ->setAclRules($this->getAclRoleRules())
            ->setAclGroup($groupTransfer);
    }

    /**
     * @return \Generated\Shared\Transfer\GroupTransfer
     */
    protected function createGroup(): GroupTransfer
    {
        return (new GroupTransfer())
            ->setName($this->config->getBfxGroupName())
            ->setReference($this->config->getBfxGroupReference());
    }

    /**
     * @return \ArrayObject
     */
    protected function getAclRoleRules(): ArrayObject
    {
        $ruleTransfers = new ArrayObject();

        $bundles = [
            AclConstants::BFX_REPORTS_GUI,
        ];

        //$merchantPortalBundles = $this->config->getMerchantPortalGuiBundles();

        $ruleTransfers = $this->addRoleRules($ruleTransfers, $bundles, SprykerAclConstants::ALLOW);
        //$ruleTransfers = $this->addRoleRules($ruleTransfers, $merchantPortalBundles, AclConstants::DENY);

        return $ruleTransfers;
    }

    /**
     * @param \ArrayObject $ruleTransfers
     * @param array $bundles
     * @param string $type
     *
     * @return \ArrayObject
     */
    protected function addRoleRules(ArrayObject $ruleTransfers, array $bundles, string $type): ArrayObject
    {
        foreach ($bundles as $bundle) {
            $ruleTransfer = (new RuleTransfer())
                ->setBundle($bundle)
                ->setController(SprykerAclConstants::VALIDATOR_WILDCARD)
                ->setAction(SprykerAclConstants::VALIDATOR_WILDCARD)
                ->setType($type);
            $ruleTransfers->append($ruleTransfer);
        }

        return $ruleTransfers;
    }
}
