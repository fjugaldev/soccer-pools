<?php

namespace InnovatikLabs\Shared\Infrastructure;

interface DomainEvent
{
    public function getAggregateId(): AggregateId;
}
