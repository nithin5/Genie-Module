$(document).ready(function(){
  (function($) {
  var xhrPool = [];
  $(document).ajaxSend(function(e, jqXHR, options){
    xhrPool.push(jqXHR);
  });
  $(document).ajaxComplete(function(e, jqXHR, options) {
    xhrPool = $.grep(xhrPool, function(x){return x!=jqXHR});
  });
   abort = function() {
    $.each(xhrPool, function(idx, jqXHR) {
      jqXHR.abort();
    });
  };
  var oldbeforeunload = window.onbeforeunload;
  window.onbeforeunload = function() {
    var r = oldbeforeunload ? oldbeforeunload() : undefined;
    if (r == undefined) {
      abort();
    }
    return r;
  }
})(jQuery);
 $(".facebook-value-button").click(function() {
        FB.login();
    })
$(".closefull").click(function() {
     $('#login-popup3').modal('hide');
 });
 $(".close_pending").click(function() {
     $('#activation-popup').modal('hide');
 });
 $("#help_main").click(function() {
     $("#forgot_password_main").show();
 });

 if (window.innerWidth < 760) {   
    +function ($) {
    $(document)
        .on('click', '#login-drop', function () { $(document.body).addClass('modal-open') })
        .on('click', '.closebtn', function () { $(document.body).removeClass('modal-open') })
    }(jQuery);
}

if (window.innerWidth < 760) {   
+function ($) {
$(document)
    .on('click', '#navbartogmnu', function () { $(document.body).addClass('modal-open') })
    .on('click', '.menu-close.close_main', function () { $(document.body).removeClass('modal-open') })
}(jQuery);
}

  $(window).on('popstate', function() {
    var user = $("#User_Id").val();
    var control = $("#ControllerName").val();
    if (control != 'search') {
      if ($("#rgtnavscresult").is(':visible')) {
        $("#rgtnavscresult").removeClass('_xsdpblock');
        $("#rgtnavscresult").addClass('_xsdpnon');
        $("body").removeClass('stopscroll');
      }
    }
  });
  $(document).on('blur', '#Sidebar .input-block-level.form-control', function() {
    var section = $(this);
    var user = $("#User_Id").val();
    $(this).removeClass("Col12Width");
  });
    $(document).on('focus', '#Sidebar .input-block-level.form-control', function() {
    var section = $(this);
    var user = $("#User_Id").val();
    $(this).addClass("Col12Width");
  });

  $(document).on('click', '#Sidebar .btn-group', function() {
    var section = $(this).attr('data-id');
    var user = $("#User_Id").val();
    section = section.replace('register', '');
    if (section == 'Store') {
      section = 'Seller';
    } else if (section == 'Offer Type') {
      section = 'Type';
    } else if (section == 'Ad Type') {
      section = 'Ad_Type';
    }
    section = section.replace('-', '');
    $("#Store_" + section).toggleClass('filter_open');
    $("#Store_" + section + " .glyphicon-menu-down").addClass("glyphicon-menu-up").removeClass("glyphicon-menu-down");
    if (!$("#Store_" + section).hasClass('filter_open')) {
      $("#Store_" + section + " .glyphicon-menu-up").addClass("glyphicon-menu-down").removeClass("glyphicon-menu-up");
    }
  }); 
  $("body").on("mouseover", function() {
    $("#Sidebar .input-block-level.form-control").attr("placeholder", "Search...");
  });

$(document).on('mouseover', '.dropdown._dropdwnsorft', function() {
    $('.dropdown._dropdwnsorft').addClass('open');
  });
  $(document).on('mouseleave', '.dropdown._dropdwnsorft', function() {
    $('.dropdown._dropdwnsorft').removeClass('open');
  });

 $(document).on("change", ".offline_sel_sh", function() {
    var id = $(this).attr("id");
    $('input.offline_sel_sh').not(this).prop('checked', false);
    var checked = $(".offline_sel_sh").attr('checked');
    if (checked != 'checked') {
      var search = $('#SearchSubCategory').val();
      var genie_url = 'https://www.xerve.in/genie?wish=' + encodeURIComponent(search);
      window.open(genie_url, '_blank');
    }
    
    if (id == 'offers') {
      var offer_count = $("#offline_offer_sel_va").val();
      $(".offline_offer_seller_are").show();
      $("#_submiturwish").show();
      if (parseInt(offer_count) > 0) {
        $(".offline_price_seller_are").hide();
      } else {
        $(".offline_price_seller_are").show();
      }
      $('.col-xs-12.col-md-2.padding-0._width12').removeClass('_width12');
    } else if (id == 'prices') {
      var price_count = $("#offline_price_sel_va").val();
      if (parseInt(price_count) > 0) {
        $(".offline_offer_seller_are").hide();
      } else {
        $(".offline_offer_seller_are").show();
      }
      $('.col-xs-12.col-md-2.padding-0._width12').removeClass('_width12');
      $(".offline_price_seller_are").show();
      $("#_submiturwish").show();
    }
  });

  $('#SearchSubCategory').blur(function() {
    $('.custom-btn-home').removeClass("focus");
  })
  $('#SearchSubCategory').focus(function() {
    $('.custom-btn-home').addClass("focus")
  }); 

  if ($(window).width() < 500) {
    $("#xrimgadds").click(function() {
      $('._xrhmcomd').show();
      $('._xrhmcomd2').hide();
      $('#xrimgadds').addClass("active");
      $('#Xrhwitwrk').removeClass("active");
    });
    
    $("#Xrhwitwrk").click(function() {
      $('._xrhmcomd2').show();
      $('._xrhmcomd').hide();
      $('#Xrhwitwrk').addClass("active");
      $('#xrimgadds').removeClass("active");
    });
    $(document).on('click', "#xrveprc", function(event) {
      $('#cashback_section_carousel').addClass("mbxrhide");
      $('#prices_section_carousel').removeClass("mbxrhide");
      $('#xrveprc').addClass("active");
      $('#xrvpopcsh').removeClass("active");
    });
    $(document).on('click', "#xrvpopcsh", function(event) {
      $('#cashback_section_carousel').removeClass("mbxrhide");
      $('#prices_section_carousel').addClass("mbxrhide");
      $('#xrveprc').removeClass("active");
      $('#xrvpopcsh').addClass("active");
    });
}
    $(document).on('click', '#save_client_linked', function() {
    // $("#save_client_linked").click(function(){
    //alert("save_client");
    var mobile = $("#second-login-popup-linked #txtMblNo").val();
    var email = $("#second-login-popup-linked #Business_Email_Id").val();
    var email_pressence = $("#email_pressence_linked").val();
    var mobile_pressence = $("#mobile_pressence-linked").val();
    var login_type = "";
    var controller = $("#ControllerName").val();
    if (controller == 'shop') {
      var login_type_value = $("#coupon_login_main").val();
      if (login_type_value == 10) {
        login_type = 10
      } else {
        login_type = 0;
      }
    } else if (controller == 'cashback') {
      var login_type_value = $("#cashback_login_mobile_key").val();
      login_type = login_type_value;
    } else {
      login_type = 0;
    }
    if (!mobile) {
      // alert('here');
      $("#second-login-popup-linked #error_mobile").text("* Mobile No. Required");
      $("#second-login-popup-linked #error_mobile").css({
        "display": "block"
      });
      $("#second-login-popup-linked #error_mobile").css({
        "float": "left"
      });
      // return false;
    } else {
      $("#second-login-popup-linked #error_mobile").css({
        "display": "none"
      });
    }
    if (!email) {
      $("#second-login-popup-linked #error_useremail").text("* Email Id Required");
      $("#second-login-popup-linked #error_useremail").css({
        "display": "block"
      });
      $("#second-login-popup-linked #error_useremail").css({
        "float": "left"
      });
      $("#second-login-popup-linked #error_useremail").css({
        "margin": "0"
      });
      // return false;
    } else {
      $("#second-login-popup-linked #error_useremail").css({
        "display": "none"
      });
    }
    if (!ValidateMobile(mobile) && mobile != '') {
      // alert('here');
      $("#second-login-popup-linked #error_mobile").text("* Enter Valid Mobile Number");
      $("#second-login-popup-linked #error_mobile").css({
        "float": "left"
      });
      $("#second-login-popup-linked #error_mobile").css({
        "display": "block"
      });
      // return false;
    } else if (ValidateMobile(mobile)) {
      $("#second-login-popup-linked #error_mobile").css({
        "display": "none"
      });
    }
    if (!ValidateEmail(email) && email != '') {
      // alert('here');
      $("#second-login-popup-linked #error_useremail").text("* Enter Valid Email Id");
      $("#second-login-popup-linked #error_useremail").css({
        "float": "left"
      });
      $("#second-login-popup-linked #error_useremail").css({
        "display": "block"
      });
      // return false;
    } else if (ValidateEmail(email)) {
      $("#second-login-popup-linked #error_useremail").css({
        "display": "none"
      });
    }
    var id = $("#user_log").val();
    var f_id = $("#f_id_valuation").val();
    var first_name = $("#facebook_firstname").val();
    var last_name = $("#facebook_lastname").val();
    var mobile_verify_value = $("#mobile_fac_veri").val();
    var email_verify_value = $("#email_fac_veri").val();
    // if(mobile=)
    var longitude = $("#login_popup_buyer_longitude_f").val();
    var latitude = $("#login_popup_buyer_latitude_f").val();
    var city = $("#login_popup_buyer_city_f").val();
    var area = $("#login_popup_buyer_area_f").val();
    var country = $("#login_popup_buyer_country_f").val();
    var state = $("#login_popup_buyer_state_f").val();
    var address = $("#login_popup_buyer_address_f").val();
    // var linked_in = $("#linked_in_login").val();
    if (longitude == "") {
      $("#error_facebook_sharelocation").show();
    } else {
      $("#error_facebook_sharelocation").hide();
    }
    
    if ((!mobile) || (!email) || (!longitude))
      return false;
    if (id) {
      $(".loading-login-buyer-ajax-facebook").show();
      $(".save_client_facebook_button").hide();
      $.ajax({
        type: "POST",
        url: "/Generals/save_client_linked",
        data: "id=" + id + "&mobile=" + mobile + "&email=" + email + "&controller=" + controller + "&login_type=" + login_type + "&f_id=" + f_id + "&first_name=" + first_name + "&last_name=" + last_name + "&mobile_verify=" + mobile_verify_value + "&email_verify=" + email_verify_value + "&longitude=" + longitude + "&latitude=" + latitude + "&city=" + city + "&area=" + area + "&state=" + state + "&country=" + country + "&address=" + address,
        success: "success",
        dataType: 'text',
        context: document.body
      }).done(function(msg) {
        $(".loading-login-buyer-ajax-facebook").hide();
        if (f_id == '' || f_id == undefined) {
          $(".save_client_facebook_button").show();
          if (msg == 0) {
            $("#second-login-popup-linked #error_useremail").text("* Email Id. Already Exists");
            $("#second-login-popup-linked #error_useremail").css({
              "display": "inline"
            });
          } else if (msg == 1) {
            // error_mobile
            $("#second-login-popup-linked #error_mobile").text("* Mobile No. Already Exists");
            $("#second-login-popup-linked #error_mobile").css({
              "display": "inline"
            });
          } else if (msg == 2) {
            $("#second-login-popup-linked #error_useremail").text("* Email Id Already Exists");
            $("#second-login-popup-linked #error_useremail").css({
              "display": "inline"
            });
            $("#second-login-popup-linked #error_mobile").text("* Mobile No. Already Exists");
            $("#second-login-popup-linked #error_mobile").css({
              "display": "inline"
            });
          } else {
            $("#saved-info").show().fadeOut(400);
            // $(".close").click();
            $("#second-login-popup").modal('hide');
            if (controller == 'Homes') {
              window.location.href = "https://www.xerve.in";
            } else if (controller == 'cashback' && login_type == 1) {
              window.location.href = "https://www.xerve.in/myaccount/upload_bill";
            }
          }
        } else {
          var obj = jQuery.parseJSON(msg);
          var error = obj.error_message;
          var reason = obj.reason_value;
          $("#f_authenticate_reason").val(reason);
          var mobile_verify = $("#mobile_fac_veri").val();
          var email_verify = $("#email_fac_veri").val();
          // alert(mobile_verify);
          if (reason == 'same_account') {
            $(".linked_join_first_phase").hide();
            $("#linkedin_confirmation_section").show();
          } else if (reason == 'mobile_no_use') {
            if (mobile_verify == 1) {
              $(".linked_join_first_phase").hide();
              $("#linkedin_confirmation_section").show();
            } else {
              $("#mobile_fac_veri").val(1);
              $(".linked_join_first_phase button#save_client_linked").text('confirm');
              $(".linked_join_first_phase button#save_client_linked").show();
            }
          } else if (reason == 'email_id_use') {
            if (email_verify == 1) {
              var user_id_value = obj.user_id;
              $("#facebook_intial_id").val(user_id_value);
              $(".linked_join_first_phase").hide();
              $("#linkedin_confirmation_section").show();
              $("#linked_verify_code_email").show();
            } else {
              $("#email_fac_veri").val(1);
              $(".linked_join_first_phase button#save_client_linked").text('confirm');
              $(".linked_join_first_phase button#save_client_linked").show();
            }
          } else if (reason == 'new_account') {
            var user_id_value = obj.user_id;
            $("#facebook_intial_id").val(user_id_value);
            $(".linked_join_first_phase").hide();
            $("#linkedin_confirmation_section").show();
          }
          $(".linked_error_area").html(error);
          $(".linked_error_area").css('display', 'inline-block');
        }
      });
    }
  });
  $(document).on('click', '#save_client', function() {
    //alert("save_client");
    var mobile = $("#second-login-popup #txtMblNo").val();
    var email = $("#second-login-popup #Business_Email_Id").val();
    var email_pressence = $("#email_pressence").val();
    var mobile_pressence = $("#mobile_pressence").val();
    var login_type = "";
    var controller = $("#ControllerName").val();
    var social_type = $("#social_login_type").val();
    var social_user = $('#social_user_type').val();
    if (controller == 'shop') {
      var login_type_value = $("#coupon_login_main").val();
      if (login_type_value == 10) {
        login_type = 10
      } else {
        login_type = 0;
      }
    } else if (controller == 'cashback') {
      var login_type_value = $("#cashback_login_mobile_key").val();
      login_type = login_type_value;
    } else {
      login_type = 0;
    }
    if (!mobile) {
      // alert('here');
      $("#second-login-popup #error_mobile").text("* Mobile No. Required");
      $("#second-login-popup #error_mobile").css({
        "display": "block"
      });
      $("#second-login-popup #error_mobile").css({
        "float": "left"
      });
      // return false;
    } else {
      $("#second-login-popup #error_mobile").css({
        "display": "none"
      });
    }
    if (!email) {
      $("#second-login-popup #error_useremail").text("* Email Id Required");
      $("#second-login-popup #error_useremail").css({
        "display": "block"
      });
      $("#second-login-popup #error_useremail").css({
        "float": "left"
      });
      $("#second-login-popup #error_useremail").css({
        "margin": "0"
      });
      // return false;
    } else {
      $("#second-login-popup #error_useremail").css({
        "display": "none"
      });
    }
    if (!ValidateMobile(mobile) && mobile != '') {
      // alert('here');
      $("#second-login-popup #error_mobile").text("* Enter Valid Mobile Number");
      $("#second-login-popup #error_mobile").css({
        "float": "left"
      });
      $("#second-login-popup #error_mobile").css({
        "display": "block"
      });
      // return false;
    } else if (ValidateMobile(mobile)) {
      $("#second-login-popup #error_mobile").css({
        "display": "none"
      });
    }
    if (!ValidateEmail(email) && email != '') {
      // alert('here');
      $("#second-login-popup #error_useremail").text("* Enter Valid Email Id");
      $("#second-login-popup #error_useremail").css({
        "float": "left"
      });
      $("#second-login-popup #error_useremail").css({
        "display": "block"
      });
      // return false;
    } else if (ValidateEmail(email)) {
      $("#second-login-popup #error_useremail").css({
        "display": "none"
      });
    }
    var id = $("#user_log").val();
    var f_id = $("#f_id_valuation").val();
    var first_name = $("#facebook_firstname").val();
    var last_name = $("#facebook_lastname").val();
    var gender = $("#facebook_gender").val();
    var profile_pic = $("#facebook_profile").val();
    var mobile_verify_value = $("#mobile_fac_veri").val();
    var email_verify_value = $("#email_fac_veri").val();
    // if(mobile=)
    var longitude = $("#login_popup_buyer_longitude_f").val();
    var latitude = $("#login_popup_buyer_latitude_f").val();
    var city = $("#login_popup_buyer_city_f").val();
    var area = $("#login_popup_buyer_area_f").val();
    var country = $("#login_popup_buyer_country_f").val();
    var state = $("#login_popup_buyer_state_f").val();
    var address = $("#login_popup_buyer_address_f").val();
    var linked_in = $("#linked_in_login").val();
    if (longitude == "") {
      $("#error_facebook_sharelocation").show();
    } else {
      $("#error_facebook_sharelocation").hide();
    }
    if ((!mobile) || (!email))
      return false;
    if (id) {
      $(".loading-login-buyer-ajax-facebook").show();
      $(".save_client_facebook_button").hide();
      $.ajax({
        type: "POST",
        url: "/Connect/save_client",
        data: "id=" + id + "&mobile=" + mobile + "&email=" + email + "&controller=" + controller + "&login_type=" + login_type + "&f_id=" + f_id + "&first_name=" + 

first_name + "&last_name=" + last_name + "&mobile_verify=" + mobile_verify_value + "&email_verify=" + email_verify_value + "&longitude=" + longitude + "&latitude=" + 

latitude + "&city=" + city + "&area=" + area + "&state=" + state + "&country=" + country + "&address=" + address + "&gender=" + gender + "&profile_pic=" + 

encodeURIComponent(profile_pic),
        success: "success",
        dataType: 'text',
        context: document.body
      }).done(function(msg) {
        $("#second-login-popup #Business_Email_Id").prop("readonly", false);
        $(".loading-login-buyer-ajax-facebook").hide();
        if (f_id == '' || f_id == undefined) {
          $(".save_client_facebook_button").show();
          if (msg == 0) {
            $("#second-login-popup #error_useremail").text("* Email Id. Already Exists");
            $("#second-login-popup #error_useremail").css({
              "display": "inline"
            });
          } else if (msg == 1) {
            // error_mobile
            $("#second-login-popup #error_mobile").text("* Mobile No. Already Exists");
            $("#second-login-popup #error_mobile").css({
              "display": "inline"
            });
          } else if (msg == 2) {
            $("#second-login-popup #error_useremail").text("* Email Id Already Exists");
            $("#second-login-popup #error_useremail").css({
              "display": "inline"
            });
            $("#second-login-popup #error_mobile").text("* Mobile No. Already Exists");
            $("#second-login-popup #error_mobile").css({
              "display": "inline"
            });
          } else {
            $("#saved-info").show().fadeOut(400);
            // $(".close").click();
            $("#second-login-popup").modal('hide');
            if (controller == 'Homes') {
              window.location.href = "https://www.xerve.in";
            } else if (controller == 'cashback' && login_type == 1) {
              window.location.href = "https://www.xerve.in/myaccount/upload_bill";
            }
          }
        } else {
          var obj = jQuery.parseJSON(msg);
          var error = obj.error_message;
          var reason = obj.reason_value;
          $("#f_authenticate_reason").val(reason);
          var mobile_verify = $("#mobile_fac_veri").val();
          var email_verify = $("#email_fac_veri").val();
          if (reason == 'same_account') {
            $(".facebook_join_first_phase").hide();
            $("#facebook_confirmation_section").show();
          } else if (reason == 'mobile_no_use') {
            if (mobile_verify == 1) {
              $(".facebook_join_first_phase").hide();
              $("#facebook_confirmation_section").show();
            } else {
              $("#mobile_fac_veri").val(1);
              $(".facebook_join_first_phase button#save_client").text('confirm');
              $(".facebook_join_first_phase button#save_client").show();
            }
          } else if (reason == 'email_id_use') {
            if (email_verify == 1) {
              var user_id_value = obj.user_id;
              $("#facebook_intial_id").val(user_id_value);
              $(".facebook_join_first_phase").hide();
              $("#facebook_confirmation_section").show();
              $("#facebook_verify_code_email").show();
            } else {
              $("#email_fac_veri").val(1);
              $(".facebook_join_first_phase button#save_client").text('confirm');
              $(".facebook_join_first_phase button#save_client").show();
            }
          } else if (reason == 'new_account') {
            var user_id_value = obj.user_id;
            $("#facebook_intial_id").val(user_id_value);
            $(".facebook_join_first_phase").hide();
            $("#facebook_confirmation_section").show();
          }
          $(".facebook_error_area").html(error);
          $(".facebook_error_area").css('display', 'inline-block');
        }
      });
    }
  }); 
     var section = $("input[id=view_value]:last").val();
  // alert(section);
  if (section != '' && section != undefined) {
    if (section == 'list') {
      $("#scroll-top-grid").show();
      $("#scroll-top-check").hide();
    } else if (section == 'grid') {
      $("#scroll-top-grid").hide();
      $("#scroll-top-check").show();
    }
    if (window.innerWidth < 1199) {
      $("#scroll-top-check").css("bottom", "162px");
      $("#scroll-top-grid").css("bottom", "162px");
    }
    $("#scroll-top-check").click(function() {
      $("#scroll-top-grid").show();
      $("#scroll-top-check").hide();
    });
    $("#scroll-top-grid").click(function() {
      $("#scroll-top-grid").hide();
      $("#scroll-top-check").show();
    });
  } else {
    $("#scroll-top-grid").hide();
    $("#scroll-top-check").hide();
  }
    $('.custom-accord-head').click(function(e) {
    
    // alert("code is here");
 
    $('.custom-accord-head .glyphicon').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
    if ($(this.hash).css('display') != 'block')
    {
      $(".custom-accord-det").hide();
      $(this).find('.glyphicon').addClass('glyphicon-chevron-up').removeClass('glyphicon-chevron-down');
    }
    $(this.hash).slideToggle();
    $('html,body').animate({
      scrollTop: $(this.hash).offset().top - 600
    }, 1000);
  });
  $(document).on("click", "#scroll-top-sort", function() {
    var controller = $("#ControllerName").val();
    if (controller == 'shop') {
      $(".close-cover-sortsidestore").show();
    } else {
      $(".close-cover-sortside").show();
    }
    $("#sort_menu_scroll").show();
  });
   $(".head-list li").mouseenter(function() {
    var section = $(this).attr('id');
    $(".head-list li").each(function() {
      $(this).css("border-top", "2px solid #fff");
    });
    if (section == 'shop') {
      $(this).css('border-top', '2px solid #ffcc00');
    } else if (section == 'offers') {
      $(this).css('border-top', '2px solid #ffcc00');
    } else if (section == 'coupons') {
      $(this).css('border-top', '2px solid #ffcc00');
    } else if (section == 'cashback') {
      $(this).css('border-top', '2px solid #ffcc00');
    } else if (section == 'reviews') {
      $(this).css('border-top', '2px solid #ffcc00');
    } else if (section == 'company') {
      $(this).css('border-top', '2px solid #ffcc00');
    }
  });
  $(".head-list li").mouseleave(function(e) {
    var section = $(this).attr('id');
    var class_name = $(this).attr('class');
    var clas = '';
    if (section == 'shop') {
      clas = 'store'
    }
    if (section == 'offers') {
      clas = 'offer';
 
    }
    if (section == 'coupons') {
      clas = 'coupon';
    }
    if (section == 'reviews') {
      clas = 'review';
    }
    if (section == 'company') {
      clas = 'company';
    }
    if (class_name == undefined && !$("#main_hover_" + clas + "_section").is(':visible')) {
     
      $("#" + section).css("border-top", "2px solid #fff");
    }
  }); 

   $("#SearchSubCategory").focus(function() {
    var text = $("#SearchSubCategory").val();
    $("div.main-hover-store").hide();
    if (text.length >= 1) {
      suggestions_clicked();
      google_suggestion();
      $("#rgtnavscresult").removeClass('_xsdpblock');
      $('body').removeClass('stopscroll');
      $("#rgtnavscresult").addClass('_xsdpnon');
      $("#related_searches_paren").show();
      $("#related_searches").show();
    }
    // }
  });

 $(".head-list-second-header li.normal_li").each(function() {
   })
  $(".head-list-second-header div").each(function() {
    $(this).mouseover(function() {
    });
    $(this).mouseleave(function() {
    });
  });

 if ($(window).width() < 500) {
    $("#SearchSubCategory").focus(function() {
      if ($("#rgtnavscresult").is(":visible")) {
        $(".sidenav").removeClass('navexp');
        $("#rgtnavscresult").removeClass('_xsdpblock');
        $('body').removeClass('stopscroll');
        $("#rgtnavscresult").addClass('_xsdpnon');
      }
    });
    
    if ($(".dtpgnav").length > 0) {
      $(".dtpgnav #main_search_form").click(function() {
        $(".dtpgnav").addClass('dtscexp');
        $(".detailheader ").addClass("top38");
        $(".nav.navbar-nav.navbar-right").css("display", "none");
        $("#navbartogmnu").css("display", "none");
        $(".dtlogohd.dskhide").css("display", "none");
        $(".col-xs-12.padding-0.xrapps").css("display", "none");
        var q = $('#SearchSubCategory').val();
        if (q.length >= 1 && !$("#related_searches").is(":visible")) {
          $("#related_searches").show();
          $("#related_searches_paren").show();
        }
        if ($("#rgtnavscresult").is(":visible")) {
          $(".sidenav").removeClass('navexp');
          $("#rgtnavscresult").removeClass('_xsdpblock');
          $('body').removeClass('stopscroll');
          $("#rgtnavscresult").addClass('_xsdpnon');
        }
      });
      $(".dtpgnav #main_search_form").mouseleave(function() {
        $(".dtpgnav").removeClass('dtscexp');
        $(".detailheader ").removeClass("top38");
        $(".nav.navbar-nav.navbar-right").css("display", "block");
        $("#navbartogmnu").css("display", "block");
        $(".dtlogohd.dskhide").css("display", "block");
        $(".col-xs-12.padding-0.xrapps").css("display", "block");
      });
    }
  }
    if ($(window).width() < 1200) {
    $("#SearchSubCategory").focus(function() {
      var controller = $("#ControllerName").val();
      if (controller == 'Homes') {
        // alert(controller);
        var q = $('#SearchSubCategory').val();
        if (q.length >= 1 && !$("#related_searches").is(":visible")) {
          $("#related_searches").show();
          $("#related_searches_paren").show();
        }
        $(".custom-header").slideUp();
        $(".title_right_box").hide();
        $(".mb_ch_main").hide();
        // $(".main-section.index-page").css("margin-top","10px");
      } else {
        $(".header-details").addClass("visible-xs");
        $('.header').addClass('slide--up');
        if (controller != 'genie') {
          $(".navbar ").slideUp();
          $(".pull-up-hold .padding-0 ").slideUp();
          $('.pull-down-lg').fadeOut();
        }
        if (!$(".image-bg").is(":visible")) {
          // $(".pull-up-hold").fadeOut();
          $('.pull-down-lg').fadeOut();
          $(".image-bg").hide();
        }
        if (window.innerWidth < 760) {
          $(".suggest_style_main").css("top", "36px");
          $(".store_sort_menu").css('top', '123px');
          $(".close-cover-sort").css('top', '118px');
          $(".offer_sort_menu").css('top', '87px');
          $(".close-cover-sortother").css('top', '118px');
          $(".marg-tp-company").css('margin-top', '50px');
          $(".marg-tp-offer").css('margin-top', '50px');
        } else if (window.innerWidth > 760) {
          $(".store_sort_menu").css('top', '123px');
          $(".close-cover-sort").css('top', '118px');
          $(".offer_sort_menu").css('top', '87px');
          $(".close-cover-sortother").css('top', '118px');
          $(".marg-tp-company").css('cssText', 'margin-top:90px!important');
          $(".marg-tp-offer").css('cssText', 'margin-top:90px!important');
        }
      }
    });
    $(document).mousedown(function(e) {
      // The latest element clicked
      var user = $("#User_Id").val();
      clicky = $(e.target);
    });
   
  }
  setTimeout(function() {
    if ($('.main-section .btn-group').hasClass('open')) {
      $('.main-section .btn-group').removeClass('open');
    }
  });
    $(document).on('click', '#save_client_google', function() {
    var mobile = $("#second-login-popup #txtMblNo").val();
    var email = $("#second-login-popup #Business_Email_Id").val();
    var email_pressence = $("#email_pressence").val();
    var mobile_pressence = $("#mobile_pressence").val();
    var controller = $("#ControllerName").val();
    var mobile_validate = 0;
    if (!mobile) {
      $("#second-login-popup #error_mobile").text("* Mobile No. Required");
      $("#second-login-popup #error_mobile").css({
        "display": "block"
      });
      $("#second-login-popup #error_mobile").css({
        "float": "left"
      });
    } else {
      $("#second-login-popup #error_mobile").css({
        "display": "none"
      });
    }
    if (!ValidateMobile(mobile) && mobile != '') {
      $("#second-login-popup #error_mobile").text("* Enter Valid Mobile Number");
      $("#second-login-popup #error_mobile").css({
        "float": "left"
      });
      $("#second-login-popup #error_mobile").css({
        "display": "block"
      });
    } else if (ValidateMobile(mobile)) {
      $("#second-login-popup #error_mobile").css({
        "display": "none"
      });
      mobile_validate = 1;
    }
    var id = $("#user_log").val();
    var g_id = $("#f_id_valuation").val();
    var first_name = $("#facebook_firstname").val();
    var last_name = $("#facebook_lastname").val();
    // var gender     = $("#facebook_gender").val();
    var profile_pic = $("#facebook_profile").val();
    var mobile_verify_value = $("#mobile_fac_veri").val();
    var email_verify_value = $("#email_fac_veri").val();
    var longitude = $("#login_popup_buyer_longitude_f").val();
    var latitude = $("#login_popup_buyer_latitude_f").val();
    var city = $("#login_popup_buyer_city_f").val();
    var area = $("#login_popup_buyer_area_f").val();
    var country = $("#login_popup_buyer_country_f").val();
    var state = $("#login_popup_buyer_state_f").val();
    var address = $("#login_popup_buyer_address_f").val();
    if (longitude == "") {
      $("#error_facebook_sharelocation").show();
    } else {
      $("#error_facebook_sharelocation").hide();
    }
    var login_type = 0;
    if ((!mobile) || (!email) || (mobile_validate == 0))
      return false;
    if (id) {
      $(".loading-login-buyer-ajax-facebook").show();
      $("#second-login-popup #save_client_google").hide();
      $.ajax({
        type: "POST",
        url: "/Connect/save_client_google",
        data: "id=" + id + "&mobile=" + mobile + "&email=" + email + "&controller=" + controller + "&login_type=" + login_type + "&g_id=" + g_id + "&first_name=" + first_name + "&last_name=" + last_name + "&mobile_verify=" + mobile_verify_value + "&email_verify=" + email_verify_value + "&longitude=" + longitude + "&latitude=" + latitude + "&city=" + city + "&area=" + area + "&state=" + state + "&country=" + country + "&address=" + address + "&profile_pic=" + encodeURIComponent(profile_pic),
        success: "success",
        dataType: 'text',
        context: document.body
      }).done(function(msg) {
        $(".loading-login-buyer-ajax-facebook").hide();
        if (g_id == '' || g_id == undefined) {
          $(".save_client_facebook_button").show();
          if (msg == 0) {
            $("#second-login-popup #error_useremail").text("* Email Id. Already Exists");
            $("#second-login-popup #error_useremail").css({
              "display": "inline"
            });
          } else if (msg == 1) {
            $("#second-login-popup #error_mobile").text("* Mobile No. Already Exists");
            $("#second-login-popup #error_mobile").css({
              "display": "inline"
            });
          } else if (msg == 2) {
            $("#second-login-popup #error_useremail").text("* Email Id Already Exists");
            $("#second-login-popup #error_useremail").css({
              "display": "inline"
            });
            $("#second-login-popup #error_mobile").text("* Mobile No. Already Exists");
            $("#second-login-popup #error_mobile").css({
              "display": "inline"
            });
          } else {
            $("#saved-info").show().fadeOut(400);
            $("#second-login-popup").modal('hide');
            if (controller == 'Homes') {
              window.location.href = "https://www.xerve.in";
            } else if (controller == 'cashback' && login_type == 1) {
              window.location.href = "https://www.xerve.in/myaccount/upload_bill";
            }
          }
        } else {
          var obj = jQuery.parseJSON(msg);
          var error = obj.error_message;
          var otp_message = obj.otp_message;
          var reason = obj.reason_value;
          $("#f_authenticate_reason").val(reason);
          var mobile_verify = $("#mobile_fac_veri").val();
          var email_verify = $("#email_fac_veri").val();
          if (reason == 'mobile_no_use') {
            if (mobile_verify == 1) {
              var user_id_value = obj.user_id;
              $(".facebook_join_first_phase").hide();
              $("#facebook_confirmation_section").show();
              $("#facebook_intial_id").val(user_id_value);
              $("#second-login-popup .facebook_error_area").html(error);
              $("#second-login-popup .facebook-otp-area").html(otp_message);
              $("#second-login-popup .facebook-otp-area").show();
              $("#second-login-popup .intial_activate_msg").hide();
            } else {
              $("#mobile_fac_veri").val(1);
              $(".facebook_join_first_phase button#save_client_google").text('confirm');
              $(".facebook_join_first_phase button#save_client_google").show();
              $("#second-login-popup .facebook_error_area").html(error);
              $("#second-login-popup .facebook_error_area").css('display', 'inline-block');
              $("#second-login-popup #save_facebook").hide();
              $("#second-login-popup #save_google").show();
              $("#second-login-popup .intial_activate_msg").hide();
            }
          } else if (reason == 'new_account') {
            var user_id_value = obj.user_id;
            $("#facebook_intial_id").val(user_id_value);
            $("#second-login-popup .facebook_error_area").html(error);
            $("#second-login-popup .facebook-otp-area").html(otp_message);
            $("#second-login-popup .facebook-otp-area").show();
            $("#second-login-popup .intial_activate_msg").hide();
            $(".facebook_join_first_phase").hide();
            $("#facebook_confirmation_section").show();
            $("#second-login-popup #save_facebook").hide();
            $("#second-login-popup #save_google").show();
          }
        }
      });
    }
  });
  $('.subgetdrop2').show();
  $('.subgetdrop3').hide();
  $(document).on('click touchstart tap', "#getdrop2", function(event) {
    $('.subgetdrop2').show();
    $('.subgetdrop3').hide();
    $('#getdrop2').addClass("active");
    $('#getdrop3').removeClass("active");
  });
  $(document).on('click touchstart tap', "#getdrop3", function(event) {
    $('.subgetdrop3').show();
    $('.subgetdrop2').hide();
    $('#getdrop3').addClass("active");
    $('#getdrop2').removeClass("active");
  });
  $(document).on('click', '#closenav', function() {
    $(".sidenav").removeClass('navexp');
    var control = $("#ControllerName").val();
    var location = actual_url_address;
    history.pushState({
      page: location
    }, '', location);
    var user = $("#User_Id").val();
    $("#rgtnavscresult").removeClass('_xsdpblock');
    $('body').removeClass('stopscroll');
    $("#rgtnavscresult").addClass('_xsdpnon');
    if (window.innerWidth > 760) {
      if (control == 'Homes') {
        $('header').addClass('home_header');
      }
    }
  })
   $("#gopage,#gpage").click(function() {
    var control = $("#ControllerName").val();
    $("div.main-hover-store").hide();
    var search_keyword = $("#SearchSubCategory").val();
    var section_new_new = $(".sd_frmct_hm ").val();
    var section_new_new1 = $(".sd_frmct_hm").val();
    if (search_keyword != '') {
      if ($('#related_searches').is(':visible')) {
        var section = $(".main_button_for_search a").attr('name');
      } else {
        var section = '';
      }
      search_keyword = search_keyword.replace(/\s*$/, "");
      // alert(control);
      if (control == 'Homes' || control == 'vouchers') {
        $("#related_searches").hide();
        var section = $(".sd_frmct_hm ").val();
        if (section != 'all' && section != undefined && section != '') {
          if (section == 'shop') {
            section = 'prices';
          }
          var for_value = $("#user_type").val();
          if (for_value == '' || for_value == undefined) {
            for_value = 'Personal';
          }
          var sharelatitude = $("#sharelatitude").val();
          var check_name_search = 0;
          if (sharelatitude == '' || sharelatitude == undefined) {
            for (var i = 0; i < list_word_search.length; i++) {
              if (search_keyword.toLowerCase().includes(list_word_search[i])) {
                check_name_search = 1;
              };
            };
          }
          if (check_name_search == 1) {
            share_location_keyword(section, search_keyword);
          } else {
            window.location.href = '/' + section + "?q=" + encodeURIComponent(search_keyword);
          }
          } else {
          suggestions_push(search_keyword);
        }
        // }
      } else if (control == 'Brands') {
        $("#related_searches").hide();
        // alert(user);
        var user = $("#User_Id").val();
        // if(user!=54204){
        var section_text = $(".sd_frmct_hm  :selected").text();
        if (section_text == 'All Sections') {
          section_text = 'All';
        }
        if (section_text != 'All' && section_text != undefined && section_text != '') {
          var section = $(".sd_frmct_hm ").val();
          if (section == 'shop') {
            section = 'prices';
          }
          var for_value = $("#user_type").val();
          if (for_value == '' || for_value == undefined) {
            for_value = 'Personal';
          }
          var sharelatitude = $("#sharelatitude").val();
          var check_name_search = 0;
          if (sharelatitude == '' || sharelatitude == undefined) {
            for (var i = 0; i < list_word_search.length; i++) {
              if (search_keyword.toLowerCase().includes(list_word_search[i])) {
                check_name_search = 1;
              };
            };
          }
          if (check_name_search == 1) {
            share_location_keyword(section, search_keyword);
          } else {
            window.location.href = '/' + section + "?q=" + encodeURIComponent(search_keyword);
          }
        } else {
          suggestions_push(search_keyword);
          $("#related_searches").hide();
        }
      } else if (control == 'leads' || control == 'enquiries' || control == 'pricing') {
        $("#related_searches").hide();
        var section_text = $(".sd_frmct_hm :selected").text();
        if (section_text == 'leads' || section_text == 'leads') {
          var sharelatitude = $("#sharelatitude").val();
          var check_name_search = 0;
          if (sharelatitude == '' || sharelatitude == undefined) {
            for (var i = 0; i < list_word_search.length; i++) {
              if (search_keyword.toLowerCase().includes(list_word_search[i])) {
                check_name_search = 1;
              };
            };
          }
          if (check_name_search == 1) {
            share_location_keyword(section_text, search_keyword);
          } else {
            window.location.href = '/' + section_text + "?q=" + encodeURIComponent(search_keyword);
          }
        } else {
          if (section_text == 'All Sections') {
            section_text = 'All';
          }
          if (section_text != 'All' && section_text != undefined && section_text != '') {
            var section = $(".sd_frmct_hm").val();
            if (section == 'shop') {
              section = 'prices';
            }
            var sharelatitude = $("#sharelatitude").val();
            var check_name_search = 0;
            if (sharelatitude == '' || sharelatitude == undefined) {
              for (var i = 0; i < list_word_search.length; i++) {
                if (search_keyword.toLowerCase().includes(list_word_search[i])) {
                  check_name_search = 1;
                };
              };
            }
            if (check_name_search == 1) {
              share_location_keyword(section, search_keyword);
            } else {
              window.location.href = '/' + section + "?q=" + encodeURIComponent(search_keyword);
            }
          } else {
            suggestions_push(search_keyword);
            $("#related_searches").hide();
          }
        }
      } else if (control == 'reviews') {
        // alert("here");
        var page_type = $("#PageType").val();
        if (page_type == 'details') {
          suggestions_push(search_keyword);
        } else {
          $("#related_searches").remove();
          var section = $(".main_button_for_search a").attr('name');
          if (section == undefined) {
            section = control;
          }
          var view_type = $("input[id='view_value']:last").val();
          if (view_type == '' || view_type == undefined) {
            if ($(window).width() > 640) {
              if (control == 'shop' || control == 'reviews')
                view_type = 'grid';
              else
                view_type = 'list';
            } else {
              view_type = 'list';
            }
          }
          if ($('.search_blocks').is(':visible')) {
            var user_type = $("#" + section + "-pointer-name").attr('name');
            if (user_type == undefined)
              user_type = $("input[id='For']:last").val();
          } else {
            user_type = $("input[id='For']:last").val();
          }
          $.ajax({
            type: "POST",
            url: "/Connect/search_word",
            data: "keyword=" + search_keyword + "&control=" + control + "&For=" + user_type,
          }).done(function(msg) {
            var obj = jQuery.parseJSON(msg);
            // alert(obj);
            var section_new = obj.section;
            if (section_new != 'control') {
              var sharelatitude = $("#sharelatitude").val();
              var check_name_search = 0;
              if (sharelatitude == '' || sharelatitude == undefined) {
                for (var i = 0; i < list_word_search.length; i++) {
                  if (search_keyword.toLowerCase().includes(list_word_search[i])) {
                    check_name_search = 1;
                  };
                };
              }
              if (check_name_search == 1) {
                share_location_keyword(section_new, search_keyword);
              } else {
                window.location.href = '/' + section_new + "?q=" + encodeURIComponent(search_keyword);
              }
            } else {
              var sharelatitude = $("#sharelatitude").val();
              var check_name_search = 0;
              if (sharelatitude == '' || sharelatitude == undefined) {
                for (var i = 0; i < list_word_search.length; i++) {
                  if (search_keyword.toLowerCase().includes(list_word_search[i])) {
                    check_name_search = 1;
                  };
                };
              }
              if (check_name_search == 1) {
                share_location_keyword(section, search_keyword);
              } else {
                window.location.href = '/' + section + "?q=" + encodeURIComponent(search_keyword);
              }
            }
          });
        }
      } else if (control == 'myaccount') {
        $("#related_searches").remove();
        if ($('#related_searches').is(':visible')) {
          var section = $(".main_button_for_search a").attr('name');
        } else {
          var section = $(".sd_frmct_hm ").val();
        }
        if (section == undefined) {
          var section = $(".sd_frmct_hm ").val();
          if (section == undefined)
            section = 'shop';
        }
        if ($(window).width() > 640) {
          if (section == 'shop' || section == 'reviews')
            view_type = 'grid';
          else
            view_type = 'list';
        } else {
          view_type = 'list';
        }
        if ($('#related_searches').is(':visible')) {
          var for_value = $("#" + section + "-pointer-name").attr('name');
        } else {
          var for_value = $("#user_type").val();
        }
        if (for_value == undefined || for_value == '') {
          for_value = 'Personal';
        }
        
        var search_going = $("input[id='search_ongoing_main']").val();
        var selected_option = $(".sd_frmct_hm ").val();
        if (selected_option == undefined)
          selected_option = 'shop';
        if (search_going == 1) {
          var sharelatitude = $("#sharelatitude").val();
          var check_name_search = 0;
          if (sharelatitude == '' || sharelatitude == undefined) {
            for (var i = 0; i < list_word_search.length; i++) {
              if (search_keyword.toLowerCase().includes(list_word_search[i])) {
                check_name_search = 1;
              };
            };
          }
          if (check_name_search == 1) {
            share_location_keyword(section, search_keyword);
          } else {
            window.location.href = '/' + section + "?q=" + encodeURIComponent(search_keyword);
          }
          
        } else {
          var sharelatitude = $("#sharelatitude").val();
          var check_name_search = 0;
          if (sharelatitude == '' || sharelatitude == undefined) {
            for (var i = 0; i < list_word_search.length; i++) {
              if (search_keyword.toLowerCase().includes(list_word_search[i])) {
                check_name_search = 1;
              };
            };
          }
          if (check_name_search == 1) {
            share_location_keyword(selected_option, search_keyword);
          } else {
            window.location.href = '/' + selected_option + "?q=" + encodeURIComponent(search_keyword);
          }
          
        }
      } else {
        var page_type = $("#PageType").val();
        $("#related_searches").hide();
        var section_text = $(".sd_frmct_hm :selected").text();
        if (section_text == 'All Sections') {
          section_text = 'All';
        }
        if (section_text != 'All' && section_text != undefined && section_text != '') {
          var section = $(".sd_frmct_hm").val();
          if (section == 'shop') {
            section = 'prices';
          }
          
          var sharelatitude = $("#sharelatitude").val();
          var check_name_search = 0;
          if (sharelatitude == '' || sharelatitude == undefined) {
            for (var i = 0; i < list_word_search.length; i++) {
              if (search_keyword.toLowerCase().includes(list_word_search[i])) {
                check_name_search = 1;
              };
            };
          }
          if (check_name_search == 1) {
            share_location_keyword(section, search_keyword);
          } else {
            window.location.href = '/' + section + "?q=" + encodeURIComponent(search_keyword);
          }
        } else {
          suggestions_push(search_keyword);
          $("#related_searches").hide();
        }
   
      }
    } else if (section_new_new == 'all' || section_new_new1 == 'all' || section_new_new == '') {
      suggestions_push_click_default();
      console.log(section_new_new);
    } else if (search_keyword == '') {
      $('#SearchSubCategory').css('cssText', 'border-color:#ff0000');
    }
  });
  $('.subgetdrop2').show();
  $('.subgetdrop3').hide();
  $(document).on('click', "#getdrop2", function(event) {
    $('.subgetdrop2').show();
    $('.subgetdrop3').hide();
    $('#getdrop2').addClass("active");
    $('#getdrop3').removeClass("active");
  });
  $(document).on('click', "#getdrop3", function(event) {
    $('.subgetdrop3').show();
    $('.subgetdrop2').hide();
    $('#getdrop3').addClass("active");
    $('#getdrop2').removeClass("active");
  });
  if ($(".mbchat").hasClass("mbchattextbox")) {
    $('.chat_button .btn').css({
      'background': '#0c93f3'
    });
    $('.message-entry input[type="textarea"]').css({
      'border': '1px solid #0c93f3'
    });
  } else {
    $('.chat_button .btn').css({
      'background': '#00b050'
    });
    $('.message-entry input[type="textarea"]').css({
      'border': '1px solid #00b050'
    });
  }
  if (window.innerWidth < 760) {
    $(document).on('click', "#brandbtndesk", function(event) {
      if ($(".main_sc_hd.headermain").hasClass('mbhide')) {
        $(".main_sc_hd.headermain").removeClass('mbhide');
        $("#brandbtndesk").addClass('active');
        $(".search_hd.image-bg.main-section").show();
        $(".marg-tp-company").css({
          "margin-top": "65px"
        });
        $(".marg-tp-offer").css({
          "margin-top": "65px"
        });
        $(".marg-tp-coupon").css({
          "margin-top": "65px"
        });
        $(".marg-tp-other").css({
          "margin-top": "65px"
        });
        $(".marg-tp-coupon.mrgcash").css({
          "margin-top": "65px"
        });
      } else {
        $(".main_sc_hd.headermain").addClass('mbhide');
        $("#brandbtndesk").removeClass('active');
        $(".search_hd.image-bg.main-section").hide();
        $(".marg-tp-company").removeAttr("style");
        $(".marg-tp-company").removeAttr("style");
        $(".marg-tp-offer").removeAttr("style");
        $(".marg-tp-coupon").removeAttr("style");
        $(".marg-tp-other").removeAttr("style");
        $(".marg-tp-coupon.mrgcash").removeAttr("style");
      }
    });
    $(document).on('click', ".store_btn_sort", function(event) {
      if ($(".open.store_sort_menu").hasClass('mbhide')) {
        $(".open.store_sort_menu").removeClass('mbhide');
        $(".store_btn_sort").addClass('active');
      } else {
        $(".open.store_sort_menu").addClass('mbhide');
        $(".store_btn_sort").removeClass('active');
      }
    });
    $(document).on('click', ".store_btn_sort", function(event) {
      if ($(".open.offer_sort_menu").hasClass('mbhide')) {
        $(".open.offer_sort_menu").removeClass('mbhide');
        $(".store_btn_sort").addClass('active');
      } else {
        $(".open.offer_sort_menu").addClass('mbhide');
        $(".store_btn_sort").removeClass('active');
      }
    });
    
    $(function() {
      if (navigator.userAgent.indexOf('Safari') != -1 &&
        navigator.userAgent.indexOf('Chrome') == -1) {
        $("body").addClass("iphonemb");
        $(".modal").addClass("iphonemb");
      }
      
    });
    //  endiphone
    if ($('.inner-top-head').hasClass('top38')) {
      $(".mncol82").css("margin-top", "-80px");
    }
  }
  if (window.innerWidth < 760) {
    $(document).on('click', "#brandbtndesk", function(event) {
      if ($(".main_sc_hd.headermain").hasClass('mbhide')) {
        $(".main_sc_hd.headermain").removeClass('mbhide');
        $("#brandbtndesk").addClass('active');
        $(".search_hd.image-bg.main-section").show();
        $(".marg-tp-company").css({
          "margin-top": "65px"
        });
        $(".marg-tp-offer").css({
          "margin-top": "65px"
        });
        $(".marg-tp-coupon").css({
          "margin-top": "65px"
        });
        $(".marg-tp-other").css({
          "margin-top": "65px"
        });
        $(".marg-tp-coupon.mrgcash").css({
          "margin-top": "65px"
        });
      } else {
        $(".main_sc_hd.headermain").addClass('mbhide');
        $("#brandbtndesk").removeClass('active');
        $(".search_hd.image-bg.main-section").hide();
        $(".marg-tp-company").removeAttr("style");
        $(".marg-tp-company").removeAttr("style");
        $(".marg-tp-offer").removeAttr("style");
        $(".marg-tp-coupon").removeAttr("style");
        $(".marg-tp-other").removeAttr("style");
        $(".marg-tp-coupon.mrgcash").removeAttr("style");
      }
    });
    $(document).on('click', ".store_btn_sort", function(event) {
      if ($(".open.store_sort_menu").hasClass('mbhide')) {
        $(".open.store_sort_menu").removeClass('mbhide');
        $(".store_btn_sort").addClass('active');
      } else {
        $(".open.store_sort_menu").addClass('mbhide');
        $(".store_btn_sort").removeClass('active');
      }
    });
    $(document).on('click', ".store_btn_sort", function(event) {
      if ($(".open.offer_sort_menu").hasClass('mbhide')) {
        $(".open.offer_sort_menu").removeClass('mbhide');
        $(".store_btn_sort").addClass('active');
      } else {
        $(".open.offer_sort_menu").addClass('mbhide');
        $(".store_btn_sort").removeClass('active');
      }
    });
    
    $(function() {
      if (navigator.userAgent.indexOf('Safari') != -1 &&
        navigator.userAgent.indexOf('Chrome') == -1) {
        $("body").addClass("iphonemb");
        $(".modal").addClass("iphonemb");
      }
      
    });
    //  endiphone
    if ($('.inner-top-head').hasClass('top38')) {
      $(".mncol82").css("margin-top", "-80px");
    }
  }
  $(".normal_li").mouseleave(function() {
    $(".show_maHHSSSS").find('.title_for_sectn_header2').css('cssText', 'color:#fff');
    $(".show_maHHSSSS").find('#share-location-button img').attr("src", "/img/pin-black.png");
  });
  $(".loginnav .closebtn").hide();

$(window).scroll(function() {
    if ($('body').scrollTop() > 100) {
      $("ul.link_ul_myaccount").hide();
    } else {
      $("ul.link_ul_myaccount").show();
    }
  });
  $(".right-hold h6 span").removeClass("caret_header");
  $(".right-hold h6 span").addClass("glyphicon glyphicon-menu-down");
  $(".li_show_instock_side").addClass("active");

  $(document).on('click', "li[id='cashlsthd'] .list-hd", function(event) {
    $(this).closest('li#cashlsthd').find('.list-des').toggle();
  });
  /***/
  $(document).on('click', '#Search_Preview', function() {
    $("#preview_enter_key").val(1);
    google_suggestion_preview();
    suggestions_preview();
  });

$(document).on("keyup", "#Search_Preview", function(e) {
    var user = $("#User_Id").val();
    var control = $("#ControllerName").val();
    var search_keyword = $("#Search_Preview").val();
    if ((e.keyCode >= 48 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || (e.keyCode == 8) || (e.keyCode >= 186 && e.keyCode <= 222) && e.keyCode != 13) {
      $("#preview_enter_key").val(1);
      if (search_keyword != '') {
        if (typeof timeoutbrand3 == "number") {
          window.clearTimeout(timeoutbrand3);
          delete timeoutbrand3;
        }
        timeoutbrand3 = window.setTimeout(google_suggestion_preview, 500); //1500
      }
      if (search_keyword != '') {
        if (typeof timeoutbrand == "number") {
          window.clearTimeout(timeoutbrand);
          delete timeoutbrand;
        }
        timeoutbrand = window.setTimeout(suggestions_preview, 500); //1500
      }
    }
    if (e.keyCode == 13 && control != '' && search_keyword != '') {
      $("#preview_enter_key").val(0);
      var customer = $("#for_value").val();
      var control = $("#ControllerName").val();
      var main_control = $("#ControllerName").val();
      var txt = $("#Search_Preview").val();
      if (control == 'search') {
        window.location.href = "/search?q=" + encodeURIComponent(txt);
      } else {
        var view_type = $("input[id='view_value']:last").val();
        if (view_type == '' || view_type == undefined) {
          if ($(window).width() > 640) {
            if (control == 'shop' || control == 'reviews')
              view_type = 'grid';
            else
              view_type = 'list';
          } else {
            view_type = 'list';
          }
        }
        $("#related_searches_paren_preview").hide();
        $("#sea_main_section_all").html('<div class="loading_image_selection" style="margin: 0px auto; position: absolute; opacity: 1; z-index: 3000; background-color: rgb(255, 255, 255); text-align: center; vertical-align: middle; width: 200px; height: 51px; padding-top: 18px; border-radius: 5px; left: 0px; right: 0px; bottom: 0px; top: 40%;display:block;"><img src="/img/loading_company.gif" class="img-responsive"></div>');
        abort();
        req_sugg = $.ajax({
          type: "POST",
          url: "/Connect/suggestions_search_push",
          data: "txt=" + encodeURIComponent(txt) + "&customer=" + customer + "&control=" + control + "&viewlist=" + view_type + "&main_control=" + main_control + "&method=push&method_value=preview",
          success: "success",
          dataType: 'text',
          async: true,
          beforeSend: function() {},
          success: function(msg) {
            $("#related_searches_paren_preview").hide();
            $("#rgtnavscresult").html(msg);
            $("#close-search").html('<span class="sd_close-img"><i class="glyphicon glyphicon-remove-circle"></i></span>');
          }
        });
      }
    }
  });

 var controller_name = $("#ControllerName").val();
  $("#main_search_form").submit(function(e) {
    var user = $("#User_Id").val();
    var lock_flag = $("#lock_flag").val();
    if (controller_name == 'reviews') {
      var search_keyword = $("#SearchSubCategory").val();
      var page_type = $('#PageType').val();
      if (page_type == 'details') {
        $("#related_searches").hide();
        var section_text = $(".sd_frmct_hm :selected").text();
        if (section_text == 'All Sections') {
          section_text = 'All';
        }
        if (section_text != 'All' && section_text != undefined && section_text != '') {
          var section = $(".sd_frmct_hm").val();
          
          if (section == 'shop') {
            section = 'prices';
          }
          window.location.href = '/' + section + "?q=" + encodeURIComponent(search_keyword);
        } else {
          suggestions_push(search_keyword);
          $("#related_searches").hide();
        }
      } else {
        e.preventDefault();
        var section = $(".sd_frmct_hm").val();
        var section_text = $(".sd_frmct_hm :selected").text();
        
        if (section_text != 'All' && section_text != undefined && section_text != '') {
          if (section == '' || section == undefined) {
            var section = $("#ControllerName").val();
          }
          
          var view_type = $("input[id='view_value']:last").val();
          var user_type = $("input[id='For']:last").val();
          
          if (section == 'shop') {
            section = 'prices';
          }
          window.location.href = '/' + section + "?q=" + encodeURIComponent(search_keyword);
        } else {
          suggestions_push(search_keyword);
          $("#related_searches").hide();
        }
        if (lock_flag == 1) {
          $("#related_searches").remove();
        }
      }
      
    } else {
      return true;
    }
  });
  /**/
    $("li.padding-nil").mouseenter(function() {
    if (!$(this).hasClass('li-header-camel-left')) {
      var user = $("#User_Id").val();
      var image_value = $(this).find('img').attr('src');
      var image_name = image_value.split('/img/');
      var image = image_name[1];
      var image_part = image.split('-');
      var image_src = image_part[0] + '-white.png';
      var image_src_main = '/img/' + image_src;
      $(this).find('img').attr('src', image_src_main);
      $(this).find('.title_for_sectn_header2').css('cssText', 'color:#fff');
    }
  });
  $("li.padding-nil").mouseleave(function() {
    var user = $("#User_Id").val();
    if (!$(this).hasClass('li-header-camel-left')) {
      var image_value = $(this).find('img').attr('src');
      var image_name = image_value.split('/img/');
      var image = image_name[1];
      var image_part = image.split('-');
      var image_src = image_part[0] + '-white.png';
      var image_src_main = '/img/' + image_src;
      var show_allHH = $(this).find("#show_all_loc_shahh").val();
      if (show_allHH != 1) {
        $(this).find('img').attr('src', image_src_main);
        $(this).find('.title_for_sectn_header2').css('cssText', 'color:#fff');
      }
    }
  });
  //for  the half header elements
  $("li.padding-nil div").mouseenter(function() {
    if ($(this).hasClass('for-personal-in-header')) {
      // alert('working');
      var image_value = $('li.padding-nil .for-personal-in-header').find(' img').attr('src');
      var image_name = image_value.split('/img/');
      var image = image_name[1];
      var image_part = image.split('-');
      var image_src = image_part[0] + '-white.png';
      var image_src_main = '/img/' + image_src;
      $('li.padding-nil .for-personal-in-header').find('img').attr('src', image_src_main);
    }
    if ($(this).hasClass('for-business-in-header')) {
      var image_value = $('li.padding-nil .for-business-in-header').find('img').attr('src');
      var image_name = image_value.split('/img/');
      var image = image_name[1];
      var image_part = image.split('-');
      var image_src = image_part[0] + '-white.png';
      var image_src_main = '/img/' + image_src;
      $('li.padding-nil .for-business-in-header').find('img').attr('src', image_src_main);
    }
   
  });
  $("li.padding-nil div").mouseleave(function() {
    if ($(this).hasClass('for-personal-in-header')) {
      var image_value = $('li.padding-nil .for-personal-in-header').find(' img').attr('src');
      var image_name = image_value.split('/img/');
      var image = image_name[1];
      var image_part = image.split('-');
      var image_src = image_part[0] + '-white.png';
      var image_src_main = '/img/' + image_src;
      $('li.padding-nil .for-personal-in-header').find('img').attr('src', image_src_main);
    }
    if ($(this).hasClass('for-business-in-header')) {
      var image_value = $('li.padding-nil .for-business-in-header').find('img').attr('src');
      // alert(image_value);
      var image_name = image_value.split('/img/');
      var image = image_name[1];
      var image_part = image.split('-');
      var image_src = image_part[0] + '-white.png';
      var image_src_main = '/img/' + image_src;
      $('li.padding-nil .for-business-in-header').find('img').attr('src', image_src_main);
    }
    
  });
  $('.push_notification_area').mouseleave(function() {
    $('.main_notification ').css({
      'display': 'none'
    });
  });
  $('.main-section.mbhide').mouseleave(function() {
    $('.store_sort_menu').css({
      'display': 'none'
    });
  });
  $('.main-section.mbhide').mouseleave(function() {
    $('.offer_sort_menu').css({
      'display': 'none'
    });
  });

});

var google_request;
var actual_url_address;
//review-show
var list_word_search = ["near me", "nearby", "nearme", "around me"];
$('.write-coment').click(function() {
  $('.write-feedback').slideDown();
  $(this).hide();
});
$("#close-search").on('click', function() {
  $("#SearchSubCategory").focus();
});
$('.download-model ul li').click(function() {
  $('.download-model .registered').slideDown();
  $('.download-model ul').addClass('inc-marg');
});
//checkbox
$('.edit-btn-new').click(function() {
  $(this).hide();
  $(this).parent('.inr').find('.view-pos').css('display', 'inline-block');
  $(this).parent('.inr').find('.save-btn-new').css('display', 'inline-block');
  $(this).parent('.inr').find('.edit-rp').addClass('div-edit-hold').attr('contenteditable', 'true').focus();
  $(this).parent('.left-head-report').find('.inr').fadeIn('');
});
$('.save-btn-new').click(function() {
  $(this).hide();
  $(this).parent('.inr').find('.view-pos').css('display', 'none');
  $(this).parent('.inr').find('.edit-btn-new').show();
  $(this).parent('.inr').find('.view-pos').hide();
  $(this).parent('.inr').find('.edit-rp').removeClass('div-edit-hold').attr('contenteditable', 'false');
});
//read more
$('.read-more').click(function() {
  $('.review-more').slideDown();
  $(this).hide();
  $('.read-less').show();
});
$('.read-less').click(function() {
  $('.review-more').slideUp();
  $(this).hide();
  $('.read-more').fadeIn();
});
//quotes-arrow-up&down
$('a.right-float, .continue,a.panel-heading').click(function() {
  $('span.glyphicon').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
  if ($(this.hash).css('display') != 'block')
  {
    $(this).find('span.glyphicon').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up')
  }
});
//accounts inner
$('.account-arrow-one').click(function() {
  $(this).hide();
  $('.account-arrow-two').show();
  $('.left-acc').addClass('kill-me');
});
$('.account-arrow-two').click(function() {
  $(this).hide();
  $('.account-arrow-one').show();
  $('.left-acc').removeClass('kill-me');
  $("#filter").removeClass("act-icon");
});
//mobile header customisation harini
$('#filter,.glyphicon-filter').click(function() {
  $(this).show();
  $('.account-arrow-two').show();
  $(this).parents().siblings('.image-bg').fadeOut(); // search option to fadeout
  $(this).parents().siblings('.second-heading').fadeOut(); //sections to fadeout
  $("#sections,#search").removeClass("act-icon");
  if ($(this).hasClass("act-icon")) {
    $(this).removeClass("act-icon");
    $('.left-acc').removeClass('kill-me'); // filter
    $('.custom-aside').removeClass('going').addClass('coming');
    $("body").removeClass('scroll');
    $('.pull-me').css('display', 'none');
  } else {
    $(this).addClass("act-icon");
    $('.left-acc').addClass('kill-me'); // filter
    // company pages
    $('.custom-aside').addClass('going').removeClass('coming');
    $('.pull-me').css('display', 'block')
    $("div.sort_section").addClass('open');
  }
});
$('#search,.glyphicon-search').click(function() {
  $(this).parents().siblings('.second-heading').fadeOut(); //sections
  $('.left-acc').removeClass('kill-me'); // filter
  $("#filter,#sections").removeClass("act-icon");
  $('.custom-aside').removeClass('going').addClass('coming');
  $("body").removeClass('scroll');
  if ($(this).hasClass("act-icon")) {
    $(this).removeClass("act-icon");
    $(".image-bg").slideUp();
    $(".pull-up-hold").slideUp();
    $('.pull-up').css('display', 'none');
    
  } else {
    $(this).addClass("act-icon");
    $(".image-bg").slideDown();
    $(".camel-bg").hide();
    $(".pull-up-hold").slideDown();
  
  }
});
$("#sections,.glyphicon-th-list").click(function() {
  
  $('.left-acc').removeClass('kill-me'); // filter
  $('.custom-aside').removeClass('going').addClass('coming');
  $("body").removeClass('scroll');
  $('.pull-me').css('display', 'none');
  $(this).parents().siblings('.image-bg').fadeOut(); // search
  $("#filter,#search").removeClass("act-icon");
 
  if ($(this).hasClass("act-icon")) {
    $(this).removeClass("act-icon").addClass('inact-icon');
    $(".camel-bg").slideUp();
    $('.pull-up').css('display', 'none');
    $(".pull-up-hold").slideUp();
    
  } else {
    $(this).removeClass("inact-icon").addClass("act-icon");
    $(".pull-up-hold").slideDown();
    $(".camel-bg").slideDown();
    $(".image-bg").hide();
  }
});
$(".serch").click(function() {
  $(this).parents('.image-bg').fadeOut(); // search
  $(this).parents('.second-heading').fadeOut(); //sections
  $('.left-acc').removeClass('kill-me'); // filter
  $("#search,#sections,#filter").removeClass("act-icon");
});

//see-more
$('.see-more').click(function() {
  $('.hidden-para').slideDown();
  $(this).hide();
  $('.less').show();
});
$('.less').click(function() {
  $(this).hide();
  $('.hidden-para').slideUp();
  $('.see-more').show();
});
//login-show
$('#login-drop,.login-image').click(function(e) {
  e.preventDefault();
  $("#User_Id")
  $('.front').removeClass('front-change');
  $('.f2_container').removeClass('f2-change');
  $('.back').removeClass('back-change');
  $("#bill_upload_value").val(0);
  setTimeout(function() {
    $(".main-log").removeClass('show-login');
  }, 6000)
});
$(document).click(function(e) {
  if (!$(e.target).is('.main,#login-drop,.login-image,.client_side_info,.client_side_info .seller_child,.client_side_info .seller_child a')) {
    $(".main").removeClass('show-login');
  }
  if (!$(e.target).is('.menu-title-hold,.menu-title,.nav-dissaper,.menu-sub a,.menu-title-hold a,.f2_container div,.f2_container h3,.f2_container h4,.f2_container input,.f2_container button,.f2_container span')) {
    $('.gn-menu-wrapper').removeClass('gn-open-all');
    $('.menu-close').hide();
    $('.text-menu,.push-me,.icon-bar,#push-me').fadeIn();
    setTimeout(function()
      {
        $('.mymenu').removeClass('mymenu_show');
      }, 800);
    $('.menu-icon').show(1000);
  }
});
if ($(window).width() > 1200) {
  //pull-up and down in large screen only
  // alert("here");
  var lastScrollTop = 50;
  $(window).scroll(function(event) {
    var st = $(this).scrollTop();
    if (st > lastScrollTop) {
      $('.header').addClass('slide--up');
      $('.pull-up-lg').fadeOut();
      var controller = $("#ControllerName").val();
      if (controller != 'Homes') {
        $(".navbar ").slideUp();
      }
      $('.pull-down-lg').fadeIn();
      $('.only-lg').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
      $('.header').removeClass('slide--reset');
      $('.pointer-active').fadeOut();
      $('.header').addClass('move-up');
      $(".header-second-navbar").css('top', '144px');
      $(".store_sort_menu").css('top', '98px');
      $(".offer_sort_menu").css('top', '98px');
      var filename = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
      var pathArray = window.location.pathname.split('/');
      var length = pathArray.length;
      var filename = pathArray[2];
      if (filename != '' && filename != undefined && filename != 'price') {
        str = filename.slice(0, 4);
        str2 = filename.slice(0, 6);
        if (str == 'XRVO' || str == 'XRVOS' || str2 == 'XRVCOU' || str2 == 'XRVCOU' || str == 'XRVA') {
        }
      } else if (filename == 'price' && controller == 'shop') {
        // $(".pull-up-hold").css('margin-top','28px');
        // $(".pull-up-hold .padding-0 ").slideUp();
      }
      if (length > 5) {
        $(".pull-up-hold .padding-0 ").slideUp();
      }
      } else {
      var controller = $("#ControllerName").val();
      var filename = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
      var pathArray = window.location.pathname.split('/');
      var length = pathArray.length;
      var filename = pathArray[2];
      if (filename != '' && filename != undefined && filename != 'price') {
        str = filename.slice(0, 4);
        str2 = filename.slice(0, 6);
        if (str == 'XRVO' || str == 'XRVOS' || str2 == 'XRVCOU' || str2 == 'XRVCOU' || str == 'XRVA') {
        }
       } else if (filename == 'price' && controller == 'shop') {
       }
      $('.header').removeClass('slide--up');
      $('.header').addClass('slide--reset');
      $('.pull-down-lg').fadeOut();
      $('.pointer-active').fadeIn()
      $(".navbar ").slideDown();
      $(".pull-up-hold .padding-0 ").slideDown();
      $('.header').removeClass('move-up');
      $(".header-second-navbar").css('top', '141px');
      $(".store_sort_menu").css('top', '155px');
      $(".offer_sort_menu").css('top', '158px');
      }
    lastScrollTop = st;
  });
  $('.pull-down-lg').click(function() {
    if ($('.header').hasClass('slide--reset')) {
      $('.header').addClass('slide--up');
      $('.header').removeClass('slide--reset');
      $('.pointer-active').fadeOut();
      $('.header').removeClass('move-up');
    } else if ($('.header').hasClass('slide--up')) {
      $('.header').removeClass('slide--up');
      $('.header').addClass('slide--reset');
      $('.pointer-active').fadeIn()
      $('.header').removeClass('move-up');
      $('.pull-down-lg').hide();
    }
  });
}
if ($(window).width() <= 1200) {
  //pull-up and down in large screen only
  var lastScrollTop = 50;
  $(window).scroll(function(event) {
    var st = $(this).scrollTop();
    var filename = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
    var pathArray = window.location.pathname.split('/');
    var length = pathArray.length;
    if (st > lastScrollTop) {
      var controller = $("#ControllerName").val();
      if (controller != 'Homes') {
        $(".navbar ").slideUp();
        if (length > 5)
          $(".pull-up-hold .padding-0 ").slideUp();
      }
      $(".header-details").addClass("visible-xs");
      $('.header').addClass('slide--up');
      $('.pull-down-lg').fadeOut();
      if (!$(".image-bg").is(":visible")) {
        $('.pull-down-lg').fadeOut();
        $(".image-bg").hide();
      }
      if (window.innerWidth < 760) {
        $(".store_sort_menu").css('top', '34px');
        $(".close-cover-sort").css('top', '96px');
        $(".offer_sort_menu").css('top', '82px');
        $(".close-cover-sortother").css('top', '118px');
      }
      if (window.innerWidth > 760 && window.innerWidth < 980) {
        $(".store_sort_menu").css('top', '94px');
        $(".close-cover-sort").css('cssText', '94px!important');
        $(".offer_sort_menu").css('top', '61px');
        $(".close-cover-sortother").css('top', '97px');
      }
      if (window.innerWidth > 980 && window.innerWidth < 1199) {
        $(".store_sort_menu").css('top', '132px');
        $(".close-cover-sort").css('top', '132px');
        $(".offer_sort_menu").css('top', '99px');
        $(".close-cover-sortother").css('top', '89px');
      }
      
    } else {
      $('.header').removeClass('slide--up');
      $('.header').addClass('slide--reset');
      $(".navbar ").slideDown();
      if (length > 5)
        $(".pull-up-hold .padding-0 ").slideDown();
      $(".header-details").addClass("visible-xs");
      if (!$(".image-bg").is(":visible")) {
        $(".image-bg").hide();
        $('.camel-bg').slideDown();
        $(".image-bg").slideDown();
        $(".pull-up-hold").slideDown().css({
          "height": "110px"
        });
      }
      if (window.innerWidth < 760) {
        $(".offer_sort_menu").css('top', '168px');
      }
      if (window.innerWidth > 760 && window.innerWidth < 980) {
        $(".offer_sort_menu").css('top', '161px');
        $(".store_sort_menu").css('top', '194px');
      } else if (window.innerWidth > 980 && window.innerWidth < 1199) {
        $(".store_sort_menu").css('top', '212px');
        $(".offer_sort_menu").css('top', '175px');
      } else {
        $(".store_sort_menu").css('top', '120px');
      }
      $(".close-cover-sort").css('top', '180px');
      $(".close-cover-sortother").css('top', '210px');
    }
    lastScrollTop = st;
  });
}
//show-more
$('#show-more').click(function() {
  $('.verification-details-hold').slideDown('500');
});
//flip
$('#select-vendor, .join-btn-2,.login-vendor,.seller-diff').click(function() {
  $('.front').addClass('front-change');
  $('.f2_container').addClass('f2-change');
  $('.back').addClass('back-change');
  $("#bill_upload_value").val(0);
});
$('#select-client, .join-btn, .login-client,.buyer-diff').click(function() {
  $('.front').removeClass('front-change');
  $('.f2_container').removeClass('f2-change');
  $('.back').removeClass('back-change');
  $("#bill_upload_value").val(0);
});
$('#coupon_skip_step').click(function() {
  $('.front-coupon').addClass('front-change');
  $('.f2_container-coupon').addClass('f2-change');
  $('.back-coupon').addClass('back-change');
});
//compare page height calculate
$(window).load(function() {
  if (window.innerWidth > 767) {
    $('.first-sec ul').each(function() {
      var highestBox = 0;
      $('li', this).each(function() {
        if ($(this).height() > highestBox) {
          highestBox = $(this).height();
        }
      });
      $('li', this).height(highestBox);
    });
  } else {
  }
});
$('.top-hold-right ul').each(function() {
  var highestBox1 = 0;
  $('.company-listing', this).each(function() {
    if ($(this).height() > highestBox1) {
      highestBox1 = $(this).height();
    }
  });
  $('.company-listing', this).height(highestBox1);
});
$(window).scroll(function() {
  if ($(this).scrollTop() > 80) {
    $('.pos-fixed').addClass('drag-me-up')
  } else {
    $('.top-hold-right').removeClass('drag-me-up')
  }
});
$("#scroll-top-menu").hide();
$("#scroll-top-sort").hide();
$("#scroll-top-filter").hide();
$("#scroll-top-filter-shop").hide();

$(function() {
  $(window).scroll(function() {
    var section = $("input[id=view_value]:last").val();
    if ($(this).scrollTop() > 100) {
 
      if (window.innerWidth > 1199) {
        $("#scroll-top-menu").fadeIn();
      }
      $("#scroll-top-sort").fadeIn();
      if (window.innerWidth < 1199) {
        $("#scroll-top-filter").fadeIn();
        $("#scroll-top-filter-shop").fadeIn();
      
        var controller = $("#ControllerName").val();
        if (controller == 'shop' || controller == 'offers' || controller == 'coupons' || controller == 'cashback' || controller == 'reviews' || controller == 'companies') {
          $("#scroll-top-menu").show();
          $("#scroll-top-menu").css("bottom", "116px");
          $("#scroll-top-filter-shop").css("bottom", "70px");
        
        } else {
          $("#scroll-top-menu").hide();
          $("#scroll-top-filter").css("bottom", "116px");
        }
      
      }
    } else {
      $('#scroll-top').fadeOut();
      $(".store_product_menu").hide();
      $(".close-cover-search").css('cssText', 'display:none!important');
      $(".close-cover-searchSide").css('cssText', 'display:none!important');
 
      $(".header-second-navbar").css('top', '141px');
      $("#scroll-top-sort").fadeOut();
     
      if (window.innerWidth < 1199) {
        $("#scroll-top-menu").fadeOut();
        $("#scroll-top-filter").fadeOut();
        $("#scroll-top-filter-shop").fadeOut();
      }
      if (window.innerWidth > 1199) {
        $("#scroll-top-menu").fadeOut();
      }
    }
  });
  //smooth scroll
  $('#scroll-top').click(function() {
    $('body,html').animate({
      scrollTop: 0
    }, 800);
    return false;
  })
});
function gnMenu() {
}

function ValidateMobile(mobile) {
  var expr = /^[1-9]{1}[0-9]{9}$/;;
  return expr.test(mobile);
}

function ValidateEmail(email) {
  var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
  return expr.test(email);
};

//price page
if (window.innerWidth < 2000) {
  $('.head-price, .head-value').click(function() {
    if ($(this).hasClass('price-down')) {
      $(this).parent('ul').find($('li')).addClass('show-li').removeClass('hide-li');
      $(this).removeClass('price-down').addClass('price-up');
    } else if ($(this).hasClass('price-up')) {
      $(this).parent('ul').find($('li')).addClass('hide-li').removeClass('show-li');
      $(this).addClass('price-down').removeClass('price-up');
    }
  });
}
//leads page
function show_details(enq)
{
  if ($("#show" + enq).hasClass('show-me')) {
    $("#hidden_msg" + enq).addClass('none_height').removeClass('fixed_height');
    $("#info" + enq).slideDown('slow');
    $("#show" + enq).html("Less Details").addClass('no-me').removeClass('show-me');
  } else
  {
    $("#hidden_msg" + enq).addClass('fixed_height').removeClass('none_height');
    $("#info" + enq).slideUp('slow');
    $("#show" + enq).html("View Details").addClass('show-me').removeClass('no-me');
  }
}


//company page
if (window.innerWidth <= 1200) {
  $('.first-sub-head').click(function() {
    $(this).parent('.bottom-hold .first-sec').find('.first-sub-body').slideToggle();
  });
}
//mobile effects
$('.push-me').click(function() {
  $('.custom-aside').addClass('going').removeClass('coming');
  $('.pull-me').css('display', 'block');
  $('.push-me').css('display', 'none');
  $("div.sort_section").addClass('open');
});
$('.pull-up').click(function() {
  $('.header.header--fixed').addClass('move-up');
  $(this).hide();
  $('.pull-down').show()
});
$('.pull-down').click(function() {
  $('.header.header--fixed').removeClass('move-up');
  $(this).hide();
  $('.pull-up').show()
});
$(function() {
  $("[data-toggle='tooltip']").tooltip();
});
$('.like').click(function() {
  if ($(this).hasClass("not-like")) {
    $(this).addClass("clicked").removeClass("not-like");
  } else if ($(this).hasClass("clicked")) {
    $(this).removeClass("clicked").addClass("not-like");
  }
});
$(document).on('click', function(e) {
  if (!$(e.target).is('input[type="radio"],label,#gpage,#gopage,#rgtnavscresult,#mySidenav,#mySidenav div,#mySidenav h1,#mySidenav center,#mySidenav a,#mySidenav span,#mySidenav p,#mySidenav i,#mySidenav img,._hmcmpbtn,#other_subgenie #main_title,.search_preview *,#share-location-login-popup-leads_myloc1,#otp_verify_form,#share-location-login-popup-leads_myloc1 *,#otp_verify_form *,.login-popup *,#login-popup-vendors *,#client_signin_main *,#top_catowl *,genie_contianer *,#inner_preview_search *')) {
    $("#rgtnavscresult").removeClass('_xsdpblock');
    $('body').removeClass('stopscroll');
    $("#rgtnavscresult").addClass('_xsdpnon');
  }
	
  if (!$(e.target).is('.main_notification_guest,.main_notification_guest p,.main_notification_guest b,.main_notification_guest span,.glyphicon-bell-notifi-guest,.glyphicon-bell-notifi')) {
    $('.main_notification_guest').hide();
  }
  if (!$(e.target).is('.home_notification,.fa-bell,.notify_cnt,#notificate,#plus99,#notification_section,.glyphicon,.home_notification dd,.home_notification div,.cb-enable span, .cb-disable span')) {
    $(".home_notification").hide();
    $(".home_notification").addClass("no-dis");
  }
  if (!$(e.target).is('.scroll-tab,.scroll-tab .options,.scroll-tab ul,.scroll-tab li,.scroll-tab a,.scroll-tab div,.scroll-tab h3,.scroll-tab span,.custom-aside,.option-head,#bottom_ctr,#filter_mobile,#scroll-top-filter,#scroll-top-filter img,#scroll-top-filter-shop,#scroll-top-filter-shop img,.filter-button-desktop,.filter-button-desktop a,.filter-button-desktop a span , .filter-button-desktop img,.select_hold,.select_hold .value_btn,.select_hold .value_btn_mobile,.select_hold button,.select_hold button i,.modal-backdrop,.filter_button_mobile')) {
    $('.custom-aside').removeClass('going').addClass('coming');
    $('.pull-me').css('display', 'none');
    $("body").removeClass('scroll');
  } else {
    $("div.sort_section").addClass('open');
  }
  if (!$(e.target).is('.home_notification_brand,#notification_section_brand,.glyphicon,.notification_section_brand dd,.notification_section_brand div,.home_notification_brand li,home_notification_brand li a, .home_notification_brand *')) {
    $(".home_notification_brand").hide();
    $(".home_notification_brand").addClass("no-dis");
  }
  if (!$(e.target).is('#related_searches,#related_searches div,#related_searches ul,#related_searches span,#related_searches li,.related_searches,.subelement-for-homesearch-suggest-title,.suggestion_list_element,.suggestion_highlight_normal,#google_suggest,#SearchSubCategory,.store_overall_searchmain,.store_overall_searchmain a,.store_overall_searchmain .element-for-homesearch, .store_overall_searchmain .element-for-homesearch span,.show_more_search_button,.arrow-image,.arrow-image img,#sub_header_type_personal_home_search_shop a,#sub_header_type_personal_home_search_shop p,#sub_header_type_business_home_search_shop a,#sub_header_type_business_home_search_shop p,#sub_header_type_personal_home_search_offers a, #sub_header_type_personal_home_search_offers p,#sub_header_type_business_home_search_offers a,#sub_header_type_business_home_search_offers p, #sub_header_type_personal_home_search_offers p,#sub_header_type_personal_home_search_coupons a, #sub_header_type_personal_home_search_coupons p,#sub_header_type_business_home_search_coupons p,#sub_header_type_business_home_search_coupons a, #sub_header_type_personal_home_search_coupons p,#sub_header_type_personal_home_search_cashback a , #sub_header_type_personal_home_search_cashback p,#sub_header_type_business_home_search_cashback a,#sub_header_type_business_home_search_cashback p , #sub_header_type_personal_home_search_cashback p,#sub_header_type_personal_home_search_reviews a , #sub_header_type_personal_home_search_reviews p,#sub_header_type_business_home_search_reviews a , #sub_header_type_business_home_search_reviews p,#sub_header_type_personal_home_search_company a, #sub_header_type_personal_home_search_company p,#sub_header_type_business_home_search_company p,#sub_header_type_business_home_search_company a,#sub_header_type_personal_home_search_company p,.show_more_section,.total-count-section,.suggestions_block,.suggestion_list,.suggestion_list li,.redirect_path_search,.redirect_path_search .search_blocks,.redirect_path_search .search_blocks li,.redirect_path_search li a,.suggestions_block,.suggestions_block .suggestion_list,.suggestions_block .suggestion_list ul,.suggestions_block .suggestion_list ul li, .suggestions_block .suggestion_list ul li a, .suggestions_block .suggestion_list ul li a span,.element-for-homesearch,.element-for-homesearch span,.sd_frmct_hm ,.sd_frmct_hm  option')) {
   
    if ($(e.target).is('#owl-demo-home .item')) {
      if ($('#related_searches').is(":hidden")) {
        $("#related_searches").hide();
      }
    } else {
      $("#related_searches").hide();
    }
  } else {
    var q = $('#SearchSubCategory').val();
    if (q.length >= 2) {
      $("#related_searches").show();
    }
  }
  if (!$(e.target).is('#related_searches,#related_searches div,#related_searches ul,#related_searches span,#related_searches li,.related_searches,.subelement-for-homesearch-suggest-title,.suggestion_list_element,.suggestion_highlight_normal,#google_suggest,#SearchSubCategory,.store_overall_searchmain,.store_overall_searchmain a,.store_overall_searchmain .element-for-homesearch, .store_overall_searchmain .element-for-homesearch span,.show_more_search_button,.arrow-image,.arrow-image img,#sub_header_type_personal_home_search_shop a,#sub_header_type_personal_home_search_shop p,#sub_header_type_business_home_search_shop a,#sub_header_type_business_home_search_shop p,#sub_header_type_personal_home_search_offers a, #sub_header_type_personal_home_search_offers p,#sub_header_type_business_home_search_offers a,#sub_header_type_business_home_search_offers p, #sub_header_type_personal_home_search_offers p,#sub_header_type_personal_home_search_coupons a, #sub_header_type_personal_home_search_coupons p,#sub_header_type_business_home_search_coupons p,#sub_header_type_business_home_search_coupons a, #sub_header_type_personal_home_search_coupons p,#sub_header_type_personal_home_search_cashback a , #sub_header_type_personal_home_search_cashback p,#sub_header_type_business_home_search_cashback a,#sub_header_type_business_home_search_cashback p , #sub_header_type_personal_home_search_cashback p,#sub_header_type_personal_home_search_reviews a , #sub_header_type_personal_home_search_reviews p,#sub_header_type_business_home_search_reviews a , #sub_header_type_business_home_search_reviews p,#sub_header_type_personal_home_search_company a, #sub_header_type_personal_home_search_company p,#sub_header_type_business_home_search_company p,#sub_header_type_business_home_search_company a,#sub_header_type_personal_home_search_company p,.show_more_section,.total-count-section,.suggestions_block,.suggestion_list,.suggestion_list li,.redirect_path_search,.redirect_path_search .search_blocks,.redirect_path_search .search_blocks li,.redirect_path_search li a,.suggestions_block,.suggestions_block .suggestion_list,.suggestions_block .suggestion_list ul,.suggestions_block .suggestion_list ul li, .suggestions_block .suggestion_list ul li a, .suggestions_block .suggestion_list ul li a span,.element-for-homesearch,.element-for-homesearch span,.sd_frmct_hm ,.sd_frmct_hm  option')) {
    
    if ($(e.target).is('#owl-demo-home .item')) {
      if ($('#related_searches').is(":hidden")) {
        $("#related_searches").hide();
      }
    } else {
      $("#related_searches").hide();
    }
  }
});

function getnotification() {
  var for_value = $("#for_value").val();
  var order = order;
  var customer = '';
  var controller = $("#ControllerName").val();
  if (for_value == 'Business') {
    customer = 2;
  } else {
    customer = 1;
  }
  if ($(".home_notification").hasClass('no-dis')) {
    $("#notifi-drop").hide();
    $("#load_notify").show();
    $("#plus99").hide();
    $.ajax({
      type: "POST",
      url: "/Connect/getnotification",
      data: "customer=" + customer + "&controller=" + controller,
      success: "success",
      dataType: 'text',
      context: document.body
    }).done(function(msg) {
      $("#notifi-drop").show();
      $("#load_notify").hide();
      $("#notification_section").html(msg);
      $("#home_notification").show();
      var store_radar = $("#store_radar").val();
      var offer_radar = $("#offer_radar").val();
      var review_radar = $("#review_radar").val();
      var store_radar = $("#store_radar").val();
      if (parseInt(store_radar) > 0)
        $("#notify_store").text(parseInt(store_radar)).show();
      if (parseInt(offer_radar) > 0)
        $("#notify_offer").text(parseInt(offer_radar)).show();
      if (parseInt(review_radar) > 0)
        $("#notify_review").text(parseInt(review_radar)).show();
      if (parseInt(coupon_radar) > 0)
        $("#notify_coupon").text(parseInt(coupon_radar)).show();
      if ($(".home_notification").hasClass('no-dis')) {
        $(".home_notification").slideDown("slow");
        $(".home_notification").removeClass("no-dis");
      }
    });
  } else {
    $(".home_notification").slideUp("slow");
    $(".home_notification").addClass("no-dis");
  }
  $("#notify_cnt").hide();
  var current = parseInt($("#notify_cnt").text());
  if (current > 0) {
    $.ajax({
      type: "POST",
      url: "/Connect/update_notification",
      data: "current=" + current,
      success: "success",
      dataType: 'text',
      context: document.body
    }).done(function(msg) {
      $("#notify_cnt").text(0);
    });
  }
}

function getnotifihome(control, customer, section) {
  var q = $('#SearchSubCategory').val();
  var view_value = $("input[id='view_value']").val();
  if (view_value == '') {
    view_value = 'grid';
  }
  width = $(window).width();
  $.ajax({
    url: "/Connect/getnotification_brand",
    data: "Search=" + encodeURIComponent(q) + "&customer=" + customer + "&sect=quick" + "&suggest=yes" + "&control=" + control + "&width=" + width,
    type: "POST"
  }).done(function(txt) {
    $("#redirect_path_search").html(txt);
    $(".store_overall_searchmain_main_results_home").css('width', '100%');
    if ($(window).width() < 640) {
      $(".store_overall_searchmain_main_results_home").css('padding', '10px');
    }
    $("div[id='search_result_section_each_home']").hide();
    $("div[id='header_for_the_sections_home']").hide();
    $("span[id=search_pointer_element_home]").hide();
    $("." + section + "_pointer_element_home").show();
    $("." + section + "_search_result_section_home").show();
    $(".header_for_the_section_home_" + section).show();
    // shop_search_result_section
    $(".inner-details-search .main_button_for_search_home").removeClass('main_button_for_search_home');
    $("#main_button_for_search_home_" + section).addClass('main_button_for_search_home');
    $(".store_product_menumain .dropdown-menu").bind('scroll', function() {
      if (typeof timeout == "number") {
        window.clearTimeout(timeout);
        delete timeout;
      }
      timeout = window.setTimeout(check_newmain, 100);
    });
    
  });
}

function getnotifi(control, customer, count) {
  var q = $('#SearchSubCategory').val();
  $("#related_searches").show();
  $('#show_more_section_' + control).hide();
  var opposite = '';
  var for_value = '';
  var view_value = $("input[id='view_value']").val();
  if (view_value == '') {
    view_value = 'grid';
  }
  if (customer == 1) {
    opposite = 'Business';
    for_value = 'Personal';
  } else {
    opposite = 'Personal';
    for_value = 'Business';
  }
  $("#for_value_notification").val(for_value);
  for_value_lower = for_value.toLowerCase();
  var pointer_for = for_value.toLowerCase();
  var pointer_oppo = opposite.toLowerCase();
  var id = control + "_" + for_value + "_show_section";
  var id_more = "element-for-homesearch-" + for_value + "-" + control;
  var id_pointer = "pointer-home-search-" + pointer_for + "-" + control;
  var id_tick = "tick-home-search-" + pointer_for + "-" + control;
  $("div[id='" + id + "']").show();
  $("li[id='" + id_more + "']").show();
  $("." + id_pointer).show();
  $("span[id='" + id_tick + "']").show();
 
  var id_more_oppo = "element-for-homesearch-" + opposite + "-" + control;
  var id_oppo = control + "_" + opposite + "_show_section";
  var id_pointer_oppo = "pointer-home-search-" + pointer_oppo + "-" + control;
  var id_tick_oppo = "tick-home-search-" + pointer_oppo + "-" + control;
  $("." + id_pointer_oppo).removeAttr('name');
  $("." + id_pointer_oppo).removeAttr('id');
  $("." + id_pointer).attr("id", control + '-pointer-name');
  $("." + id_pointer).attr('name', for_value);
  $("div[id='" + id_oppo + "']").hide();
  $("li[id='" + id_more_oppo + "']").hide();
  $("." + id_pointer_oppo).hide();
  $("span[id='" + id_tick_oppo + "']").hide();
 
  $("li[id='" + id + "']").show();
  $("div[id='" + control + "_" + opposite + "_show_section']").hide();
  $("div[id='" + control + "_" + opposite + "_show_section_category']").hide();
  $("div[id='" + control + "_" + opposite + "_show_section_category_main']").hide();
  $("div[id='" + control + "_" + for_value + "_show_section_category']").show();
  $("div[id='" + control + "_" + for_value + "_show_section_category_main']").show();
  $("." + control + "_search_result_section").html('<div class="loading_image_selection" style="margin: 0px auto; position: relative; z-index: 3000; background-color: rgb(255, 255, 255); text-align: left; display:inline-block;"><img src="/img/loading_company.gif" class="img-responsive"></div>');
  $("." + control + "_search_result_section").show();
  width = $(window).width();
  $.ajax({
    url: "/Connect/getnotification_brand",
    data: "Search=" + encodeURIComponent(q) + "&customer=" + customer + "&sect=pass" + "&suggest=yes" + "&control=" + control + "&width=" + width + "&view_value=" + view_value,
    type: "POST"
  }).done(function(txt) {
    $("#related_searches_div").html(txt);
    $("#related_searches").show();
    $('#show_more_section_' + control).show();
    if (count == 0) {
      $("#show_more_section_" + control).css('display', 'none');
    } else {
      $("#show_more_section_" + control).css('display', 'inline-flex');
    }
    var name = $(".main_button_for_search a").attr('name');
    var category_each = $("#category_list_" + for_value_lower + "_" + name).val();
    if (category_each == 1) {
      $("." + name + "_search_result_section").hide();
    }
    $(".store_product_menumain .dropdown-menu").bind('scroll', function() {
      if (typeof timeout == "number") {
        window.clearTimeout(timeout);
        delete timeout;
      }
      timeout = window.setTimeout(check_newmain, 100);
    });
  });
  
}

function filter_skip_mobile() {
  if ($(".custom-aside").hasClass('coming')) {
    $('.custom-aside').removeClass('coming').addClass('going');
    $("div.sort_section").addClass('open');
    $(".custom-aside .pull-me").css("cssText", "display:block");
  } else {
    $('.custom-aside').removeClass('going').addClass('coming');
    $("body").removeClass('scroll');
    $(".custom-aside .pull-me").css("cssText", "display:none");
  }
}


$(document).click(function(e) {
  if (!$(e.target).is('#scroll-top-sort,.scroll-top-sort-img')) {
    $("#sort_menu_scroll").hide();
    $(".close-cover-sortsidestore").hide();
    $(".close-cover-sortside").hide();
  }
});


function SelectOptionScroll() {
  $('body,html').animate({
    scrollTop: 0
  }, 100);
  $("#sort_menu_scroll").hide();
  $(".close-cover-sortside").hide();
  $(".close-cover-sortsidestore").hide();
}

function filter_skip_mobile_scroll() {
  if ($(".custom-aside").hasClass('coming')) {
    $('.custom-aside').removeClass('coming').addClass('going');
    $(".custom-aside .pull-me").css("cssText", "display:block");
    $("div.sort_section").addClass('open');
    if (window.innerWidth < 760) {
      $("body").addClass('modal-open');
    }
  } else {
    $('.custom-aside').removeClass('going').addClass('coming');
    $("body").removeClass('modal-open');
    $(".custom-aside .pull-me").css("cssText", "display:none");
  }
}

function seller_show_login() {
  $('.front').addClass('front-change');
  $('.f2_container').addClass('f2-change');
  $('.back').addClass('back-change');
}

function buyer_show_login() {
  $('.front').removeClass('front-change');
  $('.f2_container').removeClass('f2-change');
  $('.back').removeClass('back-change');
}

function show_dropmenu_links() {
  if (!$("div.main").is(":visible")) {
    $(".main").addClass('show-login');
  } else {
    $(".main").removeClass('show-login');
  }
}

$(document).on('click', '.buyer-diff', function() {
  $(this).css('font-weight', 'bold');
  $('.seller-diff').css('font-weight', 'normal');
});
$(document).on('click', '.seller-diff', function() {
  $(this).css('font-weight', 'bold');
  $('.buyer-diff').css('font-weight', 'normal');
});

function search_other_content_switch(search, section, for_value, type) {
  var view = $("input[id='view_value']:last").val();
  var control = $('#ControllerName').val();
  if (type == 'brand') {
    var Brand = search;
    search = '';
  } else
    var Brand = '';
  var tot_cnt_first = $("input[id='tot_cnt']:first").val();
  $.ajax({
    type: "POST",
    url: "/Generals/Search_Other_Content",
    data: "For=" + for_value + "&Search=" + search + "&Brand=" + Brand + "&control=" + control + "&viewlist=" + view,
    success: "success",
    dataType: 'text',
    context: document.body
  }).done(function(msg) {
    $(".extra_space").hide();
    $(".search_other_content").html(msg);
    var search_content_bottom = $("#search_content_at_bottom").val();
    if (search_content_bottom == 0) {
      $(".txt_search_bottom").hide();
    }
    $("div[id='Loading_Search_Content']").remove();
    $("div[id^='loading']").remove();
    if (tot_cnt_first >= 1) {
      $(".search_othercontent_section").show();
      $(".txt_search_bottom").show();
    }
    var control = $("#ControllerName").val();
    if (control != '') {
      $("#" + control + "_search_result").hide();
    }
  });
}

function new_results(section, customer) {
  $("#loading_image_section_inner_new_result").show();
  var offer_new = $("#offer_new").val();
  var offer_expire = $("#offer_expire").val();
  var coupon_new = $("#coupon_new").val();
  var coupon_expire = $("#coupon_expire").val();
  var cashback_new = $("#cashback_new").val();
  var cashback_expire = $("#cashback_expire").val();
  var reviews_new = $("#reviews_new").val();
  $.ajax({
    type: "POST",
    url: "/Connect/new_section_results",
    data: "section=" + section + "&customer=" + customer + "&offer_new=" + offer_new + "&offer_expire=" + offer_expire + "&coupon_new=" + coupon_new + "&coupon_expire=" + coupon_expire + "&cashback_new=" + cashback_new + "&cashback_expire=" + cashback_expire + "&reviews_new=" + reviews_new,
  }).done(function(msg) {
    $("#loading_image_section_inner_new_result").hide();
    $("#item_new_data").html(msg);
  });
}

function select_search() {
  var search_keyword = $("#SearchSubCategory").val();
  var customer = $("#for_value").val();
  var section = $(".sd_frmct_hm ").val();
  var user = $('#User_Id').val();
  var section_name = $(".sd_frmct_hm  :selected").val();
  if (section_name != 'All' && section_name != 'all' && section_name != 'shop' && section_name != 'companies' && section_name != 'company' && section_name != 'reviews') {
    var section_name_upper = section_name;
    section_name_upper = section_name_upper.substring(0, 1).toUpperCase() + section_name_upper.substring(1);
    $("#SearchSubCategory").attr('placeholder', 'Search in ' + section_name_upper + ' ...');
  } else if (section_name == 'reviews') {
    $("#SearchSubCategory").attr('placeholder', 'Search in Launches ...');
  } else if (section_name == 'shop') {
    $("#SearchSubCategory").attr('placeholder', 'Search in Prices ...');
  } else if (section_name == 'companies' || section_name == 'company') {
    $("#SearchSubCategory").attr('placeholder', 'Search in Vendors ...');
  } else if (section_name == 'all') {
    $("#SearchSubCategory").attr('placeholder', 'Search ...');
  }
  if (section_name == 'all') {
  }
  if (section_name != 'companies') {
    home_quick(customer, section_name, 'none');
  } else {
    home_quick(customer, 'company', 'none');
  }
  if (search_keyword != '') {
    show_search_result(section);
  }
  $(".indetthird-main-home .activated_link").removeClass('activated_link');
  if (section_name != 'companies') {
    $("#" + section_name + "-third-li a").addClass('activated_link');
  } else {
    $("#company-third-li").addClass('activated_link');
  }
}


function google_suggestion() {
  var control = $("#ControllerName").val();
  var search_keyword = $("#SearchSubCategory").val();
  var main_control = $("#ControllerName").val();
  var page_type = $("#PageType").val();
  if (control == 'Homes') {
    var customer = $("#for_value").val();
    control = $(".sd_frmct_hm ").val();
    if (control == '' || control == undefined) {
      control = 'Homes';
    }
  } else {
    customer = $("input[id='For']:last").val();
    var view_type = $("input[id='view_value']:last").val();
  }
  if (control == 'Brands' || control == 'vouchers') {
    control = 'Homes';
  }
  if (view_type == '' || view_type == undefined) {
    if ($(window).width() > 640) {
      if (control == 'shop' || control == 'reviews')
        view_type = 'grid';
      else
        view_type = 'list';
    } else {
      view_type = 'list';
    }
  }
  $("#lock_flag").val(0);
  //alert("Hi");
  var gs = 0;
  var search_go = 0;
  google_request = $.ajax({
    type: "POST",
    url: "/Connect/google_suggest",
    data: "txt=" + encodeURIComponent(search_keyword) + "&gs=" + gs + "&customer=" + customer + "&control=" + control + "&viewlist=" + view_type + "&main_control=" + main_control + "&page_type=" + page_type,
    success: "success",
    async: true,
    dataType: 'text',
    beforeSend: function() {},
    success: function(msg) {
    
      if ($(window).width() <= 1024) {
        if ($('#rgtnavscresult').is(":hidden")) {
          $("#related_searches").show();
        }
      } else {
        $("#related_searches").show();
      }
      $(".suggestions_google").html(msg);
      if (search_go == 0) {
        var gogle_va = $("#related_searches #google_suggestion_flag").val();
        if (gogle_va == 1) {
          $(".suggestions_google").show();
        } else {
          $(".suggestions_google").hide();
        }
        $("#lock_flag").val(1);
        var enter_lock = $("#enter_flag").val();
        if (enter_lock == 1) {
          var section = $("#controller_name_google").val();
          var search_keyword = $("#SearchSubCategory").val();
          var view_type = $("input[id='view_value']:last").val();
          var user_type = $("input[id='For']:last").val();
          if (user_type == 'Personal') {
            window.location.href = '/' + section + '?q=' + encodeURIComponent(search_keyword);
          } else {
            window.location.href = '/' + section + '/for-business?q=' + encodeURIComponent(search_keyword);
          }
          $("#related_searches").remove();
        }
      } else {
        $(".suggestions_google").hide();
      }
    }
  });
}

function google_suggestion_preview() {
  var control = $("#ControllerName").val();
  var search_keyword = $("#Search_Preview").val();
  var main_control = $("#ControllerName").val();
  var gs = 0;
  var search_go = 0;
  var page_type = $("#PageType").val();
  customer = $("input[id='For']:last").val();
  var view_type = $("input[id='view_value']:last").val();
  if (view_type == undefined) {
    view_type = '';
  }
  google_request = $.ajax({
    type: "POST",
    url: "/Connect/google_suggest",
    data: "txt=" + encodeURIComponent(search_keyword) + "&gs=" + gs + "&customer=" + customer + "&control=" + control + "&viewlist=" + view_type + "&main_control=" + main_control + "&page_type=" + page_type,
    success: "success",
    async: true,
    dataType: 'text',
    beforeSend: function() {},
    success: function(msg) {
      var preview_enter = $("#preview_enter_key").val();
      if (preview_enter == 1) {
        $("#related_searches_paren_preview").show();
        $("#related_searches_preview").show();
      } else {
        $("#related_searches_paren_preview").hide();
        $("#related_searches_preview").hide();
      }
      $(".suggestions_google_preview").html(msg);
      $(".suggestions_google_preview").show();
    }
  });
}

function suggestions_preview() {
    var txt = $("#Search_Preview").val();
    var control = $("#ControllerName").val();
    var main_control = $("#ControllerName").val();
    var customer = $("input[id='For']:last").val();
    var search_go = 0;
    var view_type = $("input[id='view_value']:last").val();
    if (view_type == '' || view_type == undefined) {
      if ($(window).width() > 640) {
        if (control == 'shop' || control == 'reviews')
          view_type = 'grid';
        else
          view_type = 'list';
      } else {
        view_type = 'list';
      }
    }
    if (customer == undefined || customer == '') {
      customer = 'Personal';
    }
    $(".suggestions_block_preview").html('<div class="loading_image_selection" style="margin: 0px auto; position: fixed; opacity: 1; z-index: 3000; background-color: rgb(255, 255, 255); text-align: center; vertical-align: middle; width: 200px; height: 51px; padding-top: 18px; border-radius: 5px; left: 15%; right: 0px; bottom: 0px; top: 30%;display:block;"><img src="/img/loading_company.gif" class="img-responsive"></div>');
    req_sugg = $.ajax({
      type: "POST",
      url: "/Connect/suggestions_search",
      data: "txt=" + encodeURIComponent(txt) + "&customer=" + customer + "&control=" + control + "&viewlist=" + view_type + "&main_control=" + main_control + "&method=normal",
      success: "success",
      dataType: 'text',
      context: document.body
    }).done(function(msg) {
      $(".suggestions_block_preview").html(msg);
      $(".suggestions_block_preview").show();
      $("#close-search").html('<span class="sd_close-img"><i class="glyphicon glyphicon-remove-circle"></i></span>');
    });
  }
 


function suggestions_home_main(txt) {
  $("#search_txt").text(txt);
  $("input[id='search_ongoing']").val(0);
  $("input[id='search_ongoing_main']").val(0);
  $("#related_searches_div_home").hide();
  $(".suggestions_block_home").hide();
  $("#loading_sugg_home").show();
  if (req_sugg != null) req_sugg.abort();
  var control = $("#ControllerName").val();
  var main_control = $("#ControllerName").val();
  if (control == 'Homes') {
    var customer = $("#for_value").val();
    var search_go = $("#search_popup_ongo").val();
    control = $(".sd_frmct_hm ").val();
    if (control == '' || control == undefined || control == 'all') {
      control = 'prices';
    }
  } else {
    var customer = $("input[id='For']:last").val();
    var search_go = 0;
    var view_type = $("input[id='view_value']:last").val();
  }
  if (control == 'Brands' || control == 'vouchers') {
    control = 'Homes';
  }
  if (view_type == '' || view_type == undefined) {
    if ($(window).width() > 640) {
      if (control == 'shop' || control == 'reviews')
        view_type = 'grid';
      else
        view_type = 'list';
    } else {
      view_type = 'list';
    }
  }
  if (txt != '') {
    $("#redirect-popup").modal('show');
    req_sugg = $.ajax({
      type: "POST",
      url: "/Connect/suggestions_search",
      data: "txt=" + encodeURIComponent(txt) + "&customer=" + customer + "&control=" + control + "&viewlist=" + view_type + "&main_control=" + main_control + "&method=normal",
      success: "success",
      dataType: 'text',
      context: document.body
    }).done(function(msg) {
      $(".suggestions_block_home").show();
      $("#loading_sugg_home").hide();
      if (search_go == 0) {
        $(".suggestions_block_home").html(msg);
        var section_name = $('#section_name').val();
        if (section_name != '') {
          $(".sd_frmct_hm ").val(section_name);
        }
        $("input[id='search_ongoing_main']").val(1);
        var name = $(".main_button_for_search a").attr('name');
        var category_each = $("#category_list_personal_" + name).val();
        var personal_category = $("#personal_category_value").val();
        if (personal_category == 1) {
        } else {
          $("div[id='search_result_section_each']").hide();
        }
        $(".suggestions_block_home").show();
      } else {
        $(".suggestions_block").hide();
        $("#related_searches").hide();
      }
    });
  }
}
var sec_sugg_req = null

function suggestion_section() {
  var txt = $("#SearchSubCategory").val();
  var control = $("#ControllerName").val();
  sec_sugg_req = $.ajax({
    type: "POST",
    url: "/Connect/section_suggestion",
    data: "txt=" + encodeURIComponent(txt) + "&control=" + control,
    success: "success",
    dataType: 'text',
    context: document.body
  }).done(function(msg) {
    var obj = jQuery.parseJSON(msg);
    var section = obj.section;
    $("#ControllerName_Enter").val(section);
  });
}

function suggestions_clicked() {
  $("input[id='search_ongoing']").val(0);
  $("input[id='search_ongoing_main']").val(0);
  $(".suggestions_block").hide();
  var txt = $("#SearchSubCategory").val();
  if (req_sugg != null) req_sugg.abort();
  var control = $("#ControllerName").val();
  var main_control = $("#ControllerName").val();
  if (control == 'Homes') {
    var customer = $("#for_value").val();
    var search_go = $("#search_popup_ongo").val();
    if (search_go == undefined) {
      search_go = 0;
    }
    control = $(".sd_frmct_hm ").val();
    if (control == 'all')
      control = 'Homes';
    if (control == '' || control == undefined) {
      control = 'Homes';
    }
  } else {
    var customer = $("input[id='For']:last").val();
    var search_go = 0;
    var view_type = $("input[id='view_value']:last").val();
  }
  if (control == 'Brands' || control == 'vouchers') {
    control = 'Homes';
  }
  if (view_type == '' || view_type == undefined) {
    if ($(window).width() > 640) {
      if (control == 'shop' || control == 'reviews')
        view_type = 'grid';
      else
        view_type = 'list';
    } else {
      view_type = 'list';
    }
  }
  if (txt != '') {
    $("#related_searches").show();
    req_sugg = $.ajax({
      type: "POST",
      url: "/Connect/suggestions_search",
      data: "txt=" + encodeURIComponent(txt) + "&customer=" + customer + "&control=" + control + "&viewlist=" + view_type + "&main_control=" + main_control + "&method=normal",
      success: "success",
      dataType: 'text',
      context: document.body
    }).done(function(msg) {
      $(".suggestions_block").show();
      if (search_go == 0) {
        $(".suggestions_block").html(msg);
        var section_name = $('#section_name').val();
        $("input[id='search_ongoing_main']").val(1);
        var name = $(".main_button_for_search a").attr('name');
        var category_each = $("#category_list_personal_" + name).val();
        var personal_category = $("#personal_category_value").val();
        if (personal_category == 1) {
        } else {
          $("div[id='search_result_section_each']").hide();
        }
        $(".suggestions_block").show();
        if ($('#rgtnavscresult').is(":hidden")) {
          $("#related_searches").show();
        }
      } else {
        $(".suggestions_block").hide();
        $("#related_searches").hide();
      }
    });
  }
}
var req_sugg = null;

function suggestions() {
  $("input[id='search_ongoing']").val(0);
  $("input[id='search_ongoing_main']").val(0);
  $(".suggestions_block").hide();
  var txt = $("#SearchSubCategory").val();
  var control = $("#ControllerName").val();
  var main_control = $("#ControllerName").val();
  if (control == 'Homes') {
    var customer = $("#for_value").val();
    var search_go = $("#search_popup_ongo").val();
    control = $(".sd_frmct_hm ").val();
    if (control == 'all') control = 'Homes';
    if (control == '' || control == undefined) {
      control = 'Homes';
    }
  } else {
    var customer = $("input[id='For']:last").val();
    var search_go = 0;
    var view_type = $("input[id='view_value']:last").val();
  }
  if (control == 'Brands' || control == 'vouchers') {
    control = 'Homes';
  }
  if (view_type == '' || view_type == undefined) {
    if ($(window).width() > 640) {
      if (control == 'shop' || control == 'reviews') view_type = 'grid';
      else view_type = 'list';
    } else {
      view_type = 'list';
    }
  }
  if (txt != '') {
    if ($('#rgtnavscresult').is(":hidden")) {
      $("#related_searches").show();
    }
    $(".suggestions_block").html('<div class="loading_image_selection" style="margin: 0px auto; position: fixed; opacity: 1; z-index: 3000; background-color: rgb(255, 255, 255); text-align: center; vertical-align: middle; width: 200px; height: 51px; padding-top: 18px; border-radius: 5px; left: 15%; right: 0px; bottom: 0px; top: 30%;display:block;"><img src="/img/loading_company.gif" class="img-responsive"></div>');
    $(".suggestions_block").show();
    req_sugg = $.ajax({
      type: "POST",
      url: "/Connect/suggestions_search",
      data: "txt=" + encodeURIComponent(txt) + "&customer=" + customer + "&control=" + control + "&viewlist=" + view_type + "&main_control=" + main_control + "&method=normal",
      success: "success",
      dataType: 'text',
      context: document.body
    }).done(function(msg) {
      $(".suggestions_block").show();
      if (search_go == 0) {
        $(".suggestions_block").html(msg);
        $("#related_searches_div").hide();
        $("#close-search").html('<span class="sd_close-img"><i class="glyphicon glyphicon-remove-circle"></i></span>');
        var section_name = $('#section_name').val();
        $("input[id='search_ongoing_main']").val(1);
        var name = $(".main_button_for_search a").attr('name');
        var category_each = $("#category_list_personal_" + name).val();
        var personal_category = $("#personal_category_value").val();
        if (personal_category == 1) {} else {
          $("div[id='search_result_section_each']").hide();
        }
        $(".suggestions_block").show();
        if ($('#rgtnavscresult').is(":hidden")) {
          $("#related_searches").show();
        }
      } else {
        $(".suggestions_block").hide();
        $("#related_searches").hide();
      }
    });
  }
}


function suggestions_push_click(search) {
  $("#related_searches_paren").hide();
  var txt = search;
  var user = $("#User_Id").val();
  var text_value = decodeURIComponent(txt);
  text_value = text_value.replace(/\+/g, ' ');
  $("#SearchSubCategory").val(text_value);
  var control = $("#ControllerName").val();
  var main_control = $("#ControllerName").val();
  if (control == 'Homes') {
    var customer = $("#for_value").val();
    control = $(".sd_frmct_hm ").val();
    if (control == 'All Sections') {
      control = 'All';
    }
  } else if (control != 'search') {
    var customer = $("input[id='For']:last").val();
    control = $(".sd_frmct_hm").val();
  }
  if (control == 'all' || control == '' || control == undefined) {
    if (txt != '') {
      $("#mySidenav").html('<div class="loading_image_selection" style="margin: 0px auto; position: absolute; opacity: 1; z-index: 3000; background-color: rgb(255, 255, 255); text-align: center; vertical-align: middle; width: 200px; height: 51px; padding-top: 18px; border-radius: 5px; left: 0px; right: 0px; bottom: 0px; top: 40%;display:block;"><img src="/img/loading_company.gif" class="img-responsive"></div>');
      $("#related_searches").hide();
      $("#xerve_store_search").val("");
      var sharelatitude = $("#sharelatitude").val();
      var check_name_search = 0;
      if (sharelatitude == '' || sharelatitude == undefined) {
        for (var i = 0; i < list_word_search.length; i++) {
          if (txt.toLowerCase().includes(list_word_search[i])) {
            check_name_search = 1;
          };
        };
      }
      if (check_name_search == 1) {
        var share_push_pop = "share popup";
        var share_push_sec = "share new";
        view_type = "";
        share_location_keyword(control, txt, customer, view_type, main_control, share_push_pop, share_push_sec);
      } else {
        abort();
        this.$backdrop = $('<div class="modal-backdrop fade in " />').appendTo(document.body)
        $(".loading_image_selection").show();
        req_sugg = $.ajax({
          type: "POST",
          url: "/Connect/suggestions_search_push",
          data: "txt=" + encodeURIComponent(txt) + "&customer=" + customer + "&control=" + control + "&main_control=" + main_control + "&method=push",
          success: "success",
          dataType: 'text',
          context: document.body
        }).done(function(msg) {
          $(".loading_image_selection").hide();
          $(".modal-backdrop").remove();
          $("#close-search").html('<span class="sd_close-img"><i class="glyphicon glyphicon-remove-circle"></i></span>');
          $("#rgtnavscresult").html(msg);
          var path = '/search?q=' + txt;
          var user = $("#User_Id").val();
          actual_url_address = window.location.href;
          history.pushState({
            page: path
          }, '', path);
          offline_seller_search(txt);
          if (window.innerWidth > 760) {
            if (control == 'Homes') {
              $('header').removeClass('home_header');
            }
          }
          var control_value = $("#Control_Name_Value").val();
          $(".sidenav").addClass('navexp');
          var user = $("#User_Id").val();
          if ($('#sea_main_sectionoffers').length !== 0 && $('#sea_main_sectioncashback').length == 0) {
            $("#sea_main_sectionoffers").addClass('_onlyone_deal');
          }
          if ($('#sea_main_sectioncashback').length !== 0 && $('#sea_main_sectionoffers').length == 0) {
            $("#sea_main_sectioncashback").addClass('_onlyone_deal');
          }
          $('span[id*="compare_pri_buttonnew1"]').each(function() {
            $(this).trigger('click');
          });
          $("#mySidenav").show();
          $("#rgtnavscresult").removeClass('_xsdpnon');
          $('#rgtnavscresult').addClass('_xsdpblock');
          $('header').removeClass('search_home');
          $('header').removeClass('home_header');
          $('body').addClass('stopscroll');
          $("#SearchSubCategory").blur();
          var store_id_searech = $("#xerve_store_search").val();
          if (store_id_searech != undefined && store_id_searech != null && store_id_searech != "") {
            Category_Call_Search();
          }
        });
      }
    }
  } else {
    if (control == 'shop') {
      control = 'prices';
    }
    var sharelatitude = $("#sharelatitude").val();
    var check_name_search = 0;
    if (sharelatitude == '' || sharelatitude == undefined) {
      for (var i = 0; i < list_word_search.length; i++) {
        if (txt.toLowerCase().includes(list_word_search[i])) {
          check_name_search = 1;
        };
      };
    }
    if (check_name_search == 1) {
      share_location_keyword(control, txt);
    } else {
      window.location.href = '/' + control + "?q=" + encodeURIComponent(txt);
    }
  }
}
function suggestions_push(search) {
  $("#related_searches_paren").hide();
  $("#xerve_store_search").val("");
  var txt = $("#SearchSubCategory").val();
  if (req_sugg != null) req_sugg.abort();
  var control = $("#ControllerName").val();
  var main_control = $("#ControllerName").val();
  if (control == 'Homes') {
    var customer = $("#for_value").val();
    var search_go = 0;
    control = $(".sd_frmct_hm ").val();
    if (control == 'all')
      control = 'Homes';
    if (control == '' || control == undefined) {
      control = 'Homes';
    }
  } else {
    var customer = $("input[id='For']:last").val();
    var search_go = 0;
    var view_type = $("input[id='view_value']:last").val();
  }
  if (control == 'Brands' || control == 'vouchers') {
    control = 'Homes';
  }
  if (view_type == '' || view_type == undefined) {
    if ($(window).width() > 640) {
      if (control == 'shop' || control == 'reviews')
        view_type = 'grid';
      else
        view_type = 'list';
    } else {
      view_type = 'list';
    }
  }
  if (txt != '') {
   
    $("#mySidenav").html('<div class="loading_image_selection" style="margin: 0px auto; position: absolute; opacity: 1; z-index: 3000; background-color: rgb(255, 255, 255); text-align: center; vertical-align: middle; width: 200px; height: 51px; padding-top: 18px; border-radius: 5px; left: 0px; right: 0px; bottom: 0px; top: 40%;display:block;"><img src="/img/loading_company.gif" class="img-responsive"></div>');
    var sharelatitude = $("#sharelatitude").val();
    var check_name_search = 0;
    if (sharelatitude == '' || sharelatitude == undefined) {
      for (var i = 0; i < list_word_search.length; i++) {
        if (txt.toLowerCase().includes(list_word_search[i])) {
          check_name_search = 1;
        };
      };
    }
    if (check_name_search == 1) {
      var share_push_pop = "share popup";
      share_location_keyword(control, txt, customer, view_type, main_control, share_push_pop);
    } else {
      var user = $("#User_Id").val();
      abort();
      var user = $("#User_Id").val();
      req_sugg = $.ajax({
        type: "POST",
        url: "/Connect/suggestions_search_push",
        data: "txt=" + encodeURIComponent(txt) + "&customer=" + customer + "&control=" + control + "&viewlist=" + view_type + "&main_control=" + main_control + "&method=push",
        success: "success",
        dataType: 'text',
        async: true,
        beforeSend: function() {},
        success: function(msg) {
          var user = $("#User_Id").val();
          $("#rgtnavscresult").html(msg);
          path = '/search?q=' + txt;
          actual_url_address = window.location.href;
          history.pushState({
            page: path
          }, '', path);
          $("#close-search").html('<span class="sd_close-img"><i class="glyphicon glyphicon-remove-circle"></i></span>');
          offline_seller_search(txt);
          $('span[id*="compare_pri_buttonnew1"]').each(function() {
            $(this).trigger('click');
          });
          if (window.innerWidth > 760) {
            if (control == 'Homes') {
              $('header').removeClass('home_header');
            }
          }
          var control_value = $("#Control_Name_Value").val();
          if ($('#sea_main_sectionoffers').length !== 0 && $('#sea_main_sectioncashback').length == 0) {
            $("#sea_main_sectionoffers").addClass('_onlyone_deal');
          }
          if ($('#sea_main_sectioncashback').length !== 0 && $('#sea_main_sectionoffers').length == 0) {
            $("#sea_main_sectioncashback").addClass('_onlyone_deal');
          }
          var user = $("#User_Id").val();
          $("#related_searches_paren").hide();
          $(".sidenav").addClass('navexp');
          $("#mySidenav").show();
          $("#rgtnavscresult").removeClass('_xsdpnon');
          $('#rgtnavscresult').addClass('_xsdpblock');
          if (window.innerWidth < 760) {
            if ($('header').hasClass('home_header')) {
              if ($("#rgtnavscresult").hasClass('_xsdpblock')) {
                $('header').removeClass('dragme-up');
                $('header').addClass('_only_search');
                $('._static_search').hide();
                $('._xrheader.dskhide').hide();
              }
            }
          }
          $('header').removeClass('search_home');
          $('header').removeClass('home_header');
          $('body').addClass('stopscroll');
          $("#SearchSubCategory").blur();
          var store_id_searech = $("#xerve_store_search").val();
          if (store_id_searech != undefined && store_id_searech != null && store_id_searech != "") {
            seller_new_price();
          }
        }
      });
    }
  }
}

function search_path(txt) {
  var control = $("#ControllerName").val();
  var user = $("#User_Id").val();
  var customer = ''
  var customer = $("input[id='For']:last").val();
  var main_control = $("#ControllerName").val();
  var view_type = $("input[id='view_value']:last").val();
  if (view_type == '' || view_type == undefined) {
    if ($(window).width() > 640) {
      if (control == 'shop' || control == 'reviews')
        view_type = 'grid';
      else
        view_type = 'list';
    } else {
      view_type = 'list';
    }
  }
  req_sugg_new = $.ajax({
    type: "POST",
    url: "/search?q=" + txt,
    success: "success",
    dataType: 'text',
    async: true,
    beforeSend: function() {},
    success: function(msg) {
    }
  });
}

function suggestions_share_location(control, txt, customer, view_type, main_control, share_push_pop1, share_push_sec, location13, area1, location12, state_name, country_name, latitude99, longitude99) {
  var path_share = '';
  $("#xerve_store_search").val("");
  if (share_push_pop1 == "loc") {
    path_share = path_share.concat("&sharearea=" + location13);
    path_share = path_share.concat("&sharearea1=" + area1);
    path_share = path_share.concat("&sharecity=" + location12);
    path_share = path_share.concat("&sharestate=" + state_name);
    path_share = path_share.concat("&sharecountry=" + country_name);
    path_share = path_share.concat("&latitude99=" + latitude99);
    path_share = path_share.concat("&longitude99=" + longitude99);
  }
  if (share_push_sec == 'share new') {
    abort();
    req_sugg = $.ajax({
      type: "POST",
      url: "/Connect/suggestions_search_push",
      data: "txt=" + encodeURIComponent(txt) + "&customer=" + customer + "&control=" + control + "&main_control=" + main_control + "&method=push" + path_share,
      success: "success",
      dataType: 'text',
      context: document.body
    }).done(function(msg) {
      $("#rgtnavscresult").html(msg);
      $("#close-search").html('<span class="sd_close-img"><i class="glyphicon glyphicon-remove-circle"></i></span>');
      offline_seller_search(txt);
      if (window.innerWidth > 760) {
        if (control == 'Homes') {
          $('header').removeClass('home_header');
        }
      }
      var control_value = $("#Control_Name_Value").val();
      var user = $("#User_Id").val();
      if ($('#sea_main_sectionoffers').length !== 0 && $('#sea_main_sectioncashback').length == 0) {
        $("#sea_main_sectionoffers").addClass('_onlyone_deal');
      }
      if ($('#sea_main_sectioncashback').length !== 0 && $('#sea_main_sectionoffers').length == 0) {
        $("#sea_main_sectioncashback").addClass('_onlyone_deal');
      }
      $('span[id*="compare_pri_buttonnew1"]').each(function() {
        $(this).trigger('click');
      });
      $(".sidenav").addClass('navexp');
      $("#mySidenav").show();
      $("#rgtnavscresult").removeClass('_xsdpnon');
      $('#rgtnavscresult').addClass('_xsdpblock');
      if (window.innerWidth < 760) {
        if ($('header').hasClass('home_header')) {
          if ($("#rgtnavscresult").hasClass('_xsdpblock')) {
            $('header').removeClass('dragme-up');
            $('header').addClass('_only_search');
            $('._static_search').hide();
            $('._xrheader.dskhide').hide();
          }
        }
      }
      $('header').removeClass('search_home');
      $('header').removeClass('home_header');
      $('body').addClass('stopscroll');
      $("#SearchSubCategory").blur();
      var store_id_searech = $("#xerve_store_search").val();
      if (store_id_searech != undefined && store_id_searech != null && store_id_searech != "") {
        Category_Call_Search();
      }
      $("#sharelatitude").val(latitude99);
      $("#sharelongitude").val(longitude99);
    });
  } else {
    abort();
    req_sugg = $.ajax({
      type: "POST",
      url: "/Connect/suggestions_search_push",
      data: "txt=" + encodeURIComponent(txt) + "&customer=" + customer + "&control=" + control + "&viewlist=" + view_type + "&main_control=" + main_control + "&method=push" + path_share,
      success: "success",
      dataType: 'text',
      context: document.body
    }).done(function(msg) {
      $("#SearchSubCategory").blur();
      // $("#close-search").hide();
      $("#rgtnavscresult").html(msg);
      $("#close-search").html('<span class="sd_close-img"><i class="glyphicon glyphicon-remove-circle"></i></span>');
      offline_seller_search(txt);
      if (window.innerWidth > 760) {
        if (control == 'Homes') {
          $('header').removeClass('home_header');
        }
      }
      var control_value = $("#Control_Name_Value").val();
      
      var user = $("#User_Id").val();
      if ($('#sea_main_sectionoffers').length !== 0 && $('#sea_main_sectioncashback').length == 0) {
        $("#sea_main_sectionoffers").addClass('_onlyone_deal');
      }
      if ($('#sea_main_sectioncashback').length !== 0 && $('#sea_main_sectionoffers').length == 0) {
        $("#sea_main_sectioncashback").addClass('_onlyone_deal');
      }
      $('span[id*="compare_pri_buttonnew1"]').each(function() {
        $(this).trigger('click');
      });
      $("#related_searches_paren").hide();
      $(".sidenav").addClass('navexp');
      $("#mySidenav").show();
      $("#rgtnavscresult").removeClass('_xsdpnon');
      $('#rgtnavscresult').addClass('_xsdpblock');
      if (window.innerWidth < 760) {
        if ($('header').hasClass('home_header')) {
          if ($("#rgtnavscresult").hasClass('_xsdpblock')) {
            $('header').removeClass('dragme-up');
            $('header').addClass('_only_search');
            $('._static_search').hide();
            $('._xrheader.dskhide').hide();
          }
        }
      }
      $('header').removeClass('search_home');
      $('header').removeClass('home_header');
      $('body').addClass('stopscroll');
      $("#SearchSubCategory").blur();
      var store_id_searech = $("#xerve_store_search").val();
      if (store_id_searech != undefined && store_id_searech != null && store_id_searech != "") {
        Category_Call_Search();
      }
      $("#sharelatitude").val(latitude99);
      $("#sharelongitude").val(longitude99);
    });
  }
}

function suggest_click(search, section) {
  var q = search;
  $("#SearchSubCategory").val(q);
  $(".suggestions_block").hide();
  // suggestions(q);
  var control = $("#ControllerName").val();
  if (control == 'Homes') {
    var user_type = $("#user_type").val();
    if (user_type == 'Personal') {
      window.location.href = '/' + section + '?q=' + encodeURIComponent(search);
    } else {
      window.location.href = '/' + section + '/for-business?q=' + encodeURIComponent(search);
    }
  } else {
    user_type = $("input[id='For']:last").val();
    var view_type = $("input[id='view_value']:last").val();
    if (user_type == 'Personal') {
      window.location.href = '/' + section + '?q=' + encodeURIComponent(search);
    } else {
      window.location.href = '/' + section + '/for-business?q=' + encodeURIComponent(search);
    }
  }
}

function suggestions_home() {
  var txt = $("#SearchSubCategory").val();
  if (req_sugg != null) req_sugg.abort();
  var control = $("#ControllerName").val();
  if (control == 'Homes') {
    var customer = $("#for_value").val();
    var search_go = $("#search_popup_ongo").val();
  } else {
    var customer = $("input[id='For']:last").val();
    var search_go = 0;
  }
  req_sugg = $.ajax({
    type: "POST",
    url: "/Connect/suggestions_search",
    data: "txt=" + txt + "&customer=" + customer + "&control=" + control + "&popup=yes",
    success: "success",
    dataType: 'text',
    context: document.body
  }).done(function(msg) {
    $(".suggestions_block_home").html(msg);
    $(".suggestions_block_home").show();
    $('#redirect-popup').modal('show');
  });
}

function show_search_result(section) {
  $(".store_overall_searchmain_main_results").css('width', '100%');
  $(".sd_frmct_hm ").val(section);
  $(".show_more_section").each(function() {
    $(this).hide();
  });
  var name = $(".main_button_for_search a").attr('name');
  var customer = $("#" + name + "-pointer-name").attr('name');
  if (customer == '' || customer == undefined) {
    var customer = $("#for_value_notification").val();
  }
  if (customer == 'Personal') {
    opposite = 'Business';
    for_value = 'Personal';
  } else {
    opposite = 'Personal';
    for_value = 'Business';
  }
  for_value_lower = for_value.toLowerCase();
  var pointer_for = for_value.toLowerCase();
  var pointer_oppo = opposite.toLowerCase();
  var id = section + "_" + for_value + "_show_section";
  var id_more = "element-for-homesearch-" + for_value + "-" + section;
  var id_pointer = "pointer-home-search-" + pointer_for + "-" + section;
  $("." + id_pointer).attr("id", section + '-pointer-name');
  var category_each = $("#category_list_" + for_value_lower + "_" + section).val();
  $("#show_more_section_" + section).css("display", 'inline-flex');
  $(".search_grey_result a").each(function() {
    $(this).removeAttr('style');
  });
  $(".total-count-section").each(function() {
    $(this).removeAttr('style');
  });
  $("div[id='search_result_section_each']").hide();
  $("div[id='search_result_section_each_suggest']").hide();
  $("div[id='header_for_the_sections']").hide();
  $("span[id=search_pointer_element]").hide();
  $("." + section + "_pointer_element").show();
  if (category_each == 1) {
    $("div." + section + "_search_result_section").hide();
  } else {
    $("div." + section + "_search_result_section").show();
  }
  $("div." + section + "_search_result_section_suggest").show();
  $(".header_for_the_section_" + section).show();
  $(".inner-details-search .main_button_for_search").removeClass('main_button_for_search');
  $("#main_button_for_search_" + section).addClass('main_button_for_search');
  if ($("#main_button_for_search_" + section).hasClass('search_grey_result')) {
    $("#main_button_for_search_" + section + " a").css("cssText", "color:#999!important");
    $("#main_button_for_search_" + section + " .total-count-section").css("cssText", "color:#999!important");
  }
  $("div[id='" + id + "']").show();
  $("li[id='" + id_more + "']").show();
  $("." + id_pointer).show();
  var id_more_oppo = "element-for-homesearch-" + opposite + "-" + section;
  var id_oppo = section + "_" + opposite + "_show_section";
  var id_pointer_oppo = "pointer-home-search-" + pointer_oppo + "-" + section;
  $("div[id='" + id_oppo + "']").hide();
  $("li[id='" + id_more_oppo + "']").hide();
  $("." + id_pointer_oppo).hide();
  $("." + id_pointer_oppo).removeAttr('name');
  $("." + id_pointer_oppo).removeAttr('id');
  $("." + id_pointer).attr("id", section + '-pointer-name');
  $("." + id_pointer).attr('name', for_value);
  $("li[id='" + id + "']").show();
  $("div[id='" + section + "_" + opposite + "_show_section']").hide();
  $("div[id='" + section + "_" + opposite + "_show_section_category']").hide();
  $("div[id='" + section + "_" + for_value + "_show_section_category']").show();
  $("div[id='" + section + "_" + opposite + "_show_section_category_main']").hide();
  $("div[id='" + section + "_" + for_value + "_show_section_category_main']").show();
  $("div[id='" + section + "_" + for_value + "_show_section']").show();
}


function OfferCouponIdSearch(offer_id, category, row, page, promourl, seller_name, url_type) {
  var name = $("#user_name").val();
  var user = $("#User_Id").val();
  if (user != 1 && user != '' && user != 0) {
    if (url_type == 1) {
      var url_main = promourl + "&UID=" + user + "&UID2=" + name;
    } else if (url_type == 2) {
      var url_main = promourl + "&affExtParam1=" + user + "&affExtParam2=" + name;
    } else if (url_type == 3) {
      var url_main = promourl + "&aff_sub=" + user + "&aff_sub2=" + name;
    } else if (url_type == 4) {
      var url_main = promourl + "&aff_sub2=" + user + "&aff_sub3=" + name;
    } else if (url_type == 6) {
      var url_main = promourl + "&aff_sub=" + user + "&aff_sub1=" + name;
    } else if (url_type == 7) {
      var url_main = promourl; //+"&ascsubtag="+user
    } else {
      var url_main = promourl;
    }
    var sub_url = "/coupons/" + offer_id + "?open_main=1";
    window.open(url_main, '_blank');
    var popup = window.open(sub_url, '_blank');
    if (!popup || popup.closed || typeof popup.closed == 'undefined') {
      alert("Popup Blocker is enabled! Please add this site to your exception list.");
      mywindow = window.location.href = '/coupons/' + offer_id + '?open_main=1';
      mywindow.focus();
    }
  } else {
    var sub_url = "/coupons/" + offer_id + "?open_main=1";
    window.open(promourl, '_blank');
    var popup = window.open(sub_url, '_blank');
    if (!popup || popup.closed || typeof popup.closed == 'undefined') {
      //Worked For IE and Firefox
      alert("Popup Blocker is enabled! Please add this site to your exception list.");
      mywindow = window.location.href = '/coupons/' + offer_id + '?open_main=1';
      mywindow.focus();
    }
  }
}
function brand_club_show(id, section) {
  $("#brand_club_div" + id).show();
  $("#brand_club_button" + id).hide();
}
var timercat;

function shop_hover_cat_list() {
  var req_next_brand = null;
  var req_next_gender = null;
  var req_next_subact = null;
  var req_next_type = null;
  var req_next_cate = null;
  $(".list_shop_next_cate li").mouseenter(function() {
    var that = $(this);
    if (req_next_cate != null) req_next_cate.abort();
    if (req_next_gender != null) req_next_gender.abort();
    if (req_next_subact != null) req_next_subact.abort();
    if (req_next_type != null) req_next_type.abort();
    if (req_next_brand != null) req_next_brand.abort();
    var section_sep = $("#separate_section").val();
    var seller = '';
    var gender_url = '';
    var discount_url = '';
    var seller_url = '';
    var price_url = '';
    var user = $("#User_Id").val();
    if (section_sep == 'gender') {
      var gender = $("#gender_selection_hover").val();
      var url = '&gender=' + gender;
      var gender_url = '/g-' + gender.replace(/\ /g, "-").toLowerCase();
    } else if (section_sep == 'discount') {
      var discount = $(".list_shop_next_cate_sep .hover_shop_next_sep_offer").find('#shop_gender_name_li').val();
      var url = '&discount=' + discount;
      discount_url = '/d-' + discount.replace(/\ /g, "-").replace('%', '').toLowerCase();
    } else if (section_sep == 'seller') {
      var seller = $(".list_shop_next_cate_sep .hover_shop_next_sep_offer").find('#shop_gender_name_li').val();
      var url = '&seller=' + seller;
      seller_url = '/r-' + seller.replace(/\ /g, "-").toLowerCase();
    } else if (section_sep == 'price') {
      var price = $(".list_shop_next_cate_sep .hover_shop_next_sep_offer").find('#shop_gender_name_li').val();
      price_url = '/p-' + price.replace(/\ /g, "-").replace('---', '-');
    }
    timercat = setTimeout(function() {
      $(".list_shop_next_cate li.hover_shop_next_cat").removeClass("hover_shop_next_cat");
      $(that).addClass("hover_shop_next_cat");
      $(".list_shop_next_cate li.hover_shop_next_cat_new").removeClass("hover_shop_next_cat_new");
      $(that).addClass("hover_shop_next_cat_new");
      if ($(that).hasClass("hover_shop_next_cat_new")) {
        var category_name = $(that).find("#shop_cate_name_li").val();
        $("#category_query_value").val(category_name);
        var view_va = $("input[id=view_value]:last").val();
        $(".Brand_Section_Hover_Gender").addClass("hover_shopext_cl_wid");
        $(".Discount_Section_Hover").addClass("hover_shopext_cl_wid");
        $(".Seller_Section_Hover").addClass("hover_shopext_cl_wid");
        $(".Brand_list_Section_Hover").addClass("hover_shopext_cl_wid");
        $(".Price_list_Section_Hover").addClass("hover_shopext_cl_wid");
        $(".Price_list_Section_Hover").hide();
        $(".Brand_list_Section_Hover").hide();
        $(".Seller_Section_Hover").hide();
        $(".Discount_Section_Hover").hide();
        $(".Brand_Section_Hover_Gender").hide();
        $(".Discount_Section_Hover").hide();
        $(".Seller_Section_Hover").hide();
        $(".Brand_Section_Hover").hide();
        $(".show_loading_for_cat_s").show();
        var section = 'shop';
        var For = 'Personal';
        req_next_cate = $.ajax({
          type: 'POST',
          url: "/Filter/get_next",
          data: "§ion=" + section + "&category_name=" + category_name + "&For=" + For + url,
          beforeSend: function() {},
          success: function(msg) {
            $(".show_loading_for_cat_s").hide();
            $(".show_apply_for_cat_s_shop").show();
            if (msg) {
              if (For == 'Personal') {
                http: var path_company_url = '/prices' + seller_url + '/c-' + category_name.replace(/\ /g, "-").toLowerCase() + price_url + discount_url + gender_url;
              } else {
                if (category_name == 'fashion - clothing') {
                  category_name = 'fashion';
                }
                var path_company_url = '/prices/c-' + category_name.replace(/\ /g, "-").toLowerCase() + "/for-business";
              }
              $(".show_apply_for_cat_s_shop a").attr("href", path_company_url);
              $(".show_apply_for_cat_s_shop").show();
              $(".Brand_Section_Hover_Gender .gender_subsection ul li.nav-hover-font").remove();
              $(".Price_list_Section_Hover").hide();
              $(".Brand_list_Section_Hover").hide();
              $(".Seller_Section_Hover").hide();
              $(".Discount_Section_Hover").hide();
              $(".Brand_Section_Hover_Gender").show();
              var obj = jQuery.parseJSON(msg);
              if (obj.gender) {
                $(".Discount_Section_Hover").hide();
                $.each(obj.gender, function(key, value) {
                  if (For == 'Personal') {
                    if (category_name == 'fashion - clothing') {
                      category_name = 'fashion';
                    }
                    $(".Brand_Section_Hover_Gender .gender_subsection ul").append('<li class="nav-hover-font gender_for_load_n"><input type="hidden" id="shop_gender_name_li" value="' + key + '">   <a href="/prices/c-' + category_name.replace(/\ /g, "-").toLowerCase() + '/g-' + key.replace(/\ /g, "-").toLowerCase() + gender_url + '">' + capitalized_string(key) + '<span class="ar_ma_sh_co_i_url">></span> </a></li>');
                  } else {}
                });
                shop_hover_gender_list();
              } else if (obj.subcat) {
                $(".Brand_Section_Hover_Gender").hide();
                $(".Discount_Section_Hover .discount_subsection ol li.nav-hover-font").remove();
                $(".Discount_Section_Hover .discount_subsection .hover_header_h1").html("Sub-Category");
                $(".Discount_Section_Hover").show();
                $(".Discount_Section_Hover .price_subsection").hide();
                var subcat_count = obj.subcat_count;
                if (parseInt(subcat_count) > 12) {
                  $(".count_view_more_btn_all_subcat").show();
                } else {
                  $(".count_view_more_btn_all_subcat").hide();
                }
                var subs = 0;
                var subsv = 0;
                var class_name = '';
                $.each(obj.subcat, function(key, value) {
                  key_url = key.replace('-', '_');
                  if (subs == 0) {
                    class_name_new = 'hover_shop_next_subact hover_subcat_latest_top';
                  } else {
                    class_name_new = '';
                  }
                  if (category_name == 'fashion - clothing') {
                    category_name = 'fashion';
                  }
                  if (subs % 12 == 0) {
                    subsv++;
                  }
                  if (parseInt(subs) >= 12) {
                    class_name_new += ' _xsdpnon';
                  }
                  if (For == 'Personal') {
                    $(".Discount_Section_Hover .discount_subsection ol").append('<li class="nav-hover-font gender_for_load_n ' + class_name_new + '" id="subcategory' + subsv + '"> <input type="hidden" id="shop_subcat_name_li" value="' + key + '"> <a href="/prices/c-' + category_name.replace(/\ /g, "-").toLowerCase() + '/s-' + key_url.replace(/\ /g, "-").replace('/','%2f').toLowerCase() + gender_url + '">' + capitalized_string(key) + '<span class="ar_ma_sh_co_i_url">></span></a></li>');
                  } else {}
                  subs++;
                });
                if (parseInt(subcat_count) > 10) {
                  $("#total_current_sub").val(subsv);
                  $("#current_sub").val(1);
                  $("#subcategory_section_prev").hide();
                  $("#subcategory_section_next").show();
                  $("#subcategory_next").show();
                } else {
                  $("#subcategory_next").hide();
                }
                $(".Discount_Section_Hover").show();
                $("#main_hover_store_section").show();
                shop_hover_subcat_list();
                shop_hover_subcat_list_new();
              }
            }
          }
        });
      }
    }, 1000);
  }).mouseleave(function() {
    clearTimeout(timercat);
  });
}

function shop_hover_gender_list_new() {
  var req_next_gender = null;
  var req_next_brand = null;
  var req_next_cate = null;
  var req_next_subact = null;
  var req_next_type = null;
  if (req_next_gender != null) req_next_gender.abort();
  if (req_next_cate != null) req_next_cate.abort();
  if (req_next_subact != null) req_next_subact.abort();
  if (req_next_type != null) req_next_type.abort();
  if (req_next_brand != null) req_next_brand.abort();
  var category_name = 'baby and kids';
  $(".Price_list_Section_Hover").hide();
  $(".Brand_list_Section_Hover").hide();
  $(".Seller_Section_Hover").hide();
  $(".Discount_Section_Hover").hide();
  $(".Brand_Section_Hover").hide();
  $(".show_loading_for_cat_s").show();
  var gender = $(".Brand_Section_Hover_Gender .gender_subsection ul .hover_shop_next_gender").find('#shop_gender_name_li').val();
  var separate_s = $("#separate_section").val();
  var discount_url = '';
  var seller_url = '';
  var price_url = '';
  discount = '';
  price = '';
  seller = '';
  var gender_url = '';
  if (separate_s == 'gender') {
    var gender = $("#gender_selection_hover").val();
    var url = '/g-' + gender;
    var gender_url = '/g-' + gender.replace(/\ /g, "-").toLowerCase();
  } else if (separate_s == 'discount') {
    discount = $("#separate_section_value").val();
    discount_url = '/d-' + discount.replace(/\ /g, "-").replace('%', '').toLowerCase();
  } else if (separate_s == 'price') {
    price = $("#separate_section_value").val();
    price_url = '/p-' + price.replace(/\ /g, "-").replace('---', '-');
  } else if (separate_s == 'seller') {
    seller = $("#separate_section_value").val();
    seller_url = '/r-' + seller.replace(/\ /g, "-").replace('%', '').toLowerCase();
  }
  $(".Brand_Section_Hover_Gender .gender_subsection ul li").removeClass("hover_shop_next_gender");
  $(this).addClass("hover_shop_next_gender");
  var section = 'shop';
  var For = $("#for_value").val();
  var view_va = $("input[id=view_value]:last").val();
  For = 'Personal';
  req_next_gender = $.ajax({
    type: 'POST',
    url: "/Filter/get_next",
    data: "§ion=" + section + "&category_name=" + category_name + "&For=" + For + "&gender=" + gender + "&viewlist=" + view_va + "&discount=" + discount + "&price=" + price + "&seller=" + seller,
    beforeSend: function() {},
    success: function(msg) {
      $(".show_loading_for_cat_s").hide();
      if (msg) {
        if (category_name == 'fashion - clothing') {
          category_name = 'fashion';
        }
        if (For == 'Personal') {
          var path_company_url = '/prices' + gender_url + '/c-' + category_name.replace(/\ /g, "-").toLowerCase() + price_url + discount_url + '/g-' + gender.replace(/\ /g, "-").toLowerCase();
        } else {
          var path_company_url = '/prices/c-' + category_name.replace(/\ /g, "-").toLowerCase() + '/g-' + gender.replace(/\ /g, "-").toLowerCase() + '/for-business';
        }
        $(".show_apply_for_cat_s_shop a").attr("href", path_company_url);
        $(".Discount_Section_Hover .discount_subsection ol li.nav-hover-font").remove();
        $(".Discount_Section_Hover .discount_subsection .hover_header_h1").html("Sub-Category");
        $(".Discount_Section_Hover").show();
        $(".Discount_Section_Hover .price_subsection").hide();
        $(".Price_list_Section_Hover").hide();
        $(".Brand_list_Section_Hover").hide();
        $(".Seller_Section_Hover").hide();
        var obj = jQuery.parseJSON(msg);
        if (obj.gender && parseInt(obj.gender_count) > 1) {
          $(".Brand_Section_Hover_Gender .gender_subsection ul").empty();
          $.each(obj.gender, function(key, value) {
            if (For == 'Personal') {
              $(".Brand_Section_Hover_Gender .gender_subsection ul").append('<li class="nav-hover-font gender_for_load_n"><input type="hidden" id="shop_gender_name_li" value="' + key + '">   <a href="/prices' + seller_url + '/c-' + category_name.replace(/\ /g, "-").toLowerCase() + '/g-' + key.replace(/\ /g, "+").toLowerCase() + discount_url + price_url + '">' + capitalized_string(key) + '<span class="ar_ma_sh_co_i_url">></span> </a></li>');
            } else {}
          });
          $(".Brand_Section_Hover_Gender").show();
          $("#main_hover_store_section").show();
          shop_hover_gender_list();
        } else if (obj.subcat) {
          if (category_name == 'fashion - clothing') {
            category_name = 'fashion';
          }
          var subcat_count = obj.subcat_count;
          if (parseInt(subcat_count) > 12) {
            $(".count_view_more_btn_all_subcat").show();
            if (For == 'Personal') {
              var path_company_url = '/prices/c-' + category_name.replace(/\ /g, "-").toLowerCase() + '/g-' + gender.replace(/\ /g, "-").toLowerCase();
            } else {
              var path_company_url = '/prices/c-' + category_name.replace(/\ /g, "-").toLowerCase() + '/g-' + gender.replace(/\ /g, "-").toLowerCase() + '/for-business';
            }
            $(".count_view_more_btn_all_subcat a").attr("href", path_company_url);
          } else {
            $(".count_view_more_btn_all_subcat").hide();
          }
          $(".Discount_Section_Hover .discount_subsection ol").empty();
          var subs = 0;
          var subsv = 0;
          var class_name = '';
          $.each(obj.subcat, function(key, value) {
            if (subs == 0) {
              class_name_new = 'hover_shop_next_subact hover_subcat_latest_top';
            } else {
              class_name_new = '';
            }
            if (subs % 10 == 0) {
              subsv++;
            }
            if (parseInt(subs) >= 10) {
              class_name = '_xsdpnon';
            }
            if (For == 'Personal') {
              $(".Discount_Section_Hover .discount_subsection ol").append('<li class="nav-hover-font gender_for_load_n ' + class_name_new + '" id="subcat' + subsv + '"> <input type="hidden" id="shop_subcat_name_li" value="' + key + '"> <a href="/prices' + seller_url + '/c-' + category_name.replace(/\ /g, "-").toLowerCase() + '/s-' + key.replace(/\ /g, "-").replace('/','%2f').toLowerCase() + '/g-' + gender.replace(/\ /g, "-").toLowerCase() + discount_url + price_url + '">' + capitalized_string(key) + '<span class="ar_ma_sh_co_i_url">></span></a></li>');
            } else {}
            subs++;
          });
          if (parseInt(subcat_count) > 10) {
            $("#total_current_sub").val(subsv);
            $("#current_sub").val(1);
            $("#subcategory_section_prev").hide();
            $("#subcategory_section_next").show();
            $("#subcategory_next").show();
          } else {
            $("#subcategory_next").hide();
          }
        }
        $(".Discount_Section_Hover").show();
        $("#main_hover_store_section").show();
        shop_hover_subcat_list();
        shop_hover_subcat_list_new();
      }
    }
  });
}
var timersubcat;
var timertype;
var req_next_cate_cate = null;
var req_next_cate_gender = null;
var req_next_cate_subcat = null;
var req_next_cate_type = null;
var req_next_cate_brand = null;
var rating_all = [];
var similar_all = [];
var view_more_all = [];
var checkQrunning;
var lazyloadscroll_all = null;

function selectview(view, part) {
  var control = $("#ControllerName").val()
  var url = window.location.href;
  url = url.replace('refine=1', '');
  var user = $("#User_Id").val();
  url_main = url.split('&viewlist');
  url_imp = url.split('?');
  if (control == 'prices') {
    if (req_query != null) req_query.abort();
    if (bestmaincall_all.length != 0) {
      for (var i = 0; i < bestmaincall_all.length; i++)
        bestmaincall_all[i].abort();
    }
    if (searchtoolcall_call.length != 0) {
      for (var i = 0; i < searchtoolcall_call.length; i++)
        searchtoolcall_call[i].abort();
    }
    if (likecall_all.length != 0) {
      for (var i = 0; i < likecall_all.length; i++)
        likecall_all[i].abort();
    }
    if (seller_newmaincall_all.length != 0) {
      for (var i = 0; i < seller_newmaincall_all.length; i++)
        seller_newmaincall_all[i].abort();
    }
    if (checkQrunning == 1) {
      var checkQrunning_final = checkQrunning;
    } else {
      var checkQrunning_final = 2;
    }
  } else {
    if (rating_all.length != 0) {
      for (var i = 0; i < rating_all.length; i++)
        rating_all[i].abort();
    }
    if (similar_all.length != 0) {
      for (var i = 0; i < similar_all.length; i++)
        similar_all[i].abort();
    }
    if (view_more_all.length != 0) {
      for (var i = 0; i < view_more_all.length; i++)
        view_more_all[i].abort();
    }
    if (lazyloadscroll_all != null) lazyloadscroll_all.abort();
    if (checkQrunning == 1) {
      var checkQrunning_final = checkQrunning;
    } else {
      var checkQrunning_final = 2;
    }
  }
  if (view != url_main[1]) {
    if (url_imp[1] != '' && url_imp[1] != undefined) {
      path = url_imp[0] + "?" + url_imp[1] + "&viewlist=" + view;
    } else {
      path = url_imp[0] + "?viewlist=" + view;
    }
  }
  var home = $('#Home').val();
  var parse = $("#Parse_Value").val();
  var search = $("#Search").val();
  var user = $("#User_Id").val();
  
  if ((part == 0 || part == 1)) {
    if (home == 'main' || (control != 'prices' && search != "" && search != 0) || parse == 'yes' || (home == '' && control != 'prices')) {
      if (part == 0) {
        $("div.store_enti_sec").show();
        $("div.inner-details-shop").hide();
        $("ul.inner-details-shop").hide();
        $("#all_prices").removeClass('btn-default');
        $("#all_prices").addClass('btn-primary');
        $("#all_prices").addClass('active');
        $("#adv_prices").addClass('btn-default');
        $("#adv_prices").removeClass('btn-primary');
        $("#adv_prices").removeClass('active');
        if (control == 'offers') {
          $("#view_all_section_buttons").show();
        }
      } else if (part == 1) {
        $("div.store_enti_sec").hide();
        $("div.inner-details-shop").show();
        if (home == 'main' || parse == 'yes') {
          $("ul.inner-details-shop").show();
        }
        $("#all_prices").addClass('btn-default');
        $("#all_prices").removeClass('btn-primary');
        $("#all_prices").removeClass('active');
        $("#adv_prices").removeClass('btn-default');
        $("#adv_prices").addClass('btn-primary');
        $("#adv_prices").addClass('active');
        if (control == 'offers') {
          $("#view_all_section_buttons").hide();
        }
      }
      if (control == 'offers' && part!=1) {
        cashback_for_search_home(0);
      }
    } else {
      this.$backdrop = $('<div class="modal-backdrop fade in " />')
        .appendTo(document.body)
      $(".loading_image_selection").show();
      if (part == 1) {
        path = path.concat('&refine=1');
      } else {
        path = path.replace("&refine=1", "");
      }
      if (home == 'main') {
        path = path.concat("&home_page=yes");
      }
      var device = $("input[id='device_type']:last").val();
      if (device != undefined && device != '' && device != null) {
        path = path.concat('&device=' + device);
      }
      req_query = $.ajax({
        type: 'GET',
        url: path + "&sidebar=yes&pageview=shop&view_change=yes",
        data: {},
        beforeSend: function() {},
        success: function(data) {
          $('.loading_image_selection').hide();
          $(".modal-backdrop").remove();
          $('#Home_Content').html(data);
          if (control == 'prices') {
            $("input[id='view_value']").val(view);
          }
          if (control == 'offers') {
            var selected_view = $("input[id='selected_view']:last").val();
            var online_count = $("input[id='tot_cnt_online']:last").val();
            var user = $("#User_Id").val();
            // if(user == 54204){
            // 	alert(selected_view);
            // }
            if (online_count == 0) {
              $(".online_offers_section").show();
            }
            var selected_area = '';
            if (selected_view == 'cashback') {
              selected_area = 'online';
            } else if (selected_view == 'all') {
              selected_area = 'online';
            }
            if (parseInt(online_count) > 0) {
              show_nextoffline(selected_view, '', '0', selected_area);
            }
            var show_cashback = $("input[id='show_cashback']").val();
            var type_cashback = $("input[id='show_type']").val();
            var show_f = 0;
            var home = $("#Home").val();
            if (home == 'main') {
              cashback_for_search_home(0);
            } else {
              if (show_cashback == 1 || type_cashback == 1 || show_cashback == 0) {
                if (show_cashback == 0) {
                  show_f = 0;
                } else if (show_cashback == 1) {
                  show_f = 1;
                }
                if (parseInt(online_count) > 0) {
                  if (selected_view == 'all') {
                    cashback_for_search(0);
                  } else {
                    cashback_for_search(show_f);
                  }
                }
              }
            }
          }
          if (control == 'prices') {
            LikeCall();
            var device_value = $("#device_type").val();
            var user = $("#User_Id").val();
            if ((device_value == 'Mobile' && view !== 'list') || (device_value == 'Desktop') || (device_value == 'Tablet')) {
              Category_Call();
            }
            if (view == 'lite') {
              seller_new_price_lite();
            }
          }
          if ($("#Home").val() == 'main') {
            Run_Brand_carousel();
          }
          if (checkQrunning_final == 1) {}
        },
      });
    }
  } else {
    var home = $("#Home").val();
    var user = $("#User_Id").val();
    this.$backdrop = $('<div class="modal-backdrop fade in " />')
      .appendTo(document.body)
    $(".loading_image_selection").show();
    if (part == 1) {
      path = path.concat('&refine=1');
    } else {
      path = path.replace("&refine=1", "");
    }
    if (home == 'main') {
      path = path.concat("&home_page=yes");
    }
    var device = $("input[id='device_type']:last").val();
    if (device != undefined && device != '' && device != null) {
      path = path.concat('&device=' + device);
    }
    req_query = $.ajax({
      type: 'GET',
      url: path + "&sidebar=yes&pageview=shop&view_change=yes",
      data: {},
      beforeSend: function() {},
      success: function(data) {
        $('.loading_image_selection').hide();
        $(".modal-backdrop").remove();
        $('#Home_Content').html(data);
        var user = $("#User_Id").val();
        if (control == 'prices') {
          $("input[id='view_value']").val(view);
        }
        if (control == 'offers') {
          var selected_view = $("input[id='selected_view']:last").val();
          var online_count = $("input[id='tot_cnt_online']:last").val();
          var user = $("#User_Id").val();
          if (online_count == 0) {
            $(".online_offers_section").show();
          }
          var selected_area = '';
          if (selected_view == 'cashback') {
            selected_area = 'online';
          } else if (selected_view == 'all') {
            selected_area = 'online';
          }
          if (parseInt(online_count) > 0) {
            show_nextoffline(selected_view, '', '0', selected_area);
          }
          var show_cashback = $("input[id='show_cashback']").val();
          var type_cashback = $("input[id='show_type']").val();
          var home = $("#Home").val();
          if (home == 'main') {
            cashback_for_search_home(0);
          } else {
            if (show_cashback == 1 || type_cashback == 1) {
              if (parseInt(online_count) > 0) {
                if (selected_view == 'all') {
                  cashback_for_search(0);
                } else {
                  cashback_for_search();
                }
              }
            }
          }
        }
        if (control == 'prices') {
          LikeCall();
          var device_value = $("#device_type").val();
          var user = $("#User_Id").val();
          if ((device_value == 'Mobile' && view !== 'list') || (device_value == 'Desktop') || (device_value == 'Tablet')) {
            Category_Call();
          }
          if (view == 'lite') {
            seller_new_price_lite();
          }
        }
        if ($("#Home").val() == 'main') {
          Run_Brand_carousel();
        }
        if (checkQrunning_final == 1) {}
      },
    });
  }
}
function notification_show_guest() {
  $(".main_notification").show();
}

function show_login_guest() {
  $(".main_notification").hide();
}

function notification_close() {
  var user = $("#User_Id").val();
  $.ajax({
    type: "POST",
    url: "/Connect/notification_close",
    data: "user=" + user,
    success: "success",
    dataType: 'text',
    context: document.body
  }).done(function(msg) {
  });
}

function push_notification() {
  var user = $("#User_Id").val();
  var count = $("#notification_full_count").val();
  // count =2 ;
  if (user == 0 || user == '' || user == undefined) {
    user = 0;
  }
  if (parseInt(count) > 0) {
    $.ajax({
      type: "POST",
      url: "/Connect/push_notification",
      data: "user=" + user,
      success: "success",
      dataType: 'text',
      context: document.body
    }).done(function(msg) {
      $(".push_notification_area").html(msg);
      var notification_count = $(".notification_details_res").val();
      if (notification_count == 1) {
        $(".glyphicon-bell-notifi").show();
        var notification_checked = $(".notification_checked").val();
        var total_count = $("#notification_full_count").val();
        if (parseInt(total_count) > 0) {
          $(".label_notifi_head").text(total_count);
        }
        if (parseInt(notification_checked) > 0) {
          $(".user_notifi_sec_noti").show();
          $(".glyphicon-bell-notifi").css('color', '#FF0000');
        }
        notification_close();
      } else {
      }
      
    });
  }
}

function notification_show() {
  $("div.user_notifi_sec_noti").show();
  var flag = $("#notification_image_flag").val();
  if (flag == 0) {
    $.ajax({
      type: "POST",
      url: "/Connect/push_notification_image",
      success: "success",
      dataType: 'text',
      context: document.body
    }).done(function(msg) {
      $("#pusha_add_careousel").html(msg);
      $(".push_notification_image_section").fadeIn("slow");
      $("#notification_image_flag").val(1);
      $("#pusha_add_careousel").owlCarousel({
        autoPlay: 3000,
        stopOnHover: true,
        items: 1,
        navigation: true,
        pagination: false
      });
      $(".owl-prev").html('<i class="glyphicon glyphicon-menu-left"></i>');
      $(".owl-next").html('<i class="glyphicon glyphicon-menu-right"></i>');
      $(".owl-prev").addClass('pull-left');
      $(".owl-next").addClass('pull-right');
    });
  }
}

function close_notification(id) {
  var user = $("#User_Id").val();
  var count = $("#notification_full_count").val();
  var new_count = parseInt(count) - 1;
  $("#notification_full_count").val(new_count);
  if (new_count == 0) {
    $(".main_notification").hide();
  }
  $.ajax({
    type: "POST",
    url: "/Connect/close_notification",
    data: "user=" + user + "&id=" + id,
    success: "success",
    dataType: 'text',
    context: document.body
  }).done(function(msg) {
    $("#notification_div" + id).remove();
  });
}

function close_notification_all() {
  $(".main_notification").hide();
  var user = $("#User_Id").val();
  $.ajax({
    type: "POST",
    url: "/Connect/close_notification_all",
    data: "user=" + user,
    success: "success",
    dataType: 'text',
    context: document.body
  }).done(function(msg) {
  });
}
$(document).scroll(function() {
  if ($(this).scrollTop() > 0) {
    $('.ft_btn').css('display', 'block');
  } else {
    $('.ft_btn').css('display', 'none');
  }
});

// menu
$(document).click(function() {
  $('#navbartogmnu').click(function() {
    $('.gn-menu-wrapper').addClass('gn-open-all');
    $('.navbar-toggle').addClass('nav-dissaper');
    $('.custom-aside').removeClass('going').addClass('coming');
    $("body").removeClass('scroll');
    $('.pull-me').css('display', 'none');
    $('.icon-bar,.text-menu').hide();
    $('.menu-close').fadeIn();
    $('.push-me').fadeOut();
  });
  $('.menu-close').click(function() {
    $('.gn-menu-wrapper').removeClass('gn-open-all');
    $('.menu-close').hide();
    $('.text-menu,.push-me,.icon-bar,#push-me').fadeIn();
    setTimeout(function()
      {
        $('.mymenu').removeClass('mymenu_show');
      }, 800);
    $('.menu-icon').show(1000);
  });
  
});

$(document).on('click', ".mn-link-more", function(event) {
  if ($(".open.store_sort_menu_category").hasClass("dskhide")) {
    $(".open.store_sort_menu_category").removeClass("dskhide");
    $(".open.store_sort_menu_category").show();
    $(".mn-link-more").addClass("active");
  } else {
    $(".open.store_sort_menu_category").addClass("dskhide");
    $(".open.store_sort_menu_category").hide();
    $(".mn-link-more").removeClass("active");
  }
});
$(document).on('click', ".mn-link-more", function(event) {
  if ($(".open.offer_sort_menu_category").hasClass("dskhide")) {
    $(".open.offer_sort_menu_category").removeClass("dskhide");
    $(".open.offer_sort_menu_category").show();
    $(".mn-link-more .glyphicon").addClass("glyphicon-menu-up");
    $(".mn-link-more .glyphicon").removeClass("glyphicon-menu-down");
  } else {
    $(".open.offer_sort_menu_category").addClass("dskhide");
    $(".open.offer_sort_menu_category").hide();
    $(".mn-link-more .glyphicon").addClass("glyphicon-menu-down");
    $(".mn-link-more .glyphicon").removeClass("glyphicon-menu-up");
  }
});
// close sort
/*-----*/
jQuery(document).ready(function() {
  jQuery('.glyphicon-bell-notifi-guest').on('click', function(event) {
    jQuery('.main_notification_guest').toggle('show');
  });
  jQuery('.sortbtnlk').on('mouseover', function(event) {
    jQuery('.store_sort_menu').toggle();
    jQuery('.offer_sort_menu').toggle();
  });
  $("li#cashlsthd .list-hd").addClass("fntlsthd");
  $(document).on('click', "li[id='cashlsthd'] .list-hd", function(event) {
    if ($(this).hasClass("fntlsthd")) {
      $(this).removeClass("fntlsthd");
    } else {
      $(this).addClass("fntlsthd");
    }
  });
  $(document).on('click', "li[id='cashlsthd'] .list-hd", function(event) {
    if ($(this).find('.glyphicon').hasClass("glyphicon-menu-down")) {
      $(this).find('.glyphicon').removeClass("glyphicon-menu-down");
      $(this).find('.glyphicon').addClass("glyphicon-menu-up");
    } else if ($(this).find('.glyphicon').hasClass("glyphicon-menu-up")) {
      $(this).find('.glyphicon').removeClass("glyphicon-menu-up");
      $(this).find('.glyphicon').addClass("glyphicon-menu-down");
    }
  });
  if (navigator.userAgent.search("Firefox") >= 0) {
    $('body').addClass('onlyfirebox');
  }
});
/*-----*/

$(document).on('mouseover', "ul.link_ul.head-list li", function(event) {
  $('.main-hover-store').removeClass("mnoff");
});
$(document).on('mouseleave', '._xrheader', function() {
  var control = $("#ControllerName").val();
  
});
$(document).on('mouseover', ".navbar", function(event) {
  $('.main-hover-store').removeClass("mnoff");
});
$(document).on('mouseover', ".main_sc_hd", function(event) {
  $('.main-hover-store').addClass("mnoff");
});
$(document).on('click', ".li_show_instock_side", function(event) {
  if ($(this).find('.glyphicon').hasClass("checked")) {
    $(this).addClass("active");
    $(".li_show_outstock_side").removeClass("active");
  }
});
$(document).on('click', ".li_show_outstock_side", function(event) {
  if ($(this).find('.glyphicon').hasClass("checked")) {
    $(this).addClass("active");
    $(".li_show_instock_side").removeClass("active");
  }
});

function capitalized_string(string) {
  var string_arry = string.split(" ");
  var list_name = ["a", "an", "and", "are", "as", "at", "be", "but", "by", "for", "if", "in", "into", "is", "it", "no", "not", "of", "on", "or", "such", "that", "the", "their", "then", "there", "these", "they", "this", "to", "was", "will", "with"];
  var myArray_list = [];
  var mmm = 0;
  for (var i = 0; i < string_arry.length; i++) {
    if (list_name.indexOf(string_arry[i].toLowerCase()) > -1 && mmm > 0) {
      myArray_list[mmm] = string_arry[i];
    } else {
      if (string_arry[i] != '' && string_arry[i] != undefined) {
        myArray_list[mmm] = string_arry[i][0].toUpperCase() + string_arry[i].slice(1);
      }
    }
    mmm++;
  }
  return myArray_list.join(" ");
}

function share_location_keyword(section_name, search_keyword, customer, view_type, main_control, share_push_pop, share_push_sec) {
  if (navigator.geolocation) {
    var login_popup_sss_positionOptions = {
      enableHighAccuracy: true,
    };
    navigator.geolocation.getCurrentPosition(login_popup_sss_geolocationSuccess, login_popup_sss_geolocationError, login_popup_sss_positionOptions);
  }

  function login_popup_sss_geolocationError(positionError) {
    // if user not shared location entering this loop
    if (share_push_pop == 'share popup') {
      var share_push_pop1 = "no loc";
      suggestions_share_location(section_name, search_keyword, customer, view_type, main_control, share_push_pop1, share_push_sec);
    } else {
      window.location.href = '/' + section_name + "?q=" + encodeURIComponent(search_keyword);
    }
  }

  function login_popup_sss_geolocationSuccess(position) {
    lat1 = position.coords.latitude
    lng2 = position.coords.longitude
    latitude99 = position.coords.latitude
    longitude99 = position.coords.longitude
    var userLatLng = new google.maps.LatLng(lat1, lng2);
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        "location": userLatLng
      },
      function(results, status) {
        text9 = results[0].formatted_address;
        address99 = results[0].formatted_address;
        if (status == google.maps.GeocoderStatus.OK) {
        } else {
          document.getElementById("error").innerHTML += "Unable to retrieve your address" + "<br />";
        }
      });
    var latlng = new google.maps.LatLng(lat1, lng2);
    geocoder.geocode({
      'latLng': latlng
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[1]) {
          address99 = results[0].formatted_address;
          for (var i = 0; i < results[0].address_components.length; i++) {
            for (var b = 0; b < results[0].address_components[i].types.length; b++) {
              if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                city2 = results[0].address_components[i];
                state_name = city2.long_name;
              }
              if (results[0].address_components[i].types[b] == "locality") {
                city1 = results[0].address_components[i];
                location12 = city1.long_name;
              }
              if (results[0].address_components[i].types[b] == "sublocality_level_1") {
                city = results[0].address_components[i];
                location13 = city.long_name + "";
              }
              if (results[0].address_components[i].types[b] == "country") {
                country = results[0].address_components[i];
                country_name = country.long_name + "";
              }
            }
          }
          var path_share = "";
          var latitude_L = '';
          var longitude_L = '';
          var results1 = '';
          var status1 = '';
          geocoder.geocode({
            'address': location12
          }, function(results1, status1) {
            if (status1 == google.maps.GeocoderStatus.OK) {
              latitude_L = results1[0].geometry.location.lat();
              longitude_L = results1[0].geometry.location.lng();
            }
            if (latitude_L == latitude99) {
              location13 = 'All';
            };
            path_share = path_share.concat("sharearea=" + location13);
            path_share = path_share.concat("&sharearea1=" + area1);
            path_share = path_share.concat("&sharecity=" + location12);
            path_share = path_share.concat("&sharestate=" + state_name);
            path_share = path_share.concat("&sharecountry=" + country_name);
            path_share = path_share.concat("&latitude99=" + latitude99);
            path_share = path_share.concat("&longitude99=" + longitude99);
            if (share_push_pop == 'share popup') {
              var share_push_pop1 = "loc";
              suggestions_share_location(section_name, search_keyword, customer, view_type, main_control, share_push_pop1, share_push_sec, location13, area1, location12, state_name, country_name, latitude99, longitude99);
            } else {
              $.ajax({
                type: 'POST',
                url: "/Filter/save_share_details",
                data: path_share,
                beforeSend: function() {},
                success: function(data) {
                  window.location.href = '/' + section_name + "?q=" + encodeURIComponent(search_keyword);
                }
              });
            }
          });
        }
      } else {
        // geo location fails
        if (share_push_pop == 'share popup') {
          var share_push_pop1 = "no loc";
          suggestions_share_location(section_name, search_keyword, customer, view_type, main_control, share_push_pop1, share_push_sec);
        } else {
          window.location.href = '/' + section_name + "?q=" + encodeURIComponent(search_keyword);
        }
      }
    });
  }
}



