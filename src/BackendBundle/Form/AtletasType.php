<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use BackendBundle\Form\Type\GeneroType;
use BackendBundle\Form\Type\NacionalidadType;
use BackendBundle\Form\Type\SangreType;
use BackendBundle\Form\Type\TallaRopaType;
use BackendBundle\Form\Type\TallaMediasType;
use BackendBundle\Form\Type\TallaZapatosType;
use BackendBundle\Form\Type\StatusType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class AtletasType extends AbstractType {

    /**
      @param FormBuilderInterface $builder
      @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $pEntity = $builder->getForm()->getData();
      
        $builder
                ->add('nacionalidad', NacionalidadType::class, array('placeholder' => 'Nacionalidad',))
                ->add('cedula', 'integer', array('required' => true, 'attr' => array('placeholder' => 'Cédula de Identidad')))
                ->add('primerApellido', 'text', array('required' => true, 'attr' => array('placeholder' => 'Primer Apellido')))
                ->add('segundoApellido', 'text', array('required' => false, 'attr' => array('placeholder' => 'Segundo Apellido')))
                ->add('primerNombre', 'text', array('required' => true, 'attr' => array('placeholder' => 'Primer Nombre')))
                ->add('segundoNombre', 'text', array('required' => false, 'attr' => array('placeholder' => 'Segundo Nombre')))
                ->add('fechaNacimiento', DateType::class)
                ->add('genero', GeneroType::class, array('placeholder' => 'Género',))
                ->add('email', 'email', array('required' => true, 'attr' => array('placeholder' => 'E-mail')))
                ->add('telefono', 'text', array('required' => true, 'attr' => array('placeholder' => 'Teléfono Personal')))
                
                ->add('imagenCedula', 'comur_image', array(
                    'uploadConfig' => array(
                        'uploadRoute' => 'comur_api_upload', //optional
                        'uploadUrl' => $pEntity->getUploadRootDirCedula(), // required - see explanation below (you can also put just a dir path)
                        'webDir' => '../web/' . $pEntity->getUploadDirCedula(), // required - see explanation below (you can also put just a dir path)
                        'fileExt' => '*.jpg;*.gif;*.png;*.jpeg', //optional
                        'libraryDir' => null, //optional
                        'libraryRoute' => 'comur_api_image_library', //optional
                        'showLibrary' => false //optional                        
                    ),
                    'cropConfig' => array(
                        'minWidth' => 240,
                        'minHeight' => 300,
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
                
                ->add('fotografia', 'comur_image', array(
                    'uploadConfig' => array(
                        'uploadRoute' => 'comur_api_upload', //optional
                        'uploadUrl' => $pEntity->getUploadRootDirFotografia(), // required - see explanation below (you can also put just a dir path)
                        'webDir' => '../web/' . $pEntity->getUploadDirFotografia(), // required - see explanation below (you can also put just a dir path)
                        'fileExt' => '*.jpg;*.gif;*.png;*.jpeg', //optional
                        'libraryDir' => null, //optional
                        'libraryRoute' => 'comur_api_image_library', //optional
                        'showLibrary' => false //optional                        
                    ),
                    'cropConfig' => array(
                        'minWidth' => 240,
                        'minHeight' => 300,
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
                ->add('institucion', 'text', array('required' => true, 'attr' => array('placeholder' => 'Institución')))
                ->add('departamento', 'text', array('required' => true, 'attr' => array('placeholder' => 'Facultad')))
                ->add('ingreso', 'integer', array('required' => true, 'attr' => array('placeholder' => 'Año de Ingreso')))
                
                ->add('contancia', 'comur_image', array(
                    'uploadConfig' => array(
                        'uploadRoute' => 'comur_api_upload', //optional
                        'uploadUrl' => $pEntity->getUploadRootDirContancia(), // required - see explanation below (you can also put just a dir path)
                        'webDir' => '../web/' . $pEntity->getUploadDirContancia(), // required - see explanation below (you can also put just a dir path)
                        'fileExt' => '*.jpg;*.gif;*.png;*.jpeg', //optional
                        'libraryDir' => null, //optional
                        'libraryRoute' => 'comur_api_image_library', //optional
                        'showLibrary' => false //optional                        
                    ),
                    'cropConfig' => array(
                        'minWidth' => 240,
                        'minHeight' => 300,
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
                
                
                ->add('carnet', 'comur_image', array(
                    'uploadConfig' => array(
                        'uploadRoute' => 'comur_api_upload', //optional
                        'uploadUrl' => $pEntity->getUploadRootDirCarnet(), // required - see explanation below (you can also put just a dir path)
                        'webDir' => '../web/' . $pEntity->getUploadDirCarnet(), // required - see explanation below (you can also put just a dir path)
                        'fileExt' => '*.jpg;*.gif;*.png;*.jpeg', //optional
                        'libraryDir' => null, //optional
                        'libraryRoute' => 'comur_api_image_library', //optional
                        'showLibrary' => false //optional                        
                    ),
                    'cropConfig' => array(
                        'minWidth' => 240,
                        'minHeight' => 300,
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
                
                ->add('altura', 'integer', array('required' => true, 'attr' => array('placeholder' => 'Altura (Cms)')))
                ->add('peso', 'integer', array('required' => true, 'attr' => array('placeholder' => 'Peso (Kgrs)')))
                ->add('tipoSangre', SangreType::class, array('placeholder' => 'Tipo de Sangre',))
                ->add('alergias', 'textarea', array('required' => false, 'attr' => array('rows' => '2', 'placeholder' => 'Alergias')))
                ->add('contactoNombre', 'text', array('required' => true, 'attr' => array('placeholder' => 'Nombre del Contacto en Caso de Emergencia')))
                ->add('contactoTelefono', 'text', array('required' => true, 'attr' => array('placeholder' => 'Teléfono de Contacto en Caso de Emergencia')))
                ->add('tallaFranela', TallaRopaType::class, array('placeholder' => 'Talla Franela',))
                ->add('tallaPantalon', TallaRopaType::class, array('placeholder' => 'Talla Pantalón',))
                ->add('tallaPantalonCorto', TallaRopaType::class, array('placeholder' => 'Talla Pantalón Corto',))
                ->add('tallaChaqueta', TallaRopaType::class, array('placeholder' => 'Talla Chaqueta',))
                ->add('tallaGorra', TallaRopaType::class, array('placeholder' => 'Talla Gorra',))
                ->add('tallaMedias', TallaMediasType::class, array('placeholder' => 'Talla Medias',))
                ->add('tallaZapato', TallaZapatosType::class, array('placeholder' => 'Talla Zapato',))
                ->add('status', StatusType::class, array('placeholder' => 'Status',))
                ->add('observacion', 'textarea', array('required' => false, 'attr' => array('rows' => '4', 'placeholder' => 'Observaciones')))
        ;
    }

    /**
      @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Atletas'
        ));
    }

}
