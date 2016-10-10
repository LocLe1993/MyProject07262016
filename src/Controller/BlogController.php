<?php

namespace MyProject\Controller;

use Symfony\Component\HttpFoundation\Request;
use MyProject\Entity\Blog;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;
use MyProject\Form\BlogTypes;

class BlogController {
	public function index(\Silex\Application $app) {
		$list = $app ['Myproject.Blog.Repository']->getListAll ();
		
		return $app ['twig']->render ( 'blog/index.html.twig', array (
				'list' => $list,
				'PageName' => 'BLOG LIST',
				'CurrentPage' => 'Blog List' 
		) );
	}
// 	public function addView(\Silex\Application $app) {
// 		$form = $app['form.factory']
// 			->createBuilder(BlogTypes::class, null)
// 			->getForm();
		
// 		return $app ['twig']->render ( 'blog/input.html.twig', array (
// 				'PageName' => 'BLOG LIST',
// 				'CurrentPage' => 'Blog List',
// 				'form' => $form->createView () 
// 		) );
// 	}
	public function addAction(\Silex\Application $app, Request $request) {
		$data = array(
			
		);
		$form = $app['form.factory']->createBuilder(BlogTypes::class, $data)
			->getForm();
		$form->handleRequest($request);
		if ($form->isValid()) {
			$data = $form->getData();
			// do something with the data
			// redirect somewhere
			var_dump($data);die();
		}
		// display the form
		return $app['twig']->render('blog/input.html.twig', array('form' => $form->createView()));
	}
}