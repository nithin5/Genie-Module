<?php
class Leadaltpayment extends AppModel {

    var $name = 'quoteotherpayments';
	var $primaryKey = 'id';
     
  
    public function get_off_details_verified($sellerid){

	    $offlinepay_data=array();
        

	    $offlinepay_query="SELECT user_id,created_date,email,firstName,lastName,addressStreet1,addressCity,addressState,addressCountry,addressZip,mobileNo,payment_type 
	    FROM quoteotherpayments WHERE verify=1 and user_id='".$sellerid."' ORDER BY id DESC LIMIT 1";
	    

	    $offlinepay_data = $this->query($offlinepay_query);

      return $offlinepay_data;
    }

    public function get_off_details($User_Id){

	       $User_data=array();

	       $pay_query="SELECT id,email,mobileNo,firstName,lastName,amount,addressStreet1,addressCity,addressState,addressZip,mobileNo,user_id,TxId,payment_for,package_name,paymentMode,payment_mode,leads_credited FROM quoteotherpayments WHERE user_id ='".$User_Id."' ORDER BY id desc limit 1" ;

	       $User_data=$this->query($pay_query);

        return $User_data;

    }

    public function get_on_details($sellerid){

	     $onlinepay_data=array();


	     $onlinepay_query="SELECT user_id,created_date,email,mobileNo,firstName,lastName,addressCity,addressStreet1,addressZip,addressState,addressCountry,paymentMode FROM quotespayment_details WHERE user_id='".$sellerid."' ORDER BY id DESC LIMIT 1";

	     $onlinepay_data = $this->query($onlinepay_query);

	     return $onlinepay_data;
    }


    public function get_credit_report($User_Id){

	    $result=array();

	    $query="(SELECT id,payment_mode,user_id,created_date,email,mobileNo,firstName,lastName,addressCity,addressStreet1,addressZip,addressState,addressCountry,paymentMode,package_name,amount,leads_credited
	      FROM quotespayment_details WHERE user_id='".$User_Id."') 
	       UNION
	      (SELECT id,payment_mode,user_id,created_date,email,firstName,lastName,addressStreet1,addressCity,addressState,addressCountry,addressZip,mobileNo,payment_type,package_name,amount,leads_credited
	       FROM quoteotherpayments WHERE verify=1 and user_id='".$User_Id."') 
	     ORDER BY created_date DESC";

	    $result= $this->query($query);

      return $result;

    }

     

	
   
	
   
}