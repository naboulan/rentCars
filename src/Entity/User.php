<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Car", mappedBy="user")
     */
    private $cars;

    public function __construct() {
        $this->cars = new ArrayCollection();
        $this->locations = new ArrayCollection();
        $this->Messagerie = new ArrayCollection();
        $this->Car = new ArrayCollection();
      
    }
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mdp;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;
     /**
     *@ORM\Column(type="string", length=255)
     */
    private $datedenaissance;
     /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;
     /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;
     /**
     * @ORM\Column(type="integer")
     */
    private $codepostal;
    /**
     * @ORM\Column(type="string", length=10)
     */
    private $numtel;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numpermis;
 /**
     * @ORM\Column(type="integer")
     */
    private $anneepermis;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\location", mappedBy="User")
     */
    private $locations;

    

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="user")
     */
    private $Messagerie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="Car")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="user")
     */
    private $Car;


    public function getemail(): ?string
    {
        return $this->email;
    }

    public function setemail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    public function getmdp(): ?string
    {
        return $this->mdp;
    }

    public function setmdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getnom(): ?string
    {
        return $this->nom;
    }

    public function setnom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getprenom(): ?string
    {
        return $this->prenom;
    }

    public function setprenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getdatedenaissance(): ?string
    {
        return $this->datedenaissance;
    }

    public function setdatedenaissance(string $datedenaissance): self
    {
        $this->datedenaissance = $datedenaissance;

        return $this;
    }

    public function getadresse(): ?string
    {
        return $this->adresse;
    }

    public function setadresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
    public function getville(): ?string
    {
        return $this->ville;
    }

    public function setville(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
    public function getcodepostal(): ?int
    {
        return $this->codepostal;
    }

    public function setcodepostal(int $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    public function getnumtel(): ?string
    {
        return $this->numtel;
    }

    public function setnumtel(string $numtel): self
    {
        $this->numtel = $numtel;

        return $this;
    }


    public function getnumpermis(): ?string
    {
        return $this->numpermis;
    }

    public function setnumpermis(string $numpermis): self
    {
        $this->numpermis = $numpermis;

        return $this;
    }

    public function getanneepermis(): ?int
    {
        return $this->anneepermis;
    }

    public function setanneepermis(int $anneepermis): self
    {
        $this->anneepermis = $anneepermis;

        return $this;
    }

    /**
     * @return Collection|Location[]
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): self
    {
        if (!$this->locations->contains($location)) {
            $this->locations[] = $location;
            $location->setUser($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): self
    {
        if ($this->locations->contains($location)) {
            $this->locations->removeElement($location);
            // set the owning side to null (unless already changed)
            if ($location->getUser() === $this) {
                $location->setUser(null);
            }
        }

        return $this;
    }

    public function getUser(): ?self
    {
        return $this->user;
    }

    public function setUser(?self $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getMessagerie(): Collection
    {
        return $this->Messagerie;
    }

    public function addMessagerie(self $messagerie): self
    {
        if (!$this->Messagerie->contains($messagerie)) {
            $this->Messagerie[] = $messagerie;
            $messagerie->setUser($this);
        }

        return $this;
    }

    public function removeMessagerie(self $messagerie): self
    {
        if ($this->Messagerie->contains($messagerie)) {
            $this->Messagerie->removeElement($messagerie);
            // set the owning side to null (unless already changed)
            if ($messagerie->getUser() === $this) {
                $messagerie->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCar(): Collection
    {
        return $this->Car;
    }

    public function addCar(self $car): self
    {
        if (!$this->Car->contains($car)) {
            $this->Car[] = $car;
            $car->setUser($this);
        }

        return $this;
    }

    public function removeCar(self $car): self
    {
        if ($this->Car->contains($car)) {
            $this->Car->removeElement($car);
            // set the owning side to null (unless already changed)
            if ($car->getUser() === $this) {
                $car->setUser(null);
            }
        }

        return $this;
    }





}

