
//$("#quotesave, #quoteguestsave").on('click touchstart',function(e) {
	



function member_type_1(){
	var member_type=$('#member_type:checked').val();

	if(member_type == 0){//guest
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
}
function quote_save(){
//$("#quotesave, #quoteguestsave").on('click touchstart',function(e) {

//console.log('quotesave');
//e.preventDefault();
var login_type=$("#genie_login_type").val();

var check_controller=$("#ControllerName").val();
var genie_title=$("#genie_title").val();
//var unique_ip=$("#unique_ip").val();

//$("#login-popup-vendors").modal('show');

var actual_link='g-4';//search result page details

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
var formid=4;
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
var sub_cat_id=$("#seo_sub_cat_id").val();
var check_cd=$("#check_cd").val();
var otp_number=$('#otp_number').val();
var member_type=$('#member_type').val();
var otp_checked=0;
var one2one=0;
var brand='';
      
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
         }//guest
                    
             
                     
   
        }
 var dataString ='b2c='+b2c+'&productspec='+encodeURIComponent(productspec)+'&formid='+formid+'&login_city='+login_city+'&login_state='+login_state+'&login_area='+login_area+'&login_address='+login_address+'&login_city1='+login_city1+'&login_area1='+login_area1+'&login_state1='+login_state1+'&login_address1='+login_address1+'&enquiry_time='+enquiry_time+'&login_state='+login_state+'&login_state1='+login_state1+'&login_zone='+login_zone+'&login_zone1='+login_zone1+'&login_zones='+login_zones+'&login_zones1='+login_zones1+'&login_lat='+login_lat+'&login_long='+login_long+'&login_lat1='+login_lat1+'&login_long1='+login_long1+'&member_type='+member_type+'&full_name='+full_name+'&mobile_number='+mobile_number+'&check_controller='+check_controller+'&genie_url='+encodeURIComponent(genie_title)+'&second_click='+second_click+'&check_quote_id='+check_quote_id+'&otp_checked='+otp_checked+'&actual_link='+encodeURIComponent(actual_link)+'&login_type='+login_type+'&budget='+budget+'&quantity='+quantity+'&brand='+brand+'&one2one='+one2one;
 
   $("#leadform_loading").show();
   $("#LeadAddForm").hide();    
   //$("#quoteguestsave").hide();

$.ajax({
    type: "POST",
    url: '/genie/form_submit',
    data: dataString,
    cache: false,
    async: false, //async true- block window close
    success: function(data,textStatus,xhr){
    
      var obj=$.parseJSON(data);
     // console.log(obj);
     
         if(obj['yes']==1){ //need otp
                              //$("#get_pricealert").hide();
                               $("#otp_verify_form").css("display","block");
                               $('._quot-form').addClass('gienotp');
                               $("#otp_number").focus();
                               $("#guest_type").val(obj['guest']);
                               $("#check_quote_id").val(obj['quote_id']);
                               $("#check_mob_no").val(obj['mobile_number']);
                               $("#check_cd").val(obj['cd']);
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
              $("#budget").val("");
            
              $("#mobile_number").val("");
              $("#dpd1").val("");
              $("#leadform_loading").hide();
                                             
            
    } ,
        error: function (error) {
       
    }

});//

}

/*otp verification of guest mobile*/
function verify_guest_otp()
   {
    
          var otp_number=$("#otp_number").val();
          console.log(otp_number);
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
          
          if(otp_number == '')  {
            $('#otp_number').css("border-color","#ff0000");
            return false;
          }
          else{
               $('#otp_number').css("border-color","#dddddd");
          }
        var dataString ='otp_number='+otp_number+'&guest_type='+guest_type+'&check_quote_id='+check_quote_id;
        console.log(dataString);
         
       $.ajax({
                      type: "POST",
                      url: '/genie/verify_guest_otp',
                      data: dataString,
                      cache: false,
                      success: function(data,textStatus,xhr){ 
                             console.log(textStatus);
                             var obj=$.parseJSON(data);
                             console.log(obj);
                              if(obj==1){
                                          $("#productspec").val("");
                                          $("#quantity").val("");
                                          $("#budget").val("");
                                          $("#login_popup_leads_select_city2").val("");
                                          $("#pub").val("");
                                          $("#rest").val("");
                                          $("#full_name").val("");
                                          $("#dpd1").val("");
                                          $("#mobile_number").val("");
                                          $("#otp_number").val("");
                                          $('#mobile_number').hide();
                                          $('#full_name').hide();
                                          $("#otp_verify_form").hide();
                                          $("#LeadAddForm")[0].reset();

                                         // $('._quot-form').addClass('gienotp');
                                          $("#LeadAddForm").show();
                                          $("#quote_response").show();
                                          $("#quote_response1").show()
                                          $("#pubsorresto").show();
                                          $(".main_form").show();
                                          $("#quoteguestsave").show();
                               //}           
                
                               }else{
                                          $(".main_form").hide();
                                          $("#otp_verify_form").show();
                                          $("#invalid_otp").show();
                               }
                      } //success
            });//ajax
 }//verify_guest_otp

 function hide_link(){
               $('#resend_code_btn_now').hide();
               $('#resend_code_btn').show();
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
                      } //success
            });//ajax

}

function close_response(){
     $("#quote_response").hide();
     $("#quote_response1").hide();
}

/*Geo Location codes*/
function lead_insert()
   {
   console.log('lead_insert...');
    var check_controller=$("#ControllerName").val();
    
     $("#submit_clicked").val("1");
     $("#quotesave").show();
    var enquiry_time=$("#QuoteEnquiryTime").val();
    var formid=4;
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
    var genie_links='g-4';
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
             var dataString ='b2c='+b2c+'&userid='+user_id+'&productspec='+encodeURIComponent(productspec)+'&formid='+formid+'&login_city1='+login_city1+'&login_area1='+login_area1+'&login_state1='+login_state1+'&login_address1='+encodeURIComponent(login_address1)+'&enquiry_time='+enquiry_time+'&login_zone1='+login_zone1+'&login_zones1='+login_zones1+'&login_lat1='+login_lat1+'&login_long1='+login_long1+'&quantity='+quantity+'&budget='+budget+'&member_type='+member_type+'&check_controller='+check_controller+'&genie_url='+encodeURIComponent(genie_url)+'&prelogin='+prelogin+'&cat_id='+cat_id+'&sub_cat_id='+sub_cat_id+'&genie_links='+genie_links;
            // console.log(dataString);
           
                $.ajax({
                    type: "POST",
                    url: '/genie/preloginajaxadd',
                    data: dataString,
                    cache: false,
                    async: true, //blocks window close
                    success: function(data,textStatus,xhr){
                    
                   
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
                      //$("#quotesave").show();
                      $('#member_type').prop( "checked", false );
                      $("#member").show();
                      $("#quotesave").show();
                    } //success
                });//ajax
            }   //if user_id
            return false;
        }