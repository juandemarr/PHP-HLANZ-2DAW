<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/analytics")
 */
class AnalyticsController extends AbstractController
{
    /**
     * @Route("/", name="analytics", methods={"GET"})
     */
    public function analytics(UserRepository $userRepo, PostRepository $postRepo): Response
    {
        $totalUsers = count($userRepo->findAll());
        $totalPosts = count($postRepo->findAll());

        //Obtener id de los 5 posts con mas likes
        $arrayIdPostLikes = array();
        $fiveIdPostLikes = $postRepo->fiveIdPostLikes();
        foreach ($fiveIdPostLikes as $key => $value) {
            $arrayIdPostLikes[] = $value->getId();
            
        }
        //dump($arrayIdPostLikes);
        
        //Obtener numero de likes de los 5 posts
        $arrayNumberPostLikes = array();
        $fiveNumberPostLikes = $postRepo->fiveNumberPostLikes();
        foreach ($fiveNumberPostLikes as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $arrayNumberPostLikes[] = $value2;
            }
        }
        dump(json_encode($arrayNumberPostLikes));
        exit;
        
        
        
        //$fivePostComments = $postRepo->fivePostComments();
        
        return $this->render('analytics/analytics.html.twig', [
            'totalUsers' => $totalUsers,
            'totalPosts' => $totalPosts,
            'fivePostLikes' => $fivePostLikes,
            //'fivePostComments' => $fivePostComments
        ]);
    }
}