<?php
use Migrations\AbstractMigration;

class CreatePosts extends AbstractMigration
{
	/**
	 * Migração para gerar a tabela de Posts
	 * @param void
	 * @return void
	 */
	public function change()
	{
		$table = $this->table('products');
		$table->addColumn('title', 'string', [
			'default' => null,
			'limit' => 64,
			'null' => false,
		]);
		$table->addColumn('description', 'string', [
			'default' => null,
			'limit' => 264,
			'null' => true,
		]);
		$table->addColumn('body', 'text', [
			'default' => null,
			'null' => false,
		]);
		$table->addColumn('info', 'json', [
			'default' => null,
			'null' => true,
		]);
		$table->addColumn('created', 'datetime', [
			'default' => null,
			'null' => false,
		]);
		$table->addColumn('modified', 'datetime', [
			'default' => null,
			'null' => false,
		]);
		$table->addColumn('deleted', 'datetime', [
			'default' => null,
			'null' => true,
		]);
		$table->create();
	}
}