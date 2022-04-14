<?php

namespace App\Form;

use App\Entity\Rubrique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RubriqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Refrubrique',TextType::class,[
                
                'attr' => ['class' => 'form-control', 'placeholder' => 'rubrique']
            ])
            ->add('libellerubrique', TextType::class,[
                'attr' =>['class' => 'form-control']
            ])
            ->add('type', ChoiceType::class,[ 
                    'label'=>'Type', 
                    'attr' => ['class' => 'form-control'],
                    'choices' =>['Recette','Pensionnaire','Centre'],
                    'choice_value' => function (?String $type) {
                        return $type;
                    },
                    'choice_label' => function (?String $type) {
                        return $type;
                    } 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rubrique::class,
        ]);
    }
}
