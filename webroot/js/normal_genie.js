$(document).ready(function(){ 
$("#genie_multioffer").on('click touchstart',function(e) {
  //e.preventDefault();
  
   $("#genie-contact-seller").removeClass("active");
   $("#genie_multioffer").addClass("active");
   $("#seller_select").hide();
   $("#direct_call_click").val(0);
   first_seller_call(0);
   
   $("#LeadAddForm").show();  
   $(".main_form").show(); 
 });

$("#genie-contact-seller").on('click touchstart',function(e) {
   //e.preventDefault();
  
    first_seller_call(1);
   $("#genie_multioffer").removeClass("active");
   $("#genie-contact-seller").addClass("active");
   $("#LeadAddForm").hide();
   $("#direct_call_click").val(1);
   
   $(".main_form").hide();  
   $("#seller_select").show();
   

});

$("#productspec").on('click',function() {
  var genie_title =$('#genie_title').val();
  var productspec=$("#productspec").val();
  if((genie_title=='')||(genie_title==undefined)){
     $('#spec_content').text('# Please Provide Details.');  
     $('#mobile_number').css("border-color","#dddddd");
     $('#mob_desc').text('');
  }
});
$("#productspec").on('blur',function() {
var genie_title =$('#genie_title').val();
var productspec =$('#productspec').val();
    if((genie_title=='')||(genie_title==undefined)){
            if(productspec == '')  {
                    $('#spec_content').css("display","none");
                    $('#productspec').css("border-color","#ff0000");
                    return false;
            }
            else{
                    $('#productspec').css("border-color","#dddddd");
                    $('#spec_content').text('');  
                    $('#spec_content').css("display","block");
                    $('#error_msg_productspec').hide();
            } 
    }
    else{
    }
});
/*quantity*/
$("#quantity").on('click select',function() {
var genie_title =$('#genie_title').val();
var quantity=$("#quantity").text();
var quan=$(".demo_quan").text();
var newd=$('#tot_quan li:selected').val();
var productspec=$("#productspec").val();
if((genie_title=='')||(genie_title==undefined)){//normal url
   $('#quan_desc').css("display","block");  
   $('#quan_desc').html('<p class="col-xs-12 padding-0"># Quantity (Units) - Only Numbers</p>'); 
   $('#mobile_number').css("border-color","#dddddd");
   $('#mob_desc').text('');
}else{
}
 
});
$("#quantity").on('blur',function() {
var genie_title =$('#genie_title').val();
var quantity=$("#quantity").val();
var valid_quantity=/^[0-9 ]+$/;
if((genie_title=='')||(genie_title==undefined)){
  if(quantity == '')
  {
    // $('#quan_desc').css("display","none");  
    // $('#quantity').css("border-color","#ff0000");
    // return false;
  }
  else{
        if(!valid_quantity.test(quantity)){
          $('#quan_desc').css("display","block");
          $('#quantity').css("border-color","#ff0000");
          $("#quan_desc").html('<p class="col-xs-12 padding-0"># Quantity (in Units) - Only Numbers</p>');
        }
        else{
            $('#quan_desc').css("display","block");  
            $('#quan_desc').html("");
            $('#quantity').css("border-color","#dddddd");
            $('#error_quantity').hide();
        }
  }      
}
else{
      var productspec=$("#productspec").val();
      if(quantity != ''){
              if(!valid_quantity.test(quantity)){
                $('#quan_desc').css("display","block");
                $('#quantity').css("border-color","#ff0000");
                $("#quan_desc").html('<p class="col-xs-12 padding-0"># Quantity (in Units) - Only Numbers</p>');
              }
              else{
                 $('#quantity').css("border-color","#dddddd");
                 $('#quan_desc').css("display","none");  
                 $('#error_quantity').hide();
              }          
      }else{

              $('#quantity').css("border-color","#ff0000");
              $('#quan_desc').css("display","none");                  
              return false;
      }
}
});
/*eof quantity*/
$("#budget").on('click select',function() {
  var genie_title =$('#genie_title').val();
  var budget=$("#budget").val();
  if((genie_title=='')||(genie_title==undefined)){//normal form
    $('#bud_desc').css("display","block");
    $('#bud_desc').text('# Budget (Rs.) - Only Numbers'); 
    $('#mob_desc').text('');
    $('#mobile_number').css("border-color","#dddddd");
  }else{//prefilled form
    $('#bud_desc').css("display","block");
    $('#bud_desc').text('# Budget (Rs.) - Only Numbers'); 
  }
});

$("#budget").on('blur',function() {
var genie_title =$('#genie_title').val();
var budget=$("#budget").val();
var valid_budget=/^[0-9 ]+$/;
if((genie_title=='')||(genie_title==undefined)){
if((budget == '')||(budget==undefined)) {
}
else{  
        if(!valid_budget.test(budget)){
          $('#bud_desc').css("display","block");
          $('#budget').css("border-color","#ff0000");
          $("#bud_desc").html("# Budget (in Rs.) - Only Numbers");
          return false;
        }
        else
        {
          $('#bud_desc').text(''); 
          $('#bud_desc').css("display","block");
          $('#budget').css("border-color","#dddddd");
          $('#error_budget').hide();
        }
}//budget not null
}
else{//prefilled

      if(budget != ''){
        if(!valid_budget.test(budget)){
              $('#bud_desc').css("display","block");
              $('#budget').css("border-color","#ff0000");
              $("#bud_desc").html("# Budget (in Rs.) - Only Numbers");
         }
         else{
            $('#bud_desc').css("display","none");
            $('#budget').css("border-color","#dddddd");
            $('#error_budget').hide();
         }//not valid
      }else{
          $('#bud_desc').css("display","none");
          $('#budget').css("border-color","#ff0000");
          return false;
      }
}
});

$("#category_id").on('change',function() {
      $("#sellerform_loading").show();
      var catid = $(this).val();
      $("#cat_sel").val(catid);
      $("#seo_cat_id").val(catid);
      var city_id=$("#seo_city_id").val();
      //get_city_cat_combo();
      if(city_id==''){
             get_cat_city_combo();
      }
      var catname = $("#category_id option:selected").text();
      catname  =catname.trim();
      $("#seo_cat_name").val(catname);
      $("#cat_head").html(catname);
      $("#subcat_id").find('option').remove();
      $("#subcategory_id").empty();
      var dataString = 'cat_id='+ catid;
      if (catid) {
        $.ajax({
          type: "POST",
          url: '/genie/getSubcategories',
          data: dataString,
          cache: false,
          success: function(data,textStatus,xhr) {
            $("#sellerform_loading").hide();
            var html = $.parseJSON(data);
            var c_key;
            var c_val;
            if(html!=''){
              $('#subcat').show();
              $('#subcategory_id').show();
               $("#subzone").show();
                  $("#zone_buy").show(); 
              $('<option>').val(0).text('Select Subcategory').appendTo($("#subcategory_id"));
             $.each(html, function(key, value) {  
                $('<option>').val(key).text(value).appendTo($("#subcategory_id"));
             });
           }else{
                  $('#subcat').hide();
                  $('#subcategory_id').hide();
                  $("#subzone").hide();
                  $("#zone_buy").hide(); 
           }
           show_sellers();
           $("#sellerform_loading").hide();
           } 
          });//ajax
      }//if id
    });

/*Display corresponding cityareas based on cities*/
    $("#city_buy").on('change',function() {
      //e.preventDefault();
      $("#sellerform_loading").show();
      var cityid = $(this).val();
      $("#seo_city_id").val(cityid);
      var cityname = $("#city_buy option:selected").text();
      cityname =cityname.trim();
      $("#seo_city_name").val(cityname);
      $("#city_head").html(cityname);
      var cat_id=$("#seo_cat_id").val();
      //if((cat_id=='')||(cat_id==23)){
            get_city_cat_combo();
      //}
      //return false;
      //$("#zone_buy").find('option').remove();
      var dataString = 'id='+ cityid;
      if (cityid) {
        $.ajax({
          type: "POST",
          url: '/genie/getAreas' ,
          data: dataString,
          cache: true,
          success: function(html) {
             var html = $.parseJSON(html);
             $("#zone_buy").empty();
             if(html!=''){
                  $("#subzone").show();
                  $("#zone_buy").show(); 
                  $('#subcat').show();
                  $('#subcategory_id').show();
                  $('<option>').val(0).text('Select Area').appendTo($("#zone_buy"));
                  $.each(html, function(key, value) {  
                    $('<option>').val(key).text(value).appendTo($("#zone_buy"));
                  });
              }else{
                  $("#subzone").hide();
                  $("#zone_buy").hide();
                  $('#subcat').hide();
                  $('#subcategory_id').hide();
              }
               show_sellers();
              $("#sellerform_loading").hide();
          } 
        });
      }
    });

$("#zone_buy").on('change',function(){
      var area_id = $(this).val();
      $("#seo_area_id").val(area_id);
      var area_name = $("#zone_buy option:selected").text();
      area_name =area_name.trim();
      $("#seo_area_name").val(area_name);
      show_sellers();
});

$("#subcategory_id").on('change',function(){
      var sub_cat_id = $(this).val();
      //$("#seo_area_id").val(area_id);
      $("#seo_sub_cat_id").val(sub_cat_id);
      var sub_cat_name = $("#seo_sub_cat_id option:selected").text();
      sub_cat_name =sub_cat_name.trim();
      $("#seo_subcat_name").val(sub_cat_name);
      show_sellers();
});

$("#full_name").on('click',function() {
 $('#mobile_number').css("border-color","#dddddd");
 $('#mob_desc').text('');
});

$("#mobile_number").on('click',function() {
var mobile_number=$("#mobile_number").val();
$(".mob_desc").css("display","block");
$(".mob_desc").text("# 10 Digit No.");

});

$("#mobile_number").on('blur',function() {
    var genie_title =$('#genie_title').val();
    var mobile_number=$("#mobile_number").val();
    var valid_mobile = /^[6-9]{1}[0-9]{9}$/;
    if((mobile_number == '')||(!valid_mobile.test(mobile_number)))  {
         $('#mobile_number').css("border-color","#ff0000");
         $('#mobile_number').css("border","1.5px");
         $(".mob_desc").html("<span style='color:#ff0000;border:2px'># 10 Digit No.</span>");
         return false;
    }
    else{
    $('#mobile_number').css("border-color","#dddddd");
    }
});

first_seller_call(2);
LeftSidebar();


});

