<?php   
//Configure::write('debug',2);
//echo $this->Html->css('jquery-ui');
echo $this->Html->css('displaybuttons');
echo $this->Html->css('alertify.min');
//echo $this->Html->css('colorbox');
echo $this->Html->css('jChat');
//echo $this->Html->css('Enquiry_style');

//echo $this->Html->script('jquery.min');
//echo $this->Html->script('bootstrap.min');
echo $this->Html->script('alertify.min');

//echo $this->Html->script('jquery.colorbox');
echo $this->Html->script('jquery.nicescroll');//not in server
//echo $this->Html->script('jquery-ui');
echo $this->element('login_vendors');//login
echo $this->element('leads_form');//login
echo $this->Html->script('leads_details_after_login');
?>



 <!-- link to add new quotes page -->

<style>
	body {

		color: #000000;

	}
	p{
		font-size: 16px;
	}
	
</style>

<div class="vendor_enquiry ">
    
			<?php 

			

			  //echo $user_id;

			   if(count($chat_intro)==0){
			   	 $introheader=" Introduce yourself to customers";
			   	 $intro_button="btn btn-primary active";
			   	 //$intromsg=$chat_intro[0]['messages']['messages'];
			   }
			   else{

			   	$introheader= "My Introduction";
			   	$intromsg=$chat_intro[0]['messages']['messages'];
			   	$intro_button="btn btn-primary disabled";
			   }
			
         
			  	$view_details_nocredit="<b> Pricing: Note: 1000 Credits = Rs. 1000</b> | <b><a target='_blank' style='text-decoration: underline;color: #0c93f3;'href=https://xerve.in/pricing>View Packages & Details</a></b>)";

			   

			   if($quotes['Lead']['b2c']== 1)
			    {
			   //	$type="Individual";
			   		
			   	$min_credit=$category_credits;
			   	
			   }
			   else
			    {
			   //	$type="Business ";
			   	
               $min_credit=$category_credits;

			    }
			  //  echo $category_credits;
 $parts=explode("/",$backpath);
 $seller_part=$parts[3];//getting sender id if request coming from chat page

echo "<div class='sd_panel sd_panel-info'>
<div class='panel-body padding-0'>";  
  

   echo"<p></p>";
	
	/*Credit Contact, Chat*/
	echo"<div class='leads-popup-hold'>";
    echo"<div class='row'>";
     
    echo"<div class='leads_ct col-md-6 col-xs-12'>";
    
    $today = date('Y-m-d');
    echo" <input type='hidden' id='today' value='<?=$today?>'>"; ?>
    <input type='hidden' id='min_credit' value='<?=$category_credits?>'>  
  

	<?echo"<div class='quote-detail-chat-info'>";
	/*chat window*/
	?>
	
	<div class='qut-lead-buyer' style="border:none">
	 <input type="hidden" id="User_Id" value="<?=$User_Id?>">
	  <input type="hidden" id="user_id" value="<?=$User_Id?>">
	  <input type="hidden" id="enquiry_id" value="<?echo $quotes['Lead']['enquiry_id'];?>">

	  <input type="hidden" id="b2c" value="<?php echo $quotes['Lead']['b2c'];?>">
	    <input type="hidden" id="quoteid" value="<?php echo $quotes['Lead']['quoteid'];?>">
	     <input type="hidden" id="serverid" value="<?php echo $quotes['Lead']['user_id'];?>">
	     <input type="hidden" id="sid_id" value="<?php echo $sid_id;?>">
	     <input type="hidden" id="productspec" value="<?php echo $quotes['Lead']['productspec'];?>">
	
	     <?if($sid_id != ''){?>

	        <div class='Quotes-lead-buyer' style='margin-top: 2px'>

			Enquiry For: <i class="tithd"><?=$sid_vendorname?></i>

			</div>
          <?}?>
	    
			<!--<div class='Quotes-lead-buyer' style='margin-top: 2px'>

			Enquiry Id: <i><?echo $quotes['Lead']['enquiry_id'];?></i>

			</div>-->
			  <div class='panel-body quotes_chathead'>
			
			       <div class="contentchat" id="contentchat">
			       <input type="hidden" id="sellers_category" value="<?=$check_seller_category?>">
			            <ul class="detail-messages-layout">
			                 <li class="<?php echo $class;?>" >
		                                           
										<div class="message-area">

													   <span class="user-name" style="margin-bottom:6px">
															<strong>Customer Requirement </strong>

													   </span><!--user-name -->
													
													   <div class="info-row">
													  
														<div>
														
										
														
														<div class='qut-lead-sd-msg' style='overflow: auto;max-height:100px'>


															<span id="customer_req" style="font-size: 16px">
																	 <div class="sd_arrow1"></div>
															
									 										<?php
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

																				
																
																			?>
															</span><!--customer_req-->
							                                <span id="spec" style="display:none;white-space: pre-line;">
							                                     <?
									                               	echo trim(nl2br($quotes['Lead']['productspec']));

							                                    
							                                     ?>
							                                     	
							                                </span><!--spec -->
																
												
											
												</div><!--qut-lead-sd-msg -->

												
											  <!--</div>-->
											
										</div><!-- message-area -->
		
							</li>

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
							
 
							      <?	 if(($user_id != $quoted_user)){ //updated 01-06-17 restricting buyers
							      				// print_r($last_msg);
							      				// echo $last_msg[0][a][intromsg];
											   if(count($last_msg) > 0)
										       {		
										         if($last_msg[0][a][intromsg]!=2) {?> 
													   <li class="<?php echo $class;?>" >
								                         
														 		<?echo $this->element('leads_details_lastmsg');  ?>		  
																					
													   </li>
							  			 <?php }//dont show client requirement
										       } //last reply message
										   }//restricting buyers//

											 ?>


			            </ul> <!--messages-layout -->


			       </div> <!--contentchat -->
			</div> <!--panel-body -->

