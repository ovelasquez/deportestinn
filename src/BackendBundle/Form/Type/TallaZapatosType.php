<?php
namespace BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TallaZapatosType extends AbstractType {

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'choices' => array(
                '6' => '6',
                '6,5' => '6,5',
                '7' => '7',
                '7,5' => '7,5',
                '8' => '8',
                '8,5' => '8,5',
                '9' => '9',
                '9,5' => '9,5',
                '10' => '10',
                '10,5' => '10,5',
                '11' => '11',
                '11,5' => '11,5',
                '12' => '12',              
                '13' => '13',
                '14' => '14',
                '15' => '15',
                '16' => '16',
                '17' => '17',
                '18' => '18',                              
            )
        ));
    }

    public function getParent() {
        return ChoiceType::class;
    }

}
