function onLoad() {
  IN.User.logout();
}

function onLinkedInLoad() {
  IN.UI.Authorize().place();
  IN.Event.on(IN, "auth", function() {
    onLinkedInAuth();
  });
  IN.Event.on(IN, "logout", function() {
    onLogout();
  });
}

function onLinkedInAuth() {
  console.log('onLinkedInAuth');
  IN.API.Profile("me").fields("id,firstName,lastName,emailAddress,headline,distance,phoneNumbers").result(function(me) {
    var response = me.values[0];
    var controller = $("#ControllerName").val();
    var product_url = $("#skip-step").attr("href");
    $.ajax({
      type: "POST",
      url: "/Generals/linked_in_login",
      data: "id=" + response.id + "&email=" + response.emailAddress + "&first_name=" + response.firstName + "&gender=" + response.gender + "&last_name=" + response.lastName + "&product_url=" + product_url,
      success: "success",
      dataType: 'text',
      context: document.body
    }).done(function(msg) {
      var controller = $("#ControllerName").val();
      var obj = jQuery.parseJSON(msg);
      result = obj.id;
      status = obj.status_user;
      if (status == 'Yes') {
        if (controller == 'join') {
          window.location = "/myaccount";
        } else if (controller == 'companies' || controller == 'genie') {
          $("#login-popup-vendors").modal('hide');
          //$("#login-vendors").modal('hide');
          $('body').removeClass('modal-open');
          $(".modal-backdrop").remove();
          $("#quotesave").show();
          $("#quoteloginbutton").hide();
          $("#User_Id").val(result);
          $("#QuoteUserId").val(result);
          var submit = $("input[id='submit_clicked']:last").val();
          if (submit == 1) {
            lead_insert();
          }
        } else {
          location.reload();
        }
      } else {
        $("#mobile_pressence_linked").val(1);
        $("#email_pressence_linked").val(1);
        f_id = obj.id;
        first_name = response.first_name;
        last_name = response.last_name;
        email_id = obj.email;
        main_mobile = obj.mobile;
        main_email = obj.email;
        $('#user_log').val(f_id)
        $("#f_id_valuation").val(f_id);
        $("#f_user_valuation").val(f_id);
        $("#f_user_email").val(main_email);
        $("#facebook_firstname").val(first_name);
        $("#facebook_lastname").val(last_name);
        var controller = $("#ControllerName").val();
        $(".login-popup").modal('hide');
        if ((main_email == '' || main_email == null) || (main_mobile == '' || main_mobile == null)) {
          $("#second-login-popup-linked").modal('show');
          if (main_email != '' && main_email != null && main_email != undefined) {
            $("#second-login-popup-linked #Business_Email_Id").val(main_email);
          }
          if (main_mobile != '' && main_mobile != null) {
            $("#second-login-popup-linked #txtMblNo").hide();
            $("#second-login-popup-linked .std-code").hide();
            $("#mobile_pressence_linked").val(1);
          }
        }
      }
    });
    if (product_url) window.location.href = product_url;
  });
}

function statusChangeCallback(response) {
  // console.log(response.status);
  if (response.status === 'connected') {
    testAPI();
  } else if (response.status === 'not_authorized') {
    document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
  } else {
    document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
  }
}
window.fbAsyncInit = function() {
  FB.init({
    appId: '1540857126165017',
    xfbml: true,
    version: 'v2.8',
    status: true
  });
};
// (function(d, s, id) {
//   var js, fjs = d.getElementsByTagName(s)[0];
//   if (d.getElementById(id)) {
//     return;
//   }
//   js = d.createElement(s);
//   js.id = id;
//   js.src = "//connect.facebook.net/en_US/sdk.js";
//   fjs.parentNode.insertBefore(js, fjs);
// }(document, 'script', 'facebook-jssdk'));

(function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));

