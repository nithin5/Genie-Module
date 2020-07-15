<?php
  
/**

 * Static content controller.

 *

 * This file will render views from views/pages/

 *

 * PHP 5

 *

 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)

 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)

 *

 * Licensed under The MIT License

 * Redistributions of files must retain the above copyright notice.

 *

 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)

 * @link          http://cakephp.org CakePHP(tm) Project

 * @package       app.Controller

 * @since         CakePHP(tm) v 0.2.9

 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)

 */



App::uses('AppController', 'Controller');

App::uses('CakeEmail', 'Network/Email');

App::uses('GeoIpLocation', 'GeoIp.Model');


App::uses("AuthComponent", "Controller/Component");

/**

 * Static content controller

 *

 * Override this controller by placing a copy in controllers directory of an application

 *

 * @package       app.Controller

 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html

 */

class UsersController extends AppController { 


/**

 * Controller name

 *

 * @var string

 */

	public $name = null;

	public $helpers = array('Js');



/**

 * This controller does not use a model

 *

 * @var array

 */

public $uses = array('Country','City','Category','SubCategory','Area','cake_sessions','Day','Month','Year');

public $components = array('Cookie','SolrServer');

/**


 * Displays a view

 *

 * @param mixed What page to display

 * @return void

 */

	public function beforeFilter() {

	if($this->Auth->user('id')){

		$this->set("UserData",ucfirst($this->Auth->user('id')));
		$this->set("UserStatus",ucfirst($this->Auth->user('status')));

		} 
		 if(!empty($array[0]))
		  $LiveUser = count($array[0]); 
		$this->set("LiveUser",@$LiveUser);
		  
		 $UserStatus  = $this->Auth->user('status');
		 $this->set('UserStatus',@$UserStatus);

		 $this->set('SolrComponent', $this->SolrServer);
		
		 $User_Id = $this->Auth->user('id'); 
		 $this->set('User_Id',@$User_Id);
		
		 if($this->Auth->user('id')){
		 
		 if(!empty($UserStatus))
		 $Dname = $this->Auth->user('first_name')." ".$this->Auth->user('last_name');
		 else
		 $Dname = $this->Auth->user('company_name');	 
		 
		 $this->set('Dname',@$Dname);
		 
		 }
		
		if($this->params['action'] != 'join'){
		
		$Day_Lists = $this->Day->find('list', array('conditions' => array('Day.deleted_flag' => '1'),
													 'fields' => array('Day.id','Day.day'),
													 'order' => array('Day.id asc')));
	
	 	$Month_Lists = $this->Month->find('list', array('conditions' => array('Month.deleted_flag' => '1'),
													 'fields' => array('Month.id','Month.month_name'),
													 'order' => array('Month.id asc')));
	 
	 	$Year_Lists = $this->Year->find('list', array('conditions' => array('Year.deleted_flag' => '1'),
													 'fields' => array('Year.id','Year.year'),
													 'order' => array('Year.id desc')));		
													 
    
		$this->loadModel('OfferCategory');

		$Offer_Category = $this->OfferCategory->find('list', array('conditions' => array('OfferCategory.deleted_flag' => '0'),'fields' => array('OfferCategory.id','OfferCategory.category_name'),
			 'order' => array('OfferCategory.category_name asc')));
			  
		$Default_Category = 1; 


		$CategoryList = $Offer_Category;

						
	    //echo "<pre>";print_r($CategoryList);echo "</pre>";	exit();									 														 
		 $this->set("Offer_Category", $Offer_Category);
		 $this->set('CategoryList',$CategoryList);
		 $this->set('Day_Lists',$Day_Lists);
		 $this->set('Month_Lists',$Month_Lists);
		 $this->set('Year_Lists',$Year_Lists);
		}

		$this->Auth->allow("star_rating","rate_review","register","dynamic_login","activate","success","forgotpassword","createnewpassword","enquiry","direct_enquiry","review","feedback","direct_login","loginajax","registerajax","loginajaxapp","logout","join","logout_ajax","unique_count");

		

	}

	function index()

