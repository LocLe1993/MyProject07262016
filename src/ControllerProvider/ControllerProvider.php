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
        
        $controllers->get('/blog/add','MyProject\Controller\BlogController::addBlogPage')->bind('addBlog');
        $controllers->post('/blog/addblog','MyProject\Controller\BlogController::addBlog')->bind('addBlogPost');
        
        $controllers->get('/blog/update','MyProject\Controller\BlogController::updateBlogPage')->bind('updateBlog');
        $controllers->post('/blog/updateblog','MyProject\Controller\BlogController::updateBlog')->bind('updateBlogPost');
        
        $controllers->post('/blog/deleteblog','MyProject\Controller\BlogController::deleteBlog')->bind('deleteBlog');
        
        $controllers->get('/blogType', 'MyProject\Controller\BlogTypeController::index')->bind('blogType');
        
        $controllers->get('/blogType/add','MyProject\Controller\BlogTypeController::addBlogType')->bind('addBlogType');

        
        /* Login */
        $controllers->get('/login', 'MyProject\Controller\AdminController::login')->bind('login');
        
        /* Logout */
        $controllers->delete('/logout', 'MyProject\Controller\AdminController::logout')->bind('logout');

        return $controllers;
    }
}