<?php

namespace App\Repository;

use App\Entity\Creations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Creations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Creations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Creations[]    findAll()
 * @method Creations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Creations::class);
    }

    // /**
    //  * @return Creations[] Returns an array of Creations objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Creations
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