	{

		
	
		$this->redirect("/");
		
		$this->set("title_for_layout","Xerve.in - Users");

	}
	
	
	public function direct_login() {
	
	// Configure::write('debug', 2);
	$this->layout = "sucess";
	
	$this->loadModel("User");
	
	
	if(!empty($this->request->data['User']['business_email'])){
	
	$Email_Id = $this->request->data['User']['business_email'];
	
	$User_Details = $this->User->find('first',
		
			      array(
						'conditions' => array("User.business_email" => $Email_Id),
						  
						'fields' => array('User.id'),
						
						'order' => array('created desc')));
						
						
	//echo "<pre>";print_r($User_Details);echo "</pre>"; exit();	
	
	$MyUser_id = $User_Details['User']['id'];
	
    $user = $this->User->findById($MyUser_id);
						
	$user = $user['User'];	
												
	$this->Auth->login($user);
	
	$this->redirect('/');
	
	}
	
	//echo "<pre>";print_r($user);echo "</pre>";
	
	//echo "User Id: ".$MyUser_id;exit();
	
	
		
}
public function registerajax(){


			// Configure::write("debug",2);

			$this->loadModel('User');		

			$this->autoRender = false;



			$result = "";
			
			$email_check =  $this->request->data['register']['Business_Email'];

            $mobile_check = $this->request->data['register']['MblNo'];	

             if(!empty($email_check)){

            	$EmailFound = $this->User->find('list', array(
                    'conditions' => array('business_email' => $email_check),
                    'fields' => array('id, business_email')));

                $CntEmailFound = count($EmailFound);

            }else{

                $CntEmailFound = 0;

            }

             $MobileFound = $this->User->find('list', array(
                    'conditions' => array('mobile_number' => $mobile_check),
                    'fields' => array('id, mobile_number')));

                $CntMobileFound = count($MobileFound);

                // $CntEmailFound = count($EmailFound);

                // echo "<pre>"; print_r($MobileFound);

           $user_buyer = array_keys($MobileFound)[0];     

           $buyer_userid = $this->request->data['buyer_userid']; 


   //         $result['user_name12657'] = $mobile_check;
   //         $result['user_name12'] = $user_buyer;
   //         	$result['user_name'] = $user_buyer;

			// echo json_encode($result); die;

           $country_name = $this->request->data['login_country'];
			$this->loadModel('Country'); 
	    	$xerve_save356 = " country_name='" .$country_name."'";
			$saveareaname1 = $this->Country->query('select `id` from countries where'. $xerve_save356);
			$country_id = $saveareaname1[0]['countries']['id'];

			if (empty($country_id)) {
				$Country_array['country_name'] = $this->request->data['login_country'];
				$Country_array['deleted_flag'] = 1;
	    	  
				if ($this->Country->save($Country_array)){
					$countrylastId = $this->Country->id;
				}						
				$country_id = $countrylastId;		
			}

		


			if(empty($this->request->data['login_area']) || empty($this->request->data['login_state'])){

				$area_name_google = "";

				$city_name_google = "";

				$state_name_google = "";

				$lat_reg = $this->request->data['login_latitude'];

				$lon_reg = $this->request->data['login_longitude'];

				

				$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat_reg.",".$lon_reg."&key=AIzaSyBLaay-Ls0Ktl3zp-VL0lgYqFRp-sSg6zI";
                $ch=curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $output=curl_exec($ch);
                curl_close($ch);
                $objs = json_decode($output);

                foreach ($objs->results[0]->address_components as $value) {

                	if($value->types[2]=='sublocality_level_1'){

                            $area_name_google = $value->long_name;

                      }

                      if($value->types[0]=='locality'){

                        	$city_name_google   = $value->long_name;
                      }

                      if($value->types[0]=='administrative_area_level_1'){

                            $state_name_google   = $value->long_name;
                       }
                }

                if(!empty($area_name_google)){

                	$this->request->data['login_area'] = $area_name_google;
                }
			}

			//getting state id based on name

			if(empty($this->request->data['login_state'])){

				$this->request->data['login_state'] = $state_name_google;
			}


			$state_name = $this->request->data['login_state'];

			$this->loadModel('StateList'); 
			if ($state_name=='0') {
				$state_id = $state_name;
			}else{
				$xerve_save356 = " state_name='" .$state_name."' and deleted_flag=0";
			    $saveareaname1 = $this->StateList->query('select `id` from state_lists where'. $xerve_save356);
				$state_id = $saveareaname1[0]['state_lists']['id'];
			}

			if (!empty($state_id) || $state_id=='0') {
			    $store_state_id = $state_id;
			}else{

				$state_array['state_name'] = $this->request->data['login_state'];
				$state_array['deleted_flag'] = 0;
	    	  	$state_array['country_id'] = $country_id;

				if ($this->StateList->save($state_array)){
					$statelastId = $this->StateList->id;
				}
				$store_state_id = $statelastId;
			}

			if(empty($this->request->data['login_city']) && !empty($city_name_google)){

				$this->request->data['login_city'] = $city_name_google;
			}


			if(!empty($this->request->data['login_city'])){

					$this->loadModel('City'); 

            		$login_city = $this->request->data['login_city'];
		              
		          

		            $xerve_save356 = " city_name='" .$login_city."'";

				    $saveareaname1 = $this->City->query('select `id` from cities where'. $xerve_save356);

					$city_id = $saveareaname1[0]['cities']['id'];

					
					if ($city_id == "0") {

			      		 $store_city_id = $city_id;
			      	}else{
		            if (!empty($city_id)) {
						
						  $store_city_id = $city_id;
					}else{

						 $this->loadModel('City'); 

						 $this->set('xervesubcat12', $this->City->find('ajax'));

						 if ($this->request->is('post')){ 

						 $xervesubcat12['city_name'] = $this->request->data['login_city'];

						  $xervesubcat12['deleted_flag'] = 1;
						  $xervesubcat12['country_id'] = $country_id;
						  $xervesubcat12['state_id'] = $store_state_id;
						//$array2['city'] = All;

						 if ($this->City->save($xervesubcat12)){

						 	$lastId = $this->City->id;
						 }

						 $store_city_id = $lastId;

						}
					}
				}



			}

			//if the area value is empty

			

			


			if(!empty($this->request->data['login_area'])){
		
				$this->loadModel('Area');

            	$login_area = $this->request->data['login_area'];
            
	           	if ($login_area == "0") {

	              	$area_id = $login_area;
	            }else{
			      	$xerve_save3567 = " area_name='" .$login_area."'";

			     	$saveareaname12 = $this->Area->query('select `id` from areas where'. $xerve_save3567);

					$area_id = $saveareaname12[0]['areas']['id'];

				}

				if ($area_id == "0") {
				
					$store_area_id = $area_id;		
				}else{
	            if (!empty($area_id)) {      	
	            	
					$store_area_id = $area_id;		

				}else{

					$this->loadModel('Area'); 

					$this->set('xervesubcat123', $this->Area->find('ajax'));

					if ($this->request->is('post')){ 

						$xervesubcat123['area_name'] = $this->request->data['login_area'];

						$xervesubcat123['deleted_flag'] = 1;
						$xervesubcat123['city_id'] = $store_city_id;

						if ($this->Area->save($xervesubcat123)){

						 	$lastId = $this->Area->id;
						}

						$store_area_id = $lastId;

					}

				}

			}

			}


           if ($user_buyer == $buyer_userid && !empty($buyer_userid) && $buyer_userid!=null) {
           	
           	// echo "here";	brand_for
           	// update the value buyer account to seller account

           	$set_qry = "";


           	$where_qry = "id='".$buyer_userid."' ";

           	$where_qry_listing = "user_id='".$buyer_userid."' ";

           	$set_qry .= "brand_for='1' ";

			$set_qry .= ", activated='0' ";

				
			if(!empty($this->request->data['register']['iagree']))
			$set_qry .= ", join_from='Direct' ";

			

			$set_qry .= ", business_type='1' ";

			$set_qry .= ", ip='".$_SERVER['REMOTE_ADDR']."' ";

			if($this->request->is('post') && !empty($this->request->data['register']['iagree'])) {
			 	$set_qry .= ", status='0' ";
			 	$user_type_for = 0;
				
				if(isset($this->request->data['FrmJoin']))
				{
				$set_qry .= ", status='0' ";
				$user_type_for = 0;

				}
				if(!empty($this->request->data['FrmRegister']))
				{		
				$set_qry .= ", status='1' ";
				$user_type_for = 1;
				}
	    }


			 if(!empty($this->request->data['register']['Category_id']))
			$set_qry .= ", category_id='".$this->request->data['register']['Category_id']."' ";

			 if(!empty($this->request->data['register']['SubCategory']))
			$set_qry .= ", sub_category_id='".$this->request->data['register']['SubCategory']."' ";	

			if(!empty($this->request->data['register']['companyname']))
			$set_qry .= ", company_name='".$this->request->data['register']['companyname']."' ";
		

			if(!empty($this->request->data['register']['First_Name']))
				$set_qry .= " ,first_name='".$this->request->data['register']['First_Name']."' ";

			if(!empty($this->request->data['register']['Last_Name']))
				$set_qry .= ",last_name='".$this->request->data['register']['Last_Name']."' ";
				
			if(!empty($this->request->data['register']['NamePrfx']))
				$set_qry .= ",name_title='".$this->request->data['register']['NamePrfx']."' ";
				

			if(!empty($this->request->data['register']['MblNo'])){
			
				$set_qry .= ",mobile_number='".$this->request->data['register']['MblNo']."' ";

				$mobile_number = $this->request->data['register']['MblNo'];

			}



			if(!empty($this->request->data['register']['Business_Email']))
			$set_qry .= ",business_email='".$this->request->data['register']['Business_Email']."' ";
			


			// if(isset($this->request->data['FrmJoin']))
			// $set_qry .= ",password='".$this->request->data['register']['Password']."' ";

			// else if(isset($this->request->data['FrmRegister']))
			// $set_qry .= ",password='".$this->request->data['register']['Password']."' ";

			// else{

			if(!empty($this->request->data['register']['Password'])){
				$Md5_password = AuthComponent::password($this->request->data['register']['Password']);
				$set_qry .= ",password='".$Md5_password."' ";

			}


			  date_default_timezone_set('Asia/Calcutta');
		             $DateAdded = date( 'Y-m-d H:i:s' );
            
			
			$set_qry .= ",created='".$DateAdded."' ";    

			$set_qry .= ",lead_became_zero='".$DateAdded."' ";        
			$set_qry .= ",display_became_zero='".$DateAdded."' "; 

			$date = strtotime($DateAdded);
		    $date = strtotime("+7 day", $date);
            $date=date('Y-m-d H:i:s' , $date);


			$Unique_Id = 'XRVL'.substr(str_shuffle(uniqid()), 1, 7);


			$Unique_Code = substr(str_shuffle(uniqid()), 1, 6);

			$set_qry .= ",zero_lead_remainder='".$date."' ";        
			$set_qry .= ",zero_display_remainder='".$date."' ";        
			$set_qry .= ",activation_code='".md5($Unique_Id)."' ";        
			$set_qry .= ",verify_code='".$Unique_Code."' ";        
			

			if(isset($this->request->data['FrmJoin']))

			$set_qry .= ",user_type='2' ";  //2 means  Vendor , 1 default means Clients
			
			if(!empty($this->request->data['FrmRegister']))
			
			$set_qry .= ",user_type='1' "; //2 means  Vendor , 1 default means Clients


			$Channel_Fnd = $this->Cookie->read('WINChannel');

			$Channel_Type = $this->Cookie->read('WINChannel_type');


		


			if(!empty($Channel_Fnd)){

			$set_qry .= ",channel='".$Channel_Fnd."' ";  
			$set_qry .= ",channel_target_type='".$Channel_Type."' ";  

			}



			if(!empty($this->request->data['login_latitude']))
				$set_qry .= ",latitude='".$this->request->data['login_latitude']."' ";


			if(!empty($this->request->data['login_longitude']))
				$set_qry .= ",longitude='".$this->request->data['login_longitude']."' ";



			


			// $UsrCatData['country_id'] = $country_id;	
			// $UsrCatData['state_id'] = $store_state_id;
			// $UsrData['country_id'] = $country_id;	
			// $UsrData['state_id'] = $store_state_id;

			// store_city_id
			// store_area_id

           	if(!empty($country_id)){
				$set_qry .= ",country_id='".$country_id."' ";
           	}


			if(!empty($store_state_id))
				$set_qry .= ",state_id='".$store_state_id."' ";

			if(!empty($store_state_id))
				$set_qry .= ",city_id='".$store_city_id."' ";

			if(!empty($store_state_id))
				$set_qry .= ",area_id='".$store_area_id."' ";
				
			 //echo $set_qry.$where_qry; exit();

		

			$this->User->query("update users set $set_qry where $where_qry");


				// $set_qry .= ",country_id='".$country_id."' ";

			if ($user_type_for==0) {

					$set_qry_listing = '';
					$set_qry_listing .= "deleted_flag='1' ";

					$this->loadModel('BusinessListing');
				
					if(!empty($this->request->data['register']['MblNo'])){
						$set_qry_listing .= ",mobile_number='".$this->request->data['register']['MblNo']."' ";	
					}

					if(!empty($this->request->data['register']['Business_Email'])){
						$set_qry_listing .= ",business_email='".$this->request->data['register']['Business_Email']."' ";	
					}

					if(!empty($this->request->data['register']['First_Name'])){
						$set_qry_listing .= ",first_name='".$this->request->data['register']['First_Name']."' ";	
					}
					if(!empty($this->request->data['register']['Last_Name'])){
						$set_qry_listing .= ",last_name='".$this->request->data['register']['Last_Name']."' ";	
					}

					// $UsrBusiData['first_name'] = $this->request->data['register']['First_Name'];

					// $UsrBusiData['last_name'] = $this->request->data['register']['Last_Name'];

					// $UsrBusiData['designation'] = $MyUser_id;

					if(!empty($this->request->data['register']['companyname']))
			 		$set_qry_listing .= ",company_name='".$this->request->data['register']['companyname']."' ";

					// $UsrBusiData['business_email'] = $this->request->data['register']['Business_Email'];

					if(!empty($this->request->data['login_address'])){
						$address = str_replace("'", "\'", $this->request->data['login_address']);	
			 			$set_qry_listing .= ",office_address='".$address."' ";
					}

					$this->BusinessListing->query("update business_listings set $set_qry_listing where $where_qry_listing");

			}

			$this->loadModel('UserCategory');
			$this->loadModel('BusinessListingCategory');


			$set_qry_cate = '';
			$set_qry_cate .= "brand_for='1' ";

			
			 if(!empty($this->request->data['register']['Category_id']))
			$set_qry_cate .= ", category_id='".$this->request->data['register']['Category_id']."' ";

			 if(!empty($this->request->data['register']['SubCategory']))
			$set_qry_cate .= ", sub_category_id='".$this->request->data['register']['SubCategory']."' ";	

			if(!empty($this->request->data['login_latitude']))
				$set_qry_cate .= ",latitude='".$this->request->data['login_latitude']."' ";


			if(!empty($this->request->data['login_longitude']))
				$set_qry_cate .= ",longitude='".$this->request->data['login_longitude']."' ";

			if(!empty($this->request->data['login_address'])){
				$address = str_replace("'", "\'", $this->request->data['login_address']);	
				$set_qry_cate .= ",address='".$address."' ";
			}

			if(!empty($country_id)){
				$set_qry_cate .= ",country_id='".$country_id."' ";
           	}

			if(!empty($store_state_id))
				$set_qry_cate .= ",state_id='".$store_state_id."' ";

			if(!empty($store_state_id))
				$set_qry_cate .= ",city_id='".$store_city_id."' ";

			if(!empty($store_state_id))
				$set_qry_cate .= ",area_id='".$store_area_id."' ";


		$this->BusinessListingCategory->query("update business_listing_categories set $set_qry_cate where $where_qry_listing");
		$this->UserCategory->query("update user_categories set $set_qry_cate where $where_qry_listing");


		$name  = $this->request->data['register']['First_Name'] . ' ' . $this->request->data['register']['Last_Name'];



		if(!empty($mobile_number)){
		 

			// $message= "Please use this Code: $Unique_Code to complete your Account Activation process. Thank you.";
			$message= "Please use this Code: $Unique_Code to convert your Buyer Account to a Seller Account. Thank you.";


			$to = $mobile_number;
			$message=urlencode($message);
		
			
			// $to = $book_no;
			// $message=urlencode($message);
		
			$this->to=$to;
			$to=substr($to,-10) ;
			$arrayto=array("9", "8" ,"7","6");
			$to_check=substr($to,0,1);
	
			 if(in_array($to_check, $arrayto))
	 			
	 			$this->to=$to;

	 		else echo "invalid number";

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
	

	 			 $objs = json_decode($output);

	 			 // echo "<pre>";print_r($objs);die;
			}


			$result['result'] = $buyer_userid;

			$result['mobile'] = $mobile_number;

			$result['user_name'] = $name;

			echo json_encode($result);


   //         	$result['user_name12'] = "herer";
   //         	$result['user_name'] = $user_buyer;

			// echo json_encode($result); 




           }else{	


      if ($CntEmailFound <= 0  && $CntMobileFound <= 0 ){


	    if(empty($this->request->data['register']['alter'])){


		 if($this->request->is('post') && !empty($this->request->data['register']['iagree'])) {


		 	$UsrData['status'] = 0;	

		 	$user_type_for = 0;
			
			$UsrData['join_from'] = "Direct";
			
			if(isset($this->request->data['FrmJoin']))
			{
			$UsrData['business_type'] = $this->request->data['register']['business_type'];
			// $UsrData['brand_for'] = $this->request->data['register']['business_type'];
			$UsrData['brand_for'] = 1;
			$UsrData['status'] = 0;	
			$user_type_for = 0;

			}
			if(!empty($this->request->data['FrmRegister']))
			{		
			$UsrData['status'] = 1;	
			$user_type_for = 1;
			$UsrData['company_name']="";
			}
	    }


			 if(!empty($this->request->data['register']['business_type'])){


			
			if($this->request->data['register']['business_type']==2)
			{
				if(!empty($this->request->data['register']['Category_id']))
				$UsrData['category_id'] = $this->request->data['register']['Category_id'];	

				if(!empty($this->request->data['register']['SubCategory']))
				$UsrData['sub_category_id'] = $this->request->data['register']['SubCategory'];				
			}else
			{

			if(!empty($this->request->data['register']['offer_Category_id']))
			$UsrData['category_id'] = $this->request->data['register']['offer_Category_id'];			
			}		

			}	
			
			if(!empty($this->request->data['register']['companyname']))
			 $UsrData['company_name'] = $this->request->data['register']['companyname'];		

			 		
			 

			//$UsrData['sub_category_id'] = $this->request->data['register']['SubCategoryCmpySelect'][0];			

           /// if($this->request->data['register']['BusinessType']==2 || isset($this->request->data['FrmJoin']))
			
			// if(!empty($this->request->data['register']['Area_id']))
			// $UsrData['area_id'] = $this->request->data['register']['Area_id'];			

			// if(!empty($this->request->data['register']['City_id']))
			// $UsrData['city_id'] = $this->request->data['register']['City_id'];			

			// $UsrData['country_id'] = 1;			

            if(!empty($this->request->data['register']['OffcPhneCode']))
			$UsrData['office_std_code'] = $this->request->data['register']['OffcPhneCode'];			

			if(!empty($this->request->data['register']['OffcPhneNo']))
			$UsrData['office_phone_number'] = $this->request->data['register']['OffcPhneNo'];			

			//$UsrData['designation'] = $this->request->data['register']['Designation'];			

			//$UsrData['website'] = $this->request->data['register']['website'];			

			$UsrData['first_name'] = ucwords(strtolower($this->request->data['register']['First_Name']));			

			$UsrData['last_name'] = ucwords(strtolower($this->request->data['register']['Last_Name']));

			$Unique_Id = 'XRVL'.substr(str_shuffle(uniqid()), 1, 7);


			$Unique_Code = substr(str_shuffle(uniqid()), 1, 6);

			// $UsrData['activation_code'] = md5($Unique_Id);
			
			//echo "company name: ".$this->request->data['register']['companyname']; exit();
			

            if(!empty($this->request->data['register']['MblNo'])){
			$UsrData['mobile_number'] = $this->request->data['register']['MblNo'];	

			$mobile_number = $this->request->data['register']['MblNo'];

		}


			$UsrData['name_title'] = $this->request->data['register']['NamePrfx'];				
			
			/* if(isset($this->request->data['FrmRegister']))
			 {
			 
			 if(!empty($this->request->data['Day']['Type']))
			 $UsrData['day_id'] = $this->request->data['Day']['Type'];
			
			 if(!empty($this->request->data['Month']['Type']))
			 $UsrData['month_id'] = $this->request->data['Month']['Type'];
			
			 if(!empty($this->request->data['Year']['Type']))
			 $UsrData['year_id'] = $this->request->data['Year']['Type'];	
			 
			 }*/		
			
			// if(!empty($this->request->data['enquiry']['Call']))
			// $UsrData['xxx']= $this->request->data['enquiry']['Call'];

			$UsrData['ip'] = $_SERVER['REMOTE_ADDR'];
			
			$UsrData['business_email'] = $this->request->data['register']['Business_Email'];


              
			if(isset($this->request->data['FrmJoin']))
			$UsrData['password'] = $this->request->data['register']['Password'];
			else if(isset($this->request->data['FrmRegister']))
			$UsrData['password'] = $this->request->data['register']['Password'];
			else{
				$UsrData['business_email'] = $this->request->data['register']['Business_Email'];
				$Md5_password = AuthComponent::password($this->request->data['register']['Password']);
				$UsrData['password']=$Md5_password;
			}


			         date_default_timezone_set('Asia/Calcutta');
		             $DateAdded = date( 'Y-m-d H:i:s' );
            
			         $UsrData['created'] = $DateAdded;	                    

                     $UsrData['lead_became_zero'] = $DateAdded;

                     $UsrData['display_became_zero'] = $DateAdded;

                     $date = strtotime($DateAdded);
		             $date = strtotime("+7 day", $date);
                     $date=date('Y-m-d H:i:s' , $date);

                     $UsrData['zero_lead_remainder'] = $date;

                     $UsrData['zero_display_remainder'] = $date;

					$UsrData['activation_code'] = md5($Unique_Id);

					$UsrData['verify_code']  = $Unique_Code;


			if(isset($this->request->data['FrmJoin']))

			$UsrData['user_type'] = "2"; //2 means  Vendor , 1 default means Clients
			
			if(!empty($this->request->data['FrmRegister']))
			
			$UsrData['user_type'] = "1"; //2 means  Vendor , 1 default means Clients


			$Channel_Fnd = $this->Cookie->read('WINChannel');

			$Channel_Type = $this->Cookie->read('WINChannel_type');

			$Channel_Type_Sub = $this->Cookie->read('WINChannel_type_sub');


			// echo $Channel_Fnd;echo "<br/>";

			// echo $Channel_Type;die;

			if(!empty($Channel_Fnd)){

			$UsrData['channel'] =$Channel_Fnd;
			
			$UsrData['channel_target_type'] =$Channel_Type; 

			$UsrData['sub_channel'] =$Channel_Type_Sub; 


			}

			if(!empty($this->request->data['login_latitude']))
			$UsrData['latitude'] = $this->request->data['login_latitude'];

			if(!empty($this->request->data['login_longitude']))
			$UsrData['longitude'] = $this->request->data['login_longitude'];

			// if(!empty($this->request->data['login_address']))
			// $UsrData['address'] = $this->request->data['login_address'];

		// 	$country_name = $this->request->data['login_country'];
		// 	$this->loadModel('Country'); 
	 //    	$xerve_save356 = " country_name='" .$country_name."'";
		// 	$saveareaname1 = $this->Country->query('select `id` from countries where'. $xerve_save356);
		// 	$country_id = $saveareaname1[0]['countries']['id'];

		// 	if (empty($country_id)) {
		// 		$Country_array['country_name'] = $this->request->data['login_country'];
		// 		$Country_array['deleted_flag'] = 1;
	    	  
		// 		if ($this->Country->save($Country_array)){
		// 			$countrylastId = $this->Country->id;
		// 		}						
		// 		$country_id = $countrylastId;		
		// 	}

		// //getting state id based on name

		// 	$state_name = $this->request->data['login_state'];

		// 	$this->loadModel('StateList'); 
		// 	if ($state_name=='0') {
		// 		$state_id = $state_name;
		// 	}else{
		// 		$xerve_save356 = " state_name='" .$state_name."' and deleted_flag=0";
		// 	    $saveareaname1 = $this->StateList->query('select `id` from state_lists where'. $xerve_save356);
		// 		$state_id = $saveareaname1[0]['state_lists']['id'];
		// 	}

		// 	if (!empty($state_id) || $state_id=='0') {
		// 	    $store_state_id = $state_id;
		// 	}else{

		// 		$state_array['state_name'] = $this->request->data['login_state'];
		// 		$state_array['deleted_flag'] = 0;
	 //    	  	$state_array['country_id'] = $country_id;

		// 		if ($this->StateList->save($state_array)){
		// 			$statelastId = $this->StateList->id;
		// 		}
		// 		$store_state_id = $statelastId;
		// 	}


		


			// if(!empty($this->request->data['login_city'])){

			// 		$this->loadModel('City'); 

   //          		$login_city = $this->request->data['login_city'];
		              
		          

		 //            $xerve_save356 = " city_name='" .$login_city."'";

			// 	    $saveareaname1 = $this->City->query('select `id` from cities where'. $xerve_save356);

			// 		$city_id = $saveareaname1[0]['cities']['id'];

					
			// 		if ($city_id == "0") {

			//       		 $UsrCatData['city_id'] = $city_id;	
			//       		 $UsrData['city_id'] = $city_id;
			//       		 $store_city_id = $city_id;
			//       	}else{
		 //            if (!empty($city_id)) {
			// 			 $UsrCatData['city_id'] = $city_id;	
			// 			  $UsrData['city_id'] = $city_id;
			// 			  $store_city_id = $city_id;
			// 		}else{

			// 			 $this->loadModel('City'); 

			// 			 $this->set('xervesubcat12', $this->City->find('ajax'));

			// 			 if ($this->request->is('post')){ 

			// 			 $xervesubcat12['city_name'] = $this->request->data['login_city'];

			// 			  $xervesubcat12['deleted_flag'] = 1;
			// 			  $xervesubcat12['country_id'] = $country_id;
			// 			  $xervesubcat12['state_id'] = $store_state_id;
			// 			//$array2['city'] = All;

			// 			 if ($this->City->save($xervesubcat12)){

			// 			 	$lastId = $this->City->id;
			// 			 }

			// 			$UsrCatData['city_id'] = $lastId;
			// 			 $UsrData['city_id'] = $lastId;	
			// 			 $store_city_id = $lastId;

			// 			}
			// 		}
			// 	}



			// }

			// if(!empty($this->request->data['login_area'])){
		
			// 	$this->loadModel('Area');

   //          	$login_area = $this->request->data['login_area'];
            
	  //          	if ($login_area == "0") {

	  //             	$area_id = $login_area;
	  //           }else{
			//       	$xerve_save3567 = " area_name='" .$login_area."'";

			//      	$saveareaname12 = $this->Area->query('select `id` from areas where'. $xerve_save3567);

			// 		$area_id = $saveareaname12[0]['areas']['id'];

			// 	}

			// 	if ($area_id == "0") {
			// 		$UsrCatData['area_id'] = $area_id;	
			// 		$UsrData['area_id'] = $area_id;					
			// 	}else{
	  //           if (!empty($area_id)) {      	
	  //           	$UsrCatData['area_id'] = $area_id;	
	  //            	$UsrData['area_id'] = $area_id;		
			// 	}else{

			// 		$this->loadModel('Area'); 

			// 		$this->set('xervesubcat123', $this->Area->find('ajax'));

			// 		if ($this->request->is('post')){ 

			// 			$xervesubcat123['area_name'] = $this->request->data['login_area'];

			// 			$xervesubcat123['deleted_flag'] = 1;
			// 			$xervesubcat123['city_id'] = $store_city_id;

			// 			if ($this->Area->save($xervesubcat123)){

			// 			 	$lastId = $this->Area->id;
			// 			}

			// 			$UsrCatData['area_id'] = $lastId;	
			// 			$UsrData['area_id'] = $lastId;	

			// 		}

			// 	}

			// }

			// }


			$UsrCatData['country_id'] = $country_id;	
			$UsrCatData['state_id'] = $store_state_id;
			$UsrData['country_id'] = $country_id;	
			$UsrData['state_id'] = $store_state_id;

			$UsrCatData['city_id'] = $store_city_id;
			$UsrData['city_id'] = $store_city_id;	

			$UsrCatData['area_id'] = $store_area_id;	
			$UsrData['area_id'] = $store_area_id;	



			// $UsrCatData['country_id'] = $country_id;	
			// $UsrCatData['state_id'] = $store_state_id;
			// $UsrData['country_id'] = $country_id;	
			// $UsrData['state_id'] = $store_state_id;

			// store_city_id
			// store_area_id


			// if(!empty($this->request->data['register']['business_type'])){

			// $UserData['brand_for'] = $this->request->data['register']['business_type'];
			// }

				// if($_SERVER['REMOTE_ADDR']=='122.166.203.173'){

				// 	echo "<pre>";print_r($UsrData);die;
				// }

				if(!empty($UsrData['business_email'])){

					$UsrData['email_send'] = 1;
				}else{

					$UsrData['email_send'] = 0;
				}


				$this->User->save($UsrData);

				$MyUser_id =  $this->User->id;

				// $this->loadModel('Refferal');

					

				// $


				
				/*updated */

				if($UsrData['status'] == 0){// if seller only loop

									$this->loadModel('OfflineSeller');

									$mobile_number_seller = $this->request->data['register']['MblNo'];

									$off_seller_details = $this->OfflineSeller->find('first',array(

														'conditions' => array('OfflineSeller.mobile_number'=>$mobile_number_seller),

														'fields' => array('OfflineSeller.seller_id','OfflineSeller.vid')

										));

									// if(!empty($this->request->data['seller_campaign'])){

								if(empty($off_seller_details)){

									$Unique_Id_Seller = 'SID'.substr(str_shuffle(uniqid()), 1, 7);

									                                  
                                    $Off_Seller['mobile_number'] = $this->request->data['register']['MblNo'];

									$Off_Seller['seller_id'] = $Unique_Id_Seller;
                                    									                                    									
									$Off_Seller['created'] = $DateAdded;

									$Off_Seller['vid']  = $MyUser_id;

									if(!empty($this->request->data['seller_campaign'])){

									$Off_Seller['seller_type'] = 0;
									$Off_Seller['status'] = 1;
									

									}else{

									$Off_Seller['seller_type'] = 1;
									$Off_Seller['status'] = 0;

									}

									$Off_Seller['latitude'] = $this->request->data['login_latitude'];
                                    $Off_Seller['longitude'] = $this->request->data['login_longitude'];
                                    $Off_Seller['category_name'] = $this->request->data['category_seller'];
                                    $Off_Seller['area'] = $this->request->data['login_area'];
                                    $Off_Seller['city'] = $this->request->data['login_city'];
                                    $Off_Seller['address'] = $this->request->data['login_address'];
                                    $Off_Seller['full_name'] = $this->request->data['register']['First_Name']." ".$this->request->data['register']['Last_Name'];
                                    $Off_Seller['business_email'] = $this->request->data['register']['Business_Email'];
                                    $Off_Seller['seller_name'] = $this->request->data['register']['companyname'];
                                    $Off_Seller['mobile_number'] = $mobile_number_seller;
                                    $Off_Seller['landline_number'] = $this->request->data['register']['OffcPhneNo'];
                                    $Off_Seller['seller_name'] = $this->request->data['register']['companyname'];

									$this->OfflineSeller->save($Off_Seller);

									// App::uses('CakeEmail', 'Network/Email');

									if(!empty($this->request->data['seller_campaign'])){
    		
						   //  		$email = new CakeEmail();

						   //          $email->config('smtp');

						   //          $email->from(array('info@xerve.in' => 'Xerve.in'));

						   //          $email->to(array('xerve.retail@gmail.com')); // Customer Service Email


									// $email->cc(array('arunarav@gmail.com'));

									// $email->subject("New Seller Application ($MyUser_id)");

									// $msg_app = "New Seller (SID) Application.";

									

									// if($this->request->data['register']['NamePrfx'] == 1)		{

					    //                 $namePrefix = 'Mr';


					    //             }
					    //             else if($this->request->data['register']['NamePrfx'] == 2){

					    //                 $namePrefix = 'Mrs';

					    //             }else{

					    //                 $namePrefix = 'Ms';
					    //             }

					    //             $Message = $msg_app."\r\nName: ".$namePrefix." ".$this->request->data['register']['First_Name']." ".$this->request->data['register']['Last_Name']."\r\nEmail: ".$this->request->data['register']['Business_Email']."\r\nMobile Number: +91-".$this->request->data['register']['MblNo']." (User Id : ".$MyUser_id.")";

					    //             $email->send($Message);
					            }

								}else{

										$Unique_Id_Seller = $off_seller_details['OfflineSeller']['seller_id'];

										if(empty($off_seller_details['OfflineSeller']['vid']) && !empty($Unique_Id_Seller)){

											$this->OfflineSeller->updateAll(array('OfflineSeller.vid'=>"'$MyUser_id'"),array('OfflineSeller.seller_id'=>$Unique_Id_Seller));
										}


								}


									$result['SID'] = $Unique_Id_Seller;

								// }


									$this->loadModel("Leadaltpayment");



									$category_id=$this->request->data['register']['Category_id'];
									// $query="select type from offer_categories where id='".$category_id."'";//
									// $category_data = $this->User->query($query);
									


									// $company_type=$category_data[0]['offer_categories']['type'];
									// if(($company_type ==1)||($company_type ==3)){
									// $register_credit['leads_credited']='100';
									// $leads_credits=100;
									// }
									// if($company_type ==2){
									// $register_credit['leads_credited']='500';
									// $leads_credits=500;
									// }

									 // $query="select credits from offer_categories where id='".$category_id."'";
									 // $category_data = $this->User->query($query);
									 // $leads_credits=$category_data[0]['offer_categories']['credits'];
									 // $leads_credits=$leads_credits * 3;

                                    $leads_credits=50;


									$register_credit['created_date'] = $DateAdded;
									$register_credit['amount'] = $leads_credits;
									$register_credit['user_id']=$MyUser_id;
									$register_credit['register'] ='1';
									$register_credit['package_name']='FREE';
									$register_credit['payment_mode'] = 'OFFLINE';
									$register_credit['payment_for'] = 'Leads';
									$register_credit['verify']='1';
									$register_credit['firstName'] = $this->request->data['register']['First_Name'];        
									$register_credit['lastName'] = $this->request->data['register']['Last_Name'];
									$register_credit['email'] = $this->request->data['register']['Business_Email'];
									$register_credit['mobileNo'] = $this->request->data['register']['MblNo'];
									
									$this->Leadaltpayment->save($register_credit); 
								 $query=" UPDATE users SET leads_displays_count = leads_displays_count + '".$leads_credits."' WHERE id = '".$MyUser_id."' "; 
								 $this->User->query($query); 

									
							}// if seller only loop	
				/*updated */


				$User_Check = $this->User->find('first', array(
		            'conditions' => array('User.id' => $MyUser_id, 'User.mobile_number' => $mobile_number),
		            'fields' => array('User.business_email', 'User.mobile_number','User.id')
		        ));

		         // $CntUser_Check = count($User_Check);


				if(!empty($User_Check)){



						
			

				// adding seller details in business_listing table 

				$this->loadModel('BusinessListing');


				if ($user_type_for==0) {				
					

					$UsrBusiData['user_id'] = $MyUser_id;

					$UsrBusiData['deleted_flag'] = 1;

					if(!empty($this->request->data['register']['MblNo'])){
						$UsrBusiData['mobile_number'] = $this->request->data['register']['MblNo'];	
					}


					$UsrBusiData['first_name'] = $this->request->data['register']['First_Name'];

					$UsrBusiData['last_name'] = $this->request->data['register']['Last_Name'];

					// $UsrBusiData['designation'] = $MyUser_id;

					if(!empty($this->request->data['register']['companyname']))
			 		$UsrBusiData['company_name'] = $this->request->data['register']['companyname'];

					$UsrBusiData['business_email'] = $this->request->data['register']['Business_Email'];

					if(!empty($this->request->data['login_address']))
					$UsrBusiData['office_address'] = $this->request->data['login_address'];

					$this->BusinessListing->save($UsrBusiData);


				}
					//'fields'   => array('User.first_name','User.last_name','User.designation','User.mobile_number','User.office_std_code','User.office_phone_number','User.company_name','User.business_email'),






				$this->loadModel('UserCategory');
				$this->loadModel('BusinessListingCategory');
				
				if(isset($this->request->data['FrmJoin']))			   
			    $UsrCatData['brand_for'] = 1;

					 // $UsrCatData['brand_for'] = $this->request->data['register']['business_type'];

					if(!empty($this->request->data['enquiry']['requirement_type'])){


					if($this->request->data['enquiry']['requirement_type']==2){

						if(!empty($this->request->data['register']['Category_id']))
					$UsrCatData['category_id'] = $this->request->data['register']['Category_id'];	


					}

					else{

					 	$UsrCatData['category_id']=0;
					 	$UsrCatData['sub_category_id']=0;
					 	$UsrCatData['brand_for']=1;
					 	
				 }


				}


					if(!empty($this->request->data['register']['business_type'])){
					if($this->request->data['register']['business_type']==2)
					{
						if(!empty($this->request->data['register']['Category_id']))
					$UsrCatData['category_id'] = $this->request->data['register']['Category_id'];	
					if(!empty($this->request->data['register']['SubCategory']))
					$UsrCatData['sub_category_id'] = $this->request->data['register']['SubCategory'];				
					}else
					{
						if(!empty($this->request->data['register']['offer_Category_id']))
					$UsrCatData['category_id'] = $this->request->data['register']['offer_Category_id'];
					
					if(!empty($this->request->data['register']['SubCategory']))
					$UsrCatData['sub_category_id'] = $this->request->data['register']['SubCategory'];
					else
					$UsrCatData['sub_category_id'] = 0;

					}			
				}
				
					// $UsrCatData['city_id'] = $this->request->data['register']['City_id'];

					// $UsrCatData['area_id'] = $this->request->data['register']['Area_id'];

					// city area getting id values
					if(!empty($this->request->data['login_latitude']))
					$UsrCatData['latitude'] = $this->request->data['login_latitude'];

					if(!empty($this->request->data['login_longitude']))
					$UsrCatData['longitude'] = $this->request->data['login_longitude'];

					if(!empty($this->request->data['login_address']))
					$UsrCatData['address'] = $this->request->data['login_address'];
				



					$UsrCatData['country_id'] = 1;

					if(!empty($this->request->data['register']['business_type'])){

						// $UsrCatData['brand_for'] = $this->request->data['register']['business_type'];

					}


					$UsrCatData['user_id']= $MyUser_id;

					//Get Sender id from last insert of user

					// echo $MyUser_id	;echo "<br/>";

					// echo "<pre>";print_r($UsrCatData);echo "<br/>";die;
					$this->UserCategory->save($UsrCatData);// saving in user_categories table.


					$this->BusinessListingCategory->save($UsrCatData);




				$usrEmail =$UsrData['business_email'];

				$company_name = $UsrData['company_name'];

				$first_name = $UsrData['first_name'];

				$last_name = $UsrData['last_name'];


				$name  = $UsrData['first_name'] . ' ' . $UsrData['last_name'];


				$company_name = $UsrData['company_name'];

				$activation_code = $UsrData['activation_code'];

				$mobile_validate_main = substr($mobile_number, -10);
        		$arraytomobile_main = array("9", "8", "7");
        		$to_check_mobile_main = substr($mobile_validate_main, 0, 1);

		if(!empty($mobile_number) && in_array($to_check_mobile_main, $arraytomobile_main)){

					// 			if($mobile_number  == '9447809314'){

					// 	echo "code is here";die;
					// }
		

			$message= "Please use this Code: $Unique_Code to complete your Account Activation process. Thank you.";


			$to = $mobile_number;
			$message=urlencode($message);
		
			
			// $to = $book_no;
			// $message=urlencode($message);
		
			$this->to=$to;
			$to=substr($to,-10) ;
			$arrayto=array("9", "8" ,"7","6");
			$to_check=substr($to,0,1);
	
			 if(in_array($to_check, $arrayto))
	 			
	 			$this->to=$to;

	 		else echo "invalid number";

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
	

	 			 $objs = json_decode($output);

	 			 // echo "<pre>";print_r($objs);die;
			}

				// $email = new CakeEmail();

				// $Email_Template = "client_activation";

				// $subject = "Activate Your Buyer Account XRV$MyUser_id Now.";

				//  $email->viewVars(array('Original_Subject'=>@$Original_Subject,'country_name'=>@$country_name,'city_name'=>@$city_name,'sub_category_name'=>@$sub_category_name,'category_name'=>@$category_name,'first_name' => $first_name,'company_name' => $company_name,'last_name' => $last_name,'activation_code' =>$activation_code ,'original'=>@$original,'enquiry_id' => $Unique_Id,'created_date'=>@$created_date, "FrmReg" => $FrmReg));

				// $email->config('smtp')

				// ->template($Email_Template)

				// ->emailFormat('html') 

				// ->from(array('info@xerve.in' => 'Xerve.in'))

				// ->to("$usrEmail")
				
				// //->to("smani8388@gmail.com")
				
			 //    ->bcc(array('info@xerve.in'))
																	
				// ->replyTo(array('support@xerve.in'))

				// ->subject($subject)

				// ->send();

		}


}

			$result['result'] = $MyUser_id;

			$result['mobile'] = $UsrData['mobile_number'];

			$result['user_name'] = $name;

			echo json_encode($result);
	}

	}
}
	public function loginajax() {

	    // Configure::write('debug', 2); 
        $this->layout=false;
		$this->autoRender = false;	
		if(empty($MyUser_id))
		$User_Id = $this->Auth->user('id');
        else
        $User_Id = $MyUser_id;
	
		$refer = Controller::referer();
        
		
		if(!empty($this->request->data['User']['business_email']))
		$user_name = $this->request->data['User']['business_email'];

		$password  = $this->request->data['User']['password'];

		$this->loadModel('User');

		$user_nopass = $this->User->find('first',array(

							'conditions' => array('User.mobile_number'=>$user_name,'User.password IS NULL'),

							'fields'     => array('User.id','User.mobile_number')
 
						));

		$Pass_User = $user_nopass['User']['id'];

		$Pass_Mobile = $user_nopass['User']['mobile_number'];
		// if($user_name == '9447809314'){

		// 	echo "<pre>";print_r($user_nopass);die;

		// }
		
		/*if($_SERVER['REMOTE_ADDR']=='122.166.203.173')
		 {
		 echo "outside".$user_name;
		 }*/

		 $exception_list = array('content@xerve.in','arun@winclients.in','arunarav@gmail.com');



		if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $user_name)) { 
		  
		  $email_valid = 1;


		}
		else{

			$email_valid=0;
		}



		if(strlen($user_name) ==10 && $email_valid==0) { 


				$mobile_valid = 1;

			}

			else{

				$mobile_valid = 0;

			}

		$result = "";	
		
		if(($email_valid==0 && $mobile_valid==1) || (in_array($user_name, $exception_list))){


			if(!empty($user_nopass)){

				$Md5_password = AuthComponent::password($password);
				$this->User->updateAll(array('User.password'=>"'$Md5_password'"),array('User.id'=>$Pass_User,'User.mobile_number'=>$Pass_Mobile));

				$user_value = $this->User->findById($Pass_User);
				$user = $user_value['User'];
				$this->Auth->login($user);

				$result['result'] = $Pass_User;
				$result['mobile'] = $Pass_Mobile;


			}

		else{
			
		 if ($this->Auth->login()) {
		 

         /*if($_SERVER['REMOTE_ADDR']=='122.166.203.173')
		 {
		 echo "inside login";
		 }*/

		 //echo "Login ".$this->request->data['User']['business_email'];exit();
		
		$this->loadModel("LoginDetail");

		$this->loadModel('UserActivity');

		$this->loadModel('Refferal');

		$this->loadModel('CashbackReport');
		 
		date_default_timezone_set('Asia/Calcutta');
			
		$DateAdded = date( 'Y-m-d H:i:s' );
		
		$Login['created'] = $DateAdded;			
			
		$Login['user_name'] =  $this->request->data['User']['business_email'];
		
		$Login['login_from'] = "Direct";

		$Login['id'] = $this->Auth->user('id');

		$Login['ip'] = $_SERVER['REMOTE_ADDR'];
		

		$Login_Activity['created'] = $DateAdded;

		$Login_Activity['user_name'] = $this->request->data['User']['business_email'];

		$Login_Activity['login_from'] = "Direct";

		$Login_Activity['activity'] = 'Login';

		$Login_Activity['user_id'] = $this->Auth->user('id');

		$Login_Activity['ip'] = $_SERVER['REMOTE_ADDR'];

		$this->UserActivity->save($Login_Activity);
		 
		$this->LoginDetail->save($Login); 
		
		$lst = explode("/", $refer);	

		$user_id_reff = $this->Auth->user('id');


		 $refferal_name = $this->Cookie->read('referral_name');

         $refferal_id =   $this->Cookie->read('referral_id');

         if(!empty($refferal_id) && $refferal_id != 'undefined'){

         $refferal_details = $this->Refferal->find('first',array(

         						'conditions' => array('Refferal.user_id'=>$user_id_reff),


         					 ));

         $order_count_main = $this->CashbackReport->find('count',array(

         						'conditions' => array('CashbackReport.user_id'=>$user_id_reff,

         						'OR'        => array('CashbackReport.status = 1','CashbackReport.status = 2') 

         						)));



         if(empty($refferal_details) && $user_id_reff != $refferal_id && empty($order_count_main)){

         				date_default_timezone_set('Asia/Calcutta');

                        $DateAdded = date( 'Y-m-d H:i:s' );

                        $reff['refferal_id'] = $refferal_id;

                        $reff['refferal_name'] = $refferal_name;

                        $reff['user_id'] = $user_id_reff;

                        $reff['created'] = $DateAdded;

                        $this->Refferal->save($reff);

                        $this->Cookie->delete('referral_name');

                        $this->Cookie->delete('referral_id');

         	}

         	else{

         		// echo "the code is here";die;

         		$reff_sender = $refferal_details['Refferal']['refferal_id'];

         		$order_count = $this->CashbackReport->find('first',array(

                          'conditions' => array('CashbackReport.order_status'=>$user_id_reff,'CashbackReport.user_id'=> $reff_sender,

                           'OR'        => array('CashbackReport.status = 1','CashbackReport.status = 2') 
                          )));

         		// echo "<pre>";print_r($order_count);die;

         		if(empty($order_count) && $user_id_reff != $refferal_id && empty($order_count_main)){

         			// echo "the code is here";die;

         			$this->Refferal->updateAll(array('Refferal.refferal_id'=>$refferal_id,'Refferal.refferal_name'=>"'$refferal_name'",'Refferal.updated'=>'"' . date('Y-m-d H:i:s') . '"'),array('Refferal.user_id'=>$user_id_reff));
         		}

         		

         	}
         }

				
		//print_r($lst);
		
		// $External = $this->request->data['ProductURL'];
		
		// $ExternalList = explode("XRVA", $External);
		

		$External = $this->request->data['ProductURL'];

		$ExternalSeller = $this->request->data['ProductSeller'];

		$ExternalSeller = trim($ExternalSeller);
		
		 // echo "ExternalList: ".$ExternalList; exit();
		 	
		// print_r($ExternalList);die;


		

		$User_Id = $this->Auth->user('id');

		$this->loadModel('User');


		$mobile = $this->User->query("select mobile_number,first_name,last_name,status from users where id = $User_Id");

		// echo "<pre>";print_r($mobile);die;

		$mobile_number = $mobile[0]['users']['mobile_number'];

		$first_name    = $mobile[0]['users']['first_name'];

		$last_name      = $mobile[0]['users']['last_name'];

		$status         = $mobile[0]['users']['status'];

		$name = $first_name . ' ' . $last_name;


		$FullName = $this->Auth->user('first_name')." ".$this->Auth->user('last_name');
		
		if(!empty($External))
		{


			if($ExternalSeller=='Flipkart.com')
			{		

				$ExternalURL = $External.'&affExtParam1='.$User_Id.'&affExtParam2='.$name;

			}
			// &aff_sub='.$User_Id.'&aff_sub2='.$FullName;

			else if($ExternalSeller=='Snapdeal.com'){

				$ExternalURL = $External.'&aff_sub='.$User_Id.'&aff_sub2='.$name;
			}
			else if($ExternalList[1]=='OMG')
			{

				$ExternalURL = $External.'&UID='.$User_Id.'&UID2='.$name;
			// return $this->redirect($ExternalURL);
			}

			else if($ExternalSeller == 'Shopclues.com'){

				$ExternalURL = $External.'&s2='.$User_Id.'&s3='.$name;

			}


			else if($ExternalSeller=='Amazon.in'){

				$ExternalURL = $External.'&ascsubtag='.$User_Id;

			}

			else if($ExternalSeller  == 'Paytmmall.com'){

				$ExternalURL = "https://ad.admitad.com/g/skgi6a1tctbe231f08d76339fea834/?ulp=".urlencode($External)."&subid=".$User_Id;

			}
			else{

				$ExternalURL = $External.'&UID='.$User_Id.'&UID2='.$name;
			}


		}

		

		
			$result['result'] = $User_Id;
			$result['mobile'] = $mobile_number;
			$result['user_name'] = $name;
			$result['status_value'] = $status;
			$result['shop_url'] = $ExternalURL;
			$result['refer']  = $refer;
		}

	

		else{
		
		
		/*if($_SERVER['REMOTE_ADDR']=='122.166.203.173')
		 {
		 echo "inside login else";
		 }*/

		 $this->loadModel("User");

				 if($email_valid==1){
			 
		 		$User_Details = $this->User->find('first',array(
						'conditions' => array("User.business_email" => $user_name),
						  
						'fields' => array('User.id','User.first_name','User.last_name','User.business_email','User.company_name','User.activation_code','User.status','User.activated','User.verify_code'),
						
						'order' => array('created asc'),
						
		 			));

		 	}
		 	else if($email_valid==0 && $mobile_valid==1){

		 			$User_Details = $this->User->find('first',array(
						'conditions' => array("User.mobile_number" => $user_name),
						  
						'fields' => array('User.id','User.first_name','User.last_name','User.business_email','User.company_name','User.activation_code','User.status','User.activated','User.verify_code'),
						
						'order' => array('created asc'),
						
		 			));

		 	}


		 		$firstname_value = $User_Details['User']['first_name'];

		 		$lastname_value  = $User_Details['User']['last_name'];

		 		if(!empty($User_Details)){

		 			$result['content_user'] = 'yes';

		 			$activated = $User_Details['User']['activated'];

		 			if($activated==1){

		 			$result['password_correct']	 = 'No';

					}

					else{

						// echo $mobile_valid;

						$result['code_mobile'] = 'No';

						$result['code_email'] = 'No';

						$result['user_id_activate'] = $User_Details['User']['id'];

						$result['password_correct']	 = 'Yes';

						$user_id_value = $User_Details['User']['id'];



						$code  = $User_Details['User']['verify_code'];

						if(empty($code)){

							$code = substr(str_shuffle(uniqid()), 1, 6);

							$this->User->query("update users set verify_code ='$code' where id= $user_id_value");


						}

						if($mobile_valid==1){




							$result['code_mobile'] = 'Yes';

							$message= "Please use this Code: $code to complete your Account Activation process. Thank you.";


							$to = $user_name;
							$message=urlencode($message);
						
							
							// $to = $book_no;
							// $message=urlencode($message);
						
							$this->to=$to;
							$to=substr($to,-10) ;
							$arrayto=array("9", "8" ,"7","6");
							$to_check=substr($to,0,1);
					
							 if(in_array($to_check, $arrayto))
					 			
					 			$this->to=$to;

					 		else echo "invalid number";

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
					

					 			 $objs = json_decode($output);
						}

						else if($email_valid==1){

							$result['code_email'] = 'Yes';

								// 	$email = new CakeEmail();

								// $usrEmail =$user_name;

								// //$user_identify=$User_Details[0]['users']['id'];

								// $email->viewVars(array('User_Details' => $User_Details,'newpwd'=>$newpwd,'User_Id'=>$result['user_id_activate'],'Unique_Id'=>$code,'email_value'=>$user_name,'first_name'=>$firstname_value,'last_name'=>$lastname_value));
								
								//    //echo $user_identify;

								//     $email->config('smtp')

								// 	->template('client_activation')

								// 	->emailFormat('html')

								// 	->from(array('info@xerve.in' => 'Xerve.in'))

								// 	->to("$usrEmail")
									
								// 	//->to("smani8388@gmail.com")
									
								//     ->bcc(array('info@xerve.in'))	
																	
				    //                 ->replyTo(array('support@xerve.in'))
                                     
								// 	->subject("Activate Your Buyer Account XRV$user_id_value Now.")

								// 	->send();
						}




					}


		 		}
		 		else{

		 			$result['content_user'] = 'no';
		 		}
				    $result['result'] = 'No';
		}
	}

	}else{

		 $result['result'] = 'No';
		}


		 /*if($_SERVER['REMOTE_ADDR']=='122.166.203.173')
		 {
		 echo "the login is done<pre>";print_r($result);echo "</pre>";
		 }*/
		
		// echo "the login is done";

		echo json_encode($result);
        //exit();

	}


	public function join($id="",$store="",$channel=""){

		// Configure::write("debug",2);

		// echo "the code is here";die;
			
		$this->layout = "Joinlayout";


		if (stripos($id, 'buy-') === false){

		if(!empty($id)){

			$this->set('new_page','yes');

			// added by manoj.
			if ($id == 'ch-14') $id = 1;

			$this->set('page_id',$id);
			// echo $id;die;
		}else{
			// $this->set('page_id',1);
			$this->set('new_page','no');
		}

		

		 $cloudfront_imgall = "https://d372i0x0rvq68a.cloudfront.net";

		 $this->set('cloudfront_imgall',$cloudfront_imgall);

		$pro_store_id = $this->request->query['store_id']; 
		$pro_url = $this->request->query['url']; 
		$pro_url_source = $this->request->query['url_source']; 
		$pro_source_seller = $this->request->query['source_seller']; 
		$pro_xerve_cashback = $this->request->query['xerve_cashback']; 
		$pro_image_name = $this->request->query['image_name']; 

		//for the channel data

		$uri_channel = $_SERVER['REQUEST_URI'];

    if(stripos($uri_channel, 'ch-')){

        $channel_value_array = explode('ch-', $uri_channel);
        $channel_with_sub    = explode('-', $channel_value_array[1]);
        $channel = $channel_with_sub[0];
        $channel_sub = $channel_with_sub[1];
        // if($this->Auth->user('id') == 54204){
        // 	echo "<pre>";print_r($channel_with_sub);die;
        // }
        $this->Cookie->write('WINChannel', $channel, false, 86400);
        $this->Cookie->write('WINChannel_type', $uri_channel, false, 86400);
        $this->Cookie->write('WINChannel_type_sub', $channel_sub, false, 86400);
      }


		if (!empty($pro_store_id)) {
			$this->set("pro_store_id",$pro_store_id);
			$this->set("pro_url",$pro_url);
			$this->set("pro_url_source",$pro_url_source);
			$this->set("pro_source_seller",$pro_source_seller);
			$this->set("pro_xerve_cashback",$pro_xerve_cashback);
			$this->set("pro_image_name",$pro_image_name);
		}

		if(empty($MyUser_id))
		$User_Id = $this->Auth->user('id');
        else
        $User_Id = $MyUser_id;
				
		// $refer = Controller::referer();
        
		// $lead_refer=$refer;

	
		// echo "the code is coming here";die;

    	$this->set("title_for_layout","Xerve.in - Join");

    }else{

    	$uri_channel = $_SERVER['REQUEST_URI'];

    	// echo $uri_channel;die;

    	if(stripos($uri_channel, 'ch-')){

        $channel_value_array = explode('ch-', $uri_channel);
        $channel_with_sub    = explode('-', $channel_value_array[1]);
        $channel = $channel_with_sub[0];
        $channel_sub = $channel_with_sub[1];
        $channel_area = $channel_with_sub[2];
        
        $this->set('channel',$channel);
        $this->set('channel_sub',$channel_sub);
        $this->set('channel_area',$channel_area);
        $this->set('uri_channel',$uri_channel);
        $this->Cookie->write('WINChannel', $channel, false, 86400);
        $this->Cookie->write('WINChannel_type', $uri_channel, false, 86400);
        $this->Cookie->write('WINChannel_type_sub', $channel_sub, false, 86400);
      }


    	 $For = "XRVOS_";
		 $store_red_first = $store;
		 $Ref_Main = explode('-', $store);

        $For_LAST = array();
        foreach ($Ref_Main as $key => $value) {
            if ($key == 0) {
                $For .=$value . "_";
            } else {
                $For_LAST[] = $value;
            }
        }
		if (!empty($For_LAST)) {
            $For_LAST1 = implode('-', $For_LAST);
        }
		$For .=$For_LAST1;

		$query_filter_main = Cache::read('Shop_Details_query_filter_Main_join' . $For, 'similar');
		if (empty($query_filter_main) && strlen($For) > 7) {
			$params = '&omitHeader=true&facet=false&fl=id,product1,product_title,store_id,user_id,seller,category_name_small,sub_category_name_small,type_small,gender_small,company_name_small&fq=store_id_exact:"' . $For . '"';
			$query = "q=*";
			$query_filter_main = $this->SolrServer->fireQueryToSolr("shop", $query, $params);
			Cache::write('Shop_Details_query_filter_Main_join' . $For, $query_filter_main, 'similar');
	    }

	    $product_info = $query_filter_main['response']['docs'][0];

	    // echo "<pre>";print_r($product_info);die;
	    $product_url = $id.'/'.$store;

	    $this->set('product_info',$product_info);

	    $this->set('product_url',$product_url);




    }

		// echo "the code is here";die;
	}

	public function login($MyUser_id) {

		$this->layout = "login";
		$this->set("title_for_layout","Xerve.in - Login");

		 $cloudfront_imgall = "https://d372i0x0rvq68a.cloudfront.net";

		 $this->set('cloudfront_imgall',$cloudfront_imgall);

		$pro_store_id = $this->request->query['storeid']; 
		$pro_url = $this->request->query['url']; 
		$pro_url_source = $this->request->query['url_source']; 
		$pro_source_seller = $this->request->query['source_seller']; 
		$pro_xerve_cashback = $this->request->query['xerve_cashback']; 
		$pro_image_name = $this->request->query['image_name']; 

		if (!empty($pro_source_seller)) {
			$this->set("pro_store_id",$pro_store_id);
			$this->set("pro_url",$pro_url);
			$this->set("pro_url_source",$pro_url_source);
			$this->set("pro_source_seller",$pro_source_seller);
			$this->set("pro_xerve_cashback",$pro_xerve_cashback);
			$this->set("pro_image_name",$pro_image_name);

			$Company_Meta_Search = strtolower(explode('.', $pro_source_seller)[0]);

			// if($_SERVER['REMOTE_ADDR']=='122.179.36.200'){

			// 	echo $Company_Meta_Search;die;
			// }

			$query = "q=*&omitHeader=true&start=0&rows=2000&facet=false";

			$Partial_meta = 'company_name_small';

             $params = '&fl=url_type,seller_name,company_name_small&indent=true&facet.mincount=1&fq=ad_type:[1%20TO%202]&fq=!cashback_value:0&fq=coupon_value:0&fq=company_name_small:"'.urlencode(strtolower($Company_Meta_Search)).'"';

        	  $params .="&group=true&group.field=coupon_id&group.main=true&facet.field=category_name_exact";

        	$Valid_Cashback_C = date('Y-m-d');                            
        
        	$valid_for_cashback_C = '&fq=coupon_end_exact:[' . $Valid_Cashback_C . '+TO+*]';  

        	$query_details =  $this->SolrServer->fireQueryToSolr("coupon_xerve",$query,$params.$Fields_All.$valid_for_cashback_C);  

        	$seller_details = $query_details['response']['docs'][0];

        	$this->set('seller_details',$seller_details);

        	// echo "<pre>";print_r($seller_details);die;
		}

		if(empty($MyUser_id))
		$User_Id = $this->Auth->user('id');
        else
        $User_Id = $MyUser_id;
				
		$refer = Controller::referer();
        
		$lead_refer=$refer;


		// if($User_Id==54204){

	 //    	Configure::write('debug', 2); 

		// }
	
		//echo "Business Email: ".$this->request->data['User']['business_email']; exit();
		//exit();
		
		if(!empty($this->request->data['User']['business_email']))
		$user_name = $this->request->data['User']['business_email'];
	
			
		 if ($this->Auth->login()) {
		 
		  //echo "Login ".$this->request->data['User']['business_email'];exit();
		
		$this->loadModel("LoginDetail");

		$this->loadModel('UserActivity');
		 
		date_default_timezone_set('Asia/Calcutta');
			
		$DateAdded = date( 'Y-m-d H:i:s' );
		
		$Login['created'] = $DateAdded;			
			
		$Login['user_name'] =  $this->request->data['User']['business_email'];
		
		$Login['login_from'] = "Direct";

		$Login['id'] = $this->Auth->user('id');

		$Login['ip'] = $_SERVER['REMOTE_ADDR'];


		//for the user activity table

		$Login_Activity['created'] = $DateAdded;

		$Login_Activity['user_name'] = $this->request->data['User']['business_email'];

		$Login_Activity['login_from'] = "Direct";

		$Login_Activity['activity'] = 'Login';

		$Login_Activity['user_id'] = $this->Auth->user('id');

		$Login_Activity['ip'] = $_SERVER['REMOTE_ADDR'];

		$this->UserActivity->save($Login_Activity);
		 
		$this->LoginDetail->save($Login); 
		
		$lst = explode("/", $refer);		
				
		//print_r($lst);
		
		$External = $this->request->data['ProductURL'];
		
		$ExternalList = explode("XRVA", $External);
		
		 //echo "External: ".$External; exit();
		 
		$User_Id = $this->Auth->user('id');
		$FullName = $this->Auth->user('first_name')." ".$this->Auth->user('last_name');
		
		if(!empty($External))
		{
			if($ExternalList[1]=='Flipkart.com')
			{		
			$ExternalURL = $ExternalList[0].'&affExtParam1='.$User_Id.'&affExtParam2='.$FullName;
			$this->redirect($ExternalURL);
			}
			else if($ExternalList[1]=='OMG')
			{
			$ExternalURL = $ExternalList[0].'&UID='.$User_Id.'&UID2='.$FullName;
			$this->redirect($ExternalURL);
			}
		}
		
		/*ADDED BY NITHIN ON 10 03 16*/
		//if(($lead_refer == 'http://www.xerve.in/leads') AND($lead_refer != 'http://www.xerve.in/users/login')){
			//$this->redirect('http://www.xerve.in/leads');

		//}
		/*ADDED BY NITHIN ON 10 03 16*/


		if(!isset($this->request->data['FrmJoinLogin'])){
		if($lst[3]=='users' && $lst[4]=='login')
		$this->redirect("/");
		else		
		$this->redirect($refer);
     }
     elseif(isset($this->request->data['FrmJoinLogin'])){

     	$this->redirect("/myaccount");
     }

		} else {

		  
		 if(!empty($this->request->data['User']['business_email']))
		 {
		 
		 $this->loadModel("User");
			 
		 $User_Details = $this->User->find('first',
		
				array(
						'conditions' => array("User.business_email" => $user_name),
						  
						'fields' => array('User.id','User.first_name','User.last_name','User.business_email','User.company_name','User.activation_code','User.status','User.activated','Enquiry.enquiry_id'),
						
						'order' => array('created desc'),
						
		 				'joins'         =>  array(

		 						array(

		 								'table'         =>  'enquiries',

		 								'alias'         =>  'Enquiry',

		 								'type'          =>  'left',

		 								'foreignKey'    =>  false,

		 								'conditions'    =>  array( 'User.id = Enquiry.user_id' )

		 						)		
				)));

	    //echo "afterere<pre>";print_r($User_Details);echo "</pre>";exit();
		
		if(!empty($User_Details)) {
		
		if(empty($User_Details['User']['activated']))
		{	
		
               $this->loadModel("Enquiry");	
			   
			   $MyUser_id = $User_Details['User']['id'];
			   
			   if(!empty($User_Details['User']['status']))
				{		
 		
			        $Unique_Id = $User_Details['Enquiry']['enquiry_id'];
			
			        $activated = $this->Enquiry->query("SELECT category_name, sub_category_name, city_name,original_subject,date_format(created_date,'%e %M %Y - %l:%i %p') AS created_date,created_date

					FROM enquiries, sub_categories, categories, cities

					WHERE  enquiries.category_id = categories.id

					AND enquiries.sub_category_id = sub_categories.id

					AND enquiries.city_id = cities.id

					AND enquiry_id='$Unique_Id'");
					
				
				    //echo "<pre>";print_r($activated);echo "</pre>";exit();
				
					$city_name =$activated[0]['cities']['city_name'];
					
					$created_date=$activated[0][0]['created_date'];

					$original = $activated[0]['enquiries']['original_subject'];

					$sub_category_name =$activated[0]['sub_categories']['sub_category_name'];

					$category_name =$activated[0]['categories']['category_name'];
				
				}
				
					$country_name ="India";
					
					$email = new CakeEmail();
					
					$usrEmail = $User_Details['User']['business_email'];

					$first_name = $User_Details['User']['first_name'];

					$last_name = $User_Details['User']['last_name'];

					$company_name = $User_Details['User']['company_name'];

					$activation_code = $User_Details['User']['activation_code'];
					
					$Email_Template = "client_activation";

					$subject = "Activate Your Client Account XRV$MyUser_id Now >";

					if(@$User_Details['User']['status']==0){

					$Email_Template = "vendor_activation";

					$subject = "Activate Your Account XRV$MyUser_id Now >";

					$Original_Subject ="";

					$country_name ="India";

					$city_name ="";				

					$sub_category_name ="";

					$category_name ="";

				 }
				 
				 
				//  $email->viewVars(array('Original_Subject'=>@$Original_Subject,'country_name'=>@$country_name,'city_name'=>@$city_name,'sub_category_name'=>@$sub_category_name,'category_name'=>@$category_name,'first_name' => $first_name,'company_name' => $company_name,'last_name' => $last_name,'activation_code' =>$activation_code ,'original'=>@$original,'enquiry_id' => $Unique_Id,'created_date'=>@$created_date,'Message'=>'Thank you for successfully register with xerve. Hope you get will get business.Your Activation Link <a href="http://www.xerve.in/users/activate/">Activate</a>

				// 		'));

				// $email->config('smtp')

				// ->template($Email_Template)

				// ->emailFormat('html') 

				// ->from(array('info@xerve.in' => 'Xerve.in'))

				// ->to("$usrEmail")
				
				// //->to("smani8388@gmail.com")
				
				// ->bcc(array('info@xerve.in'))
																	
				// ->replyTo(array('support@xerve.in'))

				// ->subject($subject)

				// ->send();
				 
		 $this->set("FrmActivate",$user_name);
		 // $this->render('/Users/activation_pending');
		  $this->Session->setFlash(__("&nbsp;&nbsp;&nbsp;&nbsp;* Activate Your Account"));
		 
		}
		else
		{
		$this->Session->setFlash(__("&nbsp;&nbsp;&nbsp;&nbsp;* Given Password is Wrong. Please Try Again or Use Forgot Password Option."));
		}
		
		}
		else
		{
		 $this->Session->setFlash(__("&nbsp;&nbsp;&nbsp;&nbsp;* Invalid Login Details. Please Try Again."));
		}
		
		 }

		//$this->redirect($_SERVER['HTTP_REFERER']);

		}
		
		

	}

		public function createnewpassword() {

	$this->layout = "login";

	// Configure::write("debug",2);

	

	if($this->request->is("post")){



	$newpassword = $_POST['newpassword'];

	$confirmpassword = $_POST['confirmpassword'];

	$email = $_POST['business_email'];

	$business_email = "'".$_POST['business_email']."'";

	$verificationcode = "'".str_replace("PWD","",$_POST['verificationcode'])."'";

	$email_valid = 0;

	$mobile_valid = 0;

	$verificationcode = trim($verificationcode);


if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) { 
  
  $email_valid = 1;


}
else{

	$email_valid=0;
}

if(strlen($email) ==10 && $email_valid==0) { 


		$mobile_valid = 1;

	}

	else{

		$mobile_valid = 0;

	}


	

	if(!empty($verificationcode) && !empty($business_email)  && !empty($newpassword) && !empty($confirmpassword)  ){

	

	if($newpassword==$confirmpassword){

	

	$oldpwdMd5 = AuthComponent::password($newpassword);

	

	$this->loadModel("User");

	$User_Id = $this->Auth->user('id');

	

	//echo "select id from users where   business_email=$business_email and pwd_verification=$verificationcode";

	if($email_valid==1 && $mobile_valid==0){

	$User_Details = $this->User->query("select id,first_name,last_name,business_email from users where  business_email=$business_email and pwd_verification=$verificationcode");
}

else if($email_valid==0 && $mobile_valid==1)

{


	$User_Details = $this->User->query("select id,first_name,last_name,business_email from users where  mobile_number=$email and pwd_verification=$verificationcode");

}
	// echo "afterere<pre>";print_r($User_Details);echo "</pre>";die;
	
	$idss=$User_Details[0]['users']['id'];

	$new_email=$_POST['business_email'];

	

	if(!empty($User_Details))

	{

		$Newpassword = AuthComponent::password($newpassword);

		if($email_valid==1 && $mobile_valid==0){

		$UserDetails = $this->User->query("update users set password='$Newpassword' where   business_email=$business_email and pwd_verification=$verificationcode");



		// $email = new CakeEmail();
 
		// 						$usrEmail =$new_email;

		// 						$email->viewVars(array('User_Details' => $User_Details,'newpassword'=>$newpassword,'User_Id'=>$User_Id));

		// 						$email->config('smtp')

		// 							->template('new_password')

		// 							->emailFormat('html')

		// 							->from(array('info@xerve.in' => 'Xerve.in'))

		// 						    ->to("$usrEmail")
									
		// 							//->to("smani8388@gmail.com")
									
		// 						    ->bcc(array('info@xerve.in'))
																	
		// 		                    ->replyTo(array('support@xerve.in'))

		// 							->subject("Password Changed for Account XRV$idss.")

		// 							->send();

			                         // $this->redirect('/users/login');
	}

	else if($email_valid==0 && $mobile_valid==1){

		$UserDetails = $this->User->query("update users set password='$Newpassword' where   mobile_number=$email and pwd_verification=$verificationcode");


	}


		$_SESSION['Success'] = "You have successfully changed your password.";

		

		                            //echo "pwd updated<pre>";print_r($UserDetails);echo "</pre>";

	}else{

	$_SESSION['Logininvalid'] = "Invalid Login Email or Verification Code.";

	}

	}else{

	   // $this->Session->setFlash("Password Mismatch.");

		$_SESSION['pwdwrong'] = "Password Mismatch.";

	}

	

	}else{//if ends

	$_SESSION['allfields'] = "Please fill all the required fields.";

	// echo "<pre>";print_r($this->Session);echo "</pre>";
	

	}

	

	}

	

	}

