<?php

// src/Controller/ProfilController.php

namespace App\Controller;

use App\Entity\PersonneLogin;
use App\Form\ProfilLoginType;
use App\Form\ProfilPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $hasher): Response
    {
        $user = $this->getUser();
        if (!$user instanceof PersonneLogin) {
            throw $this->createAccessDeniedException();
        }

        // Formulaire de modification login
        $loginForm = $this->createForm(ProfilLoginType::class, $user);
        $loginForm->handleRequest($request);

        if ($loginForm->isSubmitted() && $loginForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Identifiant mis à jour');
            return $this->redirectToRoute('app_profil');
        }

        // Formulaire de modification mot de passe
        $passwordForm = $this->createForm(ProfilPasswordType::class);
        $passwordForm->handleRequest($request);

        if ($passwordForm->isSubmitted() && $passwordForm->isValid()) {
            $newPassword = $passwordForm->get('newPassword')->getData();
            $user->setMp($hasher->hashPassword($user, $newPassword));
            $em->flush();
            $this->addFlash('success', 'Mot de passe mis à jour');
            return $this->redirectToRoute('app_profil');
        }

        return $this->render('profil/index.html.twig', [
            'user' => $user,
            'loginForm' => $loginForm->createView(),
            'passwordForm' => $passwordForm->createView(),
        ]);
    }
}
