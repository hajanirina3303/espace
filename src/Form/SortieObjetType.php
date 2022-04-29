<?php

namespace App\Form;

use App\Entity\Objet;
use App\Entity\SortieObjet;
use App\Repository\ObjetRepository;
use App\Repository\SortieObjetRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieObjetType extends AbstractType
{
    private SortieObjetRepository $sortieObjetRepository;


    public function __construct(
        ObjetRepository $objetRepository
    )
    {
        //repository
        $this->objetRepository = $objetRepository;
   
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $objets = array();
        foreach ($this->objetRepository->findObjet() as $objet) {
            if ($objet->getResteQuantite(0) > 0) // seul les quantites superieur à 0 sont affiché
            array_push($objets, $objet);            
        }
        $builder
            ->add('date_sortie', DateType::class,
            [
                'widget' => 'single_text',
                'html5' => true,
                'label' =>  'Date sortie',
                'input_format' => 'dd/mm/yyyy',
                'required'=>true,
                'attr' => ['class' => 'form-control']
            ])
                   
            ->add('objet', EntityType::class,
            [
                'class' => Objet::class,
                'label'=>'Objet', 
                'attr' => ['class' => 'form-control'],
                'choices' => $objets,
                'choice_value' => function (?Objet $objet) {
                    return $objet!=null?$objet->getId():'';
                },
                'choice_label' => function (?Objet $objet) {
                    return $objet!=null?$objet->getDescription():'';
                },
            ])  
             ->add('unite_objet',NumberType::class,[ 'label'=> 'Unité objet à sortir','attr' => ['class' => 'form-control']])      
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SortieObjet::class,
        ]);
    }
}
