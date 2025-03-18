<?php

namespace App\Repository;

use App\Entity\Competition;
use App\Entity\CompetitionDiscipline;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompetitionDiscipline>
 */
class CompetitionDisciplineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompetitionDiscipline::class);
    }

    public function findByCompetition(Competition $competition): array
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.competition = :competition')
            ->setParameter('competition', $competition)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return CompetitionDiscipline[] Returns an array of CompetitionDiscipline objects
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

    //    public function findOneBySomeField($value): ?CompetitionDiscipline
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
