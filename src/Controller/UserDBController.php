<?php

namespace App\Controller;

use App\Entity\UserDB;
use App\Form\UserDBType;
use App\Repository\UserDBRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

#[Route('/user')]
class UserDBController extends AbstractController
{
    #[Route('/', name: 'user_d_b_index', methods: ['GET'])]
    public function index(UserDBRepository $userDBRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('user_db/index.html.twig', [
            'user_d_bs' => $userDBRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'user_d_b_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $userDB = new UserDB();
        $form = $this->createForm(UserDBType::class, $userDB);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userDB->setPassword($encoder->encodePassword($userDB, $userDB->getPassword()));
            $entityManager->persist($userDB);
            $entityManager->flush();

            return $this->redirectToRoute('user_d_b_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_db/new.html.twig', [
            'user_d_b' => $userDB,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'user_d_b_show', methods: ['GET'])]
    public function show(UserDB $userDB): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('user_db/show.html.twig', [
            'user_d_b' => $userDB,
        ]);
    }

    #[Route('/{id}/edit', name: 'user_d_b_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserDB $userDB, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(UserDBType::class, $userDB);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('user_d_b_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_db/edit.html.twig', [
            'user_d_b' => $userDB,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'user_d_b_delete', methods: ['POST'])]
    public function delete(Request $request, UserDB $userDB, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$userDB->getId(), $request->request->get('_token'))) {
            $entityManager->remove($userDB);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_d_b_index', [], Response::HTTP_SEE_OTHER);
    }
}
