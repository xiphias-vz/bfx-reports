<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\SprykerBladeFxUser\Communication;

use Spryker\Client\Session\SessionClientInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\HttpFoundation\RequestStack;
use Xiphias\Shared\Reports\ReportsConfig;
use Xiphias\Zed\SprykerBladeFxUser\SprykerBladeFxUserDependencyProvider;

class SprykerBladeFxUserCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Spryker\Client\Session\SessionClientInterface
     */
    public function getSessionClient(): SessionClientInterface
    {
        return $this->getProvidedDependency(SprykerBladeFxUserDependencyProvider::SESSION_CLIENT);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RequestStack|null
     */
    public function getRequestStackService(): ?RequestStack
    {
        return $this->getProvidedDependency(SprykerBladeFxUserDependencyProvider::SERVICE_REQUEST_STACK);
    }

    /**
     * @return \Xiphias\Shared\Reports\ReportsConfig
     */
    public function getReportsSharedConfig(): ReportsConfig
    {
        return new ReportsConfig();
    }
}
