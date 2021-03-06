<?php

 /* @property string $id
 /* @property string $user_id
 /* @property string $title
 /* @property string $content
 /* @property integer $numberOfLikes
 /* @property integer $numberOfComments
 /* @property integer $status
 /* @property integer $created_at
 /* @property integer $updated_at
 */
class Blogpost extends CActiveRecord
 {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'blogpost';
	}

	public function rules() {
		return array(
							array('user_id, title, content, numberOfLikes, numberOfComments', 'required'),
							array('numberOfLikes, numberOfComments, status, created_at, updated_at', 'numerical', 'integerOnly'=>true),
							array('user_id', 'length', 'max'=>11),
							array('title, content', 'length', 'max'=>255),
					);
	}

	public function relations() {
		return array(
			'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
			'comments'=>array(self::HAS_MANY, 'Comment', 'blogpost_id'),
			'likes'=>array(self::HAS_MANY, 'Like', 'blogpost_id'),
		);
	}

	public function beforeSave() {
		if($this->isNewRecord) { 
			$this->created_at = time();
		}
		$this->updated_at = time();
		return parent::beforeSave();
	}

	public function updateColumns($column_value_array) {
		$column_value_array['updated_at'] = time();
		foreach($column_value_array as $column_name => $column_value)
			$this->$column_name = $column_value;
		$this->update(array_keys($column_value_array));
	}

	public static function create($attributes) {
		$model = new Blogpost;
		$model->attributes = $attributes;
		$model->save();
		return $model;
	}
}