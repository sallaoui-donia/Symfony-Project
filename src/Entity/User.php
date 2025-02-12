<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 *   fields={"email"},
 *    message="L'émail que vous avez tapé est déjà utilisé !"
 * )
 */
class User implements UserInterface
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
    private $username;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=250)
     *  @Assert\Length(
     *     min = 8,
     *     minMessage = "Votre mot de passe doit comporter au minimum {{ limit }} caractères")
     *  @Assert\EqualTo(propertyPath = "confirm_password",
     * message="Vous n'avez pas saisi le même mot de passe !" )
     */
    private $password;



    /**
     * @Assert\EqualTo(propertyPath = "password",
     *  message="Vous n'avez pas saisi le même mot de passe !" )
     */
    private $confirm_password;

    public function getConfirmPassword()
    {
        return $this->confirm_password;
    }
    public function setConfirmPassword($confirm_password)
    {
        $this->confirm_password = $confirm_password;
        return $this;
    }


    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity=Club::class, mappedBy="user")
     */
    private $club;

    /**
     * @ORM\OneToMany(targetEntity=Camping::class, mappedBy="user")
     */
    private $camping;

    /**
     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="user")
     */
    private $event;

    /**
     * @ORM\OneToMany(targetEntity=Formation::class, mappedBy="user")
     */
    private $formation;

    /**
     * @ORM\OneToMany(targetEntity=Randonne::class, mappedBy="user")
     */
    private $randonne;

    /**
     * @ORM\OneToMany(targetEntity=Inscription::class, mappedBy="user")
     */
    private $inscriptions;

    public function __construct()
    {
        $this->club = new ArrayCollection();
        $this->camping = new ArrayCollection();
        $this->event = new ArrayCollection();
        $this->formation = new ArrayCollection();
        $this->randonne = new ArrayCollection();
        $this->inscriptions = new ArrayCollection();
    }







    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString(): ?string
    {
        return $this->username;
    }
    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    public function getRoles()
    {
        $roles = $this->roles;
        $roles[] ='ROLE_USER';

        return array_unique($roles);
    }
    public function eraseCredentials(){}

    public function getSalt(){}



    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection|Club[]
     */
    public function getClub(): Collection
    {
        return $this->club;
    }

    public function addClub(Club $club): self
    {
        if (!$this->club->contains($club)) {
            $this->club[] = $club;
            $club->setUser($this);
        }

        return $this;
    }

    public function removeClub(Club $club): self
    {
        if ($this->club->removeElement($club)) {
            // set the owning side to null (unless already changed)
            if ($club->getUser() === $this) {
                $club->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Camping[]
     */
    public function getCamping(): Collection
    {
        return $this->camping;
    }

    public function addCamping(Camping $camping): self
    {
        if (!$this->camping->contains($camping)) {
            $this->camping[] = $camping;
            $camping->setUser($this);
        }

        return $this;
    }

    public function removeCamping(Camping $camping): self
    {
        if ($this->camping->removeElement($camping)) {
            // set the owning side to null (unless already changed)
            if ($camping->getUser() === $this) {
                $camping->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvent(): Collection
    {
        return $this->event;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->event->contains($event)) {
            $this->event[] = $event;
            $event->setUser($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->event->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getUser() === $this) {
                $event->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormation(): Collection
    {
        return $this->formation;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formation->contains($formation)) {
            $this->formation[] = $formation;
            $formation->setUser($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formation->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getUser() === $this) {
                $formation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Randonne[]
     */
    public function getRandonne(): Collection
    {
        return $this->randonne;
    }

    public function addRandonne(Randonne $randonne): self
    {
        if (!$this->randonne->contains($randonne)) {
            $this->randonne[] = $randonne;
            $randonne->setUser($this);
        }

        return $this;
    }

    public function removeRandonne(Randonne $randonne): self
    {
        if ($this->randonne->removeElement($randonne)) {
            // set the owning side to null (unless already changed)
            if ($randonne->getUser() === $this) {
                $randonne->setUser(null);
            }
        }

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
            $inscription->setUser($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getUser() === $this) {
                $inscription->setUser(null);
            }
        }

        return $this;
    }
}
