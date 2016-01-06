<?php
/**
 * Created by PhpStorm.
 * User: misha
 * Date: 30.04.15
 * Time: 21:26
 */

namespace AppBundle\Admin;

use Knp\Menu\ItemInterface;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class ArticleAdmin extends Admin{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', null, array('label' => 'Название'))
            ->add('annotation', 'textarea', array('label' => 'Аннотация', 'attr'=>array('class' => 'tinymce')))
            ->add('tags', 'sonata_type_model', array('label' => 'Тэги', 'class' => 'AppBundle\Entity\Tag', 'multiple' => true))
            ->add('visible', null, array('label' => 'Отображать', 'required' => false))
            ->add('text', 'textarea', array('label' => 'Развернутое описание', 'attr'=>array('class' => 'tinymce')))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('title', null, array('label' => 'Название'))
            ->add('visible', null, array('label' => 'Отображать', 'editable' => true))
            ->add('update_at', null, array('label' => 'Дата обновления'))
            ->add('_action', 'action', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array()
                ),
                'label' => 'Действия'
            ))
        ;
    }

    public function prePersist($article)
    {
        $article->setUpdateAt(new \DateTime());
        $article->setSlug();
    }

    public function preUpdate($article)
    {
        $article->setUpdateAt(new \DateTime());
        $article->setSlug();
    }
}