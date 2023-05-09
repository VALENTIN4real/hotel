<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Entity\Suite;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtablissementController extends AbstractController
{
    #[Route('/liste-etablissements', name: 'app_etablissements')]
    public function listEtablissements(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Etablissement::class);
        $etablissements = $repository->findAll();
        return $this->render('etablissement/etablissements.html.twig', [
            'controller_name' => 'EtablissementController',
            'etablissements' => $etablissements
        ]);
    }

    #[Route('/etablissement/{id}', name: 'app_etablissement')]
    public function getEtablissementById(ManagerRegistry $doctrine, int $id): Response
    {
        $repository = $doctrine->getRepository(Etablissement::class);
        $etablissement = $repository->find($id);
        $repositorySuites = $doctrine->getRepository(Suite::class);
        $suites = $repositorySuites->findBy(['etablissement' => $id]);
        return $this->render('etablissement/etablissement.html.twig', [
            'controller_name' => 'EtablissementController',
            'etablissement' => $etablissement,
            'suites' => $suites
        ]);
    }
}
