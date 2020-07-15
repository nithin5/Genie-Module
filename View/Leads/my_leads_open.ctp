
<?php

 echo "<div class='container seller_quotes_panel'><div class='sd_panel sd_panel-primary'>
 <div class='sd_panel-heading'>";?>



<?php

 echo"</div>
 <div class='panel-body _enqquotes_buyer'>";?>

<!--Laftacc-->
<div class="left-acc-new">
<?php 
if($user_id){
echo $this->element('Sidebar_Myaccount'); 
}
else{
 echo $this->element('Leads_Sidebar');  
}
?>
</div>
<!--End of Laftacc-->
<div class="right-acc-new"><!--start Rightacc-->
     <div class="ofr_det offer-pop-des offer_inner" style="border: none;">
       
       <span class="bread-crumb-family" style=""><a href="http://www.xerve.in/"><span style="color: #0070C0;">Home </span> </a> > &nbsp; <a href="http://www.xerve.in/myaccount"><span style="color: #0070C0;">My Account </span> </a> > &nbsp; <a href="http://www.xerve.in/myaccount/my_leads"><span style="color: #0070C0;">My Leads</span> </a> 

       </span>

       </div>

       <div class="clearfix"></div>

        <div class="sd_offer_hd">
            <h1 class="store_header_strip offer-strip" style="margin-bottom: 10px;"><span class="header_icon"><img src="/img/new_black.png" alt="New Leads" title="New Leads">My Active Leads</span></h1>
      </div>
<?php

if(COUNT($quotes)>0){?>
<div class="sd_table-responsive">
<table class="table table-hover">
  <div class="dropdown" >
  <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" style="margin-bottom:5px">More Options
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    
    <li><a href="/myaccount/my_leads" onclick="<?php echo Router::url(array('controller'=>'myaccount', 'action'=>'my_leads'))?>">All Leads</a></li>

    <li><a href="/myaccount/my_leads_open" onclick="<?php echo Router::url(array('controller'=>'myaccount', 'action'=>'my_leads_open'))?>">Live Leads</a></li>

    <li><a href="/myaccount/my_leads_closed" onclick="<?php echo Router::url(array('controller'=>'myaccount', 'action'=>'my_leads_closed'))?>">Closed Leads</a></li>
    
    
  </ul>
</div>
<thead>
    <tr>
     
		<th class="sd_fst_child">ID</th>
    <th>CUSTOMER NEEDS</th>
		
    <th>ENQUIRY D & T</th>
		<th>ASSIST NOW</th>
		 
    </tr>
</thead>
<tbody>
<!-- Here's where we loop through our $quotes array, printing out quote info -->

    <?php foreach ($quotes as $quote) :?>
    <tr>
       
		<td>
            <?php //echo "XRVL".$quote['Quotebid']['quoteid']; ?>
             <?php echo $quote['quotes']['enquiry_id']; ?>
		</td>
        <td>
            <?php 

            $mask=$this->requestAction('/myaccount/mask_field_index/'.$quote['quotes']['quoteid']);
            echo $this->Text->truncate($mask, 60);

            //echo $this->Text->truncate($quote['quotes']['productspec'],40); 
            ?> 

        </td>
		
		
     
        <?php
            if($quote['quotes']['status']== 1){$quotestatus="Approved";$cssstatus="approved";}
            if($quote['quotes']['status']== 2){$quotestatus="Pending";$cssstatus="pending";}
            if($quote['quotes']['status']== 0){$quotestatus="Disappoved";$cssstatus="disapproved";}
            if($quote['quotes']['status']== 4){$quotestatus="Bid Closed By Customer";$cssstatus="closed";}
            if($quote['quotes']['status']== 5){$quotestatus="Bid Finalized By Customer";$cssstatus="selected";}
         ?>
          <!--<td class="<?php //echo $cssstatus;?>">
           <?php //echo $quotestatus;?>
          </td>-->
          <td>
               <?php 
             // echo $quote['quotes']['enquiry_time']; 
               echo $this->Time->format($quote['quotes']['enquiry_time'], '%l:%M %p, %e %b %Y, %a ')
               ?> 
          </td>
        <td class="view_details">
        <?php
          echo $this->Html->link('View Details', array('controller'=>'leads','action' => 'details', $quote['quotes']['enquiry_id']));
         ?>
			<!--/button-->
        </td>
	</tr>
    <?php endforeach; ?>
	<ul class="pagination pagination-lg" style="float:right">
	  <?php
   /* echo $this->Paginator->first(__('First', true), array('class' => 'disabled'));
    echo " ";
    echo $this->Paginator->prev('« Prev', null, null, array('class' => 'disabled'));
    echo " ";
    echo " ";
    echo $this->Paginator->next('Next»', null, null, array('class' => 'disabled'));
    echo " ";
    echo $this->Paginator->last(__('Last', true), array('class' => 'disabled'));
    echo"(";
    echo $this->Paginator->counter(array('format' => 'range'));
    echo")";*/
		 //echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => '', 'currentClass' => 'active', 'currentTag' => 'a' ));
	 ?>
    </ul>
    <?php unset($quote); ?>
</tbody>
</table>
</div><!--responsive table -->
 <!--Square format-->
           
        
       
      
   <!--Square format-->
</div><!--End Rightacc-->

<?php echo"</div></div></div>";
    }
    else{
    echo"<p style=\"margin-top:65px\"></p>";?>
    <div class="alert alert-danger" >
        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
        <strong>Info:</strong> No Leads as yet..
    </div>


    <?php echo("<p></p>");
}

?>
