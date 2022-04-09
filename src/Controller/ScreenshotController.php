<?php

namespace App\Controller;

use App\Repository\ScreenshotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScreenshotController extends AbstractController
{
    #[Route('/screenshot', name: 'app_screenshot')]
    public function index(ScreenshotRepository $repository): Response
    {
        $screenshots = $repository->findAll();

        return $this->render('screenshot/index.html.twig', [
            'screenshots' => $screenshots,
        ]);
    }
}
