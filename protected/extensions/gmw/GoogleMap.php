<?php
class GoogleMap {
    //put your code here
    protected $mTitle;
    protected $mContent;
    protected $mImg;
    protected $mKey;
    private $mSidebarWidth;
	private $width;
	private $height;
    private $mId;
	
    public function __construct($id)
    {
        $this->mId=$id;
	$this->mKey='ABQIAAAAjvAdx3uLvexI2G5bkYepahQwp-bsalx-QHFJ3KX5HEBgBZfTQBQPhQ5PgqIYfvMrIIcYqeBzemnG7w'; //'ABQIAAAAjvAdx3uLvexI2G5bkYepahQGDwfolOEAvUGmNN27MQhUpy2Y5RRUEzl5y_D0iijy_5MdB5A1wd7qXw';
        $this->mImg='';

        //$this->addCSS("jscrollpane/jquery.jscrollpane.css");        
        //$this->addScript("jscrollpane/jquery.mousewheel.js");
        //$this->addScript("jscrollpane/jquery.jscrollpane.min.js");
		//$this->addScript("jquery/jquery.corner.js");
        //$this->addScript("http://www.google.com/jsapi?key=".$this->mKey);

        //$this->addScript("jquery/jquery.addthis.js");
		
		

        if(isset($_GET['width']) && isset($_GET['height']))
        {
            $this->setWidth($_GET['width']);
            $this->setHeight($height=$_GET['height']);
        }
        else
        {
            $this->setWidth(600);
            $this->setHeight(600);
            $this->setSidebarWidth(300);
        }
    }
	
	public function setWidth($_width)
	{
		$this->width=$_width;
	}
	
	public function setHeight($_height)
	{
		$this->height=$_height;
	}
	
	public function getWidth()
	{
		return $this->width;
	}
	
	public function getHeight()
	{
		return $this->height;
	}

    public function setSidebarWidth($width)
    {
        $this->mSidebarWidth=$width;
    }

    public function getSidebarWidth()
    {
        return $this->mSidebarWidth;
    }

    public function setTitle($title)
    {
        $this->mTitle=$title;
    }

    public function setUrl($filename)
    {
        $this->mContent='';
        if(file_exists($filename))
        {
            $file_handle = fopen($filename, "r");
            while (!feof($file_handle)) {
               $line = fgets($file_handle);
               $this->mContent.= $line;
            }
            fclose($file_handle);
        }
    }

