<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use App\Entity\Categories;
use App\Entity\Products;
use App\Entity\Orders;
use App\Entity\Images;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Intl\Timezones;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator){}
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $url = $this -> adminUrlGenerator->setController(ProductsCrudController::class)->generateUrl();
        return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('E Commerce');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
           yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', Users::class);
           yield MenuItem::linkToCrud('Produits', 'fas fa-list', Products::class);
           yield MenuItem::linkToCrud('Categories', 'fas fa-list', Categories::class);
           yield MenuItem::linkToCrud('Commandes', 'fas fa-list', Orders::class);
           yield MenuItem::linkToCrud('Images', 'fas fa-list', Images::class);


    }
}
