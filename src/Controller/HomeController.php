<?php

namespace MyProject\Controller;

class HomeController {
	public function index(\Silex\Application $app) {
		$amount = $app['const']['username']['max'];
		return $app['twig']->render('index.html.twig',
				array(
						'str'=> '60,000.00',
						'amount' => $amount,
						'header_title' => 'Index - Home',
						'title' => 'home'
				));
	}
}