<?php

declare(strict_types=1);

namespace Movies\MovieLanguages;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class MovieLanguagesController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IMovieLanguagesService $service;

    public function __construct(IMovieLanguagesService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var MovieLanguagesModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $movieLanguagesId = (int) ($args["movie_languages_id"] ?? 0);
        if ($movieLanguagesId <= 0) {
            return new JsonResponse(["result" => $movieLanguagesId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var MovieLanguagesModel $model */
        $model = $this->service->createModel($data);
        $model->setMovieLanguagesId($movieLanguagesId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $movieLanguagesId = (int) ($args["movie_languages_id"] ?? 0);
        if ($movieLanguagesId <= 0) {
            return new JsonResponse(["result" => $movieLanguagesId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var MovieLanguagesModel $model */
        $model = $this->service->get($movieLanguagesId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var MovieLanguagesModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $movieLanguagesId = (int) ($args["movie_languages_id"] ?? 0);
        if ($movieLanguagesId <= 0) {
            return new JsonResponse(["result" => $movieLanguagesId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($movieLanguagesId);

        return new JsonResponse(["result" => $result]);
    }
}