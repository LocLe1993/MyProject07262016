<?php

namespace MyProject;

use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Symfony\Component\Yaml\Yaml;
use Silex\Provider\SessionServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\FormServiceProvider;

class Application extends \Silex\Application {
	public function __construct(array $values = array())
    {
        parent::__construct($values);
        
        $this->initConfig();
    }
	public function initialize() {
        $this->initCommon();
		$this->initServiceAndRouting();
		$this->initTwig();
		$this->initDoctrine();
        $this->initSession();
        $this->initLocale();
        $this->initAsset();
        $this->initSecurity();
	}

    /**
     * Initialize common parameter
     */
    private function initCommon() {
        Request::enableHttpMethodParameterOverride();
    }

	public function initConfig() {
        require_once __DIR__.'/../config/config.php';
        $this['const'] = $this->initConstantFile();
	}

    private function initConstantFile () {
        $constantPath = __DIR__."/../config/constant.yml";
        $arrConstant = Yaml::parse(file_get_contents($constantPath));
        return $arrConstant;
    }

	public function initServiceAndRouting() {
		$this->register(new ServiceControllerServiceProvider());
		$this->register(new FormServiceProvider());
		$this->register(new AssetServiceProvider());
		$this->register(new TwigServiceProvider());
		$this->register(new HttpFragmentServiceProvider());

		$this->mount('/', new \MyProject\ControllerProvider\ControllerProvider());
		$this->register(new \MyProject\ServiceProvider\ServiceProvider());
	}

	public function initTwig() {
		$this->register(new \Silex\Provider\TwigServiceProvider(), array(
           'twig.path' => __DIR__.'/../templates',
      	));

      	$this['twig'] = $this->extend('twig', function ($twig, $app) {
		    $twig->addExtension(new \MyProject\Twig\TwigExtension($app));
            return $twig;
		});
	}

	public function initDoctrine() {
        $this->register(new \Silex\Provider\DoctrineServiceProvider(), array(
            'db.options' => array(
                'dbname'   => DB_NAME,
                'user'     => DB_USER,
                'password' => DB_PASS,
                'host'     => DB_HOST,
                'charset'  => 'utf8',
                'driver'   => 'pdo_mysql'
            )
        ));
        $this->register(new \Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider(), array(
            "orm.em.options" => array(
                "mappings" => array(
                    array(
                        "type" => "yml",
                        "namespace" => "MyProject",
                        "path" => __DIR__."/../config/yaml",
                    )
                ),
            ),
        ));
        $this->register(
            new \Saxulum\DoctrineOrmManagerRegistry\Provider\DoctrineOrmManagerRegistryProvider()
        );
	}

    // /**
    //  * Initialize security
    //  */
    // public function initSecurity()
    // {
    //     $app = $this;
    //     $app['security.firewalls'] = array();
    //     $this['security.user_provider.default'] =
    //         $this['orm.em']->getRepository('\MyProject\Entity\Member');
    //     $this->register(new \Silex\Provider\SecurityServiceProvider());
    //     $this->register(new \Silex\Provider\RememberMeServiceProvider());
    //     $this->boot();
    //     $app['security.firewalls'] = array(
    //         'member' => array(
    //             'wsse' =>array(
    //                 'login_path' => '/login',
    //                 'check_path' => '/login_check',
    //                 'username_parameter' => 'user_id',
    //                 'password_parameter' => 'password',
    //                 'default_target_path' => '/',
    //                 'always_use_default_target_path' => true
    //             ),
    //             'pattern' => '^/',
    //             'form' => array(
    //                 'login_path' => '/login',
    //                 'check_path' => '/login_check',
    //                 'username_parameter' => 'user_id',
    //                 'password_parameter' => 'password',
    //                 'default_target_path' => '/',
    //                 'always_use_default_target_path' => true
    //             ),
    //             'remember_me' => array(
    //                 'always_remember_me'=> false,
    //                 'lifetime' => 3600 * 24 * 14,
    //                 'remember_me_parameter' => 'remember',
    //             ),
    //             'users' => $this['security.user_provider.default'],
    //             'anonymous' => true,
    //         ),
    //     );
    //     $this['security.access_rules'] = array(
    //         array('^/login', 'IS_AUTHENTICATED_ANONYMOUSLY'),
    //         array('^/', 'ROLE_USER'),
    //     );
    //     $this['password_encoder'] = new \MyProject\Core\PasswordEncoder();
        
    //     $this['security.encoder_factory'] = 
    //     new \Symfony\Component\Security\Core\Encoder\EncoderFactory(
    //         array(
    //             'MyProject\Entity\Member' => $this['password_encoder'],
    //         )
    //     );

    //     $this['user'] = $this->checkToken($app);

    //     $this['security.authentication_listener.factory.wsse'] = $this->protect(function ($name, $options) use ($app) {
    //         // define the authentication provider object
    //         $this['security.authentication_provider.'.$name.'.wsse'] = $this->authenProvider($app, $name);

    //         // define the authentication listener object
    //         $this['security.authentication_listener.'.$name.'.wsse'] = $this->manageAuthen($app, $name, $options);

