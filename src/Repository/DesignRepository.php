<?php

namespace App\Repository;

use App\Entity\Design;
use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Design>
 *
 * @method Design|null find($id, $lockMode = null, $lockVersion = null)
 * @method Design|null findOneBy(array $criteria, array $orderBy = null)
 * @method Design[]    findAll()
 * @method Design[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DesignRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Design::class);
    }

    /**
     * @return Design[] Returns an array of Design objects
     */
    public function findByTag(string $query): array
    {
        if(empty($query)) {
            return $this->findAll();
        }

        return $this->createQueryBuilder('d')
            ->select('d')
            ->leftJoin('d.tag', 'tag')
            ->where('LOWER(tag.label) LIKE :query')
            ->setParameter('query', '%'.strtolower($query).'%')
            ->getQuery()
            ->getResult();

    }

    public function findByName(string $query): array
    {
        if(empty($query)) {
            return $this->findAll();
        }

        return $this->createQueryBuilder('d')
            ->select('d')
            ->where('LOWER(d.name) LIKE :query')
            ->setParameter('query', '%'.strtolower($query).'%')
            ->getQuery()
            ->getResult();
    }
}
