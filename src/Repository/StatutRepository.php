<?php

namespace App\Repository;

use App\Entity\Statut;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Statut|null find($id, $lockMode = null, $lockVersion = null)
 * @method Statut|null findOneBy(array $criteria, array $orderBy = null)
 * @method Statut[]    findAll()
 * @method Statut[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatutRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Statut::class);
    }


    public function findLike($titre)
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.nomStatut LIKE :titre ')
            ->setParameter( 'titre', "%$titre%")
            ->orderBy('a.nomStatut')
            ->setMaxResults(5)
            ->getQuery()
            ->execute()
            ;
    }
    public function findAllLike($titre)
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.nomStatut LIKE :titre')
            ->setParameter( 'titre', "%$titre%")
            ->orderBy('a.nomStatut')
            ->getQuery()
            ->execute()
            ;
    }

    // /**
    //  * @return Statut[] Returns an array of Statut objects
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
    public function findOneBySomeField($value): ?Statut
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
