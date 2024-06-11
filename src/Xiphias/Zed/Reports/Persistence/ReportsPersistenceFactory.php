<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Reports\Persistence;

use Orm\Zed\Acl\Persistence\SpyAclGroupQuery;
use Orm\Zed\Acl\Persistence\SpyAclUserHasGroupQuery;
use Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Xiphias\Zed\Reports\ReportsConfig getConfig()
 */
class ReportsPersistenceFactory extends AbstractPersistenceFactory
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
}
