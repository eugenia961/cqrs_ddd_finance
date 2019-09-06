<?php

namespace App\Backend\Country\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="countries")
 */
class Country {

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
    private $acronyms;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tax;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $currency;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enable;

    /**
     * @ORM\OneToMany(targetEntity="App\Backend\Company\Domain\Entity\Company", mappedBy="contry", orphanRemoval=true)
     */
    private $companies;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $color;

    public function __construct($id, $name, $acronyms, $tax, $currency, $enable, $companies, $color) {

        $this->id = $id;
        $this->name = $name;
        $this->acronyms = $acronyms;
        $this->currency = $currency;
        $this->tax = $tax;
        $this->enable = $enable;
        $this->companies = $companies;
        $this->color = $color;
    }

    public static function created($id, $name, $acronyms, $currency, $color) {

        $country = new static($id, $name, $acronyms, null, $currency, true, new ArrayCollection(), $color);

        return $country;
    }

    public function id() {
        return $this->id;
    }

    public function name() {
        return $this->name;
    }

    public function acronyms() {
        return $this->acronyms;
    }

    public function tax() {
        return $this->tax;
    }

    public function currency() {
        return $this->currency;
    }

    public function enable() {
        return $this->enable;
    }

    /**
     * @return Collection|Company[]
     */
    public function companies(): Collection {
        return $this->companies;
    }

    public function color() {
        return $this->color;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    public function setTax($tax): self {
        $this->tax = $tax;

        return $this;
    }

    public function setCurrency($currency): self {
        $this->currency = $currency;

        return $this;
    }

    public function setEnable(bool $enable): self {
        $this->enable = $enable;

        return $this;
    }

    public function addCompany($company): self {
        if (!$this->companies->contains($company)) {
            $this->companies[] = $company;
            $company->setContry($this);
        }

        return $this;
    }

    public function removeCompany($company): self {
        if ($this->companies->contains($company)) {
            $this->companies->removeElement($company);
// set the owning side to null (unless already changed)
            if ($company->getContry() === $this) {
                $company->setContry(null);
            }
        }

        return $this;
    }

    public function setColor($color): self {
        $this->color = $color;

        return $this;
    }

}
