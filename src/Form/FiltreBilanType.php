<?php

namespace App\Form;

use App\Entity\Rubrique;
use App\Repository\MouvementRepository;
use App\Repository\RubriqueRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltreBilanType extends AbstractType
{
    private MouvementRepository $mouvementRepository;
    private RubriqueRepository $rubriqueRepository;
    
    public function __construct(
        RubriqueRepository $rubriqueRepository,
        MouvementRepository $mouvementRepository
    )
    {
        //repository
        $this->mouvementRepository = $mouvementRepository;
        $this->rubriqueRepository = $rubriqueRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('annee',NumberType::class, [
            'required' => true,
            'label' => 'Annee',
            'scale'=> 0,
            'invalid_message' => 'doit etre un nombre',
            'html5' => true,
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Annee',
                'step'=> 'any'
            ]
        ]) 
      
        ->add('type',ChoiceType::class,[ 
            'label'=>'Choix obligatoire', 
            'placeholder' => '',
            'required' => true,
            'attr' => ['class' => 'form-control'],
            'choices' =>['Mensuel','Trimestriel','Semestriel', 'Annuel'],
            'choice_value' => function (?String $type) {
                return $type;
            },
            'choice_label' => function (?String $type) {
                return $type;
            } 
        ])
        ->add('mensuel',ChoiceType::class,[ 
            'label'=>'Mois de', 
            'attr' => ['class' => 'form-control'],
            'choices' =>[new Moiss(1,'Janvier'), new Moiss(2,'Février'), new Moiss (3,'Mars'), new Moiss(4,'Avril'), new Moiss(5,'Mai'), new Moiss(6,'Juin'), new Moiss(7, 'Juillet'),new Moiss(8,'Août'),new Moiss(9,'Septembre'),new Moiss(10,'Octobre'),new Moiss(11,'Novembre'),new Moiss(12,'Décembre')],
            'choice_value' => function (?Moiss $type) {
                return $type!=null?$type->id:'' ;
            },
            'choice_label' => function (?Moiss $type) {
                return $type!=null?$type->label:'' ;
            } 
        ])
        ->add('trimestriel',ChoiceType::class,[ 
            'label'=>'Trimestre', 
            'attr' => ['class' => 'form-control'],
            'choices' =>[1,2,3,4],
            'choice_value' => function ($type) {
                return $type;
            },
            'choice_label' => function ($type) {
                return $type;
            } 
        ])
        ->add('semestre',ChoiceType::class,[ 
            'label'=>'Semestre', 
            'attr' => ['class' => 'form-control'],
            'choices' =>[1,2],
            'choice_value' => function ($type) {
                return $type;
            },
            'choice_label' => function ($type) {
                return $type;
            } 
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           
        ]);
    }

    
    
}
class Moiss 
    {
        public $id;
        public $label;
        public function __construct(
            $id,
            $label
        )
        {
           $this->id = $id;
           $this->label = $label;
        }
    }