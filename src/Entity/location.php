<?php

namespace App\Entity;

use App\Entity\Car;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\locationRepository")
 */
class location
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $datedebut;
    /**
     * @ORM\Column(type="date")
     */
    private $datefin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="locations")
     */
    private $User;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Car", inversedBy="locations")
     */
    private $Car;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\location", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $Etatdl;


    /**
     * @ORM\Column(type="boolean")
     */
    private $validateProp;


    public function getdatedebut()
    {
        return $this->datedebut;
    }

    public function setdatedebut(\Datetime $datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }
    public function getdatefin()
    {
        return $this->datefin;
    }

    public function setdatefin(\Datetime $datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getCar(): ?self
    {
        return $this->Car;
    }

    public function setCar(Car $Car): self
    {
        $this->Car = $Car;

        return $this;
    }

    public function getEtatdl(): ?self
    {
        return $this->Etatdl;
    }

    public function setEtatdl(self $Etatdl): self
    {
        $this->Etatdl = $Etatdl;

        return $this;
    }

    public function getValidateProp()
    {
        return $this->validateProp;
    }

    public function setValidateProp(Bool $validateProp)
    {
        $this->validateProp = $validateProp;

        return $this;
    }

}