function hide_link_inner(i){
    $('#resend_code_btn_now_inner-'+i).hide();
    $('#resend_code_btn_inner-'+i).show();
}         

function inner_show(sellername,i){
    $('#contact_sellers-'+i).hide();
    $('#inner_genie_page-'+i).show();
    $('#comp-head-'+i).show();
    $("#dpd1_inner-"+i).trigger("click");
    var user_id_inner=$('#QuoteUserId').val();
    if(user_id_inner>0){//logged in
      $('.member_type_member-'+i).prop( "checked", true );
    }
}
function show_guest_inner(i){
   var member_inner=$( '#member_type_inner-'+i+':checked' ).val();
    $('#full_name_inner-'+i).show();
    $('#mobile_number_inner-'+i).show();
    $('.member_type_member-'+i).prop( "checked", false );
    $('.member_type_guest-'+i).prop( "checked", true );
    $('#guest_inner-'+i).show();
    $('#member_inner-'+i).hide();
}
function hide_guest_inner(i){
    $('.member_type_member-'+i).prop( "checked", true );
    $('.member_type_guest-'+i).prop( "checked", false );
    var member_inner=$( '#member_type_inner-'+i+':checked' ).val();
    $('#full_name_inner-'+i).hide();
    $('#mobile_number_inner-'+i).hide();
    var user_id_inner=$('#QuoteUserId').val();
    if(user_id_inner>0){//logged in
      $('#guest_inner-'+i).hide();
      $('#member_inner-'+i).show();
    }
    else{
        $('#guest_inner-'+i).hide();
        $('#member_inner-'+i).show();
    }
}

function resend_otp_inner(i){
    var otp_number=$("#otp_number_inner-"+i).val();
    var guest_type=$("#guest_type_inner-"+i).val();
    var check_quote_id=$("#check_quote_id_inner-"+i).val();
    $("#need_otp_check").val(1);
    var url = window.location.href;
    url =url.split("?")[0]; 
    var dataString ='otp_number='+otp_number+'&guest_type='+guest_type+'&check_quote_id='+check_quote_id;
    $.ajax({
            type: "POST",
            url: '/genie/resend_otp_inner',
            data: dataString,
            cache: false,
            success: function(data,textStatus,xhr){ 
                   $("#resend_code_btn_inner-"+i).hide();
                   $(".resend_msg_inner-"+i).text('OTP SMS SENT');
            } 
    });
}

function verify_guest_otp_inner(i){
  var j=i;
  var otp_number=$("#otp_number_inner-"+i).val();
  var guest_type=$("#guest_type_inner-"+i).val();
  var check_quote_id=$("#check_quote_id_inner-"+i).val();
  var check_cd=$("#check_cd_inner-"+i).val();
  if(otp_number == '')  {
    $('#otp_number_inner-'+i).css("border-color","#ff0000");
    return false;
  }
  else{
       $('#otp_number_inner-'+i).css("border-color","#dddddd");
  }
  var dataString ='otp_number='+otp_number+'&guest_type='+guest_type+'&check_quote_id='+check_quote_id;
  $.ajax({
          type: "POST",
          url: '/genie/verify_guest_otp_inner',
          data: dataString,
          cache: false,
          success: function(data,textStatus,xhr){ 
          var obj=$.parseJSON(data);
          if(obj==1){
                $("#productspec_inner-"+i).val("");
                $("#quantity_inner-"+i).val("");
                $("#budget_inner-"+i).val("");
                $("#full_name_inner-"+i).val("");
                $("#dpd1_inner-"+i).val("");
                $("#mobile_number_inner-"+i).val("");
                $('#spec_content_inner-'+i).text('');
                $("#spec_content_inner-"+i).css("display","none");
                $("#quan_desc_inner-"+i).css("display","none");
                $("#bud_desc_inner-"+i).css("display","none");
                $("#loc_desc_inner-"+i).css("display","none");
                $("#fname_desc_inner-"+i).css("display","none");
                $("#mob_desc_inner-"+i).css("display","none"); 
                $("#quote_response_inner-"+i).show();
                $("#quote_response1_inner-"+i).show();
                $("#otp_number_inner-"+i).val("");
                $("#inner_genie_page-"+i).show();
                $("#otp_verify_form_inner-"+i).hide();
          }
          else{
                $("#inner_genie_page-"+i).hide();
                $("#otp_verify_form-"+i).show();
                $("#invalid_otp-"+i).show();
          }
        } 
  });
 }//verify_guest_otp_inner
 /*prelogin validation for direct enquiry*/
