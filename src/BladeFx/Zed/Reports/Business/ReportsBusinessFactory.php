<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BladeFx\Zed\Reports\Business;

use BladeFx\Client\ReportsApi\ReportsApiClientInterface;
use BladeFx\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticator;
use BladeFx\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface;
use BladeFx\Zed\Reports\Business\BladeFx\CategoryReader\BladeFxCategoryReader;
use BladeFx\Zed\Reports\Business\BladeFx\CategoryReader\BladeFxCategoryReaderInterface;
use BladeFx\Zed\Reports\Business\BladeFx\PreviewReader\BladeFxPreviewReader;
use BladeFx\Zed\Reports\Business\BladeFx\PreviewReader\BladeFxPreviewReaderInterface;
use BladeFx\Zed\Reports\Business\BladeFx\ReportByFormatReader\BladeFxReportByFormatReader;
use BladeFx\Zed\Reports\Business\BladeFx\ReportByFormatReader\BladeFxReportByFormatReaderInterface;
use BladeFx\Zed\Reports\Business\BladeFx\ReportListReader\BladeFxReportListReader;
use BladeFx\Zed\Reports\Business\BladeFx\ReportListReader\BladeFxReportListReaderInterface;
use BladeFx\Zed\Reports\Business\BladeFx\ReportsReader\ReportsReader;
use BladeFx\Zed\Reports\Business\BladeFx\ReportsReader\ReportsReaderInterface;
use BladeFx\Zed\Reports\Business\BladeFx\ReportsUpdater\ReportsUpdater;
use BladeFx\Zed\Reports\Business\BladeFx\ReportsUpdater\ReportsUpdaterInterface;
use BladeFx\Zed\Reports\Business\BladeFx\RequestProcessor\RequestProcessor;
use BladeFx\Zed\Reports\Business\BladeFx\RequestProcessor\RequestProcessorInterface;
use BladeFx\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolver;
use BladeFx\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface;
use BladeFx\Zed\Reports\ReportsDependencyProvider;
use Spryker\Client\Session\SessionClientInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Messenger\Business\MessengerFacadeInterface;

/**
 * @method \BladeFx\Zed\Reports\ReportsConfig getConfig()
 * @method \BladeFx\Zed\Reports\Business\ReportsFacade getFacade();
 */
class ReportsBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \BladeFx\Zed\Reports\Business\BladeFx\RequestProcessor\RequestProcessorInterface
     */
    public function createRequestProcessor(): RequestProcessorInterface
    {
        return new RequestProcessor(
            $this->createBladeFxCategoryReader(),
            $this->createBladeFxReportsReader(),
            $this->createReportsUpdater(),
            $this->getConfig(),
        );
    }

    /**
     * @return \BladeFx\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface
     */
    public function createBladeFxAuthenticator(): BladeFxAuthenticatorInterface
    {
        return new BladeFxAuthenticator(
            $this->getBladeFxClient(),
            $this->getConfig(),
            $this->getSessionClient(),
            $this->getBladeFxPostAuthenticationPlugins(),
        );
    }

    /**
     * @return \BladeFx\Zed\Reports\Business\BladeFx\CategoryReader\BladeFxCategoryReaderInterface
     */
    public function createBladeFxCategoryReader(): BladeFxCategoryReaderInterface
    {
        return new BladeFxCategoryReader(
            $this->getBladeFxClient(),
            $this->createTokenResolver(),
            $this->getConfig(),
        );
    }

    /**
     * @return \BladeFx\Zed\Reports\Business\BladeFx\ReportsReader\ReportsReaderInterface
     */
    public function createBladeFxReportsReader(): ReportsReaderInterface
    {
        return new ReportsReader(
            $this->getBladeFxClient(),
            $this->createTokenResolver(),
            $this->getConfig(),
        );
    }

    /**
     * @return \BladeFx\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface
     */
    public function createTokenResolver(): TokenResolverInterface
    {
        return new TokenResolver(
            $this->createBladeFxAuthenticator(),
            $this->getSessionClient(),
            $this->getConfig(),
        );
    }

    /**
     * @return \BladeFx\Zed\Reports\Business\BladeFx\ReportsUpdater\ReportsUpdaterInterface
     */
    public function createReportsUpdater(): ReportsUpdaterInterface
    {
        return new ReportsUpdater(
            $this->getBladeFxClient(),
            $this->createTokenResolver(),
            $this->getMessengerFacade(),
            $this->getSessionClient(),
            $this->getConfig(),
        );
    }

    /**
     * @return \BladeFx\Client\ReportsApi\ReportsApiClientInterface
     */
    public function getBladeFxClient(): ReportsApiClientInterface
    {
        return $this->getProvidedDependency(ReportsDependencyProvider::BLADE_FX_CLIENT);
    }

    /**
     * @return \Spryker\Client\Session\SessionClientInterface
     */
    public function getSessionClient(): SessionClientInterface
    {
        return $this->getProvidedDependency(ReportsDependencyProvider::SESSION_CLIENT);
    }

    /**
     * @return array<\BladeFx\Zed\Reports\Communication\Plugins\Authentication\BladeFxPostAuthenticationPluginInterface>
     */
    public function getBladeFxPostAuthenticationPlugins(): array
    {
        return $this->getProvidedDependency(ReportsDependencyProvider::BLADE_FX_POST_AUTHENTICATION_PLUGINS);
    }

    /**
     * @return \Spryker\Zed\Messenger\Business\MessengerFacadeInterface
     */
    public function getMessengerFacade(): MessengerFacadeInterface
    {
        return $this->getProvidedDependency(ReportsDependencyProvider::MESSENGER_FACADE);
    }

    /**
     * @return \BladeFx\Zed\Reports\Business\BladeFx\ReportListReader\BladeFxReportListReaderInterface
     */
    public function createBladeFxReportListReader(): BladeFxReportListReaderInterface
    {
        return new BladeFxReportListReader(
            $this->createBladeFxAuthenticator(),
            $this->getBladeFxClient(),
            $this->getSessionClient(),
            $this->getConfig(),
        );
    }

    /**
     * @return \BladeFx\Zed\Reports\Business\BladeFx\ReportByFormatReader\BladeFxReportByFormatReaderInterface
     */
    public function createBladeFxReportByFormatReader(): BladeFxReportByFormatReaderInterface
    {
        return new BladeFxReportByFormatReader(
            $this->createBladeFxAuthenticator(),
            $this->getBladeFxClient(),
            $this->getSessionClient(),
            $this->getConfig(),
        );
    }

    /**
     * @return \BladeFx\Zed\Reports\Business\BladeFx\PreviewReader\BladeFxPreviewReaderInterface
     */
    public function createBladeFxPreviewReader(): BladeFxPreviewReaderInterface
    {
        return new BladeFxPreviewReader(
            $this->getBladeFxClient(),
            $this->createTokenResolver(),
            $this->getConfig(),
        );
    }
}
