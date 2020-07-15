<?php
App::uses('AppController', 'Controller');
class GenieController extends AppController {
   var $uses = array('Lead');   
   function beforeFilter() { 
    parent::beforeFilter();
    if($_SERVER['REMOTE_ADDR']=='49.207.54.6'){
         // Configure::write('debug',2);
    }
    $this->Auth->allow('getAreas','index','getSubcategories','ajaxadd','mark_read','check_lead_paid','getcreditsajax','get_sidid','chatlogoff','chatlogin','verify_guest_otp','unique_count','resend_otp','getoffers','preloginajaxadd','getsub_faq','join_genie_sms','offer_marker','form_submit','verify_guest_otp_inner','direct_enquiry','getDiffSellerList','prelogin_direct','get_catcitycombo','get_city_cat_combo');
  }
    public function index($Start_Name=0,$Comp = 'full'){
      $Yes_Full = 0;

      if (!strstr($Start_Name, 'XRVL')) {
        $this->loadModel('GenieUser');
        $actual_link = 'https://'.$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI'];
        $this->set("actual_link",$actual_link);
        require_once 'Mobile_Detect.php';
        $detect = new Mobile_Detect;
          if ( $detect->isMobile() ) {
            $device_value = 'Mobile';
            $device = 'Mobile';
            $this->set('device',$device);
          }
          else if($detect->isTablet()){
            $device_value = 'Tablet';
            $device = 'Tablet';
            $this->set('device',$device);
          }   

            if (!empty($this->request->query['wish'])){
                    $this->set("wish",$this->request->query['wish']);
            }
            if (!empty($this->request->query['title'])){
                $genie_title = $this->request->query['title'];
                if (!empty($this->request->query['url'])){
                    $genie_url = $this->request->query['url'];
                    $chat_url = $genie_url; 
                    $apiKey = 'AIzaSyCCe-FLs8hLmMb1CgoAEbNoMFTXiuJAZaQ';
                    $postData = array('longUrl' => $chat_url, 'key' => $apiKey);
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
                    $genie_url = $shortLink_buyer['id'];
              }
              if (!empty($this->request->query['channel'])){
                  $this->set("channel_type",$this->request->query['channel']);
                  $channel_value_array = explode('-', $this->request->query['channel']);
                  $channel_with_sub    = explode('-', $channel_value_array);
                  $channel_1 = $channel_value_array[1];
                  $channel_sub = $channel_value_array[2];
                  $this->Cookie->write('WINChannel', $channel_1, false, 86400);
                  $this->Cookie->write('WINChannel_type', $this->request->query['channel'], false, 86400);
                  $this->Cookie->write('WINChannel_type_sub', $channel_sub, false, 86400);
              }
              else{
                    if($this->request->query['wish']==''){
                      $this->set("channel_type",'g-0');
                    }else{
                      $this->set("channel_type",'g-2');
                    }
              }
              if (!empty($this->request->query['select_type']))
                   $select_type = $this->request->query['select_type'];
                    if (empty($select_type)) {
                        $this->set("genie_title",'I want '.$genie_title);                  
                    }else{
                        $this->set("genie_title",$genie_title);
                    }
                    $this->set("genie_url",$genie_url);
              }
              else{
                      $category_list=explode('/',$_SERVER['REQUEST_URI']);
                      $category = str_replace("-", " ", $category_list[2]);
                      $category = str_replace("category", "", $category);
                      $category_url =trim($category);
                      $this->set("category_url",$category_url);
                      $_SERVER['REQUEST_URI']="https://www.xerve.in/genie";
              }
               
   if($this->request->query['channel']=='ch-11'||$this->request->query['channel']=='ch-14-11'||$this->request->query['channel']=='ch-14-12'||$this->request->query['channel']=='ch-14-13'||$this->request->query['channel']=='ch-8-11'){
           $this->Auth->logout();
           $campaign=2;
          
    }
    else if(($this->request->query['pg']==2)||($this->request->query['channel']=='ch-1-11')){
            $this->Auth->logout();
            $pg = $this->request->query['pg'];
            $campaign=1;
            
            $this->set("pg",2);
            $this->set("channel_type",'ch-1-11');
    }
    else{
            $campaign=3;
    }
              $this->set("campaign",$campaign);
              
               if (!empty($this->request->query['cat_type'])){//2: mobiles
                  $cat_type=$this->request->query['cat_type'];
                  $this->set("camp_cat_type",$cat_type);
               }
               if (!empty($this->request->query['budget']))
                $budget = $this->request->query['budget'];
               if (!empty($this->request->query['quantity']))
                $quantity = $this->request->query['quantity'];
               if (!empty($this->request->query['second_time'])){
                 $second_time = $this->request->query['second_time'];
                 $this->set("second_time",$second_time);
               }
               if (!empty($this->request->query['check_eq_id'])){
                 $check_eq_id = $this->request->query['check_eq_id'];
                          $code=$this->Lead->getotp($check_eq_id);
                          $this->set("check_cd_code",$code[0]['quotes']['genie_verify_code']);
                          $this->set("check_eq_id",$check_eq_id);
               }
               if (!empty($this->request->query['check_mb_no'])){
                 $check_mb_no = $this->request->query['check_mb_no'];
                 $this->set("check_mb_no",$check_mb_no);
               }
                if (!empty($budget)) {
                    $this->set("budget",$budget);   
                }
                if (!empty($quantity)) {
                    $this->set("quantity",$quantity);                  
                }
                if (!empty($this->request->query['latitude']) AND(!empty($this->request->query['longitude']))){
                    $this->set("latitude",$this->request->query['latitude']);
                    $this->set("longitude",$this->request->query['longitude']);
                    $details=$this->GenieUser->get_full_address($this->request->query['latitude'],$this->request->query['longitude']);
                    
                    $address=$details[0]['areas']['area'].', '.$details[0][cities][city];
                    $this->set("area",$details[0]['areas']['area']);
                    $this->set("city",$details[0]['cities']['city']);
                    $this->set("state",$details[0]['state_lists']['state']);
                    $this->set("country",$details[0]['countries']['country']);
                    $this->set("address",$address);
                } 
                
               $User_Id = $this->Auth->user('id');
               $store_str = '';
				       $store_str1 = '';
              if($genie_title==''){ 

                      $this->loadModel('Quotecategory');
                      $this->loadModel('Quotecity');
                      $OfferCategory_List_product=$this->Quotecategory->get_offer_category_list();
                      $Genie_Category = array('Product' => 'Products Category') + $OfferCategory_List_product;
                      $this->set('Genie_Category',$Genie_Category);
                
                      $City_List = $this->Quotecity->get_city_list();
                      $this->set('City_List',$City_List);
                
                    /*genie form updation*/
                    if($this->request->query['enquiry_id']){
                           $details=$this->Lead->get_quote_full_details($this->request->query['enquiry_id']);
                           $country='India';
                           $genie_up_flag=1;
                           $address=$details[0][quotes][zone_buy].', '.$details[0][quotes][city_buy];
                           $this->set("genie_title",$details[0]['quotes']['productspec']);
                           $this->set("area",$details[0]['quotes']['zone_buy']);
                           $this->set("city",$details[0]['quotes']['city_buy']);
                           $this->set("state",$details[0]['quotes']['state_buy']);
                           $this->set("country",$country);
                           $this->set("budget",$details[0]['quotes']['budget']);
                           $this->set("quantity",$details[0]['quotes']['quantity']);
                           $this->set("address",$address);
                           $this->set("genie_up_flag",$genie_up_flag);
                           $this->set("genie_up_user_id",$details[0]['quotes']['user_id']);
                           $this->set("genie_up_guest_type",$details[0]['quotes']['guest_flag']);
                           $this->set("genie_up_member_type",$details[0]['quotes']['user_mode']);
                           $this->set("latitude",$details[0]['quotelocations']['latitude_buy']);
                           $this->set("longitude",$details[0]['quotelocations']['longitude_buy']);
                           $this->set("address",$address);
                           $this->set("quote_id",$details[0]['quotes']['quoteid']);
                           $this->set("b2c",$details[0]['quotes']['b2c']);
                    }
                   /*eof genie form updation*/
                    if (!empty($User_Id)) {
                        $store_str .="" . $User_Id;
    					          $store_str1 .="" . $User_Id;
                    } else {
                        $store_str .="5";
    					          $store_str1 .="5";
                    }			
            				$USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
                  
            				if (stripos(strtolower($USER_AGENT),"bot/") !== false || stripos(strtolower($USER_AGENT),"crawler") !== false)
            					$crowler = "Crawler"; 
            				else
            					$crowler = "Direct";
            			
            				if($crowler=='Direct')
            				{
            					$store_str1 .= "{" . $_SERVER['REMOTE_ADDR'] . "{" . date('Y-m-d H:i:s') . "{" . urldecode($_SERVER['REQUEST_URI']) . '{' . $device_value. '{' . $crowler. "{" . $USER_AGENT;
            					
            				}else{
            					$store_str .= "{" . $_SERVER['REMOTE_ADDR'] . "{" . date('Y-m-d H:i:s') . "{" . urldecode($_SERVER['REQUEST_URI']) . '{' . $device_value. '{' . $crowler. "{" . $USER_AGENT;
            				}
                    $file_read = '/var/www/html/app/webroot/user_details/search_file_count.txt';
                    $file_rd = fopen($file_read, "r");
                    $file_read_count = fread($file_rd, "10");
                    fclose($file_rd);
            				$file_read1 = '/var/www/html/app/webroot/new_user_details/search_file_count.txt';
            				$file_rd1 = fopen($file_read1,"r");
            				$file_read_count1 = fread($file_rd1,"10");
            				fclose($file_rd1);
                    if (!empty($file_read_count)) {
                        $file_app = '/var/www/html/app/webroot/user_details/search_text' . $file_read_count . '.txt';
                        $myfile = fopen($file_app, "a");
                        fwrite($myfile, "\n" . $store_str);
                        fclose($myfile);
              					if($crowler=='Direct')
              					{				
              						$file_app1 = '/var/www/html/app/webroot/new_user_details/search_text' . $file_read_count1 . '.txt';
              						$myfile1 = fopen($file_app1, "a");
              						fwrite($myfile1, "\n" . $store_str1);
              						fclose($myfile1);				
              					}
                    }
              }
        $this->set("title_for_layout", "Xerve Genie");
        $this->set('description_for_layout','Wish-Get Quotes-Compare-Buy! Xerve Genie helps you get options and quotes for all your personal and office needs instantly. Ask Genie & receive exclusive deals in fashion, mobiles, restaurants & pubs, electronics, furniture, IT & office supplies and much more from local sellers nearby. It gets you the best money saving deals by connecting you with interested vendors easily.Post your requirement and get the best deal now!!');
        $this->layout = 'genie_layout';
    }
    else{
      //configure::write('debug',2);
            $Yes_Full=1;
            $For = $Comp;
            $back_path=$this->referer();
            $back=substr($back_path,26,35);
            $b1=substr($back,0,16);
            $b2=substr($back,20,35);
            //$this->loadModel('User');
            $this->loadModel('GenieUser');
            $this->loadModel('Quotebid');
            $this->loadModel('Quotecategory'); 
            $this->loadModel('SubCategory');
            $this->loadModel('Jchat');
            $enquiry_id = $this->request->params['pass'][0]; //enquiry id
            $sidid  = $this->request->params['pass'][1];//sid id
            $sms_buyer_id  = $this->request->params['pass'][2];// seller id
            
            if($sms_buyer_id!=''){//if url from email
              if($sms_buyer_id =='disable'){
                $disable ='disable';
              }else{
                $mark_read_msg=1;
              }
            }
            if($this->request->params['pass'][3]!=''){//rare condition from admin link
                          $disable  = $this->request->params['pass'][3];
            }
            if($disable =='disable'){
              $this->set('disable',$disable);
            }
            
            $quotes=$this->Lead->get_full_quotes($enquiry_id);
            $browser=$this->get_browser();
         
            $quoteid=$quotes['Lead']['quoteid'];
            $guest_flag=$quotes['Lead']['guest_flag'];
            $b2c=$quotes['Lead']['b2c'];
            $quoted_user=$quotes['Lead']['user_id'];//get the quoted user id //buyer
            $quantity=$quotes['Lead']['quantity']; 
            $budget=$quotes['Lead']['budget'];  
            $zone_buy=$quotes['Lead']['zone_buy']; 
            $city_buy=$quotes['Lead']['city_buy']; 
            $full_name=$quotes['Lead']['full_name']; 
            $sel_cat_id=$quotes['Lead']['cat_id'];
            $genie_url=$quotes['Lead']['genie_url'];
            if($genie_url==''){
                 $tot_bud=$budget;
            }
            else{
                 $tot_bud=$quantity * $budget; 
            }
            $today = date('Y-m-d');
            $chat_msg_time = date('Y-m-d H:i:s');
           
          /*for left tab elements*/
           
            $category_credits=$this->Quotecategory->getCategory_Credits($quotes['Lead']['cat_id']);
            
            $check_seller_category=$this->check_seller_category($User_Id,$quoteid);
            
            $CategoryName=$this->Quotecategory->get_category_list($quote_id);
           
            $SubCategoryName=$this->SubCategory->get_quote_subcategory($quotes['Lead']['quoteid']);
            
            /*eof for left tab elements*/
            if(($b2!='') AND (strlen($b2)==10)){
                  $sid_flag=1;
                  $this->set('sid_flag',$sid_flag);
            }
            if($sms_buyer_id != ''){
                $receiver =$quoted_user;
                $buyerstatus=$this->GenieUser->get_seller_status($receiver);    
            }
            else
            {
                 $receiver= $this->Auth->user('id'); 
                 $buyerstatus= $this->Auth->user('status');
            }
            $sidsellerid=$this->GenieUser->get_offline_seller_id($sidid);
            $userid=$sidsellerid;

            $users_result=$this->GenieUser->get_user_details($userid,$quoted_user);
            $buyername_query=$this->GenieUser->get_user_basic_details($quoted_user);
            $new_buy_title = $buyername_query[0]['users']['name_title']; 
            if(($new_buy_title==1)||($new_buy_title=='')){
              $new_buy_title="Mr.";
            }
            else{
              $new_buy_title="Miss.";
            }
            $new_buy_fname = $buyername_query[0]['users']['first_name']; 
            $new_buy_lname =  $buyername_query[0]['users']['last_name']; 
            $new_buy_cname =  $buyername_query[0]['users']['company_name']; 
            if($b2c==1){
               if($full_name==''){
                   $new_tot_name=$new_buy_title." ".$new_buy_fname;
               }
               else{
                   $new_tot_name=$full_name;
               }
            }
            else{
                $new_tot_name=$new_buy_cname;
            }
            
            $first_msg_status=$this->Jchat->first_msg_status($quoteid,$sms_buyer_id,$quoted_user);
            
            $sellername=$this->GenieUser->get_full_name($sidsellerid);
            $sid_vendorname=$this->GenieUser->get_company_name($sidsellerid);
          
            /* marking message as read*/
             $leads_down= $this->Quotebid->lead_download($userid,$quoteid);
             $website=$this->Quotebid->get_website($userid,$quoteid);
                
             $productspec_sms=$quotes['Lead']['productspec'];
             $productspec_sms=substr($productspec_sms, 0, 10);
             $mobile_number_sms=$this->GenieUser->get_mobile($userid);
             if(($b1=="/enquiry_details")||($mark_read_msg==1)){
                $update_date = date('Y-m-d H:i:s');
                $unread_status=$this->Jchat->get_msg_status_time($quoteid,$userid,$receiver);
                if($unread_status[0]['messages']['status'] =='unread'){
                        $msg_intro_prev_time = strtotime($unread_status[0]['messages']['time']);
                        if ((time() - $msg_intro_prev_time) > 300) {
                         $send_sms=1;
                         $this->Jchat->up_msg_read_stat_2($update_date,$enquiry_id,$userid,$receiver,$backpath);
                        }
                        if($mobile_number_sms !=0){
                            $chat_url = 'https://www.xerve.in/leads/'.$enquiry_id.'/'.$sidsellerid.'/'.$receiver;   
                            $apiKey = 'AIzaSyCCe-FLs8hLmMb1CgoAEbNoMFTXiuJAZaQ';
                            $postData = array('longUrl' => $chat_url, 'key' => $apiKey);
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
                            $chat_url = $shortLink_buyer['id'];
                   /*eof short url for sending sms*/
$sms_message = "Customer: '$new_tot_name' just read Your Message.
Enquiry: $productspec_sms...
Enquiry Id: $enquiry_id
Enquiry Link: $chat_url
Best Regards,
Xerve Team.
www.xerve.in";
                            $mobile=$mobile_number_sms;
                            $to = urlencode($mobile);
                            $sms_message=urlencode($sms_message);
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
                              $url="http://alerts.solutionsinfini.com/api/web2sms.php?workingkey=A5d8f4c8c48eb27a2b0e14ae549b76ce5&sender=iXERVE&to=$to&message=$sms_message&type=json";
                              $ch=curl_init();
                              curl_setopt($ch, CURLOPT_URL, $url);
                              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                              if($send_sms==1){
                                  // $output=curl_exec($ch);
                             }
                              curl_close($ch);
                          }//valid mobile                                          
                     /*sms functionality*/
                }//unread
                else{
                }
                   /*sms functionality*/
             }  
              $this->Jchat->up_msg_read_stat($update_date,$enquiry_id,$userid,$receiver,$backpath);
                 if($disable ==''){
                                      if($send_sms==1){
                                          //$this->Lead->query($mark_read_msg_query);
                                     }
                  }                     
              $this->Lead->up_push_st_2($enquiry_id,$userid,$receiver);
              $this->Quotebid->up_quotebids_deduct_1($enquiry_id,$userid,$update_date);
                                      
            /* eof marking message as read*/
              $view_seller_contact=$this->GenieUser->view_contact($userid);
              $view_buyer_contact=$this->GenieUser->view_full_contact($quoted_user,$guest_flag);
              $seller_loc_result=$this->GenieUser->get_user_loc_details($userid);
              $seller_city=$seller_loc_result[0]['cities']['city_name'];
              $seller_area=$seller_loc_result[0]['areas']['area_name'];
              if($seller_area!=''){
                $seller_loc=$seller_area.', '.$seller_city;
              }
              else{
                  $seller_loc=$seller_city;
              }
              if($zone_buy != ''){
                    $buyer_loc = $zone_buy.', '.$city_buy;
               }
               else{
                    $buyer_loc=$city_buy;
               }
              
              $result=$this->GenieUser->set_user_sessionStatus($receiver,'ONLINE');
              $serverid = $this->GenieUser->get_user($userid, 'ID');
              $server_username = ucfirst($this->GenieUser->get_user($userid, 'USERNAME'));
              $server_status=$this->GenieUser->get_onlinestatus($userid);
              $ServerLastTime=$this->GenieUser->get_session_time($userid);
              if($guest_flag ==0){
                    $clientID = $this->GenieUser->get_user($receiver, 'ID');
                    $msg_cnt= $this->Jchat->getmsgcnt($clientID,$serverid,$quoteid);
                    $clientNAME = ucfirst($this->GenieUser->get_user($receiver, 'USERNAME'));
                    $client_status=$this->GenieUser->get_onlinestatus($receiver);
              }
              else{
                    $clientID = $receiver;
                    $msg_cnt= $this->Jchat->getmsgcnt($clientID,$serverid,$quoteid);
                    $client_status=$this->GenieGuest->get_onlinegueststatus($receiver);
                    $clientNAME = " Customer ";
              }
               
                $LastTime=$this->GenieUser->get_session_time($serverid);
                if($clientID != $quoted_user){//seller
                  $sellerid=$clientID;
                }
                else{//buyer
                  $sellerid=$serverid;
                }  
                $sellername=$this->GenieUser->get_full_name($sellerid);
                $sid_vendorname=$this->GenieUser->get_company_name($sellerid);
                $seller_mobile_no=$this->GenieUser->get_mobile($sellerid);
                
              if($clientID != $quoted_user){
                  $chat_intro=$this->Jchat->getchatintro($quoteid,$clientID);
              }
              $credit_balance=$this->GenieUser->credit_balance($clientID);
              
              $b2c=$quotes['Lead']['b2c'];
              $cat_id=$quotes['Lead']['cat_id'];
              
              $check_seller_category=$this->check_seller_category($clientID,$quoteid);
              $category_type=$this->Quotecategory->getCategory_type($quotes['Lead']['cat_id']);
                   
                  $form_id=$this->Lead->get_formid($quoteid);
                  if($sellerid != ''){
                          $quoteprice=$this->Quotebid->get_formprice($sellerid,$quoteid);
                          $quoteoffers=$this->Quotebid->get_formoffers($sellerid,$quoteid);
                          $this->set(compact('quoteprice'));
                          $this->set(compact('quoteoffers'));
                  }
                  $productspec= $quotes['Lead']['productspec'];
                  $productmask= $quotes['Lead']['productmask'];
                  $leads_down= $this->Quotebid->lead_download($userid,$quoteid);
                  $mask=$this->mask_field($productspec,$productmask);
                  $quote_status=$quotes['Lead']['status'];
                  $buying_date=$quotes['Lead']['pause_time'];
                  $buying_date=$quotes['Lead']['buyingdate'];
                  $expiry_date= $buying_date;

                  $this->set('quotes',$quotes);
                  $this->set('category_credits', $category_credits);
                  $this->set('check_seller_category',$check_seller_category);
                  $this->set(compact('CategoryName'));
                  $this->set(compact('SubCategoryName'));
                  $this->set('enquiry_id',$enquiry_id);
                  $this->set('sid_id',$sidid);
                  $this->set('browser',$browser);

                  $this->set('today',$today);
                  $this->set('chat_msg_time',$chat_msg_time);
                  $this->set('full_name',$full_name);
                  $this->set('sel_cat_id',$sel_cat_id);
                  $this->set('budget',$budget);
                  $this->set('quantity',$quantity);
                  $this->set('genie_url',$quotes['Lead']['genie_url']);
                  $this->set('tot_bud',$tot_bud);
                  $this->set('first_msg_status',$first_msg_status);
                  $this->set('customer_name',$new_tot_name);
                  $this->set('quoted_user',$quoted_user);
                  $this->set('sid_vendorname', $sid_vendorname);
                  $this->set('Vendor_Name', $sellername); 
                  $this->set('leads_down',$leads_down);  
                  $this->set('website',$website);  
                  $this->set('seller_loc',$seller_loc);
                  $this->set('buyer_loc',$buyer_loc);
                  $this->set(compact('view_seller_contact'));
                  $this->set(compact('view_buyer_contact'));
                  $this->set('buyerstatus',$buyerstatus); 
                  $this->set('sender',$userid);         
                  $this->set('quoteid',$quoteid);
                  $this->set(compact('msg_cnt'));
                  $this->set(compact('guest_flag'));
                  $this->set('seller_mobile_no',$seller_mobile_no);
                  $this->set('Vendor_Name', $sellername);
                  $this->set('sid_vendorname', $sid_vendorname);  
                  $this->set(compact('chat_intro','sellerid','credit_balance')); 
                  $this->set(compact('credit_enabled'));
                  $this->set('category_credits', $category_credits);
                  $this->set('check_seller_category',$check_seller_category);
                  $this->set('leads_down',$leads_down);
                  $this->set(compact('productmask'));
                  $this->set(compact('productspec'));
                  $this->set(compact('mask'));       
                  $this->set(compact('form_id')); 
                  $this->set(compact('b2c'));
                  $this->set(compact('quote_status'));
                  $this->set(compact('pause_time'));
                  $this->set(compact('buying_date'));
                  $this->set(compact('expiry_date'));    
                  $messages_ids = $this->Jchat->get_messages_id($userid,$receiver,$quoteid);
                        foreach($messages_ids as $key=>$value){
                          $userstatus=$this->GenieUser->get_seller_status($value['messages']['user_id']);
                          $messages_ids[$key]['messages']['user_status'] = $userstatus;
                        }
                        //print_r($messages_ids);
                  $this->set(compact('messages_ids')); 
        // Check if is client or server
                 $this->set(compact('serverid','server_username','server_status','ServerLastTime'));   
                 $this->set(compact('clientID','clientNAME','LastTime','client_status'));
                 $this->set('description_for_layout','Wish-Get Quotes-Compare-Buy! Xerve Genie helps you get options and quotes for all your personal and office needs instantly. Ask Genie & receive exclusive deals in fashion, mobiles, restaurants & pubs, electronics, furniture, IT & office supplies and much more from local sellers nearby. It gets you the best money saving deals by connecting you with interested vendors easily.Post your requirement and get the best deal now!!');
                 $this->layout = 'quotelayout';
          }//chat page
         $this->set('Yes_Full', $Yes_Full);
    }
    public function check_seller_category($seller_id,$quoteid){
      $quote_cat_id=$this->Lead->get_catid($quoteid);
      $result=$this->GenieUser->get_bl_cat_id($seller_id,$quote_cat_id);
      $found=COUNT($result);
      return $found;
    }
  // masking a field
    public function mask_field($enquiry,$maskingfield) {
      $m=explode("#",$maskingfield);
      $spec=$enquiry;
      $i=0;
      while($i<count($m)){
            if($i==0){
            $p=str_replace($m[$i], " xxxxx ",$spec );
             }
          else{
            $p=str_replace($m[$i], " xxxxx ",$p );
            }
            $i++;
      }
        return $p;
    }// masking a field

public function get_paused_username($quoteid){
  $this->loadModel('GenieUser');
  $userid=$this->Lead->get_quoteuser($quoteid);
  $b2c=$this->Lead->get_b2c($quoteid);
  $userstatus=$this->GenieUser->get_seller_status($userid);
       if($userstatus == 1){ //buyer
             $full_name=$this->GenieUser->get_full_name($userid);
       } 
       else{//seller
              if($b2c==1){//personal
                    $full_name=$this->GenieUser->get_full_name($userid);
              }
              else{ //business
                    $full_name=$this->GenieUser->get_company_name($userid);
              }
       } 
       //$full_name="nnn";
    return $full_name;   
 }

