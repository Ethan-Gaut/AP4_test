<?php
/*
namespace App\Controller;

use App\Entity\Patient;
use App\Entity\Visite;
use App\Entity\Infirmiere;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VisiteController extends AbstractController
{
    #[Route('/visite', name: 'app_visite')]
    public function index(EntityManagerInterface $em): Response
    {
        $user = $this->getUser(); // Récupère l'utilisateur connecté
        $infirmiereId = $user->getId(); // Assure-toi que c'est bien l'ID attendu

        // Récupérer les visites associées à l’infirmière
        $qb = $em->createQueryBuilder();
        $qb->select('v')
            ->from(Visite::class, 'v')
            ->where('v.infirmiere = :id')
            ->setParameter('id', $infirmiereId);

        $visites = $qb->getQuery()->getResult();

        return $this->render('visite/index.html.twig', [
            'visites' => $visites,
        ]);
    }
}
*/

namespace App\Controller;

use App\Entity\Visite;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\VisiteType;

final class VisiteController extends AbstractController
{
    #[Route('/visite', name: 'app_visite')]
    public function index(EntityManagerInterface $em): Response
    {
        // Récupère l'utilisateur connecté
        $user = $this->getUser();
        $infirmiereId = $user->getId(); // L'ID de l'infirmière

        // Requête pour récupérer les visites associées à l'infirmière
        $qb = $em->createQueryBuilder();
        $qb->select('v', 'p')  // Sélectionne la visite (v) et le patient (p)
        ->from(Visite::class, 'v')
            ->join('v.patient', 'p')  // Jointure avec l'entité Personne
            ->where('v.infirmiere = :id')
            ->setParameter('id', $infirmiereId);

        $visites = $qb->getQuery()->getResult(); // Exécuter la requête pour obtenir les résultats

        // Renvoyer la vue avec les visites
        return $this->render('visite/index.html.twig', [
            'visites' => $visites,
        ]);
    }


    #[Route('/visite/ajouter', name: 'app_visite_ajouter')]
    public function ajouter(EntityManagerInterface $em, Request $request): Response
    {
        $user = $this->getUser(); // Récupère l'utilisateur connecté (l'infirmière)
        $infirmiere = $user; // Si l'utilisateur connecté est bien de type Infirmiere

        // Crée une nouvelle instance de Visite
        $visite = new Visite();

        // Assurez-vous d'attribuer l'infirmière à la visite
        $visite->setInfirmiere($infirmiere); // L'objet Infirmiere

        // Créer le formulaire pour la visite
        $form = $this->createForm(VisiteType::class, $visite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarder la visite
            $em->persist($visite);
            $em->flush();

            // Rediriger vers la page des visites après ajout
            return $this->redirectToRoute('app_visite');
        }

        return $this->render('visite/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }




    #[Route('/visite/modifier/{id}', name: 'app_visite_modifier')]
    public function modifier(int $id, EntityManagerInterface $em, Request $request): Response
    {
        $visite = $em->getRepository(Visite::class)->find($id);

        if (!$visite) {
            throw $this->createNotFoundException('Visite non trouvée');
        }

        // Créer le formulaire
        $form = $this->createForm(VisiteType::class, $visite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarder les modifications
            $em->flush();

            // Rediriger vers la page des visites après modification
            return $this->redirectToRoute('app_visite');
        }

        return $this->render('visite/modifier.html.twig', [
            'form' => $form->createView(),
            'visite' => $visite
        ]);
    }



    #[Route('/visite/supprimer/{id}', name: 'app_visite_supprimer')]
    public function supprimer(int $id, EntityManagerInterface $em): Response
    {
        $visite = $em->getRepository(Visite::class)->find($id);

        if (!$visite) {
            throw $this->createNotFoundException('Visite non trouvée');
        }

        // Supprimer la visite
        $em->remove($visite);
        $em->flush();

        // Rediriger vers la page des visites après suppression
        return $this->redirectToRoute('app_visite');
    }

}

