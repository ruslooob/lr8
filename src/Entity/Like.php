<?php

namespace App\Entity;

use App\Repository\LikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikeRepository::class)]
#[ORM\Table(name: '`like`')]
class Like
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'likes')]
    private User $User;

    #[ORM\ManyToOne(targetEntity: Screenshot::class, inversedBy: 'likes')]
    private Screenshot $Screenshot;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getScreenshot(): ?Screenshot
    {
        return $this->Screenshot;
    }

    public function setScreenshot(?Screenshot $Screenshot): self
    {
        $this->Screenshot = $Screenshot;

        return $this;
    }
}