function Store_userdate_share_loc(latitude99, longitude99, address99, location_type, location13, location12, section_share) {
  var show_allHH = $("#show_all_loc_shahh").val();
  if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    if (show_allHH != 1) {
      $("li#for_location_in_heade_full a.main_a").addClass("show_maHHSSSS");
      $("#show_all_loc_shahh").val(1);
      $(".show_maHHSSSS").find('.title_for_sectn_header2').css('cssText', 'color:#fff');
    };
  }
  $.ajax({
    url: "/cashback/save_usersharelocation_details",
    type: "POST",
    dataType: "json",
    data: {
      "shareLatitude": latitude99,
      "shareLongitude": longitude99,
      "shareAddress": address99,
      "type": location_type,
      "sharearea": location13,
      "sharecity": location12,
      "section": section_share,
    },
    success: function(data) {}
  });
}

function geolocateUser() {
  if (navigator.geolocation) {
    var positionOptions = {
      enableHighAccuracy: true,
    };
    navigator.geolocation.getCurrentPosition(geolocationSuccess, geolocationError, positionOptions);
  }
}

function geolocationError(positionError) {
  $(".share_location_dis").css("display", "none");
  $(".share_location_button_dis").css("display", "none");
  $(".show_text_location_dis").html('Sorry! We couldn\'t find Your Current Location.<br><span class="text_hilighted_popup" style="font-weight:bold;text-align:center;">Please enter Your Current Location below.</span>');
}

