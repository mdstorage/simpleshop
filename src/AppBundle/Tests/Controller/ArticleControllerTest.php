<?php
namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase {

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request("GET", "/статьи");
        $this->assertTrue($crawler->filter('h1:contains("Статьи")')->count() > 0, "Список статей отображается некорректно");
    }

    public function testShow()
    {
        $client = static::createClient();

        $articles = $client->getContainer()
            ->get('doctrine')->getRepository('AppBundle:Article')
            ->findByVisible(1);

        foreach ($articles as $article) {
            $crawler = $client->request("GET", "/статьи/" . $article->getId() . "/" . $article->getSlug() . ".html");
            $this->assertTrue($crawler->filter('h1:contains("' . $article->getTitle() . '")')->count() > 0, "Статья \"" . $article->getTitle() . "\" отображается некорректно");
        }


    }
}