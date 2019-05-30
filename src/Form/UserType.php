<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email' , EmailType::class,[ 'attr'=>['placeholder'=>"votre email"] ])
            ->add('mdp', PasswordType::class,[ 'attr'=>['placeholder'=>"votre password"] ])
            ->add('nom',TextType::class,[ 'attr'=>['placeholder'=>"votre nom"] ])
            ->add('prenom',TextType::class,[ 'attr'=>['placeholder'=>"votre prenom"] ])
            ->add('datedenaissance', BirthdayType::class, [
                'placeholder' =>  [
                     'month' => 'Month', 'day' => 'Day','year' => 'Year',
                ]
            ])
            ->add('adresse',TextareaType::class, [
                'attr' => ['class' => 'tinymce'],
            ])
            ->add('ville', TextType::class)
            ->add('codepostal')
            ->add('numtel',NumberType::class,[ 'attr'=>['placeholder'=>"votre numero"] ])
            ->add('numpermis',NumberType::class,[ 'attr'=>['placeholder'=>"votre numero permis"] ])
            ->add('anneepermis', DateType::class, [
                'widget' => 'choice',
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
