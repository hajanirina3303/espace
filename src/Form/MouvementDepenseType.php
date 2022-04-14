<?php

namespace App\Form;

use App\Entity\Rubrique;
use App\Repository\MouvementRepository;
use App\Repository\RubriqueRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;

class MouvementDepenseType extends AbstractType
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
    
        $last = $this->mouvementRepository->findLast();
        $lastmouvementdate = new \DateTime('2000-01-01');
        if(count($last)!=0)
        $lastmouvementdate = $last[0]->getDatemouvement()->setTime(0,0,0,0);

        $builder
        ->add('rubriqueRef', EntityType::class,
        [
            'class' => Rubrique::class,
            'label'=>'Rubrique (*)', 
            'placeholder'=>'',
            'attr' => ['class' => 'form-control'],
            'choices' => $this->rubriqueRepository->findDepense(),
            'choice_value' => function (?Rubrique $rubrique) {
                return $rubrique!=null?$rubrique->getRefrubrique():'';
            },
            'choice_label' => function (?Rubrique $rubrique) {
                return $rubrique!=null?$rubrique->getRefrubrique():'';
            },
        ])        
        ->add('datemouvement',DateType::class,[
            'widget' => 'single_text',
            'html5' => true,
            'label' => 'Date depense(*)',
            'input_format' => 'dd/mm/yyyy',
            'required'=>true,
            'attr' => ['class' => 'form-control'],
            'constraints'=>[
                new LessThanOrEqual(new \DateTime(), null, "doit etre avant Aujourd'hui {{ compared_value }}"), 
            new GreaterThanOrEqual($lastmouvementdate, null, "Doit etre apres {{ compared_value }}")]
        ])
        ->add('numeroPiece',NumberType::class ,[
            'label' => 'Numero piece de depense(*)',
            'invalid_message' => 'doit etre un nombre',
            'html5' => true,
            'required' => true,
            'attr' => ['placeholder' => 'Numero Piece de depense','class' => 'form-control'],
        ])
        ->add('libellepiece',TextType::class ,[
            'label' => 'Piece de depense(*)',
            'required' => true,
            'attr' => ['placeholder' => 'Libelle','class' => 'form-control'],
        ])
        ->add('datepiece',DateType::class,[
            'widget' => 'single_text',
            'html5' => true,
            'label' => 'Date Piece(*)',
            'input_format' => 'dd/mm/yyyy',
            'required'=>true,
            'attr' => ['class' => 'form-control']
        ])        
        ->add('description',TextType::class ,[
            'label' => 'Description depense(*)',
            'required' => true,
            'attr' => ['placeholder' => 'Description','class' => 'form-control'],
        ])->add('montant',NumberType::class, [
                'required' => true,
                'label' => 'Montant(*)',
                'scale'=> 2,
                'invalid_message' => 'doit etre un nombre',
                'html5' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Montant',
                    'step'=> 'any'
                ]
        ])         
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           
        ]);
    }
}
