<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Acl\Communication\Plugin\BladeFxReports;

use Spryker\Zed\AclExtension\Dependency\Plugin\AclInstallerPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Xiphias\Shared\Acl\AclConstants;

/**
 * @method \Pyz\Zed\Acl\AclConfig getConfig()
 * @method \Spryker\Zed\Acl\Communication\AclCommunicationFactory getFactory()
 * @method \Spryker\Zed\Acl\Business\AclFacadeInterface getFacade()
 * @method \Spryker\Zed\Acl\Persistence\AclQueryContainerInterface getQueryContainer()
 */
class BladeFxReportsAclInstallerPlugin extends AbstractPlugin implements AclInstallerPluginInterface, AclConstants
{
    /**
     * @return array<\Generated\Shared\Transfer\RoleTransfer>
     */
    public function getRoles(): array
    {
        $roles = [];
        $roles[] = $this->getFacade()->createBfxAclRoleAndGroup()->getRole();
        $roles[] = $this->getFacade()->createBfxMerchantPortalAclRoleAndGroup()->getRole();

        return $roles;
    }

    /**
     * @return array<\Generated\Shared\Transfer\GroupTransfer>
     */
    public function getGroups(): array
    {
        $groups = [];
        $groups[] = $this->getFacade()->createBfxAclRoleAndGroup()->getGroup();
        $groups[] = $this->getFacade()->createBfxMerchantPortalAclRoleAndGroup()->getGroup();

        return $groups;
    }
}
