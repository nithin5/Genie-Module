/*code for geo location*/
$(document).ready(function(){
   // if (typeof google === 'object' && typeof google.maps === 'object') {
   //       }else{
   //      $.getScript('https://maps.googleapis.com/maps/api/js?v=3.26&libraries=places');

   //       }
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
    $("#login_popup_leads_select_city2").on('click',function(e) {
      e.preventDefault();
         $('#mobile_number').css("border-color","#dddddd");
         $('#mob_desc').text('');
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


});

  function edit_location() {
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
    }
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
                     var newzone = city.long_name +"";       
                }
                 if (results[0].address_components[i].types[b] == "country") {
                    country= results[0].address_components[i];   
                     country_name = country.long_name +"";          
                }
            }
        }
                            login_popup_leads_store_usersharelocdetails_locshare_myloc1();
                          
                             $('#share-location-login-popup-leads_myloc1').modal('hide');
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
               }
  function login_popup_leads_codeLatLngsearch_myloc1(userLatLng,address3) {
    var latlng = new google.maps.LatLng(lati, longi);
     var geocoder = new google.maps.Geocoder(); 
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[1]) {
             address99 = results[0].formatted_address;
             country_name=address3[0];                  
             state= address3[1];
             location12=address3[2];
             location13=address3[3];  
             for (var i=0; i<results[0].address_components.length; i++) {
                  for (var b=0;b<results[0].address_components[i].types.length;b++) {
                          if (results[0].address_components[i].types[b] == "sublocality_level_1") {
                                city= results[0].address_components[i];   
                                 var newzone = city.long_name +""; 
                            } 
                    }
            }
            if(state == null){
             $('#autocomplete12_myloc1_msg').show();
             $('#autocomplete12_myloc1_msg').text("* Please Choose a State");
             return false;
        }
            if(country_name != ' India'){
            $('#autocomplete12_myloc1_msg').show();
            $('#autocomplete12_myloc1_msg').text("* Please Choose  Locations Only From India");
              return false;
        }
                    country_name=address3[0];                   
                    state= address3[1];
                    location12=address3[2];
                    location13=address3[3];
                    location14=address3[4];
                    location15=address3[5];
                    login_popup_leads_store_usersharelocdetails_locshare_myloc1(address3);
                    $("#area_loc_check").text(newzone);
                    $('#share-location-login-popup-leads_myloc1').modal('hide'); 
                    return false;
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
        $("#area_loc_check").text("");
  }
   function login_popup_leads_store_usersharelocdetails_locshare_myloc1(){
        $("#login_popup_leads_country1").val(country_name);
        $("#login_popup_leads_state1").val(state);
        $("#login_popup_leads_latitude1").val(latitude99);
        $("#login_popup_leads_longitude1").val(longitude99);
        $("#lati").text(latitude99);
        $("#longi").text(longitude99);
        $("#loc_long").show();
        $("#loc_lat").show();
        $("#login_popup_leads_city1").val(location12);
        $("#login_popup_leads_area1").val(location13);
        $("#login_popup_leads_address1").val(address99);
         if(location13 == null){ 
                if(location12 != null){ 
                     $("#login_popup_leads_select_city2").val(location12);
                }
                else{
                     $("#login_popup_leads_select_city2").val(state+", "+country_name);
                }
        }
        else{
            $("#login_popup_leads_select_city2").val(location13+", "+location12);  
        }
          $('#loc_desc').css("display","block");
          $('#login_popup_leads_select_city2').css("border-color","#dddddd");
  }

/*EOF Geo Location codes*/
  function sel_budg(){
      var $target = $( event.currentTarget );
    $target.closest('.genie_dropdown')
      .find('#budget').val($target.attr('value'))
      .end()
      .children('.dropdown-toggle').dropdown('toggle');
    $target.closest('.genie_dropdown')
        .find('#budget').text($target.context.textContent);
    return false;
    $('.genie_dropdown').removeClass('open');
}

  function sel_quant(){ 
      var $target = $( event.currentTarget );
    $target.closest('.quan_dropdown')
      .find('#quantity').val($target.attr('value'))
      .end()
      .children('.dropdown-toggle').dropdown('toggle');
    $target.closest('.quan_dropdown')
        .find('#quantity').text($target.context.textContent);
    return false;
    $('.quan_dropdown').removeClass('open');
 }

function resend_code(){
          var otp_number=$("#otp_number").val();
          var guest_type=$("#guest_type").val();
          var check_quote_id=$("#check_quote_id").val();
          $("#need_otp_check").val(1);
          var url = window.location.href;
           url =url.split("?")[0]; 
          var dataString ='otp_number='+otp_number+'&guest_type='+guest_type+'&check_quote_id='+check_quote_id;
       $.ajax({
                      type: "POST",
                      url: '/genie/resend_otp',
                      data: dataString,
                      cache: false,
                      success: function(data,textStatus,xhr){ 
                             $("#resend_code_btn").hide();
                             $(".resend_msg").text('OTP SMS SENT');
                      } 
            });
}

