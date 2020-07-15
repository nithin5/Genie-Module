$( document ).ready(function() {
    console.log('onready');
   	var idleState = false;
    var idleTimer = null;
    var enquiry_id=$("#enquiry_id").val();
    var client_status=$("#client_status").val();
    var server_status=$("#server_status").val();
    var quote_status=$("#quote_status").val();
    var buydate=$("#buyingdate").val();
    var expiry_date=$("#expiry_date").val();
    var today=$("#today").val();

    if((quote_status ==5)||(today >= expiry_date)){

    }
  	else{
   	     $("#toggle_require").hide();
   	     var disable=$("#disabled").val();
    }//live enquiries

	$('.sd-chatmaincontainer').on('mousemove click touchstart mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick swipe tap taphold', function () {
		clearTimeout(idleTimer);
	    var i=0;
	    if (idleState === true) { 
            chatlogin();
            $("#timer").val(1);
            var timer=$("#timer").val();
            if(timer==1) {
              var time_interval =setInterval(reload, 10000);
              $("#timer").val(timer);
	     	  $("#time_interval").val(time_interval);
            }
	    }
	    idleState = false;
	    idleTimer = setTimeout(function () { 
	         i=i+1; 
	         chatlogoff(); 
	         $("#timer").val(0);
	         var time_interval =$("#time_interval").val();
	         clearInterval(time_interval);
	         reload(); 
	        idleState = true;
	     }, 60000);
	});
 //    $("body").trigger("mousemove");
 //         var disable=$("#disabled").val();
	// 	   if(disable == ''){
	// 	       mark_read();
	// 	   }
	// });
  
//     $("#checkbuttonquote").click(function(){
//         $("#demo_quote").toggle(700,'linear');

//     });
//     $("#view_require").click(function(){
//         $("#toggle_require").toggle();

//     });

//     $("#quote-show").click(function(){
//         $("#quote-form").toggle();

//     });

// $('#req_chatnow').click(function(){
// 	   if (!$(this).hasClass("active")) {
// 			    // Remove the class from anything that is active
// 			    $("li.active").removeClass("active");
// 			    // And make this active
// 			    $('#chat_class').addClass("active");
// 			    $('#1a').removeClass("active");
// 			    $('#2a').addClass("active");
// 			   // $("#id="req_class"").addClass("active");
// 			    $('#chat_class').addClass('active');
// 	  }
$("#sendMessage, #sendMessage_sub").on('click',function() {
	//console.log('sm')
	var  timer=$("#timer").val();
 	var time_interval=$("#time_interval").val();
    clearInterval(time_interval);
 	$("#timer").val(0);	
	 var b2c = $("#b2c").val();
	 var message=$(".type-a-message-box").val();
	 //console.log('message'+message);
	 message=nl2br(message);
	 var quoteid=$("#quoteid").val();
	 var enquiry_id=$("#enquiry_id").val();
	 //console.log(enquiry_id);
	 var userid=$("#userid").val();
	 var chat_msg_time=$("#chat_msg_time").val();
	 var chat_msg_time_display_show=time_format(chat_msg_time);
	 var guest_flag=$("#guest_flag").val();
	 var guest_user_id=$("#guest_user_id").val();
	 var serverid=$("#server_id").val();
    if(message == ''){
    	//console.log('errorfgfg');
		$('#chat_msg_error').show().delay(5000).fadeOut();
		// alert("Enter Valid Messages");
         return false;		 
	}	


	 $(".type-a-message-box").val("");

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
'<div class="clear"></div>'+
'</div>'+
'<p>'+message+'</p>'+
'</div>'+
'<div class="clear"></div>'+
'</li>';	

$('ul.sdchatmsg').append(result);
scrollHeight=0;
$("ul.sdchatmsg").animate({ scrollTop: $("ul.sdchatmsg")[0].scrollHeight}, 0);	
	//if (quoteid) {
	var dataString = 'message='+ message+'&quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid+'&enquiry_id='+enquiry_id+'&b2c='+b2c+'&chat_msg_time='+chat_msg_time+'&guest_user_id='+guest_user_id+'&guest_flag='+guest_flag;
	console.log(dataString);
	//return false;
	$.ajax({
		type: "POST",
		url: '/leads/ajaxsend',
		data: dataString,
		cache: false,
		async: false, //blocks window close
		success: function(data,textStatus,xhr){ 
			//console.log(data);
			//alert(data);
		 reload_insert();
		} //success
		 
	});//
	//}	//if quote
	//return false;
});
$(".type-a-message-box input-sm").keypress(function(event){
    console.log('enter');
 	var  timer=$("#timer").val();
    var time_interval=$("#time_interval").val();
 	clearInterval(time_interval);
 	$("#timer").val(0);

    var ID = $(this).attr("id");
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
    					var quote_status=$("#quote_status").val();
    					var chat_msg_time=$("#chat_msg_time").val();
    					var chat_msg_time_display_show=time_format(chat_msg_time);
    					var guest_flag=$("#guest_flag").val();
    					var guest_user_id=$("#guest_user_id").val();
    					var disable=$("#disabled").val();
    					if(disable == 'disable'){
					    	return false;
					    }
					    if(quote_status == 5){
					    	return false;
					    }
				         var b2c = $("#b2c").val();
				         var message=$(".type-a-message-box").val();
				         message=nl2br(message);
						 var quoteid=$("#quoteid").val();
						 var userid=$("#userid").val();
						 var enquiry_id=$("#enquiry_id").val();
						var serverid=$("#server_id").val();
						 if(message == '')
								{
								
								     $('#chat_msg_error').show().delay(5000).fadeOut();
								     return false;		 
								}	
						 var result = '<li class="server" >'+
 '<a  class="time img_chat" title=""  style="float:right"><img class="img-circle" src="/img/avatars/buyer.png" alt="Profile" style=""></a>'+
 '<div class="sdcht pull-right">'+
 '<span class="chat-user-status"><img src="/img/chat_online.png" alt="<i>online</i>"><i>online</i></span>'+
 '<span class="time label label-success" >'+chat_msg_time_display_show+'</span>'+
 '</div>'+	
'<div class="message-area"  style="cursor: not-allowed;">'+
'<span class=""></span>'+
'<div class="info-row">'+
'<span class="user-name" style="text-transform:none"><a ><strong><b>ME</b></strong></a></span></span>'+
'<div class="clear"></div>'+
'</div>'+
'<p>'+message+'</p>'+
'</div>'+
'<div class="clear"></div>'+
'</li>';	
   $('ul.sdchatmsg').append(result);
				var dataString = 'message='+ message+'&quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid+'&enquiry_id='+enquiry_id+'&b2c='+b2c+'&chat_msg_time='+chat_msg_time+'&guest_user_id='+guest_user_id+'&guest_flag='+guest_flag;
				$(".type-a-message-box").val("");
				$(".type-a-message-box").prop('disabled', true);	
						$.ajax({
							type: "POST",
							url: 'leads/ajaxsend',
							data: dataString,
							cache: false,
							async: true, //blocks window close
							success: function(data,textStatus,xhr){ 
							$(".type-a-message-box").prop('disabled', false);
							reload_insert();
							} //success
						});//
                  return false;
			//}	//if quote	   
		 }//if key is enter
   		//return false;				
});//key press function
  
 //console.log('end');       
 });

            /* When enter key is pressed*/
            //type-a-message-box input-sm
 


  /*Latest message details*/
