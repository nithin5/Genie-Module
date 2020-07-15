  <!-- Modal for customer details-->
<div class="modal  login-popup chatleadspopup" id="chat_flip_info_terms_test" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top:60px;"> 
<div class="modal-dialog model-top-dsk-vou12">
<div class="modal-content">
<div class="modal-header">
<?
  $flag=1;
  /*calculating budget*/
 if($free_credits>3){
                       if($credit_balance >= $category_credits_1){
                             if(($leads_down == 1)||($leads_down == 2)){

                                 $offer_style="display:inline-block";
                                 $req_style="display:none";
                                 $pay_style="display:none";

                              }
                              else{
                                      $offer_style="display:none";
                                      $req_style="display:inline-block";
                                      $pay_style="display:none";
                              }
                      }
                      else{  
                              $offer_style="display:none";
                              $req_style="display:none";
                              $pay_style="display:inline-block";
                      }
                      $deduct=$category_credits_1;
}
else{
          
          if($credit_balance >= $category_credits_1){
                 $deduct=$category_credits_1;
                                     if(($leads_down == 1)||($leads_down == 2)){
				                                   $offer_style="display:inline-block";
				                                   $req_style="display:none";
				                                   $pay_style="display:none";

				                              }else{
				                                      $req_style="display:inline-block";
				                                      $offer_style="display:none";
				                                      $pay_style="display:none";
				                              }

          }
          else{
      				      if(($free_credits==1)||($free_credits==2)){
                            $deduct=10;
                            if(($leads_down == 1)||($leads_down == 2)){
                                   $offer_style="display:inline-block";
                                   $req_style="display:none";
                                   $pay_style="display:none";

                              }else{
                                      $req_style="display:inline-block";
                                      $offer_style="display:none";
                                      $pay_style="display:none";
                              }
      				                            
      				      }
      				      if($free_credits==3){
      				              $deduct=1;
                            if(($leads_down == 1)||($leads_down == 2)){
                                   $offer_style="display:inline-block";
                                   $req_style="display:none";
                                   $pay_style="display:none";

                              }else{
                                      $req_style="display:none";
                                      $offer_style="display:none";
                                      $pay_style="display:inline-block";
                              }
      				      }
				}      
      
}                
                          $this->set('deduct',$deduct);
