<?php 
namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener {

    public function onKernelException(GetResponseForExceptionEvent $event) {

        $exception = $event->getException();
        $message = sprintf(
            'Unexpected error (code %s): %s.',
            $exception->getCode(),
            $exception->getMessage()
        );

        // Customize your response object to display the exception details
        $response = new JsonResponse();
        $response->setContent(json_encode([
            "data" => null,
            "errors" => [$message]
        ]));

        $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);

        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        }

        $event->setResponse($response);
    }
}