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
    

 $("body").on('click',"#login_popup_leads_select_city2",function(){
    
         var user_id=$("#QuoteUserId").val();



        if (typeof google === 'object' && typeof google.maps === 'object') {
  
         }else{
        $.getScript('https://maps.googleapis.com/maps/api/js?v=3.26&libraries=places');

         }

        
        $('#share-location-login-popup-leads_myloc1').modal('show');  
        

        var login_popup_city = $("input[id='login_popup_leads_city1']").val();        

        var login_popup_area = $("input[id='login_popup_leads_area1']").val();

        var login_popup_state = $("input[id='login_popup_leads_state1']").val();
           

        var login_popup_country = $("input[id='login_popup_leads_country1']").val();
       

                var area_name='';
                if (login_popup_area!=' ' && login_popup_area!='') {
                   area_name = login_popup_area+", ";

                }

                    
                if (login_popup_city!='') {

                    $("#show_location_popup_loc_login_popup_leads_myloc1").show();
                    $(".current-location12").show();
                 $("#change_location_ad99_login_popup_leads_myloc1").html(area_name +""+ login_popup_city +","+ login_popup_state +","+login_popup_country);
                }else{
                    $("#show_location_popup_loc_login_popup_leads_myloc1").hide();
                }
    
    
   

  }); 




        function login_popup_leads_geolocateUser_myloc1() {

                if (navigator.geolocation) {
                    var login_popup_leads_positionOptions_myloc1 = {
                        enableHighAccuracy: true,                    
                    };
                    navigator.geolocation.getCurrentPosition(login_popup_leads_geolocationSuccess_myloc1, login_popup_leads_geolocationError_myloc1, login_popup_leads_positionOptions_myloc1);
                }
                
                
        }




        function login_popup_leads_geolocationError_myloc1(positionError) {


                $(".share_location_leads").css("display","none");
            $(".share_location_button_leads").css("display","none");

            $(".show_text_location_leads").html('Sorry! We couldn\'t find Your Current Location.<br><span class="text_hilighted_popup" style="font-weight:bold;">Please enter Your Current Location below.</span>');
             

              
        }

        function login_popup_leads_geolocationSuccess_myloc1(position) {
                
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

           

                 login_popup_leads_codeLatLng_myloc1(userLatLng)  
        }


       function login_popup_leads_codeLatLng_myloc1(userLatLng) {
            var latlng = new google.maps.LatLng(lat1, lng2);
             var geocoder = new google.maps.Geocoder(); 
            geocoder.geocode({'latLng': latlng}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
              
                if (results[1]) {

            address99 = results[0].formatted_address;

             //$("#area_loc_check").text(''); 
         
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
      
    
                    
                  
                            login_popup_leads_store_usersharelocdetails_locshare_myloc1();
                             $('#share-location-login-popup-leads_myloc1').modal('hide');
                             //login_popup_leads_store_usersharelocdetails()

            
        } else {
          alert("No results found");
        }
      }
    });


    $('#share-location-login-popup-leads_myloc1').modal('hide');
  

   
  }

  function login_popup_leads_initialize_myloc1() {

            var autocomplete1 = new google.maps.places.Autocomplete(document.getElementById('login_popup_leads_autocomplete_myloc1'));
                google.maps.event.addListener(autocomplete1, 'place_changed', function() {

                    var place = autocomplete1.getPlace();
            
                                    lati = place.geometry.location.lat();
                                    longi = place.geometry.location.lng();
                                    latitude99 = place.geometry.location.lat();
                                    longitude99 = place.geometry.location.lng();
            
                });
                $(document).ready(function() {

                    $('#login_popup_leads_nearbyoff_myloc1').click(function(event) {

                        var keycode = (event.keyCode ? event.keyCode : event.which);
                        if(keycode == '13'){
                                            event.preventDefault();
                                            return false;
                                         }

                                address3 = jQuery('input[id=login_popup_leads_autocomplete_myloc1]').val();

                                $("#area_loc_check").text('');

                                address3=address3.split(",");
                                address3=address3.reverse();

                                locationmap = "";

                                output13 = "";
                           
                                var userLatLng = new google.maps.LatLng(lati, longi);

                                login_popup_leads_codeLatLngsearch_myloc1(userLatLng,address3)
                    });           
                });
                // $("#login_popup_leads_autocomplete_myloc1").focus();
            }


        function login_popup_leads_codeLatLngsearch_myloc1(userLatLng,address3) {
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
            
                    
               /* if(location12 == null){
                     alert('Please Choose a City');
                     return false;
                }   */ 

             /* if(state == null){
                     alert('Please Choose a State');
                     return false;
                } */
                if(state == null){
          //alert('Please Choose a State');
            // return false;

             $('#autocomplete12_myloc1_msg').show();
             $('#autocomplete12_myloc1_msg').text("* Please Choose a State");
             return false;

        }
            if(country_name != ' India'){
           // alert('Please Choose  Locations Only From India');
            $('#autocomplete12_myloc1_msg').show();
            $('#autocomplete12_myloc1_msg').text("* Please Choose  Locations Only From India");

              return false;
        }
       

                

                /*if(country_name != ' India'){
                    alert('Please Choose  Locations Only From India');
                                // return false;
                }else{*/
                    country_name=address3[0];                   
                    state= address3[1];//state
                    location12=address3[2];//city
                    location13=address3[3];//area
                    location14=address3[4];//area2
                    location15=address3[5];//area3
                    login_popup_leads_store_usersharelocdetails_locshare_myloc1(address3);
                    $("#area_loc_check").text(location13);
                    $('#share-location-login-popup-leads_myloc1').modal('hide');  
               // }  

                 
        }
      }
    });
   
   
  }


  function removelocationlogin_popup_leads_myloc1(){



    $('#share-location-login-popup-leads_myloc1').modal('hide');  

        $("#login_popup_leads_country1").val("");
        $("#login_popup_leads_latitude1").val("");
        $("#login_popup_leads_longitude1").val("");
        $("#login_popup_leads_city1").val("");
        $("#login_popup_leads_area1").val("");
        $("#login_popup_leads_address1").val("");
        $("#login_popup_leads_state1").val("");
        $("#login_popup_leads_select_city2").val("");
        $("#login_popup_leads_autocomplete_myloc1").val("");
        $("#change_location_ad99_login_popup_leads_myloc1").empty();



  }

   function login_popup_leads_store_usersharelocdetails_locshare_myloc1(){

        $("#login_popup_leads_country1").val(country_name);
        $("#login_popup_leads_state1").val(state);
        $("#login_popup_leads_latitude1").val(latitude99);
        $("#login_popup_leads_longitude1").val(longitude99);
        $("#login_popup_leads_city1").val(location12);
        $("#login_popup_leads_area1").val(location13);
        $("#login_popup_leads_address1").val(address99);

        // $("#login_popup_leads_country1").val(country_name);
        // $("#login_popup_leads_latitude1").val(latitude99);
        // $("#login_popup_leads_longitude1").val(longitude99);
        // $("#login_popup_leads_city1").val(location12);
        // $("#login_popup_leads_state1").val(state);
        // $("#login_popup_leads_area1").val(location13);
        // $("#login_popup_leads_address1").val(address99);

         if(location13 == null){ //no area

                if(location12 != null){ //city value is there 
            
                     $("#login_popup_leads_select_city2").val(location12+", "+state+", "+country_name);
                }
                else{//no city

                     $("#login_popup_leads_select_city2").val(state+", "+country_name);
                }
        }
        else{//area is there
            
            $("#login_popup_leads_select_city2").val(location13+", "+location12+", "+state+", "+country_name);    
        }



         /*if((location12 =='')||(location13 =='undefined')){
         $("#login_popup_leads_select_city2").val(location12+", "+state+", "+country_name);
     }else{

        $("#login_popup_leads_select_city2").val(location13+", "+location12+", "+state+", "+country_name);
    }*/

        // $("#login_popup_leads_select_city2").val(location13+","+location12+","+state+","+country_name);

        $("#login_popup_leads_select_city2").attr("readonly", "readonly");
        // $("#login_popup_leads_select_city2").attr("readonly", "readonly");


  }


/*Geo Location codes*/

/********************GOOGLE MAP LOCATION IN LEADS ENQUIRY FORM*************************************************************************/