
  
 <!--<input type="hidden" id="For" value="<?=$For?>" />-->
  <? if(empty($Yes_Full)){?>

<? if(empty($ajaxLoding)){ ?> 
<div id="Home_Content" style="min-height:800px;"><? }?> <!-- start-Home -->

  <input id="url_now_new" type="text" value="<? foreach($Sorted_Array_new as $key2=>$val2){ if(!empty($$val2)) { echo '/'.strtolower($val2).'-'.$$val2;} }?>/forfor-personal<? if(!empty($Search)){echo '&q='.str_replace(" ", "+", $Search);}?><? if(!empty($Sortby)){echo '&sortby='.$Sortby;}?><? if(!empty($Viewby)){echo '&viewlist='.$Viewby;}?><?if(!empty($device) && $device=='Mobile'){echo '&device='.$device;}?>" class="_xsdpnon" /> 
 


 <input id="url_now" type="hidden" value="?need=<?=$For?><? if(!empty($Search)){echo '&q='.str_replace(" ", "+", $Search);}?><? foreach($Sorted_Array as $key2=>$val2){if(!empty($$val2)) {echo '&'.strtolower($val2).'='.str_replace(" ", "+", str_replace('&','%26',str_replace('%','2A',$$val2)));} }?><? if(!empty($Sortby)){echo '&sortby='.$Sortby;}?><? if(!empty($Viewby)){echo '&viewlist='.$Viewby;}?><?if(!empty($device) && $device=='Mobile'){echo '&device='.$device;}?>" style="display:none;" /> 

    <input id="url_last" type="hidden" value="www.xerve.in/leads?need=<?=$For?><? foreach($Sorted_Array as $key3=>$val3){ if(!empty($$val3)) { echo '&'.strtolower($val3).'='.str_replace(" ", "+", str_replace('&','%26',str_replace('%','2A',$$val3)));} }?><? if(!empty($Sortby)){echo '&sortby='.$Sortby;}?><? if(!empty($Viewby)){echo '&viewlist='.$Viewby;}?>" style="display:none;"  />
 
     <div class="loading_image_selection" id="loading_image_selection_store_main"><img src="/img/loading_company.gif" class="img-responsive" alt="loading" title="loading"></div>
 
        <input type="hidden" id="scroll_top_height" value="">  

        <div id="title_for_layout" style="display:none;"><?php echo $title_for_layout;?></div>
        <div id="description_for_layout" style="display:none;"><?php echo $description_for_layout;?></div> 
  
        <input type="hidden" id="field_names_order" value="<?= implode("-", $field_cookie) ?>">
  
        <input type="hidden" id="scroll_top_filter_height" value="">

        <input type="hidden" id="height_home_content" value="">

        <input type="hidden" id="single_page_height_main" value=""> 

        <input type="hidden" id="Home" value="<?=$Home_Value?>"> 
 
<input type="hidden" id="view_value" value="<?=$Viewby?>">

<input type="hidden" id="category" value="<?=$Category?>" />

<input type="hidden" id="city" value="<?=$City?>">

<input type="hidden" id="For" value="<?=$For?>">

<input type="hidden" id="Search" value="<?=$Search?>">

<input type="hidden" id="Page" value="<?if (!empty($Page)) {echo $Page;} else {echo 0;}?>">
            
        <input type="hidden" id="ControllerName1" value="leads">
        <input type="hidden" id="Brand" value="<?=$Brand?>">
        <input type="hidden" id="sidebar" value="<?=$Sidebar?>">
        <input type="hidden" id="Self" value="<?=$Self?>">

        <div id="params_count" style="display:none"><?=$params_count?></div>

        <input id="Where_Catch" type="hidden" value="<?php echo $Where_Catch;?>" />
         
        <input id="condition" type="hidden" value="<?php echo $condition;?>" />


        <input type="hidden" id="brand_search" value="<?=$brand_search?>">
        <input type="hidden" id="Where_Catch_Filter_brand" value="<?=$Where_Catch_Filter_brand?>">
        
        <input type="hidden" id="Brand_name_main" value="<?=$Brand?>">
        <input type="hidden" id="Category_name_main" value="<?if(empty($Home)) { echo $Category; }?>">
        <input type="hidden" id="SubCategory_name_main" value="<?=$SubCategory?>">
        <input type="hidden" id="Type_name_main" value="<?=$Type?>">
        <input type="hidden" id="Gender_name_main" value="<?=$Gender?>">
        <input type="hidden" id="City_name_main" value="<?=$City?>">
        <input type="hidden" id="Area_name_main" value="<?=$Area?>">


        <input type="hidden" id="Filter_Other_Brand" value="<?=$Filter_Other_Brand?>">
        <input type="hidden" id="Where_Catch_Filter" value="<?=$Where_Catch_Filter?>">
        <input type="hidden" id="Filter_Other_Category" value="<?=$Filter_Other_Category?>">
        <input type="hidden" id="Filter_Other_SubCategory" value="<?=$Filter_Other_SubCategory?>">
        <input type="hidden" id="Filter_Other_Type" value="<?=$Filter_Other_Type?>">
        <input type="hidden" id="Filter_Other_Gender" value="<?=$Filter_Other_Gender?>">
        <input type="hidden" id="Filter_Other_City" value="<?=$Filter_Other_City?>">
        <input type="hidden" id="Filter_Other_Area" value="<?=$Filter_Other_Area?>">

            <input type="hidden" id="WC_Category" value="<?=$WC_Category?>">
            <input type="hidden" id="WC_SubCategory" value="<?=$WC_Sub_Category?>">
            <input type="hidden" id="WC_Brand" value="<?=$WC_Brand?>">
            <input type="hidden" id="WC_Type" value="<?=$WC_Type?>">
            <input type="hidden" id="WC_Gender" value="<?=$WC_Gender?>">
            <input type="hidden" id="WC_City" value="<?=$WC_City?>">
            <input type="hidden" id="WC_Area" value="<?=$WC_Area?>">
            <input type="hidden" id="WC_For" value="<?=$WC_For?>">


<!-- <input id="url_now" type="hidden" value="http://www.xerve.in/leads"> -->

 <input id="condition" type="hidden" value="<?php echo $condition;?>" />

  <input type="hidden" id="Home" value="<?=$Home?>" />
  
          <?php echo $this->element('Leads_Sidebar'); ?>  
          

  

<div class='panel panel-primary right-section'>
 
     
 <div class="sd_pt_vw_sect" style="margin-top:20px; margin-bottom:30px;">
                        <div class="row">
                           <span class="glyphicon glyphicon-th-large sd_pt_grid1 <?if($Viewby=='grid'){?> active_grid <?}?>" onclick="selectview('grid')"></span>
                           
                           <span class="glyphicon glyphicon-th-list sd_pt_list <?if($Viewby=='list'){?> active_grid <?}?>" onclick="selectview('list')"></span>
                        </div>
           </div>

<?php echo $this->Session->flash('sms'); ?>  


  <div class="sd_ft_bdcrum show_mi_order"  style="margin-bottom: 10px; margin-top:0px;<?if( (!empty($Home) || empty($Self) ) && empty($Search)){?> display:none;<?}?> ">
  <!-- fnhfljilfjok -->

    <div class="app_selection_click">


    <?

    // echo "this is the category value".$Category;

                    if (!empty($Category)) {

                                $Category_Arr = explode("|", $Category);

                                foreach ($Category_Arr as $za => $categ) {

                                    // echo $categ;

                                    $arr_Category .= '<div class="select_hold cl_category' . str_replace(' ', '_', $categ) .'" onclick="SelectOption(' . "'Category'" . ',13,' . "'" . $categ . "'" . ",'" . $categ . "'" . ",'close'" . ')"><span class="value_btn">' . str_replace('-', ' ', $categ) . '</span><button id="Category' . $categ . '" class="closed_btn sort13' . $za . '"><i class="glyphicon glyphicon-remove"></i></button></div>';  // echo $str;
                                       
                                 } 

                                 // echo $arr_Category;
                            }

                            if (!empty($SubCategory)) {

                                $SubCategory_Arr = explode("|", $SubCategory);

                                foreach ($SubCategory_Arr as $za => $categ1) {

                                    // echo $categ;

                                    $arr_SubCategory .= '<div class="select_hold cl_subcategory' . str_replace(' ', '_', $categ1) .'" onclick="SelectOption(' . "'SubCategory'" . ',13,' . "'" . $categ1 . "'" . ",'" . $categ1 . "'" . ",'close'" . ')"><span class="value_btn">' . str_replace('-', ' ', $categ1) . '</span><button id="SubCategory' . $categ1 . '" class="closed_btn sort13' . $za . '"><i class="glyphicon glyphicon-remove"></i></button></div>';  // echo $str;
                                       
                                 }

                                 // echo $arr_Category;
                            }

                            if (!empty($Gender)) {

                                $Gender_Arr = explode("|", $Gender);

                                foreach ($Gender_Arr as $za => $categ1) {

                                    // echo $categ;

                                    $arr_Gender .= '<div class="select_hold cl_gender' . str_replace(' ', '_', $categ1) .'" onclick="SelectOption(' . "'Gender'" . ',13,' . "'" . $categ1 . "'" . ",'" . $categ1 . "'" . ",'close'" . ')"><span class="value_btn">' . str_replace('-', ' ', $categ1) . '</span><button id="Gender' . $categ1 . '" class="closed_btn sort13' . $za . '"><i class="glyphicon glyphicon-remove"></i></button></div>';  // echo $str;
                                       
                                 }

                                 // echo $arr_Category;
                            }

                            if (!empty($Type)) {

                                $Type_Arr = explode("|", $Type);

                                foreach ($Type_Arr as $za => $categ1) {

                                    // echo $categ;

                                    $arr_Type .= '<div class="select_hold cl_type' . str_replace(' ', '_', $categ1) .'" onclick="SelectOption(' . "'Type'" . ',13,' . "'" . $categ1 . "'" . ",'" . $categ1 . "'" . ",'close'" . ')"><span class="value_btn">' . str_replace('-', ' ', $categ1) . '</span><button id="Type' . $categ1 . '" class="closed_btn sort13' . $za . '"><i class="glyphicon glyphicon-remove"></i></button></div>';  // echo $str;
                                       
                                 }

                                 // echo $arr_Category;
                            }

                             if (!empty($Brand)) {

                                 $Brand_Arr = explode("|", $Brand);

                                 foreach ($Brand_Arr as $c => $brand_na) {

                                        $pri1 = str_replace(' ', '_', $brand_na);
                                        $pri1 = str_replace('.', '_', $pri1);
                                        $pri1 = str_replace('%', '_', $pri1);


                                      $arr_Brand .= '<div class="select_hold cl_brand' . $pri1 .'" onclick="SelectOption(' . "'Brand'" . ',13,' . "'" . $brand_na . "'" . ",'" . $brand_na . "'" . ",'close'" . ')"><span class="value_btn">' . str_replace('-', ' ', $brand_na) . '</span><button id="Brand' . $brand_na . '" class="closed_btn sort13' . $c . '"><i class="glyphicon glyphicon-remove"></i></button></div>';
                                       
                                 }

                                 // echo $arr_Brand;
                            }

                             if (!empty($Area)) {

                                 $Area_Arr = explode("|", $Area);

                                 foreach ($Area_Arr as $ar => $area_na) {

                                        // $pri1 = str_replace(' ', '_', $brand_na);
                                        // $pri1 = str_replace('.', '_', $pri1);
                                        // $pri1 = str_replace('%', '_', $pri1);


                                      $arr_Area .= '<div class="select_hold cl_area' . str_replace(' ', '_', $area_na) .'" onclick="SelectOption(' . "'Area'" . ',13,' . "'" . $area_na . "'" . ",'" . $area_na . "'" . ",'close'" . ')"><span class="value_btn">' . str_replace('-', ' ', $area_na) . '</span><button id="Area' . $area_na . '" class="closed_btn sort13' . $ar . '"><i class="glyphicon glyphicon-remove"></i></button></div>'; 
                                       
                                 }

                                 // echo $arr_Area;
                            }

                            if (!empty($For)) {

                                 $For_Arr = explode("|", $For);

                                 foreach ($For_Arr as $ar => $For_na) {

                                        // $pri1 = str_replace(' ', '_', $brand_na);
                                        // $pri1 = str_replace('.', '_', $pri1);
                                        // $pri1 = str_replace('%', '_', $pri1);


                                      $arr_For .= '<div class="select_hold cl_for' . str_replace(' ', '_', $For_na) .'" onclick="SelectOption(' . "'For'" . ',13,' . "'" . $For_na . "'" . ",'" . $For_na . "'" . ",'close'" . ')"><span class="value_btn">' . str_replace('-', ' ', $For_na) . '</span><button id="For' . $area_na . '" class="closed_btn sort13' . $ar . '"><i class="glyphicon glyphicon-remove"></i></button></div>'; 
                                       
                                 }

                                 // echo $arr_Area;
                            }

                              if (!empty($City)) {

                                 $City_Arr = explode("|", $City);

                                 foreach ($City_Arr as $cr => $city_na) {

                                        // $pri1 = str_replace(' ', '_', $brand_na);
                                        // $pri1 = str_replace('.', '_', $pri1);
                                        // $pri1 = str_replace('%', '_', $pri1);


                                      $arr_City .= '<div class="select_hold cl_city' . str_replace(' ', '_', $city_na) .'" onclick="SelectOption(' . "'City'" . ',13,' . "'" . $city_na . "'" . ",'" . $city_na . "'" . ",'close'" . ')"><span class="value_btn">' . str_replace('-', ' ', $city_na) . '</span><button id="City' . $city_na . '" class="closed_btn sort13' . $cr . '"><i class="glyphicon glyphicon-remove"></i></button></div>'; 
                                       
                                 }

                                 // echo $arr_City;
                            }

                           if($Search!='All' && !empty($Search)){echo '<div class="select_hold select_hold_check_offer cl_search_close" id="" onclick="SelectOption('."'Search'".',0,'."'".str_replace("'","",$Search)."'".",'".str_replace("'","",$Search)."'".",'close'".')"><span class="value_btn">'.$Search.'</span><button  id="Search'.$Search.'" class="closed_btn sort12"><i class="glyphicon glyphicon-remove"></i></button></div>';}

                      if (empty($Home)) {
                           
                            $show_clear_all = 0;
                            foreach($Sorted_Array as $key1=>$val1)
                                  {

                                  $var_brand = "arr_".$val1;
                             
                                  if(!empty($$val1)){ echo $$var_brand;
                                    $show_clear_all = 1;

                                   }                              

                                  }  

                      }   ?>    

         
    </div>

     <div class="clear_main_append">

           <?     if(empty($Home_Value) && (!empty($show_clear_all) || $Search!='All' && !empty($Search))){
            ?>



             <div class="select_hold" style="margin-bottom: 25px;" onclick="SelectOption('clear', 0, 'clear', 'clear', 'clear')"><span class="value_btn">Clear All</span><button id="'.$val1.$$val1.'" class="closed_btn sort1"><i class="glyphicon glyphicon-remove"></i></button></div>

             <?}?>
             </div>

</div>
<?  if (empty($Sidebar)) { ?>

<div class="nearoffonlineHH" id="offset_top_hei" style="display: inline-block;width: 100%;">

 <a class="nearbyofflinegg nearcommonhh1  nearcchhse " href="/leads"> <span>Request For Proposals (<?=$cnt['leads']?>)</span>                  
                     </a>   
                
    <a class="nearbyallgg nearcommonhh1 nearcchh" href="/enquiries"> <span>Request For Prices (<?=$cnt['price']?>)</span> </a>

</div><br/><?}?>


    <div class="enquiries-table-responsive" style="border:none;">
      

    <? if (!empty($quotes)) { ?>
 
 <?if($Viewby == 'list'){?>
 <div id="leads-list">
              <?php

                  if(COUNT($quotes)>0){?>
                      <div class="lead-table-responsive">
                      <table class="table table-hover">
                      <thead>
                          <tr>
                              <th class="col-xs2">ID</th>
                            
                          <th class="col-xs-4">CUSTOMER NEEDS</th>
                      		<th class="col-xs-2"> D & T</th>
                             
                             <th class="col-xs-2">BUYING DATE</th>
                           
                      		<th class="col-xs-2" style="text-align: center">ASSIST CUSTOMER </th>
                          </tr>
                      </thead>
                      <tbody>
                <!-- Here's where we loop through our $quotes array, printing out post info -->
                     
                <!-- -->


                     <?   foreach ($quotes as $quote) :?>
                     <? if($quote['zone_buy'] !=''){

                        $seller_location=$quote['zone_buy'].', '.$quote['city_name_exact'];
                        
                    }
                    else{

                        $seller_location=$quote['city_name_exact'];
                   }

     ?>
                    
                                          <tr>
                                             
                                              <td class="col-xs-2 txt_all_off_Q">
                                              <?php if($quote['lead_for_exact']=='Business'){$customer="(Business Reqt.)";}else{
                                                $customer="(Personal Reqt.)";
                                                }
                                                if($quote['one2one']==0){
                                                    $one2one="";
                                                }else{
                                                    $one2one="Direct";
                                                }
                                              ?>
                                                  <?php
                                                      //echo "XRVL".$quote['quotes']['quoteid'];
                                                      echo $quote['enquiry_id']."<br/>";
                                                     
                                                      echo $customer."<br/>";
                                                      echo $one2one;
                                                  ?>
                                              </td>
                                      		 
                                               <td class="col-xs4 txt_all_off_Q">
                                                  <?php  
                                                //  echo $quote['productspec'];
                                                 //echo  $quote['quoteid'];

                                          //  $mask=$this->requestAction('/leads/mask_field_index/'.$quote['quoteid']);//hided for now on 24 th oct due to performance issues

                                                 // mask_field_index($quote['quotes']['quoteid']);
                                                  //echo $mask;
                                                 // $mask="enquiry";
                                                  
                                                 echo $this->Text->truncate($quote['productspec'], 50)."<br/>";
                                             
                                      			     //echo $this->Text->truncate($quote['productspec'], 50)."<br/>";

                                                  if($quote['notes']!=''){
                                      			?>
                                                 (Note:<?php 
                                                 echo $this->Text->truncate($quote['notes'], 60);?>)<br/>
                                                 <?} 
                                                 if($seller_location!=''){?>
                                                 (<?php echo $seller_location;?>)
                                                 <?}?>
                                              </td> 
                                              
                                      		 <td class="col-xs2 txt_all_off_Q">
                                         
                                                  <?php 
                                                  //echo "is".date('y-m-d');
                                                  // print_r($quote['enquiry_time'])."<br>";
                                                  // $date = date($quote['enquiry_time'],'H:i:A,d M Y, D');
                                                 // echo $date;
                                                  // echo $this->Time->format($quote['enquiry_time'], '%l:%M %p, %e %b %Y, %a '); ?>
                                    <?  //$date1 = date_create($quote['enquiry_time']);?>
                                    <?//echo date_format($date1, 'g:i A,  j M Y, D'); ?>
<?php echo $this->Time->format($quote['enquiry_time'], '%l:%M %p, %e %b %Y, %a '); ?><br/>
 <? $today = date('Y-m-d');
   

$expiry_date=$quote['buyingdate'];
$expiry_date= date('Y-m-d', strtotime($expiry_date. ' + 1 days'));
$receiver=$quote['user_id'];

//echo $expiry_date;
    

                         if(($today >= $expiry_date )||($quote['status']==5)){

                                      if($quote['status']==5){
                                        
                                          echo"<span class='uspause'>Paused</span>";
                                       }//paused lead
                                       else{
                                    
                                        echo"<span class='usexp'>Expired</span>";
                                       }//expired lead
                         
                            }else{
                                 echo"<span class='uslive'>Live! </span>";
                            }
 ?>

                                      			<?php //echo $this->Time->timeAgoInWords($quote['quotes']['enquiry_time']);?>
                                              </td>
                                             
                                              <td class="col-xs2 txt_all_off_Q">
                                                <? //echo $quote['buyingdate'] ?>
                                                <? echo $this->Time->format($quote['buyingdate'], '%d-%m-%Y');?>

                                            </td>
                                          
                                               <?php  
                                                  if($quote['status']== 1){$quotestatus="Approved";$cssstatus="approved";}
                                                  if($quote['status']== 2){$quotestatus="Pending";$cssstatus="pending";}
                                                  if($quote['status']== 0){$quotestatus="Disappoved";$cssstatus="disapproved";}
                                                  if($quote['status']== 4){$quotestatus="Bid Closed By Customer";$cssstatus="closed";}
                                                  if($quote['status']== 5){$quotestatus="Bid Finalized By Customer";$cssstatus="selected";}
                                                  ?>
                                            
                                             <td class="vwdetbtnatenq col-xs-3 txt_all_off_Q">
                                             <span class="view_details ">
                                             <input type="hidden" id="quoteno" name="quoteno" value="<?php echo $quote['quoteid'];?>" />
                                                  <?php
                                                      //echo $this->Html->link('View Details', array('controller'=>'leads','action' => 'details', "XRVL".$quote['quotes']['quoteid']));
                                                    
                                         
                    if(($today >= $expiry_date )||($quote['status']==5)){

                                      if($quote['status']==5){
                                        
                 echo $this->Html->link('View Details', array('controller'=>'leads','action' => 'index',$quote['enquiry_id']),array('target' => '_blank','class'=>'btpause'));
                                                 
                                       }//paused lead
                                       else{
                                    
                   echo $this->Html->link('View Details', array('controller'=>'leads','action' => 'index', $quote['enquiry_id']),array('class'=>'btexp','target' => '_blank'));
                                                 
                                       }//expired lead
                         
                            }else{
                            	//echo $User_Id;
                if($sid_id==''){                
                echo $this->Html->link('View Details', array('controller'=>'leads','action' => 'index', $quote['enquiry_id']),array('target' => '_blank','class'=>'btlive'));
                }else{
                   echo $this->Html->link('View Details', array('controller'=>'leads','action' => 'index', $quote['enquiry_id'],$sid_id),array('target' => '_blank','class'=>'btlive'));
                 
                }
                                                 
                            }
 ?>
                                      			<!--/button-->
                                               </span>
                                              </td>
                                          </tr>
                        <?php endforeach; ?>
	

    
                  </tbody>
                  </table>
                  </div>
                  </div><!--leads-list -->
                  <?php }//quotes

                  } //list?>

<!--grid format -->
<?php if($Viewby == 'grid'){?>
<div id="leads-grid" style="margin-top:15px">
<?php 
if(COUNT($quotes)>0){?>
              <ul class="lead-hold-all">
              <?php foreach ($quotes as $quote) :?>
               <li>
                     
                     <div class="lead-list-hold">
                     <div class="lead-list">
                           <div class="row"> 
                                <span class="camel-clr"><h6>Lead Id :</h6></span>
                                  <span>
                                   <?php echo $quotestatus;?><?php echo $quote['enquiry_id']; ?></span>    
                           </div>

                           <div class="row">
                              <span class="camel-clr"><h6>Requirement Type:</h6></span> 
                              <?php if($quote['lead_for_exact']=='Business'){$customer="Business ";}else{
                                                $customer="Individual ";
                                              }
                                              ?>
                                              <span class="camel-clr"><?=$customer?></span> 
                           </div>
                    
                    
                         
                     <div class="row">

                               <div id="hidden_msg<?php echo $quote['quoteid']; ?>" class="clnt-msg fixed_height">
                                  <span class="camel-clr"> Requirement:</span> 
                               <?php 
                              // $mask=$this->requestAction('/leads/mask_field_index/'.$quote['quoteid']);

                                $mask=$quote['productspec'];

                                //echo $this->Text->truncate($mask, 60);
                                 
                                                 echo $this->Text->truncate($quote['productspec'], 50)."<br/>";
                                            
                                 if($quote['notes']!=''){
                                                ?>
                                                 (Note:<?php 
                                                 echo $this->Text->truncate($quote['notes'], 60);?>)
                                                 <?}?>
                         
                              
                                                        
                               </div>
                     </div>
                     <div id="info<?php echo $quote['quoteid']; ?>" class="show-me-details" style="min-height:65px; line-height:22px;">          
                     
                      <div class="row"><span class="camel-clr">Enquiry D & T: </span>
                       <span ><?php echo $this->Time->format($quote['enquiry_time'], '%l:%M %p, %e %b %Y, %a '); ?><br/>
                            <? $today = date('Y-m-d');?>
                            
                            <?
                            $receiver=$quote['user_id'];
                            ?>
                            </span>
                        </div>

                                             <div class="row">
                                                <? //echo $quote['buyingdate'] ?>
                                                 <span class="camel-clr"><h6>Buying Date:</h6></span>   
                                                <? echo $this->Time->format($quote['buyingdate'], '%d-%m-%Y');?>

                                             </div>

                        <div class="row">
                              <span class="camel-clr"><h6>Enquiry Status:</h6></span>      
<?
$expiry_date=$quote['buyingdate'];
$expiry_date= date('Y-m-d', strtotime($expiry_date. ' + 1 days'));

                         if(($today >= $expiry_date)||($quote['status']==5)){

                                      if($quote['status']==5){
                                        
                                          echo"<span class='uspause'>Paused</span>";
                                       }//paused lead
                                       else{
                                    
                                        echo"<span class='usexp'>Expired</span>";
                                       }//expired lead
                         
                            }else{
                                 echo"<span class='uslive'>Live! </span>";
                            }
                          ?>

        


                       </span>

                      </div>

                          
                      
                     
                     </div>
                     </div>
                     <!--<a id="show<?php echo $quote['quoteid']; ?>" class="view-hidden show-me" onclick="show_details(<?php echo $quote['quoteid']; ?>)"></a>-->
                     <div class="row">

                    
                     <?php
                      if(($today >= $expiry_date)||($quote['status']==5)){//expired or paused

                                      if($quote['status']==5){//paused
                                        
                                          echo $this->Html->link('View Details', array('controller'=>'leads','action' => 'index',$quote['enquiry_id']),array('target' => '_blank','class'=>'connect-client btpause'));
                                                 
                                       }//paused lead
                                       else{
                                    
                   echo $this->Html->link('View Details', array('controller'=>'leads','action' => 'index',$quote['enquiry_id']),array('class'=>'btexp connect-client ','target' => '_blank'));
                                                 
                                       }//expired lead
                         
                            }//expired or paused
                            else{
                         if($sid_id==''){                
                echo $this->Html->link('View Details', array('controller'=>'leads','action' => 'index', $quote['enquiry_id']),array('target' => '_blank','class'=>'btlive'));
                }else{
                   echo $this->Html->link('View Details', array('controller'=>'leads','action' => 'index', $quote['enquiry_id'],$sid_id),array('target' => '_blank','class'=>'btlive'));
                 
                }
                    
                    }//live
                       ?>
                     
                     </div>
                      </div>
                      </li>
                      <?php endforeach; ?>
              </ul>
<?php }//if quotes

?>
</div><!--leads-grid -->
<?php }?>

  <? }else{ ?>
    

        <div class="txt_black20" align="left" style="padding-bottom: 20px; margin-left: 13px;padding-top:10px;">
                       <div style="margin-top:10px;color:#000;margin-bottom:0px;">

  <span id="both_st_add" class="both_st_add<?= $For ?>"><p class="no_result_search_latest"> No Matches Found.</p>
                        <br>
<p class="no_rst_anor_sea">Please Try Another Search or Selection.</p><br><p class="no_rst_all_f" onClick="SelectOption('clear',0,'clear','clear','clear')"> X Clear Search & All Filters</p></span>

</div>

</div>

 <?  } ?>



    </div>

</div>

</div>



<?}else{?>

<?php echo $this->element('chat_full_details'); ?>


<?}?>


<script type="text/javascript">
jQuery(document).ready(function($) {




lazyloads_main();

});


        function lazyloads_main(){




                    var page_height = $("#single_page_height_main").val();

                    if (page_height=='') {

                        page_height = $('.right-section').outerHeight(true);
                        $("#single_page_height_main").val(page_height);
                        var show_next = 0;
                    }else{
                        var show_next = 1;
                    }

                    }
</script>

<?
function capitalize_words($string){

    $string = strtolower($string);

    $string1 = explode(" ", $string);

    $avoid_ar = array("a","an","and","are","as","at","be","but","by","for","if","in","into","is","it","no","not","of","on","or","such","that","the","their","then","there","these","they","this","to","was","will","with");

    foreach ($string1 as $key => $val_s) {
        
        if (in_array($val_s, $avoid_ar)) {
            $Search_Arry1[] = $val_s;
        }else{

            if (strpos($val_s, "(") === 0) {

                $val_s[1]= strtoupper($val_s[1]);

                $Search_Arry1[] = $val_s;
            }else{
                $Search_Arry1[] = ucfirst($val_s);
            }
        }

    }
          
    $string2 = implode(" ", $Search_Arry1);

    return $string2;

}
?>