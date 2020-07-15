<?php
App::uses('CakeEmail', 'Network/Email');

class PricingController extends AppController {
    public $helpers = array('Html', 'Form');
	// public $layout = "pricing";
    public $components = array('Cookie','RequestHandler');

    function beforeFilter() {
   
         $this->Auth->allow('index','otherpay','buyer_check','lite','pay_response');

    }

    public function index() { 
   
	$User_Id = $this->Auth->user('id');
	$User_status = $this->Auth->user('status');
		
	

	$this->layout = 'pricing';

	$Pricing_page =1;

	$this->loadModel('OfferCategory'); //if it's not already loaded
            $CategoryList = $this->OfferCategory->find('list', array(
                                'conditions' =>array('OfferCategory.deleted_flag' => '0'),
                                'fields' => array('id','category_name'),
                                ));

	$this->set(compact('CategoryList'));//end of category fetch

	$this->loadModel("City"); 

	$City_Combo = $this->City->find('list', array(
			'conditions' => array('City.deleted_flag' => '0',
					'City.country_id'=>'1'),
			'fields' => array('City.id','City.city_name'),
			'order' => array('City.city_name asc')));


	$OfferCategory  = $this->OfferCategory->find('all', array(
					        'conditions' => array('OfferCategory.deleted_flag'=>'0'),
							 
							'fields' => array('OfferCategory.id','OfferCategory.category_name','OfferCategory.type','OfferCategory.credits','category_types.type_name'),

							'joins'  => array(
								                  array(
											               'table'         =>  'category_types',

					 								        'type'          =>  'left',

					 								       'foreignKey'    =>  false,

					 								       'conditions'    =>  array( 'category_types.id = OfferCategory.type' ),
										 
										                 )
											),	
							'order' => array('OfferCategory.category_name'),
							
							
							 ));

	
        $temp_category=array();

        $product_category=array();

        $service_category=array();

        $hybrid_category=array();

	  foreach ($OfferCategory as $offercategory) {
	  	//print_r($offercategory);
	  	# code...
	  

	  	          if($offercategory['OfferCategory']['type']==1){
	  	          	$temp_category['product_category']['category_name']=$offercategory['OfferCategory']['category_name'];
	  	          	$temp_category['product_category']['credits']=$offercategory['OfferCategory']['credits'];
	  	          	$temp_category['product_category']['type_name']=$offercategory['category_types']['type_name'];
	  	          	$product_category[]=$temp_category;
	  	          	unset($temp_category);
	  	          }
	  	         

	  	          if($offercategory['OfferCategory']['type']==2){
	  	          	
	  	          	$temp_category['service_category']['category_name']=$offercategory['OfferCategory']['category_name'];
	  	          	$temp_category['service_category']['credits']=$offercategory['OfferCategory']['credits'];
	  	          	$temp_category['service_category']['type_name']=$offercategory['category_types']['type_name'];
                    $service_category[]=$temp_category;
	  	          	unset($temp_category);
	  	          }
	  	       

	  	          if($offercategory['OfferCategory']['type']==3){
	  	          	$temp_category['hybrid_category']['category_name']=$offercategory['OfferCategory']['category_name'];
	  	          	$temp_category['hybrid_category']['credits']=$offercategory['OfferCategory']['credits'];
	  	          	$temp_category['hybrid_category']['type_name']=$offercategory['category_types']['type_name'];
                     $hybrid_category[]=$temp_category;
	  	          	unset($temp_category);
	  	          }
	  	        
	  }
    

	$this->set("product_category",$product_category);
	$this->set("service_category",$service_category);
	$this->set("hybrid_category",$hybrid_category);
    $this->set("City_Combo",$City_Combo);
	$this->set('User_Id',$User_Id);
	$this->set('User_status',$User_status);
	$this->set("title_for_layout","Xerve.in - Pricing");
	$this->set("description_for_layout","Pay-Only-For-Results and Value-for-Money Marketing and Leads Packages.");
	$this->set("keyword_for_layout","Pay-Only-For-Results and Value-for-Money Marketing and Leads Packages.");
	
    }
    public function onlinepaymentsuccessful() {
        
    }
    public function bookingsuccessful() {
         
    }
    /*lite package*/
    public function lite(){

    	//Configure::write('debug',2);
    	$this->loadModel('Quotealtpayment');
    	$this->loadModel('Leadaltpayment');
    	$this->loadModel('GenieUser');
    	$this->loadModel('Quotecity');
    	
    	$sid_id=$this->request->params['pass'][0]; //sid id
    	

    	      $mystring = $sid_id;
    	     // echo $mystring;

                $findme = 'SID';
                  //echo $findme;
                if(!strstr($sid_id, 'SID')){
                
                    $User_Id = $this->Auth->user('id');
                

                	$UserStatus  = $this->Auth->user('status');

			        $this->set('UserStatus',@$UserStatus);
                   
						        if($UserStatus == 1){

					                                   $this->redirect("/users/login");
					            }
					            if(($User_Id=='')||($User_Id==undefined)){
                                  $this->redirect("/users/login");
			                	}
                        

                }else{
                	
                	$User_Id=$this->get_uidfsid($sid_id);
                	//echo $User_Id;
                }
                

		/*Getting login user Details*/
			
	
			
			$this->set('User_Id', $User_Id);
			
			

		 /*Getting login user  Details*/
		
		$this->set("currency","INR");
		

		// if(!$User_Id){

		//    //$this->redirect("/users/login");

		// }
		

		/*Package Details*/
		        $PayPackage="LITE";
		        $PaymentFor="Leads";
		        $PaymentMode="ONLINE";
		        $basic_leads=100;

		        $this->set('PaymentMode', $PaymentMode);
		        $this->set('LeadsCredited', $basic_leads);
		        $this->set('PayPackage', $PayPackage);
		        $this->set('PaymentFor', $PaymentFor);
		/*Package Details*/
		
       

	    /*Setting User Details*/
		   // $this->loadModel("User"); 
	
		    $User_data =$this->GenieUser->get_seller_details($User_Id);
	

            $onlinepay_data = $this->Quotealtpayment->get_details_verified($User_Id);
           
            $this->set(compact('onlinepay_data'));


			$offlinepay_data = $this->Leadaltpayment->get_off_details_verified($User_Id);
			
			$this->set(compact('offlinepay_data'));

			$totaldata=array_merge($onlinepay_data,$offlinepay_data);
			
			$this->set(compact('totaldata'));

			if($offlinepay_data[0]['quoteotherpayments']['created_date'] > $onlinepay_data[0]['quotespayment_details']['created_date'])
                 {
                                        
                    $this->set('lastpay_user_id',$offlinepay_data[0]['quoteotherpayments']['user_id']);
                   $this->set('lastpay_created_date',$offlinepay_data[0]['quoteotherpayments']['created_date']);
                    $this->set('lastpay_email',$offlinepay_data[0]['quoteotherpayments']['email']);
                    $this->set('lastpay_firstName',$offlinepay_data[0]['quoteotherpayments']['firstName']);
                    $this->set('lastpay_lastName',$offlinepay_data[0]['quoteotherpayments']['lastName']);
                    $this->set('lastpay_addressStreet1',$offlinepay_data[0]['quoteotherpayments']['addressStreet1']);
                    $this->set('lastpay_addressCity',$offlinepay_data[0]['quoteotherpayments']['addressCity']);
                    $this->set('lastpay_addressState',$offlinepay_data[0]['quoteotherpayments']['addressState']);
                    $this->set('lastpay_addressCountry',$offlinepay_data[0]['quoteotherpayments']['addressCountry']);
                    $this->set('lastpay_addressZip',$offlinepay_data[0]['quoteotherpayments']['addressZip']);
                    $this->set('lastpay_mobileNo',$offlinepay_data[0]['quoteotherpayments']['mobileNo']);
                    $this->set('lastpay_paymentMode',$offlinepay_data[0]['quoteotherpayments']['payment_type']);
                 }
                 else{

                    $this->set('lastpay_user_id',$onlinepay_data[0]['quotespayment_details']['user_id']);
                    $this->set('lastpay_created_date',$onlinepay_data[0]['quotespayment_details']['created_date']);
                    $this->set('lastpay_email',$onlinepay_data[0]['quotespayment_details']['email']);
                    $this->set('lastpay_firstName',$onlinepay_data[0]['quotespayment_details']['firstName']);
                    $this->set('lastpay_lastName',$onlinepay_data[0]['quotespayment_details']['lastName']);
                    $this->set('lastpay_addressStreet1',$onlinepay_data[0]['quotespayment_details']['addressStreet1']);
                    $this->set('lastpay_addressCity',$onlinepay_data[0]['quotespayment_details']['addressCity']);
                    $this->set('lastpay_addressState',$onlinepay_data[0]['quotespayment_details']['addressState']);
                    $this->set('lastpay_addressCountry',$onlinepay_data[0]['quotespayment_details']['addressCountry']);
                    $this->set('lastpay_addressZip',$onlinepay_data[0]['quotespayment_details']['addressZip']);
                    $this->set('lastpay_mobileNo',$onlinepay_data[0]['quotespayment_details']['mobileNo']);
                    $this->set('lastpay_paymentMode',$onlinepay_data[0]['quotespayment_details']['paymentMode']);

                 }
            if($User_data[0]['users']['country_id']==105){
            	$country_id=1;
            }else{
            	$country_id=$User_data[0]['users']['country_id'];
            }     
            $Country_data ==$this->Quotecity->get_country_name($country_id);
		
			$this->set("country_name",$Country_data[0]['country_lists']['country_name']);
             
	

		    $User_City=$this->Quotecity->get_city_for_pricing($User_data[0]['users']['city_id']);
	
		    $this->set("city_name",$User_City[0]['quotecities']['city_name']);

		    $this->set(compact('User_data'));
		 /*Setting User Details ends*/

		
		$this->layout = 'pricing';

		

	}//lite
    /*lite package*/

