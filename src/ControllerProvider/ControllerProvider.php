<?php

namespace MyProject\ControllerProvider;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class ControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/', 'MyProject\Controller\HomeController::index')->bind('index');
        
        $controllers->get('/new', 'MyProject\Controller\HomeController::newhtml')->bind('new');
        
        $controllers->get('/blog', 'MyProject\Controller\BlogController::index')->bind('blog');
        
        $controllers->get('/blog/add', 'MyProject\Controller\BlogController::addView')->bind('blogadd');

        /* Login */
        $controllers->get('/login', 'MyProject\Controller\AdminController::login')->bind('login');
        
        /* Logout */
        $controllers->delete('/logout', 'MyProject\Controller\AdminController::logout')->bind('logout');

        return $controllers;
    }
}