function verify_guest_otp()
   {
          var otp_number=$("#otp_number").val();
          var guest_type=$("#guest_type").val();
          var check_quote_id=$("#check_quote_id").val();
          var check_cd=$("#check_cd").val();
           var pub=$("#pub").val();
           var rest=$("#rest").val();
           var genie_title=$("#genie_title").val();
           if(genie_title!=''){
               if(check_cd!=otp_number){
                  $('#otp_number').css("border-color","#ff0000");
                  return false;
               }
           }
          var url = window.location.href;
          url =url.split("?")[0]; 
          if(otp_number == '')  {
            $('#otp_number').css("border-color","#ff0000");
            return false;
          }
          else{
               $('#otp_number').css("border-color","#dddddd");
          }
        var dataString ='otp_number='+otp_number+'&guest_type='+guest_type+
        '&check_quote_id='+check_quote_id;
       $.ajax({
                      type: "POST",
                      url: '/genie/verify_guest_otp',
                      data: dataString,
                      cache: false,
                      success: function(data,textStatus,xhr){ 
                             var obj=$.parseJSON(data);
                              if(obj==1){
                                if(genie_title!=''){
                                        var sub_url;
                                }else{
                                          $('._quot-form').addClass('gienotp');
                                          $("#otp_verify_form").hide();
                                          $("#LeadAddForm").show();
                                          $("#quote_response").show();
                                          $("#quote_response1").show()
                                          $("#pubsorresto").show();
                                          $("#otp_number").val("");
                                          $(".main_form").show();
                                          $("#LeadAddForm")[0].reset();
                                          $("#productspec").val("");
                                          $("#quantity").val("");
                                          $("#budget").val("");
                                          $("#login_popup_leads_select_city2").val("");
                                          $("#pub").val("");
                                          $("#rest").val("");
                                          $("#full_name").val("");
                                          $("#dpd1").val("");
                                          $("#mobile_number").val("");
                                          $("#spec_content").css("display","none");
                                          $("#quan_desc").css("display","none");
                                          $("#bud_desc").css("display","none");
                                          $("#loc_desc").css("display","none");
                                          $("#fname_desc").css("display","none");
                                          $("#mob_desc").css("display","none"); 
                               }           
                               }else{
                                          $(".main_form").hide();
                                          $("#otp_verify_form").show();
                                          $("#invalid_otp").show();
                               }
                      } 
            });
 }

 function hide_link(){
               $('#resend_code_btn_now').hide();
               $('#resend_code_btn').show();
 }

function close_response(){
     $("#quote_response").hide();
     $("#quote_response1").hide();
}
function member_click_1(){
  var member_type=$('#member_type:checked').val();
    if(member_type == 0){
               $('#member').hide();
               $('#guest').show();
               $('#mobile_number').show();
               $('#full_name').show();
               $('#mob_desc').text('');
               $('#mobile_number').css("border-color","#dddddd");
    }else{
              $('#member').show();
              $('#guest').hide();
              $('#mobile_number').hide();
              $('#full_name').hide();
              $('#mob_desc').text('');
              $('#mobile_number').css("border-color","#dddddd");
    }
}

