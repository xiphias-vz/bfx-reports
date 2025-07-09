<?php


namespace Xiphias\Zed\SprykerBladeFxUser\Persistence;

use Orm\Zed\Acl\Persistence\SpyAclGroupQuery;
use Orm\Zed\Acl\Persistence\SpyAclUserHasGroupQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use Xiphias\Shared\Reports\ReportsConfig;

/**
 * @method \Xiphias\Zed\SprykerBladeFxUser\SprykerBladeFxUserConfig getConfig()
 */
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
