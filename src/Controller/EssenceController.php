<?php

namespace App\Controller;

use App\Entity\Essence;
use App\Entity\User;
use App\Form\ModifEssenceType;
use App\Repository\EssenceRepository;

use App\Form\AddEssenceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ObjectManager\entityManager;


class EssenceController extends AbstractController
{


    #[Route('/user/essence', name: 'essence')]
    public function formessence(EssenceRepository $EssenceRepository, Request $request): Response
    {

        $user = new Essence();
        $user->setUser($this->getUser());


        $form = $this->createForm(AddEssenceType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('essence');
        }



/////////////////affichage//////////////////////////////
        $em = $this->getDoctrine()->getManager();
        $dernierEssence = $em
            ->getRepository('App\entity\Essence')
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


        return $this->render('user/essence.html.twig', [
            'registrationForm' => $form->createView(),
            'dernierEssences' => $dernierEssence,
        ]);
    }

    #[Route('/user/essence/edit/{id}', name: 'essenceModif')]
    public function modifEssence(Essence $Essence,EssenceRepository $EssenceRepository, Request $request): Response
    {



        $form = $this->createForm(ModifEssenceType::class, $Essence);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->persist($user);//inutile
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('essence');
        }

        return $this->render('user/essenceModification.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    #[Route('/user/essence/edit/supp/{id}', name: 'suppEssence')]
    public function suppEssence(Essence $Essence): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($Essence);
        $em->flush();

        return $this->redirectToRoute('essence');

    }


}
