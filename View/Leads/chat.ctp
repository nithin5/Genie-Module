<?php
	//Configure::write('debug',2);


// echo $this->Html->css('responsive');

/*for carousal in pop up of seller*/
// echo $this->Html->css('owl.carousel.css');
// echo $this->Html->css('owl.theme.css');
// echo $this->Html->css('owl.transitions.css');

//echo $this->Html->script('jquery.min');
// echo $this->Html->script('bootstrap'); 
		//echo $this->Html->script('jChat');
//not in server
		
		//echo $this->Html->script('custom');
// echo $this->Html->script('jquery-ui');

echo $this->element('login_vendors');//login
//echo $this->element('leads_form');//login
echo $this->Html->script('leads_details_after_login');
echo $this->Html->script('jquery.nicescroll');



		/*for carousal in pop up of seller*/
 //echo $this->Html->script('owl.carousel.js');
//echo $this->Html->script('compare_validate');

		
		
	?>

</head>

<body>

    
   
    
    <div class="sd-chatmaincontainer">
    <?php
   // $expiry_date=$quotes['Lead']['buyingdate'];
	//$expiry_date= date('Y-m-d', strtotime($expiry_date. ' + 1 days'));
    /*Bread Crumb Starts*/
    echo"<div class='leads_quick col-md-12 col-xs-12' >";
	  // echo $this->element('leads_chat_crumbs');  	
    echo"</div>";
   /*Bread Crumb Ends*/
   ?>
       
     <div class='chat-panel-info'>
                         
                   <div class=' quotes_chathead'>
                  
    <input type="hidden" id="User_Id" value="<?=$clientID?>">
     <?$today = date('Y-m-d');?>             
    <input type='hidden' id='today' value='<?=$today?>'>
    <input type='hidden' id='buyingdate' value='<?=$buying_date?>'>
    <input type='hidden' id='expiry_date' value='<?=$expiry_date?>'>
    <input type='hidden' id='server_id' value='<?=$serverid?>'>
   <!--  <input type='hidden' id='product_spec' value='<?=$productspec?>'>
 -->    
  <input type="hidden" id="leads_credits_balance" name="leads_credits_balance" >
     <input type='hidden' id='min_credit' value='<?=$category_credits?>'>



	 
	    
	     <input type="hidden" id="sid_id" value="<?php echo $sid_id;?>">
	     <input type="hidden" id="productspec" value="<?php echo $quotes['Lead']['productspec'];?>">

	      		
	

    <??>
         <!--form id="chatform" method="post"-->
        <div class="contentchat sd_contentchat" id="contentchat"> 
        	<div class="chatpanel-body">
        	<b>ENQUIRY ID :  <?=$enquiry_id?> </b>
        	
        	 <!--nav_menu-->
          <div class="_cnavmn">
                
				          <?

                        if($quote_offer==''){
									          if($messages_ids ==''){
									          	//$req_class="active";
									          	$msg_class="active";
									          	$price_class="";
									            }else{
									          	$msg_class="active";$req_class="";$price_class="";
									          }
				        }else{
				          $msg_class="";$req_class="";$price_class="active";	
				        }

          ?>
			 <!--menu header-->
			  <div class="_navhd">
				  <ul  class="nav nav-tabs">
				 <? if($clientID == $quoted_user){ //buyer?>

					 <li id="req_class" class="<?=$req_class?>">
				      <a  href="#1a" data-toggle="tab"><i class="mbhide">ENQUIRY</i> DETAILS</a>
					</li> 

					<li id="chat_class" class="<?=$msg_class?>">
					<a href="#2a" data-toggle="tab">CHAT<i class="mbhide"> WITH SELLER</i></a>
					</li>

					<?if($quoteprice > 0){?>
					<!-- <li id="price_class" class="<?=$price_class?>">
					<a href="#3a" data-toggle="tab" ><i class="mbhide">VIEW PRICE & OFFER</i><i class="DShide">QUOTES</i>
					</a>
					</li> -->
					<?}?>

					<?}else{ //seller?>
					    <li id="req_class" class="<?=$req_class?>">
				               <a  href="#1a" data-toggle="tab"><i class="mbhide">ENQUIRY</i> DETAILS</a>
					   </li> 
					    <li id="chat_class" class="<?=$msg_class?>"><a href="#2a" data-toggle="tab">CHAT<i class="mbhide"> WITH CUSTOMER</i></a>
					    </li>
							<?if(($quoteprice =='')||($quoteprice == 0)){?>
								
							<?}else{?>
									
					
							<?}?>
 					<?}?>
				</ul> 
			  </div>	  
			 <!--end-->
			 <!--nav_body-->
			 <div class="xnvtab tab-content clearfix">
				 <!--customer enquiry-->
			   <div class="tab-pane <?=$req_class?>" id="1a">
			              	<div id='toggle_require' class='sd_well_body' >
									 	
											 <?//echo $this->element('leads_chat_mask');  
											 //echo "<div class='leads_det leads-pop-des'>";
											 echo $this->element('chat_left_side');	
											 ?>
											 
											 	   	
											<p>	 
														<!-- <?if(($today >=$expiry_date)|| ($quote_status ==5)){}//expired or 
														else{?> 			
													   <button   id='req_chatnow' type="button" class='class="btn btn-default'  
													   style="margin-top:25px;border:0px;background-color: #3f51b5;font-size: 15px;float: left;width: 10%;text-transform: uppercase;color: #fff";>
													   CHAT NOW </button>
												
													   <?}?> -->

							</div>
				</div> 
				<!--END customer enquiry-->
				<!--chaT-->
				<div class="tab-pane <?=$msg_class?>" id="2a">
               
			<!-- jChat -->
			  
			
            <ul class="sd-messages-layout">
                 <!--  <li class="client" id=>
           							 <a  class="img_chat"></a>

           							 <div class="message-area">
           							 <div class="info-row" style="font-size: bold"><strong>Customer Requirement</strong></div>
										<p>
                                         <?php echo $productspec;?> </p>
                   						</div> 
                   	</li>
                 -->
				<?php 
				
				if($messages_ids !='')
				{
				foreach($messages_ids as $message){
					
					if($message['messages']['user_id']== $clientID)
                    {
					        $status=$client_status;
					        $username="ME";
					        
					        $img_chat_style="float:left";
	                        $img_circle_style="float:right";
								 if($status =='online'){
			                           $status_src="/img/chat_online.png";
								 }
								 else{
			                          $status_src="/img/chat_offline.png";

								}	
						}		
                    else{
	                       $status=$server_status;
	                        

	                        $img_chat_style="float:right;cursor:pointer";
	                        $img_circle_style="float:left;cursor:pointer";
					           if($status =='online'){
					           	   
			                        $status_src="/img/chat_online.png";
								}
								else{
			                          $status_src="/img/chat_offline.png";
			                    }
	                      		if($message['messages']['user_id']== $quoted_user){
	                      		    $username="Customer";
	                     		 }else{
	                                     if($sid_flag==1){
	                                     	 $username="Customer";

	                                     }else{
		                      			      $username=$this->requestAction('/leads/get_username/'.$message['messages']['user_id']);
	                                     }
	                      		}
					  
					}	

			       if($message['messages']['user_id']== $quoted_user)
                    {
                     $class="client";	
					 $profile_pic="/img/avatars/buyer.png";


                    }
                    else{

                    	 $class="server";	
					     $profile_pic="/img/avatars/seller.png";	
					 

                    }

			
			
					?>
					
				<!--<form id="chatform" method="post">-->

				<li class="<?php echo $class;?>" id="<?php echo $message['messages']['id'];?>" style="<?php echo $margin;?>">
            <?php //echo $message['messages']['user_id'];
            //echo $quoted_user;?>
		 <?php if($message['messages']['user_id']!= $quoted_user)   //not quote submitted by buyer(seller or seller buyer)
                    {?>
                    

					  <a  data-target="#know-more-popup" data-toggle="modal" onclick="CompanyPage(<?=$message['messages']['user_id']?>,'2','','insurance','plansmart-financial','XRV<?=$message['messages']['user_id']?>')"  class="img_chat "  title="<?php echo $username;?>" style="<?php echo $img_chat_style;?>">
			          <img class="img-circle" src="<?php echo $profile_pic;?>" alt="<?php echo $username;?>" style="<?php echo $img_circle_style;?>;cursor:pointer">
			          </a>
		       <?}
		       else{  
			       	     if($sid_flag==1){
	                              $is_buyer == 1;
			       	     }
			       	     else{
			                  $is_buyer=$this->requestAction('/leads/get_seller_status/'.$message['messages']['user_id']);
			              }
		             //echo "dfdfdf".$is_buyer;
                      if($is_buyer == 1){
		             ?>
		            
					   <a  class="img_chat"   title="<?php echo $username;?>" style="<?php echo $img_chat_style;?>">

			          <img class="img-circle" src="<?php echo $profile_pic;?>" alt="<?php echo $username;?>" 
			          style="<?php echo $img_circle_style;?>;">
			          </a>

		       <?     }
		              else{?>

		                    <a class="img_chat"   title="<?php echo $username;?>" style="<?php echo $img_chat_style;?>">
			          <img class="img-circle" src="<?php echo $profile_pic;?>" alt="<?php echo $username;?>" 
			          style="<?php echo $img_circle_style;?>;cursor:pointer">
			          </a>

		              <?}

		       }?>

		<div class="message-area">

			<span class=""></span>
			<div class="info-row">
				<span class="user-name">
				<?if($message['messages']['user_id']!= $quoted_user){?>

				 <a  data-target="#know-more-popup" data-toggle="modal" onclick="CompanyPage(<?=$message['messages']['user_id']?>,'2','','insurance','plansmart-financial','XRV<?=$message['messages']['user_id']?>')"  title="<?php echo $username;?>" >
                    <strong><?php echo $username;?> </strong>
                 </a>
				<?}else{?>

				<strong><?php echo $username;?> 
                          
				</strong>
                  <?}?>
				</span>
				<span class="chat-user-status"> 
				 <img  src="<?php echo $status_src;?>" alt="<?php echo $username;?>">
				 </span>
				<span class="time label label-success" id="message_<?php echo $message['messages']['id'];?>">
				
				
				<?php 
				$time=$message['messages']['time'];
				//echo $time;
		
			//$date = new DateTime($time);
			//echo $date;
			$sessiontime = new DateTime($ServerLastTime);
			//echo $this->Time->timeAgoInWords($date);


				echo $this->Time->format($time,'%l:%M %p, %e %b %Y, %a ');
			
				?>
                
				</span>
				<div class="clear"></div>
			</div>
			<p>
				<?php echo $message['messages']['messages'];?>
			</p>
		</div>
		<div class="clear"></div>
	</li>
				<?php }}?>
            </ul><!--sd-messages-layout-->
            

             <span class="sd_chat1">
            <br>
             <?php 
                   // echo "session time is ".$sessiontime;
                    if($sessiontime != null){
            									 //echo "Last Logged in".$this->Time->timeAgoInWords($sessiontime); 
       				  }
             ?>
           
             </span>
             <?if(($leads_down == 0)||($leads_down == 3)){//show only if not paid or refunded?>

             <?if ($quoted_user != $clientID) {?>
		 	<div id='chats_pkg_details' class="message-entry msgnot" style="">
				 <?echo $this->element('chat_pkg_details');?>

			</div> 
			<?}?>
			<?}?>
            <div class="message-entry">
            <div id="notify"> </div>
            <span id="chat_msg_error" style="display:none">* Enter the chat messages.</span>
             <div id="type-status-<?php echo $serverid; ?>" class="receiver-chat-status"></div>
             <div id="type-status"></div>

            <div class="container" id="credit_msg">
              <div id='new_msg_indicator' style="display:none;float:right;color:#ff0000">You have new messages</div>  
                </div> 
                 <?php //}else{
                 	if(($today >= $expiry_date)|| ($quote_status ==5)){}//expired or 
                  else{
                  	?>
                 <input type="textarea" placeholder="Type Here and Start Chatting .." id="<?php echo $clientID; ?>" class="type-a-message-box input-sm" name="message" /> 
                 <?}

                  if(($today >= $expiry_date)|| ($quote_status ==5)){ //paused or expired 


	                    if($quote_status ==5){//paused
	                		
			                $pausetime=$this->Time->format($pause_time, '%l:%M %p, %e %b %Y, %a ');
			                    if ($quoted_user != $clientID) {

			                     	 	$paused_status="Note:Chat is Unavailable for this Enquiry as it has been Paused by the Customer at ".$pausetime;

			                    }//seller
			                    else{

			                     	 	$paused_status="Note It has been paused by ". $clientNAME." at ". $pausetime;

			                    }//buyer
		                }//paused
		                else{
	                          
	                        $paused_status="Note:Chat is Unavailable for this Enquiry as it has Expired";
	                    }//expired
	                         echo"<span style='font-weight: bold;'>";
	                     	 echo $paused_status;
	                     	 echo"<span>";
                    }// eof paused or expired 
                    ?>

				 <input type="hidden" id="quoteid" name="quoteid" class="input-sm" value="<?php echo $quoteid;?>" /> 
				 <input type="hidden" id="enquiry_id" name="enquiry_id" class="input-sm" value="<?php echo $enquiry_id;?>" /> 
				 <input type="hidden" id="userid" name="userid" class="input-sm" value="<?php echo $clientID;?>" />
				 <input type="hidden" id="User_Id" name="User_Id" class="input-sm" value="<?php echo $clientID;?>" />
				 <input type="hidden" id="serverid" name="serverid" class="input-sm" value="<?php echo $serverid;?>" />
				 <input type="hidden" id="b2c" name="b2c" class="input-sm" value="<?php echo $b2c;?>" />
				<input type="hidden" id="sellerid" name="sellerid" class="input-sm" value="<?php echo $sellerid;?>" />
				<input type="hidden" id="quote_status" name="quote_status" class="input-sm" value="<?php echo $quote_status;?>" />
				 <input type="hidden" id="sellers_category" value="<?=$check_seller_category?>">
				
             
                </div><!-- send-group -->
                   <div class="chat_button">
                   <?php
                  
              
               
                  if(($today >= $expiry_date)|| ($quote_status ==5)){}
                  	else{
                  	?>
                 <input type="submit" style=""  name="send-message" id="sendMessage" class="btn btn-primary" value="Send" style="float:left;margin-left:200px"/>
                 <?php //}?>
           <input type="submit" style="display:none" name="send-message" id="sendMessage_sub" class="btn btn-primary" value="Send"  >
                     <?}
                    ?>
                </div><!-- message-entry -->
            <!--</form>-->
           
            
            <!-- // jChat -->
				</div>
				<!--end-->
				   <!--Quote Form -->
        <div class="tab-pane <?=$price_class?>"  id="3a">

         <?php if ($quoted_user != $clientID) {?>
        
				            <div class='container' id='quote-form' >
											 	<span class="top_msg" id="top_heading" >
									  
												</span>
								<?echo $this->element('leads_chat_seller_price');  ?>	
							</div><!--panel panel-info-->
  
          <?php }
          else{ //for buyer?>
		                   <div class='container' id='quote-form' >
									 	<span class="top_msg" id="top_heading" >
							  
										</span>
						   <?echo $this->element('leads_chat_buyer_price');  ?>	
					      </div><!--panel panel-info-->


           <?}?>
				</div>
				<!--end-->
  </div>
			 <!--end-->
	      </div>		  
		<!--end-->

        	<!--<a  id='view_require' class=='btn btn-link' >View Customer Requirement</a>
        	<?php if ($quoted_user != $clientID) {?>
        	<a id='quote-show' class=='btn btn-link' style="cursor: pointer;margin-left: 490px;color:#006400;text-decoration: underline;">
        	 Quote Your Best Price</a> 
        	<?}?>-->
        	<?php //}

        	//else{
        		?>
		        
					
					    
			 <!--Quote Form ends-->		
			</div>
			    <?php 
			   
                
                  if($b2c==1)
                  {
                  	  $credit=10;
                  } //credit amount for b2c
                  else{
                       $credit=100;
                  } //credit amount for b2b
                  
                  /*To find the seller */
                  if($clientID != $quoted_user){$seller=$clientID;}else{$seller='';}
                  /* To find the seller*/
                     
					if(count($chat_intro) == 0 AND ($clientID != $quoted_user))	{

						//echo "<h3>Contact this Customer Now with ".$credit." Credits.</h3>";

					//echo "<h6>(Note: your account will be charged only once i.e. when you send your first message)</h6>";
					}
                ?>

            <?php
			    $current_session_time=$ServerLastTime;
				
				if($current_session_time)
				{
					$session_time = '<span class="session_time sd_ch_lastc"><b> Last seen </b> '.$current_session_time.'</span>';
				} else {
					$session_time = '<span class="session_time sd_ch_online"><b> Online </b></span>';	
				}
				 
				
			?>
     
                     
        </div> <!-- // contentchat -->

        
    </div><!--container -->

    <!--////////
        place ur price
    //////////////  -->
