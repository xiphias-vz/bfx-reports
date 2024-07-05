<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Acl;

use Pyz\Zed\Acl\AclDependencyProvider as SprykerAclDependencyProvider;
use Xiphias\Zed\Acl\Communication\Plugin\BladeFxReports\BladeFxReportsAclInstallerPlugin;

class AclDependencyProvider extends SprykerAclDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\AclExtension\Dependency\Plugin\AclInstallerPluginInterface>
     */
    protected function getAclInstallerPlugins(): array
    {
        $aclInstallerPlugins = parent::getAclInstallerPlugins();
        $aclInstallerPlugins[] = new BladeFxReportsAclInstallerPlugin();

        return $aclInstallerPlugins;
    }
}
