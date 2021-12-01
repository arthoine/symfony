<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Essence;
use App\Entity\EssenceGNR;
use App\Entity\LivretHeure;
use App\Entity\User;
use App\Entity\Vehicule;
use App\Form\AddEssenceGNRType;
use App\Form\AddLivretHeure;
use App\Form\ClientAjoutType;
use App\Form\ClientType;
use App\Form\VehiculeAjoutType;
use App\Form\VehiculeType;
use App\Repository\ClientRepository;
use App\Repository\EssenceRepository;
use App\Repository\EssenceGNRRepository;
use App\Repository\VehiculeRepository;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Form\AddEssenceType;
use App\Repository\LivretHeureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ObjectManager\entityManager;


class VehiculeGazoilController extends AbstractController
{
    #[Route('/admin/GestionVehiculeGazoil', name: 'GestionVehiculeGazoil')]
    public function GestionClient()
    {
        return $this->render('admin/vehiculeGazoil/GestionVehiculeGazoil.html.twig', [
        ]);
    }
/////////////////////////////////////
    /** @var VehiculeRepository */
    private $VehiculeRepository;

    public function __construct(VehiculeRepository $VehiculeRepository)
    {
        $this->VehiculeRepository = $VehiculeRepository;
    }
////////////////////////////

    /**
     * @Route("/admin/VehiculeGazoil", name="VehiculeGazoil")
     * @param Request $request
     * @return Response
     */
    public function Client(VehiculeRepository $VehiculeRepository,Request $request): Response
    {




        $page = $request->query->getInt('page', 1);

        $articles = $this->VehiculeRepository->findPaginatedResults($page);

        return $this->render('admin/vehiculeGazoil/VehiculeGazoilActif.html.twig', [
            'articles' => $articles,
            'pagination' => [
                'current' => $page,
                'previous' => $page - 1 > 0 ? $page - 1 : null,
                'next' => $articles->count() > $page * $this->VehiculeRepository::ITEMS_PER_PAGE ? $page + 1 : null
            ]
        ]);




    }

    #[Route('/admin/VehiculeGazoil/{id}', name: 'VehiculeGazoilModif')]
    public function modifEssence(Vehicule $Vehicule, Request $request): Response
    {



        $form = $this->createForm(VehiculeType::class, $Vehicule);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->persist($user);//inutile
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('VehiculeGazoil');
        }

        return $this->render('admin/vehiculeGazoil/VehiculeGazoilModifActif.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    #[Route('/admin/AjoutVehiculeGazoil', name: 'VehiculeGazoilAdd')]
    public function ClientAdd(VehiculeRepository $VehiculeRepository, Request $request): Response
    {
        $Vehicule = new Vehicule();
        $form = $this->createForm(VehiculeAjoutType::class, $Vehicule);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Vehicule);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('VehiculeGazoil');
        }

        return $this->render('admin/vehiculeGazoil/VehiculeGazoilAdd.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    #[Route('/admin/VehiculeGazoil/supp/{id}', name: 'suppVehiculeGazoil')]
    public function suppclient(Vehicule $Vehicule): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($Vehicule);
        $em->flush();

        return $this->redirectToRoute('VehiculeGazoil');

    }


}