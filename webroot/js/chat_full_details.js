$(document).ready(function(){
    // $(document).bind("contextmenu",function(e) {
    //  e.preventDefault();
    // });
    
    // $(document).keydown(function(event){
    //     if(event.keyCode==123){
    //        //Prevent from F12
    //       event.preventDefault();
    //     }
    //     else if(event.ctrlKey && event.shiftKey && event.keyCode==73){ 
    //       event.preventDefault();
    //        //Prevent from ctrl+shift+i
    //     }
    // });
        var productspec=$("#product_spec").val();
        var contact_prio=$("#contact_prio").val();
        $('.custcontact').css('top','184px');
        var sid=$("#sid_id").val();
        var leads_down=$("#leads_down").val();
        var stat=$("#stat").val();
        var enquiry_id=$("#enquiry_id").val();
        var client_status=$("#client_status").val();
        var server_status=$("#server_status").val();
        var quote_status=$("#quote_status").val();
        var buydate=$("#buyingdate").val();;
        var expiry_date=$("#expiry_date").val();
        var userid=$("#userid").val();
        var quoted_user=$("#quoted_user").val();
        var today=$("#today").val();
        var leads_down=$("#leads_down").val();
        var disable=$("#disabled").val();
        if(stat=='success')
         {  
            reload();
            chat_display_modal_after_pay();
        }
        if((leads_down==0)||(leads_down==3)){
                   chat_flip_info_main_test(); 
        }
            if(sid!=0){
                  var idleState = false;
                  var idleTimer = null;
                  $('.sd-chatmaincontainer').on('mousemove click touchstart mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick swipe tap taphold', function () {
                  clearTimeout(idleTimer);
                  var i=0;
                  if (idleState === true) { 
                                  chatlogin();
                                  $("#timer").val(1);
                                  var timer=$("#timer").val();
                                  if(timer==1){
                                       var time_interval =setInterval(reload, 5000);
                                       $("#timer").val(timer);
                                       $("#time_interval").val(time_interval);
                                  }
                  }
                  idleState = false;
                  idleTimer = setTimeout(function () { 
                   i=i+1; 
                   chatlogoff(); 
                   var time_interval =$("#time_interval").val();
                   clearInterval(time_interval);
                   $("#timer").val(0);
                   reload(); 
                  idleState = true;
                 }, 60000);
        });//mark as logged in
                 $("body").trigger("mousemove");
                 $("body").trigger("touchstart");
                 $("body").trigger("scroll");
       }
        mark_read();
          if((quote_status ==5)||(today >= expiry_date)){
          }
          else{
              $("#toggle_require").hide();
          }//live enquiries
          $("#first-tab").on('click tap',function(e){
                $("#first-tab").addClass("active");
                $("#second-tab").removeClass("active");
                $("#third-tab").removeClass("active");
                $("#first-tab-details").show();
                $("#second-tab-details").hide();
                $("#third-tab-details").hide();
          }); 
          $("#second-tab").on('click tap',function(e){
                $("#second-tab").addClass("active");
                $("#first-tab").removeClass("active");
                $("#third-tab").removeClass("active");
                $("#first-tab-details").hide();
                $("#second-tab-details").show();
                $("#third-tab-details").hide();
          }); 
          $("#third-tab").on('click tap',function(e){
                $("#third-tab").addClass("active");
                $("#second-tab").removeClass("active");
                $("#first-tab").removeClass("active");
                $("#first-tab-details").hide();
                $("#second-tab-details").hide();
                $("#third-tab-details").show();
          }); 
          $("#show_payment").on('click tap',function(e){
                $("#pay_block").css("display","block");
                $("#pay_block").css("margin-top","-140px");
                $("#req_block").css("display","none");
                $("#offer_block").css("display","none");
          });
          $("#show_attach").on('click touchstart',function(e){
              $("#attach_ins").show();
              $("#chat_img_upload").modal('show');

          });
          $( window ).on( "load", function() {
          $("ul.sdchatmsg").animate({scrollTop: $('ul.sdchatmsg li:last').offset().top - 0});
             mark_read();
          });
          $("#checkbutton").on('click',function(e){
              var check_seller=$("#sellers_category").val();
              if(check_seller == 0){
                 $("#category_block_reason").show();
                 return;
              }
              $('#1a').removeClass("active"); 
              $('#req_class').removeClass("active");
              $('#2a').addClass("active");
              $('#chat_class').addClass("active");
          });
          $("#checkbuttonsid").on('click',function(e){
              var check_seller=$("#sellers_category").val();
              if(check_seller == 0){
                 $("#category_block_reason").show();
                 return;
              }
              $('#1a').removeClass("active"); 
              $('#req_class').removeClass("active");
              $('#2a').addClass("active");
              $('#chat_class').addClass("active");
          });
          $("#contact_client_pay, #checkbutton_next").on('click',function(e){
              $('#1a').removeClass("active"); 
              $('#req_class').removeClass("active");
              $('#2a').addClass("active");
              $('#chat_class').addClass("active");
          });
          $("#checkbutton_login").on('click',function(e){
              $('#1a').removeClass("active"); 
              $('#req_class').removeClass("active");
              $('#2a').addClass("active");
              $('#chat_class').addClass("active");
          });
          $("#viewdetails_login").on('click',function(e){
              $('#1a').removeClass("active"); 
              $('#req_class').removeClass("active");
              $('#2a').addClass("active");
              $('#chat_class').addClass("active");
          });
          $("#viewdetails_before_login").on('click',function(e){
              $('#1a').removeClass("active"); 
              $('#req_class').removeClass("active");
              $('#2a').addClass("active");
              $('#chat_class').addClass("active");
          });
         if (window.innerWidth < 700 ) {  
              $('.type-a-message-box').click(function(event) {
                  if($(event.target).is('input.input-sm')){
                      $('#header-include-hover').addClass('rmheader');
                  }
                  else {
                      $('#header-include-hover').removeClass('rmheader');   
                  } 
              });
              $('.type-a-message-box').mouseleave(function(){
                    $('#header-include-hover').removeClass('rmheader');   
              }); 
         } 
          $("#contact_client_pay_login").on('click',function(e){
            console.log('contact client pay login');
          if(!e.detail || e.detail == 1){ 
            var quoted_user=$('#quoted_user').val();
            var buyer_status=$('#buyer_status').val();
            var b2c =$("#b2c").val();
            var userid=$("#User_Id").val();
            var pre_balance=$("#leads_credits_balance").val();//check
            var min_credit=$("#min_credit").val();
            var post_balance=pre_balance - min_credit;
            var quoteid=$("#quoteid").val();
            var enquiry_id=$("#enquiry_id").val();
            var serverid=$("#serverid").val();//receiving user
            var productspec=$("#productspec").val();
              var dataString = 'type='+ b2c+'&quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid+
              '&enquiry_id='+enquiry_id+'&productspec='+encodeURIComponent(productspec);
              e.preventDefault(); 
                  $.ajax({
                        type: "POST",
                        url: '/leads/category_ajax_for_detail',
                        data: dataString,
                        success: function(data,textStatus,xhr){ 
                        var obj=$.parseJSON(data);
                        var flag=obj.flag;
                        var firstname=obj.first_name;
                        var lastname=obj.last_name;
                        if(flag == 'false'){
                                $("#category_block_reason").show();
                                $("#contact_client_pay_login").hide();
                                $("#full_name").hide();
                                $("#full_name_ajax").show();
                                $("#full_name_ajax").text('Dear '+firstname+' '+lastname);
                                return false;
                            }
                           else{  
                                 $.ajax({
                                          type: "POST",
                                          url: '/leads/contact_client',
                                          data: dataString,
                                          cache: false,
                                          async: true, 
                                          success: function(data,textStatus,xhr){ 
                                            $('#1a').removeClass("active"); 
                                            $('#2a').addClass("active");
                                            $('#req_class').removeClass("active");
                                            $('#chat_class').addClass("active");
                                            $('#chats_pkg_details').hide()
                                            $("#checkbutton_login").show();
                                            $("#contact_client_pay_login").hide();
                                            $("#chat_visible").hide();
                                            $("#instalogin_credits").show();
                                            $("#instalogin_credits").text('Your Credits Balance: '+post_balance);
                                   } 
                              });
                        }
                    } 
                  });
            }
            });
          $(".track_seller").on('click',function(e){
              var userid=$("#receiver").val();
              var quoteid=$("#quoteid").val();
              var enquiry_id=$("#enquiry_id").val();
              var dataString = 'quoteid='+quoteid+'&userid='+userid+'&enquiry_id='+enquiry_id;
                    $.ajax({
                              type: "POST",
                              url: '/leads/track_number',
                              data: dataString,
                              cache: false,
                              success: function(data,textStatus,xhr){ 
                              } 
                  });
          });
          $("#track_seller_count").on('click',function(e){
                  var userid=$("#receiver").val();
                  var quoteid=$("#quoteid").val();
                  var enquiry_id=$("#enquiry_id").val();
                  var dataString = 'quoteid='+quoteid+'&userid='+userid+'&enquiry_id='+enquiry_id;
                  $.ajax({
                          type: "POST",
                          url: '/leads/track_number/',
                          data: dataString,
                          cache: false,
                          success: function(data,textStatus,xhr){ 
                          } 
                  });
          });
    $("#sendMessage, #sendMessage_sub").on('click',function() {
        console.log('msg button pressed');
        var sid=$("#sid_id").val();
        var leads_down=$("#leads_down").val();
        var free_credits=$("#free_credits").val();
        free_credits=parseInt(free_credits); 
        var leads_credits_balance = $("#leads_credits_balance").val();
        leads_credits_balance=parseInt(leads_credits_balance); 
        var min_credit = $("#min_credit").val();
        min_credit=parseInt(min_credit); 
          if((leads_down == 0)||(leads_down == 3)){
                  if(free_credits>2){
                          if(leads_credits_balance < min_credit){
                            chat_flip_info_main_test();
                            return false;
                          }
                    }
          }
          var  timer=$("#timer").val();
          var time_interval=$("#time_interval").val();
          clearInterval(time_interval);
          $("#timer").val(0);
          var message=$(".type-a-message-box").val();
          var productspec=$("#productspec").val();
          $("#send_click").val(1);
          var guest_flag=$("#guest_flag").val();
          var cat_id=$("#sel_cat_id").val();
          var guest_user_id=$("#guest_user_id").val();
          if(message == '' || message == ' ' || message == undefined){
                $('#chat_msg_error').show().delay(4000).fadeOut();
                       return false;  
          }
          else{
                    message=nl2br(message);
                    $(".type-a-message-box").val("");
                    $(".type-a-message-box").prop('disabled', true);
                    var check_seller=$("#sellers_category").val();
                    var logged=$("#receiver").val();
                    var chat_msg_time=$("#chat_msg_time").val();
                    var chat_msg_time_display_show=time_format(chat_msg_time);
                    var seller_prio=$("#seller_prio").val();
                    var tot_res=$("#tot_res").val();
                        if(logged ==''){//not logged in
                                     $("#sellers_login").css("background-color", "red");
                                     $("#quoteseller_loginbutton").css("color", "yellow");
                                     $("#sellers_login").css("color", "#fff");
                                     $("#sellers_login").show();
                                    return false;
                        }
                        if(check_seller == 0){ 
                        }
                    var b2c = $("#b2c").val();
                    var quoteid=$("#quoteid").val();
                    var enquiry_id=$("#enquiry_id").val();
                    var userid=$("#userid").val();
                    var serverid=$("#server_id").val();
                    var quoted_user=$("#quoted_user").val();
                    if(userid != quoted_user){ 
                  
                       var result = '<li class="server" >'+'<a  class="time img_chat" title=""  style="float:right">'+
                      '<img class="img-circle" src="/img/avatars/seller.png" alt="Profile" style=""></a>'+
                      '<div class="sdcht pull-right">'+'<span class="chat-user-status"><img src="/img/chat_online.png" alt="<i>online</i>">'+
                      '<i>online</i></span>'+'<span class="time label label-success" >'+chat_msg_time_display_show+'</span>'+
                      '</div>'+'<div class="message-area"  style="cursor: not-allowed;">'+
                      '<span class=""></span>'+'<div class="info-row">'+'<span class="user-name" style="text-transform:none">'+
                      '<a ><strong><b>ME</b></strong></a></span></span>'+
                      '<span class="time label label-success" id="1219"></span>'+
                      '<div class="clear"></div>'+'</div>'+'<p>'+message+'</p>'+
                      '</div>'+'<div class="clear"></div>'+
                      '</li>';  
                      $('ul.sdchatmsg').append(result);
                      scrollHeight=0;
                      $("ul.sdchatmsg").animate({ scrollTop: $("ul.sdchatmsg")[0].scrollHeight}, 0);
                        if((leads_down == 0)||(leads_down == 3)){
                                if(leads_credits_balance >= min_credit){
                                    $("#pre_contact").show();
                                    $("#post_contact").hide();
                                    if(tot_res <=5){
                                        chat_flip_info_main();
                                    }
                                    contact_client_pay();
                                  }
                                  else{//low credit balance
                                                return false;
                                  }
                        }
                  }
                  var dataString = 'message='+ message+'&quoteid='+quoteid+'&userid='+userid+
                  '&serverid='+serverid+'&enquiry_id='+enquiry_id+'&b2c='+b2c+'&chat_msg_time='+chat_msg_time+
                  '&guest_user_id='+guest_user_id+'&guest_flag='+guest_flag+'&cat_id='+cat_id+
                  '&productspec='+productspec;
                      $.ajax({
                        type: "POST",
                        url: '/leads/ajaxsend',
                        data: dataString,
                        cache: false,
                        async: true, //blocks window close
                        success: function(data,textStatus,xhr){ 
                        $(".type-a-message-box").prop('disabled', false);
                        $("#after_contact_pay1").hide();
                        $('#before_pay_but').attr('placeholder', 'Type Your Message Here ..');
                          reload_insert();
                          $("#timer").val(1);
                          $("#chat_flip_info_terms_test").modal('hide');
                        } 
                      });
                    return false;
            }
    });
/* When enter key is pressed*/
    var enterPressed = false;
    $(".type-a-message-box").keypress(function(event){
        console.log('msg box pressed');
        var sid=$("#sid_id").val();
        var leads_down=$("#leads_down").val();
        var guest_flag=$("#guest_flag").val(); 
        var guest_user_id=$("#guest_user_id").val();
        var seller_prio=$("#seller_prio").val();
        var tot_res=$("#tot_res").val();
        var leads_credits_balance = $("#leads_credits_balance").val();
        leads_credits_balance=parseInt(leads_credits_balance); 
        var min_credit = $("#min_credit").val();
        min_credit=parseInt(min_credit); 
        var free_credits=$("#free_credits").val();
        free_credits=parseInt(free_credits); 
        var  timer=$("#timer").val();
        var time_interval=$("#time_interval").val();
        clearInterval(time_interval);
        $("#timer").val(0);
        $("#send_click").val(1);
        var ID = $(this).attr("id");
        var b2c = $("#b2c").val();
        var quoteid=$("#quoteid").val();
        var enquiry_id=$("#enquiry_id").val();
        var serverid=$("#server_id").val();
        var guest_user_id=$("#guest_user_id").val();
        var send=1;
        var keycode = (event.keyCode ? event.keyCode : event.which);
        var logged=$("#receiver").val();
        var message=$(".type-a-message-box").val();
        var cat_id=$("#sel_cat_id").val();
        var productspec=$("#productspec").val();
        message=nl2br(message);
        var login_form=$("#loginvendor").val();
        var chat_msg_time=$("#chat_msg_time").val();
        var chat_msg_time_display_show=time_format(chat_msg_time);
        if(logged ==''){}
          else{
            var log_in=1;//user is logged in
          }
        if(keycode == '13'){
            if((leads_down == 0)||(leads_down == 3)){
                        if(free_credits>2){
                                    if(leads_credits_balance < min_credit){
                                         chat_flip_info_main_test();
                                         return false;
                                    }
                        }
            }
            var userid=$("#userid").val();
            var quoted_user=$("#quoted_user").val();
            var buyer_status=$("#buyers_status").val();
            var check_seller=$("#sellers_category").val();
            if((check_seller == 0)&&(log_in == 1)){
            }
            if(message == '' || message == ' ' || message == undefined){//no chat messages
                  $(".paystrp").show();
                  $('#chat_msg_error').show().delay(3000).fadeOut();
            }
            else{
                  $(".type-a-message-box").val("");
                  $(".type-a-message-box").prop('disabled', false);
                 var result = '<li class="server" >'+
                 '<a  class="time img_chat" title=""  style="float:right">'+
                 '<img class="img-circle" src="/img/avatars/seller.png" alt="Profile" style=""></a>'+
                 '<div class="sdcht pull-right">'+'<span class="chat-user-status">'+
                 '<img src="/img/chat_online.png" alt="<i>online</i>">'+
                 '<i>online</i></span><span class="time label label-success" >'+chat_msg_time_display_show
                 +'</span>'+'</div>'+ '<div class="message-area"  style="cursor: not-allowed;">'+
                 '<span class=""></span>'+'<div class="info-row">'+
                 '<span class="user-name" style="text-transform:none"><a ><strong><b>ME</b>'+
                 '</strong></a></span></span>'+'<div class="clear"></div>'+'</div>'+
                 '<p>'+message+'</p>'+'</div>'+'<div class="clear"></div>'+
                 '</li>';
                  $('ul.sdchatmsg').append(result);
                  scrollHeight=0;
                  $("ul.sdchatmsg").animate({ scrollTop: $("ul.sdchatmsg")[0].scrollHeight}, 0);      
                  var quote_status=$("#quote_status").val();
                  if(quote_status == 5){
                    return false;
                  }
                  if(buyer_status == 1){ 
                    return false;
                  }
                  if(userid !=quoted_user){
                              if((leads_down == 0)||(leads_down == 3)){
                                  if(leads_credits_balance >= min_credit){
                                        if(tot_res <=5){
                                          chat_flip_info_main();
                                        }
                                        contact_client_pay();
                                  }
                                  else{
                                        return false;
                                  }
                              }
                  }
                  else{
                        return false;
                 }
                 enterPressed = true;
                 if(message != '') {
                      var dataString = 'message='+ message+'&quoteid='+quoteid+'&userid='+userid+
                      '&serverid='+serverid+'&enquiry_id='+enquiry_id+'&b2c='+b2c+
                      '&chat_msg_time='+chat_msg_time+'&guest_user_id='+guest_user_id+
                      '&guest_flag='+guest_flag+'&cat_id='+cat_id+'&productspec='+productspec;
                      $(".type-a-message-box").val("");
                          $.ajax({
                              type: "POST",
                              url: '/leads/ajaxsend',
                              data: dataString,
                              success: function(data,textStatus,xhr){ 
                                  $('#loading_image_selection_store_main').hide();
                                  $("#after_contact_pay1").hide();
                                  $('#before_pay_but').attr('placeholder', 'Type Your Message Here ..');
                                  reload_insert();
                                  $("#timer").val(1);
                              } 
                          });
                          return false;
                  } 
                }   
              }//if key is enter
              else{
              }
  });//key press function
});//onload
//block F5 & Control+F5
  function chatlogoff(){
      var quoteid=$("#quoteid").val();
      var userid=$("#userid").val();//logged in user
      var enquiry_id=$("#enquiry_id").val();//receiver
      var serverid=$("#server_id").val();
      var dataString;
        if (quoteid) {
                       dataString = 'quoteid='+quoteid+'&userid='+userid+'&enquiry_id='+enquiry_id;
                        $.ajax({
                            type: "POST",
                            url: '/leads/chatlogoff',
                            data: dataString,
                            cache: false,
                            async: true, 
                            success: function(data,textStatus,xhr){ 
                            } 
                        });
        }
  }
  function chatlogin(){
      var quoteid=$("#quoteid").val();
      var userid=$("#userid").val();
      var enquiry_id=$("#enquiry_id").val();
      var serverid=$("#server_id").val();
      var dataString;
        if (quoteid) {
                        dataString = 'quoteid='+quoteid+'&userid='+userid+'&enquiry_id='+enquiry_id;
                        $.ajax({
                                  type: "POST",
                                  url: '/leads/chatlogin',
                                  data: dataString,
                                  cache: false,
                                  async: true, //blocks window close
                                    success: function(data,textStatus,xhr){ 
                                       reload();
                                    } //success
                        });
        }
  }
  /*reload for loggedin user insertion*/
  function reload_insert(){
        console.log('reload_insert');
        var sel_cat_id=$("#sel_cat_id").val();
        var cust_full_name=$("#full_name").val();
        var genie_url=$("#genie_url").val();
        var full_name=$("#full_name").val();
        var quoteid=$("#quoteid").val();
        var userid=$("#userid").val();
        var serverid=$("#server_id").val();
        var guest_flag=$("#guest_flag").val();
        var guest_user_id=$("#guest_user_id").val();
        var buyer_gender=$("#buyer_gender").val();
        var seller_loc=$("#seller_loc").val();
        var buyer_loc=$("#buyer_loc").val();
        var buyername=$("#buyername").val();
        var quantity=$("#quantity").val();
        var budget=$("#budget").val();
        var total_budget=parseInt(quantity) * parseInt(budget); 
        var view_seller_contact=$("#view_seller_contact").val();
        var view_buyer_contact=$("#view_buyer_contact").val();
        var view_buyer_contact_mask=$("#view_buyer_contact_mask").val();
        var seller_prio= get_seller_contact_prio_ajax();
        var leads_down=$("#leads_down").val();
        var quoted_user=$("#quoted_user").val();
        var sid=$("#sid_id").val();
        var test='';
        var result;
        var dataString = 'quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid+'&guest_flag='+guest_flag+
        '&guest_user_id='+guest_user_id;
                if((leads_down==0)||(leads_down==3)){
                      test='chat_flip_info_main_test()';
                }else{
                      test='chat_display_modal_after_pay()';
                }
          $.ajax({
                  dataType: "json",
                  type: "POST",
                  url: '/leads/ajaxupdate',
                  data: dataString,
                  //cache: false,
                  async: true, 
                  success: function(data){ 
                  var json_data = JSON.stringify(data);
                  var myarray = new Array();
                  var msgtime= Date();
                  var chat_status='';
                  var msgid;
                  var user_id;
                  var username;
                  var receiver_id;   
                  var messages;
                  var intromsg;
                  var offer_flag;
                  var read_status='';
                  var mbchat='';
                  var icon="";
                  var bud='';
                  var quant='';
                  var company_name='';
                  var chat_status;
                  var chat_status_buyer=0;
                  var read_stat;
                  var time=''; 
                  var target="";
                  var seller_url="";
                  var username_style=""; 
                  var view_contact='';
                  var img_chat_style="";
                  var img_circle_style="";
                  var icon="";
                  var lclass="";  
                  var src="";
                  var location="";
                  var status_src="";
                  var status_on=""; 
                  var rd;
                  var rdyear;
                  var rdmonth = new Array();
                      rdmonth[0] = "Jan";
                      rdmonth[1] = "Feb";
                      rdmonth[2] = "Mar";
                      rdmonth[3] = "Apr";
                      rdmonth[4] = "May";
                      rdmonth[5] = "Jun";
                      rdmonth[6] = "Jul";
                      rdmonth[7] = "Aug";
                      rdmonth[8] = "Sep";
                      rdmonth[9] = "Oct";
                      rdmonth[10] = "Nov";
                      rdmonth[11] = "Dec";
                  var rdweekday = new Array(7);
                     rdweekday[0] =  "Sun";
                      rdweekday[1] = "Mon";
                      rdweekday[2] = "Tue";
                      rdweekday[3] = "Wed";
                      rdweekday[4] = "Thu";
                      rdweekday[5] = "Fri";
                      rdweekday[6] = "Sat";
                  var rdmon ;
                  var rdday ;
                  var rdweekday ;
                  var rdhrs  ; 
                  var rdmins  ;
                  var d ;
                  var year ;
                  var month = new Array();
                      month[0] = "Jan";
                      month[1] = "Feb";
                      month[2] = "Mar";
                      month[3] = "Apr";
                      month[4] = "May";
                      month[5] = "Jun";
                      month[6] = "Jul";
                      month[7] = "Aug";
                      month[8] = "Sep";
                      month[9] = "Oct";
                      month[10] = "Nov";
                      month[11] = "Dec"; 
                  var mon ;
                  var day ;
                  var weekday;
                  var weekday = new Array(7);
                      weekday[0] =  "Sun";
                      weekday[1] = "Mon";
                      weekday[2] = "Tue";
                      weekday[3] = "Wed";
                      weekday[4] = "Thu";
                      weekday[5] = "Fri";
                      weekday[6] = "Sat";
                  var hrs ; 
                  var mins;
                  var am_pm;
                  var hrs ; 
                  var rdtime='';
                for( var i = 0; i < data.length; i++ )
                {
                  msgid=data[i].messages.id;
                  user_id=data[i].messages.user_id;
                  username=data[i].users.username;
                  receiver_id=data[i].messages.receiver;   
                  messages=data[i].messages.messages;
                  intromsg=data[i].messages.intromsg;
                  offer_flag=data[i].messages.offer_flag;
                  read_status='';
                  chat_status=data[i].users.chat_status;
                  chat_status_buyer=0;
                  read_stat= data[i].messages.status;
                 // <?// date_default_timezone_set('Asia/Kolkata');?>
                 if(data[i].messages.read_time!=undefined){
                    rd= new Date(data[i].messages.read_time);
                    rdyear = rd.getFullYear();
                    rdmon = rdmonth[rd.getMonth()];
                    rdday = rd.getDate();
                    rdweekday = rdweekday[rd.getDay()];
                    rdhrs = rd.getHours() ; 
                    rdmins = rd.getMinutes() ;
                    rdam_pm = (rdhrs >= 12) ? ('' +'PM') : ('' +'AM');
                    rdhrs = (rdhrs > 12) ? (rdhrs-12) : (rdhrs);  
                    if(rdmins > 60) { 
                            rdmins= +rdmins - 60;
                            rdhrs= +rdhrs + 1;
                    }else{
                           if(rdmins < 10){
                                rdmins = "0" + mins;
                             }
                             else{
                              rdmins=rdmins;
                            }
                    }
                  rdtime = rdhrs+ ":" +rdmins+ " " +rdam_pm+ ", "+rdday+" "+rdmon+" "+rdyear+", "+rdweekday;
                }
                if(data[i].messages.time!=undefined){
                    d = new Date(data[i].messages.time);
                    year = d.getFullYear();
                    mon = month[d.getMonth()];
                    day = d.getDate();
                    weekday = weekday[d.getDay()];
                    hrs = d.getHours() ; 
                    mins = d.getMinutes() ;
                    am_pm = (hrs > 12) ? ('' +'PM') : ('' +'AM');
                    hrs = (hrs > 12) ? (hrs-12) : (hrs); 
                    if(mins > 60) { 
                                    mins= +mins - 60;
                                    hrs= +hrs + 1;
                    }else{
                                   if(mins < 10)
                                     {
                                        mins = "0" + mins;
                                     }
                                     else{
                                      mins=mins;
                                     }
                    }
                    time = hrs+ ":" +mins+ " " +am_pm+ ", "+day+" "+mon+" "+year+", "+weekday;
                  }
                  if(guest_flag ==0){
                      company_name=toTitleCase(data[i].users.company_name);
                  }
                  else{
                      company_name=data[i].users.company_name;
                  }
                  if(guest_flag ==1){
                     chat_status_buyer=data[i].genie_guests.chat_status_buyer;
                  }
                  if(intromsg==2){
                        if((sel_cat_id==80)||(sel_cat_id==88)||(sel_cat_id==109)){
                              if(quantity!=undefined){
                                    quant='<span class="_qntp"><span class="_qnth1"><strong>GROUP SIZE: </strong>'+
                                   quantity; 
                               }  
                               bud='<br/><strong>BUDGET (per Head): </strong>Rs. '+budget+'</span></span>';
                               if(genie_url!=''){
                                      if(genie_url!='undefined'){
                                          bud +='<br/><strong>TOTAL BUDGET: </strong>Rs. '+total_budget+
                                          '</span></span>';
                                      }
                              }
                        }else{
                                  quant='<span class="_qntp"><span class="_qnth1"><strong>QUANTITY: </strong>'+
                                  quantity;
                                  bud='<br/><strong>BUDGET: </strong>Rs. '+budget+'</span></span>';
                        }
                  }
                  else{
                         quant='';
                         bud='';
                  }
                  if(company_name !='') {
                                if(user_id == quoted_user){
                                  if(guest_flag==1){
                                                               username="Customer ";
                                  }else{
                                  username="Customer ("+buyer_gender+". "+buyername+ ")";
                                    }
                                }else{
                                    username=company_name;
                                    company_name=company_name.replace(" ","-");
                                }
                         target="_blank";
                         seller_url="http://www.xerve.in/companies/it-and-software/"+company_name+"/XRV"+user_id+"/list";
                         username_style="";
                  }
                  else{
                          target="_self";
                          seller_url="#";
                          username_style="cursor:none;text-decoration:none!important";
                  }
                  if(user_id == userid){
                          username="ME";
                          view_contact='';
                          mbchat='';
                          img_chat_style="float:left";
                          img_circle_style="float:right";
                            if(read_stat=='unread'){
                                    read_status="<i>UnRead by Customer</i>";
                            }else{
                                    read_status="<i class='glyphicon glyphicon-ok'></i> Read by Customer";
                            }
                  }else{
                            read_status='';       
                               if((leads_down ==1)||(leads_down==2)){
                                   view_contact='View Customer Number';
                                   mbchat="mbchat";
                                   icon="<span class='glyphicon glyphicon-earphone xwhite'></span> ";
                                } 
                            img_chat_style="float:right";
                            img_circle_style="float:left";
                  }
                  if(user_id == quoted_user){
                    lclass="client";  
                    src="/img/avatars/buyer.png";
                        if(guest_flag ==0){
                              if((leads_down == 1)||(leads_down == 2)){
                                      if(seller_prio <= 5){ 
                                  username="<div onclick='javascript:chat_display_modal_after_pay()' style='cursor:pointer'>Customer ("+buyername+")</div>";
                                      }else{
                                            username="CUSTOMER ("+buyername+")";
                                      }
                              }else{
                                            username="CUSTOMER ("+buyername+")";
                              }
                        }
                        else{

                               if((full_name=='')||(full_name==undefined)){
                                        full_buyer="CUSTOMER";
                                }else{
                                        full_buyer=full_name;
                               }
                                              
                        }
                                if(user_id == userid){
                                  username="ME";
                                }
                                  location=buyer_loc; 
                  }/*quoted user/buyer*/  
                  else{
                        location=seller_loc; 
                        lclass="server"; 
                        src="/img/avatars/seller.png";
                        chat_status=data[i].users.chat_status;
                  }
                  if(chat_status =='online'){
                     status_src="/img/chat_online.png";
                     status_on="<i>online</i>";
                  }else{
                      status_src="/img/chat_offline.png";
                      status_on="offline";
                  }
                /*changing the textarea color based on paid/unpaid*/
                  if ((leads_down ==1)||(leads_down==2)) {

                      $('.chat_button .btn').css({ 'background': '#00b050' });
                      $('.message-entry input[type="textarea"]').css({ 'border': '1px solid #00b050' });

                  }else{
                      $('.chat_button .btn').css({ 'background': '#0c93f3' });
                      $('.message-entry input[type="textarea"]').css({ 'border':'1px solid #0c93f3' });
                  }
                              /*eof changing the textarea color based on paid/unpaid*/
              result='<li class='+lclass+' id='+msgid+'>'+
              '<a target='+target+' href='+seller_url+' class="time img_chat" title=""  style='+img_chat_style+
              '><img class="img-circle" src='+src+'  alt="Profile" style='+img_circle_style+'></a>'+
              '<div class="sdcht pull-right">'+
              '<span style="padding-left:10px"><img src=' +status_src+' alt='+chat_status+'> '+status_on+ '</span>'+
              '<span class="time label label-success" id='+msgid+'>'+time+'</span>'+
              '</div>'+
              '<div class="message-area">'+
              '<span class=""></span>'+
              '<div class="info-row">'+
              '<span class="user-name" ><a style='+username_style+'><strong style="text-transform:none">'+username +
              '</strong></a> </span>'+'<span class="seller_loc" >'+location+'</span><br/><br/>';
              if(view_contact!=''){
                  if((leads_down ==1)||(leads_down==2)){
                      if(seller_prio <=5){
                      result +='<span class='+mbchat+'>'+icon+'<a href=tel:'+view_buyer_contact+
                      'class="track_seller" onclick='+test+'>'+view_buyer_contact+'</span>'+'<div class="clear"></div>'+'</div>';
                    }
                  }else{
                    if(seller_prio <=5){
                    result +='<span class="mbchat">'+icon+'<a class="track_seller" onclick='+test+'>View Customer Number</a></span>';
                     '<div class="clear"></div>'+
                    '</div>';
                  }
                }
              }
          if(offer_flag==1){
                result += '<span style="color:#0393f3">My Offer -</span> '+messages+'<br/>';                                    
          }else{    
                result += messages+'<br/>';
          }
          if(quant!=''){
                result += quant; 
          }
          if(bud!=''){

                result +=bud;
          }
        result +='<span style="float:right" class="readmsg">'+read_status+'</span>'+
        '</div>';
        myarray.push(result);
          }//for loop of all messages for this quotes b/w 2 users
            $('ul.sdchatmsg').empty();
            $('ul.sdchatmsg').html(myarray);
            scrollHeight=0;
            $("ul.sdchatmsg").animate({ scrollTop: $("ul.sdchatmsg")[0].scrollHeight}, 0);
            $('.loading_chat_image').hide();
            $('#loading_chat_image').hide();
            $("#loading_chat_green_image").hide();
            $(".type-a-message-box").show();
            $('.chat_button').show();
          } 
        }); 
    }
