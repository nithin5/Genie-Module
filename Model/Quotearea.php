<?php
class Quotearea extends AppModel{
	var $name = 'quoteareas';

	public function get_quote_area_id($login_area_buy){
	        $condition = " deleted_flag=0 AND area_name='" .$login_area_buy."'";
	        $areaname_buy = $this->query('select id from quoteareas where'. $condition);
        return $areaname_buy[0]['quoteareas']['id'];
	}

    public function get_quote_area($quoteid){
		    $AreaName=array();
			$AreaName=$this->query("SELECT quoteareas.id, quoteareas.area_name FROM quoteareas INNER JOIN quotes ON (quotes.locradius = quoteareas.id AND quotes.quoteid = '".$quoteid."')");
	    return $AreaName;
	}

	public function get_quote_area_list($locarea){
		    $AreaList = array();
		    $AreaList = $this->find('list',array(  
	                   'conditions' =>array('Quotearea.deleted_flag' => '0',
	                   'Quotearea.city_id' => $locarea ),
	                    'fields' => array('id','area_name'),
	                   )
	                 );
	    return $AreaList;
    }

    public function get_arealist_of_city($city_id){
	    $AreaList =array();	
	    $AreaList = $this->find('list', array(
	                'fields' => array('Quotearea.id', 'Quotearea.area_name',),
	                'conditions' => array('Quotearea.city_id' => $city_id,'Quotearea.area_name IS NOT NULL')
	            ));
	    return $AreaList;
    }

    public function set_quote_area($city_id,$area_name){
        $query="INSERT INTO quoteareas SET area_name='".$area_name."' AND city_id='".$city_id."' ";
		$this->query($query);
    }
	
}