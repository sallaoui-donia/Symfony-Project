<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriptionRepository::class)
 */
class Inscription
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
    private $nom_enfant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_enfant;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom_parent;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone_parent;

    /**
     * @ORM\Column(type="date")
     */
    private $date_naissance;



    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="inscriptions")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="inscriptions")
     */
    private $club;

    /**
     * @ORM\ManyToOne(targetEntity=Formation::class, inversedBy="inscriptions")
     */
    private $formation;

    /**
     * @ORM\ManyToOne(targetEntity=Camping::class, inversedBy="inscriptions")
     */
    private $camping;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="inscriptions")
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity=Randonne::class, inversedBy="inscriptions")
     */
    private $randonne;


    public function __toString(): ?string
    {
        return $this->nom_enfant;
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNomEnfant(): ?string
    {
        return $this->nom_enfant;
    }

    public function setNomEnfant(string $nom_enfant): self
    {
        $this->nom_enfant = $nom_enfant;

        return $this;
    }

    public function getPrenomEnfant(): ?string
    {
        return $this->prenom_enfant;
    }

    public function setPrenomEnfant(string $prenom_enfant): self
    {
        $this->prenom_enfant = $prenom_enfant;

        return $this;
    }

    public function getNomParent(): ?string
    {
        return $this->nom_parent;
    }

    public function setNomParent(string $nom_parent): self
    {
        $this->nom_parent = $nom_parent;

        return $this;
    }

    public function getTelephoneParent(): ?int
    {
        return $this->telephone_parent;
    }

    public function setTelephoneParent(int $telephone_parent): self
    {
        $this->telephone_parent = $telephone_parent;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

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

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): self
    {
        $this->club = $club;

        return $this;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function getCamping(): ?Camping
    {
        return $this->camping;
    }

    public function setCamping(?Camping $camping): self
    {
        $this->camping = $camping;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getRandonne(): ?Randonne
    {
        return $this->randonne;
    }

    public function setRandonne(?Randonne $randonne): self
    {
        $this->randonne = $randonne;

        return $this;
    }

}
