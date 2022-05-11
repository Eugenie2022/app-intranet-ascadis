<?php

namespace App\Entity;

use App\Repository\AccesPortailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccesPortailRepository::class)]
class AccesPortail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $login;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\ManyToOne(targetEntity: Role::class, inversedBy: 'accesPortails')]
    #[ORM\JoinColumn(nullable: false)]
    private $habilitation;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHabilitation(): ?Role
    {
        return $this->habilitation;
    }

    public function setHabilitation(?Role $habilitation): self
    {
        $this->habilitation = $habilitation;

        return $this;
    }
}
