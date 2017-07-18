<?php

/**
 * This is the model class for table "irtbl_user_marker_tag".
 *
 * The followings are the available columns in table 'irtbl_user_marker_tag':
 * @property integer $id
 * @property string $tag_id
 * @property integer $user_id
 * @property integer $marker_id
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property Tag $tag
 * @property User $createUser
 * @property Marker $marker
 * @property User $updateUser
 * @property User $user
 */
class UserMarkerTag extends IrActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserMarkerTag the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'irtbl_user_marker_tag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, marker_id, create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('tag_id', 'length', 'max'=>128),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tag_id, user_id, marker_id, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tag' => array(self::BELONGS_TO, 'Tag', 'tag_id'),
			'createUser' => array(self::BELONGS_TO, 'User', 'create_user_id'),
			'marker' => array(self::BELONGS_TO, 'Marker', 'marker_id'),
			'updateUser' => array(self::BELONGS_TO, 'User', 'update_user_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tag_id' => 'Tag',
			'user_id' => 'User',
			'marker_id' => 'Marker',
			'create_time' => 'Create Time',
			'create_user_id' => 'Create User',
			'update_time' => 'Update Time',
			'update_user_id' => 'Update User',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('tag_id',$this->tag_id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('marker_id',$this->marker_id);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}