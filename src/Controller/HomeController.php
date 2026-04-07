<?php

namespace App\Controller;

use App\Chart\BlogDateChart;
use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(BlogRepository $blogRepository, Request $request): Response
    {
        return $this->render('home/index.html.twig', [
            'blogs' => $blogRepository->findPaginated($request->query->getInt('page', 1)),
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('home/about.html.twig');
    }

    #[Route('/dashboard', name: 'app_dashboard')]
    public function dashboard(BlogRepository $blogRepository, BlogDateChart $blogDateChart): Response
    {
        return $this->render('home/dashboard.html.twig', [
            'blogs' => $blogRepository->findPaginated(1, 5),
            'chart' => $blogDateChart->getChart(),
        ]);
    }
}
