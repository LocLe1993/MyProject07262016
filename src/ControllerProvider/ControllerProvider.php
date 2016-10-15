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
        
        $controllers->get('/new/', 'MyProject\Controller\HomeController::newhtml')->bind('new');
        
        $controllers->match('/blog/', 'MyProject\Controller\BlogController::index')->bind('blog');
        
        //$controllers->get('/blog/add', 'MyProject\Controller\BlogController::addView')->bind('blogaddView');
        
        $controllers->match('/blog/add/', 'MyProject\Controller\BlogController::addAction')->bind('blogadd');
        $controllers->match('/blog/update/{id}', 'MyProject\Controller\BlogController::updateAction')
        ->assert('id', '\d+')
        ->bind('blogupdate');
        
        $controllers->match('/blog/delete/', 'MyProject\Controller\BlogController::deleteAction')
        ->bind('blogdelete');

        /* Login */
        $controllers->get('/login/', 'MyProject\Controller\AdminController::login')->bind('login');
        
        /* Logout */
        $controllers->delete('/logout/', 'MyProject\Controller\AdminController::logout')->bind('logout');

        return $controllers;
    }
}