<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/admin/api", name="app_home")
     */
    public function index(CallApiService $callApiService): Response
    {
        $response = $this->render('home/index.html.twig', [
            'data' => $callApiService->getClients(),
            'departments' => $callApiService->getAllData(),
        ]);

        $response->setSharedMaxAge(3600);

        return $response;
    }
}
