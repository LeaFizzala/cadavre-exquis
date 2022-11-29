<?php

namespace App\Repository;

use App\Entity\CadavreExquis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<CadavreExquis>
 *
 * @method CadavreExquis|null find($id, $lockMode = null, $lockVersion = null)
 * @method CadavreExquis|null findOneBy(array $criteria, array $orderBy = null)
 * @method CadavreExquis[]    findAll()
 * @method CadavreExquis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CadavreExquisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CadavreExquis::class);
    }

    public function save(CadavreExquis $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CadavreExquis $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}