<?php

namespace App\Repository;

use App\Entity\Rubrique;
use App\Entity\Bilan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rubrique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rubrique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rubrique[]    findAll()
 * @method Rubrique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RubriqueRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $em;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManagerInterface)
    {
        parent::__construct($registry, Rubrique::class);
        $this->em = $entityManagerInterface;
    }

    public function findRecette()
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.refrubrique = :rct')
            ->setParameter('rct', "RCT")
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findDepense()
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.refrubrique != :rct')
            ->setParameter('rct', "RCT")
            ->getQuery()
            ->getResult()
        ;
    }

    public function findBilan($month, $year)
    {
    
        $query = $this->em->getConnection()->prepare("
            SELECT 
            r.LibelleRubrique as libelle,
            CASE 
                WHEN r.type IS NULL THEN 'Autre' 
                ELSE r.type
            END 
            as type, 
            CASE
            WHEN rct.idRecette IS NULL THEN 'moins'
            ELSE 'plus'
            END
            as ttype,
            CASE
            WHEN m.idMouvement IS NULL THEN 0
            ELSE SUM(m.Montant)
            END 
            as montant
            FROM 
            rubrique r
            LEFT JOIN mouvement m ON m.rubrique_ref = r.RefRubrique AND YEAR(m.dateMouvement) = :year AND MONTH(m.dateMouvement) IN (".implode(',',$month).")
            LEFT JOIN recette rct ON rct.idRecette = m.idMouvement  
            GROUP BY r.RefRubrique
            ORDER BY r.type DESC
            ");       

            return $query->execute(array('year'=>$year))->fetchAll();
    }

    
   
    
    // /**
    //  * @return Rubrique[] Returns an array of Rubrique objects
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
    public function findOneBySomeField($value): ?Rubrique
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
