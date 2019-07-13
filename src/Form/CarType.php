<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule',TextType::class,[ 'label_format' => 'Matricule', 'attr'=>['placeholder'=>"numéro du matricule"] ])
            ->add('marque',TextType::class,[ 'label_format' => 'Marque', 'attr'=>['placeholder'=>"marque de la voiture"] ])
            ->add('model',TextType::class,[ 'label_format' => 'Modèle', 'attr'=>['placeholder'=>"modèle de la voiture"] ])
            ->add('category', ChoiceType::class, ['label_format' => 'Catégorie',
                'choices' => ['Mariage' => 'mariage', 'Citadine' => 'citadine'],
            ])
            ->add('imageFile', FileType::class,[ 'required'=>false,'attr'=>['placeholder'=>"ajouter une image"]])
            ->add('carburant',TextType::class,[ 'label_format' => 'Carburant', 'attr'=>['placeholder'=>"essence ou gazoil"] ])
            ->add('year',TextType::class,[ 'label_format' => 'Année', 'attr'=>['placeholder'=>"année de mise en fonction de la voiture"] ])
            ->add('price',TextType::class,[ 'label_format' => 'Prix', 'attr'=>['placeholder'=>"prix de la location par jour"] ])
            ->add('caution',TextType::class,[ 'label_format' => 'Caution', 'attr'=>['placeholder'=>"caution"] ])
            ->add('boitAVitesse', CheckboxType::class, [
                'label'    => 'boite a vitesse auto',
                'required' => false,'label_format' => 'Boite à vitesse',
                
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
