<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Contacts;
use AppBundle\Entity\MainPage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactsController  extends Controller{

    /**
     * @Route("/contacts", name="contacts")
     */
    public function indexAction()
    {
        $contacts = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Contacts')
            ->findOneById(1);

        if (!$contacts) {
            $this->create();
        }

        return $this->render('contacts/index.html.twig', array('contacts' => $contacts));
    }

    private function create()
    {
        $contacts = new Contacts();
        $contacts->setPhones("Телефоны");
        $contacts->setEmail("Email");
        $contacts->setSkype("Skype");
        $contacts->setMapCode("");
        $contacts->setMapPointHint("");
        $contacts->setMapPointInformation("");
        $contacts->setMapX("");
        $contacts->setMapY("");
        $contacts->setRegistrationData("");
        $contacts->setSkype("");

        $contacts->setUpdateAt(new \DateTime());

        $em = $this->getDoctrine()->getManager();

        $em->persist($contacts);
        $em->flush();

        return $contacts;
    }
}