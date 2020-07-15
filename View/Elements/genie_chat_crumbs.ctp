 <?
 echo" <div class='leads_bread_det leads-pop-des' >";
			    echo"<span class='lead-bread-crumb-family'>";
					 
					     echo "<span style='color:#0070C0'> "; 
					     echo $this->Html->link('Home ', array('controller'=>'leads','action' => 'chatoffhome',$enquiry_id,$clientID ),array('target' => '_blank'));
					     echo "<span style='color:#0070C0'>   >"; 
					     echo"</span>";  
					    
					       echo "<span style='color:#0070C0'> ";
                  
					    if($clientID == $quoted_user){

					        echo $this->Html->link('Back to Enquiry', array('controller'=>'leads','action' => 'chatoff',$enquiry_id,$quoted_user),array('target' => '_blank'));

					    }
					    else{

					    	 echo $this->Html->link('Back to Leads', array('controller'=>'leads','action' => 'chatoff',$enquiry_id,$clientID),array('target' => '_blank'));
					    }
					       echo"</span>"; 
					     
			     echo"</span>";
	    echo"</div>";
?>