<?php

namespace LoginBundle\Event;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class OnKernelRequestListener
{
    public function onKernelRequest(GetResponseEvent $getResponseEvent)
    {
        $request = $getResponseEvent->getRequest();
        $request->setLocale('de');
 //       dump( 'LoginBundle\Event\OnKernelRequestListener\onKernelRequest\(GetResponseEvent $getResponseEvent)');
    }

}
