<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Service\InventarizationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class InventarizationController
 * @package App\Controller
 * @Route("/inventarization")
 */
class InventarizationController extends AbstractController
{
    /**
     * @param EntityManagerInterface $em
     * @param string $entityAlias
     * @return JsonResponse
     * @Route("/", name="inventarization")
     */
    public function index(TaskRepository $taskRepository, InventarizationService $inventarizationService)
    {
        $inventarizations = [];
        /** @var Task $task */
        foreach ($taskRepository->findAll() as $task) {
            $inventarizations[] = $inventarizationService->createInventarization($task);
        }
        return $this->json($inventarizations);
    }

    /**
     * @param EntityManagerInterface $em
     * @param SerializerInterface $serializer
     * @param Request $request
     * @param string $entityAlias
     * @return JsonResponse
     * @Route("/update", name="inventarization_update")
     */
    public function update(EntityManagerInterface $em, SerializerInterface $serializer, Request $request, string $entityAlias)
    {
        $entity = $serializer->deserialize($request->request, $this->getEntityName($entityAlias), 'json');
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
