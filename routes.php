<?php

declare(strict_types=1);

$router->get("/country", "Movies\Country\CountryController::getAll");
$router->post("/country", "Movies\Country\CountryController::insert");
$router->group("/country", function ($router) {
    $router->get("/{country_id:number}", "Movies\Country\CountryController::get");
    $router->post("/{country_id:number}", "Movies\Country\CountryController::update");
    $router->delete("/{country_id:number}", "Movies\Country\CountryController::delete");
});

$router->get("/department", "Movies\Department\DepartmentController::getAll");
$router->post("/department", "Movies\Department\DepartmentController::insert");
$router->group("/department", function ($router) {
    $router->get("/{department_id:number}", "Movies\Department\DepartmentController::get");
    $router->post("/{department_id:number}", "Movies\Department\DepartmentController::update");
    $router->delete("/{department_id:number}", "Movies\Department\DepartmentController::delete");
});

$router->get("/gender", "Movies\Gender\GenderController::getAll");
$router->post("/gender", "Movies\Gender\GenderController::insert");
$router->group("/gender", function ($router) {
    $router->get("/{gender_id:number}", "Movies\Gender\GenderController::get");
    $router->post("/{gender_id:number}", "Movies\Gender\GenderController::update");
    $router->delete("/{gender_id:number}", "Movies\Gender\GenderController::delete");
});

$router->get("/genre", "Movies\Genre\GenreController::getAll");
$router->post("/genre", "Movies\Genre\GenreController::insert");
$router->group("/genre", function ($router) {
    $router->get("/{genre_id:number}", "Movies\Genre\GenreController::get");
    $router->post("/{genre_id:number}", "Movies\Genre\GenreController::update");
    $router->delete("/{genre_id:number}", "Movies\Genre\GenreController::delete");
});

$router->get("/keyword", "Movies\Keyword\KeywordController::getAll");
$router->post("/keyword", "Movies\Keyword\KeywordController::insert");
$router->group("/keyword", function ($router) {
    $router->get("/{keyword_id:number}", "Movies\Keyword\KeywordController::get");
    $router->post("/{keyword_id:number}", "Movies\Keyword\KeywordController::update");
    $router->delete("/{keyword_id:number}", "Movies\Keyword\KeywordController::delete");
});

$router->get("/language", "Movies\Language\LanguageController::getAll");
$router->post("/language", "Movies\Language\LanguageController::insert");
$router->group("/language", function ($router) {
    $router->get("/{language_id:number}", "Movies\Language\LanguageController::get");
    $router->post("/{language_id:number}", "Movies\Language\LanguageController::update");
    $router->delete("/{language_id:number}", "Movies\Language\LanguageController::delete");
});

$router->get("/language-role", "Movies\LanguageRole\LanguageRoleController::getAll");
$router->post("/language-role", "Movies\LanguageRole\LanguageRoleController::insert");
$router->group("/language-role", function ($router) {
    $router->get("/{language_role_id:number}", "Movies\LanguageRole\LanguageRoleController::get");
    $router->post("/{language_role_id:number}", "Movies\LanguageRole\LanguageRoleController::update");
    $router->delete("/{language_role_id:number}", "Movies\LanguageRole\LanguageRoleController::delete");
});

$router->get("/movie", "Movies\Movie\MovieController::getAll");
$router->post("/movie", "Movies\Movie\MovieController::insert");
$router->group("/movie", function ($router) {
    $router->get("/{movie_id:number}", "Movies\Movie\MovieController::get");
    $router->post("/{movie_id:number}", "Movies\Movie\MovieController::update");
    $router->delete("/{movie_id:number}", "Movies\Movie\MovieController::delete");
});

$router->get("/movie-cast", "Movies\MovieCast\MovieCastController::getAll");
$router->post("/movie-cast", "Movies\MovieCast\MovieCastController::insert");
$router->group("/movie-cast", function ($router) {
    $router->get("/{movie_cast_id:number}", "Movies\MovieCast\MovieCastController::get");
    $router->post("/{movie_cast_id:number}", "Movies\MovieCast\MovieCastController::update");
    $router->delete("/{movie_cast_id:number}", "Movies\MovieCast\MovieCastController::delete");
});

