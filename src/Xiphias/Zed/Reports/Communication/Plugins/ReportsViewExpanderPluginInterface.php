<?php

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\Plugins;

use Symfony\Component\HttpFoundation\Request;

interface ReportsViewExpanderPluginInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param array $viewData
     *
     * @return array<string, string>
     */
    public function expand(Request $request, array $viewData): array;
}