/*reload for loggedin user insertion*/
/*contact client + credit deduction  process*/
    function reload(){
          var isSafari = !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/);
          var quoteid=$("#quoteid").val();
          var sel_cat_id=$("#sel_cat_id").val();
          var genie_url=$("#genie_url").val();
          var quoted_user=$("#quoted_user").val();
          var userid=$("#userid").val();
          var serverid=$("#server_id").val();
          var productspec=$("#product_spec").val();
          productspec=nl2br(productspec);
          var guest_flag=$("#guest_flag").val();
          var guest_user_id=$("#guest_user_id").val();
          var disable=$("#disabled").val();
          var quantity=$("#quantity").val();
          var budget=$("#budget").val();
          var view_seller_contact=$("#view_seller_contact").val();
          var view_buyer_contact=$("#view_buyer_contact").val();
          var view_buyer_contact_mask=$("#view_buyer_contact_mask").val();
          var seller_loc=$("#seller_loc").val();
          var buyer_loc=$("#buyer_loc").val();
          var total_budget=parseInt(quantity) * parseInt(budget); 
          var seller_prio= get_seller_contact_prio_ajax();
          var full_name=$("#full_name").val();
          var enquiry_time=$("#enquiry_time").val();
          enquiry_time=time_format(enquiry_time);
          var leads_down=$("#leads_down").val();
          var buyer_gender=$("#buyer_gender").val();
          var buyername=$("#buyername").val();
          var dataString = 'quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid+'&guest_flag='+guest_flag+'&guest_user_id='+guest_user_id;
          var chat_status='';
          var chat_status_buyer='';
          var sid=$("#sid_id").val();
          /*var rd='';
          var rdyear = '';
          var rdmonth = new Array();
              rdmonth[0] = "Jan";
              rdmonth[1] = "Feb";
              rdmonth[2] = "Mar";
              rdmonth[3] = "Apr";
              rdmonth[4] = "May";
              rdmonth[5] = "Jun";
              rdmonth[6] = "Jul";
              rdmonth[7] = "Aug";
              rdmonth[8] = "Sep";
              rdmonth[9] = "Oct";
              rdmonth[10] = "Nov";
              rdmonth[11] = "Dec";
          var rdmon = '';
          var rdday = '';
          var rdweekday = new Array(7);
              rdweekday[0] = "Sun";
              rdweekday[1] = "Mon";
              rdweekday[2] = "Tue";
              rdweekday[3] = "Wed";
              rdweekday[4] = "Thu";
              rdweekday[5] = "Fri";
              rdweekday[6] = "Sat";
          var rdtime = '';
          var rdhrs = ''; 
          var rdmins = '';
          var rdam_pm = '';  
          */  
     
  
       
          
    
          var test;
                         if((leads_down==0)||(leads_down==3)){
                           test='chat_flip_info_main_test()';
                         }
                         else{
                           test='chat_display_modal_after_pay()';
                         }
           $.ajax({
              dataType: "json",
              type: "POST",
              url: '/leads/ajaxupdate',
              data: dataString,
              cache: false,
              async: true, 
             // console.log(data);
              success: function(data){ 
              var json_data = JSON.stringify(data);
              console.log(json_data);
              var myarray = new Array();
              var msgtime= Date();
              var status_src="";
              var status_on="";
              var quant='';
              var bud='';
              var read_status='';
              var view_contact='';
              var mbchat='';
              var icon='';
              var chat_status='';
              var img_chat_style="";
              var img_circle_style="";
              var seller_url="";
              var target="";
              var username_style="";
              var lclass="";  
              var src="";
              var location='';
              var msgid='';
              var intromsg;
              var user_id;
              var username;
              var company_name='';
              var receiver_id;
              var messages;
              var offer_flag;
              var read_stat;
              var result;
              var full_buyer;
              var weekday = new Array();
                weekday[0] = "Sun";
                weekday[1] = "Mon";
                weekday[2] = "Tue";
                weekday[3] = "Wed";
                weekday[4] = "Thu";
                weekday[5] = "Fri";
                weekday[6] = "Sat";
               // console.log('wd'+weekday);
                  var month = new Array();
                    month[0] = "Jan";
                    month[1] = "Feb";
                    month[2] = "Mar";
                    month[3] = "Apr";
                    month[4] = "May";
                    month[5] = "Jun";
                    month[6] = "Jul";
                    month[7] = "Aug";
                    month[8] = "Sep";
                    month[9] = "Oct";
                    month[10] = "Nov";
                    month[11] = "Dec";
            if(data.length >0){
              for( var i = 0; i < data.length; i++ )
              {
                 msgid=data[i].messages.id;
                 intromsg=data[i].messages.intromsg;
                 user_id=data[i].messages.user_id;//sender
                 username=data[i].users.username;
                 company_name='';
                 receiver_id=data[i].messages.receiver;   //logged in user
                 messages=nl2br(data[i].messages.messages);
                 offer_flag=data[i].messages.offer_flag;
                 read_stat= data[i].messages.status;
                //<?php date_default_timezone_set('Asia/Kolkata');?>
             /*if(data[i].messages.read_time!=undefined){
                rd= new Date(data[i].messages.read_time);
                rdyear = rd.getFullYear();//year
                rdmon = rdmonth[rd.getMonth()];
                rdday = rd.getDate();
                rdweekday = rdweekday[rd.getDay()];
                rdhrs = rd.getHours() ; 
                rdmins = rd.getMinutes() ;
                rdam_pm = (rdhrs >= 12) ? ('' +'PM') : ('' +'AM');//am or pm
                rdhrs = (rdhrs > 12) ? (rdhrs-12) : (rdhrs);
                    if(rdmins > 60) { 
                              rdmins= +rdmins - 60;
                              rdhrs= +rdhrs + 1;
                    }else{
                           if(rdmins < 10)
                             {
                                rdmins = "0" + mins;
                             }
                             else{
                                   rdmins=rdmins;
                            }
                    }
                    rdtime = rdhrs+ ":" +rdmins+ " " +rdam_pm+ ", "+rdday+" "+rdmon+" "+rdyear+", "+rdweekday;
              }*/
               //console.log(data[i].messages.time);
               //console.log(month);
               //console.log('wd'+weekday);
              // console.log(isSafari);
              if(data[i].messages.time!=undefined){
                if(isSafari==1){
                        var d = new Date(data[i].messages.time);
                }
                else{
                        var d = new Date(data[i].messages.time.replace(' ', 'T'));
                }
               // console.log(d);
                var year = d.getFullYear();
                mon = month[d.getMonth()];
                var day = d.getDate();
                //console.log('day'+day);
                console.log('o'+d.getDay());
                weekday = weekday[d.getDay()];
                //console.log(weekday);
                var hrs = d.getHours() ; 
                var mins = d.getMinutes() ;
                var am_pm = (hrs >= 12) ? ('' +'PM') : ('' +'AM');
                hrs = (hrs > 12) ? (hrs-12) : (hrs);
                    if(mins > 60) { 
                              mins= +mins - 60;
                              hrs= +hrs + 1;
                    }else{
                         if(mins < 10)
                           {
                              mins = "0" + mins;
                           }
                           else{
                            mins=mins;
                          }
                    }
                    if(isSafari==1){
                         var time = '';
                    }else{            
                         var time = hrs+ ":" +mins+ " " +am_pm+ ", "+day+" "+mon+" "+year+", "+weekday;
                    }
              }
                  if(intromsg==2){
                        if((sel_cat_id==80)||(sel_cat_id==88)||(sel_cat_id==109)){
                              if(quantity!=undefined){
                                quant='<span class="_qntp"><span class="_qnth1"><strong>Group Size: </strong>'+quantity; 
                              }   
                        }else{
                             quant='<span class="_qntp"><span class="_qnth1"><strong>Quantity: </strong>'+quantity; 
                        }
                      if((sel_cat_id==80)||(sel_cat_id==88)||(sel_cat_id==109)){
                           bud='<br/><strong>Budget (per Head): </strong>Rs. '+budget+'</span></span>';

                      if(genie_url!=''){
                            if(genie_url!='undefined'){
                                bud +='<br/><strong>TOTAL BUDGET: </strong>Rs. '+total_budget+'</span></span>';
                            }
                      }
                      }else{
                         bud='<br/><strong>Budget: </strong>Rs. '+budget+'</span></span>';
                     }
                 }
                 else{
                        quant='';
                        bud='';
                 }
                    if(guest_flag==0){
                             company_name=toTitleCase(data[i].users.company_name);
                    }
                    else{
                             company_name=data[i].users.company_name;
                    }
                             chat_status=data[i].users.chat_status;
                    if(guest_flag ==1){
                             chat_status_buyer=data[i].genie_guests.chat_status_buyer;
                    }
                    if(user_id == userid){
                          if(disable==''){
                                  username="ME";
                                  view_contact='';
                                  mbchat='';
                                  icon='';
                          }
                          else{
                              username=company_name;
                          }
                          img_chat_style="float:left";
                          img_circle_style="float:right";
                          seller_url="#";
                          if(read_stat=='unread'){
                                  read_status="<i>UnRead by Customer</i>";
                          }
                          else{
                                  read_status="<i class='glyphicon glyphicon-ok'></i> Read by Customer";
                          }
                    }
                    else{
                              if((leads_down ==1)||(leads_down==2)){
                                  view_contact_no=view_buyer_contact;
                                  view_contact=view_buyer_contact;
                                  mbchat="mbchat";
                                  icon="<span class='glyphicon glyphicon-earphone xwhite' ></span> ";
                               }
                               else{
                                    view_contact='View Customer Number';
                                    icon="<span class='glyphicon glyphicon-earphone xwhite' ></span> ";
                               } 
                              img_chat_style="float:right";
                              img_circle_style="float:left";
                              if(user_id == quoted_user){
                                    if(guest_flag ==0){
                                              if((leads_down == 1)||(leads_down == 2)){
                                                       if(seller_prio <= 5){ 
                                                          username="<div onclick='javascript:chat_display_modal_after_pay()' style='cursor:pointer'>Customer ("+buyername+")</div>";
                                                       }
                                                       else{
                                                          username="CUSTOMER ("+buyername+")";
                                                      }
                                              }
                                              else{
                                                        username="CUSTOMER ("+buyername+")";
                                              }
                                    }
                                    else{
                                          username="CUSTOMER"
                                    }
                                    target="_self";
                                    seller_url="#";
                                    username_style="cursor:none;text-decoration:none!important";
                              }
                              else{
                                     username=company_name;
                                     company_name=company_name.replace(" ","-");
                                     target="_blank";
                                     seller_url="http://www.xerve.in/companies/it-and-software/"+company_name+"/XRV"+user_id+"/list";
                                     username_style="";
                             }
                        }
                        if(user_id == quoted_user){
                              lclass="client";  
                              src="/img/avatars/buyer.png";
                              location=buyer_loc;
                        }
                        else{
                              lclass="server"; 
                              src="/img/avatars/seller.png";
                              location=seller_loc; 
                        }
                        if(chat_status =='online'){
                              status_src="/img/chat_online.png";
                              status_on="<i>online</i>";
                        }else{
                              status_src="/img/chat_offline.png";
                              status_on="offline";
                        }
                        if ((leads_down ==1)||(leads_down==2)) {
                                $('.chat_button .btn').css({ 'background': '#00b050' });
                                $('.message-entry input[type="textarea"]').css({ 'border': '1px solid #00b050' });
                        } else {
                                $('.chat_button .btn').css({ 'background': '#0c93f3' });
                                $('.message-entry input[type="textarea"]').css({ 'border':'1px solid #0c93f3' });
                        }

                         result = '<li class='+lclass+' id='+msgid+'>'+
                        '<a class="time img_chat" title=""  style='+img_chat_style+'><img class="img-circle" src='+src+'  alt="Profile" style='+img_circle_style+'></a>'+
                        '<div class="sdcht pull-right">'+
                        '<span style="padding-left:10px"><img src=' +status_src+' alt='+chat_status+'> '+status_on+ '</span>'+
                        '<span class="time label label-success" id='+msgid+'>'+time+'</span>'+
                        '</div>'+ 
                        '<div class="message-area">'+
                        '<div class="info-row">'+
                        '<span class="user-name" >'+
                        '<a target='+target+' style='+username_style+'><strong style="text-transform:none">'+username +'</strong></a> </span><br>'+
                        '<span class="seller_loc">'+location+'</span><br/>';
                   if(view_contact!=''){
                            if((leads_down ==1)||(leads_down==2)){
                                if(seller_prio <=5){
                                  result +='<span class='+mbchat+' style="margin-bottom: 5px">'+icon+'<a class="track_seller" href=tel:'+view_buyer_contact+'>'+view_buyer_contact+'</span>'+
                                 '<div class="clear"></div>'+
                                 '</div>';
                              }
                            }else{
                              
                                  if(seller_prio <=5){
                                    result +='<span class="mbchat" style="margin-bottom: 5px">'+icon+'<a class="track_seller" onclick='+test+'>View Customer Number</a></span>'+
                                     '<div class="clear"></div>'+
                                    '</div>';
                                }
                          }
                    }
                    if(offer_flag==1){
                          result += '<span style="color:#0393f3">My Offer -</span> '+messages+'<br/>';                                    
                    }
                    else{    
                          result += messages+'<br/>';
                    }
                    if(bud!=''){
                            result +=bud;
                    }
                    if(quant!=''){
                            result += quant; 
                    }
                    result +='<span class="readmsg" style="float:right">'+read_status+'</span>';
                    result +='</div></li>';
                    myarray.push(result);
                  }//for loop of all messages for this quotes b/w 2 users
                }//if there is data
                else{
                      if((sel_cat_id==80)||(sel_cat_id==88)||(sel_cat_id==109)){
                            quant='<span class="_qntp"><span class="_qnth1"><strong>GROUP SIZE: </strong>'+quantity;   
                      }else{
                            quant='<span class="_qntp"><span class="_qnth1"><strong>QUANTITY: </strong>'+quantity;
                      }
                      if((sel_cat_id==80)||(sel_cat_id==88)||(sel_cat_id==109)){
                            bud='<br><strong>BUDGET (Per Person):</strong> Rs. '+budget+'</span></span>';
                            if(genie_url!=''){
                                  if(genie_url!='undefined'){
                                   bud +='<br/><strong>TOTAL BUDGET: </strong>Rs. '+total_budget+'</span></span>';
                                  }
                            }
                      }
                      else{
                          bud='<br><strong>BUDGET:</strong> Rs. '+budget+'</span></span>';
                      }
                      client_status=$("#client_status").val();
                      if(client_status =='online'){
                                          status_src="/img/chat_online.png";
                                          status_on="<i>online</i>";
                         }
                         else{
                                         status_src="/img/chat_offline.png";
                                         status_on="offline";
                         }
                         if(guest_flag == 0){
                                if((leads_down == 1)||(leads_down == 2)){
                                                           if(seller_prio <= 5){ 
                                full_buyer="<div onclick='javascript:chat_display_modal_after_pay();' style='cursor:pointer'>Customer ("+buyername+")</div>";
                                                           }else{
                                                           full_buyer="CUSTOMER ("+buyername+")";
                                                          }
                                                       }else{
                                                        full_buyer="CUSTOMER ("+buyername+")";
                                                       }
                         }
                         else{
                              if((full_name=='')||(full_name==undefined)){
                                  full_buyer="CUSTOMER";
                              }else{
                                  full_buyer=full_name;
                              }
                         }
                          result = '<li class="client" >'+
                           '<a  class="time img_chat" title=""  style="float:left"><img class="img-circle" src="/img/avatars/buyer.png" alt="Profile" style=""></a>'+
                           '<div class="sdcht pull-right">'+
                           '<span class="chat-user-status"><img src=' +status_src+' alt='+status_on+'>'+status_on+'</span>'+
                           '<span class="time label label-success">'+enquiry_time+'</span>'+
                          '</div>'+ 
                          '<div class="message-area"  style="cursor: not-allowed;">'+
                          '<span class=""></span>'+
                          '<div class="info-row">'+
                          '<span class="user-name" style="text-transform:none"><a ><strong><b>'+full_buyer+'</b></strong></a></span></span>'+
                          '<span class="time label label-success" id="1219"><p></p></span>'+
                          '<div class="clear"></div>'+
                          '</div>'+
                          '<p>'+productspec+'</p>'+
                          '<p>'+quant+'</p>'+
                          '<p>'+bud+'</p>'+
                          '</div>'+
                          '<div class="clear"></div>'+
                          '</li>';
                          myarray.push(result);
                  }
                      $('ul.sdchatmsg').html(myarray);
          } 
        });
  }

  function chat_submit(){
      console.log('chat_submit');
      var  timer=$("#timer").val();
      var time_interval=$("#time_interval").val();
      clearInterval(time_interval);
      $("#timer").val(0);
      var message=$(".type-a-message-box").val();
      var productspec=$("#productspec").val();
      var b2c = $("#b2c").val();
      var quoteid=$("#quoteid").val();
      var enquiry_id=$("#enquiry_id").val();
      var userid=$("#userid").val();
      var serverid=$("#server_id").val();
      var quoted_user=$("#quoted_user").val();
      var leads_credits_balance = $("#leads_credits_balance").val();
      leads_credits_balance=parseInt(leads_credits_balance); 
      var min_credit = $("#min_credit").val();
      min_credit=parseInt(min_credit); 
      var leads_down=$("#leads_down").val();
      $("#send_click").val(1);
      var guest_flag=$("#guest_flag").val();
      var cat_id=$("#sel_cat_id").val();
      var guest_user_id=$("#guest_user_id").val();
        if(message == '' || message == ' ' || message == undefined){//no chat messages
                $('#chat_msg_error').show().delay(4000).fadeOut();
                return false;  
        }
        else{
               message=nl2br(message);
               $(".type-a-message-box").val("");
               $(".type-a-message-box").prop('disabled', true);
               var check_seller=$("#sellers_category").val();
               var logged=$("#receiver").val();
               var chat_msg_time=$("#chat_msg_time").val();
               var chat_msg_time_display_show=time_format(chat_msg_time);
               var seller_prio=$("#seller_prio").val();
               var tot_res=$("#tot_res").val();
              if(logged ==''){
                           $("#sellers_login").css("background-color", "red");
                           $("#quoteseller_loginbutton").css("color", "yellow");
                           $("#sellers_login").css("color", "#fff");
                           $("#sellers_login").show();
                          return false;
              }
              if(check_seller == 0){ 
              }
              if(userid != quoted_user){ 
                                                                      var result = '<li class="server" >'+
                 '<a  class="time img_chat" title=""  style="float:right"><img class="img-circle" src="/img/avatars/seller.png" alt="Profile" style=""></a>'+
                 '<div class="sdcht pull-right">'+
                 '<span class="chat-user-status"><img src="/img/chat_online.png" alt="<i>online</i>"><i>online</i></span>'+
                 '<span class="time label label-success" >'+chat_msg_time_display_show+'</span>'+
                 '</div>'+  
                '<div class="message-area"  style="cursor: not-allowed;">'+
                '<span class=""></span>'+
                '<div class="info-row">'+
                '<span class="user-name" style="text-transform:none"><a ><strong><b>ME</b></strong></a></span></span>'+
                '<span class="time label label-success" id="1219"><p></p></span>'+
                '<div class="clear"></div>'+
                '</div>'+
                '<p>'+message+'</p>'+
                '</div>'+
                '<div class="clear"></div>'+
                '</li>';  
                  $('ul.sdchatmsg').append(result);
                  scrollHeight=0;
                  $("ul.sdchatmsg").animate({ scrollTop: $("ul.sdchatmsg")[0].scrollHeight}, 0);
                      if((leads_down == 0)||(leads_down == 3)){
                            if(leads_credits_balance >= min_credit){
                                   $("#pre_contact").show();
                                   $("#post_contact").hide();
                                      chat_flip_info_main_test();
                                      contact_client_pay_test();
                            }
                            else{
                                    return false;
                            }
                      }
                }
                var dataString = 'message='+ message+'&quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid+'&enquiry_id='+enquiry_id+'&b2c='+b2c+'&chat_msg_time='+chat_msg_time+'&guest_user_id='+guest_user_id+'&guest_flag='+guest_flag+'&cat_id='+cat_id+'&productspec='+productspec;
                $.ajax({
                  type: "POST",
                  url: '/leads/ajaxsend',
                  data: dataString,
                  cache: false,
                  async: true, 
                  success: function(data,textStatus,xhr){ 
                   $(".type-a-message-box").prop('disabled', false);
                   $("#after_contact_pay1").hide();
                   $('#before_pay_but').attr('placeholder', 'Type Your Message Here ..');
                    reload_insert();
                    $("#timer").val(1);
                  } 
                });
              return false;
      }
  }
  function c2_package(){
       var agree = $('#agree').is(':checked');
       var c2_credit=$("#c2_credit").val();
       $("#sel_min_credit").val(c2_credit);
       $("#min_credit").val(c2_credit);
       $("#pay_pkg").val(2);
       if(agree==false){
          $('#agree_error').show();
          return false;
       }
       else{
        $('#agree_error').hide();
        $("#sendMessage").trigger('click');
       }
}

