<?php

namespace App\Controller;

use App\Entity\Tier;
use App\Form\TierFormType;
use App\Repository\TierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

    public function __construct(EntityManagerInterface $entityManager, TierRepository $tierRepository)
    {
        $this->em = $entityManager;
        $this->tierRepository = $tierRepository;
    }

    /**
     * @Route("/tier/{id}", name="get_tier_by_id", methods={"GET"})
     */
    public function index($id): JsonResponse
    {
        $tier = $this->tierRepository->findBy(['project' => $id]);
        return new JsonResponse($tier, 200);
    }

    /**
     * @Route("/tier/add", name="add_tier", methods={"POST"})
     */
    public function new($id, Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $project = $this->tierRepository->find($id);
        $tier = new Tier();
        $tier->setProject($project);
        $form = $this->createForm(TierFormType::class, $tier);
        $form->submit($data);
        $violation = $validator->validate($tier);

        if (count($violation) > 0) {
            foreach ($violation as $error) {
                return new JsonResponse($error->getMessage(), Response::HTTP_BAD_REQUEST);
            }
        }
        $this->em->persist($tier);
        $this->em->flush();
        return new JsonResponse('Created new project successfully with id ' . $tier->getId(), Response::HTTP_CREATED);
    }
}
