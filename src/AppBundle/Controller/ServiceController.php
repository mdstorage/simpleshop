<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Service;
use AppBundle\Entity\ServiceGroup;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/услуги/{serviceGroupSlug}")
 */
class ServiceController extends Controller{

    /**
     * @Route("/{page}", name="service_list", defaults={"page" = 1}, requirements={
     *     "page": "\d+"
     * })
     * @ParamConverter("serviceGroup", class="AppBundle:ServiceGroup", options={"mapping" : {"serviceGroupSlug" = "slug"}})
     */
    public function listAction(ServiceGroup $serviceGroup, $page)
    {
        $allServices = $serviceGroup->getServices()->filter(function($service) {
            return $service->isVisible() == 1;
        });

        //если в группе всего один сервис, то список не выводится, а происходит перенаправление сразу на отображение этого единственного сервиса
        if ($allServices->count() == 1) {
            return $this->redirectToRoute('service_show', array(
                'serviceGroupSlug' => $serviceGroup->getSlug(),
                'serviceSlug' => $allServices->first()->getSlug()));
        }

        $pagination = $this->get('pagination')->setCollection($allServices)->setItemsPerPage(Service::SERVICES_PER_PAGE);
        $pageServices = $pagination->getItems($page);

        $articles = array();
        foreach ($pageServices as $service) {
            foreach ($service->getTags() as $tag) {
                if ($tag) {
                    $articles = array_merge($articles, $tag->getArticles()->filter(function($service) {
                        return $service->isVisible() == 1;
                    })->toArray());
                }
            }
        }

        return $this->render('service/index.html.twig', array(
            'serviceGroup' => $serviceGroup,
            'articles' => array_unique($articles),
            'services' => $pageServices,
            'page' => $page,
            'pagesCount' => $pagination->getPagesCount()
        ));
    }

    /**
     * @Route("/{serviceSlug}.html", name="service_show")
     * @ParamConverter("serviceGroup", class="AppBundle:ServiceGroup", options={"mapping" : {"serviceGroupSlug" = "slug"}})
     * @ParamConverter("service", class="AppBundle:Service", options={"mapping" : {"serviceSlug" = "slug"}})
     */
    public function showAction(ServiceGroup $serviceGroup, Service $service)
    {
        $additional = array();
        $articles = array();
        if ($service->getServiceGroup() == $serviceGroup && $service->isVisible()) {
            //точное совпадение ВСЕХ тэгов
            if ($service->getTags()->toArray()) {
                $articles = $service->getTags()->first()->getArticles()->toArray();
                //ХОТЯ БЫ ОДИН тэг совпадает
                foreach ($service->getTags() as $tag) {
                    //остаются только совпадающие элементы массивов (пересечение массивов)
                    $articles = array_intersect($articles, $tag->getArticles()->filter(function($service) {
                        return $service->isVisible() == 1;
                    })->toArray());
                    //массивы складываются, т.е. "собираются" все статьи, имеющие хотя бы один общий с услугой тэг
                    $additional = array_merge($additional, $tag->getArticles()->filter(function($service) {
                        return $service->isVisible() == 1;
                    })->toArray());
                }
                //убрать те статьи, которые уже есть в точном совпадении
                $additional = array_diff($additional, $articles);
            }

            return $this->render('service/show.html.twig', array(
                'service' => $service,
                'articles' => array_unique($articles),
                'additional' => $additional
            ));
        } else {
            throw $this->createNotFoundException('Такая страница не существует!');
        }
    }
}