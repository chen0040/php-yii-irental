<?php
Yii::import('ext.geocoders.*');

/**
 * This is the model class for table "irtbl_marker".
 *
 * The followings are the available columns in table 'irtbl_marker':
 * @property integer $id
 * @property string $description
 * @property string $name
 * @property string $address
 * @property double $lat
 * @property double $lng
 * @property string $data_type
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 * @property string $UUID
 *
 * The followings are the available model relations:
 * @property User $createUser
 * @property User $updateUser
 * @property MarkerFeatureTag[] $markerFeatureTags
 * @property MarkerMarkerTag[] $markerMarkerTags
 * @property UserMarkerTag[] $userMarkerTags
 */
class Marker extends IrActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Marker the static model class
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
		return 'irtbl_marker';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('address, lat, lng, price, is_available', 'required'),
			array('create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('lat, lng, price, age', 'numerical'),
			array('name', 'length', 'max'=>60),
			array('address', 'length', 'max'=>512),
			array('data_type', 'length', 'max'=>128),
			array('description, create_time, update_time, image_link1, image_link2, image_link3, image_link4, video_link', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, description, name, address, lat, lng, data_type, create_time, create_user_id, update_time, update_user_id, price, age, is_available, image_link1, image_link2, image_link3, image_link4, video_link', 'safe', 'on'=>'search'),
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
			'createUser' => array(self::BELONGS_TO, 'User', 'create_user_id'),
			'updateUser' => array(self::BELONGS_TO, 'User', 'update_user_id'),
			'markerFeatureTags' => array(self::HAS_MANY, 'MarkerFeatureTag', 'marker_id'),
			'markerMarkerTags' => array(self::HAS_MANY, 'MarkerMarkerTag', 'marker1_id'),
			'userMarkerTags' => array(self::HAS_MANY, 'UserMarkerTag', 'marker_id'),
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
			'name' => 'Name',
			'address' => 'Address',
			'lat' => 'Lat',
			'lng' => 'Lng',
			'data_type' => 'Property For',
			'create_time' => 'Post On',
			'create_user_id' => 'Post By',
			'update_time' => 'Updated On',
			'update_user_id' => 'Update User',
			'image_link1' => 'Image Link 1',
			'image_link2' => 'Image Link 2',
			'image_link3' => 'Image Link 3',
			'image_link4' => 'Image Link 4',
			'video_link' => 'Video Link',
			'UUID' => 'UUID',
			'price' => 'Price',
			'age' => 'Year',
			'is_available' => 'Is Available Now',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('lng',$this->lng);
		$criteria->compare('image_link1',$this->image_link1);
		$criteria->compare('image_link2',$this->image_link2);
		$criteria->compare('image_link3',$this->image_link3);
		$criteria->compare('image_link4',$this->image_link4);
		$criteria->compare('video_link',$this->video_link);
		$criteria->compare('data_type',$this->data_type,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);
		$criteria->compare('UUID', $this->UUID);
		$criteria->compare('price', $this->price);
		$criteria->compare('is_available', $this->is_available);
		$criteria->compare('age', $this->age);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchNearbyMarkers($orig_lat, $orig_lng, $radius)
	{
		$query='select * from irtbl_marker';
		$query.='set @orig_lat='.$orig_lat.';';
		//$query.='set @orig_lng='.$orig_lng.';';
		//$query.='set @max_distance='.$radius.';';
		//$query.='set @lng1=@orig_lng-@max_distance/abs(cos(radians(@orig_lat)) * 69);';
		//$query.='set @lng2=@orig_lng+@max_distance/abs(cos(radians(@orig_lat)) * 69);';
		//$query.='set @lat1=@orig_lat-(@max_distance/69);';
		//$query.='set @lat2=@orig_lat+(@max_distance/69);';
		//$query.='SELECT *, 3956*2*ASIN(SQRT(POWER(SIN((:orig_lat - abs(irtbl_marker.lat)) * pi() / 180 /2), 2) + COS(:orig_lat * pi()/180) * COS(abs(irtbl_marker.lat)*pi()/180) * POWER(SIN((:orig_lng - irtbl_marker.lng)*pi()/180/2), 2)))  FROM '.$this->tableName().' where lng between @lng1 and @lng2 and lat between @lat1 and @lat2 ORDER limit 10;';
		
		$lng1=$orig_lng-$radius/abs(cos(deg2rad($orig_lat)) * 69);
		$lng2=$orig_lng+$radius/abs(cos(deg2rad($orig_lat)) * 69);
		$lat1=$orig_lat-($radius/69);
		$lat2=$orig_lat+($radius/69);
		
		$cmd = Yii::app()->db->createCommand();
		$cmd->select('irtbl_marker.lat, irtbl_marker.lng, irtbl_marker.lng as distance', array(':orig_lat'=>$orig_lat));
		$cmd->from('irtbl_marker');
		$cmd->where('lng between :lng1 and :lng2 and lat between :lat1 and :lat2', array(':lng1'=>$lng1, ':lng2'=>$lng2, ':lat1'=>$lat1, ':lat2'=>$lat2));
		
		
		return $cmd->queryAll();
	}
	
	/** 
	* perform one-way encryption on the password before we store it in the database 
	*/
	protected function beforeValidate() 
	{
		if(!isset($this->lat) || ($this->lat==0 && $this->lng==0))
		{
			$geo=HttpGeocoder::getSingleton();
			$coordinates=$geo->getLatLngJsonData($this->address);
			$this->lat=$coordinates[0];
			$this->lng=$coordinates[1];
		}
		
		return parent::beforeValidate(); 
	} 
}