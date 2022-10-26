<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UsersRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user', 'user_detail'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user', 'user_detail'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user', 'user_detail'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user', 'user_detail'])]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user', 'user_detail'])]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user', 'user_detail'])]
    private ?string $phone = null;

    #[ORM\OneToMany(mappedBy: 'users', targetEntity: Possessions::class)]
    #[Groups(['user'])]
    private Collection $possessions;

    public function __construct()
    {
        $this->possessions = new ArrayCollection();
    }

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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection<int, Possessions>
     */
    public function getPossessions(): Collection
    {
        return $this->possessions;
    }

    public function addPossession(Possessions $possession): self
    {
        if (!$this->possessions->contains($possession)) {
            $this->possessions->add($possession);
            $possession->setUsers($this);
        }

        return $this;
    }

    public function removePossession(Possessions $possession): self
    {
        if ($this->possessions->removeElement($possession)) {
            // set the owning side to null (unless already changed)
            if ($possession->getUsers() === $this) {
                $possession->setUsers(null);
            }
        }

        return $this;
    }
}
