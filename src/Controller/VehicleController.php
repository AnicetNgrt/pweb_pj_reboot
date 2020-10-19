<?php

namespace App\Controller;

use App\Entity\Vehicle;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\VehicleType;
use Symfony\Component\Routing\Annotation\Route;

class VehicleController extends AbstractController
{

    public $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;   
    }

    /**
     * @Route("/", name="app_home", methods="GET")
     */
    public function index(VehicleRepository $vehicleRepository): Response
    {
        $vehicles = $vehicleRepository->findAll();
        return $this->render('vehicle/index.html.twig', compact('vehicles'));
    }

    /**
     * @Route("/vehicles/{id<[0-9]+>}", name="app_vehicles_show", methods="GET")
     */
    public function show(Vehicle $vehicle): Response
    {  
        $characs = (array) json_decode($vehicle->getCharacsJSON());
        $characsNames = array_keys($characs);
        $characsValues = array_values($characs);
        return $this->render('vehicle/show.html.twig', [
            'vehicle' => $vehicle,
            'characsNames' => $characsNames,
            'characsValues' => $characsValues
        ]);
    }

    /**
     * @Route("/vehicles/{id<[0-9]+>}/edit", name="app_vehicles_edit", methods="GET|PUT")
     */
    public function edit(Vehicle $vehicle, Request $request): Response
    {
        $form = $this->createForm(VehicleType::class, $vehicle, [
            'method' => 'PUT'
        ]);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($vehicle);
            $this->em->flush();

            $this->addFlash('success', 'Vehicle successfully updated!');

            return $this->redirectToRoute('app_home');
        }
        return $this->render('vehicle/edit.html.twig',
        [
            'vehicle' => $vehicle,
            'myForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/vehicles/create", name="app_vehicles_create", methods="GET|POST")
     */
    public function create(Request $request): Response
    {
        $vehicle = new Vehicle;
        $form = $this->createForm(VehicleType::class, $vehicle);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($vehicle);
            $this->em->flush();

            $this->addFlash('success', 'Vehicle successfully added!');

            return $this->redirectToRoute('app_home');
        }

        return $this->render('vehicle/create.html.twig',
        [
            'myForm' => $form->createView()
        ]);
    }

    /**
     * @Route("vehicles/{id<[0-9]+>}/delete", name="app_vehicles_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vehicle $vehicle): Response
    {
        $formToken = $request->request->get('csrf_token');
        if($this->isCsrfTokenValid('vehicles.delete' . $vehicle->getId(), $formToken)) {
            $this->em->remove($vehicle);
            $this->em->flush();
            $this->addFlash('info', 'Vehicle successfully deleted!');
        }  
        return $this->redirectToRoute('app_home');
    }
}
