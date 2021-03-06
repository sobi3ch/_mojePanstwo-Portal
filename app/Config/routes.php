<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
if ( $_SERVER['HTTP_HOST'] == PK_DOMAIN ) { // HTTP_X_FORWARDED_HOST

	Router::connect( '/dane/krs_podmioty/:id', array(
		'plugin'     => 'Dane',
		'controller' => 'krs_podmioty',
		'action'     => 'view'
	) );
	Router::connect( '/dane/krs_podmioty/:id/:action', array( 'plugin' => 'Dane', 'controller' => 'krs_podmioty' ) );
	Router::connect( '/dane/krs_podmioty/:id/:action/*', array( 'plugin' => 'Dane', 'controller' => 'krs_podmioty' ) );

	Router::connect( '/', array( 'plugin' => 'Dane', 'controller' => 'gminy', 'action' => 'view', 'id' => 903 ) );
	Router::connect( '/:action', array( 'plugin' => 'Dane', 'controller' => 'gminy', 'id' => 903 ) );
	Router::connect( '/:action/*', array( 'plugin' => 'Dane', 'controller' => 'gminy', 'id' => 903 ) );
	
	
	Router::connect( '/dane/krs_podmioty/:id,:slug', array(
		'plugin'     => 'Dane',
		'controller' => 'krs_podmioty',
		'action'     => 'view'
	) );
	Router::connect( '/dane/krs_podmioty/:id,:slug/:action', array( 'plugin' => 'Dane', 'controller' => 'krs_podmioty' ) );
	Router::connect( '/dane/krs_podmioty/:id,:slug/:action/*', array( 'plugin' => 'Dane', 'controller' => 'krs_podmioty' ) );

	Router::connect( '/', array( 'plugin' => 'Dane', 'controller' => 'gminy', 'action' => 'view', 'id' => 903 ) );
	Router::connect( '/:action', array( 'plugin' => 'Dane', 'controller' => 'gminy', 'id' => 903 ) );
	Router::connect( '/:action/*', array( 'plugin' => 'Dane', 'controller' => 'gminy', 'id' => 903 ) );

} else {
	Router::connect( '/', array( 'controller' => 'pages', 'action' => 'display', 'home' ) );
}

/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
Router::connect( '/pages/*', array( 'controller' => 'pages', 'action' => 'display' ) );

Router::connect( '/htmlex/*', array( 'controller' => 'docs', 'action' => 'tunnel' ) );

Router::connect( '/docs/:id', array( 'controller' => 'docs', 'action' => 'view' ), array( 'id' => '[0-9]+' ) );
Router::connect( '/docs/:id/download', array(
	'controller' => 'docs',
	'action'     => 'download'
), array( 'id' => '[0-9]+' ) );
Router::connect( '/docs/:doc_id-:package_id', array(
	'controller' => 'docs',
	'action'     => 'viewPackage'
), array( 'doc_id' => '[0-9]+', 'package_id' => '[0-9]+' ) );

Router::connect( '/oportalu', array( 'controller' => 'pages', 'action' => 'display', 'about_us' ) );
Router::connect( '/regulamin', array( 'controller' => 'pages', 'action' => 'display', 'regulations' ) );
Router::connect( '/zglosblad', array( 'controller' => 'pages', 'action' => 'display', 'report_bug' ) );
Router::connect( '/kontakt', array( 'controller' => 'pages', 'action' => 'display', 'contact_us' ) );

Router::connect('/aplikacje', array('controller' => 'pages', 'action' => 'display', 'apps'));

Router::parseExtensions( 'rss', 'xml', 'json', 'html' );
Router::connect( '/sitemap', array( 'controller' => 'sitemaps', 'action' => 'index' ) );
Router::connect( '/sitemaps/:dataset-:page', array( 'controller' => 'sitemaps', 'action' => 'dataset' ) );

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
require CAKE . 'Config' . DS . 'routes.php';
