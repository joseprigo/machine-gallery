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
class MachineBitsControllerTest extends WebTestCase
{
    public function testBrands()
    {
        $expectedJson = [
            ["brand" => "technamo"],
            ["brand" => "metallicum"],
            ["brand"=> "senpai"]
        ];
        $expectedJsonString = '[{"brand":"technamo"},{"brand":"metallicum"},{"brand":"senpai"}]';
        $client = static::createClient();
        $crawler = $client->request('GET', '/machine_bits/brands');
        $response = $client->getResponse();

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertJsonStringEqualsJsonString($expectedJsonString, $response->getContent());
    }
    
}