function quote_login_inner(i){
    var otp_checked;
    $("#submit_clicked").val("1");
    $("#inner_post_login").val(i);
    var seller_id=$('#seller_id-'+i).val();
    var b2c_inner=$( '#b2c_inner-'+i+':checked' ).val();
    $("#b2c").val(b2c_inner);
    var pdtspec_inner=$('#productspec_inner-'+i).val();
    $("#productspec").val(pdtspec_inner);
    var quantity_inner=$('#quantity_inner-'+i).val();
    $("#quantity").val(quantity_inner);
    var budget_inner=$('#budget_inner-'+i).val();
    $("#budget").val(budget_inner);
    var dpd1_inner=$('#dpd1_inner-'+i).val();
    $("#dpd1").val(dpd1_inner);
    var member_type_inner=$('#member_type_inner-'+i+':checked').val();
    $("#member_type").val(member_type_inner);
    var full_name_inner=$('#full_name_inner-'+i).val();
    $("#full_name").val(full_name_inner);
    var mobile_number_inner=$('#mobile_number_inner-'+i).val();
    $("#mobile_number").val(mobile_number_inner);
    var user_id_inner=$('#QuoteUserId').val();
    $('#one2one_inner').val(1);
     if(user_id_inner > 0){
       otp_checked=1;
     }else{
      otp_checked=0;
     }
    var enquiry_time=$('#QuoteEnquiryTime').val();
    var second_click=$('#second_click').val();
    var check_controller=$('#check_controller').val();
    var actual_link= $('#actual_link').val();
    var formid=$('#QuoteFormid').val();
    var unique_ip=$('#unique_ip').val();
    var login_type=$('#genie_login_type').val();
    var genie_title=$('#genie_title').val();
    var cat_id=$("#seo_cat_id").val();
    var sub_cat_id=$("#seo_sub_cat_id").val();
    var city_id=$("#seo_city_id").val();
    var city_name=$("#seo_city_name").val();
    var area_id=$("#seo_area_id").val();
    var area_name=$("#seo_area_name").val();
    if((b2c_inner=='')||(b2c_inner==undefined)){
      $('#b2c_inner-'+i).css("outline","1px solid #ff0000");
      return false;
    }
    else{
      $('#b2c_inner-'+i).css("outline","1px solid #dddddd");
      $('#error_customer').hide();
    }
    if((pdtspec_inner == '')||(pdtspec_inner == ' ')||(pdtspec_inner == undefined)||(pdtspec_inner == '  '))  {
      $('#productspec_inner-'+i).css("border-color","#ff0000");
      return false;
    }
    else{
        $('#productspec_inner-'+i).css("border-color","#dddddd");
        $('#error_msg_productspec').hide();
    } 
    if((quantity_inner =='')||(quantity_inner==undefined)||(quantity_inner ==' ')) {
       $("#quantity_inner-"+i).css("border-color","#ff0000");
       return false;
    }
    else{
        var valid_quantity=/^[0-9 ]+$/;
       if(!valid_quantity.test(quantity_inner)){
              $('#quantity_inner-'+i).css("border-color","#ff0000");
       }else{
        $("#quantity_inner-"+i).css("border-color","#dddddd");
        $("#error_quantity").hide();
       }
  }
  if((budget_inner =='') || (budget_inner==undefined)||(budget_inner==' '))  {
      $("#budget_inner-"+i).css("border-color","#ff0000");
      return false;
  }
  else{
        var valid_budget=/^[0-9 ]+$/;
        if(!valid_budget.test(budget_inner)){
            $('#budget_inner-'+i).css("border-color","#ff0000");
           return false;
        }
        else{
                $("#budget_inner-"+i).css("border-color","#dddddd");
        }
  }
  if((member_type_inner=='')||(member_type_inner==undefined)){
    $("#member_type_inner-"+i).css("outline","1px solid #ff0000");
    return false;
  }
  else{
        $("#member_type_inner-"+i).css("outline","1px solid #dddddd");
  } //guest or member
        $("#login-popup-vendors").modal('show');
  }
/*eof prelogin validation for direct enquiry*/

