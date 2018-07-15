<?php

namespace LoginBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UStIdBeiFirmaConstraint extends Constraint
{
    public $firmaErfordertUStId = 'Die Eingabe einer Firma "{{ firma }}" erfordert die Eingabe einer USt-Id';
    public $uStIdErfordertFirma = 'Die Eingabe USt-Id "{{ ust_id }}" erfordert die Eingabe einer Firma';
    
    public function validatedBy() {
        return 'ust_id_bei_firma_validator';
    }

    public function getTargets() {
        return self::CLASS_CONSTRAINT;
    }
}

?>