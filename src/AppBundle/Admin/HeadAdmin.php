<?php
/**
 * Created by PhpStorm.
 * User: itm
 * Date: 08.05.15
 * Time: 12:32
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

class HeadAdmin extends Admin{

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('delete');
    }

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper

            ->tab('Общие')
            ->with('Содержание страницы')
            ->add('header', null, array('label' => 'Шапка', 'required' => false, 'attr'=>array('class' => 'tinymce')))
            ->add('contacts', null, array('label' => 'Контакты', 'attr'=>array('class' => 'tinymce')))
            ->end()
            ->end()
            ->tab('SEO')
            ->with('Параметры для продвижения')
            ->add('keywords', null, array('label' => 'Ключевые слова', 'required' => false))
            ->add('description', null, array('label' => 'Описание страницы', 'required' => false))
            ->end()
            ->end()
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('header', null, array('label' => 'Шапка'))
            ->add('_action', 'action', array(
                'actions' => array(
                    'edit' => array()
                ),
                'label' => 'Действия'
            ))
        ;
    }
} 