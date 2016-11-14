<?php

namespace AutenticacionBundle\Entity;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', null, array('label' => 'Nombre'))
                ->add('apellido', null, array('label' => 'Apellido'))
                ->add('campeonato', null, array('label' => 'Apellido'))
                ->add('organizacion', null, array('label' => 'Apellido'))
                ->add('liga', null, array(
                    'label' => 'Liga',
                    'empty_value' => 'Seleccione',
                    'attr' => array('class' => 'form-control'),
                    'label_attr' => array('class' => 'col-lg-2 control-label')))
        ;
    }

    public function getParent() {
        return 'fos_user_registration';
    }

    public function getName() {
        return 'app_user_registration';
    }

}
