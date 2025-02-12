<?php

namespace App\Controller;

use App\Entity\Camping;
use App\Entity\Inscription;
use App\Form\Inscription1Type;
use App\Repository\InscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inscription")
 */
class InscriptionController extends AbstractController
{
    /**
     * @Route("/", name="inscription_index", methods={"GET"})
     */
    public function index(InscriptionRepository $inscriptionRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->getId();

        return $this->render('inscription/index.html.twig', [
            'inscriptions' => $inscriptionRepository->findBy(array('user' =>   $user)),
        ]);
    }





    /**
     * @Route("/inscri", name="inscription_index2", methods={"GET"})
     */
    public function index2(InscriptionRepository $inscriptionRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->getId();

        return $this->render('inscription/index.html.twig', [
            'inscriptions' => $inscriptionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="inscription_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->getId();

        $inscription = new Inscription();
        $inscription->setUser($user);
        $form = $this->createForm(Inscription1Type::class, $inscription);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($inscription);
            $entityManager->flush();

            return $this->redirectToRoute('inscription_index');
        }

        return $this->render('inscription/new.html.twig', [
            'inscription' => $inscription,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="inscription_show", methods={"GET"})
     */
    public function show(Inscription $inscription): Response
    {

        return $this->render('inscription/show.html.twig', [
            'inscription' => $inscription,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="inscription_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Inscription $inscription): Response
    {
        $form = $this->createForm(Inscription1Type::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inscription_index');
        }

        return $this->render('inscription/edit.html.twig', [
            'inscription' => $inscription,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="inscription_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Inscription $inscription): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscription->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inscription);
            $entityManager->flush();
        }

        return $this->redirectToRoute('inscription_index');
    }
}
