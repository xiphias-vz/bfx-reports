<?php


namespace Xiphias\Shared\Reports;

use Spryker\Shared\Kernel\AbstractSharedConfig;

class ReportsConfig extends AbstractSharedConfig
{
    /**
     * @var string
     */
    protected const MERCHANT_ID_KEY = 'merchant_id';

    /**
     * @var string
     */
    protected const BFX_USER_LANGUAGE_ID_SESSION_KEY = 'bfx_language_id';

    /**
     * @var string
     */
    protected const BFX_USER_COMPANY_ID_SESSION_KEY = 'bfx_company_id';

    /**
     * @var string
     */
    protected const BFX_TOKEN_SESSION_KEY = 'bfx_token';

    /**
     * @var string
     */
    protected const BLADE_FX_GROUP_NAME = 'BladeFx Reports';

    /**
     * @var string
     */
    protected const BLADE_FX_MERCHANT_PORTAL_GROUP_NAME = 'BladeFx-Reports-MP';

    /**
     * @var string
     */
    public const BLADE_FX_USER_SESSION = 'bfx_user_session';

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
    public function getBfxUserLanguageIdSessionKey(): string
    {
        return static::BFX_USER_LANGUAGE_ID_SESSION_KEY;
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
    public function getBfxTokenSessionKey(): string
    {
        return static::BFX_TOKEN_SESSION_KEY;
    }

    /**
     * @return string
     */
    public function getBladeFxBOGroupName(): string
    {
        return static::BLADE_FX_GROUP_NAME;
    }

    /**
     * @return string
     */
    public function getBladeFxMerchantPortalGroupName(): string
    {
        return static::BLADE_FX_MERCHANT_PORTAL_GROUP_NAME;
    }

    /**
     * @param string $username
     *
     * @return string
     */
    public function getBfxUserSessionKey(string $username): string
    {
        return static::BLADE_FX_USER_SESSION . '-' . md5($username);
    }
}
