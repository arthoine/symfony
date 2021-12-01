<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Essence;
use App\Entity\EssenceGNR;
use App\Entity\LivretHeure;
use App\Entity\User;
use App\Form\AddEssenceGNRType;
use App\Form\AddLivretHeure;
use App\Form\ClientAjoutType;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use App\Repository\EssenceRepository;
use App\Repository\EssenceGNRRepository;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Form\AddEssenceType;
use App\Repository\LivretHeureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ObjectManager\entityManager;


class ClientController extends AbstractController
{
    #[Route('/admin/GestionClient', name: 'GestionClient')]
    public function GestionClient()
    {
        return $this->render('admin/Client/GestionClient.html.twig', [
        ]);
    }
/////////////////////////////////////
    /** @var ClientRepository */
    private $ClientRepository;

    public function __construct(ClientRepository $ClientRepository)
    {
        $this->ClientRepository = $ClientRepository;
    }
////////////////////////////

    /**
     * @Route("/admin/Client", name="Client")
     * @param Request $request
     * @return Response
     */
    public function Client(ClientRepository $ClientRepository,Request $request): Response
    {




        $page = $request->query->getInt('page', 1);

        $articles = $this->ClientRepository->findPaginatedResults($page);

        return $this->render('admin/Client/ClientActif.html.twig', [
            'articles' => $articles,
            'pagination' => [
                'current' => $page,
                'previous' => $page - 1 > 0 ? $page - 1 : null,
                'next' => $articles->count() > $page * $this->ClientRepository::ITEMS_PER_PAGE ? $page + 1 : null
            ]
        ]);




    }

    #[Route('/admin/Client/{id}', name: 'ClientModif')]
    public function modifEssence(Client $Client,ClientRepository $ClientRepository, Request $request): Response
    {



        $form = $this->createForm(ClientType::class, $Client);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->persist($user);//inutile
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('Client');
        }

        return $this->render('admin/Client/ClientModifActif.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    #[Route('/admin/AjoutClient', name: 'ClientAdd')]
    public function ClientAdd(ClientRepository $ClientRepository, Request $request): Response
    {
        $Client = new Client();
        $form = $this->createForm(ClientAjoutType::class, $Client);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Client);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('Client');
        }

        return $this->render('admin/Client/ClientAdd.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    #[Route('/admin/Client/supp/{id}', name: 'suppclient')]
    public function suppclient(Client $Client): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($Client);
        $em->flush();

        return $this->redirectToRoute('Client');

    }


}