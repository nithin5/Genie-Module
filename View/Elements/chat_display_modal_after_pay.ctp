  <!-- Modal for customer details-->
<div class="modal  login-popup chatleadspopup" id="chat_display_modal_after" tabindex="-1" role="dialog" aria-labelledby="chat_display_modal_afterLabel"  style="top:60px;"> 
<div class="modal-dialog model-top-dsk-vou12">
<div class="modal-content">
<div class="modal-header">
<?
  if(($free_credits==1)||($free_credits==2)){
    $deduct=10;
  }
  if($free_credits==3){
   $deduct=1;
  }
  if($free_credits==4){
    $deduct=$category_credits_1;
  }
?>
<button type="button" class="close_chatnum " data-dismiss="modal">X</button>
<h4 class="modal-title"> </h4>
</div><!--modal-header-->
<div class="modal-body">
<div class='chatetails'>
   <div id="req_block" ><!--ist block -->
      <ul>
     <li>
     <span id="">
     <h2 class="product_title_modal" >
     <span class='leads_listdes col-xs-6 padding-0' >
       <a id="track_seller_count" style="cursor:auto!important;">
       <strong>CUSTOMER NUMBER: </strong> 
     </span><!--leads_listdes col-xs-6 padding-0 -->
     <span class='leads_listdes col-xs-6 padding-0' >
      
              <span id="pre_contact" class="xrred" style="font-weight: bold;font-size: 18px;">
                  <a href=tel:'<?echo $view_buyer_contact;?>' class="mbchat xwhite" style="font-weight: bold;margin-top: -29px;margin-bottom: 10px;display: inline-block;margin-left: 181px;padding: 8px 30px;border-radius: 11px;">
    <i class="glyphicon glyphicon-earphone "  style="font-size:x-small;"> </i> 
    <?echo $view_buyer_contact;?>
                   </a>
              </span> <!--pre_contact --> 
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
                  <span class='col-xs-12 padding-0' >
                     <input type="text" id="offers_id_1"  name="offers_id_1" class="form-control offers_id_1" placeholder="Type Your Offer Here ..." value="<?=$quoted_offer?>"> 
                 </span>
                     <span  id="offer_btn_1" style="width: 50%;display: inline-block;text-align: center;font-size: 14px;color: #fff !important;background: #2095f3;border-radius: 4px;padding: 10px 6px;margin-top: 10px" onClick="offer_btn_1();">
                      <?if($quoted_offer==''){?>SUBMIT OFFERS<?}else{?> EDIT YOUR OFFER<?}?>
                      </span>    
        </span>
     </span>
    </li>
     </ul>
   </div><!--eof i st block-->
    </div>
    </div> 
</div>
</div>

</div>
<!-- Modal for customer offer details-->  