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
        $app['Myproject.Blog.Repository'] = $app->factory(function () use ($app) {
        	return $app['orm.em']->getRepository('MyProject\Entity\Blog');
        });
        $app['Myproject.BlogType.Repository'] = $app->factory(function () use ($app) {
        	return $app['orm.em']->getRepository('MyProject\Entity\BlogType');
        });
        
       	$app['form.types'] = $app->extend('form.types', function ($types) use ($app) {
       		$types[] =
       			new \MyProject\Form\BlogTypes();
       		
       		return $types;
       	});
    }

    public function boot(Application $app)
    {
        // do something 
    }
}