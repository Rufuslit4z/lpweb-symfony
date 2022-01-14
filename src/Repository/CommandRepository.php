<?php

namespace App\Repository;

use App\Entity\Command;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Command|null find($id, $lockMode = null, $lockVersion = null)
 * @method Command|null findOneBy(array $criteria, array $orderBy = null)
 * @method Command[]    findAll()
 * @method Command[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Command::class);
    }

    public function findById(int $id){
        return $this->createQueryBuilder('p')
                    ->andWhere('p.id = :val')
                    ->setParameter('val', $id)
                    ->getQuery()
                    ->getResult();
    }

    public function findByEmail(string $email){
        return $this->createQueryBuilder('p')
                    ->andWhere('p.email = :val')
                    ->setParameter('val', $email)
                    ->getQuery()
                    ->getResult();
    }

}
