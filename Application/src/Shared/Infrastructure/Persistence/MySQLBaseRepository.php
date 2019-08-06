<?php

namespace InnovatikLabs\Shared\Infrastructure\Persistence;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bridge\Doctrine\RegistryInterface;

abstract class MySQLBaseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    /**
     * @param QueryBuilder $qb
     * @param int $page
     * @param int $limit
     * @return Paginator|null
     */
    public function allPaginatedOrNull(QueryBuilder $qb, int $page, int $limit): ?Paginator
    {
        $paginatedResults = self::paginate($qb, $page, $limit);
        if ($paginatedResults->getQuery()->getMaxResults() == 0) return null;

        return $paginatedResults;
    }

    /**
     * @param QueryBuilder|Query $query
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public static function paginate($query, int $page, int $limit): Paginator
    {
        $paginator = new Paginator($query);
        $paginator
            ->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);
        return $paginator;
    }
    /**
     * @param Paginator $paginator
     * @return int
     */
    public static function lastPage(Paginator $paginator): int
    {
        return ceil($paginator->count() / $paginator->getQuery()->getMaxResults());
    }
    /**
     * @param Paginator $paginator
     * @return int
     */
    public static function total(Paginator $paginator): int
    {
        return $paginator->count();
    }
    /**
     * @param Paginator $paginator
     * @return bool
     */
    public static function currentPageHasNoResult(Paginator $paginator): bool
    {
        return !$paginator->getIterator()->count();
    }
}
