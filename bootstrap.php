<?php
/**
 * (c) Tasklist App: The Simple task list.
 *
 * PHP version 5.6
 *
 * @author  Ge Bender <gesianbender@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @link    http://tasklist.gebender.com.br
 */
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('America/Sao_Paulo');

error_reporting(E_ALL);
ini_set('display_errors', true);

$autoload = require_once('vendor/autoload.php');
$autoload->add('', dirname(__FILE__) . '/App/Model/');

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use App\Controller\TasksController;
use Symfony\Component\HttpFoundation\Response;

// The Silex App
$app = new Application();

// The configs
$app['config'] = function () {
	return App\Config::load();
};

// Coonnection prams
$app['conn'] = function () use($app) {
    $conn = parse_url($app['config']['db']);
    $conn['driver'] = str_replace('pdo-mysql', 'pdo_mysql', $conn['scheme']);
    $conn['dbname'] = substr($conn['path'], 1);
    $conn['driverOptions'] = [1002 => 'SET NAMES utf8'];

    if (isset($conn['pass']) === true) {
    	$conn['password'] = $conn['pass'];
    }

    return $conn;
};

// The entityManager
$app['db'] = function () use($app) {
	$config = Setup::createAnnotationMetadataConfiguration(array(dirname(__FILE__) . '/App/Model'), true);
	return EntityManager::create($app['conn'], $config);
};

// The task controller
$app['taskControl'] = function () use($app) {
	return new TasksController($app);
};


// The Sympony Templete schema
$app['Templating'] = function () {
    $loader = new FilesystemLoader([dirname(__FILE__) . '/App/view/%name%']);
    $templateNameParser = new TemplateNameParser();
    
    return new PhpEngine($templateNameParser, $loader);
};


// ROTAS //

// Lista as tasks
$app->get('/tasks', function () use($app) {
	return $app['taskControl']->listar();
});


// View de uma task
$app->get('/tasks/{id}', function ($id) use($app) {
	return $app['taskControl']->findTask($id);
})->assert('id', '\d+');


// Insere nova task
$app->post('/tasks', function(Request $request) use ($app) {
	$dados = json_decode($request->getContent(), true);
	$id = $app['taskControl']->create($dados);
	
	$response = new Response('Tarefa inserida com sucesso!', 201);
	$response->headers->set('Location', "/tasks/{$id}");

	return $response;
});


// Edita uma Task
$app->put('/tasks/{id}', function(Request $request, $id) use ($app) {
	$dados = json_decode($request->getContent(), true);
	$dados = $app['taskControl']->update($id, $dados);
		
	return $app->json($dados, 200);
})->assert('id', '\d+');


// Deleta uma task
$app->delete('/tasks/{id}', function($id) use ($app) {
	$app['taskControl']->remove($id);
	
	return new Response(null, 204);
})->assert('id', '\d+');


