<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Machine;
//use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * run fixtures:
 * php bin/console doctrine:fixtures:load
 */
class AppFixtures extends Fixture
{
    private const USER = [
        'username' => 'josep_rigo',
        'password' => 'josep123',
        'roles' => [User::ROLE_ADMIN],
        ];

    private const MACHINES = [
        [
            "uuid"         => "3be36048-b3bf-4f32-b274-8050c475f60b",
            "brand"        => "technamo",
            "model"        => "lorem_ipsum_5000",
            "manufacturer" => "machine_and_co",
            "price"        => 1000.00,
        ],
        [
            "uuid"         => "3be36048-b3bf-4f32-b274-8050c475f60c",
            "brand"        => "metallicum",
            "model"        => "xv50_doble_blade",
            "manufacturer" => "ipsolution",
            "price"        => 2000.00,
        ],
        [
            "uuid"         => "3be36048-b3bf-4f32-b274-8050c475f60d",
            "brand"        => "technamo",
            "model"        => "blenderer_plus",
            "manufacturer" => "machine_and_co",
            "price"        => 1500.00,
        ],
        [
            "uuid"         => "3be36048-b3bf-4f32-b274-8050c475f60f",
            "brand"        => "senpai",
            "model"        => "blenderer_2",
            "manufacturer" => "ipsolution",
            "price"        => 1400.00,
        ],
        
        
    ];
    
    private const IMAGES = [
        [
            "uuid" => "072823c0-b042-4ccf-9162-43114d802b76",
            "type" => "thumbnail",
            "url"  => "https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Fully_automated_schiffli_embroidery_machine_by_Saurer.jpg/1024px-Fully_automated_schiffli_embroidery_machine_by_Saurer.jpg",
        ],
        [
            "uuid" => "93ca343f-01bc-4dad-9410-c495ae2c1e59",
            "type" => "lateral_view",
            "url"  => "https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Fully_automated_schiffli_embroidery_machine_by_Saurer.jpg/1024px-Fully_automated_schiffli_embroidery_machine_by_Saurer.jpg",
        ],
        
        [
            "uuid" => "072823c0-b042-4ccf-9162-43114d802b77",
            "type" => "thumbnail",
            "url"  => "https://upload.wikimedia.org/wikipedia/commons/thumb/1/1c/Houtzagerij_Sagi_Tschiertschen_03.jpg/1280px-Houtzagerij_Sagi_Tschiertschen_03.jpg",
        ],
        [
            "uuid" => "93ca343f-01bc-4dad-9410-c495ae2c1e5a",
            "type" => "front_view",
            "url"  => "https://upload.wikimedia.org/wikipedia/commons/thumb/4/49/Woman_sewing_a_face_mask_with_a_Singer_machine_09.jpg/1920px-Woman_sewing_a_face_mask_with_a_Singer_machine_09.jpg",
        ],
        
        [
            "uuid" => "072823c0-b042-4ccf-9162-43114d802b76",
            "type" => "thumbnail",
            "url"  => "https://upload.wikimedia.org/wikipedia/commons/8/8a/Tortilla_machine.jpg",
        ],
        [
            "uuid" => "93ca343f-01bc-4dad-9410-c495ae2c1e59",
            "type" => "front_view",
            "url"  => "https://upload.wikimedia.org/wikipedia/commons/1/1b/Tree_drilling_machine.jpg",
        ],
        
        [
            "uuid" => "072823c0-b042-4ccf-9162-43114d802b76",
            "type" => "thumbnail",
            "url"  => "https://upload.wikimedia.org/wikipedia/commons/d/db/EB1911_Weighing_Machines_-_Inverted_counter_machine.jpg",
        ],
        [
            "uuid" => "93ca343f-01bc-4dad-9410-c495ae2c1e59",
            "type" => "lateral_view",
            "url"  => "https://upload.wikimedia.org/wikipedia/commons/f/f8/Delorean_Time_Machine_Replica.jpg",
        ],
    ];

    /**
     * @var UserPasswordInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        //$this->loadUser($manager);
        $this->loadMachines($manager);
        $this->loadImages($manager);
        
    }
    
    private function loadMachines(ObjectManager $manager)
    {
        foreach(self::MACHINES as $machineData)
        {
            $machine = new Machine();
            $machine->setBrand($machineData['brand']);
            $machine->setManufacturer($machineData['manufacturer']);
            $machine->setModel($machineData['model']);
            $machine->setPrice($machineData['price']);
            $manager->persist($machine);
        }
        $manager->flush();
    }
    
    private function loadImages(ObjectManager $manager)
    {
        foreach(self::IMAGES as $index=>$imageData)
        {
            $image = new Image();
            $image->setType($imageData['type']);
            $image->setUrl($imageData['url']);
            $image->setMachine($this->getReference(self::USERS[intdiv($index,2)]['uuid']));
            $manager->persist($image);
        }
        $manager->flush();
    }
//    private function loadUser(ObjectManager $manager){
//        
//        $userData = self::USER;
//        $user = new User();
//        $user->setUsername($userData['username']);
//
//        $user->setPassword(
//                $this->passwordEncoder->encodePassword(
//                        $user,
//                        $userData['password']
//                        )
//                );
//        $user->setRoles($userData['roles']);
//        $user->setEnabled(true);
//        $this->addReference($userData['username'],
//                $user);
//
//
//        $user->setPreferences($preferences);
//
//        $manager->persist($user);
//        
//        
//        
//
//        
//        $manager->flush();
//    }
}
