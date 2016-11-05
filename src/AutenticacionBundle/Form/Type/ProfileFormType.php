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
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder->add('cedula','text', array('label'=>'Cédula',
            'required'=>false));
        $builder->add('nombre','text', array('label'=>'Primer Nombre'));
       
        $builder->add('apellido','text', array('label'=>'Primer Apellido'));
        
        
        $builder->add('groups', 'entity', array(
            'class' => 'BackendBundle\Entity\Group',
            'multiple' => true,
            'expanded' => true,
            'label' => 'Grupo:',
            'attr'=>array('class'=>'form-control')
        ));
        parent::buildForm($builder, $options);
        $builder->add('enabled',null, array(
            'label'=>'Activo',
            'required'=>false));
        $builder->remove('current_password');
        
        
    }

    public function getParent()
    {
        return 'fos_user_profile';
    }

    public function getName()
    {
        return 'ubv_estacionamiento_perfil_usuario';
    }
}
