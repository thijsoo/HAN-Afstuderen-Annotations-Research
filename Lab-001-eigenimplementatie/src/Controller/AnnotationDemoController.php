<?php

namespace App\Controller;

use App\Annotation\Middleware\Middleware;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AnnotationDemoController
 * @package App\Controller
 * @Middleware(class="App\Domain\Middleware\ParameterChecker",method="checkGet",params={"demo"})
 */
class AnnotationDemoController extends Controller
{
    /**
     * @Route("/annotation/demo", name="annotation_demo")
     * @Middleware(class="App\Domain\Middleware\ParameterChecker",method="checkGet",params={"token","find"})
     */
    public function index()
    {
        return $this->render('annotation_demo/index.html.twig', [
            'controller_name' => 'AnnotationDemoController',
        ]);
    }

    /**
     * @Route("/annotation/controller", name="annotation_demo_controller")
     * @Middleware(class="App\Domain\Middleware\ParameterChecker",method="checkGet",params={"demomethod"})
     */
    public function controllerWide()
    {
        return $this->render('annotation_demo/index.html.twig', ['controller_name' => 'AnnotationDemoController',]);
    }
}
