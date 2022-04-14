<?php

namespace App\Form;

use App\Entity\DonObjet;
use App\Entity\Objet;
use App\Entity\Rubrique;
use App\Repository\DonObjetRepository;
use App\Repository\MouvementRepository;
use App\Repository\RubriqueRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjetType extends AbstractType
{
    private MouvementRepository $mouvementRepository;
    private RubriqueRepository $rubriqueRepository;
    private DonObjetRepository $donObjetRepository;
    
    public function __construct(
        RubriqueRepository $rubriqueRepository,
        MouvementRepository $mouvementRepository,
        DonObjetRepository $donObjetRepository
    )
    {
        //repository
        $this->mouvementRepository = $mouvementRepository;
        $this->rubriqueRepository = $rubriqueRepository;
        $this->donObjetRepository = $donObjetRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('quantite')
            ->add('valeur')
            ->add('rubrique',EntityType::class,
            [
                'class' => Rubrique::class,
                'label'=>'Rubrique', 
                'attr' => ['class' => 'form-control'],
                'choices' => $this->rubriqueRepository->findDepense(),
                'choice_value' => function (?Rubrique $rubrique) {
                    return $rubrique!=null?$rubrique->getRefrubrique():'';
                },
                'choice_label' => function (?Rubrique $rubrique) {
                    return $rubrique!=null?$rubrique->getRefrubrique():'';
                },
            ])        
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Objet::class,
        ]);
    }
}
