<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {

        //$movie = $this->getDoctrine->getRepository('App:Movie')->findOneById(1);
        $movie = $this->getDoctrine()
        ->getRepository('App:Movie')
        ->findOneByTitle("Star",1);

        //$hasAcces = $this->isGranted('ROLE_ADMIN');
        //$username=$this->getUser()->getUsername(); 
        //$this es la entidad de la ejecucion, equivalente a la sesion,
        // solo tendremos ahi al usuario
        if($this->isGranted("ROLE_USER"))
            $username = $this->getUser()->getUsername();
        else $username="visitante";
        
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            //'movies' => $movies,
            'lapelicula' => $movie,//devuelve una tupla de pelicula, que al estar asociado al modelo pelicula 
            //es un objeto de ese modelo, con sus respectivas propiedades
            'username'=>$username
            //usar las variables creadas arriba. Las asigna a valores que enviamos a la vista twig
        ]);
    }
    /**
     * @Route("/films", name="films")
     */
    public function getFilms(): Response
    {
        $movies = $this->getDoctrine()//accede a la bd
        ->getRepository('App:Movie')//al repositorio 
        ->findAllVisible();//metodo de ese repositorio

        return $this->render('main/films.html.twig', [
            'controller_name' => 'MainController',
            'movies' => $movies
        ]);
    }
}
