<!doctype html>
<html lang="en-IN" itemscope="" itemtype="http://schema.org/WebPage">
<head>
<title><?php echo $title_for_layout;?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="robots" content="index,follow"/>
<meta name="description" content="<?php echo $description_for_layout;?>" />
<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
<link rel="icon" href="/img/favicon.ico" type="image/x-icon">

        <?php 

         $this->Combinator->add_libs('css', array('BootMain.css'));

        if($campaign==1||$campaign==2){
          $this->Combinator->add_libs('css', array(
          'genieSpecialoff.css'
       ));
        }else{
 $this->Combinator->add_libs('css', array('XerveMain.css'));
if($device == 'Mobile'){ $this->Combinator->add_libs('css', array('bootMain_mob.css'));} else { $this->Combinator->add_libs('css', array('bootMain_dsk.css'));}
    $this->Combinator->add_libs('css', array('Genie_min.css'));
    echo $this->Combinator->scripts('css', true);

        }
			echo $this->Combinator->scripts('css'); // Output CSS files
			?>
	</head>
	<body>
		<input id="ActionName" type="hidden" value="<?=$this->params['action']?>">
		<input type="hidden" id="search_done_home" value="0">	
		<input type="hidden" name="search_done_enter" id="search_done_enter" value="0">
			<div id="MainAjaxContainer">	
			 <div class="marg-leadsdetail geniemainform" >
				<div class="container-fluid padding-0">
						<div class="row">
							<!-- <div id="Sidebar" class="leftsidebar"></div> -->
							<?php echo $content_for_layout; ?>
						</div>
					</div>
                </div>
			</div>



<?if($campaign==1){
  $this->Combinator->add_libs('js',array(
            'jquery-1.9.js',
            'bootstrap.js',
            'lazyload.min.js',
           // 'compare_validate.js',
            'genie_custom_new.js',
            'bootstrap-select.min.js',
            'owl.carousel.js',
            'common_genie.js',
            'calender.js'
        ));
 }else if($campaign==2){
            $this->Combinator->add_libs('js',array(
            'jquery-1.9.js',
             'bootstrap.js',
            // 'glazyload.js',
            'compare_validate.js',
            'custom_new.js',
            'bootstrap-select.min.js',
            'owl.carousel.js',
            'nprogress.js',
            'common_genie.js',
            'campaign_genie.js',
            'calender.js',
       ));
 }
 else{
    $this->Combinator->add_libs('js',array(
            'jquery-1.9.js',
            'bootstrap.js',
            'compare_validate.js',
            'login_validate.js',
            'custom_new.js',
            'bootstrap-select.min.js',
            'owl.carousel.js',
            'lazyload.min.js',
            // 'genie_map',
            'nprogress.js',
            'social_inner.js',
            'leads_after_login.js',
            'common_genie.js',
            'normal_genie.js',
            'calender.js',
            //'social.js'
        ));

    } 
    echo $this->Combinator->scripts('js'); // Output Js files
    ?>
    <script  async src='https://maps.googleapis.com/maps/api/js?v=3&amp;libraries=places&key=AIzaSyBLaay-Ls0Ktl3zp-VL0lgYqFRp-sSg6zI'></script> 
    <?
    if($this->request->query['channel']=='ch-1-11' || $this->request->query['channel']=='ch-14-11'|| $this->request->query['channel']=='ch-8-11' || $this->request->query['channel']=='ch-14-12' || $this->request->query['channel']=='ch-14-13'){
          echo $this->element('main_header_join'); 
        }
        else{
          echo $this->element('detail_header'); 
        }
    ?>    
      <? 
        if($campaign>2){ //echo "c".$campaign;
      ?>
         <script type="text/javascript">
          new gnMenu(document.getElementById('gn-menu'));
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
        <? }?>
<?}?>
<script type="text/javascript">
    $(window).on('load', function () {

    var css = [
       '/css/Fonts.css'
    ],
    i = 0,
    link = document.createElement('link'),
    head = document.getElementsByTagName('head')[0],
    tmp;
    link.rel = 'stylesheet';

    for(; i < css.length; i++){
        tmp = link.cloneNode(true);
        tmp.href = css[i];
        head.appendChild(tmp);
    }
});
</script>

</body>
</html>



