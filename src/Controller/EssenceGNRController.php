<?php

namespace App\Controller;

use App\Entity\Essence;
use App\Entity\EssenceGNR;
use App\Entity\User;
use App\Form\AddEssenceGNRType;
use App\Form\ModifEssenceGNRType;
use App\Repository\EssenceRepository;
use App\Repository\EssenceGNRRepository;

use App\Form\AddEssenceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ObjectManager\entityManager;


class EssenceGNRController extends AbstractController
{


    #[Route('/user/essenceGNR', name: 'essenceGNR')]
    public function formessence(EssenceGNRRepository $EssenceRepository, Request $request): Response
    {

        $user = new EssenceGNR();
        $user->setUser($this->getUser());


        $form = $this->createForm(AddEssenceGNRType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('essenceGNR');
        }



/////////////////affichage//////////////////////////////
        $em = $this->getDoctrine()->getManager();
        $dernierEssence = $em
            ->getRepository('App\entity\EssenceGNR')
            ->findBy(
                [
                    'user'=> $this->getUser()
                ],
                [
                    'id' => 'DESC'
                ],
                5
            );
        $em->flush();
        //dump($dernierEssence );





        return $this->render('user/essenceGNR.html.twig', [
            'registrationForm' => $form->createView(),
            'dernierEssences' => $dernierEssence,
        ]);
    }

    #[Route('/user/essenceGNR/edit/{id}', name: 'essenceGNRModif')]
    public function modifEssence(EssenceGNR $Essence,EssenceGNRRepository $EssenceRepository, Request $request): Response
    {



        $form = $this->createForm(ModifEssenceGNRType::class, $Essence);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->persist($user);//inutile
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('essenceGNR');
        }

        return $this->render('user/essenceGNRModification.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    #[Route('/user/essenceGNR/edit/supp/{id}', name: 'suppEssenceGNR')]
    public function suppEssence(EssenceGNR $Essence): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($Essence);
        $em->flush();

        return $this->redirectToRoute('essenceGNR');

    }


}
