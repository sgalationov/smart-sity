<?php

namespace App\Controller;

use App\Entity\Device;
use App\Entity\Unit;
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
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/index", name="line_index")
     */
    public function index()
    {
        return $this->json([
                [

                    "id" => 'water',
                    "isActive" => true,
                    "text" => 'Водяные сети',
                    "color" => 'blue',
                    "lines" => [
                        [
                            "id" => 'water1',
                            "lineIdК" => 'linewater1',
                            "layerId" => 'water',
                            "lat" => 51.54355876453761,
                            "lng" => 46.01014137268067,
                            "info" => [
                                "status" => 'warning',
                                "name" => 'Название элемента',
                                "date" => time(),
                                "stat" => 'Наземный',
                                "type" => 'Наземный',
                                "category" => 'Категория',
                                "bandwidth" => 43434,
                                "forecast" => 'Прогноз',
                                "fotos" => [],
                                "risk" => 3434,
                                "history" => [
                                    [
                                        "date" => time(),
                                        "text" => 'Ввод в эксплуатацию',
                                        "performer" => 'Теплосети'
                                    ]
                                ]
                            ]
                        ],
                        [
                            "id" => 'water2',
                            "lineId" => 'linewater1',
                            "layerId" => 'water',
                            "lat" => 51.529357812115485,
                            "lng" => 46.03966712951661,
                            "info" => [
                                "status" => 'success',
                                "name" => 'Название элемента',
                                "date" => time(),
                                "stat" => 'Наземный',
                                "type" => 'Наземный',
                                "category" => 'Категория',
                                "bandWidth" => 43434,
                                "forecast" => 'Прогноз',
                                "fotos" => [],
                                "risk" => 3434,
                                "history" => [
                                    [
                                        "date" => time(),
                                        "text" => 'Ввод в эксплуатацию',
                                        "performer" => 'Теплосети'
                                    ]
                                ]
                            ]
                        ],
                        [
                            "id" => 'water3',
                            "lineId" => 'linewater1',
                            "layerId" => 'water',
                            "lat" => 51.53373482374044,
                            "lng" => 46.05949401855469,
                            "info" => [
                                "status" => 'danger',
                                "name" => 'Название элемента',
                                "date" => time(),
                                "stat" => 'Наземный',
                                "type" => 'Наземный',
                                "category" => 'Категория',
                                "bandwidth" => 43434,
                                "forecast" => 'Прогноз',
                                "fotos" => [],
                                "risk" => 3434,
                                "history" => [
                                    [
                                        "date" => time(),
                                        "text" => 'Ввод в эксплуатацию',
                                        "performer" => 'Теплосети'
                                    ]
                                ]
                            ]
                        ],
                    ]
                ],
                [
                    "id" => 'gaz',
                    "isActive" => false,
                    "text" => 'Газовые сети',
                    "color" => 'green',
                    "lines" => [],
                ],
                [
                    "id" => 'electricity',
                    "isActive" => false,
                    "text" => 'Электрические сети',
                    "color" => 'yellow',
                    "lines" => [],
                ],
                [
                    "id" => 'warm',
                    "isActive" => false,
                    "text" => 'Тепловые сети',
                    "color" => 'red',
                    "lines" => [],
                ]
            ]
        );
    }

    /**
     * @Route("/create", name="line_create")
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $data = json_decode($request->getContent(), true);
        $unit = new Unit();
        $unit->setName($data['']);
        $unit->setLongitude($data['']);
        $unit->setLatitude($data['']);
        $unit->setBandwidth($data['']);
        $unit->setPowerGeneration($data['']);
        $unit->setPowerConsumption($data['']);
        $unit->setLastCheckAt($data['']);
//        $unit->setLayer();
//        $unit->setParent();
        return $this->json($data);
    }


}
