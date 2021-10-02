<?php

declare(strict_types=1);

// Core

$container->add("Pdo", PDO::class)
    ->addArgument("mysql:dbname={$_ENV["DB_NAME"]};host={$_ENV["DB_HOST"]}")
    ->addArgument($_ENV["DB_USER"])
    ->addArgument($_ENV["DB_PASS"])
    ->addArgument([]);
$container->add("Database", Movies\Database\PdoDatabase::class)
    ->addArgument("Pdo");

// Country

$container->add("CountryRepository", Movies\Country\CountryRepository::class)
    ->addArgument("Database");
$container->add("CountryService", Movies\Country\CountryService::class)
    ->addArgument("CountryRepository");
$container->add(Movies\Country\CountryController::class)
    ->addArgument("CountryService");

// Department

$container->add("DepartmentRepository", Movies\Department\DepartmentRepository::class)
    ->addArgument("Database");
$container->add("DepartmentService", Movies\Department\DepartmentService::class)
    ->addArgument("DepartmentRepository");
$container->add(Movies\Department\DepartmentController::class)
    ->addArgument("DepartmentService");

// Gender

$container->add("GenderRepository", Movies\Gender\GenderRepository::class)
    ->addArgument("Database");
$container->add("GenderService", Movies\Gender\GenderService::class)
    ->addArgument("GenderRepository");
$container->add(Movies\Gender\GenderController::class)
    ->addArgument("GenderService");

// Genre

$container->add("GenreRepository", Movies\Genre\GenreRepository::class)
    ->addArgument("Database");
$container->add("GenreService", Movies\Genre\GenreService::class)
    ->addArgument("GenreRepository");
$container->add(Movies\Genre\GenreController::class)
    ->addArgument("GenreService");

// Keyword

$container->add("KeywordRepository", Movies\Keyword\KeywordRepository::class)
    ->addArgument("Database");
$container->add("KeywordService", Movies\Keyword\KeywordService::class)
    ->addArgument("KeywordRepository");
$container->add(Movies\Keyword\KeywordController::class)
    ->addArgument("KeywordService");

// Language

$container->add("LanguageRepository", Movies\Language\LanguageRepository::class)
    ->addArgument("Database");
$container->add("LanguageService", Movies\Language\LanguageService::class)
    ->addArgument("LanguageRepository");
$container->add(Movies\Language\LanguageController::class)
    ->addArgument("LanguageService");

// LanguageRole

$container->add("LanguageRoleRepository", Movies\LanguageRole\LanguageRoleRepository::class)
    ->addArgument("Database");
$container->add("LanguageRoleService", Movies\LanguageRole\LanguageRoleService::class)
    ->addArgument("LanguageRoleRepository");
$container->add(Movies\LanguageRole\LanguageRoleController::class)
    ->addArgument("LanguageRoleService");

// Movie

$container->add("MovieRepository", Movies\Movie\MovieRepository::class)
    ->addArgument("Database");
$container->add("MovieService", Movies\Movie\MovieService::class)
    ->addArgument("MovieRepository");
$container->add(Movies\Movie\MovieController::class)
    ->addArgument("MovieService");

// MovieCast

$container->add("MovieCastRepository", Movies\MovieCast\MovieCastRepository::class)
    ->addArgument("Database");
$container->add("MovieCastService", Movies\MovieCast\MovieCastService::class)
    ->addArgument("MovieCastRepository");
$container->add(Movies\MovieCast\MovieCastController::class)
    ->addArgument("MovieCastService");

// MovieCompany

$container->add("MovieCompanyRepository", Movies\MovieCompany\MovieCompanyRepository::class)
    ->addArgument("Database");
$container->add("MovieCompanyService", Movies\MovieCompany\MovieCompanyService::class)
    ->addArgument("MovieCompanyRepository");
$container->add(Movies\MovieCompany\MovieCompanyController::class)
    ->addArgument("MovieCompanyService");

// MovieCrew

$container->add("MovieCrewRepository", Movies\MovieCrew\MovieCrewRepository::class)
    ->addArgument("Database");
$container->add("MovieCrewService", Movies\MovieCrew\MovieCrewService::class)
    ->addArgument("MovieCrewRepository");
$container->add(Movies\MovieCrew\MovieCrewController::class)
    ->addArgument("MovieCrewService");

// MovieGenres

$container->add("MovieGenresRepository", Movies\MovieGenres\MovieGenresRepository::class)
    ->addArgument("Database");
$container->add("MovieGenresService", Movies\MovieGenres\MovieGenresService::class)
    ->addArgument("MovieGenresRepository");
$container->add(Movies\MovieGenres\MovieGenresController::class)
    ->addArgument("MovieGenresService");

// MovieKeywords

$container->add("MovieKeywordsRepository", Movies\MovieKeywords\MovieKeywordsRepository::class)
    ->addArgument("Database");
$container->add("MovieKeywordsService", Movies\MovieKeywords\MovieKeywordsService::class)
    ->addArgument("MovieKeywordsRepository");
$container->add(Movies\MovieKeywords\MovieKeywordsController::class)
    ->addArgument("MovieKeywordsService");

// MovieLanguages

$container->add("MovieLanguagesRepository", Movies\MovieLanguages\MovieLanguagesRepository::class)
    ->addArgument("Database");
$container->add("MovieLanguagesService", Movies\MovieLanguages\MovieLanguagesService::class)
    ->addArgument("MovieLanguagesRepository");
$container->add(Movies\MovieLanguages\MovieLanguagesController::class)
    ->addArgument("MovieLanguagesService");

// Person

$container->add("PersonRepository", Movies\Person\PersonRepository::class)
    ->addArgument("Database");
$container->add("PersonService", Movies\Person\PersonService::class)
    ->addArgument("PersonRepository");
$container->add(Movies\Person\PersonController::class)
    ->addArgument("PersonService");

// ProductionCompany

$container->add("ProductionCompanyRepository", Movies\ProductionCompany\ProductionCompanyRepository::class)
    ->addArgument("Database");
$container->add("ProductionCompanyService", Movies\ProductionCompany\ProductionCompanyService::class)
    ->addArgument("ProductionCompanyRepository");
$container->add(Movies\ProductionCompany\ProductionCompanyController::class)
    ->addArgument("ProductionCompanyService");

// ProductionCountry

$container->add("ProductionCountryRepository", Movies\ProductionCountry\ProductionCountryRepository::class)
    ->addArgument("Database");
$container->add("ProductionCountryService", Movies\ProductionCountry\ProductionCountryService::class)
    ->addArgument("ProductionCountryRepository");
$container->add(Movies\ProductionCountry\ProductionCountryController::class)
    ->addArgument("ProductionCountryService");

