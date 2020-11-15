<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Entity\Machine;
use App\Repository\MachineRepository;
use App\Service\SerializerFactory;

use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of MachineController
 *
 * @author josep
 * @Route("machine")
 */
class MachineController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var SerializerFactory
     */
    private $serializerFactory;

    /**
     * @var MachineRepository
     */
    private $machineRepository;

    function __construct(
            MachineRepository $machineRepository,
            SerializerFactory $serializerFactory,
            EntityManagerInterface $entityManager)
    {
        $this->machineRepository = $machineRepository;
        $this->serializerFactory = $serializerFactory;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/list", name="machine_list")
     */
    public function List()
    {
        $machines    = $this->machineRepository->findAll();
        $serializer  = $this->serializerFactory->getSerializer();
        
        $jsonContent = $serializer->serialize($machines, 'json', [
            'circular_reference_handler' => function ($object) {
            return $object->getId();
            
            }
        ]);
        return new Response($jsonContent, 200, ['Content-Type' => 'application/json']);
    }
    
    /**
     * @Route("/show/{uuid}", name="machine_show")
     */
    public function showSingle(Machine $machine)
    {
        $serializer  = $this->serializerFactory->getSerializer();
        $jsonContent = $serializer->serialize($machine, 'json', [
            'circular_reference_handler' => function ($object) {
            return $object->getId();
            
            }
        ]);
        return new Response($jsonContent, 200, ['Content-Type' => 'application/json']);
    }
    
    /**
     * @Route("/add", name="machine_add", methods={"POST"})
     */
    public function add(Request $request)
    {
        $data    = json_decode($request->getContent(), true);
        $machine = new Machine();
        $form    = $this->createForm(new App\Form\MachineType(), $machine);
        $form->submit($data);
        $machine->setUuid(Uuid::uuid4());
        if($form->isValid()){
            $this->entityManager->persist($machine);
            $this->entityManager->flush();
            return new Response('added', 200);
        }
        return new Response(['message' => 'Internal error while adding a new machine'], 500, ['Content-Type' => 'application/json']);
    }
    
    /**
     * @Route("/edit/{uuid}", name="machine_edit", methods={"PUT"})
     */
    public function edit(Machine $machine, Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(new App\Form\MachineType(), $machine);
        $form->submit($data);
        if($form->isValid()){
            $this->entityManager->persist($machine);
            $this->entityManager->flush();
            return new Response('edited', 200);
        }
        return new Response(['message' => 'Internal error while editing a machine'], 500, ['Content-Type' => 'application/json']);
    }
    /**
     * @Route("/delete/{uuid}", name="machine_delete", methods={"DELETE"})
     */
    public function delete(Machine $machine)
    {
        $this->entityManager->remove($machine);
        $this->entityManager->flush();
        return new Response('deleted', 200);
    }
    
}
