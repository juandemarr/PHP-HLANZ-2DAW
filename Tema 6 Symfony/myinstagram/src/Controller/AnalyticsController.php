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
        
        $fivePostLikes = $postRepo->fivePostLikes();
        $fivePostComments = $postRepo->fivePostComments();
        
        return $this->render('analytics/analytics.html.twig', [
            'totalUsers' => $totalUsers,
            'totalPosts' => $totalPosts,
            'fivePostLikes' => $fivePostLikes,
            'fivePostComments' => $fivePostComments
        ]);
    }
}