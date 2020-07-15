<?php
App::uses('AppController', 'Controller');
CakePlugin::load('Uploader');
App::uses('CakeTime', 'Utility');
App::uses('CakeEmail', 'Network/Email'); 
App::import('Vendor', 'Uploader.Uploader');

class LeadsController extends AppController {
   var $uses = array('Lead');   
   var $helpers = array('Form', 'Html', 'Session','Time', 'Text','Paginator');
   public $components = array('RequestHandler','SolrServer','Paginator','Session');
	
function beforeFilter() { 
  if($_SERVER['REMOTE_ADDR']=='106.51.18.247'){
    //Configure::write('debug', 2); 
   }   
    parent::beforeFilter();
     
    $this->Auth->allow('getAreas','index','getSubcategories','selectquoteajax','getBusinessList','stopquote','chaton','chatoff','ajaxupdate','ajaxsend','listquotes','chat_history','chatintro','contact_client','quote_form','getmsgcnt','getmsgcntajax','mask_field_index','ajaxadd','ajaxfileupload','credit_report','mark_read','leads_cron_update','category_ajax','category_ajax_for_detail','check_lead_paid','provide_credits','getcreditsajax','chatlogoff','chatlogin','update_enquiry_time','track_number','verify_guest_otp','website_update','attachsend','mark_read_onload','pay_response','update_offers','prices_response','get_seller_contact_prio_ajax','get_username');
      
      $redisObj = new Redis();            
      $this->set("redisObj",$redisObj);
  }
////////////////////////////////////////////////////////////
//Listing Enquiry Lists in Leads Index page
///////////////////////////////////////////////////////////
public function index($Start_Name=0,$Comp = 'full',$Category_name="",$Area_name="",$City_name="",$For="") {
    $Yes_Full = 0;
    $redisObj = new Redis();    
    $this->openRedisConnection('127.0.0.1', 6379,$redisObj);
    if (!strstr($Start_Name, 'XRVL')) {
       $User_Id = $this->Auth->user('id');
                    if($User_Id){
                                $buyerstatus= $this->Auth->user('status');
                                if($buyerstatus == 0){
                                 $jsonSellerId = $this->getValueFromKey("Red_offind_seller_id".$User_Id,$redisObj);
                                 $sidquery = json_decode($jsonSellerId,true); 
                                if(empty($sidquery)){
                                 $sidquery="SELECT seller_id FROM offline_sellers WHERE seller_type=1 AND vid='".$User_Id."'";
                                 $sidquery = $this->Lead->query($sidquery);
                                 $sidquery_json = json_encode($sidquery);
                          $this->setValueWithTtl("Red_offind_seller_id".$User_Id, $sidquery_json , 86400,$redisObj);
                                }
                                    $sidsellerid=$sid_query[0]['offline_sellers']['seller_id'] ;
                                    $this->set('sid_id',$sidsellerid);
                                }
                    }
if (!$this->RequestHandler->isAjax() && (!empty($this->request->query['need']) || !empty($this->request->query['for']) || !empty($this->request->query['p']) || !empty($this->request->query['category']) || !empty($this->request->query['subcategory']) || !empty($this->request->query['city']) || !empty($this->request->query['area']) ) ) {
                // $this->layout = "404error";
            
            }else{
        $Field_Array = array('Category','Subcategory','City','Area','For');
        if(!empty($Start_Name)){
                $Start_New = explode("-", $Start_Name);
               if (in_array(ucfirst($Start_New[0]), $Field_Array)){
                   $Field_Value1 = preg_replace("/".$Start_New[0]."-/", "",$Start_Name,1);
                   $this->request->query[$Start_New[0]] = $Field_Value1;                                  
                   if($Start_New[0] != 'price' && $Start_New[0] != 'sortby' && $Start_New[0] != 'search')
                     $field_cookie[] = $For_New[0];
               }
            }
             if(!empty($Category_name)){
                $Category_New = explode("-",$Category_name);
                if(in_array(ucfirst($Category_New[0]),$Field_Array)){
                    $Field_Value2 = preg_replace("/".$Category_New[0]."-/", "",$Category_name,1);
                    $this->request->query[$Category_New[0]] = $Field_Value2;
                        $field_cookie[] = $Category_New[0];
                }
            }
            if(!empty($City_name)){
                $City_New = explode("-",$City_name);
                if(in_array(ucfirst($City_New[0]), $Field_Array)){
                    $Field_Value3 = preg_replace("/".$City_New[0]."-/", "",$City_name,1);
                    $this->request->query[$City_New[0]] = $Field_Value3;
                        $field_cookie[] = $City_New[0];
                }
            }
            if(!empty($Area_name)){
                $Area_New = explode("-",$Area_name);
                if(in_array(ucfirst($Area_New[0]),$Field_Array)){
                    $Field_Value4 = preg_replace("/".$Area_New[0]."-/", "",$Area_name,1);
                    $this->request->query[$Area_New[0]] = $Field_Value4;
                        $field_cookie[] = $Area_New[0];
                }
            }
              if(!empty($For)){
                $For_New = explode("-", $For);
               if (in_array(ucfirst($For_New[0]), $Field_Array)){
                   $Field_Value5 = preg_replace("/".$For_New[0]."-/", "",$For,1);
                   $this->request->query[$For_New[0]] = $Field_Value5;                                  
                   if($For_New[0] != 'price' && $For_New[0] != 'sortby' && $For_New[0] != 'search')
                     $field_cookie[] = $For_New[0];
               }
            }
             /*hided for the purpose of removing business type*/
            /*if(!empty($this->request->query['for']))
                $For = ucfirst($this->request->query['for']);
            else
                $For = 'Personal';*/
            /*hided for the purpose of removing business type*/
        $this->loadModel('Lead');
        ini_set('memory_limit', '512M');
        $buyer_id = $this->Auth->user('status');
        $this->set('user_id', $User_Id);
        $condition="status = 1";
        if($this->RequestHandler->isAjax()){
            $this->layout = "ajax";
            $this->set("ajaxLoding","yes");
             if(!empty($this->request->query['filter_order']))
                $filter_order = $this->request->query['filter_order'];
            if(!empty($this->request->query['field_name']))
                $field_name = $this->request->query['field_name'];
            if ($this->request->query['pageview']!='shop') {
           $field_cookie = explode("-", $filter_order);
            if (!in_array(strtolower($field_name), $field_cookie)) {
                $field_cookie[] = strtolower($field_name);
            }else{  
                $field_name1 = str_replace("_", "", $field_name);
                if (empty($this->request->query[strtolower($field_name1)])){
                    foreach ($field_cookie as $k_S => $v_S) {
                        if (strtolower($field_name) == $v_S) {
                            unset($field_cookie[$k_S]);
                        }
                    }
                   
                }
            }
        }
        }else{
            $this->layout = "leads";
        }                   
}//404 error
        $Cookie_Str1_main = $field_cookie;
        $this->set('field_cookie', $field_cookie);
        if(!empty($this->request->query['viewlist']))
        $Viewby = $this->request->query['viewlist'];
        else
        $Viewby = 'list';
  
        if(!empty($this->request->query['device']))
        $device = $this->request->query['device'];
        else
        $device = 'Desktop';
        if(!empty($this->request->query['category']))
        $Category = $this->request->query['category'];
        if(!empty($this->request->query['for']))
        $For = $this->request->query['for'];
        if(!empty($this->request->query['subcategory']))
        $SubCategory = $this->request->query['subcategory'];
        if(!empty($this->request->query['city']))
        $City = $this->request->query['city'];
        if(!empty($this->request->query['area']))
        $Area = $this->request->query['area'];
        if(!empty($this->request->query['parse']))
        $Parse  = $this->request->query['parse'];
        if(!empty($this->request->query['q']))
        $Search = $this->request->query['q'];  
        if(!empty($this->request->query['c']))
        $Suggest = $this->request->query['c']; 
        if(!empty($this->request->query['p']))
        $Home = $this->request->query['p'];
        $Order_By = "";
        if (!empty($Search)) {
                 $query = "q=" . urlencode("$Search") . "&defType=dismax" . $Order_By;
        }else{
          $query = "q=*".$Order_By;
        }         
        $query .= "&qf=" . urlencode("title_ngram text_exact_match")."&pf=" . urlencode("text_general_exact");
            $query .= "&start=0&rows=0&facet=false";   
            $params_P = "&fq=quote_for:Personal&indent=true&facet.mincount=1";
          $results_P = $this->SolrServer->fireQueryToSolr('offline_quotes', $query , $params_P.$params_E);
          $params_B = "&fq=quote_for:Business&indent=true&facet.mincount=1";
          $results_B = $this->SolrServer->fireQueryToSolr('offline_quotes', $query , $params_B.$params_E);
          if (!empty($Search)) {
                   $query = "q=" . urlencode("$Search") . "&defType=dismax" . $Order_By;
          }else{
            $query = "q=*".$Order_By;
          }         
         $query .= "&qf=" . urlencode("title_ngram text_exact_match")."&pf=" . urlencode("text_general_exact");
          $query .= "&start=0&rows=0&facet=false";    
          $params_P = "&fq=status:1";
          $results_LP = $this->SolrServer->fireQueryToSolr('leads', $query , $params_P.$params_L);
          $params_B = "&fq=status:1";
          $results_LB = $this->SolrServer->fireQueryToSolr('leads', $query , $params_B.$params_L);
          $cnt['price'] = $results_P['response']['numFound']+$results_B['response']['numFound'];
          $cnt['leads'] = $results_LP['response']['numFound']+$results_LB['response']['numFound'];
          $this->set('cnt',$cnt);
        $Order_By = "";
        if (!empty($Search)) {
                 $query = "q=" . urlencode("$Search") . "&defType=dismax" . $Order_By;
        }else{
          $query = "q=*".$Order_By;
        }         
        $query .= "&qf=" . urlencode("title_ngram text_exact_match")."&pf=" . urlencode("text_general_exact");
        $query .= "&start=0&rows=0&facet=false";   
        $params_P = "&fq=quote_for:Personal&indent=true&facet.mincount=1";
        $results_P = $this->SolrServer->fireQueryToSolr('offline_quotes', $query , $params_P.$params_E);
        $params_B = "&fq=quote_for:Business&indent=true&facet.mincount=1";
        $results_B = $this->SolrServer->fireQueryToSolr('offline_quotes', $query , $params_B.$params_E);
        if (!empty($Search)) {
                 $query = "q=" . urlencode("$Search") . "&defType=dismax" . $Order_By;
        }else{
          $query = "q=*".$Order_By;
        }         
        $query .= "&qf=" . urlencode("title_ngram text_exact_match")."&pf=" . urlencode("text_general_exact");
        $query .= "&start=0&rows=0&facet=false";    
        $params_P = "&fq=status:1";
        $results_LP = $this->SolrServer->fireQueryToSolr('leads', $query , $params_P.$params_L);
        $params_B = "&fq=status:1";
        $results_LB = $this->SolrServer->fireQueryToSolr('leads', $query , $params_B.$params_L);
        $cnt['price'] = $results_P['response']['numFound']+$results_B['response']['numFound'];
        $cnt['leads'] = $results_LP['response']['numFound']+$results_LB['response']['numFound'];
        $this->set('cnt',$cnt);
        $lazyload = $this->request->query['lazyload'];
        $Sort_Array["For"] = "For";
        $Sort_Array["Category"] = "Category";
        $Sort_Array["SubCategory"] = "SubCategory";
        $Sort_Array["City"] = "City";
        $Sort_Array["Area"] = "Area";   
        $Home_get = 0;    
        //for the removal of the hyphen for the variables'
        if(!empty($Category)){
                $Category = str_replace("-", " ", $Category);
                $Category = str_replace("—", "-", $Category);
                $Home_get = 1;
            }
            if(!empty($SubCategory)){
                 $SubCategory = str_replace("-", " ", $SubCategory);
                $SubCategory = str_replace("—", "-", $SubCategory);
                $Home_get = 1;
            } 
            if(!empty($City)){
                 $City = str_replace("-", " ", $City);
                $City = str_replace("—", "-", $City);
                $Home_get = 1;
            }
            if(!empty($Area)){
                 $Area = str_replace("-", " ", $Area);
                $Area = str_replace("—", "-", $Area);
                $Home_get = 1;
            }       
            if (empty($Search) && empty($Home_get)) {
            $Home = "main";
            }
        $Self = 0;            
        $Where_Catch='';
        $params_count = '';
        $params = '';
        $Order_By = '';
        if ($Viewby == 'grid') {
            if (!empty($Home))
                $rows = 4;
            else
                $rows = 12;
        }else {
            if (!empty($Home))
                $rows = 4;
            else 
                $rows = 24; 
        }
                    $params .= "&fq=(status:1+OR+status:5)";
                    $params .="&fq=one2one:0";
                  $params .= "&facet.mincount=1&facet.sort=index&facet.limit=100";
                  if(!empty($Category)){
             $Category = str_replace("-", " ", $Category);
              $Where_Catch .= "Category".$Category;
              $Self = 1;
                $CategoryArray = explode('|', $Category);
                 foreach ($CategoryArray as $key => $val) {
                   if ($key == 0) {
                      $params .= '&fq=category_ngram:"' . urlencode($val) . '"';
                      $params_count .= '&fq=category_ngram:"' . urlencode($val) . '"';
 
                   }else{
                     $params .= '%20and%20category_ngram:"' . urlencode($val) . '"';
                     $params_count .= '%20and%20category_ngram:"' . urlencode($val) . '"';
                   }
                 }
          }
          if(!empty($SubCategory)){
            $SubCategory = str_replace('-',' ', $SubCategory);
            $Where_Catch .= "SubCategory".$SubCategory;
              $Self = 1;
            $SubCategoryArray = explode('|', $SubCategory);
            foreach ($SubCategoryArray as $keysu => $valuesu) {
               if ($keysu == 0) {
                      $params .= '&fq=sub_category_ngram:"' . urlencode($valuesu) . '"';
                      $params_count .= '&fq=sub_category_ngram:"' . urlencode($valuesu) . '"';
                   }else{
                     $params .= '%20and%20sub_category_ngram:"' . urlencode($valuesu) . '"';
                     $params_count .= '%20and%20sub_category_ngram:"' . urlencode($valuesu) . '"';
                   }
            }
          }
          if(!empty($City)){
            $City = str_replace("-", " ", $City);
            $Where_Catch .= "City".$City;
              $Self = 1;
            $CityArray = explode('|',$City);
            foreach ($CityArray as $keyc => $valuec) {
               if ($keyc == 0) {
                      $params .= '&fq=city_ngram:"' . urlencode($valuec) . '"';
                      $params_count .= '&fq=city_ngram:"' . urlencode($valuec) . '"';
                   }else{
                     $params .= '%20and%20city_ngram:"' . urlencode($valuec) . '"';
                     $params_count .= '%20and%20city_ngram:"' . urlencode($valuec) . '"';
                   }
            }
          }

          if(!empty($For)){
            $For = str_replace("-", " ", $For);
            $Where_Catch .= "For".$For;
              $Self = 1;
            $ForArray = explode('|',$For);
           // print_r($ForArray);
            foreach ($ForArray as $keyc => $valuec) {
               if ($keyc == 0) {
                      $params .= '&fq=lead_for_exact:"' . ucfirst($valuec) . '"';
                      $params_count .= '&fq=lead_for_exact:"' . ucfirst($valuec) . '"';
                   }else{
                     $params .= '%20and%20lead_for_exact:"' . ucfirst($valuec) . '"';
                     $params_count .= '%20and%20lead_for_exact:"' . ucfirst($valuec) . '"';
                   }
            }
          }
          if(!empty($Area)){
            $Area = str_replace("-"," ",$Area);
            $Where_Catch .= "Area".$Area;
              $Self = 1;
            $AreaArray = explode('|', $Area);
            foreach ($AreaArray as $keya => $valuea) {
                 if ($keya == 0) {
                      $params .= '&fq=area_ngram:"' . urlencode($valuea) . '"';
                      $params_count .= '&fq=area_ngram:"' . urlencode($valuea) . '"';
                   }else{
                     $params .= '%20and%20area_ngram:"' . urlencode($valuea) . '"';
                     $params_count .= '%20and%20area_ngram:"' . urlencode($valuea) . '"';
                   }
            }
            }
               // if ($For == "Business")
                    $bus_facet = "&facet.field=sub_category_name_exact";
               // else
                   // $bus_facet = "";
                $params .= "&facet.field=lead_for_exact&facet.field=category_name_exact" . $bus_facet . "&facet.field=city_name_exact&facet.field=area_name_exact";
                $Order_By =  "&sort=approval_time+desc";
                if (!empty($Search)) {
                     $query = "q=" . urlencode("$Search") . "&defType=dismax" . $Order_By;

                }else{
                    $query = "q=*".$Order_By;
                }         
                $query .= "&qf=" . urlencode("title_ngram text_exact_match")."&pf=" . urlencode("text_general_exact");
                $query .= "&start=0&rows=1000&facet=true&omitHeader=true";
                $results = $this->SolrServer->fireQueryToSolr("leads", $query , $params);
                $quotes=$results['response']['docs'];
                $tot_cnt = $results['response']['numFound'];
                if ($User_Id==95449) {
                    //echo "<pre>";print_r($results);die; 
                } 
                $Where_Catch = str_replace(" ", "-", $Where_Catch);
                $LeadFor_Combo =  Cache::read('LeadFor_Combo_cache_Leads'.$Where_Catch. $Search, 'long');
                $Category_Combo =  Cache::read('Cat_Combo_cache_Leads'.$Where_Catch. $Search, 'long');
                $SubCategory_Combo  = Cache::read('SubCat_Combo_cache_Leads'.$Where_Catch. $Search, 'long');
                $City_Combo = Cache::read('City_Combo_cache_Leads'.$Where_Catch. $Search,'long');
                $Area_Combo = Cache::read('Area_Combo_cache_Leads'.$Where_Catch. $Search,'long');
                $LeadFor_Combo_home =  Cache::read('LeadFor_Combo_cache_Leads', 'long');
                $Category_Combo_home =  Cache::read('Cat_Combo_cache_Leads', 'long');
                $SubCategory_Combo_home  = Cache::read('SubCat_Combo_cache_Leads', 'long');
                $City_Combo_home = Cache::read('City_Combo_cache_Leads','long');
                $Area_Combo_home = Cache::read('Area_Combo_cache_Leads','long');//updated 18 th may
        if (!empty($quotes)) {
            $LeadFor_Combo = $results['facet_counts']['facet_fields']['lead_for_exact'];
            Cache::write('LeadFor_Combo_cache_Leads'.$Where_Catch. $Search, $LeadFor_Combo, 'long');
            $Category_Combo = $results['facet_counts']['facet_fields']['category_name_exact'];
            Cache::write('Cat_Combo_cache_Leads'.$Where_Catch. $Search, $Category_Combo, 'long');
            $SubCategory_Combo = $results['facet_counts']['facet_fields']['sub_category_name_exact'];
            Cache::write('SubCat_Combo_cache_Leads'.$Where_Catch. $Search, $SubCategory_Combo, 'long');
            $City_Combo = $results['facet_counts']['facet_fields']['city_name_exact'];
            Cache::write('City_Combo_cache_Leads'.$Where_Catch. $Search,$City_Combo,'long');
            $Area_Combo = $results['facet_counts']['facet_fields']['area_name_exact'];
            Cache::write('Area_Combo_cache_Leads'.$Where_Catch. $Search,$Area_Combo,'long');
         }
           if (!empty($Self)) {
            $url = $_SERVER['REQUEST_URI'];
            $url_parsed = parse_url($url);
            parse_str($url_parsed['query'], $url_parts);
            foreach ($Cookie_Str1_main as $key => $val) {
                $key = strtolower($val);
                if ($key == 'category' || $key == 'subcategory' || $key == 'city' || $key == 'area' || $key == 'type' || $key == 'gender' || $key == 'brand' || $key == 'for') {
                    if ($key == 'subcategory') {
                        $Sort_Arr_Order["SubCategory"] = "SubCategory";
                        $Field_name["SubCategory"] = "SubCategory";
                    } else {
                        $Sort_Arr_Order[ucfirst($key)] = ucfirst($key);
                        $Field_name[ucfirst($key)] = ucfirst($key);
                    }
                }
            }
            if (!empty($Sort_Arr_Order))
                $Sorted_Array = array_replace(array_flip($Sort_Arr_Order), $Sort_Array);
            else
                $Sorted_Array = $Sort_Array;

            $Sort_Array = array_values($Sorted_Array);
        }
        if (!empty($Search)) {
           $query_filter1 = "q=" . urlencode("$Search") . "&defType=dismax" . $Order_By;

        }else{
          $query_filter1 = "q=*".$Order_By;
        }         
         $query_filter1 .= "&qf=" . urlencode("title_ngram text_exact_match")."&pf=" . urlencode("text_general_exact");
        $query_filter1 .= "&start=0&rows=0&facet=true"; 
       $params_all_offer = "&indent=true&facet.mincount=1&facet.field=lead_for&facet.sort=index&facet.limit=201&fq=status:1";
         $search_for_cache = '';
        $selections_count = 0;
        $WC_Category = "";
        $WC_Sub_Category = "";   
        $WC_City= "";
        $WC_Area = "";
        $WC_For = "";
          foreach ($Field_name as $key_s => $value) {
            if ($value == 'Category') {
                $Category_filter = 1;          
                $search_for_cache_s = str_replace(" ", "-", $search_for_cache);
                if (empty($Cat_Combos_home_filter)) {
                    $query_filter = $this->SolrServer->fireQueryToSolr("leads", $query_filter1 . "&mm=$mm_countval", $params_all_offer . "&facet.field=category_name_exact" . $params_filter);
                      $Cat_Combos_home_filter = $query_filter['facet_counts']['facet_fields']['category_name_exact'];
                     Cache::write('Cat_Combo_cache_Leads' . $search_for_cache_s . $Search, $Cat_Combos_home_filter, 'long');
                }
                $CategoryArray = explode('~', $Category);
                foreach ($CategoryArray as $key => $val) {
                    if ($key == 0) {
                        $params_filter .= '&fq=category_ngram:"' . urlencode($val) . '"';
                        $params_for_brand .= '&fq=category_ngram:"' . urlencode($val) . '"';
                    } else {
                        $params_filter .= '%20and%20category_ngram:"' . urlencode($val) . '"';
                        $params_for_brand .= '%20and%20category_ngram:"' . urlencode($val) . '"';
                    }
                }
            }
            if ($value == 'For') {
                $For_filter = 1;          
                $search_for_cache_s = str_replace(" ", "-", $search_for_cache);
                if (empty($LeadFor_Combos_home_filter)) {
                    $query_filter = $this->SolrServer->fireQueryToSolr("leads", $query_filter1 . "&mm=$mm_countval", $params_all_offer . "&facet.field=lead_for_exact" . $params_filter);
                      $LeadFor_Combos_home_filter = $query_filter['facet_counts']['facet_fields']['lead_for_exact'];
                     Cache::write('LeadFor_Combo_cache_Leads' . $search_for_cache_s . $Search, $LeadFor_Combos_home_filter, 'long');
                }
                $ForArray = explode('~', $For);
                foreach ($ForArray as $key => $val) {
                    if ($key == 0) {
                        $params_filter .= '&fq=lead_for_exact:"' . ucfirst($val) . '"';
                        $params_for_brand .= '&fq=lead_for_exact:"' . ucfirst($val) . '"';
                    } else {
                        $params_filter .= '%20and%20lead_for_exact:"' . ucfirst($val) . '"';
                        $params_for_brand .= '%20and%20lead_for_exact:"' . ucfirst($val) . '"';
                    }
                }
            }
           if ($value == 'SubCategory') {
                $SubCategory_filter = 1;
                $search_for_cache_s = str_replace(" ", "-", $search_for_cache);
                if (empty($Category)) {
                    $SubCategoryArray = explode('~', $SubCategory);
                    foreach ($SubCategoryArray as $key => $val) {
                        $category_cache_sub = $val;
                        $category_cache_sub = str_replace(" ", "-", $category_cache_sub);
                        if (empty($category_list_cache)) {
                            $params_for_cate = '&fq=sub_category_ngram:"' . urlencode($val) . '"';
                            $query_filter = $this->SolrServer->fireQueryToSolr("leads", $query_filter1 . "&mm=$mm_countval", $params_all_offer . "&facet.field=category_name_exact" . $params_for_cate);
                            $category_list_cache = $query_filter['facet_counts']['facet_fields']['category_name_exact'];
                             Cache::write('Cat_Combo_cache_Leads'  . $search_for_cache_s . $category_cache_sub . $Search, $category_list_cache, 'long');
                        }
                        foreach ($category_list_cache as $key => $value1) {
                            $Category_list = $key;
                            break;
                        }
                        $Category_cache = str_replace(" ", "-", $Category_list);
                        if (empty($SCat_Combos_home_filrer)) {
                            $params_for_cate = '&fq=category_name_exact:"' . urlencode($Category_list) . '"';
                            $query_filter = $this->SolrServer->fireQueryToSolr("leads", $query_filter1 . "&mm=$mm_countval", $params_all_offer . "&facet.field=sub_category_name_exact" . $params_filter . $params_for_cate);
                            $SCat_Combos_home_filrer = $query_filter['facet_counts']['facet_fields']['sub_category_name_exact'];
                             Cache::write('SubCat_Combo_cache_Leads' . $search_for_cache_s . $Category_cache . $Search, $SCat_Combos_home_filrer, 'long');
                        } else {
                            // $SCat_Combos_home_filrer_tree .= $SCat_Combos_home_filrer;
                        }
                        if (!empty($SCat_Combos_home_filrer_tree)) {
                            $SCat_Combos_home_filrer_total = array_merge($SCat_Combos_home_filrer_tree, $SCat_Combos_home_filrer);
                        } else {
                            $SCat_Combos_home_filrer_total = $SCat_Combos_home_filrer;
                            $SCat_Combos_home_filrer_tree = $SCat_Combos_home_filrer;
                        }
                    }
                    $SCat_Combos_home_filrer = $SCat_Combos_home_filrer_tree;
                } else {
                    if (empty($SCat_Combos_home_filrer)) {
                        $query_filter = $this->SolrServer->fireQueryToSolr("leads", $query_filter1 . "&mm=$mm_countval", $params_all_offer . "&facet.field=sub_category_name_exact" . $params_filter);
                        $SCat_Combos_home_filrer = $query_filter['facet_counts']['facet_fields']['sub_category_name_exact'];
                        Cache::write('SubCat_Combo_cache_Leads' . $search_for_cache_s . $Search, $SCat_Combos_home_filrer, 'long');
                    }
                }
                $SubCategoryArray = explode('~', $SubCategory);
                foreach ($SubCategoryArray as $key => $val) {
                    if ($key == 0) {
                        $params_filter .= '&fq=sub_category_ngram:"' . urlencode($val) . '"';
                        $params_for_brand .= '&fq=sub_category_ngram:"' . urlencode($val) . '"';
                    } else {
                        $params_filter .= '%20and%20sub_category_ngram:"' . urlencode($val) . '"';
                        $params_for_brand .= '%20and%20sub_category_ngram:"' . urlencode($val) . '"';
                    }
                }
            }
            if ($value == 'City') {
                $City_filter = 1;
                $search_for_cache_s = str_replace(" ", "-", $search_for_cache);
                if (empty($City_Combos_home_filrer)) {
                    $query_filter = $this->SolrServer->fireQueryToSolr("leads", $query_filter1 . "&mm=$mm_countval", $params_all_offer . "&facet.field=city_name_exact" . $params_filter);
                    $City_Combos_home_filrer = $query_filter['facet_counts']['facet_fields']['city_name_exact'];
                    Cache::write('City_Combo_cache_Leads' . $search_for_cache_s . $Search, $City_Combos_home_filrer, 'long');
                }
                $CityArray = explode('~', $City);
                foreach ($CityArray as $key => $val) {
                    if ($key == 0) {
                        $params_filter .= '&fq=city_ngram:"' . urlencode($val) . '"';
                        $params_for_brand .= '&fq=city_ngram:"' . urlencode($val) . '"';
                    } else {
                        $params_filter .= '%20and%20city_ngram:"' . urlencode($val) . '"';
                        $params_for_brand .= '%20and%20city_ngram:"' . urlencode($val) . '"';
                    }
                }
            }

            if ($value == 'Area') {
                $Area_filter = 1;
                $search_for_cache_s = str_replace(" ", "-", $search_for_cache);
                if (empty($Area_Combos_home_filrer)) {
                    $query_filter = $this->SolrServer->fireQueryToSolr("leads", $query_filter1 . "&mm=$mm_countval", $params_all_offer . "&facet.field=area_name_exact" . $params_filter);
                     $Area_Combos_home_filrer = $query_filter['facet_counts']['facet_fields']['area_name_exact'];
                    Cache::write('Area_Combo_cache_Leads' . $search_for_cache_s . $Search, $Area_Combos_home_filrer, 'long');
                }
                $AreaArray = explode('~', $Area);
                foreach ($AreaArray as $key => $val) {
                    if ($key == 0) {
                        $params_filter .= '&fq=area_ngram:"' . urlencode($val) . '"';
                        $params_for_brand .= '&fq=area_ngram:"' . urlencode($val) . '"';
                    } else {
                        $params_filter .= '%20and%20area_ngram:"' . urlencode($val) . '"';
                        $params_for_brand .= '%20and%20area_ngram:"' . urlencode($val) . '"';
                    }
                }
            }
            if ($value != 'Brand') {
                $search_for_cache_brand .= $value.$$value;
                $Where_Catch_Filter_brand .= $value.$$value;
            }
            $search_for_cache .= $value.$$value;
            $selections_count++;
            if($value != 'Category')
            $WC_Category .= $value.$$value;
            if($value != 'SubCategory')
            $WC_Sub_Category .= $value.$$value;
            if($value != 'For')
            $WC_For .= $value.$$value;
            if($value != 'City')
            $WC_City .= $value.$$value;
            if($value != 'Area')
            $WC_Area .= $value.$$value;
        }
        if (!empty($Category) && $Category_filter == 1 && !empty($Cat_Combos_home_filter)) {
            $Category_Combo = $Cat_Combos_home_filter;
        }
        if (!empty($For) && $For_filter == 1 && !empty($LeadFor_Combos_home_filter)) {
            $LeadFor_Combo = $LeadFor_Combos_home_filter;
        }
        if (!empty($SubCategory) && $SubCategory_filter == 1 && !empty($SCat_Combos_home_filrer)) {
            $SubCategory_Combo = $SCat_Combos_home_filrer;
        }
        if (!empty($City) && $City_filter == 1 && !empty($City_Combos_home_filrer)) {
            $City_Combo = $City_Combos_home_filrer;
        }
        if (!empty($Area) && $Area_filter == 1 && !empty($Area_Combos_home_filrer)) {
            $Area_Combo = $Area_Combos_home_filrer;
        }
         if (empty($quotes) && empty($Self)) {
            $Category_Combo = $Category_Combo_home;
            $SubCategory_Combo = $SubCategory_Combo_home;
            $City_Combo = $City_Combo_home;
            $Area_Combo = $Area_Combo_home;
            $LeadFor_Combo = $LeadFor_Combo_home;
        }
        if (!empty($Category)) {
            $Category_Array = explode('~', $Category);
            $Cat_Combos_lower = array_change_key_case($Category_Combo, CASE_LOWER);
            foreach ($Category_Array as $key => $value) {
                if (!array_key_exists(strtolower($value), $Cat_Combos_lower)) {
                    $Filter_Other_Category[] = $value;
                }
            }
            if (!empty($Filter_Other_Category)) {
                $Filter_Other_Category1 = implode("~", $Filter_Other_Category);
                $this->set('Filter_Other_Category', $Filter_Other_Category1);
                $sort_Category_order = 1;
                $searchword = $Filter_Other_Category1;
                $Category_Combos_text1 = array();
                $Category_Combos_text2 = array();
                foreach ($Category_Combo as $k => $v) {
                    if (preg_match("/\b$searchword/i", $k)) {
                        $Category_Combos_text1[$k] = $v;
                    } else {
                        $Category_Combos_text2[$k] = $v;
                    }
                }
                if (!empty($Category_Combos_text1) && !empty($Category_Combos_text2)) {
                    array_multisort(array_values($Category_Combos_text1), SORT_DESC, array_keys($Category_Combos_text1), SORT_ASC, $Category_Combos_text1);
                    array_multisort(array_values($Category_Combos_text2), SORT_DESC, array_keys($Category_Combos_text2), SORT_ASC, $Category_Combos_text2);
                    $Category_Combo = $Category_Combos_text1 + $Category_Combos_text2;
                }
            }
        }

        if (!empty($SubCategory)) {
            $SubCategory_Array = explode('~', $SubCategory);
            $SCat_Combos_lower = array_change_key_case($SubCategory_Combo, CASE_LOWER);
            foreach ($SubCategory_Array as $key => $value) {
                if (!array_key_exists(strtolower($value), $SCat_Combos_lower)) {
                    $Filter_Other_SubCategory[] = $value;
                }
            }
            if (!empty($Filter_Other_SubCategory)) {
                $Filter_Other_SubCategory1 = implode("~", $Filter_Other_SubCategory);
                $this->set('Filter_Other_SubCategory', $Filter_Other_SubCategory1);
                $sort_SubCategory_order = 1;
                $searchword = $Filter_Other_SubCategory1;
                $SubCategory_Combos_text1 = array();
                $SubCategory_Combos_text2 = array();
                foreach ($SubCategory_Combo as $k => $v) {
                    if (preg_match("/\b$searchword/i", $k)) {
                        $SubCategory_Combos_text1[$k] = $v;
                    } else {
                        $SubCategory_Combos_text2[$k] = $v;
                    }
                }
                if (!empty($SubCategory_Combos_text1) && !empty($SubCategory_Combos_text2)) {
                    array_multisort(array_values($SubCategory_Combos_text1), SORT_DESC, array_keys($SubCategory_Combos_text1), SORT_ASC, $SubCategory_Combos_text1);
                    array_multisort(array_values($SubCategory_Combos_text2), SORT_DESC, array_keys($SubCategory_Combos_text2), SORT_ASC, $SubCategory_Combos_text2);
                    $SubCategory_Combo = $SubCategory_Combos_text1 + $SubCategory_Combos_text2;
                }
            }
        }


           if (!empty($City)) {
            $City_Array = explode('~', $City);
            $City_Combos_lower = array_change_key_case($City_Combo, CASE_LOWER);
            foreach ($City_Array as $key => $value) {
                if (!array_key_exists(strtolower($value), $City_Combos_lower)) {
                    $Filter_Other_City[] = $value;
                }
            }
            if (!empty($Filter_Other_City)) {
                $Filter_Other_City1 = implode("~", $Filter_Other_City);
                $this->set('Filter_Other_City', $Filter_Other_City1);
                $sort_City_order = 1;
                $searchword = $Filter_Other_City1;
                $City_Combos_text1 = array();
                $City_Combos_text2 = array();
                foreach ($City_Combo as $k => $v) {
                    if (preg_match("/\b$searchword/i", $k)) {
                        $City_Combos_text1[$k] = $v;
                    } else {
                        $City_Combos_text2[$k] = $v;
                    }
                }

                if (!empty($City_Combos_text1) && !empty($City_Combos_text2)) {
                    array_multisort(array_values($City_Combos_text1), SORT_DESC, array_keys($City_Combos_text1), SORT_ASC, $City_Combos_text1);
                    array_multisort(array_values($City_Combos_text2), SORT_DESC, array_keys($City_Combos_text2), SORT_ASC, $City_Combos_text2);
                    $City_Combo = $City_Combos_text1 + $City_Combos_text2;
                }
            }
        }


             if (!empty($Area)) {
            $Area_Array = explode('~', $Area);
            $Area_Combos_lower = array_change_key_case($Area_Combo, CASE_LOWER);

            foreach ($Area_Array as $key => $value) {
                if (!array_key_exists(strtolower($value), $Area_Combos_lower)) {
                    $Filter_Other_Area[] = $value;
                }
            }
            if (!empty($Filter_Other_Area)) {

                $Filter_Other_Area1 = implode("~", $Filter_Other_Area);
                $this->set('Filter_Other_Area', $Filter_Other_Area1);
                $sort_Area_order = 1;
                $searchword = $Filter_Other_Area1;
                $Area_Combos_text1 = array();
                $Area_Combos_text2 = array();

                foreach ($Area_Combo as $k => $v) {
                    if (preg_match("/\b$searchword/i", $k)) {
                        $Area_Combos_text1[$k] = $v;
                    } else {
                        $Area_Combos_text2[$k] = $v;
                    }
                }

                if (!empty($Area_Combos_text1) && !empty($Area_Combos_text2)) {
                    array_multisort(array_values($Area_Combos_text1), SORT_DESC, array_keys($Area_Combos_text1), SORT_ASC, $Area_Combos_text1);
                    array_multisort(array_values($Area_Combos_text2), SORT_DESC, array_keys($Area_Combos_text2), SORT_ASC, $Area_Combos_text2);
                    $Area_Combo = $Area_Combos_text1 + $Area_Combos_text2;
                }
            }
        }
         if (!empty($Home)) {
            ksort($Category_Combo);
            ksort($SubCategory_Combo);
            ksort($City_Combo);
            ksort($Area_Combo);
        } else {
            if ($sort_Category_order != 1) {
                array_multisort(array_values($Category_Combo), SORT_DESC, array_keys($Category_Combo), SORT_ASC, $Category_Combo);
            }
            if ($sort_SubCategory_order != 1) {
                array_multisort(array_values($SubCategory_Combo), SORT_DESC, array_keys($SubCategory_Combo), SORT_ASC, $SubCategory_Combo);
            }
            if ($sort_City_order != 1) {
                array_multisort(array_values($City_Combo), SORT_DESC, array_keys($City_Combo), SORT_ASC, $City_Combo);
            }

            if ($sort_Area_order != 1) {
                array_multisort(array_values($Area_Combo), SORT_DESC, array_keys($Area_Combo), SORT_ASC, $Area_Combo);
            }
        }
        $Sorted_Array_New  = array('Category','SubCategory','City','Area','For','Search');
            $this->set('Sorted_Array_new', $Sorted_Array_New);
            $this->set('WC_Category', $WC_Category);
            $this->set('WC_Sub_Category', $WC_Sub_Category);     
            $this->set('WC_City', $WC_City);
            $this->set('WC_Area', $WC_Area);
            $this->set('WC_For', $WC_For);
            $this->set("Search", $Search);
            $this->set("For", @$For);
            $this->set('Self',$Self);
            $this->set('Home_Value',$Home);
            $this->set('Home',$Home);
            $this->set("Viewby", @$Viewby);
            $this->set("Category", $Category);
            $this->set("SubCategory", $SubCategory);
            $this->set('City',$City);
            $this->set('Area',$Area);
            $this->set("Sorted_Array", $Sort_Array);
            $this->set('Category_Combo',$Category_Combo);
            $this->set('For_Combo',$LeadFor_Combo);
            $this->set('SubCategory_Combo',$SubCategory_Combo);
            $this->set('Area_Combo',$Area_Combo);
            $this->set('City_Combo',$City_Combo);
            $this->set("Sidebar",@$this->request->query['sidebar']);   
            $this->set('Parse',$Parse);
            $this->set('Category_Tree',$Category);     
            $this->set('side',@$this->request->query['side']);
            $this->set('lazyload',$lazyload);    
            $this->set('params_count', $params_count);
            $this->set('Where_Catch', $Where_Catch);
            $this->set('condition', $condition);
            $this->set('quotes',$quotes);
            $this->set("title_for_layout", "Xerve.in : Leads");

          }
          else{
                $this->loadModel('Jchat');
                $this->loadModel('User');
                $this->loadModel('GenieUser');
                $this->loadModel('Quotebid');
                $this->loadModel('Leadaltpayment');
                $this->loadModel('Quotecategory'); 
                $this->loadModel('OfferCategory'); 
                $this->loadModel('SubCategory');
                $this->loadModel('GenieGuest');

                date_default_timezone_set("Asia/Calcutta");
                $Yes_Full=1;
                $For = $Comp;

                $back_path=$this->referer();
                $trace_path=$_SERVER['HTTP_REFERER'];
                        $back=substr($back_path,26,35);
                        $b1=substr($back,0,16);
                        $b2=substr($back,20,35);
                $check_logged_user= $this->Auth->user('id');
                $enquiry_id = $this->request->params['pass'][0]; 
                $sid_id  = $this->request->params['pass'][1];
                $mystring = $sid_id;
                $findme   = 'SID';
                $pos = strpos($mystring, $findme);
                $quoted_user  = $this->request->params['pass'][2];
                if($quoted_user == 'disable'){
                  $disable=$quoted_user;
                }
                if($this->request->params['pass'][3]!=''){//rare condition
                     if($this->request->params['pass'][3]=='disable'){
                     $disable  = $this->request->params['pass'][3];//disable for investors
                     }
                     if($this->request->params['pass'][3]=='success'){
                     $stat  = $this->request->params['pass'][3];//disable for investors
                     }
                     if($this->request->params['pass'][3]=='fail'){
                     $stat  = $this->request->params['pass'][3];//disable for investors
                     }
                    
                }
                 $quoteid=$this->Lead->get_quoteid($enquiry_id);
                 $guest_flag=$this->Lead->get_guest_flag($quoteid);
                 $productspec_sms=$this->Lead->getproductspec($quoteid);
                 $enquiry_time=$this->Lead->getquotetime($quoteid);
                 $quoted_user=$this->Lead->get_quoteuser($quoteid);
                 // $quantity_query =  $this->Lead->query("SELECT full_name,cat_id,quantity,budget,zone_buy,city_buy,genie_url FROM quotes WHERE quoteid='".$quoteid."'");
                 $quantity_query =$this->Lead->get_quote_quan_det($quoteid);
                 $quantity=$quantity_query[0]['quotes']['quantity']; 
                 $budget=$quantity_query[0]['quotes']['budget']; 
                 $zone_buy=$quantity_query[0]['quotes']['zone_buy'];
                 $city_buy=$quantity_query[0]['quotes']['city_buy'];
                 $full_name=$quantity_query[0]['quotes']['full_name'];
                 $cat_id=$quantity_query[0]['quotes']['cat_id'];
                 $genie_url=$quantity_query[0]['quotes']['genie_url'];
                 if($guest_flag ==0){
                    $buyername=$this->GenieUser->get_full_name($quoted_user) ;
                    $buyer_gender=$this->GenieUser->get_gender($quoted_user) ;
                    $buyer_business_email=$this->GenieUser->get_email($quoted_user);
                 }
                 else{
                      $buyername="Customer";
                      $buyer_gender="";
                      $guest_user_id=$this->GenieGuest->get_guest_temp_id($quoted_user);
                 }
                 if($pos === false) {//(leads super market)
                              //second parameter is user id
                              $receiver= $this->Auth->user('id');
                              $buyerstatus= $this->Auth->user('status');
                              if($receiver!=''){
                                    if($buyerstatus ==0){
                                       $sidsellerid=$this->GenieUser->get_offline_sid_id($receiver);
                                    }
                               }
                               else{
                                 $sidsellerid=0;
                               }
                              $this->set('sid_id',$sidsellerid);
                  }
                  else{//found(marketing url)
                        $sid_flag=1;
                        $return_url="https://".$_SERVER["HTTP_HOST"]."".$_SERVER['REQUEST_URI'];
                        if($sid_flag == 1){
                              $receiver=$this->GenieUser->get_offline_seller_id($sid_id);
                              $buyerstatus=$this->GenieUser->get_seller_status($receiver);
                              $check_sid_intro_result =$this->Jchat->get_chatintro_enqid($enquiry_id,$quoted_user,$receiver);
                              $msg_intro_prev_time = strtotime($check_sid_intro_result[0]['messages']['notify_time']);
                              if ((time() - $msg_intro_prev_time) > 180) {
                                          // 5 mins has passed
                                  $read_update=1;
                              }
                              if(count($check_sid_intro_result)==0){
                                  $approval_time=date('Y-m-d H:i:s');
                                  if($guest_flag==0){
                                          $this->Jchat->ins_msg_intro_2($productspec_sms,$enquiry_time,$quoted_user,$receiver,$quoteid,$enquiry_id,0);
                                  }
                                  else{
                                         $this->Jchat->ins_msg_intro_2($productspec_sms,$enquiry_time,$quoted_user,$receiver,$quoteid,$enquiry_id,$guest_user_id);
                                  }
                             }
                        }
                 }
              $userid=$quoted_user;//buyer
              $seller_loc_result=$this->GenieUser->get_user_loc_details($receiver);           
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
              $tot_sel_click=$this->Quotebid->get_seller_contact_prio($quoteid,$receiver);
              $tot_res=$this->Lead->get_tot_contact_prio($quoteid);
              $tot_res=$tot_res + 1;
              /*for left tab elements*/
              $quotes=$this->Lead->get_full_quotes($enquiry_id);
              $CategoryList=$this->Quotecategory->get_category_list_1();
              $category_credits=$this->Quotecategory->getCategory_Credits($quoteid);
              $browser=$this->get_browser();
              $check_seller_category=$this->check_seller_category($User_Id,$quoteid);
              $CategoryName=$this->Quotecategory->get_category_list($quotes['Lead']['quoteid']);
              $SubCategoryList =$this->SubCategory->get_subcategory_list($quotes['Lead']['cat_id']);
              $SubCategoryName=$this->SubCategory->get_quote_subcategory($quotes['Lead']['quoteid']);
               /*eof for left tab elements*/
              $offer  = $this->request->params['pass'][2];
              $session = "online";
              $this->GenieUser->up_user_session($receiver,$session);
              $update_date = date('Y-m-d H:i:s');
              $backpath='leads1';
              $view_seller_contact=$this->GenieUser->view_contact($receiver);
              $view_buyer_contact=$this->GenieUser->view_full_contact($quoted_user,$guest_flag);
              $view_buyer_contact_mask=$this->get_starred($view_buyer_contact);
                  if($disable == ''){
                             if($read_update==1){
                              // $this->Jchat->up_msg_read_stat_1($update_date,$enquiry_id,$quoted_user,$receiver,$backpath,$guest_flag,$guest_user_id=0);
                              }
                  }
             //receiving user status
              if($guest_flag==0){//registered user
                $serverid = $this->GenieUser->get_user($userid, 'ID');
              }
              else{//guest user
                $serverid=$quoted_user;
              }
              $server_username = ucfirst($this->GenieUser->get_user($userid, 'USERNAME'));
              $server_status=$this->get_onlinestatus_buyer($userid,$guest_flag);
              $ServerLastTime=$this->get_session_time_buyer($userid,$guest_flag);
              $productspec= $quotes['Lead']['productspec'];
              $productmask=$quotes['Lead']['productmask'];
              $cat_id=$quotes['Lead']['cat_id'];
              $leads_down= $this->Quotebid->lead_download($receiver,$quoteid);//updated 06-07-17
              $mask=$this->mask_field($productspec,$productmask);
              $get_lead_details=$this->Quotebid->get_quote_offer_web_details($receiver,$quoteid);
              if(($cat_id==80)||($cat_id==88)){
               $get_prefilled=$this->Quotebid->get_prefilled_details($receiver);
                 $this->set('prefill_quoted_website',$get_prefilled_website[0]['quotebids']['website']);
                 $this->set('prefill_quoted_offer',$get_prefilled_offer[0]['quotebids']['quoteoffers']);
              }
              $clientID = $this->GenieUser->get_user($receiver, 'ID');
              $msg_cnt= $this->Jchat->getmsgcnt($clientID,$serverid,$quoteid);
              $clientNAME = ucfirst($this->GenieUser->get_user($receiver, 'USERNAME'));
              $client_status=$this->GenieUser->get_onlinestatus($receiver);
              $LastTime=$this->GenieUser->get_session_time($serverid);
              if($clientID != $quoted_user){
                $sellerid=$clientID;
              }
              else{
                  $sellerid=$serverid;
              }   
              $User_data =$this->GenieUser->get_seller_address($receiver);
              $onlinepay_data = $this->Leadaltpayment->get_on_details($sellerid);
              $offlinepay_data= $this->Leadaltpayment->get_off_details_verified($sellerid);
              $totaldata=array_merge($onlinepay_data,$offlinepay_data);
              $sellername_query =$this->GenieUser->get_seller_details($sellerid);
              $sellername=ucfirst($sellername_query[0]['users']['first_name'])." ".ucfirst($sellername_query[0]['users']['last_name']); 
              $sid_vendorname=$sellername_query[0]['users']['company_name'];
              if($clientID != $quoted_user){
                          $chat_intro=$this->Jchat->getchatintro($quoteid,$clientID);
              }
              $credit_balance=$sellername_query[0]['users']['leads_displays_count']-$sellername_query[0]['users']['leads_displays'];
              if(($sellername_query[0]['users']['leads_displays_count']>0)AND($sellername_query[0]['users']['leads_displays_count']<100))
              {
                $free_credit=1;//has free credits
              }else{
                $free_credit=0;//free credits over
              }
                $b2c=$quotes['Lead']['b2c'];
                if(($quotes['Lead']['genie_url']=='')||($quotes['Lead']['genie_url']==undefined)){
                       if(($quotes['Lead']['cat_id']==88)||($quotes['Lead']['cat_id']==80)){
                         $tot_budget=$quotes['Lead']['budget']*$quotes['Lead']['quantity'];
                       }
                       else{
                       $tot_budget=$quotes['Lead']['budget'];
                       }
                }
                else{
                      if(($quotes['Lead']['cat_id']==88)||($quotes['Lead']['cat_id']==80)){
                         $tot_budget=$quotes['Lead']['budget']*$quotes['Lead']['quantity'];
                       }
                }
                // if(($sid_id=='SID69cb828')||($sid_id=='SID71d1a7d')||($sid_id=='SID4a091b5')){
                       if($quotes['Lead']['one2one']==0){
                            $tot_bud=10;
                       }else{
                            $tot_bud=20;
                       }
                      if($credit_balance >= $tot_bud){
                                    if($sellername_query[0]['users']['ded_cnt']<5){
                                        $free_credits_model=1;
                                        $credit_min=10;
                                        $category_credits_1=10;
                                    }
                                    else{ //not go  pay page
                                           $PayPackage="LITE";
                                           $free_credits_model=2;
                                           $credit_min=$tot_bud;
                                           $category_credits_1=$tot_bud;
                                    }
                     }
                     else{//low balance
                            if($sellername_query[0]['users']['ded_cnt']<5){//will not reach this condition
                                $free_credits_model=1;
                                $credit_min=10;
                                $category_credits_1=10;
                                $leads_debit=10;
                            }
                            elseif(($sellername_query[0]['users']['ded_cnt']>=5)AND($sellername_query[0]['users']['ded_cnt']<10)){
                                   $free_credits_model=3;
                                   $category_credits_1=1;
                                   $PayPackage="TRIAL";
                                   $basic_leads=1;//leads to be credited
                                   $leads_debit=1;
                            }
                            else{
                                    $free_credits_model=4;
                                    $PayPackage="3rd package";
                                    $credit_min=$tot_bud;
                                    $category_credits_1=$tot_bud;
                                    $leads_debit=$category_credits_1;//leads to be credited
                            }
                     }
              //$free_credits_model=1;
              /*Package Details*/
                $PaymentFor="Leads";
                $PaymentMode="ONLINE";
                $mini_leads=$category_credits_1;
                    $check_seller_category=$this->check_seller_category($receiver,$quoteid);
                    $credit_min=$category_credits_1; 
                      if($credit_balance >= $credit_min){  
                         $credit_enabled=1;
                      }
                      else
                      {
                         $credit_enabled=0;
                      }
                    $form_id=$this->Lead->get_formid($quoteid);
                      if($sellerid != ''){
                              $quoteprice=$this->Quotebid->get_formprice($sellerid,$quoteid);
                              $quoteoffers=$this->Quotebid->get_formoffers($sellerid,$quoteid);
                              
                      }
                  $quote_status=$quotes['Lead']['status'];
                  $pause_time=$quotes['Lead']['pause_time'];
                  $buying_date=$quotes['Lead']['buyingdate'];
                  $is_link= $this->link_for_seller($quoteid);
                  $paused_username= $this->get_paused_username($quoteid);
                  $expiry_date=$buying_date;
                  $first_msg_status=$this->Jchat->first_msg_status($quoteid,$sellerid,$quoted_user);
                  $messages_ids = $this->Jchat->get_messages_id($userid,$receiver,$quoteid);

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
                  $this->set('return_url',$return_url);
                  $this->set('sid_flag',$sid_flag);
                  $this->set(compact('msg_cnt'));
                  $this->set('leads_down',$leads_down);
                  $this->set(compact('SubCategoryName','SubCategoryList'));
                  $this->set(compact('CategoryName'));
                  $this->set('check_logged_user',$check_logged_user);
                  $this->set('stat',$stat);
                  $this->set('enquiry_time',$enquiry_time);
                  $this->set('full_name',$full_name);
                  $this->set('sel_cat_id',$cat_id);
                  $this->set('genie_url',$genie_url);
                  $this->set('check_seller_category',$check_seller_category);
                  $this->set('credit_balance', $credit_balance);
                  $this->set(compact('mask'));
                  $this->set(compact('credit_enabled')); 
                  $this->set('check_seller_category',$check_seller_category);
                  $this->set('guest_user_id',$guest_user_id);
                  $this->set('guest_flag',$guest_flag);
                  $this->set('budget',$budget);
                  $this->set('quantity',$quantity);
                  $this->set('buyername',$buyername);
                  $this->set('buyer_business_email',$buyer_business_email);
                  $this->set('buyer_gender',$buyer_gender);
                  $this->set(compact('quoteid'));
                  $this->set('sid_id',$sid_id);
                  $this->set('receiver',$receiver);
                  $this->set('seller_loc',$seller_loc);
                  $this->set('buyer_loc',$buyer_loc);
                  $this->set('seller_prio',$tot_sel_click);
                  $this->set('tot_res',$tot_res);
                  $this->set('quotes',$quotes);
                  $this->set('browser',$browser);
                  $this->set('quoted_website',$get_lead_details[0]['quotebids']['website']);
                  $this->set('quoted_offer',$get_lead_details[0]['quotebids']['quoteoffers']);
                  $this->set(compact('view_buyer_contact_mask'));
                  $this->set(compact('view_seller_contact'));
                  $this->set(compact('view_buyer_contact'));
                  $this->set('full_name',$quotes['Lead']['full_name']);
                  $this->set('sel_cat_id',$quotes['Lead']['cat_id']);
                  $this->set('genie_url',$quotes['Lead']['genie_url']);
                  $this->set('contact_prio',$quotes['Lead']['contact_prio']);
                  $this->set('category_credits', $category_credits);
                  $this->set('PaymentMode', $PaymentMode);
                  $this->set('PayPackage', $PayPackage);
                  $this->set('PaymentFor', $PaymentFor);
                  $this->set('LeadsCredited', $leads_debit);
                  $this->set('mini_credits', $mini_leads);
                  $this->set('free_credits', $free_credits_model);
                  $this->set('category_credits_1', $category_credits_1);
                  $this->set('category_credits_2', $category_credits_2);
                  $this->set(compact('quoteprice'));
                  $this->set('is_link', $is_link);
                  $this->set('paused_username', $paused_username);
                  $this->set('first_msg_status',$first_msg_status);
                  $this->set('Vendor_Name', $sellername);
                  $this->set('quoted_user',$quoted_user);
                  $this->set('buyers_status',$buyerstatus);
                  $this->set('enquiry_id',$enquiry_id);
                  $this->set(compact('productmask'));
                  $this->set(compact('productspec'));
                  $this->set('buyersstatus',$buyerstatus); 
                  $this->set('sender',$userid);         
                  $this->set('quoteid',$quoteid);
                  $this->set('disable',$disable);
                  $this->set('sid_vendorname', $sid_vendorname);
                  $this->set(compact('chat_intro','sellerid','credit_balance'));
                  $this->set('Vendor_Name', $sellername);
                  $this->set('category_credits', $category_credits);
                  $this->set(compact('messages_ids')); 
                  $this->set(compact('pause_time'));
                  $this->set(compact('quote_status')); 
                  $this->set(compact('form_id')); 
                  $this->set(compact('b2c')); 
                  $this->set(compact('buying_date'));
                  $this->set(compact('expiry_date'));
            // Check if is client or server
                  $this->set(compact('serverid','server_username','server_status','ServerLastTime'));   
                  $this->set(compact('clientID','clientNAME','LastTime','client_status'));
              $this->layout = 'quotelayout';
          }//chat page
		        $this->set('Yes_Full', $Yes_Full);
    }

public function listquotes(){
  $this->loadModel('Quotecity'); 
  $this->loadModel('Quotecategory'); 
  $CityList = $this->Quotecity->get_quote_city_list();
  $this->set(compact('CityList'));
  $CategoryList = $this->Quotecategory->get_category_bl_list();
  $this->set(compact('CategoryList'));
  $cat_id = $this->params['url']['cat_id'];
  $city_id = $this->params['url']['city_id'];
  $this->set(compact('cat_id'));
  $this->set(compact('city_id'));
   
    if(($cat_id !=null )AND ($city_id !=null)){
      $this->Paginator->options = array('url' => $this->passedArgs);
      $this->paginate = array(
              'paramType' => 'querystring',
              'conditions' => array('Lead.cat_id'=>$cat_id,'Lead.locarea'=>$city_id),
               'limit' => 3,
             'order' =>array('Lead.enquiry_time' =>'desc'),
             );
      $quotes = $this->paginate('Lead');
      $this->set(compact('quotes'));
    }
}
////////////////////////////////////////////////////////////
  //ADD a quote using ajax functionality
  ///////////////////////////////////////////////////////////
public function ajaxadd() {
    $User_Id = $this->Auth->user('id');
    $this->loadModel('Quotecity');
    $this->loadModel('Lead');
    $this->loadModel('GenieGuest');
    $this->loadModel('LeadLocations');
    $this->loadModel('Quotearea');
    $this->loadModel('User');
    $this->loadModel('GenieUser');
    $enquiry_time=date('Y-m-d H:i:s');
    $Mydata['enquiry_time']=$enquiry_time;
    $latitude=$this->request->data['login_lat1'];
    $member_type=$this->request->data['member_type'];
    $mobile_number=$this->request->data['mobile_number'];
    $unique_ip=$this->request->data['unique_ip'];
    $Mydata['remote_ip']=$_SERVER['REMOTE_ADDR'];
    $Mydata['formid']=1;
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
        }
        else{
             $city_id=$city_id;
        }
        $locarea_buy=$city_id;
        $locarea=$city_id;
        $Mydata['locarea']=$locarea; 
        $Mydata['locarea_buy']=$locarea_buy;
    }
    if(!empty($this->request->data['login_area1'])){
               $login_area_buy = $this->request->data['login_area1'];
               $login_area_buy =  trim($login_area_buy);
               $login_area=$login_area_buy;
               if ($login_area_buy == "0") {
                  $area_id_buy = $login_area_buy;
               }
               else{
                    $area_id = $this->Quotearea->get_quote_area_id($login_area_buy);
                    if($area_id ==''){
                      $area_id_buy=0;
                      $this->Quotearea->set_quote_area($locarea,$login_area_buy);
                    }
                    else{
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
                  }else{//already a activated guest user
                        $this->GenieGuest->up_gg_vc($member_guest_id,$Unique_Id_otp);       
                        $Mydata['guest_flag']=1; 
                        $Mydata['full_name']=$full_name; 
                        $Mydata['user_mode']=0;
                        $Mydata['status']=6;
                        $Mydata['genie_verify_code']=$Unique_Id_otp;
                        $Mydata['user_id']=$member_guest_id;
                  }
                  $this->Lead->save($Mydata);
                  $ID = $this->Lead->id;// in a controller
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
            $ID = $this->Lead->id;// in a controller
            $enquiryid = $this->Lead->enquiry_id;
     }
     $need_activation['quote_id']=$ID;
     $Myloc['quoteid']=$ID;
     $this->LeadLocations->save($Myloc); 
     echo json_encode($need_activation);
     exit();
    }//eof ajax add

