<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
// set your API key here
class HttpGeocoder
{
     // Hold an instance of the class
    private static $mInstance;
    private $mApiKey;

    // A private constructor; prevents direct creation of object
    private function __construct()
    {
        $localhost=true;
        //$this->mApiKey='ABQIAAAAjvAdx3uLvexI2G5bkYepahQwp-bsalx-QHFJ3KX5HEBgBZfTQBQPhQ5PgqIYfvMrIIcYqeBzemnG7w';
		$this->mApiKey='ABQIAAAAjvAdx3uLvexI2G5bkYepahQGDwfolOEAvUGmNN27MQhUpy2Y5RRUEzl5y_D0iijy_5MdB5A1wd7qXw';
        if(!$localhost)
        {
            $this->mApiKey='ABQIAAAAjvAdx3uLvexI2G5bkYepahQcPyf2dOLSRs_M3CZpYgJ3TGWiohQJqe8T6pV9a5fEsB3cWr-w6wk7sQ';
        }
    }

    // The singleton method
    public static function getSingleton()
    {
        if (!isset(self::$mInstance)) {
            $c = __CLASS__;
            self::$mInstance = new $c;
        }

        return self::$mInstance;
    }

    // Prevent users to clone the instance
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function getAddressDataFile($lat, $lng, $output)
    {
        // format this string with the appropriate latitude longitude
        $url = 'http://maps.google.com/maps/geo?q='.$lat.','.$lng.'&output='.$output.'&sensor=true';
        // make the HTTP request
        $data = @file_get_contents($url);
        return $data;
    }
	
	public function getLatLngDataFile($address, $output)
	{
		// format this string with the appropriate latitude longitude
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=true';
        // make the HTTP request
        $data = @file_get_contents($url);
        return $data;
	}

    public function getAddressJsonFile($lat, $lng)
    {
        $data=$this->getAddressDataFile($lat, $lng, 'json');
        return $data;
    }

    public function getAddressXmlFile($lat, $lng)
    {
        $data=$this->getAddressDataFile($lat, $lng, 'xml');
        return $data;
    }
    
    public function getAddressJsonData($lat, $lng)
    {
        $data=$this->getAddressJsonFile($lat, $lng);
        // parse the json response
        $jsondata = json_decode($data, true);

        // if we get a placemark array and the status was good, get the addres
        if(is_array($jsondata )&& $jsondata ['Status']['code']==200)
        {
              $addr = $jsondata ['Placemark'][0]['address'];
              return $addr;
        }
        
        return '';
    }
	
	public function getLatLngJsonFile($address)
    {
        $data=$this->getLatLngDataFile($address, 'json');
        return $data;
    }

    public function getLatLngXmlFile($address)
    {
        $data=$this->getLatLngDataFile($address, 'xml');
        return $data;
    }
    
    public function getLatLngJsonData($address)
    {
        $data=$this->getLatLngJsonFile($address);
        // parse the json response
        $jsondata = json_decode($data, true);

        // if we get a placemark array and the status was good, get the addres
        if(is_array($jsondata )&& $jsondata ['status']=='OK')
        {
			  $location=$jsondata['results'][0]['geometry']['location']; 
              $latlng = array(floatval($location['lat']), floatval($location['lng']));
              return $latlng;
        }
        
        return array(0, 0);
    }
}

?>
