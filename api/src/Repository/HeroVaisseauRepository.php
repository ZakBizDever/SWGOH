<?php

namespace App\Repository;

use App\Entity\HeroVaisseau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HeroVaisseau>
 *
 * @method HeroVaisseau|null find($id, $lockMode = null, $lockVersion = null)
 * @method HeroVaisseau|null findOneBy(array $criteria, array $orderBy = null)
 * @method HeroVaisseau[]    findAll()
 * @method HeroVaisseau[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeroVaisseauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HeroVaisseau::class);
    }

    public function findHerosByAllyCode($allyCode)
    {
        return $this->createQueryBuilder('h')
            ->where('h.player_code = :allyCode')
            ->andWhere('h.combat_type = :combat_type')
            ->setParameter('combat_type', 1)
            ->setParameter('allyCode', $allyCode)
            ->getQuery()
            ->getResult();
    }

    public function findVaisseauxByAllyCode($allyCode)
    {
        return $this->createQueryBuilder('v')
            ->where('v.player_code = :allyCode')
            ->andWhere('v.combat_type = :combat_type')
            ->setParameter('combat_type', 2)
            ->setParameter('allyCode', $allyCode)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return HeroVaisseau[] Returns an array of HeroVaisseau objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HeroVaisseau
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
