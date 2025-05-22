<?php


namespace Xiphias\Zed\SprykerBladeFxUser;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Xiphias\Client\ReportsApi\ReportsApiClient;
use Xiphias\Client\ReportsApi\ReportsApiClientInterface;
use Xiphias\Zed\SprykerBladeFxUser\Communication\Plugin\User\B2CCreateBfxUserOnBfxPlugin;
use Xiphias\Zed\SprykerBladeFxUser\Communication\Plugin\User\B2CDeleteBfxUserOnBfxPlugin;
use Xiphias\Zed\SprykerBladeFxUser\Communication\Plugin\User\B2CUpdateBfxUserOnBfxPlugin;

/**
 * @method \Xiphias\Zed\SprykerBladeFxUser\SprykerBladeFxUserConfig getConfig()
 */
class SprykerBladeFxUserDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const BLADE_FX_CLIENT = 'BLADE_FX_CLIENT';

    /**
     * @var string
     */
    public const SESSION_CLIENT = 'SESSION_CLIENT';

    /**
     * @uses \Spryker\Zed\Http\Communication\Plugin\Application\HttpApplicationPlugin::SERVICE_REQUEST_STACK
     *
     * @var string
     */
    public const SERVICE_REQUEST_STACK = 'request_stack';

    /**
     * @var string
     */
    public const BLADE_FX_USER_HANDLER_PLUGINS = 'BLADE_FX_USER_HANDLER_PLUGINS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addBladeFxClient($container);
        $container = $this->addSessionClient($container);
        $container = $this->addBladeFxUserHandlerPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = $this->addRequestStackService($container);
        $container = $this->addSessionClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBladeFxClient(Container $container): Container
    {
        $container->set(
            static::BLADE_FX_CLIENT,
            static function (): ReportsApiClientInterface {
                return new ReportsApiClient();
            },
        );

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
    public function addBladeFxUserHandlerPlugins(Container $container): Container
    {
        $container->set(static::BLADE_FX_USER_HANDLER_PLUGINS, function () {
            if ($this->getConfig()->getMarketplaceInstallation()) {
                return $this->getBladeFxUserHandlerPlugins();
            }

            return '';
        });

        return $container;
    }

    /**
     * @return array
     */
    protected function getBladeFxUserHandlerPlugins(): array
    {
        return [
            new B2CCreateBfxUserOnBfxPlugin(),
            new B2CUpdateBfxUserOnBfxPlugin(),
            new B2CDeleteBfxUserOnBfxPlugin(),
        ];
    }
}
