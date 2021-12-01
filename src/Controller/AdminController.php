<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/admin", name="app_admin_admin")
     */

    public function admin()
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('admin/index.html.twig', [
            'users' => $users
        ]);
    }
    /**
     * @Route("/admin/menu", name="menu")
     */

    public function adminmenu()
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');


        return $this->render('admin/menu.html.twig', [

        ]);
    }



}