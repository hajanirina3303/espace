<?php

namespace App\Controller;

use App\Entity\Piece;
use App\Form\PieceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/piece')]
class PieceController extends AbstractController
{
    #[Route('/', name: 'piece_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $pieces = $entityManager
            ->getRepository(Piece::class)
            ->findAll();

        return $this->render('piece/index.html.twig', [
            'pieces' => $pieces,
        ]);
    }

    #[Route('/new', name: 'piece_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EDITEUR');
        $piece = new Piece();
        $form = $this->createForm(PieceType::class, $piece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($piece);
            $entityManager->flush();

            return $this->redirectToRoute('piece_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('piece/new.html.twig', [
            'piece' => $piece,
            'form' => $form,
        ]);
    }

    #[Route('/{idpiece}', name: 'piece_show', methods: ['GET'])]
    public function show(Piece $piece): Response
    {
        return $this->render('piece/show.html.twig', [
            'piece' => $piece,
        ]);
    }

    #[Route('/{idpiece}/edit', name: 'piece_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Piece $piece, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EDITEUR');
        $form = $this->createForm(PieceType::class, $piece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('piece_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('piece/edit.html.twig', [
            'piece' => $piece,
            'form' => $form,
        ]);
    }

    #[Route('/{idpiece}', name: 'piece_delete', methods: ['POST'])]
    public function delete(Request $request, Piece $piece, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EDITEUR');
        if ($this->isCsrfTokenValid('delete'.$piece->getIdpiece(), $request->request->get('_token'))) {
            $entityManager->remove($piece);
            $entityManager->flush();
        }

        return $this->redirectToRoute('piece_index', [], Response::HTTP_SEE_OTHER);
    }
}
