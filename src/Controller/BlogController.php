<?php

namespace MyProject\Controller;


use Symfony\Component\HttpFoundation\Request;


class BlogController {
	
	public function index(\Silex\Application $app, Request $request) {
		
		$list = $app['Myproject.Blog.Repository']->getListAll();
		
		$listType = $app['Myproject.Type.Repository']->getAllForCBB();
		$listField = $app['Myproject.Field.Repository']->getAllForCBB();
		
		$blogname = $request->get('blogname');
		$field = $request->get('field');
		$blogtype = $request->get('blogtype');
		
		if ($blogname != "" || $field != "" || $blogtype != "") {
			$list = $app['Myproject.Blog.Repository']->getListByCondition($blogname,$field,$blogtype);
		}
		
		//var_dump($listType);die();
		
		return $app['twig']->render('blog/index.html.twig',
			array(
				'list'=> $list,
				'listType' => $listType,
				'listField' => $listField,
				'PageName' => 'BLOG LIST',
				'CurrentPage' => 'Blog List'
			)
		);
	}
	
	public function addBlog(\Silex\Application $app) {
		return $app['twig']->render('blog/add.html.twig',array('PageName' => 'ADD BLOG','CurrentPage'=>'Add Blog'));
	}
}