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
     * @return TournamentPoolView[]
     */
    public function allOfUserId(string $tournamentId, UuidInterface $ownerId): array
    {
        $qb = $this->createQueryBuilder('tp')
            ->where('tp.id = :ownerId')
            ->setParameter('ownerId', $ownerId->getBytes());

        $tournamentPools = [];
        foreach ($this->allOrEmpty($qb) as $tournament) {
            $tournamentPools[] = $this->tournamentPoolAdapter->map($tournament);
        }

        return $tournamentPools;
    }
}
