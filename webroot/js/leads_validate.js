
var req_query = null;
function SelectOption(field, order, id, value, page) {

    

    $(window).scrollTop(0);

    $('#Sidebar').css('cssText', 'position:fixed;top:138px;');     

    
    if (order=='submit-price'){
        
        $("input[id='lazyload_price_control']:last").val("yes");        
                
    }
        
  
 
    if (req_query != null) req_query.abort();

  

    var Home_Value = $("input[id='Home']:last").val();

    if(Home_Value!=''){

       // var  view_value_path ='?need=Personal'
    }
    else{

        var view_value_path = $("#url_now").val();

    }


 view_value = $("input[id=view_value]:last").val();

    if (field == 'Store')
    {
        var For = value;


        var for_url = '';

                // if (For=='Business') {
                //     for_url = "/for-business";
                // };


        window.location.href = 'https://www.xerve.in/leads';
    } else
    {
        // var For = $("input[id=For]:last").val();
        var For = "";
    }

    if (((page == 'close'|| page=='close-mobile') && (field == 'Search') && $("#self").val() != 1 && field != 'Store') || (page == 'clear'))

    {

    var view_va = $("input[id=view_value]:last").val();

                var for_url = '';

                if (For=='Business') {
                    for_url = "/for-business";
                };
        window.location.href = 'https://www.xerve.in/leads'+for_url;
    }
    if (page == 'gray')
    {
        //$("#register"+field).find('option').removeClass("selected");
        $('option[id="' + field + '-' + id + '"]').removeAttr('selected');
        $("option[value='" + id + "']").removeAttr('selected');
        $("option[value='" + id + "']").attr("selected", "");
        window.open('https://www.xerve.in/leads?need=' + For + '&' + field.toLowerCase() + '=' + value.replace(/\&/g, "%26"), "_blank");
        return false;
    }

    id = id.replace(/\#39/g, "'");

    value = value.replace(/\#39/g, "'");



    var select_box1 = $("select[id*='registerCategory']").html();

    var select_box2 = $("select[id*='registerGender']").html();

    var select_box3 = $("select[id*='registerSubCategory']").html();

    var select_box4 = $("select[id*='registerType']").html();

    

    
    var Path_Last = $("input[id=url_last]:last").val();
    
    
       
    path = "/leads";
         

    var vartop = [], hashing, p = 0;

    var hashtop = Path_Last.slice(Path_Last.indexOf('?') + 1).split('&');

    for (p = 0; p < hashtop.length; p++)
    {

        hashing = hashtop[p].split('=');
        if ($.inArray(hashing[0], vartop) === -1)
            vartop.push(hashing[0]);

    }

    if ($.inArray(field.toLowerCase(), vartop) === -1)
        vartop.push(field.toLowerCase());

 

    if (field == 'Store')

    {

        var store_for = value;

    } else

    {


        var store_for = $('#register0 .custom-checked').val();

    }


   // var search = $("input[id=Search]:last").val();

      if ((page == 'close' || page=='close-mobile') && field == 'Search'){
        var Search = '';
        $(".cl_search_close").remove();  
    }
    else
        var Search = $('#Search').val();


   
   
    var check_add_delete = 0;

    var show_clea_for = 0;

        var Filter_Other_Category = $("input[id='Filter_Other_Category']:last").val();
        if (Filter_Other_Category!='' ) {           
            $("#registerCategory").prepend('<option id="'+Filter_Other_Category+'" name="'+Filter_Other_Category.toLowerCase()+'" value="'+Filter_Other_Category+'" selected=selected>'+Filter_Other_Category+'</option>')
        }     

        var Filter_Other_Brand = $("input[id='Filter_Other_Brand']:last").val();
        if (Filter_Other_Brand!='' ) {
            $("#registerBrand").prepend('<option id="'+Filter_Other_Brand+'" name="'+Filter_Other_Brand.toLowerCase()+'" value="'+Filter_Other_Brand+'"  selected=selected>'+Filter_Other_Brand+'</option>')
        }    

        var Filter_Other_SubCategory = $("input[id='Filter_Other_SubCategory']:last").val();
        if (Filter_Other_SubCategory!='') {
            $("#registerSubCategory").prepend('<option id="'+Filter_Other_SubCategory+'" name="'+Filter_Other_SubCategory.toLowerCase()+'" value="'+Filter_Other_SubCategory+'" selected=selected>'+Filter_Other_SubCategory+'</option>')
        }

        var Filter_Other_City = $("input[id='Filter_Other_City']:last").val();
        if (Filter_Other_City!='' ) {
            $("#registerCity").prepend('<option id="'+Filter_Other_City+'" name="'+Filter_Other_City.toLowerCase()+'" value="'+Filter_Other_City+'" selected=selected>'+Filter_Other_City+'</option>')
        }

        var Filter_Other_Area = $("input[id='Filter_Other_Area']:last").val();
        if (Filter_Other_Area!='') {
            $("#registerArea").prepend('<option id="'+Filter_Other_Area+'" value="'+Filter_Other_Area+'" name="'+Filter_Other_Area.toLowerCase()+'" selected=selected>'+Filter_Other_Area+'</option>')
        }

        var Filter_Other_Gender = $("input[id='Filter_Other_Gender']:last").val();
        if (Filter_Other_Gender!='') {
            $("#registerGender").prepend('<option id="'+Filter_Other_Gender+'" value="'+Filter_Other_Gender+'" name="'+Filter_Other_Gender.toLowerCase()+'" selected=selected>'+Filter_Other_Gender+'</option>')
        }

        var Filter_Other_Type = $("input[id='Filter_Other_Type']:last").val();
        if (Filter_Other_Type!='') {
            $("#registerType").prepend('<option id="'+Filter_Other_Type+'" value="'+Filter_Other_Type+'" name="'+Filter_Other_Type.toLowerCase()+'" selected=selected>'+Filter_Other_Type+'</option>')
        }

    var myArray4 = [];
    var j = 0;


    // if (!$('#registerType option[value="' + id + '"]').is(':selected') && field == 'Type') {
    //     $("#registerType option:selected").each(function () {
    //         myArray4[j] = $(this).val().replace(/\&/g, "%26").replace(/\ /g, "+");
    //         j++;
    //     });

    //     myArray4[j] = value.replace(/\&/g, "%26").replace(/\ /g, "+");

    //     if(page!='close'){
    //         $(".show_mi_order").show();
    //         $(".app_selection_click").append('<div class="select_hold cl_type'+id.replace(/\ /g, "_")+'" onclick="SelectOption(' + "'Type'" + ',' + "'3'" + ',' + "'" + id + "'" + ',' + "'" + id + "'" + ',' + "'close'" + ')"> <span class="value_btn">'+id.replace(/\-/g, " ")+'</span><button class="closed_btn"><i class="glyphicon glyphicon-remove"></i></button></div>');
    //         show_clea_for = 1;
    //     } 

    // } else if ($('#registerType option[value="' + id + '"]').is(':selected') || (page == 'close' || page=='close-mobile') || $.inArray('type', vartop) > -1) { // removed || $.inArray('type', vartop) > -1

    //     $("#registerType option:selected").each(function () {

    //         //alert($( this ).text());
    //         var current_val = $(this).val().replace(/\&/g, "%26");
    //         if (current_val != value.replace(/\&/g, "%26"))
    //         {
    //             myArray4[j] = $(this).val().replace(/\&/g, "%26").replace(/\ /g, "+");
    //             j++;
    //         }else{
    //             check_add_delete = 1;
    //             setTimeout(function(){
    //             $(".ads_type"+id.replace(/\ /g, "_")).parent().removeClass('selected'); 
    //             $('#registerType option[value="' + id + '"]').removeAttr('selected');

    //         },10);
    //             $(".cl_type"+id.replace(/\ /g, "_")).remove();  
    //         }

    //     });

    //     //alert("else top"); 

    // }
 
    var myArray5 = [];

    var x = 0;

    // if (!$('#registerBrand option[name="'+id.toLowerCase()+'"]').is(':selected') && field == 'Brand') {

    //     //alert("true top");    

    //     $("#registerBrand option:selected").each(function () {

    //         myArray5[x] = $(this).val().replace(/\&/g, "%26").replace(/\ /g, "+");
    //         x++;

    //     });


    //     myArray5[x] = value.replace(/\&/g, "%26").replace(/\ /g, "+");
    //     if(page!='close'){
    //         $(".show_mi_order").show();
    //         $(".app_selection_click").append('<div class="select_hold cl_brand'+id.replace(/\ /g, "_").replace(/\./g, '_').replace(/\%/g, '_')+'" onclick="SelectOption(' + "'Brand'" + ',' + "'3'" + ',' + "'" + id + "'" + ',' + "'" + id + "'" + ',' + "'close'" + ')"> <span class="value_btn">'+id.replace(/\-/g, " ")+'</span><button class="closed_btn"><i class="glyphicon glyphicon-remove"></i></button></div>');
    //         show_clea_for = 1;
    //     } 

    // } else if ($('#registerBrand option[name="'+id.toLowerCase()+'"]').is(':selected') || (page == 'close' || page=='close-mobile') || $.inArray('brand', vartop) > -1) {

    //     $("#registerBrand option:selected").each(function () {

    //         //alert($( this ).text());

    //         var current_val = $( this ).attr('name').replace(/\&/g, "%26");
    //         if (current_val != value.toLowerCase().replace(/\&/g, "%26"))
    //         {
    //             myArray5[x] = $(this).val().replace(/\&/g, "%26").replace(/\ /g, "+");
    //             x++;
    //         }else{
    //             check_add_delete = 1;
    //             setTimeout(function(){
    //             $(".ads_brand"+id.replace(/\ /g, "_").replace(/\./g, '_').replace(/\%/g, '_')).parent().removeClass('selected'); 
    //             $('#registerBrand option[name="'+id.toLowerCase()+'"]').removeAttr('selected');

    //         },10);
    //             $(".cl_brand"+id.replace(/\ /g, "_").replace(/\./g, '_').replace(/\%/g, '_')).remove();  
    //         }

    //     });

    //     //alert("else top"+myArray5); 

    // }

 


    // adding multiple selection filters category, subcategory, gender, price, Discount

    var myArray15 = [];
    var za = 0;

    
 if (!$('#registerCategory option[name="' + id.toLowerCase() + '"]').is(':selected') && field == 'Category') {
     // console.log(field);
        $("#registerCategory option:selected").each(function () {
            myArray15[za] = $(this).attr('name');
            za++;
        });

        myArray15[za] = value;

        if(page!='close'){
            $(".show_mi_order").show();
            $(".app_selection_click").append('<div class="select_hold cl_category'+id.toLowerCase().replace(/\ /g, "_")+'" onclick="SelectOption(' + "'Category'" + ',' + "'3'" + ',' + "'" + id + "'" + ',' + "'" + id + "'" + ',' + "'close'" + ')"> <span class="value_btn">'+id.replace(/\-/g, " ")+'</span><button class="closed_btn"><i class="glyphicon glyphicon-remove"></i></button></div>');
            show_clea_for = 1;
        } 

    } else if ($('#registerCategory option[name="' + id.toLowerCase() + '"]').is(':selected') || (page == 'close' || page=='close-mobile') || $.inArray('category', vartop) > -1) {
 // console.log(id);
 // console.log("here")
        $("#registerCategory option:selected").each(function () {
                // console.log(current_val);

            var current_val = $(this).val();
            if (current_val != value.toLowerCase())
            {
                myArray15[za] = $(this).val();
                za++;
            }else{ 
                check_add_delete = 1;
                setTimeout(function(){
                $(".ads_category"+id.replace(/\ /g, "_")).parent().removeClass('selected'); 
                $('#registerCategory option[name="' + id.toLowerCase() + '"]').removeAttr('selected');

            },10);
                  $(".cl_category"+id.toLowerCase().replace(/\ /g, "_")).remove();  

                // console.log(current_val);
            }
        });

    }

    var myArray19 = [];
    var zg = 0;
    
 if (!$('#registerSubCategory option[name="' + id.toLowerCase() + '"]').is(':selected') && field == 'SubCategory') {
        $("#registerSubCategory option:selected").each(function () {
            myArray19[zg] = $(this).val();
            zg++;
        });

        myArray19[zg] = value;

        if(page!='close'){
            $(".show_mi_order").show();
            $(".app_selection_click").append('<div class="select_hold cl_subcategory'+id.toLowerCase().replace(/\ /g, "_")+'" onclick="SelectOption(' + "'SubCategory'" + ',' + "'3'" + ',' + "'" + id + "'" + ',' + "'" + id + "'" + ',' + "'close'" + ')"> <span class="value_btn">'+id.replace(/\-/g, " ")+'</span><button class="closed_btn"><i class="glyphicon glyphicon-remove"></i></button></div>');
            show_clea_for = 1;
        } 

    } else if ($('#registerSubCategory option[name="' + id.toLowerCase() + '"]').is(':selected') || (page == 'close' || page=='close-mobile') || $.inArray('subcategory', vartop) > -1) {

        $("#registerSubCategory option:selected").each(function () {
            var current_val =  $(this).attr('name');
            if (current_val != value.toLowerCase())
            {
                myArray19[zg] = $(this).val();
                zg++;
            }else{
                check_add_delete = 1;
                setTimeout(function(){
                $(".ads_subcategory"+id.replace(/\ /g, "_")).parent().removeClass('selected');
                $('#registerSubCategory option[name="' + id.toLowerCase() + '"]').removeAttr('selected');

            },10);
                $(".cl_subcategory"+id.toLowerCase().replace(/\ /g, "_")).remove();  
            }
        });

    }
// console.log(myArray15);
// var myArray15 = myArray15.join('##');
    var myArray18 = [];
    var zb = 0;
    
 if (!$('#registerArea option[name="' + id.toLowerCase() + '"]').is(':selected') && field == 'Area') {
        $("#registerArea option:selected").each(function () {
            myArray18[zb] =  $(this).attr('name');
            zb++;
        });

        myArray18[zb] = value;

        if(page!='close'){
            $(".show_mi_order").show();
            $(".app_selection_click").append('<div class="select_hold cl_area'+id.toLowerCase().replace(/\ /g, "_")+'" onclick="SelectOption(' + "'Area'" + ',' + "'3'" + ',' + "'" + id + "'" + ',' + "'" + id + "'" + ',' + "'close'" + ')"> <span class="value_btn">'+id.replace(/\-/g, " ")+'</span><button class="closed_btn"><i class="glyphicon glyphicon-remove"></i></button></div>');
            show_clea_for = 1;
        } 

    } else if ($('#registerArea option[name="' + id.toLowerCase() + '"]').is(':selected') || (page == 'close' || page=='close-mobile') || $.inArray('area', vartop) > -1) {

        $("#registerArea option:selected").each(function () {

            var current_val = $(this).attr('name');
            if (current_val != value.toLowerCase())
            {
                myArray18[zb] = $(this).val();
                zb++;
            }else{
                check_add_delete = 1;
                setTimeout(function(){
                $(".ads_area"+id.replace(/\ /g, "_")).parent().removeClass('selected');
                $('#registerArea option[name="' + id.toLowerCase() + '"]').removeAttr('selected');

            },10);
                $(".cl_area"+id.toLowerCase().replace(/\ /g, "_")).remove();  
            }
        });

    }

    // console.log(myArray18);

    var myArray16 = [];
    var zc = 0;
    
 if (!$('#registerCity option[name="' + id.toLowerCase() + '"]').is(':selected') && field == 'City') {
        $("#registerCity option:selected").each(function () {
            myArray16[zc] = $(this).val();
            zc++;
        });

        myArray16[zc] = value;

        if(page!='close'){
            $(".show_mi_order").show();
            $(".app_selection_click").append('<div class="select_hold cl_subcategory'+id.toLowerCase().replace(/\ /g, "_")+'" onclick="SelectOption(' + "'City'" + ',' + "'3'" + ',' + "'" + id + "'" + ',' + "'" + id + "'" + ',' + "'close'" + ')"> <span class="value_btn">'+id.replace(/\-/g, " ")+'</span><button class="closed_btn"><i class="glyphicon glyphicon-remove"></i></button></div>');
            show_clea_for = 1;
        } 

    } else if ($('#registerCity option[name="' + id.toLowerCase() + '"]').is(':selected') || (page == 'close' || page=='close-mobile') || $.inArray('city', vartop) > -1) {

        $("#registerCity option:selected").each(function () {

            var current_val =  $(this).attr('name');
            if (current_val != value.toLowerCase())
            {
                myArray16[zc] = $(this).val();
                zc++;
            }else{
                check_add_delete = 1;
                setTimeout(function(){
                $(".ads_city"+id.replace(/\ /g, "_")).parent().removeClass('selected');
                $('#registerCity option[name="' + id.toLowerCase() + '"]').removeAttr('selected');

            },10);
                $(".cl_city"+id.toLowerCase().replace(/\ /g, "_")).remove();  
            }
        });

    }


        var myArray161 = [];
    var zcc = 0;
    
 if (!$('#registerFor option[name="' + id.toLowerCase() + '"]').is(':selected') && field == 'For') {
        $("#registerFor option:selected").each(function () {
            myArray161[zcc] = $(this).val();
            zcc++;
        });

        myArray161[zcc] = value;

        if(page!='close'){
            $(".show_mi_order").show();
            $(".app_selection_click").append('<div class="select_hold cl_subcategory'+id.toLowerCase().replace(/\ /g, "_")+'" onclick="SelectOption(' + "'For'" + ',' + "'3'" + ',' + "'" + id + "'" + ',' + "'" + id + "'" + ',' + "'close'" + ')"> <span class="value_btn">'+id.replace(/\-/g, " ")+'</span><button class="closed_btn"><i class="glyphicon glyphicon-remove"></i></button></div>');
            show_clea_for = 1;
        } 

    } else if ($('#registerFor option[name="' + id.toLowerCase() + '"]').is(':selected') || (page == 'close' || page=='close-mobile') || $.inArray('for', vartop) > -1) {

        $("#registerFor option:selected").each(function () {

            var current_val =  $(this).attr('name');
            if (current_val != value.toLowerCase())
            {
                myArray161[zcc] = $(this).val();
                zcc++;
            }else{
                check_add_delete = 1;
                setTimeout(function(){
                $(".ads_for"+id.replace(/\ /g, "_")).parent().removeClass('selected');
                $('#registerFor option[name="' + id.toLowerCase() + '"]').removeAttr('selected');

            },10);
                $(".cl_for"+id.toLowerCase().replace(/\ /g, "_")).remove();  
            }
        });

    }


 //    var myArray17 = [];
 //    var zh = 0;
    
 // if (!$('#registerGender option[value="' + id + '"]').is(':selected') && field == 'Gender') {
 //        $("#registerGender option:selected").each(function () {
 //            myArray17[zh] = $(this).val();
 //            zh++;
 //        });

 //        myArray17[zh] = value;

 //        if(page!='close'){
 //            $(".show_mi_order").show();
 //            $(".app_selection_click").append('<div class="select_hold cl_gender'+id.replace(/\ /g, "_")+'" onclick="SelectOption(' + "'Gender'" + ',' + "'3'" + ',' + "'" + id + "'" + ',' + "'" + id + "'" + ',' + "'close'" + ')"> <span class="value_btn">'+id.replace(/\-/g, " ")+'</span><button class="closed_btn"><i class="glyphicon glyphicon-remove"></i></button></div>');
 //            show_clea_for = 1;
 //        } 

 //    } else if ($('#registerGender option[value="' + id + '"]').is(':selected') || (page == 'close' || page=='close-mobile') || $.inArray('gender', vartop) > -1) {

 //        $("#registerGender option:selected").each(function () {

 //            var current_val = $(this).val();
 //            if (current_val != value)
 //            {
 //                myArray17[zh] = $(this).val();
 //                zh++;
 //            }else{
 //                check_add_delete = 1;
 //                setTimeout(function(){
 //                $(".ads_gender"+id.replace(/\ /g, "_")).parent().removeClass('selected');
 //                $('#registerGender option[value="' + id + '"]').removeAttr('selected');

 //            },10);
 //                $(".cl_gender"+id.replace(/\ /g, "_")).remove();  
 //            }
 //        });

 //    }



        if (show_clea_for == 1 && $("#Home").val()=='main') {
        $(".clear_main_append").html('<div class="select_hold onclick="SelectOption(' + "'clear'" + ',' + "'0'" + ',' + "'clear'" + ',' + "'clear'" + ',' + "'clear'" + ')"> <span class="value_btn">Clear All</span><button class="closed_btn"><i class="glyphicon glyphicon-remove"></i></button></div>');
            
    };

        // console.log(vartop);

    if (field != 'Clear') {

        vartop = ["for","category", "subcategory","city","area"];

        $.each(vartop, function (inx, qstr) {

            if (qstr) {
       
                // console.log(qstr);



               if (qstr == 'category' && myArray15 != '' && myArray15)
                {   
                    myArray15 = myArray15.sort();
                    var myArray15_s = myArray15.join('|').replace(/\-/g, "—").replace(/\&/g, "%26").replace(/\ /g, "-");                
                    path = path.concat("/category-" + myArray15_s.toLowerCase());
                }  

                 else if (qstr == 'subcategory' && myArray19 != '' && myArray19)
                {
                    myArray19 = myArray19.sort();
                    var myArray19_s = myArray19.join('|').replace(/\-/g, "—").replace(/\&/g, "%26").replace(/\ /g, "-");
                    path = path.concat("/subcategory-" + myArray19_s.toLowerCase());

                }    

                else if (qstr == 'city' && myArray16 != '' && myArray16)
                {
                    myArray16 = myArray16.sort();
                    var myArray16_s = myArray16.join('|').replace(/\-/g, "—").replace(/\&/g, "%26").replace(/\ /g, "-");
                    path = path.concat("/city-" + myArray16_s.toLowerCase());

                }                

                else if (qstr == 'area' && myArray18 != '' && myArray18)
                {
                    myArray18 = myArray18.sort();
                    var myArray18_s = myArray18.join('|').replace(/\-/g, "—").replace(/\&/g, "%26").replace(/\ /g, "-");
                    path = path.concat("/area-" + myArray18_s.toLowerCase());
                }   
                 else if (qstr == 'for' && myArray161 != '' && myArray161)
                {
                    myArray161 = myArray161.sort();
                    var myArray161_s = myArray161.join('|').replace(/\-/g, "—").replace(/\&/g, "%26").replace(/\ /g, "-");
                    path = path.concat("/for-" + myArray161_s.toLowerCase());
                }  

                // else if (qstr == 'brand' && myArray19 != '' && myArray19)
                // {
                //       var myArray19_s = myArray19.join('~');
             
                //        myArray19_s = myArray19_s.replace("++", "%2B+");
                //        myArray19_s = myArray19_s.replace("50000+", "50000%2B");
             
                //     path = path.concat("&brand=" + myArray19_s);
                // }   

          

            }

            if (qstr === field.toLowerCase() && page != 'close')
            {
                //alert("Enter");
                // return false;
            }

        });

        if (page == 'close' || page=='close-mobile')
        {

            // path = path.concat("&filter=" + page);

        }
    } else

    {

        // var path = path.concat("?p=main");

    }


    // if (For=='Business') {
                  
    //     path = path.concat("/for-business");
    // };

    path_full = '';

    if (field == 'ViewList') {

        if (page == 'close' || page=='close-mobile')
            view_value = '';
        else
            view_value = value;

        

        if(Home_Value!=''){

            Home_Value = 'main';
        }
        else{

            Home_Value = '';
        }

        path_full = view_value_path;

    } else {

        Home_Value ='';

        view_value = $("input[id=view_value]:last").val();
    }


        var path_new = '';

       if(Search && Search!='All'){

        var brand_search = $("input[id='brand_search']:last").val();

        if (brand_search!="yes" || field=='Offer') {

             path = path.concat("?q="+Search.replace(/\ /g, "+"));

             ajax_lod_in = 'yes';
              path_new = '&field_name='+field;
        }else{
             path_new = '?field_name='+field;
        }


    }else{

        ajax_lod_in = 'no';
     path_new = '?field_name='+field;
    }


    var filter_or_li = $("#field_names_order").val();

    path_new += "&filter_order="+filter_or_li;



 if(Home_Value!='' && field=='ViewList'){
      
	 	this.$backdrop = $('<div class="modal-backdrop fade in " />')  .appendTo(document.body)

         $(".loading_image_selection").show();

      
	// window.location.href ="https://www.xerve.in/leads?need="+For+"&p=main&viewlist="+view_value;

	 }else{
            //view_value='list';
			path_new = path_new.concat("&viewlist="+view_value);
            
			

	}




    // var number_po = $("#Store_"+field).attr('name');

    // if(field=='Store' || page=='close'){
    //     number_po = 0;
    // }
    var number_po = 0;
    var show_loading_fi = 0;

    if (number_po>1) {

        var main_low = parseInt(number_po)-1;
        
        for (i = parseInt(main_low); i >=1; i--) {        
         
            // $(".for_fltr_loading_top").show();
            $(".hideload"+i).css("display", "none");

        }
    }

    for (i = parseInt(number_po)+1; i <=12; i++) {
    
      $(".hideload"+i).css("display", "none");

     show_loading_fi =1

    } 


    if (show_loading_fi==1) {

       $(".for_fltr_loading_i").show();
    }

     if ($(window).width() < 1200 && page != 'close' && page != 'clear' && field!='ViewList') {

        $(".empty-ght-skty").show();
        $('.filter_foot_sk_foo').show();
     }
// $(window).scrollTop()+
        var scroll_hei_sh = 150;

        if (page!='clear' && $('div.load_class_ap_img').length==0) {

              $(".show_mi_order").detach().prependTo(".right-section");
              $(".sd_pt_vw_sect").detach().prependTo(".right-section");
              
             $('.right-section > .enquiries-table-responsive').css('display','none');
             $('.right-section').append('<div class="load_class_ap_img" style="margin-top:'+scroll_hei_sh+'px;" align="center"><img src="/img/loading_company.gif" alt="loading"  title="loading"/></div>');
        }

        
        setTimeout(function(){
        if($.inArray('category', vartop) > -1){ 
        $('button[data-id="registerCategory"] .pull-left ').text('Category');
        }   
        if($.inArray('subcategory', vartop) > -1){  
        $('button[data-id="registerSubCategory"] .pull-left').text('Sub-Category');
        }
        if($.inArray('type', vartop) > -1){    
        $('button[data-id="registerType"] .pull-left').text('Type');
        }      
        if($.inArray('brand', vartop) > -1){        
        $('button[data-id="registerBrand"] .pull-left').text('Brand');
        }      
        if($.inArray('gender', vartop) > -1){  
        $('button[data-id="registerGender"] .pull-left').text('Gender');
        }  
        if($.inArray('size', vartop) > -1){  
        $('button[data-id="registerCity"] .pull-left').text('City');
        }
        if($.inArray('for', vartop) > -1){  
        $('button[data-id="registerFor"] .pull-left').text('Customer Type');
        }
        if($.inArray('color', vartop) > -1){  
        $('button[data-id="registerArea"] .pull-left').text('Area');
        }
        
   
       
        },0);

        // return false;
    //    NProgress1.done();
    // NProgress1.start();

    

    // if (order=='submit-price')
    //     return false;

    req_query = $.ajax({
        type: 'GET',
        url: path +path_new+ "&sidebar=yes&lazyload=yes",
        data: {
        },
        beforeSend: function () {

            // $("#loading").show(); //show loading...

           // if (page!='clear') {
           //   $('.right-section').html('<div style="margin-top:'+scroll_hei_sh+'px;" align="center"><img src="/img/loading_company.gif" alt="loading"  title="loading"/></div>');
           //  }
            
        },
        success: function (data) {

            //alert(data);
            // NProgress1.done();


            $('.loading_image_selection').hide();

            $(".modal-backdrop").remove();


           
               if ($('div#Sidebar > .going').length==0){
                    var show_filter_mo = 0;
               }else{
                    var show_filter_mo = 1;
               }
          
         
            $('#Home_Content').html("");

            $('#Home_Content').html(data);

             var for_main_value = $("input[id='For']:last").val();

            $("#For_Controller").val(for_main_value);

            // if()

                
            $(".for_fltr_loading_i").hide();
            
            history.pushState({page: path}, '', path);

            // if(!sorted_value)  
            // {
            //     //alert(sorted_value+"inside");
            //     // LatestPrice(0);
            // }else
            // {
            //    //alert(sorted_value+"outside");
            //    // LatestPrice(1); 
            // }

            // BestBuyCall();
            
           

            // LikeCall();

            if ($(window).width() < 1199) {

                $(".page_container_desktop").remove();
            }


            $(".scroll-tab").show();



            new_val = value;

            Sidebar(field, order, id, value, page, select_box1, select_box2, select_box3, select_box4);

             if ($(window).width() < 1200) {

                $(".empty-ght-skty").show();

             
            
             }

             // console.log(page);
             // console.log(field);

            if ((page != 'close' && page!='close-mobile' && page!='main-sub') && field != 'ViewList' && field != 'Store') {

             //     console.log(page);
             // console.log(field);

                if (show_filter_mo==1) {

                $('.custom-aside').addClass('going').removeClass('coming');

                $('.pull-me').css('display', 'block');
                };

                // alert('#register'+field+' option[value="' + id + '"]');

                // alert(check_add_delete);

                // if($('#register'+field+' option[value="' + id + '"]').is(':selected')){

                //     alert("here");
                // }
                
                if(($('#register'+field+' option[value="' + id + '"]').is(':selected') || order=='submit-price' || page=='main' || page=='main-sub' || field=='Store') && field != 'Sortby' && check_add_delete!=1) {

            
                    // alert("here");

                    $(".filter-selected-value").text(value);

                    $(".alert-field-name").text(field);

                    $(".alert-success").show();

                    $(".alert-danger").hide();
                }else if (field != 'Sortby'){

                    $(".filter-selected-value-danger").text(value);

                $(".alertdanger-field-name").text(field);

                $(".alert-danger").show();

                $(".alert-success").hide();
                }              

               
            }

            if(page=='close-mobile'){

                $('.custom-aside').addClass('going').removeClass('coming');

                 $('.pull-me').css('display', 'block');

                $(".filter-selected-value-danger").text(value);

                $(".alertdanger-field-name").text(field);

                $(".alert-danger").show();

                $(".alert-success").hide();

                // $(".alert-success").html('<a class="close" href="#" data-dismiss="alert" aria-label="close">×</a><strong><span class="alert-field-name">'+field+'</span>: <span class="filter-selected-value">'+value+'</span></strong> has been successfully removed.');

                //  $(".alert-success").show();
            }

            if(page=='close'){

                     $(".filter-selected-value-danger").text(value);

                $(".alertdanger-field-name").text(field);

                $(".alert-danger").show();

                $(".alert-success").hide();

                 // $(".alert-success").html('<a class="close" href="#" data-dismiss="alert" aria-label="close">×</a><strong><span class="alert-field-name">'+field+'</span>: <span class="filter-selected-value">'+value+'</span></strong> has been successfully removed.');

                 // $(".alert-success").show();
            }

            if ($(window).width() < 1200) {

               var scroll_mbil = $('.store-sidebar-breadcrum').outerHeight(true);
              
                $('.scroll-tab').scrollTop(parseInt(scroll_mbil));
            }

            $(".store_product_menu .dropdown-menu").bind('scroll', function () {




                if (typeof timeout == "number") {
                    window.clearTimeout(timeout);
                    delete timeout;
                }
                timeout = window.setTimeout(check_new, 100);
            });


        



        },
    });

}

function Sidebar(field, order, id, value, page, select_box1, select_box2, select_box3, select_box4, select_box5, select_box6, select_box7, select_box8, select_box9, select_box10, select_box11, select_box12)

{

    // alert("SEL");                

    var Where = $("div[id=Where]:last").text();

    var IsSub = $("input[id=IsSub]:last").val();

    var Control = $("#ControllerName").val();

    var Search = $("#Search").val();

    var For = $("input[id=For]:last").val();

    var Suggest = $("input[id=Suggest]:last").val();

    var Condition = $("div[id=Condition]:last").text();

    var Home = $("input[id=Home]:last").val();

    var Category = $("input[id=Category]:last").val();

    var Full_Path = $("#url_now").val();

    //var pieces = Full_Path.split('/');        

    var Before_Path = $("#url_now").val();


    var vararg = [], hashed;

    var hasharg = Before_Path.slice(Before_Path.indexOf('?') + 1).split('&');

    for (var p = 0; p < hasharg.length; p++)
    {
        hashed = hasharg[p].split('=');
        vararg.push(hashed[0]);
        vararg[hashed[0]] = hashed[1];
    }

    //alert(vararg.need);
    //alert(vararg.brand);
    brand_q = vararg.brand;
    if (brand_q)
        brand_q = vararg.brand.replace(/\&/g, "%26");

    if (Where)
        Where = Where.replace(/\&/g, "%26");



    if (select_box1 !== null && select_box1 !== undefined) {

        //alert("Enter");

     
                    var Full_Path = $("#url_now_new").val();    
                                
                            if(Full_Path=='' || Full_Path==undefined){

                        Full_Path=='';
                    }     
                                
                        var vars = [], hash;

                        var hashes = Full_Path.slice(Full_Path.indexOf('?') + 1).split('/');

                        // console.log(hashes);

                        for (var i = 0; i < hashes.length; i++)
                        {
                            hash = hashes[i].split('-');
                            vars.push(hash[0]);
                            vars[hash[0]] = hashes[i].replace(hash[0]+"-", "");
                        }


        //alert(hashes);

        //alert(vars);       


        var needName = vars.need;
        var categoryName = vars.category;
        var genderName = vars.gender;
        var subName = vars.subcategory;
        var typeName = vars.type;
        var brandName = vars.brand;
        var modelName = vars.model;
        var colorName = vars.color;
        var sizeName = vars.size;
        var discountName = vars.discount;
        var priceName = vars.price;
        var deliveryName = vars.delivery;
        var sellerName = vars.seller;
        var sortbyName = vars.sortby;
            var cityName = vars.city;   
            var forName = vars.for;   

            var areaName = vars.area;   

        // alert(modelName);



     

        if (sortbyName !== undefined)
        {
            $("select[id*=store_sort]").html(select_box11);
            //$(".seller_section .btn-default").css({"border":"red 1px solid"});    
        }


        $("#order").val(order);


       

        $("#Sidebar_New").html('');

        jQuery("#Sidebar").detach().appendTo('#Sidebar_New');

        $("#Sidebar").show();


      


        // adding multiple selection filters category, subcategory, gender, price, discount


        // if (field == 'Category')
        // {
        //     if (categoryName !== undefined && $("#Home").val()!='main')
        //     {
        //         if (!$('#registerCategory option[value="' + id + '"]').is(':selected'))
        //         {
        //             var newpi = categoryName.split('~');

        //             for (var i = 0; i < newpi.length; i = i + 1) {

        //                 $('select[id="register' + field + '"]').find("option[value='" + newpi[i].replace(/\%26/g, "&").replace(/\+/g, " ") + "']").attr("selected", "selected");

        //                 $('select[id="register' + field + '"]').find('option[value="' + newpi[i].replace(/\%26/g, "&").replace(/\+/g, " ") + '"]').prependTo($('select[id="register' + field + '"]'));
        //                 // $('select[id="register' + field + '"]').val('' + newpi[i].replace(/\%26/g, "&").replace(/\+/g, " ") + '');
        //             }
        //         } else

        //         {
        //             $('option[id="Category-' + id + '"]').removeAttr('selected');
        //         }
        //     }

        // }


        // // if (field == 'SubCategory')
        // // {
        // //     if (subName !== undefined)
        // //     {
        // //         if (!$('#registerSubCategory option[value="' + id + '"]').is(':selected'))
        // //         {
        // //             var newpi = subName.split('~');

        // //             for (var i = 0; i < newpi.length; i = i + 1) {

        // //                 $('select[id="register' + field + '"]').find("option[value='" + newpi[i].replace(/\%26/g, "&").replace(/\+/g, " ") + "']").attr("selected", "selected");

        // //                 $('select[id="register' + field + '"]').find('option[value="' + newpi[i].replace(/\%26/g, "&").replace(/\+/g, " ") + '"]').prependTo($('select[id="register' + field + '"]'));
        // //                 // $('select[id="register' + field + '"]').val('' + newpi[i].replace(/\%26/g, "&").replace(/\+/g, " ") + '');
        // //             }
        // //         } else

        // //         {
        // //             $('option[id="SubCategory-' + id + '"]').removeAttr('selected');
        // //         }
        // //     }

        // // }


        // if (field == 'Gender')
        // {
        //     if (genderName !== undefined)
        //     {
        //         if (!$('#registerGender option[value="' + id + '"]').is(':selected'))
        //         {
        //             var newpi = genderName.split('~');

        //             for (var i = 0; i < newpi.length; i = i + 1) {

        //                 $('select[id="register' + field + '"]').find("option[value='" + newpi[i].replace(/\%26/g, "&").replace(/\+/g, " ") + "']").attr("selected", "selected");

        //                 $('select[id="register' + field + '"]').find('option[value="' + newpi[i].replace(/\%26/g, "&").replace(/\+/g, " ") + '"]').prependTo($('select[id="register' + field + '"]'));
        //                 // $('select[id="register' + field + '"]').val('' + newpi[i].replace(/\%26/g, "&").replace(/\+/g, " ") + '');
        //             }
        //         } else

        //         {
        //             $('option[id="Gender-' + id + '"]').removeAttr('selected');
        //         }
        //     }

        // }

        //     if(field=='City')
        //     {
        //     if(cityName!==undefined)
        //     {               
        //     if(!$('#registerCity option[name="'+id.toLowerCase()+'"]').is(':selected'))
        //     {   
        //     var newpi = cityName.split(',');    
        //     for ( var i = 0; i < newpi.length; i = i + 1 ) {
        //     $('select[id="register'+field+'"]').find("option[name='"+newpi[i].toLowerCase().replace(/\%26/g, "&").replace(/\+/g, " ")+"']").attr("selected", "selected");
            
        //     $('select[id="register'+field+'"]').find('option[name="'+newpi[i].toLowerCase().replace(/\%26/g, "&").replace(/\+/g, " ")+'"]').prependTo($('select[id="register'+field+'"]'));
        // //  $('select[id="register'+field+'"]').val(''+newpi[i].replace(/\%26/g, "&")+'');

        //     }
        //     }
        //     else
        //     {               
        //         $('option[id="City-'+id+'"]').removeAttr('selected');
        //     }
        //     }           

        //     } 

        // if(field=='Area')
        //     {
        //     if(areaName!==undefined)
        //     {
        //         if(!$('#registerArea option[name="'+id.toLowerCase()+'"]').is(':selected'))
        //     {
        //     var newpi = areaName.split('~');
        //     for ( var i = 0; i < newpi.length; i = i + 1 ) {
        //     $('select[id="register'+field+'"]').find("option[name='"+newpi[i].toLowerCase().replace(/\%26/g, "&").replace(/\+/g, " ")+"']").attr("selected", "selected");
            
        //     $('select[id="register'+field+'"]').find('option[name="'+newpi[i].toLowerCase().replace(/\%26/g, "&").replace(/\+/g, " ")+'"]').prependTo($('select[id="register'+field+'"]'));
        //     }           
        //     }
        //     else
        //     {
        //     $('option[id="Area-'+id+'"]').removeAttr('selected');   
        //     }           
        //     }
        //     } 


       

        // if (field == 'Brand')

        // {

        //     if (brandName !== undefined)

        //     {

        //         //$('#Store_Brand').attr('onclick','').unbind('click');

        //         if (!$('#registerBrand option[name="'+id.toLowerCase()+'"]').is(':selected'))

        //         {

        //             //alert("selected");

        //             var newpi = brandName.split('~');

        //             for (var i = 0; i < newpi.length; i = i + 1) {

        //                 // alert(newpi[i]);

        //                 $('select[id="register' + field + '"]').find("option[name='" + newpi[i].toLowerCase().replace(/\%26/g, "&").replace(/\+/g, " ") + "']").attr("selected", "selected");

        //                 $('select[id="register' + field + '"]').find('option[name="' + newpi[i].toLowerCase().replace(/\%26/g, "&").replace(/\+/g, " ") + '"]').prependTo($('select[id="register' + field + '"]'));
        //                 // $('select[id="register' + field + '"]').val('' + newpi[i].replace(/\%26/g, "&").replace(/\+/g, " ") + '');

        //             }

        //         } else

        //         {

        //             //alert("deselect"+id);

        //             $('option[id="Brand-' + id + '"]').removeAttr('selected');

        //         }

        //         //$('input[id^="SubCategory"+'-'+'+id'+"]').val(value).attr("checked", "checked");

        //     }

        // }





        // if (field == 'Seller')

        // {

        //     if (sellerName !== undefined)

        //     {

        //         //alert(id);

        //         if (!$('#registerSeller option[value="' + id + '"]').is(':selected'))

        //         {

        //             //alert("selected");

        //             var newpi = sellerName.split('~');

        //             for (var i = 0; i < newpi.length; i = i + 1) {

        //                 //alert(newpi[i]);

        //                 $("option[value='" + newpi[i].replace(/\%26/g, "&").replace(/\+/g, " ") + "']").attr("selected", "selected");

        //                 $('select[id="register' + field + '"]').find('option[value="' + newpi[i].replace(/\%26/g, "&").replace(/\+/g, " ") + '"]').prependTo($('select[id="register' + field + '"]'));
        //                 // $('select[id="register' + field + '"]').val('' + newpi[i].replace(/\%26/g, "&").replace(/\+/g, " ") + '');

        //             }

        //         } else

        //         {

        //             //alert("deselect"+id);

        //             $('option[id="Seller-' + id + '"]').removeAttr('selected');

        //         }

        //     }


        // }


        // if (field == 'Sortby')

        // {

        //     if (sortbyName !== undefined)

        //     {

        //         if (!$('#store_sort option[value="' + id + '"]').is(':selected'))

        //         {

        //             //alert("selected");

        //             var newpi = sortbyName.split(',');

        //             for (var i = 0; i < newpi.length; i = i + 1) {

        //                 //alert(newpi[i]);

        //                 $("option[value='" + newpi[i] + "']").attr("selected", "selected");

        //                 $('select[id="register' + field + '"]').find('option[value="' + newpi[i] + '"]').prependTo($('select[id="register' + field + '"]'));
        //                 $('select[id="register' + field + '"]').val('' + newpi[i] + '');

        //             }

        //         } else

        //         {

        //             //alert("deselect"+id);

        //             $('option[id="Sortby-' + id + '"]').removeAttr('selected');

        //         }

        //     }


        // }

                        // if (brandName !== undefined && brandName!='' && brandName!='Brand'){                           
                        //     var newpi = brandName.split('|');

                        //     for (var i = 0; i < newpi.length; i = i + 1) {

                        //         // alert(newpi[i]);

                        //         $('select[id="registerBrand"]').find("option[name='" + newpi[i].replace(/\%26/g, "&").trim() + "']").attr("selected", "selected");

                        //         $('select[id="registerBrand"]').find('option[value="' + newpi[i].replace(/\%26/g, "&").trim() + '"]').prependTo($('select[id="registerBrand"]'));
                        //         // $('select[id="register' + field + '"]').val('' + newpi[i].replace(/\%26/g, "&") + '');

                        //     }                           

                        // }

                        // var select_box19 = $("select[id*='registerCategory']").html();

                         // alert(select_box19);

                        if (categoryName !== undefined && categoryName!='' && categoryName!='Category' && $("#Home").val()!='main'){                           
                            var newpi = categoryName.split('|');

                            for (var i = 0; i < newpi.length; i = i + 1) {
                                // console.log(newpi[i].replace(/\%26/g, "&"));

                                // console.log($('select[id="registerCategory"]').html());
                                // console.log($('select[id="registerCategory"]').find("option[value='" + newpi[i].replace(/\%26/g, "&").trim() + "']").val());

                                $('select[id="registerCategory"]').find("option[name='" + newpi[i].toLowerCase().replace(/\%26/g, "&").trim() + "']").attr("selected", "selected");

                                $('select[id="registerCategory"]').find('option[name="' + newpi[i].toLowerCase().replace(/\%26/g, "&").trim() + '"]').prependTo($('select[id="registerCategory"]'));
                                // $('select[id="register' + field + '"]').val('' + newpi[i].replace(/\%26/g, "&") + '');

                            }                           

                        }

                        if (subName !== undefined && subName!='' && subName!='SubCategory'){                           
                            var newpi = subName.split('|');

                            for (var i = 0; i < newpi.length; i = i + 1) {
                              
                                $('select[id="registerSubCategory"]').find("option[name='" + newpi[i].toLowerCase().replace(/\%26/g, "&").trim() + "']").attr("selected", "selected");

                                $('select[id="registerSubCategory"]').find('option[name="' + newpi[i].toLowerCase().replace(/\%26/g, "&").trim() + '"]').prependTo($('select[id="registerSubCategory"]'));

                            }                           

                        }

                        // if (genderName !== undefined && genderName!='' && genderName!='Gender'){                           
                        //     var newpi = genderName.split('|');

                        //     for (var i = 0; i < newpi.length; i = i + 1) {
                              
                        //         $('select[id="registerGender"]').find("option[value='" + newpi[i].replace(/\%26/g, "&").trim() + "']").attr("selected", "selected");

                        //         $('select[id="registerGender"]').find('option[value="' + newpi[i].replace(/\%26/g, "&").trim() + '"]').prependTo($('select[id="registerGender"]'));

                        //     }                           

                        // }

                         if (cityName !== undefined && cityName!='' && cityName!='City'){

                            var newpi = cityName.split('|');

                            for (var i = 0; i < newpi.length; i = i + 1) {

                             // console.log(newpi[i].toLowerCase().replace(/\%26/g, "&").trim());
                             // console.log($('select[id="registerCity"]').html());

                                $('select[id="registerCity"]').find("option[name='" + newpi[i].toLowerCase().replace(/\%26/g, "&").trim() + "']").attr("selected", "selected");

                                $('select[id="registerCity"]').find('option[name="' + newpi[i].toLowerCase().replace(/\%26/g, "&").trim() + '"]').prependTo($('select[id="registerCity"]'));
                        
                            }                        

                        }

                        if (forName !== undefined && forName!='' && forName!='For'){

                            var newpi = forName.split('|');

                            for (var i = 0; i < newpi.length; i = i + 1) {

                          
                                $('select[id="registerFor"]').find("option[name='" + newpi[i].toLowerCase().replace(/\%26/g, "&").trim() + "']").attr("selected", "selected");

                                $('select[id="registerFor"]').find('option[name="' + newpi[i].toLowerCase().replace(/\%26/g, "&").trim() + '"]').prependTo($('select[id="registerFor"]'));
                        
                            }                        

                        }

                      
                        // console.log(areaName)
                        if (areaName !== undefined && areaName!='' && areaName!='Area'){

                            var newpi = areaName.split('|');

                            for (var i = 0; i < newpi.length; i = i + 1) {
                               

                                $('select[id="registerArea"]').find("option[name='" + newpi[i].toLowerCase().replace(/\%26/g, "&").trim() + "']").attr("selected", "selected");

                                $('select[id="registerArea"]').find('option[name="' + newpi[i].toLowerCase().replace(/\%26/g, "&").trim() + '"]').prependTo($('select[id="registerArea"]'));
                        
                            }                        

                        }

                     

        /* end */

    }

    //  var select_box5_here = $("select[id*='registerBrand']").html();
    //   var select_box1 = $("select[id*='registerCategory']").html();
    //  console.log(select_box5_here);
    // console.log(select_box1);


    //alert("subName"+subName);

    $('.selectpicker').selectpicker({});

    if (cityName !== undefined)
        $('button[data-id="registerCity"] .pull-left').text('City');
    if (forName !== undefined)
        $('button[data-id="registerFor"] .pull-left').text('Customer Type');
    if (areaName !== undefined)
        $('button[data-id="registerArea"] .pull-left').text('Area');
    if (categoryName !== undefined)
        $('button[data-id="registerCategory"] .pull-left ').text('Category');
    if (genderName !== undefined)
        $('button[data-id="registerGender"] .pull-left').text('Gender');
    if (subName !== undefined)
        $('button[data-id="registerSubCategory"] .pull-left').text('Sub-Category');
    if (typeName !== undefined)
        $('button[data-id="registerType"] .pull-left').text('Type');
    if (brandName !== undefined)
        $('button[data-id="registerBrand"] .pull-left').text('Brand');
  
    if (sortbyName !== undefined)
        $('button[data-id="store_sort"] .pull-left').text('Sort by');

 

    $("#filter_load").hide();

    $("#filter").removeClass('act-icon');

    filter_search();

      LeftSidebar();

      filter_search_position();

    // test_file();

    // $("#scroll_top_filter_height").val("");

     $("#single_page_height_main").val($('.right-section .list').outerHeight(true));


     if ($(window).width() >= 1200) {

           var scroll_top_height12 = $("#Sidebar_New").outerHeight(true);

         $("#scroll_top_filter_height").val(scroll_top_height12);
        $('#Sidebar').css('cssText', 'position:fixed;top:138px;');

        $("#scroll_top_height").val("");

         $('#Home_Content').css('cssText', 'min-height:2000px;');




    }


    // if ($("#Home").val() == 'main')
       // Run_Brand_carousel();

  

    // if (brandName == undefined)
    // if(field!='Brand')
        // Store_Brand();

    // if (modelName == undefined)
    // if(field!='Model')
        // Store_Model();

    // if (colorName == undefined)
    // if(field!='Color')
        // Store_Color();

    // alert("here");

    $("#Sidebar div[class^='dropdown-menu']").css({"position": "static", "display": "block"});

    // $("#Sidebar .gender_section div[class^='dropdown-menu']").css({"position": "none", "display": "none"});

    // $("#scroll-top").click();
      
      

    if (field != 'Store' && field != 'Sortby' && field != 'ViewList')
    {
     
        // $('.scroll-tab').animate({scrollTop: $("#Store_" + field).position().top - 100}, 2000);
        //
        // alert(field);

      //     setTimeout(function(){

      //   $('.scroll-tab').scrollTop(0);

      // },21000);

        // $("#Store_" + field).focus();
    }
    //alert($("div[id=title_for_layout]:last").text());
    document.title = $("div[id=title_for_layout]:last").text();
    document.description = $("div[id=description_for_layout]:last").text();


}

function filter_search(){
        

    $(".brand_section > .hide_srh_fltr_brand").remove();
    var data_brand = $("#Store_Brand").find(".show_order_main_full").html();
   $("#Store_Brand").find("button[data-id*='registerBrand']").after(data_brand);


    $(".category_section > .hide_srh_fltr_brand").remove();
    var data_category = $("#Store_Category").find(".show_order_main_full").html();
   $("#Store_Category").find("button[data-id*='registerCategory']").after(data_category);

    $(".subcategory_section > .hide_srh_fltr_brand").remove();
    var data_category = $("#Store_SubCategory").find(".show_order_main_full").html();
   $("#Store_SubCategory").find("button[data-id*='registerSubCategory']").after(data_category);

    $(".type_section > .hide_srh_fltr_brand").remove();
    var data_category = $("#Store_Type").find(".show_order_main_full").html();
   $("#Store_Type").find("button[data-id*='registerType']").after(data_category);

    $(".gender_section > .hide_srh_fltr_brand").remove();
    var data_category = $("#Store_Gender").find(".show_order_main_full").html();
   $("#Store_Gender").find("button[data-id*='registerGender']").after(data_category);

       $(".city_section > .hide_srh_fltr_brand").remove();
    var data_category = $("#Store_City").find(".show_order_main_full").html();
   $("#Store_City").find("button[data-id*='registerCity']").after(data_category);

    $(".area_section > .hide_srh_fltr_brand").remove();
    var data_category = $("#Store_Area").find(".show_order_main_full").html();
   $("#Store_Area").find("button[data-id*='registerArea']").after(data_category);

           
                $("#Store_Category .input-block-level").keyup(function () {
               text_category =  $("#Store_Category .input-block-level").val();
               
                if (text_category!='') {
                    $("#Store_Category").find(".input-remove-text").show();
                }else{
                    $("#Store_Category").find(".input-remove-text").hide();
                }
          });


          $("#Store_Category .input-remove-text").click(function(){

            $("#Store_Category").find('.hide_srh_fltr_brand').addClass('show_order_main').removeClass('hide_srh_fltr_main');

        setTimeout(function () {

            $("#Store_Category .main-section .bootstrap-select").addClass('open');
                $("#Store_Category").find(".input-remove-text").hide();
                $(".category_section ul li.filter-append").remove();

        },50);    

    });

            $("#Store_SubCategory .input-block-level").keyup(function () {
               text_category =  $("#Store_SubCategory .input-block-level").val();
               
                if (text_category!='') {
                    $("#Store_SubCategory").find(".input-remove-text").show();
                }else{
                    $("#Store_SubCategory").find(".input-remove-text").hide();
                }
            });


            $("#Store_SubCategory .input-remove-text").click(function(){

                $("#Store_SubCategory").find('.hide_srh_fltr_brand').addClass('show_order_main').removeClass('hide_srh_fltr_main');


                setTimeout(function () {

                    $("#Store_SubCategory .main-section .bootstrap-select").addClass('open');

                    $("#Store_SubCategory").find(".input-remove-text").hide();
                    $(".subcategory_section ul li.filter-append").remove();

                },50);
            
            });

            $("#Store_Gender .input-block-level").keyup(function () {
               text_category =  $("#Store_Gender .input-block-level").val();
               
                if (text_category!='') {
                    $("#Store_Gender").find(".input-remove-text").show();
                }else{
                    $("#Store_Gender").find(".input-remove-text").hide();
                }
            });


            $("#Store_Gender .input-remove-text").click(function(){

                $("#Store_Gender").find('.hide_srh_fltr_brand').addClass('show_order_main').removeClass('hide_srh_fltr_main');


                setTimeout(function () {

                    $("#Store_Gender .main-section .bootstrap-select").addClass('open');

                    $("#Store_Gender").find(".input-remove-text").hide();
                    $(".gender_section ul li.filter-append").remove();

                },50);
            
            });


            $("#Store_Type .input-block-level").keyup(function () {
               text_category =  $("#Store_Type .input-block-level").val();
               
                if (text_category!='') {
                    $("#Store_Type").find(".input-remove-text").show();
                }else{
                    $("#Store_Type").find(".input-remove-text").hide();
                }
            });


            $("#Store_Type .input-remove-text").click(function(){

                $("#Store_Type").find('.hide_srh_fltr_brand').addClass('show_order_main').removeClass('hide_srh_fltr_main');


                setTimeout(function () {

                    $("#Store_Type .main-section .bootstrap-select").addClass('open');

                    $("#Store_Type").find(".input-remove-text").hide();
                    $(".type_section ul li.filter-append").remove();

                },50);
            
            });



            var timeoutBrand;

        $("#Store_Brand .input-block-level").keyup(function (e) {                

            $("#Store_Brand .no-results").remove();

            var txt = $("#Store_Brand .input-block-level").val();
            if (txt!='') {
                    $("#Store_Brand").find('.hide_srh_fltr_brand').addClass('hide_srh_fltr_main').removeClass('show_order_main');
                }else{
                    $("#Store_Brand").find('.hide_srh_fltr_brand').addClass('show_order_main').removeClass('hide_srh_fltr_main');
                }
            if (typeof timeoutBrand == "number") {
            window.clearTimeout(timeoutBrand);
            delete timeoutBrand;
        }
        timeoutBrand = window.setTimeout(show_suggestions('Brand','brand',txt), 1500);
           

            if (e.keyCode == 13) {

                if (txt != '') {

                   SelectReloadFilter('Brand','2',txt,txt,'basic');
                }

            }

        });


            $("#Store_Brand .input-remove-text").click(function(){
                // Shop_brand_Close();

                  $("#Store_Brand").find('.hide_srh_fltr_brand').addClass('show_order_main').removeClass('hide_srh_fltr_main');

                setTimeout(function () {

                    $("#Store_Brand .main-section .bootstrap-select").addClass('open');

                    $("#Store_Brand").find(".input-remove-text").hide();
                      $("#Store_Brand .input-block-level").val("");
                    $("#Store_Brand .input-block-level").click();
                    $(".brand_section ul li.filter-append").remove();

                },50);
            
            });



        
      



    var timeoutcategory;

        $("#Store_Category .input-block-level").keyup(function (e) {

                

            $("#Store_Category .no-results").remove();

            var txt = $("#Store_Category .input-block-level").val();
            if (txt!='') {
                    $("#Store_Category").find('.hide_srh_fltr_brand').addClass('hide_srh_fltr_main').removeClass('show_order_main');
                }else{
                    $("#Store_Category").find('.hide_srh_fltr_brand').addClass('show_order_main').removeClass('hide_srh_fltr_main');
                }
            if (typeof timeoutcategory == "number") {
            window.clearTimeout(timeoutcategory);
            delete timeoutcategory;
        }
        timeoutcategory = window.setTimeout(show_suggestions('Category','category',txt), 1500);
           

            if (e.keyCode == 13) {

                if (txt != '') {

                   SelectReloadFilter('Category','2',txt,txt,'basic');
                }

            }

        });

var timeoutsubcategory;
        $("#Store_SubCategory .input-block-level").keyup(function (e) {

            

             $("#Store_SubCategory .no-results").remove();

            var txt = $("#Store_SubCategory .input-block-level").val();

            if (txt!='') {
                    $("#Store_SubCategory").find('.hide_srh_fltr_brand').addClass('hide_srh_fltr_main').removeClass('show_order_main');
                }else{
                    $("#Store_SubCategory").find('.hide_srh_fltr_brand').addClass('show_order_main').removeClass('hide_srh_fltr_main');
                }
                
                 if (typeof timeoutsubcategory == "number") {
                    window.clearTimeout(timeoutsubcategory);
                    delete timeoutsubcategory;
                }
                timeoutsubcategory = window.setTimeout(show_suggestions('SubCategory','subcategory',txt), 1500);
        
            if (e.keyCode == 13) {

                if (txt != '') {

                   SelectReloadFilter('SubCategory','2',txt,txt,'basic');
                }

            }

        });
var timeouttype;
        $("#Store_Type .input-block-level").keyup(function (e) {

           
            
            $("#Store_Type .no-results").remove();

            var txt = $("#Store_Type .input-block-level").val();
             if (txt!='') {
                    $("#Store_Type").find('.hide_srh_fltr_brand').addClass('hide_srh_fltr_main').removeClass('show_order_main');
                }else{
                    $("#Store_Type").find('.hide_srh_fltr_brand').addClass('show_order_main').removeClass('hide_srh_fltr_main');
                }
             if (typeof timeouttype == "number") {
                    window.clearTimeout(timeouttype);
                    delete timeouttype;
                }
                timeouttype = window.setTimeout(show_suggestions('Type','type',txt), 1500);
           
            if (e.keyCode == 13) {

                if (txt != '') {

                   SelectReloadFilter('Type','2',txt,txt,'basic');
                }

            }

        });
var timeoutgender;
        $("#Store_Gender .input-block-level").keyup(function (e) {

            
            
            $("#Store_Gender .no-results").remove();

            var txt = $("#Store_Gender .input-block-level").val();

            if (txt!='') {
                    $("#Store_Gender").find('.hide_srh_fltr_brand').addClass('hide_srh_fltr_main').removeClass('show_order_main');
                }else{
                    $("#Store_Gender").find('.hide_srh_fltr_brand').addClass('show_order_main').removeClass('hide_srh_fltr_main');
                }
                if (typeof timeoutgender == "number") {
                    window.clearTimeout(timeoutgender);
                    delete timeoutgender;
                }
                timeoutgender = window.setTimeout(show_suggestions('Gender','gender',txt), 1500);
     


            if (e.keyCode == 13) {

                if (txt != '') {

                   SelectReloadFilter('Gender','2',txt,txt,'basic');
                }

            }

        });


        $("#Store_Brand .input-block-level").keyup(function (e) {
            
            $("#Store_Brand .no-results").remove();

            var txt = $("#Store_Brand .input-block-level").val();
        
            if (e.keyCode == 13) {

                if (txt != '') {

                   SelectReloadFilter('Brand','2',txt,txt,'basic');
                }
            }       

        });



              var timeoutcity;
            $("#Store_City .input-block-level").keyup(function (e) {
               var txt = $("#Store_City .input-block-level").val();
               
                if (txt!='') {
                    $("#Store_City").find(".input-remove-text").show();
                    $("#Store_City").find('.hide_srh_fltr_brand').addClass('hide_srh_fltr_main').removeClass('show_order_main');
                }else{
                    $("#Store_City").find(".input-remove-text").hide();
                    $("#Store_City").find('.hide_srh_fltr_brand').addClass('show_order_main').removeClass('hide_srh_fltr_main');
                }

                

                 $("#Store_City .no-results").remove();

                   
                if (typeof timeoutcity == "number") {
                    window.clearTimeout(timeoutcity);
                    delete timeoutcity;
                }

                timeoutcity = window.setTimeout(show_suggestions('City','city',txt), 1500);
                

                    if (e.keyCode == 13) {

                        if (txt != '') {

                           SelectReloadFilter('City','2',txt,txt,'basic');
                        }

                    }


            });


            $("#Store_City .input-remove-text").click(function(){

                $("#Store_City").find('.hide_srh_fltr_brand').addClass('show_order_main').removeClass('hide_srh_fltr_main');


                setTimeout(function () {

                $("#Store_City .main-section .bootstrap-select").addClass('open');
                $("#Store_City").find(".input-remove-text").hide();
                $(".city_section ul li.filter-append").remove();

                },50);    

            });
              var timeoutarea;
            $("#Store_Area .input-block-level").keyup(function (e) {
               var txt = $("#Store_Area .input-block-level").val();
               
                if (txt!='') {
                    $("#Store_Area").find(".input-remove-text").show();
                    $("#Store_Area").find('.hide_srh_fltr_brand').addClass('hide_srh_fltr_main').removeClass('show_order_main');
                }else{
                    $("#Store_Area").find(".input-remove-text").hide();
                    $("#Store_Area").find('.hide_srh_fltr_brand').addClass('show_order_main').removeClass('hide_srh_fltr_main');
                }


                 $("#Store_Area .no-results").remove();

                   
                if (typeof timeoutarea == "number") {
                    window.clearTimeout(timeoutarea);
                    delete timeoutarea;
                }
                timeoutarea = window.setTimeout(show_suggestions('Area','area',txt), 1500);
               

                    if (e.keyCode == 13) {

                        if (txt != '') {

                           SelectReloadFilter('Area','2',txt,txt,'basic');
                        }

                    }


            });


            $("#Store_Area .input-remove-text").click(function(){

                $("#Store_Area").find('.hide_srh_fltr_brand').addClass('show_order_main').removeClass('hide_srh_fltr_main');

                setTimeout(function () {

                $("#Store_Area .main-section .bootstrap-select").addClass('open');
                $("#Store_Area").find(".input-remove-text").hide();
                $(".area_section ul li.filter-append").remove();

                },50);    

            });

     }



			
//     function LeftSidebar()

//             {        

//                 var Search = $("#Search").val();
//                 var Control = $("#ControllerName1").val();
//                 // var Where = $("div[id=Where]:last").text();                
//                 var params_count = $("div[id=params_count]:last").text();
//                 // var IsSub = $("input[id=IsSub]:last").val();
//                 var user_type = $("input[id=For]:last").val();
//                 // var Suggest = $("input[id=Suggest]:last").val();
//                 var brand  = $("#Brand").val();                
//                 var sidebar  = $("#sidebar").val();
//                 if(Search==undefined){

//                     Search = '';
//                 }
                
//                 // if(Where)
//                 // Where = Where.replace(/\&/g, "%26");
                

//                 $.ajax({


//                     type: "POST",
                    

//                     url: "/Filter/Search_Tools1",
                    

//                     data:"Search="+Search+"&Control="+Control+"&user_type="+user_type+"&params="+encodeURIComponent(params_count)+"&brand="+brand+"&sidebar="+sidebar,

                    

//                     success: "success",

                    

//                     dataType: 'text',

                    

//                     context: document.body



//                     }).done(function(msg) { 

                    

//                     var obj = jQuery.parseJSON(msg);


                   
//                     if (obj.count[0]!=0) {
//                     $("span#enquiries_cnt").html('<span class="header_blue">'+obj.count[0]+" Leads</span>");

//                     }else{
//                          $("span#enquiries_cnt").html('<span class="header_blue">0 Leads</span>');

//                     }
//                     if (obj.count[1]!=0) {
//                     $("span#leads_cnt").html('<span class="header_blue">'+obj.count[1]+" Leads</span>");
                        
//                     }else{
//                         $("span#leads_cnt").html('<span class="header_blue">0 Leads</span>');
                        
//                     }

//                     if (obj.count[3] != '') {
//                         $(".for-business-in-header-text").html('Business <span class="count_of_business">(' + obj.count[3] + ')</span>')
//                     }
//                     else {
//                         $(".for-business-in-header-text").html('Business <span class="count_of_business">(0)</span>')
//                     }


//                     if(obj.count[2]!=''){
//                         $(".for-personal-in-header-text").html('Personal <span class="count_of_personal">('+obj.count[2]+')</span>')
//                     }
//                     else{
//                         $(".for-personal-in-header-text").html('Personal <span class="count_of_personal">(0)</span>')
//                     }

                  

//                 });


// }

			

function filter_search_position(){

                if($(window).width()>1200){

            var lastScrollTop1 = 0;

            var direction;
       
            $(window).on('mousewheel scroll', function (e) {              
           

                var scroll_top_height12 = $("#scroll_top_height").val();

                if (scroll_top_height12=='') {
                    $("#Sidebar_New").removeAttr('style');     
                };
                
                var st_down = $(this).scrollTop();                         

                if (st_down > lastScrollTop1){
                    var direction = 1;
                    // direction1 = 1;
                }
                if (st_down < lastScrollTop1){
                    var direction = 0;

                    // direction1=0;
                }

              
                if (lastScrollTop1 !== st_down) {
                    lastScrollTop1 = st_down;               
                   
                    var filter_div_height = $("#Sidebar_New").outerHeight(true);                

                    var filter_div_height122 = $("#scroll_top_filter_height").val();                

                    if (filter_div_height122=='') {              

                        var filter_div_height = $("#Sidebar_New").outerHeight(true);
                        $("#scroll_top_filter_height").val(filter_div_height);
                    }else{
                         var filter_div_height = filter_div_height122;
                    }
                    

                    var scroll_top_height = $("#scroll_top_height").val();
                   
                    var filter_div_height12 = parseInt(filter_div_height)-200;

                    if (scroll_top_height!='') {

                        filter_div_height12 = parseInt(scroll_top_height)+(parseInt(filter_div_height)-200);


                    if(direction === 1) {

                        var top_height = $(window).scrollTop()-(parseInt(scroll_top_height)+88);
                      
                        $('#Sidebar').css('cssText', 'position:fixed;top:-'+top_height+'px;');
                    }
                    if(direction === 0) {

                        var top_height = $(window).scrollTop()-(parseInt(scroll_top_height)+138);
                        $('#Sidebar').css('cssText', 'position:fixed;top:-'+top_height+'px;');
                 
                    }

                    }else{

                    if(direction === 1) {
                       
                         $('#sidebar_shot_view').css('cssText', 'position:fixed!important;top:88px!important');
                    }
                    if(direction === 0) {
                         $('#sidebar_shot_view').css('cssText', 'position:fixed!important;top:138px!important');
                      
                    }
                        
                    }

                 

                    if ($(window).scrollTop() > filter_div_height12+800) {
                     
                        $("#scroll_top_height").val("");

                        $("#Sidebar").css("display", "none");
                        $("#sidebar_shot_view").css("display", "block");
                         $("#height_home_content").val("");
                         
                        if(direction === 1) {
                            
                             $('#sidebar_shot_view').css('cssText', 'position:fixed!important;top:88px!important');
                        }
                        if(direction === 0) {
                             $('#sidebar_shot_view').css('cssText', 'position:fixed!important;top:138px!important');
                          
                        }
                      
                    }
                    else if ($(window).scrollTop() < filter_div_height12+800) {
             
                        $("#Sidebar").css("display", "block");
                        $("#sidebar_shot_view").css("display", "none");       
                        $("#height_home_content").val("");
                      
                        if (scroll_top_height!='' && direction === 0 && scroll_top_height>$(window).scrollTop()) {
                             $("#scroll_top_height").val("");
                          };

                         

                            if (scroll_top_height=='') {
                                if(direction === 1) {                        

                                    if ($(window).scrollTop()==0) {
                                        var top_height = 88;
                                        $('#Sidebar').css('cssText', 'position:fixed;top:88px;');
                                    }else{
                                   
                                         var top_height = $(window).scrollTop()-88;
                                         $('#Sidebar').css('cssText', 'position:fixed;top:-'+top_height+'px;');
                                    }                     
                                    
                                }
                                if(direction === 0) {                              
                                    if ($(window).scrollTop()==0) {
                                        var top_height = 138;
                                        $('#Sidebar').css('cssText', 'position:fixed;top:138px;');
                                    }else{
                                 
                                        var top_height = $(window).scrollTop()-138;
                                         $('#Sidebar').css('cssText', 'position:fixed;top:-'+top_height+'px;');
                                    }                            
                            
                                }

                            };        
              

                        }else{      

                            $("#Sidebar").css("display", "block");
                            $("#sidebar_shot_view").css("display", "none");           
                        }

                    };
      
            $(document).on('click' , '#sidebar_shot_view', function(e) {               
                

                var filter_div_height45 = $("#Home_Content").outerHeight(true);

                var filter_height = $("#scroll_top_filter_height").val();
                    
                var full_page_height = (parseInt(filter_div_height45)+parseInt(filter_height));

                var height_home_content = $("#height_home_content").val();

                if (parseInt(full_page_height)>$(window).scrollTop() && height_home_content=='') {

                    $("#height_home_content").val("1");
                    $('#Home_Content').css('cssText', 'min-height:'+full_page_height+'px;');

                };
                
                $("#scroll_top_height").val($(window).scrollTop());

                if(direction === 1) {             
                     $('#Sidebar').css('cssText', 'position:fixed;top:88px;');
                }
                if(direction === 0) {
                     $('#Sidebar').css('cssText', 'position:fixed;top:138px;');
             
                }

                $("#Sidebar").css("display", "block");
                $("#sidebar_shot_view").css("display", "none");      

       
            });          

        });



    }



    
}

	

           var req_category = null;

        function show_suggestions(field,id,txt){

            // console.log(field);
            // console.log(id);
                
            $("."+id+"_section ul li.filter-append").remove();

            if (txt!='') {

                $("."+id+"_section ul").append('<li class="filter-append" rel="23"><a title="Search Results" class="" style="" tabindex="0"><span class="text">------------Search Results------------</span></a></li>');

                $("."+id+"_section ul").append('<li class="filter-append filter-append-loading" rel="23"><div class="" align="center"><img src="/img/loading_company.gif" alt="loading"  title="loading"/></div></li>');

            }
            if (req_category != null) req_category.abort();

            var control = $("#ControllerName").val();

            var user_type = $("input[id=For]:last").val();

            var search = $("input[id=Search]:last").val();

            var Where = $("div[id=params]:last").text();

            var Where_brand = $("div[id=params_brand]:last").text();

            var field_cache = $("input[id=WC_"+field+"]:last").val();

            var count_txt = txt.length; 

            if(txt!=''){

            if (count_txt>=2) { 

            req_category = $.ajax({

            type: "POST",
            url: "/Filter/Leads_Search",
            data: "txt=" + txt + "&search="+search+"&field="+field+"&field_cache="+field_cache+"&Where_brand="+encodeURIComponent(Where_brand)+"&Where="+encodeURIComponent(Where)+"&customer=" + user_type + "&control=" + control,
            success: "success",
            dataType: 'text',
            context: document.body

            }).done(function (msg) {

            if (msg)
            {
 

            var obj = jQuery.parseJSON(msg);

            var category_name = obj.category;
            var category_value = obj.category_value;

            var scat_name = obj.subcategory;
            var scat_name_value = obj.subcategory_value;

            var type_name = obj.type;
            var type_value = obj.type_value;

            var gender_name = obj.gender;
            var gender_value = obj.gender_value;

            var city_name = obj.city;
            var city_value = obj.city_value;

            var area_name = obj.area;
            var area_value = obj.area_value;
                    
            var brand_name = obj.brand;
            var brand_value = obj.brand_value;

              $("."+id+"_section ul li.filter-append").remove();

            $("#Store_"+field+" .no-results").remove();

             $("."+id+"_section ul").append('<li class="filter-append" rel="23"><a title="Search Results" class="" style="" tabindex="0"><span class="text">------------Search Results------------</span></a></li>');
              if (category_name!='' && category_name!==undefined) {

                category_name_shot = category_name;         
                if (category_name.length>15) {
                    category_name_shot = category_name.substring(0, 15);
                    category_name_shot = category_name_shot+"...";
                };
                var re = new RegExp('('+txt+')', 'gi');
               
                var high_text_cate = '<span class=suggestion_highlight>'+txt+'</span>';
               
                $("."+id+"_section ul").append('<li class="filter-append" rel="23"><a onclick="SelectFilter(' + "'Category'" + ',' + "'2'" + ',' + "'" + txt + "'" + ',' + "'" + txt + "'" + ',' + "'basic'" + ')" title="'+txt+'" class="" style="" tabindex="0"><span class="text"><span class="filter-type-text">' + high_text_cate + '</span><span class="text-count-value"> in Category ('+category_value+')</span> </span></a></li>');
            } 

            if (scat_name!='' && scat_name!==undefined) {

                scat_name_shot = scat_name;          
                if (scat_name.length>15) {
                    scat_name_shot = scat_name.substring(0, 15);
                    scat_name_shot = scat_name_shot+"...";
                };
                 var re = new RegExp('('+txt+')', 'gi');
               
                // var high_text_subcate = scat_name_shot.replace(re,'<span class=suggestion_highlight>'+txt+'</span>');
                var high_text_subcate = '<span class=suggestion_highlight>'+txt+'</span>';
                scat_name = scat_name.replace("'","%27");   
                scat_name = scat_name.replace(",","%2C");
                $("."+id+"_section ul").append('<li class="filter-append" rel="23"><a onclick="SelectFilter(' + "'SubCategory'" + ',' + "'3'" + ',' + "'" + txt + "'" + ',' + "'" + txt + "'" + ',' + "'basic'" + ')" title="'+txt+'" class="" style="" tabindex="0"><span class="text"><span class="filter-type-text">' + high_text_subcate + '</span><span class="text-count-value"> in Sub-Category ('+scat_name_value+')</span> </span></a></li>');
            } 

            if (type_name!='' && type_name!==undefined) {

                type_name_shot = type_name;      
                if (type_name.length>15) {
                    type_name_shot = type_name.substring(0, 15);  
                    type_name_shot = type_name_shot+"...";
                };
                 var re = new RegExp('('+txt+')', 'gi');
               
                // var high_text_type = type_name_shot.replace(re,'<span class=suggestion_highlight>'+txt+'</span>');
                var high_text_type = '<span class=suggestion_highlight>'+txt+'</span>';
                type_name = type_name.replace("'","%27");   
                type_name = type_name.replace(",","%2C");
                $("."+id+"_section ul").append('<li class="filter-append" rel="23"><a onclick="SelectFilter(' + "'Type'" + ',' + "'4'" + ',' + "'" + type_name + "'" + ',' + "'" + type_name + "'" + ',' + "'basic'" + ')" title="'+type_name+'" class="" style="" tabindex="0"><span class="text"><span class="filter-type-text">' + high_text_type + '</span><span class="text-count-value"> in Type ('+type_value+')</span> </span></a></li>');
            } 

            if (gender_name!='' && gender_name!==undefined) {

                gender_name_shot = gender_name;           
                if (gender_name.length>15) {
                    gender_name_shot = gender_name.substring(0, 15); 
                    gender_name_shot = gender_name_shot+"...";
                };
                 var re = new RegExp('('+txt+')', 'gi');
               
                var high_text_gender = '<span class=suggestion_highlight>'+txt+'</span>';
               
                $("."+id+"_section ul").append('<li class="filter-append" rel="23"><a onclick="SelectFilter(' + "'Gender'" + ',' + "'5'" + ',' + "'" + gender_name + "'" + ',' + "'" + gender_name + "'" + ',' + "'basic'" + ')" title="'+gender_name+'" class="" style="" tabindex="0"><span class="text"><span class="filter-type-text">' + high_text_gender + '</span><span class="text-count-value"> in Gender ('+gender_value+') </span></span></a></li>');
            } 

            if (brand_name!='' && brand_name!==undefined) {

                    brand_name_shot = brand_name;

                if (brand_name.length>15) {
                    brand_name_shot = brand_name.substring(0, 15); 
                    brand_name_shot = brand_name_shot+"...";
                };

                
            
                var reb = new RegExp('('+txt+')', 'gi');

                 var high_text_brand = '<span class=suggestion_highlight>'+txt+'</span>';
                 // console.log(high_text_brand);
                brand_name = brand_name.replace("'","%27");   
                brand_name = brand_name.replace(",","%2C"); 
                $("."+id+"_section ul").append('<li class="filter-append" rel="23"><a onclick="SelectFilter(' + "'Brand'" + ',' + "'6'" + ',' + "'" + txt + "'" + ',' + "'" + txt + "'" + ',' + "'basic'" + ')" title="'+txt+'" class="" style="" tabindex="0"><span class="text"><span class="filter-type-text">' + high_text_brand + '</span><span class="text-count-value"><span class="text-count-value"> in Brand ('+brand_value+')</span> </span></span></a></li>');
            } 

            if (city_name!='' && city_name!==undefined) {

                city_name_shot = city_name;      
                if (city_name.length>15) {
                    city_name_shot = city_name.substring(0, 15);    
                    city_name_shot = city_name_shot+"...";
                };

                var re = new RegExp('('+txt+')', 'gi');
                var high_text_city = '<span class=suggestion_highlight>'+txt+'</span>';
                city_name = city_name.replace("'","%27");   
                city_name = city_name.replace(",","%2C"); 
                $("."+id+"_section ul").append('<li class="filter-append" rel="23"><a onclick="SelectFilter(' + "'City'" + ',' + "'7'" + ',' + "'" + txt + "'" + ',' + "'" + txt + "'" + ',' + "'basic'" + ')" title="'+txt+'" class="" style="" tabindex="0"><span class="text"><span class="filter-type-text">' + high_text_city + '</span><span class="text-count-value"> in City ('+city_value+')</span> </span></a></li>');
            } 

            if (area_name!='' && area_name!==undefined ) {

                area_name_shot = area_name;        
                if (area_name.length>15) {
                    area_name_shot = area_name.substring(0, 15);  
                    area_name_shot = area_name_shot+"...";
                };
                var re = new RegExp('('+txt+')', 'gi');
                // var high_text_area = area_name_shot.replace(re,'<span class=suggestion_highlight>'+txt+'</span>');
                var high_text_area = '<span class=suggestion_highlight>'+txt+'</span>';
               
                area_name = area_name.replace("'","%27");   
                area_name = area_name.replace(",","%2C"); 
                $("."+id+"_section ul").append('<li class="filter-append" rel="23"><a onclick="SelectFilter(' + "'Area'" + ',' + "'8'" + ',' + "'" + txt + "'" + ',' + "'" + txt + "'" + ',' + "'basic'" + ')" title="'+txt+'" class="" style="" tabindex="0"><span class="text"><span class="filter-type-text">' + high_text_area + '</span><span class="text-count-value"> in Area ('+area_value+') </span></span></a></li>');
            }



            }else{


            $("."+id+"_section ul li.filter-append-loading").remove();
            $("."+id+"_section ul").append('<li class="filter-append" rel="23"><a title="No Results" class="" style="" tabindex="0"><span class="text text-count-value">No Matches Found.<br/>Please Try Another Search.</span></a></li>');
           
            }

        });

    }else{
           $("."+id+"_section ul li.filter-append").remove();

            $("#Store_"+field+" .no-results").remove();

            $("."+id+"_section ul").append('<li class="filter-append" rel="23"><a title="Search Results" class="" style="" tabindex="0"><span class="text">------------Search Results------------</span></a></li>');
            $("."+id+"_section ul").append('<li class="filter-append" rel="23"><a title="No Results" class="" style="" tabindex="0"><span class="text text-count-value">Min. 2 Characters Required.</span></a></li>');
           
    }

}

}


      function SelectReloadFilter(field, order, id, search_value, page){
      

        var For = $("input[id=For]:last").val();

        var view_value = $("input[id=view_value]:last").val();

        this.$backdrop = $('<div class="modal-backdrop fade in " />')
        .appendTo(document.body)

        $(".loading_image_selection").show();
   

        // var search_value = $("#store_product_menu_fixed .input-block-level").val();

        if (search_value != '') {

            window.location.href = 'https://www.xerve.in/leads?need=' + For + '&q=' + search_value+'&viewlist='+view_value;

        }

    
 }

     function SelectFilter(field, order, id, value, page){


        this.$backdrop = $('<div class="modal-backdrop fade in " />')
        .appendTo(document.body)

        $(".loading_image_selection").show();

        var For = $("input[id=For]:last").val();

        view_value = $("input[id=view_value]:last").val();

        window.location.href = 'https://www.xerve.in/leads?need=' + For + '&' + field.toLowerCase() +'='+value.replace(/\&/g, "%26").replace(/\ /g, "+").charAt(0).toUpperCase()+value.slice(1)+'&viewlist='+view_value; 
        

 }



       var B_Order = null;
    
function change_show_order(order,field){

    if (B_Order != null) B_Order.abort();

        $("#Store_"+field+" div."+field.toLowerCase()+"_section").addClass("open");
    setTimeout(function(){
        $("#Store_"+field+" div."+field.toLowerCase()+"_section").addClass("open");
    },0);

    $("#Store_"+field).find(".tick_sele_alpha").hide();
    $("#Store_"+field).find(".tick_sele_count").hide();
    $("#Store_"+field).find(".tick_sele_"+order).show();
    $("#Store_"+field).find(".color_ma_so_count").removeClass("sort-sele-filt");
    $("#Store_"+field).find(".color_ma_so_alpha").removeClass("sort-sele-filt");
    $("#Store_"+field).find(".color_ma_so_"+order).addClass("sort-sele-filt");

        var menu_height = $("#Store_"+field+" .dropdown-menu").outerHeight(true);

        if (order=='alpha') {

            var alpha_value = $("#Store_"+field).find("input[id='Brand_order_store']:last").val();
            if (alpha_value=='alpha_atoz') {
                $("#Store_"+field).find("input[id='Brand_order_store']:last").val("alpha_ztoa");
                order = alpha_value;  
                $("#Store_"+field).find(".show_icon_val_alpha").html('<i class="glyphicon glyphicon-sort-by-alphabet"> </i>');
              
            }else{
                $("#Store_"+field).find("input[id='Brand_order_store']:last").val("alpha_atoz");
                order = alpha_value;
                $("#Store_"+field).find(".show_icon_val_alpha").html('<i class="glyphicon glyphicon-sort-by-alphabet-alt"> </i>');

            }
 
        }else if (order=='count') {

            var count_value = $("#Store_"+field).find("input[id='Brand_order_count']:last").val();    
            if (count_value=='countdec') {
                $("#Store_"+field).find("input[id='Brand_order_count']:last").val("countasc");
                order = count_value;
                $("#Store_"+field).find(".show_icon_val_count").html('<i class="glyphicon glyphicon-sort-by-attributes-alt"> </i>');

            }else{
                $("#Store_"+field).find("input[id='Brand_order_count']:last").val("countdec");
                order = count_value;
                $("#Store_"+field).find(".show_icon_val_count").html('<i class="glyphicon glyphicon-sort-by-attributes"> </i>');

            }

        };
        var menu_top = parseInt(menu_height)/2-20;

        $("#Store_"+field+" ul.dropdown-menu").html('<li class="filter-append" style="height:'+menu_height+'px;padding-top:'+menu_top+'px;" rel="23"><div class="" align="center"><img src="/img/loading_company.gif" alt="loading"  title="loading"/></div></li>');
      
        $("#Store_"+field).find("input[id='Brand_order_store_main']:last").val(order);
       
        if (field=='Brand') {
            var Where_Catch = $("input[id='Where_Catch_Filter_brand']").val();
        }else{
            var Where_Catch = $("input[id='WC_"+field+"']").val();
        }

      
        var Brand_name_main = $("input[id='"+field+"_name_main']:last").val();

        var Search = $("#Search").val();

        var brand_search = $("input[id='brand_search']:last").val();

        if (brand_search=="yes")  {
            Search = '';
        }

        section = 'leads';

    B_Order = $.ajax({
        type: "POST",
        url: "/Filter/Change_order",
        data: "field=" + field+"&Search=" + Search+"&Where_Catch=" + Where_Catch+"&section="+section+"&brand="+Brand_name_main+"&order="+order,
        success: "success",
        dataType: 'text',
        context: document.body

    }).done(function (msg) {

        // console.log(msg);

        // $("#Store_Brand_Order").html("");
        $("#Store_"+field+"_Order").html(msg);

        $('.selectpicker_'+field.toLowerCase()).selectpicker({});

        if (field=='SubCategory') {
        $('button[data-id="register'+field+'"] .pull-left').text("Sub-Category");

        }else{
        $('button[data-id="register'+field+'"] .pull-left').text(field);

        }

        $("#Store_"+field+" div.brand_section").addClass("open");

  
        filter_search();

        // $(".brand_searchction ul li.filter-append").reviewmove();
  

    });



}

	

	

	

















  





  

     


	

	  

	  

	 
	  

	  

	    

	
	  

	










	


	

	


	


			
		







				










  




  	



			 