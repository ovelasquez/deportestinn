<?php

namespace BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TallaMediasType extends AbstractType {

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'choices' => array(
                'T1' => 'T1',
               'T2' => 'T2',
                'T3' => 'T3',
                'T4' => 'T4',
                'T5' => 'T5',
                
            )
        ));
    }

    public function getParent() {
        return ChoiceType::class;
    }

}
