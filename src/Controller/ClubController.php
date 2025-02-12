<?php

namespace App\Controller;

use App\Entity\Club;
use App\Form\ClubType;
use App\Repository\ClubRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/club")
 */
class ClubController extends AbstractController
{
    /**
     * @Route("/", name="club_index", methods={"GET"})
     */
    public function index(ClubRepository $clubRepository,Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->getId();
            return $this->render('club/index.html.twig', [
               'clubs' => $clubRepository->findBy(array('user' =>   $user)),
            ]);

    }




    /**
     * @Route("/affich", name="club_affich", methods={"GET"})
     */
    public function affich(ClubRepository $clubRepository,Request $request): Response
    {

        return $this->render('club/indexUser.html.twig', [
            'clubs' => $clubRepository->findAll(),
        ]);

    }

    /**
     * @Route("/new", name="club_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {   $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->getId();

            $club = new Club();
            $club->setUser($user);
            $form = $this->createForm(ClubType::class, $club);
            $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $file = $produit->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $entityManager = $this->getDoctrine()->getManager();
            $produit->setImage($fileName);
            $entityManager->persist($produit);
            $entityManager->flush();






            if ($form->isSubmitted() && $form->isValid()) {


            }
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($club);
                $entityManager->flush();

                return $this->redirectToRoute('club_index');
            }

            return $this->render('club/new.html.twig', [
                'club' => $club,
                'form' => $form->createView(),
            ]);

    }
    /**
     * @Route("/{id}", name="club_show", methods={"GET"})
     */
    public function show(Club $club, Request $request): Response
    {

            return $this->render('club/show.html.twig', [
                'club' => $club,
            ]);

    }
    /**
     * @Route("aff/{id}", name="club_aff", methods={"GET"})
     */
    public function aff(Club $club, Request $request): Response
    {

        return $this->render('club/aff.html.twig', [
            'club' => $club,
        ]);

    }



    /**
     * @Route("/{id}/edit", name="club_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Club $club): Response
    {

            $form = $this->createForm(ClubType::class, $club);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('club_index');
            }

            return $this->render('club/edit.html.twig', [
                'club' => $club,
                'form' => $form->createView(),
            ]);

    }
    /**
     * @Route("/{id}", name="club_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Club $club): Response
    {
        if ($this->isCsrfTokenValid('delete'.$club->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($club);
            $entityManager->flush();
        }

        return $this->redirectToRoute('club_index');
    }
}
