<?php

namespace App\Form;

use App\Entity\Rubrique;
use App\Repository\MouvementRepository;
use App\Repository\RubriqueRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltreType extends AbstractType
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
      
        ->add('dateDebut',DateType::class,[
            'widget' => 'single_text',
            'html5' => true,
            'label' => 'Date debut',
            'input_format' => 'dd/mm/yyyy',
            'required'=>true,
            'attr' => ['class' => 'form-control']
        ])
        ->add('dateFin',DateType::class,[
            'widget' => 'single_text',
            'html5' => true,
            'label' => 'Date fin',
            'input_format' => 'dd/mm/yyyy',
            'required'=>true,
            'attr' => ['class' => 'form-control']
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           
        ]);
    }
}