    //         return array(
    //             // the authentication provider id
    //             'security.authentication_provider.'.$name.'.wsse',
    //             // the authentication listener id
    //             'security.authentication_listener.'.$name.'.wsse',
    //             // the entry point id
    //             null,
    //             // the position of the listener in the stack
    //             'pre_auth'
    //         );
    //     });
    // }

    /**
     * Initialize security service provider
     */
    private function initSecurity() {
        $app = $this;
        $this['security.user_provider.default'] = $this['orm.em']->getRepository('MyProject\Entity\Member');
        $this->register(new \Silex\Provider\SecurityServiceProvider());
        $this->register(new \Silex\Provider\RememberMeServiceProvider());
        
        $this ['security.firewalls'] = array (
            // 'member', you can change to another name
            'member' => array (
                'pattern' => '^/',
                'anonymous' => true,
                'form' => array(
                    'login_path' => '/login',
                    'check_path' => '/login_check',
                    'username_parameter' => 'username',
                    'password_parameter' => 'password',
                    'default_target_path' => '/',
                    'always_use_default_target_path' => true
                ),
                'wsse' => array(
                    'login_path' => '/login',
                    'check_path' => '/login_check',
                    'username_parameter' => 'username',
                    'password_parameter' => 'password',
                    'default_target_path' => '/',
                    'always_use_default_target_path' => true
                ),
                'remember_me' => array(
                    'always_remember_me'=> false,
                    'lifetime' => 3600 * 24 * 14,
                    'remember_me_parameter' => 'remember',
                ),
                'users' => $this['security.user_provider.default'],
                'anonymous' => true,
            ) 
        );
        
        $this['security.access_rules'] = array(
            array('^/login', 'IS_AUTHENTICATED_ANONYMOUSLY'),
            array('^/', 'ROLE_USER'),
        );
        $this['password_encoder'] = $this->factory(function () {
            return new \MyProject\Core\PasswordEncoder();
        });
        $this['security.encoder_factory'] = $this->factory(function ($app) {
            return new \Symfony\Component\Security\Core\Encoder\EncoderFactory(array(
                'MyProject\Entity\Member' => $app['password_encoder'],
            ));
        });
        
        $this['user'] = $this->factory(function ($app) {
            // use 'security.token_storage' for this version instead of 'security' old version
            $token = $app['security.token_storage']->getToken();
            return ($token !== null) ? $token->getUser() : null;
        });
        
        $this['security.authentication_listener.factory.wsse'] = $this->protect(function ($name, $options) use ($app) {
            // define the authentication provider object
            $this['security.authentication_provider.'.$name.'.wsse'] = $this->factory(function ($app) use ($name) {
                return new \MyProject\Core\WsseProvider(
                    $app['security.user_provider.default'],
                    $name,
                    $app['security.encoder_factory']
                );
            });
        
            // define the authentication listener object
            $app['security.authentication_listener.'.$name.'.wsse'] = $this->factory(function ($app) use ($name, $options) {
                $app['security.authentication.success_handler.'.$name] =
                $app['security.authentication.success_handler._proto'](
                    $name,
                    $options
                );
                $app['security.authentication.failure_handler.'.$name] =
                $app['security.authentication.failure_handler._proto'](
                    $name,
                    $options
                );
                return new \MyProject\Core\WsseListener(
                    // use 'security.token_storage' for this version instead of 'security' old version
                    $app['security.token_storage'],
                    $app['security.authentication_manager'],
                    $app['security.session_strategy'],
                    $app['security.http_utils'],
                    $name,
                    $app['security.authentication.success_handler.'.$name],
                    $app['security.authentication.failure_handler.'.$name],
                    $options,
                    $app['logger'],
                    $app['dispatcher'],
                    null
                );
            });
        
            return array(
                // the authentication provider id
                'security.authentication_provider.'.$name.'.wsse',
                // the authentication listener id
                'security.authentication_listener.'.$name.'.wsse',
                // the entry point id
                null,
                // the position of the listener in the stack
                'pre_auth'
            );
        });
    }

    /**
     * Initialize session service provider
     */
    private function initSession() {
        $this->register(new SessionServiceProvider(), array (
            'session.storage.options' => array(
                'name' => 'MYPROJECT',
                'cookie_httponly' => true 
            ) 
        ) );
    }
    
    /**
     * Initialize translation service provider
     */
    private function initLocale() {
        $this->register(new TranslationServiceProvider(), array (
            'locale_fallbacks' => array (
                LOCALE 
            ),
            'locale' => LOCALE 
        ) );
    }

    /**
     * Initialize Asset service provider
     */
    private function initAsset() {
        $this->register(new AssetServiceProvider(), array(
            'assets.version' => ASSET_VERSION,
            'assets.version_format' => 'version',
            'assets.named_packages' => array(
                'css' => array('base_path' => ASSET_CSS_BASE_PATH),
                'img' => array('base_path' => ASSET_IMG_BASE_PATH),
                'js' => array('base_path' => ASSET_JS_BASE_PATH),
            	'assets' => array('base_path' => ASSET_ASSETS_BASE_PATH),
            ),
        ));
    }
}