 public function link_for_seller($quoteid){
      $this->loadModel('GenieUser');
      $b2c=$this->Lead->get_b2c($quoteid);
      $userid=$this->Lead->get_quoteuser($quoteid);
      $userstatus=$this->GenieUser->get_seller_status($userid);
      if($userstatus ==0){
                          if($b2c == 2){
                            $need_link=1; //seller with b2b
                          }else{
                            $need_link=0;
                          }
      }
    return $need_link;
 }
// get the pause time of a quote

public function enquiry_details($id=null) {
  //Configure::write('debug',2);
  $this->loadModel('GenieUser');
  $this->loadModel('Quotebid');
  $this->loadModel('Quotecity');
  $this->loadModel('Quotecategory'); 
  $this->loadModel('Quotearea');
  $parts = parse_url($this->referer());
  $this->set('backpath', $parts['path']); 
  $buyer_id = $this->Auth->user('status');
  $this->set('buyer_id', $buyer_id);//seller or buyer flag
  $User_Id = $this->Auth->user('id');
  $customer_name=$this->GenieUser->get_username($User_Id);
  $enquiry_id=$id;
  $quoteid=$this->Lead->get_quoteid($enquiry_id);
  $quoted_user=$this->Lead->get_quoteuser($quoteid);
  $customer_name= $this->get_paused_username($quoteid);
  $this->set('user_id', $User_Id);
  $is_link= $this->link_for_seller($quoteid);
  $this->set('is_link', $is_link);
   $paused_seller_id=$this->Lead->get_quoteuser($quoteid);//quote placed user
  $this->set('paused_seller_id', $paused_seller_id);
  $this->set('message_quote', $quoteid);
  $productspec=$this->Lead->getproductspec($quoteid);
  $productmask=$this->Lead->getproductmask($quoteid);
  $mask=$this->mask_field($productspec,$productmask);
  $this->set(compact('mask'));
  $response_count = $this->Quotebid->get_response_count($quoteid);
  $this->set(compact('response_count'));
  if($this->request->is('post')){
                   $quoteno=$this->request->data['Lead']['quoteid'];
                   $sellerid=$this->request->data['Lead']['sellerid'];
                   $checkseller = $this->Quotebid->get_display_sellers($sellerid,$quoteno);
                   if($checkseller == 1){
                        $id=$this->Quotebid->up_quotebids_display($quoteno,0);
                        if($id > 0 ){ 
                            $id=$this->Lead->up_pause_st($quoteno);
                            if($id > 0){
                              $this->Quotebid->clear();
                              echo $this->Session->setFlash('Quote For This Enquiries are Stopped');
                            }
                            else //revoke incase of updation errors
                            {
                              $id=$this->Quotebid->up_pause_st($quoteno,1); 
                            }
                        }
                        else
                        {
                           echo $this->Session->setFlash('Unable to Update Quotes ..Please Try Later');
                        }  
                           $this->Quotebid->clear();
                           return $this->redirect(array('action' => 'enquiry_details'));
                  }
        } //insert or update prices/offers  
      
        $quotes= $this->Lead->get_full_quotes($enquiry_id);
        $this->set('quotes', $quotes);
        $chat=$this->Quotebid->chatbutton($quoteid);
        $this->set('chat', $chat);
        $CategoryName=$this->Quotecategory->get_category_list($quotes['Lead']['quoteid']);
        $category_credits=$CategoryName[0]['offer_categories']['credits'];
        $this->set('category_credits',$category_credits);
        $this->set(compact('CategoryName'));
      
        $this->loadModel('SubCategory');
        $SubCategoryName=$this->SubCategory->get_quote_subcategory($quotes['Lead']['quoteid']);
        $this->set(compact('SubCategoryName'));
    
        $CityList =$this->Quotecity->get_quote_city_list();
        $CityName=$this->Quotecity->get_quote_city_details($quotes['Lead']['quoteid']);
        $this->set(compact('CityName','CityList'));
     
        $AreaList =$this->Quotearea->get_quote_area_list($quotes['Lead']['locarea']);
        $AreaName=$this->Quotearea->get_quote_area($quotes['Lead']['quoteid']);
        $this->set(compact('AreaList','AreaName'));
        if(!empty($User_Id)){
            $credit=$this->GenieUser->get_business_info($User_Id);
            $credit_balance=$credit[0]['users']['leads_displays_count'] - $credit[0]['users']['leads_displays'];
            $credit_min=$category_credits;
             if($credit_balance >= $credit_min){
                 $this->set('business_email', $credit[0]['users']['business_email']);
                 $this->set('mobile_number', $credit[0]['users']['mobile_number']);
                 $credit_enabled=1;
             }
             else{
                   $credit_enabled=0;
             }
            $this->set('credit_enabled', $credit_enabled);
            $this->loadModel('Jchat');
            $last_msg = $this->Jchat->get_last_msg($User_Id,$quoteid) ;   
            $chat_intro=$this->Jchat->getchatintro($quoteid,$User_Id);
       }
    
       $this->set(compact('last_msg','new_message','Fullname','customer_name'));
       $this->set(compact('chat_intro','quoted_user'));
       $this->layout = 'genie_layout';
 }

public function get_sidid($receiver){

   $this->loadModel('GenieUser');
   $sidsellerid=$this->GenieUser->get_offline_sid_id($receiver);
   return $sidsellerid;
}

// logging out from chat dashboard after closing browser
    public function chatlogoff(){
     // Configure::write('debug',2);
      $this->loadModel('Lead');
      $this->loadModel('GenieUser');
      $userid=$this->request['data']['userid'];
      $enquiry_id=$this->request['data']['enquiry_id'];
      $quoteid=$this->request['data']['quoteid'];
      $guest_flag=$this->request['data']['guest_flag'];
      $user_quote_id=$this->Lead->get_quoteuser($quoteid);//to find the enquiry placed user
          $session="offline";
            if($guest_flag==0){ 
                  $this->GenieUser->up_user_session($userid,$session); 
            }
            else{
                  $this->GenieGuest->up_guest_session($user_id,$session);
            }

            exit();
     } 
// for all enquiries of a buyer/customer in myaccount page
// logging in from chat page when user becomes active
    public function chatlogin(){
      //Configure::write('debug',2);
      $this->loadModel('Lead');
      $this->loadModel('GenieUser');
      $userid=$this->request['data']['userid'];
      $enquiry_id=$this->request['data']['enquiry_id'];
      $quoteid=$this->request['data']['quoteid'];
      $guest_flag=$this->request['data']['guest_flag'];
      $user_quote_id=$this->Lead->get_quoteuser($quoteid);//to find the enquiry placed user
      if($guest_flag==0){ 
         $session="online";
        $this->GenieUser->up_user_session($userid,$session);
      }else{
         $session="online";
         
          $this->GenieGuest->up_guest_session($user_id,$session);
      }

       exit();
     }  

