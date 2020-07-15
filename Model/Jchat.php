<?php
class Jchat extends AppModel{

	public $useTable = 'messages';
	
	var $primaryKey = 'id';

	public function array_values_recursive($ary) {
		$lst = array();
		foreach( array_keys($ary) as $k ) 
		{
			$v = $ary[$k];
			if(is_scalar($v)) 
			{
				$lst[] = $v;
			} elseif (is_array($v)) {
				$lst = array_merge($lst, $this->array_values_recursive($v));
			}
		}
		return $lst;
	}
		
		
	public function escape($arg){
		return $this->mysql->real_escape_string($arg);
	}
		
    public function sanitize_integer($get_id){
		$sanitize = strip_tags($get_id);
		$sanitize = str_replace("'","", $sanitize);
		$sanitize = str_replace('"', "", $sanitize);
		$sanitize = (int) $sanitize;
		if(is_int($sanitize))
		{
			return $sanitize;
		}
		$sanitize = substr($sanitize, 0, strpos($sanitize, ' '));
		preg_match("/^\d+$/", $sanitize, $matches);	
		if(!empty($matches['0']))
		{
			return $matches['0'];	
		}
    }
		
	public function results($result){
			$result_array = array();
			for($i = 0; $row = $this->fetch_row($result); $i++)
			{
			   $result_array[$i] = $row; 
			}
		return $result_array;
	} 
	
	
	public function error(){
		return $this->mysql->error;
	}	
	
	public function error_number(){
		return $this->mysql->errno;	
	}
	
	
	public function insert_id(){
		return $this->getInsertID();	
	}
		
    public function first_msg_status($quoteid,$sellerid,$buyerid){
      $query="SELECT COUNT(*) AS sum FROM messages WHERE quoteid='".$quoteid."' AND user_id='".$sellerid."' AND receiver='".$buyerid."' AND intromsg=1 AND status='unread'";
      $result =  $this->query($query);
      $cnt= $result[0][0]['sum'];
      return $cnt;
    }

