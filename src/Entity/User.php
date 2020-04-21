<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeProfil", inversedBy="users")
     */
    private $typeprofil;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Choix", mappedBy="user")
     */
    private $choixes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Item", mappedBy="user")
     */
    private $items;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="fromUser")
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="toUser")
     */
    private $sendMessages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserChallenge", mappedBy="user")
     */
    private $userChallenges;


    public function __construct()
    {
        $this->choixes = new ArrayCollection();
        $this->items = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->sendMessages = new ArrayCollection();
        $this->challenges = new ArrayCollection();
        $this->ongoingChallenge = new ArrayCollection();
        $this->userChallenges = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTypeprofil(): ?TypeProfil
    {
        return $this->typeprofil;
    }

    public function setTypeprofil(?TypeProfil $typeprofil): self
    {
        $this->typeprofil = $typeprofil;

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
            $choix->setUser($this);
        }

        return $this;
    }

    public function removeChoix(Choix $choix): self
    {
        if ($this->choixes->contains($choix)) {
            $this->choixes->removeElement($choix);
            // set the owning side to null (unless already changed)
            if ($choix->getUser() === $this) {
                $choix->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Item[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setUser($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getUser() === $this) {
                $item->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setFromUser($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getFromUser() === $this) {
                $message->setFromUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getSendMessages(): Collection
    {
        return $this->sendMessages;
    }

    public function addSendMessage(Message $sendMessage): self
    {
        if (!$this->sendMessages->contains($sendMessage)) {
            $this->sendMessages[] = $sendMessage;
            $sendMessage->setToUser($this);
        }

        return $this;
    }

    public function removeSendMessage(Message $sendMessage): self
    {
        if ($this->sendMessages->contains($sendMessage)) {
            $this->sendMessages->removeElement($sendMessage);
            // set the owning side to null (unless already changed)
            if ($sendMessage->getToUser() === $this) {
                $sendMessage->setToUser(null);
            }
        }

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
            $userChallenge->setUser($this);
        }

        return $this;
    }

    public function removeUserChallenge(UserChallenge $userChallenge): self
    {
        if ($this->userChallenges->contains($userChallenge)) {
            $this->userChallenges->removeElement($userChallenge);
            // set the owning side to null (unless already changed)
            if ($userChallenge->getUser() === $this) {
                $userChallenge->setUser(null);
            }
        }

        return $this;
    }

}
