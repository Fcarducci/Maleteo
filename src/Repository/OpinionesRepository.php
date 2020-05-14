<?php

namespace App\Repository;

use App\Entity\Opiniones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Opiniones|null find($id, $lockMode = null, $lockVersion = null)
 * @method Opiniones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Opiniones[]    findAll()
 * @method Opiniones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpinionesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Opiniones::class);
    }

    // /**
    //  * @return Opiniones[] Returns an array of Opiniones objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Opiniones
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
