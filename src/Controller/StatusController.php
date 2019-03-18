<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Status;

class StatusController extends BaseController {

    /**
     * @Route("/statuses", name="statuses", methods={"GET", "OPTIONS"})
     */
    public function listAction() {

        $repo = $this->getRepository(Status::class);

        $data = $repo->findAll();

        return $this->newResponse($data);
    }
    
}
