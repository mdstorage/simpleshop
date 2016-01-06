<?php
/**
 * Created by PhpStorm.
 * User: itm
 * Date: 08.05.15
 * Time: 12:26
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="head")
 */
class Head {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $header;

    /**
     * @ORM\Column(type="text")
     */
    private $contacts;

    /**
     * @ORM\Column(type="text")
     */
    private $keywords;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * Set header
     *
     * @param string $header
     * @return MainPage
     */
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set contacts
     *
     * @param string $contacts
     * @return MainPage
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;

        return $this;
    }

    /**
     * Get contacts
     *
     * @return string
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     * @return MainPage
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return MainPage
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return "Шапка";
    }
}
