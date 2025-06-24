<?php

declare(strict_types=1);

namespace Xiphias\Zed\XiphiasAcl\Business\BfxAclRoleCreator;

use ArrayObject;
use Generated\Shared\Transfer\BfxAclRoleTransfer;
use Generated\Shared\Transfer\GroupTransfer;
use Generated\Shared\Transfer\RoleTransfer;
use Generated\Shared\Transfer\RuleTransfer;
use Spryker\Shared\Acl\AclConstants as SprykerAclConstants;
use Xiphias\Shared\Acl\AclConstants;
use Xiphias\Zed\XiphiasAcl\XiphiasAclConfig;

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
            ->setRoles($this->createRoles())
            ->setGroup($this->createGroup());

        return $bfxAclRoleTransfer;
    }

    /**
     * @return \ArrayObject<\Generated\Shared\Transfer\RoleTransfer>
     */
    protected function createRoles(): ArrayObject
    {
        $roles = [];
        $rules = $this->getAclRoleRules();
        $groupTransfer = (new GroupTransfer())
            ->setName($this->config->getBfxGroupName());

        foreach ($rules as $ruleTransfer) {
            $groupName = $this->config->getBfxGroupName();
            $roleName = $ruleTransfer->getBundle() === AclConstants::BFX_REPORTS_GUI
                ? $groupName : $groupName . ' MP';

            $roles[] = (new RoleTransfer())
                ->setName($roleName)
                ->setAclRules(new ArrayObject([$ruleTransfer]))
                ->setAclGroup($groupTransfer);
        }

        return new ArrayObject($roles);
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
            AclConstants::BFX_REPORTS_MERCHANT_PORTAL_GUI,
        ];

        $ruleTransfers = $this->addRoleRules($ruleTransfers, $bundles, SprykerAclConstants::ALLOW);

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
