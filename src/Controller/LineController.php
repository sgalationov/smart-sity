<?php

namespace App\Controller;

use App\Entity\Device;
use App\Entity\Layer;
use App\Entity\Unit;
use App\Entity\User;
use App\Repository\LayerRepository;
use App\Repository\UnitRepository;
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
    public function index(LayerRepository $layerRepository, UnitRepository $unitRepository)
    {
        $layers = $layerRepository->getLayers();
        $arrayUnits = [];
        $units = $unitRepository->findAll();
        foreach ($units as $unit) {
            $arrayUnits[$unit->getLayer()->getExternalId()][$unit->getLineId()] = [
                "id" => $unit->getExternalId(),
                "lineIdК" => $unit->getLineId(),
                "layerId" => $unit->getLayer()->getExternalId(),
                "lat" => $unit->getLatitude(),
                "lng" => $unit->getLongitude(),
                "info" => [
                    "status" => 'warning',
                    "name" => $unit->getName(),
                    "date" => $unit->getLastCheckAt(),
                    "stat" => 'Наземный',
                    "type" => 'Наземный',
                    "category" => 'Категория',
                    "bandwidth" => $unit->getBandwidth(),
                    "forecast" => 'Прогноз',
                    "fotos" => [],
                    "risk" => $unit->getUnitCondition(),
                    "history" => [
                        [
                            "date" => time(),
                            "text" => 'Ввод в эксплуатацию',
                            "performer" => 'Теплосети'
                        ]
                    ]
                ]
            ];
        }
        $data = [
            [
                "id" => 'water',
                "isActive" => true,
                "text" => 'Водяные сети',
                "color" => 'blue',
                "lines" => [],
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
        ];
        foreach ($data as &$arrlayer) {
            if (key_exists($arrlayer['id'], $arrayUnits)) {
                foreach ($arrayUnits[$arrlayer['id']] as $lineExtId => $arrayUnit) {
                    $arrlayer["lines"][$lineExtId][] = $arrayUnit;
                }
            }
        }
        return $this->json([
                [
                    "id" => 'water',
                    "isActive" => true,
                    "text" => 'Водяные сети',
                    "color" => 'blue',
                    "lines" => [
                        'linewater1' => [
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
     * @Route("/short-index", name="short_line_index")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function shortIndex()
    {
        return $this->json([
            [
                "id" => 'water',
                "isActive" => true,
                "text" => 'Водяные сети',
                "color" => 'blue',
                "lines" => [
                    [
                        "start" => [51.55610190273931, 46.0182094573974],
                        "end" => [51.54532088274009, 46.0283374786377],
                        "budget" => 20,
                        "lifetime" => 56,
                        "social" => 54,
                        "objects" => 34,
                        "period" => 12,
                        "cat" => 'Водоснабжение',
                        "long" => '20 км',
                        "nodes" => 324,
                        "width" => '46666',
                        "cost" => '1234543 руб'
                    ],
                    [
                        "start" => [51.54532088274009, 46.0283374786377],
                        "end" => [51.53838125126607, 46.02438926696777],
                        "budget" => 10,
                        "lifetime" => 21,
                        "social" => 23,
                        "objects" => 64,
                        "period" => 56,
                        "cat" => 'Водоснабжение',
                        "long" => '10 км',
                        "nodes" => '324',
                        "width" => '46666',
                        "cost" => '1234543 руб'
                    ],
                    [
                        "start" => [51.53838125126607, 46.02438926696777],
                        "end" => [51.53453730768712, 46.03211402893067],
                        "budget" => 67,
                        "lifetime" => 43,
                        "social" => 89,
                        "objects" => 12,
                        "period" => 78,
                        "cat" => 'Водоснабжение',
                        "long" => '10 км',
                        "nodes" => '324',
                        "width" => '46666',
                        "cost" => '1234543 руб'
                    ],
                    [
                        "start" => [51.53453730768712, 46.03211402893067],
                        "end" => [51.52775622697431, 46.02773666381836],
                        "budget" => 89,
                        "lifetime" => 34,
                        "social" => 78,
                        "objects" => 29,
                        "period" => 46,
                        "cat" => 'Водоснабжение',
                        "long" => '10 км',
                        "nodes" => '324',
                        "width" => '46666',
                        "cost" => '1234543 руб'
                    ],
                    [
                        "start" => [51.52775622697431, 46.02773666381836],
                        "end" => [51.52925135518991, 46.0191535949707],
                        "budget" => 60,
                        "lifetime" => 46,
                        "social" => 45,
                        "objects" => 67,
                        "period" => 24,
                        "cat" => 'Водоснабжение',
                        "long" => '70 км',
                        "nodes" => '324',
                        "width" => '46666',
                        "cost" => '1234543 руб'
                    ],
                    [
                        "start" => [51.52925135518991, 46.0191535949707],
                        "end" => [51.52380458033574, 46.015548706054695],
                        "budget" => 48,
                        "lifetime" => 12,
                        "social" => 67,
                        "objects" => 23,
                        "period" => 79,
                        "cat" => 'Водоснабжение',
                        "long" => '70 км',
                        "nodes" => '324',
                        "width" => '46666',
                        "cost" => '1234543 руб'
                    ],
                    [
                        "start" => [51.52380458033574, 46.015548706054695],
                        "end" => [51.518410563197584, 46.01511955261231],
                        "budget" => 67,
                        "lifetime" => 56,
                        "social" => 84,
                        "objects" => 84,
                        "period" => 10,
                        "cat" => 'Водоснабжение',
                        "long" => '50 км',
                        "nodes" => '324',
                        "width" => '46666',
                        "cost" => '1234543 руб'
                    ],
                ]
            ],

            [
                "id" => 'gaz',
                "isActive" => false,
                "text" => 'Газовые сети',
                "color" => 'green',
                "lines" => []
            ],

            [
                "id" => 'electricity',
                "isActive" => false,
                "text" => 'Электрические сети',
                "color" => 'yellow',
                "lines" => []
            ],

            [
                "id" => 'warm',
                "isActive" => false,
                "text" => 'Тепловые сети',
                "color" => 'red',
                "lines" => []
            ]
        ]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("/create", name="line_create")
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $data = json_decode($request->getContent(), true);
        $layers = $em->getRepository(Layer::class)->getLayers();
        foreach ($data as $idLine => $datum) {
            $oldUnits = $em->getRepository(Unit::class)->getOldUnits($idLine);
            $parent = false;
            foreach ($datum as $eUnit) {
                if (!key_exists($eUnit['id'], $oldUnits)) {
                    $unit = new Unit();
                    $unit->setExternalId($eUnit['id']);
                    $unit->setName($eUnit['info']['name']);
                    $unit->setLongitude($eUnit['lng']);
                    $unit->setLatitude($eUnit['lat']);
                    $unit->setLineId($eUnit['lineId']);
                    $unit->setBandwidth($eUnit['info']['bandwidth']);
                    $date = new \DateTime();
                    $date->setTimestamp($eUnit['info']['date']);
                    $unit->setLastCheckAt($date);
                    $date1 = new \DateTime();
                    $date1->setTimestamp($eUnit['info']['history'][0]['date']);
                    $unit->setLastCheckAt($date1);
                    $unit->setLayer($layers[$eUnit['layerId']]);
                } else {
                    $unit = $oldUnits[$eUnit['id']];
                }
                if ($parent) {
                    $unit->setParent($parent);
                }
                $parent = $unit;
                $em->persist($unit);
            }
        }
        $em->flush();
        return $this->json($data);
    }
}
