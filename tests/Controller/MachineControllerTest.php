<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of MachineControllerTest
 *
 * @author josep
 */
class MachineControllerTest extends WebTestCase
{
    public function testShow()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/machine/list');
        
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        //$responseData = json_decode($response->getContent(), true);
    }
    
    public function testShowOne()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/machine/show/3be36048-b3bf-4f32-b274-8050c475f60b');
        
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        //$responseData = json_decode($response->getContent(), true);
    }
    
    public function add()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/machine/add');
        
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        //$responseData = json_decode($response->getContent(), true);
    }
    
    public function edit()
    {
        $client = static::createClient();
        $crawler = $client->request('PUT', '/machine/edit/3be36048-b3bf-4f32-b274-8050c475f60b');
        
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        //$responseData = json_decode($response->getContent(), true);
    }
    
    public function delete()
    {
        $client = static::createClient();
        $crawler = $client->request('DELETE', '/machine/delete/3be36048-b3bf-4f32-b274-8050c475f60b');
        
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        //$responseData = json_decode($response->getContent(), true);
    }
    
}
