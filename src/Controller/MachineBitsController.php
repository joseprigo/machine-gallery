<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Repository\MachineRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of MachineBitsController
 *
 * @author josep
 * @Route("/machine_bits")
 */
class MachineBitsController extends AbstractController
{

    /**
     * @var MachineRepository
     */
    private $machineRepository;

    function __construct(MachineRepository $machineRepository) {
        
        $this->machineRepository = $machineRepository;
    }
    
    /**
     * @Route("/brands", name="machine_bits_brands")
     */
    public function brands()
    {
        $brandsList = $this->machineRepository->existingBrands();
        return new Response(json_encode($brandsList),
                200,
                ['Content-Type' => 'application/json']
                );
    }
    /**
     * @Route("/manufacturers", name="machine_bits_Manufacturers")
     */
    public function Manufacturers()
    {
        $manufacturersList = $this->machineRepository->existingManufacturers();
        return new Response(json_encode($manufacturersList),
                200,
                ['Content-Type' => 'application/json']
                );
    }
    /**
     * @Route("/models", name="machine_bits_models")
     */
    public function models()
    {
        $modelsList = $this->machineRepository->existingModels();
        return new Response(json_encode($modelsList),
                200,
                ['Content-Type' => 'application/json']
                );
    }

}
