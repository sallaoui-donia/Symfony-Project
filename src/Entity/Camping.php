<?php

namespace App\Entity;

use App\Repository\CampingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampingRepository::class)
 */
class Camping
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
    private $nom_c;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $program;

    /**
     * @ORM\Column(type="date")
     */
    private $date_fin;

    /**
     * @ORM\Column(type="date")
     */
    private $date_debut;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $destination;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrplaces;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrbus;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prix_c;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="camping")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Inscription::class, mappedBy="camping")
     */
    private $inscriptions;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }


    public function __toString(): ?string
    {
        return $this->nom_c;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomC(): ?string
    {
        return $this->nom_c;
    }

    public function setNomC(string $nom_c): self
    {
        $this->nom_c = $nom_c;

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

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

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

    public function getNbrplaces(): ?int
    {
        return $this->nbrplaces;
    }

    public function setNbrplaces(int $nbrplaces): self
    {
        $this->nbrplaces = $nbrplaces;

        return $this;
    }

    public function getNbrbus(): ?int
    {
        return $this->nbrbus;
    }

    public function setNbrbus(int $nbrbus): self
    {
        $this->nbrbus = $nbrbus;

        return $this;
    }

    public function getPrixC(): ?string
    {
        return $this->prix_c;
    }

    public function setPrixC(string $prix_c): self
    {
        $this->prix_c = $prix_c;

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
            $inscription->setCamping($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getCamping() === $this) {
                $inscription->setCamping(null);
            }
        }

        return $this;
    }




}
