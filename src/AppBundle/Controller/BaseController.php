<?php
namespace AppBundle\Controller;

use AppBundle\Form\Type\CallMeType;
use AppBundle\Utils\CallMe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    public function getCallMeFormAction()
    {
        $callMeForm = $this->createForm(new CallMeType());
        return $this->render('_callme.html.twig', array(
            'callMeForm' => $callMeForm->createView()
        ));
    }

    /**
     * @Route("/callme", name="callme")
     */
    public function callMeAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $callMeForm = $this->createForm(new CallMeType());
            $callMeForm->handleRequest($request);
            if ($callMeForm->isValid()){
                $name = $callMeForm->get('name')->getData();
                $phone = $callMeForm->get('phone')->getData();
                $message = $callMeForm->get('message')->getData() ? : "Сообщение отсутствует";
                $callme = $this->get($this->container->getParameter('call_me_service'));
                if ($callme->send($name, $phone, $message)) {
                    return new Response('Данные успешно отправлены, наш менеджер перезвонит Вам в ближайшее время.');
                } else {
                    return new Response('Ошибка при отправке данных, проверьте соединение с Интернетом или повторите попытку позже.');
                }
            } else {
                return new Response('Поля Имя и Телефон являются обязательными для заполнения!');
            }

        }
    }
} 