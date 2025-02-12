<?php

namespace App\Repository;

use App\Entity\Randonne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Randonne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Randonne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Randonne[]    findAll()
 * @method Randonne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RandonneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Randonne::class);
    }

    // /**
    //  * @return Randonne[] Returns an array of Randonne objects
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
    public function findOneBySomeField($value): ?Randonne
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