  //ADD a quote using ajax functionality
public function ajaxadd() {
      $this->loadModel('Quotecity');
      $this->loadModel('Lead');
      $this->loadModel('GenieGuest');
      $this->loadModel('LeadLocations');
      $this->loadModel('Quotearea');
      $this->loadModel('User');
      $this->loadModel('GenieUser');

      $this->layout = false;
      $this->autoRender = false;
       
      $User_Id = $this->Auth->user('id');
      $enquiry_time=date('Y-m-d H:i:s');
      $remote_ip=$this->request->data['unique_ip'];
      $second_click=$this->request->data['second_click'];
      $prelogin=$this->request->data['prelogin'];
      $user_id=$this->request->data['userid'];
      $email=$this->request->data['email'];
      $otp_checked=$this->request->data['otp_checked'];
      $actual_link=$this->request->data['actual_link'];
      $login_type=$this->request->data['login_type'];
      if($login_type=='social_login'){
        $social_login=1;
      }
      else{
        $social_login=0;
      }
      $Mydata['genie_links']=$actual_link;
      $check_quote_id=$this->request->data['check_quote_id'];
      $controller=$this->request->data['check_controller'];
      $Mydata['enquiry_time']=$enquiry_time;
      $need_activation['remote_ip']=$remote_ip;
      $Mydata['control']=$controller;
      $Mydata['remote_ip']=$remote_ip;
      if($this->request->data['cat_id']!=''){
      $Mydata['cat_id']=$this->request->data['cat_id'];
      $Mydata['blcat_id']=$this->request->data['cat_id'];
      }
      if($this->request->data['sub_cat_id']!=''){
      $Mydata['subcat_id']=$this->request->data['sub_cat_id'];
      }
      if($this->request->data['camp_cat_type']!=''){
      	$Mydata['c_cat_flag']=$this->request->data['camp_cat_type'];
      }

      $lunch=$this->request->data['lunch'];//flag=1;updation
      if($this->request->data['pub']==1){
                  $need_activation['pub']=1;
      }else{
        $need_activation['pub']=0;
      }
      if($this->request->data['rest']==1){
            $need_activation['rest']=1;
      }else{
            $need_activation['rest']=0;
      }
      if($this->request->data['food']==1){
                  $need_activation['food']=1;
      }else{
           $need_activation['food']=0;
      }
      $Mydata['lunch']=$lunch;
     
      $Unique_Id_otp = mt_rand(100000,999999);
      $need_activation['cd']=$Unique_Id_otp;
      if($social_login==1){
      $need_activation['cd']='';
      }
      else{
      $need_activation['cd']=$Unique_Id_otp;
      }
       // $need_activation['check']=$Unique_Id_otp;
      $latitude=$this->request->data['login_lat1'];
      $mobile_number=$this->request->data['mobile_number'];
      $need_activation['mobile_number']=$mobile_number;
      $full_name=htmlentities($this->request->data['full_name']);
    /*for updation cases*/  
      $genie_up_flag=$this->request->data['genie_up_flag'];//flag=1;updation
      $enquiry_up_id=$this->request->data['enquiry_up_id'];
      $genie_up_user_id=$this->request->data['genie_up_user_id'];//user id or guest id in quotes table
      $genie_up_guest_type=$this->request->data['genie_up_guest_type'];//1:guest 0:member
      $genie_up_member_type=$this->request->data['genie_up_member_type'];//1:guest 0:member
      $genie_up_quote_id=$this->request->data['genie_up_quote_id'];
      /*eof for updation cases*/ 
      if($genie_up_flag==1){
                 $member_type=$genie_up_member_type;
      }
      else{
        $member_type=$this->request->data['member_type'];  
      }
       if($genie_up_flag==1){
       // $member_type=1;
                 if($genie_up_guest_type==1){
                      $member_guest_id=$this->GenieGuest->get_guest_id($mobile_number);
                 }
                 else{
                       $member_user_id=$this->GenieUser->get_user_id($mobile_number);
                 }
       }
       else{
            if($prelogin==1)
              {
                  $member_user_id = $user_id;
              }else{
                    $member_user_id=$this->GenieUser->get_user_id($mobile_number);
                    $member_guest_id=$this->GenieGuest->get_guest_id($mobile_number);
            }
      }
      if($second_click==1){
              $genie_up_flag=1;
              $member_type = 1;
      }
      /*setting variables*/
      $longitude=$this->request->data['login_long1'];
      $latitude_buy=$latitude;
      $longitude_buy=$longitude;
      $formid=$this->request->data['formid'];
      $Mydata['formid']=$this->request->data['formid'];
      $buyingdate=date('Y-m-d', strtotime("+30 days")); 
      $Mydata['buyingdate']=$buyingdate;
      $attachmenturl=$this->request->data['attachmenturl'];
      $address_buy = stripslashes($this->request->data['login_address1']);
      $address = $address_buy;
      $state_buy = addslashes($this->request->data['login_state1']);
      $state =$state_buy;
      $Mydata['state']=$state;
      $Myloc['state']=$state;
      $Mydata['state_buy']=$state_buy;
      $Myloc['state_buy']=$state_buy;
      if(!empty($this->request->data['login_city1'])){
                $login_city_buy = $this->request->data['login_city1'];
                $login_city_buy = trim($login_city_buy);
                if($login_city_buy == 'Bangalore'){
                            $login_city_buy ='Bengaluru';
                        }
                        $login_city=$login_city_buy;
                $city_id =$this->Quotecity->get_city_id($login_city_buy);
                if($city_id ==''){
                  $city_id=0;
                }else{
                  $city_id=$city_id;
                }
                $locarea_buy=$city_id;
                $locarea=$city_id;
                $Mydata['locarea']=$locarea; 
                $Mydata['locarea_buy']=$locarea_buy;
              }//city
               if(!empty($this->request->data['login_area1'])){
               $login_area_buy = $this->request->data['login_area1'];
               $login_area_buy =  trim($login_area_buy);
               $login_area=$login_area_buy;
                if ($login_area_buy == "0") {
                  $area_id_buy = $login_area_buy;
               }else{
                        $area_id = $this->Quotearea->get_quote_area_id($login_area_buy);

                       if($area_id ==''){
                        $area_id_buy=0;
                          $this->Quotearea->set_quote_area($locarea,$login_area_buy);
                       }else{
                        $area_id_buy = $areaname_buy[0]['quoteareas']['id'];
                       }
                     }
               }//area
               $locradius_buy=$area_id_buy; //buy area
               $Mydata['locradius']=$locradius_buy; 
               $locradius=$area_id_buy;
               $Mydata['locradius_buy']=$locradius_buy; 
          $genie_url=$this->request->data['genie_url'];
          if($genie_url==''){
               $productspec=addslashes($this->request->data['productspec']);
          }
          else{
              $productspec=str_replace("'"," ",$this->request->data['productspec']);
              $productspec=addslashes($productspec);
              $need_activation['genie_url']=1;
          }
         $quantity=$this->request->data['quantity']; 
         $budget=$this->request->data['budget']; 
         $login_city=addslashes($login_city);
         $login_city_buy=addslashes($login_city_buy);
         $login_area=addslashes($login_area);
         $login_area_buy=addslashes($login_area_buy);
         $login_zone1_buy=addslashes($this->request->data['login_zone1']);
         $login_zone1=$login_zone1_buy;
         $login_zone2_buy=addslashes($this->request->data['login_zones1']);
         $login_zone2= $login_zone2_buy;
         $b2c=$this->request->data['b2c']; 
         $gender=$this->request->data['gender'];
         $size=$this->request->data['size'];
         $color=$this->request->data['color']; 

         $Mydata['budget']=trim($budget);
         $Mydata['quantity']=trim($quantity);
         $Mydata['productspec']=$productspec;
         $Mydata['city_buy']=trim($login_city); 
         $Mydata['zone_buy']=trim($login_area); 
         $Mydata['city']=trim($login_city_buy); 
         $Mydata['zone']=trim($login_area_buy); 
         $Mydata['b2c']=$b2c;
         $Mydata['gender']=trim($gender);
         $Mydata['size']=trim($size);
         $Mydata['color']=trim($color);
         
         $Myloc['city_buy']=trim($login_city);   
         $Myloc['city']=trim($login_city_buy);  
         $Myloc['zone_buy']=trim($login_area); 
         $Myloc['zone']=trim($login_area_buy); 
         $Myloc['zone1_buy']=trim($login_zone1);
         $Myloc['zone1']=trim($login_zone1_buy); 
         $Myloc['zone2']=trim($login_zone2_buy); 
         $Myloc['zone2_buy']=trim($login_zone2);
         $Myloc['latitude_buy']=trim($latitude_buy);
         $Myloc['longitude_buy']=trim($longitude_buy);
         $Myloc['latitude']=trim($latitude);
         $Myloc['longitude']=trim($longitude);
        
        if(!empty($this->request->data['brand'])){
                   $brand=$this->request->data['brand']; 
                   $Mydata['seller_name']=trim($brand);
        }

        $Enquiry_Id = 'XRVL'.substr(str_shuffle(uniqid()), 1, 6);
        $Mydata['enquiry_id']=$Enquiry_Id;
        $Mydata['genie_url']=$genie_url;
        $Myloc['enquiry_id']=$Enquiry_Id;
      if($member_type == 0){//posting as a guest user ;may or may not be registered user
                               $Myguest['guest_flag'] =1;
                               $Myguest['status'] = 0;  
                               $Myguest['member_type']=$member_type;
                               $Myguest['mobile_number']=$mobile_number;
                               $Myguest['remote_ip']=$remote_ip;
                               $Myguest['created']=$enquiry_time;
                               $Myguest['userid']=$member_user_id;
                               $tempuid = 'TID'.substr(str_shuffle(uniqid()), 1, 6);
                               $Myguest['verify_code']=$Unique_Id_otp;
                               $Myguest['temp_uid'] =$tempuid; 
            if(($member_user_id == 0)||($member_user_id == '')) {//guest users
                              if(($member_guest_id == 0)||($member_guest_id == '')) {//new guest user
                                      $this->GenieGuest->save($Myguest);
                                       $guest_id = $this->GenieGuest->id;
                                       $Mydata['guest_flag']=1;                                      
                                       $Mydata['user_id']=$guest_id;
                                       $Mydata['full_name']=$full_name;
                                       $Mydata['status']=6;
                                       $Mydata['user_mode']=0;
                              }
                              else{//already a activated guest user
                                       $this->GenieGuest->up_gg_vc($member_guest_id,$Unique_Id_otp);
                                       $Mydata['guest_flag']=1;  
                                       $Mydata['user_mode']=0;
                                       $Mydata['status']=6;
                                       $Mydata['full_name']=$full_name;
                                       $Mydata['genie_verify_code']=$Unique_Id_otp;
                                       $Mydata['user_id']=$member_guest_id;
                              }
                              $this->Lead->save($Mydata);
                              $ID = $this->Lead->id;// in a controller
                              $enquiryid = $this->Lead->enquiry_id;  
                              $need_activation['guest']=1;
                              /*user table*/
                    $UsrData['status'] = 1;
                    $UsrData['brand_for'] = 1;
                    $UsrData['country_id'] = 105;
                    $UsrData['company_name'] = "";
                    $UsrData['first_name'] = "Guest";
                    $UsrData['last_name'] = "User";
                    $UsrData['business_email'] = "";
                    $UsrData['mobile_number'] = $mobile_number;
                    $UsrData['password'] = "xerveteam";
                    $UsrData['user_type'] = "1";
                    $UsrData['verify_code'] = $code;
                    $UsrData['genie_user'] = "1";

                    //$UsrData['f_id'] = $f_id;

                    if(!empty($email) && $email != 'undefined'){
                        $UsrData['email_send'] = 1;
                    }
                    $UsrData['name_title'] = "1";
                    $UsrData['activated'] = "1";
                    $UsrData['longitude'] = $longitude;
                    $UsrData['latitude'] = $latitude;
                    $UsrData['country_id'] = "105";
                    $UsrData['state_id'] = "2376";
                    $UsrData['city_id'] = $login_area_buy;
                    $UsrData['area_id'] = $locradius_buy;
                    $UsrData['category_id']=$this->request->data['cat_id'];
                    $UsrData['sub_category_id']=$this->request->data['sub_cat_id'];
                    $UsrData['ip'] = $remote_ip;

                    $UsrCatData['longitude'] = $longitude;
                    $UsrCatData['latitude'] = $latitude;
                    $UsrCatData['state_id'] = "2376";
                    $UsrCatData['country_id'] = "105";
                    $UsrCatData['city_id'] = $login_area_buy;
                    $UsrCatData['area_id'] = $locradius_buy;
                    $UsrCatData['category_id'] = $this->request->data['cat_id'];

                    $Channel_Fnd = $this->Cookie->read('WINChannel');
                    $Channel_Type = $this->Cookie->read('WINChannel_type');
                    $Channel_Type_Sub = $this->Cookie->read('WINChannel_type_sub');

                    if (!empty($Channel_Fnd)) {
                        $UsrData['channel'] = $Channel_Fnd;
                        $UsrData['channel_target_type'] = $Channel_Type;
                        $UsrData['sub_channel'] =$Channel_Type_Sub; 
                        if($UsrData['channel']=="8"){
                          $UsrData['join_from'] = "Facebook";
                        }else if($UsrData['channel']=="14"){
                           $UsrData['join_from'] = "Google";
                        }else if($UsrData['channel']=="1"){
                           $UsrData['join_from'] = "SMS";
                        }
                        else{
                           $UsrData['join_from'] = "Direct";
                        }

                    }
                    $this->User->save($UsrData);
                    $this->loadModel('UserCategory');
                    $MyUser_id = $this->User->id;
                    $UsrCatData['user_id'] = $MyUser_id;
                    $this->UserCategory->save($UsrCatData); 
                                                        /*user table*/
                    }//guest users
                   else{//already registered users in guest mode
                     //echo json_encode('already registered users in guest mode');
                          $Mydata['user_mode']=0;
                          $Mydata['guest_flag']=0;
                          $Mydata['user_id']=$member_user_id;
                          if($genie_title!=''){
                              if($second_click==1){
                                $Mydata['status']=2;
                              }else{
                                $Mydata['status']=6; 
                              }
                          }else{
                            $Mydata['status']=6; 
                          }
                          $Mydata['full_name']=$full_name;
                          $this->Lead->save($Mydata);
                          $ID = $this->Lead->id;// in a controller
                          $enquiryid = $this->Lead->enquiry_id;
                          if($genie_up_flag==1){
                                                 $ID=$genie_up_quote_id;
                          }
                          
                          $this->Lead->up_genie_verify_code($ID,$Unique_Id_otp);
                          $need_activation['guest']=0;
                   }
                                  /*sms for activation*/
                    if($genie_url==''){
                      $need_activation['yes']=1;
$message= "Please use this OTP: $Unique_Id_otp to complete your Mobile No. verification process. Thank you.
Best Regards,
Xerve Team.
www.xerve.in";
                      $to = $mobile_number;
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
                        if($login_type!='social_login'){
                        $output=curl_exec($ch);
                      }
                        curl_close($ch);
                          /*sms for activation */
                }
     }
     else{//logged in

             if($second_click!=1){
                   if($genie_up_flag==1){//for updation
                                        	$ask_cnt=$this->Lead->getaskcnt($genie_up_quote_id);
                                       	  if($ask_cnt == 0){
                                             $ask_cnt=1;
                                            }
                                          else{
                                            $ask_cnt=$ask_cnt+1;
                                           }
          $this->Lead->up_quotes_1($productspec,$budget,$quantity,$login_area_buy,$login_city_buy,$state_buy,$enquiry_time,$ask_cnt,$genie_up_quote_id);
                    }
                    else{
                          if($prelogin!=1){
                                    $user_id=$User_Id;
                          }
                          $Mydata['user_id']=$user_id;
                          $Mydata['guest_flag']=0;
                          $need_activation['yes']=0;
                          $need_activation['guest']=0;
                          $need_activation['mydata']=$remote_ip;
                          $need_activation['secondclick']=3;
                          $this->Lead->save($Mydata);
                          $ID = $this->Lead->id;
                          $enquiryid = $this->Lead->enquiry_id;
                }
        }//not second click
     }
     $need_activation['quote_id']=$ID;
     $Myloc['quoteid']=$ID;
      if($genie_up_flag==1){
            if($second_click==1){
               $need_activation['secondclick']=1;
               if($otp_checked==1){ 
                 $this->Lead->up_quotes_camp($productspec,$budget,$quantity,$login_area_buy,$login_city_buy,$state_buy,$lunch,$enquiry_time,$email,$check_quote_id);
              }
              else{
                  $this->Lead->up_quotes($productspec,$budget,$quantity,$login_area_buy,$login_city_buy,$state_buy,$enquiry_time,$email,$check_quote_id);
              }
             
              $this->LeadLocations->up_location($login_zone1_buy,$login_area_buy,$login_city_buy,$state_buy,$address_buy,$latitude_buy,$longitude_buy,$check_quote_id);
              $ID =$check_quote_id;
              $otp=$this->Lead->getotp($check_quote_id);
              $need_activation['yes']=1;
      }
      else{ 
            $this->LeadLocations->up_location($login_zone1_buy,$login_area_buy,$login_city_buy,$state_buy,$address_buy,$latitude_buy,$longitude_buy,$check_quote_id);
      }
       
        }else{  
              $this->LeadLocations->save($Myloc); // to be revoked
      }
        echo json_encode($need_activation);
       exit();
    }//end of ajax add function

