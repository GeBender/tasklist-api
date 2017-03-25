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
namespace App\DAO;

class DAO
{

	protected $app;
	
	protected $EntityRepository;
	
	protected $db;
	
	
	public function __construct($model, $app)
	{
		$this->app = $app;
		$this->db = $this->app['db'];
		$this->EntityRepository = $this->app['db']->getRepository($model);
	}
	
}