function c1_package(){
      var c1_credit=$("#c1_credit").val();
      var agree = $('#agree').is(':checked');
      $("#sel_min_credit").val(c1_credit);
      $("#min_credit").val(c1_credit);
      $("#pay_pkg").val(1);
       if(agree==false){
          $('#agree_error').show();
          return false;
       }
       else{
            $('#agree_error').hide();
            $("#sendMessage").trigger('click');
       }
}
function websitefocus(){
  var website =$("#website_id").val();
  $("#website_id_text").html(website);
  $('#website_id_text').show();
  $("#website_id").hide();
}
function offersfocus(){
  var offer=$("#offers_id").val();
  $("#offers_id_text").html(offer);
  $('#offers_id_text').show();
  $("#offers_id").hide();
}

function change_support(){
 $('.contusfixed').html('<strong class="xwhite"><span class="glyphicon glyphicon-earphone xwhite" style="margin-right: 5px;"> </span>SUPPORT: 7022619911 </strong><br>');
}

function close_contact(){
    $('#after_contact_pay').hide();
    $('#after_contact_head').hide();
    $('#note1').hide();
    $('#note2').hide();
    $('.nit_close').hide();
    $('#chats_pkg_details').hide();
}
function close_after_contact(){
    $('#after_contact_pay').hide();
    $('#after_contact_head').hide();
    $('#note1').hide();
    $('#note2').hide();
    $('.nit_close').hide();
    $('#chats_pkg_details').hide();
}
function chat_flip_info_main_test(){
    var  timer=$("#timer").val(); 
    var  time_interval=$("#time_interval").val();
    clearInterval(time_interval);
    $("#timer").val(0);
    $("#chat_flip_info_terms_test").modal({backdrop: 'static', keyboard: false});
}
function chat_display_modal_after_pay(){
    var  timer=$("#timer").val(); 
    var  time_interval=$("#time_interval").val();
    clearInterval(time_interval);
    $("#timer").val(0);
    $("#chat_display_modal_after").modal({backdrop: 'static', keyboard: false});
}

