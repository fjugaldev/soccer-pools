<?php

namespace InnovatikLabs\Bet\TournamentPool\Infrastructure\Persistence\ORM;

use InnovatikLabs\Bet\TournamentPool\Domain\Model\TournamentPoolView;
use InnovatikLabs\Bet\TournamentPool\Domain\Persistence\ORM\TournamentPoolQueryRepositoryInterface;
use InnovatikLabs\Bet\TournamentPool\Domain\Model\TournamentPool;
use InnovatikLabs\Bet\TournamentPool\Infrastructure\Persistence\Adapter\TournamentPoolAdapter;
use InnovatikLabs\Shared\Infrastructure\Persistence\AdapterInterface;
use InnovatikLabs\Shared\Infrastructure\Persistence\MySQLBaseRepository;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TournamentPoolQueryRepository extends MySQLBaseRepository implements TournamentPoolQueryRepositoryInterface
{
    /**
     * @var TournamentPoolAdapter
     */
    private $tournamentPoolAdapter;

    public function __construct(RegistryInterface $registry, TournamentPoolAdapter $tournamentPoolAdapter)
    {
        parent::__construct($registry, TournamentPool::class);
        $this->tournamentPoolAdapter = $tournamentPoolAdapter;
    }

    /**
     * @param string $tournamentId
     * @param UuidInterface $ownerId
     * @param int $page
     * @param int $limit
     * @return TournamentPoolView[]|null
     */
    public function allTournamentPoolsOfUserOrNull(string $tournamentId, UuidInterface $ownerId, int $page, int $limit): ?array
    {
        $qb = $this->createQueryBuilder('tp')
            ->where('tp.owner = :ownerId')
            ->setParameter('ownerId', $ownerId->getBytes());
        $paginatedResults = self::allPaginatedOrNull($qb, $page, $limit);

        $tournamentPools = [];
        foreach ($paginatedResults->getQuery()->getResult() as $tournament) {
            $tournamentPools[] = $this->tournamentPoolAdapter->map($tournament);
        }

        return $tournamentPools;
    }

    /**
     * @param string $tournamentId
     * @param UuidInterface $ownerId
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countAllTournamentPoolsOfUser(string $tournamentId, UuidInterface $ownerId): int
    {
        $qb = $this->createQueryBuilder('tp')
            ->where('tp.owner = :ownerId')
            ->setParameter('ownerId', $ownerId->getBytes());

        return $qb
            ->select('count(tp.id)')
            ->getQuery()
            ->useQueryCache(true)
            ->useResultCache(true, 3600)
            ->getSingleScalarResult();
    }
}
