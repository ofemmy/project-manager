<?php


    namespace App\Controller;


    use App\Entity\Project;
    use App\Entity\Task;
    use App\Enum\StatusTypeEnum;
    use App\Repository\ProjectRepository;
    use App\Repository\TaskRepository;
    use App\Services\CustomTestService;
    use App\Services\TestInterface;
    use Carbon\Carbon;
    use Carbon\CarbonImmutable;
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
            return $this->render("project/login.html.twig",compact("projects"));
        }

        /**
         * @Route("/new")
         * @param Request $request
         * @return Response
         * @throws \Exception
         */
        public function testCreate(Request $request):Response {
            $em=$this->getDoctrine()->getManager();
            $startDate = CarbonImmutable::today();
            $endDate = $startDate->addMonth();

            $project = new Project();
            $project->setTitle("Build a new house");
            $project->setStatus(StatusTypeEnum::STATUS_ONGOING);
            $project->setStartDate($startDate);
            $project->setEndDate($endDate);
            $em->persist($project);
            $em->flush();
            return new Response(
                "New project added with id of " . $project->getId()
            );
        }

        /**
         * @Route("/service")
         * @param TestInterface $cs
         */
        public function service(TestInterface $cs)
        {

            $cs->test();
        }
    }