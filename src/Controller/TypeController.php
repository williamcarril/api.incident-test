<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Type;

class TypeController extends BaseController {

    /**
     * @Route("/types", name="types", methods={"GET", "OPTIONS"})
     */
    public function listAction() {

        $repo = $this->getRepository(Type::class);

        $data = $repo->findAll();

        return $this->newResponse($data);
    }
    
}
