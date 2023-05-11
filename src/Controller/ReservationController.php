<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Entity\Suite;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $etablissements = $doctrine->getRepository(Etablissement::class)->findAll();
        $suites = $doctrine->getRepository(Suite::class)->findAll();
        return $this->render('reservation/index.html.twig', [
            'etablissements' => $etablissements,
            'suites' => $suites
        ]);
    }
}
