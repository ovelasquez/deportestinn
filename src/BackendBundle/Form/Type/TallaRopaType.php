<?php

namespace BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TallaRopaType extends AbstractType {

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'choices' => array(
                'SS' => 'SS',
                'S' => 'S',
                'M' => 'M',
                'L' => 'L',
                'XL' => 'XL',
                '2XL-' => '2XL',
                '3XL' => '3XL',
                '4XL' => '4XL',    
            )
        ));
    }

    public function getParent() {
        return ChoiceType::class;
    }

}
