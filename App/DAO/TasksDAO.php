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

class TasksDAO extends DAO
{

	public function getList()
	{
		return $this->EntityRepository->findBy([], ['ordem' => 'ASC']);
	}

	public function find($id)
	{
		return $this->EntityRepository->find($id);
	}
	
	public function salvar($task)
	{
		$task = $this->db->merge($task);
		$this->db->flush();
		
		return $task;
	}

	public function deletar($model)
	{
		var_dump('DELETE FROM Task t WHERE t.id = '.$model->id);
		$this->db->createQuery('DELETE FROM Task t WHERE t.id = '.$model->id)->execute();//->setParameter('taskId', $model->id)
	}
}