    public function render_header()
    {
        echo '
		<script type="text/javascript">
       
        // ====== Array for decoding the failure codes ======
        var reasons=[];
        var '.$this->mId.'_map;
        var '.$this->mId.'_geo;
        var gmarkers = [];
        var gxml_markers = [];
        var gmarker_counter = 0;
        var customIcons = [];
        // === create the context menu div ===
        var '.$this->mId.'_contextmenu;

        function createMarkerTabs(xml_marker)
        {
            var point = new GLatLng(parseFloat(xml_marker.getAttribute("lat")),
                           parseFloat(xml_marker.getAttribute("lng")));
            var description = xml_marker.getAttribute("description");
            var addressline1 = xml_marker.getAttribute("addressline1");
            var addressline2 = xml_marker.getAttribute("addressline2");
            var addressline3 = xml_marker.getAttribute("addressline3");
            var addressline4 = xml_marker.getAttribute("addressline4");
            var price=xml_marker.getAttribute("price");
            var last_updated=xml_marker.getAttribute("last_updated");
            var type = xml_marker.getAttribute("type");
            var region=xml_marker.getAttribute("region");
            var id=xml_marker.getAttribute("id");

            var contactname=xml_marker.getAttribute("contactname");
            var contactphone1=xml_marker.getAttribute("contactphone1");
            var contactphone2=xml_marker.getAttribute("contactphone2");
            var contactemail=xml_marker.getAttribute("contactemail");

            var pic1=xml_marker.getAttribute("pic1");
            var pic2=xml_marker.getAttribute("pic2");
            var pic3=xml_marker.getAttribute("pic3");
            var pic4=xml_marker.getAttribute("pic4");

            if(pic1=="") pic1="images/default.png";
            if(pic2=="") pic2="images/default.png";
            if(pic3=="") pic3="images/default.png";
            if(pic4=="") pic4="images/default.png";

            var tabs = [];
            var tab_count=5;
            var htmls = \'<div style="width:\'+tab_count*88+\'px">\';
            htmls += ("<b>" + description + "</b> <br/>");
            htmls += "<hr />";
            htmls += (addressline1 + "<br />");
            htmls += (addressline2 + "<br />");
            htmls += (addressline3 + "<br />");
            htmls += (addressline4);
            htmls += "<hr />";
            htmls += ("<b>Type: </b>"+type+"<br />");
            htmls += ("<b>Region: </b>"+region+"<br />");
            htmls += ("<b>Last Updated: </b>"+last_updated+"<br />");
            htmls += ("<b>Price: $</b>"+price);
            htmls += (\'<\/div>\');
            tabs.push(new GInfoWindowTab("Household",htmls));

            htmls = ("<b>Name: </b>" + contactname+"<br />");
            htmls += ("<b>Phone1: </b>" + contactphone1+"<br />");
            htmls += ("<b>Phone2: </b>" + contactphone2+"<br />");
            htmls += ("<b>Email: </b><a href=\'mailto:" + contactemail+"?subject=rental\'>"+contactemail+"</a><br />");
            tabs.push(new GInfoWindowTab("Contact",htmls));

            htmls = ("<table>");
            htmls += ("<tr>");
            htmls += ("<td><img src=\'"+pic1+"\' border=\'0\'/></td>");
            htmls += ("<td><img src=\'"+pic2+"\' border=\'0\'/></td>");
            htmls += ("</tr><tr>");
            htmls += ("<td><img src=\'"+pic3+"\' border=\'0\'/></td>");
            htmls += ("<td><img src=\'"+pic4+"\' border=\'0\'/></td>");
            htmls += ("</tr>");
            htmls += ("</table>");
            tabs.push(new GInfoWindowTab("Photos",htmls));

            htmls = ("<b>Commands: </b>");
            htmls += ("<ul>");
            htmls += (\'<li><a href="javascript:delete_click(\' + id + \')">delete</a></li>\');
            htmls += (\'<li><a href="javascript:detail_click(\' + id + \')">details</a></li>\');
            htmls += ("</ul>");
            tabs.push(new GInfoWindowTab("Actions",htmls));

            return tabs;
        }

        function detail_click(_id)
        {
            window.location.href = "marker_detail.php?id="+_id;
        }

        function delete_click(_id)
        {
            $.post("phpsqlajax_delrec.php",
            {
              id : _id
            },
           function(data){
             alert(data.name);

             clearMarkers();
             loadMarkers();

           }, "json");
        }

        function reCenter()
        {
            var search=$("#txtGoTo").val();

            if(search=="")
            {
                alert("Please enter your address first");
                return;
            }

            // ====== Perform the Geocoding ======
            '.$this->mId.'_geo.getLocations(search, function (result)
            {
                // If that was successful
                if (result.Status.code == G_GEO_SUCCESS)
                {
                  if(result.Placemark.length == 0)
                  {
                    return;
                  }

                  // Loop through the results, placing markers
                  for (var i=0; i<result.Placemark.length; i++) {
                    var p = result.Placemark[i].Point.coordinates;
                    var marker = new GMarker(new GLatLng(p[1],p[0]));
                  }

                  // centre the map on the first result
                  var p = result.Placemark[0].Point.coordinates;
                  // ===== Look for the bounding box of the first result =====
                  var N = result.Placemark[0].ExtendedData.LatLonBox.north;
                  var S = result.Placemark[0].ExtendedData.LatLonBox.south;
                  var E = result.Placemark[0].ExtendedData.LatLonBox.east;
                  var W = result.Placemark[0].ExtendedData.LatLonBox.west;
                  var bounds = new GLatLngBounds(new GLatLng(S,W), new GLatLng(N,E));
                  // Choose a zoom level that fits
                  var zoom = '.$this->mId.'_map.getBoundsZoomLevel(bounds);

                  '.$this->mId.'_map.setCenter(bounds.getCenter(),zoom);

                  var points=[new GLatLng(N,W),new GLatLng(N,E),new GLatLng(S,E),new GLatLng(S,W),new GLatLng(N,W)];
                  '.$this->mId.'_map.addOverlay(new GPolyline(points));

                }
                // ====== Decode the error status ======
                else {
                  var reason="Code "+result.Status.code;
                  if (reasons[result.Status.code]) {
                    reason = reasons[result.Status.code]
                  }
                  alert(\'Could not find "\'+search+ \'" \' + reason);
                }
              }
            );
        }

        function createSidebarHtml(_type)
        {
            var side_bar_html="<table border=\'0\' width=\'100%\'>";
            side_bar_html+=("<tr><th align=\'left\'>Description</th><th align=\'left\'>Region</th><th align=\'left\'>Price</th></tr>");
            for(var i=0; i != gmarker_counter; ++i)
            {
                var xml_marker=gxml_markers[i];
                var type=xml_marker.getAttribute("type");

                if(type==_type)
                {
                    side_bar_html+="<tr>";

                    var description=xml_marker.getAttribute("description");
                    var region=xml_marker.getAttribute("region");
                    var price=xml_marker.getAttribute("price");
                    var id=xml_marker.getAttribute("id");

                    side_bar_html += "<td>";
                    side_bar_html += \'<a href="javascript:description_click(\' + i + \')">\' + description + \'<\/a><br>\';
                    side_bar_html += "</td>";

                    side_bar_html += "<td>";
                    side_bar_html += \'<a href="javascript:region_click(\' + i + \')">\' + region + \'<\/a><br>\';
                    side_bar_html += "</td>";

                    side_bar_html += "<td>";
                    side_bar_html += \'<a href="javascript:price_click(\' + i + \')">\' + price + \'<\/a><br>\';
                    side_bar_html += "</td>";

                    side_bar_html += "<td>";
                    side_bar_html += (\'<a href="javascript:delete_click(\' + id + \')">delete</a>&nbsp;\');
                    side_bar_html += (\'<a href="javascript:detail_click(\' + id + \')">details</a>\');
                    side_bar_html += "</td>";

                    side_bar_html+="</tr>";
                }
            }
            side_bar_html+="</table>";
            return side_bar_html;
        }

        function createMarker(xml_marker)
        {
          gxml_markers[gmarker_counter]=xml_marker;
          var type = xml_marker.getAttribute("type");
          var point = new GLatLng(parseFloat(xml_marker.getAttribute("lat")),
                            parseFloat(xml_marker.getAttribute("lng")));
                            
          var marker = new google.maps.GMarker(point, customIcons[type]);
          gmarkers[gmarker_counter] = marker;

          GEvent.addListener(marker, "click", function()
          {
            marker.openInfoWindowTabsHtml(createMarkerTabs(xml_marker));
          });
          gmarker_counter++;
          return marker;
        }

        // This function picks up the click and opens the corresponding info window
        function description_click(i) {
            gmarkers[i].openInfoWindowTabsHtml(createMarkerTabs(gxml_markers[i]));
           // gmarkers[i].openInfoWindowHtml(htmls[i]);
        }

        // This function picks up the click and opens the corresponding info window
        function region_click(i) {
            gmarkers[i].openInfoWindowTabsHtml(createMarkerTabs(gxml_markers[i]));
           // gmarkers[i].openInfoWindowHtml(htmls[i]);
        }

        // This function picks up the click and opens the corresponding info window
        function price_click(i) {
            gmarkers[i].openInfoWindowTabsHtml(createMarkerTabs(gxml_markers[i]));
           // gmarkers[i].openInfoWindowHtml(htmls[i]);
        }

        function createIcon(ico_name, shadow_name)
        {
            var baseIcon=new google.maps.GIcon(google.maps.G_DEFAULT_ICON);
            baseIcon.image=ico_name;
            baseIcon.shadow=shadow_name;
            baseIcon.iconSize=new GSize(12,20);
            baseIcon.shadowSize=new GSize(22,20);
            baseIcon.iconAnchor=new GPoint(6,20);
            baseIcon.infoWindowAnchor=new GPoint(5,1);

            return baseIcon;
        }

        function clearMarkers()
        {
            gmarkers = [];
            gxml_markers = [];
            gmarker_counter = 0;
            '.$this->mId.'_map.clearOverlays();
        }

        function loadMarkers()
        {
            google.maps.GDownloadUrl("phpsqlajax_genxml.php", function(data)
            {
              var xml = GXml.parse(data);

              var markers = xml.documentElement.getElementsByTagName("marker");
              for (var i = 0; i < markers.length; i++)
              {
                var marker = createMarker(markers[i]);
                '.$this->mId.'_map.addOverlay(marker);
              }

              // put the assembled side_bar_html contents into the side_bar div
              $("#'.$this->mId.'_sidebar_rental").html(createSidebarHtml("Rental"));
              $("#'.$this->mId.'_sidebar_restaurant").html(createSidebarHtml("Restaurant"));
              $("#'.$this->mId.'_sidebar_shopping").html(createSidebarHtml("Shopping"));

              $(".scroll-pane").jScrollPane();
            });
        }

        // === functions that perform the context menu options ===
        function zoomIn() {
            // perform the requested operation
            '.$this->mId.'_map.zoomIn();
            // hide the context menu now that it has been used
            '.$this->mId.'_contextmenu.style.visibility="hidden";
        }
        function zoomOut() {
            // perform the requested operation
            '.$this->mId.'_map.zoomOut();
            // hide the context menu now that it has been used
            '.$this->mId.'_contextmenu.style.visibility="hidden";
        }
        function zoomInHere() {
            // perform the requested operation
            var point = '.$this->mId.'_map.fromContainerPixelToLatLng(clickedPixel)
            '.$this->mId.'_map.zoomIn(point,true);
            // hide the context menu now that it has been used
            '.$this->mId.'_contextmenu.style.visibility="hidden";
        }
        function zoomOutHere() {
            // perform the requested operation
            var point = '.$this->mId.'_map.fromContainerPixelToLatLng(clickedPixel)
            '.$this->mId.'_map.setCenter(point,'.$this->mId.'_map.getZoom()-1); // There is no map.zoomOut() equivalent
            // hide the context menu now that it has been used
            '.$this->mId.'_contextmenu.style.visibility="hidden";
        }
        function centreMapHere() {
            // perform the requested operation
            var point = '.$this->mId.'_map.fromContainerPixelToLatLng(clickedPixel)
            '.$this->mId.'_map.setCenter(point);
            // hide the context menu now that it has been used
            '.$this->mId.'_contextmenu.style.visibility="hidden";
        }

        $(function(){
            //customIcons["Rental"] = createIcon(\'http://google-maps-icons.googlecode.com/files/gazstation.png\', \'http://google-maps-icons.googlecode.com/files/gazstation.png\');
            //customIcons["Restaurant"] = createIcon(\'http://google-maps-icons.googlecode.com/files/gazstation.png\', \'http://google-maps-icons.googlecode.com/files/gazstation.png\');
            //gico_station=createIcon("station.png");
            //gico_depot=createIcon("depot.png");
            //gico_vehicle=createIcon("vehicle.png");
            //ground_overlay_shown=false;
            // ====== Create a Client Geocoder ======
            '.$this->mId.'_geo = new google.maps.GClientGeocoder();

            reasons[G_GEO_SUCCESS]            = "Success";
            reasons[G_GEO_MISSING_ADDRESS]    = "Missing Address: The address was either missing or had no value.";
            reasons[G_GEO_UNKNOWN_ADDRESS]    = "Unknown Address:  No corresponding geographic location could be found for the specified address.";
            reasons[G_GEO_UNAVAILABLE_ADDRESS]= "Unavailable Address:  The geocode for the given address cannot be returned due to legal or contractual reasons.";
            reasons[G_GEO_BAD_KEY]            = "Bad Key: The API key is either invalid or does not match the domain for which it was given";
            reasons[G_GEO_TOO_MANY_QUERIES]   = "Too Many Queries: The daily geocoding quota for this site has been exceeded.";
            reasons[G_GEO_SERVER_ERROR]       = "Server error: The geocoding request could not be successfully processed.";

            //intialize map
            '.$this->mId.'_map=new GMap2(document.getElementById("'.$this->mId.'_map"));
            '.$this->mId.'_map.addMapType(G_SATELLITE_3D_MAP);
            '.$this->mId.'_map.addControl(new GLargeMapControl());
            '.$this->mId.'_map.addControl(new GMapTypeControl());
            '.$this->mId.'_map.setCenter(new GLatLng(1.368354,103.818054), 12); //47.614495, -122.341861, 13
            //'.$this->mId.'_map.setMapType(G_SATELLITE_MAP);
            //'.$this->mId.'_map.setMapType(G_NORMAL_MAP);
            //'.$this->mId.'_map.addControl(new PResizeControl());
            '.$this->mId.'_map.setUIToDefault();

            '.$this->mId.'_contextmenu=document.createElement("'.$this->mId.'_contextmenu");
            '.$this->mId.'_contextmenu.style.visibility="hidden";
            '.$this->mId.'_contextmenu.style.background="#ffffff";
            '.$this->mId.'_contextmenu.style.border="1px solid #8888FF";

            '.$this->mId.'_contextmenu.innerHTML = \'<a href="javascript:zoomIn()"><div class="context">&nbsp;&nbsp;Show Nearby Property&nbsp;&nbsp;<\/div><\/a>\'
                            + \'<a href="javascript:zoomOut()"><div class="context">&nbsp;&nbsp;Show Nearby MRT&nbsp;&nbsp;<\/div><\/a>\'
                            + \'<a href="javascript:zoomInHere()"><div class="context">&nbsp;&nbsp;Show Nearby Shopping Mall&nbsp;&nbsp;<\/div><\/a>\'
                            + \'<a href="javascript:zoomOutHere()"><div class="context">&nbsp;&nbsp;Show Nearby Restaurant&nbsp;&nbsp;<\/div><\/a>\'
                            + \'<a href="javascript:centreMapHere()"><div class="context">&nbsp;&nbsp;Show Nearby Transport&nbsp;&nbsp;<\/div><\/a>\';

            '.$this->mId.'_map.getContainer().appendChild('.$this->mId.'_contextmenu);
            // === listen for singlerightclick ===
            GEvent.addListener('.$this->mId.'_map,"singlerightclick",function(pixel,tile) {
                // store the "pixel" info in case we need it later
                // adjust the context menu location if near an egde
                // create a GControlPosition
                // apply it to the context menu, and make the context menu visible
                clickedPixel = pixel;
                var x=pixel.x;
                var y=pixel.y;
                if (x > '.$this->mId.'_map.getSize().width - 120) { x = '.$this->mId.'_map.getSize().width - 120 }
                if (y > '.$this->mId.'_map.getSize().height - 100) { y = '.$this->mId.'_map.getSize().height - 100 }
                var pos = new GControlPosition(G_ANCHOR_TOP_LEFT, new GSize(x,y));
                pos.apply('.$this->mId.'_contextmenu);
                '.$this->mId.'_contextmenu.style.visibility = "visible";
            });

            // === If the user clicks on the map, close the context menu ===
            GEvent.addListener('.$this->mId.'_map, "click", function() {
              '.$this->mId.'_contextmenu.style.visibility="hidden";
            });

            clearMarkers();
            loadMarkers();

        });
        $(function(){
            $("#'.$this->mId.'_title").corner("bevel top");
            $("#btnGoTo").click(function(){
                reCenter();
                return false;
            });
        });
		</script>
        ';
    }

    public function setIcon($img)
    {
        $this->mImg=$img;
    }
    
    public function render_title()
    {
        $img='';/*
        if(isset($this->mImg))
        {
            $img='<img src="'.$this->mImg.'" border="0" align="absmiddle" /> ';
        }*/
        $format='padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;background: url(codezone/css/images/top_bar.png);'; //#6af
        $format.='width:'.($this->getWidth()+$this->getSidebarWidth()+20).'px;';

        echo '<div style="'.$format.'" id="'.$this->mId.'_title">'.$img.$this->mTitle.'</div>'; //class="ui-state-default ui-corner-all"
    }


    protected function getMapStyle()
    {
        $style="";
        $style.="width:".$this->getWidth()."px;";
        $style.="height:".$this->getHeight()."px;";
        $style.='overflow-x:hidden;';
        $style.='overflow-y:hidden;';

        return $style;
    }

    protected function getMapFrameStyle()
    {
        $style="";
        $style.='background:white;';
        $style.='color:black;';
        $style.='padding:5px;';
        $style.='border-left:1px solid cyan;';
        //$style.='border-right:1px solid cyan;';
        $style.='border-bottom:4px double cyan;';

        if($this->getWidth() != -1)
        {
            $style.='width:'.$this->getWidth().'px;';
        }
        else
        {
            $style.='width:100%;';
        }

        if($this->getHeight() != -1)
        {
            $style.='height:'.$this->getHeight().'px;';
        }
        else
        {
            $style.='height:100%;';
        }
       

        return $style;
    }

    private function getSidebarFrameStyle()
    {
        $style="";
        $style.='background:#ccc;';
        $style.='color:black;';
        $style.='padding:5px;';
        $style.='border-left:1px solid cyan;';
        $style.='border-right:1px solid cyan;';
        $style.='border-bottom:4px double cyan;';
        

        $style.='width:100%;';

        return $style;
    }

    public function render()
    {
		CGoogleApi::init();
		CGoogleApi::register('maps', '2.x');
		
        echo '<form action="'.$_SERVER["REQUEST_URI"].'" method="POST" class="niceform"/>';
        echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">'."\n";
        echo '<tr>';
        echo '<td style="'.$this->getMapFrameStyle().'" rowspan="2">';
        echo "<div id=\"".$this->mId."_map\" style=\"".$this->getMapStyle()."\" />";
        echo '</td>';
        echo '<td style="background:#ccc;">';
        echo '&nbsp;&nbsp;Target Location: ';
        echo '<input type="text" value="" id="txtGoTo" name="txtGoTo" />';
        echo '<button id="btnGoTo" name="btnGoTo">Go</button>';
        echo '</td>';
        echo '</tr><tr>';
        echo '<td style="'.$this->getSidebarFrameStyle().'" valign="top">';
        echo '<div id="'.$this->mId.'_sidebar_pane"  class="scroll-pane" style="height: '.($this->getHeight()-30).'px">';

        echo '<fieldset>';
    	echo '<legend>Rental Info</legend>';
        echo '<dl>';
        echo '<div id="'.$this->mId.'_sidebar_rental" class="scroll-pane" style="height: 200px;overflow: auto;"></div>';
        echo '</dl>';
        echo '</fieldset>';
        
        echo '<fieldset>';
    	echo '<legend>Restaurant Info</legend>';
        echo '<dl>';
        echo '<div id="'.$this->mId.'_sidebar_restaurant" class="scroll-pane" style="height: 200px;overflow: auto;"></div>';
        echo '</dl>';
        echo '</fieldset>';

        echo '<fieldset>';
    	echo '<legend>Shopping Info</legend>';
        echo '<dl>';
        echo '<div id="'.$this->mId.'_sidebar_shopping" class="scroll-pane" style="height: 200px;overflow: auto;"></div>';
        echo '</dl>';
        echo '</fieldset>';
        
        echo '</div>';

        echo '</td>'."\n";
        echo '</tr>'."\n";
        echo '</table>'."\n";
        echo '</form>';
    }
}
?>
