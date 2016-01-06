<?php

namespace AppBundle\Admin;

use Knp\Menu\ItemInterface;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
class ServiceGroupAdmin extends Admin{

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Настройки группы')
                ->with(null)
                    ->add('name', 'text', array('label' => 'Название'))
                    ->add('visible', null, array('label' => 'Отображать', 'required' => false))
                ->end()
            ->end()
//            ->tab('Услуги, входящие в группу')
//                ->with(null)
//                    ->add(
//                        'services',
//                        'sonata_type_collection',
//                        array('required' => false, 'by_reference' => false, 'label' => 'Услуги'),
//                        array('edit' => 'inline', 'inline' => 'table')
//                    )
//                ->end()
//            ->end()
//            ->add('contacts', null, array('label' => 'Контакты', 'attr'=>array('class' => 'tinymce')))
//            ->add('content', 'textarea', array('label' => 'Содержание', 'attr'=>array('class' => 'tinymce')))
//            ->add('footer', 'text', array('label' => 'Футер', 'required' => false))
//            ->add('news', null, array('label' => 'Отображать новости', 'required' => false))
//            ->add('articles', null, array('label' => 'Отображать статьи', 'required' => false))
//            ->add('actions', null, array('label' => 'Отображать акции', 'required' => false))
//            ->add('keywords', null, array('label' => 'Ключевые слова', 'required' => false))
//            ->add('description', null, array('label' => 'Описание страницы', 'required' => false))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array('label' => 'Название'))
            ->add('visible', null, array('label' => 'Отображать'))
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, array('label' => 'Название'))
            ->add('visible', null, array('label' => 'Отображать', 'editable' => true))
            ->add('services', null, array('label' => 'Услуги'))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        // Here we set the fields of the ShowMapper variable, $showMapper (but this can be called anything)
        $showMapper

            /*
             * The default option is to just display the value as text (for boolean this will be 1 or 0)
             */
            ->add('name', null, array('label' => 'Название'))
            ->add('services', null, array('label' => 'Услуги'))
            ->add('visible', null, array('label' => 'Видимый'))
        ;

    }

    public function preRemove($serviceGroup)
    {
        if ($serviceGroup->getServices()->getValues()) {
            throw new \Exception('Нельзя удалить группу, в которой есть услуги!');
        }
    }

    public function preBatchAction($actionName, ProxyQueryInterface $query, array & $idx, $allElements)
    {
        if ($actionName == 'delete') {
            $query
                ->andWhere($query->expr()->in('o.id', '?1'))
                ->setParameter(1, $idx);
            $serviceGroups = $query->execute();
            foreach ($serviceGroups as $serviceGroup) {
                $this->preRemove($serviceGroup);
            }
        }
    }

    public function prePersist($service)
    {
        $service->setSlug();
    }

    public function preUpdate($service)
    {
        $service->setSlug();
    }
}