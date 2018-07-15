<?php

namespace LoginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use LoginBundle\Entity\User;

class LoginController extends Controller
{
  
    /**
     * @Route("/login", name="login")
     */
    public function loginAction( Request $request )
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $fehler = $authenticationUtils->getLastAuthenticationError();
        $kennung = $authenticationUtils->getLastUsername();
        $em = $this->getDoctrine()->getManager();

        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $usernames = '';
        foreach( $users as $user ) {
          $usernames .=  "'" . $user->getUsername() .  "',";
        }
        $usernames = substr($usernames,0,-1);
        
        return $this->render('@Login/Login/login.html.twig', array(
            'fehler' => $fehler,
            'kennung' => $kennung,
            'usernames' => $usernames
        ));
    }

}
