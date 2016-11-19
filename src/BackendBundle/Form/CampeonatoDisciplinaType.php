<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CampeonatoDisciplinaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('maximo', 'text')
                ->add('minimo', 'text')
                ->add('abierto', 'text')
                ->add('entrenador', 'text')
                ->add('asistente', 'text')
                ->add('delegado', 'text')
                ->add('medico', 'text')
                ->add('logistico', 'text')
                ->add('inicio', DateType::class)
                ->add('fin', DateType::class)
                ->add('disciplina')
                ->add('campeonato')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\CampeonatoDisciplina'
        ));
    }

}