function testAPI() {
  console.log('testAPI');
  $("#login-popup .modal-body").html('<div style="text-align:center; font-weight:bold; margin-top:50px;  padding-bottom:50px; ">Logging in to XERVE ...<br><br><img src="/img/loading_company.gif" align="Facebook Loggin In" class="img-responsive" /></div>');
  $("#social_login_type").val('facebook');
  // $("#social_user_type").val('Account');
  FB.api('/me?fields=id,email,name,first_name,last_name,gender,updated_time,picture', function(response) {
    $("#login-popup .modal-header").hide();
    $("#login-popup .modal-footer").hide();
    $("#login-popup2 .modal-header").hide();
    $("#login-popup2 .modal-footer").hide();
    $("#login-popup3 .modal-header").hide();
    $("#login-popup3 .modal-footer").hide();
    $("#login-popup2 .modal-body").html('<div style="text-align:center; font-weight:bold; margin-top:50px;  padding-bottom:50px; ">Logging in to XERVE ...<br><br><img src="/img/loading_company.gif" align="Facebook Loggin In" class="img-responsive" /></div>');
    $("#login-popup3 .front-couponmain .modal-body").html('<div style="text-align:center; font-weight:bold; margin-top:50px;  padding-bottom:50px;width:100%;display:inline-block; ">Logging in to XERVE ...<br><br><img src="/img/loading_company.gif" align="Facebook Loggin In" class="img-responsive" /></div>');
    var user_id = $("#User_Id").val();
    var product_url = $("#skip-step").attr("href");
    var controller = $("#ControllerName").val();
    if (controller == 'cashback') {
      $("#facebook-post-popup").addClass('in');
      $("#facebook-post-popup").modal('show');
    }
    $("#f_name").text(response.first_name);
    $.ajax({
      type: "POST",
      url: "/Generals/f_social_login_new",
      data: "id=" + response.id + "&email=" + response.email + "&first_name=" + response.first_name + "&gender=" + response.gender + "&last_name=" + response.last_name + "&name=" + response.name + "&updated_time=" + response.updated_time + "&product_url=" + product_url + "&profile_pic=" + encodeURIComponent(response.picture.data.url),
      success: "success",
      dataType: 'text',
      context: document.body
    }).done(function(msg) {
      $("#login-popup2 .close").click();
      $("#login-popup .close").click();
      $(".closefull").click();
      var obj = jQuery.parseJSON(msg);
      var controller = $("#ControllerName").val();
      result = obj.result;
      status = obj.status_user;
      name = obj.user_name;
      mobile_genie = obj.mobile;
      genie_name = obj.user_name;
      $(".facebook_name_section").text(name);
      $("#user_name").val(name);
      $("#user_log").val(obj.id);
      $("#User_Id").val(result);
      full_name = name;
      $("#user_name").val(full_name);
      if (status == 'Yes') {
        $("#after-login-drop").show();
        $("#before-login-drop").hide();
        $('body').removeClass('modal-open');
        $(".modal-backdrop").remove();
        $(".modal-content-login").remove();
        $("#second-login-popup").modal('hide');
        $(".buyers-sellers-diff-before").hide();
        show_info_myaccount(result, 1);
        $("#f_name").text(response.first_name);
        $("#user_log").val(obj.id);
        var bill_upload = $("#bill_upload_value").val();
        if (bill_upload == 1) {
          window.location.href = "https://www.xerve.in/myaccount/upload_bill";
        }
        // console.log(controller);
        var submit = $("input[id='submit_clicked']:last").val();
        // console.log(submit);
        if (controller == 'reviews') {
          $.ajax({
            type: "POST",
            url: "/Generals/cashback_activate",
            data: "&user_id=" + result,
            success: "success",
            dataType: 'text',
            context: document.body
          }).done(function(msg) {
            var data = $.parseJSON(msg);
            main_mobile = data.main_mobile;
            main_email = data.main_email;
            status_value = data.status_value;
            if ((main_email == '' || main_email == null) || (main_mobile == '' || main_mobile == null)) {
              $("#second-login-popup").modal('show');
              if (main_email != '' && main_email != null) {
                $("#second-login-popup #Business_Email_Id").hide();
                $("#email_pressence").val(1);
              }
              if (main_mobile != '' && main_mobile != null) {
                $("#second-login-popup #txtMblNo").hide();
                $("#second-login-popup .std-code").hide();
                $("#mobile_pressence").val(1);
              }
            } else {
              if (controller == 'Homes') {
                if ($("#check_redirect_from_extension").val() == 1) {
                  window.location.href = $("#check_url_from_extension").val();
                } else {
                  if (status_value == 0) {
                    window.location.href = "https://www.xerve.in/";
                  } else if (status_value = 1) {
                    window.location.href = "https://www.xerve.in/";
                  } else {
                    window.location.href = "https://www.xerve.in";
                  }
                }
              }
            }
          });
        }
        if (controller == 'vouchers') {
          result = obj.result;
          status = obj.status_user;
          name = obj.user_name;
          url_type = $("#url_type").val();
          $("#after-login-drop").show();
          $("#before-login-drop").hide();
          url = $("#url_cashback").val();
          $("#User_Id").val(result);
          $("#user_name").val(name);
          seller_name = $("#seller_name").val();
          cashback_info = $("#cashback_info").val();
          if (url_type == 1) {
            var url_main = url + "&UID=" + result + "&UID2=" + name;
          } else if (url_type == 2) {
            var url_main = url + "&affExtParam1=" + result + "&affExtParam2=" + name;
          } else if (url_type == 3 || url_type == 11 || url_type == 13) {
            var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + name;
          } else if (url_type == 4) {
            var url_main = url + "&aff_sub2=" + result + "&aff_sub3=" + name;
          } else if (url_type == 6) {
            var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + name;
          } else if (url_type == 7 || url_type == 5) {
            var url_main = url + "&tag=749927-21&ascsubtag=" + result;
          } else if (url_type == 8) {
            var url_main = url + "?subid=" + result;
          } else if (url_type == 9) {
            var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
          } else if (url_type == 10) {
            var url_main = url + "&subid=" + result;
          } else if (url_type == 12) {
            var url_main = url + "&s2=" + result + "&s3=" + full_name;
          } else {
            var url_main = url;
          }
          $('#couponactivation-popup').modal('show');
          $("#couponactivation-popup").find('.popup_idsection').text(result);
          $("#couponactivation-popup").find('.popup_namesection').text(name);
          $("#couponactivation-popup").find("span[class='popup_brandsection']").text(seller_name);
          $("#couponactivation-popup").find(".popup_couponlink").html('<a class="know_coupon_popup colio-link" target="_blank" href="' + url_main + '">SHOP NOW AT ' + seller_name + '</a>')
          $("#couponactivation-popup").find("#extra_cashback_popup").html(" Get" + ' ' + cashback_info + ' ' + "Cashback from Xerve");
        }
        if (controller == 'cashback') {
          $("#login-popup2").modal('hide');
          $('body').removeClass('modal-open');
          $(".modal-backdrop").remove();
          $("#User_Id_Main").val(result);
          $("#user_name").val(name);
          $("#user_name_main").val(name);
          $("#User_Id").val(result);
          mobile = obj.mobile;
          email = obj.email;
          var cashback = $("#cashback_value").val();
          if (cashback != 'bill' && cashback != 'reff') {
            subscribe_offline_cashback(result);
            $.ajax({
              type: "POST",
              url: "/Generals/cashback_activate",
              data: "&user_id=" + result,
              success: "success",
              dataType: 'text',
              context: document.body
            }).done(function(msg) {
              var data = $.parseJSON(msg);
              main_mobile = data.main_mobile;
              main_email = data.main_email;
              if ((main_email == '' || main_email == null) || (main_mobile == '' || main_mobile == null)) {
                $("#second-login-popup").modal('show');
                if (main_email != '' && main_email != null) {
                  $("#second-login-popup #Business_Email_Id").hide();
                  $("#email_pressence").val(1);
                }
                if (main_mobile != '' && main_mobile != null) {
                  $("#second-login-popup #txtMblNo").hide();
                  $("#second-login-popup .std-code").hide();
                  $("#mobile_pressence").val(1);
                }
              }
            });
          }
          if (cashback == 'reff') {
            $.ajax({
              type: "POST",
              url: "/Generals/cashback_activate",
              data: "&user_id=" + result,
              success: "success",
              dataType: 'text',
              context: document.body
            }).done(function(msg) {
              $("#facebook-post-popup").hide('');
              $("#facebook-post-popup").removeClass('in');
              $('body').removeClass('modal-open');
              $(".modal-backdrop").remove();
              $(".modal-content-login").remove();
              var data = $.parseJSON(msg);
              main_mobile = data.main_mobile;
              main_email = data.main_email;
              $('.front2').remove();
              if (main_mobile == "" || main_mobile == null) {
                $('#mobile_book').val(obj.mobile);
              }
              $(".bill_last_step").show();
              if (main_email == "" || main_email == null) {
                $("#email_book").show();
              }
              if ((main_email == '' || main_email == null) && (main_mobile == '' || main_mobile == null)) {
                $("#no_info").val(1);
              }
              $("#User_Id").val(result);
              name = name.replace(/\s/g, "-");
              var reff_url = "https://www.xerve.in/cashback/party?uid=" + result + "&ref=" + name;
              $("#after_reff_div").show();
              $("#before_reff_div").remove();
              $("#mobile_book_after").val(reff_url);
              $(".sharethis-inline-share-buttons").attr('data-url', reff_url);
              var reff_main_url = "https://www.xerve.in/cashback/party/" + result;
              $(".modal-backdrop").remove();
              this.$backdrop = $('<div class="modal-backdrop fade in " />').appendTo(document.body);
              $(".loading_image_selection").show();
              window.location.href = reff_main_url;
            });
          }
          if (cashback == 'bill') {
            $.ajax({
              type: "POST",
              url: "/Generals/cashback_activate",
              data: "&user_id=" + result,
              success: "success",
              dataType: 'text',
              context: document.body
            }).done(function(msg) {
              $("#facebook-post-popup").hide('');
              $("#facebook-post-popup").removeClass('in');
              $('body').removeClass('modal-open');
              $(".modal-backdrop").remove();
              $(".modal-content-login").remove();
              var data = $.parseJSON(msg);
              main_mobile = data.main_mobile;
              main_email = data.main_email;
              $('.front2').remove();
              if (main_mobile == "" || main_mobile == null) {
                $('#mobile_book').val(obj.mobile);
              }
              $(".bill_last_step").show();
              if (main_email == "" || main_email == null) {
                $("#email_book").show();
              }
              if ((main_email == '' || main_email == null) && (main_mobile == '' || main_mobile == null)) {
                $("#no_info").val(1);
              }
              $("#User_Id").val(result);
            });
          }
          if (cashback == 'highest') {
            if (status == 'Yes') {
              $("#facebook-post-popup").hide('');
              $("#facebook-post-popup").removeClass('in');
              $(".modal-backdrop").hide();
              $(".ft_btn_high").hide();
              var url = $("#Seller_Url").val();
              var url_type = $("#Seller_UrlType").val();
              var seller_name = $("#Seller_Name").val();
              $("#user_status").val(result);
              var login_type = $("#login_type").val();
              $("a[id*='cop_cou_main_bt']").each(function() {
                $(this).text('Go To Store');
              });
              show_info_myaccount(user_id, 1);
              if (login_type == 'login') {
                if (url_type == 1) {
                  var url_main = url + "&UID=" + result + "&UID2=" + name;
                } else if (url_type == 2) {
                  var url_main = url + "&affExtParam1=" + result + "&affExtParam2=" + name;
                } else if (url_type == 3 || url_type == 11 || url_type == 13) {
                  var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + name;
                } else if (url_type == 4) {
                  var url_main = url + "&aff_sub2=" + result + "&aff_sub3=" + name;
                } else if (url_type == 5) {
                  var url_main = url + "&ascsubtag=" + result;
                } else if (url_type == 6) {
                  var url_main = url + "&aff_sub=" + result + "&aff_sub1=" + name;
                } else if (url_type == 7 || url_type == 5) {
                  var url_main = url + "&tag=749927-21&ascsubtag=" + result;
                } else if (url_type == 8) {
                  var url_main = url + "?subid=" + result;
                } else if (url_type == 9) {
                  var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + name;
                } else if (url_type == 10) {
                  var url_main = url + "&subid=" + result;
                } else if (url_type == 12) {
                  var url_main = url + "&s2=" + result + "&s3=" + name;
                } else {
                  var url_main = url;
                }
                $('#couponactivation-popup').modal('show');
                $("#couponactivation-popup").find('.popup_idsection').text(result);
                $("#couponactivation-popup").find('.popup_namesection').text(name);
                $("#couponactivation-popup").find("span[class='popup_brandsection']").text(seller_name);
                var cashback_info = $(".cashback_" + seller_name).text();
                $("#couponactivation-popup").find(".popup_couponlink").html('<a onclick="post_log_click(\'' + url_main + '\');" class="know_coupon_popup colio-link">SHOP NOW AT ' + seller_name + '</a>')
                $("#couponactivation-popup").find("#extra_cashback_popup").html(" Get" + ' <span class="_cashsh4_popup">' + cashback_info + "</span>");
              } else {
                $("a[id*='cop_cou_main_bt']").each(function() {
                  $(this).text('Go To Store');
                });
                show_info_myaccount(user_id, 1);
                var seller_list = $("#Seller_Array").val();
                $.ajax({
                  type: 'POST',
                  url: '/Generals/wishlist_save',
                  data: 'user_id=' + result + "&seller_list=" + encodeURIComponent(seller_list),
                  success: function(data) {
                    $('.ft_btn_high_Last').show();
                  }
                });
              }
              // alert("working fine");
            } else {
              // alert("working in");
              if ((obj.email == '' || obj.email == null) && (obj.mobile == '' || obj.mobile == null)) {
                // $("#second-login-popup").modal('show');
                if (obj.email) $("#second-login-popup #Business_Email").hide();
                if (obj.mobile) {
                  $("#second-login-popup .std-code").hide();
                  $("#second-login-popup #txtMblNo").hide();
                }
              }
            }
          }
          if (cashback != 2 && cashback != 'bill' && cashback != 'highest') {
            $("#after-login-drop").show();
            $("#before-login-drop").hide();
            $('a[id*="shop_reward_login_button_index"]').removeAttr('data-target');
            $('a[id*="shop_reward_login_button_index"]').removeAttr('data-toggle');
            $("#f_name").text(response.first_name);
            $("#user_log").val(obj.id);
            var page = $("#pager").val();
            if (status == 'Yes') {
              if (page == 'half') {
                var coupon = $("#coupon_id").val();
                var url_type = $("#" + coupon).find("#coupon_url_type").val();
                var row = $("#row").val();
                $('a[id*="login-index-offer"]').removeAttr('data-target');
                $('a[id*="login-index-offer"]').removeAttr('data-toggle');
                // $('a[id*="shop_reward_login_button_index"]').removeAttr('data-target');
                // $('a[id*="shop_reward_login_button_index"]').removeAttr('data-toggle');
                $("#User_Id").val(result);
                $("#user_name").val(name);
                $("#" + coupon).find(".coupon_loading").css("display", "none");
                $("#" + coupon).find("#useraccount_info").text(result);
                $("#" + coupon).find("#username_info").text(name);
                $("#" + coupon).find(".connection_section").css("display", "inline-block");
                $("#user_name").val(name);
                var url = $("#" + coupon).find('#coupon_get_sms').attr('href');
                if (url_type == 1) {
                  var url_main = url + "&UID=" + result + "&UID2=" + full_name;
                } else if (url_type == 2) {
                  var url_main = url + "&affExtParam1=" + result + "&affExtParam2=" + full_name;
                } else if (url_type == 3 || url_type == 11 || url_type == 13) {
                  var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                } else if (url_type == 4) {
                  var url_main = url + "&aff_sub2=" + result + "&aff_sub3=" + full_name;
                } else if (url_type == 5) {
                  var url_main = url + "&ascsubtag=" + result;
                } else if (url_type == 6) {
                  var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                } else if (url_type == 7 || url_type == 5) {
                  var url_main = url + "&tag=749927-21&ascsubtag=" + result;
                } else if (url_type == 8) {
                  var url_main = url + "?subid=" + result;
                } else if (url_type == 9) {
                  var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                } else if (url_type == 9) {
                  var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                } else if (url_type == 10) {
                  var url_main = url + "&subid=" + result;
                } else if (url_type == 12) {
                  var url_main = url + "&s2=" + result + "&s3=" + full_name;
                } else {
                  var url_main = url;
                }
                $("#" + coupon).find('#coupon_get_sms').attr('href', url_main);
                var high = $("#" + coupon).find("#show_high").val();
                var info = $("#" + coupon).find('show_info').val();
                $("#cashbackinfo-popup").modal('hide');
                $("#" + coupon).find("#coupon_get_sms").hide();
                var seller_name = $("#" + coupon).find("#skip_title").val();
                $('#couponactivation-popup').modal('show');
                $("#couponactivation-popup").find('.popup_idsection').text(result);
                $("#couponactivation-popup").find('.popup_namesection').text(name);
                $("#couponactivation-popup").find("span[class='popup_brandsection']").text(seller_name);
                var cashback_info = $("#" + coupon).find("#cashback_rs_only_code").val();
                $("#couponactivation-popup").find(".popup_couponlink").html('<a class="know_coupon_popup colio-link" onclick="click_reward_login_index();">SHOP NOW AT ' + seller_name + '</a>');
                // $("#couponactivation-popup").find("#extra_cashback_popup").html(" Get" + ' ' + cashback_info + ' ' + "Xerve Cashback");
                $("#couponactivation-popup").find("#extra_cashback_popup").html(" Get" + ' <span class="_cashsh4_popup">' + cashback_info + ' ' + "Cashback </span> from Xerve");
                $("li[id='main-" + row + "']").find("#show_high").val(1);
              } else {
                var main_pageof = $("#main_pageof").val();
                if (main_pageof == 1) {
                  var cashback = $("#cashback_value_main").val();
                  //                        if(result == 54204){
                  //     alert("here"+cashback);
                  // }
                  $("#login-popup3").hide();
                  $('body').removeClass('modal-open');
                  $("#cashbackinfo-popup-main").modal('hide');
                  $(".modal-backdrop").remove();
                  $("#User_Id_Main").val(result);
                  $("#user_name_main").val(name);
                  $('a[id*="login-index-offer"]').removeAttr('data-target');
                  $('a[id*="login-index-offer"]').removeAttr('data-toggle');
                  // $('a[id*="shop_reward_login_button_index"]').removeAttr('data-target');
                  // $('a[id*="shop_reward_login_button_index"]').removeAttr('data-toggle');
                  var cashback_id_main = $("#main_coupon_id_main").val();
                  $("#details_content_white_bg" + cashback_id_main + " ._cashdstrp").hide();
                  var url_type = $("#coupon_url_type_main" + cashback_id_main).val();
                  var url = $('#coupon_get_sms_main' + cashback_id_main).val();
                  var check_make = $("#makemytripinputno" + cashback_id_main).val();
                  if (check_make != undefined && check_make != '') {
                    url = $('#makemytripinputnum' + check_make + cashback_id_main).val();
                  }
                  if (cashback == 'cash') {
                    if (url_type == 1) {
                      var url_main = url + "&UID=" + result + "&UID2=" + name;
                    } else if (url_type == 2) {
                      var url_main = url + "&affExtParam1=" + result + "&affExtParam2=" + name;
                    } else if (url_type == 3 || url_type == 11 || url_type == 13) {
                      var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + name;
                    } else if (url_type == 4) {
                      var url_main = url + "&aff_sub2=" + result + "&aff_sub3=" + name;
                    } else if (url_type == 5) {
                      var url_main = url + "&ascsubtag=" + result;
                    } else if (url_type == 6) {
                      var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + name;
                    } else if (url_type == 7 || url_type == 5) {
                      var url_main = url + "&tag=749927-21&ascsubtag=" + result;
                    } else if (url_type == 8) {
                      var url_main = url + "?subid=" + result;
                    } else if (url_type == 9) {
                      var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + name;
                    } else if (url_type == 10) {
                      var url_main = url + "&subid=" + result;
                    } else if (url_type == 12) {
                      var url_main = url + "&s2=" + result + "&s3=" + name;
                    } else {
                      var url_main = url;
                    }
                    $("#" + coupon).find('#coupon_get_sms').attr('href', url_main);
                    $("#" + coupon).find('#coupon_cash_sms').hide();
                    var seller_name = $("#seller_main_name").val();
                    $("#cashbackinfo-popup-main").modal('hide');
                    $('#couponactivation-popup-main').modal('show');
                    $("#couponactivation-popup-main").find('.popup_idsection').text(result);
                    $("#couponactivation-popup-main").find('.popup_namesection').text(name);
                    $("#couponactivation-popup-main").find("span[class='popup_brandsection']").text(seller_name);
                    var cashback_info = $(".coupon_rs_code_main").html();
                    var makecashbk = $("#makemytripinputcashback" + cashback_id_main).val();
                    if (makecashbk != undefined && makecashbk != '') {
                      cashback_info = makecashbk + "";
                    };
                    var cashback_id_main1 = "'" + cashback_id_main + "'";
                    var name_cas_here = "";
                    if (cashback_id_main == 'XRVCOU1cac') {
                      name_cas_here = "Rewards";
                    } else {
                      name_cas_here = "Cashback";
                    }
                    var url_url_main = "'" + url_main.trim() + "'";
                    $("#couponactivation-popup-main").find(".popup_couponlink").html('<a class="know_coupon_popup colio-link" onclick="chashback_imgonline1_postlogin(\'' + cashback_id_main.trim() + '\');" >SHOP NOW AT ' + seller_name + '</a>')
                    var name_cas_here = "";
                    if (cashback_id_main == 'XRVCOU1cac') {
                      name_cas_here = "Rewards";
                    } else {
                      name_cas_here = "Cashback";
                    }
                    var campaign_type = $("#campaign_type").val();
                    if (campaign_type == 'yes') {
                      campaign_complete();
                    }
                    if (cashback_info.indexOf('Upto') == -1) {
                      cashback_info = 'Upto ' + cashback_info;
                    }
                    $("#couponactivation-popup-main").find("#extra_cashback_popup").html(" Get" + ' <span class="_cashsh4_popup"> ' + cashback_info + ' </span>' + " Xerve " + name_cas_here + "");
                    if (seller_name != 'Flipkart') {
                      $("#couponactivation-popup-main").find("#extra_cashback_campaign").html("4. Purchases via " + seller_name + " App will NOT be eligible for Xerve " + name_cas_here + ".");
                      $("#couponactivation-popup-main #extra_cashback_campaign").show();
                    }
                    $(".pre_lo_flip_main_C").hide();
                    $(".post_lo_flip_main_C").show();
                    $(".extra_ion_cash").hide();
                  } else if (cashback == 'bill') {
                    $.ajax({
                      type: "POST",
                      url: "/Generals/cashback_activate",
                      data: "&user_id=" + result,
                      success: "success",
                      dataType: 'text',
                      context: document.body
                    }).done(function(msg) {
                      var data = $.parseJSON(msg);
                      main_mobile = data.main_mobile;
                      main_email = data.main_email;
                      if ((main_mobile == '' || main_mobile == null)) {
                        $("#cashback_login_mobile_key").val(1);
                        $("#second-login-popup").modal('show');
                        if (main_email != '' && main_email != null) {
                          $("#second-login-popup #Business_Email_Id").hide();
                          $("#email_pressence").val(1);
                        }
                      } else {
                        window.location.href = "https://www.xerve.in/myaccount/upload_bill";
                      }
                    });
                  }
                }
              }
            }
            if ((obj.email == '' || obj.email == null) && (obj.mobile == '' || obj.mobile == null)) {
              $("#second-login-popup").modal('show');
              if (obj.email) $("#second-login-popup #Business_Email").hide();
              if (obj.mobile) {
                $("#second-login-popup .std-code").hide();
                $("#second-login-popup #txtMblNo").hide();
              }
            }
          } else if (cashback == 2 && cashback != 'bill') {
            $.ajax({
              type: "POST",
              url: "/Generals/cashback_activate",
              data: "&user_id=" + result,
              success: "success",
              dataType: 'text',
              context: document.body
            }).done(function(msg) {
              var data = $.parseJSON(msg);
              main_mobile = data.main_mobile;
              main_email = data.main_email;
              if ((main_email == '' || main_email == null) || (main_mobile == '' || main_mobile == null)) {
                $("#second-login-popup").modal('show');
                if (main_email != '' && main_email != null) {
                  $("#second-login-popup #Business_Email_Id").hide();
                  $("#email_pressence").val(1);
                }
                if (main_mobile != '' && main_mobile != null) {
                  $("#second-login-popup #txtMblNo").hide();
                  $("#second-login-popup .std-code").hide();
                  $("#mobile_pressence").val(1);
                }
              } else {
                window.location.href = "https://www.xerve.in/myaccount/upload_bill";
              }
            });
          }
        }
        if (controller == 'compare') {
          if (status == 'Yes') {
            $("#login-popup2").hide();
            $('body').removeClass('modal-open');
            $(".modal-backdrop").remove();
            $(".modal-body-login").remove();
            $("#User_Id_Main").val(result);
            $("#user_name_main").val(name);
            var seller_name = $("#seller_main").val();
            var alink = $("#website_main").val();
            var store_id = $("#store_id_main").val();
            $(".know-compare").each(function() {
              var current_element = $(this);
              $(this).removeAttr('data-toggle');
              $(this).removeAttr('data-target');
            });
            if (seller_name == 'Flipkart.com') {
              var url_main_half = alink + "&affExtParam1=" + result + "&affExtParam2=" + name;
            } else if (seller == 'Snapdeal.com') {
              var url_main_half = alink + "&aff_sub=" + result + "&aff_sub2=" + name;
            } else if (seller == 'Amazon.in') {
              var url_main_half = alink + '&ascsubtag=' + result;
            } else if (seller_name == 'Bluestone.com') {
              var url_main_half = alink + "&UID=" + result + "&UID2=" + name;
            } else {
              var url_main_half = alink + "&UID=" + result + "&UID2=" + name;
            }
            var sub_url = "/redirect?store_id=" + store_id + "&url=" + encodeURIComponent(url_main_half);
            var cashback_info = $("#" + store_id + "-cashback").val();
            var image_main = $("#image_main").val();
            var product_name = $("#product_title").val();
            var image_url = "https://d19n7ukq09i248.cloudfront.net/" + seller_name + "/" + image_main;
            var sellering = $("#seller").val();
            var image_url = getImageNames('Small', seller_name, image_main);
            $("#couponactivation-popup").find('.popup_product_image').attr("src", image_url);
            $("#cashbackinfo-popup").modal('hide');
            $('#couponactivation-popup').modal('show');
            $("#couponactivation-popup").find('.popup_idsection').text(result);
            $("#couponactivation-popup").find('.popup_namesection').text(name);
            $("#couponactivation-popup").find(".popup_productsection").text(product_name);
            $("#couponactivation-popup").find("span[class='popup_brandsection']").text(seller_name);
            $("#couponactivation-popup").find(".popup_couponlink").html('<a class="know_coupon_popup colio-link" onclick="compare_product_click_category(\'' + sub_url + '\')">SHOP NOW AT ' + seller_name + '</a>')
            $("#couponactivation-popup").find("#extra_cashback_popup").html(" Get" + ' ' + cashback_info + ' ' + " Xerve Cashback");
          }
          if ((obj.email == '' || obj.email == null) && (obj.mobile == '' || obj.mobile == null)) {
            $("#second-login-popup").modal('show');
          }
          if (obj.emai) $("#second-login-popup #Business_Email").hide();
          if (obj.mobile) {
            $("#second-login-popup .std-code").hide();
            $("#second-login-popup #txtMblNo").hide();
          }
        }
        if (controller == 'coupons') {
          var coupon = $("#coupon_id").val();
          var row = $("#row").val();
          var url_type = $("#" + coupon).find("#coupon_url_type").val();
          var url = $("#" + coupon).find('#coupon_get_sms').attr('href');
          var downloaded = $("#" + coupon).find('#coupon_downloaded').val();
          var main_pageof = $("#main_pageof").val();
          $("#" + coupon).find('#coupon_downloaded').val(1);
          if (status == 'Yes') {
            $("#login-popup2").modal('hide');
            $('body').removeClass('modal-open');
            $(".modal-backdrop").remove();
            var cashback = $("#cashback_value").val();
            var seller = $("#" + coupon).find('#seller_name').val();
            var coupon_type = $("#coupon_type").val();
            $(".know_coupon").each(function() {
              var current_element = $(this);
              $(this).removeAttr('data-toggle');
              $(this).removeAttr('data-target');
            });
            if (cashback == 12) {
              $("#login-popup2").hide();
              $('body').removeClass('modal-open');
              $(".modal-backdrop").remove();
              $("#User_Id").val(result);
              var offer_id = $('#Offer_Id_Main').val();
              id = "coupon" + offer_id;
              $.ajax({
                type: "POST",
                url: "/Coupons/getCouponId",
                data: "offer_id=" + offer_id,
                success: "success",
                dataType: 'text',
                context: document.body
              }).done(function(msg) {
                var data = $.parseJSON(msg);
                main_mobile = obj.main_mobile;
                main_email = obj.main_email;
                promourl = data.promourl;
                promocode = data.promocode;
                url_type = data.url_type;
                if (url_type == 1) {
                  var url_main = promourl + "&UID=" + result + "&UID2=" + full_name;
                } else if (url_type == 2) {
                  var url_main = promourl + "&affExtParam1=" + result + "&affExtParam2=" + full_name;
                } else if (url_type == 3 || url_type == 11 || url_type == 13) {
                  var url_main = promourl + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                } else if (url_type == 4) {
                  var url_main = promourl + "&aff_sub2=" + result + "&aff_sub3=" + full_name;
                } else if (url_type == 6) {
                  var url_main = promourl + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                } else if (url_type == 7) {
                  var url_main = promourl + "&ascsubtag=" + result;
                } else if (url_type == 8) {
                  var url_main = promourl + "?subid=" + result;
                } else if (url_type == 9) {
                  var url_main = promourl + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                } else if (url_type == 10) {
                  var url_main = promourl + "&subid=" + result;
                } else if (url_type == 12) {
                  var url_main = promourl + "&s2=" + result + "&s3=" + full_name;
                } else {
                  var url_main = promourl;
                }
                $("#" + id).find('.coupon_loading').hide();
                $(".coupon-check-section").each(function() {
                  var current = $(this);
                  $(this).hide();
                });
                $(".coupon-infocash").each(function() {
                  var current2 = $(this);
                  $(this).show();
                });
                $("#login-popup2").modal('hide');
                $("#login-popup").modal('hide');
                $("#cashbackinfo-popup").modal('hide');
                var seller_name = $("#" + id).find("#skip_title").val();
                var cashback_infotext = $("#" + id).find('._coupon_cash_info').html();
                $('#couponactivation-popup').modal('show');
                $("#couponactivation-popup").find('.popup_idsection').text(result);
                $("#couponactivation-popup").find('.popup_namesection').text(name);
                $("#couponactivation-popup").find("span[class='popup_brandsection']").text(seller_name);
                $("#couponactivation-popup").find("#extra_cashback_popup").html(cashback_infotext);
                $("#couponactivation-popup").find(".popup_couponlink").html('<a class="know_coupon_popup colio-link" onclick="click_reward_login_index();">SHOP NOW AT ' + seller_name + '</a>');
                $("#" + id).find('.coupon_main_section_button_link').attr('value', url_main);
                $("#" + id).find('.coupon_main_section_button_link').attr('value', url_main);
                $("#" + id).find('.know_coupon').removeAttr('data-toggle');
                $("#" + id).find('.know_coupon').removeAttr('data-target');
                $("#" + id).find("#coupon_subtitle_alert").hide();
                $(".know_coupon").each(function() {
                  var current_element = $(this);
                  $(this).removeAttr('data-toggle');
                  $(this).removeAttr('data-target');
                });
              });
            } else if (cashback == 2) {
              var coupon_id_value = $("input[id='coupon_id_value']:last").val();
              $("#brand-coupon" + coupon_id_value).find(".coupon_loading").css("display", "inline-block");
              $.ajax({
                type: "POST",
                url: "/Generals/user_active_coupon",
                data: "user_id=" + result + "&seller_name=" + seller,
                success: "success",
                dataType: 'text',
                context: document.body
              }).done(function(msg) {
                var data = $.parseJSON(msg);
                activate = data.activated;
                show_section = data.show_section;
                balance = data.balance;
                total = data.total;
                need = data.need;
                seller = data.seller;
                mobile = data.mobile;
                main_mobile = data.main_mobile;
                cashback = data.cashback;
                downloaded = data.downloaded;
                cod = data.cod;
                voucher_no = data.voucher_no;
                main_email = data.main_email;
                if (coupon_type == 'offline') {
                  $("#" + coupon).find(".coupon_loading").css("display", "none");
                  $("#" + coupon).find('.coupon_main_section').show();
                  $("#" + coupon).find('p[id="coupon_subtitle_alert"]').hide();
                  $("#" + coupon).find('span[class="coupon_get_info"]').show();
                  $("#" + coupon).find('.coupon_get_info #number').val(mobile);
                  $("li[id='main-" + row + "']").css('height', '530px');
                } else {
                  if (show_section == 'Yes') {
                    $("#login-popup2").hide();
                    $('body').removeClass('modal-open');
                    $(".modal-backdrop").remove();
                    var url_value = $("#url_for_login_seller").val();
                    var url_type_value = $("#urltype_for_login_seller").val();
                    var alink = "";
                    if (url_type_value == 1) {
                      alink = url_value + "&UID=" + result + "&UID2=" + name;
                    } else if (url_type_value == 2) {
                      alink = url_value + "&affExtParam1=" + result + "&affExtParam2=" + name;
                    } else if (url_type_value == 3 || url_type_value == 11 || url_type_value == 13) {
                      alink = url_value + "&aff_sub=" + result + "&aff_sub2=" + name;
                    } else if (url_type_value == 4) {
                      alink = url_value + "&aff_sub2=" + result + "&aff_sub3=" + name;
                    } else if (url_type_value == 7) {
                      alink = url_value + "&ascsubtag=" + result;
                    } else if (url_type_value == 8) {
                      alink = url_value + "?subid=" + result;
                    } else if (url_type_value == 9) {
                      alink = url_value + "&aff_sub=" + result + "&aff_sub2=" + name;
                    } else if (url_type_value == 10) {
                      alink = url_value + "&subid=" + result;
                    } else if (url_type_value == 12) {
                      alink = url_value + "&s2=" + result + "&s3=" + full_name;
                    } else {
                      alink = url_value;
                    }
                    $("#" + coupon).find(".coupon_loading").css("display", "none");
                    $("#" + coupon).find('.coupon_main_section').show();
                    if (mobile != '' && mobile != undefined) {
                      $("#" + coupon).find('input[name=coupon__mobile_number]').val(mobile);
                    } else {
                      $("#" + coupon).find('input[name=coupon__mobile_number]').val(main_mobile);
                    }
                    $("#" + coupon).find('input[name=coupon_email_id_name]').val(main_email);
                    if (cod == 'yes') {
                      if (cashback == 'no') {
                        $("#" + coupon).find(".cod-input-section").show();
                      } else {
                        $("#" + coupon).find(".cod-link-section").show();
                      }
                      if (downloaded == 'Yes') {
                        $("#" + coupon).find(".code_info").hide();
                        $("#" + coupon).find("#coupon_get_bank").text('Visit My account to get cash');
                        $("#" + coupon).find("#coupon_get_bank").attr("href", "/myaccount");
                        $("#" + coupon).find("#coupon_get_bank").css("font-size", "11px");
                      }
                    }
                    if (url_type == 1) {
                      var url_main = url + "&UID=" + result + "&UID2=" + full_name;
                    } else if (url_type == 2) {
                      var url_main = url + "&affExtParam1=" + result + "&affExtParam2=" + full_name;
                    } else if (url_type == 3 || url_type == 11 || url_type == 13) {
                      var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                    } else if (url_type == 4) {
                      var url_main = url + "&aff_sub2=" + result + "&aff_sub3=" + full_name;
                    } else if (url_type == 6) {
                      var url_main = url + "&aff_sub=" + result + "&aff_sub1=" + full_name;
                    } else if (url_type == 7) {
                      var url_main = url + "&ascsubtag=" + result;
                    } else if (url_type == 8) {
                      var url_main = url + "?subid=" + result;
                    } else if (url_type == 9) {
                      var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                    } else if (url_type == 10) {
                      var url_main = url + "&subid=" + result;
                    } else if (url_type == 12) {
                      var url_main = url + "&s2=" + result + "&s3=" + full_name;
                    } else {
                      var url_main = url;
                    }
                    if (!alink.match(/^http([s]?):\/\/.*/)) {
                      url_main = 'http://' + alink;
                    } else {
                      url_main = alink;
                    }
                    var link_text = $("#" + coupon).find('.visit_link_coupon').html();
                    var link_string = '<p class="coupon_visit_link" id="visiting_link_for_seller" style="font-weight:bold;color:#428bca;text-align:center;"><a onclick="click_voucher_seller(\'' + url_main + '\')" class="visit_link_coupon">' + link_text + '</a></p>';
                    $("#" + coupon).find('.coupon_clk_out_ele').html(link_string);
                    var info = $("#" + coupon).find('show_info').val();
                    var high = $("#" + coupon).find("#show_high").val();
                    if (high == 1) {
                      if (cod == 'yes' && downloaded == 'No') {
                        $("li[id='main-" + row + "']").css('height', '850px');
                      } else if (cod == 'yes' && downloaded == 'Yes') {
                        $("li[id='main-" + row + "']").css('height', '650px');
                      } else {
                        $("li[id='main-" + row + "']").css('height', '580px');
                      }
                    } else {
                      if (info == 1) {
                        if (cod == 'yes' && downloaded == 'No') {
                          $("li[id='main-" + row + "']").css('height', '850px');
                        } else if (cod == 'yes' && downloaded == 'Yes') {
                          $("li[id='main-" + row + "']").css('height', '650px');
                        } else {
                          $("li[id='main-" + row + "']").css('height', '560px');
                        }
                      } else {
                        if (cod == 'yes' && downloaded == 'No') {
                          $("li[id='main-" + row + "']").css('height', '850px');
                        } else if (cod == 'yes' && downloaded == 'Yes') {
                          $("li[id='main-" + row + "']").css('height', '650px');
                        } else {
                          $("li[id='main-" + row + "']").css('height', '560px');
                        }
                      }
                    }
                    $("li[id='main-" + row + "']").find("#show_high").val(1);
                    if ((main_email == '' || main_email == null) || (main_mobile == '' || main_mobile == null)) {
                      $("#second-login-popup").modal('show');
                      if (main_email != '' && main_email != null) {
                        $("#second-login-popup #Business_Email_Id").hide();
                        $("#email_pressence").val(1);
                      }
                      if (main_mobile != '' && main_mobile != null) {
                        $("#second-login-popup #txtMblNo").hide();
                        $("#second-login-popup .std-code").hide();
                        $("#mobile_pressence").val(1);
                      }
                    }
                  } else if (show_section == 'No') {
                    $("#login-popup2").hide();
                    $('body').removeClass('modal-open');
                    $(".modal-backdrop").remove();
                    var url = $("#" + coupon).find('#coupon_get_sms').attr('href');
                    $("#" + coupon).find(".coupon_loading").css("display", "none");
                    var info = $("#" + coupon).find('show_info').val();
                    var high = $("#" + coupon).find("#show_high").val();
                    if (high == 1) {
                      $("li[id='main-" + row + "']").css('height', '580px');
                    } else {
                      if (info == 1) {
                        $("li[id='main-" + row + "']").css('height', '530px');
                      } else {
                        $("li[id='main-" + row + "']").css('height', '530px');
                      }
                    }
                    $("li[id='main-" + row + "']").find("#show_high").val(1);
                    if (url_type == 1) {
                      var url_main = url + "&UID=" + result + "&UID2=" + full_name;
                    } else if (url_type == 2) {
                      var url_main = url + "&affExtParam1=" + result + "&affExtParam2=" + full_name;
                    } else if (url_type == 3 || url_type == 11 || url_type == 13) {
                      var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                    } else if (url_type == 4) {
                      var url_main = url + "&aff_sub2=" + result + "&aff_sub3=" + full_name;
                    } else if (url_type == 7) {
                      var url_main = url + "&ascsubtag=" + result;
                    } else if (url_type == 8) {
                      var url_main = url + "?subid=" + result;
                    } else if (url_type == 9) {
                      var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                    } else if (url_type == 10) {
                      var url_main = url + "&subid=" + result;
                    } else if (url_type == 12) {
                      var url_main = url + "&s2=" + result + "&s3=" + full_name;
                    } else {
                      var url_main = url;
                    }
                    if (url != '' || url !== "undefined") {
                      if (!url.match(/^http([s]?):\/\/.*/)) {
                        url_main = 'http://' + url_main;
                      }
                      if (downloaded != 1) {
                        $("#" + coupon).find('#coupon_get_sms').attr('href', url_main);
                      }
                    }
                    $("#" + coupon).find('#coupon_get_sms').attr('href', url_main);
                    var link_text = $("#" + coupon).find('.visit_link_coupon').html();
                    var link_string = '<p class="coupon_visit_link" id="visiting_link_for_seller" style="font-weight:bold;color:#428bca;text-align:center;"><a onclick="click_voucher_seller(\'' + url_main + '\')" class="visit_link_coupon">' + link_text + '</a></p>';
                    $("#" + coupon).find('.coupon_clk_out_ele').html(link_string);
                    $("#" + coupon).find('.coupon_main_section').show();
                    $("#" + coupon).find("#radio_section_coupon").hide();
                    $("#" + coupon).find('#resent_alert_link').attr('href', url_main);
                    $("#" + coupon).find("#resent_alert").show();
                    $("#" + coupon).find("span[class*=coupon_get_info]").hide();
                    $("#" + coupon).find('#coupon_alert_sms').hide();
                    $("#" + coupon).find('#coupon_subtitle_alert').html("<span class='bold'></span>YOUR XERVE CASH BALANCE IS <span class='bold '>RS. " + total + "</span><br/>YOUR APPROVED XERVE CASH IS <span class='bold colored'>RS. " + balance + "</span><br/></br/>YOU NEED AN EXTRA RS. " + need + " APPROVED XERVE CASH TO BE ABLE TO PICK a <i class='fa fa-rupee'></i> 100 COUPON.");
                    if (seller != null) {
                      $("#" + coupon).find('#resent_alert_link').show();
                      if (voucher_no != '') {
                        $("#" + coupon).find('#resent_alert_link').text("RESEND THE PREVIOUS" + " " + seller + " " + "COUPON TO" + " " + mobile);
                      } else {
                        $("#" + coupon).find('#resent_alert_link').hide();
                      }
                    } else {
                      $("#" + coupon).find('#resent_alert_link').hide();
                    }
                    if (balance == 0) {
                      $(".colored").css('color', '#FF0000');
                    } else {
                      $(".colored").css('color', '#00b050');
                    }
                    $("#" + coupon).find('#coupon_subtitle_alert').show();
                  }
                }
              });
            } else {
              var filename = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
              var pathArray = window.location.pathname.split('/');
              var length = pathArray.length;
              var filename = pathArray[2];
              if (filename != '' && filename != undefined) {
                str = filename.slice(0, 4);
              } else {
                str = "";
              }
              if (str == 'XRVO') {
                var seller_name = $("#skip_title_main").val();
                var offer_id = $("#offer_main_id").val();
                $.ajax({
                  type: "POST",
                  url: "/Coupons/getCouponId",
                  data: "offer_id=" + offer_id,
                  success: "success",
                  dataType: 'text',
                  context: document.body
                }).done(function(msg) {
                  var data = $.parseJSON(msg);
                  main_email = obj.main_email;
                  main_mobile = obj.main_mobile;
                  promourl = data.promourl;
                  promocode = data.promocode;
                  url_type = data.url_type;
                  if (url_type == 1) {
                    var url_main = promourl + "&UID=" + result + "&UID2=" + full_name;
                  } else if (url_type == 2) {
                    var url_main = promourl + "&affExtParam1=" + result + "&affExtParam2=" + full_name;
                  } else if (url_type == 3 || url_type == 11 || url_type == 13) {
                    var url_main = promourl + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                  } else if (url_type == 4) {
                    var url_main = promourl + "&aff_sub2=" + result + "&aff_sub3=" + full_name;
                  } else if (url_type == 6) {
                    var url_main = promourl + "&aff_sub=" + result + "&aff_sub1=" + full_name;
                  } else if (url_type == 7) {
                    var url_main = promourl + "&ascsubtag=" + result;
                  } else if (url_type == 8) {
                    var url_main = promourl + "?subid=" + result;
                  } else if (url_type == 9) {
                    var url_main = promourl + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                  } else if (url_type == 10) {
                    var url_main = promourl + "&subid=" + result;
                  } else if (url_type == 12) {
                    var url_main = promourl + "&s2=" + result + "&s3=" + full_name;
                  } else {
                    var url_main = promourl;
                  }
                  $("#url_value_main").val(url_main);
                  $("#User_Id_Main").val(result);
                  $("#user_name_main").val(name);
                  $(".modal-backdrop").hide();
                  $(".know3,.code-link").each(function() {
                    var current_element = $(this);
                    $(this).removeAttr('data-toggle');
                    $(this).removeAttr('data-target');
                  });
                  var coupon = $("#coupon_id").val();
                  var url_type = $("#" + coupon).find("#coupon_url_type").val();
                  var row = $("#row").val();
                  $("#login-popup3").hide();
                  $("#login-popup2").modal('hide');
                  $("#login-popup").modal('hide');
                  $("#cashbackinfo-popup-main").modal('hide');
                  if (offer_id != '' && offer_id != undefined) {
                    $(".check_section_main").hide();
                    $(".extra_cashback_infomain").show();
                    $("#coupon-check-label-id").hide();
                    $(".extra_cashback_infomain_separate").css('display', 'block');
                    $(".extra_cashback_infomain_separate").css('font-size', '16px');
                    $(".extra_cashback_infomain_separate").css("margin-bottom", "10px");
                    $('#couponactivation-popup_main_seller').modal('show');
                    $("#couponactivation-popup_main_seller").find('.popup_idsection').text(result);
                    $("#couponactivation-popup_main_seller").find('.popup_namesection').text(name);
                    $("#couponactivation-popup_main_seller").find("span[class='popup_brandsection']").text(seller_name);
                    var cashback_info = $("#extra_cashback_infomain_text" + offer_id).html();
                    $("#couponactivation-popup_main_seller").find(".popup_couponlink").html('<a class="know_coupon_popup colio-link" onclick="compare_product_click_category(\'' + url_main + '\')">SHOP NOW AT ' + seller_name + '</a>');
                    $("#couponactivation-popup_main_seller").find('.seller_name_coupon_popup').text(seller_name);
                    $("#couponactivation-popup_main_seller").find("#extra_cashback_popup").html(cashback_info);
                  }
                });
              } else {
                $("#User_Id_Main").val(result);
                $("#user_name_main").val(name);
                $(".modal-backdrop").hide();
                $(".know3,.code-link").each(function() {
                  var current_element = $(this);
                  $(this).removeAttr('data-toggle');
                  $(this).removeAttr('data-target');
                });
                var coupon = $("#coupon_id").val();
                var url_type = $("#" + coupon).find("#coupon_url_type").val();
                var row = $("#row").val();
                $("#login-popup3").hide();
                $("#login-popup2").modal('hide');
                $("#login-popup").modal('hide');
                $("#cashbackinfo-popup-main").modal('hide');
                var offer_id = $("#offer_main_id").val();
                if (offer_id != '' && offer_id != undefined) {
                  var seller_name = $("#skip_title_main" + offer_id).val();
                  $(".check_section_main").hide();
                  $(".extra_cashback_infomain").show();
                  $("#coupon-check-label-id").hide();
                  $(".extra_cashback_infomain_separate").css('display', 'block');
                  $(".extra_cashback_infomain_separate").css('font-size', '16px');
                  $(".extra_cashback_infomain_separate").css("margin-bottom", "10px");
                  $.ajax({
                    type: "POST",
                    url: "/Coupons/getCouponId",
                    data: "offer_id=" + offer_id,
                    success: "success",
                    dataType: 'text',
                    context: document.body
                  }).done(function(msg) {
                    var data = $.parseJSON(msg);
                    main_mobile = obj.main_mobile;
                    main_email = obj.main_email;
                    promourl = data.promourl;
                    promocode = data.promocode;
                    url_type = data.url_type;
                    if (url_type == 1) {
                      var url_main = promourl + "&UID=" + result + "&UID2=" + full_name;
                    } else if (url_type == 2) {
                      var url_main = promourl + "&affExtParam1=" + result + "&affExtParam2=" + full_name;
                    } else if (url_type == 3 || url_type == 11 || url_type == 13) {
                      var url_main = promourl + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                    } else if (url_type == 4) {
                      var url_main = promourl + "&aff_sub2=" + result + "&aff_sub3=" + full_name;
                    } else if (url_type == 6) {
                      var url_main = promourl + "&aff_sub=" + result + "&aff_sub1=" + full_name;
                    } else if (url_type == 7) {
                      var url_main = promourl + "&ascsubtag=" + result;
                    } else if (url_type == 8) {
                      var url_main = promourl + "?subid=" + result;
                    } else if (url_type == 9) {
                      var url_main = promourl + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                    } else if (url_type == 10) {
                      var url_main = promourl + "&subid=" + result;
                    } else if (url_type == 12) {
                      var url_main = promourl + "&s2=" + result + "&s3=" + full_name;
                    } else {
                      var url_main = promourl;
                    }
                    $('#couponactivation-popup_main').modal('show');
                    $("#couponactivation-popup_main").find('.popup_idsection').text(result);
                    $("#couponactivation-popup_main").find('.popup_idsection').text(result);
                    $("#couponactivation-popup_main").find('.popup_namesection').text(name);
                    $("#couponactivation-popup_main").find(".popup_couponlink").html('<a class="know_coupon_popup colio-link" onclick="compare_product_click_category(\'' + url_main + '\',\'redirect\')">SHOP NOW AT ' + seller_name + '</a>');
                    $("#couponactivation-popup_main").find('.popup_brandsection').text(seller_name);
                    var cashback_info = $("#extra_cashback_infomain_text" + offer_id + " .detai-h5").html();
                    $("#couponactivation-popup_main").find("#extra_cashback_popup").html(cashback_info);
                  });
                }
                $("#User_Id").val(result);
                $("#" + coupon).find(".coupon_loading").css("display", "none");
                $("#" + coupon).find('.coupon_info_section').show();
                $("#" + coupon).find('#coupon_cash_sms').hide();
                $("#" + coupon).find('#coupon_get_sms').show();
                $("#user_name").val(name);
                var url = $("#" + coupon).find('#coupon_get_sms').attr('href');
                if (url_type == 1) {
                  var url_main = url + "&UID=" + result + "&UID2=" + full_name;
                } else if (url_type == 2) {
                  var url_main = url + "&affExtParam1=" + result + "&affExtParam2=" + full_name;
                } else if (url_type == 3 || url_type == 11 || url_type == 13) {
                  var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                } else if (url_type == 4) {
                  var url_main = url + "&aff_sub2=" + result + "&aff_sub3=" + full_name;
                } else if (url_type == 7) {
                  var url_main = url + "&ascsubtag=" + result;
                } else if (url_type == 8) {
                  var url_main = url + "?subid=" + result;
                } else if (url_type == 9) {
                  var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                } else if (url_type == 10) {
                  var url_main = url + "&subid=" + result;
                } else if (url_type == 12) {
                  var url_main = url + "&s2=" + result + "&s3=" + full_name;
                } else {
                  var url_main = url;
                }
                $("#" + coupon).find('#coupon_get_sms').attr('href', url_main);
                var high = $("#" + coupon).find("#show_high").val();
                var info = $("#" + coupon).find('show_info').val();
                if (high == 1) {
                  $("li[id='main-" + row + "']").css('height', '580px');
                } else {
                  if (info == 1) {
                    $("li[id='main-" + row + "']").css('height', '530px');
                  } else {
                    $("li[id='main-" + row + "']").css('height', '530px');
                  }
                }
                $("li[id='main-" + row + "']").find("#show_high").val(1);
              }
            }
          }
          $("#after-login-drop").show();
          $("#before-login-drop").hide();
          $("#f_name").text(response.first_name);
          $("#user_log").val(obj.id);
          $.ajax({
            type: "POST",
            url: "/Generals/cashback_activate",
            data: "&user_id=" + result,
            success: "success",
            dataType: 'text',
            context: document.body
          }).done(function(msg) {
            var data = $.parseJSON(msg);
            main_mobile = data.main_mobile;
            main_email = data.main_email;
            if ((main_email == '' || main_email == null) || (main_mobile == '' || main_mobile == null)) {
              $("#second-login-popup").modal('show');
              if (main_email != '' && main_email != null) {
                $("#second-login-popup #Business_Email_Id").hide();
                $("#email_pressence").val(1);
              }
              if (main_mobile != '' && main_mobile != null) {
                $("#second-login-popup #txtMblNo").hide();
                $("#second-login-popup .std-code").hide();
                $("#mobile_pressence").val(1);
              }
            }
          });
        } else if (controller == 'offers') {
          $("#User_Id").val(result);
          $("#User_Id_Main").val(result);
          $("#login-popup2").modal('hide');
          $("#login-popup3").modal('hide');
          $('body').removeClass('modal-open');
          $(".modal-backdrop").remove();
          $('a[id*="shop_reward_login_button_index"]').removeAttr('data-target');
          $('a[id*="shop_reward_login_button_index"]').removeAttr('data-toggle');
          $('a[id*="login-index-offer"]').removeAttr('data-target');
          $('a[id*="login-index-offer"]').removeAttr('data-toggle');
          $(".info-22-benefit").each(function() {
            var element2 = $(this);
            element2.find("#username_info").text(name);
            element2.find("#useraccount_info").text(result);
            element2.show();
          });
          $("div[id='info_benefit_info']").css('display', 'inline-block');
          $("#user_name").val(name);
          $(".main_know_link").each(function() {
            var current_element = $(this);
            $(this).removeAttr('data-toggle');
            $(this).removeAttr('data-target');
          });
          var offer_id = $("#offer_main_id").val();
          var id = "offer_area" + offer_id;
          $("#cashbackinfo-popup").modal('hide');
          var login_type_offer_main = $("#login_type_offer").val();
          var offer_page_type = $("#login_page_type").val();
          if (offer_page_type == 'main') {
            var login_type_offer_id = $("#login_type_offer_id").val();
          } else {
            var login_type_offer_id = $("#login_type_offer_id_detail").val();
          }
          if (login_type_offer_main == 'like') {
            if (offer_page_type == 'main') {
              like_login_lite(login_type_offer_id);
            } else {
              // alert(login_type_offer_id);
              like_login_lite_main(login_type_offer_id);
            }
          } else {
            if (offer_id != '' && offer_id != undefined && !$('#know-more-popup').is(':visible') && offer_id != 'offers') {
              var login_type_offer = $("#Login_For_Type").val();
              // if(result == 54204){
              // alert(login_type_offer);
              // }
              if (login_type_offer != 'cashback') {
                $.ajax({
                  type: "POST",
                  url: "/Offers/getUrl",
                  data: "offer_id=" + offer_id + "&user_id=" + result,
                  success: "success",
                  dataType: 'text',
                  context: document.body
                }).done(function(msg) {
                  var data = $.parseJSON(msg);
                  promourl = data.url;
                  url_type = data.url_type;
                  main_mobile = data.main_mobile;
                  main_email = data.main_email;
                  var name = $("#user_name").val();
                  var user = $("#User_Id").val();
                  if (url_type == 1) {
                    var url_main = promourl + "&UID=" + user + "&UID2=" + name;
                  } else if (url_type == 2) {
                    var url_main = promourl + "&affExtParam1=" + user + "&affExtParam2=" + name;
                  } else if (url_type == 3 || url_type == 11 || url_type == 13) {
                    var url_main = promourl + "&aff_sub=" + user + "&aff_sub2=" + name;
                  } else if (url_type == 4) {
                    var url_main = promourl + "&aff_sub2=" + user + "&aff_sub3=" + name;
                  } else if (url_type == 5) {
                    var url_main = promourl + "&ascsubtag=" + user;
                  } else if (url_type == 6) {
                    var url_main = promourl + "&aff_sub=" + user + "&aff_sub1=" + name;
                  } else if (url_type == 7) {
                    var url_main = promourl + "&ascsubtag=" + user;
                  } else if (url_type == 8) {
                    var url_main = promourl + "?subid=" + user;
                  } else if (url_type == 9) {
                    var url_main = promourl + "&aff_sub=" + user + "&aff_sub2=" + name;
                  } else if (url_type == 10) {
                    var url_main = promourl + "&subid=" + user;
                  } else if (url_type == 12) {
                    var url_main = promourl + "&s2=" + user + "&s3=" + name;
                  } else {
                    var url_main = promourl;
                  }
                  $(".coupon-check-section").each(function() {
                    var current = $(this);
                    $(this).hide();
                  });
                  $(".offer-check-info").each(function() {
                    var current2 = $(this);
                    $(this).show();
                  });
                  var seller_name = $("#" + id).find("#skip_title").val();
                  var cashback_info = $("#info-each-list-desk-cashback" + offer_id).html();
                  var cashback_info_button = $("#cashback_button" + offer_id).text();
                  if ($(window).width() < 700) {
                    cashback_info_button = cashback_info_button.replace('Cashback*', '');
                  } else {
                    cashback_info_button = cashback_info_button.replace('Cbk*', '');
                  }
                  var cashback_info_text = '<span class="glyphicon glyphicon-ok"></span>&nbsp;' + cashback_info_button;
                  $("span[id*='cashback_button']").each(function() {
                    $(this).removeClass('know3-cupn-cod-coup');
                    $(this).removeClass('know3-cupn-cod-coup');
                    $(this).removeClass('_sdbgbtnlite');
                    $(this).addClass('_sdnobgbtnlite');
                  });
                  // $("#cashback_button"+offer_id).html(cashback_info_text);
                  $('#couponactivation-popup').modal('show');
                  $("#couponactivation-popup").find('.popup_idsection').text(user);
                  $("#couponactivation-popup").find('.popup_namesection').text(name);
                  $("#couponactivation-popup").find("span[class='popup_brandsection']").text(seller_name);
                  var cashback_info = $("#info-each-list-desk-cashback" + offer_id).html();
                  cashback_info = cashback_info.replace('+', '');
                  $("#couponactivation-popup").find(".popup_couponlink").html('<a class="know_coupon_popup colio-link" onclick="compare_product_click_category(\'' + url_main + '\')">SHOP NOW AT ' + seller_name + '</a>')
                  $("#couponactivation-popup").find("#extra_cashback_popup").html(cashback_info);
                  if ((main_email == '' || main_email == null) || (main_mobile == '' || main_mobile == null)) {
                    $("#second-login-popup").modal('show');
                    if (main_email != '' && main_email != null) {
                      $("#second-login-popup #Business_Email_Id").hide();
                      $("#email_pressence").val(1);
                    }
                    if (main_mobile != '' && main_mobile != null) {
                      $("#second-login-popup #txtMblNo").hide();
                      $("#second-login-popup .std-code").hide();
                      $("#mobile_pressence").val(1);
                    }
                  }
                });
              } else {
                var login_typing = $("#Cashback_Login_Type").val();
                if (login_typing == 1) {
                  // alert("here");
                  var coupon = $("#offer_main_id").val();
                  var url_type = $("#" + coupon).find("#coupon_url_type").val();
                  var result = obj.result;
                  var mobile = obj.mobile;
                  var name = obj.user_name;
                  var main_name = obj.user_name;
                  name = name.replace(/\s/g, "-");
                  $("#login-popup2").hide();
                  $("#cashbackinfo-popup").modal('hide');
                  $('body').removeClass('modal-open');
                  $(".modal-backdrop").remove();
                  $("#User_Id").val(result);
                  $("#user_name").val(main_name);
                  var url = $("#" + coupon).find('#coupon_get_sms').attr('href');
                  var info = $("#" + coupon).find('#show_info').val();
                  if (url_type == 1) {
                    var url_main = url + "&UID=" + result + "&UID2=" + name;
                  } else if (url_type == 2) {
                    var url_main = url + "&affExtParam1=" + result + "&affExtParam2=" + name;
                  } else if (url_type == 3 || url_type == 11 || url_type == 13) {
                    var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + name;
                  } else if (url_type == 4) {
                    var url_main = url + "&aff_sub2=" + result + "&aff_sub3=" + name;
                  } else if (url_type == 5) {
                    var url_main = url + "&ascsubtag=" + result;
                  } else if (url_type == 6) {
                    var url_main = url + "&aff_sub=" + result + "&aff_sub1=" + name;
                  } else if (url_type == 7 || url_type == 5) {
                    var url_main = url + "&tag=749927-21&ascsubtag=" + result;
                  } else if (url_type == 8) {
                    var url_main = url + "?subid=" + result;
                  } else if (url_type == 9) {
                    var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + name;
                  } else if (url_type == 10) {
                    var url_main = url + "&subid=" + result;
                  } else if (url_type == 12) {
                    var url_main = url + "&s2=" + result + "&s3=" + name;
                  } else {
                    var url_main = url;
                  }
                  var seller_name = $("#" + coupon).find("#skip_title").val();
                  $('#couponactivation-popup-cashback').modal('show');
                  $("#couponactivation-popup-cashback").find('.popup_idsection').text(result);
                  $("#couponactivation-popup-cashback").find('.popup_namesection').text(name);
                  $("#couponactivation-popup-cashback").find("span[class='popup_brandsection']").text(seller_name);
                  var cashback_info = $("#" + coupon).find("#cashback_rs_only_code").val();
                  var cashback_id_main1 = "'" + coupon.replace("brand-coupon", "") + "','" + seller_name + "'";
                  $("#couponactivation-popup-cashback").find(".popup_couponlink").html('<a onclick="click_reward_login_index();" class="know_coupon_popup colio-link">SHOP NOW AT ' + seller_name + '</a>');
                  $("#couponactivation-popup-cashback").find("#extra_cashback_popup").html(" Get" + ' <span class="_cashsh4_popup">' + cashback_info + ' ' + "Cashback </span> from Xerve");
                } else {
                  $("#after-login-drop").show();
                  $("#before-login-drop").hide();
                  window.location.href = "https://www.xerve.in/myaccount/upload_bill";
                }
              }
            } else if (offer_id == 'offers') {
              // alert("code is coming here");
              var data = $.parseJSON(msg);
              $("#login-popupoffers").hide();
              $('body').removeClass('modal-open');
              $(".modal-backdrop").remove();
              $("#User_Id_Main").val(result);
              $("#user_name_main").val(name);
              $("#User_Id").val(result);
              var main_mobile = data.main_mobile;
              var main_email = data.main_email;
              $("#user_name").val(name);
              var cashback_id_main = $("#main_coupon_id_main").val();
              var url_type = $("#coupon_url_type_main" + cashback_id_main).val();
              var url = $('#coupon_get_sms_main' + cashback_id_main).val();
              var check_make = $("#makemytripinputno" + cashback_id_main).val();
              if (check_make != undefined && check_make != '') {
                url = $('#makemytripinputnum' + check_make + cashback_id_main).val();
              }
              // if (cashback == 'cash') {
              if (url_type == 1) {
                var url_main = url + "&UID=" + result + "&UID2=" + name;
              } else if (url_type == 2) {
                var url_main = url + "&affExtParam1=" + result + "&affExtParam2=" + name;
              } else if (url_type == 3 || url_type == 11 || url_type == 13) {
                var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + name;
              } else if (url_type == 4) {
                var url_main = url + "&aff_sub2=" + result + "&aff_sub3=" + name;
              } else if (url_type == 5) {
                var url_main = url + "&ascsubtag=" + result;
              } else if (url_type == 6) {
                var url_main = url + "&aff_sub=" + result + "&aff_sub1=" + name;
              } else if (url_type == 7 || url_type == 5) {
                var url_main = url + "&tag=749927-21&ascsubtag=" + result;
              } else if (url_type == 8) {
                var url_main = url + "?subid=" + result;
              } else if (url_type == 9) {
                var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + name;
              } else if (url_type == 10) {
                var url_main = url + "&subid=" + result;
              } else if (url_type == 12) {
                var url_main = url + "&s2=" + result + "&s3=" + name;
              } else {
                var url_main = url;
              }
              $("#" + coupon).find('#coupon_get_sms').attr('href', url_main);
              $("#" + coupon).find('#coupon_cash_sms').hide();
              var seller_name = $("#seller_main_name").val();
              $("#cashbackinfo-popup-main").modal('hide');
              $('#couponactivation-popup-main').modal('show');
              $("#couponactivation-popup-main").find('.popup_idsection').text(result);
              $("#couponactivation-popup-main").find('.popup_namesection').text(name);
              $("#couponactivation-popup-main").find("span[class='popup_brandsection']").text(seller_name);
              var cashback_info = $(".coupon_rs_code_main").html();
              var makecashbk = $("#makemytripinputcashback" + cashback_id_main).val();
              if (makecashbk != undefined && makecashbk != '') {
                cashback_info = makecashbk + "";
              };
              var cashback_id_main1 = "'" + cashback_id_main + "'";
              var name_cas_here = "";
              if (cashback_id_main == 'XRVCOU1cac') {
                name_cas_here = "Rewards";
              } else {
                name_cas_here = "Cashback";
              }
              var url_url_main = "'" + url_main.trim() + "'";
              $("#couponactivation-popup-main").find(".popup_couponlink").html('<a class="know_coupon_popup colio-link" onclick="chashback_imgonline1_postlogin(\'' + cashback_id_main.trim() + '\');" >SHOP NOW AT ' + seller_name + '</a>')
              var name_cas_here = "";
              if (cashback_id_main == 'XRVCOU1cac') {
                name_cas_here = "Rewards";
              } else {
                name_cas_here = "Cashback";
              }
              var campaign_type = $("#campaign_type").val();
              $("#couponactivation-popup-main").find("#extra_cashback_popup").html(" Get" + ' ' + cashback_info + ' ' + " Xerve " + name_cas_here + "");
              if ((main_email == '' || main_email == null) || (main_mobile == '' || main_mobile == null)) {
                $("#second-login-popup").modal('show');
                if (main_email != '' && main_email != null) {
                  $("#second-login-popup #Business_Email_Id").hide();
                  $("#email_pressence").val(1);
                }
                if (main_mobile != '' && main_mobile != null) {
                  $("#second-login-popup #txtMblNo").hide();
                  $("#second-login-popup .std-code").hide();
                  $("#mobile_pressence").val(1);
                }
              }
            }
            var offer_id2 = $("#offer_Main_id_value").val();
            if (offer_id2 != '' && offer_id2 != undefined) {
              $("#login-popup3").modal('hide');
              $('body').removeClass('modal-open');
              $(".modal-backdrop").remove();
              $("#cashbackinfo-popup-main").modal('hide');
              $("#User_Id_Main").val(result);
              $("#user_name_main").val(name);
              $.ajax({
                type: "POST",
                url: "/Offers/getUrl",
                data: "offer_id=" + offer_id2 + "&user_id=" + result,
                success: "success",
                dataType: 'text',
                context: document.body
              }).done(function(msg) {
                var data = $.parseJSON(msg);
                promourl = data.url;
                var main_mobile = data.main_mobile;
                var main_email = data.main_email;
                url_type = data.url_type;
                if (url_type == 1) {
                  var url_main = promourl + "&UID=" + result + "&UID2=" + name;
                } else if (url_type == 2) {
                  var url_main = promourl + "&affExtParam1=" + result + "&affExtParam2=" + name;
                } else if (url_type == 3 || url_type == 11 || url_type == 13) {
                  var url_main = promourl + "&aff_sub=" + result + "&aff_sub2=" + name;
                } else if (url_type == 4) {
                  var url_main = promourl + "&aff_sub2=" + result + "&aff_sub3=" + name;
                } else if (url_type == 5) {
                  var url_main = promourl + "&ascsubtag=" + result;
                } else if (url_type == 6) {
                  var url_main = promourl + "&aff_sub=" + result + "&aff_sub1=" + name;
                } else if (url_type == 7) {
                  var url_main = promourl + "&ascsubtag=" + result;
                } else if (url_type == 8) {
                  var url_main = promourl + "?subid=" + result;
                } else if (url_type == 9) {
                  var url_main = promourl + "&aff_sub=" + result + "&aff_sub2=" + name;
                } else if (url_type == 10) {
                  var url_main = promourl + "&subid=" + result;
                } else if (url_type == 12) {
                  var url_main = promourl + "&s2=" + result + "&s3=" + name;
                } else {
                  var url_main = promourl;
                }
                $(".know3").each(function() {
                  var current_element = $(this);
                  $(this).removeAttr('data-toggle');
                  $(this).removeAttr('data-target');
                });
                $(".coupon-check-sectionmain").hide();
                $(".offer-check-infomain").show();
                var seller_name = $("#skip_title_main" + offer_id2).val();
                $('#couponactivation-popup_main').modal('show');
                $("#couponactivation-popup_main").find('.popup_idsection').text(result);
                $("#couponactivation-popup_main").find('.popup_namesection').text(name);
                $("#couponactivation-popup_main").find("span[class='popup_brandsection']").text(seller_name);
                var cashback_info = $("#extra_cashback_infomain_text" + offer_id2).html();
                cashback_info = cashback_info.replace('_cashsh4', '_cashsh4_popup');
                $("#couponactivation-popup_main").find(".popup_couponlink").html('<a class="know_coupon_popup colio-link" onclick="compare_product_click_category(\'' + url_main + '\')">SHOP NOW AT ' + seller_name + '</a>');
                $("#couponactivation-popup_main").find("#extra_cashback_popup").html(cashback_info);
                if ((main_email == '' || main_email == null) || (main_mobile == '' || main_mobile == null)) {
                  $("#second-login-popup").modal('show');
                  if (main_email != '' && main_email != null) {
                    $("#second-login-popup #Business_Email_Id").hide();
                    $("#email_pressence").val(1);
                  }
                  if (main_mobile != '' && main_mobile != null) {
                    $("#second-login-popup #txtMblNo").hide();
                    $("#second-login-popup .std-code").hide();
                    $("#mobile_pressence").val(1);
                  }
                }
              });
            }
          }
        } else if (controller == 'companies' || controller == 'genie') {
          $('#leadform_loading').show();
          // console.log('genie');
          $.ajax({
            type: "POST",
            url: "/Generals/cashback_activate",
            data: "&user_id=" + result,
            success: "success",
            dataType: 'text',
            context: document.body
          }).done(function(msg) {
            var data = $.parseJSON(msg);
            main_mobile = data.main_mobile;
            main_email = data.main_email;
            status_value = data.status_value;
            if ((main_email == '' || main_email == null) || (main_mobile == '' || main_mobile == null)) {
              $("#second-login-popup").modal('show');
              if (main_email != '' && main_email != null) {
                $("#second-login-popup #Business_Email_Id").hide();
                $("#email_pressence").val(1);
              }
              if (main_mobile != '' && main_mobile != null) {
                $("#second-login-popup #txtMblNo").hide();
                $("#second-login-popup .std-code").hide();
                $("#mobile_pressence").val(1);
              }
            } else {
              var login_type = $("#genie_login_type").val();
              if (controller == 'genie' && login_type == 'New_Enquiry') {
                $("#top_mob_display #mobile_number").val(mobile_genie);
                $("#top_mob_display #full_name").val(genie_name);
                $("#otp_all").hide();
                $("#validate_login").hide();
                $("#genie_login_type").val('social_login');
                // genie_name
                $("#quoteguestsave_bef").trigger('click');
                $(".fblogin").hide();
                // alert("the code is coming here");
              } else {
                $("#login-popup-vendors").modal('hide');
                $('body').removeClass('modal-open');
                $(".modal-backdrop").remove();
                $("#quotesave").show();
                $("#quoteloginbutton").hide();
                $("#QuoteUserId").val(result);
                var submit = $("input[id='submit_clicked']:last").val();
                if (submit == 1) {
                  console.log('submit is 1');
                  lead_insert();
                }
              }
            }
          });
        } else if (controller == 'prices') {
          var store = $("#store_id").val();
          var cat_id = $("#coupon_cat").val();
          $("#User_Id_Main").val(result);
          $("#user_name_main").val(name);
          if (status == 'Yes') {
            seller = $("#main_store" + store).find('#seller_name').val();
            var store = $("#store_id").val();
            var cat = $("#coupon_cat").val();
            var page = $("#coupon_page").val();
            var row = $("#coupon_row").val();
            $("#login-popup2").hide();
            $('body').removeClass('modal-open');
            $(".modal-backdrop").remove();
            $("#User_Id").val(result);
            $(".modal-body-login").remove();
            $(".close-cover-login").remove();
            $("span.login_text_xer").each(function() {
              $(this).text('View');
            });
            $("span[id*=login_line_shop]").each(function() {
              $(this).hide();
            });
            $("span[id*=login_line_shop_index_text]").each(function() {
              $(this).hide();
            });
            $("span.login_line_shop_index_lite").each(function() {
              $(this).hide();
            })
            $("span[id*=login_line_shop_index]").each(function() {
              var current_element = $(this);
              $(this).removeAttr('data-toggle');
              $(this).removeAttr('data-target');
            });
            $(".know2_shop").each(function() {
              var current_element = $(this);
              $(this).removeAttr('data-toggle');
              $(this).removeAttr('data-target');
            });
            $(".know2_shop_compare").each(function() {
              var current_element = $(this);
              $(this).removeAttr('data-toggle');
              $(this).removeAttr('data-target');
            });
            $("span[id*=grab_deal_button]").each(function() {
              $(this).removeAttr('data-toggle');
              $(this).removeAttr('data-target');
            });
            $(".know2_shop_desk").each(function() {
              var current_element = $(this);
              $(this).removeAttr('data-toggle');
              $(this).removeAttr('data-target');
            });
            $(".store_buy_main_cashback").removeAttr('data-toggle');
            $(".store_buy_main_cashback").removeAttr('data-target');
            $(".bold_seller_one_blue").removeAttr('data-toggle');
            $(".bold_seller_one_blue").removeAttr('data-target');
            $.ajax({
              type: "POST",
              url: "/Generals/coupon_number",
              data: "seller_name=" + seller + "&user_id=" + result,
              success: "success",
              dataType: 'text',
              context: document.body
            }).done(function(msg) {
              var data = $.parseJSON(msg);
              number = data.number;
              activate = data.activated;
              show_section = data.show_section;
              balance = data.balance;
              need = data.need;
              total = data.total;
              seller = data.seller;
              main_mobile = data.main_mobile;
              main_email = data.main_email;
              var login_type = $("#login_type").val();
              if (login_type == 'like') {
                $("#login-popup2").hide();
                $('body').removeClass('modal-open');
                $(".modal-backdrop").remove();
                $(".like-login-a").each(function() {
                  var current_element = $(this);
                  $(this).removeAttr('data-toggle');
                  $(this).removeAttr('data-target');
                });
                var store_id = $("#store_id").val();
                var id = $("#id_value").val();
                var session_id = $("#Session_Id").val();
                var like_title = $("#shop_price_alert_title_main").val();
                var like_price = $("#shop_price_alert_price_main").val();
                $("#User_Id").val(result);
                var user_id = result;
                $.ajax({
                  type: "POST",
                  url: "/Connect/likes",
                  data: "user_id=" + user_id + "&id=" + id + "&session_id=" + session_id + "&store_id=" + store + "&title=" + like_title + "&price=" + like_price,
                  success: "success",
                  dataType: 'text',
                  context: document.body
                }).done(function(msg) {
                  $('#Like' + id).html('<span class="image_down_function"><img src="/img/save.png"></span>Saved');
                  $('#Like' + id).css('cssText', 'color:#ff6600!important');
                  $('#brand_heart_lite_' + id).css('cssText', 'color:#ff0000!important');
                });
              } else if (login_type == '') {
                $('body').removeClass('modal-open');
                $(".modal-backdrop").remove();
                $("#login-popup").hide();
              }
              var seller_social = $("#main_store" + store).find("#seller_social").val();
              var page = $("#page_value").val();
              if (page == 'fullpage') {
                var login_type_value = $("#coupon_login_main").val();
                if (login_type_value == 1) {
                  login_type = "coupon";
                } else if (login_type_value == 2) {
                  login_type = 'buy';
                } else if (login_type_value == 6) {
                  login_type = 'like';
                } else if (login_type_value == 7) {
                  login_type = 'like-separate'
                } else if (login_type_value == 10) {
                  login_type = 'price_alert';
                } else if (login_type_value == 12) {
                  login_type = 'cashback';
                } else if (login_type_value == 13) {
                  login_type = 'enquiry';
                }
                if (login_type == 'cashback') {
                  var url = $("#cashback_url_value").val();
                  var url_type = $("#cashback_url_type").val();
                  var seller_name = $("#cashback_seller_name").val();
                  if (url_type == 1) {
                    var url_main = url + "&UID=" + result + "&UID2=" + full_name;
                  } else if (url_type == 2) {
                    var url_main = url + "&affExtParam1=" + result + "&affExtParam2=" + full_name;
                  } else if (url_type == 3 || url_type == 11 || url_type == 13) {
                    var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                  } else if (url_type == 4) {
                    var url_main = url + "&aff_sub2=" + result + "&aff_sub3=" + full_name;
                  } else if (url_type == 6) {
                    var url_main = url + "&aff_sub=" + result + "&aff_sub1=" + full_name;
                  } else if (url_type == 7 || url_type == 5) {
                    var url_main = url + "&tag=749927-21&ascsubtag=" + result;
                  } else if (url_type == 8) {
                    var url_main = url + "?subid=" + result;
                  } else if (url_type == 9) {
                    var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                  } else if (url_type == 10) {
                    var url_main = url + "&subid=" + result;
                  } else if (url_type == 12) {
                    var url_main = url + "&s2=" + result + "&s3=" + full_name;
                  } else {
                    var url_main = url;
                  }
                  $("#cashbackinfo-popup").modal('hide');
                  $('#couponactivation-popup-main').modal('show');
                  $("#couponactivation-popup-main").find('.popup_idsection').text(result);
                  $("#couponactivation-popup-main").find('.popup_namesection').text(full_name);
                  $("#couponactivation-popup-main").find("span[class='popup_brandsection']").text(seller_name);
                  var cashback_info = $("#coupon_rs_code_main").val();
                  $("#couponactivation-popup-main").find(".popup_couponlink").html('<a class="know_coupon_popup colio-link" onclick="compare_product_click_category(\'' + url_main + '\')">SHOP NOW AT ' + seller_name + '</a>')
                  $("#couponactivation-popup-main").find("#extra_cashback_popup").html(" Get" + ' ' + cashback_info + '%' + " on Xerve Cashback");
                }
                if (login_type == 'enquiry') {
                  var store_id_alert = $("#shop_skip_id_main").val();
                  var mobile = obj.mobile;
                  $("#mobile_offline_club" + store_id_alert).val(mobile);
                  $("#shop_offline_quotes_submit" + store_id_alert).trigger('click');
                }
                if (login_type == 'price_alert') {
                  $("#login-popup3").hide();
                  $("#User_Id_Main").val(result);
                  $(".like-login-a").each(function() {
                    var current_element = $(this);
                    $(this).removeAttr('data-toggle');
                    $(this).removeAttr('data-target');
                  });
                  var title_alert = $("#shop_price_alert_title").val();
                  var price_alert = $("#shop_price_alert_price").val();
                  var store_id_alert = $("#shop_skip_id_main").val();
                  var user_id = result;
                  var session_id = $("#Session_Id_Main").val();
                  $("#want-login-main").addClass("custom-checked");
                  $("#want-login-main").removeClass("custom-checkbox");
                  $.ajax({
                    type: "POST",
                    url: "/Connect/price_alert_enter",
                    data: "user_id=" + user_id + "&title=" + title_alert + "&session_id=" + session_id + "&store_id=" + store_id_alert + "&price=" + price_alert,
                    success: "success",
                    dataType: 'text',
                    context: document.body
                  }).done(function(msg) {});
                }
                if (login_type == 'like-separate') {
                  $(".like-login-a").each(function() {
                    var current_element = $(this);
                    $(this).removeAttr('data-toggle');
                    $(this).removeAttr('data-target');
                  });
                  $("#login-popup3").hide();
                  $('body').removeClass('modal-open');
                  $(".modal-backdrop").remove();
                  $("#User_Id_Main").val(result);
                  var store_id = $("#store_id_main").val();
                  var id = $("#id_value_main_page").val();
                  var session_id = $("#Session_Id_Main").val();
                  var user_id = result;
                  $.ajax({
                    type: "POST",
                    url: "/Connect/likes",
                    data: "user_id=" + user_id + "&id=" + id + "&session_id=" + session_id + "&store_id=" + store_id,
                    success: "success",
                    dataType: 'text',
                    context: document.body
                  }).done(function(msg) {
                    $('#Like-separate' + id + 'inner').html('<span class="image_down_function"><img src="/img/save.png"></span>Saved');
                    $('#Like-separate' + id + 'inner').css('cssText', 'color:#ff6600!important');
                    $('#brand_heart_lite_main_' + id).css('cssText', 'color:#ff0000!important');
                  });
                }
                if (login_type == 'like') {
                  $(".like-login-a").each(function() {
                    var current_element = $(this);
                    $(this).removeAttr('data-toggle');
                    $(this).removeAttr('data-target');
                  });
                  $("#login-popup3").hide();
                  var store_id = $("#store_id_main").val();
                  var id_main = $("#id_value_main_page").val();
                  var session_id = $("#Session_Id_Main").val();
                  var user_id = result;
                  var title_alert = $("#shop_price_alert_title").val();
                  var price_alert = $("#shop_price_alert_price").val();
                  $.ajax({
                    type: "POST",
                    url: "/Connect/likes",
                    data: "user_id=" + user_id + "&id=" + id_main + "&session_id=" + session_id + "&store_id=" + store + "&title=" + title_alert + "&price=" + price_alert,
                    success: "success",
                    dataType: 'text',
                    context: document.body
                  }).done(function(msg) {
                    $('#Like' + id_main + '-inner').addClass('liked-store-product');
                    $('#brand_heart_lite_main_' + id).css('cssText', 'color:#ff0000!important');
                  });
                }
                if (login_type == 'buy') {
                  var shop_url = $("#social-link").val();
                  var seller_social = $("#seller_name_main").val();
                  if (seller_social == 'Flipkart.com') {
                    shop_url = shop_url + "&affExtParam1=" + result + "&affExtParam2=" + full_name;
                  } else if (seller_social == 'Snapdeal.com') {
                    shop_url = shop_url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                  } else if (seller_social == 'Zovi.com' || seller_social == 'Amazon.in') {
                    shop_url = shop_url + '&ascsubtag=' + result;
                  } else if (seller_social == 'Bluestone.com') {
                    shop_url = shop_url + "&UID=" + result + "&UID2=" + full_name;
                  } else {
                    shop_url = shop_url + "&UID=" + result + "&UID2=" + full_name;
                  }
                }
                $("#full_list_button").attr('href', shop_url);
                if (login_type == 'coupon') {
                  if (result == 'No') {
                    $("#login-popup2").hide();
                    $('body').removeClass('modal-open');
                    $(".modal-backdrop").remove();
                    $("#coupon_button").hide();
                    $(".coupon_shop_main").hide();
                    $(".coupon_details_shop").html("<span class='bold_activation'>PLEASE CLICK ON THE LINK IN ACCOUNT ACTIVATION EMAIL TO PROCEED.</span>");
                    $(".bold").css("font-weight", "bold");
                    $(".coupon_details_shop").css("font-size", "10px");
                    $(".coupon_details_shop").css("margin-bottom", "10px");
                  } else {
                    var name = obj.user_name;
                    $("#login-popup2").hide();
                    $('body').removeClass('modal-open');
                    $(".modal-backdrop").remove();
                    $("#User_Id").val(result);
                    var seller = $("seller").val();
                    $("#mobile_number").val(mobile);
                    if (show_section == 'Yes') {
                      $("#coupon_button").hide();
                      $(".coupon_shop_main").show();
                      $(".coupon_get_sms_shop").attr("href", shop_url);
                    } else {
                      if (activate == 'Activated') {
                        $("#coupon_button").hide();
                        $(".coupon_shop_main").hide();
                        $(".coupon_details_shop").html("<span class='bold'></span>YOUR XERVE CASH BALANCE IS <span class='bold '>RS. " + total + "</span><br/>YOUR APPROVED XERVE CASH IS <span class='bold colored'>RS. " + balance + "</span><br/></br/>YOU NEED AN EXTRA RS. " + need + " APPROVED XERVE CASH TO BE ABLE TO PICK A <i class='fa fa-rupee'></i> 100 COUPON.<br/><br/> <a href='/cashback?need=Personal' target='_blank' style='color:#0070c0'>VIEW ALL <span class='bold'>CLICK -> SHOP -> EARN CASHBACK</span> PROGRAMS</a>");
                        $(".bold").css("font-weight", "bold");
                        if (balance < 100) {
                          $(".colored").css('color', '#FF0000');
                        } else {
                          $(".colored").css('color', '#00b050');
                        }
                        $(".coupon_details_shop").css("font-size", "10px");
                        $(".coupon_details_shop").css("margin-bottom", "10px");
                      } else {
                        $("#coupon_button").hide();
                        $(".coupon_shop_main").hide();
                        $(".coupon_details_shop").html("<span class='bold_activation'>PLEASE CLICK ON THE LINK IN ACCOUNT ACTIVATION EMAIL TO PROCEED.</span>");
                        $(".bold").css("font-weight", "bold");
                        $(".coupon_details_shop").css("font-size", "10px");
                      }
                    }
                  }
                }
              }
              if (login_type == 'buy') {
                $("#User_Id_Main").val(result);
                $("#user_name_main").val(full_name);
                $("#User_Id").val(result);
                $("#user_name").val(full_name);
                var page_option = $("#page_option").val();
                var shop_url = $("#social-link").val();
                $("#login-popup2").modal('hide');
                $('body').removeClass('modal-open');
                $(".modal-backdrop").remove();
                if (seller_social == 'Flipkart.com') {
                  shop_url = shop_url + "&affExtParam1=" + result + "&affExtParam2=" + full_name;
                } else if (seller_social == 'Snapdeal.com') {
                  shop_url = shop_url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                } else if (seller_social == 'Zovi.com' || seller_social == 'Amazon.in') {
                  shop_url = shop_url + '&ascsubtag=' + result;
                } else if (seller_social == 'Bluestone.com') {
                  shop_url = shop_url + "&UID=" + result + "&UID2=" + full_name;
                } else {
                  shop_url = shop_url + "&UID=" + result + "&UID2=" + full_name;
                }
                if (page_option == 'fullhalf') {
                  var shop_url = $("#social-link-fullhalf").val();
                  seller_social = $("#seller_social_fullhalf").val();
                  $(".login-client-two-half,.store_buy").each(function() {
                    var current_element = $(this);
                    $(this).removeAttr('data-toggle');
                    $(this).removeAttr('data-target');
                  });
                  if (seller_social == 'Flipkart.com') {
                    shop_url = shop_url + "&affExtParam1=" + result + "&affExtParam2=" + full_name;
                  } else if (seller_social == 'Snapdeal.com') {
                    shop_url = shop_url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                  } else if (seller_social == 'Zovi.com' || seller_social == 'Amazon.in') {
                    shop_url = shop_url + '&ascsubtag=' + result;
                  } else if (seller_social == 'Bluestone.com') {
                    shop_url = shop_url + "&UID=" + result + "&UID2=" + full_name;
                  } else {
                    shop_url = shop_url + "&UID=" + result + "&UID2=" + full_name;
                  }
                  $("#login-popup3").modal('hide');
                  $("#login-popup").modal('hide');
                  $("#User_Id_Main").val(result);
                  $("#user_name_main").val(full_name);
                  $("#User_Id").val(result);
                  $("#user_name").val(full_name);
                  var seller_name = $("#seller_half").val();
                  var cash_info = $("#cashback_half").val();
                  var product_name = $("#product_half").val();
                  var image = $('#image_name_main').val();
                  var image_url = cloudfront_imgshop + "/" + seller_social + "/" + image;
                  var image_url = getImageNames('Small', seller_social, image);
                  if (parseInt(cash_info) == 0) {} else {
                    $("#couponactivation-popup_main").find('.popup_product_image').attr("src", image_url);
                    $('#couponactivation-popup_main').modal('show');
                    $("#cashbackinfo-popup-main").modal('hide');
                    $("#couponactivation-popup_main").find('.popup_idsection').text(result);
                    $("#couponactivation-popup_main").find('.popup_namesection').text(full_name);
                    $("#couponactivation-popup_main").find('.popup_productsection').text(product_name);
                    $("#couponactivation-popup_main").find("span[class='popup_brandsection']").text(seller_name);
                    var cashback_info = cash_info + ' ' + ' Xerve Cashback';
                    $("#couponactivation-popup_main").find(".popup_couponlink").html('<a class="know_coupon_popup colio-link" onclick="compare_product_click_category(\'' + shop_url + '\')">SHOP NOW AT ' + seller_name + '</a>')
                    $("#couponactivation-popup_main").find("#extra_cashback_popup").html(" Get" + ' ' + cashback_info);
                  }
                  var coupon_show = $("div[id='main_store" + store + "']").find("#coupon_show").val();
                  $("#full_list_button").attr('href', shop_url);
                }
                if (page_option == 'half') {
                  var seller_main = $("#seller").val();
                  if (seller_main == 'Flipkart.com') {
                    shop_url = shop_url + "&affExtParam1=" + result + "&affExtParam2=" + full_name;
                  } else if (seller_main == 'Snapdeal.com') {
                    shop_url = shop_url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                  } else if (seller_main == 'Zovi.com' || seller_main == 'Amazon.in') {
                    shop_url = shop_url + '&ascsubtag=' + result;
                  } else if (seller_main == 'Bluestone.com') {
                    shop_url = shop_url + "&UID=" + result + "&UID2=" + full_name;
                  } else {
                    shop_url = shop_url + "&UID=" + result + "&UID2=" + full_name;
                  }
                  $("#login-popup").modal('hide');
                  $(".login-client-two-half").each(function() {
                    var current_element = $(this);
                    $(this).removeAttr('data-toggle');
                    $(this).removeAttr('data-target');
                  });
                  $("div[id*=lite_cashback_sec]").each(function() {
                    var current_element = $(this);
                    $(this).removeAttr('data-toggle');
                    $(this).removeAttr('data-target');
                  });
                  $("div[id*=xerve_point_block]").each(function() {
                    var current_element = $(this);
                    $(this).removeAttr('data-toggle');
                    $(this).removeAttr('data-target');
                  });
                  $("#main_store" + store).find("#coupon_list_button").attr('href', shop_url);
                  var product_name = $("#main_store" + store).find("#skip_product").val();
                  var seller_name = $("#main_store" + store).find("#skip_title").val();
                  var seller_name_image = $("#main_store" + store).find("#seller_social").val();
                  var image = $('#image_popup_name').val();
                  var image_url = "https://d19n7ukq09i248.cloudfront.net/" + seller_main + "/" + image;
                  var cashback_info_value = $("#main_store" + store).find('.heading_cashback_value').val();
                  if (cashback_info_value == undefined || cashback_info_value == 0 || cashback_info_value == '') {
                    $(".modal-backdrop").remove();
                  } else {
                    var image = $('#image_popup_name').val();
                    seller = seller_name_image;
                    var image_url = cloudfront_imgshop + "/" + seller + "/" + image;
                    var sellering = $("#seller").val();
                    var image_url = getImageNames('Small', seller_name_image, image);
                    $("#couponactivation-popup").find('.popup_product_image').attr("src", image_url);
                    $('#couponactivation-popup').modal('show');
                    $("#cashbackinfo-popup").modal('hide');
                    $("#couponactivation-popup").find('.popup_idsection').text(result);
                    $("#couponactivation-popup").find('.popup_namesection').text(full_name);
                    $("#couponactivation-popup").find(".popup_productsection").text(product_name);
                    $("#couponactivation-popup").find("span[class='popup_brandsection']").text(seller_name);
                    var cashback_info = $("#main_store" + store).find(".heading_cashback").html();
                    $("#couponactivation-popup").find(".popup_couponlink").html('<a class="know_coupon_popup colio-link" onclick="compare_product_click_category(\'' + shop_url + '\')">SHOP NOW AT ' + seller_name + '</a>')
                    $("#couponactivation-popup").find("#extra_cashback_popup").html("Get " + cashback_info_value + ' ' + " Xerve Cashback");
                  }
                } else if (page_option == 'fullpage') {
                  $(".login-client-two-half,.store_buy").each(function() {
                    var current_element = $(this);
                    $(this).removeAttr('data-toggle');
                    $(this).removeAttr('data-target');
                  });
                  $("#login-popup3").modal('hide');
                  $("#login-popup").modal('hide');
                  var shop_url = $("#full_url_value").val();
                  var seller_social = $("#seller_social_main").val();
                  $("#user_name_main").val(full_name);
                  if (seller_social == 'Flipkart.com') {
                    shop_url = shop_url + "&affExtParam1=" + result + "&affExtParam2=" + full_name;
                  } else if (seller_social == 'Snapdeal.com') {
                    shop_url = shop_url + "&aff_sub=" + result + "&aff_sub2=" + full_name;
                  } else if (seller_social == 'Zovi.com' || seller_social == 'Amazon.in') {
                    shop_url = shop_url + '?&tag=749927-21&ascsubtag=' + result;
                  } else if (seller_social == 'Bluestone.com') {
                    shop_url = shop_url + "&UID=" + result + "&UID2=" + full_name;
                  } else {
                    shop_url = shop_url + "&UID=" + result + "&UID2=" + full_name;
                  }
                  $("#full_list_button").attr('href', shop_url);
                  var seller_name = $("#skip_title_main").val();
                  var product_name = $("#skip_product_main").val();
                  var cashback_info = $(".heading_section_price_cashback").html();
                  var cashback_info_value_main = $("#heading_section_price_cashback_value").val();
                  if (cashback_info_value_main == undefined || cashback_info_value_main == '' || cashback_info_value_main == 0) {
                    $(".store_buy_main_cashback").attr('href', shop_url);
                  } else {
                    $('#couponactivation-popup_main').modal('show');
                    var image = $('#image_name_main').val();
                    var image_url = "https://d19n7ukq09i248.cloudfront.net/" + seller_social + "/" + image;
                    var cashback_info_text = cashback_info_value_main + " Xerve Cashback";
                    $("#couponactivation-popup_main").find('.popup_product_image').attr("src", image_url);
                    $("#cashbackinfo-popup-main").modal('hide');
                    $("#couponactivation-popup_main").find('.popup_idsection').text(result);
                    $("#couponactivation-popup_main").find('.popup_namesection').text(full_name);
                    $("#couponactivation-popup_main").find('.popup_productsection').text(product_name);
                    $("#couponactivation-popup_main").find("span[class='popup_brandsection']").text(seller_name);
                    $("#couponactivation-popup_main").find(".popup_couponlink").html('<a class="know_coupon_popup colio-link" onclick="compare_product_click_category(\'' + shop_url + '\')">SHOP NOW AT ' + seller_name + '</a>')
                    $("#couponactivation-popup_main").find("#extra_cashback_popup").html(" Get" + ' ' + cashback_info_text);
                  }
                }
                var cat = $("#coupon_cat").val();
                var page = $("#coupon_page").val();
                var row = $("#coupon_row").val();
                var coupon_show = $("div[id='main_store" + store + "']").find("#coupon_show").val();
                if (coupon_show == 1) {
                  $("li[id*='main_" + cat + "_" + page + "_" + row + "']").css({
                    "height": "790px"
                  });
                  $("#main_store" + store).css({
                    "min-height": "750px"
                  });
                } else {}
              }
              if (login_type == 'coupon') {
                if (show_section == 'Yes') {
                  $("#main_store" + store).find("#coupon_button").hide();
                  $("#main_store" + store).find(".coupon_shop_main").show();
                  $("#main_store" + store).find('.coupon_get_info').show();
                  $("#main_store" + store).find('.coupon_get_info #number').val(mobile);
                  $("#main_store" + store).css({
                    "min-height": "740px"
                  });
                  $("li[id*='main_" + cat + "_" + page + "_" + row + "']").css({
                    "height": "760px"
                  });
                  $("#show_coupon_details" + store + cat_id).removeClass('no-dis').addClass('yes-dis');
                  $("#show_coupon_details" + store + cat_id).slideDown();
                  var url_type = $("#main_store" + store).find('#url_type').val();
                  var url = $("#main_store" + store).find('.coupon_get_sms_shop').attr('href');
                  var downloaded = $("#main_store" + store).find('#downloaded_cash').val();
                  $("#main_store" + store).find("#downloaded_cash").val(1);
                  if (url_type == 1) {
                    var url_main = url + "&UID=" + user_id + "&UID2=" + name;
                  } else if (url_type == 2) {
                    var url_main = url + "&affExtParam1=" + user_id + "&affExtParam2=" + name;
                  } else if (url_type == 3 || url_type == 11 || url_type == 13) {
                    var url_main = url + "&aff_sub=" + user_id + "&aff_sub2=" + name;
                  } else if (url_type == 4) {
                    var url_main = url + "&aff_sub2=" + user_id + "&aff_sub3=" + name;
                  } else if (url_type == 6) {
                    var url_main = url + "&aff_sub=" + user_id + "&aff_sub1=" + full_name;
                  } else if (url_type == 7 || url_type == 5) {
                    var url_main = url + "&tag=749927-21&ascsubtag=" + user_id;
                  } else if (url_type == 8) {
                    var url_main = url + "?subid=" + user_id;
                  } else if (url_type == 9) {
                    var url_main = url + "&aff_sub=" + user_id + "&aff_sub2=" + full_name;
                  } else if (url_type == 10) {
                    var url_main = url + "&subid=" + user_id;
                  } else if (url_type == 12) {
                    var url_main = url + "&s2=" + user_id + "&s3=" + full_name;
                  } else {
                    var url_main = url;
                  }
                  if (!url.match(/^http([s]?):\/\/.*/)) {
                    url_main = 'http://' + url_main;
                  }
                  if (downloaded != 1) {
                    $("#main_store" + store).find('.coupon_get_sms_shop').attr('href', url_main);
                  }
                } else {
                  $("#main_store" + store).find("#coupon_button").hide();
                  $("#main_store" + store).find(".coupon_shop_main").hide();
                  $("#main_store" + store).find('.coupon_details_shop').html("<span class='bold'></span>YOUR XERVE CASH BALANCE IS <span class='bold '>RS. " + total + "</span><br/>YOUR APPROVED XERVE CASH IS <span class='bold colored'>RS. " + balance + "</span><br/></br/>YOU NEED AN EXTRA RS. " + need + " APPROVED XERVE CASH TO BE ABLE TO PICK A <i class='fa fa-rupee'></i> 100 COUPON.");
                  $("#main_store" + store).find('.coupon_details_shop').show();
                  $(".bold").css("font-weight", "bold");
                  if (balance < 100) {
                    $(".colored").css('color', '#FF0000');
                  } else {
                    $(".colored").css('color', '#00b050');
                  }
                  $("#main_store" + store).find(".coupon_details_shop").css("font-size", "10px");
                  $("#main_store" + store).find(".coupon_details_shop").css("margin-bottom", "10px");
                  $("#main_store" + store).css({
                    "min-height": "740px"
                  });
                  $("li[id*='main_" + cat + "_" + page + "_" + row + "']").css({
                    "height": "760px"
                  });
                  $("#show_coupon_details" + store + cat_id).removeClass('no-dis').addClass('yes-dis');
                  $("#show_coupon_details" + store + cat_id).slideDown();
                }
              }
              if ((main_email == '' || main_email == null) || (main_mobile == '' || main_mobile == null)) {
                $("#second-login-popup").modal('show');
                if (main_email != '' && main_email != null) {
                  $("#second-login-popup #Business_Email_Id").hide();
                  $("#email_pressence").val(1);
                }
                if (main_mobile != '' && main_mobile != null) {
                  $("#second-login-popup #txtMblNo").hide();
                  $("#second-login-popup .std-code").hide();
                  $("#mobile_pressence").val(1);
                }
              }
            });
          }
          return false;
        } else if (controller == 'Homes') {
          $('a').removeAttr('login-popup');
          alert("code is here");
          var login_type_home = $("#login_type_home").val();
          if (login_type_home == 'cashback') {
            var coupon = $("#cashback_get_id").val();
            var url_type = $("#coupon_url_type" + coupon).val();
            var result = obj.result;
            var mobile = obj.mobile;
            var name = obj.user_name;
            var main_name = obj.user_name;
            name = name.replace(/\s/g, "-");
            $("#login-popup2").hide();
            $("#cashbackinfo-popup").modal('hide');
            $('body').removeClass('modal-open');
            $(".modal-backdrop").remove();
            $("#User_Id").val(result);
            $("#user_name").val(main_name);
            var url = $('#coupon_get_sms').val();
            var info = $("#" + coupon).find('#show_info').val();
            url = url.trim();
            if (url_type == 1) {
              var url_main = url + "&UID=" + result + "&UID2=" + name;
            } else if (url_type == 2) {
              var url_main = url + "&affExtParam1=" + result + "&affExtParam2=" + name;
            } else if (url_type == 3 || url_type == 11 || url_type == 13 || url_type == 14) {
              var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + name;
            } else if (url_type == 4) {
              var url_main = url + "&aff_sub2=" + result + "&aff_sub3=" + name;
            } else if (url_type == 5) {
              var url_main = url + "&ascsubtag=" + result;
            } else if (url_type == 6) {
              var url_main = url + "&aff_sub=" + result + "&aff_sub1=" + name;
            } else if (url_type == 7 || url_type == 5) {
              var url_main = url + "&tag=749927-21&ascsubtag=" + result;
            } else if (url_type == 8) {
              // var url_main =url+"?subid="+result;
              if ((promourl.indexOf('?') == -1)) {
                var url_main = url + "?subid=" + result;
              } else {
                var url_main = url + "&subid=" + result;
              }
            } else if (url_type == 9) {
              var url_main = url + "&aff_sub=" + result + "&aff_sub2=" + name;
            } else if (url_type == 10) {
              var url_main = url + "&subid=" + result;
            } else if (url_type == 12) {
              var url_main = url + "&s2=" + result + "&s3=" + name;
            } else {
              var url_main = url;
            }
            var seller_name = $("#skip_title" + coupon).val();
            $('#couponactivation-popup-cashback').modal('show');
            $("#couponactivation-popup-cashback").find('.popup_idsection').text(result);
            $("#couponactivation-popup-cashback").find('.popup_namesection').text(name);
            $("#couponactivation-popup-cashback").find("span[class='popup_brandsection']").text(seller_name);
            var cashback_info = $("#cashback_rs_only_code" + coupon).val();
            // var cashback_id_main1 = "'"+coupon.replace("brand-coupon","")+"','"+seller_name+"'";
            $("#couponactivation-popup-cashback").find(".popup_couponlink").html('<a onclick="compare_product_click_category_offer_prices(\'' + url_main + '\');" class="know_coupon_popup colio-link">SHOP NOW AT ' + seller_name + '</a>');
            $("#couponactivation-popup-cashback").find("#extra_cashback_popup").html(" Get" + ' <span class="_cashsh4_popup">' + cashback_info + ' ' + "Cashback </span> from Xerve");
            } else {
            $(".close").click();
            var bill_upload = $("#bill_upload_value").val();
            if ($("#check_redirect_from_extension").val() == 1) {
              window.location.href = "https://www.xerve.in/";
              // window.location.href = $("#check_url_from_extension").val();
            } else {
              var checked_input = $("#checked_input").val();
              var page_type = $("#user_join_type").val();
              window.location.href = "https://www.xerve.in/";
              // alert(checked_input);
              if (checked_input != "" && checked_input != 0 && checked_input != null && checked_input != undefined) {
                if (checked_input == 'fashion') {
                  if (page_type == 2) {
                    window.location.href = "https://www.xerve.in/offers/category-fashion-and-lifestyle?cashback=yes";
                  } else {
                    window.location.href = 'https://www.xerve.in/prices/c-fashion%7Cfootwear';
                  }
                } else if (checked_input == 'mobiles') {
                  window.location.href = 'https://www.xerve.in/prices/c-mobiles-and-tablets';
                } else if (checked_input == 'food') {
                  window.location.href = "https://www.xerve.in/offers/category-food-and-dining?cashback=yes";
                } else if (checked_input == 'electronics') {
                  if (page_type == 2) {
                    window.location.href = "https://www.xerve.in/offers/category-electronics-and-appliances?cashback=yes";
                  } else {
                    window.location.href = 'https://www.xerve.in/prices/c-electronics-and-appliances';
                  }
                } else {
                  if (page_type == 3) {
                    window.location.href = "https://www.xerve.in/offers?cashback=yes";
                  } else {
                    window.location.href = "https://www.xerve.in/";
                  }
                }
              } else {
                if (bill_upload == 1) {
                  window.location.href = "https://www.xerve.in/myaccount/upload_bill";
                } else {
                  window.location.href = "https://www.xerve.in/";
                }
              }
            }
            var obj = jQuery.parseJSON(msg);
            if (obj.email && obj.mobile) {
              $("#second-login-popup").modal('hide');
            }
            if (obj.email != '' && obj.email != null) {
              $("#email_pressence_home").val(1);
            }
            if (obj.mobile != '' && obj.mobile != null) {
              $("#mobile_pressence_home").val(1);
            }
            if (obj.email) {
              $("#second-login-popup #Business_Email").hide();
            }
            if (obj.mobile) {
              $("#second-login-popup #txtMblNo").hide();
              $("#second-login-popup .std-code").hide();
            }
            if (msg == 0) {
              $("#after-login-drop").show();
              $("#before-login-drop").hide();
              $("#user_log").val(obj.id);
              $("#f_name").text(response.first_name);
              if (obj.email && obj.mobile) {
                $("#second-login-popup .close").click();
              }
            } else {
              $("#after-login-drop").show();
              $("#before-login-drop").hide();
              $("#f_name").text(response.first_name);
              $("#user_log").val(obj.id);
              if (obj.email && obj.mobile) {
                $("#second-login-popup").modal('hide');
              }
            }
          }
        } else {
          if (msg == 0) {
            $("#after-login-drop").show();
            $("#before-login-drop").hide();
            $("#f_name").text(response.first_name);
            $("#user_log").val(obj.id);
          } else {
            $("#after-login-drop").show();
            $("#before-login-drop").hide();
            $("#f_name").text(response.first_name);
            $("#user_log").val(obj.id);
          }
          if (product_url) window.location.href = product_url;
        }
      } else {
        $("#mobile_pressence").val(1);
        $("#email_pressence").val(1);
        f_id = obj.f_id;
        first_name = response.first_name;
        last_name = response.last_name;
        email_id = obj.email;
        main_mobile = obj.mobile;
        main_email = obj.email;
        gender = obj.gender;
        profile_pic = obj.profile_pic;
        $('#user_log').val(f_id)
        $("#f_id_valuation").val(f_id);
        $("#f_user_valuation").val(f_id);
        $("#f_user_email").val(main_email);
        $("#facebook_firstname").val(first_name);
        $("#facebook_gender").val(gender);
        $("#facebook_profile").val(profile_pic);
        $("#facebook_lastname").val(last_name);
        var controller = $("#ControllerName").val();
        $(".login-popup").modal('hide');
        if ((main_email == '' || main_email == null) || (main_mobile == '' || main_mobile == null)) {
          $("#second-login-popup").modal('show');
          if (main_email != '' && main_email != null && main_email != undefined) {
            $("#second-login-popup #Business_Email_Id").val(main_email);
            $("#second-login-popup #Business_Email_Id").prop("readonly", true);
          }
          if (main_mobile != '' && main_mobile != null) {
            $("#second-login-popup #txtMblNo").hide();
            $("#second-login-popup .std-code").hide();
            $("#mobile_pressence").val(1);
          }
        }
      }
    });
    //  console.log(JSON.stringify(response));
  });
}