  public function verify_guest_otp(){
         $this->loadModel('GenieGuest');
       
         $otp_number=$this->request->data['otp_number'];
         //echo json_encode($otp_number);
         $guest_type=$this->request->data['guest_type'];
         $check_quote_id=$this->request->data['check_quote_id'];
         $quote_status=$this->Lead->get_status($check_quote_id);
         $enquiry_time=date('Y-m-d H:i:s');
         if($guest_type==1){
              $verified=$this->GenieGuest->get_verify_code($otp_number);
         }else{
              $verified=$this->Lead->get_verify_code($otp_number);
         }
         //echo json_encode($verified);
         if($verified == $otp_number){
                if($guest_type==1){
                        $this->GenieGuest->up_gg_act($verified); 
                        if($quote_status==6){
                          $this->Lead->up_pending_st_time($check_quote_id,$enquiry_time);
                        }
                }
                else{
                      $this->Lead->up_pending_st_2($verified,$enquiry_time);
                }
                       $verified=1;
         }
         else{
                $verified=0;
         }

                 echo json_encode($verified);     
                exit();
  }

  public function get_guest_temp_id($id){
       $this->loadModel('GenieGuest');
       $temp_guest_id = $this->GenieGuest->get_guest_temp_id($id);
       return $temp_guest_id;
  }

