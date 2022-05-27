<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\Service\ForgeCookie;
use Psr\Log\LoggerInterface;

class AuthController extends AbstractController
{
    #[Route('/auth/login', name: 'app_auth_login_get', methods: ['GET'])]
    public function getLogin(Request $request, LoggerInterface $logger): Response
    {
        // on vérifie si l'utilisateur possède déjà un auth token
        if ($request->cookies->get('X_AUTH_TOKEN') !== null) {
            $session = $request->getSession();
            // déjà authentifié
            if ($session->get('X_AUTH_TOKEN') === $request->cookies->get('X_AUTH_TOKEN')) return new RedirectResponse('/');
            // on a trouvé un X_AUTH_TOKEN mais il ne match pas avec celui stocké en session (forgé côté client ?)
            else {
                // on supprime le token
                $request->cookies->remove('X_AUTH_TOKEN');
                // on log pour détercter ce type de comportement
                $logger->warning('X_AUTH_TOKEN exists on the client but does\'t match server side (client side forged?)');
                new RedirectResponse('/connexion');
            }
        } else if ($request->cookies->get('X_CSRF_TOKEN') === null) {
            $fc = new ForgeCookie($request);
            return $fc->CSRFWithRedirect('/connexion');
        } else return new RedirectResponse('/connexion');
    }

    #[Route('/auth/login', name: 'app_auth_login_post', methods: ['POST'])]
    public function postLogin(#[CurrentUser] ?User $user, Request $request): Response
    {
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        } else {
            $fc = new ForgeCookie($request);
            return $fc->AuthCookieWithRedirect('/');
        }
    }
}