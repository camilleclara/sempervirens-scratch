<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeProfilRepository")
 */
class TypeProfil
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="typeprofil")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reponse", mappedBy="typeprofil")
     */
    private $reponses;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $consommation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $deplacements;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $diy;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->reponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setTypeprofil($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getTypeprofil() === $this) {
                $user->setTypeprofil(null);
            }
        }

        return $this;
    }

    public function getConsommation(): ?bool
    {
        return $this->consommation;
    }

    public function setConsommation(?bool $consommation): self
    {
        $this->consommation = $consommation;

        return $this;
    }

    public function getDeplacements(): ?bool
    {
        return $this->deplacements;
    }

    public function setDeplacements(?bool $deplacements): self
    {
        $this->deplacements = $deplacements;

        return $this;
    }

    public function getDiy(): ?bool
    {
        return $this->diy;
    }

    public function setDiy(?bool $diy): self
    {
        $this->diy = $diy;

        return $this;
    }

}
