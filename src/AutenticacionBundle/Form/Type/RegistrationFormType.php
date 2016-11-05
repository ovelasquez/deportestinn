<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AutenticacionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder->add('cedula',null, array('label'=>'Cédula',
            'required'=>false,
            'invalid_message'=>"Por favor Introduzca una cédula Valida"));
        $builder->add('nombre','text', array('label'=>'Nombre',
            'required'=>false));
       
        $builder->add('apellido','text', array('label'=>'Apellido'));
                
        $builder->add('groups', 'entity', array(
            'class' => 'BackendBundle\Entity\Group',
            'multiple' => true,
            'expanded' => true,
            'label' => 'Grupo:',
            'attr'=>array('class'=>'form-control')
        ));
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'ubv_estacionamiento_registro_usuario';
    }
}
