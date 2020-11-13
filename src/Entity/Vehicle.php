<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=VehicleRepository::class)
 * @ORM\Table(name="vehicles")
 * @Vich\Uploadable
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
    private $characsJSON = "{}";

    /**
     * @ORM\Column(type="string", length=32)
     * @Assert\NotBlank
     */
    private $locationStatus;

    /**
     * @Vich\UploadableField(mapping="vehicle_image", fileNameProperty="imageName")
     * @Assert\Image(maxSize="18M")
     */

    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="vehicles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct(){
        $this->setUpdatedAt(new \DateTime());
    }

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

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void 
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
