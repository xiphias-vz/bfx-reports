<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\CategoryReader;

use Generated\Shared\Transfer\CategoryReaderRequestTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxCategoriesListResponseTransfer;

interface BladeFxCategoryReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CategoryReaderRequestTransfer $readerRequestTransfer
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxCategoriesListResponseTransfer
     */
    public function getAllCategories(CategoryReaderRequestTransfer $readerRequestTransfer): BladeFxCategoriesListResponseTransfer;
}
