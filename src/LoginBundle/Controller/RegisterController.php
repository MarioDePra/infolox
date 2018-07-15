<?php

namespace LoginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use LoginBundle\Entity\User;
use LoginBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;


class RegisterController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function registerAction( Request $request )
    {
        $user = new User();
        $user->setLand('DE');
        $user->setHerr(true);
        $form = $this->createForm( UserType::class, $user );
        $form->handleRequest( $request );

        if( $form->isSubmitted() && $form->isValid() ) {
          $em = $this->getDoctrine()->getManager();
          $encoder = $this->container->get('security.password_encoder');
          $encodedPassword = $encoder->encodePassword($user, $user->getPassword());
          $user->setPassword($encodedPassword);
          $em->persist($user);
          $em->flush();
          return $this->redirectToRoute('danke');
        }
        
        return $this->render('@Login/Register/register.html.twig', array(
          'form' => $form->createView()
        ));
    }

    /**
     * @Route("/danke", name="danke")
     */
    public function dankeAction( Request $request )
    {
        return $this->render('@Login/Register/danke.html.twig');
    }

}
