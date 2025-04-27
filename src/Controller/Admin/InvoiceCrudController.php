<?php

namespace App\Controller\Admin;

use App\Entity\Invoice;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class InvoiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Invoice::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Mes factures')
            ->setPageTitle('new', 'Créer une facture')
            ->setPageTitle('edit', 'Modifier une facture')
            ->setPageTitle('detail', 'Détails de la facture');
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            yield IdField::new('id')->hideOnForm(),
            yield TextField::new('number', 'Numéro de facture'),
            yield DateField::new('emissionDate', "Date d'émission"),
            yield AssociationField::new('estimate', 'Devis associé'),
            yield AssociationField::new('adress', "Adresse de facturation")->hideOnForm(),
            yield DateField::new('eventDate', "Date de l'évènement"),
            yield TimeField::new('startTime', "Heure de début"),
            yield TimeField::new('endTime', "Heure de fin"),
            yield MoneyField::new('price', "Tarif")->setCurrency('EUR')->setCustomOption('storedAsCents', false),
            yield MoneyField::new('defrayal', "Défraiement")->setCurrency('EUR')->setCustomOption('storedAsCents', false)->hideOnIndex(),
            yield ChoiceField::new('status', 'Statut de la facture (émis/payé)')->setChoices([
                'Emis' => 'EMITTED',
                'Payé' => 'SIGNED',
            ])->renderExpanded(),



        ];
    }
}