     public function first_seller_msg($sellerid,$buyerid,$enquiry_id,$sid_id,$new_tot_name,$mobile_number_sms,$productspec_sms){
      if($mobile_number_sms !=0){
     /*short url for sending sms*/
              $chat_url = 'https://www.xerve.in/leads/'.$enquiry_id.'/'.$sid_id.'/'.$buyerid;   
              $apiKey = 'AIzaSyCCe-FLs8hLmMb1CgoAEbNoMFTXiuJAZaQ';
              $postData = array('longUrl' => $chat_url, 'key' => $apiKey);
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
              $chat_url = $shortLink_buyer['id'];
                   /*short url for sending sms*/
$sms_message = "Customer: '$new_tot_name' just read Your Message.
Enquiry: $productspec_sms...
Enquiry Id: $enquiry_id
Enquiry Link: $chat_url
Best Regards,
Xerve Team.
www.xerve.in";
  $mobile=$mobile_number_sms;
  $to = urlencode($mobile);
  $sms_message=urlencode($sms_message);
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
    $url="http://alerts.solutionsinfini.com/api/web2sms.php?workingkey=A5d8f4c8c48eb27a2b0e14ae549b76ce5&sender=iXERVE&to=$to&message=$sms_message&type=json";
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if($send_sms==1){
         $output=curl_exec($ch);

   }
    curl_close($ch);
                                    }//valid mobile      
     }
     ///////////////////////////////////////////////////////////////////////////////////////
    // marking messages as read for both msg tbl & push notif table from leads detail page
    //////////////////////////////////////////////////////////////////////////////////////
    public function mark_read(){
     $this->loadModel('Jchat');
     $this->autoRender = false;
     $this->layout = false;
     date_default_timezone_set("Asia/Calcutta");
     $userid=$this->request['data']['userid'];//95449
     $enquiry_id=$this->request['data']['enquiry_id'];
     $b2c=$this->request['data']['type'];
     $serverid=$this->request['data']['serverid'];//81114
     $update_date = date('Y-m-d H:i:s');
     $first_msg_status=$this->request['data']['first_unread'];//
     $sid_id=$this->request['data']['sid_id'];
     $buyer_name=$this->request['data']['customer_name'];//buyer name
     $seller_mob=$this->request['data']['seller_mobile'];//seller mob
     $productspec=$this->request['data']['productspec'];
     $productspec_sms=substr($productspec, 0, 10);
     //Sending sms for first msg to seller  $first_msg_status==1
       if($first_msg_status==1){
          if($seller_mob !=0){
           $chat_url = 'https://www.xerve.in/leads/'.$enquiry_id.'/'.$sid_id.'/'.$serverid; 
                    $apiKey = 'AIzaSyCCe-FLs8hLmMb1CgoAEbNoMFTXiuJAZaQ';
                    $postData = array('longUrl' => $chat_url, 'key' => $apiKey);
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
                    $chat_url = $shortLink_buyer['id'];
                   /*short url for sending sms*/
$sms_message = "Customer: '$buyer_name' just read Your Message.
Enquiry: $productspec_sms...
Enquiry Id: $enquiry_id
Enquiry Link: $chat_url
Best Regards,
Xerve Team.
www.xerve.in";
      $mobile=$seller_mob;
      $to = urlencode($mobile);
      $sms_message=urlencode($sms_message);
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
        $url="http://alerts.solutionsinfini.com/api/web2sms.php?workingkey=A5d8f4c8c48eb27a2b0e14ae549b76ce5&sender=iXERVE&to=$to&message=$sms_message&type=json";
       // echo json_encode($output)or die("error");
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output=curl_exec($ch);
        curl_close($ch);
        $first_msg_status=0;
                                    }//valid mobile  
       }
    //sending sms
     $backpath="genie3";
     $this->Jchat->up_msg_read_stat($update_date,$enquiry_id,$serverid,$userid,$backpath);
     $this->Lead->up_push_st_2($enquiry_id,$userid,$receiver);
     echo json_encode($first_msg_status);
     exit();
     }//mark_read


  public function unique_count(){
      $this->loadModel('Genieclick');
        $this->layout = false;
        $this->autoRender = false;
        $click_day=date('Y-m-d');
        $click_time = date('Y-m-d H:i:s');
        $unique_ip=$this->request->data['unique_ip'];
        $count = $this->Genieclick->get_click($unique_ip,$click_day);
            if(($count==0)||($count=='')||($count==null)){
		            $clicks=1;
					          if($unique_ip!=0){
                        $this->Genieclick->set_click($unique_ip,$click_day,$click_time,$clicks);
					           }
		        }
  }

public function resend_otp(){
       // Configure:write('debug',2);
        $this->layout = false;
        $this->autoRender = false;
        $this->loadModel('GenieUser');
             //$otp_number=$this->request->data['otp_number'];
             $guest_type=$this->request->data['guest_type'];
             $check_quote_id=$this->request->data['check_quote_id'];
            // echo json_encode($check_quote_id);
             //$quote_status=$this->Lead->get_status($check_quote_id);
             $quoted_user=$this->Lead->get_quoteuser($check_quote_id);
             $enquiry_time=date('Y-m-d H:i:s');
             /*Getting otp code from db*/
             //echo $guest_type;
            // echo json_encode($guest_type);
         if($guest_type==1){
              $code=$this->GenieGuest->get_activation_code_for_resend($quoted_user);
              $mobile_number=$this->GenieGuest->get_guest_mobile_lat($quoted_user);
         }else{
               $code=$this->Lead->get_verify_code_for_resend($check_quote_id);
               //echo json_encode($code);
               $mobile_number=$this->GenieUser->get_mobile($quoted_user);
        }
        //echo json_encode($code);
        //echo json_encode($mobile_number);
        $message= "Please use this OTP: $code to complete your Mobile No. verification process. Thank you.
Best Regards,
Xerve Team.
www.xerve.in";
$to = $mobile_number;
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
                          
//exit();
}


  public function getoffers() {
      $User_Id = $this->Auth->user('id');
      $this->loadModel('Quotecity');
      $this->loadModel('Lead');
      $this->loadModel('GenieGuest');
      $this->loadModel('LeadLocations');
      $this->loadModel('Quotearea');
      $this->loadModel('GenieUser');
      $lunch=$this->request->data['lunch'];//flag=1;updation
      $diningdate=$this->request->data['diningdate'];//flag=1;updation
      $Mydata['lunch']=$lunch;
      $diningdate=date($diningdate); 
      $Mydata['diningdate']=$diningdate;
      $enquiry_time=date('Y-m-d H:i:s');
      $Mydata['enquiry_time']=$enquiry_time;
      $latitude=$this->request->data['login_lat1'];
      $member_type=$this->request->data['member_type'];
      $mobile_number=$this->request->data['mobile_number'];
      $full_name=$this->request->data['full_name'];
      $Mydata['full_name']=$full_name;
      $unique_ip=$this->request->data['unique_ip'];
       if($unique_ip=='0.0.0.0'){
        $unique_ip=$_SERVER['REMOTE_ADDR'];
      }
      $Mydata['remote_ip']=$_SERVER['REMOTE_ADDR'];
      $Mydata['formid']=3;
      $Mydata['b2c']=1;
      $member_user_id=$this->GenieUser->get_user_id($mobile_number);
      $member_guest_id=$this->GenieGuest->get_guest_id($mobile_number);
      $longitude=$this->request->data['login_long1'];
      $latitude_buy=$latitude;
      $longitude_buy=$longitude;
      $genie_url=$this->request->data['genie_url'];
      $buyingdate=date('Y-m-d', strtotime("+30 days")); 
      $Mydata['buyingdate']=$buyingdate;
      $attachmenturl=$this->request->data['attachmenturl'];
      $address_buy = addslashes($this->request->data['login_address1']);
      $address = $address_buy;
      $state_buy = addslashes($this->request->data['login_state1']);
      $state =$state_buy;

      $Mydata['state']=$state;
      $Myloc['state']=$state;
      $Mydata['state_buy']=$state_buy;
      $Myloc['state_buy']=$state_buy;
      if(!empty($this->request->data['login_city1'])){
                $login_city_buy = $this->request->data['login_city1'];
                $login_city_buy = trim($login_city_buy);
                 if($login_city_buy == 'Bangalore'){
                            $login_city_buy ='Bengaluru';
                        }
                        $login_city=$login_city_buy;
               
                $city_id =$this->Quotecity->get_city_id($login_city_buy);

                if($city_id ==''){
                     $city_id=0;
                     $this->Quotecity->set_quote_city($login_city);
                }else{
                  $city_id=$city_id;
                }
                $locarea_buy=$city_id;
                $locarea=$city_id;
                $Mydata['locarea']=$locarea; 
                $Mydata['locarea_buy']=$locarea_buy;
              }//city
               if(!empty($this->request->data['login_area1'])){
               $login_area_buy = $this->request->data['login_area1'];
               $login_area_buy =  trim($login_area_buy);
               $login_area=$login_area_buy;
               if ($login_area_buy == "0") {
                  $area_id_buy = $login_area_buy;
               }else{
                       $area_id = $this->Quotearea->get_quote_area_id($login_area_buy);
                       if($area_id ==''){
                         $area_id_buy=0;
                         $this->Quotearea->set_quote_area($locarea,$login_area_buy);
                       }else{
                        $area_id_buy = $areaname_buy[0]['quoteareas']['id'];
                       }
                     }
               }
         $locradius_buy=$area_id_buy; 
         $Mydata['locradius']=$locradius_buy; 
         $locradius=$area_id_buy;
         $Mydata['locradius_buy']=$locradius_buy; 
         $productspec=addslashes($this->request->data['productspec']);
         $Mydata['productspec']=$productspec;
         $login_city=addslashes($login_city);
         $Mydata['city_buy']=trim($login_city); 
         $Myloc['city_buy']=trim($login_city);   
         $login_city_buy=addslashes($login_city_buy);
         $Mydata['city']=trim($login_city_buy); 
         $Myloc['city']=trim($login_city_buy);  
         $login_area=addslashes($login_area);
         $Mydata['zone_buy']=trim($login_area);
         $Myloc['zone_buy']=trim($login_area); 
         $login_area_buy=addslashes($login_area_buy);
         $Mydata['zone']=trim($login_area_buy); 
         $Myloc['zone']=trim($login_area_buy); 
         $login_zone1_buy=addslashes($this->request->data['login_zone1']);
         $login_zone1=$login_zone1_buy;
         $Myloc['zone1_buy']=trim($login_zone1);
         $Myloc['zone1']=trim($login_zone1_buy); 
         $login_zone2_buy=addslashes($this->request->data['login_zones1']);
         $Myloc['zone2']=trim($login_zone2_buy); 
         $login_zone2= $login_zone2_buy;
         $Myloc['zone2_buy']=trim($login_zone2);
        $Myloc['latitude_buy']=trim($latitude_buy);
        $Myloc['longitude_buy']=trim($longitude_buy);
        $Myloc['latitude']=trim($latitude);
        $Myloc['longitude']=trim($longitude);
        $b2c=$this->request->data['b2c']; 
        $Mydata['b2c']=$b2c;
        $quantity=$this->request->data['quantity']; 
        $Mydata['quantity']=trim($quantity);
        $budget=$this->request->data['budget']; 
        $Mydata['budget']=trim($budget);
        $brand=$this->request->data['brand']; 
        $Mydata['brand']=trim($brand);
        $gender=$this->request->data['gender']; 
        $Mydata['gender']=trim($gender);
        $size=$this->request->data['size']; 
        $Mydata['size']=trim($size);
        $color=$this->request->data['color']; 
        $Mydata['color']=trim($color);
        $Enquiry_Id = 'XRVL'.substr(str_shuffle(uniqid()), 1, 6);
        $Mydata['enquiry_id']=$Enquiry_Id;
        $Mydata['genie_url']=$genie_url;
        $Myloc['enquiry_id']=$Enquiry_Id;
        if($member_type == 0){//posting as a guest user ;may or may not be registered user
                             $Unique_Id_otp = mt_rand(100000,999999);
                             $Myguest['guest_flag'] =1;
                             $Myguest['status'] = 0;  
                             $Myguest['member_type']=$member_type;
                             $Myguest['mobile_number']=$mobile_number;
                             $Myguest['created']=$enquiry_time;
                             $Myguest['userid']=$member_user_id;
                             $tempuid = 'TID'.substr(str_shuffle(uniqid()), 1, 6);
                             $Myguest['verify_code']=$Unique_Id_otp;
                             $Myguest['temp_uid'] =$tempuid; 
                              if(($member_user_id == 0)||($member_user_id == '')) {//guest users
                                    if(($member_guest_id == 0)||($member_guest_id == '')) {//new guest user
                                          $this->GenieGuest->save($Myguest);
                                          $guest_id = $this->GenieGuest->id;
                                          $Mydata['guest_flag']=1;
                                          $Mydata['user_id']=$guest_id;
                                          $Mydata['full_name']=$full_name; 
                                          $Mydata['status']=6;
                                          $Mydata['user_mode']=0;
                                    }else{//activated guest user
                                          $this->GenieGuest->up_gg_vc($member_guest_id,$Unique_Id_otp);
                                          $Mydata['guest_flag']=1; 
                                          $Mydata['full_name']=$full_name; 
                                          $Mydata['user_mode']=0;
                                          $Mydata['status']=6;
                                          $Mydata['genie_verify_code']=$Unique_Id_otp;
                                          $Mydata['user_id']=$member_guest_id;
                                    }
                                    $this->Lead->save($Mydata);
                                    $ID = $this->Lead->id;
                                    $enquiryid = $this->Lead->enquiry_id;  
                                    $need_activation['guest']=1;
                              }//guest users
                              else{//already registered users in guest mode
                                    $Mydata['user_mode']=0;
                                    $Mydata['guest_flag']=0;
                                    $Mydata['user_id']=$member_user_id;
                                    $Mydata['status']=6; 
                                    $this->Lead->save($Mydata);
                                    $ID = $this->Lead->id;
                                    $enquiryid = $this->Lead->enquiry_id;
                                    $this->Lead->up_genie_verify_code($ID,$Unique_Id_otp);
                                    $need_activation['guest']=0;
                              }
                                $need_activation['yes']=1;
                                /*sms for activation*/
                                $message= "Please use this OTP: $Unique_Id_otp to complete your Mobile No. verification process. Thank you.";
                                $to = $mobile_number;
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
                          /*sms for activation */
        }
        else{//logged in
            $user_id=$User_Id;
            $Mydata['user_id']=$user_id;
            $Mydata['guest_flag']=0;
            $need_activation['yes']=0;
            $need_activation['guest']=0;
            $this->Lead->save($Mydata);
            $ID = $this->Lead->id; 
            $enquiryid = $this->Lead->enquiry_id;
        }
        $need_activation['quote_id']=$ID;
        $Myloc['quoteid']=$ID;
        $guest_type=$need_activation['guest'];
        $this->set('check_quote_id',$ID);
        $this->set('guest_type',$guest_type);
        $this->LeadLocations->save($Myloc); 
        $this->layout = 'genie_layout';
    }//end of ajax add function

