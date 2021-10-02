<?php

declare(strict_types=1);

namespace Movies\MovieGenres;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class MovieGenresController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IMovieGenresService $service;

    public function __construct(IMovieGenresService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var MovieGenresModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $movieGenresId = (int) ($args["movie_genres_id"] ?? 0);
        if ($movieGenresId <= 0) {
            return new JsonResponse(["result" => $movieGenresId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var MovieGenresModel $model */
        $model = $this->service->createModel($data);
        $model->setMovieGenresId($movieGenresId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $movieGenresId = (int) ($args["movie_genres_id"] ?? 0);
        if ($movieGenresId <= 0) {
            return new JsonResponse(["result" => $movieGenresId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var MovieGenresModel $model */
        $model = $this->service->get($movieGenresId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var MovieGenresModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $movieGenresId = (int) ($args["movie_genres_id"] ?? 0);
        if ($movieGenresId <= 0) {
            return new JsonResponse(["result" => $movieGenresId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($movieGenresId);

        return new JsonResponse(["result" => $result]);
    }
}