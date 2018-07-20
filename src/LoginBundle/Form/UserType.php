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
/*
type Symfony\Component\Form\AbstractType.php | find "function"
    public function buildForm(FormBuilderInterface $builder, array $options)
    public function buildView(FormView $view, FormInterface $form, array $options)
    public function finishView(FormView $view, FormInterface $form, array $options)
    public function configureOptions(OptionsResolver $resolver)
    public function getBlockPrefix()
    public function getParent()
type Symfony\Component\Form\FormBuilderInterface.php | find "function"
    public function add($child, $type = null, array $options = array());
    public function create($name, $type = null, array $options = array());
    public function get($name);
    public function remove($name);
    public function has($name);
    public function all();
    public function getForm();
type Symfony\Component\Form\FormTypeInterface.php | find "function"
    public function buildForm(FormBuilderInterface $builder, array $options);
    public function buildView(FormView $view, FormInterface $form, array $options);
    public function finishView(FormView $view, FormInterface $form, array $options);
    public function configureOptions(OptionsResolver $resolver);
    public function getBlockPrefix();
    public function getParent();
HINWEIS: wie AbstractType
*/

    public function buildForm( FormBuilderInterface $formBuilder, array $options ) {
      define( 'PFLICHTFELD_HINWEIS', 'Pflichtfeld' );
      define( 'PFLICHTFELD_POSTFIX', ' *' );
      
      $formBuilder
      ->add('firma', TextType::class, array(
        'label' => 'Firma',
        'required' => false
      ))
      ->add('ust_id', TextType::class, array(
        'label' => 'USt-Id',
        'required' => false
      ))
      ->add('herr', ChoiceType::class, array(
        'label' => ' ',
        'expanded' => true,
        'multiple' => false,
        'choices' => array('Herr' => true, 'Frau' => false),
        'choice_label' => function ($choiceValue, $key, $value) {
          if ( $choiceValue == true ) {
            return 'Herr';
          }
          return 'Frau';
          // or if you want to translate some key
          //return 'form.choice.'.$key;
        },
        'required' => true,
        'invalid_message' => PFLICHTFELD_HINWEIS
      ))
      ->add('vorname', TextType::class, array(
        'label' => $this->bauePflichtfeldText('Vorname'),
        'required' => true,
        'invalid_message' => PFLICHTFELD_HINWEIS
      ))
      ->add('nachname', TextType::class, array(
        'label' => $this->bauePflichtfeldText('Nachname'),
        'required' => true,
        'invalid_message' => PFLICHTFELD_HINWEIS
      ))
      ->add('adresse', TextType::class, array(
        'label' => $this->bauePflichtfeldText('Straße, Nr'),
        'required' => true,
        'invalid_message' => PFLICHTFELD_HINWEIS
      ))
      ->add('plz', TextType::class, array(
        'label' => $this->bauePflichtfeldText('PLZ'),
        'required' => true,
        'invalid_message' => PFLICHTFELD_HINWEIS
      ))
      ->add('ort', TextType::class, array(
        'label' => $this->bauePflichtfeldText('Ort'),
        'required' => true,
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
        'label' => $this->bauePflichtfeldText('Telefon'),
        'required' => true,
        'invalid_message' => PFLICHTFELD_HINWEIS
      ))
      ->add('fax', TextType::class, array(
        'label' => 'Fax',
        'required' => false,
      ))
      ->add('username', TextType::class, array(
        'label' => $this->bauePflichtfeldText('E-Mail'),
        'required' => true,
        'invalid_message' => PFLICHTFELD_HINWEIS
      ))
      // https://symfony.com/doc/3.4/reference/forms/types/repeated.html
      ->add('password', RepeatedType::class, array(
        'required' => true,
        'invalid_message' => 'Wiederholung des Passworts inkorrekt',
        'type' => PasswordType::class,
        'options' => array( 'attr' => array('class' => 'password-field') ),
        'first_options'  => array( 'label' => $this->bauePflichtfeldText('Passwort') ),
        'second_options' => array( 'label' => $this->bauePflichtfeldText('Passwort wiederholen') )
      ))
      ->add('submit', SubmitType::class, array(
        'label' => 'Speichern',
//        'attr' => [ 'class' => 'btn btn-success pull-right' ]
        'attr' => [ 'class' => 'speichern btn pull-right' ]
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