  public function preloginajaxadd() {
  //Configure::write('debug',2);
      $this->layout = false;
      $this->autoRender = false;
      $this->loadModel('Quotecity');
      $this->loadModel('Lead');
      $this->loadModel('GenieGuest');
      $this->loadModel('LeadLocations');
      $this->loadModel('Quotearea');
      $this->loadModel('GenieUser');

      $enquiry_time=date('Y-m-d H:i:s');
      $formid=$this->request->data['formid'];
      $prelogin=$this->request->data['prelogin'];
      $user_id=$this->request->data['userid'];
      $controller=$this->request->data['check_controller'];
      $quantity=$this->request->data['quantity']; 
      $budget=$this->request->data['budget']; 
      $b2c=$this->request->data['b2c']; 
      $brand=$this->request->data['brand']; 
      $gender=$this->request->data['gender'];
      $size=$this->request->data['size'];
      $color=$this->request->data['color'];
      $attachmenturl=$this->request->data['attachmenturl'];
      $member_type=$this->request->data['member_type'];  
      $genie_url=$this->request->data['genie_url'];
      $productspec=addslashes($this->request->data['productspec']);
      $remote_ip=$_SERVER['REMOTE_ADDR'];
      $latitude=$this->request->data['login_lat1'];
      $longitude=$this->request->data['login_long1'];  
      $address_buy = stripslashes($this->request->data['login_address1']);
      $state_buy = addslashes($this->request->data['login_state1']);
      $login_city_buy = $this->request->data['login_city1'];
      $login_area_buy = $this->request->data['login_area1'];
      $login_zone1_buy=addslashes($this->request->data['login_zone1']);
      $login_zone2_buy=addslashes($this->request->data['login_zones1']);
      if(($this->request->data['cat_id']=='')||($this->request->data['cat_id']==undefined)){
        $cat_id=0;
      }else{
        $cat_id=$this->request->data['cat_id'];
      }
      if(($this->request->data['sub_cat_id']=='')||($this->request->data['sub_cat_id']==undefined)){
        $sub_cat_id=0;
      }else{
        $sub_cat_id=$this->request->data['sub_cat_id'];
      }
      $Mydata['cat_id']=$cat_id;
      $Mydata['blcat_id']=$cat_id;
      $Mydata['subcat_id']=$sub_cat_id;
      $Mydata['remote_ip']=$remote_ip;
      $Mydata['genie_links']=$this->request->data['genie_links'];
      /*eof for updation cases*/
      $latitude_buy=$latitude;
      $longitude_buy=$longitude;
      $address = $address_buy;
      $state =$state_buy;
      $login_zone1=$login_zone1_buy;
      $login_zone2= $login_zone2_buy;
      $buyingdate=date('Y-m-d', strtotime("+30 days")); 
      if($prelogin==1)
              {
                  $member_user_id = $user_id;
      }
      if(!empty($login_city_buy)){
                 $login_city_buy = trim($login_city_buy);
                 if($login_city_buy == 'Bangalore'){
                            $login_city_buy ='Bengaluru';
                        }
                        $login_city=$login_city_buy;
                        $city_id =$this->Quotecity->get_city_id($login_city_buy); 
                if($city_id ==''){
                  $city_id=0;
                  
                }else{
                  $city_id=$city_id;
                }
                $locarea_buy=$city_id;
                $locarea=$city_id;
      }//city
          if(!empty($login_area_buy)){
               $login_area_buy =  trim($login_area_buy);
               $login_area=$login_area_buy;
                if ($login_area_buy == "0") {
                  $area_id_buy = $login_area_buy;
               }else{

                      $area_id = $this->Quotearea->get_quote_area_id($login_area_buy);

                       if($area_id ==''){
                         $area_id_buy=0;
                         $this->Quotearea->set_quote_area($locarea,$login_area_buy);
                       }else{
                        $area_id_buy = $areaname_buy[0]['quoteareas']['id'];
                       }
                     }
                     $locradius_buy=$area_id_buy; 
                     $locradius=$area_id_buy;
         }//area
         $productspec=str_replace("'"," ",$productspec);
         $productspec=addslashes($productspec);
         $login_zone1_buy=addslashes($login_zone1_buy);
         $login_zone1=$login_zone1_buy;
         $login_zone2_buy=addslashes($login_zone2_buy);
         $login_zone2= $login_zone2_buy;
         $login_city=addslashes($login_city);
         $login_city_buy=addslashes($login_city_buy);
         $login_area=addslashes($login_area);
         $login_area_buy=addslashes($login_area_buy);
         $Enquiry_Id = 'XRVL'.substr(str_shuffle(uniqid()), 1, 6);
          $Mydata['control']=$controller;
          $Mydata['formid']= $formid;    
          $Mydata['buyingdate']=$buyingdate;
          $Mydata['budget']=trim($budget);
          $Mydata['quantity']=trim($quantity);
          $Mydata['productspec']=$productspec;
          $Mydata['enquiry_time']=$enquiry_time;
          $Mydata['b2c']=$b2c;
          $Mydata['user_id']=$user_id;
          $Mydata['guest_flag']=0;
          $Mydata['state']=$state;
          $Mydata['state_buy']=$state_buy;
          $Mydata['city_buy']=trim($login_city);
          $Mydata['city']=trim($login_city_buy);
          $Mydata['zone_buy']=trim($login_area); 
          $Mydata['zone']=trim($login_area_buy);
          $Mydata['locarea']=$locarea; 
          $Mydata['locarea_buy']=$locarea_buy;
          $Mydata['locradius']=$locradius; 
          $Mydata['locradius_buy']=$locradius_buy;
          $Mydata['enquiry_id']=$Enquiry_Id;
          $Mydata['genie_url']='';
          $Myloc['state']=$state;
          $Myloc['state_buy']=$state_buy;
          $Myloc['city']=trim($login_city_buy);
          $Myloc['city_buy']=trim($login_city);
          $Myloc['zone_buy']=trim($login_area); 
          $Myloc['zone']=trim($login_area_buy);
          $Myloc['latitude_buy']=trim($latitude_buy);
          $Myloc['longitude_buy']=trim($longitude_buy);
          $Myloc['latitude']=trim($latitude);
          $Myloc['longitude']=trim($longitude);
          $Myloc['zone2_buy']=trim($login_zone2);
          $Myloc['zone2']=trim($login_zone2_buy); 
          $Myloc['zone1_buy']=trim($login_zone1);
          $Myloc['zone1']=trim($login_zone1_buy);
          $Myloc['enquiry_id']=$Enquiry_Id;
          $need_activation['yes']=0;
          $need_activation['guest']=0;
          $need_activation['mydata']=$remote_ip;
          try{
            $this->Lead->save($Mydata);
          }
          catch(Exception $e) {
                                //echo 'Message: ' .$e->getMessage();
          }
          $ID = $this->Lead->id;// in a controller
          $need_activation['quote_id']=$ID;
          $need_activation['remote_ip']=$remote_ip;
          $Myloc['quoteid']=$ID;
          $this->LeadLocations->save($Myloc); 
          echo json_encode($need_activation);
          exit();
  }
  public function offer_marker(){
        $this->layout = false;
        $this->autoRender = false;
        $quote_id=$this->request['data']['quote_id'];
        $this->Lead->offer_marker($quote_id);
        exit();
  }
  public function getsub_faq(){
      $this->loadModel('Quotecategory');
      $this->loadModel('SubCategory');
      $this->layout = false;
      $this->autoRender = false;
      $cat_id=$this->request['data']['cat_id'];
      $subcat_id=$this->request['data']['subcat_id']; 
          if($subcat_id==0){
            $faqs=$this->Quotecategory->get_quote_category_faq($cat_id);
          }else{
            $faqs=$this->SubCategory->get_quote_subcategory_faq($subcat_id,$cat_id);
          }
      echo json_encode($faqs);
      exit();
  }
  public function getSubcategories() {
    $this->loadModel('SubCategory');
    $SubCategory_List = array();
    $cat_id=$this->request['data']['cat_id'];
      if (isset($this->request['data']['cat_id'])) {
              
             $SubCategoryList =$this->SubCategory->get_subcategory_list($cat_id);
      }
      echo json_encode($SubCategoryList);
    exit();
  } 
  public function get_browser(){
      if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE){
         $browser= 'Internet explorer';
        }
       elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) {//For Supporting IE 11
          $browser= 'Internet explorer';
        }
       elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE){
         $browser= 'Mozilla Firefox';
       }
       elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE){
         $browser= 'Google Chrome';
       }
       elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE){
         $browser= "Opera Mini";
       }
       elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE){
         $browser= "Opera";
       }
       elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE){
         $browser= "Safari";
       }
       else{
         $browser= 'Others';
       }
       return $browser;
  }
  public function join_genie_sms(){
       $this->layout = false;
       $this->autoRender = false;
       $this->loadModel('Lead');
        $quote_id=$this->request->data['quote_id'];
        $mobile_no=$this->request->data['mobile_no'];
       
        $quotes=$this->Lead->get_join_sms_details($quote_id);
        $full_name=$quotes[0]['quotes']['full_name'];
        $productspec=$quotes[0]['quotes']['productspec'];
        $genie_links=$quotes[0]['quotes']['genie_links'];
        $url_alert['mobile_no']=$mobile_no;
        $url_alert['quote_id']=$quote_id; 
        if($productspec=='F & B Club'){
          $genie_club_member=1;
       $genie_links=$genie_links."&second_time=1&check_eq_id=".$quote_id."&check_mb_no=".$mobile_no;
      
        }else{
          $genie_club_member=0;
        }
     
       /*Generating offers Google Url */
              $long_url_buyer = 'https://www.xerve.in/offers/category-food-and-dining/subcategory-pubs%7Crestaurant/type-offline';
              $apiKey = 'AIzaSyANxKzfRqnMa8CcoZV4N9QWQpJkrfS4Yz0';
              $postData = array('longUrl' => $long_url_buyer, 'key' => $apiKey);
              $jsonData = json_encode($postData);
              $postData1= array('longUrl' => $my_leads, 'key' => $apiKey);
              $jsonData1 = json_encode($post1Data);
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
              $detail_url = $shortLink_buyer['id'];
                                    
           /*Eof Generating chat Google Url */
           /*Generating genie second form Google Url */
              $long_url_buyer = $genie_links;
              $apiKey = 'AIzaSyANxKzfRqnMa8CcoZV4N9QWQpJkrfS4Yz0';
              $postData = array('longUrl' => $long_url_buyer, 'key' => $apiKey);
              $jsonData = json_encode($postData);
              $postData1= array('longUrl' => $my_leads, 'key' => $apiKey);
              $jsonData1 = json_encode($post1Data);
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

              $genie_url = $shortLink_buyer['id'];
           /*Eof Generating genie second form Google Url */
           if($genie_club_member==0){
  }else{//f & b
$sms_message = "Hi $full_name,

Thanks for joining Xerve's Best-Prices & Best-Deals Club. 

List of Top Food & Drinks Offers Near You: $detail_url 

Exclusive Food & Drinks Deals just for You: $genie_url 

Cheers, 

Xerve Team.
www.xerve.in";
$to = $mobile_no;
            $message=urlencode($sms_message);
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
            /*sms for activation */
            echo json_encode($url_alert);
            exit();
}
}
public function form_submit() {
      //Configure::write('debug',2);
      $this->layout = false;
      $this->autoRender = false;
      $User_Id = $this->Auth->user('id');
      $this->loadModel('Quotecity');
      $this->loadModel('Lead');
      $this->loadModel('GenieGuest');
      $this->loadModel('LeadLocations');
      $this->loadModel('Quotearea');
     // $this->loadModel('Quotecategory');
      $this->loadModel('GenieUser');
      $longitude=$this->request->data['login_long1'];
      $brand=$this->request->data['brand'];
      $latitude_buy=$latitude;
      $longitude_buy=$longitude;
      $formid=$this->request->data['formid'];
    //  echo json_encode($this->request->data);
      $buyingdate=date('Y-m-d', strtotime("+30 days")); 
      $attachmenturl=$this->request->data['attachmenturl'];
      $address_buy = stripslashes($this->request->data['login_address1']);
      $address = $address_buy;
      $state_buy = addslashes($this->request->data['login_state1']);
      $state =$state_buy;
      $enquiry_time=date('Y-m-d H:i:s');
      $remote_ip=$_SERVER['REMOTE_ADDR'];
      $second_click=$this->request->data['second_click'];
      $prelogin=$this->request->data['prelogin'];
      $user_id=$this->request->data['userid'];
      $otp_checked=$this->request->data['otp_checked'];
      $actual_link=$this->request->data['actual_link'];
      $login_type=$this->request->data['login_type'];
      $check_quote_id=$this->request->data['check_quote_id'];
      $controller=$this->request->data['check_controller'];
      $member_type=$this->request->data['member_type']; 
      if($this->request->data['cat_name']!=''){ 
        $cat_name=urldecode($this->request->data['cat_name']);
        str_replace("%20"," ",$cat_name);
        
        $query="SELECT id FROM offer_categories WHERE category_name='".$cat_name."'";
     
        $cat_query = $this->Lead->query($query);
        $cat_id = $cat_query[0]['offer_categories']['id'];
        $Mydata['cat_id']=$cat_id;
        $Mydata['blcat_id']=$cat_id;

      }  
      //echo json_encode($Mydata);

      // if($this->request->data['cat_id']!=''){
      //      $Mydata['cat_id']=$this->request->data['cat_id'];
      //      $Mydata['blcat_id']=$this->request->data['cat_id'];
      // }else{
      //       $Mydata['cat_id']=0;
      //       $Mydata['blcat_id']=0;
      // }
      if($this->request->data['sub_cat_id']!=''){
          $Mydata['subcat_id']=$this->request->data['sub_cat_id'];
      }else{
          $Mydata['subcat_id']=0;
      }
      if($this->request->data['mobile_number']!=''){

      	   $mobile_number=$this->request->data['mobile_number'];
      }
      $quantity=$this->request->data['quantity']; 
      $budget=$this->request->data['budget']; 
      $full_name=htmlentities($this->request->data['full_name']);
      $latitude=$this->request->data['login_lat1'];
      $login_zone1_buy=addslashes($this->request->data['login_zone1']);
      $login_zone2_buy=addslashes($this->request->data['login_zones1']);
      $b2c=$this->request->data['b2c']; 
      $productspec=str_replace("'"," ",$this->request->data['productspec']);

      if($login_type=='social_login'){
        $social_login=1;
      }
      else{
        $social_login=0;
      }
      
      if(!empty($this->request->data['brand'])){
         $brand=urldecode($this->request->data['brand']); 
         $Mydata['seller_name']=$brand;
        }
        if(!empty($this->request->data['one2one'])){
        $Mydata['one2one']=$this->request->data['one2one'];
      }
      $Mydata['genie_links']=$actual_link;
      $Mydata['enquiry_time']=$enquiry_time;
      $Mydata['control']=$controller;
      $Mydata['remote_ip']=$remote_ip;
      $Mydata['state']=$state;
      $Mydata['state_buy']=$state_buy;
      $Mydata['buyingdate']=$buyingdate;
      $Mydata['formid']=$this->request->data['formid'];
      
      $need_activation['remote_ip']=$remote_ip;
      $Unique_Id_otp = mt_rand(100000,999999);
      $need_activation['cd']=$Unique_Id_otp;
      if($social_login==1){
           $need_activation['cd']='';
      }
      else{
           $need_activation['cd']=$Unique_Id_otp;
      }
      $need_activation['mobile_number']=$mobile_number;
      if(!empty($this->request->data['login_city1'])){
                $login_city_buy = $this->request->data['login_city1'];
                 $login_city_buy = trim($login_city_buy);
                 if($login_city_buy == 'Bangalore'){
                            $login_city_buy ='Bengaluru';
                        }
                        $login_city=$login_city_buy;
               
                 $city_id =$this->Quotecity->get_city_id($login_city_buy);  
                if($city_id ==''){
                  $city_id=0;
                }else{
                  $city_id=$city_id;
                }
                $locarea_buy=$city_id;
                $locarea=$city_id;
                $Mydata['locarea']=$locarea; 
                $Mydata['locarea_buy']=$locarea_buy;
              }//city
               if(!empty($this->request->data['login_area1'])){
               $login_area_buy = $this->request->data['login_area1'];
               $login_area_buy =  trim($login_area_buy);
               $login_area=$login_area_buy;
                if ($login_area_buy == "0") {
                  $area_id_buy = $login_area_buy;
               }else{
                       $area_id = $this->Quotearea->get_quote_area_id($login_area_buy);
                       if($area_id ==''){
                        $area_id_buy=0;
                         $this->Quotearea->set_quote_area($locarea,$login_area_buy);
                       }else{
                        $area_id_buy = $areaname_buy[0]['quoteareas']['id'];
                       }
                     }
               }//area
         $locradius_buy=$area_id_buy; 
         $locradius=$area_id_buy;
         $Enquiry_Id = 'XRVL'.substr(str_shuffle(uniqid()), 1, 6);      
         $login_city=addslashes($login_city);
         $login_city_buy=addslashes($login_city_buy);
         $productspec=addslashes($productspec);
         $login_area=addslashes($login_area);
         $login_area_buy=addslashes($login_area_buy);
         $login_zone1=$login_zone1_buy;
         $login_zone2= $login_zone2_buy;
         $Mydata['locradius']=$locradius_buy; 
         $Mydata['locradius_buy']=$locradius_buy; 
         $Mydata['budget']=trim($budget);
         $Mydata['quantity']=trim($quantity);
         $Mydata['productspec']=$productspec;
         $Mydata['city_buy']=trim($login_city); 
         $Mydata['city']=trim($login_city_buy); 
         $Mydata['zone_buy']=trim($login_area); 
         $Mydata['zone']=trim($login_area_buy); 
         $Mydata['enquiry_id']=$Enquiry_Id;
         $Mydata['b2c']=$b2c;
     try{
    $map_member_query = $this->GenieUser->find('first', array('conditions' => array('mobile_number' => $mobile_number,'activated'=>1,),'fields' => array('id'),));

    $member_user_id=$map_member_query['User']['id'];
      } catch(Exception $e) {
                               // echo 'Message: ' .$e->getMessage();
      }

      try{
    $map_guest_query = $this->GenieGuest->find('first', array('conditions' => array('mobile_number' => $mobile_number,'activated'=>1,'guest_flag'=>1,'deleted_flag'=>0,),'fields' => array('id'),));

    $member_guest_id=$map_guest_query['GenieGuest']['id'];

      } catch(Exception $e) {
                               // echo 'Message: ' .$e->getMessage();
      }      
  	$Myloc['latitude_buy']=trim($latitude_buy);
  	$Myloc['longitude_buy']=trim($longitude_buy);
  	$Myloc['latitude']=trim($latitude);
  	$Myloc['longitude']=trim($longitude);
  	$Myloc['city_buy']=trim($login_city);
  	$Myloc['zone1_buy']=trim($login_zone1);
  	$Myloc['zone2_buy']=trim($login_zone2);  
  	$Myloc['city']=trim($login_city_buy); 
  	$Myloc['zone']=trim($login_area_buy); 
  	$Myloc['zone_buy']=trim($login_area); 
  	$Myloc['zone1']=trim($login_zone1_buy); 
  	$Myloc['zone2']=trim($login_zone2_buy); 
    $Myloc['state_buy']=$state_buy;
    $Myloc['state']=$state;
          if($member_type == 0){//posting as a guest user ;may or may not be registered user
                                                        
                                     $Myguest['guest_flag'] =1;
                                     $Myguest['status'] = 0;  
                                     $Myguest['member_type']=$member_type;
                                     $Myguest['mobile_number']=$mobile_number;
                                     $Myguest['remote_ip']=$remote_ip;
                                     $Myguest['created']=$enquiry_time;
                                     $Myguest['userid']=$member_user_id;
                                     $tempuid = 'TID'.substr(str_shuffle(uniqid()), 1, 6);
                                     $Myguest['verify_code']=$Unique_Id_otp;
                                     $Myguest['temp_uid'] =$tempuid; 
                                      if(($member_user_id == 0)||($member_user_id == '')) {//guest users
                                        if(($member_guest_id == 0)||($member_guest_id == '')) {//new guest user
                                                $this->GenieGuest->save($Myguest);
                                                 $guest_id = $this->GenieGuest->id;
                                                 $Mydata['guest_flag']=1;                                      
                                                 $Mydata['user_id']=$guest_id;
                                                 $Mydata['full_name']=$full_name;
                                                 $Mydata['status']=6;
                                                 $Mydata['user_mode']=0;
                                        }else{//already a activated guest user
                                        $this->GenieGuest->up_gg_vc($member_guest_id,$Unique_Id_otp);  
                                                 $Mydata['guest_flag']=1;  
                                                 $Mydata['user_mode']=0;
                                                 $Mydata['status']=6;
                                                 $Mydata['full_name']=$full_name;
                                                 $Mydata['genie_verify_code']=$Unique_Id_otp;
                                                 $Mydata['user_id']=$member_guest_id;
                                        }
                                         $this->Lead->save($Mydata);
                                         $ID = $this->Lead->id;
                                         $enquiryid = $this->Lead->enquiry_id;  
                                         $need_activation['guest']=1;
                                     }//guest users
                                     else{//already registered users in guest mode
                                            $Mydata['user_mode']=0;
                                            $Mydata['guest_flag']=0;
                                            $Mydata['user_id']=$member_user_id;
                                            if($genie_title!=''){
                                                  if($second_click==1){
                                                                  $Mydata['status']=2;
                                              }else{
                                                     $Mydata['status']=6; 
                                              }
                                            }else{
                                                     $Mydata['status']=6; 
                                            }
                                            $Mydata['full_name']=$full_name;
                                            $this->Lead->save($Mydata);
                                            $ID = $this->Lead->id;
                                            $enquiryid = $this->Lead->enquiry_id;
                                            if($genie_up_flag==1){
                                                                   $ID=$genie_up_quote_id;
                                            }
                                           $this->Lead->up_genie_verify_code($ID,$Unique_Id_otp);
                                            $need_activation['guest']=0;
                                     }
                                  /*sms for activation*/
           $need_activation['yes']=1;
$message= "Please use this OTP: $Unique_Id_otp to complete your Mobile No. verification process. Thank you.
Best Regards,
Xerve Team.
www.xerve.in";
              $to = $mobile_number;
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

                if($login_type!='social_login'){
                $output=curl_exec($ch);
              }
                curl_close($ch);
      /*sms for activation */
     }
     else{//logged in
     	  //echo json_encode('member mode'); 
          $Mydata['user_id']=$User_Id;
          $Mydata['guest_flag']=0;
          $Mydata['user_mode']=0;
		  $Mydata['status']=2;
          $need_activation['yes']=0;
          $need_activation['guest']=0;
          $need_activation['mydata']=$remote_ip;
          $need_activation['secondclick']=3;
          $this->Lead->save($Mydata);
          $ID = $this->Lead->id;
          //$need_activation['yes']=1;
          $enquiryid = $this->Lead->enquiry_id;
     }
     $Myloc['quoteid']=$ID;
     $need_activation['quote_id']=$ID;
     $this->LeadLocations->save($Myloc); 
     echo json_encode($need_activation);
     //exit;
    }//end of form_submit function
