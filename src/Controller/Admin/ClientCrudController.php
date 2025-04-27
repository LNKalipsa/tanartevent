<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Mes clients')
            ->setPageTitle('new', 'Créer un client')
            ->setPageTitle('edit', 'Modifier un client')
            ->setPageTitle('detail', 'Détails du client');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            //yield NumberField::new('id', 'ID du client')->onlyOnIndex(),
            yield TextField::new('name', 'Nom du client'),
            yield TextField::new('firstNameContact', 'Prénom du contact')->hideOnIndex(),
            yield TextField::new('lastNameContact', 'Nom du contact')->hideOnIndex(),
            yield EmailField::new('email', 'E-mail'),
            yield TelephoneField::new('telephone', 'Numéro de téléphone'),
            yield AssociationField::new('address', 'Adresse')->renderAsEmbeddedForm()
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->update(Crud::PAGE_INDEX, Action::NEW, fn (Action $action) => $action ->setLabel('Créer un client'))
            ->update(Crud::PAGE_INDEX, Action::DETAIL, fn (Action $action) => $action->setLabel('Détails du client'));
    }
}