    public function mini(){
    	$this->loadModel('Quotealtpayment');
    	$this->loadModel('Leadaltpayment');
    	$this->loadModel('GenieUser');
    	$this->loadModel('Quotecity');

    	$sid_id=$this->request->params['pass'][0]; //sid id
    	$credits=$this->request->params['pass'][1];
    	$credits=$this->request->params['pass'][2];
    	
    	        $mystring = $sid_id;
                $findme   = 'SID';
                if(!strstr($sid_id, 'SID')){
                
                    $User_Id = $this->Auth->user('id');
                

                	$UserStatus  = $this->Auth->user('status');

			        $this->set('UserStatus',@$UserStatus);
                   
						        if($UserStatus == 1){

					                                   $this->redirect("/users/login");
					            }
					            if(($User_Id=='')||($User_Id==undefined)){
                                  $this->redirect("/users/login");
			                	}
                        

                }else{
                	
                	$User_Id=$this->get_uidfsid($sid_id);
                	//echo $User_Id;
                }

		$this->set('User_Id', $User_Id);
		 /*Getting login user  Details*/
		$this->set("currency","INR");
		/*Package Details*/
				        $PayPackage="MINI";
				        $PaymentFor="Leads";
				        $PaymentMode="ONLINE";
				 
				        $mini_leads=10;
				        $this->set('PaymentMode', $PaymentMode);
				        $this->set('LeadsCredited', $basic_leads);
				        $this->set('PayPackage', $PayPackage);
				        $this->set('PaymentFor', $PaymentFor);
				        $this->set('mini_credits', $mini_leads);
		/*Package Details*/
	    /*Setting User Details*/
		 
			$User_data =$this->GenieUser->get_seller_details($User_Id);
		    $onlinepay_data = $this->Quotealtpayment->get_details_verified($User_Id);
		    
            $this->set(compact('onlinepay_data'));
            $offlinepay_data = $this->Leadaltpayment->get_off_details_verified($User_Id);
            
			$this->set(compact('offlinepay_data'));
			$totaldata=array_merge($onlinepay_data,$offlinepay_data);
			$this->set(compact('totaldata'));
			if($offlinepay_data[0]['quoteotherpayments']['created_date'] > $onlinepay_data[0]['quotespayment_details']['created_date'])
                 {
                    $this->set('lastpay_user_id',$offlinepay_data[0]['quoteotherpayments']['user_id']);
                    $this->set('lastpay_created_date',$offlinepay_data[0]['quoteotherpayments']['created_date']);
                    $this->set('lastpay_email',$offlinepay_data[0]['quoteotherpayments']['email']);
                    $this->set('lastpay_firstName',$offlinepay_data[0]['quoteotherpayments']['firstName']);
                    $this->set('lastpay_lastName',$offlinepay_data[0]['quoteotherpayments']['lastName']);
                    $this->set('lastpay_addressStreet1',$offlinepay_data[0]['quoteotherpayments']['addressStreet1']);
                    $this->set('lastpay_addressCity',$offlinepay_data[0]['quoteotherpayments']['addressCity']);
                    $this->set('lastpay_addressState',$offlinepay_data[0]['quoteotherpayments']['addressState']);
                    $this->set('lastpay_addressCountry',$offlinepay_data[0]['quoteotherpayments']['addressCountry']);
                    $this->set('lastpay_addressZip',$offlinepay_data[0]['quoteotherpayments']['addressZip']);
                    $this->set('lastpay_mobileNo',$offlinepay_data[0]['quoteotherpayments']['mobileNo']);
                    $this->set('lastpay_paymentMode',$offlinepay_data[0]['quoteotherpayments']['payment_type']);
                 }
                 else{
                    $this->set('lastpay_user_id',$onlinepay_data[0]['quotespayment_details']['user_id']);
                    $this->set('lastpay_created_date',$onlinepay_data[0]['quotespayment_details']['created_date']);
                    $this->set('lastpay_email',$onlinepay_data[0]['quotespayment_details']['email']);
                    $this->set('lastpay_firstName',$onlinepay_data[0]['quotespayment_details']['firstName']);
                    $this->set('lastpay_lastName',$onlinepay_data[0]['quotespayment_details']['lastName']);
                    $this->set('lastpay_addressStreet1',$onlinepay_data[0]['quotespayment_details']['addressStreet1']);
                    $this->set('lastpay_addressCity',$onlinepay_data[0]['quotespayment_details']['addressCity']);
                    $this->set('lastpay_addressState',$onlinepay_data[0]['quotespayment_details']['addressState']);
                    $this->set('lastpay_addressCountry',$onlinepay_data[0]['quotespayment_details']['addressCountry']);
                   $this->set('lastpay_addressZip',$onlinepay_data[0]['quotespayment_details']['addressZip']);
                   $this->set('lastpay_mobileNo',$onlinepay_data[0]['quotespayment_details']['mobileNo']);
                   $this->set('lastpay_paymentMode',$onlinepay_data[0]['quotespayment_details']['paymentMode']);
                 }
            if($User_data[0]['users']['country_id']==105){
            	$country_id=1;
            }else{
            	$country_id=$User_data[0]['users']['country_id'];
            }  
            $Country_data =$this->Quotecity->get_country_name($country_id);     

			$this->set("country_name",$Country_data[0]['country_lists']['country_name']);

            $User_City=$this->Quotecity->get_city_for_pricing($User_data[0]['users']['city_id']);
		 
		    $this->set("city_name",$User_City[0]['quotecities']['city_name']);

		    $this->set(compact('User_data'));
		 /*Setting User Details ends*/
		$this->layout = 'pricing';
	}//mini
    /*mini package*/

    /*standard package*/

