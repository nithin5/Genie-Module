<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
<?php   
echo $this->Html->css('alertify.min');
echo $this->Html->css('colorbox');
echo $this->Html->css('jChat');
/*for carousal in pop up of seller*/
echo $this->Html->css('owl.carousel.css');
echo $this->Html->css('owl.theme.css');
echo $this->Html->css('owl.transitions.css');
echo $this->Html->script('jquery.min');
echo $this->Html->script('alertify.min');
echo $this->Html->script('jquery.colorbox');
echo $this->Html->script('jquery.nicescroll');//not in server
?>
<style>
	body {

		color: #000000;

	}
.ui-dialog .ui-dialog-titlebar-close span {
    display: block;
    margin: -8px;
}
	</style>
<!-- link to add new quotes page -->
<!--<div class='upper-right-opt'>-->
 <input type="hidden" id="view_value" value="<?= $Viewby ?>">
  <input type="hidden" id="tot_cnt" value="<?= $Viewby ?>">
<div class="buyer_enquiry sd-buyer_enquiry">
<?php 
  echo"<div class='leads-popup-hold'>";
  echo"<div class='row'>";
  echo"<div class='leads_ct col-md-6 col-xs-12'>"; 
 //echo $this->element('enquiries_crumbs');
echo "<div class='panel panel-danger' style='border:none;'>
<div class='Quotes-lead-buyer'>My Enquiry: <i>". $quotes['Lead']['enquiry_id'];
echo"</i></div><div class='panel-body'>";
    echo"<div class='panel panel-info sd-info-lead' style='border:none;'> <h4><b>My Requirement :</b></h4>";
    echo"<div class='quote-contents-left'  >";
	echo"<ul class='detail-messages-layout' style='overflow: auto;max-height:100px'>";
	echo "<p style='text-align:justify;text-justify:inter-word;'>";
	 echo nl2br(trim($quotes['Lead']['productspec']));
	echo"</p>";
	echo"</ul>";
	echo"</div>";
	echo"</div>";
	echo"<div class='quotes-contents'><div class='quotes-contents-info'><div class='quotes-contents-body'>";
    ?>
	<div class="quote-content-left">
	<!--Vendor Chat Responses -->
	  <div class='sd_xr_myenq_hd'><strong>Vendor Responses : </strong></div>
	<div class="table-responsive-sd">
<table class="table table-hover col-xs-12 padding-0">
<?php 
  if(count($last_msg)>0){
 ?>
<thead>
    <tr>
        <th class="col-xs-3">Vendor</th>
		<th class="col-xs-3" >Message</th>
		<th class="col-xs-3">D & T</th>
		<th class="col-xs-2">Chats</th>
    </tr>
</thead>
<tbody>
 <?php  
 foreach ($last_msg as $message) :
 	$Fullname=$this->requestAction('/genie/get_username/'.$message[a]['user_id']);
 	//$new_message=$this->requestAction('/leads/unread/'.$bids['Quotebid']['user'].'/'.$quotes['Lead']['quoteid']);
 	$price=$this->requestAction('/genie/get_formprice/'.$message[a]['user_id'].'/'.$quotes['Lead']['quoteid']);
 	$offers=$this->requestAction('/genie/get_formoffers/'.$message[a]['user_id'].'/'.$quotes['Lead']['quoteid']);
    $sid_id=$this->requestAction('/genie/get_sidid/'.$message[a]['user_id']);
 	?>
  <tr>
   <td  class="col-xs-3"> 
   <a  data-target="#know-more-popup" data-toggle="modal" onclick="CompanyPage(<?=$message[a]['user_id']?>,'2','','insurance','plansmart-financial','XRV<?=$message[a]['user_id']?>')" style="cursor:pointer">
    <?php echo $Fullname;?>  </a>
     </td> 
    <td class="col-xs-3">
     <?php echo $this->Text->truncate($message[a]['messages'],50);?>...
     </td>
       <td class="col-xs-3">at
       <?php 
              echo $this->Time->format($message[a]['time'], '%l:%M %p, %e %b %Y, %a '); 
    ?> </td>
		<td class="col-xs-2">
		<? if(($quotes['Lead']['status']==1)||($quotes['Lead']['status']==5)){?>
                <?if($quoted_user != $message[a]['user_id']){?>
			<a  href='/genie/<?php echo $quotes['Lead']['enquiry_id'];?>/<?php echo $sid_id?>/<?=$message[a]['user_id']?>' id='checkbutton' class='btn btn-info sd_reply_td_lead' target='_blank' style=''>VIEW </a>
			<? }
			  }
			?>
		</td>
    </tr>
     <?php endforeach; ?>
     <?php 
     	}//if count($last_msg)
     	else{
             echo $this->element('enquiries_no_response');
     	}
     //}
    ?>
</tbody>
</table>
</div>
	<!--Vendor Chat Responses -->
	<!--Vendor Quote responses-->
  <?php   
   echo"<div class='panel-heading' style='background:#fff'></div>";
							echo $this->element('enquiries_status');
							echo $this->Form->input('quoteid',array('type'=>'hidden','value'=>$quotes['Lead']['quoteid']));
						    $options=array('class'=>'quotestop','value'=>'STOP BID','label'=>'STOP BID');
		?>
<!--Vendor Quote responses-->
</div>
<!--panel-info -->
  <!--</div>-->
  </div><!--leads_ct col-md-6 col-xs-12 -->
  </div><!--row -->
  </div><!--leads-popup-hold -->
<?php	
echo "</div>";//buyer_enquiry
?>
 </div>
</div>
<?php 
/*--right side columns--*/					
	echo"<div class='col-md-6 col-xs-12'>";
	echo "<div class='leads_det leads-pop-des'>";
         /*Bread Crumb Starts*/
    echo $this->element('enquiries_crumbs');
   /*Bread Crumb Ends*/
	echo $this->element('enquiries_right_side');
	echo $this->element('enquiries_pause_button');
  echo"</div>";
