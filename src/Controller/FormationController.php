<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/formation")
 */
class FormationController extends AbstractController
{
    /**
     * @Route("/", name="formation_index", methods={"GET"})
     */
    public function index(FormationRepository $formationRepository,Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->getId();
        return $this->render('formation/index.html.twig', [
          'formations' => $formationRepository->findBy(array('user' =>   $user)),
        ]);
    }

    /**
     * @Route("/affich", name="formation_affich", methods={"GET"})
     */
    public function affich(FormationRepository $formationRepository,Request $request): Response
    {

        return $this->render('formation/indexUser.html.twig', [
            'formations' => $formationRepository->findAll(),
        ]);
    }




    /**
     * @Route("/new", name="formation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->getId();
            $formation = new Formation();
            $formation->setUser($user);
            $form = $this->createForm(FormationType::class, $formation);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($formation);
                $entityManager->flush();

                return $this->redirectToRoute('formation_index');
            }

            return $this->render('formation/new.html.twig', [
                 'formation' => $formation,
                'form' => $form->createView(),
            ]);

    }



    /**
     * @Route("/{id}", name="formation_show", methods={"GET"})
     */
    public function show(Formation $formation,Request $request): Response
    {

            return $this->render('formation/show.html.twig', [
                 'formation' => $formation,
            ]);

    }


    /**
     * @Route("aff/{id}", name="formation_aff", methods={"GET"})
     */
    public function aff(Formation $formation,Request $request): Response
    {

        return $this->render('formation/aff.html.twig', [
             'formation' => $formation,
        ]);

    }
    /**
     * @Route("/{id}/edit", name="formation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formation $formation): Response
    {
        $session = $request->getSession();
        if (!$session->has('id')) {
            $this->get('session')->getFlashBag()->add('info', 'Erreur de  Connection veuillez se connecter .... ....');
            return $this->redirectToRoute('security_login');
        } else {
            $id = $session->get('id');
            $form = $this->createForm(FormationType::class, $formation);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('formation_index');
            }

            return $this->render('formation/edit.html.twig', [
                'formation' => $formation,
                'id' => $id, 'form' => $form->createView(),
            ]);
        }
    }
    /**
     * @Route("/{id}", name="formation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Formation $formation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formation_index');
    }
}
