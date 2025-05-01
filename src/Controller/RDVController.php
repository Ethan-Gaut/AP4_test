<?php

namespace App\Controller;

use App\Entity\Visite;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RDVController extends AbstractController
{
    #[Route('/rdv', name: 'app_rdv')]
    public function index(EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        // Vérifie que l'utilisateur est bien connecté et a le rôle patient
        if (!$user || !in_array('ROLE_PATIENT', $user->getRoles(), true)) {
            throw $this->createAccessDeniedException('Accès réservé aux patients.');
        }

        // L'ID de l'utilisateur qui correspond au patient
        $patientId = $user->getId();

        // Requête pour récupérer les visites associées au patient
        $qb = $em->createQueryBuilder();
        $qb->select('v', 'p')
            ->from(Visite::class, 'v')
            ->join('v.patient', 'p')
            ->where('p.id = :id')
            ->setParameter('id', $patientId);

        $visites = $qb->getQuery()->getResult();

        return $this->render('rdv/index.html.twig', [
            'visites' => $visites,
        ]);
    }
}
