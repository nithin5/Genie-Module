  $(document).on('submit','#UserLoginFormVseller',function(event){
          var currentli = 'frontvendor1';
          var form = $(this);
          $(".registered-action").hide();
          $("._sd_lg_ft").hide();
          event.preventDefault();
              if ( form.data('requestRunning') ) {
                  return;
              }
              // Get the data from the form
           var data = form.serialize();
           var email = $('.'+currentli+' #UserBusinessEmail').val();
           var pass =  $('.'+currentli+' #UserPassword').val();
           var email_value = "";
            if(email==''){
                  $('.'+currentli+' #UserBusinessEmail').css("border-color","#FF0000");
                  $('.'+currentli+ ' #error_useremail').text("* Mobile No. Required")
                  $('.'+currentli+ ' #error_useremail').show();
              }
              else{
          	    if (ValidateEmail(email)) {
                    email_id=1;
                    $('.'+currentli+' #UserBusinessEmail').css("border-color","#d7d8e0");
                    $('.'+currentli+ ' #error_useremail').hide();
                    email_value=1;
                  }
                  else{
                    email_id=0;
                    $('.'+currentli+' #UserBusinessEmail').css("border-color","#FF0000");
                    $('.'+currentli+ ' #error_useremail').text("* Enter Valid Mobile No.")
                    $('.'+currentli+ ' #error_useremail').show();
                }
                if(email_id==0){
                	   if (ValidateMobile(email)) {
                    email_id=1;
                    $('.'+currentli+' #UserBusinessEmail').css("border-color","#d7d8e0");
                    $('.'+currentli+ ' #error_useremail').hide();
                    email_value=0;
                  }
                  else{
                  	 $('.'+currentli+' #UserBusinessEmail').css("border-color","#FF0000");
                     $('.'+currentli+ ' #error_useremail').show();
                  }
                }
              }
              if(pass==''){
                  $('.'+currentli+' #UserPassword').css("border-color","#FF0000");
                  $('.'+currentli+ ' #error_userpassword').text("* Password Required");
                  $('.'+currentli+ ' #error_userpassword').show();
              }
              else{
                  $('.'+currentli+' #UserPassword').css("border-color","#d7d8e0");
                  $('.'+currentli+ ' #error_userpassword').hide();
              }
          if(email!='' && pass!='' && email_id==1){
         // $('.'+currentli+' .loading-login-buyer-ajax').css('display','inline-block');
         // loading-login-buyer
          $('.'+currentli+' .loading-login-buyer').css('display','inline-block');//updated on 17 th july
              $.ajax({
                  type: form.attr('method'),
                  url:  form.attr('action'),
                  data: data,
                   type : 'POST',
                  // success : handleData,
                 }).done(function(msg) {
        
          $('.'+currentli+' .loading-login-buyer').css('display','none');//updated on 17 th july
                 	  var obj = jQuery.parseJSON(msg);
                 	  var coupon = $("#offer_main_id").val();
                 	 var id = "offer_area"+coupon;
                 	  var result  = obj.result;
                 	  var name    = obj.user_name;
                 	 var coupon_type = $("#coupon_type").val();
                 	  if(result=='No'){
                 	  	$("."+currentli+" .loading-login-buyer").css("display","none");
          			 content = obj.content_user;
          			 if(content=='yes'){
          			 	password_correct = obj.password_correct;
          			 	user_activate  = obj.user_id_activate;
          			 	if(password_correct=='No'){
          			 		$('.'+currentli+' #UserPassword').css("border-color","#FF0000");
                  			$('.'+currentli+ ' #error_userpassword').text("* Enter Correct Password");
          					$('.'+currentli+ ' #error_userpassword').show();
          			 	}
          			 	else if(password_correct=='Yes'){
                    code_mobile = obj.code_mobile;
                   code_email = obj.code_email;
          if(code_mobile=='Yes'){
          $('.'+currentli+' .verification_register_client_loginsection_p').html(" We've SMSed you a Code for <span style='color:#ff0000;'>Account Activation</span> purpose. Please enter the Code below to complete Registration. Thank you.");
          }
          else if(code_email=='Yes'){
          $('.'+currentli+' .verification_register_client_loginsection_p').html(" We've Emailed you a Code for <span style='color:#ff0000;'>Account Activation</span> purpose. Please enter the Code below to complete Registration. Thank you.");
          }
          $('.'+currentli+' #User_Id_Verify_loginsection').val(user_activate);
          $('.'+currentli+' .verification_register_client_loginsection').show();
          			 	}
          			}
          			 else{
          			 	// * Enter Valid Mobile No.
                   		$('.'+currentli+' #UserBusinessEmail').css("border-color","#FF0000");
          			 	$('.'+currentli+ ' #error_useremail').text("* Enter Valid Mobile No.");
          			 	$('.'+currentli+ ' #error_useremail').show();
          			 }
                }
          		else{
                 	  			$("#User_Id").val(result);
                 	  			$("#user_name").val(name);
                 	  			$("#login").modal('hide');
                 	  			
                          $("#login-popup-vendors").modal('hide');
                 	  			$('body').removeClass('modal-open');
                 	  			$("#"+id).find('#register_alert').css('display','none');
                 	  			$(".modal-backdrop").hide();
                 	  			  $(".buyers-sellers-diff-before").hide();
                          $("#after-login-drop").show();
             		          $("#before-login-drop").hide();
                     		  $("#quoteloginbutton").hide();
                    		  $("#QuoteUserId").val(result);
                    		  $(".registered-action").hide();
                         $("._sd_lg_ft").hide();
                  // $("#LeadAddForm").submit();
                    lead_insert();
              }
                  	  			});
             }//email
          }); //onsubmit

