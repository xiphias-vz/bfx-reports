<?php


namespace Xiphias\Zed\XiphiasAcl;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use Xiphias\Shared\Acl\AclConstants as XiphiasAclConstants;
use Xiphias\Shared\Reports\ReportsConstants;

class XiphiasAclConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    protected const BLADE_FX_MERCHANT_PORTAL_GROUP_NAME = 'BladeFx-Reports-MP';

    /**
     * @return string
     */
    public function getBfxMerchantPortalGroupName(): string
    {
        return static::BLADE_FX_MERCHANT_PORTAL_GROUP_NAME;
    }

    /**
     * @return string
     */
    public function getBfxGroupName(): string
    {
        return ReportsConstants::BLADE_FX_GROUP_NAME;
    }

    /**
     * @return string
     */
    public function getBfxGroupReference(): string
    {
        return ReportsConstants::BLADE_FX_GROUP_REFERENCE;
    }

    /**
     * @return array
     */
    public function getMerchantPortalGuiBundles(): array
    {
        return $this->get(XiphiasAclConstants::MERCHANT_PORTAL_GUI_BUNDLES);
    }
}
