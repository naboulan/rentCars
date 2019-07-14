<?php

namespace App\Entity;

use App\Entity\location as Location;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 * @Vich\Uploadable()
 */
class Car
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

 /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string|null
     */
    private $filename;

 /**
     *
     * @Vich\UploadableField(mapping="cars_image", fileNameProperty="filename", size="imageSize")
     *
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="integer")
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $carburant;

    /**
     * @ORM\Column(type="string")
     */
    private $year;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="float")
     */
    private $caution;

    /**
     * @ORM\Column(type="boolean")
     */
    private $boitAVitesse;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="car")
     */
    private $commentaire;
   /**
     * @ORM\OneToMany(targetEntity="App\Entity\location", mappedBy="Car")
     */
    private $locations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="cars")
     */
    private $user;

    /**
     * @ORM\Column(type="date")
     */
    private $updated_at;

    public function __construct()
    {
        $this->commentaire = new ArrayCollection();
        $this->locations = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?int
    {
        return $this->matricule;
    }

    public function setMatricule(int $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(string $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCaution(): ?float
    {
        return $this->caution;
    }

    public function setCaution(float $caution): self
    {
        $this->caution = $caution;

        return $this;
    }

    public function getBoitAVitesse(): ?bool
    {
        return $this->boitAVitesse;
    }

    public function setBoitAVitesse(bool $boitAVitesse): self
    {
        $this->boitAVitesse = $boitAVitesse;

        return $this;
    }

    public function getCar(): ?self
    {
        return $this->car;
    }

    public function setCar(?self $car): self
    {
        $this->car = $car;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCommentaire(): Collection
    {
        return $this->commentaire;
    }

    public function addCommentaire(self $commentaire): self
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire[] = $commentaire;
            $commentaire->setCar($this);
        }

        return $this;
    }

    public function removeCommentaire(self $commentaire): self
    {
        if ($this->commentaire->contains($commentaire)) {
            $this->commentaire->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getCar() === $this) {
                $commentaire->setCar(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocations(Location $locations): self
    {
        if (!$this->locations->contains($locations)) {
            $this->locations[] = $locations;
            $locations->setCar($this);
        }

        return $this;
    }

    public function removeLocations(Location $locations): self
    {
        if ($this->locations->contains($locations)) {
            $this->locations->removeElement($locations);
            // set the owning side to null (unless already changed)
            if ($locations->getCar() === $this) {
                $locations->setCar(null);
            }
        }

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
    
    public function getImageFile()
    {
        return $this->imageFile;
    }
    // public function setImageFile(?File $imageFile): property
    // {
    //     $this->imageFile = $imageFile;
    //     if ($this->imageFile instanceof UploadedFile) {
    //         $this->updated_at = new \DateTime('now');
    //     }
    //     return $this;
    // }

    public function setFilename(?string $filename): void
    {
        $this->filename = $filename;
        
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTime $updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

}
