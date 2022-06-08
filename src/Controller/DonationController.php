<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_")
 */
class DonationController extends AbstractController
{


    public function __construct(EntityManagerInterface $entityManager, ProjectRepository $projectRepository, UserRepository $userRepository)
    {
        $this->em = $entityManager;
        $this->projectRepository = $projectRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/donation/add", name="app_donation", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $project = $this->projectRepository->find($data['project']);
        $project->setContributors($project->getContributors() + 1);
        $project->setPledge($project->getPledge() + $data['amount']);
        $this->em->persist($project);
        $this->em->flush();

        return new JsonResponse('Donation was received at the project id ' . $project->getId(), Response::HTTP_CREATED);

    }
}
