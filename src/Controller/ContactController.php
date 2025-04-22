<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        // Création d'un nouvel objet Contact
        $contact = new Contact();

        // Création du formulaire
        // Le formulaire est lié à l'objet Contact
        $form = $this->createForm(ContactType::class, $contact);

        // Analyse de la requête (GET ou POST) et remplit l'objet $contact si le formulaire est soumis
        // et valide
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide, on enregistre les données dans la base de données
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les données du formulaire et on les enregistre dans la base de données
            $contact = $form->getData();
            // On peut également ajouter la date d'envoi
            $contact->setDateEnvoi(new \DateTimeImmutable());

            // On persiste l'objet Contact
            // et on le sauvegarde dans la base de données
            $em->persist($contact);
            // On enregistre les modifications dans la base de données
            $em->flush();

            //message flash pour indiquer que le message a été envoyé
            $this->addFlash('success', 'Votre message a bien été envoyé !');

            //Redirection vers la page de contact 
            return $this->redirectToRoute('contact');
        }
        // Si le formulaire n'est pas soumis ou n'est pas valide, on affiche le formulaire
        return $this->render('public/contact.html.twig', [
            'form' => $form->createView(),// On crée la vue du formulaire
        ]);
    }
}
