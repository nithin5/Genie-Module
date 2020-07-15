<script type="text/javascript" src="https://www.citruspay.com/resources/pg/js/webjs/citrus.js"> </script>
<script type="text/javascript" src="https://www.citruspay.com/resources/pg/js/webjs/jquery.payment.js"> </script>
<script>
        CitrusPay.Merchant.Config = {
            //Merchant details
            Merchant: {
                 accessKey: 'U7X6FU8HESD3NLLM746W',
                 vanityUrl: 'Xerve'
                
            }
        };
         $(document).ready(function() { 
                     $.support.cors = true; 
                     $('#citrusExpiry').payment('formatCardExpiry');
                     $('#citrusCvv').payment('formatCardCVC');
                     $('#citrusNumber').keyup(function() {
                              var cardNum = $('#citrusNumber').val().replace(/\s+/g, '');  
                               var type = $.payment.cardType(cardNum);   
                               $("#citrusNumber").css("background-image", "url(images/" + type + ".png)");      
                               if(type!='amex')
                                        $("#citrusCvv").attr("maxlength","3");
                                        else
                                        $("#citrusCvv").attr("maxlength","4");      
                               $('#citrusNumber').payment('formatCardNumber');           
                               $("#citrusScheme").val(type);  
                     });     
        });
          function getPaymentData(){
                         var data = {
                                     "customParameters": {
                                       // "productName": "123"
                                        "PayPackage":"<$=$PayPackage?>",
                                        "PaymentFor":"Leads",
                                        "PaymentMode":"ONLINE",
                                        "LeadsCredited":"<?=$leads_debit?>",
                                        "PayuserId":"<?=$receiver?>"

                                    },
                                };
                         return data;
          }
           function check_expiry(){

       var card_expiry=$("#citrusExpiry").val();
           if(card_expiry ==''){
                $('#citrusExpiry').css("border-color","#ff0000");
                $('#citrusExpiry_msg').show();
                $('#citrusExpiry_msg').text("* Please Enter Expiry Date");
                document.getElementById("citrusExpiry").value='';
                document.getElementById("citrusExpiry").focus();
              return false;
           }
            else{
                $('#citrusExpiry').css("border-color","#dddddd");
                $('#citrusExpiry_msg').hide();
           }

           var card_cvv=$("#citrusCvv").val();
           if(card_cvv ==''){
                $('#citrusCvv').css("border-color","#ff0000");
                $('#citrusCvv_msg').show();
                $('#citrusCvv_msg').text("* Please Enter CVV");
                document.getElementById("card_cvv").value='';
                document.getElementById("card_cvv").focus();
              return false;
           }
            else{
                $('#citrusCvv').css("border-color","#dddddd");
                $('#citrusCvv_msg').hide();
           }
    }
           function check_pay_card(){
           var card_number=$("#citrusNumber").val();
           if(card_number ==''){
               $('#citrusNumber').css("border-color","#ff0000");
                $('#citrusNumber_msg').show();
                $('#citrusNumber_msg').text("* Please Enter Valid Card Number");
              document.getElementById("citrusNumber").value='';
              document.getElementById("citrusNumber").focus();
              return false;
           }
            else{
                $('#citrusNumber').css("border-color","#dddddd");
                $('#citrusNumber_msg').hide();
           }
            var cardholder_name=$("#citrusCardHolder").val();
           if(cardholder_name ==''){
                $('#citrusCardHolder').css("border-color","#ff0000");
                $('#citrusCardHolder_msg').show();
                $('#citrusCardHolder_msg').text("* Please Enter Valid Name");
              document.getElementById("citrusCardHolder").value='';
              document.getElementById("citrusCardHolder").focus();
              return false;
           }
            else{
                $('#citrusCardHolder').css("border-color","#dddddd");
                $('#citrusCardHolder_msg').hide();
           }
           check_expiry();
      }
        function check(){
                var cardholder_name=$("#citrusCardHolder").val();
           if(cardholder_name ==''){
               $('#citrusCardHolder').css("border-color","#ff0000");
               $('#citrusCardHolder_msg').show();
               $('#citrusCardHolder_msg').text("* Please Enter Valid Name");
              document.getElementById("citrusCardHolder").value='';
              document.getElementById("citrusCardHolder").focus();
              return false;
           }
           else{
                 $('#citrusCardHolder').css("border-color","#dddddd");
                 $('#citrusCardHolder_msg').hide();
           }
          var alphanumers = /^[a-zA-Z \b]+$/;
                if(!alphanumers.test($("#citrusCardHolder").val())){

                    $('#citrusCardHolder').css("border-color","#ff0000");
                    $('#citrusCardHolder_msg').show();
                    $('#citrusCardHolder_msg').text("* Please Enter Valid Name");
                    document.getElementById("citrusCardHolder").value='';
                    document.getElementById("citrusCardHolder").focus();
                    return false;
                }
                 else{
                       $('#citrusCardHolder').css("border-color","#dddddd");
                       $('#citrusCardHolder_msg').hide();
              }
        }//check
        function check_email(){
                   var mobile_number=$("#citrusMobile").val();
                   valid_email=/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-zA-Z]{2,6}(?:\.[a-zA-Z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/;
                   var email=$("#citrusEmail").val();
                   if((email =='')||(!valid_email.test(email))){
                                  $('#citrusEmail').css("border-color","#ff0000");
                                  $('#citrusEmail_msg').show();
                                  $('#citrusEmail_msg').text("* Please Enter Email");
                                   document.getElementById("citrusEmail").value='';
                                   document.getElementById("citrusEmail").focus();
                                 
                                    return false;
                                 }
                                   else{
                                     $('#citrusEmail').css("border-color","#dddddd");
                                     $('#citrusEmail_msg').hide();
                                 }
        }//check_email
        function check_mobile(){
           valid_mobile=/^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1}){0,1}98(\s){0,1}(\-){0,1}(\s){0,1}[1-9]{1}[0-9]{7}$/;
                   var mobile_number=$("#citrusMobile").val();
                   if((mobile_number == '')||(!valid_mobile.test(mobile_number))){
                          $('#citrusMobile').css("border-color","#ff0000");
                         $('#citrusMobile_msg').show();
                         $('#citrusMobile_msg').text("* Please Enter Mobile");
                         document.getElementById("citrusMobile").value='';
                         document.getElementById("citrusMobile").focus();
                          return false;
                  }
                   else{
                       $('#citrusMobile').css("border-color","#dddddd");
                       $('#citrusMobile_msg').hide();
                  }
        }//check_mobile
           function GetCardType(number1)
          {
              // visa
              var number=number1.value;
              var cardscheme;
             
               re = new RegExp("^4");
              if (number.match(re) != null){
                cardscheme="VISA";
                 $('#citrusScheme').text(cardscheme);
              }
              // Mastercard
              re = new RegExp("^5[1-5]");
              if (number.match(re) != null){
                   cardscheme="MASTER CARD";
                   $('#citrusScheme').text(cardscheme);
                   }
              // AMEX
              re = new RegExp("^3[47]");
              if (number.match(re) != null){
                   cardscheme="AMEX";
                    $('#citrusScheme').text(cardscheme);
                   }
              // Discover
              re = new RegExp("^(6011|65|64[4-9]|622)");
              if (number.match(re) != null){
                   cardscheme="MASTER CARD";
                    $('#citrusScheme').text(cardscheme);
                   }
              // Diners
              re = new RegExp("^36");
              if (number.match(re) != null){
                   cardscheme="DINERS CLUB";
                    $('#citrusScheme').text(cardscheme);
                 }
              // Diners - Carte Blanche
              re = new RegExp("^30[0-5]");
              if (number.match(re) != null){
                   cardscheme="DINERS CARTE BLANCHE";
                    $('#citrusScheme').text(cardscheme);
                 }
              // JCB
              re = new RegExp("^35(2[89]|[3-8][0-9])");
              if (number.match(re) != null){
                   cardscheme="JCB";
                    $('#citrusScheme').text(cardscheme);
                 }
              // Visa Electron
              re = new RegExp("^(4026|417500|4508|4844|491(3|7))");
              if (number.match(re) != null){
                    cardscheme="VISA ELECTRON";
                    $('#citrusScheme').text(cardscheme);
                 }
              $("#citrusScheme").val(cardscheme);
          }
    </script>
	
 </head>
 <body>
   <?php                       
     $secret_key = "cdf66810b605309f96fc9b6944205003455057b7"; 
    $access_key = "U7X6FU8HESD3NLLM746W"; 
    //Should be unique for every transaction
   $txnID = uniqid();// mtx should be unique for every transaction
 
    if(($receiver==95449)||($receiver==50000)||($receiver==50001)||($receiver==129240)){
          if($free_credits==3){
                               $amount = "1";
          }else{
            $amount = "2";
          }
    }
    else{
  
         if($free_credits==3){
                    $amount = "1";
          }else{
                  $amount = $category_credits_1;
          }
   }
    $data = "merchantAccessKey=" . $access_key
                . "&transactionId="  . $txnID
                . "&amount="         . $amount;

    $signature = hash_hmac('sha1', $data, $secret_key);
 ?> 
      <div class="container prcelite" style="<?php if($credit_balance<=0){?>margin-top:0px!important"<?}?>>
      
     <div class='panel panel-info' >
    
         <button_basic align="center"  class="form-horizontal" autocomplete="off">
             
          

                <input type="hidden" label='firstname'   id="CompanyName" 
                value="<?php echo $User_data[0]['users']['company_name'];?>"/>
              
                        
                <input type="hidden" label='firstname'   id="citrusFirstName" 
                value="<?php if(COUNT($totaldata)>0){echo $lastpay_firstName;}else{echo $User_data[0]['users']['first_name'];}?>"/>
                         
               <input type="hidden"   id="citrusLastName" value="<?php if(COUNT($totaldata)>0){echo $lastpay_lastName;}else{$User_data[0]['users']['last_name'];}?>"/>
                
         
                  <input type="hidden"  id="citrusMobile" 
                  value="<?php  if(COUNT($totaldata)>0){echo $lastpay_mobileNo;}else{$User_data[0]['users']['mobile_number'];}?>" onchange="check_mobile();"/>
                   
          
                  <input type="hidden"  id="citrusEmail"
                   value="<?php if(COUNT($totaldata)>0){echo $lastpay_email;}else{$User_data[0]['users']['business_email'];}?>" onchange="check_email();"/>
                 
            
                <input type="hidden"  id="citrusStreet1" value="<?php if(COUNT($totaldata)>0){echo $lastpay_addressStreet1;}else{$User_data[0]['users']['address'];}?>"/>
                
              <input type="hidden"   id="citrusZip" value="<?php if(COUNT($totaldata)>0){echo $lastpay_addressZip;}else{$User_data[0]['users']['pincode'];}?>"/>
                    
      <!--Should be unique for every transaction-->
      <input type="hidden"  readonly id="citrusMerchantTxnId" value="<?php echo $txnID ?>"/>
       <input type="hidden"  readonly id="citrusAmount" value="<?php echo $amount ?>"/>
     <input type="hidden" id="citrusCustomParamCount" value="5"  />
     <input type="hidden"   id="citrusCountry" value="<?php  if(COUNT($totaldata)>0){echo $lastpay_addressCountry;}else{echo $country_name;}?>"/>
      <input type="hidden"  id="citrusState" 
                 value="<?php if(COUNT($totaldata)>0){echo $lastpay_addressState;}else{$User_data[0]['users']['state'];}?>"/>
    <input type="hidden"   id="citrusCity" 
                  value="<?php if(COUNT($totaldata)>0){echo $lastpay_addressCity;}else{$city_name;}?>"/>           
   <!--Custom parameter Name-->
     <!--Custom parameter Name-->
   <input type="hidden" id="citrusCustomParamsName1" value="PayPackage"  />
   <input type="hidden" id="citrusCustomParamsValue1" value="<?=$PayPackage?>"  />
   <input type="hidden" id="citrusCustomParamsName2" value="PaymentFor"  />
   <input type="hidden" id="citrusCustomParamsValue2" value="<?=$PaymentFor?>"  />
   <input type="hidden" id="citrusCustomParamsName3" value="PaymentMode"  />
   <input type="hidden" id="citrusCustomParamsValue3" value="<?=$PaymentMode?>"  />
   <input type="hidden" id="citrusCustomParamsName4" value="LeadsCredited"  />
   <input type="hidden" id="citrusCustomParamsValue4" value="<?=$LeadsCredited?>"  />
   <input type="hidden" id="citrusCustomParamsName5" value="PayuserId"  />
   <input type="hidden" id="citrusCustomParamsValue5" value="<?=$receiver?>"  />
      <!--Need to change with your Secret Key-->
      <input type="hidden" class="form-control" readonly id='citrusSignature' value="<?php echo $signature ?>"/>
      <?php echo $this->Html->image('redgif.gif', array('alt' => 'loading..','id' => 'wait-payment','style'=>'display:none'));?>
       <input type="hidden" class="form-control" readonly id='citrusCurrency' value="INR"/>
   
  <input type="hidden" class="form-control" readonly id="citrusReturnUrl" value="https://www.xerve.in/leads/pay_response/<?=$enquiry_id?>/<?=$sid_id?>/<?=$quoted_user?>">
  <br />
    <!--   </div> -->
      <!--panel body -->

 <div class='panel panel-info' id="pay_panel">
 <div class='panel-heading'>PAYMENT DETAILS</div>
 <span class="error_msg" id="paymentdetail_msg"></span>
   <div id="statuspay_msg" class="alert alert-success" style="display:none">
     Payment Received
    </div>
   <div class="row eliterw">
        <? if(COUNT($totaldata)>0){?>
                      
                      <span class="col-xs-6 padding-0"> 
                        <input id="checkbox-bank" class="checkbox-custom" name="checkbox-bank" type="checkbox" 
                        <?if($lastpay_paymentMode =='NET_BANKING'){?>checked="checked"<?}?>>
                        <label for="checkbox-bank" class="checkbox-custom-label">Netbanking</label></h4>
                    </span>
                       <span class="col-xs-6 padding-0">
                           <input id="checkbox-card" class="checkbox-custom" name="checkbox-card" type="checkbox" value=""
                           <?if(($lastpay_paymentMode =='CREDIT_CARD')||($lastpay_paymentMode =='DEBIT_CARD')){?>checked="checked"<?}?> >
                           <label for="checkbox-card" class="checkbox-custom-label">Credit or Debit Card </label></h4>
                     </span>
                          
                    
         <? }else{?>
       
         <span class="col-xs-6 padding-0"> 
            <input id="checkbox-bank" class="checkbox-custom" name="checkbox-bank" type="checkbox" checked="checked">
            <label for="checkbox-bank" class="checkbox-custom-label">Netbanking</label></h4>
        </span>
           <span class="col-xs-6 padding-0">
               <input id="checkbox-card" class="checkbox-custom" name="checkbox-card" type="checkbox">
               <label for="checkbox-card" class="checkbox-custom-label">Credit or Debit Card </label></h4>
         </span>
      
          <?}?>
  </div>
        <!--Credit /Debit Card Details-->
        <div id="card-option" <?if((COUNT($totaldata)>0)AND(($lastpay_paymentMode =='DEBIT_CARD')||($lastpay_paymentMode =='CREDIT_CARD'))){}else{?> style="display:none" <?}?>>
                   <div class='panel-heading' style="background-color: #d9edf7;border-color: #bce8f1;margin-top:15px">Credit/Debit Card Details</div> 
                    <div class='panel-body _elitebdy'>
                        <div class="row">
                                     <div class="col-md-6  col-xs-12  "> 
                                     <label>Card Type:</label>
                                                         <select id="citrusCardType" class="form-control">
                                                            <option selected="selected" value="credit">Credit</option>
                                                            <option value="debit">Debit</option>
                                                         </select>
                                     </div><!--col-md-4  col-xs-12  -->
                                    <div class="col-md-6  col-xs-12  "> <label>Card Number:</label>
                                    <input type="text" class="form-control" id="citrusNumber" value="" onblur="GetCardType(this)"/><br />
                                     <span class="error_msg" id="citrusNumber_msg"></span>
                                    </div><!--col-md-4  col-xs-12  -->
                        </div><!--row-->
                        <div class="row">
                               <div class="col-md-6  col-xs-12  "><label> Card Scheme:</label>
                                 <input type="text" class="form-control" readonly="true" id="citrusScheme" value=""  /><br />
                                </div><!--col-md-4  col-xs-12  -->
                                <div class="col-md-6  col-xs-12  "> 
                                         <label>            Name as on Card:</label>
                                   <input type="text" class="form-control" id="citrusCardHolder" value=""  onchange="check()"/><br />
                                    <span class="error_msg" id="citrusCardHolder_msg"></span>
                                </div><!--col-md-4  col-xs-12  -->
                        </div><!--row-->
                         <div class="row">
                              <div class="col-md-6  col-xs-12  "> 
                                         <label>Card Expiry 
                                         <span class="card_mon">(MM/YY)</span>:
                                         </label>
                                    <input type="text" class="form-control"  autocomplete="off" id="citrusExpiry" maxlength="7" value="" />
                                     <span class="error_msg" id="citrusExpiry_msg"></span>
                                      <span class="error_msg" id="citrus_Expiry_msg"></span>
                                    <br />
                              </div><!--col-md-4  col-xs-12  -->
                              <div class="col-md-6  col-xs-12  "> 
                                            <label> Card CVV:</label>
                                   <input type="password" class="form-control" autocomplete="off" id="citrusCvv"  value=""/>
                                    <span class="error_msg" id="citrusCvv_msg"></span>
                                    <span class="error_msg" id="citrus_Cvv_msg"></span>
                                   <br />
                              </div><!--col-md-4  col-xs-12  -->
                        </div><!--row-->
                        <div class="center col-xs-12 padding-0">  <input type="button" class="btn-primary" value="Pay by Card" id="citrusCardPayButton"  onclick="check_pay_card(),makePayment(citrusScheme.value)" /></div>
                     
                
                     </div><!--panel body for credit/debit cards -->
                  </div> <!--panel info for credit/debit cards-->
        </div><!--card-option -->
         <!--Credit /Debit Card Details ends-->
         <!--online banking Details-->
          <div id="bank-option"  <?if(COUNT($totaldata)==0){}else{
          if($lastpay_paymentMode =='NET_BANKING'){}if($lastpay_paymentMode !='NET_BANKING'){?> style="display:none" <?}}?>
                    >
                  <div class='panel panel-info'>
                   <div class='panel-heading'>Online Banking Details</div>
                    <div class='panel-body _eliteby'> 
                         <div class="row">
                            <div class="col-md-12  col-xs-12  "> 
                                   <label class="control-label" for="citrusAvailableOptions"> Select Bank:</label>
                                  <select class="form-control" id="citrusAvailableOptions">
                                  </select>
                            </div><!--col-md-4  col-xs-12  -->
                       </div><!--row-->
                      <br />
                      <input type="button" class="btn-primary" value="Pay by net banking" id="citrusNetbankingButton"/><br />
                     <br />
                   </div><!--panel body for net banking -->
                   </div><!--panel info for net banking-->
         </div><!--bank-option -->
          <div id="pay-status" style="display:none;color:#008000;background: #eee;width:400px; min-height: 25px;padding:10 10px;border: 1px solid #eee;">Payment Details Updated</div>
                    <!--DD  Details ends-->
                     <input type="hidden" id="otherpay-type" value=<?if(COUNT($totaldata)>0){echo $lastpay_paymentMode;}?>>
                    <input type="hidden" id="paypack" value="<?=$PayPackage?>">
                    <input type="hidden" id="payfor" value="<?=$PaymentFor?>">
                     <input type="hidden" id="leads_credited" value="<?=$LeadsCredited?>">
                     <input type="hidden" id="user_id" value="<?=$receiver?>">
               </form>

         </div><!--main panel info -->
           </div><!--container -->
     <script>
        fetchPaymentOptions();

      //Below function helps you to render the payment options on your own UI 
      //Merchants have to customize this function implementation in order to generate the UI of citrus wallet

      //for loading banks
      function handleCitrusPaymentOptions(citrusPaymentOptions) {
          // console.log(citrusPaymentOptions);
          var varnewarray = [];
              for (i = 0; i < citrusPaymentOptions.netBanking.length; i++) {
                varnewarray.push(citrusPaymentOptions.netBanking[i].bankName);
              }

           varnewarray = varnewarray.sort();
          /* debugger; */
          if (citrusPaymentOptions.netBanking != null){
            for (i4 = 0; i4 < varnewarray.length; i4++) {
              for (i = 0; i < citrusPaymentOptions.netBanking.length; i++) {
                    if (varnewarray[i4]==citrusPaymentOptions.netBanking[i].bankName) {
                    var obj = document.getElementById("citrusAvailableOptions");
                    var option = document.createElement("option");
                    option.text = citrusPaymentOptions.netBanking[i].bankName;
                    option.value = citrusPaymentOptions.netBanking[i].issuerCode;
                    obj.add(option);
                  }//if
                }//for i
              }//for i4
          }//if citrus
      }//handleCitrus

    function citrusServerErrorMsg(errorResponse) {
           //console.log(errorResponse);             
}
function citrusClientErrMsg(errorResponse) {
          // console.log(errorResponse);             
} 
     </script>
     
       <script type="text/javascript">
      //Net Banking
        $('#citrusNetbankingButton').on("click", function () { 
          makePayment("netbanking") ;
        });

        //Card Payment
        $("#citrusCardPayButton").on("click", function () {
         makePayment("card") ;
     });
     </script>
     <script type="text/javascript">
     $(document).ready(function () {
      var url=window.location.pathname;
      var res = url.split("/");
      var precheck_pay_type=res[4];//to check checkboxes from chat page
      if(precheck_pay_type=='card'){
            $('#checkbox-card').attr("checked", true);
            $('#checkbox-bank').attr('checked', false);
            
            $('#card-option').show();
            $('#bank-option').hide();
             
      }
      if(precheck_pay_type=='net'){
            $('#checkbox-bank').attr("checked", true);
            $('#checkbox-card').attr('checked', false);
            
            $('#bank-option').show(); 
            $('#card-option').hide();
          
      }
       

      $('#checkbox-card').change(function(e) {
        if($(this).is(":checked")) {
            $(this).attr("checked", true);
            $('#checkbox-bank').attr('checked', false);
           
            $('#card-option').show();
            $('#bank-option').hide();
            
        }
        else{
           $(this).attr("checked", true);
        }
      });


       $('#checkbox-bank').change(function(e) {
        if($(this).is(":checked")) {
            $(this).attr("checked", true);
            $('#checkbox-card').attr('checked', false);
            $('#checkbox-bank').css('margin-top','-45px');
            $('#bank-option').show(); 
            $('#card-option').hide();
            
        }
        else{
               $(this).attr("checked", true);
        }

      });//#checkbox-bank


        

      

        
       });
      </script>
      
     </body>
 </html>
    


    