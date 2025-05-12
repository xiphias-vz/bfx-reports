<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication;

use Spryker\Client\Session\SessionClientInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\HttpFoundation\RequestStack;
use Xiphias\Zed\Reports\Communication\Builder\CategoryTreeBuilder;
use Xiphias\Zed\Reports\Communication\Builder\CategoryTreeBuilderInterface;
use Xiphias\Zed\Reports\Communication\Builder\DownloadHeadersBuilder;
use Xiphias\Zed\Reports\Communication\Builder\DownloadHeadersBuilderInterface;
use Xiphias\Zed\Reports\Communication\Formatter\ParameterFormatter;
use Xiphias\Zed\Reports\Communication\Formatter\ParameterFormatterInterface;
use Xiphias\Zed\Reports\Communication\Mapper\ReportsCommunicationMapper;
use Xiphias\Zed\Reports\Communication\Mapper\ReportsCommunicationMapperInterface;
use Xiphias\Zed\Reports\Communication\Table\ReportsTable;
use Xiphias\Zed\Reports\Communication\Table\SalesReportsTable;
use Xiphias\Zed\Reports\ReportsDependencyProvider;
//use Xiphias\Zed\Reports\Communication\TabCreator\TabCreator;
//use Xiphias\Zed\Reports\Communication\TabCreator\TabCreatorInterface;
//use Xiphias\Zed\Reports\Communication\ViewExpander\ReportsSalesOverviewExpander;
//use Xiphias\Zed\Reports\Communication\ViewExpander\ReportsSalesOverviewExpanderInterface;
//use Xiphias\Zed\Reports\Communication\ViewExpander\ViewExpanderTableFactoryInterface;

/**
 * @method \Xiphias\Zed\Reports\ReportsConfig getConfig()
 * @method \Xiphias\Zed\Reports\Business\ReportsFacadeInterface getFacade()
 */
class ReportsCommunicationFactory extends AbstractCommunicationFactory
//    implements ViewExpanderTableFactoryInterface
{
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
     * @return \Xiphias\Zed\Reports\Communication\Builder\CategoryTreeBuilderInterface
     */
    public function createCategoryTreeBuilder(): CategoryTreeBuilderInterface
    {
        return new CategoryTreeBuilder();
    }

    /**
     * @return \Xiphias\Zed\Reports\Communication\Mapper\ReportsCommunicationMapper
     */
    public function createReportsCommunicationMapper(): ReportsCommunicationMapperInterface
    {
        return new ReportsCommunicationMapper(
            $this->getConfig(),
            $this->getSessionClient(),
        );
    }

//    /**
//     * @return TabCreatorInterface
//     */
//    public function createTabCreator(): TabCreatorInterface
//    {
//        return new TabCreator();
//    }
//
//    /**
//     * @return ReportsSalesOverviewExpanderInterface
//     */
//    public function createReportsSalesOverviewExpander(): ReportsSalesOverviewExpanderInterface
//    {
//        return new ReportsSalesOverviewExpander($this);
//    }
}
