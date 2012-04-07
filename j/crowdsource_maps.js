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
var facebook_icon = '/images/screen/icon_facebook.gif'
var twitter_icon = '/images/screen/twitter_icon.gif'
var video_icon = '/images/screen/video_icon.gif'
var photo_icon = '/images/screen/photo_icon.gif'

var MAP = {
		
		init:function(map_plots)
		{
			
			geocoder = new google.maps.Geocoder();
			
			var latlng = new google.maps.LatLng(40.65, -73.95);
		    
		    var myOptions = {
		    		zoom: 12,
		    		center: latlng,
		    		mapTypeId: google.maps.MapTypeId.ROADMAP
		    };
		    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		   
	    	//console.log('is not map');
	    	MAP.info_window = new google.maps.InfoWindow();
		    
		    // Make the info window close when clicking anywhere on the map.
		    google.maps.event.addListener(map, 'click', MAP.close_info_window);
		    
		    for(i=0; i< map_plots.length; i++){
		    	
		    	//loop the array of addresses to plot on the map
		    	
			    MAP.code_address(map_plots[i]);
		    }
		    
		    return false;
		    
		    //loop the array of addresses to plot on the map
		    MAP.code_address(map_plots);
		    
		}
		
		,close_info_window:function()
		{
			MAP.info_window.close();
		}
		
		,code_address:function(map_obj)
		{
			
			//console.log(map_obj);
			
			var address = map_obj.user_location;
			var category = map_obj.category;
			var entry_id = map_obj.entry_id;
			var title = map_obj.title;
			var project = map_obj.project;
    		var category_img = MAP.category_image(category);
    		var comment = map_obj.comment;
    		var username = map_obj.username;
    		var image = map_obj.image;
    		
    		//console.log(category_img);
    		
    		geocoder.geocode( { 'address': address}, function(results, status) {
    				
    			//console.log(results[0]);
    			
    			if (status == google.maps.GeocoderStatus.OK) {
    				var addr_string = results[0].formatted_address;
    				
    				var content_html = 		'<div>'
    								+		'<div class="comment_thumb">'
    								+			'<img src="'+ image +'" />'
    								+ 		'</div>'
    								+		'<div class="comment_description">'
    								+			'<p><font color="#66cccc" style="text-transform: uppercase;"><b>'+ title +'</b></font><font color="#66cccc"><br />'
    								+			''+ addr_string +'<br />'
    								+			''+ project + '</font></p>'
    								+			'<p><b>COMMENT</b><br />'+ comment + '</p>'
    								+			'<p>From '+ username + '</p>'
    								+		'</div>'
    								+ 	'</div>'
    				
    				//console.log(content_html);
    						
					//map.setCenter(results[0].geometry.location);
				    var marker = new google.maps.Marker({
				        map: map
				        ,animation: google.maps.Animation.DROP
				        ,position: results[0].geometry.location
				        ,icon: category_img
				    });				
    				
    				//console.log(marker.position);
    				
				    // Register event listeners to each marker to open a shared info
				    // window displaying the marker's position when clicked or dragged.
				    
				    google.maps.event.addListener(marker, 'mouseover', function() {
				      MAP.open_info_window(marker, content_html);
				    });
				    
    			}
    			else {
				    //alert("Geocode was not successful for the following reason: " + status);
				}
    		
    		});
    		
		}
		
		/**
		 * Get the category image
		 * @param string c the category string
		 * @return returns the img src
		 * */
		,category_image:function(c)
		{
			//console.log(c);
			
			switch(c)
			{
				case 'Twitter':
					img_src = twitter_icon;
					break;
					
				case 'Normal':
					img_src = marker_icon
					break;
				
				case 'Facebook':
					img_src = facebook_icon;
					break;
					
				case 'Photo':
					img_src = photo_icon;
					break;
				
				default:
					img_src = marker_icon;
					break;
			
			}
			
			return img_src;
			
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
		 * Autoload the tweets
		 * */
		,autoload:function()
		{
			//console.log('hi');
			var ajax = $.ajax({
				type: "POST",
				url: "/virtual-terminal/ajax",
				dataType: 'json',
				data: {
					comp: 'ajx_check_in'
					,method: 'get_attended'
					,campaign_id: ''
				},
				success: function(r, status){
					if(r.size != 0)
					{
						fields = r.field_ids;
						fields_len = fields.length;
						
						comment = r.comment;
						image = r.image;
						user_location = r.user_location;
						project_id = r.project;
						username = r.username;
						
						plot_data = {
						  	category: r.category
							,entry_date: r.entry_date
							,entry_id: r.entry_id
							,user_location: user_location
							,title: r.title
							,comment: comment.replace("'","\'")
							,project: r.project_title
							,username: username
						};
						
						//alert('u');
						//console.log(plot_data);
						MAP.code_address(plot_data);
					}
					
					
				}
			});
		}
		
}
