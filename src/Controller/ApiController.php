<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{
    /**
     * @param EntityManagerInterface $em
     * @param string $entityAlias
     * @return JsonResponse
     * @Route("/api/{entityAlias}", name="api")
     */
    public function index(EntityManagerInterface $em, string $entityAlias)
    {
        $entities = $em->getRepository($this->getEntityName($entityAlias))->findAll();
        return $this->json($entities);
    }

    /**
     * @param EntityManagerInterface $em
     * @param string $entityAlias
     * @param int $id
     * @return JsonResponse
     * @Route("/api/show/{entityAlias}/{id}", name="api_show")
     */
    public function show(EntityManagerInterface $em, string $entityAlias, int $id)
    {
        $entity = $em->getRepository($this->getEntityName($entityAlias))->find($id);
        return $this->json($entity);
    }

    /**
     * @param EntityManagerInterface $em
     * @param SerializerInterface $serializer
     * @param Request $request
     * @param string $entityAlias
     * @return JsonResponse
     * @Route("/api/create/{entityAlias}", name="api_create")
     */
    public function create(EntityManagerInterface $em, SerializerInterface $serializer, Request $request, string $entityAlias)
    {
        $entity = $serializer->deserialize($request->getContent(), $this->getEntityName($entityAlias), 'json');
        $em->persist($entity);
        $em->flush();
        return $this->json($entity);
    }

    /**
     * @param EntityManagerInterface $em
     * @param SerializerInterface $serializer
     * @param Request $request
     * @param string $entityAlias
     * @return JsonResponse
     * @Route("/api/update/{entityAlias}", name="api_update")
     */
    public function update(EntityManagerInterface $em, SerializerInterface $serializer, Request $request, string $entityAlias)
    {
        $entity = $serializer->deserialize($request->getContent(), $this->getEntityName($entityAlias), 'json');
        $em->flush();
        return $this->json($entity);
    }

    /**
     * @param string $entityAlias
     * @return string
     */
    protected function getEntityName(string $entityAlias): string
    {
        return "App\\Entity\\" . ucfirst($entityAlias);
    }
}
