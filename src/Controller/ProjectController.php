<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Tasks;
use App\Form\TasksType;
use App\Entity\Projects;
use Doctrine\ORM\EntityManager;
use App\Repository\TasksRepository;
use App\Repository\ProjectsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectController extends AbstractController
{
    #[Route('/', name: 'app_project')]
    public function index(ProjectsRepository $projectsRepository, Request $request): Response
    {
        //Show all of projects je récupère tous les projets
        $project =$projectsRepository->findAll();

        return $this->render('project/index.html.twig', [
            'projects' => $project, //je passe ici les données afin de les utiliser dans le template
            'controller_name' => 'ProjectController'
        ]);
    }
    // Show a project details with the id in parameter
    #[Route('/detail/{id}', name: 'app_detail')]
    public function detail(ProjectsRepository $projectsRepository, Projects $projects, TasksRepository $tasksRepository): Response
    {
        $id = $projects->getId();
        $detail = $projectsRepository->findBy(['id' => $id]);
        $task = $tasksRepository->findBy(['projects' => $id]);

        return $this->render('project/details.html.twig', [
            'projects' => $detail,
            'task' => $task
        ]);
    }

    #[Route('/task/{id}', name: 'app_task')]
    public function task(Projects $projects, EntityManagerInterface $entityManager, Request $request): Response
    {
        $task = new Tasks();
        $form= $this->createForm(TasksType::class,$task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {

            $idProject = $projects->getId(); 
            $task->setProjects($projects); //on attribut l'id récupéré a la nouvelle tâche créée
            
            $data = $form->getData();
    
            $entityManager->persist($data);
            $entityManager->flush();

            $this->addFlash(
                'task',
                'Tâche crée avec succès'
            );
            return $this->redirectToRoute('app_detail', array('id'=> $idProject));

        }
        return $this->render('project/task.html.twig', [
            'form' => $form->createView(),
            'project' => $projects
        ]);
}
}

