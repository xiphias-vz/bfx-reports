<?php


namespace Xiphias\Zed\Reports\Business\Builder;

use Symfony\Component\HttpFoundation\Request;
use Xiphias\Zed\Reports\Business\BladeFx\RequestProcessor\RequestProcessorInterface;

class CategoryTreeBuilder implements CategoryTreeBuilderInterface
{
    /**
     * @param \Xiphias\Zed\Reports\Business\BladeFx\RequestProcessor\RequestProcessorInterface $requestProcessor
     */
    public function __construct(
        protected RequestProcessorInterface $requestProcessor
    ) {
    }

    /**
     * @var string
     */
    public const KEY_CATEGORY_PARENT_ID = 'catParentId';

    /**
     * @var string
     */
    public const KEY_VALUE = 'value';

    /**
     * @var string
     */
    public const KEY_PARENT_COUNT = 'parentCount';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function buildCategoryTree(Request $request): array
    {
        $categories = $this->requestProcessor->processCategoryTreeListRequest($request);

        return $this->assembleCategoryTree($categories);
    }

    /**
     * @param array $categories
     *
     * @return array
     */
    public function assembleCategoryTree(array $categories): array
    {
        $categoryTree = [];
        foreach ($categories as $category) {
            $categoryParentId = $category[static::KEY_CATEGORY_PARENT_ID];
            $categoryId = $category['catId'];
            $categoryTree[$categoryId] = [
                static::KEY_CATEGORY_PARENT_ID => null,
                static::KEY_VALUE => $category,
                static::KEY_PARENT_COUNT => 0,
            ];

            if ($categoryParentId) {
                $categoryTree[$categoryId][static::KEY_CATEGORY_PARENT_ID] = $categoryParentId;
                $categoryTree[$categoryId][static::KEY_PARENT_COUNT] = 1;
            }
        }

        foreach ($categoryTree as $id => &$category) {
            if ($category[static::KEY_CATEGORY_PARENT_ID]) {
                $category[static::KEY_PARENT_COUNT] = $this->getParentCount($category[static::KEY_CATEGORY_PARENT_ID], $categoryTree);
            }
        }

        uasort($categoryTree, function ($a, $b) {
            return $b[static::KEY_PARENT_COUNT] <=> $a[static::KEY_PARENT_COUNT];
        });

        foreach ($categoryTree as $id => &$category) {
            $parentId = $category[static::KEY_CATEGORY_PARENT_ID] ?? null;
            if ($parentId) {
                $categoryTree[$parentId]['children'][] = $category;
                unset($categoryTree[$id]);
            }
        }

        return $categoryTree;
    }

    /**
     * @param int $id
     * @param array $categories
     * @param int $parentCount
     *
     * @return int
     */
    protected function getParentCount(int $id, array $categories, int $parentCount = 1): int
    {
        $parentId = $categories[$id][static::KEY_CATEGORY_PARENT_ID] ?? null;
        if ($parentId) {
            $parentCount++;
            $parentCount = $this->getParentCount($parentId, $categories, $parentCount);
        }

        return $parentCount;
    }
}
