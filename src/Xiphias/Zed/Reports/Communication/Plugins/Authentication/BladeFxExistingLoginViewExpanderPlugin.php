<?php

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\Plugins\Authentication;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Symfony\Component\HttpFoundation\Request;
use Xiphias\Zed\Reports\Communication\Plugins\ReportsViewExpanderPluginInterface;

/**
 * @method \Xiphias\Zed\Reports\Communication\ReportsCommunicationFactory getFactory()
 */
class BladeFxExistingLoginViewExpanderPlugin extends AbstractPlugin implements ReportsViewExpanderPluginInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param array $viewData
     *
     * @return array<string, string>
     */
    public function expand(Request $request, array $viewData): array
    {
        $viewData['isLoggedInBladeFx'] = $this->getFactory()->getSessionClient()->has($this->getFactory()->getConfig()->getBfxTokenSessionKey());

        return $viewData;
    }
}
