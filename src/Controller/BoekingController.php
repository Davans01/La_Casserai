<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BoekingController extends AbstractController
{
    /**
     * @Route("/boeking", name="boeking")
     */
    public function index()
    {
        return $this->render('boeking/index.html.twig', [
            'controller_name' => 'BoekingController',
        ]);
    }
}
