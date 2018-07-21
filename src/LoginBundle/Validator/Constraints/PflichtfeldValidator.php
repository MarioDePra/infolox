<?php

namespace LoginBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

class PflichtfeldValidator extends ConstraintValidator
{
  public function validate($value, Constraint $constraint)
  {
    if (null === $value || '' === $value) {
      $this->context->buildViolation( $constraint->bitteWertEingeben )
        ->addViolation();
    }
  }
}

?>