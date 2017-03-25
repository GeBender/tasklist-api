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


/**
 * @Entity
 * @Table(name="tasks")
 */
class Task extends Model
{

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;

    /** @Column(type="integer") */
    protected $ordem;

    /** @Column(type="string") */
   	protected $titulo;
    
    /** @Column(type="text") */
    protected $task;
    
    /** @Column(type="date", name="data_cadastro") */
    protected $cadastro;

    /** @Column(type="date", name="data_prazo") */
    protected $prazo;

    /** @Column(type="date", name="data_edicao", nullable=true) */
    protected $edicao;
    
    /** @Column(type="date", name="data_remocao", nullable=true) */
    protected $remocao;

    /** @Column(type="date", name="data_conclusao", nullable=true) */
    protected $conclusao;

    /** @Column(type="string") */
    protected $status;
    
    const NAO_INICIADA = 'Não iniciada';
    const EM_ANDAMENTO = 'Em andamento';
    const CONCLUIDA = 'Concluida';
    const REMOVIDA = 'Removida';
    
    public function __construct()
    {
    	$this->order = 1;
    	$this->cadastro = new \DateTime('now');
    	$this->status = self::NAO_INICIADA;
    }
    
    public function listen($dados)
    {
    	if (isset($dados['id'])) {
    		$this->id = $dados['id'];
    	}
    	
    	if (isset($dados['ordem'])) {
    		$this->ordem = $dados['ordem'];
    	}
    	
    	if (isset($dados['titulo'])) {
	    	$this->titulo = $dados['titulo'];
    	}

    	if (isset($dados['task'])) {
    		$this->task = $dados['task'];
    	}
    	
    	if (isset($dados['cadastro'])) {
	    	$this->cadastro = new \DateTime($dados['cadastro']);
    	}
    	
    	if (isset($dados['prazo'])) {
    		$this->prazo = new \DateTime($dados['prazo']);
    	}
    	
    	if (isset($dados['edicao'])) {
    		$this->edicao = new \DateTime($dados['edicao']);
    	}
    	
    	if (isset($dados['remocao'])) {
    		$this->remocao = new \DateTime($dados['remocao']);
    	}
    	
    	if (isset($dados['conclusao'])) {
    		$this->conclusao = new \DateTime($dados['conclusao']);
    	}
    	
    	if (isset($dados['status'])) {
    		$this->status = $dados['status'];
	    }
    }
    
    public function toArray() {
    	return [
    			'id' => $this->id,
    			'ordem' => $this->ordem,
    			'titulo' => $this->titulo,
    			'task' => $this->task,
    			'cadastro' => $this->cadastro,
    			'prazo' => $this->prazo,
    			'edicao' => $this->edicao,
    			'remocao' => $this->remocao,
    			'conclusao' => $this->conclusao,
    			'status' => $this->status
    	];
    }
}