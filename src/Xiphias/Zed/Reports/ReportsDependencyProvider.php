<?php

declare(strict_types=1);

namespace Xiphias\Zed\Reports;

use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Xiphias\BladeFxApi\BladeFxApiClient;
use Xiphias\BladeFxApi\BladeFxApiClientInterface;
use Xiphias\Zed\Reports\Communication\Plugins\Authentication\BladeFxSessionHandlerPostAuthenticationPlugin;

/**
 * @method \Pyz\Zed\Reports\ReportsConfig getConfig()
 */
class ReportsDependencyProvider extends AbstractBundleDependencyProvider
{
    use LoggerTrait;

    /**
     * @var string
     */
    public const BLADE_FX_CLIENT = 'BLADE_FX_CLIENT';

    /**
     * @var string
     */
    public const SPRYKER_BLADE_FX_FACADE = 'SPRYKER_BLADE_FX_FACADE';

    /**
     * @var string
     */
    public const SESSION_CLIENT = 'SESSION_CLIENT';

    /**
     * @var string
     */
    public const MESSENGER_FACADE = 'MESSENGER_FACADE';

    /**
     * @var string
     */
    public const BLADE_FX_POST_AUTHENTICATION_PLUGINS = 'BLADE_FX_POST_AUTHENTICATION_PLUGINS';

    /**
     * @uses \Spryker\Zed\Http\Communication\Plugin\Application\HttpApplicationPlugin::SERVICE_REQUEST_STACK
     *
     * @var string
     */
    public const SERVICE_REQUEST_STACK = 'request_stack';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addBladeFxClient($container);
        $container = $this->addSessionClient($container);
        $container = $this->addSprykerBladeFxUserFacade($container);
        $container = $this->addMessengerFacade($container);
        $container = $this->addBladeFxPostAuthenticationPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = $this->addSessionClient($container);
        $container = $this->addRequestStackService($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBladeFxClient(Container $container): Container
    {
        $container->set(static::BLADE_FX_CLIENT, function (Container $container): BladeFxApiClientInterface {
            return new BladeFxApiClient(
                $this->getConfig()->getHostUrl(),
                $this->getConfig()->getDefaultUsername(),
                $this->getConfig()->getDefaultPassword(),
                $this->getLogger(),
            );
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSprykerBladeFxUserFacade(Container $container): Container
    {
        $container->set(static::SPRYKER_BLADE_FX_FACADE, function (Container $container) {
            return $container->getLocator()->sprykerBladeFxUser()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSessionClient(Container $container): Container
    {
        $container->set(static::SESSION_CLIENT, function (Container $container) {
            return $container->getLocator()->session()->client();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addRequestStackService(Container $container): Container
    {
        $container->set(static::SERVICE_REQUEST_STACK, function (Container $container) {
            return $container->hasApplicationService(static::SERVICE_REQUEST_STACK)
                ? $container->getApplicationService(static::SERVICE_REQUEST_STACK)
                : null;
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addMessengerFacade(Container $container): Container
    {
        $container->set(static::MESSENGER_FACADE, function (Container $container) {
            return $container->getLocator()->messenger()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addBladeFxPostAuthenticationPlugins(Container $container): Container
    {
        $container->set(static::BLADE_FX_POST_AUTHENTICATION_PLUGINS, function () {
            return $this->getBladeFxPostAuthenticationPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Xiphias\Zed\Reports\Communication\Plugins\Authentication\BladeFxSessionHandlerPostAuthenticationPlugin>
     */
    protected function getBladeFxPostAuthenticationPlugins(): array
    {
        return [
            new BladeFxSessionHandlerPostAuthenticationPlugin(),
        ];
    }
}
