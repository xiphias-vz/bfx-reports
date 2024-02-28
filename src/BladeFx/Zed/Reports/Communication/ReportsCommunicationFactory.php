<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BladeFx\Zed\Reports\Communication;

use BladeFx\Zed\Reports\Business\ReportsFacadeInterface;
use BladeFx\Zed\Reports\Communication\Builder\DownloadHeadersBuilder;
use BladeFx\Zed\Reports\Communication\Builder\DownloadHeadersBuilderInterface;
use BladeFx\Zed\Reports\Communication\Mapper\ParameterMapper;
use BladeFx\Zed\Reports\Communication\Table\ReportsTable;
use BladeFx\Zed\Reports\Communication\Table\SalesReportsTable;
use BladeFx\Zed\Reports\ReportsDependencyProvider;
use Spryker\Client\Session\SessionClientInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \BladeFx\Zed\Reports\ReportsConfig getConfig()
 * @method \BladeFx\Zed\Reports\Business\ReportsFacadeInterface getFacade()
 */
class ReportsCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Spryker\Client\Session\SessionClientInterface
     */
    public function getSessionClient(): SessionClientInterface
    {
        return $this->getProvidedDependency(ReportsDependencyProvider::SESSION_CLIENT);
    }

    /**
     * @return \BladeFx\Zed\Reports\Communication\Table\ReportsTable
     */
    public function createReportsTable(): ReportsTable
    {
        return new ReportsTable(
            $this->getFacade(),
            $this->getConfig(),
        );
    }

    /**
     * @return \BladeFx\Zed\Reports\Communication\Builder\DownloadHeadersBuilderInterface
     */
    public function createDownloadHeadersBuilder(): DownloadHeadersBuilderInterface
    {
        return new DownloadHeadersBuilder();
    }

    /**
     * @return \BladeFx\Zed\Reports\Communication\Mapper\ParameterMapper
     */
    public function createParameterMapper(): ParameterMapper
    {
        return new ParameterMapper();
    }

    /**
     * @param \BladeFx\Zed\Reports\Business\ReportsFacadeInterface $facade
     * @param array|null $params
     *
     * @return \BladeFx\Zed\Reports\Communication\Table\SalesReportsTable
     */
    public function createSalesReportsTable(array $params = []): SalesReportsTable
    {
        return new SalesReportsTable(
            $this->getFacade(),
            $this->getConfig(),
            $params,
        );
    }
}
