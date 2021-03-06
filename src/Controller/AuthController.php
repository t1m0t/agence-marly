<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\Service\ForgeCookie;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

class AuthController extends AbstractController
{
    #[Route('/auth/login/init', name: 'app_auth_login_init', methods: ['GET'])]
    public function initLogin(Request $request, LoggerInterface $logger): RedirectResponse
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
            $cookieDuration = [
                'qty' => 2,
                'unit' => 'hour'
            ];
            $fc = new ForgeCookie($request, $cookieDuration);
            return $fc->CSRFWithRedirect('/connexion');
        } else return new RedirectResponse('/connexion');
    }

    #[Route('/auth/login', name: 'app_auth_login_post', methods: ['POST'])]
    public function postLogin(#[CurrentUser] ?User $user, Request $request): Response|RedirectResponse
    {
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        } else {
            $cookieDuration = [
                'qty' => 2,
                'unit' => 'hour'
            ];
            $fc = new ForgeCookie($request, $cookieDuration, $user);
            return $fc->AuthCookieWithRedirect('/');
        }
    }

    #[Route('/auth/logout', name: 'app_auth_logout', methods: ['GET'])]
    public function logout(Request $request): Response|RedirectResponse
    {
        $response = new RedirectResponse('/');
        $session = $request->getSession();
        $session->remove('X_AUTH_TOKEN');
        $response->headers->clearCookie('X_AUTH_TOKEN');
        $response->headers->clearCookie('IS_LOGGED_IN');
        $response->headers->clearCookie('IS_ADMIN');

        return $response;
    }


    #[Route('/auth/register', name: 'app_auth_register_post', methods: ['POST'])]
    public function register(#[CurrentUser] ?User $user, Request $request, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine): Response|RedirectResponse
    {
        if (null === $user) {
            $entityManager = $doctrine->getManager();
            $data = json_decode($request->getContent());
            $user = new User();
            $user->setEmail($data->email);
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $data->password
            );
            $user->setPassword($hashedPassword);
            $entityManager->persist($user);
            $entityManager->flush();

            $cookieDuration = [
                'qty' => 2,
                'unit' => 'hour'
            ];
            $fc = new ForgeCookie($request, $cookieDuration);
            return $fc->AuthCookieWithRedirect('/');
        } else {
            return new RedirectResponse('/');
        }
    }
}
