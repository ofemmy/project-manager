<?php


    namespace App\Controller;


    use App\Entity\Project;
    use App\Entity\Task;
    use App\Enum\StatusTypeEnum;
    use App\Repository\ProjectRepository;
    use App\Repository\TaskRepository;
    use phpDocumentor\Reflection\Types\This;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Validator\Constraints\Date;

    class TestController extends AbstractController
    {
        /**
         * @Route("/test")
         * @param Request $request
         * @param ProjectRepository $projectRepository
         * @return Response
         */
        public function test(Request $request,ProjectRepository
        $projectRepository):Response {
           $em=$this->getDoctrine()->getManager();
            $projects = $projectRepository->fetchAllProjectsWithTasks();
            foreach ($projects as $project) {
                $task= $project->getTasks()[0];
                dump($task->getTitle());
            }
            return $this->render("project/index.html.twig",compact("projects"));
        }
    }