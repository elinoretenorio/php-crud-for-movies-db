<?php

declare(strict_types=1);

namespace Movies\Database;

interface IDatabaseResult
{
    public function execute(?array $parameters = null): void;

    public function rowCount(): int;

    public function fetchAll(): array;
}
