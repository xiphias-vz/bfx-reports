<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SecurityGui\Communication\Plugin\Security\Handler;

use Spryker\Zed\SecurityGui\Communication\Plugin\Security\Handler\UserAuthenticationSuccessHandler as SprykerUserAuthenticationSuccessHandler;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * @method \Pyz\Zed\SecurityGui\Communication\SecurityGuiCommunicationFactory getFactory()
 * @method \Pyz\Zed\SecurityGui\SecurityGuiConfig getConfig()
 * @method \Spryker\Zed\SecurityGui\Business\SecurityGuiFacadeInterface getFacade()
 */
class UserAuthenticationSuccessHandler extends SprykerUserAuthenticationSuccessHandler
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token): RedirectResponse
    {
        /** @var \Spryker\Zed\SecurityGui\Communication\Security\User $user */
        $user = $token->getUser();
        $this->getFacade()->authenticateUser($user->getUserTransfer());
        $this->getFactory()->getReportsFacade()->authenticateBladeFxUser($request, $user->getUserTransfer());

        return $this->createRedirectResponse($request);
    }
}