function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}

function onLoad() {
  IN.User.logout();
}
$(document).ready(function() {
  $('div[id="facebook_custom_buton"]').unbind().click(function() {
    FB.login(function(response) {
      if (response.authResponse) {
        document.getElementById('facebook_custom_buton').style.display = 'none';
        $("#login-popup .modal-body").html('<div style="text-align:center; font-weight:bold; margin-top:50px;  padding-bottom:50px; ">Logging in to XERVE ...<br><br><img src="/img/loading_company.gif" align="Facebook Loggin In" class="img-responsive" /></div>');
        $("div.registered-skip-section").hide();
        testAPI();
      }
    }, {
      scope: 'email,public_profile',
      return_scopes: true
    });
  });
});

function facebook_confirm() {
  console.log('facebook_confirm');
  var mobile = $("#second-login-popup #txtMblNo").val();
  var email = $("#second-login-popup #Business_Email_Id").val();
  var email_pressence = $("#email_pressence").val();
  var mobile_pressence = $("#mobile_pressence").val();
  var login_type = "";
  var controller = $("#ControllerName").val();
  var code = $('#facebook_verify_code').val();
  var email_code = $("#facebook_verify_code_email").val();
  var id = $("#user_log").val();
  var f_id = $("#f_id_valuation").val();
  var reason = $("#f_authenticate_reason").val();
  if (reason == 'new_account' || reason == 'email_id_use') {
    var user_id_value = $("#facebook_intial_id").val();
  }
  var email_in_use_val = 0;
  if (code == '' || (email_code == '' && reason == 'email_id_use')) {
    $("#error_facebook_code").show();
  } else {
    $("#error_facebook_code").hide();
    email_in_use_val = 1;
  }
  if (code != '' && email_in_use_val == 1) {
    var unique_id_pixel = '';
    var pixel_url = '';
    if (/\bOMG\b/.test(window.location.href) === true && /\b-12\b/.test(window.location.href) === true) {
      if (/\bflipkart\b/.test(window.location.href) === true) {
        unique_id_pixel = 30344;
        pixel_url = "flipkart";
      } else if (/\bswiggy\b/.test(window.location.href) === true) {
        unique_id_pixel = 30331;
        pixel_url = "swiggy";
      }
    }
    $.ajax({
      type: "POST",
      url: "/Generals/facebook_confirm",
      data: "id=" + id + "&mobile=" + mobile + "&email=" + email + "&controller=" + controller + "&login_type=" + login_type + "&f_id=" + f_id + "&code=" + code + "&reason=" + reason + "&user_id_value=" + user_id_value + "&email_code=" + email_code + "&pixel=" + unique_id_pixel + "&pixel_url=" + pixel_url,
      success: "success",
      dataType: 'text',
      context: document.body
    }).done(function(msg) {
      var obj = jQuery.parseJSON(msg);
      var final = obj.final;
      if (final == 'login') {
        if (unique_id_pixel != '') {
          $(".append_src_main_your_code_fb").attr('src', 'https://track.in.omgpm.com/1053495/transaction.asp?APPID=' + user_id_value + '&MID=1053495&PID=' + unique_id_pixel + '&status=');
          $(".append_src_main_your_img_fb").html('<img src="https://track.in.omgpm.com/apptag.asp?APPID=' + user_id_value + '&MID=1053495&PID=' + unique_id_pixel + '&status=" border="0" height="1" width="1">');
        }
        testAPI();
      } else {
        $("#error_facebook_code").text("Please Enter Valid Code");
        $("#error_facebook_code").show();
      }
    });
  }
}

