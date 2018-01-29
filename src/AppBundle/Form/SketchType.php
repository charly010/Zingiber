<?php

namespace AppBundle\Form;

//use AppBundle\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//use Symfony\Component\Form\Extension\Core\Type\EntityType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SketchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title', TextType::class, [
            'label' => 'Titre',
        ])
        ->add('page', IntegerType::class, [
            'label' => 'Numéro de page',
        ])
        ->add('imageFile', FileType::class, [
            'required' => false,
        ]);
        // ->add('serie', EntityType::class, [
        //     'class' => Serie::class,
        //     'choice_label' => 'name',
        //     'required' => true,
        //     'query_builder' => $options['_queryBuilder'],
        // ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Sketch'
        ));
        //$resolver->setRequired([ '_queryBuilder' ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_sketch';
    }


}
