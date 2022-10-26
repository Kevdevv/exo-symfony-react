<?php

namespace App\Controller;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController extends AbstractController
{

    #[Route('/api/users/{id}', name:'showUser', methods: ['GET'])]
    public function showUser(Request $request, SerializerInterface $serializer, ManagerRegistry $doctrine): JsonResponse
    {
        $usersRepository = $doctrine->getRepository(Users::class);
        $user = $usersRepository->find($request->attributes->get('id'));

        $jsonContent = $serializer->serialize($user, 'json', ['groups' => ['user','possessions']]);
    
        $response = new JsonResponse();

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $response->setContent($jsonContent);
        
        return $response;
    }

    #[Route('/api/users', name:'getUsers', methods: ['GET'])]
    public function getUsers(ManagerRegistry $doctrine)
    {
        $usersRepository = $doctrine->getRepository(Users::class);
        $users = $usersRepository->findAll();

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($users, 'json');
    
        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $response->setContent($jsonContent);
        
        return $response;
    }
    
    #[Route('/api/users', name:'createUser', methods: ['POST'])]
    public function createUser(Request $request, SerializerInterface $serializer, EntityManagerInterface $em): JsonResponse 
    {
        $users = $serializer->deserialize($request->getContent(), Users::class, 'json');
        $em->persist($users);
        $em->flush();

        $jsonContent = $serializer->serialize($users, 'json');
        
        $response = new JsonResponse();

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $response->setContent($jsonContent);
        
        return $response;
   }

   #[Route('/api/users/{id}', name: 'deleteUser', methods: ['DELETE'])]
    public function deleteUser(Users $users, EntityManagerInterface $em): JsonResponse 
    {
        $em->remove($users);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
