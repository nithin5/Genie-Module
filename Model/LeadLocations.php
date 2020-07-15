<?php
class LeadLocations extends AppModel {

    var $name = 'quotelocations';
	var $primaryKey = 'id';
     
 
public function up_location($zone1,$area,$city,$state,$address,$latitude,$longitude,$quote_id){

    $loc_query="UPDATE quotelocations SET zone1_buy='$zone1',zone2_buy='$zone1',zone_buy='$area',city_buy='$city',state_buy='$state',address_buy='$address',latitude='$latitude',longitude='$longitude' WHERE quoteid='$quote_id'"; 
    
    $this->query($loc_query);

}
   
	
   
}