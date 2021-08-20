<?php

namespace App\Repository;

use App\Entity\BlogMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogMessage[]    findAll()
 * @method BlogMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogMessage::class);
    }

    // /**
    //  * @return BlogMessage[] Returns an array of BlogMessage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BlogMessage
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
