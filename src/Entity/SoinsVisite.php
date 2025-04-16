<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'soins_visite')]
#[ORM\Index(name: 'FK1', columns: ['id_categ_soins', 'id_type_soins', 'id_soins'])]
#[ORM\Index(name: 'visite', columns: ['visite'])]
#[ORM\Index(name: 'id_soins', columns: ['id_soins'])]
#[ORM\Index(name: 'id_categ_soins', columns: ['id_categ_soins'])]
#[ORM\Index(name: 'id_type_soins', columns: ['id_type_soins'])]
class SoinsVisite
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $visite;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $idCategSoins;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $idTypeSoins;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $idSoins;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $prevu;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $realise;

    public function getVisite(): ?int
    {
        return $this->visite;
    }

    public function getIdCategSoins(): ?int
    {
        return $this->idCategSoins;
    }

    public function getIdTypeSoins(): ?int
    {
        return $this->idTypeSoins;
    }

    public function getIdSoins(): ?int
    {
        return $this->idSoins;
    }

    public function getPrevu(): ?bool
    {
        return $this->prevu;
    }

    public function setPrevu(bool $prevu): self
    {
        $this->prevu = $prevu;

        return $this;
    }

    public function getRealise(): ?bool
    {
        return $this->realise;
    }

    public function setRealise(bool $realise): self
    {
        $this->realise = $realise;

        return $this;
    }
}
