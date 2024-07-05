<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\User\Communication\Controller;

use Generated\Shared\Transfer\UserTransfer;
use Spryker\Zed\User\Communication\Controller\EditController as SprykerEditController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\User\Business\UserFacadeInterface getFacade()
 * @method \Spryker\Zed\User\Persistence\UserQueryContainerInterface getQueryContainer()
 * @method \Pyz\Zed\User\Communication\UserCommunicationFactory getFactory()
 * @method \Spryker\Zed\User\Persistence\UserRepositoryInterface getRepository()
 */
class EditController extends SprykerEditController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array
     */
    public function createAction(Request $request)
    {
        $dataProvider = $this->getFactory()->createUserFormDataProvider();

        $userForm = $this->getFactory()
            ->createUserForm(
                [],
                $dataProvider->getOptions(),
            )
            ->handleRequest($request);

        $viewData = [
            'userForm' => $userForm->createView(),
        ];

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $formData = $userForm->getData();

            $userTransfer = new UserTransfer();
            $userTransfer->fromArray($formData, true);

            $userTransfer = $this->getFacade()
                ->createUser($userTransfer);

            if ($userTransfer->getIdUser()) {
                $this->getFactory()->getBladeFxFacade()->createOrUpdateUserOnBladeFx($formData, $userTransfer);

                $this->addAclGroups($formData, $userTransfer);

                $this->addSuccessMessage(static::MESSAGE_USER_CREATE_SUCCESS);

                return $this->redirectResponse(static::USER_LISTING_URL);
            }

            $this->addErrorMessage(static::MESSAGE_USER_CREATE_ERROR);
        }

        return $this->viewResponse($viewData);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array
     */
    public function updateAction(Request $request)
    {
        $idUser = $this->castId($request->get(static::PARAM_ID_USER));

        if (!$idUser) {
            $this->addErrorMessage(static::MESSAGE_ID_USER_EXTRACT_ERROR);

            return $this->redirectResponse(static::USER_LISTING_URL);
        }

        $dataProvider = $this->getFactory()->createUserUpdateFormDataProvider();
        $providerData = $dataProvider->getData($idUser);

        if ($providerData === null) {
            $this->addErrorMessage(static::MESSAGE_USER_NOT_FOUND);

            return $this->redirectResponse(static::USER_LISTING_URL);
        }

        $userForm = $this->getFactory()
            ->createUpdateUserForm(
                $providerData,
                $dataProvider->getOptions(),
            )
            ->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $formData = $userForm->getData();
            $userTransfer = new UserTransfer();
            $userTransfer->fromArray($formData, true);
            $userTransfer->setIdUser($idUser);
            $this->getFacade()->updateUser($userTransfer);

            $this->getFactory()->getBladeFxFacade()->createOrUpdateUserOnBladeFx($formData, $userTransfer);

            $this->deleteAclGroups($idUser);
            $this->addAclGroups($formData, $userTransfer);

            $this->addSuccessMessage(static::MESSAGE_USER_UPDATE_SUCCESS);

            return $this->redirectResponse(static::USER_LISTING_URL);
        }

        return $this->viewResponse([
            'userForm' => $userForm->createView(),
        ]);
    }
}
