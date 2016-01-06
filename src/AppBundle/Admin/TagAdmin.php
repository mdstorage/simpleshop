<?php
/**
 * Created by PhpStorm.
 * User: itm
 * Date: 30.04.15
 * Time: 18:01
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
class TagAdmin extends Admin{

    protected function configureRoutes(RouteCollection $collection)
    {
//        $collection->remove('list');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, array('label' => 'Название'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name', null, array('label' => 'Имя'))
            ->add('_action', 'action', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array()
                ),
                'label' => 'Действия'
            ))
        ;
    }

} 