<?php
namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ServiceControllerTest extends WebTestCase
{

    public function testList()
    {
        $client = static::createClient();

        $serviceGroups = static::$kernel->getContainer()->get('doctrine')
            ->getRepository('AppBundle:ServiceGroup')
            ->findBy(array("visible" => 1));

        foreach ($serviceGroups as $serviceGroup) {
            // если в группе всего одно услуга
            if ($serviceGroup->getServices()->count() == 1) {
                // выбираем эту услугу
                $service = $serviceGroup->getServices()->first();
                // говорим клиенту идти по редиректу
                $client->followRedirects(true);
                // забираем страницу через редирект (это будет не список услуг, а из-за редиректа - единственная услуга)
                $crawler = $client->request('GET', '/услуги/' . $serviceGroup->getSlug());
                // если в заголовке отсутствует название этой услуги, делаем вывод, что редирект проходит некорректно
                $this->assertTrue($crawler->filter('h1:contains("' . $service->getName() . '")')->count() > 0, "В группе \"" . $serviceGroup->getName() . "\" одна услуга и редирект проходит некорректно");
            } else {
            $crawler = $client->request('GET', '/услуги/' . $serviceGroup->getSlug());
            $this->assertTrue($crawler->filter('h1:contains("' . $serviceGroup->getName() . '")')->count() > 0, "Группа \"" . $serviceGroup->getName() . "\" отображается некорректно");
            }

            $articles = $client->getContainer()->get('doctrine')
                ->getRepository('AppBundle:Article')
                ->findBy(array("visible" => 0));

            foreach ($articles as $article) {
                $this->assertFalse($crawler->filter('html:contains("' . $article->getTitle() . '")')->count() > 0, "Статья \"" . $article->getTitle() . "\" является невидимой, но все равно отображается на странице списка услуг");
            }
        }
    }

    public function testShow()
    {
        $client = static::createClient();
        $serviceGroups = static::$kernel->getContainer()->get('doctrine')
            ->getRepository('AppBundle:ServiceGroup')
            ->findBy(array("visible" => 1));

        foreach ($serviceGroups as $serviceGroup) {
            $servicesVisible = static::$kernel->getContainer()->get('doctrine')
                ->getRepository('AppBundle:Service')
                ->findBy(array(
                    "visible" => 1,
                    "serviceGroup" => $serviceGroup->getId()
                ));

            $servicesHidden = $client->getContainer()->get('doctrine')
                ->getRepository('AppBundle:Service')
                ->findBy(array(
                    "visible" => 0,
                    "serviceGroup" => $serviceGroup->getId()
                ));

            foreach ($servicesHidden as $service) {
                $crawler = $client->request('GET', '/услуги/' . $serviceGroup->getSlug() . '/' . $service->getSlug() . ".html");
                $this->assertFalse($crawler->filter('h1:contains("' . $service->getName() . '")')->count() > 0, "Сервис \"" . $service->getName() . "\" является невидимым, но все равно отображается");
            }

            foreach ($servicesVisible as $service) {
                $crawler = $client->request('GET', '/услуги/' . $serviceGroup->getSlug() . '/' . $service->getSlug() . ".html");
                $this->assertTrue($crawler->filter('h1:contains("' . $service->getName() . '")')->count() > 0, "Сервис \"" . $service->getName() . "\" отображается некорректно");

                $articles = $client->getContainer()->get('doctrine')
                    ->getRepository('AppBundle:Article')
                    ->findBy(array("visible" => 0));

                foreach ($articles as $article) {
                    $this->assertFalse($crawler->filter('html:contains("' . $article->getTitle() . '")')->count() > 0, "Статья \"" . $article->getTitle() . "\" является невидимой, но все равно отображается на странице услуги \"" . $service->getName() . "\"");
                }
            }
        }
    }
}