<?php
namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class CorsSubscriber implements EventSubscriberInterface {

    public static function getSubscribedEvents() {
        return [
            KernelEvents::REQUEST  => ['onKernelRequest', 9999],
            KernelEvents::RESPONSE => ['onKernelResponse', 9999],
        ];
    }

    public function onKernelRequest(GetResponseEvent $event) {
        if (!$event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();
        $method  = $request->getRealMethod();

        if ('OPTIONS' === strtoupper($method)) {
            $response = new Response();
            $event->setResponse($response);
        }
    }

    public function onKernelResponse(FilterResponseEvent $event) {
        if (!$event->isMasterRequest()) {
            return;
        }

        $response = $event->getResponse();

        $headers = "Authorization, Content-Length, Content-Type, X-Requested-With";

        $response->headers->set('Access-Control-Allow-Origin', "*");
        $response->headers->set('Access-Control-Allow-Headers', $headers);
        $response->headers->set('Access-Control-Expose-Headers', $headers);
        $response->headers->set('Access-Control-Allow-Methods', "GET, POST, PUT, HEAD, DELETE");
        $response->headers->set('Access-Control-Max-Age', 120);
    }
}