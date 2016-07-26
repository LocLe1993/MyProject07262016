<?php

namespace MyProject\ServiceProvider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Silex\Api\BootableProviderInterface;
use Silex\Api\EventListenerProviderInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        
    }

    public function boot(Application $app)
    {
        // do something 
    }
}