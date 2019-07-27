<?php

namespace InnovatikLabs\Shared\Infrastructure\Persistence\EventStore;

use InnovatikLabs\Shared\Infrastructure\AggregateId;
use InnovatikLabs\Shared\Infrastructure\DomainEvents;
use InnovatikLabs\Shared\Infrastructure\DomainEventsHistory;

interface EventStore
{
    public function append(DomainEvents $events);

    public function get(AggregateId $aggregateId): DomainEventsHistory;
}
