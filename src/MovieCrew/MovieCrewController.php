<?php

declare(strict_types=1);

namespace Movies\MovieCrew;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class MovieCrewController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IMovieCrewService $service;

    public function __construct(IMovieCrewService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var MovieCrewModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $movieCrewId = (int) ($args["movie_crew_id"] ?? 0);
        if ($movieCrewId <= 0) {
            return new JsonResponse(["result" => $movieCrewId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var MovieCrewModel $model */
        $model = $this->service->createModel($data);
        $model->setMovieCrewId($movieCrewId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $movieCrewId = (int) ($args["movie_crew_id"] ?? 0);
        if ($movieCrewId <= 0) {
            return new JsonResponse(["result" => $movieCrewId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var MovieCrewModel $model */
        $model = $this->service->get($movieCrewId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var MovieCrewModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $movieCrewId = (int) ($args["movie_crew_id"] ?? 0);
        if ($movieCrewId <= 0) {
            return new JsonResponse(["result" => $movieCrewId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($movieCrewId);

        return new JsonResponse(["result" => $result]);
    }
}