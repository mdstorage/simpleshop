<?php
namespace AppBundle\Utils;

class CallMeSwiftMailer {
    protected $mailer;

    public function __construct(\Swift_Mailer $mailer) {
        $this->mailer = $mailer;
    }

    public function send($name, $phone, $message = ""){
        $message = \Swift_Message::newInstance()
            ->setSubject('Заказ обратного звонка от ' . $name . ', номер телефона: ' . $phone)
            ->setFrom('carwest@tut.by')
            ->setTo('carwest@tut.by')
            ->setBody('Имя: ' . $name . ' Телефон: ' . $phone . ' Сообщение: ' . $message);

        if ($this->mailer->send($message)) {
            return true;
        } else {
            return false;
        }
    }
}