public function ajaxfileupload(){
  echo($this->request->data);
  echo json_encode($this->data);
  echo json_encode($_POST);
  echo json_encode($_FILES["attachmenturl"]["tmp_name"]);
  echo json_encode($_FILES["attachmenturl"]["name"]);

  exit();
}

public function verify_guest_otp(){
   $this->loadModel('GenieGuest');
   $this->loadModel('User');
   $this->autoRender = false;
   $this->layout = false; 
   $otp_number=$this->request->data['otp_number'];
   $guest_type=$this->request->data['guest_type'];
   $check_quote_id=$this->request->data['check_quote_id'];
   $quote_status=$this->Lead->get_status($check_quote_id);
        if($guest_type==1){
              $verified_code=$this->GenieGuest->get_verify_code($otp_number);
              $verified=$verify_code[0]['genie_guests']['verify_code'];

         }else{
               $verified_code=$this->Lead->get_verify_code($otp_number);
               $verified=$verify_code[0]['quotes']['genie_verify_code'];
        }
        if($verified == $otp_number){//correct otp
              if($guest_type==1){
                      $this->GenieGuest->up_gg_act($verified);
                       if($quote_status==6){
                            $this->Lead->up_pending_st($check_quote_id);
                       }
               }
               else{
                        $this->Lead->up_pending_st_1($verified);
               }
              $verified=1;
         }
         else{
                $verified=0;
         }
         echo json_encode($verified);
         exit();
 }


