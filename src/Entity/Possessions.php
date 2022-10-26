<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PossessionsRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PossessionsRepository::class)]
class Possessions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['possessions'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['possessions'])]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['possessions'])]
    private ?float $value = null;

    #[ORM\Column(length: 255)]
    #[Groups(['possessions'])]
    private ?string $type = null;

    #[
        ORM\ManyToOne(inversedBy: 'possessions'),
        Groups(['user_detail']),
    ]
    private ?Users $users = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }
}
