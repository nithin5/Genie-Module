$(document).ready(function(){ 

//$("img.lazy").lazyload();
//LeftSidebar(); 
 
var user_id=$("#QuoteUserId").val();  
var login_type=$("#login_type").val();
var radios = $('input:radio[name=member_type]');
var genie_title=$("#genie_title").val();
var d = new Date();
var monthNames = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
var days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
var yr=d.getFullYear();
var day=d.getDate();
var mnthname=monthNames[d.getMonth()];
var dayname=days[d.getDay()];
var totday=day+' '+mnthname+' '+yr+', '+dayname;
$("#dpd1").val(totday);
var pg=$("#pg").val();
if(pg==2){
          $( "#tot_panel" ).removeClass( "camp_head" );
          $( ".page_h1" ).hide();
          $("#error_mobile_pos").hide();
          $('#top_mob').detach().appendTo("#bot_mob");
          $("#genie_add").addClass("rest_new");
          $("#my_location").show();
          $("#loggedin_section").show();
          $("#guest").show();
          $("#second_list").show();
          $("#one_icon_click_back").show();
          $('#quoteguestsave').show();
          $('#mobile_number').show();
          $('#avg_spent_mob').show();
          $('#dinnerid').show();
          $('#tot_quan').show();
          $('#need_offers_text').show();
          $('#second_list').show();
          $("#join_offer_club").hide(); 
          $("#two_icons").hide();
          $('#img_btm_dsk').hide();
          $('#img_btm_mob').hide();
          $('#one_icon_click_back').hide();
          $('#register_for_the_loginseller').hide();
          $('#tandc').hide();
 } 
 

if (top.location != location) {
            top.location.href = document.location.href ;
          }
            var nowTemp = new Date();
            var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
            var n = now.getUTCDate();
            var newdt= $('#dpd1').datepicker({
                format: 'dd-mm-yyyy'
            });
  
              $('#dpd2').datepicker({
                format: 'yyyy-mm-dd'
            });
             var checkin = $('#dpd1').datepicker({
                      onRender: function(date) {
                        return date.valueOf() < now.valueOf() ? 'disabled' : '';
                      }
           }).on('changeDate', function(ev) {
        
          var changedate=ev.date;
          var dinedate_timestamp=ev.timeStamp;
          $('#dinedate_timestamp').val(dinedate_timestamp);
          var monthNames = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
          var days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
          var yr=changedate.getFullYear();
          var day=changedate.getDate();
          var mnthname=monthNames[changedate.getMonth()];
          var dayname=days[changedate.getDay()];
          var totday=day+' '+mnthname+' '+yr+', '+dayname;
          var CDate = new Date(totday);
          if (ev.date.valueOf() < now.valueOf()){
                   $('.datepicker td'). attr('disabled', 'disabled');
          }  
          checkin.hide();
          var totday=day+' '+mnthname+' '+yr+', '+dayname;
          $('#dpd1').val(totday);
          $('#dpd1').datepicker('hide');
        }).data('datepicker');
if(user_id ==''){
                    if(genie_title==''){
                        $('#quotesave').hide();
                      }
}else{
      $('.some-class').hide();
      $('#member').show();
      $('#mobile_number').hide();
      $('#full_name').hide();
      $('#mydet').hide();
      $('#email').hide();
      $('#second_list').show();
}  

$("#login_popup_leads_select_city2").on('blur',function() {
var login_popup_leads_select_city3=$("#login_popup_leads_select_city2").val();
if((genie_title=='')||(genie_title==undefined)){
  if((login_popup_leads_select_city3=='')||(login_popup_leads_select_city3==undefined))  {
    $("#loc_desc").css("display","none");
    $('#login_popup_leads_select_city2').css("border-color","#ff0000");
    return false;
  }
  else{
    $('#login_popup_leads_select_city2').css("border-color","#dddddd");
    $('#error_city1').hide();
  }
}
else{
  if((login_popup_leads_select_city3=='')||(login_popup_leads_select_city3==undefined))  {
    $("#loc_desc").css("display","none");
    $('#login_popup_leads_select_city2').css("border-color","#ff0000");
    return false;
  }
  else{
    $('#login_popup_leads_select_city2').css("border-color","#dddddd");
    $('#error_city1').hide();
  }
}
}); 
$('input[id=member_type]').click(function(){
var test = $(this).val();
if(test == 0){//guest
           $('#member').hide();
           $('#guest').show();
           $('#mobile_number').show();
           $('#full_name').show();
           $('#mob_desc').text('');
           $('#mobile_number').css("border-color","#dddddd");
}else{//member
          $('#member').show();
          $('#guest').hide();
          $('#mobile_number').hide();
          $('#full_name').hide();
          $('#mob_desc').text('');
          $('#mobile_number').css("border-color","#dddddd");
}
});
if (window.innerWidth < 760){
      $("#productspec").focus(function(){
          $("#productspec").css('height','145px');   
      });
      $("#productspec").blur(function(){
          $("#productspec").css('height','34px');   
      });
  }
});//on load
function close_response(){
     $("#quote_response").hide();
     $("#quote_response1").hide();
}


