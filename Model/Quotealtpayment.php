<?php
class Quotealtpayment extends AppModel {

    var $name = 'quotespayment_details';
	var $primaryKey = 'id';
   
     public function get_details_verified($sellerid){

	    $onlinepay_data=array();
        
        $onlinepay_query="SELECT user_id,created_date,email,mobileNo,firstName,lastName,addressCity,addressStreet1,addressZip,addressState,addressCountry,paymentMode FROM quotespayment_details WHERE user_id='".$sellerid."' ORDER BY id DESC LIMIT 1";
       
        $onlinepay_data = $this->query($onlinepay_query);

        return $onlinepay_data;
    }


}