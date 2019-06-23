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
            ->add('email' , EmailType::class,[  'label_format' => 'Email', 'attr'=>['placeholder'=>"votre email"] ])
            ->add('mdp', PasswordType::class,[ 'label_format' => 'Mot de passe', 'attr'=>['placeholder'=>"votre password"] ])
            ->add('mdp2', PasswordType::class,[ 'label_format' => 'Confirmation du mot de passe', 'attr'=>['placeholder'=>"verifier votre password"] ])
            ->add('nom',TextType::class,[ 'label_format' => 'Nom', 'attr'=>['placeholder'=>"votre nom"] ])
            ->add('prenom',TextType::class,[ 'label_format' => 'Prénom', 'attr'=>['placeholder'=>"votre prenom"] ])
            ->add('datedenaissance', BirthdayType::class, ['label_format' => 'Date de naissance', 
                'placeholder' =>  [
                     'month' => 'Mois', 'day' => 'Jour','year' => 'Année',
                ]
            ])
            ->add('adresse',TextareaType::class, ['label_format' => 'Adresse', 
                'attr' => ['class' => 'tinymce'],
            ])
            ->add('ville', TextType::class, ['label_format' => 'Ville'])
            ->add('codepostal',NumberType::class, ['label_format' => 'Code postal'])
            ->add('numtel',NumberType::class,[ 'label_format' => 'Numéro de téléphone', 'attr'=>['placeholder'=>"votre numero"] ])
            ->add('numpermis',NumberType::class,[ 'label_format' => 'Numéro de permis', 'attr'=>['placeholder'=>"votre numero permis"] ])
            ->add('anneepermis', DateType::class ,['label_format' => 'Année de permis'])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