?>
<button type="button" class="close_chatnum " data-dismiss="modal">
<span class="glyphicon glyphicon-remove" data-dismiss="modal"></span>
</button>
<h4 class="modal-title"> </h4>
</div><!--modal-header-->
<div class="modal-body">
<div class='chatetails'>
   <div id="req_block" style="<?=$req_style?>"><!--ist block -->
      <ul>
      <li>
          <span >
          <h2 class="product_title_modal" >
          <span class='leads_listdes col-xs-6 padding-0' >
          <strong> CUSTOMER REQUIREMENT: </strong>
          </span>
          <span class='leads_listdes col-xs-6 padding-0' >
          <span id="compare-details"  class="compare_details_modal_part non-bold-text " align="center" >
          <?=$quotes['Lead']['productspec']?> 
          </span>
          </span>
          </h2>
          </span>
     </li>
      <li>
            <span>
               <span class='leads_listdes col-xs-6 padding-0'>
                 <strong> 
                 <?if(($quotes['Lead']['genie_url']=='')||($quotes['Lead']['genie_url']==undefined)){?>
                 QUANTITY:<?}else{?>GROUP SIZE: <?}?>
                 </strong> 
               </span>
              <span class='leads_listdes col-xs-6 padding-0'>
                 <span id="compare-details"  class="compare_details_modal_part non-bold-text " align="center" >
               <?= $quotes['Lead']['quantity']?>
                 </span>                              
              </span> 
          </span>
     </li>
      <li>
           <span>
             <span class='leads_listdes col-xs-6 padding-0'>
                 <strong>
             <?if(($quotes['Lead']['genie_url']=='')||($quotes['Lead']['genie_url']==undefined)){?>
             TOTAL BUDGET:<?}else{?>BUDGET (per Head): <?}?> 
                </strong> 
             </span>
              <span class='leads_listdes col-xs-6 padding-0'>
                <span id="compare-details"  class="compare_details_modal_part non-bold-text " align="center" >
                  Rs. <?=$quotes['Lead']['budget']?>                         
                </span>
              </span>   
            </span>
      </li>
       <li>
            <?if($genie_url!=''){
                 if(($sel_cat_id==88)||($sel_cat_id==80)){?>
                <span id="post_total_budget" >
                    <span class='leads_listdes col-xs-6 padding-0'><strong> TOTAL BUDGET:</strong> </span>
                     <span class='leads_listdes col-xs-6 padding-0'>
                          <span id="compare-details"  class="compare_details_modal_part non-bold-text " align="center" >
                              Rs. <?php echo $quotes['Lead']['budget']*$quotes['Lead']['quantity'];?>                         
                         </span>
                     </span>   
               </span>
             </li>
           <?
             }
           }
           ?>
     <li>
          <?if($genie_url!=''){?>
              <span id="post_total_budget" >
                  <span class='leads_listdes col-xs-6 padding-0'><strong> REMAINING CREDITS:</strong> </span>
                   <span class='leads_listdes col-xs-6 padding-0'>
                        <span id="compare-details"  class="compare_details_modal_part non-bold-text " align="center" >
                             <?php echo $credit_balance;?>                         
                       </span>
                   </span>   
             </span>
           </li>
           <?}?>
     <li>
     <span id="">
     <h2 class="product_title_modal" >
     <span class='leads_listdes col-xs-6 padding-0' >
       <a id="track_seller_count" style="cursor:auto!important;">
       <strong>CUSTOMER NUMBER: </strong> 
     </span><!--leads_listdes col-xs-6 padding-0 -->
     <span class='leads_listdes col-xs-6 padding-0' >
              <span id="pre_contact" class="xrred">
                  <?echo $view_buyer_contact_mask;?>
              </span> <!--pre_contact --> 
       </span><!--leads_listdes col-xs-6 padding-0 -->
       </a>
       </h2>
       </span>
       </li>
       <li>
         <span class='col-xs-12 padding-0'>
         <?if($leads_down == 0){?>
         <center>
         <?if(($free_credits==1)||($free_credits==2)){?>
         <span id="show_number" class='btn btn-md ' onClick="show_number()">
         SHOW CUSTOMER NUMBER</span>
         <span id="credit_ded_msg" class="col-xs-12 compare_details_modal_part non-bold-text">(Note: <?=$deduct?> Credits will be Deducted)</span>
         <?}else{?>
         <span id="show_payment" class='btn btn-md '>
         GET CUSTOMER DETAILS FOR Rs <?=$deduct?></span>
         <span id="credit_ded_msg" class="col-xs-12 compare_details_modal_part non-bold-text">(Note: Rs <?=$deduct?> will be Charged)</span>
         <?}?>
         </center>
          <?}?>
        </span>
       </li>
     </ul>
   </div><!--eof i st block-->
    <div id="offer_block" style="<?=$offer_style?>">
    <!--ii nd block -->
     <ul>
       <li>
     <span id="">
     <h2 class="product_title_modal" >
     <span class='leads_listdes col-xs-12 padding-0' >
       <a id="track_seller_count" >
       <span>You Can also Assist Customers(via calls) & Share Offer </span> 
     </span>
     <!--leads_listdes col-xs-6 padding-0 -->
     <span class='leads_listdes col-xs-12 padding-0' >
        <?php 
         if(($view_buyer_contact != '')||($view_buyer_contact != undefined)){ ?>
            <a href=tel:'<?echo $view_buyer_contact;?>' class="mbchat xwhite" >
              <i class="glyphicon glyphicon-earphone "  > </i> 
             <?echo $view_buyer_contact;?>
                   </a>
                 <? }
          ?>
       </span><!--leads_listdes col-xs-6 padding-0 -->
       </a>
       </h2>
       </span>
       </li>
        <li>
      <span id="today_off_af" >
         <span class="produh6 leads_listdes col-xs-12 padding-0" >
                  <span class='leahd4 col-xs-12 padding-0' >
                        <strong>Please Share Your Todays Offer: </strong>
                  </span>
                  <span id='offers_id_span' class='col-xs-12 padding-0' >
             <input type="text" id="offers_id_1" name="offers_id_1" class="form-control"  value="<?=$quoted_offer?>" placeholder="Type Your Offer Here ..."> 
                 </span>
                 <span>
                     <a  id="offer_btn" style="width: 50%;display: inline-block;
    text-align: center;font-size: 14px;color: #fff !important;background: #2095f3;border-radius: 4px;
    padding: 10px 6px;margin-top: 10px" onclick="offer_btn()">
                      SUBMIT OFFERS 
                      </a>    
                </span>
        </span>
     </span>
    </li>
   </ul>
   </div><!--eof ii nd block -->
   <div id="pay_block" style="<?=$pay_style?>">
         <?php if($free_credits==3){?>
          <span class="col-xs-12 col-md-12 " style="color:#c00000">Your 50 Free Credits have Exhausted</span>
            <span class="col-xs-12 col-md-12 mbhide" > Now Pay <span style="color: #009925;font-weight: bold;">Rs. 1</span> & Get Customer Details Instantly
          </span>
       <ul class="_offersadd-bg" id="re_1_block" style="margin-top: 15px;">      
          <li class="_priclead">
                  <label class="chkbox1 col-xs-4 padding-0 active" style="width: 50%;height:60px">
                  <h4> 
                      <input id="checkbox-1" class="checkbox-custom" name="checkbox-1" type="checkbox" checked="checked">
                      <label for="checkbox-1" class="checkbox-custom-label">I want Customer Details</label>
                 </h4>
                  <h5>
                      <i class="fa fa-rupee"></i> 1
                  </h5> 
                 <h6></h6>
                </label>
          </li>
           <li class="_prcbtn">
                <span>
                     <a  id="re_1_btn" style="width: 50%;display: inline-block;
    text-align: center;font-size: 14px;color: #fff !important;background: #2095f3;border-radius: 4px;
    padding: 15px 10px;">
                      PAY NOW 
                      </a>    
                </span>
            </li> 
      </ul>   
      <?php }else{?>
      <?php if($credit_balance<$category_credits_1){?> 
          <span class="col-xs-12 col-md-12 " style="color:#c00000">Your Credits are Low! </span>
           <span class="col-xs-12 col-md-12 mbhide" > Please <span style="color: #009925;font-weight: bold;">Recharge Now </span>to Get Customer Number
          </span>
           <div id="pay_outer">
              <ul class="_offersadd-bg">
               <li class="_priclead">
                        <label class="chkbox2 col-xs-4 padding-0">
                      <h4>
                         <input id="checkbox-3" class="checkbox-custom" name="checkbox-3" type="checkbox">
                         <label for="checkbox-3" class="checkbox-custom-label">MINI</label>
                      </h4>
                       <h5> 
                           <i class="fa fa-rupee"></i> 10 
                      </h5> 
                      <h6>(10 Credits)</h6>
                      <span class="_getextra"></span>
                  </label>
                  <label class="chkbox2 col-xs-4 padding-0">
                       <h4>
                           <input id="checkbox-2" class="checkbox-custom" name="checkbox-2" type="checkbox">
                           <label for="checkbox-2" class="checkbox-custom-label">LITE</label>
                      </h4>
                      <h5> 
                          <i class="fa fa-rupee"></i> 100  
                      </h5> 
                      <h6>(100 Credits)</h6>
                       <span class="_getextra"></span>
                  </label>
                </li> 
                <li class="_prcbtn">
                    <span>
                         <a class="_btnleads" id="button_basic" style="display:none"> BUY NOW</a>    
                    </span>
                </li>           
              </ul>
          </div>
          <?php }
           }?>
          <div id="pay_inner" style="display:none">
   		         <?echo $this->element('chat_pay_pack'); ?> 	
         </div>
   </div>
    </div>
    </div> 
