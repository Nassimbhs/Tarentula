<?php

namespace App\Repository;

use App\Entity\NomProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NomProduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method NomProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method NomProduit[]    findAll()
 * @method NomProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NomProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NomProduit::class);
    }

    // /**
    //  * @return NomProduit[] Returns an array of NomProduit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NomProduit
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
