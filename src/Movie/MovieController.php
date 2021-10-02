<?php

declare(strict_types=1);

namespace Movies\Movie;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class MovieController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IMovieService $service;

    public function __construct(IMovieService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var MovieModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $movieId = (int) ($args["movie_id"] ?? 0);
        if ($movieId <= 0) {
            return new JsonResponse(["result" => $movieId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var MovieModel $model */
        $model = $this->service->createModel($data);
        $model->setMovieId($movieId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $movieId = (int) ($args["movie_id"] ?? 0);
        if ($movieId <= 0) {
            return new JsonResponse(["result" => $movieId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var MovieModel $model */
        $model = $this->service->get($movieId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var MovieModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $movieId = (int) ($args["movie_id"] ?? 0);
        if ($movieId <= 0) {
            return new JsonResponse(["result" => $movieId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($movieId);

        return new JsonResponse(["result" => $result]);
    }
}