<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'integer')]
    private $habilitation;

    #[ORM\OneToMany(mappedBy: 'habilitation', targetEntity: Utilisateur::class)]
    private $utilisateurs;

    #[ORM\OneToMany(mappedBy: 'habilitation', targetEntity: AccesPortail::class)]
    private $accesPortails;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
        $this->accesPortails = new ArrayCollection();
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

    public function getHabilitation(): ?int
    {
        return $this->habilitation;
    }

    public function setHabilitation(int $habilitation): self
    {
        $this->habilitation = $habilitation;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs[] = $utilisateur;
            $utilisateur->setHabilitation($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): self
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getHabilitation() === $this) {
                $utilisateur->setHabilitation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AccesPortail>
     */
    public function getAccesPortails(): Collection
    {
        return $this->accesPortails;
    }

    public function addAccesPortail(AccesPortail $accesPortail): self
    {
        if (!$this->accesPortails->contains($accesPortail)) {
            $this->accesPortails[] = $accesPortail;
            $accesPortail->setHabilitation($this);
        }

        return $this;
    }

    public function removeAccesPortail(AccesPortail $accesPortail): self
    {
        if ($this->accesPortails->removeElement($accesPortail)) {
            // set the owning side to null (unless already changed)
            if ($accesPortail->getHabilitation() === $this) {
                $accesPortail->setHabilitation(null);
            }
        }

        return $this;
    }
}