$router->get("/movie-company", "Movies\MovieCompany\MovieCompanyController::getAll");
$router->post("/movie-company", "Movies\MovieCompany\MovieCompanyController::insert");
$router->group("/movie-company", function ($router) {
    $router->get("/{movie_company_id:number}", "Movies\MovieCompany\MovieCompanyController::get");
    $router->post("/{movie_company_id:number}", "Movies\MovieCompany\MovieCompanyController::update");
    $router->delete("/{movie_company_id:number}", "Movies\MovieCompany\MovieCompanyController::delete");
});

$router->get("/movie-crew", "Movies\MovieCrew\MovieCrewController::getAll");
$router->post("/movie-crew", "Movies\MovieCrew\MovieCrewController::insert");
$router->group("/movie-crew", function ($router) {
    $router->get("/{movie_crew_id:number}", "Movies\MovieCrew\MovieCrewController::get");
    $router->post("/{movie_crew_id:number}", "Movies\MovieCrew\MovieCrewController::update");
    $router->delete("/{movie_crew_id:number}", "Movies\MovieCrew\MovieCrewController::delete");
});

$router->get("/movie-genres", "Movies\MovieGenres\MovieGenresController::getAll");
$router->post("/movie-genres", "Movies\MovieGenres\MovieGenresController::insert");
$router->group("/movie-genres", function ($router) {
    $router->get("/{movie_genres_id:number}", "Movies\MovieGenres\MovieGenresController::get");
    $router->post("/{movie_genres_id:number}", "Movies\MovieGenres\MovieGenresController::update");
    $router->delete("/{movie_genres_id:number}", "Movies\MovieGenres\MovieGenresController::delete");
});

$router->get("/movie-keywords", "Movies\MovieKeywords\MovieKeywordsController::getAll");
$router->post("/movie-keywords", "Movies\MovieKeywords\MovieKeywordsController::insert");
$router->group("/movie-keywords", function ($router) {
    $router->get("/{movie_keywords_id:number}", "Movies\MovieKeywords\MovieKeywordsController::get");
    $router->post("/{movie_keywords_id:number}", "Movies\MovieKeywords\MovieKeywordsController::update");
    $router->delete("/{movie_keywords_id:number}", "Movies\MovieKeywords\MovieKeywordsController::delete");
});

$router->get("/movie-languages", "Movies\MovieLanguages\MovieLanguagesController::getAll");
$router->post("/movie-languages", "Movies\MovieLanguages\MovieLanguagesController::insert");
$router->group("/movie-languages", function ($router) {
    $router->get("/{movie_languages_id:number}", "Movies\MovieLanguages\MovieLanguagesController::get");
    $router->post("/{movie_languages_id:number}", "Movies\MovieLanguages\MovieLanguagesController::update");
    $router->delete("/{movie_languages_id:number}", "Movies\MovieLanguages\MovieLanguagesController::delete");
});

$router->get("/person", "Movies\Person\PersonController::getAll");
$router->post("/person", "Movies\Person\PersonController::insert");
$router->group("/person", function ($router) {
    $router->get("/{person_id:number}", "Movies\Person\PersonController::get");
    $router->post("/{person_id:number}", "Movies\Person\PersonController::update");
    $router->delete("/{person_id:number}", "Movies\Person\PersonController::delete");
});

$router->get("/production-company", "Movies\ProductionCompany\ProductionCompanyController::getAll");
$router->post("/production-company", "Movies\ProductionCompany\ProductionCompanyController::insert");
$router->group("/production-company", function ($router) {
    $router->get("/{production_company_id:number}", "Movies\ProductionCompany\ProductionCompanyController::get");
    $router->post("/{production_company_id:number}", "Movies\ProductionCompany\ProductionCompanyController::update");
    $router->delete("/{production_company_id:number}", "Movies\ProductionCompany\ProductionCompanyController::delete");
});

$router->get("/production-country", "Movies\ProductionCountry\ProductionCountryController::getAll");
$router->post("/production-country", "Movies\ProductionCountry\ProductionCountryController::insert");
$router->group("/production-country", function ($router) {
    $router->get("/{production_country_id:number}", "Movies\ProductionCountry\ProductionCountryController::get");
    $router->post("/{production_country_id:number}", "Movies\ProductionCountry\ProductionCountryController::update");
    $router->delete("/{production_country_id:number}", "Movies\ProductionCountry\ProductionCountryController::delete");
});

