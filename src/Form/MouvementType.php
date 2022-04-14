<?php

namespace App\Form;

use App\Entity\Mouvement;
use App\Entity\Piece;
use App\Entity\Rubrique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MouvementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('rubriqueRef',EntityType::class,['class' => Rubrique::class,'label'=>'Rubrique', 'attr' => ['class' => 'form-control']])
            ->add('datemouvement',DateType::class,[
                    'widget' => 'single_text',
                'html5' => true,
                'label' => 'Date mouvement',
                'input_format' => 'dd/mm/yyyy',
                'required'=>true,
                'attr' => ['class' => 'form-control']
            ])
            ->add('montant',NumberType::class, [
                'required' => false,
                'label' => 'Montant',
                'scale'=> 2,
                'invalid_message' => 'doit etre un nombre',
                'html5' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Montant',
                    'step'=> 'any'
                ]
                ])
            ->add('description',TextType::class ,[
                'required' => false,
                'attr' => ['placeholder' => 'Description','class' => 'form-control'],
            ])
            ->add('piece', EntityType::class, ['class' => Piece::class,'attr' => ['class' => 'form-control']])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mouvement::class,
        ]);
    }
}
