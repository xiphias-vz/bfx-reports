<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace BladeFx\Shared\Reports;

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
    public const BLADE_FX_ORDER_ATTRIBUTE = 'BLADE_FX_ORDER_ATTRIBUTE';

    /**
     * @var string
     */
    public const QUERY_ATTRIBUTE = 'attribute';

    /**
     * @var array
     */
    protected const BLADE_FX_PREVIEW_TRANSFER_SNAKE_CASE_PROPERTIES = [
        'repId', 'layoutId', 'paramId',
    ];

    /**
     * @var string
     */
    public const BLADE_FX_ORDER_PARAM_NAME = '@order_id';
}
