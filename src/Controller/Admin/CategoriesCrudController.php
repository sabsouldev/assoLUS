<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categories::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name', 'Nom de la catégorie'),
            TextField::new('videoUrl', 'Vidéo (URL Youtube/Vimeo)')//ajout de la vidéo
                ->setHelp('Lien de la vidéo Youtube ou Vimeo'),//Ajoute une aide pour l'admin
            TextField::new('podcastUrl', 'Podcast (URL)')//ajout du podcast
                ->setHelp('Lien du podcast'),//Ajoute une aide pour l'admin
        ];
    }
    
}
