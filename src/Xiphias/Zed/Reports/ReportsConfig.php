<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use Xiphias\Shared\Reports\ReportsConstants;

class ReportsConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const PATH_TAG_USER = 'Table';

    /**
     * @var string
     */
    public const PATH_TAG_REPORTS = 'Table1';

    /**
     * @var bool
     */
    protected const DEFAULT_LICENCE_EXP = true;

    /**
     * @var string
     */
    protected const BFX_TOKEN_SESSION_KEY = 'bfx_token';

    /**
     * @var string
     */
    protected const BFX_USER_ID_SESSION_KEY = 'bfx_user_id';

    /**
     * @var string
     */
    protected const BFX_USER_COMPANY_ID_SESSION_KEY = 'bfx_company_id';

    /**
     * @var string
     */
    protected const BFX_USER_LANGUAGE_ID_SESSION_KEY = 'bfx_language_id';

    /**
     * @var string
     */
    protected const BLADE_FX_MERCHANT_PORTAL_GROUP_NAME = 'BladeFx-Reports-MP';

    /**
     * @var string
     */
    protected const BLADE_FX_GROUP_NAME = 'BladeFx-Reports';

    /**
     * @var string
     */
    protected const MERCHANT_ID_KEY = 'merchant_id';

    /**
     * @var string
     */
    protected const SPRYKER_USER_ID_KEY = 'spryker_user_id';

    /**
     * @var string
     */
    protected const DEFAULT_DATA_RETURN_TYPE = 'JSON';

    /**
     * @var string
     */
    protected const DEFAULT_CATEGORY_QUERY_KEY = 'category';

    /**
     * @var int
     */
    protected const DEFAULT_CATEGORY_INDEX = -1;

    /**
     * @var int
     */
    protected const DEFAULT_LAYOUT = 0;

    /**
     * @var string
     */
    public const GET_REPORT_PREVIEW_URL_PATH = '/ReportEdit/ReportPreviewPrint/';

    /**
     * @var array
     */
    protected const REPORTS_TABLE_COLUMN_MAP = [
        'isFavorite' => 'Is Favorite',
        'repId' => 'rep_id',
        'repName' => 'rep_name',
        'repDesc' => 'rep_desc',
        'catName' => 'Category name',
        'actions' => 'action',
    ];

    /**
     * @var array
     */
    protected const SALES_REPORTS_TABLE_COLUMN_MAP = [
        'isFavorite' => 'Is Favorite',
        'repId' => 'rep_id',
        'repName' => 'rep_name',
        'repDesc' => 'rep_desc',
        'catName' => 'Category name',
        'actions' => 'Actions',
    ];

    /**
     * @var array
     */
    protected const REPORTS_TABLE_RAW_COLUMNS = [
        'isFavorite',
        'actions',
    ];

    /**
     * @var array
     */
    protected const SALES_REPORTS_TABLE_RAW_COLUMNS = [
        'isFavorite',
        'actions',
    ];

    /**
     * @var string
     */
    public const BLADE_FX_ROOT_URL = 'BLADE_FX_ROOT_URL';

    /**
     * @return int
     */
    public function getDefaultCategoryIndex(): int
    {
        return static::DEFAULT_CATEGORY_INDEX;
    }

    /**
     * @return string
     */
    public function getCategoryQueryKey(): string
    {
        return static::DEFAULT_CATEGORY_QUERY_KEY;
    }

    /**
     * @return string
     */
    public function getReturnTypeJson(): string
    {
        return static::DEFAULT_DATA_RETURN_TYPE;
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

    /**
     * @return bool
     */
    public function getDefaultLicenceExp(): bool
    {
        return static::DEFAULT_LICENCE_EXP;
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
    public function getBfxUserIdSessionKey(): string
    {
        return static::BFX_USER_ID_SESSION_KEY;
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
     * @return array<string>
     */
    public function getReportsTableColumnMap(): array
    {
        return static::REPORTS_TABLE_COLUMN_MAP;
    }

    /**
     * @return array<string>
     */
    public function getSalesReportsTableColumnMap(): array
    {
        return static::SALES_REPORTS_TABLE_COLUMN_MAP;
    }

    /**
     * @return array<string>
     */
    public function getReportsTableRawColumns(): array
    {
        return static::REPORTS_TABLE_RAW_COLUMNS;
    }

    /**
     * @return array<string>
     */
    public function getSalesReportsTableRawColumns(): array
    {
        return static::SALES_REPORTS_TABLE_RAW_COLUMNS;
    }

    /**
     * @return string
     */
    public function getRootUrl(): string
    {
        return $this->get(static::BLADE_FX_ROOT_URL);
    }

    /**
     * @return int
     */
    public function getDefaultLayout(): int
    {
        return static::DEFAULT_LAYOUT;
    }

    /**
     * @return string
     */
    public function getParamFormRootUrl(): string
    {
        return $this->get(ReportsConstants::BLADE_FX_ROOT_URL);
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
     * @return string
     */
    public function getMerchantIdKey(): string
    {
        return static::MERCHANT_ID_KEY;
    }

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
    public function getReportPreviewUrlPath(): string
    {
        return static::GET_REPORT_PREVIEW_URL_PATH;
    }
}
