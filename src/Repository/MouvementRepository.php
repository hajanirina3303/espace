<?php

namespace App\Repository;

use App\Entity\Depense;
use App\Entity\Mouvement;
use App\Entity\Recette;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mouvement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mouvement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mouvement[]    findAll()
 * @method Mouvement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MouvementRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $em;
    
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $em)
    {
        parent::__construct($registry, Mouvement::class);
        $this->em = $em;
    }

    public function findSoldeByDate(DateTime $date_Solde){

        //recette
        $recette = $this->em->createQueryBuilder()
        ->select('SUM(rm.montant)')
        ->from(Recette::class, 'r')
        ->join('r.idrecette', 'rm')
        ->andWhere('rm.datemouvement < :date_solde')
        ->setParameter('date_solde',$date_Solde)
        ->getQuery(); 
        $recette_motant = $recette->getSingleScalarResult();

       

        //depense
        $depense = $this->em->createQueryBuilder()
            ->select('SUM(dm.montant)')
            ->from(Depense::class, 'd')
            ->join('d.iddepense', 'dm')
            ->andWhere('dm.datemouvement < :date_solde')
            ->setParameter('date_solde',$date_Solde)
            ->getQuery(); 
        $depense_montant = $depense->getSingleScalarResult();
        $solde = $recette_motant - $depense_montant;
        return $solde;
    }

    
    public function findSoldeById($id){

        //recette
        $recette = $this->em->createQueryBuilder()
        ->select('SUM(rm.montant)')
        ->from(Recette::class, 'r')
        ->join('r.idrecette', 'rm')
        ->andWhere('rm.idmouvement < :idm')
        ->setParameter('idm',$id)
        ->getQuery(); 
        $recette_motant = $recette->getSingleScalarResult();

       

        //depense
        $depense = $this->em->createQueryBuilder()
            ->select('SUM(dm.montant)')
            ->from(Depense::class, 'd')
            ->join('d.iddepense', 'dm')
            ->andWhere('dm.idmouvement < :idm')
            ->setParameter('idm',$id)
            ->getQuery(); 
        $depense_montant = $depense->getSingleScalarResult();
        $solde = $recette_motant - $depense_montant;
        return $solde;
    }
    
    public function findByDate($date_debut, $date_fin)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.datemouvement >= :date_debut')
            ->andWhere('r.datemouvement <= :date_fin')
            ->setParameter('date_debut', $date_debut)
            ->setParameter('date_fin', $date_fin)
            ->orderBy('r.datemouvement', 'DESC')
            ->orderBy('r.idmouvement', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findLast10($date_fin)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.datemouvement <= :date_fin')
            ->setParameter('date_fin', $date_fin)
            ->orderBy('r.datemouvement', 'DESC')
            ->orderBy('r.idmouvement', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findLast()
    {
        return $this->createQueryBuilder('r')
            ->orderBy('r.datemouvement', 'DESC')
            ->orderBy('r.idmouvement', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    

    // /**
    //  * @return Mouvement[] Returns an array of Mouvement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mouvement
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
