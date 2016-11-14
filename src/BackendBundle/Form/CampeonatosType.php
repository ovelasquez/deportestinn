<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CampeonatosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $pEntity = $builder->getForm()->getData();
        $builder
                ->add('nombre')
                ->add('descripcion')
                ->add('ubicacion')               
                ->add('liga')
                ->add('inicio', DateType::class)
                ->add('fin', DateType::class)                
                ->add('logo', 'comur_image', array(
                    'uploadConfig' => array(
                        'uploadRoute' => 'comur_api_upload', //optional
                        'uploadUrl' => $pEntity->getUploadRootDir(), // required - see explanation below (you can also put just a dir path)
                        'webDir' =>  '../web/'.$pEntity->getUploadDir(), // required - see explanation below (you can also put just a dir path)
                        'fileExt' => '*.jpg;*.gif;*.png;*.jpeg', //optional
                        'libraryDir' => null, //optional
                        'libraryRoute' => 'comur_api_image_library', //optional
                        'showLibrary' => false //optional                        
                    ),
                    'cropConfig' => array(
                        'minWidth' => 250,
                        'minHeight' => 250,
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
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Campeonatos'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backendbundle_campeonatos';
    }


}
