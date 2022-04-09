<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 50)]
    private string $login;

    #[ORM\Column(type: 'string', length: 255)]
    private string $password;

    #[ORM\Column(type: 'string', length: 100)]
    private string $email;

    #[ORM\Column(type: 'string', length: 30)]
    private ?string $phone;

    #[ORM\Column(type: 'boolean')]
    private bool $isModerator;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Screenshot::class)]
    private Collection $screenshots;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Like::class)]
    private $likes;

    public function __construct()
    {
        $this->screenshots = new ArrayCollection();
        $this->likes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getIsModerator(): ?bool
    {
        return $this->isModerator;
    }

    public function setIsModerator(bool $isModerator): self
    {
        $this->isModerator = $isModerator;

        return $this;
    }

    /**
     * @return Collection<int, Screenshot>
     */
    public function getScreenshots(): Collection
    {
        return $this->screenshots;
    }

    public function addScreenshot(Screenshot $screenshot): self
    {
        if (!$this->screenshots->contains($screenshot)) {
            $this->screenshots[] = $screenshot;
            $screenshot->setUser($this);
        }

        return $this;
    }

    public function removeScreenshot(Screenshot $screenshot): self
    {
        if ($this->screenshots->removeElement($screenshot)) {
            // set the owning side to null (unless already changed)
            if ($screenshot->getUser() === $this) {
                $screenshot->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Like>
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Like $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setUser($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getUser() === $this) {
                $like->setUser(null);
            }
        }

        return $this;
    }

}
