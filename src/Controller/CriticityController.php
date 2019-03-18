<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Criticity;

class CriticityController extends BaseController {

    /**
     * @Route("/criticities", name="criticities", methods={"GET", "OPTIONS"})
     */
    public function listAction() {

        $repo = $this->getRepository(Criticity::class);

        $data = $repo->findAll();

        return $this->newResponse($data);
    }
    
}