<div class="clearboth"></div> 

        
     </div>
     </div>
    </div><!--container -->
                  
</body> 
   <script>
   $( document ).ready(function() {
   	    
     
       $("ul.sd-messages-layout").niceScroll({touchbehavior:false,cursorcolor:"#ddd",cursoropacitymax:0.6,cursorwidth:8,boxzoom:true, autohidemode:false});
    
   	   toScroll = $("ul.sd-messages-layout");
	  $("ul.sd-messages-layout").animate({ scrollTop: toScroll[0].scrollHeight }, 'slow');  

	 
	  
    
	 });

   
     /*$( ".type-a-message-box" ).on("focus",function() {
     	
     	var ID = $(this).attr("id");
     	
     	 var serverid="<?php echo $serverid;?>";//receiving user
     	user_is_typing(this, serverid);
		$(this).on('blur', function() {
								stop_type_status();	
							});

     });*/

        /* When enter key is pressed*/
 $(document).keypress(function(event){
    var ID = $(this).attr("id");
     
    var keycode = (event.keyCode ? event.keyCode : event.which);
    //console.log(keycode);return false;
    if(keycode == '13'){
    	//console.log(keycode);return false;

    					var quote_status=$("#quote_status").val();
					    if(quote_status == 5){
					    	return false;
					    }
   
					    
				         
				         var b2c = $("#b2c").val();
				         var message=$(".type-a-message-box").val();
						 var quoteid=$("#quoteid").val();
						 var userid=$("#userid").val();
						 var enquiry_id=$("#enquiry_id").val();
						
						 //var serverid="<?php echo $serverid;?>";//receiving user
						var serverid=$("#server_id").val();

						     console.log(message); 
						        
				             
						 if(message == '')
								{
								
								     $('#chat_msg_error').show().delay(5000).fadeOut();
								     return false;		 
								}	
							  
							
						 //if (quoteid) {
									//var dataString = 'message='+ message+'&quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid+'&enquiry_id='+enquiry_id;
									var dataString = 'message='+ message+'&quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid+'&enquiry_id='+enquiry_id+'&b2c='+b2c;
									
										
											
											$.ajax({
												
												type: "POST",
												url: '<?php echo Router::url(array("controller" => "leads", "action" => "ajaxsend")); ?>',
												data: dataString,
												cache: false,
												async: true, //blocks window close
												success: function(data,textStatus,xhr){ 
												$(".type-a-message-box").val("");
												//alert('ajaxsend success');
												//reload();
												
												reload_insert();
															
												
												} //success
												 
											});//
                                      return false;
								//}	//if quote	   
   						 }//if key is enter
   		//return false;				
	});//key press function
	</script>
    
   
   <script type="text/javascript">


 // $("#checkbutton").click(function(){
 //        $("#demo").toggle(1000,'linear');

 //    });

    $("#checkbuttonquote").click(function(){
        $("#demo_quote").toggle(700,'linear');

    });
