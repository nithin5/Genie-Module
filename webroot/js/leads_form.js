
 /********************GOOGLE MAP LOCATION IN LEADS ENQUIRY FORM*************************************************************************/
/*Geo Location codes*/
var lat1;
var lng2;
var location12;
var location13;
var text9;
var text8;
var lati;
var longi;
var latitude99;
var longitude99;
var address99;
var locationnameenter;
var country_name;
var state;



        function login_popup_leads_geolocateUser() {

	            if (navigator.geolocation) {
	                var login_popup_leads_positionOptions = {
	                    enableHighAccuracy: true,	                 
	                };
	                navigator.geolocation.getCurrentPosition(login_popup_leads_geolocationSuccess, login_popup_leads_geolocationError, login_popup_leads_positionOptions);
	            }
	            
	            
	    }




	    function login_popup_leads_geolocationError(positionError) {


	         	$(".share_location_leads").css("display","none");
	    	$(".share_location_button_leads").css("display","none");

	    	$(".show_text_location_leads").html('Sorry! We couldn\'t find Your Current Location.<br><span class="text_hilighted_popup" style="font-weight:bold;">Please enter Your Current Location below.</span>');
	         

	          
	    }

	    function login_popup_leads_geolocationSuccess(position) {
	         	
	        	 lat1 = position.coords.latitude
	       		 lng2 = position.coords.longitude
	       		 latitude99 = position.coords.latitude
	       		 longitude99 = position.coords.longitude
 			    var userLatLng = new google.maps.LatLng(lat1, lng2);        	       
 
	           
	            var geocoder = new google.maps.Geocoder(); 
	            geocoder.geocode({
	                "location": userLatLng 
	            },
	            function(results, status) {
	            	 text9 = results[0].formatted_address;
	            	 address99 = results[0].formatted_address;
	            	
	            	if (status == google.maps.GeocoderStatus.OK){                  

                   } else{                    
                    document.getElementById("error").innerHTML += "Unable to retrieve your address" + "<br />";

		           }
                
	            });

	       

	             login_popup_leads_codeLatLng(userLatLng)  
	    }


	   function login_popup_leads_codeLatLng(userLatLng) {
		    var latlng = new google.maps.LatLng(lat1, lng2);
		     var geocoder = new google.maps.Geocoder(); 
		    geocoder.geocode({'latLng': latlng}, function(results, status) {
		      if (status == google.maps.GeocoderStatus.OK) {
		      
		        if (results[1]) {

        	address99 = results[0].formatted_address;
         
             for (var i=0; i<results[0].address_components.length; i++) {
            for (var b=0;b<results[0].address_components[i].types.length;b++) {
        
              if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                    city2= results[0].address_components[i];  
                    state=city2.long_name;
                }
               if (results[0].address_components[i].types[b] == "locality") {
                    city1= results[0].address_components[i];  
                       location12 = city1.long_name;                                

                }
                if (results[0].address_components[i].types[b] == "sublocality_level_1") {
                    city= results[0].address_components[i];   
                     location13 = city.long_name +"";  		
	
                }
                 if (results[0].address_components[i].types[b] == "country") {
                    country= results[0].address_components[i];   
                     country_name = country.long_name +"";  		
	
                }
            }
        }
      
    
     				
				  
        					login_popup_leads_store_usersharelocdetails_locshare();
        					 $('#share-location-login-popup-leads_myloc').modal('hide');
				             //login_popup_leads_store_usersharelocdetails()

            
        } else {
          alert("No results found");
        }
      }
    });


    $('#share-location-login-popup-leads').modal('hide');
  

   
  }

  function login_popup_leads_initialize() {

			var autocomplete1 = new google.maps.places.Autocomplete(document.getElementById('login_popup_leads_autocomplete'));
				google.maps.event.addListener(autocomplete1, 'place_changed', function() {

					var place = autocomplete1.getPlace();
            
                        			lati = place.geometry.location.lat();
			                        longi = place.geometry.location.lng();
			                        latitude99 = place.geometry.location.lat();
			                        longitude99 = place.geometry.location.lng();
			
				});
				jQuery(document).ready(function() {

	            	jQuery('#login_popup_leads_nearbyoff').click(function(event) {

	            		var keycode = (event.keyCode ? event.keyCode : event.which);
					    if(keycode == '13'){
					    					event.preventDefault();
					    					return false;
					                     }

		          //       var geocoder = new google.maps.Geocoder(); 
		             
		          //       geocoder.geocode({
		          //           address : jQuery('input[id=login_popup_leads_autocomplete]').val(), 
		          //           region: 'no' 
		          //       },
		          //       function(results, status) {
		          //           if (status.toLowerCase() == 'ok') {
		          //           	address3 = jQuery('input[id=login_popup_leads_autocomplete]').val();
		          //           	address3=address3.split(",");
		          //           	address3=address3.reverse();
		                    	
		          //               var coords = new google.maps.LatLng(
		          //                   results[0]['geometry']['location'].lat(),
		          //                   results[0]['geometry']['location'].lng());
			                       
			         //                lati = coords.lat();
			         //                longi = coords.lng();
			         //                latitude99 = coords.lat();
			         //                longitude99 = coords.lng();
			                    
            //       					locationmap = "";

	           //          			output13 = "";
				           
				 			    // var userLatLng = new google.maps.LatLng(lati, longi);

				 			    // login_popup_leads_codeLatLngsearch(userLatLng,address3)
		                      
		          //           }
		          //       }
		          //       );

              					address3 = jQuery('input[id=login_popup_leads_autocomplete]').val();
		                    	address3=address3.split(",");
		                    	address3=address3.reverse();

		                    	locationmap = "";

	                    		output13 = "";
				           
				 			    var userLatLng = new google.maps.LatLng(lati, longi);

				 			    login_popup_leads_codeLatLngsearch(userLatLng,address3)
	            	});	          
       			});
       			$("#login_popup_leads_autocomplete").focus();
			}


		function login_popup_leads_codeLatLngsearch(userLatLng,address3) {
    var latlng = new google.maps.LatLng(lati, longi);
     var geocoder = new google.maps.Geocoder(); 

    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {

        if (results[1]) {
             address99 = results[0].formatted_address;
             country_name=address3[0];               	
             state= address3[1];//state
             location12=address3[2];//city
             location13=address3[3];//area
          
          	
		            
				if(location12 == null){
					 //alert('Please Choose a City');
		             //return false;
		             $('#autocomplete12_msg').show();
					 $('#autocomplete12_msg').text("* Please Choose a City");
					 return false;
		        }

			
				

				/*if(country_name != ' India'){
		            alert('Please Choose  Locations Only From India');
		                     	// return false;
		        }else{*/
		        	
		        	login_popup_leads_store_usersharelocdetails(address3);
		           	$('#share-location-login-popup-leads').modal('hide');  
		        //}	
			
  

                 
        }
      }
    });
   
   
  }


  function removelocationlogin_popup_leads(){


	$('#share-location-login-popup-leads').modal('hide');  

	    $("#login_popup_leads_country").val("");
	    $("#login_popup_leads_latitude").val("");
  		$("#login_popup_leads_longitude").val("");
  		$("#login_popup_leads_city").val("");
  		$("#login_popup_leads_area").val("");
  		$("#login_popup_leads_address").val("");
  		$("#login_popup_leads_state").val("");
  		$("#login_popup_leads_select_city").val("");


  }

   function login_popup_leads_store_usersharelocdetails_locshare(){

  		$("#login_popup_leads_country").val(country_name);
  		$("#login_popup_leads_state").val(state);
  		$("#login_popup_leads_latitude").val(latitude99);
  		$("#login_popup_leads_longitude").val(longitude99);
  		$("#login_popup_leads_city").val(location12);
  		$("#login_popup_leads_area").val(location13);
  		$("#login_popup_leads_address").val(address99);

  		$("#login_popup_leads_country1").val(country_name);
  		$("#login_popup_leads_latitude1").val(latitude99);
  		$("#login_popup_leads_longitude1").val(longitude99);
  		$("#login_popup_leads_city1").val(location12);
  		$("#login_popup_leads_state1").val(state);
  		$("#login_popup_leads_area1").val(location13);
  		$("#login_popup_leads_address1").val(address99);

  		  		
  		$("#login_popup_leads_select_city").val(location13+", "+location12+", "+state+", "+country_name);
       // $("#login_popup_leads_select_city1").val(location13+","+location12+","+state+","+country_name);

  		$("#login_popup_leads_select_city").attr("readonly", "readonly");
       // $("#login_popup_leads_select_city1").attr("readonly", "readonly");


  }

  function login_popup_leads_store_usersharelocdetails(address3){
       
  	    country_name=address3[0];               	
        state= address3[1];//state
        location12=address3[2];//city
        location13=address3[3];//area
        location14=address3[4];//area2
        location15=address3[5];//area3

        //if(location14 != ''){location}

  		$("#login_popup_leads_country").val(country_name);
  		$("#login_popup_leads_latitude").val(latitude99);
  		$("#login_popup_leads_longitude").val(longitude99);
  		$("#login_popup_leads_city").val(location12);
  		$("#login_popup_leads_area").val(location13);//zone1  	
  		$("#login_popup_leads_zone").val(location14);//zone2
  		$("#login_popup_leads_zones").val(location15);//zone3
  		$("#login_popup_leads_state").val(state);
  		$("#login_popup_leads_address").val(address99);



  		/*$("#login_popup_leads_country1").val(country_name);
  		$("#login_popup_leads_latitude1").val(latitude99);
  		$("#login_popup_leads_longitude1").val(longitude99);
  		$("#login_popup_leads_city1").val(location12);
  		$("#login_popup_leads_state1").val(state);
  		$("#login_popup_leads_area1").val(location13);
  		$("#login_popup_leads_address1").val(address99);//zone1
  		$("#login_popup_leads_zone1").val(location14);//zone2
  		$("#login_popup_leads_zones1").val(location15);//zone3*/
        
       // if(location15 !='undefined'){location13= location15+","+location14+","+location13;} 
        //if((location15 =='undefined') && (location14 !='undefined')) {location13= location14+","+location13;}
        //if((location15 =='undefined') && (location14 =='undefined')&&(location13 !='undefined')) {location13=location13;}

         if(location13 == null){ //no area

	        	if(location12 != null){ //city value is there 
	  		
	  			     $("#login_popup_leads_select_city").val(location12+","+state+","+country_name);
	  			}
	  			else{//no city

	  				 $("#login_popup_leads_select_city").val(state+","+country_name);
	  			}
  	    }
  	    else{//area is there
  	    	
  	    	  $("#login_popup_leads_select_city").val(location13+","+location12+","+state+","+country_name);	
  	    }



  		/*if(location13 == null){
  			$("#login_popup_leads_select_city").val(location12+", "+state+", "+country_name);
  			//$("#login_popup_leads_select_city1").val(location12+","+state+","+country_name);
  		}else{

  	 	$("#login_popup_leads_select_city").val(location13+", "+location12+", "+state+", "+country_name);
  	 	//$("#login_popup_leads_select_city1").val(location13+","+location12+","+state+","+country_name);
  	  }*/

  		


  		$("#login_popup_leads_select_city").attr("readonly", "readonly");
       // $("#login_popup_leads_select_city1").attr("readonly", "readonly");


  }

  /* --------------------------for buying loc-------------------------------------*/


        function login_popup_leads_geolocateUser_myloc() {

	            if (navigator.geolocation) {
	                var login_popup_leads_positionOptions = {
	                    enableHighAccuracy: true,	                 
	                };
	                navigator.geolocation.getCurrentPosition(login_popup_leads_geolocationSuccess_myloc, login_popup_leads_geolocationError_myloc, login_popup_leads_positionOptions);
	            }
	            
	               
	    }

	    


	    function login_popup_leads_geolocationError_myloc(positionError) {


	         	$(".share_location_leads").css("display","none");
	    	$(".share_location_button_leads").css("display","none");

	    	$(".show_text_location_leads").html('Sorry! We couldn\'t find Your Current Location.<br><span class="text_hilighted_popup" style="font-weight:bold;">Please enter Your Current Location below.</span>');
	         

	          
	    }

	    function login_popup_leads_geolocationSuccess_myloc(position) {
	         		
	        	 lat1 = position.coords.latitude
	       		 lng2 = position.coords.longitude
	       		 latitude99 = position.coords.latitude
	       		 longitude99 = position.coords.longitude
 			    var userLatLng = new google.maps.LatLng(lat1, lng2);        	       
 
	            

	           
	            var geocoder = new google.maps.Geocoder(); 
	            geocoder.geocode({
	                "location": userLatLng 
	            },
	            function(results, status) {
	            	 text9 = results[0].formatted_address;
	            	 
	            	 address99 = results[0].formatted_address;
	            	
	            	if (status == google.maps.GeocoderStatus.OK){                  

                   } else{                    
                    document.getElementById("error").innerHTML += "Unable to retrieve your address" + "<br />";

		           }
                
	            });

	       

	             login_popup_leads_codeLatLng_myloc(userLatLng)  
	    }


	   function login_popup_leads_codeLatLng_myloc(userLatLng) {

	   

		    var latlng = new google.maps.LatLng(lat1, lng2);
		     var geocoder = new google.maps.Geocoder(); 
		    geocoder.geocode({'latLng': latlng}, function(results, status) {
		      if (status == google.maps.GeocoderStatus.OK) {
		     
		        if (results[1]) {

        	address99 = results[0].formatted_address;
         
             for (var i=0; i<results[0].address_components.length; i++) {
            for (var b=0;b<results[0].address_components[i].types.length;b++) {
        
              if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                    city2= results[0].address_components[i];  
                    state=city2.long_name ;
                    
                }
               if (results[0].address_components[i].types[b] == "locality") {
                    city1= results[0].address_components[i];  
                       location12 = city1.long_name;                                

                }
                if (results[0].address_components[i].types[b] == "sublocality_level_1") {
                    city1= results[0].address_components[i];   
                     location13 = city1.long_name +""; 
                     
	
                }

                 if (results[0].address_components[i].types[b] == "country") {
                    country= results[0].address_components[i];   
                     country_name = country.long_name +"";  		
	
                }
            }
        }
      	

				             login_popup_leads_store_usersharelocdetails_locshare_myloc()
				              $('#share-location-login-popup-leads_myloc').modal('hide');
            
        } else {
          alert("No results found");
        }
      }
    });


    $('#share-location-login-popup-leads_myloc').modal('hide');
  

   
  }

  function login_popup_leads_initialize_myloc() {

  	        	

			var autocomplete1 = new google.maps.places.Autocomplete(document.getElementById('login_popup_leads_autocomplete_myloc'));
				
				google.maps.event.addListener(autocomplete1, 'place_changed', function() {

					   			var place = autocomplete1.getPlace();
            
                        			lati = place.geometry.location.lat();
			                        longi = place.geometry.location.lng();
			                        latitude99 = place.geometry.location.lat();
			                        longitude99 = place.geometry.location.lng();
			
				});
				jQuery(document).ready(function() {

	            	jQuery('#login_popup_leads_nearbyoff_myloc').click(function(event) {

	            		
   
					    var keycode = (event.keyCode ? event.keyCode : event.which);
					    if(keycode == '13'){
					    					event.preventDefault();
					    					return false;
					                     }


		          //       var geocoder = new google.maps.Geocoder(); 
		             
		          //       geocoder.geocode({
		          //           address : jQuery('input[id=login_popup_leads_autocomplete_myloc]').val(), 
		          //           region: 'no' 
		          //       },
		          //       function(results, status) {
		                	
		          //           if (status.toLowerCase() == 'ok') {
		          //           	address3 = jQuery('input[id=login_popup_leads_autocomplete_myloc]').val();
		          //           	address3=address3.split(",");
		          //           	address3=address3.reverse();
		                    	
		          //               var coords = new google.maps.LatLng(
		          //                   results[0]['geometry']['location'].lat(),
		          //                   results[0]['geometry']['location'].lng());
			                     
			         //                lati = coords.lat();
			         //                longi = coords.lng();
			         //                latitude99 = coords.lat();
			         //                longitude99 = coords.lng();
			                    
            //       					locationmap = "";

	           //          			output13 = "";
				          
				 			    // var userLatLng = new google.maps.LatLng(lati, longi);
				 			    
				 			    // login_popup_leads_codeLatLngsearch_myloc(userLatLng,address3);
		                      
		          //           }
		          //       }
		          //       );

              			address3 = jQuery('input[id=login_popup_leads_autocomplete_myloc]').val();
		                address3=address3.split(",");
		                address3=address3.reverse();

		                		locationmap = "";

	                    		output13 = "";
				          
				 			    var userLatLng = new google.maps.LatLng(lati, longi);
				 			    
				 			    login_popup_leads_codeLatLngsearch_myloc(userLatLng,address3);

	            	});	          
       			});
       			$("#login_popup_leads_autocomplete").focus();
			}

