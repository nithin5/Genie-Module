<?php
App::uses("AuthComponent", "Controller/Component");
class GenieUser extends AppModel {
	var $name = 'users';
	var $primaryKey = 'id';
	public function alphaNumericDashUnderscore($check) {
		$value = array_values($check);
		$value = $value[0];
		return preg_match('|^[0-9a-zA-Z_-]*$|', $value);
	}
	public function beforeSave($options = array()) {
	    $passcode = $this->data[$this->alias]["password"];
		if (isset($this->data[$this->alias]["password"])) {
			$this->data[$this->alias]["password"] = AuthComponent::password($passcode);
		}
			return true;
	}
	public function view_contact($userid){
      $query=" SELECT mobile_number,office_phone_number FROM users WHERE id='".$userid."'"; 
      $contact=$this->query($query);
                    if($contact[0]['users']['mobile_number']!=''){
                          $view_contact=$contact[0]['users']['mobile_number'];
                    }
                    else{
                          $view_contact=$contact[0]['users']['office_phone_number'];
                    }
      return  $view_contact;             
  }
  public function view_full_contact($userid,$guest_flag){
          if($guest_flag==0){
              $query=" SELECT mobile_number,office_phone_number FROM users WHERE id='".$userid."'"; 
              $contact=$this->query($query);
                    if($contact[0]['users']['mobile_number']!=''){//if there is landline
                            $view_contact=$contact[0]['users']['mobile_number'];
                    }
                    else{
                           $view_contact=$contact[0]['users']['office_phone_number']; 
                    }
          }
          else{
                  $query=" SELECT mobile_number FROM genie_guests WHERE id='".$userid."'"; 
                  $contact=$this->query($query);
                  $view_contact=$contact[0]['genie_guests']['mobile_number'];
          }                                
    return  $view_contact;             
  }
  public function map_guest_mobile($mobile_number){ //not used so far
            $users = ClassRegistry::init('User');
            $map_mobile_query = $users->find('first', array(
            'conditions' => array('mobile_number' => $mobile_number),
            'fields' => array('id'),
        ));
        $mobile_number=$map_mobile_query['User']['id'];
        return $mobile_number; 
    }
  public function get_seller_status($sender_id){
        $find_status_query="SELECT status FROM users WHERE id='".$sender_id."'";
        $seller_status=$this->query($find_status_query);
      return $seller_status[0]['users']['status'];
  }
  public function get_email($userid){
      		$find_email="SELECT business_email from users where id='".$userid."'";
      		$email=$this->query($find_email);
    		return $email[0]['users']['business_email'];
    }
  public function get_mobile($userid){
    		$find_mobile="SELECT mobile_number from users where id='".$userid."'";
    		$mobile=$this->query($find_mobile);
  		return $mobile[0]['users']['mobile_number'];
  	}
  public function get_onlinestatus($userid){ 
      $result =  $this->query("SELECT session FROM users WHERE id='".$userid."'");
      if(COUNT($result) > 0) {
         return $result[0]['users']['session'];
      }
      else{
        return false; 
      } 
    }
  public function get_session_status(){ 
      $online_users=array();
      $online_query="SELECT id,session,session_time FROM users WHERE session='online'";
      $online_users=$this->query($online_query);
      return $online_users; 
    }
  public function get_seller_details($sellerid){
     $sellername_query=array();
     $seller_details="SELECT name_title,first_name,last_name,created,mobile_number,business_email,company_name,leads_displays,leads_displays_count,ded_cnt,city_id,country_id FROM users WHERE id='".$sellerid."'";
     $sellername_query = $this->query($seller_details);
     return $sellername_query;
   }
  public function get_user_pay_det($user_id){
   $user_pay_list=array(); 
   $query="SELECT id,name_title,mobile_number,first_name,last_name,company_name,ded_cnt 
      FROM users WHERE id ='".$user_id."'";
   $user_pay_query = $this->query($query);  
   return  $user_pay_list;
  }

