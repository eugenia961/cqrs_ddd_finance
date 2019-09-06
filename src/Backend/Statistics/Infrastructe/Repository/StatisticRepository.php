<?php

namespace App\Backend\Statistics\Infrastructe\Repository;

use App\Backend\Statistics\Domain\Entity\Statistic;
use App\Backend\Statistics\Domain\Interfaces\StatisticRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Statistic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Statistic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Statistic[]    findAll()
 * @method Statistic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatisticRepository extends ServiceEntityRepository implements StatisticRepositoryInterface {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Statistic::class);
    }

    public function save($statistic) {
        $this->getEntityManager()->persist($statistic);
        $this->getEntityManager()->flush();
    }

    public function remove($statistic) {
       
        $this->getEntityManager()->remove($statistic);
        $this->getEntityManager()->flush();
    }

    public function findStatisticsById($id) {
        
        return $this->createQueryBuilder('s')                       
                        ->andWhere('s.company = :id')
                        ->setParameter('id', $id)
                        ->getQuery()
                        ->getOneOrNullResult();
    }

    // /**
    //  * @return Statistic[] Returns an array of Statistic objects
    //  */
    /*
      public function findByExampleField($value)
      {
      return $this->createQueryBuilder('s')
      ->andWhere('s.exampleField = :val')
      ->setParameter('val', $value)
      ->orderBy('s.id', 'ASC')
      ->setMaxResults(10)
      ->getQuery()
      ->getResult()
      ;
      }
     */

    /*
      public function findOneBySomeField($value): ?Statistic
      {
      return $this->createQueryBuilder('s')
      ->andWhere('s.exampleField = :val')
      ->setParameter('val', $value)
      ->getQuery()
      ->getOneOrNullResult()
      ;
      }
     */
}
