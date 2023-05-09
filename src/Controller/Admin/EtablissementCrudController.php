<?php

namespace App\Controller\Admin;

use App\Entity\Etablissement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EtablissementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Etablissement::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('ville'),
            TextField::new('adresse'),
            TextField::new('code_postal'),
            TextField::new('description'),
            TextField::new('titre'),
            ImageField::new('image')->setBasePath('public/uploads/etablissement/images')->setUploadDir('public/uploads/etablissement/images'),
        ];
    }
}
