<?php

namespace App\Controller;

use App\Annotations\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OverwriteAnnotationController extends Controller
{
    /**
     * @Route("/overwrite/annotation", name="overwrite_annotation")
     * @Method({"GET", "POST"},locale="en")
     */
    public function index()
    {
        return $this->render('overwrite_annotation/index.html.twig', [
            'controller_name' => 'OverwriteAnnotationController',
        ]);
    }
}


