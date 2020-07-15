<!doctype html>
<html lang="en-IN" itemscope="" itemtype="http://schema.org/WebPage">
<head>
					<title><?php echo $title_for_layout;?></title>
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<meta name="robots" content="index,follow"/>
					<!--fav icon-->
					<meta name="description" content="<?php echo $description_for_layout;?>" />
					<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
					<link rel="icon" href="/img/favicon.ico" type="image/x-icon">
					
					<!--eo fav icon -->
					 <!--<link rel="stylesheet" type="text/css" href="/fonts/531538/E9EF8CF9D9077D7F9.css" />-->
					<?php 
					if($Yes_Full==1){//buyer chat page
					$this->Combinator->add_libs('css', array(
							'bootstrap.min.css',
							'genie_media_desktop.css',
							'genie_media_mobile.css',
							//'carousel.css',
							'chat_master_style.css',
							'mheader_main.css',
							'header_main.css',
							//'detail_page.css',
							//'mdetail_page.css'
						
					));
					}else{//leads main page
						$this->Combinator->add_libs('css', array(
							'bootstrap.min.css',
							'genie_media_desktop.css',
							'media_mobile.css',
							'carousel.css',
							'chat_master_style.css',
							'mheader_main.css',
							'header_main.css',
							'detail_page.css',
							'mdetail_page.css'
						
					));
					}	
						echo $this->Combinator->scripts('css'); 
						
					?>
				</head>

	<body>
	
		<?if(($this->params['controller']=='genie')||($this->params['controller']=='genie2')){
			    //buyer chat page
			            echo"bcp";
						$this->Combinator->add_libs('js',array('jquery-1.9.js',
							'jquery-ui-1.9.js',
							'jquery.lazyload.js',
							'bootstrap.js',
							'bootstrap-select.min.js',
							'genie_full_details.js')
					);
					}else{
                               echo "else";
						if($Yes_Full==1){
						echo "if";
							$this->Combinator->add_libs('js',array(
					       	'jquery-1.9.js',
					       	'jquery-ui-1.9.js',
					       	'bootstrap',
					       //	'chat_custom_new.js',
					       	//'login_validate.js',
					       	'bootstrap-select.min.js',
					       //	'custom.js',
					       	//'owl.carousel.js',
					       	//'sticky-kit.js',
					       	//'nprogress_filter.js',
					       	//'nprogress.js',
					       	//'compare_validate.js',
					       	//'calender.js',
					       	'chat_full_details.js',
					       	//'social_inner.js'
					       ));

						}else{
							echo "elsee";
							$this->Combinator->add_libs('js',array(
					       	'jquery-1.9.js',
					       	'jquery-ui-1.9.js',
					       	'bootstrap',
					       	'custom_new.js',
					       	'login_validate.js',
					       	'bootstrap-select.min.js',
					       	'custom.js',
					       	'owl.carousel.js',
					       	'sticky-kit.js',
					       	'nprogress_filter.js',
					       	'nprogress.js',
					       	'compare_validate.js',
					       	'calender.js',
					       	'chat_full_details.js',
					       	'social_inner.js'
					       ));

						}
					       
					}
					echo $this->Combinator->scripts('js'); 
					?>
	 				
	<input id="ActionName" type="hidden" value="<?=$this->params['action']?>">
	<input type="hidden" id="search_done_home" value="0">	
	<input type="hidden" name="search_done_enter" id="search_done_enter" value="0">
    <?php 

    $enq_id  = $this->request->params['pass'][0]; 
    $sid_id  = $this->request->params['pass'][1];//sid id
    $mystring = $sid_id;
    $findme   = 'SID';
    $findfoot   = 'XRVL';
    $pos = strpos($mystring, $findme);
    $footpos = strpos($enq_id, $findfoot);
            if(($this->params['controller']=='genie')AND($pos === false)){
                 if($Yes_Full==1){//chat page
                 	
            	  	echo $this->element('main_header_join', array('from'=>'')); 
            	  }
            	  else{
                  echo $this->element('main_header'); 
                }
            }
            else{
            	  if($Yes_Full==1){//chat page
            	  	    echo $this->element('main_header_join', array('from'=>'')); 
            	  }
            	  else{
                        echo $this->element('main_header', array('from'=>'')); 
                  }
            }
    ?>

	<?php//echo $this->element('company_page', array('from'=>'')); ?>

		<div id="MainAjaxContainer">	
         <?if ($this->params['action'] != 'chat') {?>

			 <section class="marg-leadsdetail <?if ($this->params['controller'] == 'genie') {?> 		geniemainform <?}?>" >

		<?}else{?>
			<section class="margleadschat" >
			       <?}?>
				    <div class="container-fluid padding-0">
							<div class="row">
								<div id="Sidebar" class="leftsidebar"></div>
								<?php echo $content_for_layout; ?>
							</div>
					</div>
			</section>
		</div>
    <?php 
       if ($footpos === false) { 
       	   if($User_Id!=''){
                    echo $this->element('footer', array('from'=>'')); 
         }
       }
    ?>
    <script async src='https://maps.googleapis.com/maps/api/js?v=3&amp;libraries=places&key=AIzaSyBLaay-Ls0Ktl3zp-VL0lgYqFRp-sSg6zI'></script> 
    <? 
    if($Yes_Full==0){

    	?>
		<script type="text/javascript">
			 new gnMenu(document.getElementById('gn-menu'));
			 $(document).ready(function(){
			 	 $('.selectpicker').selectpicker({});
			 });
		</script>
		 <?if(!empty($User_Id)){?>
			 <script type="text/javascript">
			 show_info_myaccount(<?=$User_Id?>,1);
			 </script>
		<?}?>
		 <? if(empty($User_Id) || (!empty($User_Id) && !empty($UserStatus))){?>
				<script type="text/javascript">
					$(document).ready(function(){
				      linkedin_login();
				      userlocation();
				    });
				 function linkedin_login(){
				    $.getScript("https://platform.linkedin.com/in.js?async=true", function success() {
				        IN.init({
				            api_key: '782s7su6wmor85',
				            authorize: true,
				            scope: "r_basicprofile r_emailaddress",
				        });
				    });
				}
				</script> 
      <? }
    }
    ?>
</body>
</html>



