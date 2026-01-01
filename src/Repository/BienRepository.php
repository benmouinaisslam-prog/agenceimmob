<?php

namespace App\Repository;

use App\Entity\Bien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bien>
 */
class BienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bien::class);
    }

    /**
     * Search biens with optional filters.
     *
     * @return Bien[]
     */
    public function search(?string $type, ?string $q, ?string $statut): array
    {
        $qb = $this->createQueryBuilder('b');

        if ($type) {
            $qb->andWhere('b.type = :type')
               ->setParameter('type', $type);
        }

        if ($q) {
            $qb->andWhere('b.titre LIKE :q OR b.localisation LIKE :q')
               ->setParameter('q', '%'.str_replace('%','\\%',$q).'%');
        }

        if ($statut) {
            $qb->andWhere('b.statut = :statut')
               ->setParameter('statut', $statut);
        }

        return $qb->orderBy('b.id', 'DESC')
                  ->getQuery()
                  ->getResult();
    }

    //    /**
    //     * @return Bien[] Returns an array of Bien objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Bien
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
