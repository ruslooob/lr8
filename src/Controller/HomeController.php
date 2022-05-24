<?php

namespace App\Controller;

use App\Entity\Like;
use App\Entity\User;
use App\Form\LikeType;
use App\Repository\LikeRepository;
use App\Repository\ScreenshotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ScreenshotRepository $repository): Response
    {
        $screenshots = $repository->findAll();

        return $this->render('home/index.html.twig', [
            'screenshots' => $screenshots,
        ]);
    }

    #[Route(path: '/screenshot/{id}', name: 'screenshot_detail', methods: ['GET', 'POST'])]
    public function show(int                    $id,
                         ScreenshotRepository   $screenshotRepository,
                         Security               $security,
                         Request                $request,
                         EntityManagerInterface $entityManager,
    ): Response
    {
        /** @var $user User */
        $user = $security->getUser();

        $screenshot = $screenshotRepository->findOneBy(['id' => $id]);
        if ($screenshot === null) {
            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(LikeType::class);
        $form->handleRequest($request);
        $likes = $screenshot->getLikes();

        if ($form->isSubmitted() && $form->isValid()) {
            $like = new Like();
            $like->setUser($user);
            $like->setScreenshot($screenshot);

            $entityManager->persist($like);
            $entityManager->flush();

            return $this->redirectToRoute('screenshots_detail', [
                'id' => $screenshot->getId(),
                'likes' => $likes
            ]);
        }

        if ($screenshot->getUser() !== $user) {
            $entityManager->persist($screenshot);
            $entityManager->flush();
        }

        return $this->render('home/detail-screenshot.html.twig', [
            'screenshot' => $screenshot,
            'likes' => $likes,
//            'like_form' => $form->createView(),
        ]);
    }
}
