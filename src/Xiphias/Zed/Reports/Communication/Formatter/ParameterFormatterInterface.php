<?php


namespace Xiphias\Zed\Reports\Communication\Formatter;

use Symfony\Component\HttpFoundation\Request;

interface ParameterFormatterInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function formatRequestParameters(Request $request): array;
}
