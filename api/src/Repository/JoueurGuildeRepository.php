<?php

namespace App\Repository;

use App\Entity\JoueurGuilde;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JoueurGuilde>
 *
 * @method JoueurGuilde|null find($id, $lockMode = null, $lockVersion = null)
 * @method JoueurGuilde|null findOneBy(array $criteria, array $orderBy = null)
 * @method JoueurGuilde[]    findAll()
 * @method JoueurGuilde[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JoueurGuildeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JoueurGuilde::class);
    }

//    /**
//     * @return JoueurGuilde[] Returns an array of JoueurGuilde objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JoueurGuilde
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
