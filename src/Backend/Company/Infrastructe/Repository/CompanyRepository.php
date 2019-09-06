<?php

namespace App\Backend\Company\Infrastructe\Repository;

use App\Backend\Company\Domain\Entity\Company;
use App\Backend\Company\Domain\Interfaces\CompanyRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method Company[]    findAll()
 * @method Company[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyRepository extends ServiceEntityRepository implements CompanyRepositoryInterface {

    private $paginatorInterface;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginatorInterface) {

        $this->paginatorInterface = $paginatorInterface;
        parent::__construct($registry, Company::class);
    }

    public function save($company) {

        $this->getEntityManager()->persist($company);
        $this->getEntityManager()->flush();
    }

    public function findCompanyByTicker($ticker) {


        return $this->createQueryBuilder('c')
                        ->andWhere('c.ticker = :ticker')
                        ->setParameter('ticker', $ticker)
                        ->getQuery()
                        ->getOneOrNullResult();
    }

    public function findAllActivePaginationCompanies($page = 0, $limit) {

        $queryBuilder = $this->createQueryBuilder('c')
                ->andWhere('c.enable = :enable')
                ->setParameter('enable', true)
                ->getQuery();

        $pagination = $this->paginatorInterface->paginate($queryBuilder, $page, $limit);

        return $pagination;
    }

    public function countTotal() {

        $queryBuilder = $this->createQueryBuilder('c');

        return $queryBuilder->select(
                                $queryBuilder->expr()->count("c.id")
                        )
                        ->andWhere('c.enable = :enable')
                        ->setParameter('enable', true)
                        ->getQuery()
                        ->getSingleScalarResult();
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
