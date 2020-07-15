<!doctype html>

<html lang="en-IN" itemscope="" itemtype="http://schema.org/WebPage">

<head>

<meta charset="utf-8">

<title><?php echo $title_for_layout;?></title>

 

 <meta http-equiv="X-UA-Compatible" content="IE=edge">

 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="robots" content="index,follow"/>
<!--fav icon--> 

<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="/fonts/531538/E9EF8CF9D9077D7F9.css" />
<link rel="icon" href="/img/favicon.ico" type="image/x-icon">

<!--eo fav icon -->

<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>-->


<?

  $this->Combinator->add_libs('css', array('bootstrap.min.css','master.css','my_style.css','lbs_live.css','responsive.css','Enquiry_style.css','owl.carousel.css','price_main.css'));

/*$this->Combinator->add_libs('css', array('bootstrap.min.css','master.css','jquery.simpleLens.css','my_style.css','owl.carousel.css','owl.theme.css','owl.transitions.css','responsive.css','jslider.css','Enquiry_style.css','font_ntr.css','nprogress_filter.css','nprogress.css'));*/


  echo $this->Combinator->scripts('css'); // Output CSS files 

  $this->Combinator->add_libs('js',array('jquery-1.9.js','bootstrap.js','bootstrap-select.min.js','owl.carousel.js','genie_pricing.js','login_validate.js','custom_new.js')); 

 /*$this->Combinator->add_libs('js',array('jquery-1.9.js','jquery.lazyload','bootstrap', 'sd_lite_xr.js','custom_new.js','login_validate.js','bootstrap-select.min.js','custom.js','owl.carousel.js','sticky-kit.js','back_button_override.js','nprogress_filter.js','nprogress.js'));*/

  	echo $this->Combinator->scripts('js'); // Output Js files //,'jquery.autocomplete_search','suggest_search.js'
  ?>


</head>

<body>



<?php 
     echo $this->element('main_header', array('from'=>'')); 
      //echo $this->element('detail_header'); 
?>

<?php //echo $this->element('sorting', array('from'=>'')); ?>

<?php// echo $this->element('pricing_page', array('from'=>'')); ?>



<div id="MainAjaxContainer">



<?php echo $content_for_layout; ?> 






</div>



<?php echo $this->element('footer', array('from'=>'')); ?>



<!--side menu-->

	<script type="text/javascript">

  //               $(document).ready(function() {
  //               	<?if (empty($Pricing_page)){ ?>
  //               		alert("he");
  //                       LeftSidebar();
  //               	<? } ?>
 	// //menu
		// 		});
	//new gnMenu(document.getElementById('gn-menu'));
	 $(function () {
		 if (navigator.userAgent.indexOf('Safari') != -1 &&
			 navigator.userAgent.indexOf('Chrome') == -1) {
			 $("body").addClass("iphonemb");
		 }
	 });
</script>

 <?

 if(!empty($User_Id)){?>
               <script type="text/javascript">
                 show_info_myaccount(<?=$User_Id?>,1);
               </script>
          <?}?>
<script src='https://maps.googleapis.com/maps/api/js?v=3&amp;libraries=places&key=AIzaSyBLaay-Ls0Ktl3zp-VL0lgYqFRp-sSg6zI'>

  function show_info_myaccount(user){
    $(".loading-header-hover").show();$.ajax({type:"POST",url:'/Generals/myaccount_info',data:"user="+user,success:"success",dataType:'text',context:document.body}).done(function(msg){$(".loading-header-hover").hide();var obj=jQuery.parseJSON(msg);user=obj.user;name=obj.name;like=obj.like;leads=obj.leads;company=obj.company;cash=obj.cash;wish=obj.like
 if(user=='seller'){$("#header_seller_section").show();$("#cash_value_seller").text(cash);$("#wish_value_seller").text(wish);$(".seller_name_header").text(company);$("#leads_value").text(leads);}
 else{$("#header_buyer_section").show();$("#cash_value_buyer").text(cash);$("#wish_value_buyer ").text(wish);$(".buyer_name_header").text(name);$("#leads_value").text(leads);}});}     

</script>

<!--eo side menu-->

</body>

</html>

