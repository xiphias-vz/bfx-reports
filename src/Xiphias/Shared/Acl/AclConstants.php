<?php


namespace Xiphias\Shared\Acl;

use Spryker\Shared\Acl\AclConstants as SprykerAclConstants;

interface AclConstants extends SprykerAclConstants
{
    /**
     * @var string
     */
    public const MERCHANT_PORTAL_GUI_BUNDLES = 'merchant_portal_gui_bundles';

    /**
     * @var string
     */
    public const BFX_REPORTS_GUI = 'reports';

    /**
     * @var string
     */
    public const BFX_REPORTS_MERCHANT_PORTAL_GUI = 'bfx-reports-merchant-portal-gui';

    /**
     * @var string
     */
    public const DENY = 'deny';
}
