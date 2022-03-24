<?php

namespace App\Entity;

use App\Repository\TransportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransportRepository::class)
 */
class Transport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Chauffeur::class, inversedBy="transports")
     */
    private $chauffeur;

    /**
     * @ORM\ManyToOne(targetEntity=Vehicule::class, inversedBy="transports")
     */
    private $vehicule;

    /**
     * @ORM\ManyToMany(targetEntity=Marchandise::class, inversedBy="yes")
     */
    private $marchandise;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="transports")
     */
    private $expediteur;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="transports")
     */
    private $destinataire;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    public function __construct()
    {
        $this->marchandise = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChauffeur(): ?Chauffeur
    {
        return $this->chauffeur;
    }

    public function setChauffeur(?Chauffeur $chauffeur): self
    {
        $this->chauffeur = $chauffeur;

        return $this;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    /**
     * @return Collection<int, Marchandise>
     */
    public function getMarchandise(): Collection
    {
        return $this->marchandise;
    }

    public function addMarchandise(Marchandise $marchandise): self
    {
        if (!$this->marchandise->contains($marchandise)) {
            $this->marchandise[] = $marchandise;
        }

        return $this;
    }

    public function removeMarchandise(Marchandise $marchandise): self
    {
        $this->marchandise->removeElement($marchandise);

        return $this;
    }

    public function getExpediteur(): ?Client
    {
        return $this->expediteur;
    }

    public function setExpediteur(?Client $expediteur): self
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    public function getDestinataire(): ?Client
    {
        return $this->destinataire;
    }

    public function setDestinataire(?Client $destinataire): self
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
