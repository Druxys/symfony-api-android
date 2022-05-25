<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/project", name="app_project", methods={"GET"})
     */
    public function index(ProjectRepository $projectRepository): JsonResponse
    {
        $products = $projectRepository->findAll();
        return new JsonResponse($products, Response::HTTP_OK);
    }

    /**
     * @Route("/project", name="project_new", methods={"POST"})
     * @throws ORMException
     */
    public function new(Request $request, EntityManager $entityManager): JsonResponse
    {

        $project = new Project();

        $entityManager->persist($project);
        $entityManager->flush();

        return $this->json('Created new project successfully with id ' . $project->getId());
    }
}
