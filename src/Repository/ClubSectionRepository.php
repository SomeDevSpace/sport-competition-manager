<?php

namespace App\Repository;

use App\Entity\ClubSection;
use App\Entity\Sport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClubSection>
 */
class ClubSectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClubSection::class);
    }

    /**
     * @param Sport $sport
     * @return ClubSection[] Returns an array of ClubSection objects filtered by sport
     */
    public function findBySport(Sport $sport): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.sport = :sport')
            ->setParameter('sport', $sport)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return ClubSection[] Returns an array of ClubSection objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ClubSection
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