function reload()
			{
				var isSafari = !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/);
				var quoteid=$("#quoteid").val();
				var website=$("#website").val();
			    var userid=$("#userid").val();
			    var genie_url=$("#genie_url").val();
			   // var full_name=$("#full_name").val();
			    var sel_cat_id=$("#sel_cat_id").val();
			    var serverid=$("#server_id").val();
			    var productspec=$("#product_spec").val();
                productspec=nl2br(productspec);
			    var quantity=$("#quantity").val();
			    var budget=$("#budget").val();
			    var total_budget=parseInt(quantity) * parseInt(budget); 
			    var seller_name=$("#seller_name").val();
			    var seller_mobile=$("#seller_mobile").val();
			     var seller_loc=$("#seller_loc").val();
			    var buyer_loc=$("#buyer_loc").val();
			    var view_seller_contact=$("#view_seller_contact").val();
			    var view_buyer_contact=$("#view_buyer_contact").val();
			    var leads_down=$("#leads_down").val();
			    var guest_flag=$("#guest_flag").val();
			    var quoted_user=$("#quoted_user").val();
			    var guest_user_id=$("#guest_user_id").val();
			    var dataString = 'quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid+'&guest_flag='+guest_flag+'&guest_user_id='+guest_user_id;
			    var chat_status='';
				$.ajax({
					dataType: "json",
					type: "POST",
					url: '/leads/ajaxupdate',
					data: dataString,
					cache: false,
					async: true, 
					success: function(data){ 
					var json_data = JSON.stringify(data);
					var myarray = new Array();
				    var msgtime= Date();
					for( var i = 0; i < data.length; i++ )
					{
						var msgid=data[i].messages.id;
						var user_id=data[i].messages.user_id;
						var username=data[i].users.username;
						var chat_status=data[i].users.chat_status;
						if(guest_flag ==1){
					    var chat_status_buyer=data[i].genie_guests.chat_status_buyer;
					   }
						if(guest_flag==0){
						var company_name=toTitleCase(data[i].users.company_name);
					    }else{
					    	var company_name=data[i].users.company_name;
					    }
						var receiver_id=data[i].messages.receiver;   //logged in user
						var messages=nl2br(data[i].messages.messages);
						var intromsg=data[i].messages.intromsg;
						var offer_flag=data[i].messages.offer_flag;
						
						if(intromsg==2){
                           if((sel_cat_id==80)||(sel_cat_id==88)){
						   var quant='<span class="_qntp"><span class="_qnth1"><strong>GROUP SIZE: </strong>'+quantity;		
						   var bud='<br/><strong>BUDGET (Per Person): </strong>Rs. '+budget+'</span></span>';
						   if(genie_url!=''){
						   	    if(genie_url!='undefined'){
						         bud +='<br/><strong>TOTAL BUDGET: </strong>Rs. '+total_budget+'</span></span>';
						     }
						   }
							}else{
							var quant='<span class="_qntp"><span class="_qnth1"><strong>QUANTITY: </strong>'+quantity; 
							var bud='<br/><strong>BUDGET: </strong>Rs. '+budget+'</span></span>';
						   }
						
						}
						else{
							var quant='';
							var bud='';
						}
						 var read_status='';
						 var view_contact='';
						 var mbchat='';
					
						var d = new Date(data[i].messages.time);
						var year = d.getFullYear();//year
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
						var mon = month[d.getMonth()];//month
						var day = d.getDate();//day
						var weekday = new Array(7);
						weekday[0] =  "Sun";
						weekday[1] = "Mon";
						weekday[2] = "Tue";
						weekday[3] = "Wed";
						weekday[4] = "Thu";
						weekday[5] = "Fri";
						weekday[6] = "Sat";
                       var weekday = weekday[d.getDay()];//week day
                       var hrs = d.getHours() ; //hrs
					   var mins = d.getMinutes() ;//mins
					   var am_pm = (hrs >= 12) ? ('' +'PM') : ('' +'AM');//am or pm
					   var hrs = (hrs > 12) ? (hrs-12) : (hrs);
					   if(mins > 60) { 
									   	mins= +mins - 60;
									   	hrs= +hrs + 1;
									   }else{
					   						 //mins=mins;
					   						 if(mins < 10)
						   						 {
						   						 		mins = "0" + mins;
						   						 }
						   						 else{mins=mins;}
					   						}
					   var time = hrs+ ":" +mins+ " " +am_pm+ ", "+day+" "+mon+" "+year+", "+weekday;
					   /*read time*/
						      var read_stat= data[i].messages.status;

                             var rd= new Date(data[i].messages.read_time);
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
											var rdmon = rdmonth[rd.getMonth()];//month
											var rdday = rd.getDate();//day
											var rdweekday = new Array(7);
											rdweekday[0] =  "Sun";
											rdweekday[1] = "Mon";
											rdweekday[2] = "Tue";
											rdweekday[3] = "Wed";
											rdweekday[4] = "Thu";
											rdweekday[5] = "Fri";
											rdweekday[6] = "Sat";
					                       var rdweekday = rdweekday[rd.getDay()];//week day
					                       var rdhrs = rd.getHours() ; //hrs
										   var rdmins = rd.getMinutes() ;//mins
										   var rdam_pm = (rdhrs >= 12) ? ('' +'PM') : ('' +'AM');//am or pm
										    var rdhrs = (rdhrs > 12) ? (rdhrs-12) : (rdhrs);
										   if(rdmins > 60) { 
														   	rdmins= +rdmins - 60;
														   	rdhrs= +rdhrs + 1;
														   }else{
										   						 if(rdmins < 10)
											   						 {
											   						 		rdmins = "0" + rdmins;
											   						 }
											   						 else{rdmins=rdmins;}
										   						}
										if(isSafari==1){
											var rdtime ='';
										}else{   						
										   var rdtime = rdhrs+ ":" +rdmins+ " " +rdam_pm+ ", "+rdday+" "+rdmon+" "+rdyear+", "+rdweekday;
										}
						/*read time*/
						if(user_id == userid){
							                if(disable==''){
												username="ME";
											}
											else{
												
												 
												  username="CUSTOMER";
												
											}
											var view_contact='';
												mbchat='';
												var icon='';
                                                var img_chat_style="float:left";
	                                            var img_circle_style="float:right";
										   if(read_stat=='unread'){
                                                              read_status="<i>UnRead by Seller</i>";
										   }else{
                                                    read_status="<i class='glyphicon glyphicon-ok'></i> Read by Seller";
										   }
						}
						else{
												 if((leads_down ==1)||(leads_down==2)){
							                      var view_contact=view_seller_contact;
							                      mbchat="mbchat";
							                      var icon="<span class='glyphicon glyphicon-earphone xwhite'></span> ";
							                  }
           
							var img_chat_style="float:right";
	                        var img_circle_style="float:left";
	                        if(user_id == quoted_user){
								username="CUSTOMER";
								var target="_self";
							    var seller_url="#";
							    var username_style="cursor:none;text-decoration:none!important";
							}else{
								username=company_name+' '+'('+seller_name+')';
								company_name_offer=company_name;
							    company_name=company_name.replace(" ","-");
							    var target="_blank";
							    var seller_url="http://www.xerve.in/companies/it-and-software/"+company_name+"/XRV"+user_id+"/list";
							    var username_style="";
							}
						}
						if(user_id == quoted_user)
							{
							  var lclass="server";
							  var src="/img/avatars/buyer.png";
							  var location=buyer_loc;
							}	
							else{
							 	var lclass="client";
							 var src="/img/avatars/seller.png";
							 var location=seller_loc;
							}
							if(chat_status =='online'){
								var status_src="/img/chat_online.png";
								var status_on="<i class='onlineh2'>online</i>";
							}
							else{
								var status_src="/img/chat_offline.png";
								var status_on="<i class='offlineh1'>offline </i>";;
							}
var result = '<li class='+lclass+' id='+msgid+'>'+
'<a  class="time img_chat" title=""  style='+img_chat_style+'><img class="img-circle" src='+src+'  alt="Profile" style='+img_circle_style+'></a>'+
'<div class="sdcht pull-right">'+
'<span style="padding-left:10px"><img src=' +status_src+' alt='+chat_status+'> '+status_on+ '</span>'+
'<span class="time label label-success" id='+msgid+'>'+time+'</span>'+
'</div>'+	
'<div class="message-area">'+
'<div class="info-row">'+
'<span class="user-name" >'+
'<a  style='+username_style+'><strong style="text-transform:none">'+username +'</strong></a> </span>'+
'<span class="seller_loc" >'+location+'</span><br/>';
		if(view_contact!=''){
							result +='<span class="col-xs-12 padding-0"><span class='+mbchat+'>'+icon+'<a href=tel:'+view_contact+' data-rel="external">'+view_contact+'</a></span></span><p/>'+
							'</div>';

		}
											 
if(offer_flag==1){
result += '<span style="color:#0393f3">'+company_name_offer+' Offer -</span> '+messages+'<br/>';
}else{		
result += messages+'<br/>';
}
		
		if(budget!=''){
						result +=bud;
        }
        if(quantity!=''){
		               result += quant; 
		}
result +='<span class="readmsg" style="float:right">'+read_status+'</span>';
result +='</div></li>';
        myarray.push(result);
					}//for loop of all messages for this quotes b/w 2 users
			$('ul.sdchatmsg').html(myarray);
					} //success
				});//	
}
function time_format(time){
						/*read time*/
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
	var rdmon = rdmonth[rd.getMonth()];//month
	var rdday = rd.getDate();//day
	var rdweekday = new Array(7);
	rdweekday[0] =  "Sun";
	rdweekday[1] = "Mon";
	rdweekday[2] = "Tue";
	rdweekday[3] = "Wed";
	rdweekday[4] = "Thu";
	rdweekday[5] = "Fri";
	rdweekday[6] = "Sat";
   var rdweekday = rdweekday[rd.getDay()];//week day
   var rdhrs = rd.getHours() ; //hrs
   var rdmins = rd.getMinutes() ;//mins
   var rdam_pm = (rdhrs >= 12) ? ('' +'PM') : ('' +'AM');//am or pm
   var rdhrs = (rdhrs > 12) ? (rdhrs-12) : (rdhrs);
	   if(rdmins > 60) { 
					   	rdmins= +rdmins - 60;
					   	rdhrs= +rdhrs + 1;
					   }else{
	   						 if(rdmins < 10)
		   						 {
		   						 		rdmins = "0" + rdmins;
		   						 }
		   						 else{rdmins=rdmins;}
	   						}
	   var rdtime = rdhrs+ ":" +rdmins+ " " +rdam_pm+ ", "+rdday+" "+rdmon+" "+rdyear+", "+rdweekday;
	   return rdtime;
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
/*reload for loggedin user insertion*/
function reload_insert()
			{
	var sel_cat_id=$("#sel_cat_id").val();
	var quoteid=$("#quoteid").val();
	var genie_url=$("#genie_url").val();
    var userid=$("#userid").val();
    var serverid=$("#server_id").val();//receiving user
    var full_name=$("#full_name").val();
    var sel_cat_id=$("#sel_cat_id").val();
    var seller_name=$("#seller_name").val();
    var seller_mobile=$("#seller_mobile").val();
    var guest_flag=$("#guest_flag").val();
    var guest_user_id=$("#guest_user_id").val();
    var view_seller_contact=$("#view_seller_contact").val();
    var view_buyer_contact=$("#view_buyer_contact").val();
    var seller_loc=$("#seller_loc").val();
    var buyer_loc=$("#buyer_loc").val();
    var leads_down=$("#leads_down").val();
    var quantity=$("#quantity").val();
    var budget=$("#budget").val();
    var quoted_user=$("#quoted_user").val();
    var total_budget=parseInt(quantity) * parseInt(budget); 
    var read_status='';
    var view_contact='';
    var mbchat='';
    var chat_status='';
    var dataString = 'quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid+
     '&guest_flag='+guest_flag+'&guest_user_id='+guest_user_id;	
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
	for( var i = 0; i < data.length; i++ )
	{
		var msgid=data[i].messages.id;
		var user_id=data[i].messages.user_id;
		var username=data[i].users.username;
		if(guest_flag ==0){
				var company_name=toTitleCase(data[i].users.company_name);
	    }
		else{
	    	var company_name=data[i].users.company_name;
	    }
	    var chat_status=data[i].users.chat_status;
		if(guest_flag ==1){
	           var chat_status_buyer=data[i].genie_guests.chat_status_buyer;
	   }
		var receiver_id=data[i].messages.receiver;   //logged in user
		var read_stat= data[i].messages.status;
		var messages=data[i].messages.messages;
		var intromsg=data[i].messages.intromsg;
		  if(intromsg==2){
			if((sel_cat_id==80)||(sel_cat_id==88)){
	         var quant='<span class="_qntp"><span class="_qnth1"><strong>GROUP SIZE: </strong>'+quantity;
	         var bud='<br/><strong>BUDGET(Per Person): </strong>Rs. '+budget+'</span></span>';	
	          if(genie_url!=''){
	          	 if(genie_url!='undefined'){
		      bud +='<br/><strong>TOTAL BUDGET: </strong>Rs. '+total_budget+'</span></span>';
		    }
		   }
	      }else{
	        var quant='<span class="_qntp"><span class="_qnth1"><strong>QUANTITY: </strong>'+quantity; 
	        var bud='<br/><strong>BUDGET: </strong>Rs. '+budget+'</span></span>';
	       }
		}
		else{
			var quant='';
			var bud='';
		}
		var d = new Date(data[i].messages.time);
		var year = d.getFullYear();//year
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
		var mon = month[d.getMonth()];//month
		var day = d.getDate();//day
		var weekday = new Array(7);
		weekday[0] =  "Sun";
		weekday[1] = "Mon";
		weekday[2] = "Tue";
		weekday[3] = "Wed";
		weekday[4] = "Thu";
		weekday[5] = "Fri";
		weekday[6] = "Sat";
	   var weekday = weekday[d.getDay()];//week day
	   var hrs = d.getHours() ; //hrs
	   var mins = d.getMinutes() ;//mins
	   var am_pm = (hrs > 12) ? ('' +'PM') : ('' +'AM');//am or pm
	   var hrs = (hrs > 12) ? (hrs-12) : (hrs);
	   if(mins > 60) { 
				   	mins= +mins - 60;
				   	hrs= +hrs + 1;
					   }else{
	   						 //mins=mins;
	   						 if(mins < 10)
		   						 {
		   						 		//mins=sprintf("%02d", mins);
		   						 		mins = "0" + mins;
		   						 }
		   						 else{
		   						 	mins=mins;
		   						 }
	   						}
	   var time = hrs+ ":" +mins+ " " +am_pm+ ", "+day+" "+mon+" "+year+", "+weekday;
	   	/*read time*/
	    var rd= new Date(data[i].messages.read_time);
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
		var rdmon = rdmonth[rd.getMonth()];//month
		var rdday = rd.getDate();//day
		var rdweekday = new Array(7);
			rdweekday[0] =  "Sun";
			rdweekday[1] = "Mon";
			rdweekday[2] = "Tue";
			rdweekday[3] = "Wed";
			rdweekday[4] = "Thu";
			rdweekday[5] = "Fri";
			rdweekday[6] = "Sat";
	    var rdweekday = rdweekday[rd.getDay()];//week day
	    var rdhrs = rd.getHours() ; //hrs
	    var rdmins = rd.getMinutes() ;//mins
	    var rdam_pm = (rdhrs >= 12) ? ('' +'PM') : ('' +'AM');//am or pm
	    var rdhrs = (rdhrs > 12) ? (rdhrs-12) : (rdhrs);
		   if(rdmins > 60) { 
						   	rdmins= +rdmins - 60;
						   	rdhrs= +rdhrs + 1;
						   }else{
		   						 if(rdmins < 10)
			   						 {
			   						 		rdmins = "0" + rdmins;
			   						 }
			   						 else{rdmins=rdmins;}
		   						}
			  var rdtime = rdhrs+ ":" +rdmins+ " " +rdam_pm+ ", "+rdday+" "+rdmon+" "+rdyear+", "+rdweekday;
	    /*read time*/
	    if(company_name !='')	{
				if(user_id == quoted_user){
					username="CUSTOMER";
				}else{
					username=company_name;
					username=company_name+'('+seller_name+')';
				    company_name=company_name.replace(" ","-");
				}
				var target="_blank";
				var seller_url="http://www.xerve.in/companies/it-and-software/"+company_name+"/XRV"+user_id+"/list";
				var username_style="";

	    }
	    else{
					var target="_self";
					var seller_url="#";
					var username_style="cursor:none;text-decoration:none!important";
	    }
		if(user_id == userid){
	            if(disable==''){
					username="ME";
				}
				else{
	                    username="CUSTOMER";
				}
				var view_contact='';
				var mbchat='';
				var icon='';
	            var img_chat_style="float:left";
	            var img_circle_style="float:right";
			    if(read_stat=='unread'){
					read_status="<i>UnRead by Seller</i>";
				}
				else{
					read_status="<i class='glyphicon glyphicon-ok'></i> Read by Seller";
				}
		}
		else{
			        read_status=''; 
					var img_chat_style="float:right";
	                var img_circle_style="float:left";
	                if((leads_down ==1)||(leads_down==2)){
	                                        var view_contact=view_buyer_contact;
	                                        var mbchat="mbchat";
	                                        var icon="<span class='glyphicon glyphicon-earphone xwhite'></span> ";
	               }

		}
		if(user_id == quoted_user)
			{
			  var lclass="server";
			  var src="/img/avatars/buyer.png";
	               
	                   username="CUSTOMER";
	                  
	                        if(user_id == userid){
	                        	username="ME";
	                        }
	             var location=buyer_loc;
			}	
			else{
					 var lclass="client";		
					 var src="/img/avatars/seller.png";
					 chat_status=data[i].users.chat_status;
					 var location=seller_loc;	
					 	
			}
			if(chat_status =='online'){
				var status_src="/img/chat_online.png";
				var status_on="<i class='onlineh2'>online</i>";
			}
			else{
				var status_src="/img/chat_offline.png";
				var status_on="<i class='offlineh1'>offline </i>";;
		    }
var result = '<li class='+lclass+' id='+msgid+'>'+
'<a class="time img_chat" title=""  style='+img_chat_style+'><img class="img-circle" src='+src+'  alt="Profile" style='+img_circle_style+'></a>'+
'<div class="sdcht pull-right">'+
'<span style="padding-left:10px"><img src=' +status_src+' alt='+chat_status+'> '+status_on+ '</span>'+
'<span class="time label label-success" id='+msgid+'>'+time+'</span>'+
'</div>'+	
'<div class="message-area">'+
'<div class="info-row">'+
'<span class="user-name" >'+
'<a  style='+username_style+'><strong style="text-transform:none">'+username +'</strong></a> </span>'+
'<span class="seller_loc" >'+location+'</span><br/>';
		if(view_contact!=''){
					result +='<br/><span class='+mbchat+'>'+icon+'<a href=tel:'+view_contact+' data-rel="external">'+view_contact+'</a><br/></span>'+'<div class="clear"></div>'+'</div>';
		}
	

result += messages+'<br/>';
        if(budget!=''){
						result +=bud;
        }

		if(quantity!=''){
		               result += quant; 
		}
	result +='<span class="readmsg" style="float:right">'+read_status+'</span>';
	result +='</div></li>';
	myarray.push(result);
	}//for loop of all messages for this quotes b/w 2 users
		$('ul.sdchatmsg').empty();
		$('ul.sdchatmsg').html(myarray);
        scrollHeight=0;
            $("ul.sdchatmsg").animate({ scrollTop: $("ul.sdchatmsg")[0].scrollHeight}, 0);
				} //success
		});//	
       
	}

