<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
     /**
     * @ORM\Column(type="uuid", unique=true)
     */
    protected $uuid;
    
    /**
     * @var string 
     * @ORM\Column(type="string", length=280)
     * @Assert\NotBlank()
     */
    protected $type;
    
    /**
     * @var string 
     * @ORM\Column(type="string", length=280)
     * @Assert\NotBlank()
     */
    protected $url;
    
    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Machine", inversedBy="images")
    * @ORM\JoinColumn(nullable=false) 
    */
    private $machine;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }
    
    function getType(): string {
        return $this->type;
    }

    function getUrl(): string {
        return $this->url;
    }

    function getMachine() {
        return $this->machine;
    }

    function setType(string $type): void {
        $this->type = $type;
    }

    function setUrl(string $url): void {
        $this->url = $url;
    }

    function setMachine($machine): void {
        $this->machine = $machine;
    }


    
    
}
