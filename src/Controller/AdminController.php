<?php

namespace MyProject\Controller;

use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

class AdminController
{
    /**
     * 
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function login(Application $app, Request $request) {
        if ($app['security.authorization_checker']->isGranted('ROLE_USER')) {
            return $app->redirect(
                $app['url_generator']->generate('index')
            );
        }
        return $app['twig']->render('login.html.twig', array(
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
            'title' => 'login'
        ));
    }
    
    /**
     * Logout action
     * @param \Silex\Application $app
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return twig view
     */
    public function logout(Application $app, Request $request)
    {
        $app['security.token_storage']->setToken(null);
        $request->getSession()->invalidate();

        $response = $app['security.http_utils']->createRedirectResponse($request, '/login');

        $cookieNames = ['MYPROJECT','REMEMBERME'];
        foreach ($cookieNames as $cookieName) {
            $response->headers->clearCookie($cookieName);
        }
        return $response;
    }
    
    public function index(Application $app)
    {
        return $app['twig']->render('index.html.twig');
    }
}
