<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Entity\Reservation;
use App\Entity\Suite;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
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
        return $this->render('reservation/index.html.twig');
    }

    //#[Route('/liste-reservations', name: 'app_liste_reservation')]
    //public function getReservations(ManagerRegistry $doctrine): Response
    //{
    //    $reservations = $doctrine->getRepository(Reservation::class)->findBy(['client' => $this->getUser()]);
    //    return $this->render('reservations/liste-reservations.html.twig', [
    //        'reservations' => $reservations
    //    ]);
    //}

    #[Route('/api/reservation', name: 'app_reservation_suite')]
    public function postReservation(Request $request, ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        $userId = $user->getUserIdentifier();

        if ($userId > 0) {
            $reservationInfo = $request->getContent();
            $reservationInfo = json_decode($reservationInfo, true);

            // Convertir chaîne au format date en objet DateTimeInterface (format chaine : dd/mm/yyyy)
            $dateDebut = \DateTime::createFromFormat('d/m/Y', $reservationInfo['dateDebut']);
            $dateFin = \DateTime::createFromFormat('d/m/Y', $reservationInfo['dateFin']);

            $suite = $doctrine->getRepository(Suite::class)->find($reservationInfo['idSuite']);

            $newReservation = new Reservation();
            $newReservation->setClient($user);
            $newReservation->setSuite($suite);
            $newReservation->setDateDebut($dateDebut);
            $newReservation->setDateFin($dateFin);

            $doctrine->getManager()->persist($newReservation);

            $doctrine->getManager()->flush();

            return new Response('success');
        }


        // return error
        return new Response('error');
    }
}
