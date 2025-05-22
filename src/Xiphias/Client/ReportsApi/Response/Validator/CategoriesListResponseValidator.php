<?php


namespace Xiphias\Client\ReportsApi\Response\Validator;

use Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class CategoriesListResponseValidator extends AbstractResponseValidator
{
    /**
     * @return string
     */
    public function getResponseTransferClass(): string
    {
        return BladeFxCategoriesListResponseTransfer::class;
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer $responseTransfer
     *
     * @return bool
     */
    protected function validateResponse(AbstractTransfer $responseTransfer): bool
    {
        try {
            foreach ($responseTransfer->getCategoriesList() as $category) {
                $category
                    ->requireCatId();
            }
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
