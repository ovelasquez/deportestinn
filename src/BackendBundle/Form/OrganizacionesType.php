<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrganizacionesType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $pEntity = $builder->getForm()->getData(); 
        $builder
                ->add('nombre')
                ->add('abreviatura')
                ->add('rif')
                ->add('telefono')
                ->add('email', 'email', array('required' => true, 'attr' => array('placeholder' => 'E-mail')))
                ->add('responsable')
                ->add('direccion')
                ->add('campeonato', null, array('required' => true, 'empty_value' => 'Seleccione'))                
                ->add('logo', 'comur_image', array(
                    'uploadConfig' => array(
                        'uploadRoute' => 'comur_api_upload', //optional
                        'uploadUrl' => $pEntity->getUploadRootDir(), // required - see explanation below (you can also put just a dir path)
                        'webDir' => '../web/' . $pEntity->getUploadDir(), // required - see explanation below (you can also put just a dir path)
                        'fileExt' => '*.jpg;*.gif;*.png;*.jpeg', //optional
                        'libraryDir' => null, //optional
                        'libraryRoute' => 'comur_api_image_library', //optional
                        'showLibrary' => true //optional                        
                    ),
                    'cropConfig' => array(
                        'minWidth' => 200,
                        'minHeight' => 200,
                        'aspectRatio' => true, //optional
                        'cropRoute' => 'comur_api_crop', //optional
                        'forceResize' => true, //optional
                        'thumbs' => array(//optional
                            array(
                                'maxWidth' => 120,
                                'maxHeight' => 150,
                                'useAsFieldImage' => true  //optional
                            )
                        )
                    ),
                ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Organizaciones'
        ));
    }

}
