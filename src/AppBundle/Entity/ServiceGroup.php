<?php
/**
 * Created by PhpStorm.
 * User: itm
 * Date: 15.04.15
 * Time: 16:20
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Utils\Slugify;

/**
 * @ORM\Entity
 * @ORM\Table(name="service_group")
 */
class ServiceGroup {

    public function __construct()
    {
        $this->services = new ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Service", mappedBy="serviceGroup", orphanRemoval=true)
     * @ORM\OrderBy({"name" = "ASC"})
     */
    private $services;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;

    /**
     * @ORM\Column(type="string")
     */
    private $slug;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ServiceGroup
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     * @return ServiceGroup
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean 
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Add services
     *
     * @param \AppBundle\Entity\Service $services
     * @return ServiceGroup
     */
    public function addService(\AppBundle\Entity\Service $services)
    {
        $services->setServiceGroup($this);
        $this->services[] = $services;

        return $this;
    }

    /**
     * Remove services
     *
     * @param \AppBundle\Entity\Service $services
     */
    public function removeService(\AppBundle\Entity\Service $services)
    {
        $this->services->removeElement($services);
        $services->setServiceGroup(null);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Set services
     *
     * @param Doctrine\Common\Collections\ArrayCollection $services
     */
    public function setServices($services)
    {
        if (!$services) {
            $this->services = new ArrayCollection();
            return;
        }

        foreach ($services as $item) {
            $item->setServiceGroup($this);
        }

        foreach ($this->getServices() as $item) {
            if (!$services->contains($item)) {
                $this->getServices()->removeElement($item);
                $item->setServiceGroup(null);
            }
        }

        $this->services = $services;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return ServiceGroup
     */
    public function setSlug()
    {
        $this->slug = Slugify::slug($this->name);

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
