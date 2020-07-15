<?php
class Lead extends AppModel {
  var $name = 'quotes';
	var $primaryKey = 'quoteid';
public function get_quote_st($quoteid){
   $quote_status=array();
   $query="CALL get_quote_st('".$quoteid."')";
   $quote_status = $this->query($query);
  return $quote_status;
}
public function get_catcitycombo($cat_id) {
  $query="CALL get_catcitycombo('".$cat_id."')";
	$City_List=$this->query($query);
	return $City_List;
}
public function get_city_cat_combo($city_id) {
  $query="CALL get_city_cat_combo('".$city_id."')";
	$Genie_Category=$this->query($query);
	return $Genie_Category;
}
public function getaskcnt($quoteid){
		$query="SELECT ask_cnt FROM quotes WHERE quoteid='".$quoteid."' ";
		$inform_cnt=$this->query($query);
		return $inform_cnt[0]['quotes']['ask_cnt'];
}
public function getotp($quoteid){
    $query="SELECT genie_verify_code FROM quotes WHERE quoteid='".$quoteid."' ";
    $inform_cnt=$this->query($query);
    return $inform_cnt[0]['quotes']['genie_verify_code'];
}
public function get_verify_code($otp_number){
    $query="SELECT genie_verify_code FROM quotes WHERE genie_verify_code='".$otp_number."' and genie_status=0 ";
    $inform_cnt=$this->query($query);
    return $inform_cnt[0]['quotes']['genie_verify_code'];
} 
public function get_verify_code_for_resend($quote_id){
  $otp_query="SELECT genie_verify_code FROM quotes 
  WHERE quoteid='".$quote_id."' AND genie_status=0 AND status=6 AND genie_verified=0";
  //echo $otp_query;
  $verify_code=$this->query($otp_query);
  return $verify_code[0]['quotes']['genie_verify_code'];
}               
public function get_status($quoteid){ 
   $query="SELECT status FROM quotes WHERE quoteid='".$quoteid."' ";
   $quote_status=$this->query($query);
   return $quote_status[0]['quotes']['status'];
}
public function getquotetime($quoteid){ 
   $query="SELECT enquiry_time FROM quotes WHERE quoteid='".$quoteid."' ";
   $quote_status=$this->query($query);
   return $quote_status[0]['quotes']['enquiry_time'];
}
public function get_pausetime($quoteid){ 
   $query="SELECT pause_time FROM quotes WHERE quoteid='".$quoteid."' ";
   $pause_time=$this->query($query);
   return $pause_time[0]['quotes']['pause_time'];
}  
public function offer_marker($quote_id){
  $offer_marker="UPDATE quotes SET offer_marker=1 WHERE quoteid='".$quote_id."' ";
  $this->query($offer_marker);
}
public function getproductspec($quoteid){
    $query="SELECT productspec FROM quotes WHERE quoteid='".$quoteid."' ";
    $productspec=$this->query($query);
    return $productspec[0]['quotes']['productspec'];
}
public function get_productspec($enquiry_id){
    $query="SELECT productspec FROM quotes WHERE enquiry_id='".$enquiry_id."' ";
    $productspec=$this->query($query);
    return $productspec[0]['quotes']['productspec'];
}  
public function getproductmask($quoteid){
    $query="SELECT productmask FROM quotes WHERE quoteid='".$quoteid."' ";
    $productmask=$this->query($query);
    return $productmask[0]['quotes']['productmask'];
}
public function get_buyingdate($quoteid){
    $query="SELECT buyingdate FROM quotes WHERE quoteid='".$quoteid."' ";
    $quoteid=$this->query($query);
    return $quoteid[0]['quotes']['buyingdate'];
}
public function get_quoteid($enquiry_id){
    $query="SELECT quoteid FROM quotes WHERE enquiry_id='".$enquiry_id."' ";
    $quoteid=$this->query($query);
    return $quoteid[0]['quotes']['quoteid'];
}
public function get_enquiryid($quoteid){
    $query="SELECT enquiry_id FROM quotes WHERE quoteid='".$quoteid."' ";
    $enquiry_id=$this->query($query);
    return $enquiry_id[0]['quotes']['enquiry_id'];
}//get enquiry id  
public function get_b2c($quoteid){
	$find_b2c="SELECT b2c from quotes where quoteid='".$quoteid."'";
	$b2c=$this->query($find_b2c);
	return $b2c[0]['quotes']['b2c'];
}
public function get_formid($quoteid){
	$find_form_id="SELECT formid FROM quotes WHERE quoteid='".$quoteid."'";
	$form_id=$this->query($find_form_id);
	return $form_id[0]['quotes']['formid'];
}
public function get_catid($quoteid){
  $query="select cat_id from quotes where quoteid='".$quoteid."'";
  $result = $this->query($query);
  return $result[0]['quotes']['cat_id']; 
}
public function get_quoteuser($quoteid){
  $query="select user_id from quotes where quoteid='".$quoteid."'";
  $result = $this->query($query);
  return $result[0]['quotes']['user_id'];      
}
public function get_guest_flag($quote_id){
    $find_guest_flag="SELECT guest_flag from quotes WHERE quoteid='".$quote_id."'";
    $guest_flag=$this->query($find_guest_flag);
    return $guest_flag[0]['quotes']['guest_flag'];
 }
public function get_quote_full_details($enquiry_id){
   $details=array();
   $query="CALL get_quote_full_details('".$enquiry_id."')";
   $details=$this->query($query);
   return $details;
}

public function get_quote_quan_det($quoteid){
  $quantity_query=array();  
  $query="SELECT full_name,cat_id,quantity,budget,zone_buy,city_buy,genie_url 
  FROM quotes WHERE quoteid='".$quoteid."'";
  $quantity_query =  $this->query($query);
  return $quantity_query;
}

public function get_full_quotes($enquiry_id){
  $details=array();
  $details= $this->find('first', array(
                          'conditions' => array('Lead.enquiry_id' => $enquiry_id)
                      ));
  return $details;
}
public function get_join_sms_details($quote_id){
  $quotes=array();
  $query="SELECT full_name,productspec,genie_links FROM quotes WHERE quoteid='".$quote_id."'";
  $quotes=$this->query($query);
  return $quotes;
}
public function get_tot_contact_prio($quoteid){ //get the no of sellers contacted for an enquiry
  $query="SELECT contact_prio FROM quotes WHERE quoteid='".$quoteid."' ";
  $contact_prio=$this->query($query);
  return $contact_prio[0]['quotes']['contact_prio'];
}
public function get_quote_id_dt(){
  $lists=array();  
  $query="SELECT quoteid FROM quotes WHERE enquiry_time > '2017-07-01 00:00:00'";
  $lists=$this->query($query);
  return $lists;
}
public function get_quote_loc($quoteid){
  $find_loc=array();
  $find_loc_query="SELECT city_buy,city,zone_buy,zone from quotes where quoteid='".$quoteid."'";
  $find_loc=$this->query($find_loc_query);
  return $find_loc;
}
public function up_priority_cnt($enquiry_id){
 $contact_query=" UPDATE quotes SET contact_prio = contact_prio+1 WHERE enquiry_id = '".$enquiry_id."' "; 
 $this->query($contact_query);
}
public function up_full_pause_st($quote_id,$pause_time,$reason_pause){
  $query = "UPDATE quotes SET status=5,pause_time='".$pause_time."',pause_reason='".$reason_pause."'
  WHERE quoteid='" . $quote_id . "' ";
  $id = $this->query($query);
  return $id;
}
public function up_pause_st($quote_id){
      $query="UPDATE quotes SET status=5 where quoteid='".$quote_id."' ";
      $id=$this->query($query);
  return $id;
} 
public function up_genie_verify_code($quote_id,$Unique_Id_otp){
  $query="UPDATE quotes SET genie_verify_code='".$Unique_Id_otp."',genie_status='0' WHERE quoteid='".$quote_id."'";
  $this->query($query);    
}
public function up_pending_st($quote_id){
      $quote_query="UPDATE quotes SET status=2,genie_verified=1  WHERE quoteid='".$quote_id."'";
      $this->query($quote_query); 
}
public function up_pending_st_time($quote_id,$enquiry_time){
      $quote_query="UPDATE quotes SET status=2,genie_verified=1,enquiry_time='".$enquiry_time."'  WHERE quoteid='".$quote_id."'";
      $this->query($quote_query); 
}
public function up_pending_st_1($verified){
  $otp_query_update="UPDATE quotes SET status=2,genie_verified=1,genie_status=1 
  WHERE genie_verify_code='".$verified."' ";
  $this->query($otp_query_update);   
}  
public function up_pending_st_2($verified,$time){
  $otp_update="UPDATE quotes SET status=2,genie_verified=1,genie_status=1,enquiry_time='".$time."' WHERE genie_verify_code='".$verified."' ";
   $this->query($otp_update);  
}  
public function up_quotes($product,$budget,$quantity,$area,$city,$state,$time,$email,$quote_id){
   $query="UPDATE quotes SET productspec='$product',budget='$budget',quantity='$quantity',zone_buy='$area',city_buy='$city',state_buy='$state',enquiry_time='$time',email='$email' WHERE quoteid='$quote_id'"; 
   $this->query($query); 
}
public function up_quotes_1($product,$budget,$quantity,$area,$city,$state,$time,$ask_cnt,$quote_id){
  $query="UPDATE quotes SET productspec='".$product."',budget='".$budget."',quantity='".$quantity."',zone_buy='".$area."',city_buy='".$city."',state_buy='".$state."',enquiry_time='".$time."',ask_cnt='".$ask_cnt."' WHERE quoteid='".$quote_id."'";
    $this->query($query);  
} 
public function up_quotes_camp($product,$budget,$quantity,$area,$city,$state,$l,$time,$email,$quote_id){
  $query="update quotes set productspec='".$product."',budget='".$budget."',status=2,genie_verified=1,genie_status=1,quantity='".$quantity."',zone_buy='".$area."',city_buy='".$city."',state_buy='".$state."',lunch='".$l."',enquiry_time='".$time."',email='".$email."' where quoteid='".$quote_id."'";
  $this->query($query);
}
public function up_push_st_1($enquiry_id,$userid,$receiver){
  $mark_status_push_query="UPDATE push_notifications SET status='0',checked='1' WHERE sender = '".$userid."' AND receiver = '".$receiver."' AND enquiry_id='".$enquiry_id."'";  
  $this->query($mark_status_push_query);
}
public function up_push_st_2($enquiry_id,$userid,$receiver){
    $mark_status_push_query="UPDATE push_notifications SET status='0' WHERE sender = '".$userid."' AND receiver = '".$receiver."' AND enquiry_id='".$enquiry_id."'";  
    $this->query($mark_status_push_query); 
} 
   
}