function close_response(){
     $('#after_contact_pay').hide();
     $('.show_credit_balance').hide();
}

function chat_flip_info_main(){
    var  timer=$("#timer").val(); 
    var  time_interval=$("#time_interval").val();
    clearInterval(time_interval);
    $("#timer").val(0);
    $("#chat_flip_info_terms").modal('show');
}

function check_lead_pay(){
    console.log('check_lead_pay');
    var userid=$("#User_Id").val();
    var min_credit=$("#min_credit").val();
    var status=$("#quote_status").val();
    var buyingdate=$("#expiry_date").val();                       
    var today=$("#today").val();
    var enquiry_id=$("#enquiry_id").val();
    var quoted_user=$("#quoted_user").val();
    var buyer_status=$("#buyers_status").val();
    var guest_flag=$("#guest_flag").val();
    var guest_user_id=$("#guest_user_id").val();
    var buyer_status=$("#buyers_status").val();
    var sub_url;
    var obj;
    var flag;
    var balance;
    var firstname;
    var lastname;
    var seller_status;
    var sid_id;
    $('.chat_button').hide();
    $(".type-a-message-box").hide();
    $("#chats_pkg_details").hide();
    $("#loading_chat_image").show();
    $(".loading_chat_image").show();
    var dataString ='userid='+userid+'&enquiry_id='+enquiry_id;
        $.ajax({
          type: "POST",
          url: '/leads/check_lead_paid',
          data: dataString,
          success: function(data,textStatus,xhr){
             obj=$.parseJSON(data);
             flag=obj.flag;
             balance=obj.balance;
             firstname=obj.first_name;
             lastname=obj.last_name;
             seller_status=obj.seller_status;
             sid_id =obj.sid_id;
                if(seller_status==0){ 
                      if(flag == 'false'){ //not paid
                              if((today >= buyingdate)||(status == 5)){
                                   $("#checkbutton_login").hide();
                                   $("#contact_client_pay_login").hide();
                                   $("#chats_pkg_details").hide();
                                   $("#live_message").hide();
                                       if(status == 5){
                                      }
                              }
                              else{ 
                                    $("#checkbutton_login").hide();
                                    $("#live_message").hide();
                                    $("#contact_client_pay_login").show();
                                    $("#chat_visible").show();
                                    $("#instalogin_credits").show();
                                    $("#instalogin_credits").text('Your Credits Balance: '+balance);
                                    $('input[name=leads_credits_balance]').val(balance);
                                      if(guest_flag == 0){
                                        sub_url = '/leads/'+enquiry_id+'/'+sid_id+'/'+quoted_user;
                                      }else{
                                        sub_url = '/leads/'+enquiry_id+'/'+sid_id+'/'+guest_user_id;
                                      }
                                    window.open(sub_url, '_self');
                              }
                      }//not paid
                      else{ //paid
                                if((today >= buyingdate)||(status == 5)){
                                      $("#viewdetails_login").show();
                                      $("#chats_pkg_details").hide();
                                      $("#chat_visible").hide();
                                                  $("#pause_message").hide();
                                                  $("#live_message").hide();
                                      if(status == 5){
                                      $("#info_status_pause").show();
                                      }
                                      if(guest_flag == 0){
                                         sub_url = '/leads/'+enquiry_id+'/'+sid_id+'/'+quoted_user;
                                      }else{
                                         sub_url = '/leads/'+enquiry_id+'/'+sid_id+'/'+guest_user_id;
                                      }
                                      window.open(sub_url, '_self');
                                  }
                                  else{
                                        $("#loading_chat_image").show();
                                        $(".loading_chat_image").show();
                                        $("#chats_pkg_details").hide();
                                        $("#live_message").hide();
                                        $("#contact_client_pay_login").hide();
                                        $("#chat_visible").hide();
                                           if(guest_flag == 0){
                                              sub_url = '/leads/'+enquiry_id+'/'+sid_id+'/'+quoted_user;
                                            }
                                            else{
                                              sub_url = '/leads/'+enquiry_id+'/'+sid_id+'/'+guest_user_id;
                                            }
                                         window.open(sub_url, '_self');
                                 }
                        }//paid 
                }//seller
                else{//buyer
                        $("#buyer_st_message").hide();
                        $("#loading_chat_image_buyer").show();
                        $("#buyers_login_alert").show();
                        $("#checkbutton_login").hide(); 
                        $("#contact_client_pay_login").hide();
                        $("#chat_visible").hide();
                        $('.type-a-message-box').hide();
                        $('#sendMessage').hide();
                        $('#sellers_login').hide();
                        var sub_url = '/leads/'+enquiry_id;
                        window.open(sub_url, '_self');
                } //buyer 
                         $('#req_chatnow1').hide(); 
          } 
        });
  return false;
}

