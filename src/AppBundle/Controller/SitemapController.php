<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SitemapController extends Controller{
    /**
     * @Route("/sitemap.{_format}", name="sitemap", Requirements={"_format" = "xml"})
     */
    public function sitemapAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $urls = array();
        $hostname = $this->get('request')->getHost();
        $scheme = $this->get('request')->getScheme();

        $urls[] = array(
            'loc' => $this->get('router')->generate('homepage'),
            'changefreq' => 'weekly',
            'priority' => '1.0');

        foreach ($em->getRepository('AppBundle:Service')->findBy(array('visible' => 1)) as $service) {
            if ($service->getServiceGroup()->getVisible() == 1) {
                $urls[] = array(
                    'loc' => $this->get('router')->generate('service_show',
                            array(
                                'serviceSlug' => $service->getSlug(),
                                'serviceGroupSlug' => $service->getServiceGroup()->getSlug()
                            )),
                    'lastmod' => $service->getUpdateAt(),
                    'changefreq' => 'weekly',
                    'priority' => '0.7');
            }
        }

        foreach ($em->getRepository('AppBundle:Article')->findBy(array('visible' => 1)) as $article) {
            $urls[] = array(
                'loc' => $this->get('router')->generate('article_show',
                    array(
                        'id' => $article->getId(),
                        'slug' => $article->getSlug()
                    )),
                'lastmod' => $article->getUpdateAt(),
                'changefreq' => 'weekly',
                'priority' => '0.7');
        }

        return $this->render('sitemap/index.xml.twig', array(
            'urls' => $urls,
            'hostname' => $hostname,
            'scheme' => $scheme
            ));
    }
} 