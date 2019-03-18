<?php 
namespace App\EventSubscriber;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface {


    public static function getSubscribedEvents() {
        return [
           KernelEvents::EXCEPTION => ['onKernelException', 9999]
        ];
    }

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