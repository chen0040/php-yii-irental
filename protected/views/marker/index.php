<?php
$this->breadcrumbs=array(
	'Markers',
);

$this->menu=array(
	array('label'=>'Create Marker', 'url'=>array('create')),
	array('label'=>'Manage Marker', 'url'=>array('admin')),
);
?>

<h1>Markers</h1>

<?php
Yii::import('ext.gmaps.*');
 
$gMap = new EGMap();
$gMap->zoom = 10;
$mapTypeControlOptions = array(
  'position'=> EGMapControlPosition::LEFT_BOTTOM,
  'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
);
 
$gMap->mapTypeControlOptions= $mapTypeControlOptions;
 
$gMap->setCenter(1.3520830, 103.8198360);
$gMap->zoom = 16;
 
 $markers=$dataProvider->getData();
 if($markers)
 {
	$first=true;
	foreach($markers as $marker_data)
	{
		$info_window_a = new EGMapInfoWindow('
			<div class="tabs" style="width=400;height=400"><ul><li><a href="#tab1">General</a></li>

          <li><a href="#tab2" id="SV">Street View</a></li></ul>

          <div id="tab1">

			</div>

          <div id="tab2">
			</div>
	</div>
		');
		
		if($first)
		{
			$gMap->setCenter($marker_data->lat, $marker_data->lng);
			$first=false;
		}
		 
		$icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/gazstation.png");
		 
		$icon->setSize(32, 37);
		$icon->setAnchor(16, 16.5);
		$icon->setOrigin(0, 0);
		 
		// Create marker
		$marker = new EGMapMarkerWithLabel($marker_data->lat, $marker_data->lng, array('title' => 'Marker With Custom Image','icon'=>$icon));
		$marker->addHtmlInfoWindow($info_window_a);
		$gMap->addMarker($marker);
	}
	
	$info_window_b = new EGMapInfoWindow('Hey! I am a marker with label!');
	// Create marker with label
	$marker = new EGMapMarkerWithLabel(39.821089311812094, 2.90165944519042, array('title' => 'Marker With Label'));
	 
	$label_options = array(
	  'backgroundColor'=>'yellow',
	  'opacity'=>'0.75',
	  'width'=>'100px',
	  'color'=>'blue'
	);
	 
	/*
	// Two ways of setting options
	// ONE WAY:
	$marker_options = array(
	  'labelContent'=>'$9393K',
	  'labelStyle'=>$label_options,
	  'draggable'=>true,
	  // check the style ID 
	  // afterwards!!!
	  'labelClass'=>'labels',
	  'labelAnchor'=>new EGMapPoint(22,2),
	  'raiseOnDrag'=>true
	);
	 
	$marker->setOptions($marker_options);
	*/
	 
	// SECOND WAY:
	$marker->labelContent= '$425K';
	$marker->labelStyle=$label_options;
	$marker->draggable=true;
	$marker->labelClass='labels';
	$marker->raiseOnDrag= true;
	 
	$marker->setLabelAnchor(new EGMapPoint(22,0));
	 
	$marker->addHtmlInfoWindow($info_window_b);
	 
	$gMap->addMarker($marker);
}
 
// enabling marker clusterer just for fun
// to view it zoom-out the map
$gMap->enableMarkerClusterer(new EGMapMarkerClusterer());
 
$gMap->renderMap();
?>
<style type="text/css">
.labels {
   color: red;
   background-color: white;
   font-family: "Lucida Grande", "Arial", sans-serif;
   font-size: 10px;
   font-weight: bold;
   text-align: center;
   width: 40px;     
   border: 2px solid black;
   white-space: nowrap;
}
</style>

<a href="gmap/map3.htm" target="_blank">Full Screen View</a> <br />

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>