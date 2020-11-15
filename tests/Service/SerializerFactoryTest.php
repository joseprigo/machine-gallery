<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Tests;

use App\Service\SerializerFactory;

use Symfony\Component\Serializer\Serializer;
use PHPUnit\Framework\TestCase;
/**
 * Description of SerializerFactoryTest
 *
 * @author josep
 */
class SerializerFactoryTest extends TestCase
{
    public function testReturnType()
    {
        $serializerFactory = new SerializerFactory();
        $serializer = $serializerFactory->getSerializer();
        
        $this->assertInstanceOf(Serializer::class, $serializer);
    }
    
}
