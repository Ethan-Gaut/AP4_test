<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipeController extends AbstractController
{
    #[Route('/equipe', name: 'equipepage')]
    public function index(EntityManagerInterface $entityManager, $user): Response
    {
        // Récupérer toutes les personnes de la base de données
        $personnes = $entityManager->getRepository(Personne::class)->findAll();

        return $this->render('equipe/index.html.twig', [
            'personnes' => $personnes,
        ]);
    }
}