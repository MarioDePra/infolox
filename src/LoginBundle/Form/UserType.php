<?php

  namespace LoginBundle\Form;
  
  use Symfony\Component\Form\AbstractType;
  use Symfony\Component\Form\FormBuilderInterface;
  use Symfony\Component\Form\Extension\Core\Type\TextType;
  use Symfony\Component\Form\Extension\Core\Type\EmailType;
  use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;
  use Symfony\Component\Form\Extension\Core\Type\PasswordType;
  use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
  use Symfony\Component\Form\Extension\Core\Type\CountryType;
  use Symfony\Component\OptionsResolver\OptionsResolver;
  use Symfony\Component\Intl\Intl;
  use LoginBundle\Entity\User;
  
  class UserType extends AbstractType
  {

    public function buildForm( FormBuilderInterface $formBuilder, array $options ) {
      define( 'PFLICHTFELD_HINWEIS', 'Pflichtfeld' );
      define( 'PFLICHTFELD_POSTFIX', ' *' );
      
      $formBuilder
      ->add('firma', TextType::class, array(
        'attr' => [ 'placeholder' => 'Firma' ],
        'required' => false,
      ))
      ->add('ust_id', TextType::class, array(
        'attr' => [ 'placeholder' =>'USt-Id' ],
        'required' => false
      ))
      ->add('herr', ChoiceType::class, array(
        'label' => ' ',
        'expanded' => true,
        'multiple' => false,
        'choices' => array('Herr' => true, 'Frau' => false),
        'required' => true,
        'invalid_message' => PFLICHTFELD_HINWEIS
      ))
      ->add('vorname', TextType::class, array(
        'attr' => [ 'placeholder' => $this->bauePflichtfeldText('Vorname') ],
        'required' => false,
        'invalid_message' => PFLICHTFELD_HINWEIS
      ))
      ->add('nachname', TextType::class, array(
        'attr' => [ 'placeholder' => $this->bauePflichtfeldText('Nachname') ],
        'required' => false,
        'invalid_message' => PFLICHTFELD_HINWEIS
      ))
      ->add('adresse', TextType::class, array(
        'attr' => [ 'placeholder' => $this->bauePflichtfeldText('Straße, Nr') ],
        'required' => false,
        'invalid_message' => PFLICHTFELD_HINWEIS
      ))
      ->add('plz', TextType::class, array(
        'attr' => [ 'placeholder' => $this->bauePflichtfeldText('PLZ') ],
        'required' => false,
        'invalid_message' => PFLICHTFELD_HINWEIS
      ))
      ->add('ort', TextType::class, array(
        'attr' => [ 'placeholder' => $this->bauePflichtfeldText('Ort') ],
        'required' => false,
        'invalid_message' => PFLICHTFELD_HINWEIS
      ))
      ->add('land', CountryType::class, array(
//        'choices' => Intl::getRegionBundle()->getCountryNames('DE'),
//        'choice_loader' => null,
        'required' => true,
        'invalid_message' => PFLICHTFELD_HINWEIS,
        'attr' => [ 'class' => 'land' ]
      ))
      ->add('telefon', TextType::class, array(
        'attr' => [ 'placeholder' => $this->bauePflichtfeldText('Telefon') ],
        'required' => false,
        'invalid_message' => PFLICHTFELD_HINWEIS
      ))
      ->add('fax', TextType::class, array(
        'attr' => [ 'placeholder' => 'Fax' ],
        'required' => false,
      ))
      ->add('username', TextType::class, array(
        'attr' => [ 'placeholder' => $this->bauePflichtfeldText('E-Mail') ],
        'required' => false,
        'invalid_message' => PFLICHTFELD_HINWEIS
      ))
      // https://symfony.com/doc/3.4/reference/forms/types/repeated.html
      ->add('password', RepeatedType::class, array(
        'required' => false,
        'invalid_message' => 'Wiederholung des Passworts inkorrekt',
        'type' => PasswordType::class,
        'options' => array( 'attr' => array('class' => 'password-field') ),
        'first_options'  => array( 'attr' => [ 'placeholder' => $this->bauePflichtfeldText('Passwort') ] ),
        'second_options' => array( 'attr' => [ 'placeholder' => $this->bauePflichtfeldText('Passwort wiederholen') ] )
      ))
      ->add('submit', SubmitType::class, array(
        'label' => 'Speichern',
//        'attr' => [ 'class' => 'btn btn-success pull-right' ]
        'attr' => [ 'class' => 'speichern btn pull-right show-arrow' ]
      ));
    }
    
    private function bauePflichtfeldText( $sText ) {
      return $sText . PFLICHTFELD_POSTFIX;
    }

    public function configureOptions( OptionsResolver $resolver ) {
      $resolver->setDefaults( array(
        'data_class' => User::class
      ));
    }

}
