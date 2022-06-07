<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectFormType;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api", name="api_")
 */
class ProjectController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @var ProjectRepository
     */
    private ProjectRepository $projectRepository;

    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    public function __construct(EntityManagerInterface $entityManager, ProjectRepository $projectRepository, UserRepository $userRepository)
    {
        $this->em = $entityManager;
        $this->projectRepository = $projectRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/project", name="get_project", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $projects = $this->projectRepository->findAll();
        $serialize = SerializerBuilder::create()->build();
        $jsonContent = $serialize->serialize($projects, 'json', SerializationContext::create());

        return new JsonResponse($jsonContent, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/project", name="project_new", methods={"POST"})
     *
     * @param Request $request
     * @param ValidatorInterface $validator
     *
     * @return JsonResponse
     */
    public function new(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $this->userRepository->find($data['user']);
        $project = (new Project())
            ->setContributors(0)
            ->setPledge(0)
            ->setUser($user)
            ->setLimitDate(new \DateTime('now'))
        ;

        $form = $this->createForm(ProjectFormType::class, $project);
        $form->submit($data);

        $violation = $validator->validate($project);

        if (count($violation) > 0) {
            foreach ($violation as $error) {
                return new JsonResponse($error->getMessage(), Response::HTTP_BAD_REQUEST);
            }
        }

        $this->em->persist($project);
        $this->em->flush();

        return new JsonResponse('Created new project successfully with id ' . $project->getId(), Response::HTTP_CREATED);
    }
}
