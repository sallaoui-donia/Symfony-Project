<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
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
    private $nom_e;

    /**
     * @ORM\Column(type="date")
     */
    private $date_e;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type_e;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $adresse_e;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prix_e;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="event")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Inscription::class, mappedBy="event")
     */
    private $inscriptions;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }



    public function __toString() {

        return $this->nom_e;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomE(): ?string
    {
        return $this->nom_e;
    }

    public function setNomE(string $nom_e): self
    {
        $this->nom_e = $nom_e;

        return $this;
    }

    public function getDateE(): ?\DateTimeInterface
    {
        return $this->date_e;
    }

    public function setDateE(\DateTimeInterface $date_e): self
    {
        $this->date_e = $date_e;

        return $this;
    }

    public function getTypeE(): ?string
    {
        return $this->type_e;
    }

    public function setTypeE(string $type_e): self
    {
        $this->type_e = $type_e;

        return $this;
    }

    public function getAdresseE(): ?string
    {
        return $this->adresse_e;
    }

    public function setAdresseE(string $adresse_e): self
    {
        $this->adresse_e = $adresse_e;

        return $this;
    }

    public function getPrixE(): ?string
    {
        return $this->prix_e;
    }

    public function setPrixE(string $prix_e): self
    {
        $this->prix_e = $prix_e;

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
            $inscription->setEvent($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getEvent() === $this) {
                $inscription->setEvent(null);
            }
        }

        return $this;
    }


}