$("#view_require").click(function(){
        $("#toggle_require").toggle();

    });

$("#quote-show").click(function(){
        $("#quote-form").toggle();

    });

$('#req_chatnow').click(function(){
	  

   if (!$(this).hasClass("active")) {

		    // Remove the class from anything that is active
		    $("li.active").removeClass("active");
		    // And make this active
		    $('#chat_class').addClass("active");
		    $('#1a').removeClass("active");
		    $('#2a').addClass("active");
		   // $("#id="req_class"").addClass("active");
		    $('#chat_class').addClass('active');
  }
        
    });


   
   		$("#sendMessage, #sendMessage_sub").on('click',function() {
   			
							   
			 var b2c = $("#b2c").val();
			 var message=$(".type-a-message-box").val();
			 var quoteid=$("#quoteid").val();
			 var enquiry_id=$("#enquiry_id").val();
			 var userid=$("#userid").val();
			
			 //var serverid="<?php echo $serverid;?>";//receiving user
			 var serverid=$("#server_id").val();
			 //console.log(message);
			          
             
		 if(message == ''){
			
							$('#chat_msg_error').show().delay(5000).fadeOut();
							// alert("Enter Valid Messages");
				             return false;		 
			}	
			 $(".type-a-message-box").val("");
			//if (quoteid) {
			var dataString = 'message='+ message+'&quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid+'&enquiry_id='+enquiry_id+'&b2c='+b2c;
			//console.log(message);
				
				$.ajax({
					
					type: "POST",
					url: '/leads/ajaxsend',
					data: dataString,
					cache: false,
					//async: true, //blocks window close
					success: function(data,textStatus,xhr){ 
						//alert(data);
					 reload_insert();
								
					
					} //success
					 
				});//
			//}	//if quote
			return false;
		});

   var client_status="<?php echo $client_status; ?>";
  // alert(client_status);
   
   var server_status="<?php echo $server_status;?>";
    var quote_status="<?php echo $quote_status;?>";
    console.log(quote_status);
    var buydate="<?php echo $buying_date;?>";
    var expiry_date="<?php echo $expiry_date;?>";
    console.log(buydate);
    
    var today=$("#today").val();
    console.log(today);
  // alert(server_status);
   
  if((quote_status ==5)||(today >= expiry_date)){

  }
  	else{
   if((client_status == "online") && (server_status == "online"))   {

   	 $("#toggle_require").hide();
   	 
   	// $("#view_require").show();//updated on 09th march 
   	 $(".type-a-message-box").keyup(function(event) { 
   	               // alert('key up'); 
			    	//setTimeout(reload,8000);
			     	});
    // alert('reload'); 

    setInterval(reload, 10000);

    	
     
   }

}//live enquiries

   //});
   
  /*Latest message details*/
   
   
  function reload()
			{
				//alert('reload start');
				console.log('reload');
				var quoteid=$("#quoteid").val();
			    var userid=$("#userid").val();
			   // var serverid="<?php echo $serverid;?>";//receiving user
			    var serverid=$("#server_id").val();
			    var productspec=$("#product_spec").val();;
			  // JSON.parse('${resultData}'.resultData}'.replace(/&quot;/g, '"'))
			   	// productspec=productspec.replace(/&quot;/g, '');
			   	// productspec.replace(/&#34;/g,'"')
			   	//JSON.parse(productspec); 
			   	console.log(productspec); 
			       // productspec=encodeURIComponent(productspec1);
			    var dataString = 'quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid;
			   
			    // var buydate="<?php echo $buying_date;?>";
			   
			    	

				$.ajax({
					
					dataType: "json",
					type: "POST",
					url: '<?php echo Router::url(array("controller" => "leads", "action" => "ajaxupdate")); ?>',
					data: dataString,
					cache: false,
					async: true, 
					success: function(data){ 
						//alert('reload success start');
					
					var json_data = JSON.stringify(data);
					
					var myarray = new Array();
				    var msgtime= Date();

//                     var result='<li class="client">'+
//                     '<a  class="img_chat"></a>'+
//                     '<div class="message-area"><div class="info-row" style="font-size:bold"><strong>Customer Requirement</strong></div>'+
// '<p>'+productspec+'</p></div></li>';
 
   	
					
					for( var i = 0; i < data.length; i++ )
					{
						
						var msgid=data[i].messages.id;
						var user_id=data[i].messages.user_id;

						var username=data[i].users.username;
						var chat_status=data[i].users.chat_status;
						var company_name=data[i].users.company_name;
						var receiver_id=data[i].messages.receiver;   //logged in user
						var messages=data[i].messages.messages;

						<?php date_default_timezone_set('Asia/Kolkata');?>
						var d = new Date(data[i].messages.time);
						//d.setTimezone("Asia/Kolkata");
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
                       //var hrs = d.getHours() + 5; //hrs

                       var hrs = d.getHours() ; //hrs
                      
					   //var mins = d.getMinutes() + 30;//mins

					   var mins = d.getMinutes() ;//mins
					   //var thismins;
					   

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
						   						 else{mins=mins;}
					   						}


					   var time = hrs+ ":" +mins+ " " +am_pm+ " "+day+" "+mon+" "+year+", "+weekday;
					   
					   //if(weekday ==''){alert('its null');}

						
						//var time = $.datepicker.formatDate("D M d, yy", new Date(data[i].messages.time));

						//var time = $.datepicker.formatDate("d M yy, D", new Date(data[i].messages.time));
						

						/*if(company_name !='')	{

							if(user_id == <?php echo $quoted_user;?>){
								username="Customer";

							}else{
								username=company_name;
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

						}*/

						if(user_id == userid){

							username="ME";
                            var img_chat_style="float:left";
	                        var img_circle_style="float:right";
	                        var seller_url="#";
						}
						else{

							var img_chat_style="float:right";
	                        var img_circle_style="float:left";

	                        if(user_id == <?php echo $quoted_user;?>){
								username="Customer";
								var target="_self";
							    var seller_url="#";
							    var username_style="cursor:none;text-decoration:none!important";

							}else{
								username=company_name;
							    company_name=company_name.replace(" ","-");
							    var target="_blank";
							    var seller_url="http://www.xerve.in/companies/it-and-software/"+company_name+"/XRV"+user_id+"/list";
							    var username_style="";


							}

						}

						
						if(user_id == <?php echo $quoted_user;?>)
							{
							  var lclass="client";	
							  var src="/img/avatars/buyer.png";
							  //$img_chat_style="float:left";
	                       // $img_circle_style="float:right";
							  
							}	
							else{
							 var lclass="server";	
							 var src="/img/avatars/seller.png";
							}

							if(chat_status =='online'){var status_src="/img/chat_online.png";}
							else{var status_src="/img/chat_offline.png";}


 var result = '<li class='+lclass+' id='+msgid+'>'+
'<a target='+target+' href='+seller_url+' class="time img_chat" title=""  style='+img_chat_style+'><img class="img-circle" src='+src+'  alt="Profile" style='+img_circle_style+'></a>'+
'<div class="message-area">'+
'<span class=""></span>'+
'<div class="info-row">'+
'<span class="user-name"><a target='+target+' href='+seller_url+' style='+username_style+'><strong>'+username +'</strong></a> </span>'+
'<span style="padding-left:10px"><img src=' +status_src+' alt='+chat_status+'></span>'+
'<span class="time label label-success" id='+msgid+'>'+time+'</span>'+
'<div class="clear"></div>'+
'</div>'+
'<p>'+messages+'</p>'+
'</div>'+
'<div class="clear"></div>'+
'</li>';
					
					
				
        myarray.push(result);
                   
					}//for loop of all messages for this quotes b/w 2 users

			$('ul.sd-messages-layout').empty();
			$('ul.sd-messages-layout').append(myarray);
			//$("#new_msg_indicator").show().delay(15000).fadeOut();
			// alertify.success('New Messages');
	       /* $("ul.sd-messages-layout").niceScroll({touchbehavior:false,autohidemode:false,cursorcolor:"#ddd",cursoropacitymax:0.6,cursorwidth:8,boxzoom:true});
   	        toScroll = $("ul.sd-messages-layout");
	        $("ul.sd-messages-layout").animate({ scrollTop: toScroll[0].scrollHeight }, 'slow');  */
				
					} //success

					 
				});//	
       
	}

