<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\CategoryReader;

use Generated\Shared\Transfer\CategoryReaderRequestTransfer;
use Xiphias\BladeFxApi\BladeFxApiClientInterface;
use Xiphias\BladeFxApi\DTO\BladeFxCategoriesListResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxGetCategoriesListRequestTransfer;
use Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class BladeFxCategoryReader implements BladeFxCategoryReaderInterface
{
    /**
     * @var \Xiphias\BladeFxApi\BladeFxApiClientInterface
     */
    protected BladeFxApiClientInterface $apiClient;

    /**
     * @var \Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface
     */
    protected TokenResolverInterface $tokenResolver;

    /**
     * @var \Xiphias\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $config;

    /**
     * @param \Xiphias\BladeFxApi\BladeFxApiClientInterface $apiClient
     * @param \Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface $tokenResolver
     * @param \Xiphias\Zed\Reports\ReportsConfig $config
     */
    public function __construct(
        BladeFxApiClientInterface $apiClient,
        TokenResolverInterface $tokenResolver,
        ReportsConfig $config
    ) {
        $this->apiClient = $apiClient;
        $this->tokenResolver = $tokenResolver;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\CategoryReaderRequestTransfer $readerRequestTransfer
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxCategoriesListResponseTransfer
     */
    public function getAllCategories(CategoryReaderRequestTransfer $readerRequestTransfer): BladeFxCategoriesListResponseTransfer
    {
        $categories = $this->apiClient->sendGetCategoriesListRequest(
            $this->buildAuthenticatedCategoriesListRequestTransfer($readerRequestTransfer),
            true,
        );

        $categoryList = $categories->getCategoriesList();

        foreach ($categoryList as $category) {
            if ($category->getCatId() == $readerRequestTransfer->getActiveCategory()) {
                $category->setIsActiveTree(true);
            }
        }

        $categories->setCategoriesList($categoryList);

        return $categories;
    }

    /**
     * @param \Generated\Shared\Transfer\CategoryReaderRequestTransfer $readerRequestTransfer
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetCategoriesListRequestTransfer
     */
    protected function buildAuthenticatedCategoriesListRequestTransfer(
        CategoryReaderRequestTransfer $readerRequestTransfer
    ): BladeFxGetCategoriesListRequestTransfer {
        return (new BladeFxGetCategoriesListRequestTransfer())
            ->setCatId($readerRequestTransfer->getActiveCategory() ?? $this->config->getDefaultCategoryIndex())
            ->setReturnType($this->config->getReturnTypeJson())
            ->setAccessToken($this->tokenResolver->resolveToken());
    }
}