function get_seller_contact_prio_ajax(){
    var quoteid=$("#quoteid").val();
    var obj='';
    var seller_id=$("#receiver").val();
    var dataString = 'quoteid='+ quoteid+'&seller_id='+seller_id;
          $.ajax({
                  type: "POST",
                  url: '/leads/get_seller_contact_prio_ajax',
                  data: dataString,
                  cache: false,
                  async: false, //blocks window close
                    success: function(data,textStatus,xhr){ 
                       obj=$.parseJSON(data);
                    } 
          });
    return obj;
}
function mark_read(){
          var quoteid=$("#quoteid").val();
          var userid=$("#userid").val();
          var enquiry_id=$("#enquiry_id").val();
          var serverid=$("#server_id").val();
          var sid_id=$("#sid_id").val();
          var first_msg_status=$("#first_msg_status").val();
          var buyer_mobile=$("#view_buyer_contact").val();
          var vendor_name=$("#sid_vendorname").val();
          var productspec=$("#productspec").val();
          if (quoteid) {
                var dataString = 'quoteid='+quoteid+'&userid='+userid+'&enquiry_id='+enquiry_id+'&serverid='+serverid+'&first_unread='+first_msg_status+'&sid_id='+sid_id+'&buyer_mobile='+buyer_mobile+'&vendor_name='+encodeURIComponent(vendor_name)+'&productspec='+encodeURIComponent(productspec);
                  $.ajax({
                    type: "POST",
                    url: '/leads/mark_read',
                    data: dataString,
                    cache: false,
                    async: false, //blocks window close
                      success: function(data,textStatus,xhr){ 
                      } 
                  });
         }
}
function nl2br (str, is_xhtml) {   
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}
function toTitleCase(str) {
    return str.replace(/(?:^|\s)\w/g, function(match) {
        return match.toUpperCase();
    });
}
function getpropertime(str) {
    return str.replace(/(?:^|\s)\w/g, function(match) {
        return match.toUpperCase();
    });
}
function time_format(time){
    //  <?php date_default_timezone_set('Asia/Kolkata');?>
                var rd= new Date(time);
                var rdyear = rd.getFullYear();//year
                var rdmonth = new Array();
                    rdmonth[0] = "Jan";
                    rdmonth[1] = "Feb";
                    rdmonth[2] = "Mar";
                    rdmonth[3] = "Apr";
                    rdmonth[4] = "May";
                    rdmonth[5] = "Jun";
                    rdmonth[6] = "Jul";
                    rdmonth[7] = "Aug";
                    rdmonth[8] = "Sep";
                    rdmonth[9] = "Oct";
                    rdmonth[10] = "Nov";
                    rdmonth[11] = "Dec";
                var rdmon = rdmonth[rd.getMonth()];
                var rdday = rd.getDate();
                var rdweekday = new Array(7);
                    rdweekday[0] =  "Sun";
                    rdweekday[1] = "Mon";
                    rdweekday[2] = "Tue";
                    rdweekday[3] = "Wed";
                    rdweekday[4] = "Thu";
                    rdweekday[5] = "Fri";
                    rdweekday[6] = "Sat";
                var rdweekday = rdweekday[rd.getDay()];
                var rdhrs = rd.getHours() ; 
                var rdmins = rd.getMinutes() ;
                var rdam_pm = (rdhrs >= 12) ? ('' +'PM') : ('' +'AM');//am or pm
                var rdhrs = (rdhrs > 12) ? (rdhrs-12) : (rdhrs);
                    if(rdmins > 60) { 
                            rdmins= +rdmins - 60;
                            rdhrs= +rdhrs + 1;
                    }
                    else{
                           if(rdmins < 10)
                             {
                                rdmins = "0" + rdmins;
                             }
                             else{
                                  rdmins=rdmins;
                             }
                    }
                var rdtime = rdhrs+ ":" +rdmins+ " " +rdam_pm+ ", "+rdday+" "+rdmon+" "+rdyear+", "+rdweekday;
                return rdtime;
}
function contact_client_pay(){
      console.log('contact_client_pay');
      var check_seller=$("#sellers_category").val();
      var userid=$("#receiver").val();
      var b2c =$("#b2c").val();
      var quoteid=$("#quoteid").val();
      var enquiry_id=$("#enquiry_id").val();
      var serverid=$("#serverid").val();
      var sid_id=$("#sid_id").val();
      var productspec=$("#productspec").val();
      var tot_res=$("#tot_res").val();
      var min_credit=$("#min_credit").val();
      var guest_flag=$("#guest_flag").val();
      var guest_user_id=$("#guest_user_id").val();
      var pay_pkg =$("#pay_pkg").val();
      $('.loading_chat_image').show();
      $('.chat_button').hide();
      $(".type-a-message-box").hide();
        var dataString = 'type='+ b2c+'&quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid+'&enquiry_id='+enquiry_id+'&productspec='+productspec+'&tot_res='+tot_res+'&min_credit='+min_credit+'&guest_flag='+guest_flag+'&guest_user_id='+guest_user_id+'&pay_pkg='+pay_pkg;
      $.ajax({
              type: "POST",
              url: '/leads/contact_client',
              data: dataString,
              cache: false,
                success: function(data,textStatus,xhr){ 
                                $("#before_contact_no_pay").hide();
                                $("#before_contact_no_pay_msg").hide();
                                $(".hide_before_pay").hide();
                                $('#after_contact_pay').show().delay(5000).fadeOut();
                                $("#contact_client_pay").hide();
                                $('#checkbutton_next').css('display', 'inline-block');
                                $("#buynow_pkg").hide();
                                $("#buynow_pkg_ajax").show();
                                $('#1a').removeClass("active"); 
                                $('#req_class').removeClass("active");
                                $('#2a').addClass("active");
                                $('#chat_class').addClass("active");
                                $('#before_pay').hide();
                                $('#after_pay').show();
                                $('#leads_down').val(2);
                                $('#req_chatnow1').hide();
                                $('.nit_close').show();
                                $('.message-entry-for-bg-chng').css("background-color","#fff");
                } 
      });
}
function chat_focus(){
   var seller_prio=$("#seller_prio").val();
   if(seller_prio<=5){
           chat_flip_info_main();
   }
   else{
          $('.type-a-message-box').focus();
   }
}
function payment_page(){
      var pack=$("#select-pricing").val();
      var check_pay_type=$("#check_pay_type").val();
      var min_credit=$("#min_credit").val();
      var sub_url = '';
      var sid=$("#sid_id").val();
      if(sid!=0){  
                 if(pack==1){        
                            if(check_pay_type==2){
                                  sub_url = '/pricing/lite/'+sid+'/card';
                            }
                            else if(check_pay_type==3){
                                  sub_url = '/pricing/lite/'+sid+'/net';
                            }
                            else{
                                  sub_url = '/pricing/lite/'+sid+'/paytm';
                            }
                  }
                  if(pack==2){
                           if(check_pay_type==2){
                                sub_url = '/pricing/mini/'+sid+'/card/'+min_credit;
                            }
                            else if(check_pay_type==3){
                                sub_url = '/pricing/mini/'+sid+'/net/'+min_credit;
                            }
                            else{
                                sub_url = '/pricing/mini/'+sid+'/paytm/'+min_credit;
                            }
                  }    
                        var win=window.open(sub_url, '_blank');
                }   
                else{
                        return false;
        }
      return false; 
  }  