public function getcreditsajax() {
      $User_Id = $this->Auth->user('id');
      $this->loadModel('Users');
      $this->loadModel('GenieUser');
      $credit_balance=$this->GenieUser->credit_balance($User_Id);
      echo json_encode($credit_balance);
      exit();
}

public function selectquote($id1,$id2) {
    $this->loadModel('Quotebid');
    $bidno = $this->request->params['pass'][0]; 
    $quoteno = $this->request->params['pass'][1]; 
      if (isset($bidno)) {
                 $id=$this->Quotebid->up_quotebids_sel($bidno);
                 if($id > 0 )
                 { 
                     $id1=$this->Lead->up_pause_st($quoteno);
                      if($id1 > 0)
                      {
                        $this->Quotebid->clear();
                        echo $this->Session->setFlash('Quote For This Enquiries are Finalized');
                      }
                      else //revoke incase of updation errors
                      {
                        $query="UPDATE quotebids SET display=1 where quoteid='".$quoteno."' ";
                        $this->Quotebid->query($query);  
                      }
                  }
          return $this->redirect(array('action' => 'index'));
      }
}

public function credit_report(){
     $this->loadModel('Leadaltpayment');
     $User_Id = $this->Auth->user('id');
     $this->set('User_id', $User_Id);
     $result=$this->Leadaltpayment->get_credit_report($User_Id);
      $this->set('credit_received', $result);
      $credits_utilized_query="";
      $credits_utilized= $this->Lead->query($credits_utilized_query);
      $this->set('credits_utilized', $credits_utilized);
}

