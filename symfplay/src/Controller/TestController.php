<?php


    namespace App\Controller;


    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class TestController extends AbstractController
    {
        /**
         * @Route("/test")
         */
        public function test():Response {
            return $this->render('home.html.twig');
        }
    }