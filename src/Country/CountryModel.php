<?php

declare(strict_types=1);

namespace Movies\Country;

use JsonSerializable;

class CountryModel implements JsonSerializable
{
    private int $countryId;
    private string $countryIsoCode;
    private string $countryName;

    public function __construct(CountryDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->countryId = $dto->countryId;
        $this->countryIsoCode = $dto->countryIsoCode;
        $this->countryName = $dto->countryName;
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function setCountryId(int $countryId): void
    {
        $this->countryId = $countryId;
    }

    public function getCountryIsoCode(): string
    {
        return $this->countryIsoCode;
    }

    public function setCountryIsoCode(string $countryIsoCode): void
    {
        $this->countryIsoCode = $countryIsoCode;
    }

    public function getCountryName(): string
    {
        return $this->countryName;
    }

    public function setCountryName(string $countryName): void
    {
        $this->countryName = $countryName;
    }

    public function toDto(): CountryDto
    {
        $dto = new CountryDto();
        $dto->countryId = (int) ($this->countryId ?? 0);
        $dto->countryIsoCode = $this->countryIsoCode ?? "";
        $dto->countryName = $this->countryName ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "country_id" => $this->countryId,
            "country_iso_code" => $this->countryIsoCode,
            "country_name" => $this->countryName,
        ];
    }
}