/*--right side columns--*/	
  ?>
<div id="dialog-confirm" title="Confirm?" style="display:none">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;">
  	
  </span>You are about to select this bid. Are you sure?</p>
</div><!--dialog-confirm -->

<?php	
//echo $this->element('sql_dump');
?>

</div>

<script type="text/javascript">

	$(".quoteselect").on('click',function(event) {
		//alert('clicked');
	        var id = $(this).val();
			var quoteno="<?php echo $quotes['Lead']['quoteid']?>";
		    var bid_id = $(this).closest('tr').find('.bid_id').val();
			event.preventDefault();
			
			  $("#dialog-confirm").dialog({
							      resizable: false,
							      height: "auto",
							      width: 400,
							      modal: true,
							      buttons: {
							        "Confirm": function() {
							        	
							          $( this ).dialog( "close" );
							          if (bid_id) {
													var dataString = 'id='+ bid_id+'&quoteid='+quoteno;
													alert(dataString);
				
													$.ajax({
														
														type: "POST",
														url: '<?php echo Router::url(array("controller" => "leads", "action" => "selectquoteajax")); ?>',
														data: dataString,
														cache: false,
														async: false, //blocks window close
														success: function(data,textStatus,xhr){ 

									                     $("#quoteselstatus").text("The Selected Quote is shortlisted!.");
									                     $("#quoteselstatus").css("background-color", "#337ab7");
									                     $("#quoteselstatus").css("color", "#ffffff");
														 $(".quotestop").hide();
														 $(".quoteselect").hide();
									                     $("#chat").hide();
														 $("#chatenablebutton").hide();
														} 
														});
													}	
							        },//Confirm
							        Cancel: function() {
							        	
							          $( this ).dialog( "close" );
							          
							          //return false;
        					}//cancel
        					
        					//return false;
     					 }//button
     					 

   				 });//dialog
			   return false;
			   
			});
</script>
<script type="text/javascript">



		 $(".quotestop").on('click',function() {

		 	 var reason_pause=$("#reason_pause").val();
       //alert(reason_pause);

          if(reason_pause == ''){

         //alertify.alert('Enter the Reason for pausing'); 
        // $("#error_customer").show();
         $('#error_customer').show().delay(4000).fadeOut();
         return false;
     }
    //alert('c');

	alertify.confirm('Are You Sure You want to Pause  Quote .You will no longer receive any furthur quotes for this enquiry !. ', function (e) {
			if (e) {
				//alertify.success('Yours Quotes will be paused .You will no longer receive any furthur quotes for this enquiry !.');
				//alertify.success('');
            	quotestop();
             } else	{
             	alertify.error('Operation Cancelled');
            	return false;
            		
           }//else
           
         });//alertify
return false;
       
        }); 
		function quotestop() {

			var quoteid="<?php echo $quotes['Lead']['quoteid']?>";
		    var sellerid=$("#sellerid").val();
		    var reason_pause=$("#reason_pause").val();

			//event.preventDefault();
			if (quoteid) {
				var dataString = 'quoteid='+ quoteid+'&sellerid='+sellerid+'&reason_pause='+reason_pause;
				console.log(dataString);


				$.ajax({
					
					type: "POST",
					url: '<?php echo Router::url(array("controller" => "leads", "action" => "stopquote")); ?>',
					data: dataString,
					cache: false,
					async: false, //blocks window close
					success: function(data,textStatus,xhr){

                     $("#quoteselstatus").show();
                     $("#quoteselstatus").text("You will no longer receive quotes for this enquiry !.");
                    // $("#quoteselstatus").css("background-color", "#d43f3a");
                     $("#quoteselstatus").css("color", "#ff0000");
					 $(".quotestop").hide();
					 $(".quoteselect").hide();
                     $("#chat").hide();
                     $("#chatenablebutton").hide();
                      $("#reason_pause").hide();
					}
				});
			}
		}
</script>
<script type="text/javascript">
$(".quotechat").on('click',function() {
					
			var quoteno="<?php echo $quotes['Lead']['quoteid'];?>";
			var sellerid=sellerid_modal.innerHTML;
			var buyerid="<?php echo $quotes['Lead']['user_id'];?>";
			
			var msg=$("#messagetext").val();
			
			
			if(msg == '')
			{
			 $("#message_modal").animate({'backgroundColor':'#46b8da'},3000);
			 $("#message_modal").text("Enter Valid Messages");
             return false;		 
			}	
						
			//event.preventDefault();
			if (quoteno) {
				var dataString = 'sellerid='+ sellerid+'&quoteid='+ quoteno+'&buyerid='+buyerid+'&msg='+ msg;
				
				$.ajax({
					type: "POST",
					url: '<?php echo Router::url(array("controller" => "leads", "action" => "chatwithseller")); ?>',
					data: dataString,
					cache: false,
					success: function(data,textStatus,xhr){ 
				    
					parent.text("chat notified");
					
					
					} 
				});
			}
		});
		
		
		function modal_chat(seller){
			
			$("#sellerid_modal").text(seller);
		}

		$(document).ready(function(){

			$("#view_require").click(function(){
            $("#toggle_require").toggle();

    });

	/*("ul.detail-messages-layout").niceScroll({touchbehavior:false,cursorcolor:"#ddd",cursoropacitymax:0.6,cursorwidth:8,boxzoom:true, autohidemode:false});
    
   	   toScroll = $("ul.detail-messages-layout");
   	   
	  $("ul.detail-messages-layout").animate({ scrollTop: toScroll[0].scrollHeight }, 'slow');  */
	  });


		
	
</script>

  	
  