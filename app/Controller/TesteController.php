<?php

App::uses('Controller', 'Controller');

class TesteController extends Controller {

	public function index()
	{
		return 1;
	}

	public function teste()
	{
		$senhas = (array) $this->query("SELECT info->>'$.lastFivePassword' FROM blog.users WHERE 'uuid' = ".$this->data[$this->uuid]);
		//Verifico se entre as ultimas 5 alguma é igual, caso positivo retorno falso
		foreach ($senhas as $key => $senha){
			if($senha[$key]['pass'] == $check['password_update']){
				return false;
			}
		}

		//verifico se contém 5 senhas e caso seja verdadeiro apago a última
		if(count($senhas) == 5){
			$senhas = array_pop($senhas);
		}

		//insiro no inicio a nova senha
		$senhas = (array) array_unshift($senhas, ['pass' => $check['password_update'], 'created' => gmdate('Y-m-d H:i:s')]);

		//salvo no BD
		return $this->atualizarJson('users', 'info', ["uuid" => $this->data[$this->uuid]], '$.lastFivePassword', $senhas);
	}
}