/*reload for loggedin user insertion*/

function reload_insert()
			{
				//alert('reload ins start');
				///return false;
				console.log('reload insert');
				var quoteid=$("#quoteid").val();
			    var userid=$("#userid").val();
			    var serverid=$("#server_id").val();//receiving user
			    //var serverid="<?php echo $serverid;?>";//receiving user
			    var dataString = 'quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid;
			    
			   
			    	

				$.ajax({
					
					dataType: "json",
					type: "POST",
					url: '<?php echo Router::url(array("controller" => "leads", "action" => "ajaxupdate")); ?>',
					data: dataString,
					cache: false,
					async: true, 
					success: function(data){ 
						//alert('reload success start');
					
					var json_data = JSON.stringify(data);
					
					var myarray = new Array();
				    var msgtime= Date();


   	
					
					for( var i = 0; i < data.length; i++ )
					{
						
						var msgid=data[i].messages.id;
						var user_id=data[i].messages.user_id;

						var username=data[i].users.username;
						console.log(username);
						var chat_status=data[i].users.chat_status;
						var company_name=data[i].users.company_name;
						var receiver_id=data[i].messages.receiver;   //logged in user
						var messages=data[i].messages.messages;

						<?php date_default_timezone_set('Asia/Kolkata');?>
						var d = new Date(data[i].messages.time);
						//d.setTimezone("Asia/Kolkata");
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
                       //var hrs = d.getHours() + 5; //hrs

                       var hrs = d.getHours() ; //hrs
                      
					   //var mins = d.getMinutes() + 30;//mins

					   var mins = d.getMinutes() ;//mins
					   //var thismins;
					   

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
						   						 else{mins=mins;}
					   						}


					   var time = hrs+ ":" +mins+ " " +am_pm+ " "+day+" "+mon+" "+year+", "+weekday;
					   
					   //if(weekday ==''){alert('its null');}

						
						//var time = $.datepicker.formatDate("D M d, yy", new Date(data[i].messages.time));

						//var time = $.datepicker.formatDate("d M yy, D", new Date(data[i].messages.time));
						

						if(company_name !='')	{

													if(user_id == <?php echo $quoted_user;?>){
														username="Customer";

													}else{
														username=company_name;
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

							username="ME";
                            var img_chat_style="float:left";
	                        var img_circle_style="float:right";
						}
						else{
							var img_chat_style="float:right";
	                        var img_circle_style="float:left";
						}

						
						if(user_id == <?php echo $quoted_user;?>)
							{
							  var lclass="client";	
							  var src="/img/avatars/buyer.png";
							  //$img_chat_style="float:left";
	                       // $img_circle_style="float:right";
	                        username="Customer";
	                        if(user_id == userid){
	                        	username="ME";
	                        }

							  
							}	
							else{
							 var lclass="server";	
							 var src="/img/avatars/seller.png";
							}

							if(chat_status =='online'){
								var status_src="/img/chat_online.png";
							}
							else{
								var status_src="/img/chat_offline.png";
						    }


var result='<li class='+lclass+' id='+msgid+'>'+
'<a target='+target+' href='+seller_url+' class="time img_chat" title=""  style='+img_chat_style+'><img class="img-circle" src='+src+'  alt="Profile" style='+img_circle_style+'></a>'+
'<div class="message-area">'+
'<span class=""></span>'+
'<div class="info-row">'+
'<span class="user-name"><a target='+target+' href='+seller_url+' style='+username_style+'><strong>'+username +'</strong></a> </span>'+
'<span style="padding-left:10px"><img src=' +status_src+' alt='+chat_status+'></span>'+
'<span class="time label label-success" id='+msgid+'>'+time+'</span>'+
'<div class="clear"></div>'+
'</div>'+
'<p>'+messages+'</p>'+
'</div>'+
'<div class="clear"></div>'+
'</li>';
					
					
				
        myarray.push(result);
                   
					}//for loop of all messages for this quotes b/w 2 users


			$('ul.sd-messages-layout').empty();
			$('ul.sd-messages-layout').append(myarray);
	        $("ul.sd-messages-layout").niceScroll({touchbehavior:false,autohidemode:false,cursorcolor:"#ddd",cursoropacitymax:0.6,cursorwidth:8,boxzoom:true});
   	        toScroll = $("ul.sd-messages-layout");
	        $("ul.sd-messages-layout").animate({ scrollTop: toScroll[0].scrollHeight }, 'slow');  
			//message_alerts();		
					} //success

					 
				});//	
       
	}

