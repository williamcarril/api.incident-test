<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatusRepository")
 * @ORM\Table(name="tb_status")
 */
class Status extends BaseEntity {

    const OPEN_SLUG = "open";
    const CLOSED_SLUG = "closed";

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
