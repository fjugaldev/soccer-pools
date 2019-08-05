<?php

namespace InnovatikLabs\Shared\Infrastructure\Persistence;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

abstract class MySQLBaseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    /**
     * @param QueryBuilder $qb
     * @return array|null
     */
    public function allOrEmpty(QueryBuilder $qb): ?array
    {
        return $qb->getQuery()->getResult() ?? [];
    }
}