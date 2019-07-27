<?php

namespace InnovatikLabs\Bet\TournamentPool\Infrastructure\Persistence\Repository\Query;

//use InnovatikLabs\TournamentPool\Domain\Persistence\Repository\Query\ProductView;
use InnovatikLabs\Bet\TournamentPool\Domain\Persistence\Repository\Query\TournamentPoolQueryRepositoryInterface;
use InnovatikLabs\Bet\TournamentPool\Domain\Model\TournamentPool;
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
