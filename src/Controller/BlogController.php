<?php

namespace MyProject\Controller;


use Symfony\Component\HttpFoundation\Request;
use MyProject\Entity\Blog;
use Silex\Application;

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
	
	public function addBlogPage(\Silex\Application $app, Request $request) {
		$result=false;
		$listType = $app['Myproject.Type.Repository']->getAllForCBB();
		$listField = $app['Myproject.Field.Repository']->getAllForCBB();
		return $app['twig']->render('blog/add.html.twig',
				array('result'=>$result,
					'listType' => $listType,
					'listField' => $listField,
					'PageName' => 'ADD BLOG','CurrentPage'=>'Add Blog'));
	}
	
	public function addBlog(\Silex\Application $app, Request $request) {
		$blogname=$request->get('blogname');
		$blogtype=$request->get('blogtype');
		$field=$request->get('field');
		$current_user_id = $app['user']->getId();
		$blog = new Blog();
		$blog->setName($blogname);
		$blog->setFieldId($field);
		$blog->setBlogTypeId($blogtype);
		$blog->setCreatedBy($current_user_id);
		$blog->setUpdatedBy($current_user_id);
		
		$result=$app['Myproject.Blog.Repository']->save($blog);

		$listType = $app['Myproject.Type.Repository']->getAllForCBB();
		$listField = $app['Myproject.Field.Repository']->getAllForCBB();
		
		
		return $app['twig']->render('blog/add.html.twig',
				array('result'=>$result,
					'listType' => $listType,
					'listField' => $listField,
					'PageName' => 'ADD BLOG','CurrentPage'=>'Add Blog'));
	}

	public  function updateBlogPage(\Silex\Application $app, Request $request){
		$result=false;
		$blog = $app['Myproject.Blog.Repository']->getBlogById($request->get('blogId'));
		$listType = $app['Myproject.Type.Repository']->getAllForCBB();
		$listField = $app['Myproject.Field.Repository']->getAllForCBB();
		return $app['twig']->render('blog/update.html.twig',
				array('result'=>$result,
						'listType' => $listType,
						'listField' => $listField,
						'PageName' => 'UPDATE BLOG','CurrentPage'=>'Update Blog','blog'=>$blog));
	}
	
	public  function updateBlog(\Silex\Application $app, Request $request){
		$blog = $app['Myproject.Blog.Repository']->getBlogById($request->get('blogId'));
		
		$blogname=$request->get('blogname');
		$blogtype=$request->get('blogtype');
		$field=$request->get('field');
		$current_user_id = $app['user']->getId();
		$blog->setName($blogname);
		$blog->setFieldId($field);
		$blog->setBlogTypeId($blogtype);
		$blog->setCreatedBy($current_user_id);
		$blog->setUpdatedBy($current_user_id);
		
		$result=$app['Myproject.Blog.Repository']->save($blog);
		
		$listType = $app['Myproject.Type.Repository']->getAllForCBB();
		$listField = $app['Myproject.Field.Repository']->getAllForCBB();
		return $app['twig']->render('blog/update.html.twig',
				array('result'=>$result,
						'listType' => $listType,
						'listField' => $listField,
						'PageName' => 'UPDATE BLOG','CurrentPage'=>'Update Blog','blog'=>$blog));
	}
	
	public function deleteBlog(\Silex\Application $app, Request $request){
		$blog = $app['Myproject.Blog.Repository']->getBlogById($request->get('blogId'));
		
		$app['Myproject.Blog.Repository']->deleteBlog($blog);
		
		$list = $app['Myproject.Blog.Repository']->getListAll();
		
		$listType = $app['Myproject.Type.Repository']->getAllForCBB();
		$listField = $app['Myproject.Field.Repository']->getAllForCBB();
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
}