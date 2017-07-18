<?php

/**
 * This is the model class for table "irtbl_tag".
 *
 * The followings are the available columns in table 'irtbl_tag':
 * @property string $id
 * @property string $description
 * @property string $data_type
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 * @property string $UUID
 *
 * The followings are the available model relations:
 * @property FeatureFeatureTag[] $featureFeatureTags
 * @property MarkerFeatureTag[] $markerFeatureTags
 * @property MarkerMarkerTag[] $markerMarkerTags
 * @property User $createUser
 * @property User $updateUser
 * @property UserFeatureTag[] $userFeatureTags
 * @property UserMarkerTag[] $userMarkerTags
 * @property UserUserTag[] $userUserTags
 */
class Tag extends IrActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Tag the static model class
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
		return 'irtbl_tag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('id, data_type', 'length', 'max'=>128),
			array('description', 'length', 'max'=>2000),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, description, data_type, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
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
			'featureFeatureTags' => array(self::HAS_MANY, 'FeatureFeatureTag', 'tag_id'),
			'markerFeatureTags' => array(self::HAS_MANY, 'MarkerFeatureTag', 'tag_id'),
			'markerMarkerTags' => array(self::HAS_MANY, 'MarkerMarkerTag', 'tag_id'),
			'createUser' => array(self::BELONGS_TO, 'User', 'create_user_id'),
			'updateUser' => array(self::BELONGS_TO, 'User', 'update_user_id'),
			'userFeatureTags' => array(self::HAS_MANY, 'UserFeatureTag', 'tag_id'),
			'userMarkerTags' => array(self::HAS_MANY, 'UserMarkerTag', 'tag_id'),
			'userUserTags' => array(self::HAS_MANY, 'UserUserTag', 'tag_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'description' => 'Description',
			'data_type' => 'Data Type',
			'create_time' => 'Create Time',
			'create_user_id' => 'Create User',
			'update_time' => 'Update Time',
			'update_user_id' => 'Update User',
			'UUID' => 'UUID',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('data_type',$this->data_type,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);
		$criteria->compare('UUID', $this->UUID);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}