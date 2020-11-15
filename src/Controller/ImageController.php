<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Machine;
use App\Service\SerializerFactory;

use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of ImageController
 *
 * @author josep
 * @Route("/image")
 */
class ImageController extends AbstractController
{

    /**
     * @var SerializerFactory
     */
    private $serializerFactory;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    function __construct(
            SerializerFactory $serializerFactory,
            EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->serializerFactory = $serializerFactory;
    }
    /**
     * @Route("/add/{uuid}", name="image_add", methods={"POST"})
     */
    public function add(Machine $machine, Request $request)
    {
        $data  = json_decode($request->getContent(), true);
        $image = new Image();
        $form  = $this->createForm(new App\Form\ImageType(), $image);
        $form->submit($data);
        $image->setUuid(Uuid::uuid4());
        $image->setMachine($machine);
        if($form->isValid()){
            $this->entityManager->persist($image);
            $this->entityManager->flush();
            return new Response('added', 200);
        }
        return new Response(['message' => 'Internal error while adding a new Image'], 500, ['Content-Type' => 'application/json']);
    }
    
    /**
     * @Route("/edit/{uuid}", name="image_edit", methods={"PUT"})
     */
    public function edit(Image $image, Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(new App\Form\ImageType(), $image);
        $form->submit($data);
        if($form->isValid()){
            $this->entityManager->persist($image);
            $this->entityManager->flush();
            return new Response('edited', 200);
        }
        return new Response(['message' => 'Internal error while editing an Image'], 500, ['Content-Type' => 'application/json']);
    }
    /**
     * @Route("/delete/{uuid}", name="image_delete", methods={"DELETE"})
     */
    public function delete(Image $image)
    {
        $this->entityManager->remove($image);
        $this->entityManager->flush();
        return new Response('deleted', 200);
    }
}
