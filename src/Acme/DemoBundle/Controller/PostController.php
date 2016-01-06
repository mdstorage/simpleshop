<?php
namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;
use Acme\DemoBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Acme\DemoBundle\Form\Type\PostType;

class PostController extends Controller
{
    /**
     * @Route("/post", name="post_index")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $posts = $em->getRepository('AcmeDemoBundle:Post')->findAll();

        return $this->render('post/index.html.twig', array('posts' => $posts));
    }

    /**
     * /**
     * @Route("/post/new", name="post_new")
     */

    public function newAction()
    {

        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $post = new Post();
        // Получаем пользователя и присваиваем новому посту
        $post->user = $this->get('security.context')->getToken()->getUser();
        // Создаем форму, по хорошему следовало бы создать отдельный класс, но можно и так

        $form = $this->createForm(new PostType(), $post);


        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->get('doctrine')->getEntityManager();
                $em->persist($post);
                $em->flush();
                return $this->redirect($this->generateUrl('post_index'));
            }
        }
        return $this->render('post/new.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/poster/1", name="post_delete")
     * @Method("POST")
     */
    public function deleteAction()
    {
        $request = $this->get('request');
        $id = $request->get('filter');
        $em = $this->get('doctrine')->getEntityManager();
        $post = $em->getRepository('AcmeDemoBundle:Post')->findOneById($id);
        $em->remove($post);
        $em->flush();
        return $this->redirect($this->generateUrl('post_index'));
    }
}