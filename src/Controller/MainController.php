<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Carbon\Carbon;

class MainController extends AbstractController
{
    #[Route('/', methods: ["GET"])]
    #[Route('/senregistrer', methods: ["GET"])]
    #[Route('/qui-sommes-nous', methods: ["GET"])]
    #[Route('/a-propos', methods: ["GET"])]
    #[Route('/nous-contacter', methods: ["GET"])]
    #[Route('/rapporter-erreur', methods: ["GET"])]
    #[Route('/nous-contacter', methods: ["GET"])]
    #[Route('/senregistrer', methods: ["GET"])]
    #[Route('/connexion', methods: ["GET"])]
    #[Route('/senregistrer', methods: ["GET"])]
    #[Route('/mot-de-passe-oublie', methods: ["GET"])]
    #[Route('/biens', methods: ["GET"])]
    public function index(Request $request): Response
    {
        $response = new Response();
        if ($request->cookies->get('X_CSRF_TOKEN') === null) {
            $csrf_manager = new CsrfTokenManager();
            $session = $request->getSession();
            $session->set('X_CSRF_TOKEN', $csrf_manager->getToken('X_CSRF_TOKEN'));
            $cookie = Cookie::create('X_CSRF_TOKEN')
                ->withValue($session->get('X_CSRF_TOKEN'))
                ->withExpires(strtotime(Carbon::now()->add(2, 'hour')))
                ->withSameSite('strict')
                ->withHttpOnly(true)
                ->withSecure(true);
            $response->headers->setCookie($cookie);
        }

        $view = $this->renderView('/base.html.twig', [
            'controller_name' => 'MainController'
        ]);

        return $response->setContent($view);
    }
}
