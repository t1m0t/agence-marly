<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Entity\PhotoBien;
use App\Entity\RendezVous;
use App\Entity\User;
use App\Repository\PhotoBienRepository;
use App\Repository\RendezVousRepository;
use App\Repository\UserRepository;
use App\Service\ForgeCookie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/app', name: '_app')]
class PrivateController extends AbstractController
{
    #[Route('/gestion-biens', methods: ["GET"])]
    #[Route('/gestion-utilisateurs', methods: ["GET"])]
    #[Route('/profile', methods: ["GET"])]
    #[Route('/prendre-rendez-vous', methods: ["GET"])]
    #[Route('/mes-rendez-vous', methods: ["GET"])]
    #[Route('/edit-bien/{id}', methods: ["GET"])]
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

    #[Route('/users', methods: ["GET"])]
    public function getUsers(#[CurrentUser] ?User $user, ManagerRegistry $doctrine, UserRepository $userRepo): Response
    {
        // setting an admin user
        $em =  $doctrine->getManager();
        if ($user->getEmail() === 'test1@example.com') $user->setRoles(['ROLE_ADMIN']);
        $em->persist($user);
        $em->flush();

        // checking for actual role
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->json([
            'data' => $userRepo->getUsers(),
        ], Response::HTTP_ACCEPTED);
    }

    #[Route('/prendre-rendez-vous', methods: ["POST"])]
    public function postPrendreRendezVous(#[CurrentUser] ?User $user, ManagerRegistry $doctrine, Request $request): Response
    {
        // user is not admin
        if (!in_array('ROLE_ADMIN', $user->getRoles())) {
            try {
                $content = json_decode($request->getContent());
                $em =  $doctrine->getManager();

                $rendezVous = new RendezVous();
                $rendezVous->setMessage($content->message);
                $rendezVous->setAnnee($content->annee);
                $rendezVous->setMois($content->mois);
                $rendezVous->setJour($content->jour);
                $rendezVous->setHeure($content->heure);
                $rendezVous->setMinute($content->minute);
                $rendezVous->setUser($user);

                $em->persist($rendezVous);
                $em->flush();
                return $this->json([
                    'message' => 'rendez-vous créé avec succes',
                ], Response::HTTP_CREATED);
            } catch (Exception $e) {
                return $this->json([
                    'message' => 'échec de la prise de rendez-vous',
                    'erreur' => $e
                ], Response::HTTP_SERVICE_UNAVAILABLE);
            }
        } else return $this->json([
            'message' => 'admin user not allowed to post rendez-vous',
        ], Response::HTTP_UNAUTHORIZED);
    }

    #[Route('/liste-rendez-vous', methods: ["GET"])]
    public function getMesRendezVous(#[CurrentUser] ?User $user, RendezVousRepository $repo): Response
    {
        // user is not admin
        if (!in_array('ROLE_ADMIN', $user->getRoles())) {
            return $this->json([
                'data' => $repo->getRendezVous($user->getId()),
            ], Response::HTTP_ACCEPTED);
        } else return $this->json([
            'message' => 'admin user not allowed to post rendez-vous',
        ], Response::HTTP_UNAUTHORIZED);
    }

    #[Route('/edit-bien/{id}', methods: ["POST"])]
    public function postEditBien(int $id, ManagerRegistry $doctrine, Request $request, ValidatorInterface $validator): Response
    {
        try {
            $content = json_decode($request->getContent());
            dd($content);
            $em =  $doctrine->getManager();
            $bien = $doctrine->getRepository(Bien::class)->find($id);
            if ($content->adresse !== null) $bien->setAdresse($content->adresse);
            if ($content->type !== null) $bien->setType($content->type);
            if ($content->prix !== null) $bien->setPrix($content->prix);
            if ($content->surface !== null) $bien->setSurface($content->surface);
            if ($content->carrez !== null) $bien->setCarrez($content->carrez);
            if ($content->titre !== null) $bien->setTitre($content->titre);
            if ($content->description !== null) $bien->setDescription($content->description);
            if ($content->typeBien !== null) $bien->setType($content->typeBien);
            if ($content->typeBati !== null) $bien->setTypeBien($content->typeBati);
            if ($content->estVendu !== null) $bien->setEstVendu($content->estVendu === 'Oui' ? true : false);
            if ($content->photosBien !== null) {
                foreach ($content->photosBien as $photo) {
                    $editPhoto = $doctrine->getRepository(PhotoBien::class)->find($photo->id);
                    if ($photo->estPrincipale === true) $editPhoto->setEstPrincipale(true);
                    else $editPhoto->setEstPrincipale(false);
                    $em->persist($editPhoto);
                    $em->flush();
                }
            }

            $errors = $validator->validate($bien);
            if (count($errors) > 0) {
                return $this->json([
                    'message' => 'erreur de validation du bien',
                    'error' => $errors
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            } else {
                $em->persist($bien);
                $em->flush();
                return new RedirectResponse('/api/bien/' . $id);
            }
        } catch (Exception $e) {
            return $this->json([
                'message' => 'échec de l\'enregistrement du bien',
                'erreur' => $e
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }

    #[Route('/ajouter-photo/{id}', methods: ["POST"])]
    public function ajouterPhoto(int $id, ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger)
    {
        try {
            $image = $request->files->get('photo');
            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
            $image->move(
                $this->getParameter('images_directory'),
                $newFilename
            );
            $em =  $doctrine->getManager();
            $bien = $doctrine->getRepository(Bien::class)->find($id);
            $photoBien = new PhotoBien();
            $photoBien->setBien($bien);
            $photoBien->setFileName($newFilename);
            $em->persist($photoBien);
            $em->flush();

            $photoBien = $doctrine->getRepository(Bien::class)->find($photoBien->getId());

            return $this->json([
                'message' => 'Image ajoutée avec succés',
                'photoBien' => $bien->getPhotoBiens()
            ], Response::HTTP_CREATED, [], ['groups' => 'bien']);
        } catch (FileException $e) {
            return $this->json([
                'message' => 'Echec de l\'ajout de l\'image',
                'erreur' => $e
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }

    #[Route('/supprimer-photo', methods: ["POST"])]
    public function supprimerPhoto(ManagerRegistry $doctrine, Request $request, PhotoBienRepository $photoRepo)
    {
        $content = json_decode($request->getContent());
        $photo = $doctrine->getRepository(PhotoBien::class)->find($content->id);
        $bien = $photo->getBien();
        $photoRepo->remove($photo, true);

        return $this->json([
            'message' => 'Image supprimée avec succés',
            'photoBien' => $bien->getPhotoBiens()
        ], Response::HTTP_OK, [], ['groups' => 'bien']);
    }
}
