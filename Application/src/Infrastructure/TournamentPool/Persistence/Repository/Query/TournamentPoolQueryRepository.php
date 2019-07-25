<?php

namespace App\Infrastructure\TournamentPool\Persistence\Repository\Query;

use App\Domain\TournamentPool\Persistence\Repository\Query\ProductView;
use App\Domain\TournamentPool\Persistence\Repository\Query\TournamentPoolQueryRepositoryInterface;
use App\Domain\TournamentPool\ValueObject\TournamentPool;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TournamentPoolQueryRepository extends ServiceEntityRepository implements TournamentPoolQueryRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TournamentPool::class);
    }

    public function fetchAll(int $page, int $perPage): array
    {
        // TODO: Implement fetchAll() method.
    }
}
