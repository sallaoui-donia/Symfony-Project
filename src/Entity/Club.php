<?php

namespace App\Entity;
use Symfony\Component\HttpFoundation\File\File;
use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ClubRepository::class)
 */
class Club
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
     * @ORM\Column(type="string", length=50)
     */
    private $activite_c;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $adresse_c;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prix_c;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="club")
     */
    private $user;



    /**
     * @ORM\OneToMany(targetEntity=Inscription::class, mappedBy="club")
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

    public function getActiviteC(): ?string
    {
        return $this->activite_c;
    }

    public function setActiviteC(string $activite_c): self
    {
        $this->activite_c = $activite_c;

        return $this;
    }

    public function getAdresseC(): ?string
    {
        return $this->adresse_c;
    }

    public function setAdresseC(string $adresse_c): self
    {
        $this->adresse_c = $adresse_c;

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
            $inscription->setClub($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getClub() === $this) {
                $inscription->setClub(null);
            }
        }

        return $this;
    }


}
