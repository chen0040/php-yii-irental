<?php

/**
 * This is the model class for table "irtbl_user".
 *
 * The followings are the available columns in table 'irtbl_user':
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $firstname
 * @property string $lastname
 * @property string $description
 * @property string $addressline1
 * @property string $addressline2
 * @property string $addressline3
 * @property string $addressline4
 * @property string $url
 * @property string $last_login_time
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 * @property string $UUID
 * @property string $phone
 * @property string $mobile
 *
 * The followings are the available model relations:
 * @property Feature[] $features
 * @property FeatureFeatureTag[] $featureFeatureTags
 * @property Marker[] $markers
 * @property MarkerFeatureTag[] $markerFeatureTags
 * @property MarkerMarkerTag[] $markerMarkerTags
 * @property Tag[] $tags
 * @property UserFeatureTag[] $userFeatureTags
 * @property UserMarkerTag[] $userMarkerTags
 * @property UserUserTag[] $userUserTags
 */
class User extends IrActiveRecord
{
	public $password_repeat;

	
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'irtbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, phone', 'required'),
			//array('create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('email, username, password', 'length', 'max'=>256),
			array('firstname, lastname, addressline1, addressline2, addressline3, addressline4, url', 'length', 'max'=>128),
			array('description', 'length', 'max'=>2000),
			//array('last_login_time, create_time, update_time', 'safe'),
			array('password', 'compare'),
			array('password_repeat', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, username, password, firstname, lastname, description, addressline1, addressline2, addressline3, addressline4, url, phone, mobile', 'safe', 'on'=>'search'),
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
			'features' => array(self::HAS_MANY, 'Feature', 'update_user_id'),
			'featureFeatureTags' => array(self::HAS_MANY, 'FeatureFeatureTag', 'update_user_id'),
			'markers' => array(self::HAS_MANY, 'Marker', 'update_user_id'),
			'markerFeatureTags' => array(self::HAS_MANY, 'MarkerFeatureTag', 'update_user_id'),
			'markerMarkerTags' => array(self::HAS_MANY, 'MarkerMarkerTag', 'update_user_id'),
			'tags' => array(self::HAS_MANY, 'Tag', 'update_user_id'),
			'userFeatureTags' => array(self::HAS_MANY, 'UserFeatureTag', 'user_id'),
			'userMarkerTags' => array(self::HAS_MANY, 'UserMarkerTag', 'user_id'),
			'userUserTags' => array(self::HAS_MANY, 'UserUserTag', 'user2_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'username' => 'Username',
			'password' => 'Password',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'description' => 'Description',
			'addressline1' => 'Addressline1',
			'addressline2' => 'Addressline2',
			'addressline3' => 'Addressline3',
			'addressline4' => 'Addressline4',
			'url' => 'Url',
			'last_login_time' => 'Last Login Time',
			'create_time' => 'Create Time',
			'create_user_id' => 'Create User',
			'update_time' => 'Update Time',
			'update_user_id' => 'Update User',
			'UUID' => 'UUID',
			'phone' => 'Telephone',
			'mobile' => 'Mobile No.',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('addressline1',$this->addressline1,true);
		$criteria->compare('addressline2',$this->addressline2,true);
		$criteria->compare('addressline3',$this->addressline3,true);
		$criteria->compare('addressline4',$this->addressline4,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);
		$criteria->compare('UUID', $this->UUID);
		$criteria->compare('phone', $this->phone);
		$criteria->compare('mobile', $this->mobile);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	/** 
	* perform one-way encryption on the password before we store it in the database 
	*/
	protected function afterValidate() 
	{
		parent::afterValidate(); 
		$this->password = $this->encrypt($this->password);
	} 
	
	public function encrypt($value) 
	{
		return md5($value);
	}
}