    public function basic(){

		$this->loadModel('Quotealtpayment');
    	$this->loadModel('Leadaltpayment');
    	$this->loadModel('GenieUser');
    	$this->loadModel('Quotecity');

		/*Getting login user Details*/
			$User_Id = $this->Auth->user('id');
			//echo "User Id is".$User_Id;
			
			$this->set('User_Id', $User_Id);
			
			$UserStatus  = $this->Auth->user('status');
			$this->set('UserStatus',@$UserStatus);

		 /*Getting login user  Details*/
		
		$this->set("currency","INR");
		

		if(!$User_Id){
		$this->redirect("/users/login");
		}
		if($UserStatus == 1){
		$this->redirect("/users/login");
		}
//Rs. 1000    =  Standard = 1000 Credits   (Rs. 847.46 + Rs. 152.54)

		/*Package Details*/
        $PayPackage="BASIC";
        $PaymentFor="Leads";
        $PaymentMode="ONLINE";
        $basic_leads=1010;

        $this->set('PaymentMode', $PaymentMode);
        $this->set('LeadsCredited', $basic_leads);
        $this->set('PayPackage', $PayPackage);
        $this->set('PaymentFor', $PaymentFor);
		/*Package Details*/
		
       

	    /*Setting User Details*/
		 
		        
		$User_data =$this->GenieUser->get_seller_details($User_Id);

		$onlinepay_data = $this->Quotealtpayment->get_details_verified($User_Id); 
            
        $this->set(compact('onlinepay_data'));

        $offlinepay_data = $this->Leadaltpayment->get_off_details_verified($User_Id);

		$this->set(compact('offlinepay_data'));

		$totaldata=array_merge($onlinepay_data,$offlinepay_data);
		
		$this->set(compact('totaldata'));

			if($offlinepay_data[0]['quoteotherpayments']['created_date'] > $onlinepay_data[0]['quotespayment_details']['created_date'])
                 {
                                        
                    $this->set('lastpay_user_id',$offlinepay_data[0]['quoteotherpayments']['user_id']);
                    $this->set('lastpay_created_date',$offlinepay_data[0]['quoteotherpayments']['created_date']);
                    $this->set('lastpay_email',$offlinepay_data[0]['quoteotherpayments']['email']);
                    $this->set('lastpay_firstName',$offlinepay_data[0]['quoteotherpayments']['firstName']);
                    $this->set('lastpay_lastName',$offlinepay_data[0]['quoteotherpayments']['lastName']);
                    $this->set('lastpay_addressStreet1',$offlinepay_data[0]['quoteotherpayments']['addressStreet1']);
                    $this->set('lastpay_addressCity',$offlinepay_data[0]['quoteotherpayments']['addressCity']);
                    $this->set('lastpay_addressState',$offlinepay_data[0]['quoteotherpayments']['addressState']);
                    $this->set('lastpay_addressCountry',$offlinepay_data[0]['quoteotherpayments']['addressCountry']);
                    $this->set('lastpay_addressZip',$offlinepay_data[0]['quoteotherpayments']['addressZip']);
                    $this->set('lastpay_mobileNo',$offlinepay_data[0]['quoteotherpayments']['mobileNo']);
                    $this->set('lastpay_paymentMode',$offlinepay_data[0]['quoteotherpayments']['payment_type']);
                 }
                 else{

                    $this->set('lastpay_user_id',$onlinepay_data[0]['quotespayment_details']['user_id']);
                    $this->set('lastpay_created_date',$onlinepay_data[0]['quotespayment_details']['created_date']);
                    $this->set('lastpay_email',$onlinepay_data[0]['quotespayment_details']['email']);
                    $this->set('lastpay_firstName',$onlinepay_data[0]['quotespayment_details']['firstName']);
                    $this->set('lastpay_lastName',$onlinepay_data[0]['quotespayment_details']['lastName']);
                    $this->set('lastpay_addressStreet1',$onlinepay_data[0]['quotespayment_details']['addressStreet1']);
                    $this->set('lastpay_addressCity',$onlinepay_data[0]['quotespayment_details']['addressCity']);
                    $this->set('lastpay_addressState',$onlinepay_data[0]['quotespayment_details']['addressState']);
                    $this->set('lastpay_addressCountry',$onlinepay_data[0]['quotespayment_details']['addressCountry']);
                    $this->set('lastpay_addressZip',$onlinepay_data[0]['quotespayment_details']['addressZip']);
                    $this->set('lastpay_mobileNo',$onlinepay_data[0]['quotespayment_details']['mobileNo']);
                    $this->set('lastpay_paymentMode',$onlinepay_data[0]['quotespayment_details']['paymentMode']);

                 }

			 if($User_data[0]['users']['country_id']==105){
            	$country_id=1;
            }else{
            	$country_id=$User_data[0]['users']['country_id'];
            } 


			$Country_data ==$this->Quotecity->get_country_name($country_id);
			$this->set("country_name",$Country_data[0]['country_lists']['country_name']);

	        $User_City=$this->Quotecity->get_city_for_pricing($User_data[0]['users']['city_id']);
		    $this->set("city_name",$User_City[0]['quotecities']['city_name']);

		    $this->set(compact('User_data'));
		 /*Setting User Details ends*/

		
		$this->layout = 'pricing';

		

	}//basic

/*standard*/
public function standard(){
		$this->loadModel('Quotealtpayment');
    	$this->loadModel('Leadaltpayment');
    	$this->loadModel('GenieUser');
    	$this->loadModel('Quotecity');
		/*Getting login user Details*/
			$User_Id = $this->Auth->user('id');
			//echo "User Id is".$User_Id;
			
			$this->set('User_Id', $User_Id);
			
			$UserStatus  = $this->Auth->user('status');
			$this->set('UserStatus',@$UserStatus);

		 /*Getting login user  Details*/
		
		$this->set("currency","INR");
		

		if(!$User_Id){
		$this->redirect("/users/login");
		}
		if($UserStatus == 1){
		$this->redirect("/users/login");
		}
//Rs. 1000    =  Standard = 1000 Credits   (Rs. 847.46 + Rs. 152.54)

		/*Package Details*/
        $PayPackage="STANDARD";
        $PaymentFor="Leads";
        $PaymentMode="ONLINE";
        $basic_leads=500;

        $this->set('PaymentMode', $PaymentMode);
        $this->set('LeadsCredited', $basic_leads);


        
        $this->set('PayPackage', $PayPackage);
        $this->set('PaymentFor', $PaymentFor);
		/*Package Details*/
		
       

	    /*Setting User Details*/
		   // $this->loadModel("User"); 
		        
		$User_data =$this->GenieUser->get_seller_details($User_Id);

		$onlinepay_data = $this->Quotealtpayment->get_details_verified($User_Id);
            
            $this->set(compact('onlinepay_data'));

        $offlinepay_data = $this->Leadaltpayment->get_off_details_verified($User_Id);

			$this->set(compact('offlinepay_data'));

			$totaldata=array_merge($onlinepay_data,$offlinepay_data);
			
			$this->set(compact('totaldata'));

			if($offlinepay_data[0]['quoteotherpayments']['created_date'] > $onlinepay_data[0]['quotespayment_details']['created_date'])
                 {
                                        
                    $this->set('lastpay_user_id',$offlinepay_data[0]['quoteotherpayments']['user_id']);
                    $this->set('lastpay_created_date',$offlinepay_data[0]['quoteotherpayments']['created_date']);
                    $this->set('lastpay_email',$offlinepay_data[0]['quoteotherpayments']['email']);
                    $this->set('lastpay_firstName',$offlinepay_data[0]['quoteotherpayments']['firstName']);
                    $this->set('lastpay_lastName',$offlinepay_data[0]['quoteotherpayments']['lastName']);
                    $this->set('lastpay_addressStreet1',$offlinepay_data[0]['quoteotherpayments']['addressStreet1']);
                    $this->set('lastpay_addressCity',$offlinepay_data[0]['quoteotherpayments']['addressCity']);
                    $this->set('lastpay_addressState',$offlinepay_data[0]['quoteotherpayments']['addressState']);
                    $this->set('lastpay_addressCountry',$offlinepay_data[0]['quoteotherpayments']['addressCountry']);
                    $this->set('lastpay_addressZip',$offlinepay_data[0]['quoteotherpayments']['addressZip']);
                    $this->set('lastpay_mobileNo',$offlinepay_data[0]['quoteotherpayments']['mobileNo']);
                    $this->set('lastpay_paymentMode',$offlinepay_data[0]['quoteotherpayments']['payment_type']);
                 }
                 else{

                    $this->set('lastpay_user_id',$onlinepay_data[0]['quotespayment_details']['user_id']);
                    $this->set('lastpay_created_date',$onlinepay_data[0]['quotespayment_details']['created_date']);
                    $this->set('lastpay_email',$onlinepay_data[0]['quotespayment_details']['email']);
                    $this->set('lastpay_firstName',$onlinepay_data[0]['quotespayment_details']['firstName']);
                    $this->set('lastpay_lastName',$onlinepay_data[0]['quotespayment_details']['lastName']);
                    $this->set('lastpay_addressStreet1',$onlinepay_data[0]['quotespayment_details']['addressStreet1']);
                    $this->set('lastpay_addressCity',$onlinepay_data[0]['quotespayment_details']['addressCity']);
                    $this->set('lastpay_addressState',$onlinepay_data[0]['quotespayment_details']['addressState']);
                    $this->set('lastpay_addressCountry',$onlinepay_data[0]['quotespayment_details']['addressCountry']);
                    $this->set('lastpay_addressZip',$onlinepay_data[0]['quotespayment_details']['addressZip']);
                    $this->set('lastpay_mobileNo',$onlinepay_data[0]['quotespayment_details']['mobileNo']);
                    $this->set('lastpay_paymentMode',$onlinepay_data[0]['quotespayment_details']['paymentMode']);

                 }

			 if($User_data[0]['users']['country_id']==105){
            	$country_id=1;
            }else{
            	$country_id=$User_data[0]['users']['country_id'];
            } 

			$Country_data ==$this->Quotecity->get_country_name($country_id);
			$this->set("country_name",$Country_data[0]['country_lists']['country_name']);

		    $Country_data ==$this->Quotecity->get_country_name($country_id);
		    $this->set("city_name",$User_City[0]['quotecities']['city_name']);

		    $this->set(compact('User_data'));
		 /*Setting User Details ends*/

		
		$this->layout = 'pricing';

		

	}//standard



