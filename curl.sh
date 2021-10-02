curl -X GET "localhost:8080/country"

curl -X POST "localhost:8080/country" -H 'Content-Type: application/json' -d'
{
  "country_iso_code": "window",
  "country_name": "hear"
}
'

curl -X POST "localhost:8080/country/959" -H 'Content-Type: application/json' -d'
{
  "country_id": 959,
  "country_iso_code": "window",
  "country_name": "hear"
}
'

curl -X GET "localhost:8080/country/959"

curl -X DELETE "localhost:8080/country/959"

# --

curl -X GET "localhost:8080/department"

curl -X POST "localhost:8080/department" -H 'Content-Type: application/json' -d'
{
  "department_name": "or"
}
'

curl -X POST "localhost:8080/department/9466" -H 'Content-Type: application/json' -d'
{
  "department_id": 9466,
  "department_name": "or"
}
'

curl -X GET "localhost:8080/department/9466"

curl -X DELETE "localhost:8080/department/9466"

# --

curl -X GET "localhost:8080/gender"

curl -X POST "localhost:8080/gender" -H 'Content-Type: application/json' -d'
{
  "gender": "difference"
}
'

curl -X POST "localhost:8080/gender/8510" -H 'Content-Type: application/json' -d'
{
  "gender": "difference",
  "gender_id": 8510
}
'

curl -X GET "localhost:8080/gender/8510"

curl -X DELETE "localhost:8080/gender/8510"

# --

curl -X GET "localhost:8080/genre"

curl -X POST "localhost:8080/genre" -H 'Content-Type: application/json' -d'
{
  "genre_name": "take"
}
'

curl -X POST "localhost:8080/genre/8320" -H 'Content-Type: application/json' -d'
{
  "genre_id": 8320,
  "genre_name": "take"
}
'

curl -X GET "localhost:8080/genre/8320"

curl -X DELETE "localhost:8080/genre/8320"

# --

curl -X GET "localhost:8080/keyword"

curl -X POST "localhost:8080/keyword" -H 'Content-Type: application/json' -d'
{
  "keyword_name": "institution"
}
'

curl -X POST "localhost:8080/keyword/699" -H 'Content-Type: application/json' -d'
{
  "keyword_id": 699,
  "keyword_name": "institution"
}
'

curl -X GET "localhost:8080/keyword/699"

curl -X DELETE "localhost:8080/keyword/699"

# --

curl -X GET "localhost:8080/language"

curl -X POST "localhost:8080/language" -H 'Content-Type: application/json' -d'
{
  "language_code": "project",
  "language_name": "guy"
}
'

curl -X POST "localhost:8080/language/9992" -H 'Content-Type: application/json' -d'
{
  "language_code": "project",
  "language_id": 9992,
  "language_name": "guy"
}
'

curl -X GET "localhost:8080/language/9992"

curl -X DELETE "localhost:8080/language/9992"

# --

curl -X GET "localhost:8080/language-role"

curl -X POST "localhost:8080/language-role" -H 'Content-Type: application/json' -d'
{
  "language_role": "wide",
  "role_id": 7753
}
'

curl -X POST "localhost:8080/language-role/1653" -H 'Content-Type: application/json' -d'
{
  "language_role": "wide",
  "language_role_id": 1653,
  "role_id": 7753
}
'

curl -X GET "localhost:8080/language-role/1653"

curl -X DELETE "localhost:8080/language-role/1653"

# --

curl -X GET "localhost:8080/movie"

curl -X POST "localhost:8080/movie" -H 'Content-Type: application/json' -d'
{
  "budget": 4528,
  "homepage": "let",
  "movie_status": "week",
  "overview": "cell",
  "popularity": 230.38,
  "release_date": "2021-09-22",
  "revenue": 8766,
  "runtime": 993,
  "tagline": "Mrs",
  "title": "he",
  "vote_average": 523.6575720363,
  "vote_count": 1119
}
'

curl -X POST "localhost:8080/movie/4095" -H 'Content-Type: application/json' -d'
{
  "budget": 4528,
  "homepage": "let",
  "movie_id": 4095,
  "movie_status": "week",
  "overview": "cell",
  "popularity": 230.38,
  "release_date": "2021-09-22",
  "revenue": 8766,
  "runtime": 993,
  "tagline": "Mrs",
  "title": "he",
  "vote_average": 523.6575720363,
  "vote_count": 1119
}
'

curl -X GET "localhost:8080/movie/4095"

curl -X DELETE "localhost:8080/movie/4095"

# --

curl -X GET "localhost:8080/movie-cast"

curl -X POST "localhost:8080/movie-cast" -H 'Content-Type: application/json' -d'
{
  "cast_order": 7592,
  "character_name": "until",
  "gender_id": 8382,
  "movie_id": 2044,
  "person_id": 2234
}
'

