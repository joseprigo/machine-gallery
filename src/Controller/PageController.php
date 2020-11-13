<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of PageController
 *
 * @author josep
 * @Route("/")
 */
class PageController extends AbstractController
{
    /**
     * @Route("/", name="main_page")
     */
    public function index()
    {
        return $this->render('base.html.twig');
    }
}
