<?php

namespace App\Repository;

use App\Entity\UserMonitoring;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserMonitoring|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserMonitoring|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserMonitoring[]    findAll()
 * @method UserMonitoring[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserMonitoringRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserMonitoring::class);
    }

//    /**
//     * @return UserMonitoring[] Returns an array of UserMonitoring objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserMonitoring
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
