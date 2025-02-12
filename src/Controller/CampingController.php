<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Camping;
use App\Form\CampingType;
use App\Repository\CampingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/camping")
 */
class CampingController extends AbstractController
{
    /**
     * @Route("/", name="camping_index", methods={"GET"})
     */
    public function index(CampingRepository $campingRepository,Request $request): Response

    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->getId();
            return $this->render('camping/index.html.twig', [
                'campings' => $campingRepository->findBy(array('user' =>   $user)),
            ]);

    }
    /**
     * @Route("/affich", name="camping_affich", methods={"GET"})
     */
    public function affich(CampingRepository $campingRepository,Request $request): Response

    {

        return $this->render('camping/indexUser.html.twig', [
            'campings' => $campingRepository->findAll(),
        ]);

    }

    /**
     * @Route("/new", name="camping_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            $user = $this->getUser();
            $user->getId();

            $camping = new Camping();
            $camping->setUser($user);

            $form = $this->createForm(CampingType::class, $camping);


            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($camping);
                $entityManager->flush();

                return $this->redirectToRoute('camping_index');
            }

            return $this->render('camping/new.html.twig', [
                'camping' => $camping,
                'form' => $form->createView(),
            ]);

    }

    /**
     * @Route("/{id}", name="camping_show", methods={"GET"})
     */
    public function show(Camping $camping,Request $request): Response

    {

            return $this->render('camping/show.html.twig', [
                 'camping' => $camping,
            ]);

    }


    /**
     * @Route("aff/{id}", name="camping_aff", methods={"GET"})
     */
    public function aff(Camping $camping,Request $request): Response

    {

        return $this->render('camping/aff.html.twig', [
            'camping' => $camping,
        ]);

    }

    /**
     * @Route("/{id}/edit", name="camping_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Camping $camping): Response
    {
            $form = $this->createForm(CampingType::class, $camping);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('camping_index');
            }

            return $this->render('camping/edit.html.twig', [
                 'camping' => $camping,
                'form' => $form->createView(),
            ]);

    }
    /**
     * @Route("/{id}", name="camping_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Camping $camping): Response
    {

        if ($this->isCsrfTokenValid('delete'.$camping->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($camping);
            $entityManager->flush();
        }

        return $this->redirectToRoute('camping_index');
    }
}
