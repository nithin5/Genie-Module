<?
$today = date('Y-m-d');
$expiry_date=$quotes['Lead']['buyingdate'];
	 if($quotes['Lead']['b2c']== 1){
		$type="Personal";
	}
	else
	{
		$type="Business";
	}?>
<div class='col-md-6 col-xs-12 padding-0'>
<div class='quote-contents-right-vendor pull-left' style='background:#fff'>
<div class='leads_det leads-pop-des'>
<?
echo "<ul class='leads-pp-list leads_details'>";?>
<li id="category_block_reason" class="col-xs-12 padding-0" style="display:none">
	<p>
	<?	$fullname=explode(" ",$Vendor_Name);?>
	 <div id='full_name'>Dear <?=ucfirst($fullname[0])?> <?=ucfirst($fullname[1])?></div>
	 <div id='full_name_ajax' style='display: none;text-transform:capitalize;'></div>
	 <br/><br/>
	Please note that Your Xerve Account cannot Submit Info, Proposal and Quote for this Enquiry as Your Category/Location does not match with the Customer's Requirement/Location.<br/><br/>

	We request you to assist other relevant <a style='color:#0c93f3;font-size: bold' href='https://xerve.in/leads' target="_blank">Requests for Proposals</a>.<br/><br/>

	Thank you.<br/><br/>

	Best Regards,<br/>
	Xerve Team.
	</p>
