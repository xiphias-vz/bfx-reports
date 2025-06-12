<?php


namespace Xiphias\Zed\Reports\Business\Builder;

use Symfony\Component\HttpFoundation\Request;

interface CategoryTreeBuilderInterface
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function buildCategoryTree(Request $request): array;

    /**
     * @param array $categories
     *
     * @return array
     */
    public function assembleCategoryTree(array $categories): array;
}
