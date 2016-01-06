<?php
/**
 * Created by PhpStorm.
 * User: itm
 * Date: 11.05.15
 * Time: 18:09
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Vacant;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/вакансии")
 */
class VacantController extends Controller{

    /**
     * @Route("", name="vacant")
     */
    public function indexAction()
    {
        $vacant = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Vacant')
            ->findOneById(1);

        if (empty($vacant)) {
            $vacant = $this->createVacant();
        }

        return $this->render('vacant/index.html.twig', array(
            'vacant' => $vacant
        ));
    }

    protected function createVacant()
    {
        $vacant = new Vacant();
        $vacant->setTitle('Вакансии');
        $vacant->setText('Текст');

        $em = $this->getDoctrine()->getManager();

        $em->persist($vacant);
        $em->flush();

        return $vacant;
    }

} 