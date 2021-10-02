<?php

declare(strict_types=1);

namespace Movies\Person;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class PersonController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IPersonService $service;

    public function __construct(IPersonService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var PersonModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $personId = (int) ($args["person_id"] ?? 0);
        if ($personId <= 0) {
            return new JsonResponse(["result" => $personId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var PersonModel $model */
        $model = $this->service->createModel($data);
        $model->setPersonId($personId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $personId = (int) ($args["person_id"] ?? 0);
        if ($personId <= 0) {
            return new JsonResponse(["result" => $personId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var PersonModel $model */
        $model = $this->service->get($personId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var PersonModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $personId = (int) ($args["person_id"] ?? 0);
        if ($personId <= 0) {
            return new JsonResponse(["result" => $personId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($personId);

        return new JsonResponse(["result" => $result]);
    }
}