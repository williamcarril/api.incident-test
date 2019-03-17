<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Validator\ConstraintViolation;


abstract class BaseController extends AbstractController {

    protected $validator;

    public function __construct(ValidatorInterface $validator) {
        $this->validator = $validator;
    }

    protected function validate($target): iterable {
        
        $messages = [];
        $errors = $this->validator->validate($target);

        foreach($errors as $error) {
            $messages[] = $error->__toString();
        }

        return $messages;
    }

    protected function newConstraintViolationMessage($object, string $field, string $message): string {

        return sprintf("Object(%s).%s:\n    %s", get_class($object), $field, $message);
    }

    protected function getRepository($class): ServiceEntityRepository {
        return $this->getDoctrine()->getRepository($class);
    }

    protected function newNotFoundResponse(): JsonResponse {
        return $this->newResponse(null, 404);
    }

    protected function newResponse($data = null, int $status = 200, array $headers = [], array $context = []): JsonResponse {

        $payload = [
            "data" => $data,
            "errors" => null
        ];

        if (intval($status / 100) != 2) {
            
            $payload["data"] = null;
            $errors = $data;

            if (!is_array($data)) $errors = [$data];

            $payload["errors"] = $errors;
        }

        if ($status == 404) $payload = null;

        return $this->json($payload, $status, $headers, $context);
    }

}