    /*eof standard package*/


	public function pro(){
		//Configure::write('debug', 2);
        $this->loadModel('Quotealtpayment');
    	$this->loadModel('Leadaltpayment');
    	$this->loadModel('GenieUser');
    	$this->loadModel('Quotecity');
		/*Package Details*/

		$PayPackage="PRO";
        $PaymentFor="Leads";
        $PaymentMode="ONLINE";

        $pro_leads=5000;
        $pro_extra=0.05 * $pro_leads;
        $pro_leads=$pro_leads + $pro_extra;

        
        
        $this->set('PaymentMode', $PaymentMode);
        $this->set('LeadsCredited', $pro_leads);
		/*Package Details*/

        $this->set('PayPackage', $PayPackage);
        $this->set('PaymentFor', $PaymentFor);

		/*Package Details*/
		
       /*Getting login user Details*/
			$User_Id = $this->Auth->user('id');
			
			$this->set('User_Id', $User_Id);
			
			$UserStatus  = $this->Auth->user('status');
			$this->set('UserStatus',@$UserStatus);
		 /*Getting login user  Details*/
		
		$this->set("currency","INR");
		

		if(!$User_Id){
		$this->redirect("/users/login");
		}
		if($UserStatus == 1){
		$this->redirect("/users/login");
		}

	    /*Setting User Details*/
		   // $this->loadModel("User"); 
		        
		    $User_data =$this->GenieUser->get_seller_details($User_Id);

			$onlinepay_data = $this->Quotealtpayment->get_details_verified($User_Id);
            
            $this->set(compact('onlinepay_data'));

            $offlinepay_data = $this->Leadaltpayment->get_off_details_verified($User_Id);

			$this->set(compact('offlinepay_data'));

			$totaldata=array_merge($onlinepay_data,$offlinepay_data);
			
			$this->set(compact('totaldata'));

			if($offlinepay_data[0]['quoteotherpayments']['created_date'] > $onlinepay_data[0]['quotespayment_details']['created_date'])
                 {
                                        
                    $this->set('lastpay_user_id',$offlinepay_data[0]['quoteotherpayments']['user_id']);
                    $this->set('lastpay_created_date',$offlinepay_data[0]['quoteotherpayments']['created_date']);
                    $this->set('lastpay_email',$offlinepay_data[0]['quoteotherpayments']['email']);
                    $this->set('lastpay_firstName',$offlinepay_data[0]['quoteotherpayments']['firstName']);
                    $this->set('lastpay_lastName',$offlinepay_data[0]['quoteotherpayments']['lastName']);
                    $this->set('lastpay_addressStreet1',$offlinepay_data[0]['quoteotherpayments']['addressStreet1']);
                    $this->set('lastpay_addressCity',$offlinepay_data[0]['quoteotherpayments']['addressCity']);
                    $this->set('lastpay_addressState',$offlinepay_data[0]['quoteotherpayments']['addressState']);
                    $this->set('lastpay_addressCountry',$offlinepay_data[0]['quoteotherpayments']['addressCountry']);
                    $this->set('lastpay_addressZip',$offlinepay_data[0]['quoteotherpayments']['addressZip']);
                    $this->set('lastpay_mobileNo',$offlinepay_data[0]['quoteotherpayments']['mobileNo']);
                    $this->set('lastpay_paymentMode',$offlinepay_data[0]['quoteotherpayments']['payment_type']);
                 }
                 else{

                    $this->set('lastpay_user_id',$onlinepay_data[0]['quotespayment_details']['user_id']);
                    $this->set('lastpay_created_date',$onlinepay_data[0]['quotespayment_details']['created_date']);
                    $this->set('lastpay_email',$onlinepay_data[0]['quotespayment_details']['email']);
                    $this->set('lastpay_firstName',$onlinepay_data[0]['quotespayment_details']['firstName']);
                    $this->set('lastpay_lastName',$onlinepay_data[0]['quotespayment_details']['lastName']);
                    $this->set('lastpay_addressStreet1',$onlinepay_data[0]['quotespayment_details']['addressStreet1']);
                    $this->set('lastpay_addressCity',$onlinepay_data[0]['quotespayment_details']['addressCity']);
                    $this->set('lastpay_addressState',$onlinepay_data[0]['quotespayment_details']['addressState']);
                    $this->set('lastpay_addressCountry',$onlinepay_data[0]['quotespayment_details']['addressCountry']);
                    $this->set('lastpay_addressZip',$onlinepay_data[0]['quotespayment_details']['addressZip']);
                    $this->set('lastpay_mobileNo',$onlinepay_data[0]['quotespayment_details']['mobileNo']);
                    $this->set('lastpay_paymentMode',$onlinepay_data[0]['quotespayment_details']['paymentMode']);

                 }
            if($User_data[0]['users']['country_id']==105){
            	$country_id=1;
            }else{
            	$country_id=$User_data[0]['users']['country_id'];
            } 
			$Country_data ==$this->Quotecity->get_country_name($country_id);
			$this->set("country_name",$Country_data[0]['country_lists']['country_name']);

		    $User_City=$this->Quotecity->get_city_for_pricing($User_data[0]['users']['city_id']);
		   
		    $this->set("city_name",$User_City[0]['quotecities']['city_name']);

		    $this->set(compact('User_data'));
		 /*Setting User Details ends*/

		
		$this->layout = 'pricing';

		

	}//pro

