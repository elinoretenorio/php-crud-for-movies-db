<?php

declare(strict_types=1);

namespace Movies\ProductionCountry;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class ProductionCountryController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IProductionCountryService $service;

    public function __construct(IProductionCountryService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var ProductionCountryModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $productionCountryId = (int) ($args["production_country_id"] ?? 0);
        if ($productionCountryId <= 0) {
            return new JsonResponse(["result" => $productionCountryId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var ProductionCountryModel $model */
        $model = $this->service->createModel($data);
        $model->setProductionCountryId($productionCountryId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $productionCountryId = (int) ($args["production_country_id"] ?? 0);
        if ($productionCountryId <= 0) {
            return new JsonResponse(["result" => $productionCountryId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var ProductionCountryModel $model */
        $model = $this->service->get($productionCountryId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var ProductionCountryModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $productionCountryId = (int) ($args["production_country_id"] ?? 0);
        if ($productionCountryId <= 0) {
            return new JsonResponse(["result" => $productionCountryId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($productionCountryId);

        return new JsonResponse(["result" => $result]);
    }
}