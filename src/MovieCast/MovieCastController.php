<?php

declare(strict_types=1);

namespace Movies\MovieCast;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class MovieCastController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IMovieCastService $service;

    public function __construct(IMovieCastService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var MovieCastModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $movieCastId = (int) ($args["movie_cast_id"] ?? 0);
        if ($movieCastId <= 0) {
            return new JsonResponse(["result" => $movieCastId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var MovieCastModel $model */
        $model = $this->service->createModel($data);
        $model->setMovieCastId($movieCastId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $movieCastId = (int) ($args["movie_cast_id"] ?? 0);
        if ($movieCastId <= 0) {
            return new JsonResponse(["result" => $movieCastId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var MovieCastModel $model */
        $model = $this->service->get($movieCastId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var MovieCastModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $movieCastId = (int) ($args["movie_cast_id"] ?? 0);
        if ($movieCastId <= 0) {
            return new JsonResponse(["result" => $movieCastId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($movieCastId);

        return new JsonResponse(["result" => $result]);
    }
}