public function stopquote(){
    $this->loadModel('Quotebid');
    $pause_time = date( 'Y-m-d H:i:s');   
    $quoteno = $this->request['data']['quoteid'];
    $sellerid = $this->request['data']['sellerid'];
    $reason_pause = $this->request['data']['reason_pause'];
      if (isset($quoteno)) {
          $id=$this->Quotebid->up_quotebids_display($quoteno,0);
          if ($id > 0) {
              $id=$this->Lead->up_full_pause_st($quoteno,$pause_time,$reason_pause);
                    if ($id > 0) {
                                  echo $this->Session->setFlash('Quote For This Enquiries are Finalized');
                    }
                    else //revoke incase of updation errors
                    {
                      $status=1;
                       $id=$this->Quotebid->up_quotebids_display($quoteno,$status);
                    }
          }
      }
    $informstatus['message']="ok";
    header('Content-Type: application/json');
    echo json_encode($informstatus);
    exit();
  } 
////////////////////////////////////////////////////////////
//(when a quote of a seller is selected)
/////////////////////////////////////////////////////////// 
public function selectquoteajax() {
  $this->loadModel('Quotebid');
  $bidno=$this->request['data']['id'];
  $quoteno=$this->request['data']['quoteid'];
      if (isset($bidno)) {
               $id=$this->Quotebid->up_quotebids_sel($bidno);
               if($id > 0 ){ 
                    $id1=$this->Lead->up_pause_st($quoteno);
                    if($id1 > 0)
                    {
                    echo $this->Session->setFlash('Quote For This Enquiries are Finalized');
                    }
                    else //revoke incase of updation errors
                    {
                      $this->Quotebid->up_quotebids_display($quoteno,1);
                    }
                }
        exit();
      }
 }

public function check_status($quoteid) {

   $quote_status = $this->Lead->get_quote_st($quoteid);
   $this->set(compact('quote_status'));
}