</div>
</div>

</div>
<!-- Modal for customer offer details--> 
<script> 
$('#re_1_btn').on('click',function(){
   $('#pay_inner').show();
   $('#re_1_block').hide();
});
$('#checkbox-2').change(function() {
        if($(this).is(":checked")) {
            $('#pay_inner').show();
            $(this).attr("checked", true);
            $('.chkbox1').removeClass('active');
            $('#checkbox-1').attr('checked', false);
            $('.chkbox3').removeClass('active');
            $('#checkbox-3').attr('checked', false);
            $('.chkbox2').addClass('active');
            $('#button_pro').show();
            $('._prcbtn').show();
            $('#pay_url').val('pro');
            $('#citrusCustomParamsValue1').val('LITE');
            $('#paymentdetail_msg1').hide();
        }
        else{
	          $(this).attr("checked", false);  
	          $('#pay_url').val('');
	          $('.chkbox2').removeClass('active');
	          $('._prcbtn').hide();
	          $('#paymentdetail_msg1').show();
	          $('#pay_inner').show();
        }
    });
$('#checkbox-3').change(function() {
        if($(this).is(":checked")) {
            $('#pay_inner').show();
            $(this).attr("checked", true);
            $('.chkbox1').removeClass('active');
            $('#checkbox-1').attr('checked', false);
            $('.chkbox2').removeClass('active');
            $('#checkbox-2').attr('checked', false);
            $('.chkbox3').addClass('active');
            $('#button_pro').show();
            $('._prcbtn').show();
            $('#pay_url').val('std');
            $('#citrusCustomParamsValue1').val('MINI');
            $('#paymentdetail_msg1').hide();
        }
        else{
  	          $(this).attr("checked", false);  
  	          $('#pay_url').val('');
  	          $('.chkbox3').removeClass('active');
  	          $('._prcbtn').hide();
  	          $('#paymentdetail_msg1').show();
  	          $('#pay_inner').hide();
        }
    });
    </script>
