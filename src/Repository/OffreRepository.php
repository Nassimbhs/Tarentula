<?php

namespace App\Repository;

use App\Entity\Offre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Offre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offre[]    findAll()
 * @method Offre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offre::class);
    }

    public function findLike($titre)
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.numoffre LIKE :titre or a.disponibilite LIKE :titre')
            ->setParameter( 'titre', "%$titre%")
            ->orderBy('a.numoffre')
            ->setMaxResults(5)
            ->getQuery()
            ->execute()
            ;
    }
    public function findAllLike($titre)
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.numoffre LIKE :titre or a.disponibilite LIKE :titre')
            ->setParameter( 'titre', "%$titre%")
            ->orderBy('a.numoffre')
            ->getQuery()
            ->execute()
            ;
    }

    public function TrierParDateCreation()
    {
        return $this
            ->createQueryBuilder('a')
            ->orderBy('a.dateCreation')
            ->getQuery()
            ->execute()
            ;
    }

    public function TrierParDateFin()
    {
        return $this
            ->createQueryBuilder('a')
            ->orderBy('a.dateExpiration')
            ->getQuery()
            ->execute()
            ;
    }

    public function TrierParDisponibilite()
    {
        return $this
            ->createQueryBuilder('a')
            ->orderBy('a.disponibilite')
            ->getQuery()
            ->execute()
            ;
    }

    // /**
    //  * @return Offre[] Returns an array of Offre objects
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
    public function findOneBySomeField($value): ?Offre
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
