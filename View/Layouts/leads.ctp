<!doctype html>
<html lang="en-IN" itemscope="" itemtype="http://schema.org/WebPage">
<head>
<meta charset="utf-8"> 
<title><?php echo $title_for_layout;?></title>
<meta name="description" content="<?php echo $description_for_layout;?>" />
<meta name="keywords" content="<?php echo $keyword_for_layout;?>">

 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
<!--fav icon-->
<meta name="robots" content="index,follow"/>

<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
<link rel="icon" href="/img/favicon.ico" type="image/x-icon">

<!--eo fav icon -->
<!-- <link rel="stylesheet" type="text/css" href="/fonts/531538/E9EF8CF9D9077D7F9.css" /> -->

<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
   -->
 
<? $this->Combinator->add_libs('css', array(
	'bootstrap.min.css','media_desktop','media_mobile','carousel.css','master_style.css','mheader_main.css','header_main.css','detail_page.css','mdetail_page.css'
	// 'bootstrap.min.css','master.css','lbs_live.css','responsive.css','my_style.css','jslider.css','Enquiry_style.css','nprogress.css','owl.carousel.css','owl.theme.css','owl.transitions.css','price_main.css'
));
   echo $this->Combinator->scripts('css'); // Output CSS files ?>

   	<?		
   	 $this->Combinator->add_libs('js',array('jquery-1.11.0.js','jquery.lazyload','bootstrap','sd_lite_xr.js','offers_validate.js','leads_validate.js','login_validate.js','bootstrap-select.min.js','custom.js','owl.carousel.js','sticky-kit.js','nprogress_filter.js','nprogress.js','clipboard.min','custom_new.js'));

	// $this->Combinator->add_libs('js',array('jquery-1.9.js','jquery.lazyload','bootstrap','custom_new.js','leads_validate.js','login_validate.js','bootstrap-select.min.js','custom.js','nprogress.js','owl.carousel.js'));
	
		   echo $this->Combinator->scripts('js'); // Output Js files // ,'jquery.autocomplete_search','suggest_search.js'
			
			?>
 
 
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P36F33S');</script>
<!-- End Google Tag Manager -->

<!--
$this->Combinator->add_libs('js',array('jquery-1.9.js','jquery.lazyload','bootstrap','custom_new.js','leads_validate.js','login_validate.js','bootstrap-select.min.js','custom.js','sticky-kit.js'));


	
 Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '1097615193685737');
fbq('track', "PageView");
fbq('track', 'ViewContent');
fbq('track', 'Search');
fbq('track', 'InitiateCheckout');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1097615193685737&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<!-- <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-77862621-1', 'auto');
  ga('send', 'pageview');

</script> -->

<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:14328,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>


<script type="text/javascript">
(function(p,u,s,h){
    p._pcq=p._pcq||[];
    p._pcq.push(['_currentTime',Date.now()]);
    s=u.createElement('script');
    s.type='text/javascript';
    s.async=true;
    s.src='https://cdn.pushcrew.com/js/620fe81f4083d86704f21ffc00837f9f.js';
    h=u.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(s,h);
})(window,document);
</script>
	
</head>
   
   <body>

   	

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P36F33S"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!--    <script type="text/javascript">
   		NProgress.start();
   </script>
				 -->	
            <?php echo $this->element('main_header', array('from'=>'')); ?>
			
			 <?php echo $this->element('company_page', array('from'=>'')); ?>
			
			 <input type="hidden" name="search_done_home" id="search_done_home" value="0">

		
			<div id="MainAjaxContainer">
			
		
		
			
			  <section class="marg-tp-leads" <?if($this->params['action']=="details" && $ajax_login=='no'){?>style="margin-top:150px;"<?}?>>
				  
			   <div class="container-fluid padding-0"> 
				
			   <div class="row"> 
			  <div class="col-md-2 padding">
			   <div id="sidebar_shot_view" style="display:none;position:fixed;width:250px;top:198px;">	
			  <div class="option-head" style="border:1px solid #3f51b5; background-color:#3f51b5;color:#fff;width:250px;padding-left:10px;cursor:pointer">
			  	<span style="font-size:20px;">Filters</span><span class="glyphicon glyphicon-menu-down" style="font-size:20px;float:right;"></span>  
			  </div>
			  </div>
               <div id="Sidebar_New" class="leftsidebar"></div>
			   </div>


							
