<?php

namespace App\Controller;


use App\Entity\Event;
use App\Entity\User;

use App\Form\EventType;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/event")
 */
class EventController extends AbstractController
{
    /**
     * @Route("/", name="event_index", methods={"GET"})
     */
    public function index(EventRepository $eventRepository,Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->getId();
        return $this->render('event/index.html.twig', [
           'events' => $eventRepository->findBy(array('user' =>   $user)),
        ]);
    }


    /**
     * @Route("/affich", name="event_affich", methods={"GET"})
     */
    public function affich(EventRepository $eventRepository,Request $request): Response
    {

        return $this->render('event/indexUse.html.twig', [
            'events' => $eventRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="event_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response

    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->getId();

        $event = new Event();
        $event->setUser($user);
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($event);
            $entityManager->flush();


         ;

            return $this->redirectToRoute('event_index');
        }

        return $this->render('event/new.html.twig', [
         'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_show", methods={"GET"})
     */
    public function show(Event $event, Request $request): Response
    {

            return $this->render('event/show.html.twig', [
                'event' => $event,
            ]);

    }
    /**
     * @Route("aff/{id}", name="event_aff", methods={"GET"})
     */
    public function aff(Event $event, Request $request): Response
    {

        return $this->render('event/aff.html.twig', [
            'event' => $event,
        ]);

    }
    /**
     * @Route("/{id}/edit", name="event_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Event $event): Response
    {


        $session = $request->getSession();
        if (!$session->has('id')) {
            $this->get('session')->getFlashBag()->add('info', 'Erreur de  Connection veuillez se connecter .... ....');
            return $this->redirectToRoute('security_login');
        } else {
            $id = $session->get('id');
            $form = $this->createForm(EventType::class, $event);


            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute( 'event_index');
            }

            return $this->render('event/edit.html.twig', [
                'id' => $id, 'event' => $event,
                'form' => $form->createView(),
            ]);
        }
    }
    /**
     * @Route("/{id}", name="event_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Event $event): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('event_index');
    }
}