function unique_count(){
  var unique_ip =$('#unique_ip').val();
  var top_cnt=$('#top_cnt').val();
  var logo_cnt=$('#logo_cnt').val();
  var button_cnt=$('#button_cnt').val();
  var dataString ='unique_ip='+unique_ip;
    $.ajax({
              type: "POST",
              url: '/genie/unique_count',
              data: dataString,
              cache: false,
              success: function(data,textStatus,xhr){ 
              } //success
          });//ajax
}
function check_mobile(){
    valid_mobile=/^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1}){0,1}98(\s){0,1}(\-){0,1}(\s){0,1}[1-9]{1}[0-9]{7}$/;
    var mobile_number=$("#mobile_number").val();
    if((mobile_number == '')||(!valid_mobile.test(mobile_number))){
           $('#mobile_number').css("border-color","#ff0000");
           document.getElementById("mobile_number").focus();
            return false;
    }
    else{
         $('#mobile_number').css("border-color","#dddddd");
    }
}
function formatDate(date) {
  var d = new Date(date),
       month = '' + (d.getMonth() + 1),
       day = '' + d.getDate(),
       year = d.getFullYear();
  if (month.length < 2) month = '0' + month;
  if (day.length < 2) day = '0' + day;
  return [year, month, day].join('-');
}
function hide_link(){
               $('#resend_code_btn_now').hide();
               $('#resend_code_btn').show();
}
/*Geo Location code*/          
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
/*Eof Geo Location code*/ 
function quote_save(){

  var cat_id=$("#seo_cat_id").val();
  var sub_cat_id=$("#seo_sub_cat_id").val();
  var direct_call=$("#direct_call_click").val();
  if(direct_call==0){
    cat_id=0;sub_cat_id=0;
  }

  var login_type=$("#genie_login_type").val();
  var camp_cat_type=$("#camp_cat_type").val();
  var pg=$("#pg").val();
  var check_controller=$("#check_controller").val();
  var genie_title=$("#genie_title").val();
  var unique_ip=$("#unique_ip").val();
  var lunch=$("input[name='lunch']:checked").val();
  var actual_link=$("#channel_type").val();
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
  var dindt_ts=$("#dinedate_timestamp").val();
  dindt_ts=Number(dindt_ts);
  var diningdate_form=$("#dpd1").val();
  var genie_up_flag=$("#genie_up_flag").val();
  var genie_up_user_id=$("#genie_up_user_id").val();
  var genie_up_guest_type=$("#genie_up_guest_type").val();
  var genie_up_member_type=$("#genie_up_member_type").val();
  var enquiry_up_id=$("#enquiry_up_id").val();
  var genie_url=$("#genie_url").val();
  var enquiry_time=$("#QuoteEnquiryTime").val();
  var formid=$("#QuoteFormid").val();
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
  var pub=$("#pub").val();
  var rest=$("#rest").val();
  var food=$("#food").val();
  if(pub=='on'){pub=1;}
  if(rest=='on'){rest=1;}
  var food=$("#food").val();
  var ischecked = $("#food").is(':checked');
  if(ischecked==false){
        food=0;
      }else{
            if(food==2){
              food=0;
            }
            else{
                  food=1;
            }
      }
  var email=$("#email").val();
  
  var check_cd=$("#check_cd").val();
  var otp_number=$('#otp_number').val();
  var member_type=$('#member_type').val();
  if(genie_up_flag ==1)//update mode
  {
  }
  else{//insert mode
   if(genie_title!=''){
                        if(second_time!=1){
                        if((pub ==0)&&(rest==0)&&(food==0)){
                            $("#rest").css("outline","1px solid #ff0000");
                                return false;
                              
                           }else{
                                $("#rest").css("outline"," #ddd");
                           }
                            var b2c=1;
                            var valid_mobile = /^[6-9]{1}[0-9]{9}$/;
                            if(pg==2){
                  if(mobile_number == '')  {
                          $('#mobile_number').css("border-color","#ff0000");
                          $(".mob_desc").html("<span style='color:#ff0000;border:2px'># 10 Digit No.</span>");
                    return false;
                  }
                  else{
                           if((!valid_mobile.test(mobile_number))){
                             $('#mobile_number').css("border-color","#ff0000");
                                $(".mob_desc").html("<span style='color:#ff0000;border:2px'># 10 Digit No.</span>");

                           }else{
                       $('#mobile_number').css("border-color","#dddddd");
                     }
                  }
              }
                           if($("#login_popup_leads_select_city2").val()=='')  {
                                $('#login_popup_leads_select_city2').css("border-color","#ff0000");
                                 return false;
                          }
                          else{
                               $('#login_popup_leads_select_city2').css("border-color","#dddddd");
                               $('#error_city1').hide();
                         }//city2
                         var valid_fname=/^[a-zA-Z. ]+$/;
                         }
                            if(food!=1){
                               if(diningdate_form ==''){
                                                      $("#dpd1").css("border-color","#ff0000");
                                                      return false;
                                 }else{
                                     $("#dpd1").css("border-color","#ddd");    
                                 }  
                              if((lunch =='')||(lunch ==undefined))
                              {
                                $("#lunch").addClass("error_lunch");
                                $("#lunch").css("outline","1px solid #ff0000");
                                return false;
                              }
                              else{
                                $("#lunch").removeClass("error_lunch");
                                $("#lunch").css("outline"," #ddd");
                              } 
                            }//food
                              var genie_title1;
                              var resto_pubs;
                              var final_title;
                              var valid_budget=/^[0-9 ]+$/;

                           
                                      if(lunch==1){genie_title1='Lunch on ';}
                                      if(lunch==2){genie_title1='Dinner on ';}
                                      if(lunch==5){genie_title1='Lunch/Dinner on '}
                                      if((pub==1)&&(rest==1)){
                                        resto_pubs='Pubs, Restaurants & Cafes';
                                     }
                                    else{
                                      resto_pubs=$('#resto_pubs').val();
                                    }
                                  resto_pubs='(Need Offers from '+resto_pubs+')';
                                  if(food!=1){      
                                    var dining_dt=diningdate_form;
                                    var genie_title2=genie_title1.concat(dining_dt);
                                     final_title=genie_title2.concat(resto_pubs);
                                  }else{
                                     final_title=resto_pubs;
                                    }
                                
                                //login_area1
                                  productspec=final_title;
                               
                            if(food!=1){
                                 if(quantity ==0)
                                    {
                                     $("#quantitybtn").css("border-color","#ff0000");
                                     $(".margcontby").css("border-color","#ff0000");
                                   return false;
                                    }
                                    else{
                                      $("#quantitybtn").css("border-color","#ddd");
                                      $(".margcontby").css("border-color","#ddd");
                                    } 
                                  
                                    if((budget =='') || (budget==undefined)||(budget==' '))  {
                                             $("#budget").css("border-color","#ff0000");
                                              return false;
                                    }
                                    else{
                                          
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
                                
                                  }//online ordering
                                   
                                  var otp_checked=1;
    }else{//normal genie
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
       if((quantity =='')||(quantity==undefined)||(quantity ==' '))
      {
       // $("#quantity").css("border-color","#ff0000");
       // return false;
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
      if((budget =='') || (budget==undefined)||(budget==' '))  {
         // $("#budget").css("border-color","#ff0000");
         //  return false;
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
       if($("#login_popup_leads_select_city2").val()=='')  {
                      $('#login_popup_leads_select_city2').css("border-color","#ff0000");
                      return false;
                      }
                      else{
                           $('#login_popup_leads_select_city2').css("border-color","#dddddd");
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
    }
}
$("#leadform_loading").show();
$("#LeadAddForm").hide();
if(genie_up_flag == 1){//update form datas
var dataString ='b2c='+b2c+'&productspec='+encodeURIComponent(productspec)+'&login_city='+login_city+
'&login_state='+login_state+'&login_area='+login_area+'&login_address='+login_address+
'&login_city1='+login_city1+'&login_area1='+login_area1+'&login_state1='+login_state1+
'&login_address1='+login_address1+'&login_state='+login_state+'&login_state1='+login_state1+
'&login_zone='+login_zone+'&login_zone1='+login_zone1+'&login_zones='+login_zones+
'&login_zones1='+login_zones1+'&login_lat='+login_lat+'&login_long='+login_long+'&login_lat1='+login_lat1+
'&login_long1='+login_long1+'&genie_up_flag='+genie_up_flag+'&genie_up_guest_type='+genie_up_guest_type+
'&genie_up_user_id='+genie_up_user_id+'&genie_up_member_type='+genie_up_member_type+
'&enquiry_up_id='+enquiry_up_id+'&quantity='+quantity+'&budget='+budget+'&check_controller='+check_controller+
'&genie_up_quote_id='+genie_up_quote_id+'&unique_ip='+encodeURIComponent(unique_ip)+
'&genie_url='+encodeURIComponent(genie_title)+
'&second_click='+second_click+'&cat_id='+cat_id+'&sub_cat_id='+sub_cat_id+'&pub='+pub+'&rest='+rest+
'&food='+food+'&otp_checked='+otp_checked;
 }
else{//insert form datas
 var dataString ='b2c='+b2c+'&userid='+user_id+'&productspec='+encodeURIComponent(productspec)+
 '&formid='+formid+'&login_city='+login_city+'&login_state='+login_state+'&login_area='+login_area+
 '&login_address='+login_address+'&login_city1='+login_city1+'&login_area1='+login_area1+
 '&login_state1='+login_state1+'&login_address1='+login_address1+'&enquiry_time='+enquiry_time+
 '&login_state='+login_state+'&login_state1='+login_state1+'&login_zone='+login_zone+
 '&login_zone1='+login_zone1+'&login_zones='+login_zones+'&login_zones1='+login_zones1+
 '&login_lat='+login_lat+'&login_long='+login_long+'&login_lat1='+login_lat1+'&login_long1='+login_long1+
 '&quantity='+quantity+'&budget='+budget+'&member_type='+member_type+'&full_name='+full_name+
 '&mobile_number='+mobile_number+'&unique_ip='+encodeURIComponent(unique_ip)+
 '&check_controller='+check_controller+'&genie_url='+encodeURIComponent(genie_title)+'&lunch='+lunch+
 '&second_click='+second_click+'&check_quote_id='+check_quote_id+'&email='+encodeURIComponent(email)+
 '&cat_id='+cat_id+'&sub_cat_id='+sub_cat_id+'&pub='+pub+'&rest='+rest+'&food='+food+'&otp_checked='+otp_checked+
 '&actual_link='+encodeURIComponent(actual_link)+'&login_type='+login_type+'&camp_cat_type='+camp_cat_type;
}
// if(unique_ip=='49.207.48.38'){
//   console.log(dataString);
//   exit();
// }
$("#pubsorresto").hide();
$("#totrestoimgcol").hide();
$("#restoimgs").hide();
$.ajax({
    type: "POST",
    url: '/genie/ajaxadd',
    data: dataString,
    cache: false,
    async: false, //async true- block window close
    success: function(data,textStatus,xhr){
      var obj=$.parseJSON(data);
      if(pg==2){
        obj['yes']=1;
      }else{
        obj['yes']=obj['yes'];
      }
      if(obj['yes']==1){
                        if(genie_title!=''){
                          if(food==1){
                               if((pub==1)||(rest==1)){
                                          if((pub==1)&&(rest==1)){
                                   if(pg==2){
  sub_url = 'https://www.xerve.in/offers/category-food-and-dining/subcategory-pubs%7Crestaurant/type-online/genie-club/';
                                  }else{
  sub_url ='https://www.xerve.in/offers/category-food-and-dining/subcategory-pubs%7Crestaurant/type-online/';
                                  }
                                                }
                                                else {
                                                  if(pub==1){
                                                    if(pg==2){
sub_url = 'https://www.xerve.in/offers/category-food-and-dining/subcategory-pubs/type-online/genie-club/';
                              }else{
sub_url = 'https://www.xerve.in/offers/category-food-and-dining/subcategory-pubs/type-online/';
                                               }
                                                  }
                                                  if(rest==1){
                                                    if(pg==2){
sub_url = 'https://www.xerve.in/offers/category-food-and-dining/subcategory-restaurant/type-online/genie-club/';
                              }else{
sub_url = 'https://www.xerve.in/offers/category-food-and-dining/subcategory-restaurant/type-online/';
                                              }
                                                  }
                                                }
                                        }
                                        else{
                           if(pg==2){
sub_url = 'https://www.xerve.in/offers/category-food-and-dining/sortby-distance/genie-club';
                              }else{

sub_url = 'https://www.xerve.in/offers/category-food-and-dining/city-bengaluru/sortby-distance';
                             }
                                        }
                            }//online
                            else{ 
                               if((pub==1)&&(rest==1)){
  sub_url = 'https://www.xerve.in/offers/category-food-and-dining/subcategory-pubs%7Crestaurant/type-nearby/city-bengaluru';

                             }
                               else if(rest==1){
  sub_url = 'https://www.xerve.in/offers/category-food-and-dining/subcategory-restaurant/type-nearby/city-bengaluru';

                                    }else{
  sub_url = 'https://www.xerve.in/offers/category-food-and-dining/subcategory-pubs/type-nearby/city-bengaluru';

                            }
               } //else
                    window.open(sub_url, '_self'); 
                    exit;
                        }//campaign
                        else{
                               $(".main_form").hide();
                               $("#otp_verify_form").show();
                               $('._quot-form').addClass('gienotp');
                               $("#otp_number").focus();
                               $("#guest_type").val(obj['guest']);
                               $("#check_quote_id").val(obj['quote_id']);
                               setTimeout(function () { hide_link(); }, 30000);
                        }
      }else{
             $("#guest_type").val(obj['guest']);
             $("#check_quote_id").val(obj['quote_id']);
             setTimeout(function () { hide_link(); }, 5000);
             $("#spec_content").css("display","none");
             $("#quan_desc").css("display","none");
             $("#bud_desc").css("display","none");
             $("#loc_desc").css("display","none");
             $("#fname_desc").css("display","none");
             $("#mob_desc").css("display","none");
             $("#totrestoimgcol").show();
             $("#otp_verify_form").hide();
             $("#pubsorresto").show();
             $(".main_form").show();
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
          $("#quantity").val("");
          $("#budget").val("");
          $("#gender").val("");
          $("#brand").val("");
          $("#size").val("");
          $("#color").val("");
          $("#mobile_number").val("");
          $("#dpd1").val("");
          $("#leadform_loading").hide();
          $("#quote_response").show();
          $("#quote_response1").show();
          $("#totrestoimgcol").show();
          $("#LeadAddForm").show();
    } //success
});//
//}   //if user_id; as there is now guest this condition is hided
} 
/*skip genie button*/
function listed_deals(){
    var genie_title=$("#genie_title").val();
    var quote_id=$("#check_quote_id").val();
    var pub=$("#pub").val();
    var rest=$("#rest").val();
    var food=$("#food").val();
    unique_count();
      if(pub=='on'){
        pub=1;
      }
      if(rest=='on'){
        rest=1;
      }
        var ischecked = $("#food").is(':checked');
        if(ischecked==false){
              food=0;
        }else{
              if(food==2){
                food=0;
              }
              else{
                    food=1;
              }
        }
           if(food==1){
                               if((pub==1)||(rest==1)){
                                          if((pub==1)&&(rest==1)){
                     sub_url ='https://www.xerve.in/offers/category-food-and-dining/type-nearby';
                                                }
                                                else {
                                                       if(pub==1){
                    sub_url = 'https://www.xerve.in/offers/category-food-and-dining/type-nearby';
                                                 }
                                                  if(rest==1){
                    sub_url = 'https://www.xerve.in/offers/category-food-and-dining/type-nearby';
                                                  }
                                                }
                                        }
                                        else{
                    sub_url = 'https://www.xerve.in/offers/category-food-and-dining/type-nearby';
                                        }
                            }//online
                            else{ 
                               if((pub==1)&&(rest==1)){
          sub_url = 'https://www.xerve.in/offers/category-food-and-dining/type-nearby';
                                            }
                                            else if(rest==1){
          sub_url = 'https://www.xerve.in/offers/category-food-and-dining/type-nearby';
                                    }else{
          sub_url = 'https://www.xerve.in/offers/category-food-and-dining/type-nearby';
                            }
    }
    var dataString ='quote_id='+quote_id;
           $.ajax({
                          type: "POST",
                          url: '/genie/offer_marker',
                          data: dataString,
                          cache: false,
                          async:true,
                          success: function(data,textStatus,xhr){ 
                          } 
    });
     if(genie_title!=''){
         window.open(sub_url, '_blank'); 
        }
      }
//});
/*eof skip genie button*/  
$( document ).on( 'click', '.genie_dropdown .dropdown-menu li', function( event ) {
      var $target = $( event.currentTarget );
    $target.closest('.genie_dropdown')
      .find('#budget').val($target.attr('value'))
      .end()
      .children('.dropdown-toggle').dropdown('toggle');
    $target.closest('.genie_dropdown')
        .find('#budget').text($target.context.textContent);
    return false;
  });

  $( document ).on( 'click', '.quan_dropdown .dropdown-menu li', function( event ) { 
    var $target = $( event.currentTarget );
    $target.closest('.quan_dropdown')
      .find('#quantity').val($target.attr('value'))
      .end()
      .children('.dropdown-toggle').dropdown('toggle');
    $target.closest('.quan_dropdown')
        .find('#quantity').text($target.context.textContent);
    return false;
  });
 
    $( document ).on( 'click', '.brand_dropdown .dropdown-menu li', function( event ) { 
      var $target = $( event.currentTarget );
    $target.closest('.brand_dropdown')
      .find('#brand').val($target.attr('value'))
      .end()
      .children('.dropdown-toggle').dropdown('toggle');
    $target.closest('.brand_dropdown')
        .find('#brand').text($target.context.textContent);
    return false;
  });


   $( document ).on( 'click', '.genie_dropdown .dropdown-menu li', function( event ) {
   $('.genie_dropdown').removeClass('open');
 });

 $( document ).on( 'click', '.quan_dropdown .dropdown-menu li', function( event ) {
   $('.quan_dropdown').removeClass('open');
 }); 

 $( document ).on( 'click', '.brand_dropdown .dropdown-menu li', function( event ) {
   $('.brand_dropdown').removeClass('open');
 }); 
 $(window).scroll(function () {
  if ($(this).scrollTop() > 10) {
    $(".genie_nav").hide();
  } else {
    $(".genie_nav").show();
  }
});
// if($('#ssIFrame_google').length) {
//              var google_sandbox = $('#ssIFrame_google').attr('sandbox')
//              google_sandbox += ' allow-modals'
//              $('#ssIFrame_google').attr('sandbox', google_sandbox)
// }   
function show_info_myaccount(user){$(".loading-header-hover").show();$.ajax({type:"POST",url:'/Generals/myaccount_info',data:"user="+user,success:"success",dataType:'text',context:document.body}).done(function(msg){$(".loading-header-hover").hide();var obj=jQuery.parseJSON(msg);user=obj.user;name=obj.name;like=obj.like;leads=obj.leads;company=obj.company;cash=obj.cash;wish=obj.like
 if(user=='seller'){$("#header_seller_section").show();$("#cash_value_seller").text(cash);$("#wish_value_seller").text(wish);$(".seller_name_header").text(company);$("#leads_value").text(leads);}
 else{$("#header_buyer_section").show();$("#cash_value_buyer").text(cash);$("#wish_value_buyer ").text(wish);$(".buyer_name_header").text(name);$("#leads_value").text(leads);}});}     