function linked_confirm() {
  console.log('linked_confirm');
  var mobile = $("#second-login-popup-linked #txtMblNo").val();
  var email = $("#second-login-popup-linked #Business_Email_Id").val();
  var email_pressence = $("#email_pressence_linked").val();
  var mobile_pressence = $("#mobile_pressence_linked").val();
  var login_type = "";
  var controller = $("#ControllerName").val();
  var code = $('#linked_verify_code').val();
  var email_code = $("#facebook_verify_code_email").val();
  var id = $("#user_log").val();
  var f_id = $("#f_id_valuation").val();
  var reason = $("#f_authenticate_reason").val();
  if (reason == 'new_account' || reason == 'email_id_use') {
    var user_id_value = $("#facebook_intial_id").val();
  }
  var email_in_use_val = 0;
  if (code == '' || (email_code == '' && reason == 'email_id_use')) {
    $("#error_facebook_code").show();
  } else {
    $("#error_facebook_code").hide();
    email_in_use_val = 1;
  }
  if (code != '' && email_in_use_val == 1) {
    $.ajax({
      type: "POST",
      url: "/Generals/linked_confirm",
      data: "id=" + id + "&mobile=" + mobile + "&email=" + email + "&controller=" + controller + "&login_type=" + login_type + "&f_id=" + f_id + "&code=" + code + "&reason=" + reason + "&user_id_value=" + user_id_value + "&email_code=" + email_code,
      success: "success",
      dataType: 'text',
      context: document.body
    }).done(function(msg) {
      var obj = jQuery.parseJSON(msg);
      var final = obj.final;
      if (final == 'login') {
        $.ajax({
          type: "POST",
          url: "/Generals/f_social_login_home",
          data: "email=" + email + "&f_id=" + f_id,
          success: "success",
          dataType: 'text',
          context: document.body
        }).done(function(msg) {
          var controller = $("#ControllerName").val();
          if (controller == 'companies' || controller == 'genie') {
            var submit = $("input[id='submit_clicked']:last").val();
            if (submit == 1) {
              lead_insert();
            } else {
              location.reload();
            }
          } else {
            location.reload();
          }
        });
      } else {
        $("#facebook_final_error").show();
      }
    });
  }
}