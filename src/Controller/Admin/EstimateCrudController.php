<?php

namespace App\Controller\Admin;

use App\Entity\Estimate;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class EstimateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Estimate::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Mes devis')
            ->setPageTitle('new', 'Créer un devis')
            ->setPageTitle('edit', 'Modifier un devis')
            ->setPageTitle('detail', 'Détails du devis');
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            yield IdField::new('id')->hideOnForm(),
            yield NumberField::new('number', 'Numéro de devis'),
            yield DateField::new('emissionDate', "Date d'émission")->hideOnIndex(),
            yield DateField::new('validateDate', "Date de fin de validité")->hideOnIndex(),
            yield AssociationField::new('client', 'client'),
            yield AssociationField::new('address', "Adresse de l'évènement")->renderAsEmbeddedForm()->hideOnIndex(),
            yield DateField::new('eventDate', "Date de l'évènement"),
            yield TimeField::new('startTime', "Heure de début"),
            yield TimeField::new('endTime', "Heure de fin"),
            yield MoneyField::new('price', "Tarif")->setCurrency('EUR')->setCustomOption('storedAsCents', false),
            yield MoneyField::new('defrayal', "Défraiement")->setCurrency('EUR')->setCustomOption('storedAsCents', false)->hideOnIndex(),
            yield ChoiceField::new('status', 'Statut du devis (émis/signé)')->setChoices([
                'Emis' => 'EMITTED',
                'Signé' => 'SIGNED',
                'Acompte réceptionné' => 'PAID_ADVANCED',
            ])->renderExpanded(),
            //yield AssociationField::new('event', 'Créer un évènement associé')->renderAsEmbeddedForm()->hideOnIndex()->hideOnDetail()
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->update(Crud::PAGE_INDEX, Action::DETAIL, fn (Action $action) => $action ->setLabel('Détails du devis'))
            ->update(Crud::PAGE_INDEX, Action::NEW, fn (Action $action) => $action ->setLabel('Créer un devis'));

    }

}