public function chatoff(){
      $this->loadModel('GenieUser');
      $enquiry_id = $this->request->params['pass'][0];
      $senderid = $this->request->params['pass'][1];
      $quoteid=$this->Lead->get_quoteid($enquiry_id);
      $user_quote_id=$this->Lead->get_quoteuser($quoteid);
      if($senderid ==$user_quote_id){
        $loggedinuser_id=$user_quote_id;
      }
      else{
        $loggedinuser_id=$senderid;
      }
      $session = "offline";
      $this->GenieUser->up_user_session($loggedinuser_id,$session); 
          if($senderid == $user_quote_id){
               $this->redirect(array('controller' => 'myaccount', 'action' => 'my_enquiries'));
          }
          else{
                $this->redirect(array('controller' => 'leads', 'action' => 'index'));
          }
  }  // logging out from chat dashboard

 
  public function chatoffhome(){
      $this->loadModel('GenieUser');
      $session="offline";
      $enquiry_id = $this->request->params['pass'][0];
      $senderid = $this->request->params['pass'][1];
      $quoteid=$this->Lead->get_quoteid($enquiry_id);
      $user_quote_id=$this->Lead->get_quoteuser($quoteid);
        if($senderid ==$user_quote_id){
             $loggedinuser_id=$user_quote_id;
        }
        else{
             $loggedinuser_id=$senderid;
        }
      $this->GenieUser->up_user_session($loggedinuser_id,$session);
      $this->redirect('http://www.xerve.in');
  }  // logging out from chat dashboard

  public function chatlogoff(){
      $this->loadModel('GenieUser');
      $userid=$this->request['data']['userid'];
      $enquiry_id=$this->request['data']['enquiry_id'];
      $quoteid=$this->request['data']['quoteid'];
      $user_quote_id=$this->Lead->get_quoteuser($quoteid);
      $session="offline";
      $this->GenieUser->up_user_session($userid,$session);
      exit();
  }  

  public function chatlogin(){
      $this->loadModel('GenieUser');
      $session="online";
      $userid=$this->request['data']['userid'];
      $enquiry_id=$this->request['data']['enquiry_id'];
      $quoteid=$this->request['data']['quoteid'];
      $user_quote_id=$this->Lead->get_quoteuser($quoteid);
      $this->GenieUser->up_user_session($userid,$session);
      exit();
  }  


     ///////////////////////////////////////////////
    // Get online status based on a buyer
    /////////////////////////////////////////////
    public function get_onlinestatus_buyer($userid,$guest_flag)
    { 
     // $this->loadModel('User');
      $this->loadModel('GenieUser');
      $this->loadModel('GenieGuest');
      if($guest_flag==0){
              $result =$this->GenieUser->get_session_time($userid);
        }else{
             $result =$this->GenieGuest->get_session_time($userid);
      }   
        return $result;   
    }// Get online status based on a user id

  ///////////////////////////////////////////////
    // Get logged in time based on a user id
    /////////////////////////////////////////////
     public function get_session_time_buyer($serverID,$guest_flag)
    {
      //$this->loadModel('User');
      $this->loadModel('GenieUser');
      $this->loadModel('GenieGuest');
      // Result Query
                if($guest_flag==0){
                            $result =$this->GenieUser->get_session_time($serverid);
                      }else{
                             $result =$this->GenieGuest->get_session_time($serverid);
                      }  
      return $result;     
    }
     //////////////////////////////////////////////////////
    // time conversion
    ////////////////////////////////////////////////////
    private function time_calculation($timestamp)
    {
      $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");

      $lengths = array(60,60,24,7,4.35,12,10);

      $time = strtotime($timestamp);
      
      $now = time();
      
      $difference = $now - $time; 
      $tense = "ago";
      
      for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) 
      {
         $difference /= $lengths[$j];
      }
      
      $difference = round($difference);
      
      if($difference != 1) 
      {
         $periods[$j] .= "s";
      }
      
      $string_result = "$difference $periods[$j] $tense";
      
      return $string_result;  
    }//time calculation
    //////////////////////////////////////////////
    // Fetching Latest Messages 
    ////////////////////////////////////////////
    public function ajaxupdate(){
      $this->autoRender = false;
      $this->layout = false;
      $this->loadModel('Users');
      $this->loadModel('GenieUser');
      $this->loadModel('Jchat');
      date_default_timezone_set("Asia/Calcutta");
      $quoteid=$this->request['data']['quoteid'];
      $userid=$this->request['data']['userid'];
      $serverid=$this->request['data']['serverid'];
      $quoteid=$this->request['data']['quoteid'];
      $guest_flag=$this->request['data']['guest_flag'];
      $username=$this->GenieUser->get_username($userid);
      $servername=$this->GenieUser->get_username($serverid);
      if($guest_flag == 0){
        $messages_ids = $this->Jchat->ajaxupdate($userid,$serverid,$quoteid);
      }
      else{//guest users
         $messages_ids = $this->Jchat->ajaxupdate_guest($userid,$serverid,$quoteid);
      }
      $this->set(compact('messages_ids')); 
      header('Content-Type: application/json');
      echo json_encode($messages_ids);
      exit();
    } // Fetching Latest Messages 

    //////////////////////////////////////////////
    // Introduction Message 
    ////////////////////////////////////////////
    public function chatintro(){
        $this->loadModel('Jchat');
        date_default_timezone_set("Asia/Calcutta");
        $message=addslashes($this->request['data']['message']);
        $userid=$this->request['data']['userid'];
        $serverid=$this->request['data']['serverid'];
        $quoteid=$this->request['data']['quoteid'];
        $enquiry_id=$this->Lead->get_enquiryid($quoteid);
          if(isset($message))
          {   
            
            $attachment='false';
            $intromsg=1;
            $this->Jchat->ins_msg_intro_off($message,$msg_time,$userid,$serverid,$quoteid,$enquiry_id,0,$attachment,0,$intromsg);
            echo json_encode($result); 
          }
         exit();
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
      $sid_id=$this->request['data']['sid_id'];
      $first_msg_status=$this->request['data']['first_unread'];
      $vendor_name=$this->request['data']['vendor_name'];
      $buyer_mob=$this->request['data']['buyer_mobile'];
      $productspec_sms=$this->request['data']['productspec'];
      $productspec_sms=substr($productspec_sms, 0, 10);
      $cnt=$this->Jchat->req_msg_status($enquiry_id,$serverid,$userid);
      if($cnt==1){
          if($buyer_mob !=0){
                         /*short url for sending sms*/
                            $chat_url = 'https://www.xerve.in/genie/'.$enquiry_id.'/'.$sid_id.'/'.$userid;   
                             
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
$sms_message = "Vendor: '$vendor_name' just read Your Message.
Enquiry: $productspec_sms...
Enquiry Id: $enquiry_id
Enquiry Link: $chat_url
Best Regards,
Xerve Team.
www.xerve.in";
                            $mobile=$buyer_mob;
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
                 // if($send_sms==1){

                      // $output=curl_exec($ch);
                              $first_msg_status=0;
                // }
                              curl_close($ch);
         }//valid mobile    
     }
      $backpath="leads2";
      $this->Jchat->up_msg_read_stat($update_date,$enquiry_id,$serverid,$userid,$backpath);
      $this->Lead->up_push_st_2($enquiry_id,$serverid,$userid);
      echo json_encode($first_msg_status);
      exit();
     }//mark_read

 public function mark_read_onload(){
        $this->loadModel('Jchat');
        $this->autoRender = false;
        $this->layout = false;
        date_default_timezone_set("Asia/Calcutta");
        $userid=$this->request['data']['userid'];//95449
        $enquiry_id=$this->request['data']['enquiry_id'];
        $b2c=$this->request['data']['type'];
        $serverid=$this->request['data']['serverid'];//81114
        $update_date = date('Y-m-d H:i:s');
        $sid_id=$this->request['data']['sid_id'];//sid id
        $first_msg_status=$this->request['data']['first_unread'];
        $vendor_name=$this->request['data']['vendor_name'];//buyer name
        $buyer_mob=$this->request['data']['buyer_mobile'];//seller mob
        $productspec_sms=$this->request['data']['productspec'];
        $productspec_sms=substr($productspec_sms, 0, 10);
        $cnt=$this->Jchat->req_msg_status($enquiry_id,$serverid,$userid);
        if($cnt==1){
          $backpath="leads2";
          $this->Jchat->up_msg_read_stat($update_date,$enquiry_id,$serverid,$userid,$backpath);
          $this->Lead->up_push_st_2($enquiry_id,$serverid,$userid);
          echo json_encode($first_msg_status);
        }
        exit();
     }
     public function get_seller_contact_prio_ajax(){ //priority order of sellers who contacted for a quote
       $this->autoRender = false;
       $this->layout  = false;
       $this->loadModel('Quotebid');
       $quoteid=$this->request['data']['quoteid'];
       $seller_id=$this->request['data']['seller_id'];
       $max_cnt=$this->Quotebid->get_seller_contact_prio($quoteid,$seller_id);
       echo json_encode($max_cnt);
       exit();
     }

     public function contact_client(){

        $this->loadModel('Quotebid');
        $this->loadModel('GenieGuest');
        $this->loadModel('GenieUser');
        $this->loadModel('Quotecategory');
        $this->loadModel('Jchat');
        date_default_timezone_set("Asia/Calcutta");
        $userid=$this->request['data']['userid'];
        $quoteid=$this->request['data']['quoteid'];
        $b2c=$this->request['data']['type'];
        $cat_id=$this->request['data']['cat_id'];
        $serverid=$this->request['data']['serverid'];
        $enquiry_id=$this->request['data']['enquiry_id'];
        $tot_res=$this->request['data']['tot_res'];
        $min_credit=$this->request['data']['min_credit'];
        $pay_pkg=$this->request['data']['pay_pkg'];
        $productspec=$this->request['data']['productspec'];
        $productmask=substr($productspec, 0, 10); 
        $leads_down=$this->Quotebid->lead_download($userid,$quoteid);
        $guest_flag=$this->request['data']['guest_flag'];
        $guest_user_id=$this->request['data']['guest_user_id'];
        $tot_sel_click=$this->Quotebid->get_seller_contact_prio($quoteid,$userid);
        $sid_id=$this->GenieUser->get_offline_sid_id($userid);
        $sellername_query =  $this->GenieUser->get_user_basic_details($userid);
          $sellerfname=ucfirst($sellername_query[0]['users']['first_name']); 
          $sellerlname=ucfirst($sellername_query[0]['users']['last_name']); 
          $seller_comp=ucfirst($sellername_query[0]['users']['company_name']);
          $mobile_seller_number=$sellername_query[0]['users']['mobile_number'];
          $ded_cnt=$sellername_query[0]['users']['ded_cnt'];
        if($ded_cnt>5){
            $credit_status=1;//paid
          }else{
            $credit_status=0;//free
        }
        if($guest_flag==0) {
             $buyername_query =  $this->GenieUser->get_user_basic_details($serverid);
             $buyerfname=ucfirst($buyername_query[0]['users']['first_name']); 
             $buyerlname=ucfirst($buyername_query[0]['users']['last_name']);
             $buyer_gender=$buyername_query[0]['users']['name_title'];
              if($buyer_gender ==1){
                $gender="Mr";
              }
              if($buyer_gender ==2){
                $gender="Ms";
              }
              if($buyer_gender ==''){
                $gender="Mr";
              }
        }
        else{
              $mobile_guest_buyer_number=$this->GenieGuest->get_guest_mobile_lat($serverid);
              $buyerfname="Customer";
              $buyerlname="";
              $buyer_gender="";
        }
        if($guest_flag==0){
              $mobile_buyer_number=$buyername_query[0]['users']['mobile_number'];
        }
        else{
              $mobile_buyer_number=$mobile_guest_buyer_number;
        }
        $cat_id=$this->Lead->get_catid($quoteid);
        $category_credits_temp=$this->Quotecategory->getCategory_Credits($cat_id);
        $category_credits=$category_credits_temp;
        $leads_deducted=$category_credits;
        $date_deducted = date('Y-m-d H:i:s');
        $date_deployed = date('Y-m-d H:i:s');
        $revert_date=date('Y-m-d', strtotime("+2 days"));
        if($userid !=''){
                if(($leads_down == 0)||($leads_down =='')||($leads_down ==3)){ //unpaid
                      $this->GenieUser->up_user_credit_ded($min_credit,$userid);
                      $this->Lead->up_priority_cnt($enquiry_id);
                        $count = $this->Quotebid->find('count', array(
                                  'conditions' => array('Quotebid.sellerid' => $userid,'quoteid' =>$quoteid)
                              ));
                      if($count == 0) {//client not informed 
                            if($guest_flag==0){   
                                  $this->Jchat->ins_msg_intro_2($productspec,$date_deducted,$quoted_user,$seller_leads['users']['id'],$quoteid,$enquiry_id,0);
                             }
                             else{  
                               $this->Jchat->ins_msg_intro_2($productspec,$date_deducted,$quoted_user,$seller_leads['users']['id'],$quoteid,$enquiry_id,$guest_user_id);
                            }
                           $this->Quotebid->ins_quotebid_qry($enquiry_id,$quoteid,$userid,$date_deployed,$min_credit,$tot_res,$pay_pkg);
                     }
                     else //client informed
                     {
                       $this->Quotebid->up_quotebids_deduct($enquiry_id,$userid,$date_deployed,$min_credit); 
                       
                     }//client informed
                     $balance=$this->GenieUser->credit_balance($user_id);
                     echo json_encode($balance);            
                      /*generating my enquiries google url for buyer*/
                      $my_chats = 'www.xerve.in/genie/'.$enquiry_id.'/'.$sid_id.'/'.$userid;
                      $apiKey = 'AIzaSyCCe-FLs8hLmMb1CgoAEbNoMFTXiuJAZaQ';
                      $postData=array('longUrl' => $my_chats, 'key' => $apiKey);
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
                      $seller_url = $shortLink_buyer['id'];
                      echo json_encode($seller_url);
                     /*eof google url for buyer*/
                     /*generating my enquiries google url for seller*/
                      $my_chats = 'www.xerve.in/leads/'.$enquiry_id.'/'.$sid_id.'/'.$serverid;
                      $apiKey = 'AIzaSyCCe-FLs8hLmMb1CgoAEbNoMFTXiuJAZaQ';
                      $postData=array('longUrl' => $my_chats, 'key' => $apiKey);
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
                      echo json_encode($chat_url);
                       /*eof google url for seller*/
if($guest_flag==0) { 

  $sms_message="Customer Details for Enquiry '$productmask... (Id: $enquiry_id)' : $buyer_gender. $buyerfname $buyerlname, $mobile_buyer_number | Email or Chat Now with Customer: $chat_url";

}else{

  $sms_message="Customer Details for Enquiry '$productmask... (Id: $enquiry_id)' : $buyerfname, $mobile_buyer_number | Email or Chat Now with Customer: $chat_url";
}

$sms_buyer_message="Seller Details for Enquiry '$productmask... (Id: $enquiry_id)' : $seller_comp, $mobile_seller_number | Email or Chat Now with Customer: $seller_url";
                  if($pay_pkg==1){ 
                    $mobile=$mobile_buyer_number;
                    $to = $mobile;
                    $to = urlencode($to);
                    $sms_message=urlencode($sms_buyer_message);
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
                   $output=curl_exec($ch);
                   curl_close($ch);
                 }               
                            
                  $mobile=$mobile_seller_number;
                  $to = $mobile;
                  $to = urlencode($to);
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
                    if($tot_res<6){
                          if($pay_pkg==2){ 
                                    $output=curl_exec($ch);
                          }

                    }
                    curl_close($ch);
                       /*eof sms*/  
         }// if already not paid
     }//seller is not empty
     exit();
     }
    
     public function ajaxsend(){
      //Configure::write('debug',2);
        $function_start_time = date("H:i:s");
        $this->autoRender = false;
        $this->layout = false;
        date_default_timezone_set("Asia/Calcutta");
        $this->loadModel('Jchat');
        $this->loadModel('Quotebid');
        $this->loadModel('GenieUser');
        $this->loadModel('PushNotification');
        $this->loadModel('Quotecategory');
        $this->loadModel('Subcategory');
        $msg_date=date('Y-m-d');
        $b2c=$this->request['data']['b2c'];
        $userid=$this->request['data']['userid'];//logged in 
        $serverid=$this->request['data']['serverid'];//receiver
        $guest_flag=$this->request['data']['guest_flag'];
        $guest_user_id=$this->request['data']['guest_user_id'];
        $quoteid=$this->request['data']['quoteid'];
        $product_spec=$this->request['data']['productspec'];
        $enquiry_id=$this->request['data']['enquiry_id'];
        $msg_time= $this->request['data']['chat_msg_time'];
        $offers= $this->request['data']['offers'];
        $website= $this->request['data']['website'];
        $quoted_offers= $this->request['data']['quoted_offer'];
        $quoted_website= $this->request['data']['quoted_website'];
        $fbbuyeremail=$this->request['data']['fbbuyeremail'];
        $seller_lead=$this->Lead->get_full_quotes($enquiry_id);
        /*setting quote details and category*/
                $email_b2c= $seller_lead['Lead']['b2c'];
                if($email_b2c==1){$bus_type="Personal";}else{$bus_type="Business";}
                $email_city_buy= $seller_lead['Lead']['city_buy'];
                $email_city= $seller_lead['Lead']['city'];
                $email_productspec= $seller_lead['Lead']['productspec'];
                $productmask= $seller_lead['Lead']['productmask'];
                $email_area_buy= $seller_lead['Lead']['zone_buy'];
                $email_area= $seller_lead['Lead']['zone'];
                $masked=$this->mask_field(strip_tags($email_productspec),$productmask);
                $mask=$this->mask_field(strip_tags($email_productspec),$productmask);
                $quoted_user=$seller_lead['Lead']['user_id'];
                $email_blcatid= $seller_lead['Lead']['cat_id'];
                $email_subcatid= $seller_lead['Lead']['subcat_id'];
                $sms_category=$this->Quotecategory->get_category_details($email_blcatid);
                if($email_subcatid>0){
                  $sms_sub_category=$this->SubCategory->get_quote_subcategory_details($email_subcatid);
                }
                $sms_sub_category=$sub_category_query_result[0]['sub_categories']['sub_category_name'];
        /*eof setting quote details and category*/
        if(($quoted_offers=='')||($quoted_website=='')){
           $set ="listing_id='1' ";
           if($website!=''){ 
              $set .=" ,website='".$website."' "; 
           }
           if($offers!=''){ 
              $set .=" ,quoteoffers='".$offers."' "; 
           }
           $this->Quotebid->up_quotebids_set($quoteid,$userid,$set);
        }
        if($offers!=''){
              $offer_flag=1;
        }
        else{
              $offer_flag=0;
        }
        $quoted_user_id=$quoted_user;
          if($quoted_user_id == $userid){//buyer
              $new_buyer_id= $userid; 
              $new_seller_id= $serverid;
              $chat_id=$serverid; 
              $seller_id=$serverid; 
        }
        else{
              $new_seller_id= $userid;
              $new_buyer_id= $serverid;  
              $chat_id=$userid; 
              $seller_id=$userid;
        }
        /*fetching buyer details*/
            $latest_buyer_name=$this->GenieUser->get_username($quoted_user_id);
            $buyername_query =  $this->GenieUser->get_user_basic_details($quoted_user_id);
            $new_buy_fname = $buyername_query[0]['users']['first_name']; 
            $new_buy_lname = $buyername_query[0]['users']['last_name']; 
            $new_buy_cname = $buyername_query[0]['users']['company_name']; 
            $new_buy_title = $buyername_query[0]['users']['name_title'];
            $buyer_name=$this->GenieUser->get_username($new_buyer_id);
            $buyer_online=$this->GenieUser->check_user_offline($quoted_user_id);
            $buyer_mobile_number=$buyername_query[0]['users']['mobile_number'];
            if($fbbuyeremail!=''){
                $buyer_business_email=$fbbuyeremail;
            }
            else{
                $buyer_business_email=$this->GenieUser->get_email($new_buyer_id);
            }
           
            if(($new_buy_title==1)||($new_buy_title=='')){
                  $new_buy_title="Mr.";
            }
            else{
                  $new_buy_title="Miss.";
            }
            if($b2c==1){
                $new_tot_name=$new_buy_title." ".$new_buy_fname;
            }
            else{
                $new_tot_name=$new_buy_cname;
            }
        /*eof fetching buyer details*/
        /*fetching seller details*/
                $result =  $this->GenieUser->get_user_basic_details($seller_id);
                    $seller_firstname=ucfirst($result[0]['users']['first_name']);
                    $seller_lastname=ucfirst($result[0]['users']['last_name']);
                    $seller_email=ucfirst($result[0]['users']['business_email']);
                    $seller_mobile=ucfirst($result[0]['users']['mobile_number']);
                    $seller_company=ucfirst($result[0]['users']['company_name']);
                    $seller_online=$this->GenieUser->check_user_offline($seller_id);
                    $seller_business_email=$seller_email;
                    $seller_mobile_number=$seller_mobile;
                    $seller_name=$this->GenieUser->get_username($new_seller_id);
                    $seller_sid_id=$this->GenieUser->get_offline_sid_id($seller_id);

        /*eof fetching seller details*/
          $int_done=$this->Jchat->ischatintro($quoteid,$userid,$serverid);
          if($int_done == 0){
                $intromsg=1;//first seller response
          }
          
         /*Setting conditions for mail+sms notification for first response*/
           $message=addslashes($this->request['data']['message']);
      if(isset($message))
      {    
          $function_start_time = date("H:i:s");
          if($guest_flag==0){
              //$mobile_number=$this->GenieUser->get_mobile($serverid);
              $mobile_number=$buyer_mobile_number;
          }
          else{
              $mobile_number=$this->GenieGuest->get_guest_mobile_lat($serverid);
          }
          if($fbbuyeremail!=''){
                  $business_email=$fbbuyeremail;
          }
          else{
                  //$business_email=$this->GenieUser->get_email($serverid);
                  $business_email=$buyer_business_email;
          }

          if(($intromsg == 1 )||($buyer_online == 'offline')){
                  
          /*Google Short url for enquiry detail url*/
                $enquiry_details_url = 'https://www.xerve.in/genie/'.$enquiry_id.'/'.$seller_sid_id.'/'.$seller_id;
                $apiKey = 'AIzaSyANxKzfRqnMa8CcoZV4N9QWQpJkrfS4Yz0';
                $postData = array('longUrl' => $enquiry_details_url, 'key' => $apiKey);
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
                $enquiry_details_url = $shortLink_buyer['id'];
          /*Google Short url for enquiry detail ends*/
          /*Google Short url for chat url*/
                $chat_url= 'https://www.xerve.in/genie/'.$enquiry_id.'/'.$seller_sid_id.'/'.$seller_id;
                $apiKey = 'AIzaSyANxKzfRqnMa8CcoZV4N9QWQpJkrfS4Yz0';
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
          /*Eof Google Short url for chat url ends*/
          /*Google short url for my enquiry url*/
                $my_enquiries = 'https://www.xerve.in/myaccount/my_enquiries';
                $apiKey = 'AIzaSyANxKzfRqnMa8CcoZV4N9QWQpJkrfS4Yz0';
                $postData = array('longUrl' => $my_enquiries, 'key' => $apiKey);
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
                $myenquiries_url = $shortLink_buyer['id'];
          /*Eof Google short url for my enquiry url */
        }
        $attachment='false';
        if($intromsg == 1 )//first chat
        {
         
          /*updating messages in db for first seller response*/
          if($guest_flag==0){
              $this->Jchat->ins_msg_intro_off($message,$msg_time,$userid,$serverid,$quoteid,$enquiry_id,0,$attachment,$offer_flag,$intromsg);
          }
          else{
              $this->Jchat->ins_msg_intro_off($message,$msg_time,$userid,$serverid,$quoteid,$enquiry_id,$guest_user_id,$attachment,$offer_flag,$intromsg);
          }
          $notify_count=$this->get_notify_count($enquiry_id,$userid,$serverid);
          if(($notify_count ==0)||($notify_count =='')){
              $notify_count=1;
              $this->PushNotification->set_quote_push($chat_id,$enquiry_id,$userid,$serverid,$seller_sid_id,$notify_count,$msg_time,$msg_date,$product_spec);
          }
          else{
                $notify_count=$notify_count + 1;
                $this->PushNotification->up_quote_push($enquiry_id,$userid,$serverid,$notify_count,$msg_time);  
          }
          /*Eof updating messages in db for first seller response*/
           /*Email Set up for first seller response*/
           $email = new CakeEmail();
           $mask=substr($mask, 0, 49);
           $subject="Vendor ".$seller_name." has responded to Your Enquiry: ".$mask."...";
           if($business_email !=''){
              $email->config('smtp');
              $email->template('sellers_first_response');
              $email->emailFormat('html');
              $email->from(array('info@xerve.in' => 'Xerve.in'));
              $email->viewVars(array('enquiry_id'=>$enquiry_id,'b2c'=>$bus_type,'sms_category' => $sms_category,'sms_city' => $email_city_buy,'sms_area'=>$email_area_buy,'sms_sub_category'=>$sms_sub_category,'sms_my_city'=>$email_city,'sms_my_area'=>$email_area,'productspec'=>$email_productspec,'user_id'=>$userid,'chat_url'=>$enquiry_details_url,'myenquiries_url'=>$myenquiries_url,'seller_name'=>$seller_name,'buyer_name'=>$buyer_name,'msg'=>$message,'mask'=>$masked));
              $email->to($business_email);
              $email->subject($subject);
              if($guest_flag==0){
                     $email->send();
              }
            }
          //Eof Email Set up for first seller response
          
            $mob_mask=trim($mask);
            if($mobile_number !=0){
$sms_message = "Vendor: '$seller_name' has responded to Your Enquiry: '$mob_mask....'.

Please view the Vendor's Message now: $enquiry_details_url and reply. Thank you.

Best Regards,
Xerve Team.

www.xerve.in";
                  $mobile=$mobile_number;
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
                  $output=curl_exec($ch);
                  curl_close($ch);
                   }
          /*Eof Set up for first seller response */
          } //intro message
          else{
               // $seller_sid_id=$this->GenieUser->get_offline_sid_id($seller_id);
                if($guest_flag==0){ 
                   $msg_prev_time=$this->Jchat->get_prev_time($enquiry_id,$userid,$serverid,0,$guest_flag);
                }else{
                  $msg_prev_time=$this->Jchat->get_prev_time($enquiry_id,$userid,$serverid,$guest_user_id,$guest_flag);
                }
            
                $msg_prev_time = strtotime($msg_prev_time[0]['messages']['time']);
                if ((time() - $msg_prev_time) > 900) {// 15 mins has passed
                  $email_flag=1;
                  $sms_flag=1;
                }
                if($guest_flag==0){
                  $this->Jchat->ins_msg_intro_off($message,$msg_time,$userid,$serverid,$quoteid,$enquiry_id,0,$attachment,$offer_flag,0);
                 }else{
                  $this->Jchat->ins_msg_intro_off($message,$msg_time,$userid,$serverid,$quoteid,$enquiry_id,$guest_user_id,$attachment,$offer_flag,0);
                }
                $notify_count=$this->PushNotification->get_notify_count($enquiry_id,$userid,$serverid);
                if(($notify_count ==0)||($notify_count =='')){
                  $notify_count=1;
                  $this->PushNotification->set_quote_push($chat_id,$enquiry_id,$userid,$serverid,$seller_sid_id,$notify_count,$msg_time,$msg_date,$product_spec);
                }else{
                  $notify_count=$notify_count + 1;
                  $this->PushNotification->up_quote_push($enquiry_id,$userid,$serverid,$notify_count,$msg_time); 
                }
              /*Setting up email & sms if buyer is offline*/
               if($buyer_online == 'offline'){
                    // $quoted_user=$this->Lead->get_quoteuser($quoteid);
                      if($guest_flag==0){
                         $buyer_fullname=explode(" ",$buyer_name);
                         $buyer_firstname=ucfirst($buyer_fullname[0]);
                         $buyer_lastname=ucfirst($buyer_fullname[1]);
                      } 
                      else{
                           $buyer_firstname="Customer";
                           $buyer_lastname="";
                      }      
                      $buyer_offline_url = 'https://www.xerve.in/genie/'.$enquiry_id.'/'.$seller_sid_id.'/'.$seller_id; 
                      $buyer_offline_url = 'https://www.xerve.in/genie/'.$enquiry_id.'/'.$seller_sid_id.'/'.$seller_id;  
                      $apiKey = 'AIzaSyANxKzfRqnMa8CcoZV4N9QWQpJkrfS4Yz0';
                      $postData = array('longUrl' => $buyer_offline_url, 'key' => $apiKey);
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
                      $buyer_offline_url = $shortLink_buyer['id'];
                      /*Google Short url for chat url ends*/
                  $mask=substr($mask, 0, 49);
                  if($b2c == 1){  
                   $subject="Vendor ".$seller_name." has Responded to Your Enquiry: ".$mask."...";
                  }
                  else{
                   $subject="Customer ".$seller_name." has Responded to Your Enquiry: ".$mask."...";
                  }
               /*Email functionality*/
                if($buyer_business_email !=''){
                  $email_offline = new CakeEmail();
                  $email_offline->config('smtp');
                  $email_offline->template('buyer_offline');
                  $email_offline->emailFormat('html');
                  $email_offline->from(array('info@xerve.in' => 'Xerve.in'));
                    $email_offline->viewVars(array('enquiry_id'=>$enquiry_id,'b2c'=>$bus_type,'sms_category' => $sms_category,'sms_city' => $email_city_buy,'sms_area'=>$email_area_buy,'sms_sub_category'=>$sms_sub_category,'sms_my_city'=>$email_city,'sms_my_area'=>$email_area,'productspec'=>$email_productspec,'user_id'=>$userid,'chat_url'=>$buyer_offline_url,'myenquiries_url'=>$myenquiries_url,'seller_name'=>$seller_name,'buyer_firstname'=>$buyer_firstname,'buyer_lastname'=>$buyer_lastname,'msg'=>$message,'mask'=>$masked));
                            $email_offline->to($buyer_business_email);
                            $email_offline->subject($subject);
                            if($email_flag==1){
                                if($guest_flag==0){
                                        if($offer_flag==0){
                                               $email_offline->send();
                                        }
                                }
                            }
                }//business email
               /*Email functionality ends*/
                            /*Setting sms functionality*/
                                              if($buyer_mobile_number !=0){//if mobile no is valid
                                                                    $mobile=$buyer_mobile_number;
                                                                    $to = urlencode($mobile);
                                                                    // echo json_encode($to);
if($b2c == 1){ 

$offline_message="Vendor: '$seller_name' has responded to Your Enquiry: '$mask....'.

Please view the Vendor's Message now: $enquiry_details_url and reply. Thank you.

Best Regards,
Xerve Team.

www.xerve.in";

}else{

  $offline_message="Customer: '$seller_name' has responded to Your Enquiry: '$mask....'.

Please view the Vendor's Message now: $enquiry_details_url and reply. Thank you.

Best Regards,
Xerve Team.

www.xerve.in";

}
              $offline_message=urlencode($offline_message);
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
              $url_offline="http://alerts.solutionsinfini.com/api/web2sms.php?workingkey=A5d8f4c8c48eb27a2b0e14ae549b76ce5&sender=iXERVE&to=$to&message=$offline_message&type=json";
                 if($sms_flag==1){
                                    $ch_offline=curl_init();
                                    curl_setopt($ch_offline, CURLOPT_URL, $url_offline);
                                    curl_setopt($ch_offline, CURLOPT_RETURNTRANSFER, true);
                            if($offer_flag==0){//need to test properly
                                    $output_offline=curl_exec($ch_offline);
                                  }//need to test properly
                                    curl_close($ch_offline);
              }

              }//if mobile no is valid
                    /*Setting sms functionality*/
             }//buyer offline
             /*Setting up email & sms if buyer is offline ends*/
             /*Setting up email & sms if seller is offline*/
             if($seller_online == 'offline'){
                   /*Google Short url for chat url*/
                    if($guest_flag==0){
                         $chat_seller_url = 'https://www.xerve.in/leads/'.$enquiry_id.'/'.$seller_sid_id.'/'.$quoted_user;
                    }
                    else{
                        $chat_seller_url = 'https://www.xerve.in/leads/'.$enquiry_id.'/'.$seller_sid_id.'/'.$guest_user_id;
                    }
                    $apiKey = 'AIzaSyCCe-FLs8hLmMb1CgoAEbNoMFTXiuJAZaQ';
                    $postData = array('longUrl' => $chat_seller_url, 'key' => $apiKey);
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
                    $chat_seller_url = $shortLink_buyer['id'];
                    /*Google Short url for chat url ends*/
               /*eof chat url*/
                    $mask=substr($mask, 0, 49);
                    $subject="Customer  has Responded to Your Lead: ".$mask."...";
               /*Email functionality*/
                if($seller_email !=''){
                  $email_seller_offline = new CakeEmail();
                  $email_seller_offline->config('smtp');
                  $email_seller_offline->template('seller_offline');
                  $email_seller_offline->emailFormat('html');
                  $email_seller_offline->from(array('info@xerve.in' => 'Xerve.in'));
                  $email_seller_offline->viewVars(array('enquiry_id'=>$enquiry_id,'b2c'=>$bus_type,'sms_category' => $sms_category,'sms_city' => $email_city_buy,'sms_area'=>$email_area_buy,'sms_sub_category'=>$sms_sub_category,'sms_my_city'=>$email_city,'sms_my_area'=>$email_area,'productspec'=>$email_productspec,'user_id'=>$userid,'chat_url'=>$chat_seller_url,'myenquiries_url'=>$myenquiries_url,'seller_firstname'=>$seller_firstname,'seller_lastname'=>$seller_lastname,'msg'=>$message,'mask'=>$masked));
                      $email_seller_offline->to($seller_email);
                      $email_seller_offline->subject($subject);
                     if($email_flag==1){ 
                            $email_seller_offline->send();
                     }
                }//valid email
             /*Email functionality ends*/
                           /*Setting sms functionality*/
                              if($seller_mobile !=0){//if mobile no is valid
                                                      $mobile=$seller_mobile;
                                                      $to = urlencode($mobile);
$offline_message= "Customer: $new_tot_name has responded to Your Chat Message.

Enquiry: $mask...
Enquiry Id: $enquiry_id

Please view the Customer's Message now: $chat_seller_url and reply. Thank you.

Best Regards,
Xerve Team.

www.xerve.in";
                      $offline_message=urlencode($offline_message);
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
                      $url_offline="http://alerts.solutionsinfini.com/api/web2sms.php?workingkey=A5d8f4c8c48eb27a2b0e14ae549b76ce5&sender=iXERVE&to=$to&message=$offline_message&type=json";
                      if($sms_flag==1){
                              $ch_offline=curl_init();
                              curl_setopt($ch_offline, CURLOPT_URL, $url_offline);
                              curl_setopt($ch_offline, CURLOPT_RETURNTRANSFER, true);
                              $output_offline=curl_exec($ch_offline);
                              curl_close($ch_offline);
                      }
                    }//if mobile no is valid
                   /*Setting sms functionality*/
                   }
                  /*eof Setting up email & sms if seller is offline*/
            }//other messages,(not intro messages)
        //echo json_encode($query);
        //$this->Jchat->query($push_query);
        }//isset message
        exit();
     }

    public function chat_history(){
          date_default_timezone_set("Asia/Calcutta");
          $this->loadModel('Jchat');
          $this->loadModel('GenieUser');
          $this->loadModel('Jchat');
          $sellerid = $this->request->params['pass'][0]; 
          $quoteid = $this->request->params['pass'][1]; 
          $buyer_id=$this->Lead->get_quoteuser($quoteid);
          $serverid = $this->GenieUser->get_user($sellerid, 'ID');
          $server_username = ucfirst($this->GenieUser->get_user($sellerid, 'USERNAME'));
          $clientID = $this->GenieUser->get_user($buyer_id, 'ID');
          $clientNAME = ucfirst($this->GenieUser->get_user($buyer_id, 'USERNAME'));
          $messages_ids = $this->Jchat->get_messages_id($sellerid, $buyer_id,$quoteid);

          $this->set(compact('quoteid'));
          $this->set(compact('messages_ids')); 
          $this->set(compact('serverid','server_username'));   
          $this->set(compact('clientID','clientNAME'));
            
    } 

    public function quote_form(){
        $this->loadModel('Quotebid');
        $quoteid = $this->request['data']['quoteid'];
        $enquiry_id=$this->Lead->get_enquiryid($quoteid);
        $sellerid = $this->request['data']['sellerid'];
        $quoteprice = $this->request['data']['quoteprice'];
        $quoteoffers = addslashes($this->request['data']['quoteoffers']);
        $quote_time = date( 'Y-m-d H:i:s');
        $cnt=$this->Quotebid->get_formprice_cnt($sellerid,$quoteid);
        if($cnt == 1){
          $this->Quotebid->up_quotebids_price_det($quoteid,$sellerid,$quoteprice,$quoteoffers,$quote_time);
        }
        if($cnt == 0){
          $this->Quotebid->ins_quotebid_qry_1($enquiry_id,$quoteid,$sellerid,$quoteprice,$quoteoffers,$quote_time);
        }
        exit();
    }


    public function getmsgcntajax(){
        $userid=$this->request['data']['userid'];
        $serverid=$this->request['data']['serverid'];
        $quoteid=$this->request['data']['quoteid'];
        $msg_cnt=$this->Jchat->getmsgcnt($userid,$serverid,$quoteid);
        echo json_encode((int)$msg_cnt[0][0]['cnt']);
        exit();
    }

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
    }
 /////////////////////////////////////////////////////////////////
