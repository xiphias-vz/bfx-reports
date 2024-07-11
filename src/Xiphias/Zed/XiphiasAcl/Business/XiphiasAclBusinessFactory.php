<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\XiphiasAcl\Business;

use Pyz\Zed\Acl\AclConfig;
use Spryker\Zed\Acl\Business\AclBusinessFactory as SprykerAclBusinessFactory;
use Spryker\Zed\Acl\Business\Model\RoleInterface;
use Spryker\Zed\Acl\Business\Writer\RoleWriterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Xiphias\Zed\XiphiasAcl\Business\BfxAclRoleCreator\BfxAclRoleCreator;
use Xiphias\Zed\XiphiasAcl\Business\BfxAclRoleCreator\BfxAclRoleCreatorInterface;
use Xiphias\Zed\XiphiasAcl\Business\BfxAclRoleCreator\BfxMerchantPortalAclRoleCreator;
use Xiphias\Zed\XiphiasAcl\Business\BfxAclRoleCreator\BfxMerchantPortalAclRoleCreatorInterface;
//use Xiphias\Zed\XiphiasAcl\Business\Model\Role;
//use Xiphias\Zed\XiphiasAcl\Business\Writer\BladeFxRoleWriter;
//use Xiphias\Zed\XiphiasAcl\Business\Writer\BladeFxRoleWriterInterface;
//use Xiphias\Zed\XiphiasAcl\Business\Writer\RoleWriter;

/**
 * @method \Xiphias\Zed\XiphiasAcl\XiphiasAclConfig getConfig()
 */
class XiphiasAclBusinessFactory extends AbstractBusinessFactory
{
//    /**
//     * @return \Xiphias\Zed\Acl\Business\Writer\BladeFxRoleWriterInterface
//     */
//    public function createBladeFxRoleWriter(): BladeFxRoleWriterInterface
//    {
//        return new BladeFxRoleWriter(
//            $this->getQueryContainer(),
//        );
//    }
//
//    /**
//     * @return \Spryker\Zed\Acl\Business\Model\RoleInterface
//     */
//    public function createRoleModel(): RoleInterface
//    {
//        return new Role(
//            $this->createGroupModel(),
//            $this->getQueryContainer(),
//            $this->getAclRolesExpanderPlugins(),
//            $this->getAclRolePostSavePlugins(),
//            $this->createBladeFxRoleWriter(),
//        );
//    }
//
//    /**
//     * @return \Spryker\Zed\Acl\Business\Writer\RoleWriterInterface
//     */
//    public function createRoleWriter(): RoleWriterInterface
//    {
//        return new RoleWriter(
//            $this->getEntityManager(),
//            $this->getRepository(),
//            $this->getAclRolePostSavePlugins(),
//            $this->createBladeFxRoleWriter(),
//        );
//    }

    /**
     * @return \Xiphias\Zed\XiphiasAcl\Business\BfxAclRoleCreator\BfxAclRoleCreatorInterface
     */
    public function createBfxAclRoleCreator(): BfxAclRoleCreatorInterface
    {
        return new BfxAclRoleCreator($this->getConfig());
    }

    /**
     * @return \Xiphias\Zed\XiphiasAcl\Business\BfxAclRoleCreator\BfxMerchantPortalAclRoleCreatorInterface
     */
    public function createBfxMerchantPortalAclRoleCreator(): BfxMerchantPortalAclRoleCreatorInterface
    {
        return new BfxMerchantPortalAclRoleCreator($this->getConfig());
    }

    public function getAclConfig()
    {
        return new AclConfig();
    }
}
