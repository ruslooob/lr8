<?php

namespace App\Repository;

use App\Entity\Screenshot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Screenshot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Screenshot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Screenshot[]    findAll()
 * @method Screenshot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScreenshotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Screenshot::class);
    }

    /**
     */
    public function add(Screenshot $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     */
    public function remove(Screenshot $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
}
