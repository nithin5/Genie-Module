<?php
//echo $this->element('login_vendors');//login //hided for time being
//echo $this->Html->script('leads_details_after_login');  //hided for time being

  $test='chat_flip_info_main_test()';

?>
<body>
    <div class="sd-chatmaincontainer">
     <div class="sd_contentchat col-md-12 col-xs-6 padding-0">
     <?php
       if($receiver !=''){//logged in
       	  if($check_seller_category > 0){
       	  	  $block_cat=1;
       	  }
       	  else{
       	  	 $block_cat='';//irrelevant category
       	  }
       }
     ?>
    <?php if($sid_vendorname !=''){
           ?>
            <strong>Enquiry For:</strong> <?=$sid_vendorname?><br/>
            <?
            }?>
     </div>		   
     <div class='chat-panel-info col-xs-12 padding-0'>
                   <div class=' quotes_chathead'>
                   
    <input type="hidden" id="User_Id" value="<?=$receiver?>">
     <input type="hidden" id="loggedin_user" value="">
     <input type="hidden" id="sid_vendorname" value="<?=$sid_vendorname?>">
    <?php
    $today = date('Y-m-d');
    $chat_msg_time = date('Y-m-d H:i:s');
    ?> 
    <input type="hidden" id="first_msg_status" value="<?=$first_msg_status?>">            
    <input type='hidden' id='today' value='<?=$today?>'>
    <input type='hidden' id='quoted_offer' value='<?=$quoted_offer?>'>
    <input type='hidden' id='quoted_website' value='<?=$quoted_website?>'>
    <input type='hidden' id='buyingdate' value='<?=$buying_date?>'>
    <input type='hidden' id='expiry_date' value='<?=$expiry_date?>'>
    <input type='hidden' id='server_id' value='<?=$serverid?>'>
    <input type='hidden' id='leads_down' value='<?=$leads_down?>'>
    <input type='hidden' id='quoted_user' value='<?=$quoted_user?>'>
    <input type='hidden' id='product_spec' value='<?=htmlentities($productspec)?>'> 
    <input type="hidden" name="check_pay_type" id="check_pay_type">
    <input type="hidden" id="leads_credits_balance" name="leads_credits_balance" value="<?=$credit_balance?>">
    <input type='hidden' id='min_credit' value='<?=$category_credits_1?>'>
    <input type='hidden' id='c1_credit' value='<?=$category_credits_1?>'>
    <input type='hidden' id='c2_credit' value='<?=$category_credits_2?>'>
     <input type='hidden' id='sel_min_credit'>
     <input type='hidden' id='pay_pkg'>
     <input type='hidden' id='view_seller_contact' value='<?=$view_seller_contact?>'>
     <input type='hidden' id='view_buyer_contact' value='<?=$view_buyer_contact?>'>
     <input type='hidden' id='enquiry_time' value='<?=$enquiry_time?>'>
     <input type='hidden' id='receiver' value='<?=$receiver?>'>
     <input type='hidden' id='view_buyer_contact_mask' value='<?=$view_buyer_contact_mask?>'>
     <input type='hidden' id='guest_flag' value='<?=$guest_flag?>'>
     <input type='hidden' id='seller_prio' value='<?=$seller_prio?>'><!--sellers priority response -->
     <input type='hidden' id='tot_res' value='<?=$tot_res?>'><!--sellers priority response -->
     <input type='hidden' id='guest_user_id' value='<?=$guest_user_id?>'>
     <input type='hidden' id='seller_loc' value='<?=$seller_loc?>'>
     <input type='hidden' id='buyer_loc' value='<?=$buyer_loc?>'>
     <input type="hidden" id="sid_id" value="<?php echo $sid_id;?>">
     <input type="hidden" id="productspec" value='<?php echo $quotes['Lead']['productspec']?>'>
     <input type='hidden' id='sel_cat_id' value='<?=$sel_cat_id?>'>  
     <input type='hidden' id='full_name' value='<?=$full_name?>'>  
     <input type='hidden' id='Vendor_Name' value='<?=$Vendor_Name?>'>
     <input type="hidden" id="send_click">
     <input type="hidden" id="timer">
     <input type="hidden" id="time_interval">
     <input type="hidden" id="stat" value='<?=$stat?>'>

        <div class="contentchat sd_contentchat" id="contentchat"> 
        	<div class="chatpanel-body">
        	 <!--nav_menu-->
          <div class="_cnavmn">
				     <?
                       	 $msg_class="active";$req_class="";$price_class="";
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
						<li id="chat_class" class="<?=$msg_class?>"><a href="#2a" data-toggle="tab">CHAT<i class="mbhide"> WITH CUSTOMER</i></a>
					    </li>
					    <li id="req_class" class="<?=$req_class?>">
				               <a  href="#1a" data-toggle="tab"><i class="mbhide">ENQUIRY</i> DETAILS</a>
					   </li> 
					    <a href=tel:'7022619911' class="xwhite" data-rel="external" >
					   <div class="contusfixed" ><strong class="xwhite"> <span class="glyphicon glyphicon-earphone xwhite" > 
					   </span>
					   <span class="mbhide"></span> 7022619911</strong><br>
					   <span class="mbhide">( Xerve Support )</span>
					                   <!-- 7022619911 -->
                      </div>
                      </a>
					 <?}?>
					 	 <li class="brdcrum">
					<?php
						echo"<div class='leaduick cmd-12 padding-0' style='margin-top:-15px!important'>";
						echo $this->element('leads_chat_crumbs');  	
						echo"</div>";
					?>
					</li>
				</ul> 
			  </div>	
         <button type="button" id="test_button" class="btn" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-target="#myModal" style="display:none" >Basic</button>
 <? 
            echo $this->element('chat_display_modal_test');	
            echo $this->element('chat_display_modal_after_pay');