/*direct enquiry submission*/
function direct_enquiry(i){
   var otp_checked;
   var seller_id=$('#seller_id-'+i).val();
   var seller_name=$('#seller_name-'+i).val();
   var b2c_inner=$( '#b2c_inner-'+i+':checked' ).val();
   var pdtspec_inner=$('#productspec_inner-'+i).val();
   var quantity_inner=$('#quantity_inner-'+i).val();
   var budget_inner=$('#budget_inner-'+i).val();
   var dpd1_inner=$('#dpd1_inner-'+i).val();
   var member_type_inner=$('#member_type_inner-'+i+':checked').val();
   var full_name_inner=$('#full_name_inner-'+i).val();
   var mobile_number_inner=$('#mobile_number_inner-'+i).val();
   var user_id_inner=$('#QuoteUserId').val();
   if(user_id_inner > 0){
     otp_checked=1;
   }else{
    otp_checked=0;
   }
   var enquiry_time=$('#QuoteEnquiryTime').val();
   var second_click=$('#second_click').val();
   var check_controller=$('#check_controller').val();
   var actual_link= 'g-5';
   var formid=$('#QuoteFormid').val();
   var unique_ip=$('#unique_ip').val();
   var login_type=$('#genie_login_type').val();
   var genie_title=$('#genie_title').val();
   var cat_id=$("#seo_cat_id").val();
   var sub_cat_id=$("#seo_sub_cat_id").val();
   var city_id=$("#seo_city_id").val();
   var city_name=$("#seo_city_name").val();
   var area_id=$("#seo_area_id").val();
   var area_name=$("#seo_area_name").val();
      if((b2c_inner=='')||(b2c_inner==undefined)){
            $('#b2c_inner-'+i).css("outline","1px solid #ff0000");
            return false;
      }
      else{
              $('#b2c_inner-'+i).css("outline","1px solid #dddddd");
              $('#error_customer').hide();
      }
       if((pdtspec_inner == '')||(pdtspec_inner == ' ')||(pdtspec_inner == undefined)||
(pdtspec_inner == '  '))  {
            $('#productspec_inner-'+i).css("border-color","#ff0000");
            return false;
        }
        else{
             $('#productspec_inner-'+i).css("border-color","#dddddd");
             $('#error_msg_productspec').hide();
        } 
        if((quantity_inner =='')||(quantity_inner==undefined)||(quantity_inner ==' '))
        {
         $("#quantity_inner-"+i).css("border-color","#ff0000");
         return false;
        }
        else{
              var valid_quantity=/^[0-9 ]+$/;
               if(!valid_quantity.test(quantity_inner)){
                   $('#quantity_inner-'+i).css("border-color","#ff0000");
                    }
                     else{
                           $("#quantity_inner-"+i).css("border-color","#dddddd");
                           $("#error_quantity").hide();
                }
        }
        if((budget_inner =='') || (budget_inner==undefined)||(budget_inner==' '))  {
             $("#budget_inner-"+i).css("border-color","#ff0000");
              return false;
         }
         else{
                var valid_budget=/^[0-9 ]+$/;
                if(!valid_budget.test(budget_inner)){
                      $('#budget_inner-'+i).css("border-color","#ff0000");
                      return false;
                }
                else{
                      $("#budget_inner-"+i).css("border-color","#dddddd");
                }
        }
              
       if((member_type_inner=='')||(member_type_inner==undefined)){
          $("#member_type_inner-"+i).css("outline","1px solid #ff0000");
          return false;
        }
        else{
            $("#member_type_inner-"+i).css("outline","1px solid #dddddd");
            if(member_type_inner == 0){
                     var valid_fname=/^[a-zA-Z. ]+$/;
                     var valid_mobile = /^[6-9]{1}[0-9]{9}$/;
                    if((full_name_inner =='')||(!valid_fname.test(full_name_inner))||
(full_name_inner.length<3))
                              {
                              $("#full_name_inner-"+i).css("border-color","#ff0000");
                               return false;
                              }
                              else{
                                $("#full_name_inner-"+i).css("border-color","#ddd");
                              }
             if((mobile_number_inner == '')||(!valid_mobile.test(mobile_number_inner)))  {
                    $('#mobile_number_inner-'+i).css("border-color","#ff0000");
                    return false;
                  }
                  else{
                       $('#mobile_number_inner-'+i).css("border-color","#dddddd");
                  }
            }//guest
       } //guest or member 
           var dataString ='b2c='+b2c_inner+'&userid='+
user_id_inner+'&productspec='+encodeURIComponent(pdtspec_inner)+'&formid='+formid+
'&city_id='+city_id+'&city_name='+city_name+'&area_id='+area_id+'&area_name='+area_name+
'&enquiry_time='+enquiry_time+'&quantity='+quantity_inner+'&budget='+budget_inner+
'&member_type='+member_type_inner+'&full_name='+full_name_inner+'&mobile_number='+mobile_number_inner+
'&unique_ip='+encodeURIComponent(unique_ip)+'&check_controller='+check_controller+
'&genie_url='+encodeURIComponent(genie_title)+'&second_click='+second_click+'&check_quote_id='+
check_quote_id+'&cat_id='+cat_id+'&sub_cat_id='+sub_cat_id+'&otp_checked='+otp_checked+
'&actual_link='+encodeURIComponent(actual_link)+'&login_type='+login_type+'&seller_id='+seller_id+
'&seller_name='+encodeURIComponent(seller_name);
              $.ajax({
                        type: "POST",
                        url: '/genie/direct_enquiry',
                        data: dataString,
                        cache: false,
                        async: true, //blocks window close
                        success: function(data,textStatus,xhr){
                          var obj=$.parseJSON(data);
                        if(obj['yes']==1){
                           $("#inner_genie_page-"+i).hide();
                           $("#otp_verify_form_inner-"+i).show();
                           setTimeout(function () { hide_link_inner(i); }, 30000);
                          }else{
                                $("#productspec_inner-"+i).val("");
                                $("#quantity_inner-"+i).val("");
                                $("#budget_inner-"+i).val("");
                                $("#full_name_inner-"+i).val("");
                                $("#dpd1_inner-"+i).val("");
                                $("#mobile_number_inner-"+i).val("");
                                $('#spec_content_inner-'+i).text('');
                                $("#spec_content_inner-"+i).css("display","none");
                                $("#quan_desc_inner-"+i).css("display","none");
                                $("#bud_desc_inner-"+i).css("display","none");
                                $("#loc_desc_inner-"+i).css("display","none");
                                $("#fname_desc_inner-"+i).css("display","none");
                                $("#mob_desc_inner-"+i).css("display","none"); 
                                $("#quote_response_inner-"+i).show();
                                $("#quote_response1_inner-"+i).show();
                                $("#otp_number_inner-"+i).val("");
                                $("#inner_genie_page-"+i).show();
                                $("#otp_verify_form_inner-"+i).hide();
                           }
                 },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          }  
              });
 } 
/*eof direct enquiry submission*/

function date_inner(i){
          var checkin_inner = $('#dpd1_inner-'+i).datepicker({
                       click: function(date) {
                      }
            }).on('changeDate', function(ev_inner) {
           var changedate_inner=ev_inner.date;
           var dinedate_timestamp_inner=ev_inner.timeStamp;
           const monthNames = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
           const days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
           var yr_inner=changedate_inner.getFullYear();
           var day_inner=changedate_inner.getDate();
           var mnthname_inner=monthNames[changedate_inner.getMonth()];
           var dayname_inner=days[changedate_inner.getDay()];
           var totday_inner=day_inner+' '+mnthname_inner+' '+yr_inner+', '+dayname_inner;
          $('#dpd1_inner-'+i).val(totday_inner);
          $('#dpd1_inner-'+i).datepicker('hide');
         }).data('datepicker');
} 

function get_faq(){
  var cat_id=$("#seo_cat_id").val();
  var dataString = 'cat_id='+ cat_id;
  $.ajax({
      type: "POST",
      url: '/genie/get_faq',
      data: dataString,
      cache: false,
      success: function(data,textStatus,xhr) {
        var myContent = $.parseJSON(data);
         if(myContent!=''){
                  myContent.replace(/(<([^>]+)>)/ig,"");
                  myContent.replace("/n","");
                  myContent.replace("<\/o:p>","");
                  myContent.replace("<\/p>","");
                  myContent.replace("<\/span>","");
                  $("#faq_content").html(myContent);
            }                   
         }
  });
} 
function productfocus(){
  $("#productspec").focus();
}
function quantityfocus(){
  $("#quantity").focus();
}
function budgetfocus(){
  $("#budget").focus();
}
function locfocus(){
  $("#login_popup_leads_select_city2").focus();
}

function close_response_inner(i){
     $("#quote_response_inner-"+i).hide();
     $("#quote_response1_inner-"+i).hide();
}

