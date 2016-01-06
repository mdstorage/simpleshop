<?php
namespace Acme\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class PostType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('title', 'text', array(
                'label' => 'Название',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Введите название'
                )
            ))

            ->add('description', 'textarea', array(
                'label' => 'Содержание',
                'attr' => array(
                    'class' => 'tinymce',
                    'placeholder' => 'Содержание статьи'
                )
            ))

        ;
    }
    public function getName()
    {
        return 'post';
    }
} 