function geolocationSuccess(position) {
  lat1 = position.coords.latitude
  lng2 = position.coords.longitude
  latitude99 = position.coords.latitude
  longitude99 = position.coords.longitude
  var userLatLng = new google.maps.LatLng(lat1, lng2);
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({
      "location": userLatLng
    },
    function(results, status) {
      text9 = results[0].formatted_address;
      address99 = results[0].formatted_address;
      if (status == google.maps.GeocoderStatus.OK) {
      } else {
        document.getElementById("error").innerHTML += "Unable to retrieve your address" + "<br />";
      }
    });
  
  var latlng = new google.maps.LatLng(lat1, lng2);
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({
    'latLng': latlng
  }, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[1]) {
        address99 = results[0].formatted_address;
        for (var i = 0; i < results[0].address_components.length; i++) {
          for (var b = 0; b < results[0].address_components[i].types.length; b++) {
            if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
              city2 = results[0].address_components[i];
              state_name = city2.long_name;
            }
            if (results[0].address_components[i].types[b] == "locality") {
              city1 = results[0].address_components[i];
              location12 = city1.long_name;
            }
            if (results[0].address_components[i].types[b] == "sublocality_level_1") {
              city = results[0].address_components[i];
              location13 = city.long_name + "";
              area1 = city.long_name;
            }
            if (results[0].address_components[i].types[b] == "country") {
              country = results[0].address_components[i];
              country_name = country.long_name + "";
            }
          }
        }
        location_type = "share";
        var latitude_L = '';
        var longitude_L = '';
        var results1 = '';
        var status1 = '';
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({
          'address': location12
        }, function(results1, status1) {
          if (status1 == google.maps.GeocoderStatus.OK) {
            latitude_L = results1[0].geometry.location.lat();
            longitude_L = results1[0].geometry.location.lng();
          }
          if (latitude_L == latitude99) {
            location13 = 'All';
          };
          SelectOption('sharelocation', 14, location13, location13, 'basic');
          store_usersharelocdetails()
        });
      } else {
        alert("No results found");
      }
    }
  });
  $('#share-location-button45').modal('hide');
}

