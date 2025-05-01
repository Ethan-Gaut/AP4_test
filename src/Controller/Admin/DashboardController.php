<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use App\Entity\Visite;
use App\Entity\Infirmiere;
use App\Entity\Patient;
use App\Entity\Soins;

use App\Entity\PersonneLogin;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Controller\Admin\PersonneLoginCrudController;
use App\Controller\Admin\VisiteCrudController;


#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{

    private AdminUrlGenerator $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 1.1) If you have enabled the "pretty URLs" feature:
        // return $this->redirectToRoute('admin_user_index');
        //
        // 1.2) Same example but using the "ugly URLs" that were used in previous EasyAdmin versions:
        //$adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        //return $this->redirect($adminUrlGenerator->setController(PersonneLoginCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
       //return $this->render('admin/dashboard.html.twig');

        $url = $this->adminUrlGenerator
            ->setController(PersonneLoginCrudController::class)
            ->generateUrl();

        return $this->redirect($url);



    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('AP4 Test')
            ->renderContentMaximized(); // ou .renderSidebarMinimized()



            // ->setTranslationDomain('admin')
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Gestion des utilisateurs');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', PersonneLogin::class)
            ->setController(PersonneLoginCrudController::class);
        yield MenuItem::linkToCrud('Infirmiere', 'fas fa-notes-medical', Infirmiere::class);
        yield MenuItem::linkToCrud('Patient', 'fas fa-notes-medical', Patient::class);

        yield MenuItem::section('Médicale');
        yield MenuItem::linkToCrud('Visites', 'fas fa-notes-medical', Visite::class);
        yield MenuItem::linkToCrud('Soins', 'fas fa-notes-medical', Soins::class);

    }

}
