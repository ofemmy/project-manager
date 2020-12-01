<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/projects", name="project")
     * @param ProjectRepository $projectRepository
     * @return Response
     */
    public function index(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();
        return $this->render('project/index.html.twig', compact('projects'));
    }

    /**
     * @Route("/create",name="project-create")
     * @param ProjectRepository $projectRepository
     * @return Response
     */
    public function create(ProjectRepository $projectRepository)
    {
        $project=$projectRepository->find(1);
        if (!$project) {
            $em = $this->getDoctrine()->getManager();
            $projects = [
                ['title'=>'Project 1','description'=>'This is my first project'],
                ['title'=>'Project 2','description'=>'build a new Warehouse'],
                ['title'=>'Project 3','description'=>'Rebuild the basement'],
                ['title'=>'Project 4','description'=>'Prepare thesis presentation'],
            ];
            foreach ($projects as $project) {

                $proj = new Project();
                $proj->setTitle($project['title']);
                $proj->setDescription($project['description']);
                $em->persist($proj);
            }
            $em->flush();
            return $this->render('home.html.twig',['msg'=>'New Projects created and written to DB']);

        }
        return $this->render('home.html.twig',['msg'=>'Some projects already exist in the DB']);


    }

}