	public function elite(){
		//Configure::write('debug', 2);
		 $this->loadModel('Quotealtpayment');
    	$this->loadModel('Leadaltpayment');
    	$this->loadModel('GenieUser');
    	$this->loadModel('Quotecity');
		/*Package Details*/
        $PayPackage="ELITE";
        $PaymentFor="Leads";
        $PaymentMode="ONLINE";

        $elite_leads=10000;
        $elite_extra=0.1 * $elite_leads;
        $elite_leads=$elite_leads + $elite_extra;


        
        $this->set('PayPackage', $PayPackage);
        $this->set('PaymentFor', $PaymentFor);

        $this->set('PaymentMode', $PaymentMode);
        $this->set('LeadsCredited', $elite_leads);
		/*Package Details*/
		
       /*Getting login user Details*/
			$User_Id = $this->Auth->user('id');
			
			$this->set('User_Id', $User_Id);
			
			$UserStatus  = $this->Auth->user('status');
			$this->set('UserStatus',@$UserStatus);
		 /*Getting login user  Details*/
		
		$this->set("currency","INR");
		

		if(!$User_Id){
		$this->redirect("/users/login");
		}
		if($UserStatus == 1){
		$this->redirect("/users/login");
		}

	    /*Setting User Details*/
		   // $this->loadModel("User"); 
		        
		
		$User_data =$this->GenieUser->get_seller_details($User_Id);
			

		$onlinepay_data = $this->Quotealtpayment->get_details_verified($User_Id);
            
            $this->set(compact('onlinepay_data'));

        $offlinepay_data = $this->Leadaltpayment->get_off_details_verified($User_Id);


			$this->set(compact('offlinepay_data'));

			$totaldata=array_merge($onlinepay_data,$offlinepay_data);
			
			$this->set(compact('totaldata'));

			if($offlinepay_data[0]['quoteotherpayments']['created_date'] > $onlinepay_data[0]['quotespayment_details']['created_date'])
                 {
                                        
                    $this->set('lastpay_user_id',$offlinepay_data[0]['quoteotherpayments']['user_id']);
                    $this->set('lastpay_created_date',$offlinepay_data[0]['quoteotherpayments']['created_date']);
                    $this->set('lastpay_email',$offlinepay_data[0]['quoteotherpayments']['email']);
                    $this->set('lastpay_firstName',$offlinepay_data[0]['quoteotherpayments']['firstName']);
                    $this->set('lastpay_lastName',$offlinepay_data[0]['quoteotherpayments']['lastName']);
                    $this->set('lastpay_addressStreet1',$offlinepay_data[0]['quoteotherpayments']['addressStreet1']);
                    $this->set('lastpay_addressCity',$offlinepay_data[0]['quoteotherpayments']['addressCity']);
                    $this->set('lastpay_addressState',$offlinepay_data[0]['quoteotherpayments']['addressState']);
                    $this->set('lastpay_addressCountry',$offlinepay_data[0]['quoteotherpayments']['addressCountry']);
                    $this->set('lastpay_addressZip',$offlinepay_data[0]['quoteotherpayments']['addressZip']);
                    $this->set('lastpay_mobileNo',$offlinepay_data[0]['quoteotherpayments']['mobileNo']);
                    $this->set('lastpay_paymentMode',$offlinepay_data[0]['quoteotherpayments']['payment_type']);
                 }
                 else{

                    $this->set('lastpay_user_id',$onlinepay_data[0]['quotespayment_details']['user_id']);
                    $this->set('lastpay_created_date',$onlinepay_data[0]['quotespayment_details']['created_date']);
                    $this->set('lastpay_email',$onlinepay_data[0]['quotespayment_details']['email']);
                    $this->set('lastpay_firstName',$onlinepay_data[0]['quotespayment_details']['firstName']);
                    $this->set('lastpay_lastName',$onlinepay_data[0]['quotespayment_details']['lastName']);
                    $this->set('lastpay_addressStreet1',$onlinepay_data[0]['quotespayment_details']['addressStreet1']);
                    $this->set('lastpay_addressCity',$onlinepay_data[0]['quotespayment_details']['addressCity']);
                    $this->set('lastpay_addressState',$onlinepay_data[0]['quotespayment_details']['addressState']);
                    $this->set('lastpay_addressCountry',$onlinepay_data[0]['quotespayment_details']['addressCountry']);
                    $this->set('lastpay_addressZip',$onlinepay_data[0]['quotespayment_details']['addressZip']);
                    $this->set('lastpay_mobileNo',$onlinepay_data[0]['quotespayment_details']['mobileNo']);
                    $this->set('lastpay_paymentMode',$onlinepay_data[0]['quotespayment_details']['paymentMode']);

                 }
            if($User_data[0]['users']['country_id']==105){
            	$country_id=1;
            }else{
            	$country_id=$User_data[0]['users']['country_id'];
            } 
	        $Country_data ==$this->Quotecity->get_country_name($country_id);
			$this->set("country_name",$Country_data[0]['country_lists']['country_name']);

		    $User_City=$this->Quotecity->get_city_for_pricing($User_data[0]['users']['city_id']);
		    $this->set("city_name",$User_City[0]['quotecities']['city_name']);

		    $this->set(compact('User_data'));
		 /*Setting User Details ends*/

		
		$this->layout = 'pricing';

		

	}//elite

