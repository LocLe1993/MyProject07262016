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
	public function index(\Silex\Application $app, Request $request) {
		$blog = new Blog();
		$form = $app['form.factory']->createBuilder(BlogTypes::class, $blog)
		->getForm();
		$action = $request->get('action');
		$invalid = false;
		switch ($action) {
			case "add":
				$form->handleRequest($request);
				if ($form->isValid()) {
					// do something with the data
					// redirect somewhere
					$app ['Myproject.Blog.Repository']->save ($blog);
					
				} else {
					$invalid = true;
				}
				return $app->redirect($app["url_generator"]->generate("blog"));
			case "update":
				break;
			default:
				break;
		}
		
		
		$list = $app ['Myproject.Blog.Repository']->getListAll ();
		return $app ['twig']->render ( 'blog/index.html.twig', array (
				'list' => $list,
				'PageName' => 'BLOG LIST',
				'CurrentPage' => 'Blog List',
				'form' => $form->createView(),
				'invalid' => $invalid
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
		$blog = new Blog();
		$form = $app['form.factory']->createBuilder(BlogTypes::class, $blog)
			->getForm();
		$form->handleRequest($request);
		if ($form->isValid()) {
			// do something with the data
			// redirect somewhere
			$app ['Myproject.Blog.Repository']->save ($blog);
		}
		// display the form
		return $app['twig']->render('blog/input.html.twig', array('form' => $form->createView(), 'id' => null));
	}
	
	public function updateAction(\Silex\Application $app, Request $request, $id) {
		$blog = $app ['Myproject.Blog.Repository']->getById($id);
		$form = $app['form.factory']->createBuilder(BlogTypes::class, $blog)
		->getForm();
		$form->handleRequest($request);
		if ($form->isValid()) {
			// do something with the data
			// redirect somewhere
			$app ['Myproject.Blog.Repository']->save ($blog);
		}
		// display the form
		return $app['twig']->render('blog/input.html.twig', array('form' => $form->createView(), 'id' => $id));
	}
	
	public function deleteAction(\Silex\Application $app, Request $request) {
		$id = $request->get('id');
		$blog = $app ['Myproject.Blog.Repository']->getById($id);

		$app ['Myproject.Blog.Repository']->del_entity($blog);

		return $app->redirect($app["url_generator"]->generate("blog"));
	}
}