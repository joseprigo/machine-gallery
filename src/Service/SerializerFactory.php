<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

use Gamez\Symfony\Component\Serializer\Normalizer\UuidNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Description of Serializer
 *
 * @author josep
 */
class SerializerFactory 
{
    public function getSerializer()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new UuidNormalizer(), new ObjectNormalizer()];
        return new Serializer($normalizers, $encoders);
    }
}
