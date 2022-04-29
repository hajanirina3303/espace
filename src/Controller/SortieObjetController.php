<?php

namespace App\Controller;

use App\Entity\SortieObjet;
use App\Form\SortieObjetType;
use App\Repository\SortieObjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sortie/objet')]
class SortieObjetController extends AbstractController
{
    #[Route('/', name: 'sortie_objet_index', methods: ['GET'])]
    public function index(SortieObjetRepository $sortieObjetRepository): Response
    {
        return $this->render('sortie_objet/index.html.twig', [
            'sortie_objets' => $sortieObjetRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'sortie_objet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $erreur = null;
        $sortieObjet = new SortieObjet();
        $form = $this->createForm(SortieObjetType::class, $sortieObjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sortieObjet);
            if($sortieObjet->getObjet()->getResteQuantite(0) - $sortieObjet->getUniteObjet() >= 0)
            {
                $entityManager->flush();
                return $this->redirectToRoute('sortie_objet_index', [], Response::HTTP_SEE_OTHER);
            }
            else $erreur = "objet quantite insuffisant";            
        }

        return $this->renderForm('sortie_objet/new.html.twig', [
            'sortie_objet' => $sortieObjet,
            'form' => $form,
            'erreur' => $erreur
        ]);
    }

    #[Route('/{id}', name: 'sortie_objet_show', methods: ['GET'])]
    public function show(SortieObjet $sortieObjet): Response
    {
        return $this->render('sortie_objet/show.html.twig', [
            'sortie_objet' => $sortieObjet,
        ]);
    }

    #[Route('/{id}/edit', name: 'sortie_objet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SortieObjet $sortieObjet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SortieObjetType::class, $sortieObjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('sortie_objet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sortie_objet/edit.html.twig', [
            'sortie_objet' => $sortieObjet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'sortie_objet_delete', methods: ['POST'])]
    public function delete(Request $request, SortieObjet $sortieObjet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sortieObjet->getId(), $request->request->get('_token'))) {
            $entityManager->remove($sortieObjet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sortie_objet_index', [], Response::HTTP_SEE_OTHER);
    }
}
