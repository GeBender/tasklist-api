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
namespace App\Controller;
use Buzz\Browser;

class AppController extends Controller
{

    public function home()
    {
    	$browser = new Browser();
    	$browser->getLastRequest();
    	$response = $browser->get($this->app['config']['apiAddress'].'/tasks');
		$tasks = $response->getContent();

    	$this->setVar('tasks', $tasks);
    	return $this->render('home.phtml');
    }
}
