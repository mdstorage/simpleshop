<?php

namespace PeriscopeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/periscope", name="periscope_default_index")
     */
    public function indexAction()
    {
        $xmlResult = simplexml_load_file(__DIR__ . '/../phpunit_result.xml');
//        echo '<pre>';
//        print_r($xmlResult->xpath('//testcase/failure'));
//        echo '</pre><br/>';

        return $this->render('PeriscopeBundle:Default:index.html.twig', array('periscope' => $xmlResult));
    }

    /**
     * @Route("/periscope/tests", name="periscope_default_tests")
     */
    public function testsAction()
    {
        $xmlResult = simplexml_load_file(__DIR__ . '/../phpunit_result.xml');

        return $this->render('PeriscopeBundle:Default:tests.html.twig', array('periscope' => $xmlResult));
    }
}
