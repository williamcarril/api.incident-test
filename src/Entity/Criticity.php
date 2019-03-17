<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CriticityRepository")
 * @ORM\Table(name="tb_criticity")
 */
class Criticity extends BaseEntity {

    const HIGH_SLUG = "high";
    const MEDIUM_SLUG = "medium";
    const LOW_SLUG = "low";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $name;

    public function __construct()
    {
        $this->Status = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getSlug(): ?string {
        return $this->slug;
    }

    public function setSlug(string $slug): self {
        $this->slug = $slug;

        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }
}