</div><!--panel-info -->
<?php
	/*chat window*/

//if(($today > $quotes['Lead']['buyingdate'] )){

	$expiry_date=$quotes['Lead']['buyingdate'];
	$expiry_date= date('Y-m-d', strtotime($expiry_date. ' + 1 days'));
  
if($quotes['Lead']['status']==0 ){

}else{
	if($user_id != $quoted_user){ 
		//condition to be set here
		//echo "not the quote placed user";
		if($buyerstatus ==0){
			//echo "seller";
	echo"<div class='quote-detail-chat-info'>";
	
    				if($user_id)	{//logged in

    					     
    					

    					    if(($today >= $expiry_date )||($quotes['Lead']['status'] == 5)){

    					       if(($leads_down == 1)||($leads_down == 2)){?>

    					      <a  id='viewdetails_before_login'  href='/leads/chat/<?php echo $quotes['Lead']['user_id'];?>/<?php echo $quotes['Lead']['enquiry_id'];?>' target='_blank' class='btn btn-info sd_dt_ldreplybtn2' style='background:#3f51b5;margin-bottom: 5px;margin-top: 5px;'>VIEW DETAILS</a><br/>
    					      <? }
    					      echo $this->element('leads_details_status');  		 
                             // echo $info_status_pause;

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
							    	
	    
									
										 <!--<a  href='/leads/chat/<?php echo $quotes['Lead']['user_id'];?>/<?php echo $quotes['Lead']['enquiry_id'];?>' 
								            id='checkbutton_next' class='btn btn-info sd_dt_ldreplybtn' target='_blank' style=''>
								            CONTACT CUSTOMER NOW WITH <?=$category_credits?>  CREDITS</a>-->

										<?php 
									 echo $this->Form->create('Quotebid');	
								     
										//if($quotes['Lead']['status']==1){

													if(($leads_down == 1)||($leads_down == 2)){

													/*With Credits and paid*/
												   ?>
												    <div id="startchat">
										           

								<?//echo $sid_id;?>		            
										             <?if($sid_id != ''){?>

										            <a  id='checkbuttonsid' target='_blank' class='btn btn-info sd_dt_ldreplybtn2' style=''>CONTINUE CHAT WITH CUSTOMER</a>
										             <?}else{?>
										                  <a  id='checkbutton' target='_blank' class='btn btn-info sd_dt_ldreplybtn2' style=''>CONTINUE CHAT WITH CUSTOMER</a>
														<?}?>		
										            </div>
										           <?php 
										           /*with credits and not paid*/
										       		}else{?>

										       		 <div id="paytochat">
									 <a  href="#" id='contact_client_pay' target='_blank' class='btn btn-info sd_contact_client_pay' style='background:#3f51b5;    margin-top: 3px'>
										       		 CONTACT CUSTOMER NOW  </a>

									<a  href='/leads/chat/<?php echo $quotes['Lead']['user_id'];?>/<?php echo $quotes['Lead']['enquiry_id'];?>' 
								            id='checkbutton_next' class='btn btn-info sd_dt_ldreplybtn' target='_blank' style='margin-top:15px;display:none;position:relative;z-index:99;'>
								            CONTACT CUSTOMER
								    </a>
                                         
										       		  
																      <?php
																      $balance=$credit_balance-$category_credits;
																     // echo"<p class='sd_ur_creditbal'>";
																      echo"<div id='before_contact_no_pay' style='margin-top:15px;margin-bottom:15px;font-weight:bold;font-size:16px;color:#009925'>";
																      echo " Your Credits Balance: ".$credit_balance;
																      echo"</div>";
																      echo"<div id='after_contact_pay' style='display:none;color:#009925'>";
                                                                      //echo "Credits Deployed: ".$category_credits;
																      echo "<br>Your Credits Balance: ".$balance;
                                                                      echo"</div>";
                                                                      echo"<div id='after_contact_pkg'>";
																      echo $this->element('leads_pkg_details');
																      echo"</div>";
																      ?>
										       		 </div>
												<?php
											   }//has paid for the lead or not
										//}//live lead
										
										?>
										
								    <?php
	  									 
			                 } //has credits

			             }//live
						} // logged in
						else{?>
							<!--not logged in-->
							 <!--<a href="#" id="quoteloginbutton" class="btn btn-info sd_dt_ldreplybtn2" data-target="#login-popup-vendors" data-toggle="modal">CONTACT CUSTOMER NOW WITH <?=$min_credit?>  CREDITS</a>-->
                             <div class ="quotestcbtn">

                              <a  href="#" id='contact_client_pay_login' target='_blank' class='btn btn-info sd_contact_client_pay' style='background:#3f51b5;display:none;margin-top:5px'>CONTACT CUSTOMER NOW WITH <?=$min_credit?> CREDITS </a>

						        <a  id='checkbutton_login'  href='/leads/chat/<?php echo $quotes['Lead']['user_id'];?>/<?php echo $quotes['Lead']['enquiry_id'];?>' target='_blank' class='btn btn-info sd_dt_ldreplybtn2' style='background:#3f51b5;display:none;margin-top:5px'>CONTINUE CHAT WITH CUSTOMER</a>

						         <a  id='viewdetails_login'  href='/leads/chat/<?php echo $quotes['Lead']['user_id'];?>/<?php echo $quotes['Lead']['enquiry_id'];?>' target='_blank' class='btn btn-info sd_dt_ldreplybtn2' style='background:#3f51b5;display:none;margin-top:5px'>VIEW DETAILS</a>

                                  <input type="hidden" id="leads_credits_balance" name="leads_credits_balance" >  
						         <div id='instalogin_credits' style="display:none;margin-top:5px;font-weight:bold;color:#009925">
						             <!--<div id="instalogin_credits_heading">Your Lead Credit Balance is :</div>
						              <div id="instalogin_credits_value"></div>-->
									  
								 </div>

                                  <?php
							echo"<div id='status_visible' style='margin-bottom:5px'>";
											if(($today >= $expiry_date )||($quotes['Lead']['status'] == 5)){?>

				    					      <!--<a  id='viewdetails_before_login'  href='/leads/chat/<?php echo $quotes['Lead']['user_id'];?>/<?php echo $quotes['Lead']['enquiry_id'];?>' target='_blank' class='btn btn-info sd_dt_ldreplybtn2' style='background:#3f51b5;margin-bottom: 5px;margin-top: 5px;'>VIEW DETAILS</a>-->
				    					      <br/>
				    					     <? 
				    					      echo $this->element('leads_details_status'); 
				    					      if($is_link==0){
				                                      $info_status_pause= "[by ".$paused_username." at ".$pause_time."]";
						                        }
						                    else{ 

						                            $quote_placed_user=$quotes['Lead']['user_id'];//user id
						                            $info_status_pause="[by <a  data-target='#know-more-popup' data-toggle='modal' onclick=CompanyPage($quote_placed_user,'2','','insurance','plansmart-financial','XRV$quote_placed_user') style='color:#ff0000;cursor:pointer'><u>".$paused_username."</u></a> at ".$pause_time."]";


						                       }?>
											  <p id='info_status_pause' style='color:#ff0000;display:none'><?=$info_status_pause?></p>		       		 


				    					   <? }//paused or expired leads after login


							        echo"</div>";?>
                                  <? //echo $quotes['Lead']['status'];
                                     //echo $today;
                                     //echo $expiry_date;

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
															     // echo"<p class='sd_ur_creditbal'>";
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
	 }  //for sellers only
	// echo "buyer";
	} // not a quotted user
	// echo "quote placed user";
}//live lead
     echo"</div>";
	//}//live lead
	echo"</div>";//row

	?>
   
	
	
				<?php 
                      
					
				 
	echo"<div class='sd_leads_det col-md-6 col-xs-12'>";
	

	echo "<div class='leads_det leads-pop-des'>";

 /*Bread Crumb Starts*/
   echo $this->element('leads_details_crumbs');
   /*Bread Crumb Ends*/
	echo $this->element('leads_right_side');
  echo"</div>";


