<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Warehouse;
use App\Form\WarehouseType;
use App\Repository\WarehouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/warehouse")
 */
class WarehouseController extends AbstractController
{
    /**
     * @Route("/", name="warehouse_index", methods={"GET"})
     */
    public function index(WarehouseRepository $warehouseRepository): Response
    {
        return $this->render('warehouse/index.html.twig', [
            'warehouses' => $warehouseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="warehouse_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $warehouse = new Warehouse();
        $form = $this->createForm(WarehouseType::class, $warehouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($warehouse);
            $entityManager->flush();

            return $this->redirectToRoute('warehouse_index');
        }

        return $this->render('warehouse/new.html.twig', [
            'warehouse' => $warehouse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="warehouse_show", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function show(Warehouse $warehouse): Response
    {
        return $this->render('warehouse/show.html.twig', [
            'warehouse' => $warehouse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="warehouse_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Warehouse $warehouse): Response
    {
        $form = $this->createForm(WarehouseType::class, $warehouse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('warehouse_index');
        }

        return $this->render('warehouse/edit.html.twig', [
            'warehouse' => $warehouse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="warehouse_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Warehouse $warehouse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$warehouse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($warehouse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('warehouse_index');
    }

    /**
     * @Route("/{id}/deactivate", name="warehouse_deactivate", methods={"POST"})
     */
    public function deactivate(Warehouse $warehouse): JsonResponse
    {
        $warehouse->setActive(false);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($warehouse);
        $entityManager->flush();

        $this->addFlash('success', "Склад {$warehouse->getCode()} деактивирован.");

        return new JsonResponse(['message' => 'Success'], 200);
    }

    /**
     * @Route("/list-json", name="warehouse_list_json", methods={"GET"})
     */
    public function list(): Response
    {
        $data = $this->getDoctrine()
            ->getRepository(Warehouse::class)
            ->findAll();

        return $this->json($data);
    }
}