function show_number(){
        console.log('show_number');
        $("#timer").val(1);  
        var sid_vendorname=$("#sid_vendorname").val();  
        var message='Hi, '+sid_vendorname+' here. We would like to help you!';
        var leads_credits_balance = $("#leads_credits_balance").val();
         leads_credits_balance=parseInt(leads_credits_balance); 
         var min_credit = $("#min_credit").val();
         min_credit=parseInt(min_credit); 
         var post_balance=leads_credits_balance - min_credit;
         var leads_down=$("#leads_down").val();
         var userid=$("#userid").val();
         var serverid=$("#server_id").val();
         var quoted_user=$("#quoted_user").val();
         var check_seller=$("#sellers_category").val();
         var b2c =$("#b2c").val();
         var quoteid=$("#quoteid").val();
         var enquiry_id=$("#enquiry_id").val();
         var sid_id=$("#sid_id").val();
         var productspec=$("#productspec").val();
         var tot_res=$("#tot_res").val();
         var guest_flag=$("#guest_flag").val();
         var guest_user_id=$("#guest_user_id").val();
         var view_buyer_contact=$("#view_buyer_contact").val();
         var send_click=$("#send_click").val();
         var login_form=$("#loginvendor").val();
         var chat_msg_time=$("#chat_msg_time").val();
         var chat_msg_time_display_show=time_format(chat_msg_time);
         var cat_id=$("#sel_cat_id").val();

         $('#post_require').hide();
         $('#post_quantity').hide();
         $('#post_budget').hide();
         $('#post_total_budget').hide();
         $('#req_block').hide();

         var dataString = 'type='+ b2c+'&quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid+
         '&enquiry_id='+enquiry_id+'&productspec='+productspec+'&tot_res='+tot_res+'&min_credit='+min_credit+
         '&guest_flag='+guest_flag+'&guest_user_id='+guest_user_id+'&cat_id='+cat_id;

         var data_String = 'message='+ encodeURIComponent(message)+'&quoteid='+quoteid+'&userid='+userid+
         '&serverid='+serverid+'&enquiry_id='+enquiry_id+'&b2c='+b2c+'&chat_msg_time='+chat_msg_time+
         '&guest_user_id='+guest_user_id+'&guest_flag='+guest_flag+'&cat_id='+cat_id;
          if(userid != quoted_user){ 
            if(leads_credits_balance >= min_credit){
                  if((leads_down == 0)||(leads_down == 3)){
                        $('#loading_chat_green_image').show();
                        $('.chat_button').hide();
                        $(".type-a-message-box").hide();
                        $("#pre_number").hide();
                        $("#post_number").show();
                        $("#show_number").hide();
                        $("#credit_ded_msg").hide();
                        $('#offer_block').show();  
                              $.ajax({
                                      type: "POST",
                                      url: '/leads/contact_client',
                                      data: dataString,
                                      cache: false,
                                      success: function(data,textStatus,xhr){ 
                                            $('#loading_chat_green_image').hide();
                                            $("#req_block").hide();
                                            $("#offer_block").show();
                                            $(".after_balance").text(post_balance);
                                            $("#pre_contact").hide();
                                            $("#post_contact").show();
                                            $('#leads_down').val(2);
                                            $("#pre_credits").hide();
                                            $("#post_credits_li").show();
                                            $("#post_credits").show();
                                            $("#post_credits_text").show();
                                            $("#show_submit").show();
                                            $("#credits_deducted").hide();
                                            $("#postpay_pref").show();
                                            $("#brand_prof").show();
                                            $("#today_off").show();
                                            $("#first-tab-details").show();
                        if(message != '') {
                                $.ajax({
                                  type: "POST",
                                  url: '/leads/ajaxsend',
                                  data: data_String,
                                  success: function(data,textStatus,xhr){ 
                                  $('.chat_button').show();
                                      $(".type-a-message-box").show();
                                                          $("#chats_pkg_details").hide();
                                                          $("#before_pay_head").hide();
                                                          $("#after_contact_pay1").hide();
                                                          $("#before_pay_but").val('');
                                                          $('.modal-backdrop').css("opacity","0");
                                                       $('#before_pay_but').attr('placeholder', 'Type Your Message Here ..');
                                  } 
                                });
                          } 
                          reload();
                    } 
                    });
                  }
                  else{
                        if(send_click==1){
                          $("#pre_contact").hide();
                          $("#post_contact").show();
                        }
                  }
            }
            else{//low balance
                    $("#credit_ded_msg").hide();
                    $("#paystrp_now").css("display","block");
                    $("#paystrp_now").show();
                    $("#show_number").hide();
           }
    }
}

function offer_btn_1(){
       console.log('offer_btn_1');
      var seller_id=$("#sellerid").val();
      var enquiry_id=$("#enquiry_id").val();
      var offers=$(".offers_id_1").val();
        if(offers == '' || offers == ' ' || offers == undefined){
              $('#offers_id').css("border-color","ff0000");
              return false;  
        }
      var dataString = 'offers='+offers+'&enquiry_id='+enquiry_id+'&seller_id='+seller_id;
        $.ajax({
          type: "POST",
          url: '/leads/update_offers' ,
          data: dataString,
          cache: false,
          success: function(html) {
            setTimeout(function(){  $("#offer_btn_1").text('Offers Updated'); }, 3000);
           
          } 
        });
} 



