<?php

namespace App\Controller;

use App\Entity\Releve;
use App\Form\Releve1Type;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/releve')]
class ReleveController extends AbstractController
{
    #[Route('/', name: 'releve_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $releves = $entityManager
            ->getRepository(Releve::class)
            ->findAll();

        return $this->render('releve/index.html.twig', [
            'releves' => $releves,
        ]);
    }

    #[Route('/new', name: 'releve_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,SluggerInterface $slugger): Response
    {
        $releve = new Releve();
        $form = $this->createForm(Releve1Type::class, $releve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file=$form->get('file')->getData();
            if ($file){
                $filename=$slugger->slug(pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME)).'-'.uniqid().'.'.$file->guessExtension();
                $releve->setFile($filename);
                    $file->move($this->getParameter('upload_directory'),$filename);
                    $entityManager->persist($releve);
                $entityManager->flush();
                return $this->redirectToRoute('releve_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->renderForm('releve/new.html.twig', [
            'releve' => $releve,
            'form' => $form,
        ]);
    }

    #[Route('/{idreleve}', name: 'releve_show', methods: ['GET'])]
    public function show(Releve $releve): Response
    {
        return $this->render('releve/show.html.twig', [
            'releve' => $releve,
        ]);
    }

    #[Route('/{idreleve}/edit', name: 'releve_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Releve $releve, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Releve1Type::class, $releve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('releve_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('releve/edit.html.twig', [
            'releve' => $releve,
            'form' => $form,
        ]);
    }

    #[Route('/{idreleve}', name: 'releve_delete', methods: ['POST'])]
    public function delete(Request $request, Releve $releve, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$releve->getIdreleve(), $request->request->get('_token'))) {
            $entityManager->remove($releve);
            $entityManager->flush();
        }

        return $this->redirectToRoute('releve_index', [], Response::HTTP_SEE_OTHER);
    }
}
