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

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="layer")
     */
    public function login
    (
        Request $request,
        EntityManagerInterface $em,
        UserPasswordEncoderInterface $passwordEncoder,
        SerializerInterface $serializer
    ) {
        $data = json_decode($request->getContent(), true);
        /** @var User $user */
        $user = $em->getRepository(User::class)->findOneBy(['login'=> $data['login']]);
        if ($passwordEncoder->isPasswordValid($user, $data['password'])) {
            $device = new Device();
            $device->setUser($user);
            $em->persist($device);
            $em->flush();
            return $this->json($device);
        }
        return $this->json([
            'message' => 'invalid login or password',
        ], 403);
    }
}
