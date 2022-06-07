<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class AuthenticationController
 * @package App\Controller
 *
 * @Route("/api", name="auth_")
 */
class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login", methods={"POST"})
     * @return JsonResponse
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return new JsonResponse([$lastUsername, $error]);
    }

    /**
     * @Route("/login_check", name="login_check")
     *
     * @return JsonResponse
     */
    public function loginCheck()
    {
        $user = $this->getUser();

        return new JsonResponse([
            'user' => $user->getUserIdentifier(),
            'roles' => $user->getRoles()
        ]);
    }

    /**
     * @Route("/logout", name="logout", methods={"POST"})
     */
    public function logout()
    {

    }


}
