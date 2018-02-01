<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    /** 
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ]);
            // ->add('sketchs', CollectionType::class, [
            //     'entry_type' => SketchType::class,
                // 'allow_add' => true,
                // 'allow_delete' => true,
                // 'required' => false,
            // ]);
            //->add('sketchs', SketchType::class);
            // ->add('sketchs', CollectionType::class, [
            //     'entry_type' => SketchType::class,
            //     //'type' => new SketchType();
            //     'label' => 'Sketch',
            //     'allow_add' => true,
            //     'allow_delete' => true,
            //     'required' => false,
            // ]);

            // https://github.com/braincrafted/bootstrap-bundle
        //     $form->add('sketchs', BootstrapCollectionType::class [
        //     'entry_type'         => SketchType::class,
        //     'label'              => 'Sketch(',
        //     'entry_options'      => [
        //     ],
        // ]));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Serie'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_serie';
    }


}
