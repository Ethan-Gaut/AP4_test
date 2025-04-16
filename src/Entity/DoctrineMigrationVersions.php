<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'doctrine_migration_versions')]
class DoctrineMigrationVersions
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 191)]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private string $version;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $executedAt;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $executionTime;

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getExecutedAt(): ?\DateTimeInterface
    {
        return $this->executedAt;
    }

    public function setExecutedAt(?\DateTimeInterface $executedAt): self
    {
        $this->executedAt = $executedAt;

        return $this;
    }

    public function getExecutionTime(): ?int
    {
        return $this->executionTime;
    }

    public function setExecutionTime(?int $executionTime): self
    {
        $this->executionTime = $executionTime;

        return $this;
    }
}
