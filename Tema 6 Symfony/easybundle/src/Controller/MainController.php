<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pokemon;
use App\Entity\Type;

use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {
        $pokemon = $this->getDoctrine()->getManager()->getRepository("App:Pokemon")->findAll();
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'pokemon' => $pokemon
        ]);
    }


    /* recibir form creado con post en html*/
    /**
     * @Route("/buscar", name="buscar")
     */
    public function buscar(Request $request): Response
    {
        $txtBuscar = $request->get('txtBuscar');

        /*
        $pokemon = $this->getDoctrine()->getManager()->getRepository("App:Pokemon")->search($txtBuscar);
        $tipos = $this->getDoctrine()->getManager()->getRepository("App:Type")->search($txtBuscar);

        $temp = [];
        foreach($tipos as $tipo){
            foreach($tipo->getPokemon() as $p)
                $temp[] = $p;
        }
        $pokemones = array_merge($pokemon,$temp);
        */
        //Habria que comprobar que no salgan repetidos, usar mejor SQL Nativo

        //Poniendo esto en repository da error en el doctrine
        $pokemones = $this->getDoctrine()->getManager()
            ->getRepository('App:Pokemon')
            ->createQueryBuilder('p')
            ->where('t.name LIKE :val OR p.name LIKE :val')
            ->setParameter('val','%'.$txtBuscar.'%')
            ->getQuery()
            ->getResult();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'pokemon' => $pokemones
        ]);
    }


    /**
     * @Route("/{id}", name="viewPokemon")
     */
    public function viewPokemon(Pokemon $p): Response //al indicarle la entidad a la que pertenece esa variable,
    //symfony lo encuentra solo sin tener que buscarlo con la linea de abajo
    //solo sirve cuando es uno a obtener
    {
        //$pokemon = $this->getDoctrine()->getManager()->getRepository("App:Pokemon")->findOneById($id);
        
        return $this->render('main/pokemon.html.twig', [
            'controller_name' => 'MainController',
            'p' => $p //se puede quitar, necesario para el enlace
        ]);
    }

    /**
     * @Route("/type/{id}", name="viewType")
     */
    public function viewType(Type $t): Response
    {
        return $this->render('main/type.html.twig', [
            'controller_name' => 'MainController',
            'type' => $t
        ]);
    }


    
}
