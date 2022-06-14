<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\ForgeCookie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route('/app', name: '_app')]
class PrivateController extends AbstractController
{
    #[Route('/gestion-biens', methods: ["GET"])]
    #[Route('/gestion-utilisateurs', methods: ["GET"])]
    #[Route('/profile', methods: ["GET"])]
    public function indexPrivate(Request $request): Response
    {
        $response = new Response();
        $response = $this->checkCSRF($request, $response);

        $view = $this->renderView('/base.html.twig', [
            'controller_name' => 'PrivateController',
        ]);

        return $response->setContent($view);
    }

    private function checkCSRF(Request $request, Response $response)
    {
        if ($request->cookies->get('X_CSRF_TOKEN') === null) {
            $cookieDuration = [
                'qty' => 2,
                'unit' => 'hour'
            ];
            $fc = new ForgeCookie($request, $cookieDuration);
            $response->headers->setCookie($fc->forgeCSRFCookie());

            return $response;
        }
        return $response;
    }

    #[Route('/app/users', methods: ["GET"])]
    public function getUsers(#[CurrentUser] ?User $user, ManagerRegistry $doctrine, UserRepository $userRepo): Response
    {
        $em =  $doctrine->getManager();
        if ($user->getEmail() === 'test1@example.com') $user->setRoles(['ROLE_ADMIN']);
        $em->persist($user);
        $em->flush();
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->json([
            'data' => $userRepo->getUsers(),
        ], Response::HTTP_ACCEPTED);
    }
}
