<div class="sd-chatmaincontainer">
<div class='sd_contentchat col-md-12 col-xs-6 padding-0' >
<strong>ENQUIRY ID:</strong>  <?=$enquiry_id?> 
 </div>      
     <div class='chat-panel-info col-xs-12 padding-0'>
        <div class=' quotes_chathead'>
       
   <!--   <?
      $today = date('Y-m-d');
      $chat_msg_time = date('Y-m-d H:i:s');
     ?>  -->
      <input type="hidden" id="User_Id" value="<?=$clientID?>">            
    <input type='hidden' id='today' value='<?=$today?>'>
    <input type='hidden' id='buyingdate' value='<?=$buying_date?>'>
    <input type='hidden' id='expiry_date' value='<?=$expiry_date?>'>
    <input type='hidden' id='server_id' value='<?=$serverid?>'>
    <input type='hidden' id='customer_name' value='<?=$customer_name?>'>
 
    <input type="hidden" id="leads_credits_balance" name="leads_credits_balance" >
    <input type='hidden' id='min_credit' value='<?=$category_credits?>'>
	<input type="hidden" id="sid_id" value="<?php echo $sid_id;?>">
	<input type="hidden" id="productspec" value="<?php echo html_entity_decode($quotes['Lead']['productspec']);?>">
	 <input type="hidden" id="quoteid" name="quoteid" class="input-sm" value="<?php echo $quoteid;?>" /> 
	 <input type="hidden" id="userid" name="userid" class="input-sm" value="<?php echo $clientID;?>" />
	 <input type="hidden" id="User_Id" name="User_Id" class="input-sm" value="<?php echo $clientID;?>" />
	 <input type="hidden" id="serverid" name="serverid" class="input-sm" value="<?php echo $serverid;?>" />
	 <input type="hidden" id="b2c" name="b2c" class="input-sm" value="<?php echo $b2c;?>" />
	 <input type="hidden" id="sellerid" name="sellerid" class="input-sm" value="<?php echo $sellerid;?>" />
	 <input type="hidden" id="quote_status" name="quote_status" class="input-sm" value="<?php echo $quote_status;?>" />
	 <input type="hidden" id="sellers_category" value="<?=$check_seller_category?>">
	 <input type="hidden" id="disabled" name="disabled" value="<?php echo $disable;?>">
	  <input type="hidden" id="seller_name" name="seller_name" value="<?php echo $Vendor_Name;?>">
	  <input type="hidden" id="seller_mobile" name="seller_mobile" value="<?php echo $seller_mobile_no;?>">
	  <input type='hidden' id='view_seller_contact' value='<?=$view_seller_contact?>'>
      <input type='hidden' id='view_buyer_contact' value='<?=$view_buyer_contact?>'>
      <input type="hidden" id="budget" name="budget" value="<?php echo $budget;?>">
     <input type="hidden" id="quantity" name="quantity" value="<?php echo $quantity;?>">
      <input type='hidden' id='leads_down' value='<?=$leads_down?>'>
      <input type='hidden' id='chat_msg_time' value='<?=$chat_msg_time?>'>
      <input type='hidden' id='guest_flag' value='<?=$guest_flag?>'>
      <input type='hidden' id='guest_user_id' value='<?=$guest_user_id?>'>
      <input type='hidden' id='seller_loc' value='<?=$seller_loc?>'>
      <input type='hidden' id='buyer_loc' value='<?=$buyer_loc?>'>
      <input type='hidden' id='full_name' value='<?=$full_name?>'>
      <input type='hidden' id='sel_cat_id' value='<?=$sel_cat_id?>'>
      <input type='hidden' id='website' value='<?=$website?>'>
      <input type='hidden' id='genie_url' value='<?=$genie_url?>'>
      <input type="hidden" id="timer">
      <input type="hidden" id="time_interval">
      <input type="hidden" id="first_msg_status" value="<?=$first_msg_status?>">
      <input type="hidden" id="quoted_user" value="<?=$quoted_user?>">
      <input type="hidden" id="enquiry_id" value="<?=$enquiry_id?>">
      <input type="hidden" id="client_status" value="<?=$client_status?>">
      <input type="hidden" id="server_status" value="<?=$server_status?>">
      <!--for header count -->
      <input type="hidden" id="Search" value="<?=$Search?>" />
      <input type="hidden" id="Brand" value="<?=str_replace('&','%26',$Brand)?>" />
      <input type="hidden" id="Suggest" value="<?=$Suggest?>" />
      <input type="hidden" id="sidebar" value="<?=$Sidebar?>" /> 
       <!--eof for header count -->
 
        <div class="contentchat sd_contentchat" id="contentchat"> 
        	<div class="chatpanel-body">
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
					<li id="chat_class" class="<?=$msg_class?>">
					<a href="#2a" data-toggle="tab">CHAT<i class="mbhide"> WITH SELLER</i></a>
					</li>
					 <li id="req_class" class="<?=$req_class?>">
				      <a  href="#1a" data-toggle="tab"><i class="mbhide">ENQUIRY</i> DETAILS</a>
					</li> 
					<?}else{ //seller?>
					<li id="chat_class" class="<?=$msg_class?>"><a href="#2a" data-toggle="tab"><i class="dskhide">ENQUIRY</i> <i class="mbhide">CHAT WITH CUSTOMER</i></a>
				    </li>
				    <li id="req_class" class="<?=$req_class?>">
			               <a  href="#1a" data-toggle="tab"><i class="mbhide">ENQUIRY</i> DETAILS</a>
				   </li> 
					 <?}?>
					 <li class="brdcrum">
						<?php
						/*Bread Crumb Starts*/
						echo"<div class='leaduick cmd-12 padding-0' >";
						echo $this->element('genie_chat_crumbs');  	
						echo"</div>";
						/*Bread Crumb Ends*/
	                    ?>
					</li>	 
				</ul> 
			  </div>	  
			 <!--end-->
			 <!--nav_body-->
			 <div class="xnvtab tab-content clearfix">
				 <!--customer enquiry-->
			   <div class="tab-pane <?=$req_class?>" id="1a">
	              	<div id='toggle_require' class='sd_well_body' >
						<?
						 echo $this->element('genie_left_side');	
						?>
						<p>	 
					</div>
				</div> 
				<!--END customer enquiry-->
				<!--chaT-->
			<div class="tab-pane <?=$msg_class?>" id="2a">
            <ul class="sdchatmsg">
				<?php 
				if($messages_ids !='')
				{
				foreach($messages_ids as $message){
					if($message['messages']['user_id'] == $clientID)
                    {
                    	    $read_time=$message['messages']['status'];//time changed to status field
                    	    if($read_time =='read'){
									$read_status="<i class='glyphicon glyphicon-ok'></i> Read by Seller";
							}else{
									$read_status="<i>Unread by Seller</i>";
							}
							
					        $status=$client_status;
						        if($disable =='disable'){
						        	$username="CUSTOMER";
						        }
						        else{
						        $username="ME";
						        }
					        $img_chat_style="float:left";
	                        $img_circle_style="float:right";
								 if($status =='online'){
			                            $status_src="/img/chat_online.png";
			                            $status_on="<i class='onlineh2'>online</i>";
								 }
								 else{
			                           $status_src="/img/chat_offline.png";
			                           $status_on="<i class='offlineh1'>offline </i>";;
								}	
						}		
                    else{
	                        $status=$server_status;
	                        $read_time=$message['messages']['status'];//time changed to status
	                        $img_chat_style="float:right;cursor:pointer";
	                        $img_circle_style="float:left;cursor:pointer";
					            if($status =='online'){
			                        $status_src="/img/chat_online.png";
			                        $status_on="<i class='onlineh2'>online</i>";
								}
								else{
			                        $status_src="/img/chat_offline.png";
			                        $status_on="<i class='offlineh1'>offline </i>";;
			                    }
	                      		if($message['messages']['user_id'] == $quoted_user){
                                    if(($full_name=='')||($full_name==undefined)){
                                         $username="CUSTOMER";
                                    }else{
	                      		        
	                      		         $username=$full_name;
	                      	     	}
	                     		}else{
	                                     $username=$sid_vendorname; 
	                      		}
					}	
			       if($message['messages']['user_id']== $quoted_user)
                    {
                    	$class="server";
					    $profile_pic="/img/avatars/buyer.png";
                    }
                    else{
                    	  $class="client";	
					      $profile_pic="/img/avatars/seller.png";	
                    }
					?>
				<li class="<?php echo $class;?>" id="<?php echo $message['messages']['id'];?>" style="<?php echo $margin;?>">
		 <?php if($message['messages']['user_id']!= $quoted_user)   //seller or seller buyer
                    {?>
				<a class="img_chat "  title="<?php echo $username;?>" style="<?php echo $img_chat_style;?>">
			     <img class="img-circle" src="<?php echo $profile_pic;?>" alt="<?php echo $username;?>" style="<?php echo $img_circle_style;?>;cursor:pointer">
			    </a>
		       <?}
		       else{  
			        // $is_buyer=$this->requestAction('/genie/get_seller_status/'.$message['messages']['user_id']);
                      //if($is_buyer == 1){
                      	if($message['messages']['user_status']==1){
		             ?>
					   <a  class="img_chat"   title="<?php echo $username;?>" style="<?php echo $img_chat_style;?>">
			               <img class="img-circle" src="<?php echo $profile_pic;?>" alt="<?php echo $username;?>" style="<?php echo $img_circle_style;?>;">
			          </a>
		       <?     }
		              else{?>
		                    <a class="img_chat"   title="<?php echo $username;?>" style="<?php echo $img_chat_style;?>">
						<img class="img-circle" src="<?php echo $profile_pic;?>" alt="<?php echo $username;?>" 
							          style="<?php echo $img_circle_style;?>;cursor:pointer">
			               </a>
		              <?}
		       }?>
        <div class="sdcht pull-right">
			 <span class="chat-user-status"> 
				 <img  src="<?php echo $status_src;?>" alt="<?php echo $username;?>">
			 </span>
				<span class="time label label-success" id="message_<?php echo $message['messages']['id'];?>">
				<?php 
				$time=$message['messages']['time'];
			    $sessiontime = new DateTime($ServerLastTime);
			    echo $status_on;
			    if($browser!= "Safari"){
										echo $this->Time->format($time,'%l:%M %p, %e %b %Y, %a ');
			   }
				?>
				</span>
        </div>			
		<div class="message-area">
			<span class=""></span>
			<div class="info-row">
				<span class="user-name">
				<?if($message['messages']['user_id']!= $quoted_user){ //seller?>
             
							 <a title="<?php echo $username;?>" >
	       <strong class="user-name" style="text-transform: none"><?php echo ucfirst($username);?> (<?=rtrim($Vendor_Name)?>)
	       </strong> 
			                 </a><br/>
			                  <span class="seller_loc"><?=$seller_loc?> </span>
			                    <br/>
			                    <span style="text-transform:none"> </span>
									 <span class='mbchat'><!--to be updated by sajith -->
									 <span class="glyphicon glyphicon-earphone xwhite" ></span>  
									 <a href="tel:<?=$view_seller_contact?>" data-rel="external">
									  <?php if(($view_seller_contact != '')||($view_seller_contact != 'undefined')){ 
					                                echo $view_seller_contact;
					                   }
					                   ?>
					                 </a>
		                            </span>
		                        <?if($website!='nil'){?>
		                            <span class='mbchat' style="margin-left:3px"><!--to be updated by sajith -->
									 <span class="glyphicon xwhite" ></span> 
									 <a  id="visit_website" class='visit_website'>VISIT WEBSITE</a>
									 </span>
								<?}?>
				<?}//seller
				     else{?>
				              <strong class="user-name">
				                          <?php echo ucfirst($username);?> 
				               </strong><br/>
				                <span class="seller_loc"><?=$buyer_loc?> </span>
                      <?}?>
				</span>
				              <div class="clear"></div>
			</div>
					    <? if($message['messages']['intromsg']==2){
					    	echo "<span style='margin-bottom:2px'>";
						       echo nl2br(html_entity_decode($message['messages']['messages']));
						    echo"<span/>";
						    if($quantity!=''){
						        	if(($sel_cat_id==80)||($sel_cat_id==88)||($sel_cat_id==109)){
                        	echo"<span class='_qntp'><span class='_qnth1'>";echo "<strong>GROUP SIZE: </strong>".$quantity;	
                        	}else{
						        	echo"<span class='_qntp'><span class='_qnth1'>";echo "<strong>Quantity: </strong>".$quantity;
						        }
						                 }

						  if($budget!=''){
						  	    if(($sel_cat_id==80)||($sel_cat_id==88)||($sel_cat_id==109)){
			                            	echo"<br>";echo "<strong>BUDGET(Per Person): </strong> Rs. ".$budget;
                                        if($genie_url!=''){
                                        	 if($genie_url!=undefined){
			                            	echo"<br>";echo "<strong>TOTAL BUDGET: </strong> Rs. ".$budget*$quantity;
			                               }
                                          }
			                            }else{
			                           echo"<br>";echo "<strong>BUDGET: </strong> Rs. ".$budget; 	
			                            }
	                            	echo"</span></span>";
	                            }
						 }//customer requirement
 						else{//for offers
						 	   if($message['messages']['offer_flag']==1){
						echo"<span style='color:#0393f3'>";
						echo "<strong>".ucfirst($username)."'s Offer - </strong></span> ".$message['messages']['messages'];
		    	           }else{
		                       echo html_entity_decode($message['messages']['messages']);
		                   }
						 }//customer chat
						 ?>
                    <?if($message['messages']['user_id'] == $quoted_user){?>
                           <span style="float:right" class="readmsg"><?=$read_status?></span>
                    <?}?>
		</div>
		<div class="clear"></div>
	</li>
				<?php }}?>
            </ul><!--sd-messages-layout-->
             <span class="sd_chat1">
            <br>
             </span>
            <div class="message-entry">
            <div id="notify"> </div>
            <span id="chat_msg_error" style="display:none">* Please Type Chat Message.</span>
             <div id="type-status-<?php echo $serverid; ?>" class="receiver-chat-status"></div>
             <div id="type-status"></div>
            <div class="container" id="credit_msg">
              <div id='new_msg_indicator' style="display:none;float:right;color:#ff0000">You have new messages</div>  
                </div> 
                 <?php 
                 	if(($today >= $expiry_date)|| ($quote_status ==5)){}//expired or 
                  else{
                  	     if($disable==''){
                  	?>
        <input type="textarea" placeholder="Type Here and Start Chatting .."  class="type-a-message-box input-sm" name="message" /> 
                 <? }
                  }
                  if(($today >= $expiry_date)|| ($quote_status ==5)){ //paused or expired 
	                    if($quote_status ==5){//paused
			                $pausetime=$this->Time->format($pause_time, '%l:%M %p, %e %b %Y, %a ');
			                    if ($quoted_user != $clientID) {
			                     	 	$paused_status="<strong>Note:</strong> Chat is Unavailable for this Enquiry as it has been Paused by the Customer at ".$pausetime;

			                    }//seller
			                    else{
			                     	 	$paused_status="<strong>Note:</strong>  It has been paused by ". $clientNAME." at ". $pausetime;
			                    }//buyer
		                }//paused
		                else{
	                        $paused_status="<strong>Note:</strong> Chat is Unavailable for this Enquiry as it has Expired";
	                    }//expired
	                          if($disable==''){
		                         echo"<span class='msgnote'>";
		                     	 echo $paused_status;
		                     	 echo"<span>";
	                     	}
                    }// eof paused or expired 
                    ?>
                </div><!-- send-group -->
                   <div class="chat_button">
                   <?php
                  if(($today >= $expiry_date)|| ($quote_status ==5)){}
                  	else{
                  		 if($disable==''){
                  	?>
               <input type="submit"   name="send-message" id="sendMessage" class="btn btn-primary" value="Send" >
                 <?php //}?>
           <input type="submit" style="display:none" name="send-message" id="sendMessage_sub" class="btn btn-primary" value="Send"  >
                     <?  }   
                     }
                    ?>
                </div><!-- message-entry -->
				</div>
				<!--end-->
  </div>
	      </div>		  
        	<?php
        		?>
			 <!--Quote Form ends-->		
			</div>
			    <?php 
                  /*To find the seller */
                  if($clientID != $quoted_user){$seller=$clientID;}else{$seller='';}
                  /* To find the seller*/
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
<div class="clearboth"></div> 
     </div>
     </div>
    </div><!--container -->

   
