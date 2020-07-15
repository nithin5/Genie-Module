<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		
        echo $this->Html->css('bootstrap');
		echo $this->Html->css('jChat');
		echo $this->Html->css('reset');
		//echo $this->Html->css('bootstrap-responsive'); 
		echo $this->Html->css('user_css');
		      


		echo $this->Html->script('jquery.min');
		echo $this->Html->script('bootstrap'); 
		echo $this->Html->script('jChat');
		echo $this->Html->script('jquery.nicescroll.min');
		//echo $this->Html->script('jquery.livequery');
		//echo $this->Html->script('jquery.timeago');
		//echo $this->Html->script('dateFormat.min');
		echo $this->Html->script('custom');
		//echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('jquery-ui');
		
	?>  
    <div class="well well-sm"  style="background-color: #337ab7;
border-color:#337ab7;margin-bottom: 4px;">

</div>
     <div class='panel panel-info'>
                             <div class='panel-heading'>Previous Messages
<?php /*echo $this->Html->link( 'Back to Chat Dashboard', array('controller'=>'quotes','action'=>'dashboard',$quoteid), array('escape'=>false,'style'=>'color:#FFFFFF'));	
                            
  echo $this->Html->link('Back to Quotes','/quotes/chatoff', array('escape' => false,'style'=>'float:right;color:#FFFFFF')) ;*/?>
                             </div>
                   <div class='panel-body'>
 
         <!--form id="chatform" method="post"-->
        <div class="contentchat" id="contentchat">
        	
           
            
			<!-- jChat -->
				
            <ul class="messages-layout">
               
				<?php 
				
				if($messages_ids !='')
				{
				foreach($messages_ids as $message){
					//ucfirst($this->get_user($user_id,'USERNAME'));
                     //$new_message=$this->requestAction('/jchats/unread/'.$user_id);
					if($message['messages']['user_id']== $clientID)
                    {
					 $class="client";	
					 $src="/images/avatars/client.png";
					}	
                    else{
					 $class="server";	
					 $src="/images/avatars/server.png";	
					}					
			$username=$this->requestAction('/quotes/get_username/'.$message['messages']['user_id']);
			//$msg_time=$this->requestAction('/jchats/get_messages_time/'.$message['messages']['user_id']);
					?>
					
				<!--<form id="chatform" method="post">-->
				<li class="<?php echo $class;?>" id="<?php echo $message['messages']['id'];?>">
		
		<a href="#" title="<?php echo $username;?>">
         <img src="<?php echo $src;?>" height="70px" width="50px" alt="<?php echo $username;?>">

       
		</a>
		
		<div class="message-area">
			<span class="pointer"></span>
			<div class="info-row">
				<span class="user-name"><a href="#"><strong><?php echo $username;?></strong></a> says:</span>
				<span class="delete" id="delete_<?php echo $message['messages']['id'];?>">x</span>
				<span class="time" id="message_<?php echo $message['messages']['id'];?>">
				<a href='#' >
				
				<?php 
				$time=$message['messages']['time'];
				
			//$date = date('F j, Y, g:i a', strtotime(str_replace('-', '/', $time)));
			$date = new DateTime($time);
			//$sessiontime = new DateTime($ServerLastTime);
			echo $this->Time->timeAgoInWords($date);
			
				?>
                 </a>
				</span>
				<div class="clear"></div>
			</div>
			<p>
				<?php echo $message['messages']['messages'];?>
			</p>
		</div>
		<div class="clear"></div>
	</li>
				<?php }}?>
            </ul><!--messages-layout-->
            <!-- Enter message field -->
           <!-- <span class=time">-->
             
             <span style="font-size:11px">
            
             <?php //echo "Last Logged in ".$this->Time->timeAgoInWords($sessiontime); ?>
           
             </span>
			
           
            <!--</form>-->
           
            
            <!-- // jChat -->
                     
        </div> <!-- // contentchat -->
        
    <!--container -->