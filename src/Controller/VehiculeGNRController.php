<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Essence;
use App\Entity\EssenceGNR;
use App\Entity\LivretHeure;
use App\Entity\User;
use App\Entity\Vehicule2;
use App\Form\AddEssenceGNRType;
use App\Form\AddLivretHeure;
use App\Form\ClientAjoutType;
use App\Form\ClientType;
use App\Form\VehiculeAjoutType;
use App\Form\VehiculeGNRAjoutType;
use App\Form\VehiculeGNRType;
use App\Form\VehiculeType;
use App\Repository\ClientRepository;
use App\Repository\EssenceRepository;
use App\Repository\EssenceGNRRepository;
use App\Repository\Vehicule2Repository;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Form\AddEssenceType;
use App\Repository\LivretHeureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ObjectManager\entityManager;


class VehiculeGNRController extends AbstractController
{
    #[Route('/admin/GestionVehiculeGNR', name: 'GestionVehiculeGNR')]
    public function GestionVehiculeGNR()
    {
        return $this->render('admin/vehiculeGNR/GestionVehiculeGNR.html.twig', [
        ]);
    }
/////////////////////////////////////
    /** @var Vehicule2Repository */
    private $Vehicule2Repository;

    public function __construct(Vehicule2Repository $Vehicule2Repository)
    {
        $this->Vehicule2Repository = $Vehicule2Repository;
    }
////////////////////////////

    /**
     * @Route("/admin/VehiculeGNR", name="VehiculeGNR")
     * @param Request $request
     * @return Response
     */
    public function Client(Vehicule2Repository $Vehicule2Repository,Request $request): Response
    {




        $page = $request->query->getInt('page', 1);

        $articles = $this->Vehicule2Repository->findPaginatedResults($page);

        return $this->render('admin/vehiculeGNR/VehiculeGNRActif.html.twig', [
            'articles' => $articles,
            'pagination' => [
                'current' => $page,
                'previous' => $page - 1 > 0 ? $page - 1 : null,
                'next' => $articles->count() > $page * $this->Vehicule2Repository::ITEMS_PER_PAGE ? $page + 1 : null
            ]
        ]);




    }

    #[Route('/admin/GestionVehiculeGNR/{id}', name: 'VehiculeGNRModif')]
    public function modifEssence(Vehicule2 $Vehicule2, Request $request): Response
    {



        $form = $this->createForm(VehiculeGNRType::class, $Vehicule2);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->persist($user);//inutile
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('VehiculeGNR');
        }

        return $this->render('admin/vehiculeGNR/VehiculeGNRModifActif.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    #[Route('/admin/AjoutVehiculeGNR', name: 'VehiculeGNRAdd')]
    public function ClientAdd(Vehicule2Repository $Vehicule2Repository, Request $request): Response
    {
        $Vehicule2 = new Vehicule2();
        $form = $this->createForm(VehiculeGNRAjoutType::class, $Vehicule2);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Vehicule2);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('VehiculeGNR');
        }

        return $this->render('admin/vehiculeGNR/VehiculeGNRAdd.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    #[Route('/admin/GestionVehiculeGNR/supp/{id}', name: 'suppVehiculeGNR')]
    public function suppclient(Vehicule2 $Vehicule2): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($Vehicule2);
        $em->flush();

        return $this->redirectToRoute('VehiculeGNR');

    }


}