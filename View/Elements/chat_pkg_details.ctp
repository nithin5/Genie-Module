<?php
$today = date('Y-m-d');

      if(($leads_down == 1)||($leads_down == 2)){
        $test='chat_display_modal_after_pay()';
      }
      else{ 
        $test='chat_flip_info_main_test()';
      }  

$deduct=$category_credits_1;
if($receiver != $quoted_user){
                              if($buyers_status ==0){
                                     if(($leads_down == 1)||($leads_down == 2)){
                                     	  $buynow_message="<span id='before_pay_head' class='contact_chat_credit'><b class='cht_compny_xr' style='width: 23%;'>Cost of Lead = <span class='xyellow'>$deduct Credits</span> </b><b class='cht_compny_xr_oth' style='margin-left: 12px'>Your Balance = <span class='xyellow'>$credit_balance Credits</span> </b><p/><span id='before_pay_det' class='col-xs-4 padding-0 view_num' onclick='$test' style='margin-left:-363px'>Submit Your <i class='dskhide'><br></i>Offers</span></span><span id='after_contact_pay' class='message-entry msgnot pad28 nit_close'  style='display:none'><span class='contact_chat_credit' >,<b> Your Balance=  <span class='xyellow'> <?=$credit_balance?> Credits</span> </b><span id='before_pay_det' class='col-xs-4 padding-0 view_num' style='margin-left:-363px' onclick='$test'>View  <i class='dskhide'><br></i>Offers</span></span>
            </span>";
                                     }
                                     else{
                      	                    if($credit_balance >= $category_credits_1){//sufficient credit 
                                              				if($tot_res >= 6){//after five sellers
                                         $buynow_message="<span id='before_pay_head' class='contact_chat_credit' ><b class='cht_compny_xr' style='width: 23%;'>Cost of Lead = <span class='xyellow'>$deduct Credits</span> </b><b class='cht_compny_xr_oth' style='margin-left: 12px'>Your Balance = <span class='xyellow'>$credit_balance Credits</span> </b><p/><span id='before_pay_det' class='col-xs-4 padding-0 view_num' onclick='$test' style='margin-left:-363px'>Contact <i class='dskhide'><br></i>Buyer Now</span></span><span id='after_contact_pay' class='message-entry msgnot pad28 nit_close'  style='display:none'><span class='contact_chat_credit' >,<b> Your Balance=  <span class='xyellow'> <?=$credit_balance?> Credits</span> </b><span id='before_pay_det' class='col-xs-4 padding-0 view_num' style='margin-left:-363px' onclick='$test'>View  <i class='dskhide'><br></i>Number</span></span>
            </span>";
                                                      }else{//first five sellers
    $buynow_message="<span id='before_pay_head' class='contact_chat_credit' ><b class='cht_compny_xr' style='width: 23%;'>Cost of Lead = <span class='xyellow'>$deduct Credits</span> </b><b class='cht_compny_xr_oth' style='margin-left: 12px'>Your Balance = <span class='xyellow'>$credit_balance Credits</span> </b><p/><span id='before_pay_det' class='col-xs-4 padding-0 view_num' onclick='$test' style='margin-left:-363px'>Contact <i class='dskhide'><br></i>Buyer Now</span></span><span id='after_contact_pay' class='message-entry msgnot pad28 nit_close'  style='display:none'><span class='contact_chat_credit' >..<b> Your Balance=  <span class='xyellow'> <?=$credit_balance?> Credits</span> </b><span id='before_pay_det' class='col-xs-4 padding-0 view_num' style='margin-left:-363px' onclick='$test'>View  <i class='dskhide'><br></i>Number</span></span></span>        
     ";
                                                        }
                                                        $buynow_pkg="";
            												       }//eof sufficient credit balance
            												       else{//low balance
                                                            $buynow_message="
                                       <span id='before_pay_head' class='contact_chat_credit' ><b class='cht_compny_xr' style='width: 23%;'>Cost of Lead = <span class='xyellow'>$deduct Credits</span> </b><b> Your Balance = <span class='xyellow'>$credit_balance Credits (LOW)</span> </b><p/><span id='before_pay_det' class='col-xs-4 padding-0 view_num' onclick='$test' style='margin-left:-363px'>Contact <i class='dskhide'><br></i>Buyer Now</span><span/>
   <span id='after_contact_pay' class='message-entry msgnot pad28 nit_close'  style='display:none'><span class='contact_chat_credit' >..<b> Your Balance=<span class='xyellow'> <?=$credit_balance?> Credits</span> </b><span id='before_pay_det' class='col-xs-4 padding-0 view_num' style='margin-left:-363px' onclick='$test'>View  <i class='dskhide'>
         <br></i>Number
         </span>
        </span>
    </span>";
                                          }//eof low balance
                                     }//leads downloaded
                               }
}
  	$note1="Note 1:";
if($receiver){//logged in or sid case
  
                if(($today >= $expiry_date)||($status == 5)){
                 }
                 else{
                          echo"<div id='chats_pkg_details' class='message-entry msgnot pad28 hide_before_pay' style='margin-bottom:15px'>";
                                	  echo"<p >";
                                	  echo $buynow_message;
                                	  echo"</p>";
                                	  echo"<p style='color:#0c93f3'>";
                                	  echo"</p>";
                          echo"</div>";
            }
  }
  else{ //from leads super market,not logged case
         if($tot_res >= 6){
                  $cht_msg="";
         }
         else{ 
                  $cht_msg="VIEW <i class='dskhide'><br></i>NUMBER";
         }
         if(($today >= $expiry_date)||($status == 5)){
         }
         else{  ?>
                <div id='chats_pkg_details' class="message-entry msgnot buyer_login" > 
                    <span id='before_pay_head' class='contact_chat_credit' >
                      <b>CUSTOMER NUMBER = <span class='xyellow'><?=$category_credits?> Credits</span>
                          <i class='dskhide'><br></i>
                      </b>
                      <p/>
                       <span id='before_pay_det' class='col-xs-12 padding-0 view_num' onclick='<?=$test?>'>
                          <? if($tot_res >= 6){?> 
                                               <?=$cht_msg?> 
                             <?}else{?>
                                      Contact <i class='dskhide'><br></i>Buyer Now 
                             <?}?>
                       </span>
                    </span>
                 </div>
           <?}
     } 	      
?>
<script>
$(document).ready(function () {
       var radios = $('input:radio[name=optradio]');
       radios.filter('[value=1]').prop('checked', true);
});
 $('input[id=optradio]').click(function(){
     var pay_type = $(this).val();
     $("#check_pay_type").val(pay_type);
 });
</script>