function register_verification_vendor_seller(){
  var user = $("#User_Id_Verify_Vendor_seller").val();
  var code = $("#register_verify_main_vendor_seller").val();
  if(code==''){
        $("#verification_register_error_vendor_seller").text("* Activation Code Required");
        $("#verification_register_error_vendor_seller").css("color","#ff0000");
        $("#verification_register_error_vendor_seller").css("display","inline-block");
  }
  if(user!='' && code!=''){
    
     $(".loading-login-verify_vendor").css("display","inline-block");
      $.ajax({
         type: "POST",
         url: '/Generals/Registeration_Verification',
         data:"user="+user+"&code="+code,
         success: "success",
         dataType: 'text',
         context: document.body
    }).done(function(msg) {
      if(msg=='done'){
        $(".verification_register_client_vendor_seller").html("<p style='color:#000;display:inline-block;margin-top:10px;font-size:14px;'>Your Xerve Account has been <span>Activated</span>.<br/>Please <span style='color:#0070c0;cursor:pointer;' onclick='show_login_now()'>Login Now</span> and Continue Browsing.<br/> Thank you.</p>")
        
        $(".loading-login-verify_vendor").css("display","none");
      }
      else{
         
        $(".loading-login-verify_vendor").css("display","none");
        $("#verification_register_error_vendor_seller").text("* Enter Valid Activation Code");
        $("#verification_register_error_vendor_seller").css("display","inline-block");
        $("#verification_register_error_vendor_seller").css("color","#ff0000");
      }
    });
  }
}
function register_verification_vendor_buyer(){
  var user = $("#User_Id_Verify_Vendor").val();
  var code = $("#register_verify_main_vendor_buyer").val();
  if(code==''){
        $("#verification_register_error_vendor_buyer").text("* Activation Code Required");
        $("#verification_register_error_vendor_buyer").css("color","#ff0000");
        $("#verification_register_error_vendor_buyer").css("display","inline-block");
  }
  if(user!='' && code!=''){
    
    $(".loading-buyer-join-ajax").css("display","inline-block");
      $.ajax({
         type: "POST",
         url: '/Generals/Registeration_Verification',
     data:"user="+user+"&code="+code,
         success: "success",
         dataType: 'text',
         context: document.body
    }).done(function(msg) {
      if(msg=='done'){
          $(".verification_register_client_vendor").html("<p style='color:#000;display:inline-block;margin-top:10px;font-size:14px;'>Your Xerve Account has been <span>Activated</span>.<br/>Please <span style='color:#0070c0;cursor:pointer;' onclick='show_login_now()'>Login Now</span> and Continue Browsing.<br/> Thank you.</p>")
          
          $(".loading-buyer-join-ajax").css("display","none");
      }
      else{
        
          $(".loading-buyer-join-ajax").css("display","none");
          $("#verification_register_error_vendor_buyer").text("* Enter Valid Activation Code");
          $("#verification_register_error_vendor_buyer").css("display","inline-block");
          $("#verification_register_error_vendor_buyer").css("color","#ff0000");
      }
    });
  }
}
$(document).ready(function(){
/*registeration buyer */
$('.frontvendor #UserRegisterFormMainPageVendors').submit(function(e){
  var currentli = 'frontvendor';
  e.preventDefault();
  first_name = $('.'+currentli+' #txtFirstName').val();
  last_name  = $('.'+currentli+' #txtLastName').val();
  city = $('.'+currentli+' #login_popup_buyer_select_city_v').val();
  city_lati = $('.'+currentli+' #login_popup_buyer_latitude_v').val();
  city_long = $('.'+currentli+' #login_popup_buyer_longitude_v').val();
  mobile     = $('.'+currentli+' #txtMblNo').val();
  email      = $('.'+currentli+' #Business_Email').val();
  password   = $('.'+currentli+' #password1').val();
  var city_confirm = '';
  var email_id = '';
  var mobile_no = '';
  var email_id = $('.'+currentli+' #Business_Email').val();
  if(city=='Select City' || city=='' || city_lati=='' || city_long==''){
         $('.'+currentli+' input[id="login_popup_buyer_select_city"]').css("border-color","#FF0000");
         $('.'+currentli+ ' #error_city').show();
         city_confirm = 0;
      
}
else{
         $('.'+currentli+' input[id="login_popup_buyer_select_city"]').css("border-color","#d7d8e0");
         $('.'+currentli+ ' #error_city').hide();
         city_confirm = 1;
}
if(mobile==''){
      $('.'+currentli+' #txtMblNoHome').css("border-color","#FF0000");
            $('.'+currentli+ ' #error_mobile').text("* Mobile No. Required");
            $('.'+currentli+ ' #error_mobile').show();
}
else{
if (ValidateMobile(mobile)) {
          mobile_no=1;
          $('.'+currentli+' #txtMblNoHome').css("border-color","#d7d8e0");
          $('.'+currentli+ ' #error_mobile').hide();
          mobile_pressence(mobile,currentli);
}   
else{
          mobile_no=0;
          $('.'+currentli+' #txtMblNoHome').css("border-color","#FF0000");
          $('.'+currentli+ ' #error_mobile').text("* Enter Valid Mobile No.");
          $('.'+currentli+ ' #error_mobile').show();
      }
}
if(email=='')
{
      $('.'+currentli+' #Business_Email').css("border-color","#FF0000");
      $('.'+currentli+ ' #error_email').text("* Email Id Required");
      $('.'+currentli+ ' #error_email').css("display","table-row");
}
else{
      if (ValidateEmail(email)) {
          email_id=1;
          $('.'+currentli+' #Business_Email').css("border-color","#d7d8e0");
            $('.'+currentli+ ' #error_email').hide();
            email_pressence(email,currentli);
      }   
      else{
          email_id=0;
          $('.'+currentli+' #Business_Email').css("border-color","#FF0000");
            $('.'+currentli+ ' #error_email').css("display","table-row");
             $('.'+currentli+ ' #error_email').text("* Enter Valid Email Id");
      }
    }
if(first_name==''){
         $('.'+currentli+' #txtFirstName').css("border-color","#FF0000");
         
}
else{
    $("#txtFirstName").css("border-color","#d7d8e0");
}
if(last_name==''){
    $('.'+currentli+' #txtLastName').css("border-color","#FF0000");
}
else{
    $('.'+currentli+' #txtLastName').css("border-color","#d7d8e0");
}
if(password==''){
        $('input[id*="password1"]').css("border-color","#FF0000");
          $('.'+currentli+ ' #error_password').show();
}
else{
        $('input[id*="password1"]').css("border-color","#d7d8e0");
        $('.'+currentli+ ' #error_password').hide();
}
  var form = $(this);
  var data = form.serialize();
if(first_name!=''&& last_name!='' && email!='' && mobile!='' && city_confirm==1 && mobile_no==1 && email_id==1 && password!='' ){
  $('.'+currentli+' .loading-buyer-join-ajax').css('display','inline-block');
  $('.'+currentli+' .registeration_section_client_vendor').hide();
    $.ajax({
         type: "POST",
         url: '/Generals/checkUserAvailability',
        data:"mobile="+mobile+"&email_id="+email,
         success: "success",
         dataType: 'text',
         context: document.body
    }).done(function(msg) {
      if(msg=='true'){
       $('.'+currentli+' .loading-buyer-join-ajax').css('display','none');
          $.ajax({
        type: form.attr('method'),
        url:  form.attr('action'),
        data: data,
       }).done(function(msg) { 
           var obj = jQuery.parseJSON(msg);
            var result  = obj.result;
      $(".loading-login-join").hide();
          $('.'+currentli+' .verification_register_client_vendor').show();
          $('.'+currentli+' #User_Id_Verify_Vendor').val(result);
       });
   }
   else if(msg=='invalid'){
    $('.'+currentli+' .loading-buyer-join-ajax').css('display','none');
        $('.'+currentli+' .registeration_section_client_vendor').show();
        $('.'+currentli+' #txtMblNoHome').css("border-color","#FF0000");
          $('.'+currentli+ ' #error_mobile').text("* Enter Valid Mobile No.");
            $('.'+currentli+ ' #error_mobile').show();
        $(".loading-login-join").css('display','none');
   }
   else{
    $('.'+currentli+' .loading-buyer-join-ajax').css('display','none');
      $(".loading-login-join").css('display','none');
      $('.'+currentli+' .registeration_section_client_vendor').show();
   }
  });
  }
  else{
 }
 });
/*registeration buyer*/	
/*registeration seller*/
$('#UserRegisterFormVendors').submit(function(e){
  var currentli = 'frontvendor1';
  e.preventDefault();
first_name = $('.'+currentli+' #txtFirstName').val();
last_name  = $('.'+currentli+' #txtLastName').val();
mobile     = $('.'+currentli+' #txtMblNo').val();
email      = $('.'+currentli+' #Business_Email').val();
password   = $('.'+currentli+' #password1').val();
var email_id = '';
var mobile_no = '';
    var email_id = $('.'+currentli+' #Business_Email').val();
if(first_name==''){
         $('.'+currentli+' #txtFirstName').css("border-color","#FF0000");
        
}
else{
         $("#txtFirstName").css("border-color","#d7d8e0");
        
}
if(last_name==''){
         $('.'+currentli+' #txtLastName').css("border-color","#FF0000");
       
}
else{
         $('.'+currentli+' #txtLastName').css("border-color","#d7d8e0");
        
}
if(mobile==''){
         $('.'+currentli+' #txtMblNo').css("border-color","#FF0000");
          $('.'+currentli+ ' #error_mobile').text("* Mobile No. Required");
           $('.'+currentli+ ' #error_mobile').show();
      }
  else{
        if (ValidateMobile(mobile)) {
          mobile_no=1;
          $('.'+currentli+' #txtMblNo').css("border-color","#d7d8e0");
             $('.'+currentli+ ' #error_mobile').hide();
      }   
      else{
          mobile_no=0;
          $('.'+currentli+' #txtMblNo').css("border-color","#FF0000");
         
            $('.'+currentli+ ' #error_mobile').show();
      }
    }
if(email=='')
{
      $('.'+currentli+' #Business_Email').css("border-color","#FF0000");
      $('.'+currentli+ ' #error_email').text("* Email Id Required");
       $('.'+currentli+ ' #error_email').show();
}
else{
      if (ValidateEmail(email)) {
          email_id=1;
          $('.'+currentli+' #Business_Email').css("border-color","#d7d8e0");
          $('.'+currentli+ ' #error_email').hide();
      }   
      else{
          email_id=0;
          $('.'+currentli+' #Business_Email').css("border-color","#FF0000");
            $('.'+currentli+ ' #error_email').show();
      }
    }
if(password==''){
        $('.'+currentli+' #password1').css("border-color","#FF0000");
          $('.'+currentli+ ' #error_password').show();
}
else{
        $('.'+currentli+' #password1').css("border-color","d7d8e0");
        $('.'+currentli+ ' #error_password').hide();
}
  var form = $(this);
  var data = form.serialize();
 //end ready
var valid_mobile =  $('.'+currentli+' #mobile_valid_register').val();
var valid_email  =  $('.'+currentli+' #email_valid_register').val();
  if(valid_email==0 && mobile_no==1){
      $('.'+currentli+' #Business_Email').css("border-color","#ff0000");
      $('.'+currentli+ ' #error_email').show();
      $('.'+currentli+ ' #error_email').text("* Email Id Already Exists");  
  }
    if(valid_mobile==0 && email_id==1){
    $('.'+currentli+' #txtMblNo').css("border-color","#ff0000");
      $('.'+currentli+ ' #error_mobile').show();
      $('.'+currentli+ ' #error_mobile').text("* Mobile No. Already Exists");
}
   
if(first_name!=''&& last_name!='' && valid_email==1 && valid_mobile==1 &&  email!='' && mobile!='' && mobile_no==1 && email_id==1 && password!='' ){
        var check_mobil =  $('.'+currentli+' #text_buyer_validate_num').val();    
        var buyer_user_id = $('.'+currentli+' #text_buyer_mo_no').val();
       if (check_mobil==1 && buyer_user_id!='') {
        $('.'+currentli+' .sell_al_text').show();
        var value_ty = $(document.activeElement).attr('name')
        var validate_text_no = '';
        if (value_ty=='yes') {
           $.ajax({
            type: form.attr('method'),
            url:  form.attr('action'),
            data: data,
           }).done(function(msg) { 
              var obj = jQuery.parseJSON(msg);
            var result  = obj.result;
          
                $('.'+currentli+' .registeration_section_client_vendor_seller').hide();
                $('.'+currentli+' .verification_register_client_vendor_seller').show();
                $('.'+currentli+' #User_Id_Verify_Vendor_seller').val(result);
                $('.'+currentli+' .sell_al_text').hide();
                
           });
        }else if(value_ty=='no'){
            $('.'+currentli+' .sell_al_text').hide();
            $('.'+currentli+' #text_buyer_mo_no').val("");
            validate_text_no = 2;
            $('.'+currentli+' #txtMblNo').val("");
            $('.'+currentli+' #txtMblNo').css("border-color","#FF0000");
            $('.'+currentli+ ' #error_mobile').text("* Enter New Number");
            $('.'+currentli+ ' #error_mobile').show();
        }
       }else{    
          $.ajax({
        type: form.attr('method'),
        url:  form.attr('action'),
        data: data,
       }).done(function(msg) { 
        
           var obj = jQuery.parseJSON(msg);
            var result  = obj.result;
          $('.'+currentli+' .registeration_section_client_vendor_seller').hide();
          $('.'+currentli+' .verification_register_client_vendor_seller').show();
          $('.'+currentli+' #User_Id_Verify_Vendor_seller').val(result);
       });
    }
  }
  else{
 
 }
      });
/*registeration seller*/	
$(document).on('submit','#UserLoginFormVendor',function(event){
var currentli = 'frontvendor';

var form = $(this);
$(".registered-action").hide();
$("._sd_lg_ft").hide();
event.preventDefault();

var inner_btn_click=$('#inner_post_login').val();

    
    // Get the data from the form
 var data = form.serialize();

 var email = $('.'+currentli+' #UserBusinessEmail').val();
 var pass =  $('.'+currentli+' #UserPassword').val();
 var email_value = "";
  if(email==''){
        $('.'+currentli+' #UserBusinessEmail').css("border-color","#FF0000");
        $('.'+currentli+ ' #error_useremail').text("* Mobile No. Required")
        $('.'+currentli+ ' #error_useremail').show();
    }
    else{
	    if (ValidateEmail(email)) {
          email_id=1;
          $('.'+currentli+' #UserBusinessEmail').css("border-color","#d7d8e0");
          $('.'+currentli+ ' #error_useremail').hide();
          email_value=1;
        }
        else{
          	email_id=0;
          $('.'+currentli+' #UserBusinessEmail').css("border-color","#FF0000");
          $('.'+currentli+ ' #error_useremail').text("* Enter Valid Mobile No.")
          $('.'+currentli+ ' #error_useremail').show();
      }
      if(email_id==0){
      	   if (ValidateMobile(email)) {
          email_id=1;
          $('.'+currentli+' #UserBusinessEmail').css("border-color","#d7d8e0");
          $('.'+currentli+ ' #error_useremail').hide();
          email_value=0;
        }
        else{
        	 $('.'+currentli+' #UserBusinessEmail').css("border-color","#FF0000");
         	 $('.'+currentli+ ' #error_useremail').show();
        }
      }
    }
    if(pass==''){
        $('.'+currentli+' #UserPassword').css("border-color","#FF0000");
        $('.'+currentli+ ' #error_userpassword').text("* Password Required");
        $('.'+currentli+ ' #error_userpassword').show();
    }
    else{
        $('.'+currentli+' #UserPassword').css("border-color","#d7d8e0");
        $('.'+currentli+ ' #error_userpassword').hide();
    }
if(email!='' && pass!='' && email_id==1){

$('.'+currentli+' .loading-login-buyer').css('display','inline-block');

    $.ajax({
        type: form.attr('method'),
        url:  form.attr('action'),
        data: data,
        type : 'POST',
       
       }).done(function(msg) {
      
       $('.'+currentli+' .loading-login-buyer').css('display','none');
       
       	  var obj = jQuery.parseJSON(msg);
       	  var coupon = $("#offer_main_id").val();
        	var id = "offer_area"+coupon;
       	  var result  = obj.result;
       	  var name    = obj.user_name;
        	var coupon_type = $("#coupon_type").val();
       	  if(result=='No'){
             $('.'+currentli+' .loading-login-buyer').css('display','none');
			 content = obj.content_user;
			 if(content=='yes'){
			 	password_correct = obj.password_correct;
			 	user_activate  = obj.user_id_activate;
			 	if(password_correct=='No'){
			 		$('.'+currentli+' #UserPassword').css("border-color","#FF0000");
        	$('.'+currentli+ ' #error_userpassword').text("* Enter Correct Password");
					$('.'+currentli+ ' #error_userpassword').show();
			 	}

			 	else if(password_correct=='Yes'){
          code_mobile = obj.code_mobile;
          code_email = obj.code_email;
          if(code_mobile=='Yes'){

          $('.'+currentli+' .verification_register_client_loginsection_p').html(" We've SMSed you a Code for <span style='color:#ff0000;'>Account Activation</span> purpose. Please enter the Code below to complete Registration. Thank you.");
          }
          else if(code_email=='Yes'){
          $('.'+currentli+' .verification_register_client_loginsection_p').html(" We've Emailed you a Code for <span style='color:#ff0000;'>Account Activation</span> purpose. Please enter the Code below to complete Registration. Thank you.");
          }
          $('.'+currentli+' #User_Id_Verify_loginsection').val(user_activate);
          $('.'+currentli+' .verification_register_client_loginsection').show();
			 	}
			}
			 else{
         		$('.'+currentli+' #UserBusinessEmail').css("border-color","#FF0000");
   			 	  $('.'+currentli+ ' #error_useremail').text("* Enter Valid Mobile No.");
			 	    $('.'+currentli+ ' #error_useremail').show();
			 }
      }
		else{
       	  			$("#User_Id").val(result);
       	  			$("#user_name").val(name);
       	  			$("#login-popup-vendors").modal('hide');
       	  		
       	  			$('body').removeClass('modal-open');
       	  			$("#"+id).find('#register_alert').css('display','none');
       	  			$(".modal-backdrop").hide();
     	  			  $(".buyers-sellers-diff-before").hide();
                $("#after-login-drop").show();
          		  $("#before-login-drop").hide();
	          	  $("#quoteloginbutton").hide();
          		  $("#QuoteUserId").val(result);
          		  $(".registered-action").hide();
                $("._sd_lg_ft").hide();
              if(inner_btn_click==1){
                  lead_insert_inner(inner_btn_click);
              }else{
                lead_insert();
              }
             
               
               
       }
        	  			});
   }//email

}); //onsubmit
 });