/*reload for loggedin user insertion*/
     //block F5 & Control+F5
    var disable=$("#disabled").val();
function chatlogoff(){

        var quoteid=$("#quoteid").val();
	    var userid=$("#userid").val();
	    var enquiry_id=$("#enquiry_id").val();
	    var serverid=$("#server_id").val();
	    var guest_flag=$("#guest_flag").val();
	    if (quoteid) {
					var dataString = 'quoteid='+quoteid+'&userid='+userid+'&enquiry_id='+enquiry_id+
					'&guest_flag='+guest_flag;
					$.ajax({
						type: "POST",
						url: '/genie/chatlogoff',
						data: dataString,
						cache: false,
						//async: true, //unblocks window close
						success: function(data){ 
						
						} //success
					});
	    }//if quote
}//chatlogoff
function chatlogin(){
	
    var quoteid=$("#quoteid").val();
    var userid=$("#userid").val();//logged in user
    var enquiry_id=$("#enquiry_id").val();//receiver
    var guest_flag=$("#guest_flag").val();
    var serverid=$("#server_id").val();
    if (quoteid) {
				var dataString = 'quoteid='+quoteid+'&userid='+userid+'&enquiry_id='+enquiry_id+
				'&guest_flag='+guest_flag;
					$.ajax({
						type: "POST",
						url: '/genie/chatlogin',
						data: dataString,
						cache: false,
						//async: true, //blocks window close
						success: function(data){ 
							
						   reload();
						} //success
					});
	}//if quote
}//chatlogin	
function close_response(){
     $("#quote_response").hide();
     $("#quote_response1").hide();

} 
function mark_read(){
        var quoteid=$("#quoteid").val();
	    var userid=$("#userid").val();//logged in user //buyer
	    var enquiry_id=$("#enquiry_id").val();
	    var serverid=$("#server_id").val();//receiver //seller
	    var sid_id=$("#sid_id").val();//sid_id //seller
	    var first_msg_status=$("#first_msg_status").val();//receiver //seller
	    var seller_mobile=$("#seller_mobile").val();
	    var customer_name=$("#customer_name").val();
	    var productspec=$("#productspec").val();
	    if (quoteid) {
			var dataString = 'quoteid='+quoteid+'&userid='+userid+'&enquiry_id='
			+enquiry_id+'&serverid='+serverid+'&first_unread='+first_msg_status+
			'&sid_id='+sid_id+'&seller_mobile='+seller_mobile+
			'&productspec='+encodeURIComponent(productspec)+'&customer_name='+customer_name;
				$.ajax({
					type: "POST",
					url: '/genie/mark_read',
					data: dataString,
					cache: false,
					async: true, //blocks window close
					success: function(data,textStatus,xhr){ 
						var obj=$.parseJSON(data);
						$("#first_msg_status").val(obj);
					} //success
				});
	    }//if quote
}

