<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class BaseController extends AbstractController {

    protected function json($data, int $status = 200, array $headers = [], array $context = []): JsonResponse {

        $payload = [
            "status" => $status,
            "data" => $data,
            "errors" => []
        ];

        if (intval($status / 100) != 2) {
            
            $payload["data"] = null;
            $errors = $data;

            if (!is_array($data)) $errors = [$data];

            $payload["errors"] = $errors;
        }

        return parent::json($payload, $status, $headers, $context);
    }

}