</li>
<?	
if(isset($quotes['Lead']['enquiry_id'])){
	echo"<li>";
    echo "<span class='leads-list-hd'><b>Enquiry Id: </b></span><span class='leads-list-des'>".$quotes['Lead']['enquiry_id']."</span>";
    echo"</li>";
}
if(isset($quotes['Lead']['b2c'])){
	echo"<li>";
    echo "<span class='leads-list-hd'><b>Requirement Type: </b></span><span class='leads-list-des'>".$type."</span>";
    echo"</li>";
}
if(isset($quotes['Lead']['productspec'])){
	echo"<li>";
    echo "<span class='leads-list-hd'><b>Customer Requirement: </b></span><span class='leads-list-des'>";
   		if($credit_enabled == 0){
						echo trim(nl2br($mask));
		}
		if($credit_enabled > 0){
                if(($leads_down ==1)||($leads_down ==2)){
                	echo trim(nl2br($quotes['Lead']['productspec']));
                }
                else{
			       			 echo trim(nl2br($mask));
			       	}
		}
    echo"</span>";
    echo"</li>";
}
if(isset($quotes['Lead']['budget'])){
	echo"<li>";
				if(($sel_cat_id ==80)||($sel_cat_id ==88)){
					 echo "<span class='leads-list-hd'><b>Budget(Per Head): </b></span>";
					}else{
						 echo "<span class='leads-list-hd'><b>Budget: </b></span>";
				}
			    echo"<span class='leads-list-des'>";
			    echo  "Rs. ".$quotes['Lead']['budget'];
			    echo"</span>";
    echo"</li>";
}
if(isset($quotes['Lead']['quantity'])){
	echo"<li>";
			if(($sel_cat_id ==80)||($sel_cat_id ==88)){
			 echo "<span class='leads-list-hd'><b>Group Size: </b></span>";
			  }else{
			  	 echo "<span class='leads-list-hd'><b>Quantity: </b></span>";
			  }
	        echo"<span class='leads-list-des'>";
	   		echo $quotes['Lead']['quantity'];
			echo"</span>";												
    echo"</li>";
}
if(isset($CategoryName[0]['offer_categories']['category_name'])){
    echo"<li>";
	echo "<span class='leads-list-hd'><b> Category: </b></span><span class='leads-list-des'>".$CategoryName[0]['offer_categories']['category_name']." </span> ";
	echo"</li>";
}
if(isset($SubCategoryName[0]['sub_categories']['sub_category_name']))	{
	 echo"<li>";
	echo "<span class='leads-list-hd'><b>Sub-Category: </b></span>
	<span class='leads-list-des'>".$SubCategoryName[0]['sub_categories']['sub_category_name']."</span>";
	echo"</li>";

}
if($quotes['Lead']['enquiry_time']){
	echo"<li>";
	echo "<span class='leads-list-hd'><b>Enquiry Date & Time: </b></span>  ";
	echo"<span class='leads-list-des'> ";
	echo $this->Time->format($quotes['Lead']['enquiry_time'], '%l:%M %p, %e %b %Y, %a ');
	echo"</span>";
	echo"</li>";
}
if(isset($quotes['Lead']['city_buy'])){
	        if($quotes['Lead']['zone_buy'] !=''	){
	        	$need_quotes_from = $quotes['Lead']['zone_buy'].', '.$quotes['Lead']['city_buy'];
	        }else{
	        	$need_quotes_from=$quotes['Lead']['city_buy'];
	        }
}
if(isset($quotes['Lead']['city'])){
		    if($quotes['Lead']['zone'] != ''){
	        	$my_loc = $quotes['Lead']['zone'].', '.$quotes['Lead']['city'];
	        }else{
	        	$my_loc=$quotes['Lead']['city'];
	        }
	echo"<li style='margin-bottom:5px'>";
	echo "<span class='leads-list-hd'><b> Customer Location: </b></span><span class='leads-list-des'>   ".$my_loc."</span>";
	echo"</li>";
}
if($quotes['Lead']['status']>0 ){
	if($clientID != $quoted_user){ 
		if($buyerstatus ==0){
			if($disable==''){
				if($check_seller_category !=0){
					echo"<div class='quote-detail-chat-info'>";
    				if($clientID)	{//logged in
    					    if(($today >= $expiry_date )||($quotes['Lead']['status'] == 5)){
    					       if(($leads_down == 1)||($leads_down == 2)){?>
    					      <a  id='viewdetails_before_login'  class='btn btn-info sd_dt_ldreplybtn2' style='background:#3f51b5;margin-bottom: 5px;margin-top: 5px;'>VIEW DETAILS</a><br/>
    					      <? }
    					      echo $this->element('leads_details_status');  		 
    					    }//paused or expired leads after login
     					    else{//live leads
 							    if($credit_enabled == 0){//no credits
								      echo"<p>";
								      echo"<a href='https://www.xerve.in/pricing' target='_blank'>";
								      echo"<button type='button'   id='buy_now' class='btn btn-info' style='background:#3f51b5'>BUY LEAD  CREDITS
								       & CONTACT CUSTOMER</button>";
								      echo"</a>";
								      echo"<p style='color:#0c93f3'>";
								      echo $view_details_nocredit;
								      echo"</p>";
								      echo"<p style='color:#009925'>";
								      echo " Your Credits Balance: ".$credit_balance;
								      echo"</p>";
								      echo"</p>";
								      echo"<p></p>";
								      echo $this->element('leads_pkg_details');
						    }//no credits
							else
							    { // has credits

							    ?>
						<?php  echo $this->Form->create('Quotebid');	
								if(($leads_down == 1)||($leads_down == 2)){
									/*With Credits and paid*/
								   ?>
								    <div id="startchat">
							            <?if($sid_id != ''){?>
							            <a  id='checkbuttonsid'  class='btn btn-info sd_dt_ldreplybtn2'>
							            CONTINUE CHAT WITH CUSTOMER
							            </a>
							             <?
							             }
							             else{?>
						                  <a  id='checkbutton'  class='btn btn-info sd_dt_ldreplybtn2'>CONTINUE CHAT WITH CUSTOMER
						                  </a>
										<?}?>		
						            </div>
						           <?php  /*with credits and not paid*/
						       	}
						       	else{?>
						       		<div id="paytochat">
									<a  href="#" id='contact_client_pay' class='btn btn-info sd_contact_client_pay' style='background:#3f51b5;    margin-top: 3px'>
										CONTACT CUSTOMER NOW  
									</a>
								    <br/><br/>
								    <a id='checkbutton_next' class='btn btn-info sd_dt_ldreplybtn'  style='margin-top:25px;display:none;position:relative;z-index:99;'>
								            CONTACT CUSTOMER
								    </a>
								    <?php
								      $balance=$credit_balance-$category_credits;
								
								      echo"<div id='before_contact_no_pay' style='margin-top:15px;margin-bottom:15px;font-weight:bold;font-size:16px;color:#009925'>";
								      echo " Your Credits Balance: ".$credit_balance;
								      echo"</div>";
								      echo"<div id='after_contact_pay' style='display:none;color:#009925'>";
                               
								      echo "<br>Your Credits Balance: ".$balance;
                                      echo"</div>";
                                      echo"<div id='before_contact_no_pay_msg'>";
                                 echo "Note 1: <?=$category_credits?> Xerve Lead Credits are required to Reply to this Customer Enquiry";
                                      echo "</div>";
                                      echo"<div id='after_contact_pkg'>";
								      echo $this->element('leads_pkg_details');
								      echo"</div>";
								      ?>
									</div>
									<?php
									   }//has paid for the lead or not
			                 } //has credits

			             }//live
						} // logged in
						else{ ?>
							<!--not logged in-->
                            <div class ="quotestcbtn">
                            <a  href="#" id='contact_client_pay_login' target='_blank' class='btn btn-info sd_contact_client_pay' style='background:#3f51b5;display:none;margin-top:5px'>CONTACT CUSTOMER NOW WITH <?=$min_credit?> CREDITS 
                            </a>
						    <a  id='checkbutton_login'   class='btn btn-info sd_dt_ldreplybtn2' style='background:#3f51b5;display:none;margin-top:5px'>CONTINUE CHAT WITH 
						    </a>
						    <a  id='viewdetails_login'  class='btn btn-info sd_dt_ldreplybtn2' style='background:#3f51b5;display:none;margin-top:5px'>VIEW DETAILS
						    </a>
                            <input type="hidden" id="leads_credits_balance" name="leads_credits_balance" >  
						    <div id='instalogin_credits' style="display:none;margin-top:5px;font-weight:bold;color:#009925">
							</div>
                            <?php
							echo"<div id='status_visible' style='margin-bottom:5px'>";
							if(($today >= $expiry_date )||($quotes['Lead']['status'] == 5)){?>
    					      <br/>
    					     <? 
    					      echo $this->element('leads_details_status'); 
    					      $info_status_pause= "[by Customer at ".$pause_time."]";
		                      ?>
							  <p id='info_status_pause' style='color:#ff0000;display:none'><?=$info_status_pause?>
							  </p>		       		 
    					   <? }//paused or expired leads after login
					        echo"</div>";?>
                            <? 
                            if(($quotes['Lead']['status'] == 1)AND($today < $expiry_date)){?>
							  <span class="col-xs-6 padding-0">
							  <a href="#" id="quoteloginbutton" class="btn btn-info sd_dt_ldreplybtn2" data-target="#login-popup-vendors" onclick="show_section('login')" data-toggle="modal" style="float:left;width:95%;margin-right: 2px;margin-top: 5px;">LOGIN TO CONTACT CUSTOMER</a>
                              </span>
                              <span class="col-xs-6 padding-0">
							   <a href="#" id="quoteregisterbutton" class="btn btn-info sd_dt_ldreplybtn2" data-target="#login-popup-vendors" onclick="show_section('join')" data-toggle="modal" style="float:left;width:95%;margin-top:5px!important;">JOIN TO CONTACT CUSTOMER</a>
							   </span>
							<?}?>
							</div>
						    <?
							if(($today >= $expiry_date)||($quotes['Lead']['status'] == 5)){
			                       	$chat_visibility="display:none";
			                }
			                else{
			                       		$chat_visibility="display:block";
		                    }		
                            echo"<div id='chat_visible' style='$chat_visibility'>";
						    echo $this->element('leads_pkg_details');
						    echo"</div>";
						      ?>
						<?}//not logged
	echo"</div>";
}
}//not disabled
	 } //for sellers 
	} //sellers
}
  echo"</ul>";
  ?>
</div><!--leads_det leads-pop-des -->
</div><!--quote-contents-right-vendor -->
</div> <!--col-md-6 col-xs-12 -->