    public function pay_response(){
//Configure::write('debug', 2);
		     $this->loadModel('GenieUser');
			//$secret_key = "d9a0ddf82d0bc3f8641540ef166efd6796427c7c"; 
			 $secret_key = "cdf66810b605309f96fc9b6944205003455057b7"; 
		    
			$data = "";
			$flag = "true";

			/**/
			   /*generating google url for credit page*/
			        $my_enquiries = 'https://www.xerve.in/myaccount/creditreport';
			        $apiKey = 'AIzaSyCCe-FLs8hLmMb1CgoAEbNoMFTXiuJAZaQ';

			        $postData=array('longUrl' => $my_enquiries, 'key' => $apiKey);
			        $jsonData = json_encode($postData);

			        $curlObj = curl_init();

			        curl_setopt($curlObj, CURLOPT_URL, "https://www.googleapis.com/urlshortener/v1/url?key=".$apiKey);
			        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
			        curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
			        curl_setopt($curlObj, CURLOPT_HEADER, 0);
			        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
			        curl_setopt($curlObj, CURLOPT_POST, 1);
			        curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

			        $response = curl_exec($curlObj);

			        $json = json_decode($response);

			        curl_close($curlObj);

			        $shortLink_buyer = get_object_vars($json);

			        $credits_url = $shortLink_buyer['id'];


     
    /*eof generating  google url  for credit page*/
    /*generating google url for pricing page*/
			        $my_enquiries = 'https://www.xerve.in/pricing';
			        $apiKey = 'AIzaSyCCe-FLs8hLmMb1CgoAEbNoMFTXiuJAZaQ';

			        $postData=array('longUrl' => $my_enquiries, 'key' => $apiKey);
			        $jsonData = json_encode($postData);

			        $curlObj = curl_init();

			        curl_setopt($curlObj, CURLOPT_URL, "https://www.googleapis.com/urlshortener/v1/url?key=".$apiKey);
			        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
			        curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
			        curl_setopt($curlObj, CURLOPT_HEADER, 0);
			        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
			        curl_setopt($curlObj, CURLOPT_POST, 1);
			        curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

			        $response = curl_exec($curlObj);

			        $json = json_decode($response);

			        curl_close($curlObj);

			        $shortLink_buyer = get_object_vars($json);

			        $pricing_url = $shortLink_buyer['id'];
     

			
		//-----------------capturing transactions details----------------------------------//


			if(isset($_POST['TxId'])) {
					$TxId = $_POST['TxId'];
					$data .= $TxId;
                 }
			if(isset($_POST['TxStatus'])) {
					$TxStatus = $_POST['TxStatus'];
					$data .= $TxStatus;	
				 }

			if(isset($_POST['TxMsg'])) {
					$TxMsg = $_POST['TxMsg'];
					$data .= $TxMsg;
				 }

			if(isset($_POST['TxRefNo'])) {
					$TxRefNo = $_POST['TxRefNo'];
				 }


			if(isset($_POST['amount'])) {
					$amount = $_POST['amount'];
					$data .= $amount;
				 }

			if(isset($_POST['pgTxnNo'])) {
					$pgTxnNo = $_POST['pgTxnNo'];
					$data .= $pgTxnNo;
				 }

			if(isset($_POST['issuerRefNo'])) {
					$issuerRefNo = $_POST['issuerRefNo'];
					$data .= $issuerRefNo;
				 } 
			if(isset($_POST['authIdCode'])) {
					$authIdCode = $_POST['authIdCode'];
					$data .= $authIdCode;	
				 }
            
			if(isset($_POST['transactionId'])) {
					$transactionId = $_POST['transactionId'];
				 }
            if(isset($_POST['TxGateway'])) {
					$TxGateway = $_POST['TxGateway'];
				 }

		// -----------------------capturing -personal details------------------------- //

			 if(isset($_POST['firstName'])) {

					$firstName = $_POST['firstName'];
					$data .= $firstName;
				 }
				 

			if(isset($_POST['lastName'])) {

					$lastName = $_POST['lastName'];
					$data .= $lastName;
				 }

			if(isset($_POST['pgRespCode'])) {
					$pgRespCode = $_POST['pgRespCode'];
					$data .= $pgRespCode;
						
				 }

			if(isset($_POST['email'])) {
					$email = $_POST['email'];
						
				 }

            if(isset($_POST['addressStreet1'])) {
					$addressStreet1 = $_POST['addressStreet1'];
						
				 }

			if(isset($_POST['addressStreet2'])) {
					$addressStreet2 = $_POST['addressStreet2'];
						
				 }

			if(isset($_POST['addressCity'])) {
					$addressCity = $_POST['addressCity'];
						
				 }


			if(isset($_POST['addressState'])) {
					$addressState = $_POST['addressState'];
						
				 }

			if(isset($_POST['addressCountry'])) {
					$addressCountry = $_POST['addressCountry'];
						
				 }


			if(isset($_POST['addressZip'])) {
					$addressZip = $_POST['addressZip'];
					$data .= $addressZip;
						
				 }

			if(isset($_POST['mobileNo'])) {
					$mobileNo = $_POST['mobileNo'];
						
				 }


			if(isset($_POST['txnDateTime'])) {
					$txnDateTime = $_POST['txnDateTime'];
						
				 }
				/*Custom Parameters*/

			if(isset($_POST['PayPackage'])) {
					$PayPackage = $_POST['PayPackage'];//
						
				 }
			if(isset($_POST['PaymentFor'])) {
					$PaymentFor = $_POST['PaymentFor'];//
						
				 }
		    if(isset($_POST['PaymentMode'])) {
					$PaymentMode = $_POST['PaymentMode'];//
						
				 }
			if(isset($_POST['LeadsCredited'])) {
					$LeadsCredited = $_POST['LeadsCredited'];//
						
				 }
		    if(isset($_POST['PayuserId'])) {
					$User_Id = $_POST['PayuserId'];//
						
				 }

		   

		if($PayPackage =="LITE"){
          $amount=100;
          $leads_credits_real="84.75";
          $credited=$LeadsCredited;
          $split_pay="Rs. 84.75 + Rs. 15.25 GST";
        }
        else if($PayPackage =="MINI"){
          $amount=10;
          $leads_credits_real="8.475";
          $credited=$LeadsCredited;
          $split_pay="Rs. 8.475 + Rs. 1.525 GST";
       } 
       else if($PayPackage =="TRIAL"){
          $amount=1;
          $leads_credits_real="0.82";
          $credited=$LeadsCredited;
          $split_pay="Rs. 0.82 + Rs. 0.18 GST";
      } 
      else if($PayPackage =="BASIC"){
        $amount=1010; //extra 1%
        //$amount=1000+10;
        $leads_credits_real="847.46";
        $credited=$LeadsCredited;
        $split_pay="Rs. 847.46 + Rs. 152.54 GST";
      }
      else if($PayPackage =="PRO"){
        $amount=5250;
        $leads_credits_real="4237.29";
        $credited=$LeadsCredited;
        $split_pay="Rs. 4347.83 + Rs. 652.17 GST";
      }
      else if($PayPackage =="ELITE"){
        $amount=11000;
        $leads_credits_real="8474.58";
        $credited=$LeadsCredited;
        $split_pay="Rs. 8695.65 + Rs. 1304.35 GST";
      }
      else{
            $amount=$_POST['amount'];
            $leads_credits_real=$_POST['amount'];
            $credited=$LeadsCredited;
      }
				/*Custom Parameters ends*/ 

		//-------------------Capturing Card/Netbanking Details----------------------------//

        if(isset($_POST['maskedCardNumber'])) {
				$maskedCardNumber = $_POST['maskedCardNumber'];
		     }


		if(isset($_POST['cardHolderName'])) {
				$cardHolderName = $_POST['cardHolderName'];
			 }


		if(isset($_POST['cardType'])) {
				$cardType = $_POST['cardType'];
			 }

		if(isset($_POST['paymentMode'])) {
				$paymentMode = $_POST['paymentMode'];
			 }
			 echo $paymentMode;

		if(isset($_POST['currency'])) {
				$currency = $_POST['currency'];
			 }

		$Displays = 1;
		if(isset($_POST['signature'])) {
				$signature = $_POST['signature'];
			 }
		
		/*Signature Verification*/     
		    $respSignature = hash_hmac('sha1', $data, $secret_key);

			 if($signature != "" && strcmp($signature, $respSignature) != 0) {
				$flag = "false";
			 }
	    /*Signature Verification ends*/  
			  $this->set(compact('flag'));

			  $this->loadModel("User"); 
			
			  $this->loadModel("Leadaltpayment");
			  $this->loadModel("Quotealtpayment");
			  $position = 1;

			 
			   $query="SELECT id FROM users WHERE id ='".$User_Id."' ";
			  

		    
			  $User_data = $this->User->query($query);
			  
			  $User_Id=$User_data[0]['users']['id'];
			  
			  $date = date('Y-m-d H:i:s');
			  $pay_online="ONLINE";
			   if ($_POST['TxStatus'] == "SUCCESS") {
			   	$verify=1;
			   }else{
			   	$verify=0;
			   }
		       
              //$PaymentFor  $PayPackage
			  
			  if($User_Id != NULL) 
			  {
		       

		         $query="INSERT INTO quoteotherpayments SET  user_id = '".$User_Id."',created_date='".$date."',amount = '".$amount."',TxStatus = '".$TxStatus."',TxId = '".$TxId."',TxRefNo ='".$TxRefNo."',TxMsg = '".$TxMsg."',firstName='".$firstName."',lastName = '".$lastName."',pgTxnNo='".$pgTxnNo."', addressStreet1='".$addressStreet1."',email='".$email."',mobileNo = '".$mobileNo."',addressCity='".$addressCity."',addressState='".$addressState."',addressZip='".$addressZip."',addressCountry='".$addressCountry ."',txnDateTime='".$txnDateTime."',maskedCardNumber='".$maskedCardNumber."',payment_mode='".$pay_online."',signature='".$signature."',TxGateway='".$TxGateway."',transactionId='".$transactionId."',issuerRefNo='".$issuerRefNo."',authIdCode='".$authIdCode."',pgRespCode='".$pgRespCode."',cardHolderName='".$cardHolderName."',cardType='".$cardType."',currency='".$currency."',payment_for='".$PaymentFor."',package_name='".$PayPackage."',paymentMode='".$paymentMode."',leads_credited='".$credited."',leads_credits_real='".$leads_credits_real."',verify='".$verify."'";
		          
	
			      
		
		         $this->Leadaltpayment->query($query);
		         $pay_id=$this->Leadaltpayment->id;

			     
		      }//user id defined
		      
              /*Checking if payment process is success or failure*/
					  if ($_POST['TxStatus'] == "SUCCESS") {

					  	                  if($User_Id != NULL)  {

					  	                      $query="update users set leads_displays_count=leads_displays_count+$LeadsCredited,download_yes=1,position=$position where id=$User_Id ";
										      $this->User->query($query);
									      }
									     
                                          $balance=$this->GenieUser->credit_balance($User_Id);
$message="Your Order: ''$PayPackage'' Leads Package is Successful! Thank you.

Order Id: $pay_id
Package: $PayPackage
Credits: $credited
Price: Rs. $amount ($split_pay)
Payment Mode: $paymentMode

Credits Balance: $balance
Credits History: $credits_url 

Best Regards,
Xerve Team.

www.xerve.in"; 									      

				

                                                  $to = $mobileNo;
                                                 

                                                  $message=urlencode($message);
                                                
                                                  $this->to=$to;
                                                  $to=substr($to,-10) ;
                                                  $arrayto=array("9", "8" ,"7");
                                                  $to_check=substr($to,0,1);
                                              
                                                   if(in_array($to_check, $arrayto))
                                                    
                                                    $this->to=$to;

                                                

                                                  if($time=='null')          
                                                   
                                                    $time='';
                                                  
                                                  else           
                                                   
                                                      $time=urlencode($time);

                                                      $time="&time=$time";
                                                 
                                                
                                                  if($unicode=='null')          
                                                   
                                                    $unicode='';
                                                  
                                                  else          
                                                  

                                                    $unicode="&unicode=$unicode";
                                                 
                                              
                                                    
                                                    $url="http://alerts.solutionsinfini.com/api/web2sms.php?workingkey=A5d8f4c8c48eb27a2b0e14ae549b76ce5&sender=iXERVE&to=$to&message=$message&type=json";
                                    
                                          
                                        

                                                            $ch=curl_init(); 
                                                            curl_setopt($ch, CURLOPT_URL, $url);
                                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                            $output=curl_exec($ch);
                                                            curl_close($ch);

                               
                                           $this->loadModel("User"); 

		
            $balance = $this->GenieUser->credit_balance($User_Id);
			$this->set('balance',$balance);

			/*Email Template*/
			$User_data = $this->Quotealtpayment->get_details_for_pricing($User_Id);
			$first_name=$User_data[0]['quoteotherpayments']['firstName'];
			$last_name= $User_data[0]['quoteotherpayments']['lastName'];
			$addressStreet1=$User_data[0]['quoteotherpayments']['addressStreet1'];
			$addressCity= $User_data[0]['quoteotherpayments']['addressCity'];
			$addressState=$User_data[0]['quoteotherpayments']['addressState'];
			$addressZip= $User_data[0]['quoteotherpayments']['addressZip'];
			$mobileNo= $User_data[0]['quoteotherpayments']['mobileNo'];

			$Amount=$User_data[0]['quoteotherpayments']['amount'];
			$txnid= $User_data[0]['quoteotherpayments']['TxId'];
			$usrEmail= $User_data[0]['quoteotherpayments']['email'];
			$mobile=  $User_data[0]['quoteotherpayments']['mobileNo'];
			$payment_for=  $User_data[0]['quoteotherpayments']['payment_for'];//Leads
			$package_name=  $User_data[0]['quoteotherpayments']['package_name'];//basic,pro,elite
			$payment_mode=  $User_data[0]['quoteotherpayments']['paymentMode'];//netbanking,credit cards/debit card
			$payment_id=  $User_data[0]['quoteotherpayments']['id'];//
			$online=  $User_data[0]['quoteotherpayments']['payment_mode'];//online/offline
			$leads_credited=  $User_data[0]['quoteotherpayments']['leads_credited'];//credits*/




			$this->set('first_name',$first_name);
			$this->set('last_name',$last_name);
			$this->set('street',$addressStreet1);
			$this->set('city',$addressCity);
			$this->set('zip',$addressZip);


			$this->set('Amount',$Amount);
			$this->set('payment_for',$payment_for);

			$this->set('package_name',$package_name);
		
			$this->set('payment_mode',$payment_mode);
			$this->set('payment_id',$payment_id);
			$this->set('leads_credited',$leads_credited);



			if($payment_for == "Leads"){
			// $subject
			 	$subject = "Order No. ".$payment_id." | Leads Package : ".$package_name." (".$leads_credited." Credits)| View Details";	
		    }

			if(empty($_SESSION['PaymentDone'])){
			$email = new CakeEmail();
			
										$email->config('smtp');
										$email->template('onlinepayment_success');
										$email->emailFormat('html');
										$email->from(array('info@xerve.in'));

										$email->viewVars(array('first_name' => $first_name,'last_name' => $last_name,"Amount"=>$Amount,"Order_Id"=>$txnid,'payment_for'=>$payment_for,'package_name'=>$package_name,'payment_mode'=>$payment_mode,'leads_credited'=>$leads_credited,'payment_id'=>$payment_id));

										
										
										$email->to(array($usrEmail));
										$email->bcc(array('info@xerve.in','orders@xerve.in'));									
										$email->replyTo(array('support@xerve.in'));
										$email->subject($subject);
										$email->send();
			}
			$_SESSION['PaymentDone']="Success";

			/*Email Template Ends*/

						            }//success
					  else{
					  	
					  	 $balance=$this->GenieUser->credit_balance($User_Id);

					  	 $paymentMode=str_replace("_"," ",$paymentMode);

$message="Your Order: ''$pay_id'' Leads Package - Failed!

Please Try Again with a different Payment Mode: $pricing_url. Thank you.

Package: $PayPackage
Credits: $credited
Price: Rs. $amount ($split_pay)
Payment Mode: $paymentMode

Credits Balance: $balance
Credits History: $credits_url 

Best Regards,
Xerve Team.

www.xerve.in";  

			  $to = $mobileNo;
                                                 

              $message=urlencode($message);
            
              $this->to=$to;
              $to=substr($to,-10) ;
              $arrayto=array("9", "8" ,"7");
              $to_check=substr($to,0,1);
          
               if(in_array($to_check, $arrayto))
                
                $this->to=$to;

            

              if($time=='null')          
               
                $time='';
              
              else           
               
                  $time=urlencode($time);

                  $time="&time=$time";
             
            
              if($unicode=='null')          
               
                $unicode='';
              
              else          
              

                $unicode="&unicode=$unicode";
             
          
                
                $url="http://alerts.solutionsinfini.com/api/web2sms.php?workingkey=A5d8f4c8c48eb27a2b0e14ae549b76ce5&sender=iXERVE&to=$to&message=$message&type=json";

      
           // if($quoted_user != $seller_leads[users][id]){ 

                        $ch=curl_init(); 
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $output=curl_exec($ch);
                        curl_close($ch);

                                
					     	
					     	$this->redirect(array("controller" => "pricing","action" => "fail"));
					      }//fail
		    /*Checking if payment process is success or failure*/  
			  
			  
	}//ResponsePage

