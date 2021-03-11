<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Warehouse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WarehouseController extends AbstractController
{
    /**
     * @Route("/warehouse", name="warehouse")
     */
    public function index(): Response
    {
        return $this->render('warehouse/index.html.twig', [
            'controller_name' => 'WarehouseController',
        ]);
    }

    /**
     * @Route("/warehouse/doctrine", name="warehouse")
     */
    public function doctrine(): Response
    {
        $data = $this->getDoctrine()
            ->getRepository(Warehouse::class)
            ->findAll();

        return $this->json($data);
    }
}
