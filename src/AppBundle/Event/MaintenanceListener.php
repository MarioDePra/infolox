<?php

namespace AppBundle\Event;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class MaintenanceListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        // our logic will go here
    }
}