function initialize() {
  var autocomplete1 = new google.maps.places.Autocomplete(document.getElementById('autocomplete'));
  google.maps.event.addListener(autocomplete1, 'place_changed', function() {
    place = autocomplete1.getPlace();
    lati = place.geometry.location.lat();
    longi = place.geometry.location.lng();
    latitude99 = place.geometry.location.lat();
    longitude99 = place.geometry.location.lng();
  });
  jQuery(document).ready(function() {
    jQuery('#nearbyoff').click(function() {
      location13 = '';
      area1 = '';
      area2 = "";
      address99 = place.formatted_address;
      for (var i = 0; i < place.address_components.length; i++) {
        for (var b = 0; b < place.address_components[i].types.length; b++) {
          if (place.address_components[i].types[b] == "administrative_area_level_1") {
            city2 = place.address_components[i];
            state_name = city2.long_name;
          }
          if (place.address_components[i].types[b] == "locality") {
            city1 = place.address_components[i];
            location12 = city1.long_name;
          }
          if (place.address_components[i].types[b] == "country") {
            country = place.address_components[i];
            country_name = country.long_name + "";
          }
          if (place.address_components[i].types[b] == "sublocality_level_1") {
            city = place.address_components[i];
            location13 = city.long_name + "";
            area1 = city.long_name;
          }
        }
      }
      location_type = "enter";
      var latitude_L = '';
      var longitude_L = '';
      var results1 = '';
      var status1 = '';
      var geocoder = new google.maps.Geocoder();
      if (area1 == '') {
        var latlng = new google.maps.LatLng(lati, longi);
        geocoder.geocode({
          'latLng': latlng
        }, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            if (results[1]) {
              address99 = results[0].formatted_address;
              for (var i = 0; i < results[0].address_components.length; i++) {
                for (var b = 0; b < results[0].address_components[i].types.length; b++) {
                  if (results[0].address_components[i].types[b] == "sublocality_level_1") {
                    city = results[0].address_components[i];
                    area1 = city.long_name;
                  }
                  if (results[0].address_components[i].types[b] == "neighborhood") {
                    city = results[0].address_components[i];
                    area2 = city.long_name;
                  }
                }
              }
            }
          }
          if (area1 == '' && area2 != '') {
            area1 = area2;
          };
          $('#share-location-button45').modal('hide');
          SelectOption('sharelocation', 14, location13, location13, 'basic');
          store_usersharelocdetails()
        });
      } else {
        geocoder.geocode({
          'address': location12
        }, function(results1, status1) {
          if (status1 == google.maps.GeocoderStatus.OK) {
            latitude_L = results1[0].geometry.location.lat();
            longitude_L = results1[0].geometry.location.lng();
          }
          if (latitude_L == latitude99) {
            location13 = 'All';
          };
          SelectOption('sharelocation', 14, location13, location13, 'basic');
          store_usersharelocdetails()
        });
        $('#share-location-button45').modal('hide');
      }
    });
  });
}

