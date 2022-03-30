<?php

namespace App\Controller;

use App\Entity\Chauffeur;
use App\Form\ChauffeurType;
use App\Repository\ChauffeurRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chauffeur')]
class ChauffeurController extends AbstractController
{
    #[Route('/', name: 'app_chauffeur_index', methods: ['GET'])]
    public function index(ChauffeurRepository $chauffeurRepository): Response
    {
        return $this->json($chauffeurRepository->findAll());
    }

    #[Route('/new', name: 'app_chauffeur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ChauffeurRepository $chauffeurRepository): Response
    {
        $chauffeur = new Chauffeur();
        $form = $this->createForm(ChauffeurType::class, $chauffeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chauffeurRepository->add($chauffeur);
            return $this->redirectToRoute('app_chauffeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chauffeur/new.html.twig', [
            'chauffeur' => $chauffeur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chauffeur_show', methods: ['GET'])]

    public function show(Chauffeur $chauffeur): Response
    {

        return   $this->json($chauffeur);
    }

    #[Route('/{id}/edit', name: 'app_chauffeur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chauffeur $chauffeur, ChauffeurRepository $chauffeurRepository): Response
    {
        $form = $this->createForm(ChauffeurType::class, $chauffeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chauffeurRepository->add($chauffeur);
            return $this->redirectToRoute('app_chauffeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chauffeur/edit.html.twig', [
            'chauffeur' => $chauffeur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chauffeur_delete', methods: ['POST'])]
    public function delete(Request $request, Chauffeur $chauffeur, ChauffeurRepository $chauffeurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $chauffeur->getId(), $request->request->get('_token'))) {
            $chauffeurRepository->remove($chauffeur);
        }

        return $this->redirectToRoute('app_chauffeur_index', [], Response::HTTP_SEE_OTHER);
    }

    // show  chauffeur  costum api
    #[Route('/{id}/api', name: 'app_chauffeur_api', methods: ['GET', 'POST'])]
    public function ChauffeurApi(Request $request): Response
    {


        $data = $this->getDoctrine()
            ->getRepository(Chauffeur::class)
            ->findAll();

        $chauf = [];

        foreach ($data as $da) {
            $chauf[] = [
                'id' => $da->getId(),
                'Nom' => $da->getNom(),
                'prenom' => $da->getPrenom(),
                'email' => $da->getEmail(),
                'tel' => $da->getTelephone(),
                'date_permis' => $da->getDatePermis(),
            ];
        }



        return  $this->json($chauf);
    }
    // create new chauffeur  custom api 
    #[Route('/api/Chauffeurnew', name: 'app_chauffeur_new_api', methods: ['POST'])]
    public function Chauffeurnew(Request $request): Response
    {
        $param = json_decode($request->getContent(), true);


        $chauffeur = new Chauffeur();

        $chauffeur->setNom($param['nom']);
        $chauffeur->setPrenom($param['prenom']);
        $chauffeur->setEmail($param['email']);
        $chauffeur->setTelephone($param['telephone']);





        // $chauffeur->setNom($request->request->get('nom'));
        // $chauffeur->setPrenom($request->request->get('prenom'));
        // $chauffeur->setEmail($request->request->get('email'));
        // $chauffeur->setTelephone($request->request->get('telephone'));

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($chauffeur);
        $entityManager->flush();


        return $this->json('Created new chauffeur successfully with id ' . $chauffeur->getId());
    }



    // delete chauffeur
    #[Route('api/delete_chauffeur_api/{id}', name: 'app_delete_chauffeur_api', methods: ['DELETE'])]
    public function delete_chauffeur_api($id): Response
    {
        $chauffeur = $this->getDoctrine()->getRepository(Chauffeur::class)->find($id);

        $data = $this->getDoctrine()->getManager();
        $data->remove($chauffeur);
        $data->flush();


        return $this->json('delete enew chauffeur successfully with id ' . $chauffeur->getId());
    }

    #[Route('api/Chauffeurupdate/{id}', name: 'app_chauffeur_update_api', methods: ['PUT'])]
    public function Chauffeurupdate(Request $request, $id): Response

    {
        $chauffeur = $this->getDoctrine()->getRepository(Chauffeur::class)->find($id);
        $param = json_decode($request->getContent(), true);



        $chauffeur->setNom($param['nom']);
        $chauffeur->setPrenom($param['prenom']);
        $chauffeur->setEmail($param['email']);
        $chauffeur->setTelephone($param['telephone']);

        $data = $this->getDoctrine()->getManager();
        $data->persist($chauffeur);
        $data->flush();

        return $this->json('update  chauffeur successfully ');
    }
}