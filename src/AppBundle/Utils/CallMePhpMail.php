<?php
namespace AppBundle\Utils;


class CallMePhpMail {
    public function send($name, $phone, $message = ""){

        $address = 'carwest@tut.by';
        $subject = 'Заказ обратного звонка от ' . $name . ', номер телефона: ' . $phone;
        $body = 'Имя: ' . $name . ' Телефон: ' . $phone . ' Сообщение: ' . $message;
        $additionalHeaders = 'Content-Transfer-Encoding: quoted-printable';

        if (mail($address, $subject, $body, $additionalHeaders)) {
            return true;
        } else {
            return false;
        }
    }
} 