function store_usersharelocdetails() {
  section_share = $("#ControllerName").val();
  var address99_url = address99.replace("'", "\'").replace('"', '');
  Store_userdate_share_loc(latitude99, longitude99, address99_url, location_type, location13, location12, section_share);
}

function openNav() {
  document.getElementById("lgnvmenu").style.width = "265px";
  $(".loginnav .closebtn").show();
  $("#login-drop").hide();
  $(".userh6").hide();
}

function closeNav() {
  document.getElementById("lgnvmenu").style.width = "0";
  $('body').css("overflow-y", "scroll");
  $(".loginnav .closebtn").hide();
  $("#login-drop").show();
  $(".userh6").show();
}
$(document).on("click", ".ntclose .glyphicon.glyphicon-remove", function() {
  $(".main_notification").css("display", "none");
});

$(document).on('click', "#buyerli", function(event) {
  $(".buyerlinav").removeClass("dsphide");
  $("#sellerli").removeClass("active");
  $("#buyerli").addClass("active");
  $(".sellerlinav").addClass("dsphide");
});
$(document).on('click', "#sellerli", function(event) {
  $(".sellerlinav").removeClass("dsphide")
  $(".sellerlinav").show();
  $("#sellerli").addClass("active");
  $("#buyerli").removeClass("active");
  $(".buyerlinav").addClass("dsphide");
});

