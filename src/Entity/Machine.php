<?php

namespace App\Entity;

use App\Repository\MachineRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MachineRepository::class)
 */
class Machine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
     /**
     * @ORM\Column(type="uuid", unique=true)
     * @Assert\NotBlank()
     */
    protected $uuid;

    /**
     * @var string 
     * @ORM\Column(type="string", length=280)
     * @Assert\NotBlank()
     */    
    protected $brand;
    
    /**
     *
     * @var string
     * @ORM\Column(type="string", length=280)
     * @Assert\NotBlank()
     */
    protected $model;
    
    /**
     * @var string 
     * @ORM\Column(type="string", length=280)
     * @Assert\NotBlank()
     */
    protected $manufacturer;
    /**
     *
     * @var float
     * @ORM\Column(type="float")
     * @Assert\NotBlank() 
     */
    protected $price;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="machine") 
     */
    private $images;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }
    
    function getBrand(): string {
        return $this->brand;
    }

    function getModel(): string {
        return $this->model;
    }

    function getManufacturer(): string {
        return $this->manufacturer;
    }

    function getPrice(): float {
        return $this->price;
    }

    function getImages() {
        return $this->images;
    }

    function setBrand(string $brand): void {
        $this->brand = $brand;
    }

    function setModel(string $model): void {
        $this->model = $model;
    }

    function setManufacturer(string $manufacturer): void {
        $this->manufacturer = $manufacturer;
    }

    function setPrice(float $price): void {
        $this->price = $price;
    }
    
    function setUuid($uuid): void {
        $this->uuid = $uuid;
    }




    
    
    
}
