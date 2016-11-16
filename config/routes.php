<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following Route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    //$routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    $routes->connect('/', ['controller' => 'Articles', 'action' => 'index']);
    $routes->connect('/categorie/:id-:title', ['controller' => 'Articles', 'action' => 'index'],[
        'pass' => ['id','title'],
        'id' => '[0-9]+'
    ]);
    $routes->connect('/article/:id-:title', ['controller' => 'Articles', 'action' => 'view'],[
        'pass' => ['id','title'],
        'id' => '[0-9]+'
    ]);


    $routes->connect('/connexion/',['controller' => 'Users','action' => 'login']);
    $routes->connect('/deconnexion/',['controller' => 'Users','action' => 'logout']);
    $routes->connect('/inscription/',['controller' => 'Users','action' => 'register']);

    $routes->connect('/profil/:id-:username',['controller' => 'Users','action' => 'view'],[
        'pass' => ['id','username'],
        'id' => '[0-9]+'
    ]);
    $routes->connect('/compte/validation/:email',['controller' => 'Users','action' => 'validate'],[
        'pass' => ['email'],
        'id' => '[a-zA-Z0-9]+'
    ]);

    $routes->connect('/profil/editer/:id-:username',['controller' => 'Users','action' => 'edit'],[
        'pass' => ['id','username'],
        'id' => '[0-9]+'
    ]);
    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);



    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any Route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own Route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();

/**
 * ------------------- Routes with prefix --------------------
 */

Router::prefix('admin', function ($routes) {
    $routes->connect('/', ['controller' => 'Users', 'action' => 'gestion']);
    $routes->connect('/utilisateurs/',['controller' => 'Users', 'action' => 'index']);
    $routes->connect('/utilisateurs/:id-:username', ['controller' => 'Users', 'action' => 'view'],[
        'pass' => ['id','username'],
        'id' => '[0-9]+'
    ]);
    $routes->connect('/utilisateurs/editer/:id-:username', ['controller' => 'Users', 'action' => 'edit'],[
        'pass' => ['id','username'],
        'id' => '[0-9]+'
    ]);
    $routes->connect('/articles/',['controller' => 'Articles', 'action' => 'index']);
    $routes->connect('/article/:id-:title', ['controller' => 'Articles', 'action' => 'view'],[
        'pass' => ['id','title'],
        'id' => '[0-9]+'
    ]);
    $routes->connect('/article/editer/:id-:title', ['controller' => 'Articles', 'action' => 'edit'],[
        'pass' => ['id','title'],
        'id' => '[0-9]+'
    ]);
    $routes->connect('/article/ajouter', ['controller' => 'Articles', 'action' => 'add']);
    $routes->connect('/categories/', ['controller' => 'Tags', 'action' => 'index']);
    $routes->connect('/categories/ajouter', ['controller' => 'Tags', 'action' => 'add']);
    $routes->connect('/categories/:id-:title', ['controller' => 'Tags', 'action' => 'view'],[
        'pass' => ['id','title'],
        'id' => '[0-9]+'
    ]);
    $routes->connect('/categories/editer/:id-:title', ['controller' => 'Tags', 'action' => 'edit'],[
        'pass' => ['id','title'],
        'id' => '[0-9]+'
    ]);
    $routes->fallbacks(DashedRoute::class);
});


