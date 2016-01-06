<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="mainpage")
 */
class MainPage {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="boolean")
     */
    private $news;

    /**
     * @ORM\Column(type="boolean")
     */
    private $articles;

    /**
     * @ORM\Column(type="text")
     */
    private $footer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actions;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vkWidget;


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
     * @return MainPage
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
     * Set content
     *
     * @param string $content
     * @return MainPage
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set news
     *
     * @param boolean $news
     * @return MainPage
     */
    public function setNews($news)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return boolean 
     */
    public function getNews()
    {
        return $this->news;
    }

    public function hasNews()
    {
        return $this->getNews();
    }

    /**
     * Set articles
     *
     * @param boolean $articles
     * @return MainPage
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;

        return $this;
    }

    /**
     * Get articles
     *
     * @return boolean 
     */
    public function getArticles()
    {
        return $this->articles;
    }

    public function hasArticles()
    {
        return $this->getArticles();
    }

    /**
     * Set footer
     *
     * @param string $footer
     * @return MainPage
     */
    public function setFooter($footer)
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * Get footer
     *
     * @return string 
     */
    public function getFooter()
    {
        return $this->footer;
    }

    public function __toString()
    {
        return "Главная страница";
    }

    /**
     * Set actions
     *
     * @param boolean $actions
     * @return MainPage
     */
    public function setActions($actions)
    {
        $this->actions = $actions;

        return $this;
    }

    /**
     * Get actions
     *
     * @return boolean 
     */
    public function getActions()
    {
        return $this->actions;
    }

    public function hasActions()
    {
        return $this->getActions();
    }

    /**
     * Set vkWidget
     *
     * @param boolean $vkWidget
     * @return MainPage
     */
    public function setVkWidget($vkWidget)
    {
        $this->vkWidget = $vkWidget;

        return $this;
    }

    /**
     * Get vkWidget
     *
     * @return boolean 
     */
    public function getVkWidget()
    {
        return $this->vkWidget;
    }

    public function hasVkWidget()
    {
        return $this->getVkWidget();
    }
}
