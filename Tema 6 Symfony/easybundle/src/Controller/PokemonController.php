<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;


/**
 * @Route("/pokemon")
 */
class PokemonController extends AbstractController
{
    /**
     * @Route("/", name="pokemon_index", methods={"GET"})
     */
    public function index(PokemonRepository $pokemonRepository): Response
    {
        return $this->render('pokemon/index.html.twig', [
            'pokemon' => $pokemonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pokemon_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $pokemon = new Pokemon();//crea la instancia
        $form = $this->createForm(PokemonType::class, $pokemon);//crea el form
        $form->handleRequest($request);//maneja la respuesta

        if ($form->isSubmitted() && $form->isValid()) {//comprobamos si recibimos info y es valida
            //COPIAR
            $imageFile = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);//slug quita simbolos raros, aqui se pone el nombre del archivo
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();//uniqid() le crea un id unico
                //este $newFileName es el nombre del archivo

                // Move the file to the directory where brochures are stored
                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $pokemon->setImage($newFilename);
            }else{
                $newFilename = 'default.jpg';
                $pokemon->setImage($newFilename);
            }
            ///////////
            
            $entityManager->persist($pokemon);
            $entityManager->flush();//guarda los cambios

            return $this->redirectToRoute('pokemon_index', [], Response::HTTP_SEE_OTHER);//redirige
        }

        return $this->renderForm('pokemon/new.html.twig', [
            'pokemon' => $pokemon,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="pokemon_show", methods={"GET"})
     */
    public function show(Pokemon $pokemon): Response
    {
        return $this->render('pokemon/show.html.twig', [
            'pokemon' => $pokemon,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pokemon_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Pokemon $pokemon, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /////COPIAR
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {

                }

                $pokemon->setImage($newFilename);
            }
            ///////////

            $entityManager->flush();

            return $this->redirectToRoute('pokemon_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pokemon/edit.html.twig', [
            'pokemon' => $pokemon,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="pokemon_delete", methods={"POST"})
     */
    public function delete(Request $request, Pokemon $pokemon, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pokemon->getId(), $request->request->get('_token'))) {
            $entityManager->remove($pokemon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pokemon_index', [], Response::HTTP_SEE_OTHER);
    }
}