//checking whether seller paid for an enquiry after post login
/////////////////////////////////////////////////////////////////
public function check_lead_paid() {
     $this->autoRender = false;
     $this->loadModel('GenieUser'); 
     $sellerid=$this->request['data']['userid'];
     $sidsellerid=$this->$this->GenieUser->get_offline_sid_id($sellerid);
     $enquiry_id=$this->request['data']['enquiry_id'];
     $quoteid=$this->Lead->get_quoteid($enquiry_id);
     $seller_status=$this->GenieUser->get_seller_status($sellerid);
     $get_lead_cnt=$this->Quotebid->lead_download($sellerid,$quoteid);
              if($get_lead_cnt[0]['quotebids']['leads_downloaded']==0){
                $flag="false";
              }
              else{
                $flag="true";
              }
        $result=array(); 
        $result['flag'] = $flag; 
        $result['sid_id'] = $sidsellerid;
        $credit=$this->GenieUser->get_business_info($sellerid);
        $credit_balance=$credit[0]['users']['leads_displays_count'] - $credit[0]['users']['leads_displays'];
        $result['balance']= $credit_balance;
        $result['seller_status']= $seller_status;
        $result['first_name']= $credit[0]['users']['first_name'];
        $result['last_name']= $credit[0]['users']['last_name'];
        $this->set('Vendor_Name', $sellername);
        echo json_encode($result);
        exit;
   }////checking whether seller paid for an enquiry after post login
