<?php

namespace MyProject\Controller;

class HomeController {
	public function index(\Silex\Application $app) {
		$PageName = 'Dashboard';
		return $app['twig']->render('index.html.twig',array('PageName'=> $PageName));
	}
}