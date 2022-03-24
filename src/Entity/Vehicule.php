<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VehiculeRepository::class)
 */
class Vehicule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modele;

    /**
     * @ORM\Column(type="float")
     */
    private $kilometrage;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_premiere_circulation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_derniere_maintenance;

    /**
     * @ORM\Column(type="float")
     */
    private $capacite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $periodicite_maintenance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $immatriculation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type_technique;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity=Transport::class, mappedBy="vehicule")
     */
    private $transports;

    public function __construct()
    {
        $this->transports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getKilometrage(): ?float
    {
        return $this->kilometrage;
    }

    public function setKilometrage(float $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getDatePremiereCirculation(): ?\DateTimeInterface
    {
        return $this->date_premiere_circulation;
    }

    public function setDatePremiereCirculation(?\DateTimeInterface $date_premiere_circulation): self
    {
        $this->date_premiere_circulation = $date_premiere_circulation;

        return $this;
    }

    public function getDateDerniereMaintenance(): ?\DateTimeInterface
    {
        return $this->date_derniere_maintenance;
    }

    public function setDateDerniereMaintenance(?\DateTimeInterface $date_derniere_maintenance): self
    {
        $this->date_derniere_maintenance = $date_derniere_maintenance;

        return $this;
    }

    public function getCapacite(): ?float
    {
        return $this->capacite;
    }

    public function setCapacite(float $capacite): self
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getPeriodiciteMaintenance(): ?int
    {
        return $this->periodicite_maintenance;
    }

    public function setPeriodiciteMaintenance(?int $periodicite_maintenance): self
    {
        $this->periodicite_maintenance = $periodicite_maintenance;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(?string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getTypeTechnique(): ?string
    {
        return $this->type_technique;
    }

    public function setTypeTechnique(?string $type_technique): self
    {
        $this->type_technique = $type_technique;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * @return Collection<int, Transport>
     */
    public function getTransports(): Collection
    {
        return $this->transports;
    }

    public function addTransport(Transport $transport): self
    {
        if (!$this->transports->contains($transport)) {
            $this->transports[] = $transport;
            $transport->setVehicule($this);
        }

        return $this;
    }

    public function removeTransport(Transport $transport): self
    {
        if ($this->transports->removeElement($transport)) {
            // set the owning side to null (unless already changed)
            if ($transport->getVehicule() === $this) {
                $transport->setVehicule(null);
            }
        }

        return $this;
    }
}