function quote_save(){
      var login_type=$("#genie_login_type").val();
      var fnb1=$("#fnb").val();
      if(fnb1==1){
        var fnb=1;
      }else{
        var fnb=0;
      }
      var check_controller=$("#check_controller").val();
      var genie_title=$("#genie_title").val();
      var unique_ip=$("#unique_ip").val();
      var brand=$("#skip_title_main").val();
      var one2one=1;
      var actual_link='g-3';
      var second_time=$("#second_time").val();
              if(second_time==1){
                var second_click=1;
              }else{
                var second_click=$("#second_click").val();
              }
      var mb=$("input[name='member_type']:checked").val();
      var check_quote_id=$("#check_quote_id").val();
      var todaydate=$("#today").val();
      todaydate= new Date(todaydate);
      var todaydate_ts=todaydate.getTime();
      var diningdate_form=$("#dpd1").val();
      var genie_up_flag=$("#genie_up_flag").val();
      var genie_up_user_id=$("#genie_up_user_id").val();
      var genie_up_guest_type=$("#genie_up_guest_type").val();
      var genie_up_member_type=$("#genie_up_member_type").val();
      var enquiry_up_id=$("#enquiry_up_id").val();
      var genie_url=$("#genie_url").val();
      var enquiry_time=$("#QuoteEnquiryTime").val();
      var formid=3;
      var user_id=$("#QuoteUserId").val();
      var member_type=$("#member_type").val();
      var need_otp_check=$("#need_otp_check").val();
      var genie_up_quote_id=$("#genie_up_quote_id").val();
      var mobile_number=$("#mobile_number").val();
      if((mobile_number==undefined)||(mobile_number=='undefined')){
        mobile_number='';
      }
      var full_name=$("#full_name").val();
      var login_lat=$("#login_popup_leads_latitude").val();
      var login_long=$("#login_popup_leads_longitude").val();
      var login_lat1=$("#login_popup_leads_latitude1").val();
      var login_long1=$("#login_popup_leads_longitude1").val();
      var login_city=$("#login_popup_leads_city").val();
      var login_state=$("#login_popup_leads_state").val();
      var login_area=$("#login_popup_leads_area").val();
      var login_address=$("#login_popup_leads_address").val();
      var login_zone=$("#login_popup_leads_zone").val();
      var login_zones=$("#login_popup_leads_zones").val();
      var login_city1=$("#login_popup_leads_city1").val();
      var login_state1=$("#login_popup_leads_state1").val();
      var login_area1=$("#login_popup_leads_area1").val();
      var login_address1=$("#login_popup_leads_address1").val();
      var login_zone1=$("#login_popup_leads_zone1").val();
      var login_zones1=$("#login_popup_leads_zones1").val();
      var quantity=$("#quantity").val();
      var budget=$("#budget").val();
      var cat_id=$("#seo_cat_id").val();
      var cat_name=$("#category_name_you").val();
      var sub_cat_id=$("#seo_sub_cat_id").val();
      var check_cd=$("#check_cd").val();
      var otp_number=$('#otp_number').val();
      var member_type=$('#member_type').val();
      var otp_checked=0;
                var b2c=$('input[name=b2c]:checked', '#LeadAddForm').val();
                        if((b2c==1)||(b2c==2)){
                          var b2cflag=1;
                        }
                        else{
                          var b2cflag=0;
                        }
                        if(b2cflag==0){
                              $('#b2c').css("border-color","#ff0000");
                            return false;
                        }
                        else{
                                $('#b2c').css("border-color","#dddddd");
                                $('#error_customer').hide();
                            }
                          var productspec=$("#productspec").val();
                          if((productspec == '')||(productspec == ' ')||(productspec == undefined)||(productspec == '  '))  {
                                          $('#productspec').css("border-color","#ff0000");
                                          return false;
                          }
                          else{
                               $('#productspec').css("border-color","#dddddd");
                               $('#error_msg_productspec').hide();
                          } 
             if((quantity =='')||(quantity==undefined)||(quantity ==' ')||(quantity ==0))
            {
            }
            else{
                   var valid_quantity=/^[0-9 ]+$/;
                 if(!valid_quantity.test(quantity)){
                           $('#quan_desc').css("display","block");
                           $('#quantity').css("border-color","#ff0000");
                           $("#quan_desc").html('<p class="col-xs-12 padding-0"># Quantity (in Units) - Only Numbers</p>');
                         }
                         else{
                               $("#quantity").css("border-color","#dddddd");
                               $("#error_quantity").hide();
                             }
            }

            if((budget =='') || (budget==undefined)||(budget==' ')||(budget==0))  {
           }
           else{
                  var valid_budget=/^[0-9 ]+$/;
                  if(!valid_budget.test(budget)){
                            $('#bud_desc').css("display","block");
                            $('#budget').css("border-color","#ff0000");
                            $("#bud_desc").html("# Budget (in Rs.) - Only Numbers");
                            return false;
                           }
                  else{
                            $("#budget").css("border-color","#dddddd");
                            $("#error_budget").hide();
                  }
          }
          if(fnb==0){
                if($("#login_popup_leads_select_city2").val()=='')  {
                            $('#login_popup_leads_select_city2').css("border-color","#ff0000");
                            return false;
                            }
                            else{
                                 $('#login_popup_leads_select_city2').css("border-color","#dddddd");
                            }
              }else{
                     var login_lat=$("#sharelatitude").val();
                     var login_long=$("#sharelongitude").val();
                     var login_lat1=$("#sharelatitude").val();
                     var login_long1=$("#sharelongitude").val();
                     var login_city=$("#shareareacityapp").val();
              }              
       
              if((mb=='')||(mb==undefined)){
                $("#member_type").css("outline","1px solid #ff0000");
                return false;
              }else{
                $("#member_type").css("outline","1px solid #dddddd");
                  if(member_type == 0){
                           var valid_fname=/^[a-zA-Z. ]+$/;
                           var valid_mobile = /^[6-9]{1}[0-9]{9}$/;
                  if((full_name =='')||(!valid_fname.test(full_name))||(full_name.length<3))
                                    {
                                     $("#full_name").css("border-color","#ff0000");
                                     return false;
                                    }
                                    else{
                                      $("#full_name").css("border-color","#ddd");
                                    }
                  if((mobile_number == '')||(!valid_mobile.test(mobile_number)))  {
                                      $('#mobile_number').css("border-color","#ff0000");
                                      $(".mob_desc").html("<span style='color:#ff0000;border:2px'># 10 Digit No.</span>");
                          return false;
                        }
                        else{
                             $('#mobile_number').css("border-color","#dddddd");
                        }
               }
              }          
       var dataString ='b2c='+b2c+'&productspec='+encodeURIComponent(productspec)+
       '&formid='+formid+'&login_city='+login_city+'&login_state='+login_state+'&login_area='+
       login_area+'&login_address='+login_address+'&login_city1='+login_city1+'&login_area1='+
       login_area1+'&login_state1='+login_state1+'&login_address1='+login_address1+'&enquiry_time='+
       enquiry_time+'&login_state='+login_state+'&login_state1='+login_state1+'&login_zone='+login_zone+
       '&login_zone1='+login_zone1+'&login_zones='+login_zones+'&login_zones1='+login_zones1+
       '&login_lat='+login_lat+'&login_long='+login_long+'&login_lat1='+login_lat1+'&login_long1='+
       login_long1+'&member_type='+member_type+'&full_name='+full_name+'&mobile_number='+mobile_number+
       '&unique_ip='+encodeURIComponent(unique_ip)+'&check_controller='+check_controller+
       '&genie_url='+encodeURIComponent(genie_title)+'&second_click='+second_click+'&check_quote_id='+
       check_quote_id+'&otp_checked='+otp_checked+'&actual_link='+encodeURIComponent(actual_link)+
       '&login_type='+login_type+'&budget='+budget+'&quantity='+quantity+'&brand='+
       encodeURIComponent(brand)+'&one2one='+one2one+'&cat_name='+encodeURIComponent(cat_name);
         $("#leadform_loading").show();
         $("#LeadAddForm").hide();    
      $.ajax({
          type: "POST",
          url: '/genie/form_submit',
          data: dataString,
          cache: false,
          async: false, //async true- block window close
          success: function(data,textStatus,xhr){
            var obj=$.parseJSON(data);
               if(obj['yes']==1){ //need otp
                                     $("#otp_verify_form").css("display","block");
                                     $('._quot-form').addClass('gienotp');
                                     $("#otp_number").focus();
                                     $("#guest_type").val(obj['guest']);
                                     $("#check_quote_id").val(obj['quote_id']);
                                     setTimeout(function () { hide_link(); }, 30000);
                }else{
                       $("#LeadAddForm").show();
                       $("#totrestoimgcol").show();
                       $("#otp_verify_form").hide();
                       $("#pubsorresto").show();
                       $(".main_form").show();
                       $("#quote_response").show();
                       $("#quote_response1").show();
                       $("#get_pricealert").show();
            }
                    $("#productspec").val("");
                    $("#b2c").val("");
                    $("#lati").text("");
                    $("#loc_lat").hide();
                    $("#longi").text("");
                    $("#loc_long").hide();
                    $("#login_popup_leads_select_city").val("");
                    $("#login_popup_leads_select_city2").val("");
                    $("#login_popup_leads_state").val("");
                    $("#login_popup_leads_state1").val("");
                    $("#login_popup_leads_area").val("");
                    $("#login_popup_leads_area1").val("");
                    $("#login_popup_leads_zone").val("");
                    $("#login_popup_leads_zone1").val("");
                    $("#login_popup_leads_zones").val("");
                    $("#login_popup_leads_zones1").val("");
                    $("#login_popup_leads_address").val("");
                    $("#login_popup_leads_address1").val("");
                    $("#login_popup_leads_autocomplete_myloc").val("");
                    $("#change_location_ad99_login_popup_leads_myloc").text('');
                    $("#login_popup_leads_autocomplete_myloc1").val("");
                    $("#change_location_ad99_login_popup_leads_myloc1").empty();
                    $("#spec_content").css("display","none");
                    $("#quan_desc").css("display","none");
                    $("#bud_desc").css("display","none");
                    $("#loc_desc").css("display","none");
                    $("#fname_desc").css("display","none");
                    $("#mob_desc").css("display","none");
                    $("#quantity").val("");
                    $('#quantitybtn li').text('Group Size');
                    $("#budget").val("");
                    $("#budgetbtn li").text('Please Select');
                    $("#mobile_number").val("");
                    $("#dpd1").val("");
                    $("#leadform_loading").hide();
          } ,
              error: function (error) {
          }

      });//

}
