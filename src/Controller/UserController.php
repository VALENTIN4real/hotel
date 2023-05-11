<?php

namespace App\Controller;

use App\Entity\Reservation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $reservations = $doctrine->getRepository(Reservation::class)->findAll();
        return $this->render('user/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }
}
