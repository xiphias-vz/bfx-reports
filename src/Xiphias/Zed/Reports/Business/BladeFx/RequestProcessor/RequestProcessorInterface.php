<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\RequestProcessor;

use Symfony\Component\HttpFoundation\Request;

interface RequestProcessorInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function processCategoryTreeListRequest(Request $request): array;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return void
     */
    public function processSetFavoriteReportRequest(Request $request): void;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string|null $attribute
     *
     * @return array
     */
    public function processGetReportsRequest(Request $request, ?string $attribute = ''): array;
}
