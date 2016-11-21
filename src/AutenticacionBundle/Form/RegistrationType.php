<?php

namespace AutenticacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', null, array('label' => 'Nombre'))
                ->add('apellido', null, array('label' => 'Apellido'))
                ->add('liga', null, array('label' => 'liga')) 
                ->add('campeonato', null, array('label' => 'campeonato'))
                ->add('organizacion', null, array('label' => 'organizacion'))                    
                ->add('roles', 'choice', array(
                    'placeholder' => 'Seleccione',
                    'multiple'=>true,
                    'choices' => array(
                        'ROLE_LIGA' => 'LIGA',
                        'ROLE_ORGANIZACION' => 'ORGANIZACION',
                        'ROLE_SUPER_ADMIN' => 'SUPER ADMIN',                        
                    ), 'required' => true, 'attr' => array('class' => 'typeField'), 'label' => 'Perfil de usuario',
                ))
        ;
    }

    public function getParent() {
        return 'fos_user_registration';
    }

    public function getName() {
        return 'autenticacion_registration';
    }

}
