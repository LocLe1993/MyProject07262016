<?php
namespace MyProject\Controller;

use Symfony\Component\HttpFoundation\Request;

class BlogTypeController{
	public function index(\Silex\Application $app, Request $request) {
		
		$list = $app['Myproject.Type.Repository']->getListAll();
		
		return $app['twig']->render('blogType/index.html.twig',
				array(
						'list'=> $list,
						'PageName' => 'BLOG LIST',
						'CurrentPage' => 'Blog List'
				)
				);
	}
}