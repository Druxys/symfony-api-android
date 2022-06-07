<?php

namespace App\Repository;

use App\Entity\UpdatedAt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UpdatedAt>
 *
 * @method UpdatedAt|null find($id, $lockMode = null, $lockVersion = null)
 * @method UpdatedAt|null findOneBy(array $criteria, array $orderBy = null)
 * @method UpdatedAt[]    findAll()
 * @method UpdatedAt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UpdatedAtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UpdatedAt::class);
    }

    public function add(UpdatedAt $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UpdatedAt $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return UpdatedAt[] Returns an array of UpdatedAt objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UpdatedAt
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
