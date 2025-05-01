<?php

namespace App\Controller\Admin;

use App\Entity\PersonneLogin;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PersonneLoginCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PersonneLogin::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(), // seulement visible en liste
            TextField::new('login'),
            TextField::new('roleMetier'),
            //TextField::new('title'),
            //TextEditorField::new('description'),
        ];
    }

}
