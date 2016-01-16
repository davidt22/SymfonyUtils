<?php

namespace DavidTeruel\UtilsBundle\Controller;

use DavidTeruel\UtilsBundle\Utils\FlashMessage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class BaseController extends Controller
{
    /**
     * @return boolean
     */
    protected function isUserLogged()
    {
        return $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function redirectToReferer(Request $request)
    {
        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @return string
     */
    protected function getEnvironment()
    {
        return $this->get('kernel')->getEnvironment();
    }

    /**
     * @return EventDispatcherInterface
     */
    protected function getEventDispatcher()
    {
        return $this->get('event_dispatcher');
    }

    /**
     * @param $eventName
     * @param array $data
     */
    protected function dispatchEvent($eventName, array $data)
    {
        $response = new Response();
        $response->setContent($data);

        $this->getEventDispatcher()->dispatch($eventName, new GenericEvent($response));
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        /** @var Session $session */
        $session = $this->get('session');

        return $session;
    }

    /**
     * @param string $messageType
     * @param string $message
     */
    public function addFlashMessage($messageType = FlashMessage::MESSAGE_TYPE_SUCCESS, $message = '')
    {
        $flashMessage = new FlashMessage($this->getSession());
        $flashMessage->addFlashMessage($messageType, $message);
    }
}
