<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
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
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Question", mappedBy="categorie")
     */
    private $questions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Scroll", mappedBy="categorie")
     */
    private $scrolls;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->scrolls = new ArrayCollection();
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
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setCategorie($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getCategorie() === $this) {
                $question->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Scroll[]
     */
    public function getScrolls(): Collection
    {
        return $this->scrolls;
    }

    public function addScroll(Scroll $scroll): self
    {
        if (!$this->scrolls->contains($scroll)) {
            $this->scrolls[] = $scroll;
            $scroll->setCategorie($this);
        }

        return $this;
    }

    public function removeScroll(Scroll $scroll): self
    {
        if ($this->scrolls->contains($scroll)) {
            $this->scrolls->removeElement($scroll);
            // set the owning side to null (unless already changed)
            if ($scroll->getCategorie() === $this) {
                $scroll->setCategorie(null);
            }
        }

        return $this;
    }
}