?>
<!-- Modal for customer offer details-->  
			 <!--end-->
			 <!--nav_body-->
			 <div class="xnvtab tab-content clearfix">
				 <!--customer enquiry-->
			   <div class="tab-pane <?=$req_class?>" id="1a">
			              	<div id='toggle_require' class='sd_well_body' >
											 <?
											 echo $this->element('chat_left_side');	
											 ?>
											<p>	 
							</div>
				</div> 
				<!--END customer enquiry-->
				<!--chaT-->
				<div class="tab-pane <?=$msg_class?>" id="2a">
			<!-- jChat -->
            <ul class="sdchatmsg" style="overflow-x:hidden;" id="chatzone">
                 <?php 
				if($messages_ids !='')
				{
				foreach($messages_ids as $message){
					if($message['messages']['user_id']== $clientID)
                    {
                    	    $read_time=$message['messages']['status'];
                    	    if($read_time=='read'){
										   	$read_status="<i class='glyphicon glyphicon-ok'></i> Read by Customer";
										   }else{
										   	$read_status="<i>Unread by Customer</i>";
										   }
					        $status=$client_status;
					        if($disable==''){
					                $username="ME";
					       }
					       else{//for investors
                                    $username=$this->requestAction('/leads/get_username/'.$message['messages']['user_id']);
                                    $username=ucfirst($username);
					       }
					        $img_chat_style="float:left";
	                        $img_circle_style="float:right";
	                       		 if($status =='online'){
			                           $status_src="/img/chat_online.png";
			                           $status_on="<i>online</i>";
								 }
								 else{
			                          $status_src="/img/chat_offline.png";
			                          $status_on="offline";
								}	
						}		
                    else{
	                       $status=$server_status;
	                        $read_time=$message['messages']['status'];

	                        $img_chat_style="float:right;cursor:pointer";
	                        $img_circle_style="float:left;cursor:pointer";
					           if($status =='online'){
			                        $status_src="/img/chat_online.png";
			                        $status_on="<i>online</i>";
								}
								else{
			                          $status_src="/img/chat_offline.png";
			                          $status_on="offline";
			                    }
	                      		if($message['messages']['user_id']== $quoted_user){
			                      			 
                                              $username="CUSTOMER";
			                      			
	                     		 }else{
	                                     if($sid_flag==1){
			                                     	 
		                                              
		                                              $username="CUSTOMER";

					                      			
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
				
				<li class="<?php echo $class;?>" id="<?php echo $message['messages']['id'];?>" style="<?php echo $margin;?>">
		 <?php if($message['messages']['user_id']!= $quoted_user)   //not quote submitted by buyer(seller or seller buyer)
                    {?>
				
					   <a class="img_chat "  title="<?php echo $username;?>" style="<?php echo $img_chat_style;?>">
			          <img class="img-circle" src="<?php echo $profile_pic;?>" alt="<?php echo $username;?>" style="<?php echo $img_circle_style;?>;cursor:pointer">
			          </a>
		       <?}//seller
		       else{ //buyer 
						       	  if($sid_flag==1){
				                         $is_buyer == 1;//to be checked
						       	   }
						       	   else{
						                 $is_buyer=$this->requestAction('/leads/get_seller_status/'.$message['messages']['user_id']);
						           }
			                       if($is_buyer == 1){
					               ?>
												<a  class="img_chat"   title="<?php echo $username;?>" style="<?php echo $img_chat_style;?>">
											    <img class="img-circle" src="<?php echo $profile_pic;?>" alt="<?php echo $username;?>" 
											          style="<?php echo $img_circle_style;?>;">
											    </a>
					               <?}
					              else{?>
							               <a class="img_chat"   title="<?php echo $username;?>" style="<?php echo $img_chat_style;?>">
								          <img class="img-circle" src="<?php echo $profile_pic;?>" alt="<?php echo $username;?>" 
								          style="<?php echo $img_circle_style;?>;cursor:pointer">
								          </a>
					              <?}
		       }//buyer
		       ?>
         <div class="sdcht pull-right">
			 	<span class="chat-user-status"> 
				       <img  src="<?php echo $status_src;?> " alt="<?php echo $username;?>"> <?  echo $status_on; ?>
				</span>
				<span class="time label label-success" id="message_<?php echo $message['messages']['id'];?>">
							<?php 
							$time=$message['messages']['time'];
						    $sessiontime = new DateTime($ServerLastTime);
						    $read_time=$message['messages']['read_time'];
						   
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
				<?if($message['messages']['user_id']!= $quoted_user){//buyer?>
				 <a title="<?php echo $username;?>" >
                    <strong><?php echo ucfirst($username);?> </strong>
                 </a>
                   <br>
                   <span class="seller_loc"><?=$seller_loc?> </span>
                   <br>
				<?}else{//seller?>
				        <strong>
				                 <?if($guest_flag==0){?>
						             <?    if(($leads_down == 1)||($leads_down == 2)){
						                 	                     if($seller_prio <= 5){ ?>
										<div onclick="chat_flip_info_main();" style="cursor:pointer">
							          <? echo $username;?> (<?=ucfirst($buyername)?>)
										</div>
						                    <?
						                    }//priority based
									                    else{
                                             echo $username;?> (<?=ucfirst($buyername)?>)
									                    <?}
						                     }//paid
						                     else{
						                  	 echo $username;?> (<?=ucfirst($buyername)?>)
						                    <? }?>
						                     <?
								 }
								 else{//guest?>
				                      CUSTOMER
								 <?}?>
				               <?
                ?>    </strong>
                <br>
                 <span class="seller_loc"><?=$buyer_loc?> </span>
                 <br>
                <?

  $test='chat_flip_info_main_test()';
 // echo "ld".$leads_down;

?>                       
                 <?  if(($leads_down == 1)||($leads_down == 2)){//leads downloaded
                 	                     if($seller_prio <= 5){ //priority sellers?>
												
					<span class='mbchat mbchattextbox' style='background-color: #0393f3;border-color:#0393f3;margin-bottom: 2px'>
				            <span  class="glyphicon glyphicon-earphone xwhite" > </span>
				          
				            <a href=tel:'<?echo $view_buyer_contact;?>'  >
				            <span id="view_num_pop" ><?php echo $view_buyer_contact;?> </span>
				            </a>
				    <span>
												                 <span>
				                         <?} //priority sellers
				}else{
				         ?>
				            <br/>
				           <? if($seller_prio <= 5){ //priority sellers?>
				   <span class='mbchat mbchattextbox' style='background-color: #0393f3;border-color:#0393f3;margin-bottom: 2px'>
				                <span  class="glyphicon glyphicon-earphone xwhite" > </span>
				                <span id="view_num_pop" onclick="<?=$test?>"> View Customer Number </span>
				                 <span>
				                 <?} //priority sellers?>
				 	<?}?>
                  <?}?>
				</span>
				<div class="clear"></div>
			</div>
			     <? 
       if($quoted_user != $clientID){//seller      ?>
	                           <div id='before_pay'>
     	                           <? if($message['messages']['intromsg']==2){
     	                         
     	                                     if(($leads_down == 0)||($leads_down == 3)){//not paid
					                            echo nl2br($mask);
					                            echo"<br>";	
					                            if($quantity!=''){
					                            	if(($sel_cat_id==80)||($sel_cat_id==88)||($sel_cat_id==109)){
					                            		if($quantity!=undefined){
					                            			
					                            	echo"<span class='_qntp'><span class='_qnth1'>";echo "<strong>GROUP SIZE: </strong>".$quantity;	
					                            	   }else{
                                                          echo"<span class='_qntp'><span class='_qnth1'><strong></strong></span></span>";	
					                            	   }
					                            	}else{
					                            	echo"<span class='_qntp'><span class='_qnth1'>";echo "<strong>QUANTITY: </strong>".$quantity;
					                               }
					                            }

					                             if($budget!=''){
					                             	if(($sel_cat_id==80)||($sel_cat_id==88)||($sel_cat_id==109)){
					                           	echo"<br>";
					                           	echo "<strong>BUDGET (per Head): </strong>Rs. ".$budget;
					                           	 	
					                           	 	if($genie_url!=''){
					                           	 		   if($genie_url!=undefined){
					                           	 echo"<br>";
					                           	 echo "<strong>TOTAL BUDGET : </strong>Rs. ".$budget * $quantity;
					                           	 echo"</span></span>";
					                           	   }
					                             }
					                           
					                           	 }else{
					                           	 echo"<br>";
					                           	 echo "<strong>BUDGET: </strong>Rs. ".$budget;
					                           	 echo"</span></span>";	
					                           	 }
					                            }
					                            
								            } 
								            else{//paid
								                  echo nl2br($message['messages']['messages']);
								                  echo"<br>";

								                 if($quantity!=''){
								                 	if(($sel_cat_id==80)||($sel_cat_id==88)||($sel_cat_id==109)){
								                 		if($quantity!=undefined){
					                            	echo"<span class='_qntp'><span class='_qnth1'>";
					                            	echo "<strong>GROUP SIZE: </strong>".$quantity;	
					                            	  }
					                            	}else{
					                            		
								                 	echo"<span class='_qntp'><span class='_qnth1'>";echo "<strong>Quantity: </strong>".$quantity;
								                  }
								                 }
								                   
								                  if($budget!=''){
					                             	if(($sel_cat_id==80)||($sel_cat_id==88)||($sel_cat_id==109)){
					                           	echo"<br>";
					                           	echo "<strong>BUDGET (per Head): </strong>Rs. ".$budget;
					                           	if($genie_url!=''){
					                           		 if($genie_url!=undefined){
					                           	 	echo"<br>";
					                           
					                           	echo "<strong>TOTAL BUDGET : </strong>Rs. ".$budget * $quantity;
					                           	echo"</span></span>";
					                           	 }
					                           }
					                           	 }else{
					                           	 echo"<br>";
					                           	 echo "<strong>BUDGET: </strong>Rs. ".$budget;echo"</span></span>";	
					                           	 }
					                            }
								                
								            }
								    }//customer requirement
								    else{
								    	if($message['messages']['offer_flag']==1){
            									echo"<span style='color:#0393f3'>";
            									echo "<strong>My Offer -</strong></span> ".$message['messages']['messages'];
								    	}else{
                                         echo $message['messages']['messages'];
								    	}
                                       
								    }?>
							</div>
						    <div id='after_pay' style='display:none'>
									    <?php
									       echo $message['messages']['messages'];
									    ?>
						    </div>
						    <?
                     }//seller
			         else{//buyer
				           echo $message['messages']['messages'];?>
				           
				           <span class="seller_loc"><?=$buyer_loc?> </span>
				          
				<? }//buyer
				 ?>
			<!-- </p> -->
              <span style='float:right;padding: 0 0px!important' class="readmsg">
				            <?if($message['messages']['user_id']!= $quoted_user){//buyer
                                    echo $read_status; 	}
                              ?>       	
            <span>
		</div>
		                <div class="clear"></div>
	</li>
				<?php 
			    }?>
				<?}
				else{//no previous chats or prelogin case
				
                      if($client_status =='online'){
			                           $status_src="/img/chat_online.png";
			                           $status_on="<i>online</i>";
								 }
								 else{
								 	 $status_src="/img/chat_offline.png";
			                           $status_on="offline";
								 }
								 ?>
                      <li class="client" style='overflow: hidden; outline: none;'>
                      			<a  class="time img_chat" title="" style="float:left">
										<img class="img-circle" src="/img/avatars/buyer.png" alt="Profile" style=""></a>
								<div class="sdcht pull-right">
											    	<span class="chat-user-status"> 
								 <img  src="<?php echo $status_src;?> " alt="<?php echo $username;?>"> <?  echo $status_on; ?>
								 </span>
								<span class="time label label-success" >
										<?php 
										 if($browser!= "Safari"){
									     	echo $this->Time->format($enquiry_time,'%l:%M %p, %e %b %Y, %a ');
									     }
										?>
								</span>
	           </div>	
										<div class="message-area" style="cursor: not-allowed;">
										<span class=""></span>
											<div class="info-row">
													<span class="user-name" style="font-weight: bold;">
																<strong>
																<?if($guest_flag==0){?>
																<a ><b>Customer (<?=ucfirst($buyername)?>)</b></a>
																<?}else{?>
																 <a ><b>Customer </b></a>
																<?}?>
																</strong>
								<span class='mbchat' style='background-color: #0393f3;border-color:#0393f3;font-weight: normal;'>
				                <span  class="glyphicon glyphicon-earphone xwhite" > </span>  
                                 <a class='change_mask_word' >View Customer Number
                                </a>
				                 </span>
													 </span>
													<span class="time label label-success" id="1219"></span>
												    <?echo  nl2br($mask);?>
							<?if($quantity!=''){
											                 	echo"<span class='_qntp'><span class='_qnth1'>";echo "<strong>Quantity:</strong> ".$quantity;
													
															}
								                            if($budget!=''){
								                            	echo"<br>";echo "<strong>BUDGET:</strong> Rs. ".$budget;
															 echo"</span></span>";
															}
								                            ?>
													<div class="clear"></div>
											</div>
										</div>
						</li>
			          <?
				}
				?>
            </ul><!--sdchatmsg-->
               <?
					if ($quoted_user != $clientID) { 
						         if($buyers_status !=1){
                                if($disable==''){
                                                if($receiver !=''){//loggedin
													echo $this->element('chat_pkg_details');
						                         }
						                         else{
						                         	echo $this->element('chat_pkg_details');
						                         } 
							}//disable
						}
				}//seller
			
?> 

  <div id="loading_chat_green_image" class="loading_chat_green_image" style="display:none;margin-top: -21px;margin-left: 600px;"> 
    <img src="<?=$cloudfront_imgall?>/img/loading_company.gif"  alt="loading" title="loading" style="max-width: 20px;display: inline-block;">
    </div>
               <? if($credit_balance >=0){?>

         <?
     if(($today >= $expiry_date)|| ($quote_status ==5)){}else{    	
         if($disable==''){?>
                  
<div id='after_contact_pay1' class='message-entry msgnot pad28 nit_close'  style='display:none'>
    <span class='closclscnt' onclick='close_contact()'>X</span>
    <span id='before_pay_head' class='contact_chat_credit' ><span class='xyellow'> 
        <b> Your Balance=  <?=$credit_balance?> Credits</b></span>
        
        <? if($contact_prio<5){?>
        
    <span id='before_pay_det' class='col-xs-4 padding-0 view_num' style="margin-left:1px" onclick="<?if($seller_prio<=5){?>chat_flip_info_main_test()<?}?>">View  <i class='dskhide'><br></i>Number</span>
     <?}?>
    </span>
</div>       
			                      
					                                                  <?}//disable
					                                         }
					                                         }?>   
              <?
                if ($buyers_status !=1) {
					                  		  	if($quoted_user != $clientID){
					                  	          }else{
					                  	                 $isbuyer=1;
					                  	                 $isquoteduser=1;
					                  	          }
			  }
			  else{
			        $isbuyer=1;
			  }	                  	          
           ?>	
	            <div class="message-entry message-entry-for-bg-chng" >
         
            <span id="chat_msg_error" style="display:none">* Enter the chat messages.</span>
             <span id="logged_msg_error" style="display:none">* (Click above)..</span>
             <div id="type-status-<?php echo $serverid; ?>" class="receiver-chat-status"></div>
             <div id="type-status"></div>
                 <?php 
                 	
                 		if(($today >= $expiry_date)|| ($quote_status ==5)){
                      
                 		    $pausedexpired=1;
                 
                 	}//expired or paused or irrelevant cat/loc
                  else{
				                  	if ($quoted_user != $clientID) {
							                  		  	if($buyers_status !=1){
							                  	                                if($disable==''){
							                  	                                	if(($leads_down == 1)||($leads_down == 2))
							                  	                                	{//paid
											                 	 	?>

											                 <input type="textarea" autocomplete="off" placeholder="Type Your Message Here ... " id="before_pay_but_paid" class="type-a-message-box input-sm" name="message" /> 
											                 <?  
							                                                 }//paid
				                                                 else{
				                                                 	//if($credit_balance >= $category_credits){?>
                                                 		<input type="textarea" autocomplete="off" placeholder="Hi, <?=$sid_vendorname?> Here. We would like to help you!" id="before_pay_but" class="type-a-message-box input-sm" name="message" value="Hi, <?=$sid_vendorname?> here. We would like to help you!"/> 
<?if($sid_id=='SID69cb828'){?>
<div class='glyphicon glyphicon-paperclip' id="show_attach">
<div id="attach_ins" style="display:none;margin-bottom: 2px">

</div>
</div>
<?}?>
				                                                 	 
				                                                 	<?
				                                            
				                                                 }

							                                                   }
							                            }
							                            else{
							                            
							                            }
				                      }
				                      else{
				                      	
				                      }
				                    
                      }//live
                      if($receiver ==''){//not   logged in case
                      if($pausedexpired ==''){?>
                      <a id="quoteseller_loginbutton" data-target="#login-popup-vendors" data-toggle="modal">
                      	<input  type="textarea" placeholder="Start Chat & Get Contact Info ... "  class="type-a-message-box input-sm" name="message" /> 
                      	 <div class="chat_button">
                      	<input type="submit" style=""  name="send-message"  class="btn btn-primary" value="Send" style="float:left;margin-left:200px;margin-bottom: -14px;"/>
                      	</div>
                      	</a>
                    <? }
                     }
                      if($isbuyer==1){
                               $msg_buyer="Please note that only Xerve Seller Accounts can Connect with Customers; 
                                                  you are currently Logged-In to Xerve as a Buyer.";
                              	if($isquoteduser==1){?>
                                  <div style="margin-left:4px;margin-top: 2px"> 
                                  </div>
                              	<?}
                              	else{ 
                                       if(($today >= $expiry_date)|| ($quote_status ==5)){}else{
                                    
               
                   						 }//live cases      
                     			} //is buyer not 1
                          
                         }//for buyers
                  if(($today >= $expiry_date)|| ($quote_status ==5)){ //paused or expired 
                        $pausedorexpired=1;
	                    if($quote_status ==5){//paused
								                $pausetime=$this->Time->format($pause_time, '%l:%M %p, %e %b %Y, %a ');
								                    if ($quoted_user != $clientID) {
								                     	$paused_status="<strong>Note: </strong> Chat is Unavailable for this Enquiry as it has been Paused by the Customer at ".$pausetime;
								                    }//seller
								                    else{
								                     	 	$paused_status="<strong>Note: </strong> It has been paused by ". $clientNAME." at ". $pausetime;
								                    }//buyer
		                }//paused
		                else{
	                        $paused_status="<strong>Note: </strong> Chat is Unavailable for this Enquiry as it has Expired";
	                    }//expired
                             if($disable==''){
	                         echo"<span class='msgnote' style='font-weight: bold;margin-top:40px;padding:37px 0px;display:inline-block'>";
	                     	                      echo $paused_status;
	                     	 echo"<span>";
	                     	 }
                    }// eof paused or expired 
                    if($receiver !=''){//logged in case
						                 if($isbuyer==1){//buyer
							                 	echo"<span class='msgnote' style='font-weight: bold;margin-top:20px;padding:37px 0px;display:inline-block'>";
							                     echo $msg_buyer;
							                     echo"<span>";
						                }//eof buyer
						                else{//seller
						                }//eof seller
	                }//eof logged in case
	                else{//not logged in

                              if($pausedorexpired!=1){?>
                             <? }
	                }
	                //$pausedorexpired=1
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
			 <input type="hidden" id="buyers_status" name="buyers_status" value="<?php echo $buyers_status;?>">
			 <input type="hidden" id="buyer_gender" name="buyer_gender" value="<?php echo $buyer_gender;?>">
			 <input type="hidden" id="buyername" name="buyername" value="<?php echo ucfirst($buyername);?>">
			 <input type="hidden" id="disabled" name="disabled" value="<?php echo $disable;?>">
			 <input type="hidden" name="loginvendor" id="loginvendor" value="0">
			 <input type="hidden" id="disabled" name="disabled" value="<?php echo $disable;?>">
			 <input type="hidden" id="budget" name="budget" value="<?php echo $budget;?>">
			 <input type="hidden" id="quantity" name="quantity" value="<?php echo $quantity;?>">
			 <input type="hidden" id="check_logged_user" name="check_logged_user" value="<?php echo $check_logged_user;?>">
			 <input type='hidden' id='chat_msg_time' value='<?=$chat_msg_time?>'>
			 <input type='hidden' id='contact_prio' value='<?=$contact_prio?>'>
			 <input type='hidden' id='genie_url' value='<?=$genie_url?>'>
			 <input type='hidden' id='free_credits' value='<?=$free_credits?>'>
			 <input type='hidden' id='client_status' value='<?=$client_status?>'>
			 <input type='hidden' id='server_status' value='<?=$server_status?>'>
				  
                </div><!-- send-group-->
                   <div class="chat_button">
                   <?php
                   if(($today >= $expiry_date)|| ($quote_status ==5)){}	
                  	else{
                  		  if ($quoted_user != $clientID) {
                  		  	if($buyers_status !=1){
                  		  		if($disable ==''){
                  		  			   if(($leads_down == 1)||($leads_down == 2)){
                  	?>
      <input type="submit" style=""  name="send-message" id="sendMessage" class="btn btn-primary" value="SEND" style="float:left;margin-left:200px;margin-bottom: -14px;"/>
                 <?php //}?>
           <input type="submit" style="display:none" name="send-message" id="sendMessage_sub" class="btn btn-primary " value="SEND"  >
                     <?}//paid
                        else{
                             ?>
                	<input type="submit" style=""  name="send-message" id="sendMessage" class="btn btn-primary" value="SEND" style="float:left;margin-left:200px;margin-bottom: -14px;"/>
                        <?
                       
                        }//not paid
                       }//not for invstors
                      }// not buyer
                         }//not quote placed user
                         }
                    ?>
                </div><!-- message-entry -->
				</div>
  </div>
	      </div>		  
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
<div class="clearboth"></div> 
     </div>
     </div>
    </div><!--container -->
