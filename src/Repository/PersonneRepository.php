<?php

namespace App\Repository;

use App\Entity\Personne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Personne>
 *
 * @method Personne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personne[]    findAll()
 * @method Personne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personne::class);
    }

    /**
     * Recherche une personne par nom et prénom.
     */
    public function findByNomPrenom(string $nom, string $prenom): ?Personne
    {
        return $this->createQueryBuilder('p')
            ->where('p.nom = :nom')
            ->andWhere('p.prenom = :prenom')
            ->setParameter('nom', $nom)
            ->setParameter('prenom', $prenom)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Recherche toutes les personnes d'une ville donnée.
     */
    public function findByVille(string $ville): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.ville = :ville')
            ->setParameter('ville', $ville)
            ->orderBy('p.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Trouver toutes les personnes vivantes (dateDeces = NULL).
     */
    public function findLivingPersons(): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.dateDeces IS NULL')
            ->getQuery()
            ->getResult();
    }

    /**
     * Trouver toutes les personnes décédées (dateDeces NON NULL).
     */
    public function findDeceasedPersons(): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.dateDeces IS NOT NULL')
            ->getQuery()
            ->getResult();
    }

    /**
     * Recherche avancée avec critères dynamiques.
     */
    public function findByCriteria(?string $nom, ?string $prenom, ?string $ville, ?bool $vivant): array
    {
        $qb = $this->createQueryBuilder('p');

        if ($nom) {
            $qb->andWhere('p.nom LIKE :nom')
                ->setParameter('nom', "%$nom%");
        }

        if ($prenom) {
            $qb->andWhere('p.prenom LIKE :prenom')
                ->setParameter('prenom', "%$prenom%");
        }

        if ($ville) {
            $qb->andWhere('p.ville = :ville')
                ->setParameter('ville', $ville);
        }

        if ($vivant !== null) {
            if ($vivant) {
                $qb->andWhere('p.dateDeces IS NULL');
            } else {
                $qb->andWhere('p.dateDeces IS NOT NULL');
            }
        }

        return $qb->getQuery()->getResult();
    }
}
