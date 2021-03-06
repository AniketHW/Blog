<?php

 /* @property string $id
 /* @property string $user_id
 /* @property string $blogpost_id
 /* @property integer $status
 /* @property integer $time
 */
class Like extends CActiveRecord
 {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'like';
	}

	public function rules() {
		return array(
							array('user_id, blogpost_id', 'required'),
							array('status, time', 'numerical', 'integerOnly'=>true),
							array('user_id, blogpost_id', 'length', 'max'=>11),
					);
	}

	public function relations() {
		return array(
			'blogpost'=>array(self::BELONGS_TO, 'Blogpost', 'blogpost_id'),
			'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/*public function beforeSave() {
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
	*/

	public static function create($attributes) {
		$model = new Like;
		$model->attributes = $attributes;
		$model->save();
		return $model;
	}
}