<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class ArticlesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Articles::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $categorie = AssociationField::new('categorie', 'Catégorie');
        $image = ImageField::new('image')
        ->setUploadDir('public/uploads/articles')
        ->setBasePath('uploads/articles')
        ->setRequired(false);

    $podcastUrl = UrlField::new('podcastUrl', 'Podcast (URL)')
        ->setHelp('Collez l’URL du fichier MP3 ou SoundCloud')
        ->setRequired(false);

    $videoUrl = UrlField::new('videoUrl', 'Vidéo (YouTube/Vimeo)')
        ->setHelp('Collez l’URL de la vidéo')
        ->setRequired(false);

    return [
        TextField::new('title', 'Titre'),
        $categorie,
        $image->hideWhenUpdating()->hideWhenCreating(),
        $podcastUrl->hideWhenUpdating()->hideWhenCreating(),
        $videoUrl->hideWhenUpdating()->hideWhenCreating(),
        ];
    }
}
