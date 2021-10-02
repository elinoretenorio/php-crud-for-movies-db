<?php

declare(strict_types=1);

namespace Movies\Country;

class CountryDto 
{
    public int $countryId;
    public string $countryIsoCode;
    public string $countryName;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->countryId = (int) ($row["country_id"] ?? 0);
        $this->countryIsoCode = $row["country_iso_code"] ?? "";
        $this->countryName = $row["country_name"] ?? "";
    }
}