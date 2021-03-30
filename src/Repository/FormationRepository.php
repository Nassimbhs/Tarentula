<?php

namespace App\Repository;

use App\Entity\Formation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Formation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formation[]    findAll()
 * @method Formation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formation::class);
    }

    public function findLike($titre)
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.idFormation LIKE :titre or a.domaine LIKE :titre or a.lieu LIKE :titre')
            ->setParameter( 'titre', "%$titre%")
            ->orderBy('a.idFormation')
            ->setMaxResults(5)
            ->getQuery()
            ->execute()
            ;
    }
    public function findAllLike($titre)
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.idFormation LIKE :titre or a.domaine LIKE :titre or a.lieu LIKE :titre')
            ->setParameter( 'titre', "%$titre%")
            ->orderBy('a.idFormation')
            ->getQuery()
            ->execute()
            ;
    }

    public function TrierParDomaine()
    {
        return $this
            ->createQueryBuilder('a')
            ->orderBy('a.domaine')
            ->getQuery()
            ->execute()
            ;
    }

    public function TrierParDuree()
    {
        return $this
            ->createQueryBuilder('a')
            ->orderBy('a.duree')
            ->getQuery()
            ->execute()
            ;
    }

    public function TrierParLieu()
    {
        return $this
            ->createQueryBuilder('a')
            ->orderBy('a.lieu')
            ->getQuery()
            ->execute()
            ;
    }

    // /**
    //  * @return Formation[] Returns an array of Formation objects
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
    public function findOneBySomeField($value): ?Formation
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
