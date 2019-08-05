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
     * @return array|null
     */
    public function allOrEmpty(QueryBuilder $qb, int $page, int $limit): ?array
    {
        $paginator = $this->paginate($qb, $page, $limit);

        return [
            'items' => $paginator->getQuery()->getResult(),
            'currentPage' => $page,
            'totalPages' => $this->lastPage($paginator),
        ];
    }

    /**
     * @param QueryBuilder|Query $query
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function paginate($query, int $page, int $limit): Paginator
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
    public function lastPage(Paginator $paginator): int
    {
        return ceil($paginator->count() / $paginator->getQuery()->getMaxResults());
    }
    /**
     * @param Paginator $paginator
     * @return int
     */
    public function total(Paginator $paginator): int
    {
        return $paginator->count();
    }
    /**
     * @param Paginator $paginator
     * @return bool
     */
    public function currentPageHasNoResult(Paginator $paginator): bool
    {
        return !$paginator->getIterator()->count();
    }
}
