<?php

namespace LoginBundle\DataFixtures\ORM;

use LoginBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadUserData implements FixtureInterface, ContainerAwareInterface {
  
  private $container = null;
  private $objectManager = null; 
    
  public function load( ObjectManager $objectManager ) {
    $this->objectManager = $objectManager;
    if ( ($hCsvDatei = fopen( 'var/data/user.csv', 'r')) !== FALSE ) {
      while ( ($aDaten = fgetcsv( $hCsvDatei, 0, ';', '"' )) !== FALSE ) {
        $this->createUser( $aDaten[0], $aDaten[1], $aDaten[2] );
      }
    }
    fclose($hCsvDatei);
  }

  private function createUser( $vorname, $nachname, $kennung ) {
    $user = new User();

    $user->setVorname($vorname);
    $user->setNachname($nachname);
    $user->setUsername($kennung);

    $encoder = $this->container->get('security.password_encoder');
    $encodedPassword = $encoder->encodePassword($user, '');
    $user->setPassword($encodedPassword);

    $this->objectManager->persist($user);
    $this->objectManager->flush();
    echo $vorname . ' ' . $nachname . ' ' . $kennung . ' ' . $encodedPassword . "\n";
  }

# public function setContainer( ContainerInterface $container = null );
  public function setContainer( ContainerInterface $container = null ) {
     $this->container =  $container;
  }

  
}