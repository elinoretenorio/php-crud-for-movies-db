<?php

declare(strict_types=1);

namespace Movies\ProductionCountry;

use JsonSerializable;

class ProductionCountryModel implements JsonSerializable
{
    private int $productionCountryId;
    private int $movieId;
    private int $countryId;

    public function __construct(ProductionCountryDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->productionCountryId = $dto->productionCountryId;
        $this->movieId = $dto->movieId;
        $this->countryId = $dto->countryId;
    }

    public function getProductionCountryId(): int
    {
        return $this->productionCountryId;
    }

    public function setProductionCountryId(int $productionCountryId): void
    {
        $this->productionCountryId = $productionCountryId;
    }

    public function getMovieId(): int
    {
        return $this->movieId;
    }

    public function setMovieId(int $movieId): void
    {
        $this->movieId = $movieId;
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function setCountryId(int $countryId): void
    {
        $this->countryId = $countryId;
    }

    public function toDto(): ProductionCountryDto
    {
        $dto = new ProductionCountryDto();
        $dto->productionCountryId = (int) ($this->productionCountryId ?? 0);
        $dto->movieId = (int) ($this->movieId ?? 0);
        $dto->countryId = (int) ($this->countryId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "production_country_id" => $this->productionCountryId,
            "movie_id" => $this->movieId,
            "country_id" => $this->countryId,
        ];
    }
}