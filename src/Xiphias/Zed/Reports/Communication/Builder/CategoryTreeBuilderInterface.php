<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

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
