<?php

namespace App\Controller;

use App\Entity\Randonne;
use App\Form\RandonneType;
use App\Repository\RandonneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/randonne")
 */
class RandonneController extends AbstractController
{
    /**
     * @Route("/", name="randonne_index", methods={"GET"})
     */
    public function index(RandonneRepository $randonneRepository,Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->getId();
            return $this->render('randonne/index.html.twig', [
                 'randonnes' => $randonneRepository-> findBy(array('user' =>   $user)),
            ]);

    }


    /**
     * @Route("/affich", name="randonne_affich", methods={"GET"})
     */
    public function affich(RandonneRepository $randonneRepository,Request $request): Response
    {

        return $this->render('randonne/indexUser.html.twig', [
            'randonnes' => $randonneRepository->findAll(),
        ]);

    }

    /**
     * @Route("/new", name="randonne_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->getId();

            $randonne = new Randonne();
            $randonne->setUser($user);
            $form = $this->createForm(RandonneType::class, $randonne);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($randonne);
                $entityManager->flush();

                return $this->redirectToRoute('randonne_index');
            }

            return $this->render('randonne/new.html.twig', [
              'randonne' => $randonne,
                'form' => $form->createView(),
            ]);

    }

    /**
     * @Route("/{id}", name="randonne_show", methods={"GET"})
     */
    public function show(Randonne $randonne,Request $request): Response
    {

            return $this->render('randonne/show.html.twig', [
                'randonne' => $randonne,
            ]);

    }


    /**
     * @Route("aff/{id}", name="randonne_aff", methods={"GET"})
     */
    public function aff(Randonne $randonne,Request $request): Response
    {

        return $this->render('randonne/affich.html.twig', [
            'randonne' => $randonne,
        ]);

    }


    /**
     * @Route("/{id}/edit", name="randonne_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Randonne $randonne): Response
    {
            $form = $this->createForm(RandonneType::class, $randonne);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('randonne_index');
            }

            return $this->render('randonne/edit.html.twig', [
                'randonne' => $randonne,
                 'form' => $form->createView(),
            ]);

    }

    /**
     * @Route("/{id}", name="randonne_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Randonne $randonne): Response
    {
        if ($this->isCsrfTokenValid('delete'.$randonne->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($randonne);
            $entityManager->flush();
        }

        return $this->redirectToRoute('randonne_index');
    }
}
