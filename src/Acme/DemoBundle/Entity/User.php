<?php
namespace Acme\DemoBundle\Entity;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="fos_user")
     */
    public $posts;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Add posts
     *
     * @param \Acme\DemoBundle\Entity\Post $posts
     * @return User
     */
    public function addPost(\Acme\DemoBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \Acme\DemoBundle\Entity\Post $posts
     */
    public function removePost(\Acme\DemoBundle\Entity\Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
