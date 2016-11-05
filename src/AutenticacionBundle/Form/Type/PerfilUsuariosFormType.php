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
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
//use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class PerfilUsuariosFormType extends AbstractType
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
       
        $builder->add('apellido','text', array('label'=>'Primer Apellido'));
        
        
        $builder->add('groups', 'entity', array(
            'class' => 'BackendBundle\Entity\Group',
            'multiple' => true,
            'expanded' => true,
            'label' => 'Grupo:',
            'attr'=>array('class'=>'form-control')
        ));
        
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Usuarios',
            'intention'  => 'profile',
        ));
    }

    // BC for SF < 2.7
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    public function getName()
    {
        return 'perfil_usuario';
    }
}