/**********************quotedetails***************************************/	
 // echo"</div>";//left-vendor
  
	


 echo" </div>";//leads-popup-hold

	
   echo" </div>";

   echo"</div>";
   echo"</div>";	
  


	
?>
</div><!--panel body-->
</div><!--panel-->
</div><!--vendor-enquiry-->



<script type="text/javascript">
$(document).ready(function(){


	/*("ul.detail-messages-layout").niceScroll({touchbehavior:false,cursorcolor:"#ddd",cursoropacitymax:0.6,cursorwidth:8,boxzoom:true, autohidemode:true});
    
   	   toScroll = $("ul.detail-messages-layout");
	  $("ul.detail-messages-layout").animate({ scrollTop: toScroll[0].scrollHeight }, 'slow');  */


$('[data-toggle="tooltip"]').tooltip();//tooltip for prices and offers
	//$(".group1").colorbox({rel:'group1',width:"50%", height:"60%",transition:"fade"});
    $("#load-wait").hide();
  
    $("#show_contact").hide();
    $("#demo").hide();
    $("#demo_quote").hide();
    

});//onready

</script>
<script type="text/javascript">	
//if submit button clicked without alteration in value
$("#quoteupdate").click(function(event){
   
    var formid=('#form_id').val();
	if(formid == 0){ //for quote based enquiry
						var buyertype ="<?php echo $quotes['Lead']['b2c'];?>";
					     
					     if(buyertype == 1) {
					     	
							 var newprice = $("#price").val();
							 var oldprice = $("#chkquoteprice").val();
							 //event.preventDefault();
							 if (newprice == '') {
								 alertify.alert('Enter a Price');
							 }
							 if (newprice == oldprice) {
								 alertify.alert('You are quoting with the same price');
								 $('form').get(0).reset();
								 return false;
							 }
						 }//buyertype
					}//store based enquiry
	});
	/*Not used as admin is doing the insert process*/
	$("#quoteinsert").on('click keypress',function(e){
        
		var formid=('#form_id').val();
	if(formid == 0){ //for quote based enquiry
					var buyertype ="<?php echo $quotes['Lead']['b2c'];?>";
					var message=$("#intromessage").val();
						if(message == '')
						{
						 
						 alertify.alert("Enter Valid Messages");
			             return false;		 
						}	
					if(buyertype == 1) {
						var newprice = $("#price").val();
						var oldprice = $("#chkquoteprice").val();

						/*if (newprice == '') {
							alertify.alert('Enter a Price');

							return false;
						}*/
					}//buyertype
				}//store based enquiry
	
	});
	
