<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatusRepository")
 */
class Status
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
     * @ORM\OneToMany(targetEntity="App\Entity\UserChallenge", mappedBy="status")
     */
    private $userChallenges;

    public function __construct()
    {
        $this->userChallenges = new ArrayCollection();
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

    /**
     * @return Collection|UserChallenge[]
     */
    public function getUserChallenges(): Collection
    {
        return $this->userChallenges;
    }

    public function addUserChallenge(UserChallenge $userChallenge): self
    {
        if (!$this->userChallenges->contains($userChallenge)) {
            $this->userChallenges[] = $userChallenge;
            $userChallenge->setStatus($this);
        }

        return $this;
    }

    public function removeUserChallenge(UserChallenge $userChallenge): self
    {
        if ($this->userChallenges->contains($userChallenge)) {
            $this->userChallenges->removeElement($userChallenge);
            // set the owning side to null (unless already changed)
            if ($userChallenge->getStatus() === $this) {
                $userChallenge->setStatus(null);
            }
        }

        return $this;
    }
}