public function forgotpassword() {

	
		$this->layout = "sucess";

		$this->autoRender=false;

		$this->loadModel('User');

		$User_Id = $this->Auth->user('id');

		if(!empty($User_Id))

		{

			$this->redirect("/myaccount");

		}else{



			$email = $this->request->data['email'];

			$email_id = $this->request->data['email_id'];

			$mobile_no = $this->request->data['mobile_no'];

			if($email_id==1){

			if ($this->request->is("post")) {

				$User_email = $email;

				 //echo $User_email;exit();

				if ($User_email) {

					

					

					// $User_Details = $this->User->query("select id,first_name,last_name,business_email from users where business_email='$User_email' and activated=1");
				

					$User_Details = $this->User->find('first',array(

									'conditions' => array('User.business_email'=>$User_email,'User.activated=1'),

									'fields'     => array('User.id','User.first_name','User.last_name'),

									'order'      => array('User.created asc')

						));



                // echo "<pre>";print_r($User_Details);echo "</pre>";exit();
					
					

					$user_identify=$User_Details['User']['id'];

					//exit(0);

					// $Unique_Id = str_shuffle(uniqid());

					$Unique_Id = substr(str_shuffle(uniqid()), 1, 6);

							

							$newpwd = AuthComponent::password($Unique_Id);

							if(count($User_Details)==1)

							{						

							$User_Found = $this->User->query("update users set pwd_verification='$Unique_Id' where business_email='$User_email' and id=$user_identify and activated=1 ");

								
							// $this->redirect('/users/createnewpassword');

								// $email = new CakeEmail();

								// $usrEmail =$User_email;

								// //$user_identify=$User_Details[0]['users']['id'];

								// $email->viewVars(array('User_Details' => $User_Details,'newpwd'=>$newpwd,'User_Id'=>$user_identify,'Unique_Id'=>$Unique_Id,'email_value'=>$User_email));
								
								//    //echo $user_identify;

								//     $email->config('smtp')

								// 	->template('verification_code')

								// 	->emailFormat('html')

								// 	->from(array('info@xerve.in' => 'Xerve.in'))

								// 	->to("$usrEmail")
									
								// 	//->to("smani8388@gmail.com")
									
								//     ->bcc(array('info@xerve.in'))	
																	
				    //                 ->replyTo(array('support@xerve.in'))
                                     
								// 	->subject("Forgot Password? Create New Password for Account XRV$user_identify.")

								// 	->send();

							 
									echo "Yes";
							}else {

								//echo "<br>Else";

								echo "No";

								$_SESSION['setFrmforgot'] = "yes";

					$this->Session->setFlash(__("Invalid Email Id."));

					$this->redirect($_SERVER['HTTP_REFERER']);

				}

							

							


	

				} else {

					$this->Session->setFlash(__("Invalid Email Id."));

					$this->redirect($_SERVER['HTTP_REFERER']);

				}

			}

		}else{

				// echo "the code is here";die;
				// $User_Details = $this->User->query("select id,first_name,last_name,business_email from users where mobile_number=$email and activated=1");

               	// echo "<pre>";print_r($User_Details);die;


					$User_Details = $this->User->find('first',array(

									'conditions' => array('User.mobile_number'=>$email,'User.activated=1'),

									'fields'     => array('User.id'),

									'order'      => array('User.created asc')

						));



                // echo "<pre>";print_r($User_Details);echo "</pre>";exit();


				$user_identify=$User_Details['User']['id'];

				$Unique_Id = substr(str_shuffle(uniqid()), 1, 6);

							

				$newpwd = AuthComponent::password($Unique_Id);

				if(!empty($User_Details))

				{						

					$User_Found = $this->User->query("update users set pwd_verification='$Unique_Id' where mobile_number=$email and id=$user_identify and activated=1 ");
				

				// $this->redirect('/users/createnewpassword');




				$message= "Please use this Code: $Unique_Id to create your New Xerve Password. Thank you. www.xerve.in/users/createnewpassword";


				$to = $email;
				$message=urlencode($message);
				$this->to=$to;
				$to=substr($to,-10) ;
				$arrayto=array("9", "8" ,"7","6");
				$to_check=substr($to,0,1);
		
				 if(in_array($to_check, $arrayto))
		 			
		 			$this->to=$to;

		 		else echo "invalid number";

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
	

	 			 $objs = json_decode($output);

	 			 echo "Yes";

	 			}

	 			else {

	 				echo "No";
	 			}
			}

		}

	}


	

		

	public function dynamic_login() {

		$this->layout = "dynamic_login";

		$User_Id = $this->Auth->user('id');

		$refer = Controller::referer();

		if ($this->request->is("post")) {

		//print_r($this->Auth->login());exit();
			
		$this->loadModel("LoginDetail");

	    //$Login['user_id'] =
		 
		date_default_timezone_set('Asia/Calcutta');
			
		$DateAdded = date( 'Y-m-d H:i:s' );
		
		$Login['created'] = $DateAdded;	
		
		$Login['user_name'] =  $this->request->data['User']['business_email'];

		$Login['ip'] = $_SERVER['REMOTE_ADDR'];
		 
		 $this->LoginDetail->save($Login); 

		if ($this->Auth->login()) {
		
		$this->loadModel("LoginDetail");

	     //$Login['user_id'] =
		 
		 date_default_timezone_set('Asia/Calcutta');
			
		$DateAdded = date( 'Y-m-d H:i:s' );
		
		$Login['created'] = $DateAdded;	
			
			
		$Login['user_name'] =  $this->request->data['User']['business_email'];

		$Login['ip'] = $_SERVER['REMOTE_ADDR'];
		 
		$this->LoginDetail->save($Login); 

		$this->redirect($refer);

			

		} else {

		$this->Session->setFlash(__("&nbsp;&nbsp;&nbsp;&nbsp;Invalid Login Details. Please Try Again."));

		$this->redirect($_SERVER['HTTP_REFERER']);

		

		}

		}			

						

		}

	

	public function logout() {

		// Configure::write("debug",2);

		// echo "the code is here";die;

		$this->loadModel("User");

		$this->loadModel('UserActivity');

		$DateAdded = date( 'Y-m-d H:i:s' );
		

		$Login_Activity['created'] = $DateAdded;

		// $Login_Activity['user_name'] = $this->request->data['User']['business_email'];

		$Login_Activity['login_from'] = "Direct";

		$Login_Activity['activity'] = 'Logout';

		$Login_Activity['user_id'] = $this->Auth->user('id');
		$user_id=$this->Auth->user('id');

		$Login_Activity['ip'] = $_SERVER['REMOTE_ADDR'];

		$this->UserActivity->save($Login_Activity);

		$query ="UPDATE users SET  session = 'offline',session_time='".$DateAdded."' WHERE id = '".$user_id."'";
        $this->User->query($query);
	
		return $this->redirect($this->Auth->logout());

	}

	public function logout_ajax(){

		// Configure::Write("debug",2);

		$this->autoRender = false;	

		$this->loadModel('User');

		$this->loadModel('UserActivity');

		$DateAdded = date('Y-m-d H:i:s');

		$Login_Activity['created'] = $DateAdded;

		$Login_Activity['activity'] = 'Logout';

		$Login_Activity['user_id'] = $this->Auth->user('id');

		$user_id = $this->Auth->user('id');

		$Login_Activity['ip'] = $_SERVER['REMOTE_ADDR'];

		$this->UserActivity->save($Login_Activity);
		
		$query ="UPDATE users SET  session = 'offline',session_time='".$DateAdded."' WHERE id = '".$user_id."'";

        $this->User->query($query);

        $this->Auth->logout();

	}

	
	 public function feedback(){
   
	        $this->autoRender = false;
	
	        $Unique_Id = 'XRV'.substr(str_shuffle(uniqid()), 1, 5);
			
			 //Configure::write('debug', 2);
			
			if(empty($this->request->data['FrmOffer']))
			{
			
			//echo "Inside";exit();
			
			$UsrData['country_id'] = $this->request->data['Country_id'];
			
			$UsrData['visitor_type'] = $this->request->data['register']['BusinessType'];
	
	        $UsrData['company_name'] = $this->request->data['register']['companyname'];	
			
			$UsrData['name_title'] = $this->request->data['register']['NamePrfx'];	
			
			$UsrData['first_name'] = ucwords(strtolower($this->request->data['register']['FirstName']));
			
			$UsrData['last_name'] = ucwords(strtolower($this->request->data['register']['LastName']));				
	
			$UsrData['designation'] = $this->request->data['register']['Designation'];			

			$UsrData['email_id'] = $this->request->data['register']['business_email'];

			$UsrData['mobile_number'] = $this->request->data['register']['MblNo'];	

			$UsrData['feedback'] = $this->request->data['feedback'];
			
						
			$UsrData['website'] = $this->request->data['Website'];		
			
			$user_rated = 0;
			$total_rating = 0;
			
			if(!empty($this->request->data['test-1']))
			{
			$UsrData['response_time'] = $this->request->data['test-1'];
			$total_rating = $total_rating + $this->request->data['test-1'];
			$user_rated=$user_rated+1;
			}
			
			if(!empty($this->request->data['test-2']))
			{
			$UsrData['experience'] = $this->request->data['test-2'];
			$total_rating = $total_rating + $this->request->data['test-2'];
			$user_rated=$user_rated+1;
			}
			
			if(!empty($this->request->data['test-3']))
			{
			$UsrData['professionalism'] = $this->request->data['test-3'];
			$total_rating = $total_rating + $this->request->data['test-3'];
			$user_rated=$user_rated+1;
			}
			
			if(!empty($this->request->data['test-4']))
			{
			$UsrData['proposal'] = $this->request->data['test-4'];
			$total_rating = $total_rating + $this->request->data['test-4'];
			$user_rated=$user_rated+1;
			}
			
			if(!empty($this->request->data['test-5']))
			{
			$UsrData['pre_sales'] = $this->request->data['test-5'];
			$total_rating = $total_rating + $this->request->data['test-5'];
			$user_rated=$user_rated+1;
			}
			
			if(!empty($this->request->data['test-6']))
			{
			$UsrData['teamwork'] = $this->request->data['test-6'];
			$total_rating = $total_rating + $this->request->data['test-6'];
			$user_rated=$user_rated+1;
			}
			
			if(!empty($this->request->data['test-7']))
			{
			$UsrData['solutions'] = $this->request->data['test-7'];
			$total_rating = $total_rating + $this->request->data['test-7'];
			$user_rated=$user_rated+1;
			}
			
			if(!empty($this->request->data['test-8']))
			{
			$UsrData['delivery'] = $this->request->data['test-8'];
			$total_rating = $total_rating + $this->request->data['test-8'];
			$user_rated=$user_rated+1;
			}
			
			if(!empty($this->request->data['test-9']))
			{
			$UsrData['post_sales'] = $this->request->data['test-9'];
			$total_rating = $total_rating + $this->request->data['test-9'];
			$user_rated=$user_rated+1;
			}
			
			if(!empty($this->request->data['test-10']))
			{
			$UsrData['value_for_money'] = $this->request->data['test-10'];
			$total_rating = $total_rating + $this->request->data['test-10'];
			$user_rated=$user_rated+1;
			}
			
			//echo "Rated : ".$user_rated." Total : ".$total_rating; exit();
			
			$UsrData['total_rated'] = $user_rated;
			
			$UsrData['total_points'] = $total_rating;
			
			$UsrData['vendor_ID'] = $this->request->data['vendor_ID'];

			$UsrData['article_id']= $this->request->data['Article'];
		
			$Vendor_ID = $this->request->data['vendor_ID']; 
			
			$rating = (float) $total_rating / (float) $user_rated;
			
			$UsrData['rating'] = (float) $rating;
			
			}
			
			$UsrData['feedback'] = $this->request->data['feedback'];
			
			if(!empty($this->request->data['offer_id']))
			{
			$UsrData['offer_id'] = $this->request->data['offer_id'];
			
			$Offer_Id = $this->request->data['offer_id'];
			
			$this->loadModel("OfferListingDetail");	
			
			$Vendor_Details = $this->OfferListingDetail->query("select user_id from offer_listing_details where offer_id='$Offer_Id'");
			
			
			$UsrData['vendor_ID'] = $Vendor_Details[0]['offer_listing_details']['user_id'];
			
			$Vendor_ID = $Vendor_Details[0]['offer_listing_details']['user_id'];
			
			}
			
			
			if(!empty($this->request->data['FrmOffer']))
			{
			$UsrData['rating'] = $this->request->data['test-1'];
			}
			
			
			$UsrData['enquiry_id'] = $Unique_Id;
			
			$MyUser_id = $this->Auth->user('id'); 
			
			$UsrData['user_id'] = $MyUser_id;	
			
			$UsrData['activation_code'] = md5($Unique_Id);
			
			$UsrData['ip'] = $_SERVER['REMOTE_ADDR'];
	
			date_default_timezone_set('Asia/Calcutta');
			
		    $DateAdded = date( 'Y-m-d H:i:s' );
		
			$UsrData['created'] = $DateAdded;			
			
			$created =date('d F Y - g:i A', strtotime($DateAdded));
			
			//echo $created;
			//exit();
			
			$this->loadModel('RateReview');		
			
			$this->RateReview->save($UsrData); 
			
		    //echo "<pre>";print_r($UsrData);echo "</pre>";exit(); 
			
		    if(empty($this->request->data['FrmOffer']))
			{
			
			$this->loadModel('User');		
			
			$Vendor_Details = $this->User->query("select company_name from users where users.id=$Vendor_ID");
			
			$vendor_Company = $Vendor_Details[0]['users']['company_name'];
			
			//echo "<pre>";print_r($Vendor_Details);echo "</pre>";exit(); 
		
		    $email = new CakeEmail();
			
			$first_name = $this->request->data['register']['FirstName'];
			
			$last_name = $this->request->data['register']['LastName'];	
			
			$usrEmail = $this->request->data['register']['business_email'];	
			
			$feedback = $this->request->data['feedback'];
			
			$activation_code = $UsrData['activation_code'];
			
			// $email->viewVars(array('first_name' => $first_name,'last_name' => $last_name,'feedback' => $feedback,'vendor_Company' => $vendor_Company,"created" => $created, "activation_code" => $activation_code));

			// $email->config('smtp')
 
   //     		->template('feedback_activation')

			// ->emailFormat('html')

			// ->from(array('info@xerve.in' => 'Xerve.in'))

			// //->to("$usrEmail")

			// ->to("$usrEmail")
			
			// //->to("smani8388@gmail.com")
				
			// ->bcc(array('info@xerve.in'))								
				
			// ->replyTo(array('support@xerve.in')) 

			// ->subject("Activate Your Rating and Review of $vendor_Company Now ($Unique_Id)")  

			// ->send();
			
			}
		
		
		    if(!empty($this->request->data['FrmOffer']))
			{
			$_SESSION['FeedBack']="Successful submission.";
			$refer = Controller::referer();
			$this->redirect($refer);
			}else
			{
			$this->redirect("/reviewsubmissionsuccessful");
			}
			
			//echo "<pre>";print_r($UsrData);echo "</pre>";exit();  
			
			                  
	
	}

	public function rate_review(){

		
		$this->autoRender=false;
		//Configure::write("debug",2);
		 $Unique_Id = 'XRVL'.substr(str_shuffle(uniqid()), 1, 5);

		$UserData['feedback'] = $this->request->data['feedback'];

		$UserData['name_title']= $this->request->data['NamePrfx'];

		$UserData['first_name'] = $this->request->data['first_name'];

		$UserData['last_name'] = $this->request->data['last_name'];

		$UserData['email_id'] = $this->request->data['business_email'];

		$UserData['rating']   = $this->request->data['rate'];

		$UserData['vendor_ID']= $this->request->data['id'];

		if(!empty($this->request->data['article_id'])){

			$UserData['article_id'] = $this->request->data['article_id'];
		}

		if(!empty($this->request->data['store_id'])){

			$UserData['store_id'] = $this->request->data['store_id'];
		}

		if(!empty($this->request->data['offer_id'])){

			$UserData['offer_id'] = $this->request->data['offer_id'];
		}


		if(!empty($this->request->data['coupon_id'])){


			$UserData['coupon_id'] = $this->request->data['coupon_id'];
		}
		if(!empty($this->request->data['section'])){

			$UserData['section'] = $this->request->data['section'];
		}

		if(!empty($this->request->data['brand'])){

			$UserData['brand_name'] = $this->request->data['brand'];
		}


		//echo "<pre>";print_r($UserData);die;

		$UserData['activation_code'] = md5($Unique_Id);

		date_default_timezone_set('Asia/Calcutta');
		$DateAdded = date( 'Y-m-d H:i:s' );
            
		$UserData['created'] = $DateAdded;	

		$UserData['validated'] = 1;
 

		$this->loadModel('RateReview');

		$this->RateReview->save($UserData);
		


	


		// $email = new CakeEmail();
			
		// 	$first_name =$this->request->data['first_name'];
			
		// 	$last_name = $this->request->data['last_name'];	
			
		// 	$usrEmail =  $this->request->data['business_email'];	
			
		// 	$feedback = $this->request->data['feedback'];
			
		// 	$activation_code = $UsrData['activation_code'];
			
		// 	$email->viewVars(array('first_name' => $first_name,'last_name' => $last_name,'feedback' => $feedback,'vendor_Company' => $vendor_Company,"created" => $created, "activation_code" => $activation_code));

		// 	$email->config('smtp')
 
  //      		->template('feedback_activation')

		// 	->emailFormat('html')

		// 	->from(array('info@xerve.in' => 'Xerve.in'))

		// 	->to("$usrEmail")
			
		// 	//->to("smani8388@gmail.com")
				
		//     ->bcc(array('info@xerve.in'))								
				
		// 	->replyTo(array('support@xerve.in')) 

		// 	->subject("Activate Your Rating and Review of $vendor_Company Now ($Unique_Id)")  

		// 	->send();
			





	}

