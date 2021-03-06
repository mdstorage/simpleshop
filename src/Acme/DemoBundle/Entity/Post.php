<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Entity
 */
class Post
{
    /**
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     *
     */
    public $user;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     *
     *
     * @Assert\NotBlank(message="Введите заголовок.")
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Название слишком короткое",
     *     maxMessage="The name is too long."
     * )
     */
    public $title;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     */
    public $description;

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
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Post
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
     * Set user
     *
     * @param \Acme\DemoBundle\Entity\User $user
     * @return Post
     */
    public function setUser(\Acme\DemoBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Acme\DemoBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