/*reload for loggedin user insertion*/

/*contact client + credit deduction  process*/



	
	function contact_client(){
	
	
    
    var b2c = $("#b2c").val();
    var quoteid= $("#quoteid").val();
	var userid= $("#userid").val();
	

     var dataString = 'type='+ b2c+'&quoteid='+quoteid+'&userid='+userid;
				
				$.ajax({
					
					type: "POST",
					url: '<?php echo Router::url(array("controller" => "leads", "action" => "contact_client")); ?>',
					data: dataString,
					cache: false,
					async: false, //blocks window close
					success: function(data,textStatus,xhr){ 
					
					
					$("#sendMessage").show();
					$("#vendor-intro").hide();
					$("#credit_msg").hide();
					$("#sendMessage_sub").show();		
					$("#checkbuttonquote").show();
					
					$(".type-a-message-box").val()='';
					} //success
					 
				});//
	}
				
	//});//contact client+ credit deduction  process
    
    
       //placing quote
       $("#placequote").on('click',function() {
            	   
			
			var quoteid=$("#quoteid").val();
			
			
			var sellerid =$("#sellerid").val();
			
			var quoteprice =$("#quoteprice").val();
			var quoteoffers =$("#quoteoffers").val();
			
		   
            if(quoteprice == '')
			{
			 //alert('Enter Quote price');
			 $("#price_error").show();
			 $("#price_error").text("Please Enter Quote price");
			 $("#price_error").show().delay(5000).fadeOut();

			 // $("#price_error").show();
			 return false;
			 		 
			}
			 if($.isNumeric($('#quoteprice').val())== false)
					{
					// alertify.alert('Enter a Valid Quote Price');
					  $("#price_error").show();
					  $("#price_error").text("Please Enter valid Quote price");
                      $("#price_error").show().delay(5000).fadeOut();
				     // $('form').get(0).reset();//need to check this function
					  return false;
					}

					
            if(sellerid == '')
			{
			 
			 exit();		 
			}	
			//alert('after seller id');
		//&productspec='+encodeURIComponent(productspec)+	
			if (quoteid) {
			var dataString = 'quoteid='+quoteid+'&sellerid='+sellerid+'&quoteprice='+quoteprice+'&quoteoffers='+encodeURIComponent(quoteoffers);
			
							
				$.ajax({
					
					type: "POST",
					url: '<?php echo Router::url(array("controller" => "leads", "action" => "quote_form")); ?>',
					data: dataString,
					cache: false,
					async: false, //blocks window close
					success: function(data,textStatus,xhr){ 
					$("#quote_response").show();
					$("#quote_response1").show();
					
					
					} //success
					 
				});
			}//if quote

		});
       //end placing form based quote
   </script>
    <script type="text/javascript">
     //block F5 & Control+F5
    
			
       function chatlogoff(){
                var quoteid=$("#quoteid").val();
			    var userid=$("#userid").val();
			    var enquiry_id=$("#enquiry_id").val();
			   // var serverid="<?php echo $serverid;?>";//receiving user
			    var serverid=$("#server_id").val();
			    if (quoteid) {
								var dataString = 'quoteid='+quoteid+'&userid='+userid+'&enquiry_id='+enquiry_id;
								console.log(dataString);												
									$.ajax({
										
										type: "POST",
										url: '<?php echo Router::url(array("controller" => "leads", "action" => "chatlogoff")); ?>',
										data: dataString,
										cache: false,
										async: false, //blocks window close
										success: function(data,textStatus,xhr){ 
										
										} //success
										 
									});
			}//if quote
		}//chatlogoff

		$(window).on('beforeunload', function () {
               
             // chatlogoff();
			
			});
			 


			$(window).on("unload", function ()
			{
				chatlogoff();
			    //return false;
				   
			})
			
     
  
  </script>
  <script>
