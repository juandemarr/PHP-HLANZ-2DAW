<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

    /**
     * @Route("/users")
     */
class AdminController extends AbstractController
{
        /**
         * @Route("/", name="users")
         */
    
    public function listUsers()
    {
        $users = $this->getDoctrine()->getRepository('App:User')->findAll();

        return $this->render('main/user.html.twig', [
            'controller_name' => 'AdminController',
            'users' => $users
        ]);
    }
    /**
     * @Route("/admin/{id}", name="makeAdmin")
     */
    public function makeAdmin($id)
    {
        $user = $this->getDoctrine()->getRepository('App:User')->findOneById($id);
        $user->setRoles(["ROLE_ADMIN"]);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('users');
        

    }
    /**
     * @Route("/no-admin/{id}", name="makeNoAdmin")
     */
    public function makeNoAdmin($id)
    {
        $user = $this->getDoctrine()->getRepository('App:User')->findOneById($id);
        $user->setRoles([]);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('users');//se puede redirigir a la misma ruta de este controlador /users??
    }
}