  public function get_seller_address($receiver){
      $User_data=array();
      $query="SELECT name_title,business_email,mobile_number,first_name,last_name,city_id,address,pincode,state,country_id 
      FROM users WHERE id ='".$receiver."'";
      $User_data = $this->query($query);
      return $User_data;
   }
  public function get_user($serverID, $return){ 
        $result =  $this->query("SELECT first_name,last_name,id FROM users WHERE id='".$serverID."'");
        if($result) {
            switch($return){
                case "ID":
                  return $result[0]['users']['id'];
                  break;
                case "USERNAME":
                        $fullname= $result[0]['users']['first_name']." ".$result[0]['users']['last_name'];
                  return $fullname;
                  break;
            }
        }
        else {
          return false; 
        } 
    }
  public function get_username($userid) { 
        $buyerstatus=$this->get_seller_status($userid);
       if($buyerstatus == 0){
              $result =  $this->query("SELECT company_name FROM users WHERE id='".$userid."'");
              $full_name=$result[0]['users']['company_name'];
       }
       else{
             $result =  $this->query("SELECT first_name,last_name FROM users WHERE id='".$userid."'");
             $full_name=$result[0]['users']['first_name']." ".$result[0]['users']['last_name']; 
       }    
        return $full_name;  
    }
  public function credit_balance($user_id){
          $lead_credit="SELECT leads_displays,leads_displays_count FROM users WHERE id='".$user_id."'";
          $credit=$this->query($lead_credit);
          $credit_balance=$credit[0]['users']['leads_displays_count'] - $credit[0]['users']['leads_displays'];
      return $credit_balance;
    }
  public function get_session_time($serverID) {
      $result =  $this->query("SELECT session_time FROM users WHERE id = '".$serverID."'");
      if( COUNT($result) > 0){ 
        return $result[0]['users']['session_time'];
      }else {
        return false; 
      } 
  }
  public function get_company_name($sidsellerid) {
     $sid_company_query =  $this->query("SELECT company_name FROM users WHERE id='".$sidsellerid."'");
     $sid_vendorname=$sid_company_query[0]['users']['company_name'];
   return $sid_vendorname;
 }
 public function get_full_name($sellerid) {
    $sellername_query1="SELECT first_name,last_name FROM users WHERE id='".$sellerid."'";
    $sellername_query =  $this->query($sellername_query1);
    $fullname=ucfirst($sellername_query[0]['users']['first_name'])." ".ucfirst($sellername_query[0]['users']['last_name']);
  return $fullname;
 }
 public function get_user_id($mobile_number) {
    $users = ClassRegistry::init('User');
    $map_member_query = $users->find('first', array(
                                   'conditions' => array(
                                                        'mobile_number' => $mobile_number,
                                                        'activated'=>1,
                                                         ),
                                                         'fields' => array('id'),
                                                  )
                                                );
    $member_user_id=$map_member_query['User']['id'];
  return $member_user_id;
}
public function get_business_info($User_Id) {
    $credit=array();
    $lead_credit="SELECT first_name,last_name,company_name,business_email,mobile_number,leads_displays,leads_displays_count 
    FROM users WHERE id='".$User_Id."'";
    $credit=$this->query($lead_credit);
  return $credit;
}   
public function get_user_categories(){
    $lists=array();
    $query_1="CALL get_user_categories()"; 
    $lists=$this->query($query_1);
    return $lists;          
}              
public function get_full_address($latitude,$longitude){
      $details=array();
      $query="CALL get_full_address('".$latitude."','".$longitude."')";
      $details=$this->query($query);
      return $details;
}
public function get_user_details($userid,$quoted_user){
    $users_result=array();
    $users_query="CALL get_user_details('".$userid."','".$quoted_user."')";
    $users_result=$this->query($users_query);
  return $users_result;
}
public function get_user_loc_details($userid){
    $seller_loc_result=array();  
    $seller_loc_query=" CALL get_user_loc_details('".$userid."')";
    $seller_loc_result=$this->query($seller_loc_query);
  return $seller_loc_result;
}
public function get_user_basic_details($quoted_user){
  $buyername_query=array();
  $query="SELECT id,name_title,first_name,last_name,company_name,business_email,mobile_number
  FROM users WHERE id='".$quoted_user."'";
  $buyername_query =  $this->query($query);
 return $buyername_query;
}
public function get_gender($userid) { 
      $result =  $this->query("SELECT name_title FROM users WHERE id='".$userid."'");
      $full_name=$result[0]['users']['name_title'];
      if($full_name ==1){
        $gender="Mr";
      }
      if($full_name ==2){
        $gender="Ms";
      }
      if($full_name ==''){
        $gender="Mr";
      }
  return $gender;  
}
public function check_user_offline($serverid){
        $query="SELECT session FROM users WHERE id='".$serverid."'";
        $buyer_online_status_query = $this->query($query);
        $buyer_online=$buyer_online_status_query[0]['users']['session']; 
  return $buyer_online;
}
public function get_offline_seller_id($sidid){//to be changed
      $sidquery="SELECT vid FROM offline_sellers WHERE seller_type=1 AND seller_id='".$sidid."'";
      $sid_query =  $this->query($sidquery);
      $sidsellerid=$sid_query[0]['offline_sellers']['vid'] ;
  return $sidsellerid;
}
public function get_bl_details($cat_id,$city_id,$subcat_id,$zone_id){//to be changed
      $SellerName = array();
      $where=" WHERE business_listing_categories.deleted_flag=0 AND users.activated=1 ";
      if($cat_id !=''){
              $where .=" AND business_listing_categories.category_id='".$cat_id."' ";  
      }
      if($city_id !=''){
              $where .=" AND business_listing_categories.city_id='".$city_id."'";
      } 
      if($zone_id !=''){
              $where .=" AND business_listing_categories.area_id='".$zone_id."'";
      } 
      if($subcat_id !=''){
              $where .=" AND business_listing_categories.sub_category_id='".$subcat_id."'";
      }
      //echo $where;
     $query="SELECT DISTINCT(users.id),company_name,first_name,last_name,mobile_number,office_phone_number,business_email,leads_displays_count,leads_displays FROM users INNER JOIN business_listing_categories ON(users.id=business_listing_categories.user_id) $where ";
    //echo $query;
     $SellerName = $this->query($query);
  return $SellerName;
}
public function get_bl_cat_id($seller_id,$quote_cat_id){//to be changed
    $query="SELECT category_id FROM business_listing_categories WHERE user_id='".$seller_id."' AND category_id='".$quote_cat_id."'";
    $result=$this->query($query);
  return $result;
}
public function get_sidid($receiver){//to be changed
    $sidquery="SELECT seller_id FROM offline_sellers WHERE seller_type=1 AND vid='".$receiver."'";
    $sid_query =  $this->query($sidquery);
    $sidsellerid=$sid_query[0]['offline_sellers']['seller_id'] ;
  return $sidsellerid;
}
public function get_offline_sid_id($receiver){//to be changed
    $sidquery="SELECT seller_id FROM offline_sellers WHERE seller_type=1 AND vid='".$receiver."'";
    $sid_query =  $this->query($sidquery);
    $sidsellerid=$sid_query[0]['offline_sellers']['seller_id'] ;
  return $sidsellerid;
}
public function get_bl_cat_id_cnt($seller_id,$cat_id){//to be changed
    $query="SELECT category_id FROM business_listing_categories WHERE user_id='".$seller_id."' AND category_id='".$cat_id."'";
    $result=$this->query($query);
    $found=COUNT($result);
  return $found;  
}
/*update operations starts*/
public function up_user_session($user_id,$session){
    $query ="UPDATE users SET  session = '".$session."',session_time = NOW() WHERE id = '".$user_id."'";
    $result =  $this->query($query);
}
public function up_user_credit($credits,$User_id){
  $query=" UPDATE users SET leads_displays_count = leads_displays_count + '".$credits."' WHERE id = '".$User_id."' "; 
  $this->query($query);
}
public function up_user_credit_ded($credits,$User_id){
  $query=" UPDATE users SET leads_displays = leads_displays + '".$credits."',
  ded_cnt=ded_cnt+1 WHERE id = '".$User_id."' "; 
  $this->query($query);
}
public function up_user_credit_pay($leads,$position,$User_Id){
  $query="update users set leads_displays_count=leads_displays_count+$leads,download_yes=1,position=$position where id=$User_Id ";
  $this->query($query);
}

public function up_user_credit_pay_full($amount,$position,$credited,$User_Id){
 $query="update users set leads_displays_count=leads_displays_count+$amount,download_yes=1,position=$position,leads_displays = leads_displays + $credited,ded_cnt=ded_cnt+1 where id=$User_Id ";
 $this->query($query);
}

public function up_user_credit_full($amount,$position,$User_Id){
$query="UPDATE users SET leads_displays_count=leads_displays_count+$amount,download_yes=1,position=$position,leads_displays = leads_displays + $amount,ded_cnt=ded_cnt+1 WHERE id=$User_Id ";
  $this->query($query);
}
public function set_user_sessionStatus($clientID, $status){   
      switch($status)
      {
        case "ONLINE":  
          $query="SELECT session FROM users WHERE id = '".$clientID."'";
          if(($result[0]['users']['session'] == 'offline') || ($result[0]['users']['session'] == '')){

         $query="UPDATE users SET session = 'online', session_time = NOW() WHERE id = '".$clientID."'" ;
          $result = $this->query($query);
            if($result)
            {
              return true;  
            } else {
              return false; 
            }
          } else {
            return false; 
          }
        break;
        case "OFFLINE":
        $query ="UPDATE users SET  session = 'offline',session_time = NOW() WHERE id = '".$clientID."'";
        $result =  $this->query($query);
          if($result)
          {
            return true;  
          } else {
            return false; 
          }
        break;
      }
    }
/*update operations ends*/    
}