<?php

namespace App\Controller;

use App\Entity\Tier;
use App\Form\TierFormType;
use App\Repository\ProjectRepository;
use App\Repository\TierRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api", name="api_")
 */
class TierController extends AbstractController
{
    /**
     * @var TierRepository
     */
    private TierRepository $tierRepository;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;
    private ProjectRepository $projectRepository;

    public function __construct(EntityManagerInterface $entityManager, TierRepository $tierRepository, ProjectRepository $projectRepository)
    {
        $this->em = $entityManager;
        $this->tierRepository = $tierRepository;
        $this->projectRepository = $projectRepository;;
    }

    /**
     * @Route("/tier/{id}", name="get_tier_by_id", methods={"GET"})
     */
    public function index($id): JsonResponse
    {
        $tier = $this->tierRepository->findBy(['project' => $id]);
        $serialize = SerializerBuilder::create()->build();
        $jsonContent = $serialize->serialize($tier, 'json', SerializationContext::create());

        return new JsonResponse($jsonContent, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/tier/add", name="add_tier", methods={"POST"})
     */
    public function new(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        foreach ($data as $key => $dat) {
            $project = $this->projectRepository->find($dat['project']);
            $tier = new Tier();
            $tier->setProject($project);
            $form = $this->createForm(TierFormType::class, $tier);
            $form->submit($dat);
            $violation = $validator->validate($tier);

            if (count($violation) > 0) {
                foreach ($violation as $error) {
                    return new JsonResponse($error->getMessage(), Response::HTTP_BAD_REQUEST);
                }
            }
            $this->em->persist($tier);
            $this->em->flush();
        }

        return new JsonResponse('Created new tier successfully', Response::HTTP_CREATED);
    }
}
