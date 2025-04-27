<?php

namespace App\Controller\Admin;
use App\Entity\Client;
use App\Entity\Contact;
use App\Entity\Design;
use App\Entity\Estimate;
use App\Entity\Event;
use App\Entity\Invoice;
use App\Entity\Tag;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle("Tanart Event")
            ->renderContentMaximized()
            ->disableDarkMode();
    }

    public function configureMenuItems(): iterable
    {
            //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
            yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', User::class);
            yield MenuItem::linkToCrud('Client', 'fa-solid fa-person', Client::class);
            yield MenuItem::linkToCrud('Devis', 'fa fa-file-text', Estimate::class);
            yield MenuItem::linkToCrud('Facture', 'fa fa-file-text', Invoice::class);
            yield MenuItem::linkToCrud('Messagerie', 'fa-solid fa-envelope', Contact::class);
            //yield MenuItem::linkToCrud('Design', 'fa-solid fa-paintbrush', Design::class);
            //yield MenuItem::linkToCrud('Evènement', 'fa-solid fa-camera-retro', Event::class);
            //yield MenuItem::linkToCrud('Tags', 'fa-solid fa-tags', Tag::class);
            
            
    }
}
