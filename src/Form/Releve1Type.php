<?php

namespace App\Form;

use App\Entity\Releve;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Releve1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
         $builder
            ->add('datereleve',DateType::class,[
                'widget' => 'single_text',
                'html5' => true,
                'input_format' => 'dd/mm/yyyy',
                'required'=>true,
                'attr' => ['class' => 'form-control']
            ])

            ->add('datedebut', DateType::class,[
                'widget' => 'single_text',
                'html5' => true,
                'input_format' => 'dd/mm/yyyy',
                'required'=>true,
                'attr' => ['class' => 'form-control']
            ])
            ->add('datefin', DateType::class,[
                'widget' => 'single_text',
                'html5' => true,
                'input_format' => 'dd/mm/yyyy',
                'required'=>true,
                'attr' => ['class' => 'form-control']
            ])
            ->add('montantdebut',NumberType::class,[
                'attr' => ['class' => 'form-control']
            ])
            ->add('montantfin',NumberType::class,[
                'attr' => ['class' => 'form-control']])
            
            ->add('file',FileType::class,[
                'mapped' => false,
                'attr' => ['class' => 'form-control']
            ]);
           
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Releve::class,
        ]);
    }
}
