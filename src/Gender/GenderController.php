<?php

declare(strict_types=1);

namespace Movies\Gender;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class GenderController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IGenderService $service;

    public function __construct(IGenderService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var GenderModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $genderId = (int) ($args["gender_id"] ?? 0);
        if ($genderId <= 0) {
            return new JsonResponse(["result" => $genderId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var GenderModel $model */
        $model = $this->service->createModel($data);
        $model->setGenderId($genderId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $genderId = (int) ($args["gender_id"] ?? 0);
        if ($genderId <= 0) {
            return new JsonResponse(["result" => $genderId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var GenderModel $model */
        $model = $this->service->get($genderId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var GenderModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $genderId = (int) ($args["gender_id"] ?? 0);
        if ($genderId <= 0) {
            return new JsonResponse(["result" => $genderId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($genderId);

        return new JsonResponse(["result" => $result]);
    }
}