function show_sellers() {
        var cat_id=$("#category_id").val();
        var cityid=$("#city_buy").val();
        var prev_cat_id=$("#prev_category_id").val();
        var prev_city_id=$("#prev_city_id").val();
        var j;
        j=$("#limit_loop").val();
       
          if((prev_cat_id==cat_id)&&(prev_city_id==cityid)){
                  if((j=='')||(j==undefined)||(j==0)){
                    j=4;
                  }
                  else{
                    j=parseInt(j)+6;
                  }
          }else{
            j=4;
          }
         
        var zone_id=$("#zone_buy").val();//area
        var user_id_inner=$('#QuoteUserId').val();
        var city_name=$("#seo_city_name").val();
        var area_name=$("#seo_area_name").val(); 
        var cat_name=$("#seo_cat_name").val(); 
        var sub_cat_name=$("#seo_subcat_name").val(); 
          if((sub_cat_name=='')||(sub_cat_name==0)){
           var totcat=cat_name;
          }else{
           var totcat=cat_name+' > '+sub_cat_name;
          }

          if((area_name=='')||(area_name==0)){
           var totcity=city_name;
          }else{
           var totcity=city_name+' > '+area_name;
          }
        var company_name=$("#company_name").val();
        var subcat_id=$("#subcategory_id").val();//subcategory
        if((cat_id==0)&&(prev_cat_id>0)){
          cat_id=prev_cat_id;
        }
       
        if((cat_id=='')||(cat_id==undefined)||(cat_id==0))  {
          $('#category_id').css("border-color","#ff0000");
          //$("#alltab2diffsellersbody").hide();
          //return false;
        }
        else{
          $('#category_id').css("border-color","#ddd");
        }

        if((cityid=='')||(cityid==undefined)||(cityid==0)){
          $('#city_buy').css("border-color","#ff0000");
         // $("#alltab2diffsellersbody").hide();
          //return false;
        }
        else{
          $('#city_buy').css("border-color","#ddd");
        }
        var d = new Date();
        const monthNames = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
        const days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
        var yr=d.getFullYear();
        var day=d.getDate();
        var mnthname=monthNames[d.getMonth()];
        var dayname=days[d.getDay()];
        var totday=day+' '+mnthname+' '+yr+', '+dayname;
        var dataString = 'cityid='+cityid+'&cat_id='+cat_id+'&zone_id='+zone_id+'&subcat_id='+subcat_id;

            $.ajax({
                type: "POST",
                url: '/genie/getDiffSellerList',
                data: dataString,
                cache: false,
                    success: function(data,textStatus,xhr){ 
                      var obj=$.parseJSON(data);
                      var myarray = new Array();  
                      var z=obj.length;
                      $('#alltab2diffsellersbody').show();
                    for( var i = 0; i < obj.length; i++ )
                       {
                        var user_id=obj[i]['users']['id'];
                        var company_name=obj[i]['users']['company_name'];
                        var first_name=obj[i]['users']['first_name'];
                        var last_name=obj[i]['users']['last_name'];
                        var full_name=first_name+' '+last_name;
                        var business_email=obj[i]['users']['business_email'];
                        var mobile_number=obj[i]['users']['mobile_number'];
                        var office_phone_number=obj[i]['users']['office_phone_number'];
                        var leads_displays_count=parseInt(obj[i]['users']['leads_displays_count']);
                        var leads_displays=parseInt(obj[i]['users']['leads_displays']);
                        var balance=leads_displays_count - leads_displays;
                        var informed;
                        if(informed==1){
                            informed='yes';
                        }
                        else{
                            informed='no';
                        }
        var result='<div class="col-md-12 col-xs-12" ><div class="col-md-8 col-xs-8" >'+
        '<span id="comp-head-'+i+'" style="display:none;font-weight: bold;color: #00b050;"><b>You are contacting </span>'+company_name+'</b></div>'+
        '<div class="col-md-4 col-xs-4" style="margin-bottom: 10px;padding-bottom:10px;important">'+
        '<a id="contact_sellers-'+i+'" class="btn btn-primary quotesmbtn2 contact_sellers" type="submit" onClick="inner_show(\''+company_name+'\','+i+')">'+
        '<b class="sub_gen">CONTACT NOW</b></a></div></div>'+
        '<!--display msgs--><div id="quote_response_inner-'+i+'" class="alert alert-success alert-dismissable" style="display:none">'+
        '<span class="closecls_qu" style="" onclick="close_response_inner('+i+')">X</span>'+
        '<div id="quote_response1_inner-'+i+'" style="display:none">'+
        '<b>Received Your Request. Thanks.<? if(!empty($User_Id))+{?>| '+
        '<a target="_blank" href="/myaccount/my_enquiries">View Enquiry Now </a><?}?></b>'+
        '<p>You’ll soon receive Requested-Info from Xerve’s Partners (via Xerve Chat).<p></div>'+
        '</div><!--display msgs --><!--maininner form --><div style="display:none" id="inner_genie_page-'+i+'" >'+
        '<div class="col-md-12 col-xs-12 padding-0" id="inner-form_inner-'+i+'">'+
        '<input type="hidden" id="seller_id-'+i+'" value='+user_id+'>'+
        '<input type="hidden" id="seller_name-'+i+'" value='+encodeURIComponent(company_name)+'>'+
        '<div class="col-md-12 col-xs-12 padding-0 typeof_buy "><label class="col-md-12 col-xs-12 padding-0">'+
        '<input type="radio" id="b2c_inner-'+i+'" name="b2c" value="1"><span for="b2c"> My Requirement</span>'+
        '</label><label class="col-md-12 col-xs-12 padding-0">'+
        '<input type="radio" id="b2c_inner-'+i+'" name="b2c" value="2">'+
        '<span for="b2c" >Office Requirement</span></label><span class="error_msg" id="error_customer" style="display:none"></span></div>'+
        '<div> <div class="col-md-12 col-xs-12 padding-0 textarea_col">'+
        '<textarea class="form-control xenqspan productspec_inner" id="productspec_inner-'+i+'" rows="3" cols="6" data-toggle="tooltip" placeholder="Wish Box (Type Any Buying Wish Here)"></textarea>'+
        '<span style="color:#666;margin-left: 5px;margin-bottom: 2px;padding-top:2px;display: none;" id="spec_content"></span><span id="specs_content" style="display:none"> Please Provide Details.</span>'+
        '<span class="error_msg" id="error_msg_productspec" style="display:none">* </span>'+
        '<div class="col-md-12 col-xs-12 padding-0" style="margin-bottom: 6px;margin-top: 6px;">'+
        '<div class="col-md-6 col-xs-6 padding-0">'+
        '<input type="text"  id="quantity_inner-'+i+'" autocomplete="off" class="form-control select-city-box-login" placeholder="Quantity" >'+
        '<span id="quan_desc" ></span><span class="error_msg" id="error_quantity" style="display:none">'+
        '</span></div><div class="col-md-6 col-xs-6 padding-0"><input type="text" id="budget_inner-'+i+'" autocomplete="off" class="form-control select-city-box-login" placeholder="Total Budget" ><span id="bud_desc" ></span>'+
        '<span class="error_msg" id="error_budget" style="display:none"></span></div>'+
        '</div>'+
        '</div>'+
        '<div class="col-xs-12 padding-0 _loginas"><div class="col-md-12 col-xs-12 padding-0 marg0mb">'+
        '<?if(empty($User_Id)) {?><label class="col-md-6 col-xs-6 padding-0"><input id="member_type_inner-'+i+'"  type="radio" name="member_type_guest-'+i+'" class="member_type_guest-'+i+'" value="0" onclick=show_guest_inner('+i+');>'+
        '<span for="member_type"> I am a Guest</span></label><?}?><label class="col-md-6 col-xs-6 padding-0">'+
        '<input id="member_type_inner-'+i+'" type="radio" name="member_type_member-'+i+'" class="member_type_member-'+i+'" value="1" onclick=hide_guest_inner('+i+');>'+
        '<span for="member_type"> I am a Member </span></div><div class="col-md-12 col-xs-12 padding-0"><div class="col-md-6 col-xs-6 padding-0" style="padding-right: 1px">'+
        '<input type="text" id="full_name_inner-'+i+'" class="form-control select-city-box-login " value="" autocomplete="off" placeholder=" Name" style="display:none">'+
        '<span id="fname_desc" style="color:#666;margin-right: 2px"></span></div><div class="col-md-6 col-xs-6 padding-0"><div class="col-md-12 col-xs-12 padding-0">'+
        '<input type="text" id="mobile_number_inner-'+i+'" class="form-control select-city-box-login" value="" autocomplete="off" placeholder="Mobile No." maxlength=10 style="display:none">'+
        '<span id="mob_desc" class="mob_desc" ></span></div></div></div><div id="guest_inner-'+i+'" style="margin-bottom: 10px;padding-bottom:8px;padding-top:2px;border-bottom:1px solid #000!important>'+
        '<span id="quoteguestsaveinner" class="btn btn-primary quotesmbtn2"   type="submit" style="color:#fff" onClick=direct_enquiry('+i+');>'+
        '<span class="home_sprite genie_update"></span> WISH & GET</span></div><div id="member_inner-'+i+'" style="display:none;margin-bottom: 10px;padding-bottom:8px;padding-top:2px;border-bottom:1px solid #000!important>'+
        '<a id="quoteloginbutton-'+i+'" class="btn btn-primary quotesmbtn2" data-toggle="modal" aria-labelledby="myModalLabel_inner" tabindex="-1" role="dialog"  onclick="quote_login_inner('+i+')">'+
        '<span class="home_sprite genie_update"></span> WISH & GET</a></div></div><!--_loginas--></div></div></div></div><div class="col-md-12 col-xs-12" style="margin-bottom: 10px;padding-bottom:21px;border-bottom:1px solid #000!important"></div><!--otp form -->'+
        '<div id="otp_verify_form_inner-'+i+'" class="verification_register_client_vendor_home verfilg" style="display: none;">Please Enter OTP to Get Offers Now</p>'+
        '<p id="invalid_otp-'+i+'" class="error_msg" style="display:none;">* Enter Valid Code</p>'+
        '<input type="hidden" name="guest_type" id="guest_type_inner-'+i+'"><input type="hidden" name="check_quote_id" id="check_quote_id_inner-'+i+'">'+
        '<input id="otp_number_inner-'+i+'" name="register_verify_main" class="form-control" placeholder="OTP" style="margin-top:5px">'+
        '<button type="submit" class="btn btn-primary quotesmbtn2" id="quoteguestsaveotp_inner-'+i+'" onclick="verify_guest_otp_inner('+i+')" style="margin-top:5px">FINISH</button>'+
        '<span class="resend_btn_bef" id="resend_code_btn_now_inner-'+i+'" >Send OTP </span><span class="resend_btn_aft" id="resend_code_btn_inner-'+i+'" style="display:none" onclick=resend_otp_inner('+i+')>Send OTP </span>'+
        '<span class="resend_msg"></span><div class="loading-login-verify_vendor_home" style="display:none;padding-bottom:10px;text-align:center;margin-left:10px;">'+
        '<img src="/img/loading_company.gif" alt="loading" title="loading"></div>'+
        '</div><!--otp form --><hr style="border:0;border-top: 1px solid #000;!important">'; 
        myarray.push(result);
        if(i == j) {
            break;
        } 
        $('#limit_loop').val(i);
        }
        $("#prev_category_id").val(cat_id);
        $("#prev_city_id").val(cityid);
        var result_1='<div class="col-md-12 col-xs-12" onclick="show_sellers();"><a class="btn btn-primary">LOAD MORE SELLERS</a></div> ';
        if(i<z){
            myarray.push(result_1);
        }
              $('#alltab2diffsellersbody').empty();
              $('#alltab2diffsellers').show();
              $("#alltab2diffsellersbody").append(myarray);
              
              if(myarray==''){
                $("#sel_btn").show();
              }else{
                 $("#sel_btn").hide();
              }
              //
                        } //success
              });//ajax
} //viewall

