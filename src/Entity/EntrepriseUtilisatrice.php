<?php

namespace App\Entity;

use App\Repository\EntrepriseUtilisatriceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrepriseUtilisatriceRepository::class)
 */
class EntrepriseUtilisatrice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $raison_sociale;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity=Utilisateur::class, mappedBy="entrepriseUtilisatrice")
     */
    private $utilisateur;

    /**
     * @ORM\OneToMany(targetEntity=Chauffeur::class, mappedBy="entrepriseUtilisatrice")
     */
    private $chauffeur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    public function __construct()
    {
        $this->utilisateur = new ArrayCollection();
        $this->chauffeur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaisonSociale(): ?string
    {
        return $this->raison_sociale;
    }

    public function setRaisonSociale(?string $raison_sociale): self
    {
        $this->raison_sociale = $raison_sociale;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(?string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateur(): Collection
    {
        return $this->utilisateur;
    }

    public function addUtilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->utilisateur->contains($utilisateur)) {
            $this->utilisateur[] = $utilisateur;
            $utilisateur->setEntrepriseUtilisatrice($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): self
    {
        if ($this->utilisateur->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getEntrepriseUtilisatrice() === $this) {
                $utilisateur->setEntrepriseUtilisatrice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Chauffeur>
     */
    public function getChauffeur(): Collection
    {
        return $this->chauffeur;
    }

    public function addChauffeur(Chauffeur $chauffeur): self
    {
        if (!$this->chauffeur->contains($chauffeur)) {
            $this->chauffeur[] = $chauffeur;
            $chauffeur->setEntrepriseUtilisatrice($this);
        }

        return $this;
    }

    public function removeChauffeur(Chauffeur $chauffeur): self
    {
        if ($this->chauffeur->removeElement($chauffeur)) {
            // set the owning side to null (unless already changed)
            if ($chauffeur->getEntrepriseUtilisatrice() === $this) {
                $chauffeur->setEntrepriseUtilisatrice(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

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
}
