<?php

namespace LoginBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

class UStIdBeiFirmaValidator extends ConstraintValidator
{

  private $em;

  public function __construct(EntityManager $em) {
    $this->em = $em;
  }

  public function validate($value, Constraint $constraint)
  {
    // custom constraints should ignore null and empty values to allow
    // other constraints (NotBlank, NotNull, etc.) take care of that
    if (null === $value || '' === $value) {
        return;
    }
    $firma = trim( $value->getFirma() );
    $uStId = trim( $value->getUStId() );
    if ( strlen($uStId) > 0 &&  strlen($firma) == 0 ) {
      $this->context->buildViolation( $constraint->uStIdErfordertFirma )
        ->setParameter('{{ ust_id }}', $uStId)
        ->atPath( 'firma' )
        ->addViolation();
    } elseif ( strlen($firma) > 0 &&  strlen($uStId) == 0 ) {
      $this->context->buildViolation( $constraint->firmaErfordertUStId )
        ->setParameter('{{ firma }}', $firma)
        ->atPath( 'ust_id' )
        ->addViolation();
    }
  }
}

?>