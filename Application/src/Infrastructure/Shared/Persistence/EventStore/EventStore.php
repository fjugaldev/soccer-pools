<?php

namespace App\Infrastructure\Shared\Persistence\EventStore;

use App\Infrastructure\Shared\AggregateId;
use App\Infrastructure\Shared\DomainEvents;
use App\Infrastructure\Shared\DomainEventsHistory;

interface EventStore
{
    public function append(DomainEvents $events);

    public function get(AggregateId $aggregateId): DomainEventsHistory;
}
