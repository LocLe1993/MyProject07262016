<?php

namespace MyProject\Controller;

class BlogController {
	
	public function index(\Silex\Application $app) {
		
		$list = $app['Myproject.Blog.Repository']->getListAll();
		
		return $app['twig']->render('blog/index.html.twig',array('list'=> $list,'PageName' => 'BLOG LIST','CurrentPage'=>'Blog List'));
		
	}
}