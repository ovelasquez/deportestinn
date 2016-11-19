<?php
namespace BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class StatusType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                'En Proceso' => 'En Proceso',                
                'Por Corregir' => 'Por Corregir',
                'Aprobado' => 'Aprobado',
            )
        ));
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}