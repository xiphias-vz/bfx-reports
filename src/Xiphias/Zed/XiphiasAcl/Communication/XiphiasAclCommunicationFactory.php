<?php

declare(strict_types=1);

namespace Xiphias\Zed\XiphiasAcl\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Xiphias\Zed\XiphiasAcl\XiphiasAclDependencyProvider;

class XiphiasAclCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Spryker\Zed\Acl\Business\AclFacadeInterface
     */
    public function getAclFacade()
    {
        return $this->getProvidedDependency(XiphiasAclDependencyProvider::FACADE_ACL);
    }
}
