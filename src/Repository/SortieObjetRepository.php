<?php

namespace App\Repository;

use App\Entity\SortieObjet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SortieObjet|null find($id, $lockMode = null, $lockVersion = null)
 * @method SortieObjet|null findOneBy(array $criteria, array $orderBy = null)
 * @method SortieObjet[]    findAll()
 * @method SortieObjet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieObjetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SortieObjet::class);
    }

  

    // /**
    //  * @return SortieObjet[] Returns an array of SortieObjet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SortieObjet
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
