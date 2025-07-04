<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\Controller;

use Generated\Shared\Transfer\BladeFxReportTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method \Xiphias\Zed\Reports\Communication\ReportsCommunicationFactory getFactory()
 * @method \Xiphias\Zed\Reports\Business\ReportsFacadeInterface getFacade()
 */
class IndexController extends AbstractController
{
    /**
     * @var string
     */
    protected const ROOT_MODULE_URL = '/reports';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request): array
    {
        $categoryTree = $this
            ->getFacade()
            ->buildCategoryTree($request);

        $reportsTable = $this->getFactory()
            ->createReportsTable();

        $config = $this->getFactory()->getConfig();

        $categoryQueryKey = $config->getCategoryQueryKey();
        $defaultCategoryIndex = $config->getDefaultCategoryIndex();

        if (!$this->isLoggedInBladeFx()) {
            $this->createErrorMessage();
        }

        return $this->viewResponse([
            'categoryTree' => $categoryTree,
            'reportsTable' => $reportsTable->render(),
            'currentCategoryId' => $request->query->getInt($categoryQueryKey, $defaultCategoryIndex),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function reportsTableAction(): JsonResponse
    {
        $reportsTable = $this->getFactory()->createReportsTable();

        return $this->jsonResponse(
            $reportsTable->fetchData(),
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function salesReportsTableAction(Request $request): JsonResponse
    {
        $reportTable = $this
            ->getFactory()
            ->createSalesReportsTable($this->formatRequestParameters($request));

        return new JsonResponse(
            $reportTable->fetchData(),
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function favoriteReportAction(Request $request): RedirectResponse
    {
        $this->getFacade()->processSetFavoriteReportRequest($request);

        return $this->redirectResponse($request->headers->get('referer'));
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function previewAction(Request $request): JsonResponse
    {
        $mapper = $this->getFactory()->createReportsMapper();
        $paramTransfer = $mapper->mapPreviewParametersToNewParameterTransfer($request);
        $responseTransfer = $this->getFacade()->getReportPreviewURL($paramTransfer);

        return $this->jsonResponse([
            'iframeUrl' => $mapper->assemblePreviewUrl($responseTransfer),
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function downloadAction(Request $request): Response
    {
        $reportName = $request->query->get(BladeFxReportTransfer::REP_NAME);
        $reportId = $this->castId($request->query->get(BladeFxReportTransfer::REP_ID));
        $format = $request->query->get('format');

        if (!$format) {
            $this->addErrorMessage('Please choose a format to download the report in');

            return $this->RedirectResponse($request->headers->get('referer'));
        }

        $paramListTransfer = $this->getFactory()->createReportsMapper()->mapDownloadParametersToNewParameterListTransfer($request);
        $responseTransfer = $this->getFacade()->getReportByIdInWantedFormat($reportId, $format, $paramListTransfer);
        $headers = $this->getFactory()->createDownloadHeadersBuilder()->buildDownloadHeaders($format, $reportId, $reportName);

        return new Response(
            $responseTransfer->getReport(),
            200,
            $headers,
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function reportIframeAction(Request $request): JsonResponse
    {
        $reportId = (int)$request->get(BladeFxReportTransfer::REP_ID);
        $reportParamFormTransfer = $this->getFacade()->getReportParamForm($reportId);

        return $this->jsonResponse([
           'iframeUrl' => $reportParamFormTransfer->getIframeUrl(),
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    protected function formatRequestParameters(Request $request): array
    {
        return $this->getFactory()->createParameterFormatter()->formatRequestParameters($request);
    }

    /**
     * @return bool
     */
    protected function isLoggedInBladeFx(): bool
    {
        return $this->getFactory()->getSessionClient()->has(
            $this->getFactory()->getConfig()->getBfxTokenSessionKey()
        );
    }

    /**
     * @return void
     */
    protected function createErrorMessage(): void
    {
        $this->addErrorMessage('bfx.reports.login_failed');
    }
}
