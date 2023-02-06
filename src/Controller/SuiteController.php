<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuiteController extends AbstractController
{
    #[Route('/suites', name: 'app_suites')]
    public function index(): Response
    {
        return $this->render('suite/suites.html.twig', [
            'controller_name' => 'SuiteController',
        ]);
    }
}
