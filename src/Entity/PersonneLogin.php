<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity]
#[ORM\Table(name: 'personne_login')]
#[UniqueEntity(fields: ['login'], message: 'There is already an account with this login')]
class PersonneLogin implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 25, unique: true)]
    private string $login;

    #[ORM\Column(type: 'string', length: 64)]
    private string $mp;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $derniereConnexion;

    #[ORM\Column(type: 'string', length: 20)]
    private string $roleMetier; // valeurs possibles : 'infirmiere', 'admin', 'patient'

    public function getId(): ?int
    {
        return $this->id;
    }

    //public function getUserIdentifier(): string
    public function getLogin(): string
    {
        return $this->login;
    }

    public function getUserIdentifier(): string
    //public function getLogin(): string
    {
        return $this->login;
    }

    //public function setUserIdentifier(string $login): self
    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }
    public function getRoleMetier(): string
    {
        return $this->roleMetier;
    }

    public function setUserIdentifier(string $login): self
    //public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->mp;
    }

    public function getMp(): string
    {
        return $this->mp;
    }

    public function setMp(string $mp): self
    {
        $this->mp = $mp;
        return $this;
    }

    public function getRoles(): array
    {
        $roles = ['ROLE_PATIENT'];

        // Add the role based on the metier
        if ($this->roleMetier === 'infirmiere') {
            $roles[] = 'ROLE_INFIRMIERE';
        } elseif ($this->roleMetier === 'admin') {
            $roles[] = 'ROLE_ADMIN';
        } elseif ($this->roleMetier === 'patient') {
            $roles[] = 'ROLE_PATIENT';
        }

        return array_unique($roles);
    }
    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
        
    }
    public function isInfirmiere(): bool
    {
        return $this->metier === 'infirmiere';
    }
    public function isAdministrateur(): bool
    {
        return $this->metier === 'admin';
    }

    public function setRoleMetier(string $roleMetier): PersonneLogin
    {
        $this->roleMetier = $roleMetier;
        return $this;
    }

    public function getDerniereConnexion(): ?\DateTimeInterface
    {
        return $this->derniereConnexion;
    }

    public function setDerniereConnexion(?\DateTimeInterface $derniereConnexion): self
    {
        $this->derniereConnexion = $derniereConnexion;
        return $this;
    }
}