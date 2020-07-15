<?php //include("loader.php"); ?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>jChat</title>
	<?php
 echo $this->Html->css('jChat');
 echo $this->Html->css('reset');
echo $this->Html->css('bootstrap');
echo $this->Html->css('bootstrap-responsive.css'); 
echo $this->Html->css('user_css.css');

echo $this->Html->script('jquery');
echo $this->Html->script('bootstrap'); 
?>

    <!--link href="css/jChat.css" rel="stylesheet"  media="screen" type="text/css" />
	
    <link href="css/reset.css" rel="stylesheet"  media="screen" type="text/css" />
    <link href="css/bootstrap.css" rel="stylesheet"  media="screen" type="text/css" />
    <link href="css/bootstrap-responsive.css" rel="stylesheet"  media="screen" type="text/css" />
    <link href="css/user_css.css" rel="stylesheet"  media="screen" type="text/css" /-->
	    
    <!--script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script-->
    
</head>

<body>
  
  <!-- MAIN -->
    <div id="main" class="container-fluid">
        
        <!-- container content -->
        <div class="container-fluid">
        	
            <div class="row-fluid">
                  
                <div id="main-content"><!-- MAIN CONTENT -->
                                 
                    <form class="form-signin" action="login" method="post">
                    
                        <div id="login_logo"></div>
                        
                        <?php if(isset($_SESSION['jChat_loginMessage'])) { ?>
                        	<div class="alert alert-info">
                            	<?php echo $_SESSION['jChat_loginMessage']; unset($_SESSION['jChat_loginMessage']); ?>
                            </div>
                        <?php } ?>
                        
                        <div class="input-prepend">
                        	<span class="add-on"><span class="icon-user"></span></span>
							<input type="text" name="username" class="span11" placeholder="Username">
                        </div>
                        
                        <div class="input-prepend">
                        	<span class="add-on"><span class="icon-lock"></span></span>
                        	<input type="password" name="password" class="span11" placeholder="Password">
                        </div>
                        
                        <label class="inline pull-left">
                         <a href="index.php" class="mt10 pull-left">&larr; Back to site</a>
                        </label>
                        <button class="btn btn-primary pull-right" type="submit">Log in</button>
                        
                        <div class="clear"></div>

                     </form>
                                                           
                </div><!-- // MAIN CONTENT -->
                </div>
            
            </div>
            
		</div>
		<!-- // container content -->
                
        <div class="clear"></div>
        
    </div>
    <!-- // MAIN -->
    
</body> 
</html>
