<?php
class Quotecategory extends AppModel {
	var $name = 'offer_categories';
	
	public function get_category_list($quote_id){
    $CategoryName=array();
    $query="SELECT offer_categories.id, offer_categories.category_name,offer_categories.credits
     FROM offer_categories 
    INNER JOIN quotes ON (quotes.cat_id = offer_categories.id AND quotes.quoteid = '".$quote_id."')";
	  $CategoryName=$this->query($query);
  	return $CategoryName;

   }
    
    public function get_category_details($email_blcatid){
      
    $category_query="SELECT id,category_name FROM offer_categories WHERE id='".$email_blcatid."' and deleted_flag=0";
    $category_query_result=$this->query($category_query);
    $sms_category=$category_query_result[0]['offer_categories']['category_name'];
    return $sms_category;
   }
    
    public function getCategory_Credits($catid){
      $query="SELECT credits FROM offer_categories WHERE id='".$catid."'  ";
      $result =  $this->query($query);
      return $result[0]['offer_categories']['credits'];
   }

   public function getCategory_type($catid){
      $query="SELECT type FROM offer_categories WHERE id='".$catid."'  ";
      $result =  $this->query($query);
      return $result[0]['offer_categories']['type'];
   }

  public function get_quote_category_faq($cat_id){
   $query=" SELECT faq FROM offer_categories WHERE id='".$cat_id."'"; 
   $get_faq=$this->query($query);
   $faqs=$get_faq[0]['offer_categories']['faq'];
   return $faqs;
  }

  public function get_category_list_1(){
          $CategoryList =array();
          $offer_category = ClassRegistry::init('OfferCategory');
          $CategoryList = $offer_category->find('all', array(
                              'conditions' =>array('OfferCategory.deleted_flag' => '0'),
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
         return $CategoryList ;    
  }

  public function get_category_bl_list(){
    $CategoryList =array();
    $offer_category = ClassRegistry::init('OfferCategory');
    $CategoryList = $offer_category->find('list', array(
            'conditions' =>array('OfferCategory.deleted_flag' => '0'),
            'joins' => array(
                       array(
                         'table' => 'business_listing_categories',
                         'alias' => 'bl',
                         'type' => 'INNER',
                         'conditions' => array(
                           'bl.category_id = OfferCategory.id'
                         )
                       )
                     ),
            'fields' => array('id','category_name'),
            'order' => array('category_name asc')));

    return $CategoryList;
	}
  public function get_offer_category_list(){
    $OfferCategory_List =array();
    $offer_category = ClassRegistry::init('OfferCategory');
    $OfferCategory_List = $offer_category->find('list', array(
                                       'conditions' => array('OfferCategory.deleted_flag' => 0),
                                       'fields' => array('OfferCategory.id','OfferCategory.category_name'),
                                       'order' => array('OfferCategory.category_name asc')));
    return $OfferCategory_List;
  }
	
}