function get_cat_city_combo(){
    $("#sellerform_loading").show();
    var catid = $("#seo_cat_id").val();
    $("#subcat_id").find('option').remove();
    var dataString = 'cat_id='+ catid;
    $("#city_buy").empty();
    if (catid) {
      $.ajax({
          type: "POST",
          url: 'genie/get_catcitycombo',
          data: dataString,
          cache: false,
          success: function(data,textStatus,xhr) {
            $("#sellerform_loading").hide();
            $('<option>').val(0).text('Select City').appendTo($("#city_buy"));
            var html = $.parseJSON(data);
              if(html!=''){
                $.each(html, function(key, value) { 
               $('<option>').val(value["cities"]["id"]).text(value["cities"]["city_name"]).appendTo($("#city_buy"));
               });
              }
            } 
      });
    }
}

function get_city_cat_combo(){
      $("#sellerform_loading").show();
      var catid = $("#seo_cat_id").val();
      var city_id=$("#seo_city_id").val();
      $("#subcat_id").find('option').remove();
      var dataString = 'city_id='+ city_id;
      var c_id;
      var c_val;
      //$("#category_id").empty();
      if (city_id) {
        $.ajax({
          type: "POST",
          url: 'genie/get_city_cat_combo',
          data: dataString,
          cache: false,
          success: function(data,textStatus,xhr) {
            $("#sellerform_loading").hide();
             //$("#subcategory_id").hide();
            $('<option>').val(0).text('Select Category').appendTo($("#category_id"));
            $('<option>').val(0).text('Select City').appendTo($("#city_buy"));
            var html = $.parseJSON(data);
            if(html!=''){
              $.each(html, function(key, value) { 
                c_id=value["offer_categories"]["id"];
                c_val=value["offer_categories"]["category_name"];
                $('<option>').val(c_id).text(c_val).appendTo($("#category_id"));
              });
            }
            else{
                $('#subcat').hide();
                $('#subcategory_id').hide();
            }
            } 
          });
      }

}

function def_area(){     
      var cityid = 2;
      
      var city_id=$("#city_buy").val();
      $("#seo_city_id").val(city_id);
     // $("#seo_city_name").val('Bengaluru');
      var city_name=$("#seo_city_name").val();
      var cat_id=$("#seo_cat_id").val();
      $("#zone_buy").find('option').remove();
      var dataString = 'id='+ city_id;
      if (city_id) {
        $.ajax({
          type: "POST",
          url: '/genie/getAreas' ,
          data: dataString,
          cache: true,
          success: function(html) {
             var html = $.parseJSON(html);
             if(html!=''){
                  $('<option>').val(0).text('Select Area').appendTo($("#zone_buy"));
                      $.each(html, function(key, value) {  
                      $('<option>').val(key).text(value).appendTo($("#zone_buy"));
                  });
              }else{
                $("#subzone").hide();
                $("#zone_buy").hide();
              }  
          } 
        });
      }
    }

  function def_subcat(){
      var catid = $("#category_id").val();
      $("#cat_sel").val(catid);
      $("#seo_cat_id").val(catid);
      var city_id=$("#seo_city_id").val();
      $("#seo_cat_name").val('Electronics and Appliances');
      $("#subcat_id").find('option').remove();
      $("#subcategory_id").empty();
      var dataString = 'cat_id='+ catid;
      if (catid) {
        $.ajax({
          type: "POST",
          url: '/genie/getSubcategories',
          data: dataString,
          cache: false,
          success: function(data,textStatus,xhr) {
            $("#sellerform_loading").hide();
            var html = $.parseJSON(data);
            var c_key;
            var c_val;
            $('<option>').val(0).text('Select Subcategory').appendTo($("#subcategory_id"));
            if(html!=''){
                //$('#subcat').show();
                //$('#subcategory_id').show();
             $.each(html, function(key, value) {  
                $('<option>').val(key).text(value).appendTo($("#subcategory_id"));
             });
           }
           else{
                $('#subcat').hide();
                $('#subcategory_id').hide();
           }
                       } 
        });//ajax
      }//if id
  }
  /*quote insertion after login function*/
