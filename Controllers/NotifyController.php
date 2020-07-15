<?php

App::uses('AppController', 'Controller');

class NotifyController extends AppController {

    public $helpers = array('Html', 'Form');
    public $layout = null;
    public $autoRender = false;
    
     
   
public function index($enquiry_id,$sfname,$slname,$sid_id,$semail,$comp,$balance,$uid,$user_id,$sellerarea,$buyername,$detail_url,$myleads_url,$genie_title){
    	
        
    $TO='"'.$semail.'"';
    //$TO='nv.nithin@gmail.com';
    $CC = '"xerve.genie@gmail.com"';
    

    $this->loadModel('Lead');
    $this->loadModel('User');
    $this->loadModel('Jchat');

        $query="SELECT * FROM quotes
LEFT JOIN offer_categories ON (offer_categories.id=quotes.cat_id) 
LEFT JOIN sub_categories ON(quotes.subcat_id = sub_categories.id)
WHERE enquiry_id='".$enquiry_id."'";

 $leads=$this->Lead->query($query);
 $count = $this->Jchat->find('count', array(
        'conditions' => array('intromsg' => 2,'receiver' =>$user_id)
    ));

      
      $company_name=str_replace("-"," ",$comp);
    	$first_name=ucfirst($sfname);
    	$last_name=ucfirst($slname);
      $last_name=str_replace('.', ' ', $last_name);
    	
       
      $buyer_id=$leads[0]['quotes']['user_id'];

      $guest_name=$leads[0]['quotes']['full_name'];

      $guest_name=$leads[0]['quotes']['full_name'];

    	$mask=$leads[0]['quotes']['productspec'];
      $genie_title=$leads[0]['quotes']['genie_url'];
      

      $mask=str_replace("/","",$mask);
      $mask=str_replace("'","",$mask);

		  $b2c=$leads[0]['quotes']['b2c'];

            /* for fetching buyer name for sms/email*/

$buyername_query =  $this->User->query("SELECT name_title,first_name,last_name,company_name,mobile_number FROM users WHERE id='".$buyer_id."'");

           $new_buy_title = $buyername_query[0]['users']['name_title']; 

          if(($new_buy_title==1)||($new_buy_title=='')){
            $new_buy_title='Mr.';
          }
          else{
            $new_buy_title='Miss.';
          }
           $new_buy_fname = $buyername_query[0]['users']['first_name']; 
           $new_buy_lname =  $buyername_query[0]['users']['last_name']; 
           $new_buy_cname =  $buyername_query[0]['users']['company_name']; 
           $new_buy_mobno =  $buyername_query[0]['users']['mobile_number']; 
              if($b2c==1){
                               
                               if($guest_name==''){

                                       $new_tot_name=$new_buy_title." ".$new_buy_fname;
                                }else{
                                  $new_tot_name=ucfirst($guest_name);
                                }

              }
              else{
                $new_tot_name=$new_buy_cname;
                
              }
          /*eof for fetching buyer name for sms/email*/

    		     if($b2c==1){

    		     	$b2c="Personal";

    		     }else{

    		     	$b2c="Business";

    		     }


             $sms_sub_category=$leads[0]['subcategories']['sub_category_name'];

             $sms_category=$leads[0]['offer_categories']['category_name'];

             $sms_zone_buy=$leads[0]['quotes']['zone_buy'];

             $sms_city_buy=$leads[0]['quotes']['city_buy'];

             $guest_flag=$leads[0]['quotes']['guest_flag'];

             $productspec=$leads[0]['quotes']['productspec'];

             $productmask=$leads[0]['quotes']['productmask'];

             $quantity=$leads[0]['quotes']['quantity'];

             $budget=$leads[0]['quotes']['budget'];
             $total_budget=$quantity * $budget;

    

    $mask=$this->mask_field($productspec,$productmask);

      $m=explode("#",$productmask);
      		$spec=$productspec;

          	$i=0;
          while($i<count($m)){

      			    if($i==0){
      			    $p=str_replace($m[$i], "xxxxx",$spec );
      			  
      			     }
      			  else{
      			  	$p=str_replace($m[$i], "xxxxx",$p );
      			  	 	 
      			    }

      			    $i++;
      			}
      	$mask=$p;
      	
           

      if($sms_zone_buy !=''){
                 $sms_loc=$sms_zone_buy.', '.$sms_city_buy;
      }
      else{
            $sms_loc=$sms_city_buy;
      }

      if($sms_sub_category !=''){ 

         $tot_cat_sub='('.$sms_sub_category.', '.$sms_category.')';//for subject line
         $tot_cat=$sms_sub_category.', '.$sms_category;//inside content
      }
       else{

       	  $tot_cat_sub='('.$sms_category.')';
          $tot_cat=$sms_category;
       }
         $cat_id=$leads[0]['quotes']['cat_id'];

       $count = $this->Jchat->find('count', array(
        'conditions' => array('intromsg' => 2,'receiver' =>$user_id)
    ));

   
if($genie_title!=''){//campaign
       if(($cat_id==80)||($cat_id==88)){
        
          $Sub = "NEW CUSTOMER ENQUIRY (#".$count.") for ".$company_name;
        
       }
       else{
          $Sub = "New Customer Enquiry for ".$company_name." ".$tot_cat_sub." | Lead Id: ".$enquiry_id;
       }
 }
 else{
       $Sub = "New Customer Enquiry for ".$company_name." ".$tot_cat_sub." | Lead Id: ".$enquiry_id;
 }


    
    $mob_len = strlen($new_buy_mobno);
    $maskno= substr($new_buy_mobno, 0, 3).str_repeat('X', $mob_len - 3);
        
     
         /*Generating chat Google Url */
         if($guest_flag == 0){

          	  $long_url_buyer = 'www.xerve.in/leads/'.$enquiry_id.'/'.$sid_id.'/'.$uid;

          }else{

              $long_url_buyer = 'www.xerve.in/leads/'.$enquiry_id.'/'.$sid_id.'/'.$uid;

          }
  
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
                                             
          // /*Eof Generating chat Google Url */

          /*Generating My Leads Google Url */
                                               $my_leads = "www.xerve.in/myaccount/my_leads";
                                              
                                                 
                                              // $apiKey = 'AIzaSyCCe-FLs8hLmMb1CgoAEbNoMFTXiuJAZaQ';
                                                $apiKey = 'AIzaSyANxKzfRqnMa8CcoZV4N9QWQpJkrfS4Yz0';

                                                $postData = array('longUrl' => $my_leads, 'key' => $apiKey);
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

                                                 $myleads_url = $shortLink_buyer['id'];

            /*Generating My Leads Google Url */

if($genie_title!=''){//campaign
  
       if(($cat_id==80)||($cat_id==88)){
       
     $html = "Hi $first_name $last_name,<br/><br/>Customer $new_tot_name wants to Connect with <b>$company_name ($sellerarea)</b>.<br/><br/><b>REQUIREMENT: </b><div>$mask</div><br/><br/><b>GROUP SIZE: </b>$quantity<br/><br/><b>BUDGET (per Head): </b>Rs. $budget<br/><br/><b>TOTAL BUDGET: </b>Rs. $total_budget<br/><br/><b>LOCATION(Preference): </b>$sms_loc<br/><br/><b>CUSTOMER&#39;S NUMBER: $maskno</b><br/><b>View & Contact Now: <a href=$detail_url target='_blank'>$detail_url</a></b><br/><br/>....................................................................................................................................<br/><br/><b> View All Your Leads: </b><a href=$myleads_url target='_blank'>$myleads_url</a><br/>(Login to Xerve > Visit My Account - My Leads)<br/><br/>....................................................................................................................................<br/><br/><b>Your Lead Credits Balance: </b>$balance<br/>(Required to Contact Customers)<br/><br/><b>To Buy Lead Credits (Rs. 1000 - Rs 10,000): <a href='https://www.xerve.in/pricing' target='_blank'> https://www.xerve.in/pricing </a></b><br/><br/><b>Payment Options:</b> Paytm, Net Banking, Cards (Debit / Credit), NEFT, Cheque, DD<br/><br />Introduce Yourself and Your Firm to Customers via Xerve, Assist Them and Earn New Business!<br/>....................................................................................................................................<br/><br/>If you have any queries, feedback or suggestions, please contact us and help us serve you better.<br/><br/>Thank you.<br/><br/>Best Regards,<br/>Xerve Team.<br/><a href='https://www.xerve.in/' target='_blank'>www.xerve.in</a><br/><br/>M:  7022619911<br/>E: <a href='mailto:xerve.genie@gmail.com' target='_blank'>xerve.genie@gmail.com</a><br/><br/>------------------------------------------------------------------<br/><b>Xerve.in - India&#39;s No. 1 Shopping Assistant.</b>™<br/>For All Your Personal, Home and Office Needs.<br/>-------------------------------------------------------------------";
     
   }else{
  
  
    $html = "Hi $first_name $last_name,<br/><br/> Customer $cust_name wants Exculsive Deals from  <b>$company_name</b><br/><br/><b>Please assist the Customer immediately: <a href=$detail_url target='_blank'>$detail_url</a></b><br/><br/>Thank you.<br/><br/><b>Lead Id: </b>$enquiry_id<br/><br/><b>Requirement Type: </b>$b2c<br/><br/><b>Category: </b>$tot_cat<br/>$new_tot_name<br/><br/><b>Customer&#39;s Location: </b>$sms_loc<br /><br/><b>Quantity: </b>$quantity<br/><br/><b>Budget: </b>Rs. $budget<br/><br/><b>Customer&#39;s Requirement: </b><br/><div>$mask</div><br/><br/><b>Contact/Assist Customer now and Grow Your Business: <a href=$detail_url target='_blank'>$detail_url</a></b><br/><br/><b> View All Your Leads: <a href=$myleads_url target='_blank'>$myleads_url</a></b><br/>(Login to Xerve > Visit My Account - My Leads)<br/>....................................................................................................................................<br/><br/><b>Your Lead Credits Balance: </b>$balance<br/>(Required to Contact Customers)<br/><br/><b>To Buy Lead Credits (Rs. 1000 - Rs 10,000): <a href='https://www.xerve.in/pricing' target='_blank'> https://www.xerve.in/pricing </a></b><br/><br/>Payment Options: Paytm, Net Banking, Cards (Debit / Credit), NEFT, Cheque, DD<br/><br />Introduce Yourself and Your Firm to Customers via Xerve. Assist Them and Earn New Business!<br/>....................................................................................................................................<br/><br/>If you have any queries, feedback or suggestions, please contact us and help us serve you better.<br/><br/>Thank you.<br/><br/>Best Regards,<br/><br/>Xerve Team.<br/><a href='https://www.xerve.in/' target='_blank'>www.xerve.in</a><br/><br/>T: 080 - 41155811<br/>E: <a href='mailto:xerve.genie@gmail.com' target='_blank'>xerve.genie@gmail.com</a><br/><br/>------------------------------------------------------------------<br/><b>Xerve.in - India&#39;s No. 1 Shopping Assistant.</b>™<br/>For All Your Personal, Home and Office Needs.<br/>------------------------------------------------------------------";

   }
 }else{
 
   $html = "Hi $first_name $last_name,<br/><br/> Customer $cust_name wants Exculsive Deals from  <b>$company_name</b><br/><br/><b>Please assist the Customer immediately: <a href=$detail_url target='_blank'>$detail_url</a></b><br/><br/>Thank you.<br/><br/><b>Lead Id: </b>$enquiry_id<br/><br/><b>Requirement Type: </b>$b2c<br/><br/><b>Category: </b>$tot_cat<br/>$new_tot_name<br/><br/><b>Customer&#39;s Location: </b>$sms_loc<br /><br/><b>Quantity: </b>$quantity<br/><br/><b>Budget: </b>Rs. $budget<br/><br/><b>Customer&#39;s Requirement: </b><br/><div>$mask</div><br/><br/><b>Contact/Assist Customer now and Grow Your Business: <a href=$detail_url target='_blank'>$detail_url</a></b><br/><br/><b> View All Your Leads: <a href=$myleads_url target='_blank'>$myleads_url</a></b><br/>(Login to Xerve > Visit My Account - My Leads)<br/>....................................................................................................................................<br/><br/><b>Your Lead Credits Balance: </b>$balance<br/>(Required to Contact Customers)<br/><br/><b>To Buy Lead Credits (Rs. 1000 - Rs 10,000): <a href='https://www.xerve.in/pricing' target='_blank'> https://www.xerve.in/pricing </a></b><br/><br/>Payment Options: Paytm, Net Banking, Cards (Debit / Credit), NEFT, Cheque, DD<br/><br />Introduce Yourself and Your Firm to Customers via Xerve. Assist Them and Earn New Business!<br/>....................................................................................................................................<br/><br/>If you have any queries, feedback or suggestions, please contact us and help us serve you better.<br/><br/>Thank you.<br/><br/>Best Regards,<br/><br/>Xerve Team.<br/><a href='https://www.xerve.in/' target='_blank'>www.xerve.in</a><br/><br/>T: 080 - 41155811<br/>E: <a href='mailto:xerve.genie@gmail.com' target='_blank'>xerve.genie@gmail.com</a><br/><br/>------------------------------------------------------------------<br/><b>Xerve.in - India&#39;s No. 1 Shopping Assistant.</b>™<br/>For All Your Personal, Home and Office Needs.<br/>------------------------------------------------------------------";

 } 
 

       $str = "sudo aws ses send-email --region us-west-2 --from 'Xerve.in <info@xerve.in>' --destination '".'{"ToAddresses":  ['.$TO.'],"CcAddresses":  ['.$CC.']}' ."'".' --message '."'".'{"Subject": {"Data": "'.$Sub.'","Charset": "UTF-8"},"Body": {"Html": {"Data": "'.$html.'","Charset": "UTF-8"}}}'."'"; //exit;
          
        
        
        $result = shell_exec($str)or die('error');
        
       echo json_encode("Mail Sent!!<pre>");
       echo json_encode($result);
       echo "</pre>"; 
        exit;
        return;
        


    } 	
    public function mask_field($enquiry,$maskingfield) {
             $m=explode("#",$maskingfield);
      		$spec=$enquiry;

          	$i=0;
          while($i<count($m)){

      			    if($i==0){
      			    $p=str_replace($m[$i], "xxxxx",$spec );
      			  
      			     }
      			  else{
      			  	$p=str_replace($m[$i], "xxxxx",$p );
      			  	 	 
      			    }

      			    $i++;
      			}
      	
      	
      return $p;

    }

