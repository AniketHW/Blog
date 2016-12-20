<?php

class m161219_102709_post extends CDbMigration {

	public function safeUp() {
		$this->createTable(
			'blogpost',
			array(
				'id'=>'int(11) UNSIGNED NOT NULL AUTO_INCREMENT',
				'user_id'=>'int(11) UNSIGNED NOT NULL',
				'title' => 'varchar(255) NOT NULL',
				'content' => 'varchar(255) NOT NULL',
				'numberOfLikes' => 'int(11) NOT NULL',
				'numberOfComments' => 'int(11) NOT NULL',
				'status' => 'TINYINT(1)',
				'created_at' => 'int(11)',
				'updated_at' => 'int(11)',
				'PRIMARY KEY (id)',
			),
			'ENGINE=InnoDB'
		);
	}

	public function safeDown() {
		$this->dropTable('blogpost');

	}
}
