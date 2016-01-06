<?php
/**
 * Created by PhpStorm.
 * User: itm
 * Date: 15.04.15
 * Time: 16:26
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Utils\Slugify;

/**
 * @ORM\Entity
 * @ORM\Table(name="service")
 */
class Service {

    const SERVICES_PER_PAGE = 5;

    public function __construct() {
        $this->tags = new ArrayCollection();
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
     * @ORM\ManyToOne(targetEntity="ServiceGroup", inversedBy="services")
     * @ORM\JoinColumn(name="service_group_id", referencedColumnName="id")
     */
    private $serviceGroup;

    /**
     * @ORM\Column(type="text")
     */
    private $annotation;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;

//    private $articles;

    /**
     * @ORM\Column(type="datetime")
     */
    private $update_at;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="services")
     * @ORM\JoinTable(name="services_tags")
     **/
    private $tags;

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
     * @return Service
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
     * Set annotation
     *
     * @param string $annotation
     * @return Service
     */
    public function setAnnotation($annotation)
    {
        $this->annotation = $annotation;

        return $this;
    }

    /**
     * Get annotation
     *
     * @return string 
     */
    public function getAnnotation()
    {
        return $this->annotation;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Service
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     * @return Service
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

    public function isVisible()
    {
        return $this->getVisible();
    }

    /**
     * Set update_at
     *
     * @param \DateTime $updateAt
     * @return Service
     */
    public function setUpdateAt($updateAt)
    {
        $this->update_at = $updateAt;

        return $this;
    }

    /**
     * Get update_at
     *
     * @return \DateTime 
     */
    public function getUpdateAt()
    {
        return $this->update_at;
    }

    /**
     * Set serviceGroup
     *
     * @param \AppBundle\Entity\ServiceGroup $serviceGroup
     * @return Service
     */
    public function setServiceGroup(\AppBundle\Entity\ServiceGroup $serviceGroup = null)
    {
        $this->serviceGroup = $serviceGroup;

        return $this;
    }

    /**
     * Get serviceGroup
     *
     * @return \AppBundle\Entity\ServiceGroup 
     */
    public function getServiceGroup()
    {
        return $this->serviceGroup;
    }

    public function __toString()
    {
        if ($this->name) {
            return $this->name;
        } else {
            return 'Услуга';
        }
    }

    /**
     * Add tags
     *
     * @param \AppBundle\Entity\Tag $tags
     * @return Service
     */
    public function addTag(\AppBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \AppBundle\Entity\Tag $tags
     */
    public function removeTag(\AppBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Service
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