<div class="col-md-10 padding-0">
							     <?php echo $content_for_layout; ?> 

							
</div>
					  </div><!--row-->
			   
			   </div><!--container-->
			   
			   
			   </section>
			   					
			
			</div><!--End MainAjaxContainer-->							
		 
	        <?php echo $this->element('footer', array('from'=>'')); ?>


	        
		 <?if(!empty($User_Id)){?>

			 <script type="text/javascript">

			 show_info_myaccount(<?=$User_Id?>,1);

			 </script>

			 <?}?>
			
			<script type="text/javascript"> 
			
			 function filter_postion()
			  {
			  
			  if($(window).width()>1200){
			  
			   /*var contentHeight = jQuery('#Home_Content').height();
			   var sidebarHeight = jQuery('.custom-aside').height();
			   alert(contentHeight);
			   alert(sidebarHeight);
			   alert(sidebarHeight-contentHeight);
			   			   
			   if (contentHeight < sidebarHeight) {
			   
			   jQuery('#extra_space').css({"height":sidebarHeight-contentHeight+"px"});
			  
			   }*/
			  			  
			      function attach() {
				  // $(".row .leftsidebar").stick_in_parent(); .attr("selected", "selected");
				  // $("#sidebar_shot_view").stick_in_parent();

				  $(".leftsidebar").attr("style", "position:fixed;top:198px;");
				}
			
				attach();
			
			  
			  }		  
			
			}	
			
			</script>
			
				<script src="/js/calender.js"></script>


				     <script type="text/javascript"> 
      
      	$( document ).ready(function() {
			
			  //alert("Hi");				

			 <?  if (!empty($Contract)) {  ?>
			
			  store_price_info();

			<? } if(!empty($Home)){ ?>
				  // Run_Brand_carousel();
				  
				  <? }?>	


		
			  $("#filter_load").show();
			   
			  filter_postion();			 
             
			
			  
			

			  // Store_Model_Index();
			  
			  // $("div[class^='dropdown-menu']").css({"position":"static","display":"block"});

			  // $("#Sidebar .dropdown-menu").css({"position":"static","display":"block"});

			   // $("#Sidebar .gender_section div[class^='dropdown-menu']").css({"position": "none", "display": "none"});
			  
			  $(".scroll-tab").show();			  

                          jQuery("#Sidebar").detach().appendTo('#Sidebar_New');
                          
                         var Full_Path = $("#url_now_new").val();

                      

                      //   if(Full_Path=='' || Full_Path==undefined){

                      //     	Full_Path = '';
                      //   }

                     	// var vars = [], hash;

                      // 	var hashes = Full_Path.slice(Full_Path.indexOf('?') + 1).split('/');


                      
                      //   for (var i = 0; i < hashes.length; i++)
                      //   {
                      //       hash = hashes[i].split('-');
                      //       vars.push(hash[0]);
                      //       vars[hash[0]] = hashes[i].replace(hash[0]+"-", "");
                      //   }
                   


                        //alert(hashes);

                        //alert(vars);       


                        var needName = vars.need;
                        var categoryName = vars.category;                 
                        var subName = vars.subcategory;
                        var cityName = vars.city;
                        var forName = vars.for;
                        var areaName = vars.area;
                       
                 
                        
                     //    if (categoryName !== undefined && categoryName!=''){   

                     //    	<? if(empty($Home) ){ ?>

                        
                     //    	var newpi = categoryName.split('|');

	                    //   	for (var i = 0; i < newpi.length; i = i + 1) {

	                      	
	                      		
		                   //      $('select[id="registerCategory"]').find("option[name='" + newpi[i].toLowerCase().replace(/\%26/g, "&") + "']").attr("selected", "selected");

		                   //   	$('select[id="registerCategory"]').find('option[name="' + newpi[i].toLowerCase().replace(/\%26/g, "&") + '"]').prependTo($('select[id="registerCategory"]'));
		                       
	                    // 	}  

	                    // <? } ?>                                    

                     //    }


                      //   if (subName !== undefined && subName!=''){

                      //   	var newpi = subName.split('|');

		                    // for (var i = 0; i < newpi.length; i = i + 1) {

		                    //     $('select[id="registerSubCategory"]').find("option[name='" + newpi[i].toLowerCase().replace(/\%26/g, "&") + "']").attr("selected", "selected");

		                    //   	$('select[id="registerSubCategory"]').find('option[name="' + newpi[i].toLowerCase().replace(/\%26/g, "&") + '"]').prependTo($('select[id="registerSubCategory"]'));
                        
		                    // }                        

                      //   }

                      //   if (cityName !== undefined && cityName!=''){

                      //   	var newpi = cityName.split('|');

		                    // for (var i = 0; i < newpi.length; i = i + 1) {

		                    //     $('select[id="registerCity"]').find("option[name='" + newpi[i].toLowerCase().replace(/\%26/g, "&") + "']").attr("selected", "selected");

		                    //   	$('select[id="registerCity"]').find('option[name="' + newpi[i].toLowerCase().replace(/\%26/g, "&") + '"]').prependTo($('select[id="registerCity"]'));
                        
		                    // }                        

                      //   }	
                        console.log(forName);

                      //    if (forName !== undefined && forName!=''){

                      //   	var newpi = forName.split('|');

		                    // for (var i = 0; i < newpi.length; i = i + 1) {

		                    //     $('select[id="registerFor"]').find("option[name='" + newpi[i].toLowerCase().replace(/\%26/g, "&") + "']").attr("selected", "selected");

		                    //   	$('select[id="registerFor"]').find('option[name="' + newpi[i].toLowerCase().replace(/\%26/g, "&") + '"]').prependTo($('select[id="registerFor"]'));
                        
		                    // }                        

                      //   }


                      //   if (areaName !== undefined && areaName!=''){

                      //   	var newpi = areaName.split('|');

		                    // for (var i = 0; i < newpi.length; i = i + 1) {

		                    //     $('select[id="registerArea"]').find("option[name='" + newpi[i].toLowerCase().replace(/\%26/g, "&") + "']").attr("selected", "selected");

		                    //   	$('select[id="registerArea"]').find('option[name="' + newpi[i].toLowerCase().replace(/\%26/g, "&") + '"]').prependTo($('select[id="registerArea"]'));
                        
		                    // }                        

                      //   }

                      


        //                 $('.selectpicker').selectpicker({});

        //                 // alert('hi')

        //                   $("#filter_load").hide();

						  

        //                 if (categoryName !== undefined)
        //                 	$('button[data-id="registerCategory"] .pull-left').text('Category');
                      
        //                 if (subName !== undefined)
        //                     $('button[data-id="registerSubCategory"] .pull-left').text('Sub-Category');
        //                 if (cityName !== undefined)
        //                     $('button[data-id="registerCity"] .pull-left').text('City');
        //                 if (areaName !== undefined)
        //                     $('button[data-id="registerArea"] .pull-left').text('Area');
        //               	if (forName !== undefined)
        //                     $('button[data-id="registerFor"] .pull-left').text('Customer Type');
			  			 
			  		
			  			// $("#Sidebar").show();
                      


			  //jQuery("#Sidebar").appendTo('#Sidebar_New');
			  
			  /*var filter_html = $("#Sidebar").html();
			
			  $("#Sidebar_New").html(filter_html);*/			  
			 
              });


      //  window.onload = load;      

        function load() {		
              	 NProgress.done();

          
			  
			 }
			 
			 window.onload = load;	
			
       
       </script>

		<script>

		$(document).ready(function(){
				//LeftSidebar();

			
				//filter_search();
		
			    //filter_search_position();
		});
		



		</script>

		<script src='https://maps.googleapis.com/maps/api/js?v=3&sensor=false&amp;libraries=places&key=AIzaSyBLaay-Ls0Ktl3zp-VL0lgYqFRp-sSg6zI'></script>
	
</body>
</html>
