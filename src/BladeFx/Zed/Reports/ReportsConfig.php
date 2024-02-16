<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BladeFx\Zed\Reports;

use BladeFx\Shared\Reports\ReportsConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

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
     * @var array
     */
    protected const REPORTS_TABLE_COLUMN_MAP = [
        'isFavorite' => 'Is Favorite',
        'repId' => 'rep_id',
        'repName' => 'rep_name',
        'repDesc' => 'rep_desc',
        'catName' => 'Category name',
        'isActive' => 'Is active',
        'isDrilldown' => 'Is drilldown',
    ];

    /**
     * @var array
     */
    protected const REPORTS_TABLE_RAW_COLUMNS = [
        'isFavorite',
        'isActive',
        'isDrilldown',
    ];

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
    public function getBladeFxSprykerOrderAttribute(): string
    {
        return $this->get(ReportsConstants::BLADE_FX_ORDER_ATTRIBUTE);
    }

    /**
     * @return string
     */
    public function getWebServiceUrlFile(): string
    {
        return $this->get(ReportsConstants::BLADE_FX_SERVICE)[ReportsConstants::BLADE_FX_WEB_SERVICE_FILE];
    }

    /**
     * @return string
     */
    public function getBladeFxUserUrlInfo(): string
    {
        return $this->get(ReportsConstants::BLADE_FX_SERVICE)[ReportsConstants::BLADE_FX_USER_INFO];
    }

    /**
     * @return string
     */
    public function getBladeFxReportUrlList(): string
    {
        return $this->get(ReportsConstants::BLADE_FX_SERVICE)[ReportsConstants::BLADE_FX_REPORT_LIST];
    }

    /**
     * @return string
     */
    public function getBladeFxPrintOutFileUrl(): string
    {
        return $this->get(ReportsConstants::BLADE_FX_SERVICE)[ReportsConstants::BLADE_FX_URL_PRINT_OUT_FILE];
    }

    /**
     * @return string
     */
    public function getBladeFxMobileFileUrl(): string
    {
        return $this->get(ReportsConstants::BLADE_FX_SERVICE)[ReportsConstants::BLADE_FX_URL_MOBILE_FILE];
    }

    /**
     * @return string
     */
    public function getBladeFxReportsHost(): string
    {
        return $this->get(ReportsConstants::BLADE_FX_REPORTS_HOST);
    }

    /**
     * @return string
     */
    public function getBladeFxThisHost(): string
    {
        return $this->get(ReportsConstants::BLADE_FX_X_THIS_HOST);
    }

    /**
     * @return string
     */
    public function getPathTagUser(): string
    {
        return static::PATH_TAG_USER;
    }

    /**
     * @return string
     */
    public function getPathTagReports(): string
    {
        return static::PATH_TAG_REPORTS;
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
     * @return array<string>
     */
    public function getReportsTableColumnMap(): array
    {
        return static::REPORTS_TABLE_COLUMN_MAP;
    }

    /**
     * @return array<string>
     */
    public function getReportsTableRawColumns(): array
    {
        return static::REPORTS_TABLE_RAW_COLUMNS;
    }
}
