<?php


namespace Xiphias\Zed\SprykerBladeFxUser;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use Xiphias\Shared\Reports\ReportsConstants;

/**
 * @method \Xiphias\Shared\SprykerBladeFxUser\SprykerBladeFxUserConfig getSharedConfig()
 */
class SprykerBladeFxUserConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    protected const ROOT_GROUP_NAME = 'root_group';

    /**
     * @var int
     */
    protected const ROOT_ADMIN_ID = 1;

    /**
     * @return string
     */
    public function getSprykerUserIdKey(): string
    {
        return ReportsConstants::SPRYKER_USER_ID_KEY;
    }

    /**
     * @return string
     */
    public function getMerchantIdKey(): string
    {
        return ReportsConstants::MERCHANT_ID_KEY;
    }

    /**
     * @return string
     */
    public function getBfxTokenSessionKey(): string
    {
        return ReportsConstants::BFX_TOKEN_SESSION_KEY;
    }

    /**
     * @return string
     */
    public function getBfxUserCompanyIdSessionKey(): string
    {
        return ReportsConstants::BFX_USER_COMPANY_ID_SESSION_KEY;
    }

    /**
     * @return string
     */
    public function getBfxUserLanguageIdSessionKey(): string
    {
        return ReportsConstants::BFX_USER_LANGUAGE_ID_SESSION_KEY;
    }

    /**
     * @return string
     */
    public function getBladeFxGroupName(): string
    {
        return ReportsConstants::BLADE_FX_GROUP_NAME;
    }

    /**
     * @return string
     */
    public function getMarketplaceInstallation(): string
    {
        return $this->getSharedConfig()->getMarketplaceInstallation();
    }

    /**
     * @return string
     */
    public function getRootGroupName(): string
    {
        return static::ROOT_GROUP_NAME;
    }

    /**
     * @return int
     */
    public function getRootAdminId(): int
    {
        return static::ROOT_ADMIN_ID;
    }

    /**
     * @return string
     */
    public function getHostUrl(): string
    {
        return $this->get(ReportsConstants::BLADE_FX_REPORTS_HOST);
    }

    /**
     * @return string
     */
    public function getDefaultUsername(): string
    {
        return $this->get(ReportsConstants::BLADE_FX_SERVICE)[ReportsConstants::BLADE_FX_DEFAULT_USER_NAME];
    }

    /**
     * @return string
     */
    public function getDefaultPassword(): string
    {
        return $this->get(ReportsConstants::BLADE_FX_SERVICE)[ReportsConstants::BLADE_FX_DEFAULT_PASSWORD];
    }
}
