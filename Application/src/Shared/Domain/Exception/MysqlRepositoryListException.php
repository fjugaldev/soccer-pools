<?php


namespace InnovatikLabs\Shared\Domain\Exception;

class MysqlRepositoryListException extends \Exception
{
    public function __construct(string $message = 'Mysql error')
    {
        parent::__construct($message);
    }
}