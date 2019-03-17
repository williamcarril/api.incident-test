<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 * @ORM\Table(name="tb_type")
 */
class Type implements \JsonSerializable {

    const BRUTE_FORCE_ATTACK_SLUG = "brute-force-attack";
    const LOGIN_DATA_LEAK_SLUG = "login-data-leak";
    const DDOS_ATTACK_SLUG = "ddos-attack";
    const ABNORMAL_USER_ACTIVITY_SLUG = "abnormal-user-activity";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=50)
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

    public function jsonSerialize() {
        return get_object_vars($this);
    }
}
