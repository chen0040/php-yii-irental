<?php

class SearchForm extends CFormModel
{
    public $keywords;
	public $solr_results;
	public $debug_message;
	public $marker_id_array;
	public $user_id_array;
	
	public function attributeLabels() {
		return array(
			'keywords'=>'Search',
			'debug_message'=>'Debug',
			'solr_results'=>'Solr Results'
		);
	}
	
	public function doSearch($start=0, $rows=10)
	{
		$this->debug_message='';
		if(isset($this->keywords) && $this->keywords != '')
		{
			$this->solr_results = Yii::app()->CURL->run('http://155.69.147.66:8082/solr1config/select/?q='.urlencode($this->keywords).'&version=2.2&start='.$start.'&rows='.$rows.'&indent=on');
			$this->marker_id_array=array();
			$this->user_id_array=array();
			$xmldoc = new DOMDocument();
			$xmldoc->loadXML($this->solr_results);
			$docs = $xmldoc->getElementsByTagName( "doc" );
			foreach($docs as $doc)
			{
				$str_elements = $doc->getElementsByTagName( "str" );
				foreach($str_elements as $str_element)
				{
					$str_name=$str_element->getAttribute('name');
					if(isset($str_name))
					{
						if($str_name=='marker_id')
						{
							$marker_id=$str_element->nodeValue;
							$this->marker_id_array[]=$marker_id;
							$this->debug_message.=('marker:'.$marker_id)."\n";
						}
						else if($str_name=='user_id')
						{
							$user_id=$str_element->nodeValue;
							$this->user_id_array[]=$user_id;
							$this->debug_message.=('user:'.$user_id)."\n";
						}
					}
				}
			}
		}
		
		
	}
	
	public function rules()
    {
        return array(
            array('keywords', 'required'),
        );
    }
	
	public function getSearchMarkers()
	{
		$dataProvider=$this->getSearchMarkerProvider();
		if(isset($dataProvider))
		{
			return $dataProvider->getData();
		}
		return null;
	}
	
	public function getSearchMarkerProvider()
	{
		$dataProvider=new CActiveDataProvider
		(
		'Marker',
		 array( 
			)
		);
		
		$criteria=new CDbCriteria();
		if(isset($this->marker_id_array) && count($this->marker_id_array) != 0)
		{
			foreach($this->marker_id_array as $marker_id)
			{
				$criteria->addCondition('id='.$marker_id, 'OR');
			}
		}
		else
		{
			$criteria->addCondition('id=-1', 'AND');
		}
		$dataProvider->criteria=$criteria;
		
		return $dataProvider;
	}
	
	public function getSearchUserProvider()
	{
		$dataProvider=new CActiveDataProvider
		(
		'User',
		 array( 
			)
		);
		
		$criteria=new CDbCriteria();
		if(isset($this->user_id_array) && count($this->user_id_array) != 0)
		{
			foreach($this->user_id_array as $user_id)
			{
				$criteria->addCondition('id='.$user_id, 'OR');
			}
		}
		else
		{
			$criteria->addCondition('id=-1', 'AND');
		}
		$dataProvider->criteria=$criteria;
		
		return $dataProvider;
	}
	
	public function getSearchUserProviderWithPageSize($pagesize)
	{
		$dataProvider=new CActiveDataProvider
		(
		'User',
		 array( 
				'pagination'=>array( 
					'pageSize'=>$pagesize,
				), 
			)
		);
		
		$criteria=new CDbCriteria();
		if(isset($this->user_id_array) && count($this->user_id_array) != 0)
		{
			foreach($this->user_id_array as $user_id)
			{
				$criteria->addCondition('id='.$user_id, 'OR');
			}
		}
		else
		{
			$criteria->addCondition('id=-1', 'AND');
		}
		$dataProvider->criteria=$criteria;
		
		return $dataProvider;
	}
	
	public function getSearchMarkerProviderWithPageSize($pagesize)
	{
		$dataProvider=new CActiveDataProvider
		(
		'Marker',
		 array( 
				'pagination'=>array( 
					'pageSize'=>$pagesize,
				), 
			)
		);
		
		$criteria=new CDbCriteria();
		if(isset($this->marker_id_array) && count($this->marker_id_array) != 0)
		{
			foreach($this->marker_id_array as $marker_id)
			{
				$criteria->addCondition('id='.$marker_id, 'OR');
			}
		}
		else
		{
			$criteria->addCondition('id=-1', 'AND');
		}
		$dataProvider->criteria=$criteria;
		
		return $dataProvider;
	}
}

?>
