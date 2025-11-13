<?php


namespace Xiphias\Shared\Reports;

class ReportsConstants
{
    /**
     * @var string
     */
    public const BLADE_FX_SERVICE = 'BLADE_FX_SERVICE';

    /**
     * @var string
     */
    public const BLADE_FX_REPORTS_HOST = 'BLADE_FX_REPORTS_HOST';

    /**
     * @var string
     */
    public const BLADE_FX_URL_PRINT_OUT_FILE = 'BLADE_FX_URL_PRINT_OUT_FILE';

    /**
     * @var string
     */
    public const BLADE_FX_URL_MOBILE_FILE = 'BLADE_FX_URL_MOBILE_FILE';

    /**
     * @var string
     */
    public const BLADE_FX_X_THIS_HOST = 'BLADE_FX_X_THIS_HOST';

    /**
     * @var string
     */
    public const BLADE_FX_WEB_SERVICE_FILE = 'BLADE_FX_WEB_SERVICE_FILE';

    /**
     * @var string
     */
    public const BLADE_FX_USER_INFO = 'BLADE_FX_POST_URL';

    /**
     * @var string
     */
    public const BLADE_FX_REPORT_LIST = 'BLADE_FX_REPORT_LIST';

    /**
     * @var string
     */
    public const EXTERNAL_API_HTTP_CLIENT_PARAMS = 'EXTERNAL_API_HTTP_CLIENT_PARAMS';

    /**
     * @var string
     */
    public const BLADE_FX_DEFAULT_USER_NAME = 'BLADE_FX_DEFAULT_USER_NAME';

    /**
     * @var string
     */
    public const BLADE_FX_DEFAULT_PASSWORD = 'BLADE_FX_DEFAULT_PASSWORD';

    /**
     * @var string
     */
    public const BLADE_FX_SESSION_USER_TOKEN = 'blade-fx-user-token';

    /**
     * @var string
     */
    public const BLADE_FX_ORDER_ATTRIBUTE = 'spryker_order_detail';

    /**
     * @var string
     */
    public const BLADE_FX_MP_ORDER_ATTRIBUTE = 'spryker_order_detail_MP';

    /**
     * @var string
     */
    public const BLADE_FX_CUSTOMER_ATTRIBUTE = 'spryker_customer_detail';

    /**
     * @var string
     */
    public const BLADE_FX_PRODUCT_ATTRIBUTE = 'spryker_product_detail';

    /**
     * @var string
     */
    public const BLADE_FX_MERCHANT_ATTRIBUTE = 'spryker_merchant_detail';

    /**
     * @var string
     */
    public const BLADE_FX_MP_REPORTS = 'spryker_mp_reports';

    /**
     * @var string
     */
    public const BLADE_FX_ALL_REPORTS = 'spryker_all_reports';

    /**
     * @var string
     */
    public const QUERY_ATTRIBUTE = 'attribute';

    /**
     * @var string
     */
    public const BLADE_FX_ORDER_PARAM_NAME = '@OrderID';

    /**
     * @var string
     */
    public const BLADE_FX_CUSTOMER_PARAM_NAME = '@CustomerID';

    /**
     * @var string
     */
    public const BLADE_FX_PRODUCT_PARAM_NAME = '@ProductID';

    /**
     * @var string
     */
    public const BLADE_FX_MERCHANT_PARAM_NAME = '@MerchantID';

    /**
     * @var string
     */
    public const SPRKYER_PARAM_ID_PRODUCT_ABSTRACT = 'id-product-abstract';

    /**
     * @var string
     */
    public const SPRKYER_PARAM_ID_MERCHANT = 'id-merchant';

    /**
     * @var string
     */
    public const ROOT_URL_QUERY_PROPERTY = 'rootUrl';

    /**
     * @var string
     */
    public const PARAMETER_NAME = 'paramName';

    /**
     * @var string
     */
    public const PARAMETER_VALUE = 'paramValue';

    /**
     * @var string
     */
    public const CONTEXT_BLADE_FX_PARAMETER_NAME = '@context';

    /**
     * @var string
     */

    public const ID_BLADE_FX_PARAMETER_NAME = '@ID';

    /**
     * @var string
     */
    public const ENTRY_TEXT_REPORT_PREVIEW_PARAMETER_NAME = 'entryText';

    /**
     * @var string
     */
    public const ATTRIBUTE = 'attribute';

    /**
     * @var string
     */
    public const REPORT_ID = 'report_id';

    /**
     * @var string
     */
    public const BLADE_FX_ROOT_URL = 'BLADE_FX_ROOT_URL';

    /**
     * @var string
     */
    public const BLADE_FX_GROUP_NAME = 'BladeFx Reports';

    /**
     * @var string
     */
    public const BLADE_FX_GROUP_REFERENCE = 'bladefx-reports';

    /**
     * @var string
     */
    public const SPRYKER_ROOT_GROUP = 'root_group';

    /**
     * @var string
     */
    public const MARKETPLACE_ONLY_CLASS = 'Xiphias\Zed\BfxReportsMerchantPortalGui\BfxReportsMerchantPortalGuiDependencyProvider';

    /**
     * @var string
     */
    public const SPRYKER_BO_ROLE = 'SprykerBORole';

    /**
     * @var string
     */
    public const SPRYKER_MP_ROLE = 'SprykerMPRole';

    /**
     * @var string
     */
    public const SPRYKER_USER_ID_KEY = 'spryker_user_id';

    /**
     * @var string
     */
    public const MERCHANT_ID_KEY = 'merchant_id';

    /**
     * @var string
     */
    public const BFX_TOKEN_SESSION_KEY = 'bfx_token';

    /**
     * @var string
     */
    public const BFX_USER_COMPANY_ID_SESSION_KEY = 'bfx_company_id';

    /**
     * @var string
     */
    public const BFX_USER_LANGUAGE_ID_SESSION_KEY = 'bfx_language_id';

    /**
     * @var int
     */
    public const DEFAULT_CATEGORY_INDEX = -1;

    /**
     * @var string
     */
    public const EVENT_USER_POST_SAVE_LICENSE_ISSUE = 'SprykerBladeFxUser.user.post_save.license_issue';

    /**
     * @var string
     */
    public const EVENT_QUEUE_NAME = 'event';

    /**
     * @var string
     */
    public const USER_CREATE_FAILED_USER_CAP_ERROR = 'bfx.reports.create_update_delete.failed.user_cap';

    /**
     * @var string
     */
    public const USER_CREATE_UPDATE_DELETE_FAILED_GENERAL_ERROR = 'bfx.reports.create_update_delete.failed';

    /**
     * @var string
     */
    public const TIMEZONE_CROATIA = "Europe/Zagreb";

    /**
     * @var string
     */
    public const TIME_FORMAT_BLADEFX = "Y-m-d H:i:s";
}
