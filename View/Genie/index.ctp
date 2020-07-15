<? if(empty($Yes_Full)){
 ?>
<div class="container ">  
<div class="col-md-4 col-xs-4">

</div>                        
<?
if($campaign>2){
          echo $this->element('login_vendors');
}
$findme   = 'Special';
$pos = strpos($genie_title, $findme); 
 ?>
<div id="tot_panel" class="col-md-8 col-xs-12 padding-0 mncol82 camp_head <?if($pos!=false){?>resto<?}else{?>Main-genie<?}?> <?if($User_Id!=''){?>adjloginpan<?}?>">
<div class="_quot-form top-30" >
<div class=" panel panel-primary">
 <!--  <marquee>Genie</marquee> -->
<div class="col-md-12 padding-0">
<div class="col-xs-12 geniefxdhd padding-0" style="background:#e4e6eb">
<div class="col-xs-12 padding-0 dskhide paddingleft5" id="click_resto">
<div class="col-xs-12 padding-0 " id="campaign-mb-txt" style="cursor: default;">
<?if($genie_title!=''){?>
<span style="color: #009925;">Best Discounts</span> on Food & Drinks
<?}
else{?><span class="col-xshmgenie"><span class="hmgenie"><span class="home_sprite catg_genie"></span></span></span>  GENIE GETS YOU <i style="color: #17a98c">BEST DEALS</i><?}?></div>

</div> 
 <?if($pos==false){//normal genie?>
<div id="normaldsk">
<div class="col-xs-12 padding-0  mbhide">      
<div class="col-xs-12 padding-0 paddingleft10">
<span class="col-xs-12 " id="campaign-text-1"><span class="col-xshmgenie"><span class="hmgenie"><span class="home_sprite catg_genie"></span></span></span> GENIE GETS YOU <i >BEST DEALS</i> </span>
</div>  
</div>
</div>
<?}else{//campaign for desktop?>
<span id="customdsk" >
<div class="col-xs-12 padding-0  mbhide" style="cursor: default;">
<span style="color: #009925;">Best Discounts</span> on Food & Drinks
  </span>
<?}?>
</div>
<!-- hmeh1 -->
</div><!-- col-md-12 padding-0 -->
<!-- title  nav  -->
<?

if($pos==false){?>
   <div class="col-sm-12 padding-0">
      <span class="multi-offer active" id="genie_multioffer">
        Get Multi-deals Instantly
     </span>
     <span class="multi-offer" id="genie-contact-seller">
        Contact Any Seller Directly
    </span>
</div> 
<?}

?>
<div class="panel_body _panelquotes main_form">
<img title="loading" id='leadform_loading' src="https://d372i0x0rvq68a.cloudfront.net/img/loading_company.gif" class="img-responsive" style="display:none;margin-left:370px;margin-top:25px;margin-bottom:25px;position: absolute;left: 0;right: 0;margin: 0 auto;">
<div id="quote_response" class="alert alert-success alert-dismissable" style="display:none">
<span class="closecls_qu" style="" onclick="close_response()">X</span> 
<div id="quote_response1"  style="display:none">
<b>Received Your Request. Thanks. 
<?  if(!empty($User_Id)) 
      {?>  
           | <a target='_blank' href='/myaccount/my_enquiries'>View Enquiry Now </a>
      <?}?>
      </b>
<p>You’ll soon receive Requested-Info from Xerve’s Partners (via Xerve Chat).<p>
</div>
</div>
 <div id="quote_response2" class="alert alert-success alert-dismissable" style="display:none">
 </div>
<form enctype="multipart/form-data" method="post" id="LeadAddForm" accept-charset="utf-8">
<div class="genie_add <?if($pos!=false){?>col-xs-6 padding-0  restocont<?}?> <?if ($User_Id!=''){?>loginheight<?}?>" >
<input name="enquiry_time" value="<?php echo date('Y-m-d H:i:s');?>" id="QuoteEnquiryTime" type="hidden">
<input name="today" value="<?php echo date('Y-m-d');?>" id="today" type="hidden">
<input name="dine2date" value="" id="dine2date" type="hidden">
<input name="formid" value="2" id="QuoteFormid" type="hidden">
<input name="user_id" value="<?php echo $User_Id;?>" id="QuoteUserId" type="hidden">
<input id="submit_clicked" type="hidden" value="0">
<input type="hidden" id="genie_login_type" value="<?if($pos!= false){?>New_Enquiry<?}else{?>Normal<?}?>">
<input id="second_click" type="hidden" value="0">
<input type="hidden" id="resto_pubs" name="resto_pubs" >
<input type="hidden" id="check_controller" name="check_controller" value="<?=$this->params['controller']?>"> 
<input type="hidden" id="ControllerName" name="ControllerName" value="<?=$this->params['controller']?>"> 
<input type="hidden" id="need_otp_check">
<input type="hidden" id="second_time" value="<?=$second_time?>">
<input type="hidden" id="actual_link" value="<?=$actual_link?>">
<input type="hidden" id="check_eq_id" value="<?=$check_eq_id?>">
<input type="hidden" id="check_mb_no" value="<?=$check_mb_no?>">
<input type="hidden" id="check_cd_code" value="<?=$check_cd_code?>">
<input type="hidden" id="channel_type" value="<?=$channel_type?>">
<input type="hidden" id="inner_post_login">

<?if($pos!=false){?>
<input id="user_log" type="hidden" value="" />
<input type="hidden" id="f_authenticate_reason"/>
<input type="hidden" id="f_id_valuation"/>
<input type="hidden" id="f_user_valuation"/>
<input type="hidden" id="f_user_email"/>
<input type="hidden" id="facebook_firstname"/>
<input type="hidden" id="facebook_gender"/>
<input type="hidden" id="facebook_profile"/>
<input type="hidden" id="facebook_lastname"/>
<input type="hidden" id="mobile_fac_veri"/>
<input type="hidden" id="facebook_intial_id"/>
<input type="hidden" id="google_clicked" value="0">
<input type="hidden" id="dinedate_timestamp">
<input type="hidden" id="pg" value="<?=$pg?>">
<input type="hidden" id="offline" value="<?=$offline?>">
<input type="hidden" id="off_mar_url" value="<?=$off_mar_url?>">
<input type="hidden" id="camp_cat_type" value="<?=$camp_cat_type?>">
<?}?>
<input type="hidden" id="genie_title" name="genie_title" value="<?=$genie_title?>">
<input type="hidden" id="enquiry_up_id" name="enquiry_up_id" value="<?=$enquiry_id?>">
<input type="hidden" id="genie_up_flag" name="genie_up_flag" value="<?=$genie_up_flag?>">
<input type="hidden" id="genie_up_user_id" name="genie_up_user_id" value="<?=$genie_up_user_id?>">
<input type="hidden" id="genie_up_guest_type" name="genie_up_guest_type" value="<?=$genie_up_guest_type?>">
<input type="hidden" id="genie_up_member_type" name="genie_up_member_type" value="<?=$genie_up_member_type?>">
<input type="hidden" id="genie_up_quote_id" name="genie_up_quote_id" value="<?=$quote_id?>">
<input type="hidden" id="need_activation" name="need_activation" value="<?=$need_activation?>">
<input type="hidden" id="unique_ip" name="unique_ip" value="<?=$_SERVER['REMOTE_ADDR']?>">
<input type="hidden" id="seo_cat_id" name="seo_cat_id" >
<input type="hidden" id="seo_sub_cat_id" name="seo_sub_cat_id">
<input type="hidden" id="seo_cat_name" name="seo_cat_name" >
<input type="hidden" id="seo_subcat_name" name="seo_subcat_name" >
<input type="hidden" id="seo_city_id" name="seo_city_id" >
<input type="hidden" id="seo_city_name" name="seo_city_name" >
<input type="hidden" id="seo_area_id" name="seo_area_id">
<input type="hidden" id="seo_area_name" name="seo_area_name">
<input type="hidden" id="one2one_inner">
<input type="hidden" id="Search" value="<?=$Search?>" />
<input type="hidden" id="Brand" value="<?=str_replace('&','%26',$Brand)?>" />
<input type="hidden" id="Suggest" value="<?=$Suggest?>" />
<input type="hidden" id="sidebar" value="<?=$Sidebar?>" />
<input type="hidden" id="top_cnt" />
<input type="hidden" id="logo_cnt"/>
<input type="hidden" id="button_cnt"/>
<input type="hidden" value="<?php echo $latitude;?>" id="login_popup_leads_latitude1" name="login_latitude1">
<input type="hidden" value="<?php echo $longitude;?>" id="login_popup_leads_longitude1" name="login_longitude1">
<input type="hidden" value="<?php echo $city;?>" id="login_popup_leads_city1" name="login_city1">
<input type="hidden" value="<?php echo $state;?>" id="login_popup_leads_state1" name="login_state1">
<input type="hidden" value="<?php echo $area;?>" id="login_popup_leads_area1" name="login_area1">
<input type="hidden" value="" id="login_popup_leads_zone1" name="login_zone1">
<input type="hidden" value="" id="login_popup_leads_zones1" name="login_zones1">
<input type="hidden" value="<?php echo $country;?>" id="login_popup_leads_country1" name="login_country1">
<input type="hidden" value="<?php echo $address;?>" id="login_popup_leads_address1" name="login_address1">
<input type="hidden" id="check_pub">
<input type="hidden" id="check_rest">
<input type="hidden" id="check_mob_no">
<input type="hidden"  id="limit_loop">
<input type="hidden"  id="prev_category_id">
<input type="hidden"  id="prev_city_id">
<input type="hidden" id="direct_call_click">

<?if($pos==false){?>
<!-- leftside vol -->
<div class="col-md-6 col-xs-12 padding-0">
   <div class="col-md-12 col-xs-12 padding-0 typeof_buy dskhide">
      <?if($pos==false){?>  <div class="bod-hold main-section"></div> <?}?>
      <?
      if($genie_up_flag != 1){
							      $b2ccheck="true";
							      $b2bcheck="false";
      }
      else{
     				 if(($b2c==1)||($b2c=='')){
							      $b2ccheck="true";
							      $b2bcheck="false";
     				 }else{
							      $b2ccheck="false";
							      $b2bcheck="true";
      					}
      }
      ?> 
      <label class="col-md-6 col-xs-6 padding-0">
      <input type="radio" id="b2c" name="b2c"  value="1" <?if($b2ccheck=='true'){?>checked<?}?> onclick="b2c()"> 
      <span for="b2c">My Requirement</span>
      </label>
      <label class="col-md-6 col-xs-6 padding-0">
      <input type="radio" id="b2c" name="b2c"  value="2" <?if($b2bcheck=='true'){?>checked<?}?> onclick="b2c()">
      <span for="b2c" >Office Requirement</span>
      </label>
        <span class="error_msg" id="error_customer" style="display:none"></span>
     <!--  </div> -->
</div><!--col-md-6 -->
 </div>
<!-- rightsider col -->
<div class="col-md-12 col-xs-12 padding-0 _fill_detaile">
  <div class="col-md-12 col-xs-12 padding-0 typeof_buy mbhide">
      <?if($pos==false){?>  <div class="bod-hold main-section"></div> <?}?>
      <?
      if($genie_up_flag != 1){
      $b2ccheck="true";
      $b2bcheck="false";
      }
      else{
            if(($b2c==1)||($b2c=='')){
            $b2ccheck="true";
            $b2bcheck="false";
            }else{
            $b2ccheck="false";
            $b2bcheck="true";
            }
      }
      ?> 
      <label class="col-md-6 col-xs-6 padding-0">
      <input type="radio" id="b2c" name="b2c"  value="1" <?if($b2ccheck=='true'){?>checked<?}?> onclick="b2c()"> 
      <span for="b2c">My Requirement</span>
      </label>
      <label class="col-md-6 col-xs-6 padding-0">
      <input type="radio" id="b2c" name="b2c"  value="2" <?if($b2bcheck=='true'){?>checked<?}?> onclick="b2c()">
      <span for="b2c" >Office Requirement</span>
      </label>
        <span class="error_msg" id="error_customer" style="display:none"></span>
     <!--  </div> -->
</div><!--col-md-6 -->
      <!-- subcat -->
        <div class="col-md-12 col-xs-12 padding-0 textarea_col">
 <textarea class="form-control xenqspan" id="productspec" rows="3" cols="6" data-toggle="tooltip"  placeholder="Wish Box (Type Any Buying Wish Here)"><?php echo strip_tags(stripslashes($genie_title));?><?php if(($wish!='')){echo strip_tags(stripslashes($wish));}?></textarea>
<span style="color:#666;margin-left: 5px;margin-bottom: 2px;padding-top:2px;display: none;" id="spec_content">
</span>
<span id="specs_content" style="display:none"> Please Provide Details.</span>
<span class="error_msg" id="error_msg_productspec" style="display:none">* </span>
</div>
<div id="short_form">
<div class="col-md-12 col-xs-12 padding-0">
     <div class="col-md-6 col-xs-6 padding-0">
     <input type="text"  id="quantity" autocomplete="off" class="form-control select-city-box-login" value="<?php echo $quantity;?>" placeholder="<?if($genie_title==''){?>Quantity<?}else{?>Group Size<?}?>" >
    <span id="quan_desc" ></span>
    <span class="error_msg" id="error_quantity" style="display:none"></span>
    </div>
    <div class="col-md-6 col-xs-6 padding-0">
    <input type="text" id="budget" autocomplete="off" class="form-control select-city-box-login" value="<?php echo $budget;?>" placeholder="Total Budget" >
    <span id="bud_desc" ></span>
    <span class="error_msg" id="error_budget" style="display:none"></span>
    </div>
</div> <!--col-sm-12 padding-0-->  
<div class="col-xs-12 padding-0 _loginas">
</div> <!--row memtype-->
</div><!--short_form -->
<div class="col-md-12 col-xs-12 padding-0 " >
<div id="loc_dis" class="main-section select-hold <?if($pos!=false){?>_gninfosc<?}?>" <?if($pos!=false){?>style="display: none"<?}?>>
       <div class="bod-hold main-section"></div>
      <span class="error_msg" id="error_city"></span><!-- </span> -->
       <input type="text" id="login_popup_leads_select_city2" value="<?php echo $address;?>" class="form-control select-city-box-login" autocomplete="off" value="" placeholder="Location (of Sellers)" onclick="edit_location();">
      <span class="error_msg" id="error_city1" style="display:none"></span>
</div>
</div><!--col-md-6 -->
<div class="col-xs-12 padding-0 _loginas">
 <div class="col-md-12 col-xs-12 padding-0 marg0mb">
            <?if($genie_up_flag != 1){?> 
                      <?  if(empty($User_Id)) {?>  
                        <label class="col-md-6 col-xs-6 padding-0">
                          <input id="member_type"  type="radio" name="member_type"  value="0" > 
                          <span for="member_type" style="text-transform:none"> I am a Guest</span>
                        </label>
                      <?}?>
                      <label class="col-md-6 col-xs-6 padding-0">
                        <input id="member_type" type="radio" name="member_type"  value="1" <?if(!empty($User_Id)){?>checked="checked"<?}?>>
                        <span for="member_type" style="text-transform:none"> I am a Member </span>
                      </label>
            <?}?>
    </div><!--col-md-12 col-xs-12 padding-0 marg0mb -->
  </div>
  <!-- -->
    <?if($genie_up_flag != 1){?>
    <div class="col-md-12 col-xs-12 padding-0" <?if(!empty($User_Id)){?>style="display: none"<?}?>>
          <div class="col-md-6 col-xs-6 padding-0" style="padding-right: 1px">
            <input type="text" id="full_name" class="form-control select-city-box-login " value="" autocomplete="off" placeholder=" Name" style="display:none">
            <span id="fname_desc" style="color:#666;margin-right: 2px"></span>
          </div>
          <div class="col-md-6 col-xs-6 padding-0">
                <div class="col-md-12 col-xs-12 padding-0">

                  <input type="text" id="mobile_number" class="form-control select-city-box-login" autocomplete="off" placeholder="Enter Mobile No." maxlength=10 style="display:none">
                  <span id="mob_desc" class="mob_desc" ></span>
               </div><!--col-md-12 col-xs-12 padding-0-->
          </div><!--col-md-6 col-xs-6 padding-0-->
      </div> <!--col-md-12 col-xs-12 padding-0 -->
    <?}?>
</div>
<?}?>
<!-- new img mob-->
  <? if($pos!=false){?>
                      <?if(empty($User_Id)) {?>
                          <input id="member_type"  type="hidden" name="member_type"  value="0" > 
                      <?}else{?>
                        <input id="member_type"  type="hidden" name="member_type"  value="1" > 
                       <?}?>
  <div id="guest_session">
<div class="col-xs-12 padding-0" id="top_mob">
   <?if($pg==2){?>
   <div class="<?if($pg==2){?>col-md-5 col-xs-5 padding-0<?}else{?>col-md-12 col-xs-12 padding-0<?}?>" <?if($pg==2){if(empty($User_Id)){?>style="display:block;margin-top:14px"<?}else{?>style="display:none"<?}}else{?>style="display:none"<?}?>>
      <div class="genehg">My Number</div>
   </div>
   <?}?>
    <div class="<?if($pg==2){?>col-md-7 col-xs-7 padding-0<?}else{?>col-md-12 col-xs-12 padding-0<?}?>" id="top_mob_display">
         <input type="hidden" id="full_name">
         <div class="<?if($pg==2){?>col-md-12 col-xs-12 padding-0<?}else{?>col-md-6 col-xs-5 padding-0<?}?>">
          <input id="mobile_number" name="mobile_number" type="text" class="form-control <?if($pg==2){?>mob_no_2<?}else{?>mb_no<?}?>" placeholder="Enter Mobile No." autocomplete="off"  maxlength=10 style="color:#000">
               <span class="error_msg" id="error_mobile_pos" style="width: 90%;color: #777;display:block;text-align: center"># Get Free Access </span> 
               </div>
       <div class="<?if($pg==2){?>col-md-7 col-xs-7 padding-0<?}else{?>col-md-6 col-xs-7 padding-0<?}?>" >
         <div id="register_for_the_loginseller">
    <span  class="btn btn-default genie-sub" id="quoteguestsave_bef" <?if($pg==2){?>style="display:none"<?}?> >
    VIEW DISCOUNTS <i class="glyphicon glyphicon-play-circle"></i>
    </span>
         </div>
         </div>
        </div>
        
</div>                
<div class="col-xs-12 padding-0" id="join_offer_club" >        
 <div class="col-md-3 col-xs-3 padding-0">
</div>
<div class="col-md-9 col-xs-9 padding-0" >
<?if($pos!=false){?>
<!--not logged in-->
<?if(empty($User_Id)) {?>
 
   <?}?>
  <!--not logged in-->
  <?}?>
  </div><!--col-md-7--> 
  </div><!--col-xs-12-->
  <!--nonlogged in section -->
 <div id="two_icons" class='col-md-12 col-xs-12 padding-0' style="display:none">
        <div class="col-md-6 col-xs-6">
	         <div id="two_icon_click" onclick="two_icon_click()">
	           <div id="two_icon_img">
	            <img class="img-responsive lazy" src="https://d372i0x0rvq68a.cloudfront.net/icon/Gevie_Icon_125.png">
	            </div>
		            <div id="two_icon_text" class='col-md-12 col-xs-12 padding-0' style='background-color:#00b050;color:#fff;border: 2px solid #00b050;'>
		                <div class="col-md-12 col-xs-12 padding-0" >ASK GENIE FOR </div>
		                <div class="col-md-12 col-xs-12 padding-0" ><b>SPECIAL DEALS</b></div>
		               </div>
	         </div>
       </div>
       <div class="col-md-6 col-xs-6">
          <div id="one_icon_click" onclick="one_icon_click()">
           <div id="one_icon_img">
            <img class="img-responsive lazy" src="https://d372i0x0rvq68a.cloudfront.net/icon/Offers_Icon_125.png">
            </div>
	            <div id="one_icon_text" class='col-md-12 col-xs-12 padding-0' style='background-color:#3f48cc;color:#fff;border: 2px solid #3f48cc;'>
		            <div class="col-md-12 col-xs-12 padding-0" >  SHOW ME  </div>
		            <div class="col-md-12 col-xs-12 padding-0" ><b>LATEST DEALS</b></div>
	            </div>
          </div>
        </div>
</div>
<!--del content -->
<div id="loggedin_section" <?if(empty($User_Id)) {?> style="display:none" <?}else{?>style="display:block"<?}?> style="display:none">
 <div class="col-xs-12 padding-0 ">
    <div class="col-xs-12 padding-0 hide_mob" id="show_offers_off">
           <div class="col-md-12 col-xs-12 padding-0"  id="pubsorresto" >
                 <div class="col-md-5 col-xs-5 padding-0">
                        <div class="genehg" id="loc_head_mob" >My Preference</div>
                 </div>
                <div class="col-md-7 col-xs-7 padding-0" >
                     <div class="col-md-12 col-xs-8 padding-0 " >
                         <label>
                         <input type="checkbox" id="rest" name="rest" checked="true" > 
                         <span for="rest"> Restaurants</span>
                         </label> 
                    </div>

                    <div class="col-md-12 col-xs-6 padding-0 " >
                        <label >
                          <input type="checkbox" id="pub" name="pub" checked="true" style="margin-left: 2px!important;"> 
                          <span for="pub"> Pubs</span>
                        </label>
                    </div>
           
               </div>
          </div><!--eof  pubsorresto-->
    </div>

 <div class="col-xs-12 padding-0" id="my_location" >
       <div class="col-md-5 col-xs-5 padding-0">
                <div class="genehg" id="loc_head_mob" >My Location</div>
      </div>
      <div class="col-md-7 col-xs-7 padding-0" >
                  <div id="loc_dis" class="maisection selecthold" >
                      
                      <span class="error_msg" id="error_city"></span><!-- </span> -->
                      <input type="text" id="login_popup_leads_select_city2" value="<?php echo $address;?>" class="form-control selectcitybox-login" value="" placeholder="Select Your Location" onclick="edit_location();">
                      <span class="glyphicon glyphicon-menu-down mbhide"></span>
                      <span class="glyphicon glyphicon-menu-down dskhide"></span>
                    <span class="error_msg" id="error_city1" style="display:none"></span>
                </div>
      </div>
  </div>

  <div id="food_combo">
             <div class="col-xs-12 padding-0">
                       <div class="col-md-5 col-xs-5 padding-0">
                                <div class="genehg" id="" > Select Date</div>
                       </div>
                        <div class="col-xs-7 padding-0">
                                <input type="text" autocomplete="off" class="form-control" id="dpd1" placeholder="Date" >
                               <input type="hidden" class="inputappend date" id="dpd2" data-date="" data-date-format="yyyy-mm-dd">
                               <span  id="dpd4" class="glyphicon glyphicon-calendar" ></span>
                      </div>
                       <div class="col-xs-6 padding-0" >
                      </div>
           </div>

      <div class="col-xs-12 padding-0 hide_mob" >
               <div class="col-md-5 col-xs-5 padding-0">
                          <div class="genehg" id="need_offers_text" style="display:none">Select Time</div>
                </div>
      <div class="col-md-7 col-xs-7 padding-0" id="second_list" style="display:none">
         <div class="col-xs-12 padding-0 ">
                      <div class="col-xs-4 padding-0 ">
                          <label class="col-md-12 col-xs-12 ligcnt padding-0" style="padding-left: 5px;">
                                 <input type="checkbox" id="lunch" name="lunch" value="5" checked="true"> 
                              <span for="dinner" class="splunchs">Any</span>
                              </label>
                        </div>
                      <div class="col-xs-4 padding-0 ">
                          <label class="col-md-12 col-xs-12 ligcnt padding-0">
                           <input type="checkbox"  id="lunch" name="lunch" value="1" > 
                          <span for="lunch" class="splunchs">Lunch</span>
                          </label>
                      </div>
                        <div class="col-xs-4 padding-0 ">
                      <label class="col-md-12 col-xs-12 ligcnt padding-0" style="padding-left: 5px;">
                                 <input type="checkbox" id="lunch" name="lunch" value="2" > 
                              <span for="dinner" class="splunchs">Dinner</span>
                              </label>
                        </div>
                     </div>
      </div><!--col-md-7-->
  </div><!--col-xs-12-->

<div class="col-xs-12 padding-0">
        <div class="col-md-5 col-xs-5 padding-0">
                <div class="genehg" id="avg_spent_mob" style="display:none"> Budget <i style="font-weight:normal;display: inherit;line-height: 2;">(Per Person)</i>
                </div>
        </div><!--col-md-5 col-xs-5 padding-0 -->
        <div class="col-md-7 col-xs-7 padding-0" >
                   <div class="col-md-6 col-xs-6 padding-0 margcontby hide_mob" >
                          <div class="genie_dropdown quan_dropdown" id="dinnerid" style="display:none">
                                    <button class="genieprimary dropdown-toggle selectpicker" id="quantitybtn" type="button" data-toggle="dropdown">
                                                <li  id="quantity" class="text-valu3" value="4">4</li>  
                                                  <span class="glyphicon glyphicon-menu-down"></span> 
                                      </button> 
                                       <ul class="dropdown-menu selectpicker" id="drop_down_quan">
                                                <?foreach (range(2,20) as $groupsize) { ?>
                                                      <li value="<?=$groupsize?>" <?if($groupsize==4){?>selected<?}?>>
                                                     <? if($groupsize<20)
                                                     {echo $groupsize;}
                                                     else
                                                     {echo $groupsize."+";}
                                                     ?>
                                                     </li>
                                                     <?}?>
                                        </ul>
                              </div><!--genie_dropdown quan_dropdown-->
                      </div><!--col-md-6 col-xs-6 padding-0 margcontby -->

                  <div class="col-md-6 col-xs-6 padding-0 marfcnt" id="quan_outer_div">       
                          <div class="genie_dropdown" id="tot_quan" style="display:none">
                            <button class="genieprimary dropdown-toggle selectpicker" type="button" data-toggle="dropdown">

                            <?//if($camp_cat_type==1){?>
                            <li  id="budget" class="text-valu2" value="500" selected="500">Rs. 500</li>
                            <?//}?>
                            <span class="glyphicon glyphicon-menu-down"></span></button>
                            <ul class="dropdown-menu selectpicker" id="drop_down_price">
                           <? //if($camp_cat_type==1){
                                 foreach (range(250,5000,250) as $price) {
                            ?>
                              <li value="<?php echo $price?>" <?if($price==500){?>selected<?}?>>Rs. 
                                 <? if($price<5000)
                                     {echo $price;}
                                     else
                                     {echo $price."+";}
                                     ?>
                              </li>
                            <?}
                            //}
                         
                               ?> 
                            </ul>
                          </div><!--genie_dropdown-->
                   </div><!--col-md-6 col-xs-6 padding-0 marfcnt-->

        </div><!--col-md-7 col-xs-7 padding-0 -->
        </div><!--div class="col-xs-12 padding-0-->
        <!--appending mobile number -->
        <div class="col-xs-12 padding-0" id="bot_mob" >
        </div>
        </div><!--online ordering -->
        <?if(empty($User_Id)) {?>
        <div class="col-xs-12 padding-0" id="otp_all" style="display:none">
       <div class="col-md-5 col-xs-5 padding-0">
                <div class="genehg" id="otp_mob" > Verification </div>
                 <p id="mob_otp"  ></p>
                <input type="hidden" name="guest_type" id="guest_type">
                <input type="hidden" name="check_quote_id" id="check_quote_id">
                <input type="hidden" name="check_cd" id="check_cd">
      </div><!--col-md-5 col-xs-5 padding-0 -->
      <div id="otp_sub" class="col-md-7 col-xs-7 padding-0" >
        <div class="col-xs-12 padding-0" >
     <input id="otp_number" name="register_verify_main" class="form-control" placeholder="OTP" style="margin-top:5px" autocomplete="off">
<span class="resend_btn_aft" id="resend_code_btn" onclick="resend_code_btn()">Resend OTP </span>
<span class="resend_msg"></span>
<div class="loading-login-verify_vendor_home" style="display:none;padding-bottom:10px;text-align:center;margin-left:10px;">
           <img class="lazy" src="https://d372i0x0rvq68a.cloudfront.net/img/loading_company.gif" alt="loading" title="loading">
</div>  <!--col-md-7 col-xs-7 padding-0-->     
        </div><!--col-xs-12 padding-0 --> 
      </div><!--otp_sub-->
</div> <!--col-xs-12-->
</div>
<?}?>
</div><!--loggedin_section-->
 <!--del content -->
  <?if($pos!=false){?>
    <?  if(empty($User_Id)) {?> 
        <div class="col-xs-12 padding-0">
           <div class="col-xs-6 padding-0">
              <span id="one_icon_click_back" class="glyphicon glyphicon-arrow-left" onclick="one_icon_click_back()" style="display:none;font-size: 30px;top: 15px;left: 10px;cursor: pointer;"></span>
                <span id="quoteguestsave" class="btn btn-primary quotesmbtn2"  type="submit" style="display:none;" onclick="quote_save()"> 
               <span class="btn_genie"> <strong >Ask Genie For<span class="col-xs-12 padding-0">Special Deals</span></strong><span class="home_sprite new_genie"></span></span> 
                </span>
           </div>
          <div class="col-xs-6 padding-0" id="deals_tab" <?if(empty($User_Id)){if($pg==2){?>style="display:block"<?}else{?>style="display:none"<?}}else{?>style="display:block"<?}?>>
          <span class="multi-deals" id="listed_deals" onclick="listed_deals()">
         <strong >Skip Genie AND<span class="col-xs-12 padding-0"> View All Deals</span></strong> <i class="glyphicon glyphicon-menu-right"></i>
          </span>
          </div>
        </div>
   <?}else{?>
            <div id="guest" >
        <span id="one_icon_click_back" class="glyphicon glyphicon-arrow-left" onclick="one_icon_click_back()" style="display:none;font-size: 30px;top: 15px;left: 10px;cursor: pointer;"></span>
            <span id="quoteguestsave" class="btn btn-primary quotesmbtn2"  type="submit" onclick="quote_save()"> 

               <span class="btn_genie"><span class="home_sprite new_genie"></span> <strong>Submit Wish & Get Deals</strong> </span>
              </span>
          </div>
          <?}
          }?>

    
  <!-- </center> -->
  <?  if(empty($User_Id)) {?>
  <?if($pos!=false){?>
<div class="restoimgcol puht dskhide" id="img_btm_mob" <?if($pg==2){?>style="display:none"<?}?>>
<div class="col-xs-12 padding-0 joinadimg" >
<span id="restimg" class="_restoimg <?if($User_Id!=''){?>lgrestoimg<?}?>" onclick="restimg()">
  <?if($pg!=2){?>
        <img class="img-responsive lazy" id="mobrestostrip" style="display:none"  src="https://d372i0x0rvq68a.cloudfront.net/img/Resto-GENIE-Xerve-14June2018.png">
        <img class="img-responsive lazy" style="display:none" id="mobpubstrip" src="https://d372i0x0rvq68a.cloudfront.net/img/Pubs-GENIE-Xerve-15-June-2018.png">
        <img class="img-responsive lazy"  id="mobrestopubstrip" src="https://d372i0x0rvq68a.cloudfront.net/images/Genie-min-20.png">
        <?}?>
</span>
</div>
</div>
<?}?>
 
 <?if($pos!=false){?>
<div class="restoimgcol puht mbhide" id="img_btm_dsk" <?if($pg==2){?>style="display:none"<?}?>>
<div class="col-xs-12 padding-0 joinadimg">
<span id="restimg" class="_restoimg <?if($User_Id!=''){?>lgrestoimg<?}?>" onclick="restimg()">
<?if($pg!=2){?>
<img class="img-responsive lazy"  id="dskrestopubstrip" src="https://d372i0x0rvq68a.cloudfront.net/images/Genie-min-20.png">
<?}?>
</span>
</div>
</div>
<?}?>
  <!--old t c -->
  <div id="tandc" <?if($pg==2){?>style="display:none"<?}?>>
           <span class="_lglg">
                <input type="radio" name="iagreetc" checked="true" > 
                <span class="_igh1">I agree to Xerve.in <strong>
                <a class="_lghb" href="https://www.xerve.in/termsofuse" target="_blank">Terms Of Use </a>
                </strong> and <strong>
                <a class="_lghb" href="https://www.xerve.in/privacypolicy" target="_blank">Privacy Policy</a></strong>.
                </span>
          </span>
          <span class="_lglg">
              <input type="radio" name="iagreepromo" checked="true" > 
              <span class="_igh1">
              I agree to receive Xerve's Transactional and Promotional SMSes, Emails, WhatsApp Messages etc. 
              <a class="_lghb" href="https://www.xerve.in/offers" target="_blank"> (Ex: Cashback Notifications)</a>
             </span>
          </span>
</div>
  <!--old t c -->
  </div>
  <?}
    }//user not logged in
  ?> 
 <!--img  tag prev-->
<div class="col-md-12 col-xs-12 padding-0 <?if($pos!=false){?>resto_submit<?}else{?>maingeniebtn<?}?>"> 
<center>
<div id="member" style="display: none;"> 
<?if($genie_title==''){?>
<?  if(!empty($User_Id)) //user is logged in
{?>       
<span id="quotesave" class="btn btn-primary quotesmbtn2"   type="submit" onclick="quote_save()"> <span class="home_sprite new_genie"></span> <?if($pos!=false){?> <b>Submit Wish To Genie</b><?}else{?>WISH & GET<?}?> </span>
<?}else{?>
<a id="quoteloginbutton" class="btn btn-primary quotesmbtn2" data-toggle="modal" data-target="#login-popup-vendors" onclick="quote_login_button()" > <span class="home_sprite new_genie"></span> <?if($pos!=false){?><?}else{?>WISH & GET<?}?>
</a>
<span id="quotesave" class="btn btn-primary quotesmbtn2"  type="submit" onclick="quote_save()">
 <span class="home_sprite new_genie"></span> <?if($pos!=false){?><b>Submit Wish To Genie</b><?}else{?>WISH & GET<?}?>
 </span>
 <?}?>
<?}?>  
</div><!--member-->
   <?if($pos==false){?>
            <?  if(empty($User_Id)) {?>
        <div id="guest" >
         <span id="quoteguestsave" class="btn btn-primary quotesmbtn2"   type="submit" style="color:#fff" onclick="quote_save()"> 
          <span class="home_sprite new_genie"></span> <b>WISH & GET</b>
          </span>
          </div>
          <?}?>
   <?}?>
</center>
 <?if($pos==false){?>
<div id="faq_content" class="faq-ans" style="font-size: 12px;text-align: justify;line-height: 20px;font-weight: normal;margin-bottom: 20px;">
 </div>
 <?}?>
</div> <!--col-md-12 padding-0-->   
 
</div>                                          
</div>
</form>
<div id="otp_verify_form" class="verification_register_client_vendor_home verfilg" style="display: none;">
Please Enter OTP to Get Offers Now
</p>
<p id="invalid_otp" class="error_msg" style="display:none;">* Enter Valid Code</p>
<input type="hidden" name="guest_type" id="guest_type">
<input type="hidden" name="check_quote_id" id="check_quote_id">
<input id="otp_number" name="register_verify_main" class="form-control" placeholder="OTP" style="margin-top:5px">
<button type="submit" class="btn btn-primary quotesmbtn2" id="quoteguestsaveotp" onclick="verify_guest_otp()" style="margin-top:5px">FINISH
</button>
<span class="resend_btn_bef" id="resend_code_btn_now" >Send OTP </span>
<span class="resend_btn_aft" id="resend_code_btn" style="display:none" onclick="resend_code_btn()">Send OTP </span>
<span class="resend_msg"></span>
<div class="loading-login-verify_vendor_home" style="display:none;padding-bottom:10px;text-align:center;margin-left:10px;">
<img class="lazy" src="https://d372i0x0rvq68a.cloudfront.net/img/loading_company.gif" alt="loading" title="loading"></div>
</div>
<!--eof otp form -->  
<!--seller_select --> 
   <div id="seller_select" class="panel_body _panelquotes" style="display:none">
     <div class="col-md-12 col-xs-12 padding-0">
    <img title="loading" id='sellerform_loading' src="https://d372i0x0rvq68a.cloudfront.net/img/loading_company.gif" class="img-responsive lazy" style="display:none;margin-left:370px;margin-top:25px;margin-bottom:25px;position: absolute;left: 0;right: 0;margin:-30px auto;">
          <div class="col-md-12 col-xs-12 padding-0 typeof_buy ">
                <div class="bod-hold main-section"></div>
         </div>
          <div class="col-md-6 col-xs-6 padding-0 ">
           <select  id="city_buy" class="form-control" >
            <option value="0">Select City</option>
           <? foreach ($City_List as $key =>$value) {?>
                    <option value="<?=$key?>">
                      <?php 
                           echo $value;
                      ?>
                    </option>
                 <?}
                 ?>
            </option>
          </select>
     </div><!-- city_id-->
       <div class="col-md-6 col-xs-6 padding-0 " >
        <select class="form-control" id="category_id" >
            <option value="0">Select Category</option>
           <? foreach ($Genie_Category as $key =>$value) {?>
             <?if($key =='Product' || $key=='Service'){?>
            
              <?}else{?>

                   <option value="<?=$key?>" <?if(strtolower($value)==$category_url){?>selected<?}?>  >
                      <?php 
                      echo $value;
                      ?>
                    </option>
                 <?}
                 }
                  ?>
           </option>
          </select>
      </div><!-- category_id-->
        
     
     <div class="col-md-6 col-xs-6 padding-0" id="subcat" style="display:none">
            <select name="subcategory_id" id="subcategory_id" class="form-control">
              <option>Select Subcategory</option>
           <? foreach ($SubCategory_List as $key =>$value) {?>
            <option value="<?=$key?>">
                <?php
                   echo $value;
                 } ?>
            </option>
          </select>
       </div> <!--subcat -->
     <div class="col-md-6 col-xs-6 padding-0 " >
         <select class="form-control" id="zone_buy" style="display:none">
            <option value=0>Select Zone</option>
         </select>
     </div><!-- city_id-->
     <div class="col-md-6 col-xs-6 padding-0" id="sel_btn" style="display:none">
                <div class="col-xs-12 padding-0 " >
                 <span id="show_sellers" style="padding: 11px 15px 6px!important"> 
                     <b class="sub_gen">Please try another search or call +722619911</b>
                      </span>
              </div> 
     </div> 
  </div> 
        <div id="alltab2diffsellersbody">
       </div>
  </div> <!--seller_select-->    
</div><!--_quot-form-- >
</div><!--col-md-8 col-xs-12 padding-0 mncol82 -->
<!--map -->
<div id="share-location-login-popup-leads_myloc" class="modal fade login-popup-index" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="_sdshareloc">
<div class="_sharemodalcont"  id="location_fine5">
<div id="show_location_popup_loc_login_popup_leads_myloc"  class="_xsdpnon">
<span class="location-address1">
<b> Your Current Location: </b>
<span id ="change_location_ad99_login_popup_leads_myloc"></span>
</span>
<br/>
<span class="change-remove" style="display:block;margin-top:10px !important;" onclick="removelocationlogin_popup_leads_myloc();">[X] &nbspRemove Location</span>
</div>
<button type="button" class=" close close-cover share-close-btn" data-dismiss="modal">
<span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span>
</button>
<div class="content">
<button id="shareyour_myloc"  style="display:none" type="button" class="hvr-pulse-grow share_location_leads " onclick="login_popup_leads_geolocateUser_myloc();">Share Sellers Location
</button>
<br>
<div class="show_text_location_leads" style="text-align:center;">
</div>
<div class="share_location_or_condition share_location_button_leads" >
Select Seller Location
</div>
<span class="error_msg" id="autocomplete12_myloc_msg"></span>
<br>
<div onclick="login_popup_leads_initialize_myloc()">
<input type="text" id="login_popup_leads_autocomplete_myloc" class="autocomplete-text" name="autocomplete12_myloc" placeholder="Enter Seller Location" autofocus>
</div><br>
<div class="">
<button class="submit-nearby" type="button" id="login_popup_leads_nearbyoff_myloc">SUBMIT</button>
</div>
</div>
<!-- panel_body _panelquotes main_form-->
</div>
</div><!--panel panel-primary -->
<!-- panel_body _panelquotes main_form-->
</div>
</div><!--panel panel-primary -->
<!--otp form -->
</div>
</div>
</div>
</div>
<div id="share-location-login-popup-leads_myloc1" class="modal fade login-popup-index" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="_sdshareloc">
<div class="_sharemodalcont"  id="location_fine5">
<div id="show_location_popup_loc_login_popup_leads_myloc1"  class="_xsdpnon">
<span class="location-address1">
<b> Your Current Location: </b><span id ="change_location_ad99_login_popup_leads_myloc1"></span>
</span>
<br/>
<span class="change-remove" style="display:block;margin-top:10px !important;" onclick="removelocationlogin_popup_leads_myloc1();">[X] &nbspRemove Location</span>
</div>
<button type="button" class=" close close-cover share-close-btn" data-dismiss="modal">
<span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span>
</button>
<div class="content">
<button id="shareyour_myloc"  type="button" class="hvr-pulse-grow share_location_leads " onclick="login_popup_leads_geolocateUser_myloc1();">Share Your Current Location
</button>
<br>
<div class="show_text_location_leads" style="text-align:center;">
</div>
<div   class="share_location_or_condition share_location_button_leads">
OR
</div>
<span class="error_msg" id="autocomplete12_myloc1_msg"></span>
<br>
<div onclick="login_popup_leads_initialize_myloc1()">
<input type="text" id="login_popup_leads_autocomplete_myloc1" class="autocomplete-text" name="autocomplete12_myloc1" placeholder="Enter Your Current Location">
</div><br>
<span class="change-remove" id="area_loc_check" style="display:block;font-size:14px;color:#000;cursor:text;margin-top:10px !important;" >
</span>
<div class="">
<button class="submit-nearby" type="button" id="login_popup_leads_nearbyoff_myloc1">SUBMIT</button>
</div>
</div>
</div>
</div>
</div>
       
<!--map -->
<?}else{?>
<?php echo $this->element('genie_full_details'); ?>
<?}?>  

      
       