<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function finById(int $id){
        return $this->createQueryBuilder('p')
                    ->andWhere('p.id = :val')
                    ->setParameter('val', $id)
                    ->orderBy('p.id', 'ASC')
                    ->getQuery()
                    ->getResult();
    }

    public function getRecentProduct(){
        return $this->createQueryBuilder('p')
                    ->orderBy('p.createdAt', 'DESC')
                    ->setMaxResults('5')
                    ->getQuery()
                    ->getResult();
    }

    public function getLessPrice(){
        return $this->createQueryBuilder('p')
                    ->orderBy('p.price', 'ASC')
                    ->setMaxResults('5')
                    ->getQuery()
                    ->getResult();
    }
}