function compare_open(store) {
  $("#compothernav" + store).removeClass("dsphide")
  $("#compothernav" + store).show();
  $(".compother" + store).addClass("active");
  $(".sdnewcmp" + store).removeClass("active");
  $("#componnav" + store).addClass('dsphide');
}

function compare_close(store) {
  $("#compothernav" + store).addClass("dsphide")
  $("#compothernav" + store).hide();
  $(".compother" + store).removeClass("active");
  $(".sdnewcmp" + store).addClass("active");
  $("#componnav" + store).removeClass('dsphide');
}

function coupon_hea_open() {
  var status = $("#status_hea").val();
  var cashback = $("#cashback_hea").val();
  var open_url = '';
  if (status == 'buyer') {
    if (parseInt(cashback) > 0) {
      open_url = 'https://www.xerve.in/myaccount/cash_balance';
    } else {
      open_url = 'https://www.xerve.in/cashback';
    }
  } else if (status == 'seller') {
    if (parseInt(cashback) > 0) {
      open_url = 'https://www.xerve.in/myaccount/creditreport';
    } else {
      open_url = 'https://www.xerve.in/pricing';
    }
  }
  window.open(open_url, '_self');
}

function wish_hea_open() {
  var status = $("#status_hea").val();
  var wish = $("#wishlist_hea").val();
  var open_url = '';
  if (status == 'buyer') {
    if (parseInt(wish) > 0) {
      open_url = 'https://www.xerve.in/myaccount/mywishlist';
    } else {
      open_url = 'https://www.xerve.in/prices';
    }
  } else if (status == 'seller') {
    if (parseInt(wish) > 0) {
      open_url = 'https://www.xerve.in/myaccount/my_leads';
    } else {
      open_url = 'https://www.xerve.in/leads';
    }
  }
  window.open(open_url, '_self');
}

