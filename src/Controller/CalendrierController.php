<?php

namespace App\Controller;

use App\Entity\Essence;
use App\Entity\EssenceGNR;
use App\Entity\LivretHeure;
use App\Entity\User;
use App\Form\AddEssenceGNRType;
use App\Form\AddLivretHeure;
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

class CalendrierController extends AbstractController
{
    #[Route('/calendrier', name: 'calendrier')]
    public function index(LivretHeureRepository $EssenceRepository, Request $request): Response
    {

        $user = new LivretHeure();
        $user->setUserId($this->getUser());


        $form = $this->createForm(AddLivretHeure::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('heure');
        }



/////////////////affichage//////////////////////////////
        $em = $this->getDoctrine()->getManager();
        $dernierEssence = $em
            ->getRepository('App\entity\LivretHeure')
            ->findBy(
                [
                    'user_id'=> $this->getUser()
                ],
                [
                    'id' => 'DESC'
                ],
                7
            );
        $em->flush();


        $emheure = $this->getDoctrine()->getManager();
        $heuredb = $emheure
            ->getRepository('App\entity\LivretHeure')
            ->findBy(
                [
                    'user_id'=> $this->getUser()
                ]
            );
        $emheure->flush();
        //dump($heuredb);

        $idclient = $this->getDoctrine()->getManager();
        $nomclient = $idclient
            ->getRepository('App\entity\Client')
            ->findAll();
        $idclient->flush();
        //dump($nomclient);


        $year= date('Y');
        $r=array();
        $date = new \DateTime($year.'-01-01');
        while($date->format('Y') <= $year) {
            //$r[ANNEE][MOIS][JOUR] = LOUR DE LA SEMAINE;
            $y = $date->format('Y');
            $m = $date->format('n');
            $d = $date->format('j');
            $w = str_replace('0', '7', $date->format('w'));

            $r[$y][$m][$d] = $w;
            $addInterval= new \DateInterval('P1D');
            $date->add($addInterval);
        }
        $r= current($r);
        //dump($r);

        $days =array('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche');
        $months=array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

//////////////////////////////////////////////////////////////

        return $this->render('user/calendrier.html.twig', [
            'registrationForm' => $form->createView(),
            'dernierEssences' => $dernierEssence,
            'r'=>$r,
            'year'=>$year,
            'days'=>$days,
            'months'=>$months,
            'heuredb'=>$heuredb,
            'controller_name' => 'CalendrierController',
            'nomclient'=>$nomclient
        ]);
    }
}
