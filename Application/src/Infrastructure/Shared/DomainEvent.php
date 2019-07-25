<?php

namespace App\Infrastructure\Shared;

interface DomainEvent
{
    public function getAggregateId(): AggregateId;
}