    public function req_msg_status($enquiry_id,$serverid,$userid){
        $query="SELECT COUNT(*) AS sum FROM messages WHERE enquiry_id='".$enquiry_id."' AND user_id='".$serverid."' AND receiver='".$userid."' AND intromsg=2 AND status='unread'";
     $result =$this->query($query);
     $cnt= $result[0][0]['sum'];
     return $cnt;
    }   


public function get_chatintro_enqid($enquiry_id,$quoted_user,$receiver){
   $check_sid_intro_result=array();
   $check_sid_intro_query="SELECT * from messages WHERE enquiry_id='".$enquiry_id."' AND user_id='".$quoted_user."' AND receiver='".$receiver."' AND intromsg=2";
   $check_sid_intro_result =  $this->query($check_sid_intro_query); 
return $check_sid_intro_result;
}

public function getchatintro($quoteid,$sellerid){
       $query="SELECT messages from messages where quoteid='".$quoteid."' AND user_id='".$sellerid."' AND intromsg=1";
       $result =  $this->query($query);
   return $result;
}
  
public function get_messages_id($sender, $receiver,$quoteid){
 $query="SELECT id, user_id,intromsg, receiver,messages,time,read_time,status,offer_flag FROM messages
        WHERE (user_id = '".$sender."' AND receiver = '".$receiver."' AND quoteid='".$quoteid."') 
        || (user_id = '".$receiver."' AND receiver = '".$sender."' AND quoteid='".$quoteid."') ORDER BY time asc";
 $result = $this->query($query);
    if(!empty($result)){
      return $result;
    } 
    else{
      return false; 
    }
}
 
public function getmsgcnt($clientID,$serverid,$quoteid){
    $query=" SELECT count(*) as cnt FROM messages  WHERE (user_id = '".$clientID."' AND receiver = '".$serverid."' AND quoteid='".$quoteid."') || (user_id = '".$serverid."' AND receiver = '".$clientID."' AND quoteid='".$quoteid."')"; 
    $msg_cnt=$this->query($query);
    return  $msg_cnt[0][0]['cnt'];
}  

public function get_seller_response_count($quoteid){
	$count = $this->find('count', array(
	          'conditions' => array('quoteid' =>$quoteid,'leads_downloaded'=>'2')
	      ));
	return $count; 	
}

public function get_msg_status_time($quoteid,$userid,$receiver){
	$unread_status_query="SELECT status,time from messages where quoteid='".$quoteid."' AND user_id='".$userid."' AND receiver='".$receiver."' AND intromsg=1";
	$unread_status=$this->query($unread_status_query);
	return $unread_status;
}

public function get_last_msg($User_Id,$quoteid){
	  $query= "SELECT * FROM messages a WHERE a.receiver='".$User_Id."' AND a.quoteid='".$quoteid."' AND
	       a.time=(select max(b.time) FROM messages b
	      WHERE b.receiver='".$User_Id."' AND a.user_id=b.user_id AND b.quoteid='".$quoteid."' ) ORDER BY time DESC";
	  $last_msg = $this->query($query);
  return $last_msg;
}


public function get_prev_time($enquiry_id,$userid,$serverid,$guest_user_id,$guest_flag){
  if($guest_flag==0){
 			$msg_prev_time_query="SELECT messages,time FROM messages WHERE enquiry_id='".$enquiry_id."' AND user_id='".$userid."' AND receiver='".$serverid."' AND intromsg=0 ORDER BY id DESC";
  }else{
 			$msg_prev_time_query="SELECT messages,time FROM messages WHERE enquiry_id='".$enquiry_id."' AND user_id='".$userid."' AND guest_user_id='".$guest_user_id."' AND receiver='".$serverid."' AND intromsg=0 ORDER BY id DESC";
 }
    $this->query($msg_prev_time_query);
}

 
public function ajaxupdate($userid,$serverid,$quoteid){
    $query="CALL ajaxupdate('".$userid."','".$serverid."','".$quoteid."') ";
    $messages_ids =$this->query($query);
    return $messages_ids;
}	

public function ajaxupdate_guest($userid,$serverid,$quoteid){
	$query="CALL ajaxupdateguest('".$userid."','".$serverid."','".$quoteid."') "; 
	$messages_ids =$this->query($query);
	return $messages_ids;
}

public function ischatintro($quoteid,$sellerid,$receiver){
	    $query="SELECT count(*) as sum from messages where quoteid='".$quoteid."' AND user_id='".$sellerid."' AND receiver='".$receiver."' AND intromsg=1";
	    $result =  $this->query($query);
    return $result[0][0]['sum'];
}

public function up_msg_read_stat($update_date,$enquiry_id,$serverid,$userid,$backpath){
    $mark_read_msg_query="UPDATE messages SET  status = 'read',read_time='".$update_date."',backpath='".$backpath."' WHERE enquiry_id = '".$enquiry_id."' AND user_id = '".$serverid."' AND receiver='".$userid."' and status='unread'";
    $this->query($mark_read_msg_query);
}

public function up_msg_read_stat_1($update_date,$enquiry_id,$quoted_user,$receiver,$backpath,$guest_flag,$guest_user_id){
      if($guest_flag==0){
     $mark_read_msg_query="UPDATE messages SET  status = 'read',read_time='".$update_date."',backpath='".$backpath."' WHERE enquiry_id = '".$enquiry_id."' AND user_id = '".$quoted_user."' AND receiver='".$receiver."' AND status = 'unread' AND intromsg=2 ";
     }else{
     $mark_read_msg_query="UPDATE messages SET  status = 'read',read_time='".$update_date."',backpath='".$backpath."' WHERE enquiry_id = '".$enquiry_id."' AND user_id = '".$quoted_user."' AND guest_user_id='".$guest_user_id."'  AND receiver='".$receiver."' AND status = 'unread' AND intromsg=2";
     }
    $this->query($mark_read_msg_query);
}

public function up_msg_read_stat_2($update_date,$enquiry_id,$quoted_user,$receiver,$backpath){
 	$mark_read_msg_first_query="UPDATE messages SET  status = 'read',read_time='".$update_date."',backpath='genie1' WHERE enquiry_id = '".$enquiry_id."' AND user_id = '".$userid."' AND receiver='".$receiver."' AND status = 'unread' AND intromsg=1";
 	$this->query($mark_read_msg_first_query);
}

public function up_msg_time($enquiry_time,$quote_id){
    $updatequery=" UPDATE messages SET time = '".$enquiry_time."' WHERE intromsg = 2 and quoteid='".$quote_id."' "; 
    $this->query($updatequery);
}

public function ins_msg_intro_2($spec,$time,$user,$receiver,$quoteid,$enquiry_id,$guest_id){
	if($guest_id>0){
	 	             $chat_query="INSERT INTO messages SET  messages = '".$spec."',intromsg='2',time = '".$time."',user_id = '".$user."',guest_user_id = '".$guest_id."',receiver = '".$receiver."',quoteid='".$quoteid."',enquiry_id='".$enquiry_id."',status = 'unread'";
	}
	else{
	       $chat_query="INSERT INTO messages SET  messages = '".$spec."',intromsg='2',time = '".$time."',user_id = '".$user."',receiver = '".$receiver."',storage_a ='1',storage_b = '2',quoteid='".$quoteid."',enquiry_id='".$enquiry_id."',status = 'unread'";
	}
	  $this->query($chat_query);
}
 
public function ins_msg_intro_off($spec,$time,$user,$receiver,$qid,$eid,$guest_id,$attach,$oflag,$intro){
		if($guest_id>0){
			$query="INSERT INTO messages SET  messages = '".$spec."',intromsg='".$intro."',time = '".$time."',user_id = '".$user."',guest_user_id = '".$guest_id."',receiver = '".$receiver."',storage_a ='".$user."',storage_b = '".$receiver."',quoteid='".$qid."',enquiry_id='".$eid."',status = 'unread',offer_flag='".$oflag."', attachment = '".$attach."'";
		}
		else{
				$query="INSERT INTO messages SET  messages = '".$spec."',intromsg='".$intro."',time = '".$time."',user_id = '".$user."',receiver = '".$receiver."',storage_a ='".$user."',storage_b = '".$receiver."',quoteid='".$qid."',enquiry_id='".$eid."',status = 'unread',offer_flag='".$oflag."', attachment = '".$attach."'";
		}
		echo $query;
	    try{
		     $this->query($query);
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
}

	
}