function enquiry_hea_open() {
  var status = $("#status_hea").val();
  var enquiry = $("#enquiry_hea").val();
  var open_url = '';
  if (status == 'buyer') {
    if (parseInt(enquiry) > 0) {
      open_url = 'https://www.xerve.in/myaccount/my_enquiries';
    } else {
      open_url = 'https://www.xerve.in/genie';
    }
  } else if (status == 'seller') {
    if (parseInt(enquiry) > 0) {
      open_url = 'https://www.xerve.in/myaccount/price_request';
    } else {
      open_url = 'https://www.xerve.in/enquiries';
    }
  }
  window.open(open_url, '_self');
}

function brand_hea_open() {
  var status = $("#status_hea").val();
  var brand = $("#brand_hea").val();
  var open_url = '';
  if (status == 'buyer') {
    if (parseInt(brand) > 0) {
      open_url = 'https://www.xerve.in/myaccount/brand_clubs';
    } else {
      open_url = 'https://www.xerve.in/brands';
    }
  } else if (status == 'seller') {
    if (parseInt(brand) > 0) {
      open_url = 'https://www.xerve.in/myaccount/my_enquiries';
    } else {
      open_url = 'https://www.xerve.in/genie';
    }
  }
  window.open(open_url, '_self');
}
// SEARCH 