function login_popup_leads_codeLatLngsearch_myloc(userLatLng,address3) {

	
    var latlng = new google.maps.LatLng(lati, longi);
     var geocoder = new google.maps.Geocoder(); 
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {

        if (results[1]) {
        address99 = results[0].formatted_address;
       
		     country_name=address3[0];               	
             state= address3[1];//state
             location12=address3[2];//city
             location13=address3[3];//area
                       
                    
        	
        
		/*if(location12 == null){
			 alert('Please Choose a City');
             return false;
        }*/
        
        if(state == null){
          //alert('Please Choose a State');
            // return false;

             $('#autocomplete12_myloc_msg').show();
             $('#autocomplete12_myloc_msg').text("* Please Choose a State");
             return false;

        }
	
		

		if(country_name != ' India'){
           // alert('Please Choose  Locations Only From India');
            $('#autocomplete12_myloc_msg').show();
            $('#autocomplete12_myloc_msg').text("* Please Choose  Locations Only From India");

                     	 return false;
        }else{
        	
        	login_popup_leads_store_usersharelocdetails_myloc(address3)
        	$('#share-location-login-popup-leads_myloc').modal('hide');  
        }	
	

      

                 
        }
      }
    });
    


   
  }

	


  function removelocationlogin_popup_leads_myloc(){


	$('#share-location-login-popup-leads_myloc').modal('hide');  

	    $("#login_popup_leads_country1").val("");
	    $("#login_popup_leads_latitude1").val("");
  		$("#login_popup_leads_longitude1").val("");
  		$("#login_popup_leads_city1").val("");
  		$("#login_popup_leads_state1").val("");
  		$("#login_popup_leads_area1").val("");
  		$("#login_popup_leads_address1").val("");
  		$("#login_popup_leads_select_city1").val("");


  }

   function login_popup_leads_store_usersharelocdetails_locshare_myloc(){

  		$("#login_popup_leads_country1").val(country_name);
  		$("#login_popup_leads_state1").val(state);
  		$("#login_popup_leads_latitude1").val(latitude99);
  		$("#login_popup_leads_longitude1").val(longitude99);
  		$("#login_popup_leads_city1").val(location12);
  		$("#login_popup_leads_area1").val(location13);
  		$("#login_popup_leads_address1").val(address99);

  		  		
  		$("#login_popup_leads_select_city1").val(location13+", "+location12+", "+state+", "+country_name);


  		$("#login_popup_leads_select_city1").attr("readonly", "readonly");



  }


  function login_popup_leads_store_usersharelocdetails_myloc(address3){
     
  	
		                    	
		country_name=address3[0];               	
        state= address3[1];//state
        location12=address3[2];//city
        location13=address3[3];//area
        location14=address3[4];//area2
        location15=address3[5];//area3

  		$("#login_popup_leads_country1").val(country_name);
  		$("#login_popup_leads_state1").val(state);
  		$("#login_popup_leads_city1").val(location12);
  		$("#login_popup_leads_area1").val(location13);
  		$("#login_popup_leads_zone1").val(location14);//zone2
  		$("#login_popup_leads_zones1").val(location15);//zone3

  		$("#login_popup_leads_latitude1").val(latitude99);
  		$("#login_popup_leads_longitude1").val(longitude99);
  		 		
  		
  		$("#login_popup_leads_address1").val(address99);

  		
        if(location13 == null){ //no area

	        	if(location12 != null){ //city value is there 
	  		
	  			     $("#login_popup_leads_select_city1").val(location12+","+state+","+country_name);
	  			}
	  			else{//no city

	  				 $("#login_popup_leads_select_city1").val(state+","+country_name);
	  			}
  	    }
  	    else{//area is there

  	    	  $("#login_popup_leads_select_city1").val(location13+","+location12+","+state+","+country_name);	
  	    }

  		$("#login_popup_leads_select_city1").attr("readonly", "readonly");



  }

  /*location pop up for buy loc*/


	$(document).ready(function(){

	$("#login_popup_leads_select_city").click(function(){

		if (typeof google === 'object' && typeof google.maps === 'object') {
  
		 }else{
		$.getScript('https://maps.googleapis.com/maps/api/js?v=3.26&libraries=places');
		//$.getScript('https://maps.googleapis.com/maps/api/js?sensor=false ');

		 }

		
		$('#share-location-login-popup-leads').modal('show');  
		

        var login_popup_city = $("input[id='login_popup_leads_city']").val();

        var login_popup_area = $("input[id='login_popup_leads_area']").val();
        var login_popup_country = $("input[id='login_popup_leads_country']").val();

        		var area_name='';
                if (login_popup_area!=' ' && login_popup_area!='') {
                   area_name = login_popup_area+", ";
                }

                	
                if (login_popup_city!='') {

                    $("#show_location_popup_loc_login_popup_leads").show();
                    $(".current-location12").show();
                   // change_location_ad99_login_popup_leads
                    $("#change_location_ad99_login_popup_leads").html(area_name +""+ login_popup_city +", "+login_popup_country);
                    

                }else{
                	$("#show_location_popup_loc_login_popup_leads").hide();
                }
    
   	
   

  }); 

	$("#login_popup_leads_select_city1").click(function(){

		if (typeof google === 'object' && typeof google.maps === 'object') {
  
		 }else{
		$.getScript('https://maps.googleapis.com/maps/api/js?v=3.26&libraries=places');

		 }

		
		$('#share-location-login-popup-leads_myloc').modal('show');  
		

        var login_popup_city1 = $("input[id='login_popup_leads_city1']").val();
        

        var login_popup_area1 = $("input[id='login_popup_leads_area1']").val();

        var login_popup_state1 = $("input[id='login_popup_leads_state1']").val();
           

        var login_popup_country1 = $("input[id='login_popup_leads_country1']").val();
       

        		var area_name='';
                if (login_popup_area1!=' ' && login_popup_area1!='') {
                   area_name = login_popup_area1+", ";

                }

                	
                if (login_popup_city1!='') {

                    $("#show_location_popup_loc_login_popup_leads_myloc").show();
                    $(".current-location12").show();

                 $("#change_location_ad99_login_popup_leads_myloc").html(area_name +""+ login_popup_city1 +", "+ login_popup_state1 +", "+login_popup_country1);
               //change_location_ad99_login_popup_leads_myloc
                }else{
                	$("#show_location_popup_loc_login_popup_leads_myloc").hide();
                }
    
   	
   

  }); 



});

/*Geo Location codes*/

/********************GOOGLE MAP LOCATION IN LEADS ENQUIRY FORM*************************************************************************/

