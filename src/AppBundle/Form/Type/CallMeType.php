<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class CallMeType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAction('javascript:void();')
            ->setMethod('post')
            ->add('name', 'text', array(
                'constraints' => array(new NotBlank()),
                'label' => 'Имя',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Как к Вам обращаться (обязательно)?'
                )
            ))
            ->add('phone', 'text', array(
                'constraints' => array(new NotBlank()),
                'label' => 'Телефон',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Номер с кодом (обязательно)'
                )
            ))
            ->add('message', 'textarea', array(
                'label' => 'Сообщение',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Сообщение по Вашему желанию'
                )
            ))
            ->add('Заказать обратный звонок', 'submit', array(
                'attr'=>(array(
                        'class' => 'btn btn-warning',
//                        'onclick' => 'ajax()'
                    ))
            ))
        ;
    }

    public function getName()
    {
        return 'call_me_form';
    }
} 