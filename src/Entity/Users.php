<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups(['user', 'user_detail'])]
    private ?\DateTimeInterface $birthDate = null;
    
    #[Groups(['user', 'user_detail'])]
    private ?int $age = null;

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

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get the value of age
     */ 
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of age
     *
     * @return  self
     */ 
    public function setAge(int $age)
    {
        $this->age = $age;

        return $this;
    }
}
