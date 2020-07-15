<?php
class Genieclick extends AppModel {
   public $useTable = 'genie_clicks';
  
    var $primaryKey = 'id';


    public function set_click($unique_ip,$click_day,$click_time,$clicks){
       //$count=$this->get_click($unique_ip,$click_day);	
       $ins_query="INSERT INTO genie_clicks SET ip='".$unique_ip."',day='".$click_day."',daytime='".$click_time."',clicks='".$clicks."'";
       $this->query($ins_query);
    }
    public function get_click($unique_ip,$click_day){
     $count = $this->find('count', array( 'conditions' => array('ip' => $unique_ip,'day' =>$click_day)));
     return $count;
    }
	
   
}