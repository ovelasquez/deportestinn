<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AtletasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nacionalidad')
            ->add('cedula')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('primerNombre')
            ->add('segundoNombre')
            ->add('fechaNacimiento', 'date')
            ->add('genero')
            ->add('email')
            ->add('telefono')
            ->add('fotografia')
            ->add('imagenCedula')
            ->add('status')
            ->add('institucion')
            ->add('departamento')
            ->add('contancia')
            ->add('carnet')
            ->add('altura')
            ->add('peso')
            ->add('tipoSangre')
            ->add('alergias')
            ->add('contactoNombre')
            ->add('contactoTelefono')
            ->add('tallaFranela')
            ->add('tallaPantalon')
            ->add('tallaPantalonCorto')
            ->add('tallaZapato')
            ->add('tallaGorra')
            ->add('tallaChaqueta')
            ->add('tallaMedias')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Atletas'
        ));
    }
}
