<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Machine;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * run fixtures:
 * php bin/console doctrine:fixtures:load
 */
class AppFixtures extends Fixture
{
    private const USER = [
        'username' => 'josep_rigo',
        'fullname' => 'Josep Rigo',
        'email'    => 'josep@rigo.com',
        'password' => 'josep123',
        'roles' => [User::ROLE_USER],
        ];

    private const MACHINES = [
        [
            "uuid"         => "9203f90c-ade6-4351-afad-1dc8f6bce862",
            "brand"        => "technamo",
            "model"        => "lorem_ipsum_5000",
            "manufacturer" => "machine_and_co",
            "price"        => 1000.00,
        ],
        [
            "uuid"         => "9203f928-9b7b-42c9-8540-684e012c8b3d",
            "brand"        => "metallicum",
            "model"        => "xv50_doble_blade",
            "manufacturer" => "ipsolution",
            "price"        => 2000.00,
        ],
        [
            "uuid"         => "9203f934-c472-4370-ba9d-d4ba6c7533ed",
            "brand"        => "technamo",
            "model"        => "blenderer_plus",
            "manufacturer" => "machine_and_co",
            "price"        => 1500.00,
        ],
        [
            "uuid"         => "9203f943-27e7-415b-a526-f4b15d43ae6c",
            "brand"        => "senpai",
            "model"        => "blenderer_2",
            "manufacturer" => "ipsolution",
            "price"        => 1400.00,
        ],
        
        
    ];
    
    private const IMAGES = [
        [
            "uuid" => "9203f952-970a-42f6-a513-eaeba192ceac",
            "type" => "thumbnail",
            "url"  => "https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Fully_automated_schiffli_embroidery_machine_by_Saurer.jpg/1024px-Fully_automated_schiffli_embroidery_machine_by_Saurer.jpg",
        ],
        [
            "uuid" => "9203f965-e941-43c2-9f53-bb5212d4e177",
            "type" => "lateral_view",
            "url"  => "https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Fully_automated_schiffli_embroidery_machine_by_Saurer.jpg/1024px-Fully_automated_schiffli_embroidery_machine_by_Saurer.jpg",
        ],
        
        [
            "uuid" => "9203f975-6fd5-4228-8452-3c5f1e8a4581",
            "type" => "thumbnail",
            "url"  => "https://upload.wikimedia.org/wikipedia/commons/thumb/1/1c/Houtzagerij_Sagi_Tschiertschen_03.jpg/1280px-Houtzagerij_Sagi_Tschiertschen_03.jpg",
        ],
        [
            "uuid" => "9203f97f-8988-4280-b28c-7ab1d587e065",
            "type" => "front_view",
            "url"  => "https://upload.wikimedia.org/wikipedia/commons/thumb/4/49/Woman_sewing_a_face_mask_with_a_Singer_machine_09.jpg/1920px-Woman_sewing_a_face_mask_with_a_Singer_machine_09.jpg",
        ],
        
        [
            "uuid" => "9203f98b-2739-420e-ba0d-c397c7382f37",
            "type" => "thumbnail",
            "url"  => "https://upload.wikimedia.org/wikipedia/commons/8/8a/Tortilla_machine.jpg",
        ],
        [
            "uuid" => "93ca343f-01bc-4dad-9410-c495ae2c1e5b",
            "type" => "front_view",
            "url"  => "https://upload.wikimedia.org/wikipedia/commons/1/1b/Tree_drilling_machine.jpg",
        ],
        
        [
            "uuid" => "9203f998-6058-4885-aff7-3d2851bc867a",
            "type" => "thumbnail",
            "url"  => "https://upload.wikimedia.org/wikipedia/commons/d/db/EB1911_Weighing_Machines_-_Inverted_counter_machine.jpg",
        ],
        [
            "uuid" => "9203f9a2-b57e-452b-b465-7fbe04431c85",
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
        $this->loadUser($manager);
        $this->loadMachines($manager);
        $this->loadImages($manager);
        
    }
    
    private function loadMachines(ObjectManager $manager)
    {
        foreach(self::MACHINES as $machineData)
        {
            $machine = new Machine();
            $machine->setUuid($machineData['uuid']);
            $machine->setBrand($machineData['brand']);
            $machine->setManufacturer($machineData['manufacturer']);
            $machine->setModel($machineData['model']);
            $machine->setPrice($machineData['price']);
            
            $this->addReference($machineData['uuid'],
                    $machine);
            
            $manager->persist($machine);
        }
        $manager->flush();
    }
    
    private function loadImages(ObjectManager $manager)
    {
        foreach(self::IMAGES as $index=>$imageData)
        {
            $image = new Image();
            $image->setUuid($imageData['uuid']);
            $image->setType($imageData['type']);
            $image->setUrl($imageData['url']);
            $image->setMachine($this->getReference(self::MACHINES[intdiv($index,2)]['uuid']));
            $manager->persist($image);
        }
        $manager->flush();
    }
    private function loadUser(ObjectManager $manager){
        
        $userData = self::USER;
        $user = new User();
        $user->setUsername($userData['username']);
        $user->setEmail($userData['email']);
        $user->setFullName($userData['fullname']);
        $user->setPassword(
                $this->passwordEncoder->encodePassword(
                        $user,
                        $userData['password']
                        )
                );
        $user->setRoles($userData['roles']);

        $manager->persist($user);
        
        
        

        
        $manager->flush();
    }
}