     public function success(){
	//Configure::write('debug', 2);
            $this->loadModel("User"); 
            $this->loadModel("GenieUser");
            $this->loadModel("Leadaltpayment"); 

			$User_Id = $this->Auth->user('id');
			$this->set('User_Id', $User_Id);
			//$User_Id
			$UserStatus  = $this->Auth->user('status');
			$this->set('UserStatus',@$UserStatus);

        /*fetching payment & balance details*/
			
            $balance = $this->GenieUser->credit_balance($User_Id);
			$this->set('balance',$balance);

			/*Email Template*/
			$User_data =$this->Leadaltpayment->get_off_details($User_Id);
			$first_name=$User_data[0]['quoteotherpayments']['firstName'];
			$last_name= $User_data[0]['quoteotherpayments']['lastName'];
			$addressStreet1=$User_data[0]['quoteotherpayments']['addressStreet1'];
			$addressCity= $User_data[0]['quoteotherpayments']['addressCity'];
			$addressState=$User_data[0]['quoteotherpayments']['addressState'];
			$addressZip= $User_data[0]['quoteotherpayments']['addressZip'];
			$mobileNo= $User_data[0]['quoteotherpayments']['mobileNo'];

			$Amount=$User_data[0]['quoteotherpayments']['amount'];
			$txnid= $User_data[0]['quoteotherpayments']['TxId'];
			$usrEmail= $User_data[0]['quoteotherpayments']['email'];
			$mobile=  $User_data[0]['quoteotherpayments']['mobileNo'];
			$payment_for=  $User_data[0]['quoteotherpayments']['payment_for'];//Leads
			$package_name=  $User_data[0]['quoteotherpayments']['package_name'];//basic,pro,elite
			$payment_mode=  $User_data[0]['quoteotherpayments']['paymentMode'];//netbanking,credit cards/debit card
			$payment_id=  $User_data[0]['quoteotherpayments']['id'];//
			$online=  $User_data[0]['quoteotherpayments']['payment_mode'];//online/offline
			$leads_credited=  $User_data[0]['quoteotherpayments']['leads_credited'];//credits*/

        /*eof fetching payment & balance details*/


			$this->set('first_name',$first_name);
			$this->set('last_name',$last_name);
			$this->set('street',$addressStreet1);
			$this->set('city',$addressCity);
			$this->set('zip',$addressZip);


			$this->set('Amount',$Amount);
			$this->set('payment_for',$payment_for);

			$this->set('package_name',$package_name);
		
			$this->set('payment_mode',$payment_mode);
			$this->set('payment_id',$payment_id);
			$this->set('leads_credited',$leads_credited);


            /* Email Template */
			if($payment_for == "Leads"){
		
			 	$subject = "Order No. ".$payment_id." | Leads Package : ".$package_name." (".$leads_credited." Credits)| View Details";	
		    }

			if(empty($_SESSION['PaymentDone'])){
			$email = new CakeEmail();
			
										$email->config('smtp');
										$email->template('onlinepayment_success');
										$email->emailFormat('html');
										$email->from(array('info@xerve.in'));

										$email->viewVars(array('first_name' => $first_name,'last_name' => $last_name,"Amount"=>$Amount,"Order_Id"=>$txnid,'payment_for'=>$payment_for,'package_name'=>$package_name,'payment_mode'=>$payment_mode,'leads_credited'=>$leads_credited,'payment_id'=>$payment_id));

										
										//$email->to("$usrEmail");
										$email->to(array($usrEmail));
										$email->bcc(array('info@xerve.in','orders@xerve.in'));									
										$email->replyTo(array('support@xerve.in'));
										$email->subject($subject);
										$email->send();
			}
			$_SESSION['PaymentDone']="Success";

			/*Eof Email Template */

          
			$this->redirect('/myaccount/billingdetails/success');	
			
	
}//success

public function fail(){

			$User_Id = $this->Auth->user('id');
			$this->set('User_Id', $User_Id);
			
			$UserStatus  = $this->Auth->user('status');
			$this->set('UserStatus',@$UserStatus);
           
             $this->redirect('/myaccount/billingdetails/fail');
			

}//fail

