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

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

error_reporting(E_ALL);
ini_set('display_errors', true);

@header('Content-Type: text/html; charset=utf-8');
require dirname(__DIR__) . '/vendor/autoload.php';

$configDefault = App\Config::load();

$config = Setup::createAnnotationMetadataConfiguration(array(
    dirname(__FILE__) . '/Model'
), true);

$conn = parse_url($configDefault['db']);

$conn['driver'] = str_replace('pdo-mysql', 'pdo_mysql', $conn['scheme']);
$conn['dbname'] = substr($conn['path'], 1);
$conn['driverOptions'] = array(
    1002 => 'SET NAMES utf8'
);

(isset($conn['pass']) === true) ? $conn['password'] = $conn['pass'] : $conn['password'] = '';
$entityManager = EntityManager::create($conn, $config);

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
