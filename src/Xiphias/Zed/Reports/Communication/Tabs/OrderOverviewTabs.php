<?php

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\Tabs;

use Generated\Shared\Transfer\TabItemTransfer;
use Generated\Shared\Transfer\TabsViewTransfer;
use Spryker\Zed\Gui\Communication\Tabs\AbstractTabs;
use Xiphias\Shared\Reports\ReportsConstants;

class OrderOverviewTabs extends AbstractTabs
{
    /**
     * @param string $resource
     */
    public function __construct(protected string $resource)
    {
    }

    /**
     * @var string
     */
    public const ORDER_NAME = 'order';

    /**
     * @var string
     */
    public const ORDER_TITLE = 'Order Overview';

    /**
     * @var string
     */
    public const CUSTOMER_NAME = 'customer';

    /**
     * @var string
     */
    public const CUSTOMER_TITLE = 'Customer Overview';

    /**
     * @var string
     */
    public const PRODUCT_NAME = 'product';

    /**
     * @var string
     */
    public const PRODUCT_TITLE = 'Product Overview';

    /**
     * @var string
     */
    public const MERCHANT_NAME = 'merchant';

    /**
     * @var string
     */
    public const MERCHANT_TITLE = 'Merchant Overview';

    /**
     * @var string
     */
    public const REPORT_NAME = 'report';

    /**
     * @var string
     */
    public const REPORT_TITLE = 'Reports';

    /**
     * @param \Generated\Shared\Transfer\TabsViewTransfer $tabsViewTransfer
     *
     * @return \Generated\Shared\Transfer\TabsViewTransfer
     */
    protected function build(TabsViewTransfer $tabsViewTransfer): TabsViewTransfer
    {
        match ($this->resource) {
            ReportsConstants::BLADE_FX_ORDER_PARAM_NAME => $this->addOrderOverviewTab($tabsViewTransfer),
            ReportsConstants::BLADE_FX_CUSTOMER_PARAM_NAME => $this->addCustomerOverviewTab($tabsViewTransfer),
            ReportsConstants::BLADE_FX_PRODUCT_PARAM_NAME => $this->addProductOverviewTab($tabsViewTransfer),
            ReportsConstants::BLADE_FX_MERCHANT_PARAM_NAME => $this-> addMerchantOVerViewTab($tabsViewTransfer),
            default => null
        };

        $this->addReportTableTab($tabsViewTransfer);
        $tabsViewTransfer->setIsNavigable(true);

        return $tabsViewTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\TabsViewTransfer $tabsViewTransfer
     *
     * @return $this
     */
    protected function addOrderOverviewTab(TabsViewTransfer $tabsViewTransfer)
    {
        $tabItemTransfer = new TabItemTransfer();
        $tabItemTransfer
            ->setName(static::ORDER_NAME)
            ->setTitle(static::ORDER_TITLE)
            ->setTemplate($this->getOrderTemplate());

        $tabsViewTransfer->addTab($tabItemTransfer);

        return $this;
    }

    /**
     * @param \Generated\Shared\Transfer\TabsViewTransfer $tabsViewTransfer
     *
     * @return $this
     */
    protected function addCustomerOverviewTab(TabsViewTransfer $tabsViewTransfer)
    {
        $tabItemTransfer = new TabItemTransfer();
        $tabItemTransfer
            ->setName(static::CUSTOMER_NAME)
            ->setTitle(static::CUSTOMER_TITLE)
            ->setTemplate($this->getCustomerTemplate());

        $tabsViewTransfer->addTab($tabItemTransfer);

        return $this;
    }

    /**
     * @param TabsViewTransfer $tabsViewTransfer
     *
     * @return $this
     */
    protected function addProductOverviewTab(TabsViewTransfer $tabsViewTransfer)
    {
        $tabItemTransfer = new TabItemTransfer();
        $tabItemTransfer
            ->setName(static::PRODUCT_NAME)
            ->setTitle(static::PRODUCT_TITLE)
            ->setTemplate($this->getProductTemplate());

        $tabsViewTransfer->addTab($tabItemTransfer);

        return $this;
    }

    /**
     * @param TabsViewTransfer $tabsViewTransfer
     *
     * @return $this
     */
    protected function addMerchantOVerViewTab(TabsViewTransfer $tabsViewTransfer)
    {
        $tabItemTransfer = new TabItemTransfer();
        $tabItemTransfer
            ->setName(static::MERCHANT_NAME)
            ->setTitle(static::MERCHANT_TITLE)
            ->setTemplate($this->getMerchantTemplate());

        $tabsViewTransfer->addTab($tabItemTransfer);

        return $this;
    }

    /**
     * @param \Generated\Shared\Transfer\TabsViewTransfer $tabsViewTransfer
     *
     * @return $this
     */
    protected function addReportTableTab(TabsViewTransfer $tabsViewTransfer)
    {
        $tabItemTransfer = new TabItemTransfer();
        $tabItemTransfer
            ->setName(static::REPORT_NAME)
            ->setTitle(static::REPORT_TITLE)
            ->setTemplate($this->getReportsTemplate());

        $tabsViewTransfer->addTab($tabItemTransfer);

        return $this;
    }

    /**
     * @return string
     */
    protected function getOrderTemplate(): string
    {
        return '@Sales/_partials/_tabs/order-overview.twig';
    }

    /**
     * @return string
     */
    protected function getCustomerTemplate(): string
    {
        return '@Customer/_partials/_tabs/customer-overview.twig';
    }

    /**
     * @return string
     */
    protected function getProductTemplate(): string
    {
        return '@ProductManagement/_partials/_tabs/product-overview.twig';
    }

    /**
     * @return string
     */
    protected function getMerchantTemplate(): string
    {
        return '@MerchantGui/_partials/_tabs/merchant-overview.twig';
    }
    /**
     * @return string
     */
    protected function getReportsTemplate(): string
    {
        return '@Reports/_partials/_tabs/report-list.twig';
    }
}