</script>	


 <script type="text/javascript">
   
   		$("#vendor-intro").on('click',function() {
							   
			 var message=$("#intromessage").val();
			
			 var quoteid="<?php echo $quotes['Lead']['quoteid'];?>";
			 var userid="<?php echo $user_id;?>";
			

			 $("#message").val("");           
             
		 if(message == '')
			{
			 
			 alert("Enter Valid Messages");
             return false;		 
			}	
			
			if (quoteid) {
			var dataString = 'message='+ message+'&quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid;
			
			
				
				$.ajax({
					
					type: "POST",
					url: '<?php echo Router::url(array("controller" => "leads", "action" => "chatintro")); ?>',
					data: dataString,
					cache: false,
					async: false, //blocks window close
					success: function(data,textStatus,xhr){ 
					
					
					$("#chat-vendor").show();
					$("#vendor-intro").hide();
								
					
					} //success
					 
				});//
			}	//if quote
		});

$("#checkbutton").on('click',function(e){
	var check_seller=$("#sellers_category").val();
	 
	if(check_seller == 0){
		// alertify.alert('Please Choose a Different Category');
		 $("#category_block_reason").show();
		 return;
	}

	var sub_url = "/leads/chat/<?=$quotes['Lead']['user_id']?>/<?=$quotes['Lead']['enquiry_id']?>";
    window.open(sub_url, '_blank');	

});