if (window.innerWidth < 700 ) {  

	  $('.type-a-message-box').click(function(event) {
    if($(event.target).is('input.input-sm')){
         $('#header-include-hover').addClass('rmheader');
		 
	}
       
    else {
          $('#header-include-hover').removeClass('rmheader');   
	} 
       
});
  $(".type-a-message-box").click(function() {
      $('body,html').animate({
    scrollTop: $('.sd-messages-layout li:last-child').offset().top
    }, 2000);
   });
    $('.type-a-message-box').mouseleave(function(){
          $('#header-include-hover').removeClass('rmheader');   
		});	

} 
</script>

 <script>	 
function close_response(){
     $("#quote_response").hide();
     $("#quote_response1").hide();

} 
$("#checkbutton").on('click',function(e){
	var check_seller=$("#sellers_category").val();
	 console.log(check_seller);
	if(check_seller == 0){
		// alertify.alert('Please Choose a Different Category');
		 $("#category_block_reason").show();
		 return;
	}

	//var sub_url = "/leads/chat/<?=$quotes['Lead']['user_id']?>/<?=$quotes['Lead']['enquiry_id']?>";
    //window.open(sub_url, '_blank');	

    $('#1a').removeClass("active"); //enquiry
    $('#req_class').removeClass("active");
    
    $('#2a').addClass("active");//chat
    $('#chat_class').addClass("active");//chat


});

