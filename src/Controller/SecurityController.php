<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of SecurityController
 *
 * @author josep
 * @Route("/security")
 */
class SecurityController extends AbstractController{
    
    /**
     * @Route("/login", name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $authentication = [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ];
        
                return new Response($authentication, 200, ['Content-Type' => 'application/json']);

    }
    
    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {
        
    }
}
