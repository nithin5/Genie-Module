 <?php
class GenieGuest extends AppModel {

  var $name = 'genie_guests';
	var $primaryKey = 'id';
     
  
public function get_guest_mobile_lat($userid){
   $find_mobile="SELECT mobile_number from genie_guests where id='".$userid."'";
   $mobile=$this->query($find_mobile);
  return $mobile[0]['genie_guests']['mobile_number'];
} 

public function get_onlinegueststatus($userid){ 
              $result =  $this->query("SELECT session FROM genie_guests WHERE id='".$userid."'");
              if(COUNT($result) > 0) 
              {
              return $result[0]['users']['session'];
              }
              else {
                return false; 
              } 
}// Get online status based on a user id
public function get_guest_id($mobile_number) {   
      $map_guest_query = $this->find('first', array(
                                                    'conditions' => array(
                                                    'mobile_number' => $mobile_number,
                                                    'activated'=>1,
                                                    'guest_flag'=>1,
                                                    'deleted_flag'=>0,
                                                                ),
                                                                    'fields' => array('id'),
                                                    )
                                            ); 
      $member_guest_id=$map_guest_query['GenieGuest']['id'];
 return $member_guest_id;
}   

public function get_verify_code($otp_number) { 
    $otp_query="SELECT verify_code FROM genie_guests WHERE verify_code='".$otp_number."' and status=0 and deleted_flag=0";
    $verify_code=$this->query($otp_query);
    $verified=$verify_code[0]['genie_guests']['verify_code']; 
  return  $verified;     
}	

public function get_activation_code_for_resend($quoted_user) { 
    $otp_query="SELECT activation_code FROM genie_guests WHERE id='".$quoted_user."' and status=0 and activated=0 and deleted_flag=0";
    $verify_code=$this->query($otp_query);
    $code=$verify_code[0]['genie_guests']['verify_code'];
  return $code;
}

public function get_guest_temp_id($id){   
       $temp_id = $this->find('first', 
                                array(
                                      'conditions' => 
                                                    array('id' => $id,'activated'=>1 ),
                                                          'fields' => array('temp_uid'),
                                                     )
                                      );
      $temp_guest_id=$temp_id['GenieGuest']['temp_uid'];
  return $temp_guest_id;	
}

public function get_session_time($serverID) {
      $result =  $this->query("SELECT session_time FROM genie_guests WHERE id = '".$serverID."'");
      if( COUNT($result) > 0){ 
        return $result[0]['users']['session_time'];
      }
      else {
        return false; 
      } 
}

public function up_gg_vc($guest_id,$otp){
  $query="UPDATE genie_guests SET verify_code='$otp',status='0' WHERE id='$guest_id'";
  $this->query($query);
}

public function up_gg_act($verified){
  $query="UPDATE genie_guests SET activated=1,status=1 WHERE verify_code='".$verified."'";
  $this->query($query);
}

public function up_guest_session($user_id,$session){
    $query ="UPDATE genie_guests SET  session = '".$session."' WHERE id = '".$user_id."'";
    $result =  $this->query($query);
  }


}