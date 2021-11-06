<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use http\Client\Request;
use App\Http\Controllers\UserController;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// API ROUTE GROUP
$router->post('register', 'AuthController@register');
$router->post('login', 'AuthController@login');
$router->post('refresh', 'AuthController@refresh');
$router->get('logout', 'AuthController@logout');
$router->get('me', 'AuthController@me');
$router->post('uploadimg', 'Controller@uploadImage');

// GROUP AUTH (ajoute l'auth par token pour toute les route du groupe)
$router->group(['middleware' => "auth"], function($router){
    // USERS ROUTES
    $router->group(['prefix' => 'users'], function($router){
        $router->get('/','UserController@getUsersList');
        $router->get('/{id}','UserController@getUser');
        $router->post('/','UserController@addUser');
        // $router->post('/','AuthController@register');
        $router->put('/{id}','UserController@updateUser');
    });

    // MANDATES ROUTES
    $router->group(['prefix' => 'mandate'], function($router){
        $router->post('/','mandateController@addMandate');
        $router->put('/{id}','mandateController@updateMandate');
        $router->get('/','mandateController@getMandateList');
        $router->get('/{id}','mandateController@getMandate');
        $router->delete('/{id}','mandateController@deleteMandate');
    });

    // CLIENTS ROUTES
     $router->group(['prefix' => 'clients'], function($router){
        $router->post('/','ClientController@addClient');
        $router->put('/{id}','ClientController@updateClient');
        $router->get('/','ClientController@getClientList');
        $router->get('/{id}','ClientController@getClient');
    });

    //APPOINTMENT ROUTES
    $router->group(['prefix' => 'appointment'], function($router){
        $router->post('/','appointementController@addAppointement');
        $router->put('/{id}','appointementController@updateAppointement');
        $router->get('/','appointementController@getAppointementList');
        $router->get('/{id}','appointementController@getAppointement');
        $router->delete('/{id}','appointementController@deleteAppointement');
    });
    $router->group(['prefix' => 'appointments'], function($router){
        $router->post('/','appointementController@addAppointement');
        $router->put('/{id}','appointementController@updateAppointement');
        $router->get('/','appointementController@getUserAppointement');
        $router->get('/{id}','appointementController@getAppointement');
        $router->delete('/{id}','appointementController@deleteAppointement');
    });

    //PROPERTIES ROUTES
    $router->group(['prefix' => 'property'], function() use ($router){
        $router->post('/','PropertyController@addProperty');
        $router->put('/{id}','PropertyController@updateProperty');
        $router->get('/','PropertyController@getPropertiesList');
        $router->get('/{id}','PropertyController@getProperty');
        $router->delete('/{id}','PropertyController@deleteProperty');
    });

    //INVENTORIES ROUTES
    $router->group(['prefix' => 'inventory'], function() use ($router){
        $router->post('/','inventoryController@addInventory');
        $router->put('/{id}','inventoryController@updateInventory');
        $router->get('/','inventoryController@getInventoriesList');
        $router->get('/{id}','inventoryController@getInventory');
    });

    //GOALS ROUTES
    $router->group(['prefix' => 'goal'], function() use ($router){
        $router->post('/','GoalController@addGoal');
        $router->put('/{id}','GoalController@updateGoal');
        $router->get('/','GoalController@getGoalsList');
        $router->get('/{id}','GoalController@getGoal');
        $router->delete('/{id}','GoalController@deleteGoal');
    });
});




