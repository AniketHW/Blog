<?php

class m161219_104437_like extends CDbMigration
{ 
	public function safeUp() {
		$this->createTable(
			'like',
			array(
				'id'=>'int(11) UNSIGNED NOT NULL AUTO_INCREMENT',
				'user_id'=>'int(11) UNSIGNED NOT NULL',
				'blogpost_id'=>'int(11) UNSIGNED NOT NULL',
				'status' => 'TINYINT(1)',
				'time' => 'int(11)',
				'PRIMARY KEY (id)',
			),
			'ENGINE=InnoDB'
		);
	}

	public function safeDown() {
		$this->dropTable('like');

	}
}
