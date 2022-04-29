<?php

namespace App\Controller;

use App\Entity\BilanObjet;
use App\Form\BilanObjetType;
use App\Repository\BilanObjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bilan/objet')]
class BilanObjetController extends AbstractController
{
    #[Route('/', name: 'bilan_objet_index', methods: ['GET'])]
    public function index(BilanObjetRepository $bilanObjetRepository): Response
    {
        return $this->render('bilan_objet/index.html.twig', [
            'bilan_objets' => $bilanObjetRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'bilan_objet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bilanObjet = new BilanObjet();
        $form = $this->createForm(BilanObjetType::class, $bilanObjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bilanObjet);
            $entityManager->flush();

            return $this->redirectToRoute('bilan_objet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bilan_objet/new.html.twig', [
            'bilan_objet' => $bilanObjet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'bilan_objet_show', methods: ['GET'])]
    public function show(BilanObjet $bilanObjet): Response
    {
        return $this->render('bilan_objet/show.html.twig', [
            'bilan_objet' => $bilanObjet,
        ]);
    }

    #[Route('/{id}/edit', name: 'bilan_objet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BilanObjet $bilanObjet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BilanObjetType::class, $bilanObjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('bilan_objet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bilan_objet/edit.html.twig', [
            'bilan_objet' => $bilanObjet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'bilan_objet_delete', methods: ['POST'])]
    public function delete(Request $request, BilanObjet $bilanObjet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bilanObjet->getId(), $request->request->get('_token'))) {
            $entityManager->remove($bilanObjet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bilan_objet_index', [], Response::HTTP_SEE_OTHER);
    }
}
