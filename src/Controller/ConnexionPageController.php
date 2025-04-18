<?php

namespace App\Controller;

use App\Entity\PersonneLogin;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class ConnexionPageController extends AbstractController
{
    #[Route('/', name: 'connexionpage')]
    public function index(): Response
    {
        return $this->render('connexionPage/index.html.twig', [
        ]);
    }
}
