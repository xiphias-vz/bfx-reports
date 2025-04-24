<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\SprykerBladeFxUser;

use Spryker\Zed\Kernel\AbstractBundleConfig;

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
     * @var string
     */
    protected const SPRYKER_USER_ID_KEY = 'spryker_user_id';

    /**
     * @var string
     */
    protected const MERCHANT_ID_KEY = 'merchant_id';

    /**
     * @var string
     */
    protected const BFX_TOKEN_SESSION_KEY = 'bfx_token';

    /**
     * @var string
     */
    protected const BFX_USER_COMPANY_ID_SESSION_KEY = 'bfx_company_id';

    /**
     * @var string
     */
    protected const BFX_USER_LANGUAGE_ID_SESSION_KEY = 'bfx_language_id';

    /**
     * @return string
     */
    public function getSprykerUserIdKey(): string
    {
        return static::SPRYKER_USER_ID_KEY;
    }

    /**
     * @return string
     */
    public function getMerchantIdKey(): string
    {
        return static::MERCHANT_ID_KEY;
    }

    /**
     * @return string
     */
    public function getBfxTokenSessionKey(): string
    {
        return static::BFX_TOKEN_SESSION_KEY;
    }

    /**
     * @return string
     */
    public function getBfxUserCompanyIdSessionKey(): string
    {
        return static::BFX_USER_COMPANY_ID_SESSION_KEY;
    }

    /**
     * @return string
     */
    public function getBfxUserLanguageIdSessionKey(): string
    {
        return static::BFX_USER_LANGUAGE_ID_SESSION_KEY;
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
}
