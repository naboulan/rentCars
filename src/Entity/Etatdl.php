<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtatdlRepository")
 */
class Etatdl
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $aag;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $aad;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $aavd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $aavg;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ag;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ad;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $av;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ar;

    /**
     * @ORM\Column(type="bigint")
     */
    private $km;
       /**
     * @ORM\OneToOne(targetEntity="App\Entity\Etatdl", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $location;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAag(): ?string
    {
        return $this->aag;
    }

    public function setAag(string $aag): self
    {
        $this->aag = $aag;

        return $this;
    }

    public function getAad(): ?string
    {
        return $this->aad;
    }

    public function setAad(string $aad): self
    {
        $this->aad = $aad;

        return $this;
    }

    public function getAavd(): ?string
    {
        return $this->aavd;
    }

    public function setAavd(string $aavd): self
    {
        $this->aavd = $aavd;

        return $this;
    }

    public function getAavg(): ?string
    {
        return $this->aavg;
    }

    public function setAavg(string $aavg): self
    {
        $this->aavg = $aavg;

        return $this;
    }

    public function getAg(): ?string
    {
        return $this->ag;
    }

    public function setAg(string $ag): self
    {
        $this->ag = $ag;

        return $this;
    }

    public function getAd(): ?string
    {
        return $this->ad;
    }

    public function setAd(string $ad): self
    {
        $this->ad = $ad;

        return $this;
    }

    public function getAv(): ?string
    {
        return $this->av;
    }

    public function setAv(string $av): self
    {
        $this->av = $av;

        return $this;
    }

    public function getAr(): ?string
    {
        return $this->ar;
    }

    public function setAr(string $ar): self
    {
        $this->ar = $ar;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(int $km): self
    {
        $this->km = $km;

        return $this;
    }

    
}
