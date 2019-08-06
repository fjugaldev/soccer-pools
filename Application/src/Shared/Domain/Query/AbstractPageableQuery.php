<?php

namespace InnovatikLabs\Shared\Domain\Query;

abstract class AbstractPageableQuery
{
    /**
     * @var int
     */
    protected $page;

    /**
     * @var int
     */
    protected $perPageLimit;

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getPerPageLimit(): int
    {
        return $this->perPageLimit;
    }
}