/*direct enquiry otp verification*/
 public function verify_guest_otp_inner(){
             $this->loadModel('GenieGuest');
             //$this->loadModel('User');
             $otp_number=$this->request->data['otp_number'];
             $guest_type=$this->request->data['guest_type'];
             $check_quote_id=$this->request->data['check_quote_id'];
             $quote_status=$this->Lead->get_status($check_quote_id);
             $enquiry_time=date('Y-m-d H:i:s');
         /*Getting otp code from db*/
         if($guest_type==1){
             $verified=$this->GenieGuest->get_verify_code($otp_number);
             
         }else{
           
                $verified=$this->Lead->getotp($quoteid);
        }
/*eof Getting otp code from db*/  
     
        if($verified == $otp_number){
                                      if($guest_type==1){
                                                     
                                                             $this->GenieGuest->up_gg_act($verified);
                                                             if($quote_status==6){
               $this->Lead->up_pending_st_time($check_quote_id,$enquiry_time);
                                                           }
                                           }
                                            else{
              $this->Lead->up_pending_st_2($verified,$enquiry_time);
                                            }
                                           $verified=1;
         }//eof correct otp
         else{
                $verified=0;
         }
/* eof checking db otp with entered one */      
                echo json_encode($verified);
                exit();
 }
 /*direct enquiry otp verification*/  
 /*direct enquiry submission*/
 public function direct_enquiry(){
       $this->autoRender = false;
       $this->layout = false;
       $User_Id = $this->Auth->user('id');
       $this->loadModel('Quotecity');
       $this->loadModel('Lead');
       $this->loadModel('GenieGuest');
       $this->loadModel('LeadLocations');
       $this->loadModel('Quotearea');
       $this->loadModel('GenieUser');
       $enquiry_time=date('Y-m-d H:i:s');
       $buyingdate=date('Y-m-d', strtotime("+30 days")); 
       $Mydata['buyingdate']=$buyingdate;  
       $Mydata['seller_id']=$this->request->data['seller_id'];
       $Mydata['seller_name']=urldecode($this->request->data['seller_name']);

       $Mydata['one2one']=1;
       $Mydata['b2c']=$this->request->data['b2c'];
       $Mydata['productspec']=$this->request->data['productspec'];
       $Mydata['formid']=$this->request->data['formid'];
       $Mydata['locarea']=$this->request->data['city_id'];
       $Mydata['locarea_buy']=$this->request->data['city_id'];
       $Mydata['locradius']=$this->request->data['area_id'];
       $Mydata['locradius_buy']=$this->request->data['area_id'];
       $User_Id=$this->request->data['userid'];
       $Mydata['city']=trim($this->request->data['city_name']);
       $Mydata['city_buy']=trim($this->request->data['city_name']);
       $Mydata['zone']=trim($this->request->data['area_id']);
       $Mydata['zone_buy']=trim($this->request->data['area_name']);
       $Myloc['city']=trim($this->request->data['city_name']);
       $Myloc['city_buy']=trim($this->request->data['city_name']);
       $Myloc['zone']=trim($this->request->data['area_id']);
       $Myloc['zone_buy']=trim($this->request->data['area_name']);
       $Mydata['cat_id']=$this->request->data['cat_id'];
       $Mydata['blcat_id']=$this->request->data['cat_id'];
       $Mydata['subcat_id']=$this->request->data['sub_cat_id'];
       $Mydata['budget']=trim($this->request->data['budget']);
       $Mydata['quantity']=trim($this->request->data['quantity']);
       $mobile_number=$this->request->data['mobile_number'];
       $full_name=htmlentities($this->request->data['full_name']);
       $Mydata['control']=$this->request->data['check_controller'];
       $Mydata['remote_ip']=$this->request->data['unique_ip'];
       $Mydata['enquiry_time']=$enquiry_time;
       $Mydata['genie_links']=$this->request->data['actual_link'];
       $member_type=$this->request->data['member_type']; 
       $otp_checked=$this->request->data['otp_checked'];
       $login_type=$this->request->data['login_type'];
       $second_click=$this->request->data['second_click'];
       $Enquiry_Id = 'XRVL'.substr(str_shuffle(uniqid()), 1, 6);
       $Mydata['enquiry_id']=$Enquiry_Id;
       $Myloc['enquiry_id']=$Enquiry_Id;
       $Unique_Id_otp = mt_rand(100000,999999);
       $need_activation['cd']=$Unique_Id_otp;
          if($social_login==1){
              $need_activation['cd']='';
          }
          else{
                $need_activation['cd']=$Unique_Id_otp;
          }
        $need_activation['mobile_number']=$mobile_number;
      if($User_Id > 0){
                     $member_user_id=$User_Id;
      }else{
            $member_user_id=$this->GenieUser->get_user_id($mobile_number);
            $member_guest_id=$this->GenieGuest->get_guest_id($mobile_number);
      }
   
    if($member_type == 0){
                                                                                       
                         $Myguest['guest_flag'] =1;
                         $Myguest['status'] = 0;  
                         $Myguest['member_type']=$member_type;
                         $Myguest['mobile_number']=$mobile_number;
                         $Myguest['remote_ip']=$remote_ip;
                         $Myguest['created']=$enquiry_time;
                         $Myguest['userid']=$member_user_id;
                         $tempuid = 'TID'.substr(str_shuffle(uniqid()), 1, 6);
                         $Myguest['verify_code']=$Unique_Id_otp;
                         $Myguest['temp_uid'] =$tempuid; 
                          if(($member_user_id == 0)||($member_user_id == '')) {//guest users
                                  if(($member_guest_id == 0)||($member_guest_id == '')) {//new guest user
                                      $this->GenieGuest->save($Myguest);
                                      $guest_id = $this->GenieGuest->id;
                                      $Mydata['guest_flag']=1;                                      
                                      $Mydata['user_id']=$guest_id;
                                      $Mydata['full_name']=$full_name;
                                      $Mydata['status']=6;
                                      $Mydata['user_mode']=0;
                                            
                                    }else{//already a activated guest user
                                      $this->GenieGuest->up_gg_vc($member_guest_id,$Unique_Id_otp);
                                      $Mydata['guest_flag']=1;  
                                      $Mydata['user_mode']=0;
                                      $Mydata['status']=6;
                                      $Mydata['full_name']=$full_name;
                                      $Mydata['genie_verify_code']=$Unique_Id_otp;
                                      $Mydata['user_id']=$member_guest_id;
                                   }
                                   $this->Lead->save($Mydata);
                                   $ID = $this->Lead->id;
                                   $enquiryid = $this->Lead->enquiry_id;  
                                   $need_activation['guest']=1;
                         }//guest users
                         else{//already registered users in guest mode
                                $Mydata['user_mode']=0;
                                $Mydata['guest_flag']=0;
                                $Mydata['user_id']=$member_user_id;
                                $Mydata['status']=6; 
                                $Mydata['full_name']=$full_name;
                                $this->Lead->save($Mydata);
                                $ID = $this->Lead->id;
                                $enquiryid = $this->Lead->enquiry_id;
                                $this->Lead->up_genie_verify_code($ID,$Unique_Id_otp);
                                $need_activation['guest']=0;
                         }
                                  /*sms for activation*/
                                    $need_activation['yes']=1;
$message= "Please use this OTP: $Unique_Id_otp to complete your Mobile No. verification process. Thank you.
Best Regards,
Xerve Team.
www.xerve.in";
                          $to = $mobile_number;
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
                            if($login_type!='social_login'){
                            $output=curl_exec($ch);
                          }
                            curl_close($ch);
                            $need_activation['quote_id']=$ID;
                            $Myloc['quoteid']=$ID;
                            $this->LeadLocations->save($Myloc); 
                          /*sms for activation */
     }else{//logged in
                          $Mydata['user_id']=$User_Id;
                          $Mydata['guest_flag']=0;
                          $need_activation['yes']=0;
                          $need_activation['guest']=0;
                          $need_activation['mydata']=$remote_ip;
                          $need_activation['secondclick']=3;
                          $this->Lead->save($Mydata);
                          $ID = $this->Lead->id;// in a controller
                          $enquiryid = $this->Lead->enquiry_id;
                      $need_activation['quote_id']=$ID;
                      $Myloc['quoteid']=$ID;
                      $this->LeadLocations->save($Myloc); // to be revoked     
     }  
      echo json_encode($need_activation);
      exit();
   }  
 /*eof direct enquiry submission*/
 /*getting sellers based on category and city*/
  public function getDiffSellerList() {
      $this->loadModel('GenieUser');
      $this->autoRender = false;
      $this->layout = false; 
     $city_id=$this->request['data']['cityid'];
     $cat_id=$this->request['data']['cat_id'];
     $subcat_id= $this->request['data']['subcat_id'];
     $zone_id=$this->request['data']['zone_id'];
     if(($zone_id==undefined)||($zone_id==0)){
      $zone_id='';
     }
     if(($subcat_id==undefined)||($subcat_id==0)){
      $subcat_id='';
     }
     
     $SellerName=$this->GenieUser->get_bl_details($cat_id,$city_id,$subcat_id,$zone_id);
     echo json_encode($SellerName);
     exit();
  } 

  public function getAreas($id=null) {
    //Configure::write('debug',2);
        $AreaList = array();
        $id=$this->request['data']['id'];
        if (isset($id)) {
            $this->loadModel('Quotearea');
          
            $AreaList=$this->Quotearea->get_arealist_of_city($id);
        }
        
        //header('Content-Type: application/json');
        echo json_encode($AreaList);
        exit();
    }   
