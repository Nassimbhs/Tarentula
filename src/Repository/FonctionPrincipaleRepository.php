<?php

namespace App\Repository;

use App\Entity\FonctionPrincipale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FonctionPrincipale|null find($id, $lockMode = null, $lockVersion = null)
 * @method FonctionPrincipale|null findOneBy(array $criteria, array $orderBy = null)
 * @method FonctionPrincipale[]    findAll()
 * @method FonctionPrincipale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FonctionPrincipaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FonctionPrincipale::class);
    }


    public function findLike($titre)
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.nomFonction LIKE :titre ')
            ->setParameter( 'titre', "%$titre%")
            ->orderBy('a.nomFonction')
            ->setMaxResults(5)
            ->getQuery()
            ->execute()
            ;
    }
    public function findAllLike($titre)
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.nomFonction LIKE :titre')
            ->setParameter( 'titre', "%$titre%")
            ->orderBy('a.nomFonction')
            ->getQuery()
            ->execute()
            ;
    }

    // /**
    //  * @return FonctionPrincipale[] Returns an array of FonctionPrincipale objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FonctionPrincipale
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
