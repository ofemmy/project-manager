<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $errors = $authenticationUtils->getLastAuthenticationError();
        $lastUserName = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig',compact('errors',
        'lastUserName'));
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {

    }

    /**
     * @Route("/login-test")
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function loginTest(UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $user->setEmail("email@email.com".rand(1,100));
        $user->setFirstName("Olajide".rand(1,100));
        $user->setLastName("Emmanuel".rand(1,100));
        $user->setRoles(["ROLE_USER"]);
        $user->setPassword($passwordEncoder->encodePassword($user,"password"));
        $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();
      return new Response("New user with id ". $user->getId()." was added to DB");
    }

}
