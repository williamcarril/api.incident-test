<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Incident;
use App\Entity\Status;
use App\Entity\Type;
use App\Entity\Criticity;

class IncidentController extends BaseController {

    /**
     * @Route("/incidents", name="incidents", methods={"GET", "OPTIONS"})
     */
    public function listAction() {
        
        $repo = $this->getRepository(Incident::class);

        $data = $repo->findAll();

        return $this->newResponse($data);
    }

    /**
     * @Route("/incidents", name="incidents.new", methods={"POST"})
     */
    public function newAction(Request $request) {

        $input = $request->request;

        $data = $this->save(
            null,
            $input->get("title", ""),
            $input->get("description", ""),
            $input->get("criticity", ""),
            $input->get("type", "")
        );


        $status = 200;
        if (!($data instanceof Incident)) {
            $status = 422;
        }

        return $this->newResponse($data, $status);
    }

    /**
     * @Route("/incidents/{id}", name="incidents.id", methods={"GET"})
     */
    public function getAction(Request $request, $id) {

        $repo = $this->getRepository(Incident::class);

        $data = $repo->find($id);

        if ($data == null) return $this->newNotFoundResponse();

        return $this->newResponse($data);
    }


    /**
     * @Route("/incidents/{id}", name="incidents.id.update", methods={"PUT"})
     */
    public function updateAction(Request $request, int $id) {

        $input = $request->request;

        $repo = $this->getRepository(Incident::class);

        $data = $repo->find($id);

        if ($data == null) return $this->newNotFoundResponse();

        $data = $this->save(
            $data,
            $input->get("title", ""),
            $input->get("description", ""),
            $input->get("criticity", ""),
            $input->get("type", ""),
            $input->get("status", "")
        );

        $status = 200;
        if (!($data instanceof Incident)) {
            $status = 422;
        }

        return $this->newResponse($data, $status);
    }

    /**
     * @Route("/incidents/{id}", name="incidents.id.delete", methods={"DELETE"})
     */
    public function deleteAction(Request $request, $id) {

        $repo = $this->getRepository(Incident::class);

        $incident = $repo->find($id);
        if ($incident == null) return $this->newNotFoundResponse();

        $repo->delete($incident);

        return $this->newResponse();
    }

    public function save(?Incident $incident, string $title, string $description, string $criticitySlug, string $typeSlug, string $statusSlug = Status::OPEN_SLUG) {

        $errors = [];

        $incidentRepo = $this->getRepository(Incident::class);
        $statusRepo = $this->getRepository(Status::class);
        $criticityRepo = $this->getRepository(Criticity::class);
        $typeRepo = $this->getRepository(Type::class);
        if ($incident == null) $incident = new Incident();

        $criticity = $criticityRepo->findOneBy(["slug" => $criticitySlug]);
        if ($criticity == null && !empty($criticitySlug)) {
            $errors[] = $this->newConstraintViolationMessage($incident, "criticity", "Invalid value.");
        }
        
        $type = $typeRepo->findOneBy(["slug" => $typeSlug]);
        if ($type == null) {
            $errors[] = $this->newConstraintViolationMessage($incident, "type", "Invalid value.");
        }
        
        $status = $statusRepo->findOneBy(["slug" => $statusSlug]);
        if ($status == null) {
            $errors[] = $this->newConstraintViolationMessage($incident, "status", "Invalid value.");
        }

        $incident->setTitle($title);
        $incident->setDescription($description);
        $incident->setStatus($status);
        $incident->setCriticity($criticity);
        $incident->setType($type);

        $errors = array_merge($errors, $this->validate($incident));
        if (count($errors) > 0) {
            return $errors;
        }

        $incidentRepo->save($incident);

        return $incident;
    }
}
