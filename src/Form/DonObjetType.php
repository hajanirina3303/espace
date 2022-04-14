<?php

namespace App\Form;

use App\Entity\DonObjet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DonObjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateObjet',DateType::class,[
                'widget' => 'single_text',
                'html5' => true,
                'label' => 'Date don (*)',
                'input_format' => 'dd/mm/yyyy',
                'required'=>true,
                'attr' => ['class' => 'form-control']
                ])
            ->add('nomDonnateur',TextType::class,[
                'label' => 'Nom donnateur (*)',
                'required' => true,
                'attr' => ['placeholder' => 'donnateur','class' => 'form-control'],
            ])
            ->add('numeroPhone',TextType::class,[
                'label' => 'Numéro TPH donnateur (*)',
                'required' => true,
                'attr' => ['placeholder' => 'numero telephone donnateur','class' => 'form-control'],
            ])
            ->add('addresse',TextType::class,[
                'label' => 'Adresse du donnateur (*)',
                'required' => true,
                'attr' => ['placeholder' => 'adresse','class' => 'form-control'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DonObjet::class,
        ]);
    }
}
