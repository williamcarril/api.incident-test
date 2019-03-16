<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IncidentController extends BaseController {

    /**
     * @Route("/incidents", name="incidents", methods={"GET"})
     */
    public function listAction() {

        $data = [];

        return $this->json($data);
    }

    /**
     * @Route("/incidents", name="incidents.new", methods={"POST"})
     */
    public function newAction(Request $request) {

        $data = [];

        return $this->json($data);
    }

    /**
     * @Route("/incidents/{id}", name="incidents.id", methods={"GET"})
     */
    public function getAction(Request $request, $id) {

        $data = [];

        return $this->json($data);
    }


    /**
     * @Route("/incidents/{id}", name="incidents.id.update", methods={"PUT"})
     */
    public function updateAction(Request $request, $id) {

        $data = [];

        return $this->json($data);
    }

    /**
     * @Route("/incidents/{id}", name="incidents.id.delete", methods={"DELETE"})
     */
    public function deleteAction(Request $request, $id) {

        $data = [];

        return $this->json($data);
    }
}
