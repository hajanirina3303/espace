<?php

namespace App\Controller;

use App\Entity\Approvisionnement;
use App\Form\ApprovisionnementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/approvisionnement')]
class ApprovisionnementController extends AbstractController
{
    #[Route('/', name: 'approvisionnement_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $approvisionnements = $entityManager
            ->getRepository(Approvisionnement::class)
            ->findAll();

        return $this->render('approvisionnement/index.html.twig', [
            'approvisionnements' => $approvisionnements,
        ]);
    }

    #[Route('/new', name: 'approvisionnement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EDITEUR');
        $approvisionnement = new Approvisionnement();
        $form = $this->createForm(ApprovisionnementType::class, $approvisionnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($approvisionnement);
            $entityManager->flush();

            return $this->redirectToRoute('approvisionnement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('approvisionnement/new.html.twig', [
            'approvisionnement' => $approvisionnement,
            'form' => $form,
        ]);
    }

    #[Route('/{idapprovisionnement}', name: 'approvisionnement_show', methods: ['GET'])]
    public function show(Approvisionnement $approvisionnement): Response
    {
        return $this->render('approvisionnement/show.html.twig', [
            'approvisionnement' => $approvisionnement,
        ]);
    }

    #[Route('/{idapprovisionnement}/edit', name: 'approvisionnement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Approvisionnement $approvisionnement, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EDITEUR');
        $form = $this->createForm(ApprovisionnementType::class, $approvisionnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('approvisionnement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('approvisionnement/edit.html.twig', [
            'approvisionnement' => $approvisionnement,
            'form' => $form,
        ]);
    }

    #[Route('/{idapprovisionnement}', name: 'approvisionnement_delete', methods: ['POST'])]
    public function delete(Request $request, Approvisionnement $approvisionnement, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EDITEUR');
        if ($this->isCsrfTokenValid('delete'.$approvisionnement->getIdapprovisionnement(), $request->request->get('_token'))) {
            $entityManager->remove($approvisionnement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('approvisionnement_index', [], Response::HTTP_SEE_OTHER);
    }
}
