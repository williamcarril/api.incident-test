<?php

namespace App\Repository;

use App\Entity\Criticity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Criticity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Criticity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Criticity[]    findAll()
 * @method Criticity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CriticityRepository extends ServiceEntityRepository {
    
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Criticity::class);
    }

}
