<?php

namespace App\Controller;

use App\Entity\Objet;
use App\Form\ObjetType;
use App\Repository\ObjetRepository;
use App\Repository\DonObjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/objet')]
class ObjetController extends AbstractController
{
    #[Route('/', name: 'objet_index', methods: ['GET'])]
    public function index(ObjetRepository $objetRepository): Response
    {
        return $this->render('objet/index.html.twig', [
            'objets' => $objetRepository->findAll(),
        ]);
    }

    #[Route('/new/{id}', name: 'objet_new', methods: ['GET', 'POST'])]
    public function new($id, Request $request, EntityManagerInterface $entityManager, DonObjetRepository $donObjetRepository, ObjetRepository $objetRepository): Response
    {
        $objet = new Objet();
        $do = $donObjetRepository->find($id);

        
        $objet->setDon($do);
        $form = $this->createForm(ObjetType::class, $objet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($objet);
            $entityManager->flush();
            
            $objet = new Objet();
            $form = $this->createForm(ObjetType::class, $objet);            
        }
        $os = $objetRepository->findByDon($do);
        return $this->renderForm('objet/new.html.twig', [
            'objet' => $objet,
            'form' => $form,
            'do'=> $do,
            'os' => $os
        ]);
    }

    #[Route('/{id}', name: 'objet_show', methods: ['GET'])]
    public function show(Objet $objet): Response
    {
        return $this->render('objet/show.html.twig', [
            'objet' => $objet,
        ]);
    }

    #[Route('/{id}/edit', name: 'objet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Objet $objet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ObjetType::class, $objet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('objet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('objet/edit.html.twig', [
            'objet' => $objet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'objet_delete', methods: ['POST'])]
    public function delete(Request $request, Objet $objet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$objet->getId(), $request->request->get('_token'))) {
            $entityManager->remove($objet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('objet_index', [], Response::HTTP_SEE_OTHER);
    }
}
