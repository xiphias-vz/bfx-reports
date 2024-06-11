<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\User\Communication;

use Pyz\Zed\User\UserDependencyProvider;
use Spryker\Zed\User\Communication\UserCommunicationFactory as SprykerUserCommunicationFactory;
use Xiphias\Zed\Reports\Business\ReportsFacadeInterface;

/**
 * @method \Pyz\Zed\User\UserConfig getConfig()
 * @method \Spryker\Zed\User\Business\UserFacadeInterface getFacade()
 * @method \Spryker\Zed\User\Persistence\UserQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\User\Persistence\UserRepositoryInterface getRepository()
 */
class UserCommunicationFactory extends SprykerUserCommunicationFactory
{
    /**
     * @return \Xiphias\Zed\Reports\Business\ReportsFacadeInterface
     */
    public function getBladeFxFacade(): ReportsFacadeInterface
    {
        return $this->getProvidedDependency(UserDependencyProvider::BLADE_FX_FACADE);
    }
}
