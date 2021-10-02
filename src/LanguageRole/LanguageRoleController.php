<?php

declare(strict_types=1);

namespace Movies\LanguageRole;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class LanguageRoleController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ILanguageRoleService $service;

    public function __construct(ILanguageRoleService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var LanguageRoleModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $languageRoleId = (int) ($args["language_role_id"] ?? 0);
        if ($languageRoleId <= 0) {
            return new JsonResponse(["result" => $languageRoleId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var LanguageRoleModel $model */
        $model = $this->service->createModel($data);
        $model->setLanguageRoleId($languageRoleId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $languageRoleId = (int) ($args["language_role_id"] ?? 0);
        if ($languageRoleId <= 0) {
            return new JsonResponse(["result" => $languageRoleId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var LanguageRoleModel $model */
        $model = $this->service->get($languageRoleId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var LanguageRoleModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $languageRoleId = (int) ($args["language_role_id"] ?? 0);
        if ($languageRoleId <= 0) {
            return new JsonResponse(["result" => $languageRoleId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($languageRoleId);

        return new JsonResponse(["result" => $result]);
    }
}