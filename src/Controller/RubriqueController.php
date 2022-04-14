<?php

namespace App\Controller;

use App\Entity\Rubrique;
use App\Form\RubriqueType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rubrique')]
class RubriqueController extends AbstractController
{
    #[Route('/', name: 'rubrique_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $rubriques = $entityManager
            ->getRepository(Rubrique::class)
            ->findAll();

        return $this->render('rubrique/index.html.twig', [
            'rubriques' => $rubriques,
        ]);
    }

    #[Route('/new', name: 'rubrique_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EDITEUR');

        $rubrique = new Rubrique();
        $form = $this->createForm(RubriqueType::class, $rubrique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($rubrique);           
            $entityManager->flush();
            return $this->redirectToRoute('rubrique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rubrique/new.html.twig', [
            'rubrique' => $rubrique,
            'form' => $form,
        ]);
    }

    #[Route('/{refrubrique}', name: 'rubrique_show', methods: ['GET'])]
    public function show(Rubrique $rubrique): Response
    {
        return $this->render('rubrique/show.html.twig', [
            'rubrique' => $rubrique,
        ]);
    }

    #[Route('/{refrubrique}/edit', name: 'rubrique_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rubrique $rubrique, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EDITEUR');
        $form = $this->createForm(RubriqueType::class, $rubrique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('rubrique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rubrique/edit.html.twig', [
            'rubrique' => $rubrique,
            'form' => $form,
        ]);
    }

    #[Route('/{refrubrique}', name: 'rubrique_delete', methods: ['POST'])]
    public function delete(Request $request, Rubrique $rubrique, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EDITEUR');
        
        if ($this->isCsrfTokenValid('delete'.$rubrique->getRefrubrique(), $request->request->get('_token'))) {
            $entityManager->remove($rubrique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rubrique_index', [], Response::HTTP_SEE_OTHER);
    }
}
