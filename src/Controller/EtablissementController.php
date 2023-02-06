<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtablissementController extends AbstractController
{
    #[Route('/etablissements', name: 'app_etablissements')]
    public function index(): Response
    {
        return $this->render('etablissement/etablissements.html.twig', [
            'controller_name' => 'EtablissementController',
        ]);
    }
}
