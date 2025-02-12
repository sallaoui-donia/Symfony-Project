<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\FormationRepository;
use App\Repository\UserRepository;
use App\Form\UserType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SercurityController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function dash(Request $request)
    {
        $session = $request->getSession();
        $id = $session->get('id');
        return $this->render('home/index.html.twig', [
            'id' => $id,

        ]);
    }



    /**
     * @Route("/auth", name="sercurity")
     */
    public function registration(Request $request, EntityManagerInterface $em,UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user,);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('security_login');

        }

        return $this->render('sercurity/registration.html.twig',
            ['form' => $form->createView()]);
    }
    /**
     * @Route("/connexion",name="security_login" , methods={"GET","POST"})
     */

    public function login(AuthenticationUtils $authenticationUtils): Response
    {





            $error = $authenticationUtils->getLastAuthenticationError();
            $lastUsername = $authenticationUtils->getLastUsername();
            return $this->render('sercurity/login.html.twig', ['lastUsername'=>$lastUsername,'error' => $error]);


    }
    /**
     * @Route("/deconnexion",name="security_logout")
     */
    public function logout() {

    }


    }



