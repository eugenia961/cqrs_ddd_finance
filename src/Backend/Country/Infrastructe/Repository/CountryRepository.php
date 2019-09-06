<?php

namespace App\Backend\Country\Infrastructe\Repository;

use App\Backend\Country\Domain\Entity\Country;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Backend\Country\Domain\Interfaces\CountryRepositoryInterface;

/* * s
 * @method Country|null find($id, $lockMode = null, $lockVersion = null)
 * @method Country|null findOneBy(array $criteria, array $orderBy = null)
 * @method Country[]    findAll()
 * @method Country[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class CountryRepository extends ServiceEntityRepository implements CountryRepositoryInterface {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Country::class);
    }

    public function findCountryById($id) {

        return $this->createQueryBuilder('c')
                        ->where('c.id= :id')
                        ->setParameter('id', $id)
                        ->getQuery()
                        ->getOneOrNullResult();
    }

    public function save(Country $country) {

        $this->getEntityManager()->persist($country);
        $this->getEntityManager()->flush();
    }

    public function findCountryByAcronyms($acronyms) {

        return $this->createQueryBuilder('c')
                        ->where('c.acronyms= :acronyms')
                        ->setParameter('acronyms', $acronyms)
                        ->getQuery()
                        ->getOneOrNullResult();
    }

    // /**
    //  * @return Country[] Returns an array of Country objects
    //  */
    /*
      public function findByExampleField($value)
      {
      return $this->createQueryBuilder('c')
      ->andWhere('c.exampleField = :val')
      ->setParameter('val', $value)
      ->orderBy('c.id', 'ASC')
      ->setMaxResults(10)
      ->getQuery()
      ->getResult()
      ;
      }
     */

    /*
      public function findOneBySomeField($value): ?Country
      {
      return $this->createQueryBuilder('c')
      ->andWhere('c.exampleField = :val')
      ->setParameter('val', $value)
      ->getQuery()
      ->getOneOrNullResult()
      ;
      }
     */
}
