<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AffichPlanController extends AbstractController
{
    /**
     * @Route("/user/Plan" , name="affichePlan")
     */

    public function index(): Response
    {

        return $this->render('user/affichePlan.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}