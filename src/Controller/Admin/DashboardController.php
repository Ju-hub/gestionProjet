<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Tasks;
use App\Entity\Projects;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;


class DashboardController extends AbstractDashboardController
{

    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
        
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(ProjectsCrudController::class)->generateUrl();
        
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($url);

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('GestionProjets');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::subMenu('Projets', 'fa fa-home')->setSubItems([
            MenuItem::linkToCrud('Show Projects', 'fas fa-eye', Projects::class)
        ]);
        yield MenuItem::subMenu('Tasks', 'fa fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Show task', 'fas fa-eye', Tasks::class)
        ]);
        yield MenuItem::linkToCrud('Paramètres', 'fas fa-cog', User::class);
        
               // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