function lead_insert()
   {
    var check_controller=$("#check_controller").val();
    $("#submit_clicked").val("1");
    $("#quotesave").show();
    var enquiry_time=$("#QuoteEnquiryTime").val();
    var formid=$("#QuoteFormid").val();
    var user_id=$("#QuoteUserId").val();
    var unique_ip=$("#unique_ip").val();
    var genie_url=$("#genie_url").val();
    var productspec=$("#productspec").val();
    var login_city=$("#login_popup_leads_city").val();
    var login_state=$("#login_popup_leads_state").val();
    var login_area=$("#login_popup_leads_area").val();
    var login_zone=$("#login_popup_leads_zone").val();
    var login_zones=$("#login_popup_leads_zones").val();
    var login_address=$("#login_popup_leads_address").val();
    var login_city1=$("#login_popup_leads_city1").val();
    var login_state1=$("#login_popup_leads_state1").val();
    var login_area1=$("#login_popup_leads_area1").val();
    var login_zone1=$("#login_popup_leads_zone1").val();
    var login_zones1=$("#login_popup_leads_zones1").val();
    var login_address1=$("#login_popup_leads_address1").val();
    var login_lat=$("#login_popup_leads_latitude").val();
    var login_long=$("#login_popup_leads_longitude").val();
    var login_lat1=$("#login_popup_leads_latitude1").val();
    var login_long1=$("#login_popup_leads_longitude1").val();
    var quantity=$("#quantity").val();
    var budget=$("#budget").val();
    var gender=$("#gender").val();
    var brand=$("#brand").val();
    var size=$("#size").val();
    var color=$("#color").val();
    var cat_id=$("#seo_cat_id").val();
    var sub_cat_id=$("#seo_sub_cat_id").val();
    var member_type=1;
    var b2c=$('input[name=b2c]:checked', '#LeadAddForm').val();
        if((b2c==1)||(b2c==2)){
          b2cflag=1;
        }
        else{
          b2cflag=0;
        }
         if(b2cflag==0){
               $('#b2c').css("border-color","#ff0000");
              return false;
        }
        else{
                $('#b2c').css("border-color","#dddddd");
                $('#error_customer').hide();
        }
    if($("#login_popup_leads_select_city").val()=='')   {
     $('#login_popup_leads_select_city').css("border-color","#ff0000");
        return false;
    }
    else{
        $('#login_popup_leads_select_city').css("border-color","#dddddd");
        $('#error_sel_city').hide();
    }
    if($("#login_popup_leads_select_city2").val()=='')  {
     $('#login_popup_leads_select_city2').css("border-color","#ff0000");
     return false;
    }
    else{
         $('#login_popup_leads_select_city2').css("border-color","#dddddd");
         $('#error_city1').hide();
    }
    var productspec=$("#productspec").val();
    if(productspec == '')   {
      $('#productspec').css("border-color","#ff0000");
     return false;
    }
    else{
          $('#productspec').css("border-color","#dddddd");
          $('#error_msg_productspec').hide();
        }
    if((quantity == '')||(quantity == undefined)||(quantity == ' '))  {
                                     $('#quantity').css("border-color","#ff0000");
                                     return false;
    }
    else{
           var valid_quantity=/^[0-9 ]+$/;
       if(!valid_quantity.test(quantity)){
                $('#quan_desc').css("display","block");
                $('#quantity').css("border-color","#ff0000");
                $("#quan_desc").html('<p class="col-xs-12 padding-0"># Quantity (in Units) - Only Numbers</p>');
               }else{
                       $('#quantity').css("border-color","#dddddd");
                       $('#error_quantity').hide();
            }
    }
    if((budget == '')||(budget == undefined)||(budget == ' '))  {
                   $('#budget').css("border-color","#ff0000");
    return false;
    }
    else{
            var valid_budget=/^[0-9 ]+$/;
          if(!valid_budget.test(budget)){
            $('#bud_desc').css("display","block");
            $('#budget').css("border-color","#ff0000");
            $("#bud_desc").html("# Budget (in Rs.) - Only Numbers");
            return false;
           }else{
           $('#budget').css("border-color","#dddddd");
           $('#error_msg_budget').hide();
         }
    }
    if(member_type == 0){
            if(mobile_number == '')  {
                             $('#mobile_number').css("border-color","#ff0000");
                             return false;
            }
            else{
                 $('#mobile_number').css("border-color","#dddddd");
            }
    }             
     /*Null Validations ends*/
    var prelogin=1;
    var second_click=0;
    if (user_id) {
                     $("#leadform_loading").show();
                     $("#LeadAddForm").hide();
                     $("#totrestoimgcol").hide();
             var dataString ='b2c='+b2c+'&userid='+user_id+
             '&productspec='+encodeURIComponent(productspec)+'&formid='+formid+
             '&login_city1='+login_city1+'&login_area1='+login_area1+'&login_state1='+login_state1+
             '&login_address1='+encodeURIComponent(login_address1)+'&enquiry_time='+enquiry_time+
             '&login_zone1='+login_zone1+'&login_zones1='+login_zones1+'&login_lat1='+login_lat1+
             '&login_long1='+login_long1+'&quantity='+quantity+'&budget='+budget+'&member_type='+member_type+
             '&check_controller='+check_controller+'&genie_url='+encodeURIComponent(genie_url)+
             '&prelogin='+prelogin+'&unique_ip='+unique_ip+'&cat_id='+cat_id+'&sub_cat_id='+sub_cat_id;
             console.log(dataString);
                $.ajax({
                    type: "POST",
                    url: '/genie/preloginajaxadd',
                    data: dataString,
                    cache: false,
                    async: true, //blocks window close
                    success: function(data,textStatus,xhr){
                      console.log(data);
                      console.log(textStatus);
                      $("#leadform_loading").hide();
                      $("#LeadAddForm").show();
                      $("#productspec").val("");
                      $("#b2c").val("");
                      $("#dpd1").val("");
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
                      $("#login_popup_leads_address").val("");
                      $("#login_popup_leads_address1").val("");
                      $("#quote_response").show();
                      $("#quote_response1").show();
                      $("#totrestoimgcol").show();
                      $("#login_popup_leads_autocomplete_myloc").val("");
                      $("#change_location_ad99_login_popup_leads_myloc").text('');
                      $("#login_popup_leads_autocomplete_myloc1").val("");
                      $("#change_location_ad99_login_popup_leads_myloc1").empty();
                      $("#quantity").val("");
                      $("#budget").val("");
                      $("#quotesave").show();
                    } //success
                });//ajax
  }   //if user_id
            return false;
        }
/*quote insertion after login function*/
/*otp verification of guest mobile*/
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
        var dataString ='otp_number='+otp_number+'&guest_type='+guest_type+'&check_quote_id='+check_quote_id;
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
                                      }
                                      else{
                                          $('._quot-form').addClass('gienotp');
                                          $("#otp_verify_form").hide();
                                          $("#pubsorresto").show();
                                          $("#otp_number").val("");
                                          $(".main_form").show();
                                          $("#quote_response2").text('Your Xerve Guest Account has been Activated. ');
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
                                 }
                                 else{
                                            $(".main_form").hide();
                                            $("#pubsorresto").hide();
                                            $("#otp_verify_form").show();
                                            $("#invalid_otp").show();
                                 }
                      } 
            });
 }
