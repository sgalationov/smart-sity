<?php

namespace App\Controller;

use App\Entity\Device;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/line")
 */
class LineController extends AbstractController
{
    /**
     * @Route("/create", name="line_create")
     */
    public function login(Request $request,EntityManagerInterface $em)
    {
        $data = json_decode($request->getContent(), true);
        return $this->json($data);
    }
}
