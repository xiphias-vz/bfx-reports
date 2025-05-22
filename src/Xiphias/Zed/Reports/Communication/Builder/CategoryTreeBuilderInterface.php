<?php


namespace Xiphias\Zed\Reports\Communication\Builder;

interface CategoryTreeBuilderInterface
{
    /**
     * @param array $categories
     *
     * @return array
     */
    public function buildCategoryTree(array $categories): array;
}
