$(document).ready(function(){
   
var pg=$("#pg").val();
var second_time=$("#second_time").val();
var user_id=$("#QuoteUserId").val();

$("#spec_content").css("display","block");
var quantity=$("#quantity").val();
var productspec=$("#productspec").val();

var budget=$("#budget").val();
var mobile_number=$("#mobile_number").val();
var login_popup_leads_select_city3=$("#login_popup_leads_select_city2").val();
if(quantity!=''){
$('#quan_desc').html('<p class="col-xs-12 padding-0"># Quantity in Units - <a onclick="quantityfocus();" style="color:#1569C7">Edit Now</a></p>');
}
if(budget!=''){
$("#bud_desc").html('<p class="col-xs-12 padding-0"># Budget (Amount in Rs.) - <a onclick="budgetfocus();" style="color:#1569C7">Edit Now</a></p>');
}

if(login_popup_leads_select_city3!=''){ 
          $('#login_popup_leads_select_city2').css("border-bottom", "1px solid #ddd");
}

if(user_id!=0){
          
         $("#tot_quan").show();
         $("#dinnerid").show();
      
         $("#avg_spent_mob").show(); 
         $("#need_offers_text").show();
         $("#error_mobile_pos").hide(); 
         $("#second_list").show();  
         $("#loc_dis").show();
         $("#loc_head").show();
         $("#loc_head_mob").show(); 
         
         $( "#quoteguestsave_bef" ).hide();   
         $( "#quoteguestsave" ).show(); 
        

        }else{
            
}

  if(second_time==1){

  var mb_no=$("#check_mb_no").val();
  var q_id=$("#check_eq_id").val();
  var cd_id=$("#check_cd_code").val();
 
  $("#check_quote_id").val(q_id);
  $("#check_mob_no").val(mb_no);
  $("#check_cd").val(cd_id);

   $("#mob_otp").show();
   $("#mob_otp").html(mb_no);

  $("#second_list").show();
  $("#tot_quan").show();
  $("#dinnerid").show();
  $("#avg_spent_mob").show();
  $("#otp_all").show();

  $("#show_offers_off").hide();
  $("#join_offer_club").hide();
  $("#need_offers_text").show();
  $("#bpp_dsk").show();
  $("#bpp_mob").show();
  $("#tot_quan").show();
  $("#loc_dis").hide();
  $("#loc_head").show();
  $("#loc_head_mob").hide();
  $("#quoteguestsave").show();
  $("#quoteguestsave_bef").hide();
  
  $("#tandc").hide();

}             
  

$("#mobile_number").on('click',function() {
   
       $('#mobile_number').css("border-color","#000");
       $('#mobile_number').css("border-bottom","1px");
       $('#mobile_number').css("border-style","solid");
       $('#mob_desc').text('');
       $("#error_mobile_pos").css('text-align','center');
       $("#error_mobile_pos").css('color','#777');
       $('#error_mobile_pos').html('# Get Free Access');
       $('#validate_login').hide();

}); 


$('#drop_down_brand li').on('click select',function(){
    var brand=$('#drop_down_brand').val();
    var brand1= this.value;
    
      if(brand1==1){
           $('#resto_pubs').val('Samsung');
      }
      if(brand1==2){
           $('#resto_pubs').val('Honor');
      }
      if(brand1==3){
           $('#resto_pubs').val('Redmi');
      }
})


$("#quoteguestsave_bef").on('click touchstart touch',function(e) {

   e.preventDefault();
  
  var offline=$("#offline").val();
  var off_mar_url=$("#off_mar_url").val();
  var camp_cat_type=$("#camp_cat_type").val();
  if(offline==1){
                 //window.open(off_mar_url, '_blank');
                 window.location.replace(off_mar_url) ;

  }
  if(camp_cat_type==2){
        
         $(".hide_mob").hide();
         $(".show_mob").show();
         $("#quan_outer_div").css("width","92%");
  }

  var login_type=$("#genie_login_type").val();
  var todaydate=$("#today").val();
  todaydate= new Date(todaydate);
  var check_controller=$("#check_controller").val();
  var unique_ip=$("#unique_ip").val();
  var diningdate_form=$("#dpd1").val();
  var genie_title=$("#genie_title").val();
  var mobile_number=$("#mobile_number").val();
  var full_name=$("#full_name").val();
  var lunch=$("input[name='lunch']:checked").val();
  var enquiry_time=$("#QuoteEnquiryTime").val();
  var formid=$("#QuoteFormid").val();
  var email=$("#email").val();
  var actual_link=$("#channel_type").val();
  var user_id=$("#QuoteUserId").val();
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
  var second_click=$("#second_click").val();
  var pub=$("#pub").val();
  if(pub=='on'){pub=1;}
  var rest=$("#rest").val();
  if(rest=='on'){rest=1;}
  var food=$("#food").val();
  if(offline==1){
    return false;
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
  var cat_id=$("#seo_cat_id").val();
  var sub_cat_id=$("#seo_sub_cat_id").val();
  if(genie_title!=''){
                      if(camp_cat_type==1){

                         if((pub ==0)&&(rest==0)&&(food==0)){
                            $("#rest").css("outline","1px solid #0066ff");
                              return false;
                         }else{
                             $("#rest").css("outline"," #ddd");
                         }
                      }   

  }
  if(genie_title==''){   
           if($("#login_popup_leads_select_city2").val()=='')  {
              $('#login_popup_leads_select_city2').css("border-color","#0066ff");
              return false;
              }
              else{
                   $('#login_popup_leads_select_city2').css("border-color","#ddd");
              }
 }else{
       if($("#login_popup_leads_select_city2").val()=='')  {
              $('#login_popup_leads_select_city2').css("border-color","#0066ff");
      return false;
    }
    else{
         $('#login_popup_leads_select_city2').css("border-color","#ddd");
         $('#error_city1').hide();
    }//city2
 }
if((user_id=='')||(user_id==0)){
      if(genie_title!=''){//for campaign
               var valid_fname=/^[a-zA-Z. ]+$/;
  }
var member_type=0;
      if(member_type == 0){
                    var valid_mobile = /^[6-9]{1}[0-9]{9}$/;
                     if(mobile_number == '')  {
                                   // $('#mobile_number').css("border-color","#0066ff");
                                   // $("#mobile_number").css("border-bottom", "1.5px");
                                   //  $("#mobile_number").css("border-style", "solid");
                                    $("#mobile_number").css("border-bottom", "1.5px solid #0066ff");
                                    $("#error_mobile_pos").show();
                                    $("#error_mobile_pos").css('text-align','center');
                                    $("#error_mobile_pos").css('color','#0066ff');
                                    //$("#error_mobile_pos").css('padding-left','40px');
                                    $("#error_mobile_pos").html('# Get Free Access');
                                    $("#mobile_number").focus();
                                    $('#validate_login').show();
                        return false;
                  }
                  else{ 
                               if((mobile_number.length<10)||(!valid_mobile.test(mobile_number))) { 
                                  // $('#mobile_number').css("border-color","#0066ff");
                                  // $("mobile_number").css("border-bottom", "1.5px");
                                  //   $("mobile_number").css("border-style", "solid");
                                  $("#mobile_number").css("border-bottom", "1.5px solid #0066ff");
                                  $("#error_mobile_pos").show();
                                  $("#error_mobile_pos").html('# 10 Digit No.');
                                 return false;
                               }else{
                                      // $('#mobile_number').css("border-color","#000");
                                      // $("mobile_number").css("border-bottom", "1px");
                                      // $("mobile_number").css("border-style", "solid");
                                      $("#mobile_number").css("border-bottom", "1px solid #000");
                                      $("#error_mobile_pos").css('text-align','center');
                                      $("#error_mobile_pos").html('# Get Free Access');
                                      //$("#error_mobile_pos").hide();
                                      $('#validate_login').hide(); 
                             }
                  }
      }
  } 
 if((genie_title=='')||(genie_title==' ')){
    var productspec=$("#productspec").val();
      if((productspec == '')||(productspec == ' ')||(productspec == undefined)||(productspec == '  '))  {
                      $('#productspec').css("border-bottom", "1.5px solid #0066ff");
                      return false;
      }
      else{
           $('#productspec').css("border-bottom", "1.5px solid #000");
           $('#error_msg_productspec').hide();
      }
}
else{
       var productspec='F & B Club';
       if(camp_cat_type==2){
                     productspec='Mobile Club';//to be changed
       }
 }
if ( $("#mydet").hasClass( "mydet_cla" ) ) {
    $( "div#mydet" ).removeClass( "mydet_cla");
  }
  $('#loggedin_section').show();

  // alert("clciked");
var b2c=1;
var formid=2;
var dataString ='b2c='+b2c+'&userid='+user_id+'&productspec='+encodeURIComponent(productspec)+
'&formid='+formid+'&login_city='+login_city+'&login_state='+login_state+'&login_area='+login_area+
'&login_address='+login_address+'&login_city1='+login_city1+'&login_area1='+login_area1+
'&login_state1='+login_state1+'&login_address1='+login_address1+'&enquiry_time='+enquiry_time+
'&login_state='+login_state+'&login_state1='+login_state1+'&login_zone='+login_zone+'&login_zone1='+login_zone1+
'&login_zones='+login_zones+'&login_zones1='+login_zones1+'&login_lat='+login_lat+
'&login_long='+login_long+'&login_lat1='+login_lat1+'&login_long1='+login_long1+
'&quantity='+quantity+'&budget='+budget+'&member_type='+member_type+'&full_name='+full_name+
'&mobile_number='+mobile_number+'&unique_ip='+encodeURIComponent(unique_ip)+
'&check_controller='+check_controller+'&genie_url='+encodeURIComponent(genie_title)+
'&second_click='+second_click+'&email='+encodeURIComponent(email)+'&cat_id='+cat_id+
'&sub_cat_id='+sub_cat_id+'&pub='+pub+'&rest='+rest+'&food='+food+
'&actual_link='+encodeURIComponent(actual_link)+'&login_type='+login_type;
   $.ajax({
    type: "POST",
    url: '/genie/ajaxadd',
    data: dataString,
    cache: false,
    async: true, //blocks window close
    success: function(data,textStatus,xhr){
      var obj=$.parseJSON(data);
      
            // alert(obj['quote_id']);
             $("#check_quote_id").val(obj['quote_id']);
             $("#check_mob_no").val(obj['mobile_number']);
             $("#check_cd").val(obj['cd']);
                         var food_1=obj['food'];
                         var rest_1=obj['rest'];
                         var pub_1=obj['pub'];
                           if(food_1==1){
                                         if((pub_1==1)||(rest_1==1)){
                                             $("#food_combo").show();
                                            }else{
                                              $("#food_combo").hide();
                                             }  
                           }else{
                                   if((pub_1==1)||(rest_1==1)){
                                    $("#food_combo").show();
                                  }
                           }
               if(login_type=='social_login'){
                 $("#otp_all").hide(); 
                 $("#otp_mob").hide();
                 $("#otp_number").hide();
                 $("#mob_otp").hide();
                 $("#resend_code_btn").hide();

               
           }else{
                 $("#otp_all").hide(); 
                 $("#otp_mob").hide();
                 $("#otp_number").hide();
                 $("#mob_otp").hide();
                 $("#resend_code_btn").hide();
           }
          
             $("#genie_add").addClass("rest_new");
             $('#leadform_loading').hide();
             $("#validate_login").hide();
             //$("#pubsorresto").show();
             $("#second_click").val(1);
             $("#spec_content").css("display","none");
             $("#quan_desc").css("display","none");
             $("#bud_desc").css("display","none");
             $("#loc_desc").css("display","none");
             $("#fname_desc").css("display","none");
             $("#mob_desc").css("display","none");
             $("#totrestoimgcol").show();
             $("#pubsorresto").show();
             $(".main_form").show();
             $("#totrestoimgcol").show();
             $("#LeadAddForm").show();
             $('#login_popup_leads_select_city2').blur();
             $('#dpd1').blur();
             
            
    } 
});
  
             
             
             $("#fbgooglelogin").hide();
             $("#join_offer_club").hide();
            
            
            $( "#tot_panel" ).removeClass( "camp_head" );
            $( ".page_h1" ).hide();
            $("#quoteguestsave_bef").hide();

            $("#tandc").hide();
            $("#img_btm_dsk").hide();
            $("#img_btm_mob").hide();
            $("#top_mob_display").hide();
            $('#quoteguestsave').show();
            $("#need_offers_text").show();
            $("#tot_quan").show();
             $("#dinnerid").show();
             $("#avg_spent_mob").show();
             $("#deals_tab").show();
            $("#bpp_dsk").show();
            $("#bpp_mob").show();
            $("#tot_quan").show();
            $("#loc_head").show();
            $("#second_list").show();
 
}); 


 $('#food').on('change',function() {
    
       var test_food = $(this).val();
       var ischecked = $(this).is(':checked');
       var pubchecked = $('#pub').is(':checked');
       var restchecked = $('#rest').is(':checked');
      
       var rest=$('#rest').val();
       var pub=$('#pub').val();
       if(ischecked==false){
     
              if((pubchecked==1)||(restchecked==1)){
                   
                   $("#food_combo").show();
                               if((pubchecked==1)&&(restchecked==1)){
                                     $('#resto_pubs').val('Pubs, Restaurants & Cafes');
                               }else{
                                      if(pubchecked==1){
                                           $('#resto_pubs').val('Pubs');
                                      }else{
                                           $('#resto_pubs').val('Restaurants & Cafes');
                                      }
                               }
              }else{
                 $("#food_combo").hide();
              }
           $('#food').val(0);
              
       }else{
          
             $("#rest").css("outline"," #ddd");
                  if((pubchecked==1)||(restchecked==1)){
                  
                   $("#food_combo").show();
              }else{
                   
                  $("#food_combo").hide();
                  $('#resto_pubs').val('Online Food Ordering');
              }
                 $('#food').val(1);
               
               
               
                
       }

    });
$('#pub').on('change',function() {  
  var test_pub = $(this).val();
  
  var ischecked = $(this).is(':checked');
  
  var rest=$('#rest').val();
  var food=$('#food').val();


 
  if(rest=='on'){rest=1;}
  if(food=='on'){food=1;}
  
      if(ischecked==false){
        $('#pub').val(0);
        if(rest==1){ 
              
                    $("#rest").css("outline"," #ddd");
                    $('#food').val(0);
                    $("#food_combo").show();
                    $('#avg_spent').text('Budget (Per Person)');
                    $('#resto_pubs').val('Restaurants & Cafes');
                    $('.text-valu2').val(500);
                    $('.text-valu2').text('Rs. 500');
                    $('.text-valu2').attr("selected","true");

                    
            }else{
              
                  $('#avg_spent').text('Budget (Per Person)');
                                 
                  var food_checked = $('#food').is(':checked');
                  
                  if(food_checked==1){
                     
                     $('#food').val(1);
                     $("#food_combo").hide();
                  }else{
                    
                    $('#food').val(0);
                    $("#food_combo").show();

                  }
                  $('.text-valu2').val(500);
                  $('.text-valu2').text('Rs. 500');
                  $('.text-valu2').attr("selected","true");
                  $('#drop_down_price').val(500);
                 
            }
      }else{
      $('#pub').val(1);
        if(rest==1){
           
              $('#avg_spent').text('Budget (Per Person)');
              $('#food').val(0);
              $("#rest").css("outline"," #ddd");
              $("#food_combo").show();
              $('#resto_pubs').val('Pubs,Restaurants & Cafes');
              $('.text-valu2').val(500);
              $('.text-valu2').text('Rs. 500');
              $('.text-valu2').attr("selected","true");
              $('#drop_down_price').val(500);

              
            }else{
             
              $("#rest").css("outline"," #ddd");
              $('#food').val(0);
              $("#food_combo").show();
             
               
              $('#avg_spent').text('Budget (Per Person)');
              $('#resto_pubs').val('Pubs');
              $('.text-valu2').val(500);
              $('.text-valu2').text('Rs. 500');
              $('.text-valu2').attr("selected","true");
              $('#drop_down_price').val(500);

              
            }
      }
});

  $('#rest').on('change',function() {  
   var ischecked = $(this).is(':checked');
   var pub=$('#pub').val();
   var food=$('#food').val();
   if(pub=='on'){pub=1;}
   if(food=='on'){food=1;}
   if(ischecked==false){
    $('#rest').val(0);
     if(pub==1){
                
                $('#avg_spent').text('Budget (Per Person)');
                $("#rest").css("outline"," #ddd");

               
                 $('#food').val(0);
                 $("#food_combo").show();
                $('#resto_pubs').val('Pubs');
                $('.text-valu2').val(500);
                $('.text-valu2').text('Rs. 500');
                $('.text-valu2').attr("selected","true");
                $('#drop_down_price').val(500);
               
                
              }else {  
              
                  var food_checked = $('#food').is(':checked');
        
                  if(food_checked==1){
                     
                     $('#food').val(1);
                     $("#food_combo").hide();
                  }else{
                   
                    $('#food').val(0);
                    $("#food_combo").show();

                  }
               
                $('#avg_spent').text('Budget (Per Person)');
               
                
                $('.text-valu2').val(500);
                $('.text-valu2').text('Rs. 500');
                $('.text-valu2').attr("selected","true");
                $('#drop_down_price').val(500);
                
              }
  }else{
            $('#rest').val(1);
            if(pub==1){
              
               $("#rest").css("outline"," #ddd");
               
                $('#avg_spent').text('Budget (Per Person)');
               
                $('#food').val(0);
                $("#food_combo").show();
                $('#resto_pubs').val('Pubs,Restaurants & Cafes');
                $('.text-valu2').val(500);
                $('.text-valu2').text('Rs. 500');
                $('.text-valu2').attr("selected","true");
                $('#drop_down_price').val(500);
                
              }else{    
               
                $("#rest").css("outline"," #ddd"); 
                
                $('#avg_spent').text('Budget (Per Person)');
                $('#resto_pubs').val('Restaurants & Cafes');
                
                $('#food').val(0);
                $("#food_combo").show();

                $('.text-valu2').val(500);
                $('.text-valu2').text('Rs. 500');
                $('.text-valu2').attr("selected","true");
                 $('#drop_down_price').val(500);
                
              }
  }
});

 $("#lunch").on('click',function() {

 $('#mobile_number').css("border-bottom", "1.5px solid #0066ff");
 $('#mob_desc').text('');
});

  

}); 

function join_genie(){
  var check_quote_id=$("#check_quote_id").val();
  var check_mob_no=$("#check_mob_no").val();
  var dataString ='quote_id='+check_quote_id+'&mobile_no='+check_mob_no;
    $.ajax({
                      type: "POST",
                      url: '/genie/join_genie_sms',
                      data: dataString,
                      cache: false,
                      success: function(data,textStatus,xhr){ 
                        var obj=$.parseJSON(data);
                        $("#check_quote_id").val(obj['quote_id']);
                        $("#check_mob_no").val(obj['mobile_no']);
                        $("#mob_otp").show();
                        $("#mob_otp").html('('+obj['mobile_no']+')');
                      } 
            });
  }


function two_icon_click(){
   $("#two_icons").hide();
   $("#my_location").show();
   $("#loggedin_section").show();
   $("#guest").show();
   $("#second_list").show();
   $("#one_icon_click_back").show();
   $('#quoteguestsave').show();
}
function one_icon_click(){
var genie_title=$("#genie_title").val();
var quote_id=$("#check_quote_id").val();
var pub=$("#pub").val();
var rest=$("#rest").val();
var food=$("#food").val();
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
                                    sub_url ='https://www.xerve.in/offers/category-food-and-dining/subcategory-pubs%7Crestaurant/sortby-distance';
                                                }
                                                else {
                                                       if(pub==1){
                                                 sub_url = 'https://www.xerve.in/offers/category-food-and-dining/subcategory-pubs/sortby-distance';
                                                  }
                                                  if(rest==1){
                                                sub_url = 'https://www.xerve.in/offers/category-food-and-dining/subcategory-restaurant/sortby-distance';
                                                  }
                                                }
                                        }
                                        else{
                             sub_url = 'https://www.xerve.in/offers/category-food-and-dining/sortby-distance';
                                        }
                            }//online
                            else{ 
                               if((pub==1)&&(rest==1)){
                                sub_url = 'https://www.xerve.in/offers/category-food-and-dining/subcategory-pubs%7Crestaurant/sortby-distance';
                                            }
                                            else if(rest==1){
                                sub_url = 'https://www.xerve.in/offers/category-food-and-dining/subcategory-restaurant/sortby-distance';
                                    }else{
                                sub_url = 'https://www.xerve.in/offers/category-food-and-dining/subcategory-pubs/sortby-distance';
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
function one_icon_click_back(){
   $('#two_icons').show();
   $('#loggedin_section').hide();
   $("#my_location").show();
   $('#quoteguestsave').hide();
   $("#one_icon_click_back").hide();
}
function show_info_myaccount(user,click) {
        var user_id = user;
        var user = $("#User_Id").val();
         if (user!='') {
        $.ajax({
            type: "POST",
            url: '/Generals/myaccount_info',
            data: "user=" + user,
            success: "success",
            dataType: 'text',
            context: document.body
        }).done(function (msg) {
            $(".loading-header-hover").hide();
            var obj = jQuery.parseJSON(msg);
            user = obj.user;
            name = obj.name;
            like = obj.like;
            leads = obj.leads;
            company = obj.company;
            cash = obj.cash;
            wish = obj.like
            profile_pic = obj.profile_pic;
            var my_wishlist_count = obj.my_wishlist_count;
            var my_brand_club = obj.my_brand_club;
            var my_offline_price = obj.my_offline_price;
            var my_enquiries = obj.my_enquiries;
            var mylead_proposal = obj.mylead_proposal;
            var my_price_drop = obj.like;
            var mylead_credi = obj.mylead_credit;
            if (user=='NO') {
                $("#after-login-drop").hide();
                $(".header-logo-cashback-area").hide();
                $("#before-login-drop").show();
                $(".buyers-sellers-diff-before").show();
                $(".buyers-sellers-diff-after").hide();
            }else{
                if(click == 1){
                                    if(profile_pic!='' && profile_pic!=null && profile_pic!=undefined){
                                        var img_src_profile = "https://d372i0x0rvq68a.cloudfront.net/"+user_id+"/"+profile_pic;
                                        var html= '<div id="login-drop" class="face_profile_pic" ><img style="border-radius:100%" class="img-responsive " src="'+img_src_profile+'" onclick="show_info_myaccount('+user_id+',0);show_dropmenu_links();" /></div>';
                                        $(".opennav_header").html(html);
                                    }
                                    else{
                                        var first_letter = name.substring(0, 1);
                                        image_html = '<div id="login-drop" class="letter_background">'+first_letter+'</div>';
                                        $(".opennav_header").html(image_html);
                                    }
                                }
            if (user == 'seller') {
                $("#header_seller_section").show();
                $("#header_buyer_section").hide();
                $("#cash_value_seller").html('<i class="fa fa-rupee"></i>' + ' ' + cash);
                $("#wish_value_seller").text(wish);
                $(".seller_name_header").text(company);
                $("#leads_value").text(leads);
                $("#mylead_proposal_my").text(mylead_proposal);
                $("#mylead_credi_my").text(mylead_credi);
                var dynamic_val ="header_seller_section";
            } else {
                $("#header_buyer_section").show();
                var dynamic_val ="header_buyer_section";
                $("#header_seller_section").hide();
                $("#cash_value_buyer").html('<i class="fa fa-rupee"></i>' + ' ' + cash);
                $("#wish_value_buyer ").text(wish);
                $(".buyer_name_header").text(name);
                $("#leads_value").text(leads);
            }
                $("#"+dynamic_val+" #my_wishlist_count_my").text(my_wishlist_count);
                $("#"+dynamic_val+" #my_brand_club_my").text(my_brand_club);
                $("#"+dynamic_val+" #my_offline_price_my").text(my_offline_price);
                $("#"+dynamic_val+" #my_enquiries_my").text(my_enquiries);
                $("#"+dynamic_val+" #my_price_drop_my").text(my_price_drop);
            $(".wishlist_in_header").text('(' + wish + ')');
            $('.cashback_in_header').html('<i class="fa fa-rupee"></i>' + cash + '');
            $(".buyers-sellers-diff-after").show();
        }
        });
      }
    }
function restimg(){
   var mobile_number=$("#mobile_number").val();
   if(mobile_number == ''){
                                   $('#mobile_number').css("border-bottom", "1.5px solid #0066ff");
                                   // $("mobile_number").css("border-bottom", "1.5px");
                                   // $("mobile_number").css("border-style", "solid");
                                   $("#error_mobile_pos").show();
                                   $("#error_mobile_pos").css('text-align','center');
                                   $("#error_mobile_pos").css('color','#0066ff');
                                   //$("#error_mobile_pos").css('padding-left','40px');
                                   $("#error_mobile_pos").html('# Get Free Access');
                                   $("#mobile_number").focus();
                                   $('#validate_login').show();
                                   return false;
                  }else{
                                    $('#mobile_number').css("border-bottom", "1px solid #000");
                                    // $("mobile_number").css("border-bottom", "1px");
                                    // $("mobile_number").css("border-style", "solid");
                                    $("#error_mobile_pos").html('');
                                    $("#error_mobile_pos").hide();
                                    $('#validate_login').hide(); 
              }
  }
  
 function best_deals(){


   
   $("#best_deals").addClass("active");
   $("#listed_deals").removeClass("active");

 
}




 