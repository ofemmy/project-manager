<?php


    namespace App\Controller;


    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class TestController extends AbstractController
    {
        /**
         * @Route("/")
         * @param Request $request
         * @return Response
         */
        public function test(Request $request):Response {
            $ipAdd = $request->getClientIp();
            dump($ipAdd);
            return $this->render('home.html.twig',compact('ipAdd'));
        }
    }