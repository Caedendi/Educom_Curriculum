<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OptredenRepository")
 */
class Optreden
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Poppodium", inversedBy="optredens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $poppodium;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artiest", inversedBy="optredens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $artiest;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artiest", inversedBy="optredens")
     * @ORM\JoinTable(name="voorprogramma")
     */
    private $voorprogramma;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $omschrijving;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datum;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $prijs;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ticket_url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $afbeelding_url;

    public function __construct()
    {
        $this->voorprogramma = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoppodium(): ?Poppodium
    {
        return $this->poppodium;
    }

    public function setPoppodium(?Poppodium $poppodium): self
    {
        $this->poppodium = $poppodium;

        return $this;
    }

    public function getArtiest(): ?Artiest
    {
        return $this->artiest;
    }

    public function setArtiest(?Artiest $artiest): self
    {
        $this->artiest = $artiest;

        return $this;
    }

    /**
     * @return Collection|Artiest[]
     */
    public function getVoorprogramma(): Collection
    {
        return $this->voorprogramma;
    }

    public function addVoorprogramma(Artiest $voorprogramma): self
    {
        if (!$this->voorprogramma->contains($voorprogramma)) {
            $this->voorprogramma[] = $voorprogramma;
        }

        return $this;
    }

    public function removeVoorprogramma(Artiest $voorprogramma): self
    {
        if ($this->voorprogramma->contains($voorprogramma)) {
            $this->voorprogramma->removeElement($voorprogramma);
        }

        return $this;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(?string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getPrijs(): ?string
    {
        return $this->prijs;
    }

    public function setPrijs(string $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }

    public function getTicketUrl(): ?string
    {
        return $this->ticket_url;
    }

    public function setTicketUrl(?string $ticket_url): self
    {
        $this->ticket_url = $ticket_url;

        return $this;
    }

    public function getAfbeeldingUrl(): ?string
    {
        return $this->afbeelding_url;
    }

    public function setAfbeeldingUrl(?string $afbeelding_url): self
    {
        $this->afbeelding_url = $afbeelding_url;

        return $this;
    }
}