$(document).on('click', "#xrimgadds", function(event) {
  $('.xrhm_comd').show();
  $('.xrhm_comd2').hide();
  $('#xrimgadds').addClass("active");
  $('#Xrhwitwrk').removeClass("active");
});
$(document).on('click', "#Xrhwitwrk", function(event) {
  $('.xrhm_comd2').show();
  $('.xrhm_comd').hide();
  $('#Xrhwitwrk').addClass("active");
  $('#xrimgadds').removeClass("active");
});

var otherc = null;
var latestcall = null;
var popup_cancll_like = [];
var popup_cancll_colors = [];
var popup_cancll_same = [];
var popup_cancll_more = [];
var shop_detcall_main = null;
var bestcall_all = [];
var sizecall_all = [];
var ratingcall_all = [];

$(document).on("click", "#heading_comparison", function() {
  $("#Protcompare").addClass("active in");
  $("#BrandDescrp").removeClass("active in");
});
$(document).on("click", "#heading_descrptn", function() {
  $("#Protcompare").removeClass("active in");
  $("#BrandDescrp").addClass("active in");
});


$(window).scroll(function() {
  if ($(this).scrollTop() > 10) {
    $('.navmycc').css("display", "none");
    $('.main_sc_hd').addClass('_mbnavtop')
  } else {
    $('.navmycc').css("display", "block");
    $('.main_sc_hd').removeClass('_mbnavtop')
  }
});
// cashback
$(document).on("click", "#heading_comparison", function() {
  $("#Protcompare").addClass("active in");
  $("#BrandDescrp").removeClass("active in");
});
$(document).on("click", "#heading_descrptn", function() {
  $("#Protcompare").removeClass("active in");
  $("#BrandDescrp").addClass("active in");
});

$(document).on('click', 'button.close-cover-hover', function() {
  $("div.main-hover-store").hide();
});

if ($(window).width() < 700) {
  $("input").on("focus", function() {
    if ($(this).is(":focus")) {
      var $container = $(".modal.fade.in");
      var scrollTop = $container.scrollTop() + $(this).position().top;
      $('.modal.fade.in').animate({
        scrollTop: scrollTop
      }, 1000);
    }
  });
}

function userlocation() {
  $.ajax({
    type: "POST",
    url: '/Connect/user_location',
    success: "success",
    // dataType: 'text',
    // context: document.body
    async: true,
    dataType: 'text',
    beforeSend: function() {},
    success: function(msg) {
    if (msg != '' && msg != undefined && msg != null) {
      var obj = jQuery.parseJSON(msg);
      var latitude = obj.latitude;
      var longitude = obj.longitude;
      var city = obj.city;
      var state = obj.state;
      var country = obj.country;
      $("input[id='sharecity']:last").val(city);
      $("input[id='latitude']:last").val(latitude);
      $("input[id='longitude']:last").val(longitude);
      $("span[id='change_location_add']").text(city);
      $("#login_popup_buyer_longitude_f").val(longitude);
      $("#login_popup_buyer_latitude_f").val(latitude);
      $("#login_popup_buyer_city_f").val(city);
      $("#login_popup_buyer_country_f").val(country);
      $("#login_popup_buyer_state_f").val(state);
      $("#login_popup_buyer_longitude_g").val(longitude);
      $("#login_popup_buyer_latitude_g").val(latitude);
      $("#login_popup_buyer_city_g").val(city);
      $("#login_popup_buyer_country_g").val(country);
      $("#login_popup_buyer_state_g").val(state);
    }
  }
  });
}
//for the latest hover functionality
var delay=1000, setTimeoutConst;
var bestmaincall_all_search = [];

function search_external() {
  var search_keyword = $("#SearchSubCategory").val();
  search_keyword = search_keyword.replace(/\s*$/, "");
  suggestions_push();
}
$(document).on('submit', '#LeadAddForm', function(e) {
  e.preventDefault();
  var chk = $("#main_title").val();
  var select_type = $("#main_hidden_need").val();
  sub_url = '/genie?wish=' + chk;
  var win = window.open(sub_url, '_blank');
});
$(document).on('submit', '#LeadAddFormSearch', function(e) {
  e.preventDefault();
  var chk = $("#main_title").val();
  var select_type = $("#main_hidden_need").val();
  sub_url = '/genie?wish=' + chk;
  var win = window.open(sub_url, '_blank');
});
$(document).scroll(function() {
  var scrolldetail = $(window).scrollTop();
  if (scrolldetail > 0) {
    $('._xmargtshpther').addClass('details_scroll');
  }
});
$(window).scroll(function() {
  var scrollup = $(window).scrollTop();
  if (scrollup >= 800) {
    $('#scroll-top').show()
  } else {
    if (scrollup <= 800) {
      $('#scroll-top').hide()
    }
  }
});
  $(".head-list li").mouseleave(function(e) {
    if ($(window).width() > 1050) {
      var section = $(this).attr('id');
    }
  });
  $("#header-include-hover").mouseleave(function(event) {
    $(".head-list li").each(function() {
      $(this).css("border-top", "2px solid #fff");
    });
  });
  $(".main-section").mouseenter(function() {
    $("#filter_foot_sk_menu").hide();
    $(".head-list li").each(function() {
      $(this).css("border-top", "2px solid #fff");
    });
  });
function view_more_filter(section) {
  $("#Store_" + section).addClass('view_moreresult');
  $("#Store_" + section + " .filter_more").hide();
  $("#Store_" + section).scrollTo($('.bootstrap-select-searchbox'), 100);
        
}
// scroll Filter none
if (window.innerWidth < 760) {
  + function($) {
    $(document)
      .on('click', '.pull-me', function() {
        $(document.body).removeClass('modal-open')
      })
  }(jQuery);
}
function google_suggests(keyword)
{   $("input").attr("autocomplete", "on");
    $("#SearchSubCategory").val(keyword);
    suggestions();
    $(".suggestions_google").css({"border":"none"});
    $(".suggestions_google").hide();
    $("#SearchSubCategory").focus();
}
function SelectLoginOption(section) {
    if (section == 'Facebook') {
        $(".facebook_login_section").slideDown('fast');
        $(".facebook_login_section").show();
        $(".login_email_section").slideUp('fast');
        $('.login_email_section').hide();
        $("#TopSection_Login_Email i").removeClass("checked");
        $("#TopSection_Login_Email i").addClass("check-box");
        $("#TopSection_Login_Facebook i").addClass("checked");
        $("#TopSection_Login_Facebook i").removeClass("check-box");
    } else {
        $(".facebook_login_section").slideUp('fast');
        $(".facebook_login_section").hide();
        $(".login_email_section").slideDown('fast');
        $('.login_email_section').show();
        $("#TopSection_Login_Facebook i").removeClass("checked");
        $("#TopSection_Login_Facebook i").addClass("check-box");
        $("#TopSection_Login_Email i").addClass("checked");
        $("#TopSection_Login_Email i").removeClass("check-box");
    }
}
 function SelectLoginOptionMain(section) {
     if (section == 'Facebook') {
         $("#facebook_login_section_main").slideDown('fast');
         $("#facebook_login_section_main").show();
         $("#login_email_section_main").slideUp('fast');
         $('#login_email_section_main').hide();
         $("#TopSection_Login_Email_Main i").removeClass("checked");
         $("#TopSection_Login_Email_Main i").addClass("check-box");
         $("#TopSection_Login_Facebook_Main i").addClass("checked");
         $("#TopSection_Login_Facebook_Main i").removeClass("check-box");
     } else {
         $("#facebook_login_section_main").slideUp('fast');
         $("#facebook_login_section_main").hide();
         $("#login_email_section_main").slideDown('fast');
         $('#login_email_section_main').show();
         $("#TopSection_Login_Facebook_Main i").removeClass("checked");
         $("#TopSection_Login_Facebook_Main i").addClass("check-box");
         $("#TopSection_Login_Email_Main i").addClass("checked");
         $("#TopSection_Login_Email_Main i").removeClass("check-box");
     }
 }