<?php

namespace Kdrmklabs\Bundle\CurrencyBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CurrencyListener implements EventSubscriberInterface {
    
    private $default_currency;

    public function __construct($default_currency) { 
        $this->default_currency = strtoupper($default_currency);
    }

    public function onKernelRequest(GetResponseEvent $event) { 
        $request = $event->getRequest();

        if(!$request->getSession()->has('_currency')) { 
            $request->getSession()->set('_currency', $this->default_currency);
        }
        
        if($request->query->has('_currency')) { 
            $currency_iso_code = $request->query->get('_currency');
            $request->getSession()->set('_currency', $currency_iso_code);
        }
    }

    public static function getSubscribedEvents() {
        return array(
            // must be registered after the default Locale listener
            KernelEvents::REQUEST => array(array('onKernelRequest', 15)),
        );
    }
    
}
