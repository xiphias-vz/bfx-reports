<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\SecurityGui\Communication;

use Spryker\Zed\SecurityGui\Communication\SecurityGuiCommunicationFactory as SprykerSecurityGuiCommunicationFactory;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Xiphias\Zed\Reports\Business\ReportsFacadeInterface;
use Xiphias\Zed\SecurityGui\Communication\Plugin\Security\Handler\UserAuthenticationSuccessHandler;
use Xiphias\Zed\SecurityGui\SecurityGuiDependencyProvider;

/**
 * @method \Pyz\Zed\SecurityGui\SecurityGuiConfig getConfig()
 * @method \Spryker\Zed\SecurityGui\Business\SecurityGuiFacadeInterface getFacade()
 */
class SecurityGuiCommunicationFactory extends SprykerSecurityGuiCommunicationFactory
{
    /**
     * @return \Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface
     */
    public function createUserAuthenticationSuccessHandler(): AuthenticationSuccessHandlerInterface
    {
        return new UserAuthenticationSuccessHandler();
    }

    /**
     * @return \Xiphias\Zed\Reports\Business\ReportsFacadeInterface
     */
    public function getReportsFacade(): ReportsFacadeInterface
    {
        return $this->getProvidedDependency(SecurityGuiDependencyProvider::FACADE_REPORTS);
    }
}
