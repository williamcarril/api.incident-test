<?php

namespace App\Repository;

use App\Entity\Incident;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Incident|null find($id, $lockMode = null, $lockVersion = null)
 * @method Incident|null findOneBy(array $criteria, array $orderBy = null)
 * @method Incident[]    findAll()
 * @method Incident[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncidentRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Incident::class);
    }

    public function save(Incident $entity): void {
        
        $db = $this->getEntityManager();

        if ($entity->getId() == null) $db->persist($entity);
        
        $db->flush();
    }

    public function delete(Incident $entity): void {

        $db = $this->getEntityManager();

        $db->remove($entity);
        $db->flush();
    }
}
