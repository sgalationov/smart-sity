<?php

namespace App\Controller;

use App\Entity\Device;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/service")
 */
class ServiceController extends AbstractController
{
    /** KernelInterface $appKernel */
    private $appKernel;

    public function __construct(KernelInterface $appKernel)
    {
        $this->appKernel = $appKernel;
    }
    /**
     * @Route("/update", name="service_update")
     */
    public function update(Filesystem $filesystem)
    {
        $folder = $this->appKernel->getProjectDir();
        $logFileName = $folder.'/var/log/updatelog'.microtime(true).'.txt';
        exec('sh '.$folder.'/update.sh >> '.$logFileName);
        return $this->json([
            'message' => (file_get_contents($logFileName)),
        ]);
    }
}
