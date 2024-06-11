<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Acl\Business;

use Spryker\Zed\Acl\Business\AclBusinessFactory as SprykerAclBusinessFactory;
use Spryker\Zed\Acl\Business\Model\RoleInterface;
use Spryker\Zed\Acl\Business\Writer\RoleWriterInterface;
use Xiphias\Zed\Acl\Business\BfxAclRoleCreator\BfxAclRoleCreator;
use Xiphias\Zed\Acl\Business\BfxAclRoleCreator\BfxAclRoleCreatorInterface;
use Xiphias\Zed\Acl\Business\BfxAclRoleCreator\BfxMerchantPortalAclRoleCreator;
use Xiphias\Zed\Acl\Business\BfxAclRoleCreator\BfxMerchantPortalAclRoleCreatorInterface;
use Xiphias\Zed\Acl\Business\Model\Role;
use Xiphias\Zed\Acl\Business\Writer\BladeFxRoleWriter;
use Xiphias\Zed\Acl\Business\Writer\BladeFxRoleWriterInterface;
use Xiphias\Zed\Acl\Business\Writer\RoleWriter;

/**
 * @method \Spryker\Zed\Acl\Persistence\AclQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Acl\Persistence\AclRepositoryInterface getRepository()
 * @method \Spryker\Zed\Acl\Persistence\AclEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\Acl\AclConfig getConfig()
 */
class AclBusinessFactory extends SprykerAclBusinessFactory
{
    /**
     * @return \Xiphias\Zed\Acl\Business\Writer\BladeFxRoleWriterInterface
     */
    public function createBladeFxRoleWriter(): BladeFxRoleWriterInterface
    {
        return new BladeFxRoleWriter(
            $this->getQueryContainer(),
        );
    }

    /**
     * @return \Spryker\Zed\Acl\Business\Model\RoleInterface
     */
    public function createRoleModel(): RoleInterface
    {
        return new Role(
            $this->createGroupModel(),
            $this->getQueryContainer(),
            $this->getAclRolesExpanderPlugins(),
            $this->getAclRolePostSavePlugins(),
            $this->createBladeFxRoleWriter(),
        );
    }

    /**
     * @return \Spryker\Zed\Acl\Business\Writer\RoleWriterInterface
     */
    public function createRoleWriter(): RoleWriterInterface
    {
        return new RoleWriter(
            $this->getEntityManager(),
            $this->getRepository(),
            $this->getAclRolePostSavePlugins(),
            $this->createBladeFxRoleWriter(),
        );
    }

    /**
     * @return \Xiphias\Zed\Acl\Business\BfxAclRoleCreator\BfxAclRoleCreatorInterface
     */
    public function createBfxAclRoleCreator(): BfxAclRoleCreatorInterface
    {
        return new BfxAclRoleCreator($this->getConfig());
    }

    /**
     * @return \Xiphias\Zed\Acl\Business\BfxAclRoleCreator\BfxMerchantPortalAclRoleCreatorInterface
     */
    public function createBfxMerchantPortalAclRoleCreator(): BfxMerchantPortalAclRoleCreatorInterface
    {
        return new BfxMerchantPortalAclRoleCreator($this->getConfig());
    }
}
