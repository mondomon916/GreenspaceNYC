/**
 * Google Maps API scripts
 * 
 *  @author Raymond Manalo
 *  @date 12/8/2010
 * 
 */

var geocoder;
var map;
var marker_icon = '/images/screen/dashboard/markers_b.png'

var MAP = {
		
		init:function(map_plots,boro,default_map)
		{
			geocoder = new google.maps.Geocoder();
			//console.log(default_map);
			//console.log(map_plots);
			//console.log(boro);
			//coords = MAP.boro_coords(boro);
			//console.log(coords);
			
			switch(boro)
			{
				case 'manhattan': //manhattan
					var latlng = new google.maps.LatLng(40.730608, -74.006653);
					break;
				case 'bronx': //bronx
					var latlng = new google.maps.LatLng(40.8501, -73.866246);
					break;
				case 'brooklyn': //brooklyn
					var latlng = new google.maps.LatLng(40.65, -73.95);
					break;
				case 'queens': //queens
					var latlng = new google.maps.LatLng(40.749824, -73.797634);
					break;
				case 'staten island': //staten island
					var latlng = new google.maps.LatLng(40.583438, -74.149587);
					break;
			}
			
		    
		    var myOptions = {
		    		zoom: 12,
		    		center: latlng,
		    		mapTypeId: google.maps.MapTypeId.ROADMAP
		    };
		    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		    
		    if(!default_map)
		    {
		    	//console.log('is not map');
		    	MAP.info_window = new google.maps.InfoWindow();
			    
			    // Make the info window close when clicking anywhere on the map.
			    google.maps.event.addListener(map, 'click', MAP.close_info_window);
			    
			    //pass an array of addresses to plot on the map
			    MAP.code_address(map_plots);
		    }
		}
		
		,close_info_window:function()
		{
			MAP.info_window.close();
		}
		
		,code_address:function(map_plots)
		{
			//console.log(map_plots.length);
			//var address = document.getElementById("address").value;
			//console.log(address);
			
			var markers_obj = [];
			var content_string = "";
			
			for(i=0; i<= map_plots.length; i++){
				var address = map_plots[i];
				geocoder.geocode( { 'address': address}, function(results, status) {
			    	if (status == google.maps.GeocoderStatus.OK) {
						
			    		//console.log(results[0].formatted_address);
			    		
			    		var addr_string = results[0].formatted_address;
			    		
			    		//get the content for the window
			    		//MAP.get_info_content();
			    		
			    		var content_string = '<div>' +
			    							 	'<h5>' + addr_string + '</h5>' +
			    							 '</div>'
			    		
			    		//map.setCenter(results[0].geometry.location);
					    var marker = new google.maps.Marker({
					        map: map
					        ,animation: google.maps.Animation.DROP
					        ,position: results[0].geometry.location
					        ,icon: marker_icon
					    });
					    
					    // Register event listeners to each marker to open a shared info
					    // window displaying the marker's position when clicked or dragged.
					    google.maps.event.addListener(marker, 'mouseover', function() {
					      MAP.open_info_window(marker, content_string);
					    });
					    
					    /*
					    google.maps.event.addListener(marker, 'click', function() {
					    	
					    	infowindow.open(map,marker);
					    	
					    	//console.log(marker.getPosition());
					    	
					    	map.panTo(marker.getPosition());
					    	
					    	
				    	});*/
					    
					    //map.setZoom(14);
					} 
			    	else {
					    //alert("Geocode was not successful for the following reason: " + status);
					}
			    });
			}
			
			//console.log(test);
			
		    
		}
		
		/**
		 * Creates the infor windwo for the marker
		 * @param object m the marker object
		 * @param string s the content string for the marker
		 * */
		,open_info_window:function(m,s)
		{	
			//set the content of the window
			MAP.info_window.setContent(s);
			
			//open the window for the marker
			MAP.info_window.open(map,m);
		}
		
		/**
		 * Get the content for the info window
		 * */
		,get_info_content:function()
		{
			
		}
		
		/**
		 * Build the BIS data
		 * */
		,get_bis_data:function(obj)
		{
			//console.log($(obj));
			//set the data for the fields
			var borough = $(obj).attr('boro') != 'undefined' ? $(obj).attr('boro') : '';
				borough = MAP.get_borough(borough);
				
			var borough_name = $(obj).attr('borough') != 'undefined' ? $(obj).attr('borough') : '';
			var id = $(obj).attr('id') != 'undefined' ? $(obj).attr('id') : '';
			var bin = $(obj).attr('bin') != 'undefined' ? $(obj).attr('bin') : '';
			var lot = $(obj).attr('lot') != 'undefined' ? $(obj).attr('lot') : '';
			var block = $(obj).attr('block') != 'undefined' ? $(obj).attr('block') : '';
			var lon = $(obj).attr('lon') != 'undefined' ? $(obj).attr('lon') : '';
			var hin = $(obj).attr('hin') != 'undefined' ? $(obj).attr('hin') : '';
			var street = $(obj).attr('street') != 'undefined' ? $(obj).attr('street') : '';
			
			$('#borough').val(borough_name);
			$('#lo-house-number').val(lon);
			$('#hi-house-number').val(hin);
			$('#lot').val(lot);
			$('#block').val(block);
			$('#street').val(street);
			$('#bin').val(bin);
			
			//pan the map  to the location
			var address = street;
			geocoder.geocode( { 'address': address}, function(results, status) {
		    	if (status == google.maps.GeocoderStatus.OK) {
					
		    		//console.log(results[0].formatted_address);
		    		
		    		var addr_string = results[0].formatted_address;
		    		
		    		//get the content for the window
		    		//MAP.get_info_content();
		    		
		    		var content_string = '<div>' +
		    							 	'<h5>' + addr_string + '</h5>' +
		    							 '</div>'
		    		
		    		//map.setCenter(results[0].geometry.location);
				    var marker = new google.maps.Marker({
				        map: map
				        ,animation: google.maps.Animation.DROP
				        ,position: results[0].geometry.location
				        ,icon: marker_icon
				    });
				    
					MAP.open_info_window(marker, content_string);
					
				    // Register event listeners to each marker to open a shared info
				    // window displaying the marker's position when clicked or dragged.
				    google.maps.event.addListener(marker, 'mouseover', function() {
				    	MAP.open_info_window(marker, content_string);
				   	});
				    
				    /*
				    google.maps.event.addListener(marker, 'click', function() {
				    	
				    	infowindow.open(map,marker);
				    	
				    	//console.log(marker.getPosition());
				    	
				    	map.panTo(marker.getPosition());
				    	
				    	
			    	});*/
				    
				    //map.setZoom(14);
				} 
		    	else {
				    alert("Geocode was not successful for the following reason: " + status);
				}
		    });
				
		}
		
		/**
		 * 
		 * Get the borough from the id
		 * 
		 * */
		,get_borough:function(id)
		{
			
			switch(id)
			{
				case 1:
					boro = 'Manhattan';
					break;
				case 2:
					boro = 'Bronx';
					break;
				case 3:
					boro = 'Brooklyn';
					break;
				case 4:
					boro = 'Queens';
					break;
				case 5:
					boro = 'Staten Island';
					break;
				default:
					boro = 'Manhattan';
					break;
			}	
			return boro;
		}
		
		/**
		 * Show/Hide advance search
		 * */
		,toggle_search:function()
		{
			$('#advanced-search-drop').slideToggle('fast');
		}
}
