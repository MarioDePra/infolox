<?php

  namespace LoginBundle\Entity;

  use Doctrine\ORM\Mapping as ORM;
  use Symfony\Component\Security\Core\User\UserInterface;
  use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;  
  use Symfony\Component\Validator\Constraints as Assert;
  use LoginBundle\Validator\Constraints as UStIdBeiFirmaAssert;

  
/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="LoginBundle\Repository\UserRepository")
 * @UniqueEntity(fields="username", message="Dieser Anwender ist bereits registriert")
 * @UStIdBeiFirmaAssert\UStIdBeiFirmaConstraint
 */
  class User implements UserInterface
  {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $vorname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $nachname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firma;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ust_id", type="string", length=12, nullable=true)
     */
    private $uStId;
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean" )
     */
    private $herr;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=5)
     */
    private $plz;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $ort;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $land;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $telefon;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fax;
    
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     * @Assert\Email()
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    
    
    
    /**
     * @return string
     */
    public function getFirma(){
      return $this->firma;
    }

     /**
     * @return User
     */
    public function setFirma($firma){
      $this->firma = $firma;
      return $this->uStId;
    }

    /**
     * @return string
     */
    public function getUStId(){
      return $this->uStId;
    }

    /**
     * @return User
     */
    public function setUStId($uStId){
      $this->uStId = $uStId;
      return $this;
    }

    public function isHerr(){
      return $this->herr;
    }

    /**
     * @return User
     */
    public function setHerr($herr){
      $this->herr = $herr;
      return $this;
    }

    /**
     * @return string
     */
    public function getAdresse(){
      return $this->adresse;
    }

    /**
     * @return User
     */
    public function setAdresse($adresse){
      $this->adresse = $adresse;
      return $this;
    }

    /**
     * @return string
     */
    public function getPlz(){
      return $this->plz;
    }

    /**
     * @return User
     */
    public function setPlz($plz){
      $this->plz = $plz;
      return $this;
    }

    /**
     * @return string
     */
    public function getOrt(){
      return $this->ort;
    }

    /**
     * @return User
     */
    public function setOrt($ort){
      $this->ort = $ort;
      return $this;
    }

    /**
     * @return string
     */
    public function getLand(){
      return $this->land;
    }

    /**
     * @return User
     */
    public function setLand($land){
      $this->land = $land;
      return $this;
    }

    /**
     * @return string
     */
    public function getTelefon(){
      return $this->telefon;
    }

    /**
     * @return User
     */
    public function setTelefon($telefon){
      $this->telefon = $telefon;
      return $this;
    }

    /**
     * @return string
     */
    public function getFax(){
      return $this->fax;
    }

    /**
     * @return User
     */
    public function setFax($fax){
      $this->fax = $fax;
      return $this;
    }    


    
    
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set vorname
     *
     * @param string $vorname
     *
     * @return User
     */
    public function setVorname($vorname)
    {
        $this->vorname = $vorname;
        return $this;
    }

    /**
     * Get vorname
     *
     * @return string
     */
    public function getVorname()
    {
        return $this->vorname;
    }

    /**
     * Set nachname
     *
     * @param string $nachname
     *
     * @return User
     */
    public function setNachname($nachname)
    {
        $this->nachname = $nachname;

        return $this;
    }

    /**
     * Get nachname
     *
     * @return string
     */
    public function getNachname()
    {
        return $this->nachname;
    }
    
    /*
      implements Symfony\Component\Security\Core\User\UserInterface
      type \vendor\symfony\symfony\src\Symfony\Component\Security\Core\User\UserInterface.php | find "function"

      public function getRoles();
      public function getPassword();
      public function getSalt();
      public function getUsername();
      public function eraseCredentials();    
    */


    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
# leer weil https://knpuniversity.com/screencast/symfony-security/user-interface-methods#play
        return $this->password;
    }
   
    public function getRoles() { return [ 'ROLE_USER' ]; }
    public function getSalt() { return null; }
    public function eraseCredentials() { return; }

  }

