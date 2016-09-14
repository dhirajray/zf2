<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[:controller][/:action]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*/?',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*/?',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index'
                    ),
                ),
            ),
            'error' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/error[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*/?',
                    ),
                    'defaults' => array(
                        'controller' => 'Error',
                        'action' => 'index',
                    ),
                ),
            ),
            'error' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/robots.txt',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Seo',
                        'action' => 'robots',
                    ),
                ),
            ),
            'categorie' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/news[/:categorie]',
                    'constraints' => array(
                        'categorie' => '[0-9_-]*/?',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\News',
                        'action' => 'index',
                    ),
                ),
            ),
            'news' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/news/view[/:id]',
                    'constraints' => array(
                        'id' => '[0-9_-]*/?',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\News',
                        'action' => 'view',
                    ),
                ),
            )
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'my_memcached_alias' => function() {
        $memcached = new \Memcached();
        $memcached->addServer('localhost', 11211);
        return $memcached;
    },
        ),
        'invokables' => [
            'PostService' => 'Application\Service\PostService',
            'CategoriesService' => 'Application\Service\CategoriesService',
            'GalleryService' => 'Application\Service\GalleryService',
            'TagService' => 'Application\Service\TagService',
            'UserIdentity' => 'Application\Provider\Identity\UserIdentity',
            'RoleProviderService' => 'Application\Service\RoleProviderService',
            'ReviewService' => 'Application\Service\UserReviewService',
        	'ArticalService' => 'Application\Service\ArticalService',
            'Application\View\UnauthorizedStrategy' => 'Application\View\UnauthorizedStrategy',
        ],
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'ru_RU.utf8',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Error' => 'Application\Controller\ErrorController',
            'Application\Controller\News' => 'Application\Controller\NewsController',
            'Application\Controller\Upload' => 'Application\Controller\UploadController',
            'Application\Controller\Contact' => 'Application\Controller\ContactController',
            'Application\Controller\About' => 'Application\Controller\AboutController',
            'Application\Controller\Gallery' => 'Application\Controller\GalleryController',
            'Application\Controller\Service' => 'Application\Controller\ServiceController',
            'Application\Controller\Seo' => 'Application\Controller\SeoController',
            'Application\Controller\Search' => 'Application\Controller\SearchController',
            'Application\Controller\Review' => 'Application\Controller\ReviewController',
        	'Application\Controller\Artical' => 'Application\Controller\ArticalController',
        ),
    ),
    'view_manager' => array(       
        'base_path' => '/public/',
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/403' => __DIR__ . '/../view/error/403.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        //   'zfcuser' => __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'flashmessengerHelper' => 'Application\View\Helper\FlashMessengerHelper',
            'watermark' => 'Application\View\Helper\WatermarkHelper',
        )
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        ),
        'cache' => array(
            'instance' => 'my_memcached_alias',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'asset_bundle' => array(
        'assets' => array(
            'css' => array('css'),
            'js' => array(
                'js/jquery.min.js',
                'js/bootstrap.min.js'
            ),
        //      'media' => array('img')
        )
    ),
     'base_url' => 'http://localhost/sns/public' 
);