/*otp verification of guest mobile */
function quote_login_button(){
    console.log('quoteloginbutton');
    $("#submit_clicked").val("1");
    var buydate1=$("#dpd1").val();
    var productspec=$("#productspec").val();
    var member_type=$("#member_type").val();
    var mobile_number=$("#mobile_number").val();
    var login_city=$("#login_popup_leads_city").val();
    var login_state=$("#login_popup_leads_state").val();
    var login_area=$("#login_popup_leads_area").val();
    var login_zone=$("#login_popup_leads_zone").val();
    var login_zones=$("#login_popup_leads_zones").val();
    var login_address=$("#login_popup_leads_address").val();
    var login_city1=$("#login_popup_leads_city1").val();
    var login_state1=$("#login_popup_leads_state1").val();
    var login_area1=$("#login_popup_leads_area1").val();
    var login_zone1=$("#login_popup_leads_zone1").val();
    var login_zones1=$("#login_popup_leads_zones1").val();
    var login_address1=$("#login_popup_leads_address1").val();
     var quantity=$("#quantity").val();
    var budget=$("#budget").val();
    var gender=$("#gender").val();
    var brand=$("#brand").val();
    var size=$("#size").val();
    var color=$("#color").val();
    var b2c=$('input[name=b2c]:checked', '#LeadAddForm').val();
                    if((b2c==1)||(b2c==2)){
                      b2cflag=1;
                    }
                    else{
                      b2cflag=0;
                    }
                     if(b2cflag==0){
                          $('#b2c').css("border-color","#ff0000");
                          return false;
                    }
                    else{
                            $('#b2c').css("border-color","#dddddd");
                            $('#error_customer').hide();
                        }
    if($("#login_popup_leads_select_city2").val()=='')  {
     $('#login_popup_leads_select_city2').css("border-color","#ff0000");
      return false;
    }
    else{
         $('#login_popup_leads_select_city2').css("border-color","#dddddd");
         $('#error_city1').hide();
    }//city2
    var productspec=$("#productspec").val();
    if(productspec == '')   {
      $('#productspec').css("border-color","#ff0000");
      return false;
    }
    else{
          $('#productspec').css("border-color","#dddddd");
          $('#error_msg_productspec').hide();
        }//productspec
    if($("#login_popup_leads_select_city").val()=='')   {
     $('#login_popup_leads_select_city').css("border-color","#ff0000");
        return false;
    }
    else{
        $('#login_popup_leads_select_city').css("border-color","#dddddd");
        $('#error_sel_city').hide();
    }//city1
    if((quantity =='')||(quantity == undefined)||(quantity ==' '))  {
                         ('#quantity').css("border-color","#ff0000");
                         return false;
                    }
                    else{
                             var valid_quantity=/^[0-9 ]+$/;
                       if(!valid_quantity.test(quantity)){                                                    
                                $('#quan_desc').css("display","block");
                                $('#quantity').css("border-color","#ff0000");
                                $("#quan_desc").html('<p class="col-xs-12 padding-0"># Quantity (in Units) - Only Numbers</p>');
                                return false;
                               }else{
                         $('#quantity').css("border-color","#dddddd");
                         $('#error_quantity').hide();
                       }
                    }
                     if((budget =='')||(budget ==' ')||(budget ==undefined)) {
                                     $('#budget').css("border-color","#ff0000");
                      return false;
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
                                             $('#budget').css("border-color","#dddddd");
                                             $('#error_msg_budget').hide();
                       }
                    }
    } 
  function SelectLoginOption(section){
  if(section=='Facebook'){
      $(".facebook_login_section").slideDown('fast');
       $(".facebook_login_section").show();
       $(".login_email_section").slideUp('fast');
       $('.login_email_section').hide();
       $("#TopSection_Login_Email i").removeClass("checked");
       $("#TopSection_Login_Email i").addClass("check-box");
         $("#TopSection_Login_Facebook i").addClass("checked");
       $("#TopSection_Login_Facebook i").removeClass("check-box");
  }
  else{
    $(".facebook_login_section").slideUp('fast');
       $(".facebook_login_section").hide();
       $(".login_email_section").slideDown('fast');
       $('.login_email_section').show();
       $("#TopSection_Login_Facebook i").removeClass("checked");
       $("#TopSection_Login_Facebook i").addClass("check-box");
      $("#TopSection_Login_Email i").addClass("checked");
       $("#TopSection_Login_Email i").removeClass("check-box");
     }
}

$(document).ready(function(){
  $(".facebook-value-button").click(function(){
      FB.login();
  })
})
function facebook_popup(){
  // e.preventDefault();
}

function show_section(section){
 if(section=='login'){
 $(".consumers_login span").addClass('selected_home_option');
  $(".corporates_login span").removeClass('selected_home_option');
  $(".corporates_login span").addClass('main_default_home');
  $(".consumers_login span").removeClass('main_default_home');
  $(".consumers_login span.selected_home_option_type").html("&#10003;&nbsp;LOGIN");
  $(".corporates_login span.main_default_home").html("JOIN");
  $(".registered-login-section").show();
  $(".registered-join-section").hide();
    if($("#UserLoginForm").length){
        document.getElementById("UserLoginForm").reset();
    }
 }
 else{
  $(".consumers_login span").removeClass('selected_home_option');
  $(".corporates_login span").addClass('selected_home_option');
  $(".consumers_login span").addClass('main_default_home');
  $(".corporates_login span").removeClass('main_default_home');
  $(".corporates_login span.selected_home_option_type").html("&#10003;&nbsp;JOIN");
  $(".consumers_login span.main_default_home").html("LOGIN");
    $(".registered-login-section").hide();
    $(".registered-join-section").show();
    if($("#UserRegisterFormHome").length){
    document.getElementById("UserRegisterFormHome").reset();
    }
 }
}
function first_seller_call(id){
  if(id==1){
    $("#category_id").val(23);
    $("#city_buy").val(2);
    $("#seo_city_name").val('Bengaluru');
    $("#cat_head").html('Electronics and Appliances');
    $("#city_head").html('Bengaluru');
    $("#prev_category_id").val(23);
    $("#prev_city_id").val(2);
    show_sellers(23,2);
    def_area();
    def_subcat();
 }else if(id==2){
    $("#category_id").val(23);
    $("#city_buy").val(2);
    $("#seo_city_name").val('Bengaluru');
    $("#cat_head").html('Electronics and Appliances');
    $("#city_head").html('Bengaluru');
    $("#prev_category_id").val(23);
    $("#prev_city_id").val(2);
    show_sellers(23,2);
    def_area();
    def_subcat();
   
 }else{
    $("#category_id").val(0);
    $("#cat_head").html('');
 }
}

//$('#resend_code_btn').on('click',function() {
  function resend_code_btn(){
   
          var otp_number=$("#otp_number").val();
          var guest_type=$("#guest_type").val();
          var check_quote_id=$("#check_quote_id").val();
          //var url = window.location.href;
         // url =url.split("?")[0]; 
          var dataString ='otp_number='+otp_number+'&guest_type='+guest_type+'&check_quote_id='+check_quote_id;
          console.log(dataString);
       $.ajax({
                      type: "POST",
                      url: '/genie/resend_otp',
                      data: dataString,
                      cache: false,
                      success: function(data,textStatus,xhr){ 
                             console.log(data);
                             $("#resend_code_btn").hide();
                             $(".resend_msg").text('OTP SMS SENT');
                      } //success
            });//ajax
  }     
// });






         

