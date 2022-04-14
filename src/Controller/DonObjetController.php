<?php

namespace App\Controller;

use App\Entity\DonObjet;
use App\Form\DonObjetType;
use App\Repository\DonObjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/don_objet')]
class DonObjetController extends AbstractController
{
    #[Route('/', name: 'don_objet_index', methods: ['GET'])]
    public function index(DonObjetRepository $donObjetRepository): Response
    {
        return $this->render('don_objet/index.html.twig', [
            'don_objets' => $donObjetRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'don_objet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $donObjet = new DonObjet();
        $form = $this->createForm(DonObjetType::class, $donObjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($donObjet);
            $entityManager->flush();

            return $this->redirectToRoute('objet_new', ['id'=>$donObjet->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('don_objet/new.html.twig', [
            'don_objet' => $donObjet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'don_objet_show', methods: ['GET'])]
    public function show(DonObjet $donObjet): Response
    {
        return $this->render('don_objet/show.html.twig', [
            'don_objet' => $donObjet,
        ]);
    }

    #[Route('/{id}/edit', name: 'don_objet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DonObjet $donObjet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DonObjetType::class, $donObjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('don_objet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('don_objet/edit.html.twig', [
            'don_objet' => $donObjet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'don_objet_delete', methods: ['POST'])]
    public function delete(Request $request, DonObjet $donObjet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$donObjet->getId(), $request->request->get('_token'))) {
            $entityManager->remove($donObjet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('don_objet_index', [], Response::HTTP_SEE_OTHER);
    }
}
