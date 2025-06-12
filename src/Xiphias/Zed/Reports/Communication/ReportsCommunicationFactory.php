<?php

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication;

use Spryker\Client\Session\SessionClientInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\HttpFoundation\RequestStack;
use Xiphias\Zed\Reports\Communication\Builder\DownloadHeadersBuilder;
use Xiphias\Zed\Reports\Communication\Builder\DownloadHeadersBuilderInterface;
use Xiphias\Zed\Reports\Communication\Formatter\ParameterFormatter;
use Xiphias\Zed\Reports\Communication\Formatter\ParameterFormatterInterface;
use Xiphias\Zed\Reports\Communication\Mapper\ReportsMapper;
use Xiphias\Zed\Reports\Communication\Mapper\ReportsMapperInterface;
use Xiphias\Zed\Reports\Communication\TabCreator\TabCreator;
use Xiphias\Zed\Reports\Communication\TabCreator\TabCreatorInterface;
use Xiphias\Zed\Reports\Communication\Table\ReportsTable;
use Xiphias\Zed\Reports\Communication\Table\SalesReportsTable;
use Xiphias\Zed\Reports\Communication\Tabs\OrderOverviewTabs;
use Xiphias\Zed\Reports\Communication\ViewExpander\ReportsSalesOverviewExpander;
use Xiphias\Zed\Reports\Communication\ViewExpander\ReportsSalesOverviewExpanderInterface;
use Xiphias\Zed\Reports\Communication\ViewExpander\ViewExpanderTableFactoryInterface;
use Xiphias\Zed\Reports\ReportsDependencyProvider;

/**
 * @method \Xiphias\Zed\Reports\ReportsConfig getConfig()
 * @method \Xiphias\Zed\Reports\Business\ReportsFacadeInterface getFacade()
 */
class ReportsCommunicationFactory extends AbstractCommunicationFactory implements ViewExpanderTableFactoryInterface
{
    /**
     * @return \Xiphias\Zed\Reports\Communication\Table\ReportsTable
     */
    public function createReportsTable(): ReportsTable
    {
        return new ReportsTable(
            $this->getFacade(),
            $this->getConfig(),
        );
    }

    /**
     * @return \Xiphias\Zed\Reports\Communication\Builder\DownloadHeadersBuilderInterface
     */
    public function createDownloadHeadersBuilder(): DownloadHeadersBuilderInterface
    {
        return new DownloadHeadersBuilder();
    }

    /**
     * @param array $params
     *
     * @return \Xiphias\Zed\Reports\Communication\Table\SalesReportsTable
     */
    public function createSalesReportsTable(array $params = []): SalesReportsTable
    {
        return new SalesReportsTable(
            $this->getFacade(),
            $this->getConfig(),
            $params,
        );
    }

    /**
     * @return \Xiphias\Zed\Reports\Communication\Formatter\ParameterFormatterInterface
     */
    public function createParameterFormatter(): ParameterFormatterInterface
    {
        return new ParameterFormatter();
    }


    /**
     * @return \Xiphias\Zed\Reports\Communication\Mapper\ReportsMapper
     */
    public function createReportsMapper(): ReportsMapperInterface
    {
        return new ReportsMapper(
            $this->getConfig(),
            $this->getSessionClient(),
        );
    }

    /**
     * @return \Xiphias\Zed\Reports\Communication\ViewExpander\ReportsSalesOverviewExpanderInterface
     */
    public function createReportsSalesOverviewExpander(): ReportsSalesOverviewExpanderInterface
    {
        return new ReportsSalesOverviewExpander($this);
    }

    /**
     * @param string $resource
     *
     * @return OrderOverviewTabs
     */
    public function createOverviewTabs(string $resource): OrderOverviewTabs
    {
        return new OrderOverviewTabs($resource);
    }

    /**
     * @return \Spryker\Client\Session\SessionClientInterface
     */
    public function getSessionClient(): SessionClientInterface
    {
        return $this->getProvidedDependency(ReportsDependencyProvider::SESSION_CLIENT);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RequestStack|null
     */
    public function getRequestStackService(): ?RequestStack
    {
        return $this->getProvidedDependency(ReportsDependencyProvider::SERVICE_REQUEST_STACK);
    }

}
