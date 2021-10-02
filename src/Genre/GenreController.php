<?php

declare(strict_types=1);

namespace Movies\Genre;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class GenreController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IGenreService $service;

    public function __construct(IGenreService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var GenreModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $genreId = (int) ($args["genre_id"] ?? 0);
        if ($genreId <= 0) {
            return new JsonResponse(["result" => $genreId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var GenreModel $model */
        $model = $this->service->createModel($data);
        $model->setGenreId($genreId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $genreId = (int) ($args["genre_id"] ?? 0);
        if ($genreId <= 0) {
            return new JsonResponse(["result" => $genreId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var GenreModel $model */
        $model = $this->service->get($genreId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var GenreModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $genreId = (int) ($args["genre_id"] ?? 0);
        if ($genreId <= 0) {
            return new JsonResponse(["result" => $genreId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($genreId);

        return new JsonResponse(["result" => $result]);
    }
}