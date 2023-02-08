<?php

namespace App\Controller\Admin;

use App\Entity\Etablissement;
use App\Entity\Suite;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SuiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Suite::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
        ];
    }*/

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            ImageField::new('image')->setBasePath('public/uploads/suite/images/')->setUploadDir('public/uploads/suite/images'),
            TextareaField::new('description'),
            MoneyField::new('prix')->setCurrency('EUR'),
            Field::new('id_etablissement')
                ->setFormType(EntityType::class)
                ->setFormTypeOptions([
                    'class' => Etablissement::class,
                    'choice_label' => 'nom',
                ]),
        ];
    }
}
