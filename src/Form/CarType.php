<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule')
            ->add('marque')
            ->add('model')
            ->add('category', ChoiceType::class, [
                'choices' => ['mariage' => false, 'citadine' => false],
            ])
            ->add('carburant')
            ->add('year')
            ->add('price')
            ->add('caution')
            ->add('boitAVitesse', CheckboxType::class, [
                'label'    => 'auto',
                'required' => false,
                
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
