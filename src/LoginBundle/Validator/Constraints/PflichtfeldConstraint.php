<?php

namespace LoginBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PflichtfeldConstraint extends Constraint
{
    public $bitteWertEingeben = 'Bitte geben Sie einen Wert ein';
    
    public function validatedBy() {
        //return 'pflichtfeld_validator';
        return preg_replace( '/Constraint$/', 'Validator', get_class($this) );
    }

    public function getTargets() {
        return self::PROPERTY_CONSTRAINT;
    }
}

?>