///////////////////////////////////////
// masking a field used in index page
///////////////////////////////////////
public function mask_field_index($quoteid) {
            $this->loadModel('Quotebid');
            $productspec=$this->Lead->getproductspec($quoteid);
            $productmask=$this->Lead->getproductmask($quoteid);
            $User_Id = $this->Auth->user('id');
            if($User_Id) 
            {
              $leads_down= $this->Quotebid->lead_download($User_Id,$quoteid);
                if(($leads_down == 0)||($leads_down ==''))//not paid or not informed
                {
                    $mask=$this->mask_field($productspec,$productmask);
                }
                else{ //has paid
                    $mask = $productspec;
                }
            }
            else{ //notlogged
                 $mask=$this->mask_field($productspec,$productmask);
            }
            return $mask;
   }// masking a field used in index page

   public function response() {

   }
/////////////////////////////////////////////////////////
//Business List based on category & city
///////////////////////////////////////////////////////////
public function getBusinessList() {
    $AllBusinessName = array();
    $this->loadModel('BusinessListing');
    $AllBusinessName = $this->BusinessListing->find('all', array(
        'fields' => array('id','company_logo','company_name'),
        'conditions' => array('BusinessListing.city_id' => $quotes['Quote']['locarea'],'BusinessListing.category_id' => $quotes['Quote']['cat_id'])
    ));
    header('Content-Type: application/json');
    echo json_encode($AllBusinessName);
    exit();
  } //Business List based on category & city
////////////////////////////////////////////////////////////
//Fetching subcategories based on categories
///////////////////////////////////////////////////////////
public function getSubcategories() {
    $SubCategoryList = array();
    if (isset($this->request['data']['id'])) {
            $this->loadModel('SubCategory');
    
      $SubCategoryList =$this->SubCategory->get_subcategory_list($this->request['data']['id']);
    }
    header('Content-Type: application/json');
    echo json_encode($SubCategoryList);
    exit();
  } 
////////////////////////////////////////////////////////////
//Fetching cityareas based on city
///////////////////////////////////////////////////////////
public function getAreas($id=null) {
        $AreaList = array();
        $id=$this->request['data']['id'];
        if (isset($id)) {
            $this->loadModel('Quotearea');
            $AreaList=$this->Quotearea->get_arealist_of_city($id);
        }
        header('Content-Type: application/json');
        echo json_encode($AreaList);
        exit();
    }   
/////////////////////////////////////////////////////////////
//get the date from push notification table
//////////////////////////////////////////////////////////////
    public function get_notify_date($quoteid,$senderid,$receiverid){
      $this->loadModel('PushNotification');
      $date=$this->PushNotification->get_quote_date($enquiryid,$senderid,$receiverid);
      return $date;
    }
/////////////////////////////////////////////////////////////
//get the msgcount from push notification table
//////////////////////////////////////////////////////////////
    public function get_notify_count($enquiry_id,$senderid,$receiverid){
        $this->loadModel('PushNotification');
        $msg_count=$this->PushNotification->get_notify_count($enquiry_id,$senderid,$receiverid);
        return $push_notify[0]['push_notifications']['msg_count'];
    }

    public function leads_cron_update(){
      $today=date('Y-m-d');
      $refund_time = date( 'Y-m-d H:i:s');
      $session="offline";
      $this->loadModel('User');
      $this->loadModel('GenieUser');
      $online_users=$this->GenieUser->get_session_status();
      if(COUNT($online_users)>0){
               for($j=0;$j<COUNT($online_users);$j++){
                   $this->GenieUser->up_user_session($online_users[$j]['users']['id'],$session);
               }
      }
    }

    public function check_seller_category($seller_id,$quoteid){
      $this->loadModel('GenieUser');
      $quote_cat_id=$this->Lead->get_catid($quoteid);
      $result=$this->GenieUser->get_bl_cat_id_cnt($seller_id,$quote_cat_id);
      $found=COUNT($result);
      return $found;
    }

    public function category_ajax(){
      $this->loadModel('GenieUser');  
      $seller_id=$this->request['data']['userid'];
      $quoteid=$this->request['data']['quoteid'];
      $quote_cat_id=$this->Lead->get_catid($quoteid);
      $found=$this->GenieUser->get_bl_cat_id_cnt($seller_id,$quote_cat_id);
      $found=COUNT($result);
      echo json_encode($found);
      exit();
    }

public function get_paused_username($quoteid){
    $userid=$this->Lead->get_quoteuser($quoteid);
    $b2c=$this->Lead->get_b2c($quoteid);
    $userstatus=$this->GenieUser->get_seller_status($userid);
    $this->loadModel('User');
    $this->loadModel('GenieUser');
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
    return $full_name;   
 }

 public function link_for_seller($quoteid){
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
 }//link_for_seller
/////////////////////////////////////////////////////////////
//get buyer read count
//////////////////////////////////////////////////////////////
public function get_buyread_count($enquiry_id,$senderid,$receiverid){
      $this->loadModel('PushNotification');
      $push_notify=$this->PushNotification->get_notify_count($enquiry_id,$senderid,$receiverid);
      return $push_notify[0]['push_notifications']['msg_count'];
    }

public function website_update(){
    $this->autoRender = false;
    $this->layout  = false;
    $userid= $this->request['data']['userid'];
    $quoteid= $this->request['data']['quoteid'];
    $website= $this->request['data']['website'];
    $quoted_website= $this->request['data']['quoted_website'];
    $this->loadModel('Quotebid');
    $this->Quotebid->up_quotebids_website($quoteid,$userid,$website);
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

  public function ajaxaddemail() {
      $User_Id = $this->Auth->user('id');
       $this->loadModel('Quotecity');
       $this->loadModel('Lead');
       $this->loadModel('GenieGuest');
       $this->loadModel('LeadLocations');
       $this->loadModel('Quotearea');
       $this->loadModel('User');
       $this->loadModel('GenieUser');
      $enquiry_time=date('Y-m-d H:i:s');
      $Mydata['enquiry_time']=$enquiry_time;
      $latitude=$this->request->data['login_lat1'];
      $member_type=$this->request->data['member_type'];
      $mobile_number=$this->request->data['mobile_number'];
      $unique_ip=$this->request->data['unique_ip'];
       if($unique_ip=='0.0.0.0'){
        $unique_ip=$_SERVER['REMOTE_ADDR'];
      }
       $Mydata['remote_ip']=$_SERVER['REMOTE_ADDR'];
       $Mydata['formid']=3;
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
                }
                else{
                     $city_id=$city_id;
                }
                $locarea_buy=$city_id;
                $locarea=$city_id;
                $Mydata['locarea']=$locarea; 
                $Mydata['locarea_buy']=$locarea_buy;
              }
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
                       }
                       else{
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
                                        }
                                        else{//activated guest user
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
            $this->LeadLocations->save($Myloc); // to be revoked
            echo json_encode($need_activation);
            exit();
    }//end of ajax add function

