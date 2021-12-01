<?php

namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;


class RedirectionController extends AbstractController
{
    /**
     * @Route("/", name="redirect")
     */

    public function index(): RedirectResponse
    {


        return $this->redirectToRoute('app_logout');
    }



}