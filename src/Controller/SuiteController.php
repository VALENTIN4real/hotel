<?php

namespace App\Controller;

use App\Entity\Suite;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuiteController extends AbstractController
{
    #[Route('/suites', name: 'app_suites')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Suite::class);
        $suites = $repository->findAll();
        return $this->render('suite/suites.html.twig', [
            'suites' => $suites,
        ]);
    }

    #[Route('/suite/{id}', name: 'app_suite')]
    public function getSuiteById(ManagerRegistry $doctrine, int $id): Response
    {
        $repository = $doctrine->getRepository(Suite::class);
        $suite = $repository->find($id);
        return $this->render('suite/suite.html.twig', [
            'suite' => $suite
        ]);
    }
}