$("#checkbuttonsid").on('click',function(e){
	var check_seller=$("#sellers_category").val();
	 
	if(check_seller == 0){
		// alertify.alert('Please Choose a Different Category');
		 $("#category_block_reason").show();
		 return;
	}
	//href='/leads/chat/<?php echo $quotes['Lead']['user_id'];?>/<?php echo $quotes['Lead']['enquiry_id'];?>' 
	var sub_url = "https://www.xerve.in/leads/chat/<?=$quotes['Lead']['user_id']?>/<?=$quotes['Lead']['enquiry_id']?>/<?=$sid_id?>";
	console.log(sub_url);
    window.open(sub_url, '_blank');	

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

	//var b2c ="<?php echo $quotes['Lead']['b2c'];?>";
	var userid="<?php echo $user_id;?>";
    //var quoteid="<?php echo $quotes['Lead']['quoteid'];?>";
    //var enquiry_id="<?php echo $quotes['Lead']['enquiry_id'];?>";
    //var serverid="<?php echo $quotes['Lead']['user_id'];?>";//receiving user

    var b2c =$("#b2c").val();
    var quoteid=$("#quoteid").val();
    var enquiry_id=$("#enquiry_id").val();
    var serverid=$("#serverid").val();
    var sid_id=$("#sid_id").val();

     var dataString = 'type='+ b2c+'&quoteid='+quoteid+'&userid='+userid+'&serverid='+serverid+'&enquiry_id='+enquiry_id;
			
			
		 e.preventDefault();

		          if(sid_id ==''){
		         var sub_url = "/leads/chat/<?=$quotes['Lead']['user_id']?>/<?=$quotes['Lead']['enquiry_id']?>";
		         }else{

		     	 var sub_url = '/leads/chat/'+serverid+'/'+enquiry_id+'/'+sid_id;
		     	 console.log(sub_url);
		       }


                 var win=window.open(sub_url, '_blank');

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
					$("#after_contact_pay").show();	
					$("#contact_client_pay").hide();
					$("#after_contact_pkg").hide();
					$("#checkbutton_next").show();
	                win.focus();
                //location.reload();	
               
					
/*window.location = '<?php
 //echo $this->Html->url(array("controller" => "leads", "action" => "chat", $quotes['Lead']['user_id'],$quotes['Lead']['enquiry_id']));
 ?>';*/
 
							
 
					}, //success
					async: false, 
				});//ajax
			}//e.detail
				
	});

$("#contact_client_pay_login").on('click',function(e){

if(!e.detail || e.detail == 1){	
	var b2c ="<?php echo $quotes['Lead']['b2c'];?>";
	var userid=$("#User_Id").val();
	var pre_balance=$("#leads_credits_balance").val();
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
							         var sub_url = "/leads/chat/<?=$quotes['Lead']['user_id']?>/<?=$quotes['Lead']['enquiry_id']?>";

                                      var win=window.open(sub_url, '_blank');	
							       //  var win = window.open("http://google.com", '_blank');
  
									 $.ajax({
										
										type: "POST",
										url: '/leads/contact_client',
										data: dataString,
										cache: false,
										//async: false, //blocks window close
										success: function(data,textStatus,xhr){ 
										 win.focus();
										// location.reload();

										 $("#checkbutton_login").show();//chat button
								         $("#contact_client_pay_login").hide();//contact button
									     $("#chat_visible").hide();

									     $("#instalogin_credits").show();
 										 $("#instalogin_credits").text('Your Credits Balance: '+post_balance);
					                   

										 
										} //inner success
										 
									});//inner ajax
							}//else(for same category of sellers)

				
					} ,//outer success
					async:false,
					 
				});//outer ajax
				


  }//e.detail

		 
				
	});//onlick

     function check_lead_pay(){

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
	
	<!-- login prompt  -->

	



<!-- login prompt  -->