<?php

namespace Src\Shared\Domain\Contracts;

interface DatabaseDriverContract
{
    public static function getInstance();
    public function query(string $query);
}
