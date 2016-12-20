<?php

 /* @property string $id
 /* @property string $user_id
 /* @property string $title
 /* @property string $content
 /* @property string $number_of_likes
 /* @property string $number_of_views
 /* @property integer $status
 /* @property integer $created_at
 /* @property integer $updated_at
 */
class Post extends CActiveRecord
 {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'post';
	}

	public function rules() {
		return array(
							array('user_id, title, content, number_of_likes, number_of_views', 'required'),
							array('status, created_at, updated_at', 'numerical', 'integerOnly'=>true),
							array('user_id, number_of_likes, number_of_views', 'length', 'max'=>11),
							array('title, content', 'length', 'max'=>255),
					);
	}

	public function relations() {
		return array(
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
		$model = new Post;
		$model->attributes = $attributes;
		$model->save();
		return $model;
	}
}