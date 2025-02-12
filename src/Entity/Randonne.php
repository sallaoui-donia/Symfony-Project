<?php

namespace App\Entity;

use App\Repository\RandonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RandonneRepository::class)
 */
class Randonne
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom_r;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $program;

    /**
     * @ORM\Column(type="date")
     */
    private $date_r;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prix_r;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $destination;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="randonne")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Inscription::class, mappedBy="randonne")
     */
    private $inscriptions;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }

    public function __toString(): ?string
    {
        return $this->nom_r;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomR(): ?string
    {
        return $this->nom_r;
    }

    public function setNomR(string $nom_r): self
    {
        $this->nom_r = $nom_r;

        return $this;
    }

    public function getProgram(): ?string
    {
        return $this->program;
    }

    public function setProgram(string $program): self
    {
        $this->program = $program;

        return $this;
    }

    public function getDateR(): ?\DateTimeInterface
    {
        return $this->date_r;
    }

    public function setDateR(\DateTimeInterface $date_r): self
    {
        $this->date_r = $date_r;

        return $this;
    }

    public function getPrixR(): ?string
    {
        return $this->prix_r;
    }

    public function setPrixR(string $prix_r): self
    {
        $this->prix_r = $prix_r;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

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

    /**
     * @return Collection|Inscription[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setRandonne($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getRandonne() === $this) {
                $inscription->setRandonne(null);
            }
        }

        return $this;
    }


}
