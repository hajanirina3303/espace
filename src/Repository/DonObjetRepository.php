<?php

namespace App\Repository;

use App\Entity\DonObjet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DonObjet|null find($id, $lockMode = null, $lockVersion = null)
 * @method DonObjet|null findOneBy(array $criteria, array $orderBy = null)
 * @method DonObjet[]    findAll()
 * @method DonObjet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonObjetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DonObjet::class);
    }

    // /**
    //  * @return DonObjet[] Returns an array of DonObjet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DonObjet
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
