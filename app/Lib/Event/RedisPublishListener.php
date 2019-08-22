<?php

App::uses('CakeEventListener', 'Event');
App::uses('CakeText', 'Utility');
App::uses('Predis', 'Vendor/predis/predis');

class RedisPublishListener implements CakeEventListener {

	/**
	 *
	 */
	private $redis;

	/**
	 * 	Inicia conecta e defini o Redis
	 * 	@return void
	 */
	protected function __construct()
	{
		$redis = new \Redis();
		$this->redis = $redis->connect('redis', 6379);
	}

	/**
	 *	Recebe os dados que foram emitidos para o evento
	 * 	@return array
	 */
	public function implementedEvents()
	{

		return [
			'*.Notificacao' => 'redisNotificacoes',
			'*.Processos' 	=> 'redisProcessos',
		];
	}

	/**
	 *	Gera um padrão de notificação que será enviado via PUB/SUB do redis e processado pelo node.js
	 *	@param CakeEvent $event
	 *	@return array notificação
	 */
	public function redisNotificacoes(CakeEvent $event)
	{
		$data = [
			'toRoom'	=> (string) (!empty($event->toRoom))?$event->toRoom:null,
			'event'		=> (string) (!empty($event->name))?$event->name:'default',
			'url'		=> (string) (!empty($event->url))?$event->url:'http://cakephp.localhost/blog',
			'body'		=> (array) (!empty($event->body))?$event->body:[],
		];

		$this->redis->publish('notificacoes', json_encode($data));
		return $data;
	}

	/**
	 *	Gera um padrão de processos, onde os dados serão salvos no Redis e via PUB/SUB executar o evento para processar os dados através do NODE.js e exibir nas views
	 *	@param CakeEvent $event
	 *	@return - notificação de processos
	 */
	public function redisProcessos(CakeEvent $event)
	{
		$path = (string) CakeText::uuid();
		$bodyJson = (is_array($event->body) || is_object($event->body))?json_encode($event->body):$event->body;

		$data = [
			'toRoom'	=> (string) (!empty($event->toRoom))?$event->toRoom:null,
			'event'		=> (string) (!empty($event->name))?$event->name:'default',
			'action'	=> (string) (!empty($event->url))?$event->url:'http://cakephp.localhost/blog',
			'path'		=> $path,
		];

		$this->redis->set($path, $bodyJson);
		$this->redis->publish('processos', json_encode($data));
		return $data;
	}
}