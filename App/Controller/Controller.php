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

class Controller
{

	protected $app;
	protected $DAO;
	protected $vars = [];
	
	public function __construct($app)
	{
		$this->app = $app;
	}
	
	
	public function setVar($name, $value) 
	{
		$this->vars[$name] = $value;
	}
	
	
    public function render($view)
    {
    	return $this->app['Templating']->render($view, $this->vars);
    }
}
