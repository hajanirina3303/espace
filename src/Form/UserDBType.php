<?php

namespace App\Form;

use App\Entity\UserDB;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserDBType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'username',
                TextType::class,
                [
                    'label' => 'Identifiant',
                    'attr' => ['class' => 'form-control', 'placeholder' => 'Pseudo']
                ]
            )
            ->add(
                'nom',
                TextType::class,
                [
                    'label' => 'Nom',
                    'attr' => ['class' => 'form-control','placeholder' => 'lastname']
                ]
            )
            ->add(
                'prenom',
                TextType::class,
                [
                    'label' => 'Prenom', 'attr' => ['class' => 'form-control','placeholder' => 'firstname']
                ]
            )

            ->add(
                'password',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'first_options' =>
                    [
                        'label' => 'Mot de passe', 'attr' => ['class' => 'form-control','placeholder' => 'Password']
                    ],
                    'second_options' =>
                    [
                        'label' => 'Confirmation Mot de passe', 'attr' => ['class' => 'form-control','placeholder' => 'Password']
                    ],
                    'invalid_message' => 'Les 2 mot de passe ne correspondent pas',

                ]
            )
            ->add(
                'roles',
                ChoiceType::class,
                [
                    'label' => 'Choix de role',
                    'choices' => [
                        'ADMIN' => 'ROLE_ADMIN',
                        'CONSULTANT' => 'ROLE_CONSULTANT',
                        'EDITEUR' => 'ROLE_EDITEUR',
                    ],
                    'choice_label' => function ($label) {
                        if($label=='ROLE_ADMIN'){ 
                            return 'ADMINISTRATEUR';}                                               
                        elseif($label == 'ROLE_CONSULTANT'){
                            return 'CONSULTATION';
                        }
                        else{
                            return 'MISE A JOUR';
                        }
                    },
                    'choice_value' => function ($value) {
                        return $value;
                    },
                    'required' => true,
                    'multiple' => true,
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserDB::class,
        ]);
    }
}