  ////////////////////////////////////////
// get the credit balance of a user
///////////////////////////////////////
public function credit_balance($user_id){

    $this->loadModel('GenieUser');
    $balance = $this->GenieUser->credit_balance($user_id);
        return $balance;
}
// get the credit balance of a user 

public function otherpay(){
	    $User_Id = $this->Auth->user('id');

        
		$this->loadModel("Leadaltpayment");
		$date = date('Y-m-d H:i:s');
        $offline_payment="offline";

        $Mydata['created_date']= $date;
        $Mydata['user_id']=$this->request->data['user_id'];
        //$Mydata['user_id']= $User_Id;
        $Mydata['firstName']=$this->request->data['firstname'];
        $Mydata['lastName']=$this->request->data['lastname'];
        $Mydata['addressStreet1']=$this->request->data['street1'];
        $Mydata['addressCity']=$this->request->data['city'];
        $Mydata['addressState']=$this->request->data['state'];
        $Mydata['addressCountry']=$this->request->data['country'];
        $Mydata['addressZip']=$this->request->data['zip'];
        $Mydata['amount']=$this->request->data['amount'];

        $Mydata['mobileNo']=$this->request->data['mobile'];
        $Mydata['email']=$this->request->data['email'];
        $pay_type=ucfirst($this->request->data['paytype']);
        $pay_pack=$this->request->data['paypack'];
        $Mydata['payment_type']=ucfirst($this->request->data['paytype']);
        $Mydata['package_name']=$this->request->data['paypack'];


		    if($Mydata['package_name'] =="LITE"){$amount=100;$leads_credits_real="84.75";}
		    if($Mydata['package_name'] =="MINI"){$amount=10;$leads_credits_real="8.475";}
			if($Mydata['package_name'] =="STANDARD"){$amount=500;$leads_credits_real="423.73";}	 
			if($Mydata['package_name'] =="BASIC"){$amount=1000;$leads_credits_real="847.46";}
			if($Mydata['package_name'] =="PRO"){$amount=5000;$leads_credits_real="4237.29";}
			if($Mydata['package_name'] =="ELITE"){$amount=10000;$leads_credits_real="8474.58";}

         $status='Pending';
  
        $Mydata['leads_credits_real']=$leads_credits_real;

        $Mydata['payment_for']=$this->request->data['payfor'];

         $Mydata['leads_credited']=$this->request->data['leads_credited'];
         $leads_credited=$this->request->data['leads_credited'];

        $Mydata['chequeno']=$this->request->data['chequeno'];
        $Mydata['neftno']=$this->request->data['neftutrno'];
        $Mydata['ddno']=$this->request->data['ddno'];
        echo json_encode($Mydata);

        $this->Leadaltpayment->save($Mydata);
        $pay_id=$this->Leadaltpayment->id;

        /*sms for sellers*/

/*sms content*/


$message ="Received Request for $pay_pack Leads Package.

Order Id: $pay_id
Price: Rs. $amount
Credits: $leads_credited
Payment Mode: $pay_type
Status: $status

We will review and update the Status within 1 Business Hour.

Best Regards,
Xerve Team.

www.xerve.in";

/*eof sms content*/

      $mobile=$this->request->data['mobile'];

      $to = $mobile;

      $message=urlencode($message);

      $this->to=$to;
      $to=substr($to,-10) ;
      $arrayto=array("9", "8" ,"7");
      $to_check=substr($to,0,1);

      if(in_array($to_check, $arrayto))

      $this->to=$to;
      
      if($time=='null')          

      $time='';

      else           

      $time=urlencode($time);

      $time="&time=$time";
      
      if($unicode=='null')          

      $unicode='';

      else          
      
      $unicode="&unicode=$unicode";
      
      $url="http://alerts.solutionsinfini.com/api/web2sms.php?workingkey=A5d8f4c8c48eb27a2b0e14ae549b76ce5&sender=iXERVE&to=$to&message=$message&type=json";
      
      $ch=curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $output=curl_exec($ch);
      curl_close($ch);

 /*eof sms for sellers*/
        
       // $this->redirect(array('controller' => 'myaccount','action' => 'billingdetails',$offline_payment));
        
        // $this->redirect(array('controller' => 'leads', 'action' => 'enquiry_details',$enquiry_id));
        exit();


        

}
public function buyer_check(){
	   $this->layout = false;

        $this->autoRender = false;

            $this->loadModel("User"); 
		    $mobile_number=$this->request['data']['mobile'];    
		    $query="SELECT id,business_email,mobile_number,status FROM users WHERE mobile_number ='".$mobile_number."'";
			$User_data = $this->User->query($query);

			//echo json_encode($User_data);
			//header('Content-Type: application/json');

			$Total_array['id'] = $User_data[0]['users']['id'];
			$Total_array['status'] = $User_data[0]['users']['status'];
			echo json_encode($Total_array);
			// echo json_encode($User_data[0]['users']['status']);

			// exit();
		}

public  function loginajaxseller(){


		$this->autoRender = false;

		if(empty($MyUser_id))
		$User_Id = $this->Auth->user('id');
        else
        $User_Id = $MyUser_id;

    	$refer = Controller::referer();

    	if(!empty($this->request->data['User']['business_email']))
		$user_name = $this->request->data['User']['business_email'];

		if(!empty($this->request->data['User']['password']))
		$password = $this->request->data['User']['password'];

		$Md5_password = AuthComponent::password($password);


    	$user_details = $this->User->find('first',array(

                        'conditions' => array('User.mobile_number'=>$user_name,'User.password'=>$Md5_password,'User.status'=>0),

                        'fields' => array('User.first_name','User.last_name','User.id','User.mobile_number'),

                        'order'      => 'User.id asc'

                ));


    	 if(!empty($user_details)){

                $user_id_main = $user_details['User']['id'];

                $user_value = $this->User->findById($user_id_main);

                $User_Id = $user_details['User']['id'];

                $full_name = $user_value['User']['first_name']." ".$user_value['User']['last_name'];

                $user = $user_value['User'];

                $this->Auth->login($user);


                // $result['']

               	$result['user_name'] = $full_name;

               	$result['result'] = $user_value['User']['id'];

               	$result['mobile'] =  $user_value['User']['mobile_number'];



            }else{

            	$result['result'] = 'No';
            }

            echo json_encode($result);

	}

    public  function get_uidfsid($sid_id){

    	    $this->loadModel("GenieUser");

			//$sidquery="SELECT vid FROM offline_sellers WHERE seller_type=1 AND  seller_id='".$sid_id."'";

            $sidsellerid =  $this->GenieUser->get_offline_seller_id($sid_id);                                                          
                                                                             
           // $sid_query =  $this->OfflineSeller->query($sidquery);
    
            //$sidsellerid=$sid_query[0]['offline_sellers']['vid'] ;

            return $sidsellerid;
    }     


	public function get_seller_status($sender_id){
		
		$this->loadModel("GenieUser");	

		
	    $seller_status=$this->GenieUser->get_seller_status($sender_id);
		

		return $seller_status;


	}     

    public function getCategory_Credits($catid){
      $this->loadModel("Quotecategory");
      // $query="SELECT credits FROM offer_categories WHERE id='".$catid."'  ";
      // $result =  $this->Lead->query($query);
      $credits=$this->Quotecategory->getCategory_Credits($catid);
      return $credits;
   }//getCategory_Credits
                                                                            


    /*updated by nithin on 08-02-17*/
}