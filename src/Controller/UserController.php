<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AdherentsFormType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\Security\Http\Attribute\IsGranted;

final class UserController extends AbstractController
{
    #[Route('/mon-compte', name: 'espace_adherent')]
    #[IsGranted('ROLE_USER')]
    public function account(Request $request, EntityManagerInterface $em): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $userForm = $this->createForm(UserType::class, $user);
        $userForm->handleRequest($request);

        // Récupère l'entité Adherents liée à l'utilisateur
        $adherent = $user->getUserIdentifier(); // à adapter selon ta relation

        $adherentForm = $this->createForm(AdherentsFormType::class, $adherent);
        $adherentForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Informations du compte mises à jour.');
            return $this->redirectToRoute('espace_adherent');
        }

        if ($adherentForm->isSubmitted() && $adherentForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Informations d’adhésion mises à jour.');

            return $this->redirectToRoute('espace_adherent');
        }

        // Affiche la vue du profil avec le formulaire
        return $this->render('public/espace_adherent.html.twig', [
            'userform' => $userForm->createView(),
            'adherentform' => $adherentForm->createView(),
        ]);
    }
}