public function first_buyer_msg($sellerid,$buyerid,$enquiry_id,$sid_id,$vendor_name,$mobile_number_sms,$productspec_sms){
      if($mobile_number_sms !=0){
                                      // echo"mob";

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
                                                        
$sms_message = "Vendor: '$vendor_name' just read Your Message.
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

 public function attachsend(){
        $this->autoRender = false;
        $userid=$this->request['data']['userid'];//logged in 
        $serverid=$this->request['data']['serverid'];//receiver
        $guest_flag=$this->request['data']['guest_flag'];//receiver
        $guest_user_id=$this->request['data']['guest_user_id'];//receiver
        $quoteid=$this->request['data']['quoteid'];
        $enquiry_id=$this->request['data']['enquiry_id'];
        $msg_time= $this->request['data']['chat_msg_time'];
        $attachment="true";
        $message="path of file";
        $intromsg=0;
        $offer_flag=0;
        /*file upload process*/
        if(!empty($_FILES['photoimg']['name']))
        {
                   $path = $_SERVER['DOCUMENT_ROOT'];
                   $this->Uploader = new Uploader(array('tempDir' =>"$path/app/tmp/",
                            'uploadDir'=>"/temp"
                    )); 
                   $imgname = $_FILES['photoimg']['name'];
                   $User_Id_folder = "img";
                   $image_url = "https://d372i0x0rvq68a.cloudfront.net/".$userid."/".$imgname;
                   $bucket = "xrv-business-listings";   
                   rename("/var/www/html/app/webroot/temp/".$imgname, "/var/www/html/app/webroot/temp/".str_replace(" ", "_", $imgname));
                  $imgname = str_replace(" ", "_", $imgname);
                  $newimg = "/var/www/html/app/webroot/temp/".$imgname;
                  shell_exec("sudo aws s3 cp /var/www/html/app/webroot/temp/".$imgname." s3://xrv-business-listings/".$userid . '/'. $imgname." --metadata-directive REPLACE --expires ".date("Y-m-d", strtotime("+1 years"))."T00:00:00Z --acl public-read --cache-control max-age=31536000,public");
                  if(getimagesize($image_url) !== false){ 
                    unlink($newimg); 
                  } 
                  $Lists [] = "https://d372i0x0rvq68a.cloudfront.net/".$User_Id_folder."/".$imgname;
                  $file_path=$lists[0];
                  echo json_encode($file_path);
               
         }        
        /*eof file upload process*/
        $this->loadModel('Jchat');
        $this->Jchat->ins_msg_intro_off($message,$msg_time,$userid,$serverid,$quoteid,$enquiry_id,0,$attachment,$offer_flag,$intromsg);
        
        // try{
        //     $this->Jchat->query($query);
        // }
        // catch(Exception $e) {
        //         echo 'Message: ' .$e->getMessage();
        // }
    exit;
}   

public function update_offers(){
       Configure::write('debug',2);
       $this->loadModel('Quotebid');
       $this->layout = false;
       $this->autoRender = false;
       $offers=$this->request['data']['offers'];
       $enquiry_id=$this->request['data']['enquiry_id'];
       $seller_id=$this->request['data']['seller_id'];
       $this->Quotebid->up_quotebids_offers($enquiry_id,$seller_id,$offers);
       exit();
 }

     ////////////////////////////////////////
    // Get location of quote Enquiries
    ///////////////////////////////////////

 public function get_quote_loc($quoteid){
    $find_loc=$this->Lead->get_quote_loc($quoteid);
    return $find_loc;
  }

public function provide_credits(){
            $this->loadModel('User');
            $this->loadModel('GenieUser');
            $this->loadModel('BusinessListingCategory');
            $lists=$this->GenieUser->get_user_categories();
            $i=0;
            foreach($lists as $list){
                $MyUser_id=$list['users']['id'];
                $category=$list['offer_categories']['category'];
                $type=$list['offer_categories']['type'];
                        if(($type ==1)||($type ==3)){
                                
                                $leads_credits=100;
                        }
                        if($type ==2){
                                
                                $leads_credits=500;
                        }
                 $this->GenieUser->up_user_credit($leads_credits,$MyUser_id);
                 $i++;
            }
            $this->set(compact('lists'));
}

public function update_enquiry_time(){
  $this->loadModel('Jchat'); 
  $lists=$this->Lead->get_quote_id_dt();
  foreach($lists as $list){
                $quoteid=$list['quotes']['quoteid'];
                $enquiry_time=$this->Lead->getquotetime($quoteid);
                $this->Jchat->up_msg_time($enquiry_time,$quote_id);

  }
}

public function category_ajax_for_detail(){
  $this->loadModel('GenieUser');   
  $seller_id=$this->request['data']['userid'];
  $quoteid=$this->request['data']['quoteid'];
  $quote_cat_id=$this->Lead->get_catid($quoteid);
  $result=array();
  $result_array=$this->GenieUser->get_bl_cat_id($seller_id,$quote_cat_id);
          if(COUNT($result_array)==0){
                $flag="false";
          }
          else{
                $flag="true";
          }
      $result['flag'] = $flag; 
      $sellername_query=$this->GenieUser->get_user_basic_details($seller_id);
      $result['first_name'] = $sellername_query[0]['users']['first_name']; 
      $result['last_name'] =  $sellername_query[0]['users']['last_name']; 

  echo json_encode($result);
  exit();
}

public function get_starred($str) {
    $len = strlen($str);
    $str1= substr($str, 0, 3).str_repeat('X', $len - 3);
    return $str1;
}

 public function track_number(){
    $this->loadModel('Quotebid');
    $userid=$this->request['data']['userid'];
    $enquiry_id=$this->request['data']['enquiry_id'];
    $quoteid=$this->request['data']['quoteid'];
    $count = $this->Quotebid->find('count', array(
                     'conditions' => array('quoteid' =>$quoteid,'sellerid'=>$userid)
                 ));
       if($count == 0){
         $count = 1;
       }
       else{
         $count = $count + 1;
       }
    $this->Quotebid->up_quotebids_clkcnt($quoteid,$userid,$count);
    exit();
 }
    
  public function prices_response(){
      $this->loadModel("User"); 
      $this->loadModel("GenieUser"); 
      $this->loadModel("Leadaltpayment");
      $enquiry_id = $this->request->params['pass'][0]; //first param: enquiry id
      $return_path  = $this->request->params['pass'][0];//second param: sid id
      $buyer_id  = $this->request->params['pass'][2];
      $secret_key = "cdf66810b605309f96fc9b6944205003455057b7"; 
      $data = "";
      $flag = "true";
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
          $mobileNo = $_POST['mobileNo'];//seller mob no
      }
      if(isset($_POST['txnDateTime'])) {
          $txnDateTime = $_POST['txnDateTime'];
      }
        /*Custom Parameters*/
      if(isset($_POST['PayPackage'])) {
          $PayPackage = $_POST['PayPackage'];
            
      }
      if(isset($_POST['PaymentFor'])) {
          $PaymentFor = $_POST['PaymentFor'];
            
      }
      if(isset($_POST['PaymentMode'])) {
          $return_path = $_POST['PaymentMode'];
          //echo $return_path."<br/>";
          $PaymentMode = "ONLINE";
      }
      if(isset($_POST['LeadsCredited'])) {
          $LeadsCredited = $_POST['LeadsCredited'];
      }
      if(isset($_POST['PayuserId'])) {
          $User_Id = $_POST['PayuserId'];
      }
      if($PayPackage =="LITE"){
        $amount=100;
        $leads_credits_real="84.75";
        $debited=10;
        $split_pay="Rs. 84.75 + Rs. 15.25 GST";
      }
      else if($PayPackage =="TRIAL"){
        $amount=1;
        $leads=10;
        $leads_credits_real="0.8475";
        $debited=10;
        $split_pay="Rs. 0.8475 + Rs. 0.1525 GST";
      } 
      else if($PayPackage =="MINI"){
        $amount=10;
        $leads=10;
        $leads_credits_real="8.475";
        $debited=10;
        $split_pay="Rs. 8.475 + Rs. 1.525 GST";
      } 
      else if($PayPackage =="TRIAL"){
        $amount=1;
        $leads=10;
        $leads_credits_real="0.82";
        $debited=10;
        $split_pay="Rs. 0.82 + Rs. 0.18 GST";
      } 
      else if($PayPackage =="BASIC"){
        $amount=1000; //extra 1%
        $leads=1010;
        $leads_credits_real="847.46";
        $debited=10;
        $split_pay="Rs. 847.46 + Rs. 152.54 GST";
      }
      else if($PayPackage =="PRO"){
        $amount=5000;
        $leads=5250;
        $leads_credits_real="4237.29";
        $debited=10;
        $split_pay="Rs. 4347.83 + Rs. 652.17 GST";
      }
      else if($PayPackage =="ELITE"){
        $amount=10000;
        $leads=11000;
        $leads_credits_real="8474.58";
        $debited=10;
        $split_pay="Rs. 8695.65 + Rs. 1304.35 GST";
      }
      else{
            $amount=$_POST['amount'];
            $leads=$amount;
            $leads_credits_real=$_POST['amount'];
            $debited=10;
      }
        /*Custom Parameters ends*/ 
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
        /*generating my enquiries google url for seller*/
        /*eof google url for seller*/  
        $this->set(compact('flag'));
        
        $position = 1;
        $User_data =$this->GenieUser->get_user_pay_det($User_Id);
       
        $User_Id=$User_data[0]['users']['id'];
        $mobile_seller_number=$User_data[0]['users']['mobile_number'];//seller mobile number
        $name_title=$User_data[0]['users']['name_title'];
        $first_name=$User_data[0]['users']['first_name'];
        $last_name=$User_data[0]['users']['last_name'];
        $comp_name=$User_data[0]['users']['company_name'];
        $ded_cnt=$User_data[0]['users']['ded_cnt'];
        if($ded_cnt>5){
          $credit_status=1;//paid
        }else{
          $credit_status=0;//free
        }
        if($name_title ==1){
                $gender="Mr";
              }
              if($name_title ==2){
                $gender="Ms";
              }
              if($name_title ==''){
                $gender="Mr";
              }
              //}
       
        $date = date('Y-m-d H:i:s');
        $pay_online="ONLINE";
        if ($_POST['TxStatus'] == "SUCCESS") {
          $verify=1;
        }else{
          $verify=0;
        }
        if($User_Id != NULL) {
             $query="INSERT INTO quoteotherpayments SET  user_id = '".$User_Id."',created_date='".$date."',amount = '".$amount."',TxStatus = '".$TxStatus."',TxId = '".$TxId."',TxRefNo ='".$TxRefNo."',TxMsg = '".$TxMsg."',firstName='".$firstName."',lastName = '".$lastName."',pgTxnNo='".$pgTxnNo."', addressStreet1='".$addressStreet1."',email='".$email."',mobileNo = '".$mobileNo."',addressCity='".$addressCity."',addressState='".$addressState."',addressZip='".$addressZip."',addressCountry='".$addressCountry ."',txnDateTime='".$txnDateTime."',maskedCardNumber='".$maskedCardNumber."',payment_mode='".$pay_online."',signature='".$signature."',TxGateway='".$TxGateway."',transactionId='".$transactionId."',issuerRefNo='".$issuerRefNo."',authIdCode='".$authIdCode."',pgRespCode='".$pgRespCode."',cardHolderName='".$cardHolderName."',cardType='".$cardType."',currency='".$currency."',payment_for='".$PaymentFor."',package_name='".$PayPackage."',paymentMode='".$paymentMode."',leads_credited='".$leads."',leads_credits_real='".$leads_credits_real."',verify='".$verify."'";
               $this->Leadaltpayment->query($query);
               $pay_id=$this->Leadaltpayment->id;
        }
       /*Checking if payment process is success or failure*/
        if ($_POST['TxStatus'] == "SUCCESS") {
              if($User_Id != NULL)  {
                $this->GenieUser->up_user_credit_pay($leads,$position,$User_Id);
              }
        $balance = $this->GenieUser->credit_balance($User_Id); 
/*sms to sellers regarding payment*/
 $message="Your Order: ''$PayPackage'' Leads Package is Successful! Thank you.

Order Id: $pay_id
Package: $PayPackage
Credits: $leads
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
                                            
      if(in_array($to_check, $arrayto)){
        $this->to=$to;
      }
      if($time=='null'){          
        $time='';
      }
      else{           
          $time=urlencode($time);
          $time="&time=$time";
      }
      if($unicode=='null'){          
        $unicode='';
      }
      else{          
        $unicode="&unicode=$unicode";
      }
      $url="http://alerts.solutionsinfini.com/api/web2sms.php?workingkey=A5d8f4c8c48eb27a2b0e14ae549b76ce5&sender=iXERVE&to=$to&message=$message&type=json";

      $ch=curl_init(); 
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $output=curl_exec($ch);
      curl_close($ch);

/*eof sms to sellers regarding payment*/
      
      $this->set('balance',$balance);

      $pay_query="SELECT id,email,mobileNo,firstName,lastName,amount,addressStreet1,addressCity,addressState,addressZip,mobileNo,user_id,TxId,payment_for,package_name,paymentMode,payment_mode,leads_credited FROM quoteotherpayments WHERE user_id ='".$User_Id."' ORDER BY id desc limit 1" ;

      $User_data = $this->User->query($pay_query);
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

      $this->set('Amount',$Amount);
      $this->set('payment_for',$payment_for);
      $this->set('package_name',$package_name);
      $this->set('payment_mode',$payment_mode);
      $this->set('payment_id',$payment_id);
      $this->set('leads_credited',$leads_credited);
    //*Email Template*/
      if($payment_for == "offline"){
        $subject = "Order No. ".$payment_id." | Leads Package : ".$package_name." (".$leads." Credits)| View Details"; 
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
      $this->redirect($return_path.'&stat=success');    
     //to be uncommented                   
    }//success
    else{
               $balance = $this->GenieUser->credit_balance($User_Id); 
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
               if(in_array($to_check, $arrayto)){
                $this->to=$to;
              }
              if($time=='null') {         
                $time='';
              }
              else{           
                  $time=urlencode($time);
                  $time="&time=$time";
             }
             if($unicode=='null') {         
                $unicode='';
             }                                      
             else {         
                $unicode="&unicode=$unicode";
             }
             $url="http://alerts.solutionsinfini.com/api/web2sms.php?workingkey=A5d8f4c8c48eb27a2b0e14ae549b76ce5&sender=iXERVE&to=$to&message=$message&type=json";
               $ch=curl_init(); 
               curl_setopt($ch, CURLOPT_URL, $url);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               $output=curl_exec($ch);
               curl_close($ch);
                $stat="fail";
                $this->redirect($return_path.'&stat=fail');  
              }//fail
  }
  public function pay_response(){
        $this->loadModel("User"); 
        $this->loadModel("GenieUser");
        $this->loadModel("GenieGuest"); 
        $this->loadModel("Leadaltpayment");
        $this->loadModel("Jchat");
        $enquiry_id = $this->request->params['pass'][0]; //first param: enquiry id
        $sid_id  = $this->request->params['pass'][1];//second param: sid id
        $buyer_id  = $this->request->params['pass'][2];//second param: buyer id
        $secret_key = "cdf66810b605309f96fc9b6944205003455057b7"; 
        $data = "";
        $flag = "true";
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
      /*eof generating google url for pricing page*/
      /*generating my enquiries google url for seller*/
          $my_chats = 'www.xerve.in/leads/'.$enquiry_id.'/'.$sid_id.'/'.$buyer_id;
          $apiKey = 'AIzaSyCCe-FLs8hLmMb1CgoAEbNoMFTXiuJAZaQ';
          $postData=array('longUrl' => $my_chats, 'key' => $apiKey);
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
      /*eof google url my enquiries google url for seller*/
        $productspec=$this->Lead->get_full_quotes($enquiry_id);
        $productmask=$productspec['Lead']['productspec'];
        $productmask=substr($productmask, 0, 10);
        $quoteid=$productspec['Lead']['quoteid'];
        $guest_flag=$productspec['Lead']['guest_flag'];

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
        /*personal details*/
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
          $mobileNo = $_POST['mobileNo'];//seller mob no
        }
        if(isset($_POST['txnDateTime'])) {
          $txnDateTime = $_POST['txnDateTime'];
        }
        /*Custom Parameters*/
        if(isset($_POST['PayPackage'])) {
          $PayPackage = $_POST['PayPackage'];
        }
        if(isset($_POST['PaymentFor'])) {
          $PaymentFor = $_POST['PaymentFor'];
        }
        if(isset($_POST['PaymentMode'])) {
          $PaymentMode = $_POST['PaymentMode'];
        }
        if(isset($_POST['LeadsCredited'])) {
          $LeadsCredited = $_POST['LeadsCredited'];
        }
        if(isset($_POST['PayuserId'])) {
          $User_Id = $_POST['PayuserId'];
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
    //Capturing Card/Netbanking Details//
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
        $position = 1;
        $User_data = $this->GenieUser->get_user_basic_details($User_Id);
        $User_Id=$User_data[0]['users']['id'];
        $mobile_seller_number=$User_data[0]['users']['mobile_number'];//seller mobile number
        $name_title=$User_data[0]['users']['name_title'];
        $first_name=$User_data[0]['users']['first_name'];
        $last_name=$User_data[0]['users']['last_name'];
        $comp_name=$User_data[0]['users']['company_name'];
        $ded_cnt=$User_data[0]['users']['ded_cnt'];
        if($ded_cnt>5){
          $credit_status=1;//paid
        }else{
          $credit_status=0;//free
        }
        if($name_title ==1){
                $gender="Mr";
        }
        if($name_title ==2){
          $gender="Ms";
        }
        if($name_title ==''){
          $gender="Mr";
        }
        if((count($User_data)==0)){
          $mobile_guest_buyer_number=$this->GenieGuest->get_guest_mobile_lat($buyer_id);
          $guest_user_id=$mobile[0]['genie_guests']['guest_user_id'];
          $buyerfname="Customer";
          $buyerlname="";
          $buyer_gender="";
          $sms_seller_message="Customer Details for Enquiry '$productmask... (Id: $enquiry_id)' : $buyerfname, $mobile_guest_buyer_number | Email or Chat Now with Customer: $chat_url";
        }
        $intro_message="Hi, ".$comp_name." here. We would like to help you!";
        $date = date('Y-m-d H:i:s');
        
     // $this->Lead->query($chat_query);
      $pay_online="ONLINE";
      if ($_POST['TxStatus'] == "SUCCESS") {
                if($guest_flag==0){   
                      $buyer_details = $this->GenieUser->get_user_basic_details($buyer_id);
                      $buyer_mobile=$buyer_details[0]['users']['mobile_number'];
                      $buyer_fname=$buyer_details[0]['users']['first_name'];
                      $buyer_lname=$buyer_details[0]['users']['last_name'];
                      $buyer_title=$buyer_details[0]['users']['name_title'];
                        if($buyer_title ==1){
                                             $buyer_gender="Mr";
                       }
                        if($buyer_title ==2){
                                             $buyer_gender="Ms";
                       }
                        if($buyer_title ==''){
                                             $buyer_gender="Mr";
                       }
                       $this->Jchat->ins_msg_intro_2($intro_message,$date,$User_Id,$buyer_id,$quoteid,$enquiry_id,$guest_id=0);

                       $sms_seller_message="Customer Details for Enquiry '$productmask... (Id: $enquiry_id)' : $buyer_gender. $buyer_fname $buyer_lname, $buyer_mobile | Email or Chat Now with Customer: $chat_url";
                }
                else{    

                     $mobile=$this->GenieGuest->get_guest_details($buyer_id);
                     $mobile_guest_buyer_number=$mobile[0]['genie_guests']['mobile_number'];
                     $guest_user_id=$mobile[0]['genie_guests']['guest_user_id'];
                     $buyerfname="Customer";
                     $buyerlname="";
                     $buyer_gender="";
                     $sms_seller_message="Customer Details for Enquiry '$productmask... (Id: $enquiry_id)' : $buyerfname, $mobile_guest_buyer_number | Email or Chat Now with Customer: $chat_url";

             
                     $this->Jchat->ins_msg_intro_2($intro_message,$date,$User_Id,$buyer_id,$quoteid,$enquiry_id,$guest_user_id);
              }
          $verify=1;
      }
      else{
        $verify=0;
      }
      if($User_Id != NULL) {
           $query="INSERT INTO quoteotherpayments SET  user_id = '".$User_Id."',created_date='".$date."',amount = '".$amount."',TxStatus = '".$TxStatus."',TxId = '".$TxId."',TxRefNo ='".$TxRefNo."',TxMsg = '".$TxMsg."',firstName='".$firstName."',lastName = '".$lastName."',pgTxnNo='".$pgTxnNo."', addressStreet1='".$addressStreet1."',email='".$email."',mobileNo = '".$mobileNo."',addressCity='".$addressCity."',addressState='".$addressState."',addressZip='".$addressZip."',addressCountry='".$addressCountry ."',txnDateTime='".$txnDateTime."',maskedCardNumber='".$maskedCardNumber."',payment_mode='".$pay_online."',signature='".$signature."',TxGateway='".$TxGateway."',transactionId='".$transactionId."',issuerRefNo='".$issuerRefNo."',authIdCode='".$authIdCode."',pgRespCode='".$pgRespCode."',cardHolderName='".$cardHolderName."',cardType='".$cardType."',currency='".$currency."',payment_for='".$PaymentFor."',package_name='".$PayPackage."',paymentMode='".$paymentMode."',leads_credited='".$credited."',leads_credits_real='".$leads_credits_real."',verify='".$verify."'";
           $this->Leadaltpayment->query($query);
           $pay_id=$this->Leadaltpayment->id;
      }
              /*Checking if payment process is success or failure*/
      if ($_POST['TxStatus'] == "SUCCESS") {
            if($User_Id != NULL)  {
                  $this->GenieUser->up_user_credit_pay_full($amount,$position,$credited,$User_Id);
                  $this->Lead->up_priority_cnt($enquiry_id);
                  $this->Quotebid->up_quotebids_deduct($enquiry_id,$User_Id,$date,$amount); 
            }
            $balance = $this->GenieUser->credit_balance($User_Id);
/*sms to sellers regarding payment*/
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
            if(in_array($to_check, $arrayto)){
              $this->to=$to;
            }    
            if($time=='null'){          
              $time='';
            }
            else {          
                $time=urlencode($time);
                $time="&time=$time";
            }
            if($unicode=='null'){          
              $unicode='';
            }
            else          
            {
              $unicode="&unicode=$unicode";
            }
            $url="http://alerts.solutionsinfini.com/api/web2sms.php?workingkey=A5d8f4c8c48eb27a2b0e14ae549b76ce5&sender=iXERVE&to=$to&message=$message&type=json";
            $ch=curl_init(); 
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output=curl_exec($ch);
            curl_close($ch);
/*eof sms to sellers regarding payment*/
       
        
          $balance = $this->GenieUser->credit_balance($User_Id); 
          $this->set('balance',$balance);

          $pay_query="SELECT id,email,mobileNo,firstName,lastName,amount,addressStreet1,addressCity,addressState,addressZip,mobileNo,user_id,TxId,payment_for,package_name,paymentMode,payment_mode,leads_credited FROM quoteotherpayments WHERE user_id ='".$User_Id."' ORDER BY id desc limit 1" ;
          $User_data = $this->User->query($pay_query);

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
          $payment_mode=  $User_data[0]['quoteotherpayments']['paymentMode'];//netbanking,cc/debit card
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
          //*Email Template*/
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
                        $email->to(array($usrEmail));
                        $email->bcc(array('info@xerve.in','orders@xerve.in'));                  
                        $email->replyTo(array('support@xerve.in'));
                        $email->subject($subject);
                        $email->send();
          }
          $_SESSION['PaymentDone']="Success";
          /*Email Template Ends*/
          /*SMS Template starts to sellers  for buyer details*/                                                
          $stat="success";
          $this->set('stat',$stat);
          /*sms giving detals*/
          $mobile=$mobile_seller_number;
          $to = $mobile;
          $to = urlencode($to);
          $sms_seller_message=urlencode($sms_seller_message);
          $this->to=$to;
          $to=substr($to,-10) ;
          $arrayto=array("9", "8" ,"7");
          $to_check=substr($to,0,1);
          if(in_array($to_check, $arrayto)){
            $this->to=$to;
          }                                
          if($time=='null'){          
             $time='';
          }
          else {          
              $time=urlencode($time);
              $time="&time=$time";
          }
          if($unicode=='null') {         
            $unicode='';
          }                                              
          else{          
            $unicode="&unicode=$unicode";
          }
          $url1="http://alerts.solutionsinfini.com/api/web2sms.php?workingkey=A5d8f4c8c48eb27a2b0e14ae549b76ce5&sender=iXERVE&to=$to&message=$sms_seller_message&type=json";
          $ch1=curl_init();
          curl_setopt($ch1, CURLOPT_URL, $url1);
          curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
              // if($tot_res<6){
              // if($pay_pkg==2){ 
                        $output=curl_exec($ch1);
            //   }
            // }
          curl_close($ch1);
          /*sms template ends*/
          $this->redirect('/leads/'.$enquiry_id.'/'.$sid_id.'/'.$buyer_id.'/'.$stat);//to be u                   
         }//success
            else{
               $balance = $this->GenieUser->credit_balance($User_Id); 
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
          if(in_array($to_check, $arrayto)){
            $this->to=$to;
          }
          if($time=='null'){          
            $time='';
          }
          else{           
              $time=urlencode($time);
              $time="&time=$time";
          }
          if($unicode=='null'){          
            $unicode='';
          }
          else{        
            $unicode="&unicode=$unicode";
          }
          $url="http://alerts.solutionsinfini.com/api/web2sms.php?workingkey=A5d8f4c8c48eb27a2b0e14ae549b76ce5&sender=iXERVE&to=$to&message=$message&type=json";
          $ch=curl_init(); 
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $output=curl_exec($ch);
          curl_close($ch);
          $stat="fail";
          $this->redirect('/leads/'.$enquiry_id.'/'.$sid_id.'/'.$buyer_id.'/'.$stat); 
        }//fail
  }//ResponsePage

  public function get_username($userid) {
    $this->loadModel('GenieUser');
    $full_name=$this->GenieUser->get_username($userid);
    return $full_name;  
    
  }

}//end of classend of class
