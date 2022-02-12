<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/movies")
     */

class MovieController extends AbstractController
{
    
        /**
         * @Route("/", name="mainMovie")
         */
        public function index(): Response
        {
        /*esto esta anidado dentro de /movies, equivalente a /movies/ esta ultima barra es como si no se pusiera, 
         y entraria aqui
         aqui se podria usar findAll() para obtener la lista al entrar en /movies
        */
            return $this->render('main/index.html.twig',[

            ]);
        }
        /**
         * @Route("/hide/{id}", name="hideMovie")
         */
        public function hide($id): Response
        {
            /*este {} para coger la variable y pasarla luego al metodo
            cuando queramos recargar una vista y no incluir una vista nueva, hacer redirectToRoute en lugar de render
            
            redirectToRoute equivale a header(location:), llamaria al main controller y que el se encargue 
            
            para renderizar hay que tener antes una serie de datos cargados, si no se hace ningun calculo 
            no es necesario, seria equivalente a require_once

            */

            $movie = $this->getDoctrine()->getRepository('App:Movie')->findOneById($id);
            $movie->setVisible(false);

            $em = $this->getDoctrine()->getManager();
            $em->persist($movie);
            $em->flush();

            return $this->redirectToRoute('main');
        }
    }
