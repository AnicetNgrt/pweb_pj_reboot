<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VehicleRepository::class)
 * @ORM\Table(name="vehicles")
 */
class Vehicle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank
     * @Assert\Length(min=4, max=64)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $stock;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(max=255)
     * @Assert\Json(
     *     message = "You've entered an invalid Json."
     * )
     */
    private $characsJSON;

    /**
     * @ORM\Column(type="string", length=32)
     * @Assert\NotBlank
     */
    private $locationStatus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getCharacsJSON(): ?string
    {
        return $this->characsJSON;
    }

    public function setCharacsJSON(string $characsJSON): self
    {
        $this->characsJSON = $characsJSON;

        return $this;
    }

    public function getLocationStatus(): ?string
    {
        return $this->locationStatus;
    }

    public function setLocationStatus(string $locationStatus): self
    {
        $this->locationStatus = $locationStatus;

        return $this;
    }

    public function isAvailable(): bool
    {
        return $this->getLocationStatus() == "disponible";
    }
}
