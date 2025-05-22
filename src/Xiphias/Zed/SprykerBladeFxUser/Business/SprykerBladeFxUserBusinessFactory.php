<?php


namespace Xiphias\Zed\SprykerBladeFxUser\Business;

use Spryker\Client\Session\SessionClientInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Xiphias\Client\ReportsApi\ReportsApiClientInterface;
use Xiphias\Zed\SprykerBladeFxUser\Business\Checker\BladeFXUserChecker;
use Xiphias\Zed\SprykerBladeFxUser\Business\Checker\BladeFXUserCheckerInterface;
use Xiphias\Zed\SprykerBladeFxUser\Business\Handler\BladeFxUserHandler;
use Xiphias\Zed\SprykerBladeFxUser\Business\Handler\BladeFxUserHandlerInterface;
use Xiphias\Zed\SprykerBladeFxUser\SprykerBladeFxUserDependencyProvider;

/**
 * @method \Xiphias\Zed\SprykerBladeFxUser\SprykerBladeFxUserConfig getConfig()
 * @method \Xiphias\Zed\SprykerBladeFxUser\Persistence\SprykerBladeFxUserRepositoryInterface getRepository();
 */
class SprykerBladeFxUserBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Xiphias\Zed\SprykerBladeFxUser\Business\Handler\BladeFxUserHandlerInterface
     */
    public function createBladeFxUserHandler(): BladeFxUserHandlerInterface
    {
        return new BladeFxUserHandler(
            $this->createBladeFXUserChecker(),
            $this->getSessionClient(),
            $this->getBladeFxClient(),
            $this->getBladeFxUserHandlerPlugins(),
            $this->getConfig(),
        );
    }

    /**
     * @return \Xiphias\Zed\SprykerBladeFxUser\Business\Checker\BladeFXUserCheckerInterface
     */
    public function createBladeFXUserChecker(): BladeFXUserCheckerInterface
    {
        return new BladeFXUserChecker(
            $this->getRepository(),
        );
    }

    /**
     * @return \Spryker\Client\Session\SessionClientInterface
     */
    protected function getSessionClient(): SessionClientInterface
    {
        return $this->getProvidedDependency(SprykerBladeFxUserDependencyProvider::SESSION_CLIENT);
    }

    /**
     * @return \Xiphias\Client\ReportsApi\ReportsApiClientInterface
     */
    protected function getBladeFxClient(): ReportsApiClientInterface
    {
        return $this->getProvidedDependency(SprykerBladeFxUserDependencyProvider::BLADE_FX_CLIENT);
    }

    /**
     * @return array<\Xiphias\Zed\SprykerBladeFxUser\Communication\Plugin\User\BfxUserHandlerPluginInterface>
     */
    public function getBladeFxUserHandlerPlugins(): array
    {
        return $this->getProvidedDependency(SprykerBladeFxUserDependencyProvider::BLADE_FX_USER_HANDLER_PLUGINS);
    }
}
