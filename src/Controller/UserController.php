<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    /**
     * @Route("/useradd", name="user")
     */
    public function index ()
    {
        $user = new User();
        $user->setUsername('nomUtilisateur');
        $user->setUserid('nur');
        $user->setPassword('passwordenclair');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();


        return $this->render('...',
        [
            'controller_name'=>'UserController',
        ]);
    }


}