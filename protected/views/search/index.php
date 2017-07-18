<style>
#sideContainer {
    list-style-type: none;
    padding: 0;
    margin: 0 10px 0 0;
    float: left;
    border: 1px solid #676767;
    background-color: #eee;
    overflow: auto;
  }
  #sideContainer li {
    font-size: 0.9em;
    border-bottom: 1px solid #aaa;
    padding: 5px;
  }
  #mapContainer {
    float: left;
    width: 500px;
    height: 400px;
  }
 </style>
</head>
<script>
// global marker counter
var n = 1;
function generateListElement( marker ){
    var ul = document.getElementById('sideContainer');
    var li = document.createElement('li');
    var aSel = document.createElement('a');
    aSel.href = 'javascript:void(0);';
    aSel.innerHTML = 'Search Marker #' + n++;
    aSel.onclick = function(){ google.maps.event.trigger(marker, 'click')};
    li.appendChild(aSel);
    ul.appendChild(li);
}
</script>

<?php

	
$this->breadcrumbs=array(
	'Search',
);

$this->menu=array(
	array('label'=>'Create Marker', 'url'=>array('create')),
	array('label'=>'Manage Marker', 'url'=>array('admin')),
);
?>

<h1>Markers</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm'); ?>
 
    <?php echo $form->errorSummary($model); ?> 
	
	<div class="row">
		<?php echo $form->labelEx($model,'keywords'); ?>
		<?php echo $form->textField($model,'keywords',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'keywords'); ?>
	</div>
	
	 <div class="row">
		<?php echo $form->labelEx($model,'debug_message'); ?>
		<?php echo $form->textArea($model,'debug_message',array('rows'=>6, 'cols'=>80)); ?>
		<?php echo $form->error($model,'debug_message'); ?>
	</div>
 
    <div class="row submit">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>
 
<?php $this->endWidget(); ?>
</div><!-- form -->

<br /><hr />
<h2><?php echo CHtml::encode('Map View') ?></h2>
<?php
Yii::import('ext.gmaps.*');
 
$gMap = new EGMap();
$gMap->zoom = 10;
$mapTypeControlOptions = array(
  'position'=> EGMapControlPosition::LEFT_BOTTOM,
  'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
);
 
$gMap->mapTypeControlOptions= $mapTypeControlOptions;
 

$gMap->zoom = 16;
$gMap->setWidth(600);
$gMap->setHeight(380);
$google_markers=array();
 
 $markers=$model->getSearchMarkers();
 $markerProvider=$model->getSearchMarkerProviderWithPageSize(3);
 $userProvider=$model->getSearchUserProviderWithPageSize(3);
 if($markers)
 {
	if(count($markers) != 0)
	{
		$gMap->setCenter($markers[0]->lat, $markers[0]->lng);
	}
	else
	{
		$gMap->setCenter(1.3520830, 103.8198360);
	}
	foreach($markers as $marker)
	{
		// Create GMapInfoWindows
		$info_window_a = new EGMapInfoWindow('
			<div class=\'tabs\'><ul><li><a href=\'#tab1\'>General</a></li>

          <li><a href=\'#tab2\' id="SV">Street View</a></li></ul>

          <div id=\'tab1\'>
Hello
			</div>

          <div id=\'tab2\'>
		  Hello
			</div>
	</div>
		');
		
		 
		$icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/gazstation.png");
		 
		$icon->setSize(32, 37);
		$icon->setAnchor(16, 16.5);
		$icon->setOrigin(0, 0);
		 
		// Create marker
		$google_marker = new EGMapMarker($marker->lat, $marker->lng, array('title' => 'Marker With Custom Image','icon'=>$icon));
		$google_marker->addHtmlInfoWindow($info_window_a);
		$google_markers[]=$google_marker;
		$gMap->addMarker($google_marker);
	}
}
 
// enabling marker clusterer just for fun
// to view it zoom-out the map
$gMap->enableMarkerClusterer(new EGMapMarkerClusterer());

$gMap->appendMapTo('#mapContainer');

$afterInit = array();
//
// loop through markers and
// call global function to generate
// the element that will hold the
// callback trigger event
foreach($google_markers as $google_marker){
    $afterInit[] = 'generateListElement('.$google_marker->getJsName().');'.PHP_EOL;
}
// now render map and pass the afterInit code
$gMap->renderMap($afterInit);

?>


<!-- the side menu container -->
<ul id="sideContainer" style></ul>
<!-- we are going to render the map here -->
<div id="mapContainer"></div>

<br /><hr />
<h2><?php echo CHtml::encode('Markers matched') ?></h2>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$markerProvider,
	'itemView'=>'_view_marker',
)); ?>

<br /><hr />
<h2><?php echo CHtml::encode('Users matched') ?></h2>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$userProvider,
	'itemView'=>'_view_user',
)); ?>