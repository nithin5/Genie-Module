<?php
class Quotecity extends AppModel{
	  var $name = 'quotecities';

  	public function get_quote_city_list(){
          $CityList =array();
      		$CityList = $this->find('list',array(  
                         'conditions' =>array('Quotecity.deleted_flag' => '0'),//conditions
                          'fields' => array('id','city_name'),
                           'order' => array('city_name asc'),
                         )
                       );
  		 return $CityList;

  	}

    public function get_quote_city_details($quoteid){
        $CityName=array();
    	  $cityquery="SELECT quotecities.id, quotecities.city_name FROM quotecities INNER JOIN quotes ON (quotes.locarea = quotecities.id AND quotes.quoteid = '".$quoteid."')";
        $CityName=$this->query($cityquery);
      return $CityName;
    } 

    public function get_city_id($login_city_buy){
        $condition = " deleted_flag=0 AND country_id=1 AND city_name='".$login_city_buy."'";
        $cityname_buy = $this->query('select id from quotecities where'. $condition);
        $city_id = $cityname_buy[0]['quotecities']['id'];
      return $city_id;
    } 

    public function set_quote_city($city){
      $query="INSERT INTO quotecities SET city_name='".$city."',deleted_flag= '0',country_id='1'";
      $this->query($query);
    }    

    public function get_city_list(){
      $City_List=array();
      $city = ClassRegistry::init('City');
      $City_List = $city->find('list', array(
                                         'conditions' => array('City.city_name <>' => ''),
                                         'fields' => array('City.id','City.city_name'),
                                         'order' => array('City.id asc'))); 
      return $City_List;                                  
    }   
    public function get_city_for_pricing($city_id){
      $User_City=array();
      $query_city="SELECT * FROM quotecities where deleted_flag=0 AND id='".$city_id."' ";
      
        $User_City=$this->query($query_city);
        return $User_City;                                    
    }
    public function get_country_name($country_id){
        $query="select * from country_lists where id='".$country_id."'";
       
        $Country_data = $this->query($query);
        return $Country_data[0]['country_lists']['country_name'];
    }  
	
	
}