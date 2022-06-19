<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Entity\PhotoBien;
use App\Repository\BienRepository;
use App\Repository\PhotoBienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ForgeCookie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PublicController extends AbstractController
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
    #[Route('/nos-biens', methods: ["GET"])]
    #[Route('/bien/{id}', methods: ["GET"])]
    public function indexPublic(Request $request): Response
    {
        $response = new Response();
        $response = $this->checkCSRF($request, $response);

        $view = $this->renderView('/base.html.twig');

        return $response->setContent($view);
    }

    #[Route('/api/bien/{id}', methods: ["GET"])]
    public function getBien(int $id, ManagerRegistry $doctrine): Response
    {
        $bien = $doctrine->getRepository(Bien::class)->find($id);
        $photos = $doctrine->getRepository(PhotoBien::class)->findBy(['bien_id' => $id]);

        return $this->json([
            'data' => $bien,
            'photos' => $photos
        ], Response::HTTP_ACCEPTED, [], ['groups' => 'bien']);
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

    #[Route('/liste-biens', methods: ["GET"])]
    public function getBiens(Request $request, BienRepository $bienRepo): Response
    {
        $pageNumber = $request->query->get('page') ?? 1;
        $resultsPerPage = $request->query->get('perPage') ?? 10;
        $baseData = $bienRepo->getBiensWithFilters($request, $pageNumber, $resultsPerPage);
        $data = $baseData['query']->getResult();
        $results = [];
        foreach ($data as $val) {
            $results[] = [
                'id' => $val->getId(),
                'adresse' => $val->getAdresse(),
                'type' => $val->getType(),
                'prix' => $val->getPrix(),
                'surface' => $val->getSurface(),
                'carrez' => $val->getCarrez(),
                'vendu' => $val->isEstVendu(),
                'titre' => $val->getTitre(),
                'description' => $val->getDescription(),
                'date_creation' => $val->getDateCreation(),
                'date_modification' => $val->getDateModification(),
                'reponsable' => $val->getResponsable()->getEmail(),
                'photo' => $val->getPhotoBiens()
            ];
        }
        $paginationData = [
            'pages' => round($baseData['maxResult'] / $resultsPerPage),
            'baseUrl' => $request->getPathInfo(),
        ];

        return $this->json([
            'data' => $results,
            'pagination' => $paginationData,
            'type_bien' => Bien::TYPES,
            'type_bati' => Bien::TYPES_BATI
        ], Response::HTTP_ACCEPTED, [], ['groups' => 'bien']);
    }
}
