<?php

namespace DavidTeruel\UtilsBundle\Utils;

use Symfony\Component\HttpFoundation\Session\Session;

class FlashMessage
{
    const MESSAGE_TYPE_SUCCESS = 'success';
    const MESSAGE_TYPE_ERROR = 'error';
    const MESSAGE_TYPE_WARNING = 'warning';

    /** @var Session $session */
    private $session;

    /**
     * FlashMessage constructor.
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param string $messageType
     * @param string $message
     */
    public function addFlashMessage($messageType = FlashMessage::MESSAGE_TYPE_SUCCESS, $message = '')
    {
        $this->session->getFlashBag()->add(
            $messageType,
            $message
        );
    }




}