public function star_rating(){

	
	$this->autoRender=false;

	// Configure::write("debug",2);
	$this->loadModel('RateReview');

	$UserData['rating'] = $this->request->data['rate'];

	$UserData['vendor_ID'] = $this->request->data['id'];

	$UserData['validated'] = 1;

	if(!empty($this->request->data['article_id'])){

		$UserData['article_id']= $this->request->data['article_id'];
	}
	if(!empty($this->request->data['store_id'])){

	$UserData['store_id'] = $this->request->data['store_id'];
	}

	if(!empty($this->request->data['offer_id'])){

	$UserData['offer_id'] = $this->request->data['offer_id'];

}


if(!empty($this->request->data['coupon_id'])){

	$UserData['coupon_id'] = $this->request->data['coupon_id'];
}

		if(!empty($this->request->data['section'])){

			$UserData['section'] = $this->request->data['section'];
		}

		if(!empty($this->request->data['brand'])){

			$UserData['brand_name'] = $this->request->data['brand'];
		}


	$this->RateReview->save($UserData);

}


	
	public function review($id=Null){

		$this->autoRender=false;

		$this->layout = "successful";

		

		if(!empty($id))

		{

			$this->loadModel('RateReview');
			

			$id = mysql_escape_string($id);

			$activated = $this->RateReview->query("select id,first_name,last_name,email_id,vendor_Id,activated,company_name,designation,created from rate_reviews where activation_code='$id'");
			
			//echo "<pre>";print_r($activated);echo "</pre>";

			if(!empty($activated)){

				if(empty($activated[0]['rate_reviews']['activated']))

				{
				
				//$vendor_Id = $activated[0]['rate_reviews']['vendor_Id'];
					
				//$vendor_details = $this->User->query("select company_name users where id='$vendor_Id'");
				
				//echo "<pre>";print_r($vendor_details);echo "</pre>";exit();

				$this->RateReview->query("update rate_reviews set activated='1' where activation_code='$id'");
			
				/*$email = new CakeEmail();

				$usrEmail =$activated[0]['rate_reviews']['email_id'];

				$fullname =$activated[0]['rate_reviews']['full_name'];

				$company_name = $activated[0]['rate_reviews']['company_name'];	
				
				$DateAdded = $activated[0][0]['created'];
				
				$created  = date('d M Y g:i (A)', strtotime($DateAdded));			

				$Email_Template = "feedback_activated";

				$subject = "|WIN| Activation of Rating and Review of  Successful";


				$email->viewVars(array('fullname' => $fullname, 'created' => $created));

				$email->config('smtp')

				->template($Email_Template)

				->emailFormat('html')

				->from(array('info@xerve.in' => 'Xerve.in'))

				//->to("$usrEmail")

				->to("info@xerve.in")
				
				//->bcc(array('info@xerve.in'))									
				
				//->replyTo(array('support@xerve.in'))

				->subject($subject)

				->send();*/

			  }

			}

			$this->render('/Users/feedbacksubmissionsuccessful');

		}

	} 
	
	

	function register()

	{
	   
	      //if($_SERVER['REMOTE_ADDR']=='122.167.115.26')
		  //Configure::write('debug', 2);
		 
		// date_default_timezone_set('Asia/Calcutta');

		$this->layout = "main";

		$this->loadModel('User');		

		$this->autoRender = false;

		//echo "this is the register function for the enquire";

		$city= $this->request->data['city_id'];

		$category=$this->request->data['category_id'];

		$enquiry=$this->request->data['enquiry']['enquirymsg'];
		
		//echo $city;echo "and";echo $category;

		$submit = $_POST['posting'];

		// echo $submit;die;

		if (!empty($this->request->data['id'])) {

			$where_qry = " id=".$this->request->data['id'];

			$set_qry = "";
			
			if(!empty($this->request->data['register']['NamePrfx']))
			$set_qry .= "name_title='".$this->request->data['register']['NamePrfx']."' ";
			
			if(!empty($this->request->data['first_name']))
			$set_qry .= ",first_name='".$this->request->data['first_name']."' ";

			if(!empty($this->request->data['last_name']) && !empty($this->request->data['first_name']))
			$set_qry .= ",last_name='".$this->request->data['last_name']."' ";

			else if(!empty($this->request->data['last_name']))
			$set_qry .= " last_name='".$this->request->data['last_name']."' ";

			if(!empty($this->request->data['mobile_number']))
				$set_qry .= ",mobile_number='".$this->request->data['mobile_number']."' ";
			
			if(!empty($this->request->data['office_phone_number']))
				$set_qry .= ",office_phone_number='".$this->request->data['office_phone_number']."' ";	
				
			if(!empty($this->request->data['company_name']))
				$set_qry .= ",company_name='".$this->request->data['company_name']."' ";

			if(!empty($this->request->data['designation']))
				$set_qry .= ",designation='".$this->request->data['designation']."' ";

			if(!empty($this->request->data['website']))
			$set_qry .= ",website='".$this->request->data['website']."' ";			

			if(!empty($this->request->data['business_email']))
				$set_qry .= ",business_email='".$this->request->data['business_email']."' ";			

			if(!empty($this->request->data['password'])){

				$Md5_pwd = AuthComponent::password($this->request->data['password']);

				$set_qry .= ",password='".$Md5_pwd."' ";

			}
			//echo "<pre>";print_r($set_qry);die;

			$this->User->query("update users set $set_qry where $where_qry");

			$this->Session->setFlash('You have successfully updated your details.');

			$this->redirect("/myaccount/leads_profile");

		}

		
		//$city_combo="";
		
		//echo "Welcome begin".$this->request->data['register']['alter']."dfdfd".$this->request->data['register']['MblNo'];exit();
		//$city_combo=$this->request->data['CityCombo']; //exit(); 
			
	    if(empty($this->request->data['register']['alter'])){
		
		 //echo "Welcome";exit();
	
		 if($this->request->is('post') && !empty($this->request->data['register']['iagree']) || ($this->Auth->user('id') && !$this->request->data['city_enquire'])) {

		
		$Unique_Id = 'XRVL'.substr(str_shuffle(uniqid()), 1, 7);

		 
		if (!empty($this->request->data)) {			

		 //echo "Insite".$this->Auth->user('id');
		 
		if($this->Auth->user('id'))
		{
		$UserStatus = $this->Auth->user('status');
		}

		
		if(!$this->Auth->user('id') && $submit!=2 || isset($this->request->data['FrmJoin']) && !empty($UserStatus) || !empty($this->request->data['FrmRegister'])){
					 			 
			//User Data Insertion corporate
			
			$UsrData['status'] = 0;	
			
			$UsrData['join_from'] = "Direct";
			
			if(isset($this->request->data['FrmJoin']))
			{
			$UsrData['business_type'] = $this->request->data['register']['business_type'];
			// $UsrData['brand_for'] = $this->request->data['register']['business_type'];
			$UsrData['brand_for'] = 1;
			$UsrData['status'] = 0;	
			}
			if(!empty($this->request->data['FrmRegister']))
			{		
			$UsrData['status'] = 1;	
			$UsrData['company_name']="";
			}
			
			//if($this->request->data['register']['BusinessType']==1 || isset($this->request->data['FrmJoin']))
			if(!empty($this->request->data['enquiry']['requirement_type'])){
			
			$UsrData['status'] = 1;	

			if($this->request->data['enquiry']['requirement_type']==2){

				$UsrData['category_id'] = $this->request->data['register']['Category_id'];	


			}

				else{

			 	$UsrData['category_id']=0;
			 	$UsrData['sub_category_id']=0;
			 	$UsrData['brand_for']=1;
			 	$UsrData['company_name']="";
			 }


			}
			
			 if(!empty($this->request->data['register']['business_type'])){
			
			if($this->request->data['register']['business_type']==2)
			{
			$UsrData['category_id'] = $this->request->data['register']['Category_id'];	
			$UsrData['sub_category_id'] = $this->request->data['register']['SubCategory'];				
			}else
			{
			$UsrData['category_id'] = $this->request->data['register']['offer_Category_id'];			
			}		

			}	
			
			if(!empty($this->request->data['register']['companyname']))
			 $UsrData['company_name'] = $this->request->data['register']['companyname'];		

			 		
			 

			//$UsrData['sub_category_id'] = $this->request->data['register']['SubCategoryCmpySelect'][0];			

           /// if($this->request->data['register']['BusinessType']==2 || isset($this->request->data['FrmJoin']))
			
			if(!empty($this->request->data['register']['Area_id']))
			$UsrData['area_id'] = $this->request->data['register']['Area_id'];			

			$UsrData['city_id'] = $this->request->data['register']['City_id'];			

			$UsrData['country_id'] = 1;			

            if(!empty($this->request->data['register']['OffcPhneCode']))
			$UsrData['office_std_code'] = $this->request->data['register']['OffcPhneCode'];			

			if(!empty($this->request->data['register']['OffcPhneNo']))
			$UsrData['office_phone_number'] = $this->request->data['register']['OffcPhneNo'];			

			//$UsrData['designation'] = $this->request->data['register']['Designation'];			

			//$UsrData['website'] = $this->request->data['register']['website'];			

			$UsrData['first_name'] = $this->request->data['register']['First_Name'];			

			$UsrData['last_name'] = $this->request->data['register']['Last_Name'];
			
			//echo "company name: ".$this->request->data['register']['companyname']; exit();
			

            if(!empty($this->request->data['register']['MblNo']))
			$UsrData['mobile_number'] = $this->request->data['register']['MblNo'];			

			$UsrData['name_title'] = $this->request->data['register']['NamePrfx'];				
			
			/* if(isset($this->request->data['FrmRegister']))
			 {
			 
			 if(!empty($this->request->data['Day']['Type']))
			 $UsrData['day_id'] = $this->request->data['Day']['Type'];
			
			 if(!empty($this->request->data['Month']['Type']))
			 $UsrData['month_id'] = $this->request->data['Month']['Type'];
			
			 if(!empty($this->request->data['Year']['Type']))
			 $UsrData['year_id'] = $this->request->data['Year']['Type'];	
			 
			 }*/		
			
			// if(!empty($this->request->data['enquiry']['Call']))
			// $UsrData['xxx']= $this->request->data['enquiry']['Call'];

			$UsrData['ip'] = $_SERVER['REMOTE_ADDR'];
			
			$UsrData['business_email'] = $this->request->data['register']['Business_Email'];
              
			if(isset($this->request->data['FrmJoin']))
			$UsrData['password'] = $this->request->data['register']['Password'];
			else if(isset($this->request->data['FrmRegister']))
			$UsrData['password'] = $this->request->data['register']['Password'];
			else{
				$UsrData['business_email'] = $this->request->data['register']['Business_Email'];
				$Md5_password = AuthComponent::password($this->request->data['register']['Password']);
				$UsrData['password']=$Md5_password;
			}


			         date_default_timezone_set('Asia/Calcutta');
		             $DateAdded = date( 'Y-m-d H:i:s' );
            
			         $UsrData['created'] = $DateAdded;	                    

                     $UsrData['lead_became_zero'] = $DateAdded;

                     $UsrData['display_became_zero'] = $DateAdded;

                     $date = strtotime($DateAdded);
		             $date = strtotime("+7 day", $date);
                     $date=date('Y-m-d H:i:s' , $date);

                     $UsrData['zero_lead_remainder'] = $date;

                     $UsrData['zero_display_remainder'] = $date;

					$UsrData['activation_code'] = md5($Unique_Id);


					// echo "<pre>";print_r($UsrData);die;
			
			//Channels tracking for registrations
				$Channel_Fnd = $this->Cookie->read('WINChannel');
				$Channel_Type = $this->Cookie->read('WINChannel_type');
				$Channel_Type_Sub = $this->Cookie->read('WINChannel_type_sub');
				//echo $Channel_Fnd;
			if(!isset($this->request->data['FrmJoin']))
			{
			
				if(!empty($Channel_Fnd))
				{
					$UsrData['channel'] =$Channel_Fnd;
					$UsrData['channel_target_type'] =$Channel_Type; 
					$UsrData['sub_channel'] =$Channel_Type_Sub; 

				}
				//Channels tracking for registrations				
			}

			if(isset($this->request->data['FrmJoin']))
			{
						 
				//exit();
				if(!empty($Channel_Fnd))
				{
				   // echo "channels";
				  
					$UsrData['channel'] =$Channel_Fnd;
					$UsrData['channel_target_type'] =$Channel_Type;
				}
				//Channels tracking for registrations				
			}

			//User Data Insertion ends
			
			//echo "dfsdfd".$this->request->data['register']['MblNo'];
			
		  // echo "<pre>";print_r($UsrData);echo "</pre>"; exit();
		   
		 //    if(!empty($this->request->data['FrmRegister']))	
			// $UsrData['company_name'] = "";		


			$this->User->set($UsrData);

		
			$validated = $this->User->validates();
			

			}//if user notlogged in only 


			$this->loadModel('Enquiry');

			if(isset($this->request->data['FrmJoin']))

			$UsrData['user_type'] = "2"; //2 means  Vendor , 1 default means Clients
			
			if(!empty($this->request->data['FrmRegister']))
			
			$UsrData['user_type'] = "1"; //2 means  Vendor , 1 default means Clients

			if($this->User->validates() || $this->Auth->user('id') || !isset($this->request->data['FrmJoin']) || empty($this->request->data['FrmRegister']))

			{
			
			//echo "WElocme";
				
				if(!$this->Auth->user('id') && ($submit==3 || isset($this->request->data['FrmJoin']) || isset($this->request->data['FrmRegister']))){

				if(!empty($UsrData['business_email'])){

					$UsrData['email_send'] = 1;
				}else{

					$UsrData['email_send'] = 0;
				}
					// echo "this is here";die;
				$this->User->save($UsrData);  // Save User DAta for the new user..
				
				// echo "<pre>";print_r($UsrData);echo "</pre>"; exit();

				$MyUser_id =  $this->User->id;
				/*updated*/
				  if($UsrData['status'] == 0){// if seller only loop

				  	                /*sid creation*/
				  	                                $this->loadModel('OfflineSeller');

									$mobile_number_seller = $this->request->data['register']['MblNo'];

									$off_seller_details = $this->OfflineSeller->find('first',array(

														'conditions' => array('OfflineSeller.mobile_number'=>$mobile_number_seller),

														'fields' => array('OfflineSeller.seller_id')

										));

									// if(!empty($this->request->data['seller_campaign'])){

								if(empty($off_seller_details)){

									$Unique_Id_Seller = 'SID'.substr(str_shuffle(uniqid()), 1, 7);

									                                  
                                    $Off_Seller['mobile_number'] = $this->request->data['register']['MblNo'];

									$Off_Seller['seller_id'] = $Unique_Id_Seller;
                                    									                                    									
									$Off_Seller['created'] = $DateAdded;

									$Off_Seller['vid']  = $MyUser_id;

									if(!empty($this->request->data['seller_campaign'])){

									$Off_Seller['seller_type'] = 0;
									$Off_Seller['status'] = 1;
									$Off_Seller['latitude'] = $this->request->data['login_latitude'];
                                    $Off_Seller['longitude'] = $this->request->data['login_longitude'];
                                    $Off_Seller['category_name'] = $this->request->data['category_seller'];
                                    $Off_Seller['area'] = $this->request->data['login_area'];
                                    $Off_Seller['city'] = $this->request->data['login_city'];
                                    $Off_Seller['address'] = $this->request->data['login_address'];
                                    $Off_Seller['full_name'] = $this->request->data['register']['First_Name'];
                                    $Off_Seller['business_email'] = $this->request->data['register']['Business_Email'];
                                    $Off_Seller['seller_name'] = $this->request->data['register']['companyname'];

									}else{

									$Off_Seller['seller_type'] = 1;
									$Off_Seller['status'] = 0;

									}

									$this->OfflineSeller->save($Off_Seller);

									// App::uses('CakeEmail', 'Network/Email');
    		
						   //  		$email = new CakeEmail();

						   //          $email->config('smtp');

						   //          $email->from(array('info@xerve.in' => 'Xerve.in'));

						   //          $email->to(array('xerve.retail@gmail.com')); // Customer Service Email


									// $email->cc(array('arunarav@gmail.com'));

									// $email->subject("New Seller Application ($MyUser_id)");

									// $msg_app = "New Seller (SID) Application.";

									

									if($this->request->data['register']['NamePrfx'] == 1)		{

					                    $namePrefix = 'Mr';


					                }
					                else if($this->request->data['register']['NamePrfx'] == 2){

					                    $namePrefix = 'Mrs';

					                }else{

					                    $namePrefix = 'Ms';
					                }

					                // $Message = $msg_app."\r\nName: ".$namePrefix." ".$this->request->data['register']['First_Name']." ".$this->request->data['register']['Last_Name']."\r\nEmail: ".$this->request->data['register']['Business_Email']."\r\nMobile Number: +91-".$this->request->data['register']['MblNo']." (User Id : ".$MyUser_id.")";

					                // $email->send($Message);

								}else{

										$Unique_Id_Seller = $off_seller_details['OfflineSeller']['seller_id'];
								}


									$result['SID'] = $Unique_Id_Seller;

								// }


									
				  	                /*sid creation*/ 
									$this->loadModel("Leadaltpayment");



									$category_id=$this->request->data['register']['Category_id'];

									// $query="select type from offer_categories where id='".$category_id."'";//
									// $category_data = $this->User->query($query);
									


									// $company_type=$category_data[0]['offer_categories']['type'];
									// if(($company_type ==1)||($company_type ==3)){
									// $register_credit['leads_credited']='100';
									// $leads_credits=100;
									// }
									// if($company_type ==2){
									// $register_credit['leads_credited']='500';
									// $leads_credits=500;
									// }


									 $query="select credits from offer_categories where id='".$category_id."'";
									 $category_data = $this->User->query($query);
									 $leads_credits=$category_data[0]['offer_categories']['credits'];
									 $leads_credits=$leads_credits * 3;

									$register_credit['created_date'] = $DateAdded;
									$register_credit['amount'] = $leads_credits;
									$register_credit['user_id']=$MyUser_id;
									$register_credit['register'] ='1';
									$register_credit['package_name']='FREE';
									$register_credit['payment_mode'] = 'OFFLINE';
									$register_credit['payment_for'] = 'Leads';
									$register_credit['verify']='1';
									$register_credit['firstName'] = $this->request->data['register']['First_Name'];        
									$register_credit['lastName'] = $this->request->data['register']['Last_Name'];
									$register_credit['email'] = $this->request->data['register']['Business_Email'];
									$register_credit['mobileNo'] = $this->request->data['register']['MblNo'];
									$this->Leadaltpayment->save($register_credit); 
								 $query=" UPDATE users SET leads_displays_count = leads_displays_count + '".$leads_credits."' WHERE id = '".$MyUser_id."' "; 
								 $this->User->query($query); 

									
							}// if seller only loop	
				/*updated */

				

				// echo $MyUser_id;die;

				//for saving the details to the user_categories table and business_listing_categories table..
				$this->loadModel('UserCategory');
				$this->loadModel('BusinessListingCategory');
				
				
				if($submit==2 || $submit==3)
				{
				
				// $UsrCatData['brand_for'] = $this->request->data['enquiry']['requirement_type'];
				$UsrCatData['brand_for'] = 1;
				
				if(!empty($this->request->data['enquiry']['requirement_type'])){


					if($this->request->data['enquiry']['requirement_type']==2){

					$UsrCatData['category_id'] = $this->request->data['enquiry']['Category_id'];	
					$UsrCatData['sub_category_id'] = $this->request->data['subCategory'];					
					$UsrCatData['city_id'] = $this->request->data['enquiry']['City_id'];
					$UsrCatData['country_id'] = 1;
					$UsrCatData['area_id'] = 0;
					$UsrCatData['user_id']= $MyUser_id;
					
					}

					else{

					 	$UsrCatData['category_id']=0;
					 	$UsrCatData['sub_category_id']=0;
					 	$UsrCatData['brand_for']=1;
						$UsrCatData['city_id'] = $this->request->data['enquiry']['City_id'];
						$UsrCatData['country_id'] = 1;
						$UsrCatData['area_id'] = 0;
						$UsrCatData['user_id']= $MyUser_id;
					 	
				 }


				}
				
				
				}else
				{
				
				if(isset($this->request->data['FrmJoin']))
			    $UsrCatData['brand_for'] = 1;

			    // $UsrCatData['brand_for'] = $this->request->data['register']['business_type'];


					
					if(!empty($this->request->data['register']['business_type'])){
					if($this->request->data['register']['business_type']==2)
					{
					$UsrCatData['category_id'] = $this->request->data['register']['Category_id'];	
					$UsrCatData['sub_category_id'] = $this->request->data['register']['SubCategory'];				
					}else
					{
					$UsrCatData['category_id'] = $this->request->data['register']['offer_Category_id'];	
					
					$UsrCatData['sub_category_id'] = 0;		
					}			
				}
				
					$UsrCatData['city_id'] = $this->request->data['register']['City_id'];

					$UsrCatData['area_id'] = $this->request->data['register']['Area_id'];

					$UsrCatData['country_id'] = 1;

					$UsrCatData['user_id']= $MyUser_id;//Get Sender id from last insert of user
					
					
					}
					

					//echo "<pre>";print_r($UsrCatData);echo "<br/>";
					
					$this->UserCategory->save($UsrCatData);// saving in user_categories table.
					
					$this->BusinessListingCategory->save($UsrCatData);// saving into the business_listing_categories table.
					
					
            				
				}
				else if(!empty($UserStatus) && isset($this->request->data['FrmJoin']) || !empty($this->request->data['FrmRegister']))
				{

				if(!empty($UsrData['business_email'])){

					$UsrData['email_send'] = 1;
				}else{

					$UsrData['email_send'] = 0;
				}
				
				$this->User->save($UsrData);  // Save User DAta

				$MyUser_id =  $this->User->id;
						

				//echo "<pre>";print_r($UsrData);echo "</pre>";
			
				//echo "Entered";
				
				
				}else{				

				$MyUser_id = $this->Auth->user('id') ; //if user logged in take that 
				
								
				//$EnqData['status'] = 1;
				
				//echo "<br>Validated succes. no";exit();
				}
				
		
				if(!empty($this->request->data['user']['business_email']) && $submit==2 )	{

				$user_name = $this->request->data['user']['business_email'];
								
						
					$this->loadModel("LoginDetail");
					 
					date_default_timezone_set('Asia/Calcutta');
						
					$DateAdded = date( 'Y-m-d H:i:s' );
					
					$Login['created'] = $DateAdded;			
						
					$Login['user_name'] =  $this->request->data['User']['business_email'];

					$Login['ip'] = $_SERVER['REMOTE_ADDR'];
					 
					$this->LoginDetail->save($Login); 
				
				   $this->loadModel("User");
			 
				   $User_Details = $this->User->find('first',
		
			      array(
						'conditions' => array("User.business_email" => $user_name),
						  
						'fields' => array('User.id','User.first_name','User.last_name','User.business_email','User.company_name','User.activation_code','User.status','User.activated','Enquiry.enquiry_id'),
						
						'order' => array('created desc'),
						
		 				'joins'         =>  array(

		 						array(

		 								'table'         =>  'enquiries',

		 								'alias'         =>  'Enquiry',

		 								'type'          =>  'left',

		 								'foreignKey'    =>  false,

		 								'conditions'    =>  array( 'User.id = Enquiry.user_id' )

		 						)		
						)));


		 				//echo "<pre>";print_r($User_Details);echo "<br/>";die;

		 				$MyUser_id = $User_Details['User']['id'];
						
						$user = $this->User->findById($MyUser_id);
						
                        $user = $user['User'];
											
                        $this->Auth->login($user);		
						
						
						$UserLog = $this->Auth->user('id');						
						
						//echo "UserId: ".$MyUser_id." Authdfdf: ".$UserLog; exit();
		 			}
				

				if($this->Auth->user('id') || !isset($this->request->data['FrmJoin']) && empty($this->request->data['FrmRegister']))

				{

				 //echo "Hey i am from FrmJoin";exit();

				// Enquiry Insert Starts

				
                $EnqData['status'] = 1;
				
				$EnqData['original_message']= $this->addParagraphs($this->request->data['enquiry']['enquirymsg']);

				$EnqData['message']= $this->addParagraphs($this->request->data['enquiry']['enquirymsg']);
				
				$subject_100 = $this->addParagraphs($this->request->data['enquiry']['enquirymsg']);
				
				
				
				if(strlen($subject_100) > 100){
				
				$subject_100 = substr($subject_100, 0,100);
				
				}
				
				$EnqData['subject']= $subject_100;
				
				$EnqData['original_subject']= $subject_100;
				
				$EnqData['ip'] = $_SERVER['REMOTE_ADDR'];

				$EnqData['enquiry_id']=$Unique_Id;

				$_SESSION['New_User']=$Unique_Id;

				$EnqData['country_id']= 1;
				
				if($this->request->data['quotes_type']==1)

			    $EnqData['quotes_type'] = $this->request->data['quotes_type'];		
						
				$EnqData['city_id']= $this->request->data['enquiry']['City_id'];

				

				$EnqData['customer_type'] = $this->request->data['enquiry']['requirement_type'];

				if($this->request->data['enquiry']['requirement_type']==1){

					$EnqData['category_id']= $this->request->data['enquiry']['Offer_Category_id'];
				}
				elseif($this->request->data['enquiry']['requirement_type']==2){

					$EnqData['category_id']= $this->request->data['enquiry']['Category_id'];
				

				 	 date_default_timezone_set('Asia/Calcutta');
		             $DateAdded = date( 'Y-m-d H:i:s' );
            
			         $EnqData['created_date'] = $DateAdded;	  

				// $subcat=$this->request->data['subCatergory'];

				// foreach($subcat as $value){

				// 	//$subcat.= $value. ",";

				// 	$EnqData['sub_category_id'] = $value;
				// 	// echo "this is the value for the "; "<br/>";	
				// 	// echo $value;

				// }
				//  $subcat = substr($subcat,0,-1);

				// $EnqData['sub_category_id']= $subcat;
					$EnqData['sub_category_id'] = $this->request->data['subCategory'];
			}
				
				$EnqData['requirement_type']= 1;
			
				$EnqData['mobile_number']= $this->request->data['enquiry']['Quotes'];
				
				if(!empty($MyUser_id)&&!$this->Auth->user('id')){
					$EnqData['user_id']= $MyUser_id;//Get Sender id from last insert of user
				}
				else{
					$EnqData['user_id'] = $this->Auth->user('id');

				}
			
				//Channels tracking for enquries
				$Channel_Fnd = $this->Cookie->read('WINChannel');
				$Channel_Type = $this->Cookie->read('WINChannel_type');
				
				if(!empty($Channel_Fnd))
				{
					$EnqData['channel'] =$Channel_Fnd;
					$EnqData['channel_target_type'] =$Channel_Type;
					
				}
				// 
				//Channels tracking for enquries
				$this->loadModel('EnquiryListingCategory');

				$subcategory=$this->request->data['subCatergory'];
				// Enquiry Insert Ends
				// foreach($subcategory as $value ){

				// $EnqList['enquiry_id']=$Unique_Id;	
				// $EnqList['sub_category_id']= $value;

				// $EnqList['category_id']= $this->request->data['enquiry']['Category_id'];

				// $EnqList['city_id']= $this->request->data['enquiry']['City_id'];

				// $newArrays[] = $EnqList;

				// }


				// echo "<pre>";print_r($EnqData);die;
				// //for saving the enquiry subcategory lists in the enquire_listing_categories table.

				// echo "<pre>";print_r($newArrays);die;

				$this->EnquiryListingCategory->save($EnqData);
				
				// for saving the data in the enquiry table.

				$this->Enquiry->save($EnqData);// for saving the enquiry to the Enquiry table..
				
				
			  
				//$this->redirect("/enquirysubmissionsuccessful");

			}
			
				// From Join Page Enquires will not there, so disable enquiry insertion

				$layout = "main";

				if((!$this->Auth->user('id') || $this->Auth->user('id')) && $submit!=2 && $submit!=3){

				//echo $MyUser_id; echo "<br/>";
				//User Categories Combo Insertion

				$this->loadModel('UserCategory');
				$this->loadModel('BusinessListingCategory');
			

				if(!empty($this->request->data['User_Id']) || !empty($MyUser_id) )	{

					

					if(!empty($MyUser_id)){

						$user=$MyUser_id;
					}
					else{

						$user=$this->request->data['User_Id'];
					}

				$Subcategories = $this->request->data['subCatergory'];

				foreach($Subcategories as $scat){ 

					$UsrCatData['category_id']=$this->request->data['enquiry']['Category_id'];

					$UsrCatData['sub_category_id'] = $scat;

					$UsrCatData['city_id']=$this->request->data['enquiry']['City_id'];

					$UsrCatData['country_id'] = 1;

					$UsrCatData['user_id']= $user;//Get Sender id from last insert of user

					$newArraays[] = $UsrCatData;
				}

			}	

			else{
				
				$Subcategories = $this->request->data['subCatergory'];

			

				if($Subcategories!="All" && !empty($Subcategories)){

				foreach($Subcategories as $scat){  //multiple subcategories insertions

					$UsrCatData['category_id'] = $this->request->data['register']['Category_id'];

					$UsrCatData['sub_category_id'] = $scat;

					$UsrCatData['area_id'] = $this->request->data['register']['Area_id'];

					$UsrCatData['city_id'] = $this->request->data['register']['City_id'];

					$UsrCatData['country_id'] = 1;

					$UsrCatData['user_id']= $user;//Get Sender id from last insert of user

					$newArraays[] = $UsrCatData;

				}
			  }
			  	 else{

				    //echo "dfdf elser";exit(0);
                    //if(($this->request->data['register']['BusinessType']==1) || isset($this->request->data['FrmJoin']))

                    
					$UsrCatData['category_id'] = $this->request->data['register']['Category_id'];
					
					$UsrCatData['sub_category_id'] = 0;//if it is all

					$UsrCatData['area_id'] = $this->request->data['register']['Area_id'];

					$UsrCatData['city_id'] = $this->request->data['register']['City_id'];

					$UsrCatData['country_id'] = 1;

					$UsrCatData['user_id']= $this->User->id;//Get Sender id from last insert of user

					$first=$this->UserCategory->save($UsrCatData);
					//echo "Usecat".$first;
					
					$second=$this->BusinessListingCategory->save($UsrCatData);
					//echo "businlisting".$second;
					
					//exit(0);

				}
			
				

			} 
				//echo "<pre>";print_r($newArraays);die;

				// $this->UserCategory->savemany($newArraays);
				
				// $this->BusinessListingCategory->savemany($newArraays);
				

				}
				
			  
			 
				
				
			  if(!isset($this->request->data['FrmJoin']) && empty($this->request->data['FrmRegister']) || !empty($submit))
			  {
			  
				$this->loadModel('ChatDetail');
	
				$Chat['user_id'] = $MyUser_id;
				
				$Chat['reject'] = $Unique_Id;
				
				$Chat['message'] = $this->addParagraphs($this->request->data['enquiry']['enquirymsg']);

				$ip = $_SERVER['REMOTE_ADDR'];
				date_default_timezone_set('Asia/Calcutta');
				$Current_Date = date( 'Y-m-d H:i:s' );
				
				$Chat['created'] = $Current_Date;
				$Chat['ip'] = $ip;							

                $Chat['reply_to'] = 50536;

				$Chat['deleted_flag'] = 0;	
				
				$this->ChatDetail->saveAll($Chat);
			
			    //echo "<pre>";print_r($Chat);echo "</pre>";exit();
	
			  }

			    $email = new CakeEmail();
				
				//echo "test: ".$this->Auth->user('id'); exit();
				
				$thisid = $this->Auth->user('id');
			    

			  	if(!empty($thisid) && !isset($this->request->data['FrmJoin']) || empty($this->request->data['FrmRegister']) && !empty($thisid) || !empty($submit)){
				
				//echo "user: ".$this->Auth->user('id'); exit();
						
			  	//echo "the code is here";die;

			  	//echo $Unique_Id;die;

			  	$this->loadModel('Enquiry');			  		

				$Enquiries = $this->Enquiry->find('all',

						array(

						'conditions' => array("enquiry_id"=>$Unique_Id),

						'fields' => array('User.id','Enquiry.id','Enquiry.user_id','Enquiry.enquiry_id','Enquiry.original_subject','Enquiry.original_message','Enquiry.subject','Enquiry.message','Enquiry.preview',"date_format(Enquiry.created_date,'%e %M %Y - %l:%i %p') AS created_date","date_format(Enquiry.created_date,'%e %M %Y') AS date","date_format(Enquiry.created_date,'%l:%i %p') AS time",'Enquiry.created_date',"date_format(Enquiry.modified_date,'%e %M %Y - %l:%i %p') AS modified_date",'Enquiry.modified_date','Enquiry.status','Enquiry.requirement_type','User.first_name','User.company_name','User.mobile_number','User.designation','User.business_email','User.office_phone_number','User.office_std_code','User.last_name','User.website','User.name_title','Cat.category_name','SCat.sub_category_name','Area.area_name','City.city_name'),

						'order' => array('created_date desc'),

						

		 				'joins'         =>  array(



		 						array(



		 								'table'         =>  'users',



		 								'alias'         =>  'User',



		 								'type'          =>  'left',



		 								'foreignKey'    =>  false,



		 								'conditions'    =>  array( 'Enquiry.user_id = User.id' )



		 						),array(



		 								'table'         =>  'categories',



		 								'alias'         =>  'Cat',



		 								'type'          =>  'left',



		 								'foreignKey'    =>  false,



		 								'conditions'    =>  array( 'Enquiry.category_id = Cat.id' )



		 						),array(



		 								'table'         =>  'sub_categories',



		 								'alias'         =>  'SCat',



		 								'type'          =>  'left',



		 								'foreignKey'    =>  false,



		 								'conditions'    =>  array( 'Enquiry.sub_category_id = SCat.id' )



		 						),array(



		 								'table'         =>  'areas',



		 								'alias'         =>  'Area',



		 								'type'          =>  'left',



		 								'foreignKey'    =>  false,



		 								'conditions'    =>  array( 'User.area_id = Area.id')



		 						),array(



		 								'table'         =>  'cities',



		 								'alias'         =>  'City',



		 								'type'          =>  'left',



		 								'foreignKey'    =>  false,



		 								'conditions'    =>  array( 'Enquiry.city_id = City.id' )



		 						)

				            ))

		               );

             //echo "<pre>";print_r($Enquiries);echo "</pre>";exit();			       
				

        $user_id=$Enquiries[0]['Enquiry']['user_id'];
		
		$Clients = $this->User->find('first',
		
				array(
						'conditions' => array("User.id=$user_id"),
						  
						'fields' => array('User.id','User.first_name','User.last_name','User.business_type','Cat.category_name','SCat.sub_category_name','City.city_name','Enquiry.requirement_type'),
						
						'order' => array('created desc'),
						
		 				'joins'         =>  array(

		 						array(

		 								'table'         =>  'enquiries',

		 								'alias'         =>  'Enquiry',

		 								'type'          =>  'left',

		 								'foreignKey'    =>  false,

		 								'conditions'    =>  array( 'User.id = Enquiry.user_id' )

		 						),array(

		 								'table'         =>  'categories',

		 								'alias'         =>  'Cat',

		 								'type'          =>  'left',

		 								'foreignKey'    =>  false,

		 								'conditions'    =>  array( 'User.category_id = Cat.id' )

		 						),array(

		 								'table'         =>  'sub_categories',

		 								'alias'         =>  'SCat',

		 								'type'          =>  'left',

		 								'foreignKey'    =>  false,

		 								'conditions'    =>  array( 'User.sub_category_id = SCat.id' )

		 						),array(



		 								'table'         =>  'cities',



		 								'alias'         =>  'City',



		 								'type'          =>  'left',



		 								'foreignKey'    =>  false,




		 								'conditions'    =>  array( 'User.city_id = City.id' )



		 						)
		
				))
		
		);
		
		
				
			
				  
			    //echo "hello mail";	

				if($Enquiries[0]['SCat']['sub_category_name']!='All')
				$msg1="Need ".$Enquiries[0]['SCat']['sub_category_name'];
				else
				$msg1="Need ".$Enquiries[0]['Cat']['category_name'];

				$msg2="";

				//echo $msg2;
				
				//Email Notification to user
				//echo $Unique_Id;
			   //echo $MyUser_id;die;

		       $activated = $this->Enquiry->query("SELECT distinct users.id, first_name, last_name, business_email, category_name, sub_category_name,designation, city_name,original_subject,enquiries.category_id,enquiries.created_date,date_format(enquiries.created_date,'%e %M %Y - %l:%i %p') AS created_date,enquiries.city_id,enquiries.quotes_type

				FROM users, enquiries, sub_categories, categories, cities

				WHERE enquiries.user_id = users.id

				AND enquiries.category_id = categories.id

		

				AND enquiries.city_id = cities.id 

				AND enquiry_id='$Unique_Id'");
				
				// echo "<pre>dfdf";print_r($activated);echo "</pre>";exit();
		        //echo "here is another code ";

			    //echo $Unique_Id;	
		        //echo $MyUser_id;
			    //echo "<pre>";print_r($activated);die;

				
				if(!empty($activated)){

				//echo "welocome";

				$email = new CakeEmail();

				$Enquiry_Sender_id =$activated[0]['users']['id'];

				$usrEmail =$activated[0]['users']['business_email'];

				$data['first_name'] =$activated[0]['users']['first_name'];

				$data['last_name'] =$activated[0]['users']['last_name'];

				$data['country_name'] ="India";

				$data['city_name'] =$activated[0]['cities']['city_name'];

				$data['original_subject'] =$activated[0]['enquiries']['original_subject'];

				$data['designation'] =$activated[0]['users']['designation'];

				$data['created_date'] =$activated[0][0]['created_date'];

				$data['sub_category_name'] =$activated[0]['sub_categories']['sub_category_name'];

				$data['category_name'] =$activated[0]['categories']['category_name'];

				$data['enquiry_id'] = $Unique_Id;
				
				$data['quotes_type'] = $activated[0]['enquiries']['quotes_type'];
				
				$quotes_type =$activated[0]['enquiries']['quotes_type'];
				
				if($quotes_type==1)
				{
				$Post_Subject = "Enquiry Post Successful. View Quotes for Your Enquiry $Unique_Id.";
				}else
				{
				$Post_Subject = "Enquiry Post Successful. View Your Enquiry $Unique_Id.";
				}

				//echo "Enquiry Sender: Id".$Enquiry_Sender_id;

				//echo "<br><pre>";print_r($data);echo "</pre>";//exit();				

				// $email->viewVars(array('data'=>$data));

				// $email->config('smtp')

				// ->template("leads_activated")

				// ->emailFormat('html')

				// ->from(array('info@xerve.in' => 'Xerve.in'))

				// ->to("$usrEmail")
				
				// //->to("smani8388@gmail.com")

				// ->bcc(array('info@xerve.in'))

				// ->replyTo(array('support@xerve.in'))

				// ->subject("$Post_Subject")

				// //->send();

				// ->send();

				$this->set("msg","Your account has been activated Successfully.");

				//Email Notification ends
	
				

				
			
			    /*//To send email to every user belongs to the selection of this enquiry

				$Enq_category_id =$activated[0]['enquiries']['category_id'];

				$Enq_sub_category_id =$activated[0]['enquiries']['sub_category_id'];

				$Enq_city_id =$activated[0]['enquiries']['city_id'];

				

				$Enq_sub_category_name =$activated[0]['sub_categories']['sub_category_name'];

				$Enq_category_name =$activated[0]['categories']['category_name'];

				$Enq_city_name =$activated[0]['cities']['city_name'];

				
			   //To send email to every user belongs to the selection of this enquiry

				$Enquiry_Sender_detail = $this->Enquiry->query("SELECT distinct users.id, first_name, last_name, business_email, category_name, sub_category_name,designation, requirement_type, city_name,area_name,std_code

					FROM enquiries, users, sub_categories, categories, cities, user_categories, areas

					WHERE enquiry_id='$Unique_Id'

					AND users.id = user_categories.user_id 

					AND user_categories.category_id = categories.id

					AND user_categories.sub_category_id = sub_categories.id

					AND user_categories.city_id = cities.id 

					AND user_categories.category_id = categories.id

					AND user_categories.sub_category_id = sub_categories.id

					AND user_categories.city_id = cities.id AND user_categories.area_id = areas.id 

					and users.id=$Enquiry_Sender_id GROUP BY users.id");

					

				 //echo "<br>usersslist<pre>";print_r($Enquiry_Sender_detail);echo "</pre>";

			   $Users_list = $this->Enquiry->query("SELECT distinct users.id, first_name, last_name, business_email,designation

				FROM users, user_categories

				WHERE user_categories.user_id = users.id and users.status=0 AND user_categories.deleted_flag=0

				AND user_categories.category_id='$Enq_category_id' AND user_categories.city_id='$Enq_city_id'");

	
			   //echo "<br>usersslist<pre>";print_r($Users_list);echo "</pre>";

			   //exit();
			   
			   //Array merge 
		
			   ini_set('memory_limit', '700M');

			   //echo "<br>Merged_array<pre>";print_r($Merged_array);echo "</pre>";

			   set_time_limit(0);

			   if(!empty($Users_list)){

			   $email = new CakeEmail();

			   foreach($Users_list as $userdata){

			   if(!empty($userdata['users']['business_email'])){

				//$usrEmail =$userdata['users']['business_email'];

				$usrEmail =trim($userdata['users']['business_email']);

				$data['vendor_first_name'] =$userdata['users']['first_name'];

				$data['vendor_last_name'] =$userdata['users']['last_name'];

				}


				$data['sender_category'] =$Enquiry_Sender_detail[0]['categories']['category_name'];

				$data['sender_subcategory'] =$Enquiry_Sender_detail[0]['sub_categories']['sub_category_name'];

				$data['sender_city'] =$Enquiry_Sender_detail[0]['cities']['city_name'];

				$data['sender_std_code'] =$Enquiry_Sender_detail[0]['cities']['std_code'];

				$data['sender_area'] =$Enquiry_Sender_detail[0]['areas']['area_name'];

				$data['sender_type'] =$Enquiry_Sender_detail[0]['enquiries']['requirement_type'];
				
				$data['sender_designation'] =$Enquiry_Sender_detail[0]['users']['designation'];


				//$data['sub_category_name'] =$activated[0]['sub_categories']['sub_category_name'];

				//$data['category_name'] =$activated[0]['categories']['category_name'];

				$data['enquiry_id'] =$Unique_Id;

				$data['subject'] =$msg1;

				$data['message'] =$msg2;
				
			//	$email = "enquiry@quality-web-programming.com"; // Invalid email address 
 
				// Set up regular expression strings to evaluate the value of email variable against
				$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
				// Run the preg_match() function on regex against the email address
				if (preg_match($regex, $usrEmail)) {
					// echo $email . " is a valid email. We can accept it.";
					 
					 $email->viewVars($data);

						$email->config('smtp')
		
						->template("vendor_lead_alert")
		
						->emailFormat('html')
		
						->from(array('info@xerve.in' => 'Xerve.in'))
		
						//->to("$usrEmail")
					    
						//trim($usrEmail);
						
						->to("$usrEmail")
		
					    ->bcc(array('info@xerve.in'))								
		
						//->replyTo(array('support@xerve.in'))
		
						->subject("$msg1 || New Client Enquiry $Unique_Id")
		
						->send();
					 
				} else { 
					//echo $usrEmail . " is an invalid email. Please try again.";
					 
					 $InvalidEmails  .= $usrEmail."<br>";
					 $data['InvalidEmails'] =$InvalidEmails;
					 
				} 
													

				}//foreach ends
				
				//Once loop ends send invalid email id 
				
				if(!empty($data['InvalidEmails'])){
				
				 $email->viewVars($data);

						$email->config('smtp')
		
						->template("invalid_email")
		
						->emailFormat('html')
		
						->from(array('info@xerve.in' => 'Xerve.in'))
		
						//->to("$usrEmail")
					    //trim($usrEmail);
						
						->to("$usrEmail")
						
					    ->bcc(array('info@xerve.in'))
		
						->replyTo(array('support@xerve.in'))
		
						->subject("|WIN| In-Valid Emails found on while sending Enquiry $Unique_Id || $msg1")
		
						->send();
				}
				//Once loop ends send invalid email id ends

			}*/

			//Send Email to Registered Member ends
              
			//$_SESSION['PaymentDone']='success';

				}
				
			// End Lead Alert	
				
			//for the new clients...
				}else{

				 $activated = $this->Enquiry->query("SELECT category_name, sub_category_name, city_name,original_subject,date_format(created_date,'%e %M %Y - %l:%i %p') AS created_date,created_date

				FROM enquiries, sub_categories, categories, cities

				WHERE  enquiries.category_id = categories.id

				-- AND enquiries.sub_category_id = sub_categories.id

				AND enquiries.city_id = cities.id

				AND enquiry_id='$Unique_Id'");

				//  echo "Tested"; 
				//  echo "anoop is here";
				// echo $Unique_Id;
				// echo "this is the id";

				// $usrEmail =$UsrData['business_email'];
				//echo $usrEmail;die;
				//echo "<pre>";print_r($activated);die;
				
				$country_name ="India";

				$city_name =$activated[0]['cities']['city_name'];
				
				$created_date=$activated[0][0]['created_date'];

				$original = $activated[0]['enquiries']['original_subject'];

				$sub_category_name =$activated[0]['sub_categories']['sub_category_name'];

				$category_name =$activated[0]['categories']['category_name'];
				
				$usrEmail =$UsrData['business_email'];

				$company_name = $UsrData['company_name'];

				$first_name = $UsrData['first_name'];

				$last_name = $UsrData['last_name'];

				$company_name = $UsrData['company_name'];

				$activation_code = $UsrData['activation_code'];
				
				//echo $activation_code;exit();
				
				$FrmReg = "";
				
				if(!empty($this->request->data['FrmRegister']))
				{
				$FrmReg = "Yes";
			
				$created_date =date('d M Y - h:i A', strtotime($DateAdded));
				}
				
				$Email_Template = "client_activation";

				$subject = "Activate Your Buyer Account XRV$MyUser_id Now.";

				if(@$UsrData['user_type']=="2"){

				$Email_Template = "vendor_activation";

				$subject = "Activate Your Seller Account XRV$MyUser_id Now.";

				$Original_Subject ="";

				$country_name ="India";

				$city_name ="";				

				$sub_category_name ="";

				$category_name ="";

				 }
				 
				 
				 $email->viewVars(array('Original_Subject'=>@$Original_Subject,'country_name'=>@$country_name,'city_name'=>@$city_name,'sub_category_name'=>@$sub_category_name,'category_name'=>@$category_name,'first_name' => $first_name,'company_name' => $company_name,'last_name' => $last_name,'activation_code' =>$activation_code ,'original'=>@$original,'enquiry_id' => $Unique_Id,'created_date'=>@$created_date, "FrmReg" => $FrmReg));

				$email->config('smtp')

				->template($Email_Template)

				->emailFormat('html') 

				->from(array('info@xerve.in' => 'Xerve.in'))

				->to("$usrEmail")
				
				//->to("smani8388@gmail.com")
				
			    ->bcc(array('info@xerve.in'))
																	
				->replyTo(array('support@xerve.in'))

				->subject($subject)

				->send();

				//Email Notification ends
				}
				
				if(!empty($thisid) && !isset($this->request->data['FrmJoin']) || empty($this->request->data['FrmRegister']) && !empty($thisid)){

		     	if($this->request->data['quotes_type']==1)		
				$this->redirect("/onlinepayment/quotes/premium");			
				else
				$this->redirect("/quotes/$Unique_Id");	

					// $this->redirect("/enquire");
					// $this->Session->setFlash('Your stuff has been saved.');
				 	
				 	// echo "the code is here";die;

				}else if(isset($this->request->data['FrmJoin']) || !empty($this->request->data['FrmRegister']))
				
				{
				
				$External = $this->request->data['ProductURL'];
		
		        //echo "External: ".$External; exit();
		
				$ExternalList = explode("XRVA", $External);
		
				 //echo "External: ".$External; exit();
				 
				$User_Id = $this->User->id;
				
				$user = $this->User->findById($this->User->id);
				
				//echo "<pre>";print_r($user['User']);echo "</pre>";				
				
				$FullName = $user['User']['first_name']." ".$user['User']['last_name'];
				
				if(!empty($External))
				{
					if($ExternalList[1]=='Flipkart.com')
					{		
					$ExternalURL = $ExternalList[0].'&UID='.$User_Id.'&UID2='.$FullName;
					$this->redirect($ExternalURL);
					}
					else if($ExternalList[1]=='OMG')
					{
					$ExternalURL = $ExternalList[0].'&UID='.$User_Id.'&UID2='.$FullName;
					$this->redirect($ExternalURL);
					}
				}
				
				$this->redirect("/registrationsuccessful");
				
             	}
				else
				{
				
                $user = $this->User->findById($this->User->id);
                $user = $user['User'];
                $this->Auth->login($user);	
						
				if($this->request->data['quotes_type']==1)		
				$this->redirect("/onlinepayment/quotes/premium");			
				else
				$this->redirect("/quotes/$Unique_Id");	
				
				}

				

			}else{

				//echo "<br>Validation errors found <br>";

				$errors = $this->User->validationErrors;

				print_r($errors);

				$this->Session->setFlash($errors);

				$this->redirect("/");

			}

		
			 // Save Enquiry DAta

		} else {

			// Save logic goes here

			echo "<br>Data Not Found";

		}

		}else{

//echo "welcome Out:";exit();
			//echo "Please Agree";

			if(empty($this->request->data['register']['iagree']))

			{
			$this->layout = "businesses";
			$this->loadModel('DirectEnquiry');	
			$this->loadModel('Enquiry');	
	
			$this->autoRender = false;
			$UsrData['first_name'] = $this->request->data['register']['FirstName'];
			$UsrData['last_name'] = $this->request->data['register']['LastName'];			
			$UsrData['phone_no'] = $this->request->data['register']['MblNo'];	
			$UsrData['email_id'] = $this->request->data['register']['business_email'];	
			$UsrData['profile_submit_user'] =1; 
			date_default_timezone_set('Asia/Calcutta');
			$DateAdded = date( 'Y-m-d H:i:s' ); 
			$UsrData['profile_submit_user'] =$DateAdded; 
	
			$Unique_Id = 'XRVL'.str_shuffle(uniqid());
			
			$UsrData['enquiry_id'] =$Unique_Id; 
			
			//print_r($UsrData);exit();
			
			$this->DirectEnquiry->save($UsrData);  // Save User DAta
	
			$EnqData['enquiry_id']=$Unique_Id;
			
			$EnqData['ListingCity_Combo']= $this->request->data['CityCombo'];
					
			$EnqData['ListingCat_Combo']= $this->request->data['CatCombo'];
					
			$EnqData['ListingSCat_Combo']= $this->request->data['SCatCombo'];
	
			// print_r($EnqData);exit();	
	
			$this->Enquiry->save($EnqData);  // Save Enquiry DAta	
			
			$first_name=$UsrData['first_name'];
			$last_name=$UsrData['last_name'];
			$phone=$UsrData['phone_no'];
			$email=$UsrData['email_id'];
			$city_enquire=$this->request->data['city_enquire'];
			$cat_enquire=$this->request->data['cat_enquire'];
			$scat_enquire=$this->request->data['scat_enquire'];		
			$this->redirect("/quotes/$city_enquire/$cat_enquire/$scat_enquire/$first_name/$last_name/$phone/$email");
		
			}

			else

				$this->Session->setFlash('Please fill all the fields.');

			$this->redirect('/');

		}
		
		}

        $this->redirect('/');
		//echo "<br>Inside Registers ";

	}
	

	
	

	function success()

	{

		$this->layout = "sucess";

		$this->autoRender=false;

		$this->render('/Users/register_success');



	}

	function enquirysubmissionsuccessful()

	{

	$this->layout = "sucess";

	$this->autoRender=false;

	$this->render('/Users/enquirysubmissionsuccessful');

	}

	

	function addParagraphs($text)

   {

   // Add paragraph elements

   $lf = chr(10);

   return preg_replace('/

      \n

     (.*)

     \n

     /Ux' , $lf.'<p>'.$lf.'$1'.$lf.'</p>'.$lf, $text);

     }

	

	public function display() {

		$path = func_get_args();



		$count = count($path);

		if (!$count) {

			$this->redirect('/');

		}

		$page = $subpage = $title_for_layout = null;



		if (!empty($path[0])) {

			$page = $path[0];

		}

		if (!empty($path[1])) {

			$subpage = $path[1];

		}

		if (!empty($path[$count - 1])) {

			$title_for_layout = Inflector::humanize($path[$count - 1]);

		}

		$this->set(compact('page', 'subpage', 'title_for_layout'));

		$this->render(implode('/', $path));

	}

	public function enquiry($id=Null){

		$this->autoRender=false;
		
		/*if($_SERVER['REMOTE_ADDR']=='122.178.206.161')
		{
		
		 Configure::write('debug', 2);
		
		}*/
		
		//Configure::write('debug', 2);

		$this->layout = "successful";

		if(!empty($id))

		{

			$this->loadModel('User');

			//echo $id;

			$id = mysql_escape_string($id);


			$activate = $this->User->query("select id,first_name,business_email,last_name,business_email,activated,user_type,company_name from users where users.activation_code='$id'");
			
			$act=$activate[0]['users']['id'];

			 /*if($_SERVER['REMOTE_ADDR']=='122.172.244.95')
			 {
			 
			 echo "<pre>";print_r($activate);//die;
			
			 echo $act;die;
			 
			 }*/
						
			$this->loadModel('Enquiry');
				
				$user_activated = $this->Enquiry->query("SELECT enquiry_id,category_name, sub_category_name, city_name,original_subject,date_format(created_date,'%e %M %Y - %l:%i %p') AS created_date,created_date,quotes_type

				FROM enquiries, sub_categories, categories, cities

				WHERE  enquiries.category_id = categories.id

				AND enquiries.sub_category_id = sub_categories.id

				AND enquiries.city_id = cities.id

				AND user_id=$act");
				
				$quotes_type =$user_activated[0]['enquiries']['quotes_type'];
				
				if(!empty($user_activated)){
				
				$enq_id=$user_activated[0]['enquiries']['enquiry_id'];
				
				}
				
				//echo $quotes_type;
				
			    //echo "fsdsds<pre>";print_r($user_activated);echo "</pre>";exit();

			    if(!empty($activate)){

				if(!empty($activate[0]['users']['id']) && empty($activate[0]['users']['activated']))

				{

				$this->User->query("update users set activated='1',sms_activated='1' where activation_code='$id' and id=".$activate[0]['users']['id']);

				//Email Notification to user

				$email = new CakeEmail();
				
				$usrId=$activate[0]['users']['id'];

				$usrName =$activate[0]['users']['first_name'];

				$lastName =$activate[0]['users']['last_name'];

				$company_name = $activate[0]['users']['company_name'];

				$User_Type = $activate[0]['users']['user_type'];
			
				$Email_Template = "vendor_activated";

				$subject = "Account Activation Successful. Explore Our 3 Core Services.";

				$enquiry_subject ="";

				if($User_Type==1){

				$Email_Template = "client_activated";

				$subject = "Your Buyer Account XRV$usrId Activation Successful.";

				$enquiry = $this->Enquiry->query("select original_subject from enquiries where user_id=".$activate[0]['users']['id']);

				//echo "<pre>";print_r($enquiry);echo "</pre>";

				if(!empty($enquiry )){

				$enquiry_subject = $enquiry[0]['enquiries']['original_subject'];

				}
				
				
				// start lead management funciton start
				
				if(!empty($enq_id))
				{
				
				$Enquiries = $this->Enquiry->find('all',

				array(

						'conditions' => array("Enquiry.enquiry_id='$enq_id'"),

						'fields' => array('User.id','Enquiry.id','Enquiry.user_id','Enquiry.enquiry_id','Enquiry.original_subject','Enquiry.original_message','Enquiry.subject','Enquiry.message','Enquiry.preview',"date_format(Enquiry.created_date,'%e %M %Y - %l:%i %p') AS created_date","date_format(Enquiry.created_date,'%e %M %Y') AS date","date_format(Enquiry.created_date,'%l:%i %p') AS time",'Enquiry.created_date',"date_format(Enquiry.modified_date,'%e %M %Y - %l:%i %p') AS modified_date",'Enquiry.modified_date','Enquiry.status','Enquiry.requirement_type','User.first_name','User.company_name','User.mobile_number','User.designation','User.business_email','User.office_phone_number','User.office_std_code','User.last_name','User.website','User.name_title','Cat.category_name','SCat.sub_category_name','Area.area_name','City.city_name'),

						'order' => array('created_date desc'),

						

		 				'joins'         =>  array(



		 						array(



		 								'table'         =>  'users',



		 								'alias'         =>  'User',



		 								'type'          =>  'left',



		 								'foreignKey'    =>  false,



		 								'conditions'    =>  array( 'Enquiry.user_id = User.id' )



		 						),array(



		 								'table'         =>  'categories',



		 								'alias'         =>  'Cat',



		 								'type'          =>  'left',



		 								'foreignKey'    =>  false,



		 								'conditions'    =>  array( 'Enquiry.category_id = Cat.id' )



		 						),array(



		 								'table'         =>  'sub_categories',



		 								'alias'         =>  'SCat',



		 								'type'          =>  'left',



		 								'foreignKey'    =>  false,



		 								'conditions'    =>  array( 'Enquiry.sub_category_id = SCat.id' )



		 						),array(



		 								'table'         =>  'areas',



		 								'alias'         =>  'Area',



		 								'type'          =>  'left',



		 								'foreignKey'    =>  false,



		 								'conditions'    =>  array( 'User.area_id = Area.id')



		 						),array(



		 								'table'         =>  'cities',



		 								'alias'         =>  'City',



		 								'type'          =>  'left',



		 								'foreignKey'    =>  false,



		 								'conditions'    =>  array( 'Enquiry.city_id = City.id' )



		 						)

				            ))

		               );

                     


				$user_id=$Enquiries[0]['Enquiry']['user_id'];
				
				$Clients = $this->User->find('first',
				
				array(
						'conditions' => array("User.id=$user_id"),  
						'fields' => array('User.id','User.first_name','User.last_name','User.business_type','Cat.category_name','SCat.sub_category_name','City.city_name','Enquiry.requirement_type'),
						'order' => array('created desc'),
						
		 				'joins'         =>  array(

		 						array(

		 								'table'         =>  'enquiries',

		 								'alias'         =>  'Enquiry',

		 								'type'          =>  'left',

		 								'foreignKey'    =>  false,

		 								'conditions'    =>  array( 'User.id = Enquiry.user_id' )

		 						),array(

		 								'table'         =>  'categories',

		 								'alias'         =>  'Cat',

		 								'type'          =>  'left',

		 								'foreignKey'    =>  false,

		 								'conditions'    =>  array( 'User.category_id = Cat.id' )

		 						),array(

		 								'table'         =>  'sub_categories',

		 								'alias'         =>  'SCat',

		 								'type'          =>  'left',

		 								'foreignKey'    =>  false,

		 								'conditions'    =>  array( 'User.sub_category_id = SCat.id' )

		 						),array(



		 								'table'         =>  'cities',



		 								'alias'         =>  'City',



		 								'type'          =>  'left',



		 								'foreignKey'    =>  false,



		 								'conditions'    =>  array( 'User.city_id = City.id' )



		 						)
		
				))
		
		);
		
		        //echo "<pre>";print_r($Clients);echo "</pre>"; exit();
				
				
		
		    	if(empty($_SESSION['PaymentDone'])){
			
			    //echo "Tested"; exit();

			    //echo "hello mail";	

				if($Enquiries[0]['SCat']['sub_category_name']!='All')
				$msg1="Need ".$Enquiries[0]['SCat']['sub_category_name'];
				else
				$msg1="Need ".$Enquiries[0]['Cat']['category_name'];

				$msg2="";

				//echo $msg2;

				//Email Notification to user

		       $activated = $this->Enquiry->query("SELECT distinct users.id, first_name, last_name, business_email, category_name, sub_category_name,designation, city_name,original_subject,enquiries.category_id,enquiries.created_date,date_format(enquiries.created_date,'%e %M %Y - %l:%i %p') AS created_date,enquiries.sub_category_id,enquiries.city_id,enquiries.quotes_type

				FROM users, enquiries, sub_categories, categories, cities

				WHERE enquiries.user_id = users.id

				AND enquiries.category_id = categories.id

				AND enquiries.sub_category_id = sub_categories.id

				AND enquiries.city_id = cities.id 

				AND enquiry_id='$enq_id'");

			    //echo "<pre>";print_r($activated);echo "</pre>"; //exit();

				
				if(!empty($activated)){

				//echo "welocome";

				$email = new CakeEmail();

				$Enquiry_Sender_id =$activated[0]['users']['id'];

				$usrEmail =$activated[0]['users']['business_email'];

				$data['first_name'] =$activated[0]['users']['first_name'];

				$data['last_name'] =$activated[0]['users']['last_name'];

				$data['country_name'] ="India";

				$data['city_name'] =$activated[0]['cities']['city_name'];

				$data['original_subject'] =$activated[0]['enquiries']['original_subject'];

				$data['designation'] =$activated[0]['users']['designation'];

				$data['created_date'] =$activated[0][0]['created_date'];

				$data['sub_category_name'] =$activated[0]['sub_categories']['sub_category_name'];

				$data['category_name'] =$activated[0]['categories']['category_name'];

				$data['enquiry_id'] =$enq_id;
				
				$data['quotes_type'] = $activated[0]['enquiries']['quotes_type'];
				
				$quotes_type =$activated[0]['enquiries']['quotes_type'];
				
				if($quotes_type==1)
				{
				$Post_Subject = "Enquiry Post Successful. View Quotes for Your Enquiry $enq_id.";
				}else
				{
				$Post_Subject = "Enquiry Post Successful. View Your Enquiry $enq_id.";
				}
			
				//echo "Enquiry Sender: Id".$Enquiry_Sender_id;

				//echo "<br><pre>";print_r($data);echo "</pre>";//exit();				

				// $email->viewVars(array('data'=>$data));

				// $email->config('smtp')

				// ->template("leads_activated")

				// ->emailFormat('html')

				// ->from(array('info@xerve.in' => 'Xerve.in'))
				
				// ->to("$usrEmail")
				
				// //->to("smani8388@gmail.com")

				// ->bcc(array('info@xerve.in'))	

				// ->replyTo(array('support@xerve.in'))

				// ->subject("$Post_Subject")

				// //->send();

				// ->send();

				// $this->set("msg","Your account has been activated Successfully.");

				//Email Notification ends
	
				}

				
			
			   /* //To send email to every user belongs to the selection of this enquiry

				$Enq_category_id =$activated[0]['enquiries']['category_id'];

				$Enq_sub_category_id =$activated[0]['enquiries']['sub_category_id'];

				$Enq_city_id =$activated[0]['enquiries']['city_id'];

				

				$Enq_sub_category_name =$activated[0]['sub_categories']['sub_category_name'];

				$Enq_category_name =$activated[0]['categories']['category_name'];

				$Enq_city_name =$activated[0]['cities']['city_name'];

				
			   //To send email to every user belongs to the selection of this enquiry

				$Enquiry_Sender_detail = $this->Enquiry->query("SELECT distinct users.id, name_title, first_name, last_name, business_email, category_name, sub_category_name,designation, requirement_type, city_name,area_name,std_code,xxx,enquiries.mobile_number

					FROM enquiries, users, sub_categories, categories, cities, user_categories, areas

					WHERE enquiry_id='$enq_id'

					AND users.id = user_categories.user_id 

					AND user_categories.category_id = categories.id

					AND user_categories.sub_category_id = sub_categories.id

					AND user_categories.city_id = cities.id 

					AND user_categories.category_id = categories.id

					AND user_categories.sub_category_id = sub_categories.id

					AND user_categories.city_id = cities.id AND user_categories.area_id = areas.id 

					and users.id=$Enquiry_Sender_id GROUP BY users.id");

					

				 //echo "<br>usersslist<pre>";print_r($Enquiry_Sender_detail);echo "</pre>";

			   $Users_list = $this->Enquiry->query("SELECT distinct users.id, first_name, last_name, business_email,designation

				FROM users, user_categories

				WHERE user_categories.user_id = users.id and users.status=0 AND user_categories.deleted_flag=0

				AND user_categories.category_id='$Enq_category_id' AND user_categories.city_id='$Enq_city_id'");

			

			   //echo "<br>usersslist<pre>";print_r($Users_list);echo "</pre>";

			 //exit();

			

			//Array merge 

					
			ini_set('memory_limit', '700M');

			//echo "<br>Merged_array<pre>";print_r($Merged_array);echo "</pre>";

			set_time_limit(0);

			if(!empty($Users_list)){

			$email = new CakeEmail();

			foreach($Users_list as $userdata){

			if(!empty($userdata['users']['business_email'])){

				//$usrEmail =$userdata['users']['business_email'];

				$usrEmail =trim($userdata['users']['business_email']);

				$data['vendor_first_name'] =$userdata['users']['first_name'];

				$data['vendor_last_name'] =$userdata['users']['last_name'];

				}

				

					/*if(!empty($userdata['member_bases']['email_id'])){

				$usrEmail =trim($userdata['member_bases']['email_id']);

				$data['vendor_first_name'] =$userdata['member_bases']['first_name'];

				$data['vendor_last_name'] =$userdata['member_bases']['last_name'];

				}*/

				
                /*
				$data['sender_category'] =$Enquiry_Sender_detail[0]['categories']['category_name'];

				$data['sender_subcategory'] =$Enquiry_Sender_detail[0]['sub_categories']['sub_category_name'];

				$data['sender_city'] =$Enquiry_Sender_detail[0]['cities']['city_name'];

				$data['sender_std_code'] =$Enquiry_Sender_detail[0]['cities']['std_code'];

				$data['sender_area'] =$Enquiry_Sender_detail[0]['areas']['area_name'];

				$data['sender_type'] =$Enquiry_Sender_detail[0]['enquiries']['requirement_type'];
				
				$data['sender_quotes'] =$Enquiry_Sender_detail[0]['enquiries']['mobile_number'];
				
				$data['sender_designation'] =$Enquiry_Sender_detail[0]['users']['designation'];
				
				$data['sender_name_title'] =$Enquiry_Sender_detail[0]['users']['name_title'];
				
				$data['sender_call'] =$Enquiry_Sender_detail[0]['users']['xxx'];		

				

				//$data['sub_category_name'] =$activated[0]['sub_categories']['sub_category_name'];

				//$data['category_name'] =$activated[0]['categories']['category_name'];

				$data['enquiry_id'] =$enq_id;

				$data['subject'] =$msg1;

				$data['message'] =$msg2;
				
			//	$email = "enquiry@quality-web-programming.com"; // Invalid email address 
 
				// Set up regular expression strings to evaluate the value of email variable against
				$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
				// Run the preg_match() function on regex against the email address
				if (preg_match($regex, $usrEmail)) {
					// echo $email . " is a valid email. We can accept it.";
					 
					 $email->viewVars($data);

						$email->config('smtp')
		
						->template("vendor_lead_alert")
		
						->emailFormat('html')
		
						->from(array('info@xerve.in' => 'Xerve.in'))	
						
					    //trim($usrEmail);
					   
					    ->to("$usrEmail")
						
						//->to("info@xerve.in")
		
						->bcc(array('info@xerve.in'))									
		
						//->replyTo(array('support@xerve.in'))
		
						->subject("|WIN| $msg1 || New Client Enquiry $enq_id")
		
						->send();
					 
				} else { 
					//echo $usrEmail . " is an invalid email. Please try again.";
					 
					 $InvalidEmails  .= $usrEmail."<br>";
					 $data['InvalidEmails'] =$InvalidEmails;
					 
				} 
												

				

				

				}//foreach ends
				
				//Once loop ends send invalid email id 
				
				if(!empty($data['InvalidEmails'])){
				
				 $email->viewVars($data);

						$email->config('smtp')
		
						->template("invalid_email")
		
						->emailFormat('html')
		
						->from(array('info@xerve.in' => 'Xerve.in'))
		
						//->to("$usrEmail")
					   // trim($usrEmail);
						
						->to("info@xerve.in")
		
						->replyTo(array('support@xerve.in'))
		
						->subject("|WIN| In-Valid Emails found on while sending Enquiry $enq_id || $msg1")
		
						->send();
				}
				//Once loop ends send invalid email id ends

			}*/

			//Send Email to Registered Member ends
              
			$_SESSION['PaymentDone']='success';

				

			}
		
			}	// end lead management function start
				

				}
				
				$usrEmail = trim($activate[0]['users']['business_email']);				

				$email->viewVars(array('first_name' => $usrName,'last_name' => $lastName,'usrEmail' => $usrEmail,'usrId'=>$usrId,"enquiry_id" => $enq_id,'enquiry_subject' => $enquiry_subject,'company_name' => $company_name,'user_activated'=>$user_activated,'Message'=>'Your account has been successfully activated. Hope you get will get business.'));

				$email->config('smtp')

				->template($Email_Template)

				->emailFormat('html')

				->from(array('info@xerve.in' => 'Xerve.in'))

			    ->to("$usrEmail")
				
				//->to("smani8388@gmail.com")
				
				->bcc(array('info@xerve.in'))							
				
				->replyTo(array('support@xerve.in'))

				->subject($subject)

				->send();
				
				
				//echo $usrEmail;exit();

				$this->set("msg","Your account has been activated Successfully.");
                $this->set("FrmActivate","Yes");
				//Email Notification ends

				}else

					$this->set("msg","You would have Activated Your Account.");	

			}

			//exit();
			
			if(!empty($enq_id))
			{
			if($quotes_type==1)
			{
			$this->redirect('/myaccount');  
			}else{
			$this->redirect('/quotes/'.$enq_id); 
			} 
			}
			else
			$this->render('/Users/buyer_activated');

			//echo "<pre>";print_r($activated);echo "</pre>";

		}

	}


public function direct_enquiry($id=Null){

		$this->autoRender=false;

		$this->layout = "successful";

		

		if(!empty($id))

		{

			$this->loadModel('DirectEnquiry');
			$this->loadModel('Enquiry');
			$this->loadModel('BusinessListing');

			//echo "before :".$id;

			$id = mysql_escape_string($id);

			

			$enquiry = $this->Enquiry->query("select enquiry_id,vendor_ID,original_subject,ListingCity_Combo,ListingCat_Combo,ListingSCat_Combo,activated,date_format(created_date,'%e %M %Y - %l:%i %p') AS created,created_date,activation_code,offer_id from enquiries where enquiries.activation_code='$id' order by created_date desc limit 1");
			
			$enq_id=$enquiry[0]['enquiries']['enquiry_id'];
			$Company_ID=$enquiry[0]['enquiries']['vendor_ID'];
			$Offer_Id=$enquiry[0]['enquiries']['offer_id'];
			/*$this->loadModel('Enquiry');
			$activatednew = $this->Enquiry->query("select id,enquiry_id from enquiries where user_id=$act");

			print_r($activated);*/
			
			$activated = $this->DirectEnquiry->query("select enquiry_id,first_name,last_name,email_id from direct_enquiries where enquiry_id='$enq_id'");
			
			$Listing_Details=$this->BusinessListing->query("select company_name from business_listings where user_id=$Company_ID");
			
			$Vendor_company=$Listing_Details[0]['business_listings']['company_name'];
			
			if(!empty($Offer_Id))
			{
			
			$this->loadModel("OfferListingDetail");	
			
			$Vendor_Details = $this->OfferListingDetail->query("select user_id,company_name from offer_listing_details where offer_id='$Offer_Id'");
				
			$Vendor_company = $Vendor_Details[0]['offer_listing_details']['company_name'];
			
			}
			
			//User_Id=$activated['users'][''];
            //echo $enq_id;
			//echo "<pre>";print_r($activated);echo "</pre>";exit();
			//echo "<pre>";print_r($Vendor_company);echo "</pre>";exit();

			if(!empty($enquiry)){

				if(!empty($enq_id) && empty($enquiry[0]['enquiries']['activated']))

				{

				$this->Enquiry->query("update enquiries set activated='1' where activation_code='$id' and enquiry_id='$enq_id'");

				$email = new CakeEmail();
				
				$usrId=$activated[0]['direct_enquiries']['enquiry_id'];

				$usrEmail =$activated[0]['direct_enquiries']['email_id'];

				$usrName =$activated[0]['direct_enquiries']['first_name'];

				$lastName =$activated[0]['direct_enquiries']['last_name'];

				//$company_name = $activated[0]['direct_enquiries']['company_name'];

				//$User_Type = $activated[0]['direct_enquiries']['requirement_type'];
				
           
				$Email_Template = "direct_enquiry_activated";

				$subject = "Received Your Direct Enquiry || $enq_id Under Review";

				//echo $usrId;exit();
               				

				//echo "<pre>dfdf";print_r($enquiry);echo "</pre>";exit();

				if(!empty($enquiry )){

				$enquiry_subject = $enquiry[0]['enquiries']['original_subject'];


				// $email->viewVars(array('first_name' => $usrName,'last_name' => $lastName,'usrEmail' => $usrEmail,'usrId'=>$usrId,'enquiry_subject' => $enquiry_subject,'activated'=>$activated,'enquiry'=>$enquiry,'Vendor_company'=>$Vendor_company, 'Offer_Id' =>$Offer_Id));

				// $email->config('smtp')

				// ->template($Email_Template)

				// ->emailFormat('html')

				// ->from(array('info@xerve.in' => 'Xerve.in'))

				//  ->to("$usrEmail")
				
				//  //->to("smani8388@gmail.com")
				
				// ->bcc(array('info@xerve.in'))								
				
				//  ->replyTo(array('support@xerve.in')) 

				// ->subject($subject)

				// ->send();

				$this->set("msg","Your account has been activated Successfully.");
                $this->set("FrmActivate","Yes");
				//Email Notification ends

				
				}

				

				}


				}else

					$this->set("msg","You would have Activated Your Account.");	

			

			}

			

			$this->render('/Users/enquiry_activated');  

			

			//echo "<pre>";print_r($activated);echo "</pre>";

		}


	public function activate($id=Null){

		$this->autoRender=false;

		$this->layout = "successful";

		

		if(!empty($id))

		{

			$this->loadModel('User');

			//echo $id;

			$id = mysql_escape_string($id);

			//echo $id;

			$activated = $this->User->query("select id,first_name,business_email,last_name,business_email,activated,user_type,company_name from users where users.activation_code='$id'");
			
			$act=$activated[0]['users']['id'];
			
			
			/*$this->loadModel('Enquiry');
			$activatednew = $this->Enquiry->query("select id,enquiry_id from enquiries where user_id=$act");

			print_r($activated);*/
			
			//echo $act;
			
			
			//User_Id=$activated['users'][''];
			
			$this->loadModel('Enquiry');
				
				$user_activated = $this->Enquiry->query("SELECT enquiry_id,category_name, sub_category_name, city_name,original_subject,date_format(created_date,'%e %M %Y - %l:%i %p') AS created_date,created_date

				FROM enquiries, sub_categories, categories, cities

				WHERE  enquiries.category_id = categories.id

				AND enquiries.sub_category_id = sub_categories.id

				AND enquiries.city_id = cities.id

				AND user_id=$act");
				
				$enq_id=$user_activated[0]['enquiries']['enquiry_id'];
				
			  //echo "<pre>";print_r($user_activated);echo "</pre>";exit();

			if(!empty($activated)){

				

				if(!empty($activated[0]['users']['id']) && empty($activated[0]['users']['activated']))

				{

				

				$this->User->query("update users set activated='1',sms_activated='1',free_displays=1 where activation_code='$id' and id=".$activated[0]['users']['id']);

				

				//Email Notification to user

				/* $this->Components->load('Email');

				 *///App::uses('CakeEmail', 'Network/Email');

				$email = new CakeEmail();
				
				$usrId=$activated[0]['users']['id'];

				$usrEmail =$activated[0]['users']['business_email'];

				$usrName =$activated[0]['users']['first_name'];

				$lastName =$activated[0]['users']['last_name'];

				$company_name = $activated[0]['users']['company_name'];

				$User_Type = $activated[0]['users']['user_type'];
				
                
				
				

				$Email_Template = "vendor_activated";

				$subject = "Your Seller Account XRV$act Activation Successful. Get 200 Credits for Free.";

				$enquiry_subject ="";

				if($User_Type==1){

				$Email_Template = "client_activated";

				$subject = "|WIN| Received Your Enquiry || $enq_id Under Review";

				

				$enquiry = $this->User->query("select original_subject from enquiries where user_id=".$activated[0]['users']['id']);

				//echo "<pre>";print_r($enquiry);echo "</pre>";

				if(!empty($enquiry )){

				$enquiry_subject = $enquiry[0]['enquiries']['original_subject'];

				

				}

				

				}

				

				// $email->viewVars(array('first_name' => $usrName,'last_name' => $lastName,'usrEmail' => $usrEmail,'usrId'=>$usrId,'enquiry_subject' => $enquiry_subject,'company_name' => $company_name,'user_activated'=>$user_activated,'Message'=>'Your account has been successfully activated. Hope you get will get business.

				// 		'));

				// $email->config('smtp')

				// ->template($Email_Template)

				// ->emailFormat('html')

				// ->from(array('info@xerve.in' => 'Xerve.in'))

				// ->to("$usrEmail")

				// //->to("smani8388@gmail.com")
				
				// //->to("info@xerve.in")
				
				//  ->bcc(array('info@xerve.in'))									
				
				//  ->replyTo(array('support@xerve.in'))

				// ->subject($subject)

				// ->send();

				$this->set("msg","Your account has been activated Successfully.");
                $this->set("FrmActivate","Yes");
				//Email Notification ends

				

				}else

					$this->set("msg","You would have Activated Your Account.");	

			

			}

		if($this->Auth->user('id'))
		{
		$UserStatus = $this->Auth->user('status');
		$this->set("UserStatus",$UserStatus);
		}
			

			$this->render('/Users/user_activated');

			

			//echo "<pre>";print_r($activated);echo "</pre>";

		}

	}
 public function unique_count(){

      $this->loadModel('Userclick');
        $this->layout = false;
        $this->autoRender = false;
        $click_day=date('Y-m-d');
        $click_time = date('Y-m-d H:i:s');
        $unique_ip=$this->request->data['unique_ip'];

        $page = $this->request->params['pass'][0];
        $channel = $this->request->params['pass'][1];

        //echo json_encode($page);
        
        $channel = $this->Cookie->read('WINChannel');
        $subchannel = $this->Cookie->read('WINChannel_type_sub');
			

        $id=$this->request->data['id'];
		
        if($id==1){
                $top=1;
$count_top = $this->Userclick->find('count', array( 'conditions' => array('ip' => $unique_ip,'Userclick.top'=>1,'day' =>$click_day)));                
        }
        if($id==2){
        	
                $con=1;
$count_con = $this->Userclick->find('count', array( 'conditions' => array('ip' => $unique_ip,'Userclick.con'=>'1','day' =>$click_day))); 
           
        }
       if($id==3){
                $outcon=1; 
$count_outcon = $this->Userclick->find('count', array( 'conditions' => array('ip' => $unique_ip,'Userclick.outcon'=>1,'day' =>$click_day)));

        }
        
        
if((($count_top==0)||($count_top=='')||($count_top==null))AND ($top==1)){
                 $clicks=1;
                  
  if($unique_ip!=0){
      $ins_query="INSERT INTO user_join_clicks SET ip='".$unique_ip."',top='".$top."',day='".$click_day."',daytime='".$click_time."',clicks='".$clicks."',page='".$page."',channel='".$channel."',channel='".$channel."'";
      
      $this->Userclick->query($ins_query);
  }
}
if((($count_con==0)||($count_con=='')||($count_con==null))AND ($con==1)){
                 $clicks=1;
                  
  if($unique_ip!=0){
      $ins_query="INSERT INTO user_join_clicks SET ip='".$unique_ip."',con='".$con."',day='".$click_day."',daytime='".$click_time."',clicks='".$clicks."',page='".$page."',channel='".$channel."',subchannel='".$subchannel."'";
    
      
      $this->Userclick->query($ins_query);
  }
}
if((($count_outcon==0)||($count_outcon=='')||($count_outcon==null))AND ($outcon==1)){
                 $clicks=1;
                  
  if($unique_ip!=0){
      $ins_query="INSERT INTO user_join_clicks SET ip='".$unique_ip."',outcon='".$outcon."',day='".$click_day."',daytime='".$click_time."',clicks='".$clicks."',page='".$page."',channel='".$channel."',subchannel='".$subchannel."'";
      
      $this->Userclick->query($ins_query);
  }
}

}       
	

}

