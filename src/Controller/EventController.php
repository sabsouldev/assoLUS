<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EventController extends AbstractController
{
    // Route pour afficher la liste des événements
    #[Route('/evenements', name: 'event_list')]
    public function list(EventRepository $eventRepository): Response
    {
        // Récupération de la liste des événements depuis le repository
        $events = $eventRepository->findAll();

        // Rendu de la vue avec la liste des événements
        return $this->render('public/event_list.html.twig', [
            'events' => $events,
        ]);
    }
    // Route pour afficher le détail d’un événement en fonction de son slug ou de son id
    #[Route('/evenements/{id}', name: 'event_show')]
    public function show(int $id, EventRepository $eventRepository): Response
    {
        // On récupère l'événement correspondant à l'id
        $event = $eventRepository->find($id);

        // Si aucun événement n’est trouvé, on retourne une erreur 404
        if (!$event) {
            throw $this->createNotFoundException('Événement introuvable.');
        }

        // On affiche la vue de détail
        return $this->render('public/event_show.html.twig', [
            'event' => $event
        ]);
    }
}
