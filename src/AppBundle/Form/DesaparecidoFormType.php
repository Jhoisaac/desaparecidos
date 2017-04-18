<?php

namespace AppBundle\Form;

use AppBundle\AppBundle;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class DesaparecidoFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellido')
            ->add('estado_civil')
            //->add('path',HiddenType::class,array('mapped'=>false))
            ->add('foto',FileType::class,array('label'=>'Foto Desaparecido','data_class' => null))
            /*->add('foto', VichImageType::class, [
                'label' => 'Foto',
                'required' => false,
                'allow_delete' => true, // not mandatory, default is true
                'download_link' => false, // not mandatory, default is true
            ])*/
            ->add('edad', TextType::class)
            ->add('cedula')
            ->add('genero')
            ->add('altura')
            ->add('fecha_ingreso')
            ->add('fecha_lost')
            ->add('estado')
            ->add('contextura')
            ->add('color_piel')
            ->add('color_cabello')
            ->add('color_ojos')
            ->add('largo_cabello')
            ->add('contextura_cabello')
            ->add('forma_cara')
            ->add('forma_nariz')
            ->add('forma_ojos')
            ->add('forma_labios')
            ->add('barba')
            ->add('bigote');
            /*->add('discapacidad', EntityType::class,array('label'=>'Discapacidad',
                                                          'class'=>'AppBundle:Desaparecido',
                                                          'choice_label'=>'discapacidad',
                                                          'query_builder'=>function(EntityRepository $er){
                                                    return $er->createQueryBuilder('estadoDiscapacidad=1');}));*/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Desaparecido',
            //'validation_groups' => ['Default', 'Desaparecido']
        ]);
    }

    public function getName()
    {
        return 'app_bundle_desaparecido_form_type';
    }
}