$("#checkbuttonsid").on('click',function(e){
	var check_seller=$("#sellers_category").val();
	 
	if(check_seller == 0){
		// alertify.alert('Please Choose a Different Category');
		 $("#category_block_reason").show();
		 return;
	}
	//href='/leads/chat/<?php echo $quotes['Lead']['user_id'];?>/<?php echo $quotes['Lead']['enquiry_id'];?>' 
	//var sub_url = "https://www.xerve.in/leads/chat/<?=$quotes['Lead']['user_id']?>/<?=$quotes['Lead']['enquiry_id']?>/<?=$sid_id?>";
	//console.log(sub_url);
   // window.open(sub_url, '_blank');	

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





$("#contact_client_pay").on('click',function(e){

	var check_seller=$("#sellers_category").val();

	if(check_seller == 0){
		 //alertify.alert('Please Choose a Different Category');
		  $("#category_block_reason").show();
		  $("#contact_client_pay").hide();
		 return false;

	}
	if(!e.detail || e.detail == 1){

	
	//var userid="<?php echo $user_id;?>";
	var userid=$("#User_Id").val();
    
    var b2c =$("#b2c").val();
    var quoteid=$("#quoteid").val();
    var enquiry_id=$("#enquiry_id").val();
    var serverid=$("#serverid").val();
    var sid_id=$("#sid_id").val();

     var dataString = 'type='+ b2c+'&quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid+'&enquiry_id='+enquiry_id;
     console.log(dataString);
    // return false;
			
			
		 e.preventDefault();

		         /* if(sid_id ==''){
		         var sub_url = "/leads/chat/<?=$quotes['Lead']['user_id']?>/<?=$quotes['Lead']['enquiry_id']?>";
		         }else{

		     	 var sub_url = '/leads/chat/'+serverid+'/'+enquiry_id+'/'+sid_id;
		     	 console.log(sub_url);
		       }*/


                 //var win=window.open(sub_url, '_blank');

				$.ajax({
					
					type: "POST",
					url: '/leads/contact_client',
					data: dataString,
					cache: false,
					//async: false, //blocks window close
					success: function(data,textStatus,xhr){ 
					
					
				//var sub_url = "/leads/chat/<?=$quotes['Lead']['user_id']?>/<?=$quotes['Lead']['enquiry_id']?>";

               // window.open(sub_url, '_blank');
                    $("#before_contact_no_pay").hide();
                    $("#before_contact_no_pay_msg").hide();
                    $("#chats_pkg_details").hide();//
					$("#after_contact_pay").show();	
					$("#contact_client_pay").hide();
					$('#checkbutton_next').css('display', 'inline-block');
					$("#after_contact_pkg").hide();
					//$("#checkbutton_next").show();
					$("#buynow_pkg").hide();
					$("#buynow_pkg_ajax").show();

					$('#1a').removeClass("active"); //enquiry
                    $('#req_class').removeClass("active");
    
                    $('#2a').addClass("active");//chat
                    $('#chat_class').addClass("active");//chat

	                //win.focus();
                //location.reload();	
               
					
/*window.location = '<?php
 //echo $this->Html->url(array("controller" => "leads", "action" => "chat", $quotes['Lead']['user_id'],$quotes['Lead']['enquiry_id']));
 ?>';*/
 
							
 
					} //success
					//async: false, 
				});//ajax
			}//e.detail
				
	});

$("#contact_client_pay_login").on('click',function(e){

if(!e.detail || e.detail == 1){	
	var b2c ="<?php echo $quotes['Lead']['b2c'];?>";
	var userid=$("#User_Id").val();
	var pre_balance=$("#leads_credits_balance").val();//check
    var min_credit=$("#min_credit").val();
    var post_balance=pre_balance - min_credit;
    var quoteid="<?php echo $quotes['Lead']['quoteid'];?>";
    var enquiry_id="<?php echo $quotes['Lead']['enquiry_id'];?>";
    var serverid="<?php echo $quotes['Lead']['user_id'];?>";//receiving user
    var productspec=$("#productspec").val();

    var dataString = 'type='+ b2c+'&quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid+'&enquiry_id='+enquiry_id+'&productspec='+encodeURIComponent(productspec);
    
    e.preventDefault();		
				$.ajax({
					
							type: "POST",
							//url: '/leads/category_ajax',
							url: '/leads/category_ajax_for_detail',
							data: dataString,
							success: function(data,textStatus,xhr){ 
							var obj=$.parseJSON(data);
							var flag=obj.flag;
							var firstname=obj.first_name;
							var lastname=obj.last_name;
							
							
							/*console.log(flag);	
							console.log(firstname);
							console.log(lastname);*/	
							
							if(flag == 'false'){//if its different category of sellers
                                              //console.log('inside false');
										// alertify.alert('Please Choose a Different Category');
										  $("#category_block_reason").show();
										  $("#contact_client_pay_login").hide();
										  $("#full_name").hide();
										  $("#full_name_ajax").show();
										  $("#full_name_ajax").text('Dear '+firstname+' '+lastname);
										  return false;
							    }
							   else{  // alert('Moving on to Chat Zone');
							           //console.log('inside true');
							        // var sub_url = "/leads/chat/<?=$quotes['Lead']['user_id']?>/<?=$quotes['Lead']['enquiry_id']?>";

                                     // var win=window.open(sub_url, '_blank');	
							       //  var win = window.open("http://google.com", '_blank');
  
									 $.ajax({
										
										type: "POST",
										url: '/leads/contact_client',
										data: dataString,
										cache: false,
										//async: false, //blocks window close
										success: function(data,textStatus,xhr){ 
										// win.focus();
										// location.reload();
										$('#1a').removeClass("active"); //enquiry
										$('#2a').addClass("active");//chat

									    $('#req_class').removeClass("active");
									    $('#chat_class').addClass("active");//chat


										 $("#checkbutton_login").show();//chat button
								         $("#contact_client_pay_login").hide();//contact button
									     $("#chat_visible").hide();

									     $("#instalogin_credits").show();
 										 $("#instalogin_credits").text('Your Credits Balance: '+post_balance);

					                   

										 
										} //inner success
										 
									});//inner ajax
							}//else(for same category of sellers)

				
					} //outer success
					//async:false,
					 
				});//outer ajax
				


  }//e.detail

		 
				
	});//onlick




function check_lead_pay(){

	    console.log('check_lead_pay');

		var userid=$("#User_Id").val();
		var min_credit=$("#min_credit").val();
		var status="<?php echo $quotes['Lead']['status'];?>";

		//var buyingdate="<?php echo $quotes['Lead']['buyingdate'];?>";
		var buyingdate="<?php echo $expiry_date;?>";//expiry date
		var today="<?php echo $today;?>";
		//var category_credits="<?php echo min_credit;?>";
		
       //console.log("is"+min_credit);
             var enquiry_id="<?php echo $quotes['Lead']['enquiry_id'];?>";

            // var dataString = $(this).serialize();
			 var dataString ='userid='+userid+'&enquiry_id='+enquiry_id;
            //console.log(dataString);
     
           //e.preventDefault();	
            $.ajax({

					type: "POST",
					url: '/leads/check_lead_paid',
					data: dataString,
					success: function(data,textStatus,xhr){
						//console.log(data);
						
						var obj=$.parseJSON(data);
						var flag=obj.flag;
						var balance=obj.balance;
						var firstname=obj.first_name;
						var lastname=obj.last_name;
						//console.log(balance);console.log(flag);
						
			                        if(flag == 'false'){ //not paid
			                        	
			                        	//console.log(data);
				                        	if((today >= buyingdate)||(status == 5)){

				                        		// console.log('0 not live');

				                        		$("#checkbutton_login").hide();//chat button
				                        		$("#contact_client_pay_login").hide();//contact button
				                        		if(status == 5){
				                        		   //  $("#info_status_pause").show();
				                        	   }

				                        	}
				                        	else{ //live

				                        		// console.log('0  live');

						                    $("#checkbutton_login").hide(); //chat button
						                   
						                    $("#contact_client_pay_login").show();//pay buttton
						                    $("#chat_visible").show();
						                    $("#instalogin_credits").show();
								                    
								                     $("#instalogin_credits").text('Your Credits Balance: '+balance);
								                     
								                     $('input[name=leads_credits_balance]').val(balance);
								                    // $("#instalogin_credits_heading").show();
								                    
								                 
						                  }
			                        }
			                        else{ //paid
			                        	    if((today >= buyingdate)||(status == 5)){
                                                // console.log('1 not live');
				                        		//$("#checkbutton_login").show();//chat button
				                        		$("#viewdetails_login").show();//chat button
				                        		//$("#contact_client_pay_login").hide();//contact button
				                        		$("#chat_visible").hide();
				                        		if(status == 5){
				                        		$("#info_status_pause").show();
				                        	  }

				                        	}else{
						                        	//console.log('1 live');
						                        	
						                        	 $("#checkbutton_login").show();//chat button
								                     $("#contact_client_pay_login").hide();//contact button
								                     $("#chat_visible").hide();

					                       }

			                        }

						} //success
				});//ajax


	return false;
	 
}//check_lead_pay

</script>	  
   
</html>