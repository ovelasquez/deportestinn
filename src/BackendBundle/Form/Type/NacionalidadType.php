<?php
namespace BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class NacionalidadType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                'V' => 'Venezolana',
                'E' => 'Extranjero',
            )
        ));
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}