$(window).scroll(function () {
if ($(this).scrollTop() > 10) {
	$(".contusfixed").css("display", "none");
} else {
    $(".contusfixed").css("display", "block");
}
});
// $(".visit_website").on('click tap',function(e){
// 	var website=$('#website').val();
// 	if(website=='nil'){
// 		return false;
// 	}

// 	var sub_url = 'http://'+website;
//     window.open(sub_url, '_blank');	
    // $('#1a').removeClass("active"); //enquiry
    // $('#req_class').removeClass("active");
    // $('#2a').addClass("active");//chat
    // $('#chat_class').addClass("active");//chat
//});
$("#checkbutton").on('click',function(e){
	var check_seller=$("#sellers_category").val();
	if(check_seller == 0){
		 $("#category_block_reason").show();
		 return;
	}
    $('#1a').removeClass("active"); //enquiry
    $('#req_class').removeClass("active");
    $('#2a').addClass("active");//chat
    $('#chat_class').addClass("active");//chat
});
$("#checkbuttonsid").on('click',function(e){
	var check_seller=$("#sellers_category").val();
	 
	if(check_seller == 0){
		 $("#category_block_reason").show();
		 return;
	}
    $('#1a').removeClass("active"); //enquiry
    $('#req_class').removeClass("active");
    $('#2a').addClass("active");//chat
    $('#chat_class').addClass("active");//chat
});
$("#checkbutton_next").on('click',function(e){
    $('#1a').removeClass("active"); //enquiry
    $('#req_class').removeClass("active");
    $('#2a').addClass("active");//chat
    $('#chat_class').addClass("active");//chat
});
$("#checkbutton_login").on('click',function(e){
    $('#1a').removeClass("active"); //enquiry
    $('#req_class').removeClass("active");
    $('#2a').addClass("active");//chat
    $('#chat_class').addClass("active");//chat
});
$("#viewdetails_login").on('click',function(e){
    $('#1a').removeClass("active"); //enquiry
    $('#req_class').removeClass("active");
    $('#2a').addClass("active");//chat
    $('#chat_class').addClass("active");//chat
});
$("#viewdetails_before_login").on('click',function(e){
    $('#1a').removeClass("active"); //enquiry
    $('#req_class').removeClass("active");
    $('#2a').addClass("active");//chat
    $('#chat_class').addClass("active");//chat
});


if (window.innerWidth < 700 ) {  
	  $('.type-a-message-box').click(function(event) {
    if($(event.target).is('input.input-sm')){
         $('#header-include-hover').addClass('rmheader');
		   $('.marg-leadsdetail').addClass('genietopnil');
	}
    else {
          $('#header-include-hover').removeClass('rmheader');   
		     $('.marg-leadsdetail').removeClass('genietopnil');
	} 
});
$('input.type-a-message-box.input-sm').on('keypress', function () {
    $("#header-include-hover").removeClass("rmheader");
	  $('.marg-leadsdetail').addClass('genietopnil');
});
$('input.type-a-message-box.input-sm').on('touchstart click', function () {
    $("body").css("overflow","none");
});
        $('.type-a-message-box').mouseleave(function(){
          $('#header-include-hover').removeClass('rmheader');   
		    $('.marg-leadsdetail').removeClass('genietopnil');
		});	

} 
    