<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReponseRepository")
 */
class Reponse
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
    private $texte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="reponses")
     */
    private $question;


    /**
     * @ORM\Column(type="integer")
     */
    private $points;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Choix", mappedBy="reponse")
     */
    private $choixes;

    public function __construct()
    {
        $this->choixes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }


    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    /**
     * @return Collection|Choix[]
     */
    public function getChoixes(): Collection
    {
        return $this->choixes;
    }

    public function addChoix(Choix $choix): self
    {
        if (!$this->choixes->contains($choix)) {
            $this->choixes[] = $choix;
            $choix->setReponse($this);
        }

        return $this;
    }

    public function removeChoix(Choix $choix): self
    {
        if ($this->choixes->contains($choix)) {
            $this->choixes->removeElement($choix);
            // set the owning side to null (unless already changed)
            if ($choix->getReponse() === $this) {
                $choix->setReponse(null);
            }
        }

        return $this;
    }
}
