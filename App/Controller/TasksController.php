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

class TasksController extends Controller
{

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
    
    public function findTask($id)
    {
    	return json_encode($this->DAO->find($id)->toArray());
    }
    
    public function create($dados)
    {
    	$task = new Task();
    	$task->listen($dados);
    	
    	$newTask = $this->DAO->salvar($task);
    	return $newTask->id;
    }

    public function update($id, $dados)
    {
    	$task = $this->DAO->find($id);
    	$task->listen($dados);
    	
    	$this->DAO->salvar($task);
    	
    	return $task->toArray();
    }
    
    public function remove($id)
    {
    	$task = $this->DAO->find($id);
    	$this->DAO->deletar($task);
    	
    	return true;
    }
}