    public function buyer_approve($enquiry_id,$first_name,$last_name,$buyer_email){



        //Configure::write("debug", 2); 
        // echo "index";
                
       // $TO = '"nv.nithin@gmail.com"';
        

        
        // template value
        
        // $Name =  "Mani";
        // $Value = "50008";
        // $Unique_Id = "dfdsfsadfasdfds";
          
          $this->loadModel('Lead');

        $query="SELECT * FROM quotes
LEFT JOIN offer_categories ON (offer_categories.id=quotes.cat_id) 
LEFT JOIN sub_categories ON(quotes.subcat_id = sub_categories.id)
LEFT JOIN quotecities ON(quotes.locarea_buy=quotecities.id) WHERE enquiry_id='".$enquiry_id."'";;

    $leads=$this->Lead->query($query);

      $TO = '"'.$buyer_email.'"';
       // $buyer_email
       // $CC = '"xerve.retail@gmail.com"';
        $CC = '"xerve.genie@gmail.com"';

        //$CC = '"arunarav@gmail.com"';
        //$CC = '"mani@xerve.in"';//"smani8388@gmail.com", "bnmunireddy@gmail.com",
        
        //$Sub = "Test mail from Mani";
       

     
     $mask=$leads[0]['quotes']['productspec'];
     $b2c=$leads[0]['quotes']['b2c'];
     if($b2c==1){
      $b2c="Personal";
     }else{
      $b2c="Business";
     }

     $sms_sub_category=$leads[0]['subcategories']['sub_category_name'];
     $sms_category=$leads[0]['offer_categories']['category_name'];

     $sms_zone_buy=$leads[0]['quotes']['zone_buy'];
     $sms_city_buy=$leads[0]['quotes']['city_buy'];

      $name = "Anoop";
          $buyer_firstname=$first_name;
          $buyer_lastname=$last_name;
        
          $mask=nl2br($mask);
                                     if($sms_zone_buy !=''){
                                                             $sms_loc=$sms_zone_buy.', '.$sms_city_buy;
                                                            }
                                                       else{
                                                              $sms_loc=$sms_city_buy;
                                                       }

                                                      if($sms_sub_category !=''){ 
                                                                    $tot_cat="(".$sms_sub_category.", ".$sms_category.")";
                                                         }
                                                       else{
                                                             $tot_cat="(".$sms_category.")";
                                                         }
                                                          $Sub="Your Enquiry has been Approved and Sent to ".$tot_cat."";
           /*google urls**/

                                                /*generating my enquiries google url added on 6 march*/
                                                  $my_enquiries = 'www.xerve.in/myaccount/my_enquiries';
                                                  $apiKey = 'AIzaSyCCe-FLs8hLmMb1CgoAEbNoMFTXiuJAZaQ';

                                                $postData=array('longUrl' => $my_enquiries, 'key' => $apiKey);
                                                $jsonData = json_encode($postData);

                                                 
                                                 //$jsonData= json_encode($postData);
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

                                                $my_enquiries_url = $shortLink_buyer['id'];
                                               
                                              /*generating my enquiries google url  29 may*/


                                             /*Generating Enquiry Details Google Url added on 29 may*/
                                                 
                                               

                    

                   

          if($name == 'Anoop'){ $city_name = "in Bangalore";}else{ $city_name = "in Hyderabad"; }
      //  $html = $this->assign_data($Name,$Value,$Unique_Id);
            // $html = "test mail for the admin";

         $html = "Hi $buyer_firstname $buyer_lastname,<br /><br />We have approved and sent Your Enquiry to relevant Sellers in $sms_loc.<br /><br /> <b>Enquiry Id:  $enquiry_id</b> <br /><br /><b>Enquiry Type:  $b2c </b><br /><br /><b>Category: </b> $tot_cat <br /><br /><b>Your Location: </b> $sms_loc<br /><br /><b> Your Requirement: </b><br /><br /><div >$mask</div><br /><br />...............................................................................................................................<p />To View All Your Enquiries & Multiple Vendors Responses:.<a href='www.xerve.in/myaccount/my_enquiries' target='_blank'>$my_enquiries_url</a>.<br/>(Login to Xerve and Visit My Account - My Enquiries)<br/>...............................................................................................................................<p />if you have any queries or feedback, please feel free to contact us and help us serve you better.<br/><br/>Thank you.<br/><br/>Best Regards,<br/><br/>Xerve Team.<br/><a href='https://www.xerve.in/' target='_blank'></a><br/><br/>T: 080 - 41155811<br/>E: <a href='mailto:support@xerve.in' target='_blank'>support@xerve.in</a><br/><br/>-------------------------------------------------------------------<br/><b>Xerve.in - India&#39;s No. 1 Buying Assistant.</b>™<br/>For All Personal and Business Buying Needs.<br/>-------------------------------------------------------------------";

         //echo $html;
        // ses-send-email.pl -f "My Name <MyEmail@mydomain.com>" 

         
        
        $str = "sudo aws ses send-email --region us-west-2 --from xerve.genie@gmail.com --destination '".'{"ToAddresses":  ['.$TO.'],"CcAddresses":  ['.$CC.']}' ."'".' --message '."'".'{"Subject": {"Data": "'.$Sub.'","Charset": "UTF-8"},"Body": {"Html": {"Data": "'.$html.'","Charset": "UTF-8"}}}'."'"; //exit;
          
        //echo $str; 
        
        $result = shell_exec($str);
        
        //echo "Mail Sent!!<pre>";print_r($result);echo "</pre>"; 
        
    }


   

   
    

}
