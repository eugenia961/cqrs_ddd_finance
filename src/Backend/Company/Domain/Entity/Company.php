<?php

namespace App\Backend\Company\Domain\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="companies")
 */
class Company {

    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="string")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $ticker;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $market;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enable;

    /**
     * @ORM\ManyToOne(targetEntity="App\Backend\Country\Domain\Entity\Country", inversedBy="companies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

 
    
    
    public function __construct($id,$name,$ticker,$market,$enable,$country) {
        
        $this->id=$id;
        $this->name=$name;
        $this->ticker=$ticker;
        $this->market=$market;
        $this->enable=$enable;
        $this->country=$country;
    }
    
    public static function created($id,$name,$ticker,$market,$country){
        
        $company=new static ($id,$name,$ticker,$market,true,$country);
        
        return $company;
    }

    public function id() {
        return $this->id;
    }

    public function name() {
        return $this->name;
    }

    public function ticker() {
        return $this->ticker;
    }

    public function market() {
        return $this->market;
    }

    public function enable() {
        return $this->enable;
    }

    public function country() {
        return $this->country;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

  
    public function setMarket($market): self {
        $this->market = $market;

        return $this;
    }
    
    
     public function setTicker($ticker): self {
        $this->ticker = $ticker;

        return $this;
    }

    public function setEnable(bool $enable): self {
        $this->enable = $enable;

        return $this;
    }

    public function setCountry(Country $contry): self {
        $this->contry = $country;

        return $this;
    }



}
