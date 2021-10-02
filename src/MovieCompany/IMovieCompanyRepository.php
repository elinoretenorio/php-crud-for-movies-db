<?php

declare(strict_types=1);

namespace Movies\MovieCompany;

interface IMovieCompanyRepository
{
    public function insert(MovieCompanyDto $dto): int;

    public function update(MovieCompanyDto $dto): int;

    public function get(int $movieCompanyId): ?MovieCompanyDto;

    public function getAll(): array;

    public function delete(int $movieCompanyId): int;
}