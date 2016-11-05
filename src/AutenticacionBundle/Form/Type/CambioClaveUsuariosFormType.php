<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UBV\AutenticacionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
//use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class CambioClaveUsuariosFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder->add('username','text', array('label'=>'Cédula',
            'required'=>false));
        $builder->add('email', 'email');
        $builder->add('cedula','text', array('label'=>'Cédula',
            'required'=>false));
        $builder->add('nombre','text', array('label'=>'Nombre'));
        
        $builder->add('apellido','text', array('label'=>'Apellido'));
        $builder->add('segundoApellido','text', array(
            'label'=>'Segundo Apellido',
            'required'=>false));
        
        $builder->add('plainPassword', 'repeated', array(
            'type' => 'password',
            'options' => array('translation_domain' => 'FOSUserBundle'),
            'first_options' => array('label' => 'form.new_password'),
            'second_options' => array('label' => 'form.new_password_confirmation'),
            'invalid_message' => 'fos_user.password.mismatch',
        ));
        
        $builder->add('groups', 'entity', array(
            'class' => 'BackendBundle\Entity\Group',
            'multiple' => true,
            'expanded' => true,
            'label' => 'Grupo:',
            'attr'=>array('class'=>'form-control')
        ));
        
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Usuarios',
        ));
    }

    public function getName()
    {
        return 'cambio_clave_usuario';
    }
}
