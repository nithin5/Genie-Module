<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Dashboard</title>
 <?php
echo $this->Html->meta('icon');
echo $this->fetch('meta');
echo $this->Html->css('jChat');
echo $this->Html->css('bootstrap');
        
		//echo $this->Html->css('reset');
        
		
		//echo $this->Html->css('bootstrap-responsive'); 
         
		//echo $this->Html->css('user_css');
      
        echo $this->Html->script('jquery.min');
        echo $this->Html->script('bootstrap.min');
?>   
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 100%;
      //margin: auto;
  }
  </style> 
    
</head>

<body>

	
    <div class="container">
    <div class="well well-sm"  style="background-color: #337ab7;
border-color:#337ab7;margin-bottom: 4px;padding-top: 9px;
    padding-bottom: 30px;">
<?php 
  //echo $this->Html->link( 'Quote Chat Dashboard', '#', array('escape'=>false,'style'=>'color:#FFFFFF')); 
                            
  echo $this->Html->link('Back to Quotes','/quotes/chatoff', array('escape' => false,'style'=>'float:right;color:#FFFFFF')) ;?>
</div>
    <div class='panel panel-primary'>
                             <div class='panel-heading' style="padding-left: 197px;">
                             A Unique Platform to Communicate with Vendors 
                             </div>
                   <div class='panel-body'>
	
            
            
            <!--<div class="content">-->
            	<div class="well well-sm" style="padding-left: 197px;padding-top: 0px;padding-bottom: 0px;background-color: #5bc0de;color:#FFFFFF">
                
                 <h4>  Select the users  & Negotiate the Deals Instantly Online</h4>
            </div><!--well -->

                <div class="chat-contents-left">    
                <div class="table-responsive">           
                <table class="table table-hover ">
                    <tbody>
					<?php //print_r($Userlist); ?>
                    	<?php foreach($Userlist as $user) { 
                       
							$user_id = $user['users']['id'];
							$first_name = $user['users']['first_name'];
                            $last_name = $user['users']['last_name'];
                            $full_name=$first_name."    ".$last_name;
							$status = $user['users']['status'];
                            $session = $user['users']['session'];
					//$this->requestAction('/jchats/unread', array('pass' => array('123')));	
                    $new_message=$this->requestAction('/quotes/unread/'.$user_id.'/'.$quoteid);
					          //echo  "new message".$new_message;
		
							if($new_message == 0)
							{
								$message_appender = '';
							} else {
								$message_appender = ' <span class="badge badge-info">'.$new_message.'</span>';	
							}
							
							
							if($session == 'online')
							{
								$session_appender = '<span class="label label-success">'.$session.'</label>';
							} else {
								$session_appender = '<span class="label label-danger">'.$session.'</label>';
							}
              
						?>
                        <tr>
                           <td>
						   
						   
						   
				<?php 
				
            $profile_pic=$this->Html->image('/images/avatars/default.png', array('height'=>'40px','width' => '60px','alt'=>'Profile Pic'));
		echo $this->Html->link($profile_pic, array('controller'=>'quotes','action'=>'chat',$user_id,$quoteid), array('escape'=>false));
		//echo $this->Html->image('/images/avatars/user'.$user_id.'.png', array('height'=>'18px','width' => '40px','alt'=>'Profile Pic'));
		
		?>		   
						   <!--/a-->
						   </td>
						   
                           <td>
						   <!--a href="chat.php?id=<?php //echo $user_id; ?>">
						   <span class="userNames"><?php //echo ucfirst($user_name); ?></span></a--> 
						  <?php echo $this->Html->link(ucfirst($full_name),'/quotes/chat/'.$user_id.'/'.$quoteid,array('class' => 'userNames', 'escape' => false));
						   ?>
						   <?php echo $message_appender; ?>
                           
						   <br />
                           <span class="on-row"><?php echo $session_appender; ?></span>
                           <!--<span class="status"><?php //echo $status; ?></span>
                                 <span class="status"><?php //echo $session; ?></span>-->
						   </td>
						   
                           <!--<td></td>-->
                        </tr>
                        <?php } ?>
                    </tbody>
                </table> 
                </div><!--table responsive -->           
                  </div> <!--contents-left -->
                  </span></div></div>
                <div class="chat-contents-right" >


                  <!-- ------------------------------ -->
                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators" style="margin-bottom:-4px">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="/images/chat-1.jpg" alt="Quote Chats" width="560" height="345">
        <div class="carousel-caption" style="background-color:#337ab7;position:static;padding-top:1px;
    padding-bottom:31px;">
        <h3>Instant Deals</h3>
        <p>Select the Vendor from left & Chat instantly</p>
      </div>
      </div>

      <div class="item">
        <img src="/images/chat-2.jpg" alt="Quote Chats" width="560px" height="345px">
        <div class="carousel-caption" style="background-color:#337ab7;position:static">
        <h3>Best Quotes</h3>
        <p>Choose the Best Quotes from Vendors</p>
      </div>
      </div>
    
      <div class="item">
        <img src="/images/chat-3.jpg" alt="Quote Chats" width="560px" height="345px">
         <div class="carousel-caption" style="background-color:#337ab7;position:static">
        <h3>Online Deals</h3>
        <p>Customers meeting vendors at real time online</p>
      </div>
      </div>

      <div class="item">
        <img src="/images/chat-4.jpg" alt="Quote Chats" width="560px" height="345px">
        <div class="carousel-caption" style="background-color:#337ab7;position:static">
        <h3>Online & Offline Messages</h3>
        <p>User can receive the messages even if offline and reply when online</p>
      </div>
      </div>
    </div> <!--carousel-inner-->

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div><!-- myCarousel -->
              <!--    -----------------------------------   -->
                    
                </div><!--right -->

                
        
       <!-- </div>--><!-- // box -->
     <!--</div>--><!-- .span6 -->
     
     <!--</div>--><!-- .grid-set -->
     
    </div><!-- .container -->
                
</body> 
   
</html>