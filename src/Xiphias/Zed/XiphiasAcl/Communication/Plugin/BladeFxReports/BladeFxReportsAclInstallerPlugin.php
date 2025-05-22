<?php


namespace Xiphias\Zed\XiphiasAcl\Communication\Plugin\BladeFxReports;

use Spryker\Zed\AclExtension\Dependency\Plugin\AclInstallerPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Xiphias\Shared\Acl\AclConstants;

/**
 * @method \Xiphias\Zed\XiphiasAcl\Business\XiphiasAclFacadeInterface getFacade()
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
//        $roles[] = $this->getFacade()->createBfxMerchantPortalAclRoleAndGroup()->getRole();

        return $roles;
    }

    /**
     * @return array<\Generated\Shared\Transfer\GroupTransfer>
     */
    public function getGroups(): array
    {
        $groups = [];
        $groups[] = $this->getFacade()->createBfxAclRoleAndGroup()->getGroup();
//        $groups[] = $this->getFacade()->createBfxMerchantPortalAclRoleAndGroup()->getGroup();

        return $groups;
    }
}
