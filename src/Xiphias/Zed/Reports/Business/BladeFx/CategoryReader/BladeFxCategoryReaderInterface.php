<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\CategoryReader;

use Xiphias\BladeFxApi\DTO\BladeFxCategoriesListResponseTransfer;
use Generated\Shared\Transfer\CategoryReaderRequestTransfer;

interface BladeFxCategoryReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CategoryReaderRequestTransfer $readerRequestTransfer
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxCategoriesListResponseTransfer
     */
    public function getAllCategories(CategoryReaderRequestTransfer $readerRequestTransfer): BladeFxCategoriesListResponseTransfer;
}
