<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\SprykerBladeFxUser\Persistence;

use Orm\Zed\Acl\Persistence\SpyAclGroupQuery;
use Orm\Zed\Acl\Persistence\SpyAclUserHasGroupQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use Xiphias\Shared\Reports\ReportsConfig;

class SprykerBladeFxUserPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Acl\Persistence\SpyAclGroupQuery
     */
    public function createAclGroupQuery(): SpyAclGroupQuery
    {
        return new SpyAclGroupQuery();
    }

    /**
     * @return \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery
     */
    public function createMerchantUserQuery(): SpyMerchantUserQuery
    {
        return new SpyMerchantUserQuery();
    }

    /**
     * @return \Orm\Zed\Acl\Persistence\SpyAclUserHasGroupQuery
     */
    public function createAclUserHasGroups(): SpyAclUserHasGroupQuery
    {
        return new SpyAclUserHasGroupQuery();
    }

    /**
     * @return \Xiphias\Shared\Reports\ReportsConfig
     */
    public function getReportsSharedConfig(): ReportsConfig
    {
        return new ReportsConfig();
    }
}
