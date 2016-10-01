<?php

namespace MyProject\Controller;

use MyProject\Form\BlogTypes;

class BlogController {
	
	public function index(\Silex\Application $app) {
		
		$list = $app['Myproject.Blog.Repository']->getListAll();
		
		return $app['twig']->render('blog/index.html.twig',array('list'=> $list,'PageName' => 'BLOG LIST','CurrentPage'=>'Blog List'));
		
	}
	
	public function addView(\Silex\Application $app) {
		$form = $app['form.factory']->createBuilder(BlogTypes::class)->getForm();
		
		return $app['twig']->render('blog/input.html.twig',array('PageName' => 'BLOG LIST','CurrentPage'=>'Blog List', 'form' => $form->createView()));
	}
}