<?php

namespace App\Repository;

use App\Entity\Emploi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Emploi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Emploi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Emploi[]    findAll()
 * @method Emploi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmploiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Emploi::class);
    }


    public function findLike($titre)
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.nomEmploi LIKE :titre or a.disponibilite LIKE :titre')
            ->setParameter( 'titre', "%$titre%")
            ->orderBy('a.nomEmploi')
            ->setMaxResults(5)
            ->getQuery()
            ->execute()
            ;
    }
    public function findAllLike($titre)
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.nomEmploi LIKE :titre or a.disponibilite LIKE :titre')
            ->setParameter( 'titre', "%$titre%")
            ->orderBy('a.nomEmploi')
            ->getQuery()
            ->execute()
            ;
    }
    public function TrierParNomEmploi()
    {
        return $this
            ->createQueryBuilder('a')
            ->orderBy('a.nomEmploi')
            ->getQuery()
            ->execute()
            ;
    }

    public function TrierParDisponiblite()
    {
        return $this
            ->createQueryBuilder('a')
            ->orderBy('a.disponibilite')
            ->getQuery()
            ->execute()
            ;
    }

    public function TrierParAgeMin()
    {
        return $this
            ->createQueryBuilder('a')
            ->orderBy('a.agemin')
            ->getQuery()
            ->execute()
            ;
    }

    public function TrierParAgeMax()
    {
        return $this
            ->createQueryBuilder('a')
            ->orderBy('a.agemax')
            ->getQuery()
            ->execute()
            ;
    }
    // /**
    //  * @return Emploi[] Returns an array of Emploi objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Emploi
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
