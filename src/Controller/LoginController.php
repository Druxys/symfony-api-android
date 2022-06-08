<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    private UserRepository $userRepository;
    private EntityManagerInterface $em;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->em = $entityManager;
    }

    /**
     * @Route("/login", name="app_login", methods={"POST"})
     */
    public function index(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $this->userRepository->findBy(['email' => $data['email'], 'password' => $data['password']]);

        if ($user) {
            return new JsonResponse($user, Response::HTTP_OK);
        } else {
            return new JsonResponse('User was not found', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Route("/user/add", name="add_user", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $this->userRepository->findBy(['email' => $data['email']]);

        if ($user) {
            return new JsonResponse('User already exists', Response::HTTP_NOT_FOUND);
        } else {
            $user = new User();
            $user->setEmail($data['email']);
            $user->setUsername($data['username']);
            $user->setPassword($data['password']);
            $this->em->persist($user);
            $this->em->flush();

            return new JsonResponse('User was created', Response::HTTP_CREATED);
        }
    }
}
