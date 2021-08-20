<?php

namespace App\Controller;

use App\Repository\BlogMessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(BlogMessageRepository $paraBlogMessageRepository): Response
    {
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'blog_message' => $paraBlogMessageRepository->findAll()
        ]);
    }
}