public function prelogin_direct() {
  
       $this->layout = false;
       $this->autoRender = false;
       $this->loadModel('Quotecity');
       $this->loadModel('Lead');
       $this->loadModel('GenieGuest');
       $this->loadModel('LeadLocations');
       $this->loadModel('Quotearea');
       $this->loadModel('User');

      $enquiry_time=date('Y-m-d H:i:s');
      $formid=$this->request->data['formid'];
      $prelogin=$this->request->data['prelogin'];
      $user_id=$this->request->data['userid'];
      $controller=$this->request->data['check_controller'];
      $quantity=$this->request->data['quantity']; 
      $budget=$this->request->data['budget']; 
      $b2c=$this->request->data['b2c']; 
    
   
      $member_type=$this->request->data['member_type'];  
      $genie_url=$this->request->data['genie_url'];
      $productspec=addslashes($this->request->data['productspec']);
      $remote_ip=$_SERVER['REMOTE_ADDR'];
      $city_id=$this->request->data['city_id'];
      $city_name=$this->request->data['city_name'];
      $area_id=$this->request->data['area_id']; 
      $area_name=$this->request->data['area_name']; 
    
      if(($this->request->data['cat_id']=='')||($this->request->data['cat_id']==undefined)){
        $cat_id=0;
      }else{
        $cat_id=$this->request->data['cat_id'];
      }
      if(($this->request->data['sub_cat_id']=='')||($this->request->data['sub_cat_id']==undefined)){
        $sub_cat_id=0;
      }else{
        $sub_cat_id=$this->request->data['sub_cat_id'];
      }
      $Mydata['cat_id']=$cat_id;
      $Mydata['blcat_id']=$cat_id;
      $Mydata['subcat_id']=$sub_cat_id;
      $Mydata['remote_ip']=$remote_ip;
      $Mydata['genie_links']='g-5';
      /*eof for updation cases*/
    
      $buyingdate=date('Y-m-d', strtotime("+30 days")); 
      if($prelogin==1)
              {
                  $member_user_id = $user_id;
                  
      }
      
           $productspec=str_replace("'"," ",$productspec);
           $productspec=addslashes($productspec);
         
           $Enquiry_Id = 'XRVL'.substr(str_shuffle(uniqid()), 1, 6);

          $Mydata['control']=$controller;
          $Mydata['formid']= $formid;    
          $Mydata['buyingdate']=$buyingdate;
          $Mydata['budget']=trim($budget);
          $Mydata['quantity']=trim($quantity);
          $Mydata['productspec']=$productspec;
          $Mydata['enquiry_time']=$enquiry_time;
          $Mydata['b2c']=$b2c;
          $Mydata['user_id']=$user_id;
          $Mydata['guest_flag']=0;
         
          $Mydata['city_buy']=trim($city_name);
          $Mydata['city']=trim($city_name);
          $Mydata['zone_buy']=trim($area_name); 
          $Mydata['zone']=trim($area_name);
          $Mydata['locarea']=$city_id; 
          $Mydata['locarea_buy']=$city_id;
          $Mydata['locradius']=$area_id; 
          $Mydata['locradius_buy']=$area_id;

          $Mydata['enquiry_id']=$Enquiry_Id;
          $Mydata['genie_url']='';

         
          $Myloc['city']=trim($city_name);
          $Myloc['city_buy']=trim($city_name);
          $Myloc['zone_buy']=trim($area_name); 
          $Myloc['zone']=trim($area_name);
          
         
          $Myloc['enquiry_id']=$Enquiry_Id;
          $need_activation['yes']=0;
          $need_activation['guest']=0;
          $need_activation['mydata']=$remote_ip;
          try{
            $this->Lead->save($Mydata);
          }
          catch(Exception $e) {
                                echo 'Message: ' .$e->getMessage();
          }
          $ID = $this->Lead->id;// in a controller
          $need_activation['quote_id']=$ID;
          $need_activation['remote_ip']=$remote_ip;
          $Myloc['quoteid']=$ID;
          $this->LeadLocations->save($Myloc); 
          echo json_encode($need_activation);
          exit();
        } 

public function get_catcitycombo() {
  $cat_id=$this->request['data']['cat_id'];
  $City_List = $this->Lead->get_catcitycombo($cat_id);
  echo json_encode($City_List);
  exit();
}

public function get_city_cat_combo() {
  $city_id=$this->request['data']['city_id'];
  $Genie_Category=$this->Lead->get_city_cat_combo($city_id);
  echo json_encode($Genie_Category);
  exit();
}

}