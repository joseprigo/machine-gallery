<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
/**
 * Description of MachineController
 *
 * @author josep
 * @Route("machine")
 */
class MachineController extends AbstractController
{
    /**
     * @Route("/list", name="machine_list")
     */
    public function List()
    {
        
    }
    
    /**
     * @Route("/show/{id}", name="machine_show")
     */
    public function showSingle(Request $request)
    {
        
    }
    
    /**
     * @Route("/add", name="machine_add")
     */
    public function add(Request $request)
    {
        
    }
    
    /**
     * @Route("/edit/{id}", name="machine_edit")
     */
    public function edit(Request $request)
    {
        
    }
    /**
     * @Route("/delete/{id}", name="machine_delete")
     */
    public function delelte(Request $request)
    {
        
    }
    
}