function lead_insert_inner(i){
   
   var member_inner=$( '#member_type_inner-'+i+':checked' ).val();
    $('#full_name_inner-'+i).show();
    $('#mobile_number_inner-'+i).show();
    $('.member_type_member-'+i).prop( "checked", false );
    $('.member_type_guest-'+i).prop( "checked", true );
    $('#guest_inner-'+i).show();
    $('#member_inner-'+i).hide();

    var check_controller=$("#check_controller").val();
    $("#submit_clicked").val("1");
    $("#quotesave").show();
    

    var productspec=$("#productspec_inner-"+i).val();
    var quantity=$("#quantity_inner-"+i).val();
    var budget=$("#budget_inner-"+i).val();
    var b2c=$("#b2c").val();
    
    var cat_id=$("#seo_cat_id").val();
    var sub_cat_id=$("#seo_sub_cat_id").val();
    var city_id=$("#seo_city_id").val();
    var city_name=$("#seo_city_name").val();
    var area_id=$("#seo_area_id").val();
    var area_name=$("#seo_area_name").val();

    var member_type=1;
    var enquiry_time=$("#QuoteEnquiryTime").val();
    var formid=$("#QuoteFormid").val();
    var user_id=$("#QuoteUserId").val();
    var unique_ip=$("#unique_ip").val();
    var genie_url=$("#genie_url").val();
    
              
     /*Null Validations ends*/
     var prelogin=1;
     var second_click=0;
    if (user_id) {
             $("#leadform_loading").show();
             $("#LeadAddForm").hide();
             $("#totrestoimgcol").hide();

             var dataString ='b2c='+b2c+'&userid='+user_id+'&productspec='+encodeURIComponent(productspec)+
             '&formid='+formid+'&quantity='+quantity+'&budget='+budget+'&member_type='+member_type+
             '&check_controller='+check_controller+'&genie_url='+encodeURIComponent(genie_url)+'&prelogin='+
             prelogin+'&unique_ip='+unique_ip+'&cat_id='+cat_id+'&sub_cat_id='+sub_cat_id+'&city_id='+
             city_id+'&city_name='+city_name+'&area_id='+area_id+'&area_name='+area_name;
            
            
                $.ajax({
                    type: "POST",
                    url: '/genie/prelogin_direct',
                    data: dataString,
                    cache: false,
                    async: true, //blocks window close
                    success: function(data,textStatus,xhr){

                   

                      $("#leadform_loading-"+i).hide();
                      $("#LeadAddForm").show();
                      $("#productspec_inner-"+i).val("");
                      $("#b2c").val("");
                      $("#quote_response_inner-"+i).show();
                      $("#quote_response1_inner-"+i).show();
                      $("#totrestoimgcol").show();
                      $("#quantity_inner-"+i).val("");
                      $("#budget_inner-"+i).val("");
                      $("#quotesave").show();

                    } //success
                });//ajax
            }   //if user_id
            

}  

