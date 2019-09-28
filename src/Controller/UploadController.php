<?php

namespace App\Controller;

use App\Entity\Device;
use App\Entity\Image;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/upload2")
 */
class UploadController extends AbstractController
{
    /**
     * @Route("/image", name="upload_image")
     */
    public function upload(Request $request, EntityManagerInterface $em, Filesystem $filesystem, KernelInterface $kernel)
    {
        /** @var UploadedFile $file */
        $fileBag = $request->files;
        $file = $fileBag->get('image');
        $file->getPathname();
        $image = new Image();
        $image->setOriginalName($file->getClientOriginalName());
        $image->setPath(uniqid().$file->getClientOriginalExtension());
        $folder = $kernel->getProjectDir().'/public/upload/image/';
        $filesystem->rename($file->getPathname(), $folder.$image->getPath());
        $em->persist($image);
        $em->flush();
        return $this->json([
            'id' => $image->getId(),
        ]);
    }
}