curl -X POST "localhost:8080/movie-cast/3150" -H 'Content-Type: application/json' -d'
{
  "cast_order": 7592,
  "character_name": "until",
  "gender_id": 8382,
  "movie_cast_id": 3150,
  "movie_id": 2044,
  "person_id": 2234
}
'

curl -X GET "localhost:8080/movie-cast/3150"

curl -X DELETE "localhost:8080/movie-cast/3150"

# --

curl -X GET "localhost:8080/movie-company"

curl -X POST "localhost:8080/movie-company" -H 'Content-Type: application/json' -d'
{
  "company_id": 839,
  "movie_id": 3998
}
'

curl -X POST "localhost:8080/movie-company/640" -H 'Content-Type: application/json' -d'
{
  "company_id": 839,
  "movie_company_id": 640,
  "movie_id": 3998
}
'

curl -X GET "localhost:8080/movie-company/640"

curl -X DELETE "localhost:8080/movie-company/640"

# --

curl -X GET "localhost:8080/movie-crew"

curl -X POST "localhost:8080/movie-crew" -H 'Content-Type: application/json' -d'
{
  "department_id": 801,
  "job": "manager",
  "movie_id": 381,
  "person_id": 374
}
'

curl -X POST "localhost:8080/movie-crew/3546" -H 'Content-Type: application/json' -d'
{
  "department_id": 801,
  "job": "manager",
  "movie_crew_id": 3546,
  "movie_id": 381,
  "person_id": 374
}
'

curl -X GET "localhost:8080/movie-crew/3546"

curl -X DELETE "localhost:8080/movie-crew/3546"

# --

curl -X GET "localhost:8080/movie-genres"

curl -X POST "localhost:8080/movie-genres" -H 'Content-Type: application/json' -d'
{
  "genre_id": 5000,
  "movie_id": 7291
}
'

curl -X POST "localhost:8080/movie-genres/6905" -H 'Content-Type: application/json' -d'
{
  "genre_id": 5000,
  "movie_genres_id": 6905,
  "movie_id": 7291
}
'

curl -X GET "localhost:8080/movie-genres/6905"

curl -X DELETE "localhost:8080/movie-genres/6905"

# --

curl -X GET "localhost:8080/movie-keywords"

curl -X POST "localhost:8080/movie-keywords" -H 'Content-Type: application/json' -d'
{
  "keyword_id": 7098,
  "movie_id": 9593
}
'

curl -X POST "localhost:8080/movie-keywords/2574" -H 'Content-Type: application/json' -d'
{
  "keyword_id": 7098,
  "movie_id": 9593,
  "movie_keywords_id": 2574
}
'

curl -X GET "localhost:8080/movie-keywords/2574"

curl -X DELETE "localhost:8080/movie-keywords/2574"

# --

curl -X GET "localhost:8080/movie-languages"

curl -X POST "localhost:8080/movie-languages" -H 'Content-Type: application/json' -d'
{
  "language_id": 9546,
  "language_role_id": 7720,
  "movie_id": 6415
}
'

curl -X POST "localhost:8080/movie-languages/2117" -H 'Content-Type: application/json' -d'
{
  "language_id": 9546,
  "language_role_id": 7720,
  "movie_id": 6415,
  "movie_languages_id": 2117
}
'

curl -X GET "localhost:8080/movie-languages/2117"

curl -X DELETE "localhost:8080/movie-languages/2117"

# --

curl -X GET "localhost:8080/person"

curl -X POST "localhost:8080/person" -H 'Content-Type: application/json' -d'
{
  "person_name": "everybody"
}
'

curl -X POST "localhost:8080/person/6980" -H 'Content-Type: application/json' -d'
{
  "person_id": 6980,
  "person_name": "everybody"
}
'

curl -X GET "localhost:8080/person/6980"

curl -X DELETE "localhost:8080/person/6980"

# --

curl -X GET "localhost:8080/production-company"

curl -X POST "localhost:8080/production-company" -H 'Content-Type: application/json' -d'
{
  "company_id": 2340,
  "company_name": "describe"
}
'

curl -X POST "localhost:8080/production-company/2395" -H 'Content-Type: application/json' -d'
{
  "company_id": 2340,
  "company_name": "describe",
  "production_company_id": 2395
}
'

curl -X GET "localhost:8080/production-company/2395"

curl -X DELETE "localhost:8080/production-company/2395"

# --

curl -X GET "localhost:8080/production-country"

curl -X POST "localhost:8080/production-country" -H 'Content-Type: application/json' -d'
{
  "country_id": 7686,
  "movie_id": 6941
}
'

curl -X POST "localhost:8080/production-country/3289" -H 'Content-Type: application/json' -d'
{
  "country_id": 7686,
  "movie_id": 6941,
  "production_country_id": 3289
}
'

curl -X GET "localhost:8080/production-country/3289"

curl -X DELETE "localhost:8080/production-country/3289"

# --

