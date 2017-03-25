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

use App\DAO\TasksDAO;
use Task;
use Silex\Application;

class TasksController extends Controller
{

	/**
	 * @param Application $app
	 */
	public function __construct($app) 
	{
		parent::__construct($app);
		$this->DAO = new TasksDAO('Task', $app);
	}
	
	
    public function listar()
    {
    	$list = $this->DAO->getList();
    	foreach ($list as $k => $v) {
    		$list[$k] = $v->toArray();
    	}
    	
    	return json_encode($list);
    }
    
    
    /**
     * @param int $id
     * @return string
     */
    public function findTask($id)
    {
    	return json_encode($this->DAO->find($id)->toArray());
    }
 
    
    /**
     * @param array $dados
     * @return int
     */
    public function create($dados)
    {
    	$task = new Task();
    	$task->listen($dados);
    	
    	$newTask = $this->DAO->salvar($task);
    	return $newTask->id;
    }

    
    /**
     * @param int $id
     * @param array $dados
     * @return array
     */
    public function update($id, $dados)
    {
    	$task = $this->DAO->find($id);
    	$task->listen($dados);
    	
    	$this->DAO->salvar($task);
    	
    	return $task->toArray();
    }

    
    /**
     * @param int $id
     */
    public function remove($id)
    {
    	$task = $this->DAO->find($id);
    	$this->DAO->deletar($task);
    }
}
